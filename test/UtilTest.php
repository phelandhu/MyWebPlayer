<?php
require_once "../bootstrap.php";
require_once $ROOT_DIR . "/class/Util.class.php";

class UtilTest extends PHPUnit_Framework_TestCase
{
	protected $_fleet = null;
	private $filePath = "/tmp/UnitLog.txt";
	
	public function setUp()
	{
		//$this->_fleet = new My_Fleet;
		shell_exec("cat /dev/null > " . $this->filePath . "\n");
	}
	
	public function tearDown()
	{
		//unset($this->_fleet);
	}

	
	public function testCommandLineArgs() {
		$argv = array("action=test","file=mine"); //
		$argvResult = array("action" => "test", "file" => "mine");
		$this->assertEquals($argvResult, Util::parseCommandLine($argv));
	}

	public function testLogArray() {
		$arrData = array("First" => "1", "Second" => "2");
		$this->assertEquals(46, Util::logArray($arrData, $this->filePath));
	}

	
	public function testLog() {
		$this->assertEquals(6, Util::log("12345", $this->filePath));
	}
}
