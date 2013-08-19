<?php
class quienes_somos extends main{
	public function index(){
		$this->title_header = '¿Quiénes somos?';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'¿Quiénes somos?');
		$this->include_theme('index','index');
	}
}

?>
