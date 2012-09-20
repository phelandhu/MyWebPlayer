<?php
class DisplayFunctions {

	function scanDirectories($rootDir, $allData=array()) {
		$alldata = null;
		$invisibleFileNames = array(".", "..");
		$dirContent = scandir($rootDir);
		foreach($dirContent as $key => $content) {
			$path = $rootDir . "/" . $content;
			if(!in_array($content, $invisibleFileNames)) {
				if(is_file($path) && is_readable($path)) {
					$allData[] = $path;
				} elseif(is_dir($path) && is_readable($path)) {
					$allData = $this->scanDirectories($path, $allData);
				}
			}
		}
		return $allData;
	}
	
	function get_filename($str) {
		$strResult = null;
		$strResult=substr(strrchr($str, "/"), 1);
		return $strResult;
	}
	
	function show_by_mask($mass, $mask=array()) {
		$strResult = null;
		foreach($mask as $content){
			$clen = strlen($content);
			$poz = stripos($mass, $content);
			$fpoz = $clen + $poz;
			if(strlen($mass)<= $clen + $poz) {
				$filename = $this->get_filename($mass);
				$strResult .= "<option value='" . $mass . "'>" . $this->formatFilename($filename) . "</option>\n";
			}
		}
		return $strResult;
	}
	
	function show_all_masks($mass=array(), $mask=array()) {
		$strResult = null;
		foreach($mass as $content){
			$strResult .= $this->show_by_mask($content, $mask);
		}
		return $strResult;
	}

	function formatFilename($filename) {
		$formattedFilename = null;
		$strTemp = explode(".", $filename);
		$arr = explode("-", $strTemp[0]);
		$band = $this->breakName($arr[0]);
		if(count($arr) > 1) {
			$album = $this->breakName($arr[1]);
			$formattedFilename = $band . " - " . $album;
		} else {
			$formattedFilename = $band;
		}
		return $formattedFilename;
	}
	
	function breakName($name) {
		$strReturn = null;
		$arrName = explode("_", $name);
		foreach($arrName as $value){
			$strReturn = $strReturn . " " . ucfirst($value);
		}
		return $strReturn;
	}

}