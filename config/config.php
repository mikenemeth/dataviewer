<?php 

// Server host
define('DB_HOST', 'localhost');

// Database name
define('DB_NAME', 'sowreports');

// Database user
define('DB_USER', 'root');

// Database user password
define('DB_PASSWORD', 'webdev');

// System Version
define('VERSION', 'v0.1');

// Input file directories
define('STORE_1', 'data/store 1/');
define('STORE_2', 'data/store 2/');
define('STORE_3', 'data/store 3/');
define('STORE_6', 'data/store 6/');
define('STORE_7', 'data/store 7/');
define('STORE_8', 'data/store 8/');
define('STORE_10', 'data/store 10/');
define('STORE_11', 'data/store 11/');
define('STORE_12', 'data/store 12/');
define('STORE_13', 'data/store 13/');
define('STORE_15', 'data/store 15/');
define('STORE_16', 'data/store 16/');
define('STORE_17', 'data/store 17/');

//	Inventory file names
define('INVENTORY_FILE', 'InventoryList.csv');

// Sales Detail by Transaction File name
define('SALES_FILE', 'sales/sales.csv');

//Map store numbers to input directories
$CFG_STORE_MAP = array(
	'1' => STORE_1,
	'2' => STORE_2,
	'3' => STORE_3,
	'6' => STORE_6,
	'7' => STORE_7,
	'8' => STORE_8,
	'10' => STORE_10,
	'12' => STORE_12,
	'13' => STORE_13,
	'15' => STORE_15,
	'16' => STORE_16,
	'17' => STORE_17
);

// Set stores groups
$CFG_SOW_TRUCKS = array(1,3,6,10,12,13,15,16,17);
$CFG_SOW_WW = array(2,7);
$CFG_UES_STORES = array(8);
?>