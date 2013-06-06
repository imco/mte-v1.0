<?php
class peticiones extends main{
	public function index(){		
		$this->header_folder ='peticiones';
		$this->include_theme('index','index');
	}
}
?>