<?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');

// Update inventory
$updateType = $_REQUEST['updateSelect'];

echo $updateType;

$inputFile = $CFG_STORE_MAP[$storeNumber] . INVENTORY_FILE;

echo "Parsing input file: $inputFile";
//$upload = new DataUpload($inputFile);
//$upload->readCSV();
//$upload->uploadInventoryData($storeNumber);

?>