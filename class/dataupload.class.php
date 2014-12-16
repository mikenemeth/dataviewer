<?php 

class DataUpload {

	var $inputFile;
	public $assocArray;
	
	public function __construct($inputFile) {
		$this->inputFile = $inputFile;
	}
	
/***********************************************
Read CSVs
***********************************************/
	public function readCSV() {
		$this->aryData = array();
		$header = NULL;
		$handle = fopen($this->inputFile, "r");
		
		if($handle) {
			while (!feof($handle) ) {
				$aryCsvData = fgetcsv($handle);
				if(!is_array($aryCsvData)) {
				continue;
				}
				if(is_null($header)) {
					$header = $aryCsvData;
				}	
				elseif (is_array($header) && count($header) == count($aryCsvData)) {
					$this->aryData[] = array_combine($header, $aryCsvData);
				}
			}
			fclose($handle);
		}
		echo "<p>CSV read into memory...</p>";
	}

/***********************************************
Convert short date to MySql date
***********************************************/
	private function convertToMysqlDate($shortDate) {

			$dateTemp = date_create_from_format('m/d/Y', $shortDate);

			$mysqlDate = date_format($dateTemp, 'y-m-d');
			
			return $mysqlDate;
	}


	private function getStoreNumber($string) {
		$store = explode("-", $string);
		
		return $store[1];
	}


/***********************************************

***********************************************/
	// Adds data to SALES table
	private function addSales() {

		$database = new Database();
		
		foreach($this->aryData as $record) {
				
			$storeNum = self::getStoreNumber($record{'Invoice No.'});
				
			$date = self::convertToMysqlDate($record{'Invoice Date'});
					
			$database->query(
				"INSERT INTO sales (`storeID`, `companyID`, `customer`, `invoiceDate`, `invoiceNum`, `vendorID`, `itemID`, `soldQty`, `cost`, `retail`, `actual`) 
				VALUES ( 
				(SELECT id FROM store WHERE `id`=:store), 
				(SELECT id FROM company WHERE `accountNum`=:company), 
				:customer, 
				:invoicedate, 
				:invoicenum, 
				(SELECT id FROM vendors WHERE `code`=:vendor), 
				(SELECT id FROM items WHERE `sku`=:sku), 
				:soldqty, 
				:cost, 
				:retail, 
				:actual)"
			);

			$database->bind(':store', $storeNum);
			$database->bind(':company', $record{'Account No.'});
			$database->bind(':customer', $record{'ShipTo'});
			$database->bind(':invoicedate', $date);
			$database->bind(':invoicenum', $record{'Invoice No.'});
			$database->bind(':vendor', $record{'Vendor'});
			$database->bind(':sku', trim(current(explode('(', $record{'Item'}))));
			$database->bind(':soldqty', $record{'Sold Qty'});
			$database->bind(':cost', $record{'Cost'});
			$database->bind(':retail', $record{'Retail'});
			$database->bind(':actual', $record{'Actual'});


			$database->execute();
			if($database->lastInsertId()) {
				echo "<br/ > Last row ID: " . $database->lastInsertId();
			}
		}
		echo "<p>All sales data added.</p>";
	}

	// Adds data to INVENTORY table
	private function addInventory($storeNumber) {
		
		$database = new Database();

		foreach($this->aryData as $record) {

			if(!$record{'Color'} && !$record{'Size'}) {
				$sku = $record{'Vendor'} . "-" . $record{'Style/Product'};
			}
			else {
				$sku = $record{'Vendor'} . "-" . $record{'Style/Product'} . "-" . $record{'Color'} . "-" . $record{'Size'};
			}
		
			$database->query(
				"INSERT INTO inventory  (`storeID`, `itemID`, `instock`, `onorder`, `min`, `max`) 
				VALUES (
				(SELECT id FROM store WHERE `id`=:store), 
				(SELECT id FROM items WHERE `sku`=:sku), 
				:instock, 
				:onorder, 
				:min, 
				:max)"
			);
				
			$database->bind(':store', $storeNumber);
			$database->bind(':sku', $sku);
			$database->bind(':instock', $record{'In-Stock'});
			$database->bind(':onorder', $record{'On Order'});
			$database->bind(':min', $record{'Min'});
			$database->bind(':max', $record{'Max'});

			$database->execute();
		}
		echo "<p>Inventory added for store " . $storeNumber . "</p>";
	}

	// Adds data to COMPANY table
	private function addCompanies() {
	
		$database = new Database();

		foreach($this->aryData as $record) {
					
			$database->query(
				"INSERT INTO company  (`accountNum`, `name`) 
				VALUES (:account, :name) 
				ON DUPLICATE KEY 
				UPDATE `accountNum`=:account, `name`=:name"
			);
				
			$database->bind(':account', $record{'Account No.'});
			$database->bind(':name', $record{'SoldTo'});

			$database->execute();
			if($database->lastInsertId()) {
				echo "<br/ > Row " . $database->lastInsertId() . " inserted.";
			}
		}
	}
	
