<?php
class peticiones extends main{
	public function index(){		
		$this->header_folder ='peticiones';
		$this->load_file_list();
		$this->include_theme('index','index');
	}
}
?>