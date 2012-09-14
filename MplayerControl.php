<?
/***********************************************
 * Created:            Thu 06 Sep 2012 10:10:28 AM PDT
* Last Modified:      Thu 06 Sep 2012 10:10:28 AM PDT
*
* [Write something intelligent here]
*
* Mike Browne - phelandhu@gmail.com
***********************************************/
class MplayerControl{
	private $fifoFile;
	
	public function __construct($myFiles, $fifoFile) {
		$this->fifoFile = $myFiles . $fifoFile;
	}
	
	public function sendCommand($action, $file) {
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
		
		if (is_writable($this->fifoFile)) {
			if (!$handle = fopen($this->fifoFile, 'a')) {
				echo "can not open $this->fifoFile";
				exit;
			}
			$tmp="$action \"$file\"\n";
		
			if (fwrite($handle, $tmp) === FALSE) {
				echo "can not write to $this->fifoFile, check permissions";
				echo false;
				exit;
			}
			echo "done $action $file\n";
			fclose($handle);
		} else {
			echo "ouch!!!11 I can not work anymore - did you execute \"./fifo.sh start\" in \"sh\" dir?";
		}
	}
	
}
?>