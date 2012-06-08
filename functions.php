<?php
function scanDirectories($rootDir, $allData=array()) {
	$invisibleFileNames = array(".", "..");
	$dirContent = scandir($rootDir);
	foreach($dirContent as $key => $content) {
		$path = $rootDir . "/" . $content;
		if(!in_array($content, $invisibleFileNames)) {
			if(is_file($path) && is_readable($path)) {
				$allData[] = $path;
			} elseif(is_dir($path) && is_readable($path)) {
				$allData = scanDirectories($path, $allData);
			}
		}
	}
	return $allData;
}


function get_filename($str) {
	$str=substr(strrchr($str, "/"), 1);
	return $str;
}

function show_by_mask($mass, $mask=array()){
	foreach($mask as $content){
		$clen=strlen($content);
		$poz=stripos($mass, $content);
		$fpoz=$clen+$poz;
		if(strlen($mass)<=$clen+$poz) {
			$filename = get_filename($mass);
			echo "<option value='".$mass."'>" . formatFilename($filename) . "</option>\n";
		}
	}
	return;
}

function formatFilename($filename) {
	$formattedFilename = null;
	$strTemp = explode(".", $filename);
	$arr = explode("-", $strTemp[0]);
	$band = breakName($arr[0]);
	if(count($arr) > 1) {
		$album = breakName($arr[1]);
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

function show_all_masks($mass=array(), $mask=array()) {
	foreach($mass as $content){
		$mass=show_by_mask($content, $mask);
	}
	return $mass;
}
