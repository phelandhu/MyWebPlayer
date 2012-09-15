<?php
/***********************************************
 * Created:            Thu 06 Sep 2012 10:10:28 AM PDT
* Last Modified:      Thu 06 Sep 2012 10:10:28 AM PDT
*
* [Write something intelligent here]
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
include_once("Util.class.php");
include_once("MplayerControl.class.php");
/*
Util::logArray($argv);
*/

$mplayerControl = new MplayerControl(exec('pwd'), "/sh/tmp/mplayer.fifo");
$commandLineArgs = Util::parseCommandLine($argv);
//Util::logArray($commandLineArgs);
$action=urldecode($commandLineArgs["action"]);
$file=urldecode($commandLineArgs["file"]);
$mplayerControl->sendCommand($action, $file);
?>