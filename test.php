#!/usr/bin/php
<?php
echo "hello world\n";
$commandLineArgs = parseCommandLine($argv);
// print_r($commandLineArgs);

$action=urldecode($commandLineArgs["action"]);
$file=urldecode($commandLineArgs["file"]);
/*
echo $action;
echo "\n";
echo $file;
echo "\n\n";
*/
echo formatFilename("soundtrack-swordfish.m3u") . "\n";
echo formatFilename("soundtrack-mortal_kombat.m3u") . "\n";
echo formatFilename("rush-hold_your_fire.m3u") . "\n";
echo formatFilename("metallica-kill'em_all.m3u") . "\n";
echo formatFilename("a_perfect_circle-mer_de_noms.m3u") . "\n";
echo formatFilename("cirque_du_soleil-alegría.m3u") . "\n";
echo formatFilename("craig_chaquico-acoustic_planet.m3u") . "\n";
echo formatFilename("danny_elfman-music_for_a_darkened_theatre-film_&_television_music-volume_two_(disc_1).m3u") . "\n";

function parseCommandLine($argv) {
	$args = array();
	foreach ($argv as $value) {
	    $arr = explode("=", $value);
	    if( count($arr) > 1 ) {
	    	$args[$arr[0]] = $arr[1];
	    }
	}
	return $args;
}


function formatFilename($filename) {
	$formattedFilename = null;
	$strTemp = explode(".", $filename);
	$arr = explode("-", $strTemp[0]);
	$band = breakName($arr[0]);
	$album = breakName($arr[1]);
	$formattedFilename = $band . " - " . $album;
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
?>
