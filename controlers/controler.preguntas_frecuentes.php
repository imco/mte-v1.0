<?php
class preguntas_frecuentes extends main{
	/* Controlador: host/preguntas_frecuentes/*
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Preguntas Frecuentes');
		$this->include_theme('index','index');		
	}
}
?>
