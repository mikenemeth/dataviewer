 <?php
require_once('../config/config.php');
require_once('../class/database.class.php');
require_once('../class/dataupload.class.php');
require_once('../class/display.class.php');
require_once('../class/query.class.php');

$database = new Database();
$query = new Query($database);

$dates = array('14-09-01', '14-12-01');
$vendors = array("'CHE'", "'KOI'", "'WKS'");
$trucks = array(1,2,3,7,6,10,12,13,15,16,17);
$ues = array(8);
?>
