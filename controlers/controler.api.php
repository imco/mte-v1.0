<?php
class api extends main{
	public function escuelas(){
		$params->limit = "0 ,30000";
		$this->get_escuelas($params);
		$this->process_escuelas();
		if($this->request('formato') == 'csv'){
			$this->format_csv();
			echo($this->get_csv($this->escuelas_csv));
		}else{
			echo json_encode($this->escuelas_digest->escuelas);
		}
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
	private function get_csv(array &$array){		
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
	}
	private function format_csv(){
		$this->escuelas_csv = array();

		foreach($this->escuelas as $escuela){
			$this->escuelas_csv[] = array(
				'cct' => $escuela->cct,
				'Nombre' => $escuela->nombre,
				'Entidad' => $escuela->entidad->nombre,
				'Municipio' => $escuela->municipio->nombre,
				'Localidad' => $escuela->localidad->nombre,
				'Latitud' => $escuela->latitud,
				'Longitud' => $escuela->longitud,

			);
		}
	}
}
?>