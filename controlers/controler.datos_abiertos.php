<?php
class datos_abiertos extends main{
	public function index(){		
		$this->header_folder ='datos_abiertos';
		$this->include_theme('index','index');
	}
}
?>