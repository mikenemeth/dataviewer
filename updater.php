<?php
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/dataupload.class.php');
require_once('class/query.class.php');
require_once('class/display.class.php');

//$inputFile = STORE_17 . INVENTORY_FILE;
//$storeNumber = 17;

//$inputFile = 'data/sales/Sales Detail by Transaction 1-01-14 to 12-01-14.csv';
//$upload = new DataUpload($inputFile);
//$upload->readCSV();

//$upload->uploadSalesData();
$database = new Database();
$query = new Query($database);

$stores = array(1,3,6,10,12,13,15,16,17);
$dates = array('14-09-01', '14-12-01');
$vendors = array("'CHE'", "'KOI'", "'WKS'");

foreach($stores as $store) {
	$query->get_weekly_sold_average_by_vendor($dates, $vendors, $store);
	echo "<br /><br />";
}

?>