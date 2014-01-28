<?php
/**
* Clase ayuda Extiende main.
* Controlador: host/ayuda
*/
class ayuda extends main{
	/*
	* Funcion Publica index 
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Ayuda');
		$this->include_theme('index','index');
	}
}
?>
