<?php
require_once "../bootstrap.php";
require_once $ROOT_DIR . "/class/MplayerControl.class.php";
require_once $ROOT_DIR . "/class/AjaxFunctions.class.php";
require_once $ROOT_DIR . "/class/Util.class.php";

class AjaxFunctionsTest extends PHPUnit_Framework_TestCase
{
	private $_mplayerControl = null;
	private $_ajaxFunctions = null;

	public function setUp()
	{
		global $ROOT_DIR;
		$this->_mplayerControl = new MplayerControl($ROOT_DIR, "/sh/tmp/mplayer.fifo");//"/home/mbrowne/myWebPlayer"
		$this->_ajaxFunctions = new AjaxFunctions($this->_mplayerControl);
	}

	public function tearDown()
	{
		unset($this->_mplayerControl);
	}

	public function testUpdateUI() {
		echo $this->_ajaxFunctions->updateUI();
	}

	public function testUpdatePlayer() {
		$action = "loadlist";
		$file = "/x/playlists/a_perfect_circle-mer_de_noms.m3u";
		//		$this->_ajaxFunctions->updatePlayer($action, $file);
	}
	
	public function testGetVolume() {
		$this->assertEquals(50, $this->_ajaxFunctions->getVolume());
	}

	public function testSetVolume() {
		echo $this->_ajaxFunctions->setVolume(50);
	}
/*	
	public function testConvertCommand() {
		$this->assertEquals("pt_step -1", $this->_ajaxFunctions->convertCommand("pt_step-1"));
	}
*/
}