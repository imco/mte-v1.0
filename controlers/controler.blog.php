<?php
class blog extends main{
	public function index(){		
		$this->breadcrumb = array('#'=>'Blog');
		$this->header_folder = 'escuelas';
		$this->include_theme('index','index');
	}
}
?>
