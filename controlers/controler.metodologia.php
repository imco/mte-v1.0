<?php
class metodologia extends main{
	/* Controlador: host/metodologia/*
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Metodología');
		$this->include_theme('index','index');		
	}
}
?>
