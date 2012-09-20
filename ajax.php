<?php
/***********************************************
* Created:            Thu 06 Sep 2012 10:10:28 AM PDT 
* Last Modified:      Thu 06 Sep 2012 10:10:28 AM PDT
*
* The PHP page of the AJAX test/demonstration, the part the HTML page talks to to get/
* send information from/to the server
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
include_once("class/Util.class.php");
include_once("class/MplayerControl.class.php");
include_once("class/AjaxFunctions.class.php");
// read in from the url
$mplayerControl = new MplayerControl(exec('pwd'), "/sh/tmp/mplayer.fifo");

$commandLineArgs = Util::parseCommandLine($argv);
//Util::logArray($commandLineArgs);
if(isset($commandLineArgs["method"])) {
	$ajaxFunctions = new AjaxFunctions($mplayerControl);
	switch ($commandLineArgs["method"]) {
		case "updateUI":
			echo $ajaxFunctions->updateUI();
			break;
		case "updatePlayer":
			$action = $ajaxFunctions->convertCommand($commandLineArgs["action"]);
			$response = $ajaxFunctions->updatePlayer($action, urldecode($commandLineArgs["file"]));
			$result = substr($response, 0, 4);
			if($result == "done") {
				echo $result;
			} else if(substr($result, 0, 3) == "Err") {
				echo "An Error occured check the error log for the message";
				Util::log($response);
			}
			break;
		case "setVolume":
			$response = $ajaxFunctions->setVolume($commandLineArgs["volume"]);
			echo "Volume set to " . $commandLineArgs["volume"] . "%";
			break;
		case "getVolume":
			$response = $ajaxFunctions->getVolume();
			echo "Volume set to " . $commandLineArgs["volume"] . "%";
			break;			
		default:
			break;
	}
} else {
	echo "Test5";
	//header('Location: /index.php');
}
?>
