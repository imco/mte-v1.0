<?php
/**
* Clase blog Extiende main.
* Controlador: host/blog
*/
class blog extends main{

	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas
	*/
	public function index(){		
		$this->breadcrumb = array('#'=>'Blog');
		$this->header_folder = 'escuelas';
		$this->include_theme('index','index');
	}
}
?>
