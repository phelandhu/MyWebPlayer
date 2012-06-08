<?php
if(isset($argv)) {
	ob_start(); //Start buffering
	print_r($argv); //print the result
	$output = ob_get_contents(); //get the result from buffer
	ob_end_clean();
}
if(isset($_GET)) {
	ob_start(); //Start buffering
	print_r($_GET); //print the result
	$get_output = ob_get_contents(); //get the result from buffer
	ob_end_clean();
}
file_put_contents ( "/tmp/log.txt", file_get_contents ( "/tmp/log.txt") . $output . "\n" . $get_output);

$myfiles=exec('pwd');

$action=$argv[1];
$action=explode("=", $action);
if ($action[0] == 'file') {
	$action=$argv[2];
	$action=explode("=", $action);
}
$action=$action[1];
$action=urldecode($action);

$file=$argv[2];
$file=explode("=", $file);
if ($file[0] == 'action') {
	$file=$argv[1];
	$file=explode("=", $file);
}
$file=$file[1];
$file=urldecode($file);
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
	'pt_step -1', 
	'seek_chapter +1',
	'seek_chapter -1'
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
	echo $tmp;
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
