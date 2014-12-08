 <?php
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/query.class.php');
require_once('class/display.class.php');
?>


<?php
$database = new Database();
$query = new Query($database);

$year = 2014;
$storeArray = array(1,3,6,10,12,13,15,16,17);

$database->query(
	"SELECT YEAR(invoiceDate) as Year, SUM(retail) AS Retail, SUM(actual) AS Actual, SUM(Retail-Actual) AS Discount 
	FROM `sales` 
	WHERE YEAR(invoiceDate)=2012   
	AND storeID IN (1,3,6,10,12,13,15,16,17)"
	);

$record = $database->single();
$discountPercentage = number_format(($record{'Discount'}/$record{'Retail'}) * 100, 2);


$database->query(
	"SELECT storeID AS Store, SUM(retail) AS Retail, SUM(actual) AS Actual, SUM(Retail-Actual) AS Discount 
	FROM `sales` 
	WHERE YEAR(invoiceDate)=2012   
	AND storeID IN (1,3,6,10,12,13,15,16,17) 
	GROUP BY storeID"
	);
	
$allStoreRows = $database->resultSet();


?>

      <div class="page-header">
        <h1><?php echo "Total Driver Discounts " . " - " . $record{'Year'}; ?></h1>
      </div>
      <div class="row">
		<div class='col-sm-3'>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Retail</h3>
            </div>
            <div class="panel-body">
              <h4>$<?php echo number_format($record{'Retail'},2); ?></h4>
            </div>
          </div>
		 </div> <!-- col-sm-3 -->
		  
		<div class='col-sm-3'>
			<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Actual</h3>
            </div>
            <div class="panel-body">
              <h4>$<?php echo number_format($record{'Actual'},2); ?></h4>
            </div>
          </div>
		 </div> <!-- col-sm-3 -->
		  
		<div class='col-sm-3'> 
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Total Discount Amount</h3>
            </div>
            <div class="panel-body">
              <h4>$<?php echo number_format($record{'Discount'},2); ?></h4>
            </div>
          </div>
		 </div> <!-- col-sm-3 -->
		 
		<div class='col-sm-3'> 
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Total Discount Percentage</h3>
            </div>
            <div class="panel-body">
              <h4>%<?php echo $discountPercentage ?></h4>
            </div>
          </div>
		 </div> <!-- col-sm-3 -->
      </div>
	  
	  <div class='row'>
		<div class='col-sm-3'>
			<?php
				$row = $query->get_total_sales_single_year($year, $storeArray);
				echo '<h4>' . Display::displayPanel('Total Sales', $row) . '</h4>';
			?>
		</div>	
	  </div>


      <div class="page-header">
        <h1>Discounts by Driver</h1>
      </div>
      <div class="row">
	  
        <div class="col-md-6">
			<?php
				  
			echo "<table class='table table-striped'>
						<thead>
						<tr>
						<th>Store</th>
						<th>Retail</th>
						<th>Actual</th>
						<th>Discounts</th>
						</tr>
						</thead>";

			foreach ($allStoreRows as $row) {
				echo "<tr>";
				foreach ($row as $field=>$value) {
					echo "<td>" . $value . "</td>";
				}
				echo "</tr>";
			}

				echo "</table>";

			?>
		</div>
      </div>
