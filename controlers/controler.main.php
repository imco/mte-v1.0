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
		$q->search_clause = $this->request('entidad') ? 'municipios.entidad = "'.$this->request('entidad').'"' : '1';
		$q->order_by = 'municipios.nombre';
		$this->municipios = $q->read('id,nombre,entidad=>nombre,entidad=>id');
		if($this->request('json')){
			$response = array();
			foreach($this->municipios as $key => $municipio){
				$response[$key]->id = $municipio->id;
				$response[$key]->nombre = $this->capitalize($municipio->nombre).", ".$this->capitalize($municipio->entidad->nombre);
			}
			echo json_encode($response);
		}
		
	}
	public function load_localidades(){
		if($this->request('entidad') || $this->request('municipio')){
			$q = new localidad();
			$q->search_clause = $this->request('entidad') ? 'localidades.entidad = "'.$this->request('entidad').'"' : '1';
			$q->search_clause = $this->request('municipio') ? 'localidades.municipio = "'.$this->request('municipio').'"' : $q->search_clause;
			$q->order_by = 'localidades.nombre';
			//$q->debug = true;
			$this->localidades = $q->read('id,nombre,entidad=>nombre,entidad=>id');
			if($this->request('json')){
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
		$q->search_clause .= $this->request('term') ? " AND escuelas.nombre LIKE '".$this->request('term')."%' " : '';
		$q->search_clause .= $this->request('entidad') ? ' AND escuelas.entidad = "'.$this->request('entidad').'" ' : '';
		$q->search_clause .= $this->request('municipio') ? ' AND escuelas.municipio = "'.$this->request('municipio').'" ' : '';
		$q->search_clause .= $this->request('localidad') ? ' AND escuelas.localidad = "'.$this->request('localidad').'" ' : '';
		$q->search_clause .= $this->request('nivel') === false || $this->request('nivel') === '' ? '' : ' AND escuelas.nivel = "'.$this->request('nivel').'" ';
		$q->order_by = 'escuelas.nombre';
		$q->limit= $limit ? $limit : "0 ,15";
		$this->escuelas = $q->read('cct,nombre,localidad=>nombre,localidad=>id,entidad=>nombre,entidad=>id,nivel=>nombre,latitud,longitud');
		if($this->request('json')){
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