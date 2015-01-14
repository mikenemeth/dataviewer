 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>
<style>
#result {
	display: none;
}</style>

    <div class="page-header">
        <h1>Sales by Facility</h1>
    </div>
<div id="controls">
	<div class="row"><p class="col-md-12">Search for a facility by typing a name or account number, click a suggestion, then click Submit.</p></div>
	<div class="row">
		<form id="salesReportControl" role="form" action="" method="post">
			<div class="col-md-4">
				<fieldset>
					<div class="form-group">
					<div id="facilitySelect" class="input-group">
						<input type="text" class="search" id="searchid" name="facilitySelect" placeholder="Enter facility name or account number..." onkeyup="autocomplet()"/>Ex. "Ely Manor" or "23676-12"<br />
					</div>
					</div>
				</fieldset>
			</div>
			
			<button type="button" id="submit_btn" class="btn btn-primary" name="submit" value="submit" onclick="getSalesReport('reports/salesbyfacility.php')">Submit</button>
		</form>
	</div>
	<div class="row">
		<ul id="result"></ul>
	</div>
</div>

<div id="reportContainer">
	<?php include('sales-dashboard.php'); ?>
</div>
