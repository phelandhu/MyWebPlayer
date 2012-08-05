<?php
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
/*
	ob_start(); //Start buffering
	print_r($argv); //print the result
	$output = ob_get_contents(); //get the result from buffer
	ob_end_clean();

	ob_start(); //Start buffering
	print_r($_GET); //print the result
	$get_output = ob_get_contents(); //get the result from buffer
	ob_end_clean();

	
file_put_contents ( "/tmp/logInputGet.txt", file_get_contents ( "/tmp/logInputGet.txt") . $output . "\n" . $get_output . "random test");
*/

if(isset($_GET)&&!isset($argv)) {
	$argv = $_GET;
}
/*
	ob_start(); //Start buffering
	print_r($argv); //print the result
	$output = ob_get_contents(); //get the result from buffer
	ob_end_clean();
file_put_contents ( "/tmp/logInputArg.txt", file_get_contents ( "/tmp/logInputArg.txt") . $output . "\nrandom test\n");
*/	
$myfiles=exec('pwd');
$commandLineArgs = parseCommandLine($argv);
	ob_start(); //Start buffering
	print_r($commandLineArgs); //print the result
	$output = ob_get_contents(); //get the result from buffer
	ob_end_clean();
	file_put_contents ( "/tmp/log.txt", file_get_contents ( "/tmp/log.txt") . $output . "\nrandom test\n");
$action=urldecode($commandLineArgs["action"]);
$file=urldecode($commandLineArgs["file"]);

$fifo = "$myfiles/sh/tmp/mplayer.fifo";
echo $fifo . "\n";

if ($action == '') {
	$action=$_GET['action'];
	$file=$_GET['file'];
}

$access=0;
$allowed_commands = array(
	'seek -15',
	'loadfile',
	'loadlist',
	'seek +15',
	'pause',
	'quit',
	'volume -1',
	'mute 1',
	'mute 0',
	'volume +1',
	'vo_fullscreen 1',
	'vo_fullscreen 0',
	'panscan +0.1',
	'panscan -0.1',
	'pt_step +1',
	'pt_step -1'
);

foreach($allowed_commands as $value) {
	if ($action == $value) {
		$access = '1';
	}
}

if ($access == '0') {
	echo $action;
	echo 'Access Denied';
	exit;
}

if (is_writable($fifo)) {
	if (!$handle = fopen($fifo, 'a')) {
		echo "can not open $fifo";
		exit;
	}
	$tmp="$action \"$file\"\n";

	if (fwrite($handle, $tmp) === FALSE) {
		echo "can not write to $fifo, check permissions";
		echo false;
		exit;
	}
	echo "done $action $file\n";
	fclose($handle);
} else {
	echo "ouch!!!11 I can not work anymore - did you execute \"./fifo.sh start\" in \"sh\" dir?";
}

?>
