<?php
class main extends controler{
	public function main($config){
		$this->config = $config;
		$this->dbConnect();
		$this->location = get_class($this);
	}
	public function load_municipios(){
		$q = new municipio();
		//$q->debug = true;
		$q->search_clause = $this->post('entidad') ? 'municipios.entidad = "'.$this->post('entidad').'"' : '1';
		$q->order_by = 'municipios.nombre';
		$this->municipios = $q->read('id,nombre,entidad=>nombre,entidad=>id');
		if($this->post('json')){
			$response = array();
			foreach($this->municipios as $key => $municipio){
				$response[$key]->id = $municipio->id;
				$response[$key]->nombre = $this->capitalize($municipio->nombre).", ".$this->capitalize($municipio->entidad->nombre);
			}
			echo json_encode($response);
		}
		
	}
	public function load_localidades(){
		if($this->post('entidad') || $this->post('municipio')){
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
					$response[$key]->nombre = $this->capitalize($localidad->nombre);
				}
				echo json_encode($response);
			}
		}else{
			$this->localidades = false;
		}
		
	}
	public function get_escuelas($limit = false){		
		$q = new escuela();
		$q->search_clause = '1 ';
		$q->search_clause .= $this->post('term') ? " AND escuelas.nombre LIKE '".$this->post('term')."%' " : '';
		$q->search_clause .= $this->post('entidad') ? ' AND escuelas.entidad = "'.$this->post('entidad').'" ' : '';
		$q->search_clause .= $this->post('municipio') ? ' AND escuelas.municipio = "'.$this->post('municipio').'" ' : '';
		$q->search_clause .= $this->post('localidad') ? ' AND escuelas.localidad = "'.$this->post('localidad').'" ' : '';
		$q->search_clause .= $this->post('nivel') === false || $this->post('nivel') === '' ? '' : ' AND escuelas.nivel = "'.$this->post('nivel').'" ';
		$q->order_by = 'escuelas.nombre';
		$q->limit= $limit ? $limit : "0 ,15";
		$this->escuelas = $q->read('cct,nombre,localidad=>nombre,localidad=>id,entidad=>nombre,entidad=>id,nivel=>nombre,latitud,longitud');
		if($this->post('json')){
			$response = array();
			if($this->escuelas){
				foreach($this->escuelas as $key => $escuela){
					$response[$key]->label = $this->capitalize($escuela->nombre).' | '.$this->capitalize($escuela->localidad->nombre).', '.$this->capitalize($escuela->entidad->nombre);
					$response[$key]->value = $this->capitalize($escuela->nombre);
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
	protected function capitalize($string){
		return ucwords(strtolower($string));
	}
}
?>