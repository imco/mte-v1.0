<?php
class resultados_nacionales extends main{
	public function index(){		
		$this->load_entidades('rank ASC');	
		$this->breadcrumb = array('#'=>'Resultados Nacionales');
		$this->header_folder = 'compara';
		$this->title_header = 'Resultados por estado';
		$this->subtitle_header = 'Revisa los resultados educativos de tu estado y cómo se comparan con el<br />promedio nacional.  En el perfil de tu estado también podrás <br />encontrar tablas de las mejores escuelas primarias, <br />secundarias y bachilleratos.';
		$this->include_theme('index','index');
	}
	public function entidad(){
		$this->draw_charts = false;
		if($this->get('id')){
			$this->load_entidades();
			$this->entidad = new entidad($this->get('id'));
			$this->entidad->read('id,nombre,rank,cct_count,promedio_general,promedio_espaniol,promedio_matematicas,distribucion_primarias,distribucion_secundarias,distribucion_bachilleratos,primaria_espaniol,primaria_matematicas,primaria_general,secundaria_espaniol,secundaria_matematicas,secundaria_general,bachillerato_espaniol,bachillerato_matematicas,bachillerato_general,escuelas_totales,escuelas_evaluadas,escuelas_publicas,escuelas_privadas,promedio_matematicas_publicas,promedio_espaniol_publicas,promedio_matematicas_privadas,promedio_espaniol_privadas,numero_escuelas_primaria,numero_escuelas_secundaria,numero_escuelas_bachillerato,promedio_nacional_matematicas_primaria,promedio_nacional_espaniol_primaria,promedio_nacional_matematicas_secundaria,promedio_nacional_espaniol_secundaria,promedio_nacional_matematicas_bachillerato,promedio_nacional_espaniol_bachillerato,promedio_nacional_general');
			$this->breadcrumb = array('/resultados-nacionales'=>'Resultados Nacionales','#' => $this->capitalize($this->entidad->nombre));
			//$this->initialize_histograms();
			$this->header_folder = 'compara';
			$this->title_header = 'Busca tu estado';

			//$this->load_petition();
			$this->load_escuelas();
			$this->petition_data = $this->load_estado_petitions($this->entidad->nombre);
			$this->include_theme('index','entidad');
		}else{
			$this->index();
		}
	}

	private function load_escuelas(){
		$niveles = array(12,13,22);
		$this->mejores_escuelas = array();
		for($i=0;$i<count($niveles);$i++){
			$params->entidad = $this->entidad->id;
			//$params->order_by = ' ISNULL(escuelas.rank_nacional), escuelas.rank_nacional ASC, escuelas.rank_entidad DESC';
			$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC';
			$params->limit = '0,5';
			$params->nivel = $niveles[$i];
			$this->get_escuelas($params);
			$this->process_escuelas();
			$this->mejores_escuelas[] = $this->escuelas_digest->escuelas;
		}
	}

	private function initialize_histograms(){
		//primarias
		if($this->entidad->distribucion_primarias == ''){
			$data = $this->histogram($this->entidad->id,12);
			$this->entidad->update('distribucion_primarias',array(json_encode($data)));
			$this->entidad->distribucion_primarias = $data;
		}
		//secundarias
		if($this->entidad->distribucion_secundarias == ''){
			$data = $this->histogram($this->entidad->id,13);
			$this->entidad->update('distribucion_secundarias',array(json_encode($data)));
			$this->entidad->distribucion_secundarias = $data;
		}
		//prepas
		if($this->entidad->distribucion_bachilleratos == ''){
			$data = $this->histogram($this->entidad->id,22);
			$this->entidad->update('distribucion_bachilleratos',array(json_encode($data)));
			$this->entidad->distribucion_bachilleratos = $data;
		}
	}
	private function histogram($entidad,$nivel){
		set_time_limit(100000);
		$sql = "SELECT cct,nombre,promedio_general FROM escuelas WHERE nivel = '$nivel' AND entidad = '$entidad' AND promedio_general IS NOT NULL";//" OR nivel = '13' or nivel = '22' or nivel = '21'";
		$result = mysql_query($sql);
		$data = array();
		for($i = 0;$i<901;$i++){
			$data[$i][0] = $i;
			$data[$i][1] = 0;
		}
		$i = 0;
		while($row = mysql_fetch_assoc($result)){
			$data[round($row['promedio_general'])][1]++;
		}
		return $data;	
	}
	/*
	private function load_petition(){
		date_default_timezone_set('America/Mexico_City');
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$petition_info = $change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela');
		$this->petition_data = array();
		foreach($petition_info as $petition){
			$regExp = "/".$this->entidad->nombre."/i";
			if(preg_match($regExp, $petition['title'])){
				$this->petition_data[] = $petition;
			}
		}
	
	}
	*/
}
?>
