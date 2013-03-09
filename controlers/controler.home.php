<?php
class home extends main{
	public function index(){
		$this->load_niveles();
		$this->include_theme('index','index');
	}
	public function load_niveles(){
		$q = new nivel();
		//$q->search_clause = 'niveles.id != "0"';
		$q->search_clause = '1';
		//$q->debug = true;
		$this->niveles = $q->read('id,nombre');
	}
	public function load_entidades(){

	}

}
?>