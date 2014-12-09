 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');

$database = new Database();
$query = new Query($database);

$year = 2014;
$stores = array(1,3,6,10,12,13,15,16,17);
$ues = array(2,7,8);
$dateRange = array('14-01-01', '13-12-31');

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


?>
<div id="wrapper">

      <div class="page-header">
        <h1>Sales Overview for <?php echo convertFromMysqlDate($dateRange[0]) . " - " . convertFromMysqlDate($dateRange[1]); ?></h1>
      </div>
	  

      <div class="page-header">
        <h3>Truck Sales</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($stores, $dateRange);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
	  
      <div class="page-header">
        <h3>UES Sales</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($ues, $dateRange);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
</div>
