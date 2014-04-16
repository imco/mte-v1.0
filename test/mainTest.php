<?php
require_once("test.default.php");

class mainTest extends defaultTest{

	public function setUp(){
		parent::setUp();
		$this->controler = $this->require_contoler("main");
	}

	/*public function testMongo_connect(){
		$mongo = $this->controler->mongo_connect();
		$this->AssertTrue($mongo->connect());
	
	}
	
	public function testShorten_url(){	
		$this->AssertEquals($this->controler->shorten_url('www.google.com'),"http://ow.ly/3jhmUU");	
	
	}
	*/

	public function testCapitalize(){
		$this->AssertEquals($this->controler->capitalize("test"),"Test");
	}
}
?>
