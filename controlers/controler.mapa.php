<?php
class mapa extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();	
		$params->limit = '0,1000';
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->draw_map = true;
		$this->include_theme('index','index');
	}
	
	
   

}
?>