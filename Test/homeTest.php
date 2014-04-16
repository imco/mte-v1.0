<?php
require_once("test.default.php");

class homeTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new home($this->config);
	}

	public function testGet_abreviatura_estado(){
		$this->AssertEquals($this->controler->get_abreviatura_estado("aguascalientes"),"Ags.");
	}

}

?>
