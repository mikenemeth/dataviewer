 <?php
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/dataupload.class.php');
require_once('class/display.class.php');
require_once('class/query.class.php');

$database = new Database();
$query = new Query($database);

$stores = array(12);
$dates = array('14-09-01', '14-12-01');
$vendors = array("'CHE'", "'KOI'", "'WKS'");
?>
	  <div class="page-header">
        <h1>Inventory by Store <small>Report generated Dec. 1, 2014</small></h1>
      </div>

	<div class="row">
		<div class="col-md-6" method="get">
			<form action="">
				<fieldset >
					<label for="storeSelect">Store Selector</label>
					<select class="form-control">
						<?php
							foreach($query->get_store_list()  as $row){
								foreach($row as $field=>$value){
									echo "<option>" . $value . "</option>";
								}
							}
						?>
					</select>
					<button type="submit" class="btn btn-default" value="">Show Report</button>
				</fieldset>
			</form>
		</div>
	</div>

      <div class="page-header">
        <h2>Store Inventory Analysis</h2>
      </div>
		
		<?php
		$headings = array('Vendor', 'In Stock', 'On Order', 'Min/Max');
		foreach($stores as $store) {
			echo '<div class="row"><h3>Store ' . $store .  '</h3>';
			echo '<div class="col-sm-6">';
				$rows = $query->get_inventory_qty_stock_order_minmax_by_store($store, $vendors);
				Display::displayTable($headings, $rows);
			echo "</div>";
			echo "</div>";
		}
		
		?>
		
      <div class="page-header">
        <h2>Store Items on Min/Max</h2>
      </div>
		
		<?php
		$headings = array('Vendor', 'In Stock', 'On Order', 'Min/Max');
		foreach($stores as $store) {
			echo '<div class="row"><h3>Store ' . $store .  '</h3>';
			echo '<div class="col-sm-6">';
				$rows = $query->get_inventory_by_store($store, $vendors);
				Display::displayTable($headings, $rows);
			echo "</div>";
			echo "</div>";
		}
		
		?>