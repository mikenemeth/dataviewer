 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>
    <div class="page-header">
        <h1>Inventory by Store</h1>
    </div>
<div id="controls">	  
	<div class="row">
		<form id="inventoryReportControl" role="form" action="" method="post">	

			<div class="col-md-3">
				<fieldset>
					<div class="form-group">
					<div id="storeSelect" class="input-group">
						<select name="storeSelect" class="form-control" required>
						  <option >Select Stores...</option>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="6">6</option>
						  <option value="7">7</option>
						  <option value="8">8</option>
						  <option value="10">10</option>
						  <option value="12">12</option>
						  <option value="13">13</option>
						  <option value="15">15</option> 
						  <option value="16">16</option>
						  <option value="17">17</option> 
						</select>
					</div>
					</div>
				</fieldset>
				</div>			
				
			<button type="button" id="submit_btn" class="btn btn-primary" name="submit" value="submit" onclick="getSalesReport('reports/inventorybystore.php')">Submit</button>
		</form>
	</div>
</div>

<div id="reportContainer">
	<?php include('inventory-dashboard.php'); ?>
</div>