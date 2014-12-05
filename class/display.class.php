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
}
?>