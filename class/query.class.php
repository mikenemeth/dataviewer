<?php 
require_once('utility.class.php');

class Query {

	
	public function __construct(Database $db) {
		$this->db = $db;
	}
	
	public function get_weekly_sold_average_by_vendor($dateArray, $vendorArray, $store) {
		$this->db->query(
			"SELECT vendors.code AS Vendor, (SUM(sales.soldQty)/13) AS 'Weekly Avg.' 
			FROM `vendors`, `items`, `sales` 
			WHERE sales.storeID=" . $store . " AND (sales.invoiceDate>='" . $dateArray[0] . "' AND sales.invoiceDate<='" . $dateArray[1] . "')  
			AND (items.vendorID=vendors.id AND items.id=sales.itemID) AND vendors.code IN (" . implode(",", $vendorArray) . ") 
			GROUP BY Vendor"
		);
		$this->db->execute();
		return $this->db->resultset();
	}
	
	public function get_inventory_qty_stock_order_minmax_by_store($stores, $vendorArray) {
		if(is_array($stores)) {
			$stores = implode(",", $stores);
		}
		$this->db->query(
			"SELECT vendors.code AS Vendor, SUM(inventory.instock) AS InStock, SUM(inventory.onorder) AS OnOrder, SUM(inventory.min) AS MinMax, (SUM(inventory.onorder) + SUM(inventory.instock))-SUM(inventory.min) 'MinMax +/-'
			FROM `inventory`, `vendors`, `items` 
			WHERE inventory.storeID=" . $stores . "  AND inventory.min>0
			AND (items.vendorID=vendors.id AND items.id=inventory.itemID)
			GROUP BY Vendor"
		);
		$this->db->execute();
		return $this->db->resultset();
	}
	
	public function get_inventory($stores, $vendorArray) {
		if(is_array($stores)) {
			$stores = implode(",", $stores);
		}
		if(is_array($vendorArray)) {
			$vendorArray = implode(",", $vendorArray);
		}
		$this->db->query(
			"SELECT vendors.code AS Vendor, SUM(inventory.instock) AS InStock, SUM(inventory.onorder) AS OnOrder, SUM(inventory.min) AS MinMax, (SUM(inventory.onorder) + SUM(inventory.instock))-SUM(inventory.min) 'MinMax +/-'
			FROM `inventory`, `vendors`, `items` 
			WHERE inventory.storeID=(" . $stores . ")  AND vendors.code IN (" . $vendorArray . ") AND inventory.min>0 
			AND (items.vendorID=vendors.id AND items.id=inventory.itemID) 
			GROUP BY Vendor"
		);
		$this->db->execute();
		return $this->db->resultset();
	}

	public function get_inventory_by_store($store) {
		$this->db->query(
			"SELECT items.sku AS Item, inventory.instock as InStock, inventory.onorder AS OnOrder, inventory.min AS MinMax 
			FROM `inventory` 
			INNER JOIN `items` 
			ON items.id=inventory.itemID 
			WHERE inventory.min>0 AND inventory.storeID=" . $store .  
			" ORDER BY inventory.instock DESC"
		);
		$this->db->execute();
		return $this->db->resultset();
	}
	
	public function get_inventory_over_under_minmax($store) {
		$this->db->query(
			"SELECT items.sku AS Item, inventory.instock as InStock, inventory.onorder AS OnOrder, inventory.min AS MinMax 
			FROM `inventory` 
			INNER JOIN `items` 
			ON items.id=inventory.itemID 
			WHERE inventory.min>0 AND inventory.storeID=" . $store .  
			" ORDER BY inventory.min DESC"
		);
		$this->db->execute();
		return $this->db->resultset();
	}
	
	public function get_last_sale_date() {
		$this->db->query( "SELECT MAX(invoiceDate) FROM sales");
		$this->db->execute();
		return $this->db->single();
	}
	
	public function get_ytd_sales() {
		$this->db->query("SELECT `value` FROM stats WHERE name='ytd_sales'");
		$this->db->execute();
		return $this->db->single();
	}
	
	public function get_mtd_sales() {
		$this->db->query("SELECT `value` FROM stats WHERE name='mtd_sales'");
		$this->db->execute();
		return $this->db->single();
	}

	public function get_store_list() {
		$this->db->query(
			"SELECT id FROM `store`;"
		);
		$this->db->execute();
		return $this->db->resultset();
	}
	
