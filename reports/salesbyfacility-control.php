 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>

    <div class="page-header">
        <h1>Sales by Facility</h1>
    </div>
<div id="controls">	  
	<div class="row">
		<form id="salesReportControl" role="form" action="" method="post">	

			<div class="col-md-3">
				<fieldset>
					<div class="form-group">
					<div id="facilitySelect" class="input-group">
						<select name="facilitySelect" class="form-control" required>
						  <option >Select Facility...</option>
						  <option value="981-12">W.S.M.C Auxillary</option>
						</select>
					</div>
					</div>
				</fieldset>
				</div>

			<button type="button" id="submit_btn" class="btn btn-primary" name="submit" value="submit" onclick="getSalesReport('reports/salesbyfacility.php')">Submit</button>
		</form>
	</div>
</div>

<div id="reportContainer">
	<?php include('sales-dashboard.php'); ?>
</div>
