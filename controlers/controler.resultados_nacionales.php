<?php
class resultados_nacionales extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->load_entidades();
		$this->include_theme('index','index');
	}
	public function entidad(){
		$this->draw_charts = true;
		
		if($this->get('id')){
			$this->header_folder ='escuelas';
			$this->load_entidades();
			$this->entidad = new entidad($this->get('id'));
			$this->entidad->read('id,nombre,cct_count,distribucion_primarias,distribucion_secundarias,distribucion_bachilleratos');
			$this->initialize_histograms();
			$this->include_theme('index','entidad');
		}else{
			$this->index();
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
	public function histogram($entidad,$nivel){
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
}
?>
