<?php
/***********************************************
SALES AND INVENTORY UPDATER

Reads inventory data files for each store specified in config.php 
and a sales data file. 

@author Mike Nemeth <mike@mikenemeth.com>
©2014 Healthcare Uniform Solutions
***********************************************/

require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/dataupload.class.php');
require_once('class/query.class.php');


function updateInventory() {

	$upload->emptyInventoryTable(); //clear Inventory table before upload

	foreach($CFG_STORE_MAP as $storeNumber=>$directory) {
		$inputFile = $storeNumber[$directory] . INVENTORY_FILE;

		$upload = new DataUpload($inputFile);
		$upload->readCSV();
		echo "Parsing inventory input file: $inputFile";
		$upload->uploadInventoryData($storeNumber);
	}
}

function updateSales() {
	
	$upload = new DataUpload(SALES_FILE);
	echo "Parsing sales input file...";
	$upload->readCSV();
	$upload->uploadSalesData();
}

// Run script
//updateSales();
updateInventory();

?>