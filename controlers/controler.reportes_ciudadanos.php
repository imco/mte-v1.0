<?php
class reportes_ciudadanos extends main{
	public function index(){		
		$this->header_folder ='reportes_ciudadanos';
		$this->include_theme('index','index');
	}
}
?>