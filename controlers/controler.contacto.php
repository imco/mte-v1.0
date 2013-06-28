<?php
class contacto extends main{
	public function index(){		
		$this->header_folder ='contacto';		
		$this->breadcrumb = array('#'=>'Contacto');
		$this->include_theme('index','index');
	}
}
?>
