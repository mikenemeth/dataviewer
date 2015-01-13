<?php 
class Utility {
	
	public static function thisWeek(){	
		$startWeek = strtotime("monday this week");
		$today = strtotime("today");

		$startWeek = date("Y-m-d",$startWeek);
		$today = date("Y-m-d", $today);

		return array($startWeek, $today);	
	}
	
	public static function lastWeek(){
		$previousWeek = strtotime("-1 week +1 day");

		$startWeek = strtotime("last monday midnight",$previousWeek);
		$endWeek = strtotime("next sunday",$startWeek);

		$startWeek = date("Y-m-d",$startWeek);
		$endWeek = date("Y-m-d",$endWeek);

		return array($startWeek, $endWeek);
	}
	
	public static function thisYear(){
		return date("Y");
	}

	public static function lastYear(){
		return date("Y", strtotime("-1 year"));
	}
	
	public static function thisMonth(){
		return date("m");
	}
	
	public static function lastMonth(){
		return date("m", strtotime("-1 month"));
	}
	
	public static function convertShortDateToMysqlDate($shortDate) {

		$dateTemp = date_create_from_format('m/d/Y', $shortDate);
		$mysqlDate = date_format($dateTemp, 'y-m-d');		
		return $mysqlDate;
	}

	public static function convertMysqlDateToShortDate($mysqlDate) {

		$dateTemp = date_create_from_format('y-m-d', $mysqlDate);
		$shortDate = date_format($dateTemp, 'm/d/Y');	
		return $shortDate;
	}
	
	public static function convertMysqlDateToHtmlDate($mysqlDate) {

		$dateTemp = date_create_from_format('y-m-d', $mysqlDate);
		$htmlDate = date_format($dateTemp, 'Y-m-d');	
		return $htmlDate;
	}
	
	public static function convertHtmlDateToShortDate($htmlDate) {

		$dateTemp = date_create_from_format('Y-m-d', $htmlDate);
		$shortDate = date_format($dateTemp, 'm/d/Y');	
		return $shortDate;
	}

	public static function convertHtmlDateToMysqlDate($htmlDate) {

		$dateTemp = date_create_from_format('Y-m-d', $htmlDate);
		$mysqlDate = date_format($dateTemp, 'y-m-d');	
		return $mysqlDate;
	}
}
?>