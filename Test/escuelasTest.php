<?php
require_once("test.default.php");

class escuelasTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new escuelas($this->config);
	}

	public function testEscuela_info(){
		$cct = "07DPT0001D";
		$this->controler->escuela_info($cct);
		$enlace =  new enlace();
		$enlace->search_clause = 'cct="'.$cct.'" AND anio = "2013"';
		$enlaces = $enlace->read('id');
		if(count($enlaces))
			$this->AssertNotContains($this->controler->escuela->grados,array(null,0));
		else
			$this->AssertEquals($this->controler->escuelas->grados,0);
	}

}

?>
