<?php

require_once('class/utility.class.php');

echo "<p>" . Utility::thisYear() . "</p>";

echo "<p>" . Utility::lastYear() . "</p>";

echo "<p>" . Utility::thisMonth() . "</p>";

echo "<p>" . Utility::lastMonth() . "</p>";

var_dump(Utility::lastWeek());

var_dump(Utility::thisWeek());

echo "<p>" . Utility::convertShortDateToMysqlDate('12/19/2014')  . "</p>";

echo "<p>" . Utility::convertMysqlDateToShortDate('14-11-17') . "</p>";

?>