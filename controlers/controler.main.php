<?php
class main extends controler{
	public function main($config){
		$this->config = $config;
		$this->dbConnect();
		$this->location = get_class($this);
		$this->header_folder = 'home';
		$this->page_title = 'Mejora tu Escuela';
		$this->breadcrumb = false;
		$this->draw_map = false;
		$this->draw_charts = false;
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
				$escuelas[$escuela->cct]->promedio_general = $escuela->promedio_general;
				$escuelas[$escuela->cct]->promedio_matematicas = $escuela->promedio_matematicas;
				$escuelas[$escuela->cct]->promedio_espaniol = $escuela->promedio_espaniol;
				$escuelas[$escuela->cct]->rank = $escuela->rank_entidad;
				$escuelas[$escuela->cct]->rank_nacional = $escuela->rank_nacional;
				$escuelas[$escuela->cct]->direccion = $this->capitalize($escuela->localidad->nombre).', '.$this->capitalize($escuela->entidad->nombre);
				$escuelas[$escuela->cct]->promedio_matematicas = $escuela->promedio_matematicas;
				$escuelas[$escuela->cct]->promedio_espaniol = $escuela->promedio_espaniol;
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
		$this->escuelas = $q->read('cct,nombre,poco_confiables,turno=>num,codigopostal,telefono,correoelectronico,paginaweb,domicilio,total_evaluados,grados,localidad=>nombre,localidad=>id,entidad=>nombre,entidad=>id,nivel=>nombre,nivel=>id,latitud,longitud,promedio_general,promedio_matematicas,promedio_espaniol,rank_entidad,rank_nacional,control=>id,control=>nombre,municipio=>nombre,municipio=>id,control=>nombre');

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
	public function get_escuelas_new($params = false,$page = false,$sort = false){
		$fq = '(nivel:12 OR nivel:13 OR nivel:22)';
		$q = isset($params->term) && $params->term ? "nombre:".str_replace(' ','~ ',$params->term).'~' : '*:*';
		if($params){
			foreach($params as $key => $param){
				$fq .= $key != 'term' && $param ? " AND $key:$param" : '';
			}
		}
		$start = $page ? ($page-1) * 10 : '0';
		$q = urlencode($q);
		$fq = urlencode($fq);
		$sort = urlencode($sort);
		$url = "http://busquedas.mejoratuescuela.org/solr/mte/select?q=$q&fq=$fq&wt=json&sort=$sort&start=$start";exit;
		$response = json_decode(file_get_contents($url));
		$this->escuelas = $response->response->docs;
		$this->num_results = $response->response->numFound;
	}

	public function load_niveles(){
		$q = new nivel();
		$q->search_clause = 'niveles.id = "12" || niveles.id = "13" || niveles.id = "22"';
		$this->niveles = $q->read('id,nombre');
	}
	public function load_entidades($order_by = false){
		$q = new entidad();
		$q->search_clause = '1';
		if($order_by) $q->order_by = $order_by;
		$this->entidades = $q->read('id,nombre,cct_count,promedio_general,rank');
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

	/*
	for test
	*/
	if(!($location_cookie = $this->cookie('user_location'))){
    		$ip = 
    			isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] :
    			isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] :
    			isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';    	
			$url = "http://freegeoip.net/json/$ip";
			$location_request = file_get_contents($url);
			$location = json_decode($location_request);
		//var_dump($location);
    		if($location->region_code != '' && $location->country_code == 'MX'){
			//$this->user_location = new entidad(9);
			$this->user_location = new entidad($location->region_code);
			$this->user_location->read('id,nombre');
		}else{
			$this->user_location = new entidad(rand(1,32));
			$this->user_location->read('nombre,id');
		}
		$this->set_cookie('user_location',$this->user_location->nombre."-".$this->user_location->id);
	}else{
		$temp = explode('-',$location_cookie);
		$this->user_location = new stdClass();
		$this->user_location->nombre = $temp[0];
		$this->user_location->id = $temp[1];
	}

    }
    protected function load_compara_cookie(){
    	$this->compara_cookie = false;
    	if($this->cookie('escuelas')){
    		$this->compara_cookie = explode('-',$this->cookie('escuelas'));
    		$this->compara_cookie = count($this->compara_cookie) ? $this->compara_cookie : false;
    	}
    }
    
    protected function cct_count_entidad(){
    	if(isset($this->escuelas)){
		foreach($this->escuelas as $escuela){
			$id_entidad = isset($escuela->entidad->id)?$escuela->entidad->id:$escuela->entidad;
			$entidad = new entidad($id_entidad);
			$nivelNombre = isset($escuela->nivel->nombre)?$escuela->nivel->nombre:$escuela->nom_nivel;
			$nivel = "numero_escuelas_".strtolower($nivelNombre);
			$nivelNacional = "numero_nacional_escuelas_".strtolower($nivelNombre);
			$entidad->read($nivel.",".$nivelNacional);
			$escuela->entidad_cct_count = $entidad->$nivel;
			$escuela->nacional_cct_count = $entidad->$nivelNacional;
		}
	}
    }

    protected function load_estado_petitions($estado){
		date_default_timezone_set('America/Mexico_City');
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$petition_info = $change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela');
		$petition_data = array();
		$i=0;
		foreach($petition_info as $petition){
			$regExp = "/".$estado."/i";
			if(preg_match($regExp, $petition['title'])){
				$petition_data[] = $petition;
				$petition_data[count($petition_data)-1]['count'] = ++$i;
			}else
				$i++;
		}
		return $petition_data;	
    }

    protected function set_info_user_search($escuelas_num){
		$params= array();
		if($this->get('search')){
		    $params[] = $this->get('term')?$this->get('term'):"";
			$params[] = $this->get('control')?$this->get('control'):0;
			$params[] = $this->get('nivel')?$this->get('nivel'):0;
			$params[] = $this->get('entidad')?$this->get('entidad'):0;
			$params[] = $this->get('municipio')?$this->get('municipio'):0;
			$params[] = $this->get('localidad')?$this->get('localidad'):0;
		}else if($this->post('search')){
		    $params[] = $this->post('term')?$this->post('term'):"";
			$params[] = $this->post('control')?$this->post('control'):0;
			$params[] = $this->post('nivel')?$this->post('nivel'):0;
			$params[] = $this->post('entidad')?$this->post('entidad'):0;
			$params[] = $this->post('municipio')?$this->post('municipio'):0;
			$params[] = $this->post('localidad')?$this->post('localidad'):0;		
		}

		if(!$this->get('p') && ($this->get('search') || $this->post('search'))){
			$params[] = $escuelas_num;
			$user_search = new user_search();
			$user_search->create(
				'term,control,nivel,entidad,municipio,localidad,cct_count',$params
			);
		}	
    }

    protected function shorten_url($url){
		$hootSuite = new ApiHootSuite($this->config->hootSuite_api_key);
		$shortUrl = $hootSuite->shorten($url);
		return $shortUrl['results']['shortUrl'];
    
    }
}
?>
