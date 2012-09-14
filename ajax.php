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
include_once("Util.php");
include_once("MplayerControl.php");
// read in from the url

// call the common.php with the parameters as command line arguments

class AjaxFunctions {
	function updateUI() {
		$strOut = "";
		switch(rand(1,10)) {
			case 1:
				$strOut = "Hello, world";
				break;
			case 2:
				$strOut = "Hi there";
				break;
			case 3:
				$strOut = "Hakuna";
				break;
			case 4:
				$strOut = "Matata";
				break;
			case 5:
				$strOut = "Five";
				break;
			case 6:
				$strOut = "Four";
				break;
			case 7:
				$strOut = "Three";
				break;
			case 8:
				$strOut = "Two";
				break;
			case 9:
				$strOut = "One";
				break;
			case 10:
				$strOut = "Blast off!";
				break;
		}
		echo $strOut;
	}
	
	function updatePlayer($action, $file) {
		//echo "Test2<br>";
		$mplayerControl = new MplayerControl(exec('pwd'), "/sh/tmp/mplayer.fifo");

		$mplayerControl->sendCommand($action, " ");
		
		//echo "Command successful";
		
	}

}

$commandLineArgs = Util::parseCommandLine($argv);
Util::logArray($commandLineArgs);
if(isset($commandLineArgs["method"])) {
	$ajaxFunctions = new AjaxFunctions();
	switch ($commandLineArgs["method"]) {
		case "updateUI":
			$ajaxFunctions->updateUI();
			break;
		case "updatePlayer":
			$ajaxFunctions->updatePlayer(urldecode($commandLineArgs["action"]), urldecode($commandLineArgs["file"]));
			break;
		default:
			break;
	}
	
} else {
	echo "Test5";
	//header('Location: /index.php');
}
?>
