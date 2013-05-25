<?php
class datos_abiertos extends main{
	public function index(){		
		$this->header_folder ='datos_abiertos';
		$this->load_file_list();
		$this->include_theme('index','index');
	}
	private function load_file_list(){
		$files = file_get_contents($this->config->document_root.'/files/files-index.js');
		$this->files = json_decode($files);
	}
}
?>