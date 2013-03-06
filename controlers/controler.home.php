<?php
class home extends main{
	public function index(){
		set_time_limit(10000);
		//$this->import_states();
		//$this->import_locales()

		$this->loop_tables();
	}

	private function import_locales(){
		$handle = $this->open_file('escuelas.txt');
		$localidad =  new localidad();
		$localidad->debug = true;
		$states = array();
		if($handle){
			$i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				if (!isset($states[$row[11]]) || !isset($states[$row[11]] [$row[9]]) || !isset($states[$row[11]][$row[9]][$row[7]]) ) {
					$q = new county();
					$q->debug = true;
					$q->search_clause = "municipios.state_id = {$row[9]} AND municipios.entidad = {$row[11]}";
					$county = $q->read('id');
					$localidad->create('municipio,nombre,entidad,localidad',array($county[0]->id,$row[8],$row[11],$row[7]));
					$states[$row[11]][$row[9]][$row[7]]->id = $localidad->id;
					$states[$row[11]][$row[9]][$row[7]]->count = 1;
					//break;
				}else{
					$states[$row[11]][$row[9]][$row[7]]->count++;
					//if($counties[$row[9]]->count == 200) break;
				}
				//if($i++ == 100) break;
			}
			//var_dump($states);
			foreach($states as $state){	
				foreach($state as $county){
					foreach($county as $localidad){
						$count = $localidad->count;
						$localidad = new localidad($localidad->id);
						$localidad->debug = true;
						$localidad->update('cct_count',array($count));
					}
				}
			}
			fclose($handle);
		}else{
			'open fail';
		}

	}

	private function import_counties(){
		$handle = $this->open_file('escuelas.txt');
		$county =  new county();
		$county->debug = true;
		$states = array();
		if ($handle){
			$i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				if(!isset($states[$row[11]]) || !isset($states[$row[11]][$row[9]])){
					$county->create('state_id,nombre,entidad',array($row[9],$row[10],$row[11]));
					$states[$row[11]][$row[9]]->id = $county->id;
					$states[$row[11]][$row[9]]->count = 1;
					//break;
				}else{
					$states[$row[11]][$row[9]]->count++;
					//if($counties[$row[9]]->count == 200) break;
				}
				//if($i++ == 200) break;
			}
			//var_dump($states);
			foreach($states as $state){	
				foreach($state as $county){
					$count = $county->count;
					$county = new county($county->id);
					$county->debug = true;
					$county->update('cct_count',array($count));
				}
			}
			fclose($handle);
		}else{
			'open fail';
		}

	}

	private function import_schools(){
		$handle = $this->open_file('escuelas.txt');
		if ($handle){
			$i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				var_dump($row);
				if($i++ == 200) break;
			}
			fclose($handle);
		}else{
			'open fail';
		}
	}
	private function import_states(){
		$handle = $this->open_file('escuelas.txt');
		$state =  new state();
		$state->debug = true;
		$states = array();
		if ($handle){
			$i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				if(!isset($states[$row[11]])){
					$state->create('id,nombre',array($row[11],$row[12]));
					//$states[$row[11]]
					$states[$row[11]] = 1;
					//break;
				}else{
					$states[$row[11]]++;
					//if($states[$row[11]]->count == 200) break;
				}
			}
			foreach($states as $key => $count){
				$state = new state($key);
				$state->debug = true;
				$state->update('cctt_count',array($count));
			}
			fclose($handle);
		}else{
			'open fail';
		}

	}
	
	private function open_file($file){
		return fopen($_SERVER['DOCUMENT_ROOT']."/files/$file", "r");
	}
	private function clean_row($row){
		foreach($row as $key => $cell) $row[$key] = $cell == 'NO ESPECIFICADO' ? '' : $cell;
		return $row;
	}
	
	private function loop_tables(){
		$file_names = Array("niveles", "subniveles", "servicios", "modalidades", "controles", "subcontroles", "sostenimientos", "statuses");
		$arrlength = count($file_names);
		
		foreach($file_names as $name)
		{
			$sql = "
			CREATE TABLE IF NOT EXISTS $name (`id` int(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cct_count` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
";
			mysql_query($sql);
		

		}
	}
}
?>