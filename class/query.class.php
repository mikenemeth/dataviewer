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
	
	public function get_single_store_sales_by_by_daterange() {
		$this->db->query(
			"SELECT MONTH(invoiceDate) AS Month, SUM(retail) AS Retail, SUM(actual) AS Actual, SUM(retail-actual) AS Discount, (SELECT (SUM(retail)-SUM(actual))/SUM(retail)*100) As Percent 
			FROM `sales` 
			WHERE YEAR(invoiceDate)=2014 AND storeID=1 
			GROUP BY MONTH(invoiceDate)"
		);
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
	
}
?>