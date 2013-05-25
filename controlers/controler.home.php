<?php
class home extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_escuelas();
		$this->include_theme('index','index');
	}
	public function load_escuelas(){
		$niveles = array(12,13,22);
		$this->get_location();
		$params->order_by = ' ISNULL(escuelas.rank_nacional), escuelas.rank_nacional ASC, escuelas.promedio_general DESC';
		$params->nivel = $niveles[rand(0,2)];
		$params->rank_nacional = rand(1,100);
		$params->control = 1;
		$params->limit = '0,1';
		$this->get_escuelas($params);
		$this->publica = $this->escuelas[0];
		$params->control = 2;
		$this->get_escuelas($params);
		$this->privada = $this->escuelas[0];
		$params2->nivel = $niveles[rand(0,2)];
		$this->nivel_5 = $params2->nivel;
		$params2->entidad = $this->user_location->id;
		$params2->order_by = ' ISNULL(escuelas.rank_nacional), escuelas.rank_nacional ASC, escuelas.promedio_general DESC';
		$params2->limit = '0,5';
		//$this->debug = true;
		$this->get_escuelas($params2);
		$this->process_escuelas();
	}

}
?>