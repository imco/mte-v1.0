<?php
class aviso_de_privacidad extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Aviso de Privacidad');
		$this->include_theme('index','index');
	}
}
?>
