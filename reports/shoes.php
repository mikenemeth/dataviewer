 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$database = new Database();
$query = new Query($database);

$codes = array('PRINT', 'CLEAR', 'CLOSE');
?>

<div id="wrapper">

      <div class="page-header">
        <h2>Print Top Inventory Analysis <small><?php echo "Report generated " . date("m/d/Y"); ?></small></h2>
      </div>

		<?php
		foreach($codes as $code) {
		$headings = array('Store', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL');
			echo '<div class="row"><h3>Print Tops marked ' . $code . '</h3>';
			echo '<div class="col-sm-12">';
				$rows = $query->get_print_top_inventory_by_size($code);
				Display::displayTable($headings, $rows);
			echo "</div>";
			echo "</div>";
		}
		?>
</div>