	// Saved for later date
	public function get_facility_list() {
		$this->db->query();
		$this->db->execute();
		return $this->db->resultset();
	}
	
	public function get_year_list() {
		$this->db->query(
			"SELECT YEAR(invoiceDate) FROM `sales` GROUP BY YEAR(invoiceDate)"
		);
		$this->db->execute();
		return $this->db->resultSet();
	}
	
	public function get_total_sales_single_year($year, $storeArray) {
		$this->db->query(
			"SELECT SUM(actual) AS Actual 
			FROM `sales` 
			WHERE YEAR(invoiceDate)=" . $year . 
			" AND storeID IN (" . implode(',', $storeArray) . ")"
			);
		$this->db->execute();
		return $this->db->single();
	}
	
	public function get_single_store_sales_by_month($year, $store) {
		$this->db->query(
			"SELECT MONTHNAME(STR_TO_DATE(MONTH(invoiceDate), '%m')), SUM(retail) AS Retail, SUM(actual) AS Actual, SUM(retail-actual) AS Discount, (SELECT (SUM(retail)-SUM(actual))/SUM(retail)*100) As Percent 
			FROM `sales` 
			WHERE YEAR(invoiceDate)=" . $year . " AND storeID=" . $store . 
			" GROUP BY MONTHNAME(invoiceDate) ORDER BY MONTH(invoiceDate) ASC"
		);
		$this->db->execute();
		$result = $this->db->resultSet();
	}
	
	public function get_sales_by_store_by_daterange($stores, $dateArray) {
		if(is_array($stores)) {
			$stores = implode(",", $stores);
		}
		
		$this->db->query(
			"SELECT IFNULL(storeID, 'Total') AS Store, SUM(retail) AS Retail, SUM(actual) AS Actual, SUM(Retail-Actual) AS Discount, (SELECT (SUM(retail)-SUM(actual))/SUM(retail)*100) As Percent 
			FROM `sales` 
			WHERE (invoiceDate>='" . $dateArray[0] . "' AND invoiceDate<='" . $dateArray[1] . "') 
			AND storeID IN (" . $stores . ") 
			GROUP BY storeID WITH ROLLUP"		
		);
		$this->db->execute();
		$result = $this->db->resultSet();
		
		foreach($result as $field=>$value) {
			$result[$field]['Retail'] = '$' . number_format($value['Retail'],2);
			$result[$field]['Actual'] = '$' . number_format($value['Actual'],2);
			$result[$field]['Discount'] = '$' . number_format($value['Discount'],2);
			$result[$field]['Percent'] = number_format($value['Percent'],2) . '%';
		}
		return $result;
	}
	
	public function get_print_top_inventory_by_size($code) {
		$this->db->query(
			"SELECT inventory.storeID AS Store, 
			SUM(IF(items.size='XS',inventory.instock,0)) AS 'XS', 
			SUM(IF(items.size='S',inventory.instock,0)) AS 'S', 
			SUM(IF(items.size='M',inventory.instock,0)) AS 'M', 
			SUM(IF(items.size='L',inventory.instock,0)) AS 'L', 
			SUM(IF(items.size='XL',inventory.instock,0)) AS 'XL', 
			SUM(IF(items.size='2XL',inventory.instock,0)) AS '2XL', 
			SUM(IF(items.size='3XL',inventory.instock,0)) AS '3XL', 
			SUM(IF(items.size='4XL',inventory.instock,0)) AS '4XL', 
			SUM(IF(items.size='5XL',inventory.instock,0)) AS '5XL' 
			FROM `inventory` 
			INNER JOIN `items` ON inventory.itemID=items.id 
			WHERE inventory.instock>0 AND items.dept='PRINT' AND items.code='" . $code . "' AND inventory.storeID IN (1,2,3,6,8,10,12,13,15,16,17) 
			GROUP BY inventory.storeID"
		);
		$this->db->execute();
		return $this->db->resultSet();
	}
	
