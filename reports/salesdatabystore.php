 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$store = $_REQUEST['storeSelect'];
$year = $_REQUEST['yearSelect'];

$database = new Database();
$query = new Query($database);

?>

<div id="wrapper">

      <div class="page-header">
        <h3><?php echo "Store " . $store  . " Sales Data: " . $year; ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Week Ending', 'Retail', 'Actual', 'Discount', 'Percentage', 'Items Sold', 'Invoices', 'Customers');
				$rows = $query->get_store_sales_data_by_year($store, $year);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>

</div>