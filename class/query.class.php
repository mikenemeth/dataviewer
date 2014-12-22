<?php 
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
			"SELECT vendors.code AS Vendor, SUM(inventory.instock) AS InStock, SUM(inventory.onorder) AS OnOrder, SUM(inventory.min) AS MinMax
			FROM `inventory`, `vendors`, `items` 
			WHERE inventory.storeID=" . $stores . "  AND inventory.min>0
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

	public function get_store_list() {
		$this->db->query(
			"SELECT id FROM `store`;"
		);
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
			SUM(IF(items.size='XS',1,0)) AS 'XS', 
			SUM(IF(items.size='S',1,0)) AS 'S', 
			SUM(IF(items.size='M',1,0)) AS 'M', 
			SUM(IF(items.size='L',1,0)) AS 'L', 
			SUM(IF(items.size='XL',1,0)) AS 'XL', 
			SUM(IF(items.size='2XL',1,0)) AS '2XL', 
			SUM(IF(items.size='3XL',1,0)) AS '3XL', 
			SUM(IF(items.size='4XL',1,0)) AS '4XL', 
			SUM(IF(items.size='5XL',1,0)) AS '5XL' 
			FROM `inventory` 
			INNER JOIN `items` ON inventory.itemID=items.id 
			WHERE inventory.instock>0 AND items.code='" . $code . "' AND inventory.storeID IN (1,3,6,10,12,13,15,16,17) 
			GROUP BY inventory.storeID"
		);
		$this->db->execute();
		return $this->db->resultSet();
	}
	
	public function get_shoe_inventory_by_size($dept) {
		$this->db->query(
			"SELECT inventory.storeID AS Store,
				SUM(IF(items.size='6',1,0)) AS '6',
				SUM(IF(items.size='6.5',1,0)) AS '6.5',
				SUM(IF(items.size='7',1,0)) AS '7',
				SUM(IF(items.size='7.5',1,0)) AS '7.5',
				SUM(IF(items.size='8',1,0)) AS '8',
				SUM(IF(items.size='8.5',1,0)) AS '8.5',
				SUM(IF(items.size='9',1,0)) AS '9',
				SUM(IF(items.size='9.5',1,0)) AS '9.5',
				SUM(IF(items.size='10',1,0)) AS '10',
				SUM(IF(items.size='10.5',1,0)) AS '10.5',
				SUM(IF(items.size='11',1,0)) AS '11',
				SUM(IF(items.size='11.5',1,0)) AS '11.5',
				SUM(IF(items.size='12',1,0)) AS '12',
				SUM(IF(items.size='13',1,0)) AS '13'
				FROM `inventory`
				INNER JOIN `items` ON inventory.itemID=items.id
				WHERE inventory.instock>0 AND items.dept='" . $dept . "' AND inventory.storeID IN (1,3,6,10,12,13,15,16,17)
				GROUP BY inventory.storeID"
		);
		$this->db->execute();
		return $this->db->resultSet();
	}
	
	public function get_store_sales_data_by_year($store, $year) {
		$this->db->query(
			"SELECT WEEK(sales.invoiceDate) 'Week', 
			SUM(sales.retail) 'Retail', 
			SUM(sales.actual) 'Actual', 
			SUM(Retail-Actual) 'Discount', 
			(SELECT (SUM(sales.retail)-SUM(sales.actual))/SUM(sales.retail)*100) 'Percent', 
			SUM(sales.soldQty) 'Pcs Sold', 
			COUNT(DISTINCT sales.invoiceNum) 'Invoices', 
			COUNT(DISTINCT sales.customer) 'Customers' 
			FROM `sales` 
			WHERE YEAR(sales.invoiceDate)=" . $year . " AND sales.storeID=" . $store . " GROUP BY WEEK(sales.invoiceDate)"
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
			WHERE company.accountNum='" . $facility . "' AND sales.actual>0 
			GROUP BY sales.invoiceDate 
			ORDER BY sales.invoiceDate ASC"
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
}
?>