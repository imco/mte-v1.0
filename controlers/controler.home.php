<?php
class home extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_escuelas();	
		$this->include_theme('index','index');
	}
	public function load_escuelas(){
		
	}

}
?>