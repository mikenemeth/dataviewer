 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>
    <div class="page-header">
        <h1>Truck Inventory Analysis</h1>
    </div>
<div id="controls">
	<div class="row"><p class="col-md-12">Select a time frame to calculate sales averages and a target number of weeks to stock for.</p></div>
	<div class="row">
		<form id="inventoryReportControl" role="form" action="" method="post">			
				
			<button type="button" id="submit_btn" class="btn btn-primary" name="submit" value="submit" onclick="getSalesReport('reports/inventoryreport.php')">Submit</button>
		</form>
	</div>
</div>

<div id="reportContainer">
	<?php include('inventory-dashboard.php'); ?>
</div>