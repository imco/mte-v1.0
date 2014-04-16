<?php
require_once("test.default.php");

class homeTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = $this->require_contoler("home");
	}

	public function testGet_abreviatura_estado(){
		$this->AssertEquals($this->controler->get_abreviatura_estado("aguascalientes"),"Ags.");
	}

}

?>
