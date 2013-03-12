<?php
class mapa extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();	
		$this->get_escuelas('0,1000');
		$this->process_escuelas();
		$this->include_theme('index','index');
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
				$escuelas[$key]->cct = $escuela->cct;
				$escuelas[$key]->latitud = $escuela->latitud;
				$escuelas[$key]->longitud = $escuela->longitud;
				$escuelas[$key]->nombre = $this->capitalize($escuela->nombre);
				$escuelas[$key]->localidad = $this->capitalize($escuela->localidad->nombre);
				$escuelas[$key]->entidad = $this->capitalize($escuela->entidad->nombre);
				$escuelas[$key]->nivel = $this->capitalize($escuela->nivel->nombre);
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
    private function get_scales(){
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
		$scales[15] = 613;
		$scales[16] = 307;
		$scales[17] = 153;
		$scales[18] = 77;
		$scales[19] = 38;
		return $scales;
    }

}
?>