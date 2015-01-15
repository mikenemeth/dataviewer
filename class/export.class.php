<?php 
class Export {
	
	var $inputArray;
	var $filename;

	public function __construct(array &$inputArray) {
		$this->inputArray = $inputArray;
	}
	
	private static function array2csv(array &$array) {
	   if (count($array) == 0) {
		 return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
		  fputcsv($df, $row);
	   }
	   fclose($df);
	   return ob_get_clean();
	}
	
	private static function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: 0");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");

		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header('Content-Transfer-Encoding: binary');
		header("Content-Type: application/download");

		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}

	public function export() {
		self::download_send_headers("data_export_" . date("d-m-Y") . ".csv");
		echo self::array2csv($this->inputArray);
		die();
	}
}
?>