<?php
require_once "../bootstrap.php";
require_once $ROOT_DIR . "/class/DisplayFunctions.class.php";
require_once $ROOT_DIR . "/class/Util.class.php";

class DisplayFunctionsTest extends PHPUnit_Framework_TestCase
{
	protected $_displayFunctions = null;
	private $strDirectory = "/x/playlists";
	private $fileList = array(
			'/x/playlists/a_perfect_circle-all.m3u',
    		'/x/playlists/a_perfect_circle-emotive.m3u',
    		'/x/playlists/a_perfect_circle-mer_de_noms.m3u',
    		'/x/playlists/a_perfect_circle-thirteenth_step.m3u'
	);
	
	private $mask = array(
	'.avi',
	'.mpg',
	'.mkv',
	'.mp4',
	'.mov',
	'.wmv',
	'.vob',
	'.aif',
	'.amr',
	'.mpeg',
	'.divx',
	'.gvi',
	'.dat',
	'.mpv',
	'.asf',
	'.wm',
	'.mp1',
	'.mp2',
	'.flv',
    '.m3u'
);
	
	public function setUp()
	{
		global $ROOT_DIR;
		$this->_displayFunctions = new DisplayFunctions();
	}
	
	public function tearDown()
	{
		unset($this->_displayFunctions);
	}
	
	public function testScanDirectories() {
		$response = $this->_displayFunctions->scanDirectories($this->strDirectory);
	}
	
	public function testGetFilename() {
		$this->assertEquals('a_perfect_circle-thirteenth_step.m3u', $this->_displayFunctions->get_filename('/x/playlists/a_perfect_circle-thirteenth_step.m3u'));
	}
	
	public function testShowBymask() {
		$this->assertEquals("<option value='/x/playlists/a_perfect_circle-thirteenth_step.m3u'> A Perfect Circle -  Thirteenth Step</option>\n",
				$this->_displayFunctions->show_by_mask('/x/playlists/a_perfect_circle-thirteenth_step.m3u',
						$this->mask));
	}
	
	public function testShowAllmasks() {
		$response = null;
		$response = $this->_displayFunctions->show_all_masks($this->fileList, $this->mask);
//		print_r( $response );
		
		$this->assertEquals("<option value='/x/playlists/a_perfect_circle-all.m3u'> A Perfect Circle -  All</option>\n<option value='/x/playlists/a_perfect_circle-emotive.m3u'> A Perfect Circle -  Emotive</option>\n<option value='/x/playlists/a_perfect_circle-mer_de_noms.m3u'> A Perfect Circle -  Mer De Noms</option>\n<option value='/x/playlists/a_perfect_circle-thirteenth_step.m3u'> A Perfect Circle -  Thirteenth Step</option>\n", 
				$this->_displayFunctions->show_all_masks($this->fileList,  $this->mask));
	}
	
	public function testFormatFilename() {
		$this->assertEquals(" A Perfect Circle -  Thirteenth Step",$this->_displayFunctions->formatFilename('a_perfect_circle-thirteenth_step.m3u'));
	}
	
	public function testBreakName() {
		$this->assertEquals(" A Perfect Circle-thirteenth Step.m3u", $this->_displayFunctions->breakName('a_perfect_circle-thirteenth_step.m3u'));
	}
	
	public function testMine() {
		$dirList=$this->_displayFunctions->scanDirectories($this->strDirectory);
		$mass=$this->_displayFunctions->show_all_masks($dirList, $this->mask);
		echo $mass;
	}

}