	// Adds data to CUSTOMER table
	private function addCustomers() {
	
		$database = new Database();

		foreach($this->aryData as $record) {
					
			$database->query(
				"INSERT IGNORE INTO customer  (`name`, `companyID`) 
				VALUES (
				:name, 
				(SELECT id FROM company WHERE `name`=:company)"
				);
				
			$database->bind(':name', $record{'ShipTo'});
			$database->bind(':company', $record{'SoldTo'});

			$database->execute();
			if($database->lastInsertId()) {
				echo "<br/ > Row " . $database->lastInsertId() . " inserted.";
			}
		}
	}


	// Adds data to VENDORS table
	private function addVendors() {
	
		$database = new Database();

		foreach($this->aryData as $record) {
					
			$database->query(
				'INSERT IGNORE INTO vendors  (`code`) VALUES (:code)'
			);
				
			$database->bind(':code', $record{'Vendor'});

			$database->execute();
			if($database->lastInsertId()) {
				echo "<br/ > Last row ID: " . $database->lastInsertId();
			}
		}
	}
	
	// Adds data to ITEMS table using Sales Summary CSV format
	private function addItemsSales() {

		$database = new Database();
		
		foreach($this->aryData as $record) {
					
			$database->query(
				"INSERT INTO items (`sku`, `description`, `size`, `color`, `vendorID`) 
				VALUES ( :sku, :description, :size, :color, (SELECT id FROM vendors WHERE `code`=:vendor)) 
				ON DUPLICATE KEY 
				UPDATE `sku`=:sku, `description`=:description, `size`=:size, `color`=:color, `vendorID`=(SELECT id FROM vendors WHERE `code`=:vendor)"
			);
					
			$database->bind(':sku', trim(current(explode('(', $record{'Item'}))));
			$database->bind(':description', $record{'Description'});
			$database->bind(':size', $record{'Size'});
			$database->bind(':color', $record{'Color'});
			$database->bind(':vendor', $record{'Vendor'});

			$database->execute();
			if($database->lastInsertId()) {
				echo "<br/ > Last row ID: " . $database->lastInsertId();
			}
		}
	}

		// Adds data to ITEMS table using Inventory CSV format
	private function addItemsInventory() {

		$database = new Database();
		
		foreach($this->aryData as $record) {
			
			if(!$record{'Color'} && !$record{'Size'}) {
				$sku = $record{'Vendor'} . "-" . $record{'Style/Product'};
			}
			else {
				$sku = $record{'Vendor'} . "-" . $record{'Style/Product'} . "-" . $record{'Color'} . "-" . $record{'Size'};
			}
			
			$database->query(
				"INSERT INTO items (`sku`, `style`, `description`, `size`, `color`, `colorDesc`, `vendorID`, `dept`, `code`) 
				VALUES ( :sku, :style, :description, :size, :color, :colorDesc, (SELECT id FROM vendors WHERE `code`=:vendor), :dept, :code) 
				ON DUPLICATE KEY 
				UPDATE `sku`=:sku, `style`=:style, `description`=:description, `size`=:size, `color`=:color, `colorDesc`=:colorDesc, `vendorID`=(SELECT id FROM vendors WHERE `code`=:vendor), `dept`=:dept, `code`=:code"
			);
					
			$database->bind(':sku', $sku);
			$database->bind(':style', $record{'Style/Product'});
			$database->bind(':description', $record{'Description'});
			$database->bind(':size', $record{'Size'});
			$database->bind(':color', $record{'Color'});
			$database->bind(':colorDesc', $record{'Color Description'});
			$database->bind(':vendor', $record{'Vendor'});
			$database->bind(':dept', $record{'Depart'});
			$database->bind(':code', $record{'Code'});

			$database->execute();
			if($database->lastInsertId()) {
				echo "<br/ > Last row ID: " . $database->lastInsertId();
			}
		}
	}	
	
	// Empty inventory table can become very large over time
	public function emptyInventoryTable() {
		$database = new Database();
		$database->query('TRUNCATE `inventory`');
		$database->execute();
		echo '<br /><p>Inventory table data cleared.</p>';
	}
	
	public function uploadSalesData() {
	
		$this->addVendors();
		$this->addItemsSales();
		$this->addCompanies();
		$this->addSales();
	}
	
	public function uploadInventoryData($storeNumber) {
		
		$this->addVendors();
		$this->addItemsInventory();
		$this->addInventory($storeNumber);
	}

}

?>