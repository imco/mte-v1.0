<?php
class aviso_de_privacidad extends main{
	/* Controlador: host/aviso_de_privacidad/*
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Aviso de Privacidad');
		$this->include_theme('index','index');
	}
}
?>
