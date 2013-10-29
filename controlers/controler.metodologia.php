<?php

/**
* Clase metodoogia Extiende main.
* Controlador: host/metodologia
*/
class metodologia extends main{
	
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Metodología');
		$this->include_theme('index','index');		
	}
}
?>
