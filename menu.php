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
          <a class="navbar-brand" href="#" id="home" value="Home" onclick="reportLoad('reports/main.php')">HUS Report Viewer v.01</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
		
          <ul class="nav navbar-nav">
            <li><a href="#" id="home" value="Home" onclick="reportLoad('reports/main.php')">Home</a></li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sales<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
				<li><a href="#" id="discountReport" value="Sales Overview" onclick="reportLoad('reports/sales.php')">Overview</a></li>
				<li><a href="#" id="discountReport" value="Driver Discounts" onclick="reportLoad()">Driver Discounts</a></li>
                <li><a href="#">Sales by Division</a></li>
                <li><a href="#">Sales by Store</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Store Sales</li>
                <li><a href="#">Store 1</a></li>
                <li><a href="#">Store 8</a></li>
              </ul>
            </li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inventory<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#" id="inventoryReport" value="inventory.php" onclick="reportLoad('reports/inventory.php')">Inventory Analysis</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
			
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Behaviors<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Overview</a></li>
                <li><a href="#">Truck Customer Buying</a></li>
                <li><a href="#">B2B Buying</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
			
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>