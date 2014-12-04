<?php
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/dataupload.class.php');

$database = new Database();

$database->query(
	"SELECT description, COUNT(id) AS Variations 
	FROM items 
	GROUP BY description");

$rows = $database->resultSet();

echo "<table border='1'>
			<tr>
			<th>Product Desc</th>
			<th>Variations</th>
			</tr>";

foreach ($rows as $row) {
	echo "<tr>";
	foreach ($row as $field=>$value) {
		echo "<td>" . $value . "</td>";
	}
	echo "</tr>";
}

	echo "</table>";

echo "Rows returned: " . $database->rowCount();

//$inputFile = 'data/Sales Detail by Transaction 11-07-14 to 11-14-14.csv';

//$salesUpload = new DataUpload($inputFile);

?>