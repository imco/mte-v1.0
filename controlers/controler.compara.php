<?php
class compara extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->header_folder = 'compara';
		$this->include_theme('index','index');
	}
}
?>