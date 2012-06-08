<?

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
'panscan -0.1'
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
	echo "done $action $file";
		fclose($handle);
	} else {
		echo "ouch!!!11 I can not work anymore - did you execute \"./fifo.sh start\" in \"sh\" dir?";
	}

?>
