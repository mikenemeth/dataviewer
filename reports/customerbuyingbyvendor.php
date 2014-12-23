 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');
require_once('../class/utility.class.php');

$vendor = $_REQUEST['vendorSelect'];
$startDate = $_REQUEST['startDate'];
$endDate = $_REQUEST['endDate'];

$database = new Database();
$query = new Query($database);

?>

<div id="wrapper">

      <div class="page-header">
        <h3><?php echo "Purchases by Vendor: " . Utility::convertHtmlDateToShortDate($startDate) . " - " . Utility::convertHtmlDateToShortDate($endDate); ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$dateRange = array(Utility::convertHtmlDateToMysqlDate($startDate), Utility::convertHtmlDateToMysqlDate($endDate));
				$headings = array('# Bought', 'Customers');
				$rows = $query->get_customer_brand_purchases($vendor);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>

</div>