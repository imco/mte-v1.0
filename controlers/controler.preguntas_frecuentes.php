<?php

/**
* Clase preguntas_frecuentes Extiende main.
* Controlador: host/preguntas_frecuentes
*/
class preguntas_frecuentes extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		$this->header_folder ='home';
		$this->breadcrumb = array('#'=>'Preguntas Frecuentes');
		$this->include_theme('index','index');		
	}
}
?>
