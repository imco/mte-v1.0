<?php
class comparador extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->header_folder = 'comparador';
		$this->include_theme('index','index');
	}
}
?>