 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>
    <div class="page-header">
        <h1>Data Uploader</h1>
    </div>
<div id="controls">	  
	<div class="row">
		<form id="updateTypeControl" role="form" action="" method="post">	

			<div class="col-md-3">
				<fieldset>
					<div class="form-group">
					<div id="updateSelect" class="input-group">
						<select name="updateSelect" class="form-control" required>
						  <option >Select update type...</option>
						  <option value="sales">Sales</option>
						  <option value="inventory">Inventory</option>
						</select>
					</div>
					</div>
				</fieldset>
				</div>			
				
			<button type="button" id="submit_btn" class="btn btn-primary" name="submit" value="submit" onclick="getSalesReport('update-database.php')">Run update now.</button>
			
		</form>
	</div>
</div>

<div id="reportContainer">
</div>