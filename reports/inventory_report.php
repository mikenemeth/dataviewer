 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
require_once('../class/utility.class.php');

$database = new Database();
$query = new Query($database);

$stores = array(1);
$vendors = array('CHE', 'KOI', 'WKS', 'WCS');

?>
<div id="wrapper">

      <div class="page-header">
        <h1>Truck Inventory Analysis</h1>
      </div>
	  

      <div class="page-header">
        <h3>Truck Inventory</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Vendor', 'In Stock', 'On Order', 'Min/Max', 'Min/Max +/-');
				$rows = $query->get_inventory($stores, $vendors);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
</div>
