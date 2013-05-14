<?php
class import extends main{
	public function index(){
		set_time_limit(100000);
		//$this->import_states();
		//$this->import_locales()
		//$this->import_schools();
		//$this->loop_tables();
		//$this->import_generic("tipo",27,28);
		//$this->get_latitudes();
		//$this->count_enlaces(31);
		$this->average_enlaces(21,1);

	}
	private function average_enlaces($nivel,$grados){
		$this->start_measure_time();
		$sql = "SELECT cct,nombre FROM escuelas WHERE nivel = '$nivel'";//" OR nivel = '13' or nivel = '22' or nivel = '21'";
		$result = mysql_query($sql);
		$i = 0;
		while($row = mysql_fetch_assoc($result)){
			$q = new enlace();
			$q->search_clause = 'cct = "'.$row['cct'].'" AND anio = "2012"';
			$enlaces = $q->read('id,anio,nivel,grado,turnos,puntaje_espaniol,puntaje_matematicas,puntaje_geografia');
			if(count($enlaces) == $grados){
				$i++;
				$sum_spa = $sum_mat = $sum_geo = 0;
				$escuela = new escuela($row['cct']);
				foreach($enlaces as $enlace){
					$sum_spa += $enlace->puntaje_espaniol;
					$sum_mat += $enlace->puntaje_matematicas;
					$sum_geo += $enlace->puntaje_geografia;
				}
				$prom_gen = ($sum_spa+$sum_mat)/($grados*2);
				//$escuela->debug = true;
				$escuela->update('promedio_espaniol,promedio_matematicas,promedio_geografia,promedio_general',array($sum_spa/$grados,$sum_mat/$grados,$sum_geo/$grados,$prom_gen));
			}
		}
		echo $i.' records updated';
	}
	private function count_enlaces($nivel){
		$this->start_measure_time();
		$sql = "SELECT cct,nombre FROM escuelas WHERE nivel = '$nivel'";//" OR nivel = '13' or nivel = '22' or nivel = '21'";
		$result = mysql_query($sql);
		$i = 0;
		$totals = array(0,0,0,0,0);
		while($row = mysql_fetch_assoc($result)){
			$q = new enlace();
			$q->search_clause = 'cct = "'.$row['cct'].'" AND anio = "2012"';
			//$q->debug = true;
			$enlaces = $q->read('id,anio,nivel,grado,turnos,puntaje_espaniol,puntaje_matematicas');
			$totals[count($enlaces)]++;
			//if($i++ == 15) break;
		}
		var_dump($totals);
	}
	private function get_latitudes(){
		$q = new localidad();
		$q->search_clause = "1";
		$q->debug = true;
		$q->limit = "0,3";
		$localidades = $q->read('id,nombre');
		foreach ($localidades as $localidad) {
			$localidad->debug =  true;
			$localidad->read("escuelas=>cct,escuelas=>latitud,escuelas=>longitud,escuelas=>nombre");
			foreach($localidad->escuelas as $escuela){
				echo $escuela->nombre." ".$escuela->latitud." ".$escuela->longitud."<br>";

			}
		}	


	}
	private function import_schools(){
		$handle = $this->open_file('escuelas.txt');
		if ($handle){
			$nocount = $i = 0;
			$escuela = new escuela();
			//$escuela->debug = true;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				//var_dump($row);
				$q = new municipio();
				$q->search_clause = "municipios.municipio = '{$row[9]}' AND municipios.entidad = '{$row[11]}' ";
				$r = $q->read('id,nombre');
				$municipio = $r[0];
				$q = new localidad();
				$q->search_clause = "localidades.municipio = '{$municipio->id}' AND localidades.localidad = '{$row[7]}'";
				$r = $q->read('id,nombre');
				$localidad = $r[0];
				$result = $escuela->create('cct,nombre,domicilio,entrecalle,ycalle,localidad,municipio,entidad,codigopostal,telefono,telextension,fax,faxextension,correoelectronico,paginaweb,turno,sector,cct_sector,altitud,longitud,latitud,tipo,nivel,subnivel,servicio,modalidad,control,subcontrol,sostenimiento,status',
				array(
					$row[0],$row[1],$row[2],$row[3],$row[4],
					$localidad->id,
					$municipio->id,
					$row[11],
					$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],
					$row[22],$row[23],$row[24],$row[25],$row[26],$row[27],
					$row[29],
					$row[31],
					$row[33],
					$row[35],
					$row[37],
					$row[39],
					$row[41],
					$row[43]
				));
				$i++;
				if(!$result){
					var_dump($i,$row);
					break;
				};
				//if($i++ == 20) break;
			}
			//echo "empty $nocount <br/>";
			fclose($handle);
		}else{
			'open fail';
		}
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
					$q->search_clause = "municipios.municipio = {$row[9]} AND municipios.entidad = {$row[11]}";
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
	private function import_generic($object,$id_field,$name_field){
		$handle = $this->open_file('escuelas.txt');
		$object =  new $object();
		$object->debug = true;
		$objects = array();
		if ($handle){
			$noid = $i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				//var_dump()
				//var_dump($row[$id_field]);
				if($row[$id_field] != ""){
					if(!isset($objects[$row[$id_field]])){
						$object->create("id,nombre",array($row[$id_field],$row[$name_field]));
						$objects[$row[$id_field]] = 1;
						//break;
					}else{
						$objects[$row[$id_field]]++;
					}
			
				}else{
					//echo "no id ";
					$noid++;
				}
				//if($i++ == 20) break;
			}
			foreach($objects as $key => $count){
				$object = new $object($key);
				$object->debug = true;
				$object->update('cct_count',array($count));
			}
			var_dump('noid',$noid);
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
		$file_names = Array("turnos");
		$arrlength = count($file_names);
		
		foreach($file_names as $name){
			$sql = "
				CREATE TABLE IF NOT EXISTS $name (
					`id` int(20) NOT NULL,
					`nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
					`cct_count` int(20) NOT NULL,
					PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
			";
			mysql_query($sql);
		}
	}
	private function import_colonias(){
		$handle = $this->open_file('escuelas.txt');
		$colonia = new colonia();
		$colonia->debug = true;
		$states = array();
		if($handle){
			$i = 0;
			while(($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				if ($row[5] != ""){
					if (!isset($states[$row[11]]) || !isset($states[$row[11]] [$row[9]]) || !isset($states[$row[11]][$row[9]][$row[7]]) || !isset($states[$row[11]][$row[9]][$row[7]][$row[5]]) ) {
						$q = new municipio();
						$q->debug = true;
						$q->search_clause = "municipios.municipio = {$row[9]} AND municipios.entidad = {$row[11]}";
						$county = $q->read('id');
						$q = new localidad();
						$q->search_clause= "localidades.municipio = {$county[0]->id} AND localidades.localidad = {$row[7]}";
						$localidad = $q->read("id");
						$colonia->create('colonia,nombre,municipio,entidad,localidad',array($row[5],$row[6],$county[0]->id,$row[11],$localidad[0]->id));
						$states[$row[11]][$row[9]][$row[7]][$row[5]]->id = $colonia->id;
						$states[$row[11]][$row[9]][$row[7]][$row[5]]->count = 1;
					}else{
						$states[$row[11]][$row[9]][$row[7]][$row[5]]->count++;
						//if($counties[$row[9]]->count == 200) break;
					}
					//if($i++ == 100) break;
				}
			}
			//var_dump($states);
			foreach($states as $state){
					foreach($state as $county){
						foreach($county as $localidad){
							foreach($localidad as $colonia){
								$count = $colonia->count;
								$colonia = new colonia($colonia->id);
								$colonia->debug = true;
								$colonia->update('cct_count',array($count));
							}
						}
					}
				}
				fclose($handle);
			}else{
				'open fail';
			}

	}

}
?>