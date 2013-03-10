<?php
class main extends controler{
	public function main($config){
		$this->config = $config;
		$this->dbConnect();
		$this->location = get_class($this);
	}
	public function load_municipios(){
		$q = new municipio();
		$q->search_clause = $this->post('entidad') ? 'municipios.entidad = "'.$this->post('entidad').'"' : '1';
		$q->order_by = 'municipios.nombre';
		$this->municipios = $q->read('id,nombre,entidad=>nombre,entidad=>id');
		if($this->post('json')){
			$response = array();
			foreach($this->municipios as $key => $municipio){
				$response[$key]->id = $municipio->id;
				$response[$key]->nombre = ucwords(strtolower($municipio->nombre)).", ".ucwords(strtolower($municipio->entidad->nombre));
			}
			echo json_encode($response);
		}
		
	}
	public function load_localidades(){
		$q = new localidad();
		$q->search_clause = $this->post('entidad') ? 'localidades.entidad = "'.$this->post('entidad').'"' : '1';
		$q->search_clause = $this->post('municipio') ? 'localidades.municipio = "'.$this->post('municipio').'"' : $q->search_clause;
		$q->order_by = 'localidades.nombre';
		//$q->debug = true;
		$this->localidades = $q->read('id,nombre,entidad=>nombre,entidad=>id');
		if($this->post('json')){
			$response = array();
			foreach($this->localidades as $key => $localidad){
				$response[$key]->id = $localidad->id;
				$response[$key]->nombre = ucwords(strtolower($localidad->nombre)).", ".ucwords(strtolower($localidad->entidad->nombre));
			}
			echo json_encode($response);
		}
		
	}
	public function get_escuelas(){
		$term = $this->request('term');
		if($term){
			$q = new escuela();
			//$q->debug = true;
			$q->search_clause = "escuelas.nombre LIKE '$term%' ";
			$q->search_clause .= $this->post('entidad') ? 'AND escuelas.entidad = "'.$this->post('entidad').'" ' : '';
			$q->search_clause .= $this->post('municipio') ? 'AND escuelas.municipio = "'.$this->post('municipio').'" ' : '';
			$q->search_clause .= $this->post('localidad') ? 'AND escuelas.localidad = "'.$this->post('localidad').'" ' : '';
			$q->order_by = 'escuelas.nombre';
			$q->limit = '0, 10';
			$escuelas = $q->read('cct,nombre,localidad=>nombre,localidad=>id,entidad=>nombre,entidad=>id');
			$response = array();
			if($escuelas){
				foreach($escuelas as $key => $escuela){
					$response[$key]->label = ucwords(strtolower($escuela->nombre)).', '.ucwords(strtolower($escuela->localidad->nombre)).', '.ucwords(strtolower($escuela->entidad->nombre));
					$response[$key]->value = ucwords(strtolower($escuela->nombre));
				}
			}
			echo json_encode($response);
		}
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
}
?>