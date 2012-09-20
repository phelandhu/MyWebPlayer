<?php
class AjaxFunctions {

	private $nonConverted = array(
			'loadfile',
			'loadlist',
			'pause',
			'quit'
	);
	
	private $_mplayerControl = null;
	
	public function __construct($mplayerControl) {
		$this->_mplayerControl = $mplayerControl;
	}

	function updateUI() {
		return $this->_mplayerControl->queryPlayer();
	}

	function updatePlayer($action, $file) {
		$result = $this->_mplayerControl->sendCommand($action, $file);
		return $result;
	}

	function getVolume() {
//		$result = $this->_mplayerControl->getVolume();
$result = 50;
		return $result;
	}
	
	function setVolume($volume) {
		$result = $this->_mplayerControl->setVolume($volume);
		return $result;
	}

	function convertCommand($pageCommand) {
		$mplayerCommand = "";
		if(in_array($pageCommand, $this->nonConverted)) {
			return $pageCommand;
		}
		if(isset($pageCommand)) {
			if($pageCommand == "pt_step-1") {
				$mplayerCommand = "pt_step -1";
			} else if ($pageCommand == "pt_step+1") {
				$mplayerCommand = "pt_step +1";
			} else if ($pageCommand == "seek-15") {
				$mplayerCommand = "seek -15";
			} else if ($pageCommand == "seek+15") {
				$mplayerCommand = "seek +15";
			} else if ($pageCommand == "volume-1") {
				$mplayerCommand = "volume -1";
			} else if ($pageCommand == "volume+1") {
				$mplayerCommand = "volume +1";
			} else if ($pageCommand == "mute1") {
				$mplayerCommand = "mute 1";
			} else if ($pageCommand == "mute0") {
				$mplayerCommand = "mute 0";
			}
		} else {
			$mplayerCommand = "";
		}
		return $mplayerCommand;
	}
}
?>