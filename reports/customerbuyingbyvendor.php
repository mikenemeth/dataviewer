 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$store = $_REQUEST['storeSelect'];
$startDate = $_REQUEST['startDate'];
$endDate = $_REQUEST['endDate'];

$database = new Database();
$query = new Query($database);

function convertToMysqlDate($shortDate) {

	$dateTemp = date_create_from_format('m/d/Y', $shortDate);
	$mysqlDate = date_format($dateTemp, 'y-m-d');		
	return $mysqlDate;
}

function convertFromMysqlDate($mysqlDate) {

	$dateTemp = date_create_from_format('y-m-d', $mysqlDate);
	$shortDate = date_format($dateTemp, 'm/d/Y');	
	return $shortDate;
}

function convertHtmlDateToShortDate($htmlDate) {

	$dateTemp = date_create_from_format('Y-m-d', $htmlDate);
	$shortDate = date_format($dateTemp, 'm/d/Y');	
	return $shortDate;
}

function convertHtmlDateToMysqlDate($htmlDate) {

	$dateTemp = date_create_from_format('Y-m-d', $htmlDate);
	$mysqlDate = date_format($dateTemp, 'y-m-d');	
	return $mysqlDate;
}
?>

<div id="wrapper">

      <div class="page-header">
        <h3><?php echo "Purchases by Vendor: " . convertHtmlDateToShortDate($startDate) . " - " . convertHtmlDateToShortDate($endDate); ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$dateRange = array(convertHtmlDateToMysqlDate($startDate), convertHtmlDateToMysqlDate($endDate));
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($store, $dateRange);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>

</div>