<?php
class metodologia extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->breadcrumb = array('#'=>'Metodología');
		$this->include_theme('index','index');		
	}
}
?>
