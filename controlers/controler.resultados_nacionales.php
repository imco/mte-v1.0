<?php
class resultados_nacionales extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->load_entidades();
		$this->include_theme('index','index');
	}
}
?>
