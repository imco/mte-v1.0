<?php
require_once("test.default.php");

class mainTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new main($this->config);
	}

	public function testGet_escuelas(){
		$params = new StdClass();
		$params->ccts = array("21DPR2501R");
		$this->controler->get_escuelas($params);
		$this->AssertEquals($this->controler->escuelas[0]->nombre,"MANUEL AVILA CAMACHO");
	}

}
?>
