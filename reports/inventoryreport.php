 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
require_once('../class/utility.class.php');

$database = new Database();
$query = new Query($database);

$vendors = array('CHE', 'KOI', 'WKS', 'WCS');

?>
<div id="wrapper">
      <div class="page-header">
        <h3>Truck Inventory</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
			<?php
				$headings = array('Vendor', 'In Stock', 'On Order', 'Min/Max', 'Min/Max +/-');
				$rows = $query->get_inventory_analysis($vendors, 12, 4.5);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
</div>
