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

}
?>