 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>

<?php
if(isset($_GET['store'])) {
	$store = $_GET['store'];
}
else {
	echo "Failed.";
}

$database = new Database();
$query = new Query($database);

$year = 2014;
$trucks = array(1,3,6,10,12,13,15,16,17);
$ues = array(2,7, 8);
$dateRange = array('14-11-01', '14-11-30');
?>

      <div class="page-header">
        <h1>Sales Overview for Nov 01, 2014 - Nov 30, 2014</h1>
      </div>
	  

      <div class="page-header">
        <h3>Truck Sales</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($trucks, $dateRange);
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
