<?php 
/**************************************
MENU

Use: To add new items to the menu, add the desired
menu, submenu items, and pages to the array below.

Example:  If you would like to add a "Customer" category 
with a new type of report called "MyReport", the following 
would be added after the "Inventory" array:

	'Customer'	=>	array(
								'My Report'	=>	'reports/myreport.php',
							),

**************************************/
$menu = array(
	'Sales'	=>	array(
							'Sales by Store'	=>	'reports/sales.php', 
							'Sales by Week'	=>	'reports/salesdatabystore-control.php', 
							'Sales Discounts'	=>	'reports/discounts.php', 
							'Sales by Facility'	=>	'reports/salesbyfacility-control.php'
						),
	'Inventory'	=>	array(
								'Truck Inventory Analysis'	=>	'reports/inventoryreport-control.php', 
								'Inventory by Store'			=>	'reports/inventorybystore-control.php', 
								'Print Top Analysis'			=>	'reports/printtops.php', 
								'Shoe Analysis'					=>	'reports/shoes.php'
							),
);

?>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#" id="home" value="Home" onclick="reportLoad('main.php')">HUS Data Viewer v.01</a>
		</div>
		
		<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
			
			<ul class="nav navbar-nav">
				<li><a href="#" id="home" value="Home" onclick="reportLoad('main.php')">Home</a></li>
				
				<?php 
					foreach($menu as $cat=>$subcat) {
						echo '<li class="dropdown">';
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $cat . '<span class="caret"></span></a>';
						echo '<ul class="dropdown-menu" role="menu">';
						
						foreach($subcat as $page=>$url) {
							echo '<li><a href="#" onclick="reportLoad(\'' . $url . '\')">' . $page . '</a></li>';
						}
						
						echo '</ul>';
						echo "</li>";
					}		
				?>
			
			</ul>
			
			<ul class="nav navbar-nav navbar-right warning">
				<li>
					<button type="button" class="btn navbar-btn btn-warning">
						<a href="#" id="admin" value="Admin" onclick="reportLoad('admin/updater.php')">Admin</a>
					</button>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
		
	</div>
</nav>