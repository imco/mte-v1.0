<?php
/**
* Clase califica Extiende main.
* Controlador: host/califica
*/
class califica extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas
	*/
	public function index(){
		$this->title_header = 'Califica tu escuela';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Califica');
		$this->include_theme('index','index');
	}

}
?>
