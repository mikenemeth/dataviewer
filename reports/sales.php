 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
require_once('../class/utility.class.php');

$database = new Database();
$query = new Query($database);

$date = $query->get_last_sale_date(); 

foreach($date as $day) {
	$maxDate =  Utility::convertMysqlDateToHtmlDate($day);
}
?>
    <div class="page-header">
        <h1>All Sales by Store</h1>
    </div>
<div id="controls">
	<div class="row"><p class="col-md-12">Enter a Start Date and End Date to see all sales totals for all stores.</p></div>
	<div class="row">
		<form id="salesReportControl" role="form" action="" method="post">	
			<div class="col-md-3">
				<fieldset>
					<div class="form-group">
						<div id="startDate" class="input-group">
							<label class="sr-only" for="startdate">Start Date</label>
							<div class="input-group-addon">Start Date</div>
							<input type="date" name="startDate" class="form-control" id="startDate"  min="2008-01-01" placeholder="ex. 12/01/2014" required>
						</div>
					</div>
				</fieldset>
			</div>

			<div class="col-md-3">
				<fieldset>
					<div class="form-group">
						<div id="endDate" class="input-group">
							<label class="sr-only" for="enddate">End Date</label>
							<div class="input-group-addon">End Date</div>
							<input type="date" name="endDate" class="form-control" id="startDate" max="<?php echo $maxDate; ?>" placeholder="ex. 12/07/2014" required>
						</div>
					</div>
				</fieldset>
			</div>				
				
			<button type="button" id="submit_btn" class="btn btn-primary" name="submit" value="submit" onclick="getSalesReport('reports/salesbystore.php')">Submit</button>
		</form>
	</div>
</div>

<div id="reportContainer">
	<?php include('sales-dashboard.php'); ?>
</div>
