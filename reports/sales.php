 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/query.class.php');
require_once('../class/display.class.php');
?>

<script>
	$(document).ready(function() {
	
	$('button').click(function() {
		jQuery.ajax({
			type: 'GET', 
			data: {keyname:$('#StoreSelector option:selected').val()}, 
			success: function(data) {
				alert('success');
			}
		});
	});
});	
</script>

    <div class="page-header">
        <h1>Sales Overview</h1>
    </div>
<div id="controls">	  
	<div class="row">
		<form role="form" action="" method="get">	
			<div class="col-md-4">
				<fieldset>
					<div class="form-group">
					<label for="dateRange">Select Date Range</label>
					<div id="dateRange" class="btn-group" role="group">
						<button type="button" class="btn btn-default" onclick="">YTD</button>
						<button type="button" class="btn btn-default" onclick="">MTD</button>
						<button type="button" class="btn btn-default" onclick="">WTD</button>
					</div>
					</div>
				</fieldset>
				</div>

			<div class="col-md-8">
				<fieldset>
					<div class="form-group">
					<label for="stores">Select Stores</label>
					<div id="dateRange" class="btn-group" role="group">
						<button type="button" class="btn btn-default" onclick="">1</button>
						<button type="button" class="btn btn-default" onclick="">3</button>
						<button type="button" class="btn btn-default" onclick="">6</button>
						<button type="button" class="btn btn-default" onclick="">10</button>
						<button type="button" class="btn btn-default" onclick="">12</button>
						<button type="button" class="btn btn-default" onclick="">13</button>
						<button type="button" class="btn btn-default" onclick="">15</button>
						<button type="button" class="btn btn-default" onclick="">16</button>
						<button type="button" class="btn btn-default" onclick="">17</button>
						<button type="button" class="btn btn-default" onclick="reportGet('reports/salesoverview.php')">All Trucks</button>
					</div>
					</div>
				</fieldset>
				</div>
				
		</form>
	</div>
</div>

<div id="reportContainer">
	<p>Default Content.</p>
</div>