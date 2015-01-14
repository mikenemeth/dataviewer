 <?php
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/query.class.php');
require_once('class/display.class.php');

$db = new Database();
$query = new Query($db);

?>

    <div class="page-header">
		<h1>Welcome to the HUS Data Viewer</h1>
    </div>
    <div class="row">
		<div class='col-sm-6'>
			<h3>Overview</h3>
			<p>This system is intended to save you time in reporting and help find things that may need your attention. This reporting system allows you to view sales and inventory reports and help you analyze that information. Sales and inventory data is not live, but is exported nightly at 2:00am from Uniform Solutions.</p>
			<p>Built with: HTML5, CSS3, PHP, MYSQL</p>
		</div> <!-- col-sm-6 -->
		
		<div class='col-sm-6'>
			<h3>Using the Data Viewer</h3>
			<p>This system is intended to save you time in reporting and help find things that may need your attention. This reporting system allows you to view sales and inventory reports and help you analyze that information. Sales and inventory data is not live, but is exported nightly at 2:00am from Uniform Solutions.</p>
			<p>Built with: HTML5, CSS3, PHP, MYSQL</p>
		</div> <!-- col-sm-6 -->
	</div>
	
	<div class="row">
		<div class='col-sm-12'>
			<h3>Currently Available Reports</h3>
			<p>The following is a list of all currently available reports.</p>
			<ul>
				<li>Sales by Store: Displays sales information for all stores in a given date range</li>
				<li>Sales by Week: Displays sales by week for a given store and year</li>
				<li>Sales Discounts: Displays YTD, MTD, and last week's sales and discounts for all trucks</li>
				<li>Sales by Facility: Search for a facility by Name or Account Number to show all sales for that facility</li>
				<li>Truck Inventory Analysis: Generates an analysis of truck inventory levels by vendor</li>
				<li>Inventory by Store: Displays current inventory for a given store</li>
				<li>Print Top Analysis: Displays current inventory of print tops for all stores</li>
				<li>Shoe Analysis: Displays current inventory of shoes for all stores</li>
				<li>Purchases by Vendor: Displays customer buying patterns for a given vendor</li>
			</ul>
		</div> <!-- col-sm-12 -->
	</div>
	
		  