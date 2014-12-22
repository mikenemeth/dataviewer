 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$database = new Database();
$query = new Query($database);

$depts = array('FOOTW');
?>

<div id="wrapper">

      <div class="page-header">
        <h2>Shoe Inventory Analysis <small><?php echo "Report generated " . date("m/d/Y"); ?></small></h2>
      </div>

		<?php
		foreach($depts as $dept) {
		$headings = array('Store', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10','10.5', '11', '11.5', '12', '13');
			echo '<div class="row"><h3>Shoes marked ' . $dept . '</h3>';
			echo '<div class="col-sm-12">';
				$rows = $query->get_shoe_inventory_by_size($dept);
				Display::displayTable($headings, $rows);
			echo "</div>";
			echo "</div>";
		}
		?>
</div>