<?php
class Util {
	static function parseCommandLine($argv) {
		$args = array();
		foreach ($argv as $value) {
			$arr = explode("=", $value);
			if( count($arr) > 1 ) {
				$args[$arr[0]] = $arr[1];
			}
		}
		return $args;
	}
	
	static function logArray($arrIn, $filePath = "/tmp/log.txt") {
		ob_start(); //Start buffering
		print_r($arrIn); //print the result
		$output = ob_get_contents(); //get the result from buffer
		ob_end_clean();
		$result = file_put_contents ( $filePath, file_get_contents ( $filePath) . $output . "\n");
		return $result;
	}
	
	static function log($strIn, $filePath = "/tmp/log.txt") {
		$result = file_put_contents ( $filePath, file_get_contents ( $filePath) . $strIn . "\n");
		return $result;
	}
}
