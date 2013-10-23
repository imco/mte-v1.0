<?php
class ayuda extends main{
	/* Controlador: host/ayuda/*
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Ayuda');
		$this->include_theme('index','index');
	}
}
?>
