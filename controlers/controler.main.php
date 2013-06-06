<?php
class main extends controler{
	public function main($config){
		$this->config = $config;
		$this->dbConnect();
		$this->location = get_class($this);
		$this->header_folder = 'home';
		$this->page_title = 'Mejora tu Escuela';
		$this->draw_map = false;
	}
	protected function process_escuelas(){
		$this->escuelas_digest = false;
		if($this->escuelas){
			$escuelas = array();
			foreach($this->escuelas as $key => $escuela){
				if($key == 0){
					$minlat = $maxlat = $escuela->latitud;
					$minlong = $maxlong = $escuela->longitud;
				}else{
					if($escuela->latitud < $minlat) $minlat = $escuela->latitud;
					else if($escuela->latitud > $maxlat) $maxlat = $escuela->latitud;
					if($escuela->longitud < $minlong) $minlong = $escuela->longitud;
					else if($escuela->longitud > $maxlong) $maxlong = $escuela->longitud;
				}
				$escuela->get_semaforo();
				$escuelas[$escuela->cct]->cct = $escuela->cct;
				$escuelas[$escuela->cct]->latitud = $escuela->latitud;
				$escuelas[$escuela->cct]->longitud = $escuela->longitud;
				$escuelas[$escuela->cct]->nombre = $this->capitalize($escuela->nombre);
				$escuelas[$escuela->cct]->localidad = $this->capitalize($escuela->localidad->nombre);
				$escuelas[$escuela->cct]->entidad = $this->capitalize($escuela->entidad->nombre);
				$escuelas[$escuela->cct]->nivel = $this->capitalize($escuela->nivel->nombre);
				$escuelas[$escuela->cct]->control = $this->capitalize($escuela->control->nombre);
				$escuelas[$escuela->cct]->semaforo = $escuela->semaforo;
				$escuelas[$escuela->cct]->rank = $escuela->rank_entidad;
				$escuelas[$escuela->cct]->direccion = $this->capitalize($escuela->localidad->nombre).', '.$this->capitalize($escuela->entidad->nombre);
			}
			$width = $this->distance($maxlat,$minlong,$maxlat,$maxlong);
			$height = $this->distance($maxlat,$minlong,$minlat,$minlong);
			$max = $width > $height ? $width : $height;
			$factor = $width > $height ? .20 : .12;
			$scales = array_reverse($this->get_scales(),true);
			foreach($scales as $key => $scale){
				$size = $scale;
				$zoom = $key;
				if($size >= $max) break;
			}
			$response->zoom = $zoom+1;
			$response->centerlat = $minlat + (($maxlat - $minlat) / 2);
			$response->centerlong = $minlong + (($maxlong - $minlong) / 2);
			$response->escuelas = $escuelas;
			$this->escuelas_digest = $response;
		}
	}
	protected function get_scales(){
		$scales[0] = 20088000;
		$scales[1] = 10044000;
		$scales[2] = 5022000;
		$scales[3] = 2511000;
		$scales[4] = 1255500;
		$scales[5] = 627750;
		$scales[6] = 313875;
		$scales[7] = 156938;
		$scales[8] = 78469;
		$scales[9] = 39234;
		$scales[10] = 19617;
		$scales[11] = 9809;
		$scales[12] = 4909;
		$scales[13] = 2452;
		$scales[14] = 1226;
		//$scales[15] = 613;
		//$scales[16] = 307;
		//$scales[17] = 153;
		//$scales[18] = 77;
		//$scales[19] = 38;
		return $scales;
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
	public function get_escuelas($params = false){		
		$q = new escuela();
		$q->search_clause .= ' 1 ';
		
		$q->search_clause .= $this->request('term') ? " AND escuelas.nombre LIKE '".$this->request('term')."%' " : '';
		if(isset($params->entidad) && $params->entidad){
			$q->search_clause .= " AND escuelas.entidad = '{$params->entidad}' ";
		}else{
			$q->search_clause .= $this->request('entidad') ? ' AND escuelas.entidad = "'.$this->request('entidad').'" ' : '';
		}
		$q->search_clause .= $this->request('municipio') ? ' AND escuelas.municipio = "'.$this->request('municipio').'" ' : '';
		if(isset($params->localidad) && $params->localidad){
			$q->search_clause .= " AND escuelas.localidad = '{$params->localidad}' ";
		}else{
			$q->search_clause .= $this->request('localidad') ? ' AND escuelas.localidad = "'.$this->request('localidad').'" ' : '';
		}

		if(isset($params->nivel) && $params->nivel){
			$q->search_clause .= " AND escuelas.nivel = '{$params->nivel}' ";
		}else{
			$q->search_clause .= $this->request('nivel') === false || $this->request('nivel') === '' ? 'AND (escuelas.nivel = "12" || escuelas.nivel = "13" || escuelas.nivel = "22") ' : ' AND escuelas.nivel = "'.$this->request('nivel').'" ';
		}

		if(isset($params->control) && $params->control){
			$q->search_clause .= " AND escuelas.control = '{$params->control}' ";
		}else{
			$q->search_clause .= $this->request('control') ? ' AND escuelas.control = "'.$this->request('control').'" ' : '';
		}
		
		if(isset($params->rank_nacional)){
			$q->search_clause .= ' AND rank_nacional >= '.$params->rank_nacional;
		}

		if(isset($params->ccts) && $params->ccts){
			if(count($params->ccts)){
				$q->search_clause = '';
				foreach($params->ccts as $i => $cct){
					$or = $i == 0 ? '(' : ' OR ';
					$q->search_clause .= "$or escuelas.cct = '$cct'";
				}
				$q->search_clause .= " )";
			}
		}
		$q->order_by = isset($params->order_by) ? $params->order_by : 'escuelas.nombre';
		$q->limit= isset($params->limit) ? $params->limit : "0 ,10";
		
		if(isset($params->pagination)){
			$this->pagination = new pagination('escuela',$params->pagination,$q->search_clause);
			$q->limit = $this->pagination->limit;
		}

		$q->debug = isset($this->debug) ? $this->debug : false;
		$this->escuelas = $q->read('cct,nombre,poco_confiables,domicilio,total_evaluados,localidad=>nombre,localidad=>id,entidad=>nombre,entidad=>id,nivel=>nombre,nivel=>id,latitud,longitud,promedio_general,promedio_matematicas,promedio_espaniol,rank_entidad,rank_nacional,control=>id,control=>nombre');

		if($this->request('json')){
			$response = array();
			if($this->escuelas){
				foreach($this->escuelas as $key => $escuela){
					$response[$key]->label = $this->capitalize($escuela->nombre)." (".$this->capitalize($escuela->nivel->nombre).") ";
					$response[$key]->address = $this->capitalize($escuela->localidad->nombre).', '.$this->capitalize($escuela->entidad->nombre);
					$response[$key]->value = $this->capitalize($escuela->nombre);
					$response[$key]->cct = $escuela->cct;
				}
			}
			echo json_encode($response);
		}
	}

	public function load_niveles(){
		$q = new nivel();
		$q->search_clause = 'niveles.id = "12" || niveles.id = "13" || niveles.id = "22"';
		$this->niveles = $q->read('id,nombre');
	}
	public function load_entidades(){
		$q = new entidad();
		$q->search_clause = '1';
		$this->entidades = $q->read('id,nombre');
	}
	protected function capitalize($string){
		return ucwords(mb_strtolower($string,'UTF-8'));
		//return $string;
	}
	private function distance($lat1,$long1,$lat2,$long2) {
        $lat1 = deg2rad($lat1);
        $long1 = deg2rad($long1);
        $lat2 = deg2rad($lat2);
        $long2 = deg2rad($long2);
        $radiusOfEarth = 6371000;// Earth's radius in meters.
        $diffLatitude = $lat1 - $lat2;
        $diffLongitude = $long1 - $long2;
        $a = sin($diffLatitude / 2) * sin($diffLatitude / 2) +
            cos($lat2) * cos($lat1) *
            sin($diffLongitude / 2) * sin($diffLongitude / 2);
        $c = 2 * asin(sqrt($a));
        $distance = $radiusOfEarth * $c;
        return $distance;
    }
    protected function get_location(){
    	/*$ip = $_SERVER['REMOTE_ADDR'];
    	//$ip = '187.153.71.141';
		$file = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=cdccbbece6854ef58d1341e85a009e4e99cdffddc7e7e8002ff38aed37344e5f&ip=$ip");
		$result = explode(';',$file);
		$entidad = $result[5];
		if($entidad != '-'){
			$q = new entidad();
			$q->search_clause = "entidades.nombre LIKE '$entidad%'";
			$entidad = $q->read('id,nombre');
			if($entidad && count($entidad) == 1) 
				$this->user_location = $entidad[0]->id;
			else
				$this->user_location = false;
		}else{
			$this->user_location = false;
		}*/
		$entidad = new entidad(rand(1,32));
		$entidad->read('nombre,id');
		$this->user_location = $entidad;

    }
    protected function load_compara_cookie(){
    	$this->compara_cookie = false;
    	if($this->cookie('escuelas')){
    		$this->compara_cookie = explode('-',$this->cookie('escuelas'));
    		$this->compara_cookie = count($this->compara_cookie) ? $this->compara_cookie : false;
    	}
    }
}
?>