	public function get_shoe_inventory_by_size($dept) {
		$this->db->query(
			"SELECT inventory.storeID AS Store,
				SUM(IF(items.size='6',inventory.instock,0)) AS '6',
				SUM(IF(items.size='6H',inventory.instock,0)) AS '6.5',
				SUM(IF(items.size='7',inventory.instock,0)) AS '7',
				SUM(IF(items.size='7H',inventory.instock,0)) AS '7.5',
				SUM(IF(items.size='8',inventory.instock,0)) AS '8',
				SUM(IF(items.size='8H',inventory.instock,0)) AS '8.5',
				SUM(IF(items.size='9',inventory.instock,0)) AS '9',
				SUM(IF(items.size='9H',inventory.instock,0)) AS '9.5',
				SUM(IF(items.size='10',inventory.instock,0)) AS '10',
				SUM(IF(items.size='10H',inventory.instock,0)) AS '10.5',
				SUM(IF(items.size='11' OR items.size='11.00',inventory.instock,0)) AS '11',
				SUM(IF(items.size='11H',inventory.instock,0)) AS '11.5',
				SUM(IF(items.size='12',inventory.instock,0)) AS '12',
				SUM(IF(items.size='13',inventory.instock,0)) AS '13'
				FROM `inventory`
				INNER JOIN `items` ON inventory.itemID=items.id
				WHERE inventory.instock>0 AND items.dept='" . $dept . "' AND inventory.storeID IN (1,2,3,6,8,10,12,13,15,16,17)
				GROUP BY inventory.storeID"
		);
		$this->db->execute();
		return $this->db->resultSet();
	}
	
	public function get_store_sales_data_by_year($store, $year) {
		$this->db->query(
			"SELECT DATE_ADD(sales.invoiceDate, INTERVAL(7-DAYOFWEEK(sales. invoiceDate)) DAY) 'End Date', 
			SUM(sales.retail) 'Retail', 
			SUM(sales.actual) 'Actual', 
			SUM(Retail-Actual) 'Discount', 
			(SELECT (SUM(sales.retail)-SUM(sales.actual))/SUM(sales.retail)*100) 'Percent', 
			SUM(sales.soldQty) 'Pcs Sold', 
			COUNT(DISTINCT sales.invoiceNum) 'Invoices', 
			COUNT(DISTINCT sales.customer) 'Customers' 
			FROM `sales` 
			WHERE YEAR(sales.invoiceDate)=" . $year . " AND sales.storeID=" . $store . " GROUP BY WEEK(sales.invoiceDate) 
			WITH ROLLUP"
		);
		$this->db->execute();
		$result = $this->db->resultSet();
		
		foreach($result as $field=>$value) {
			$result[$field]['Retail'] = '$' . number_format($value['Retail'],2);
			$result[$field]['Actual'] = '$' . number_format($value['Actual'],2);
			$result[$field]['Discount'] = '$' . number_format($value['Discount'],2);
			$result[$field]['Percent'] = number_format($value['Percent'],2) . '%';
		}
		return $result;
	}
	
	public function get_sales_by_facility($facility) {
		$this->db->query(
			"SELECT sales.invoiceDate 'Date', SUM(retail) AS Retail, SUM(actual) AS Actual, SUM(retail-actual) AS Discount, (SELECT (SUM(retail)-SUM(actual))/SUM(retail)*100) As Percent, COUNT(DISTINCT sales.invoiceNum) 'Invoices' 
			FROM `sales` 
			JOIN `company` ON sales.companyID=company.id 
			WHERE company.name='" . $facility . "' OR company.accountNum='" . $facility . "' AND sales.actual>0 
			GROUP BY sales.invoiceDate 
			ORDER BY `Date` DESC"
		);
		$this->db->execute();
		$result = $this->db->resultSet();
		foreach($result as $field=>$value) {
			if($result[$field]['Date'] != 'Total') {
				$result[$field]['Date'] = Utility::convertMysqlDateToShortDate($result[$field]['Date']);
			}
			$result[$field]['Retail'] = '$' . number_format($value['Retail'],2);
			$result[$field]['Actual'] = '$' . number_format($value['Actual'],2);
			$result[$field]['Discount'] = '$' . number_format($value['Discount'],2);
			$result[$field]['Percent'] = number_format($value['Percent'],2) . '%';
		}
		return $result;
	}
	
	public function get_customer_brand_purchases($vendor) {
		$this->db->query(
			"SELECT storeID, SUM(soldQty) 'Sold Qty', invoiceNum, SUM(retail) 'Retail' FROM sales WHERE storeID IN(1,3,6,10,12,13,15,16,17) AND vendorID=2 AND (invoiceDate>='14-10-01' AND invoiceDate<='14-11-18') GROUP BY invoiceNum ORDER BY `Sold Qty` DESC"
		);
		$this->db->execute();
		$result = $this->db->resultSet();
		
		foreach ($rows as $row) {
			foreach ($row as $field=>$value) {
				echo $value;
			}
		}
		
		return $result;
		var_dump($result);
	}
}
?>