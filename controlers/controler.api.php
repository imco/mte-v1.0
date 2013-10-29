<?php
/**
* Clase api Exitende main
* Controlador: host/api
* Brinda la interfaz de programación de aplicaciones.
*/
class api extends main{

	/**
	* Funcion Publica escuelas.
	* Obtiene y presenta información relevante de cien escuelas ya se en formato csv o json dependiendo 
	* del valor de la variable 'formato' en los datos procedentes ya sea de POST o GET.
	*/
	public function escuelas(){
		/* Obtiene y presenta información relevante de cien escuelas ya se en formato csv o json dependiendo del valor de la variable 'formato' en los datos procedentes ya sea de POST o GET. */
		$params->limit = "0 ,100";
		$this->get_escuelas($params);
		$this->process_escuelas();
		if($this->request('formato') == 'csv'){
			$this->format_csv();
			echo($this->get_csv($this->escuelas_csv));
		}else{
			echo json_encode($this->escuelas_digest->escuelas);
		}
	}

	/**
	* Funcion Publica municipios.
	* Obtiene y presenta información relevante de los municipios en formato json
	*/
	public function municipios(){
		/* Obtiene y presenta información relevante de los municipios en formato json */
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

	/**
	* Funcion Publica entidades.
	* Obtiene y presenta información relevante de los estados en formato json
	*/
	public function entidades(){
		/* Obtiene y presenta información relevante de los estados en formato json */
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

	/**
	* Funcion Privada get_csv.
	* A partir de un arreglo asociativo presenta la información de este en formato csv
	*/
	private function get_csv(array &$array){		
		/* A partir de un arreglo asociativo presenta la información de este en formato csv*/
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

	/** 
	* Funcion Privada format_csv.
	* Lee la información de las escuelas que se encuentran en el atributo de tipo arreglo del mismo nombre y crea un atributo 'escuelas_csv' de tipo arreglo que contiene un arreglo asociativo por cada escuela, donde la llave de este es el nombre del dato y es asociado a su valor.
	*/
	private function format_csv(){
		$this->escuelas_csv = array();
		$this->escuelas_csv = array();
		foreach($this->escuelas as $escuela){
			$this->escuelas_csv[] = array(
				'cct' => $escuela->cct,
				'Nombre' => $escuela->nombre,
				'Control' => $escuela->control->nombre,	
				'Entidad' => $escuela->entidad->nombre,
				'Municipio' => $escuela->municipio->nombre,
				'Localidad' => $escuela->localidad->nombre,
				'Codigo Postal' => $escuela->codigopostal,
				'Telefono' => $escuela->telefono,
				'Domicilio' => $escuela->domicilio,
				'Nivel' => $escuela->nivel->nombre,
				'Promedo General' => $escuela->promedio_general,
				'Promedo Matemáticas' => $escuela->promedio_matematicas,
				'Promedo Español' => $escuela->promedio_espaniol,				
				'Rank Estatal' => $escuela->rank_entidad,
				'Rank Estatal' => $escuela->rank_nacional,
				'Latitud' => $escuela->latitud,
				'Longitud' => $escuela->longitud,
				'Correo Electrónico' => $escuela->correoelectronico
			);
		}
	}
}
?>