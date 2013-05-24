<?php
class compara extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_compara_cookie();
		//if(!$this->get('search')) $this->get_location();
		$this->user_location = false;
		if(!$this->request('search')){
			$params->entidad = $this->user_location ? $this->user_location : 9 ;
		}
		$params->pagination = 6;		
		$params->order_by = 'escuelas.promedio_general DESC';		
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->header_folder = 'compara';		
		$this->resultados_title = 'Resultados';
		$this->include_theme('index','resultados');
	}
	public function escuelas(){
		$this->header_folder ='escuelas';
		$this->draw_map = true;
		$this->load_compara_cookie();
		$params->ccts = explode('-',$this->get('id'));
		$params->order_by = 'escuelas.promedio_general DESC';
		if(count($params->ccts)){
			$this->get_escuelas($params);		
			$this->process_escuelas();
		}
		$this->resultados_title = 'Resultados';
		$this->include_theme('index','index');
	}
}
?>