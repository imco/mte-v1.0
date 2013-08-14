<?php
class ayuda extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Ayuda');
		$this->include_theme('index','index');
	}
}
?>
