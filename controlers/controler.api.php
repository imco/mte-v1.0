<?php
class api extends main{
	public function escuelas(){
		$params->limit = "0 ,2000";
		$this->get_escuelas($params);
		$this->process_escuelas();
		echo json_encode($this->escuelas_digest->escuelas);
	}
	public function municipios(){
		$this->load_municipios();
		$digest = array();
		$i = 0;
		foreach($this->municipios as $municipio){
			$digest[$i]->id = $municipio->id;
			$digest[$i]->nombre = $municipio->nombre;
			$digest[$i]->entidad->nombre = $municipio->entidad->nombre;
			$digest[$i++]->entidad->id =  $municipio->entidad->id;
		}
		echo json_encode($digest);
	}
	public function entidades(){
		$this->load_entidades();
		$digest = array();
		$i = 0;
		foreach($this->entidades as $entidad){
			$digest[$i]->id = $entidad->id;
			$digest[$i]->nombre = $entidad->nombre;
			$digest[$i++]->ccts = $entidad->cct_count;

		}
		echo json_encode($digest);
	}
}
?>