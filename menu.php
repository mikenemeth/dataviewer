    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" id="home" value="Home" onclick="reportLoad('reports/main.php')">HUS Data Viewer v.01</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
		
          <ul class="nav navbar-nav">
            <li><a href="#" id="home" value="Home" onclick="reportLoad('reports/main.php')">Home</a></li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sales<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li><a href="#" id="discountReport" value="Sales Overview" onclick="reportLoad('reports/sales.php')">Sales Summary</a></li>
				<li><a href="#" id="discountReport" value="Sales Overview" onclick="reportLoad('reports/discounts.php')">Sales Discounts</a></li>
              </ul>
            </li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inventory<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#" id="inventoryReport" value="inventory.php" onclick="reportLoad('reports/inventory.php')">Inventory by Store</a></li>
                <li><a href="#" id="printTopReport" value="Print Top Analysis" onclick="reportLoad('reports/printtops.php')">Print Top Analysis</a></li>
                <li><a href="#" id="shoeReport" value="Shoe Analysis" onclick="reportLoad('reports/shoes.php')">Shoe Analysis</a></li>
                <li><a href="#" id="shoeReport" value="Shoe Analysis" onclick="reportLoad('reports/shoes.php')">Vendor Inventory Analysis</a></li>
              </ul>
            </li>
			
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>