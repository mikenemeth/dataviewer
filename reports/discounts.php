 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
require_once('../class/utility.class.php');

$database = new Database();
$query = new Query($database);

$year = 2014;
$stores = array(1,3,6,10,12,13,15,16,17);
$ues = array(2,7,8);
$yearRange = array('14-01-01', '14-12-07');
$monthRange = array('14-12-01', '14-12-07');
$lastWeek = array('14-12-01', '14-12-07');

?>
<div id="wrapper">

      <div class="page-header">
        <h1>Discounts Report for All Trucks</h1>
      </div>
	  

      <div class="page-header">
        <h3>Truck Sales YTD <?php echo Utility::convertFromMysqlDate($yearRange[0]) . " - " . Utility::convertFromMysqlDate($yearRange[1]); ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($stores, $yearRange);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
	  
      <div class="page-header">
        <h3>Truck Sales MTD <?php echo convertFromMysqlDate($monthRange[0]) . " - " . Utility::convertFromMysqlDate($monthRange[1]); ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($stores, $monthRange);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
	  
      <div class="page-header">
        <h3>Truck Sales Last Week <?php echo Utility::convertFromMysqlDate($lastWeek[0]) . " - " . Utility::convertFromMysqlDate($lastWeek[1]); ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($stores, $lastWeek);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
</div>
