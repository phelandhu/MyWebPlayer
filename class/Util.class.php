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
	
	static function logArray($arrIn) {
		ob_start(); //Start buffering
		print_r($arrIn); //print the result
		$output = ob_get_contents(); //get the result from buffer
		ob_end_clean();
		$result = file_put_contents ( "/tmp/log.txt", file_get_contents ( "/tmp/log.txt") . $output . "\n");
		return $result;
	}
	
	static function log($strIn) {
		$result = file_put_contents ( "/tmp/log.txt", file_get_contents ( "/tmp/log.txt") . $strIn . "\n");
		return $result;
	}
}