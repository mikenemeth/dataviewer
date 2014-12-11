 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$database = new Database();
$query = new Query($database);

$store = $_REQUEST['storeSelect'];
$vendors = array("'CHE'", "'KOI'", "'WKS'");
?>

<div id="wrapper">

      <div class="page-header">
        <h2>Store Inventory Analysis</h2>
      </div>

		<?php
		$headings = array('Vendor', 'In Stock', 'On Order', 'Min/Max');
			echo '<div class="row"><h3>Store ' . $store .  '</h3>';
			echo '<div class="col-sm-6">';
				$rows = $query->get_inventory_qty_stock_order_minmax_by_store($store, $vendors);
				Display::displayTable($headings, $rows);
			echo "</div>";
			echo "</div>";
		
		?>
		
      <div class="page-header">
        <h2>Store Items on Min/Max</h2>
      </div>
		
		<?php
		$headings = array('Vendor', 'In Stock', 'On Order', 'Min/Max');
			echo '<div class="row"><h3>Store ' . $store .  '</h3>';
			echo '<div class="col-sm-6">';
				$rows = $query->get_inventory_by_store($store, $vendors);
				Display::displayTable($headings, $rows);
			echo "</div>";
			echo "</div>";
		
		?>
</div>