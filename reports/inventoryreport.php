 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
require_once('../class/utility.class.php');

$database = new Database();
$query = new Query($database);

$vendors = array('CHE', 'KOI', 'WKS', 'WCS');
$weeks = 12;
$targetWeeks = 4.5;

?>
<div id="wrapper">
      <div class="page-header">
        <h3>Truck Inventory</h3>
      </div>

      <?php 
      foreach($CFG_SOW_TRUCKS as $store) {
      ?>
      <div class="row">
        <div class="col-md-12">
            <h4><?php echo "Truck $store"; ?></h4>
			<?php
				$headings = array('Vendor', 'Sales Avg', 'In Stock', 'On Order', 'Min/Max', 'At M/M','Min/Max +/-', 'Stock +/-' , 'O/H');
				$rows = $query->get_inventory_analysis($store, $vendors, $weeks, $targetWeeks);
				Display::displayTable($headings, $rows);
			?>
		</div>
      </div>
    <?php } ?>
</div>
