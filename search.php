<?php 
require_once('config/config.php');
require_once('class/database.class.php');
require_once('class/query.class.php');
require_once('class/display.class.php');

$db = new Database();

$q = $_POST['keyword'];

$db->query(
	"SELECT name, accountNum 
	FROM company 
	WHERE name LIKE '%" . $q . "%' OR accountNum LIKE '%" . $q . "%' 
	ORDER BY name 
	LIMIT 0, 10"
);
$db->execute();
$results = $db->resultSet();

foreach($results as $result) {
		echo '<li class="list-group-item ac-result-list" onclick="set_item(\''.str_replace("'", "\'", $result['name']).'\')"><span class="badge">' . $result['accountNum'] . '</span>' .  $result['name'] . '</li>';

}
?>

