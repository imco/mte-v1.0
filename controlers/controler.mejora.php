<?php
class mejora extends main{
	public function index(){
		$this->title_header = 'Mejora tu escuela';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Mejora');
		$this->include_theme('index','index');
	}

}
?>
