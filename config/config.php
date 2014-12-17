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

//	Inventory file names
define('INVENTORY_FILE', 'InventoryList.csv');

// Sales Detail by Transaction File name
define('SALES_FILE', 'data/sales/sales.csv');

//Map store numbers to input directories
$CFG_STORE_MAP = array(
	'1' => 'data/store 1/',
	'2' => 'data/store 2/',
	'3' => 'data/store 3/',
	'6' => 'data/store 6/',
	'8' => 'data/store 8/',
	'10' => 'data/store 10/',
	'12' => 'data/store 12/',
	'13' => 'data/store 13/',
	'15' => 'data/store 15/',
	'16' => 'data/store 16/',
	'17' => 'data/store 17/'
);

// Set stores groups
$CFG_SOW_TRUCKS = array(1,3,6,10,12,13,15,16,17);
$CFG_SOW_WW = array(2,7);
$CFG_UES_STORES = array(8);
?>