<?
/***********************************************
* Created:            Thu 06 Sep 2012 10:10:28 AM PDT
* Last Modified:      Thu 06 Sep 2012 10:10:28 AM PDT
*
* The class to control the mplayer via the web browser
*
* Mike Browne - phelandhu@gmail.com
* Stolen from some serious heavy lifting by ---X
***********************************************/
class MplayerControl{
	private $fifoFile;
	private $allowedCommands = array(
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
	
	public function __construct($myFiles, $fifoFile) {
		$this->fifoFile = $myFiles . $fifoFile;
	}
	
	public function sendCommandToPlayer($command) {
		
		$result = null;
		
		if (is_writable($this->fifoFile)) {
			if (!$handle = fopen($this->fifoFile, 'a')) {
				$result = "Err2: can not open " . $this->fifoFile;
				return $result;
				exit;
			}
			
			if (fwrite($handle, $command) === FALSE) {
				$result = "Err3: can not write to " . $this->fifoFile . ", check permissions" . false;
				return $result;
				exit;
			}
			$result = "done " . $command . "\n";
			fclose($handle);
		} else {
			$result = "Err4: ouch!!!11 I can not work anymore - did you execute \"./fifo.sh start\" in \"sh\" dir?";
		}
		return $result;		
	}
	
	public function sendCommand($action, $file) {
		$response = null;
		$access = in_array($action, $this->allowedCommands);
		if (!$access) {
			$result = "Err1: Access Denied " . $action . "\n";
			return $result;
			exit;
		}
		$command=$action . " \"" . $file . "\"\n";
		$response = $this->sendCommandToPlayer($command);
		return $response;
	}

	public function getVolume() {
		$response = null;
		$response = 50;
		return $response;
	}
	
	public function setVolume($volume) {
		$response = null;
		//"volume " . $volume . ", 1", " \n"
//		$command = $this->action . " \"" . $this->file . "\"\n";
		$command="volume " . $volume . ", 1 \" \"\n";
		$response = $this->sendCommandToPlayer($command);
		return $response;
	}
	
	public function queryPlayer() {
		$strOut = null;
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

		return $strOut;
	}
}
?>