<?php
/**
* Clase aviso_de_privacidad Extiende main. 
* Controlador: host/aviso_de_privacidad/*
*/
class aviso_de_privacidad extends main{	
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas
	*/
	public function index(){
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Aviso de Privacidad');
		$this->include_theme('index','index');
	}
}
?>
