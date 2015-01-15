 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');
require_once('../class/export.class.php');

$facility = $_REQUEST['facilitySelect'];

$database = new Database();
$query = new Query($database);

?>

<div id="wrapper">

      <div class="page-header">
        <h3><?php echo $facility  . " Sales Data" ?></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Date', 'Retail', 'Actual', 'Discount', 'Percentage', 'Invoices');
				$rows = $query->get_sales_by_facility($facility);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>

</div>