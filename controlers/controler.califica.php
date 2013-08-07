<?php
class califica extends main{
	public function index(){
		$this->title_header = 'Califica tu escuela';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Califica');
		$this->include_theme('index','index');
	}

}
?>
