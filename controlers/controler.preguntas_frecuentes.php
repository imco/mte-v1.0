<?php
class preguntas_frecuentes extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Preguntas Frecuentes');
		$this->include_theme('index','index');		
	}
}
?>
