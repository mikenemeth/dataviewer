<?php
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/dataupload.class.php');

//$inputFile = STORE_17 . INVENTORY_FILE;
//$storeNumber = 17;


$inputFile = 'data/sales/Sales Detail by Transaction 1-01-10 to 12-31-10.csv';
$upload = new DataUpload($inputFile);
$upload->readCSV();

$upload->uploadSalesData();


?>