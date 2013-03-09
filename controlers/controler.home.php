<?php
class home extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->include_theme('index','index');
	}
	public function load_niveles(){
		$q = new nivel();
		$q->search_clause = '1';
		$this->niveles = $q->read('id,nombre');
	}
	public function load_entidades(){
		$q = new entidad();
		$q->search_clause = '1';
		$this->entidades = $q->read('id,nombre');
	}
	public function load_municipios(){
		$q = new municipio();
		$q->search_clause = '1';
		$q->order_by = 'municipios.nombre';
		$this->municipios = $q->read('id,nombre,entidad=>nombre,entidad=>id');
	}
}
?>