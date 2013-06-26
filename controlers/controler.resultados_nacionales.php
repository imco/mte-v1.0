<?php
class resultados_nacionales extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->load_entidades();
		$this->include_theme('index','index');
	}
	public function entidad(){
		if($this->get('id')){
			$this->header_folder ='escuelas';
			$this->load_entidades();
			$this->entidad = new entidad($this->get('id'));
			$this->entidad->read('id,nombre,cct_count');
			$this->include_theme('index','entidad');
		}else{
			$this->index();
		}
	}
}
?>
