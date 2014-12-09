 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');

$allTrucks = array(1,3,6,10,12,13,15,16,17);
?>
    <div class="page-header">
        <h1>Inventory Overview</h1>
    </div>
<div id="controls">	  
	<div class="row">
		<form role="form" action="" method="get">	

			<div class="col-md-8">
				<fieldset>
					<div class="form-group">
					<label for="stores">Select Stores</label>
					<div id="dateRange" class="btn-group" role="group">
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 1)">1</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 3)">3</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 6)">6</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 10)">10</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 12)">12</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 13)">13</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 15)">15</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 16)">16</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php', 17)">17</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/inventoryoverview.php'">All Trucks</button>
					</div>
					</div>
				</fieldset>
				</div>
				
		</form>
	</div>
</div>

<div id="reportContainer">
	<p>Default Content.</p>
</div>