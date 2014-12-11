 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$database = new Database();
$query = new Query($database);

$dateRange = array('14-01-01', '14-12-08');

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

<?php
if(isset($_GET['store'])) {
	$store = $_GET['store'];
}
else {
	echo "Failed.";
}
?>
<div id="wrapper">

      <div class="page-header">
        <h3>Truck Sales YTD <?php echo convertFromMysqlDate($dateRange[0]) . " - " . convertFromMysqlDate($dateRange[1]); ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Store', 'Retail', 'Actual', 'Discount', 'Percentage');
				$rows = $query->get_sales_by_store_by_daterange($store, $dateRange);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>

</div>