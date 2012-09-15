<?php
//require_once 'PHPUnit/Framework.php';
require_once 'Util.class.php';

class UtilTest extends PHPUnit_Framework_TestCase
{
	protected $_fleet = null;
	
	public function setUp()
	{
		//$this->_fleet = new My_Fleet;
	}
	
	public function tearDown()
	{
		//unset($this->_fleet);
	}
	
	public function testShouldReturnFive() {
		$this->assertEquals(5, Util::log("12345"));
	}
	
	public function testCommandLineArgs() {
		
	}
/*	
	public function testShouldNotHaveAnyShipsYetInIntitialState()
	{

		//$this->_fleet->count() is boring; let's implement SPL's Countable interface
		 
		$this->assertEquals(0, count($this->_fleet));
	}
	
	public function testAddingAShipWillIncrementCountByOne()
	{
		$this->_fleet->addShip('USS Enterprise');
		$this->assertEquals(1, count($this->_fleet));
	}
	
	public function testAfterAddingAShipWeCanRetrieveItsNameByIndex()
	{
		$this->_fleet->addShip('USS Enterprise');
		$this->assertEquals('USS Enterprise', $this->_fleet->getShip( count($this->_fleet) - 1 ));
	}
*/
}