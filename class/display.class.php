<?php
class Display {
	
	public static function displayTable($headings, $rows) {
		echo "<table class='table table-striped'><thead><tr>";
		
		foreach($headings as $heading) {
			echo "<th>" . $heading . "</th>";
		}
		echo	"</tr></thead>";

		foreach ($rows as $row) {
			echo '<tr>';
			foreach ($row as $field=>$value) {
				echo '<td>' . $value . '</td>';
			}
			echo '</tr>';
		}

		echo '</table>';
	}
	
	public static function displayPanel($heading, $row) {
		echo '<div class="panel panel-primary">';
		echo '<div class="panel-heading"><h3 class="panel-title">' . $heading . '</h3></div>';
		echo '<div class="panel-body">';
		foreach($row as $record) {
				echo $record;
		}
		echo '</div>';
		echo '</div>';
	}
}
?>