<?php
require_once "../bootstrap.php";
require_once $ROOT_DIR . "/class/MplayerControl.class.php";
require_once $ROOT_DIR . "/class/Util.class.php";

class MplayerControlTest extends PHPUnit_Framework_TestCase
{
	protected $_mplayerControl = null;
	private $action = "loadlist";
	private $file = "/x/playlists/a_perfect_circle-mer_de_noms.m3u";

	public function setUp()
	{
		global $ROOT_DIR;
		$this->_mplayerControl = new MplayerControl($ROOT_DIR, "/sh/tmp/mplayer.fifo");//"/home/mbrowne/myWebPlayer"
	}

	public function tearDown()
	{
		unset($this->_mplayerControl);
	}
/*
	public function testSendCommand() {
		echo $this->_mplayerControl->sendCommand($this->action, $this->file);
	}
*/	
	public function testSendCommandToPlayer() {
		$this->action = "volume +1";
		$command = $this->action . " \"" . $this->file . "\"\n";
		$command = "quit\n";
		echo $this->_mplayerControl->sendCommandToPlayer($command);
		echo $this->_mplayerControl->sendCommandToPlayer($command);
		echo $this->_mplayerControl->sendCommandToPlayer($command);
		echo $this->_mplayerControl->sendCommandToPlayer($command);
		echo $this->_mplayerControl->sendCommandToPlayer($command);
		echo $this->_mplayerControl->sendCommandToPlayer($command);
		echo $this->_mplayerControl->sendCommandToPlayer($command);
	}
	
	public function testQueryPlayer() {
		echo $this->_mplayerControl->queryPlayer();
	}
	

}