<?php
/**
* Clase bases Extiende main.
* Controlador: host/bases
*/
class bases extends main{
	/*
	* Funcion Publica index 
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		//$this->header_folder ='escuelas';
		$this->angular = true;
		$this->breadcrumb = array('#'=>'Descargas');
		$this->include_theme('index','censo');
	}
}
?>
