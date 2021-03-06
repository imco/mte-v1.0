<?php

/**
* Clase import Extiende main.
*/
class import extends main{

	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		set_time_limit(10000000);
		//$this->import_teachers();
		//$this->import_percents();
		//$this->import_percents_manual();
		//$this->import_states();
		//$this->import_locales()
		//$this->check_nl();
		//$this->loop_tables();
		//$this->import_generic("tipo",27,28);
		//$this->get_latitudes();
// 		$this->enlaces();
//		$this->import_no_confiables();
		//$this->count_enlaces(31);
		//$this->average_enlaces(22,1);
// 		$this->update_schools();
// 		$this->update_counties();
// 		$this->update_locales();
// 		$this->update_pruebas_totales_enlace();
		$this->complete_extentions();

	}

	/*
	* Funcion Privada complete_extentions.
	*/
	private function complete_extentions(){
		$q = new escuela();
		$q->search_clause = "control = '0'";
		$q->debug = true;
		$escuelas = $q->read('cct,nombre,subcontrol,nivel');
		//var_dump(count($escuelas));
		$e = $ne = 0;
		foreach($escuelas as $escuela){
			if(strlen($escuela->cct) == 11){
				$e++;
				$parent = new $escuela(substr($escuela->cct,0,10));
				//$parent->debug = true;
				$parent->read('control=>id,subcontrol=>id,tipo=>id,subnivel=>id,servicio=>id,modalidad=>id,sostenimiento=>id,status=>id');
				$escuela = new escuela($escuela->cct);
				$escuela->debug = true;
				$escuela->update('control,subcontrol,tipo,subnivel,servicio,modalidad,sostenimiento,status',
				array($parent->control->id,$parent->subcontrol->id,$parent->tipo->id,$parent->subnivel->id,$parent->servicio->id,$parent->modalidad->id,$parent->sostenimiento->id,$parent->status->id));
			}else{
				$ne++;
			}
		}
		var_dump($e,$ne);
	}

	/*
	* Funcion Privada import_percents_manual.
	*/
	private function import_percents_manual(){
		$sql = 'SELECT cct, SUM(  alumnos_en_nivel0_espaniol ) , SUM(  alumnos_en_nivel0_matematicas ) , SUM(  alumnos_que_contestaron_total ) 
		FROM  enlaces 
		WHERE anio =  "2013"
		AND nivel =  "secundaria"
		GROUP BY cct';
		$results = mysql_query($sql);
		$i = 0;
		while($row = mysql_fetch_row($results)){
			$pct = ($row[1] + $row[2]) / 2 / $row[3];
			$escuela = new escuela($row[0]);
			$escuela->debug = true;
			$escuela->update('pct_reprobados,total_evaluados',array($pct,$row[3]));
			$i++;
		}
		echo "<br/>$i records updated";
	}

	/*
	* Funcion Privada import_percents.
	*/
	private function import_percents(){
		$handles = scandir($this->config->document_root.'/files/2013stats/');
		var_dump($handles);
		//exit;
		$handle = $this->open_file("/2013stats/".$handles[$this->get('id')]);
		$i = 0;
		if($handle){
			while (($row = fgetcsv($handle,0, ",")) !== FALSE){				
				//var_dump($row);
				//exit;
				if($i != 0){
					$rep = ($row[17] *.5)+($row[13] * .5);

					/*if($row[1] == '09PES0942C'){
						var_dump($row);
						var_dump($rep);
						exit;	
					}*/
					
					//var_dump($row[17],$row[13],$rep);
					$escuela = new escuela($row[1]);
					$escuela->debug = true;
					$escuela->update('pct_reprobados',array($rep));
					//exit;
				}
				$i++;
			}
			echo "$i records updated";
		}
	}

	/*
	* Funcion Privada import_teachers.
	*/
	private function import_teachers(){
			$id = $this->get('id');
			$maestro = new maestro();

			if($id !== false){
				$handles = scandir($this->config->document_root.'/files/maestros');
				//var_dump($handles);
				$handle = $this->open_file("/maestros/".$handles[$id]);
				if($handle){
					$i = 0;
					$egreso = new egreso_nomina();
					while (($row = fgetcsv($handle,0, "|")) !== FALSE){
						//$egreso->debug = true;
						if($i != 0){
							$egreso->create('clave_trabajador,rfc,cct,entidad,fuente,clave_tipo_nomina,division,pago,clave_presupuestal,descripcion_categoria,tipo_funcion_plaza,id_plaza,horas,trimestre1,trimestre2,trimestre3,trimestre4',
								array(
									$row[0],$row[7],$row[2],$row[1],$row[3],$row[4],$row[5],$row[6],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16]
								)
							);
						}
						$i++;
					}
					echo "imported $i records";
				}
			}
	}
	
	/*
	* Funcion Publica average_enlaces.
	* \param $nivel
	*/
	public function average_enlaces($nivel = false){
		$nivel = $this->get('id');
		$this->start_measure_time();
		if($this->get('id') !== false){
			$id = $this->get('id');
			$limit_start = $id * 10000;
			$limit_end = ($id+1) * 10000;
			$limit = "LIMIT $limit_start, $limit_end";
		}else{
			$limit = '';
		}
		$sql = "UPDATE escuelas SET promedio_general = NULL,grados = NULL,promedio_matematicas = NULL,promedio_espaniol = NULL,total_evaluados = NULL WHERE 1";
		$sql = "SELECT cct,nombre FROM escuelas WHERE nivel = '$nivel' && cct = '09DBN0007I'";//" OR nivel = '13' or nivel = '22' or nivel = '21'";
		echo $sql;

		$result = mysql_query($sql);
		$i = 0;
		$q = new enlace();
		while($row = mysql_fetch_assoc($result)){
			$q->search_clause = 'cct = "'.$row['cct'].'" AND anio = "2013"';
			$enlaces = $q->read('id,anio,nivel,grado,turnos,puntaje_espaniol,puntaje_matematicas,puntaje_geografia,alumnos_que_contestaron_total');
			if(count($enlaces)){
				//$i++;
				$grados = $sum_spa = $sum_mat = $sum_geo = 0;
				$escuela = new escuela($row['cct']);
				$alumnos_total = 0;
				foreach($enlaces as $enlace){
					//var_dump($enlace);
					if($enlace->alumnos_que_contestaron_total != 0 && ($enlace->puntaje_espaniol != 0 && $enlace->puntaje_matematicas != 0)){
						$grados++;
						$sum_spa += $enlace->puntaje_espaniol;
						$sum_mat += $enlace->puntaje_matematicas;
						$alumnos_total += $enlace->alumnos_que_contestaron_total;
					}
				}
				//if($grados < $std_grados){
					$escuela->debug = true;
					$prom_mat = $sum_mat / $grados;
					$prom_spa = $sum_spa / $grados;
					$gen = ($prom_spa * .2) + ($prom_mat *.8);
					$escuela->update('grados,promedio_matematicas,promedio_espaniol,promedio_general,total_evaluados',array($grados,$prom_mat,$prom_spa,$gen,$alumnos_total));
					$i++;
				//}
				//if($i == 20) exit;
			}
		}
		$this->stop_measure_time();
		echo $i.' records updated';
	}

	/*
	* Funcion Privada count_enlaces.
	* \param $nivel
	*/
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

	/*
	* Funcion Privada get_latitudes.
	*/
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

	/*
	* Funcion Privada update_schools.
	*/
	private function update_schools(){
		header('Content-Type: text/html;charset=ISO-8859-1');
		$handle = $this->open_file('escuelas.csv');
		if ($handle){
			$nocount = $i = 0;
			/*
				$row[1] = nombre
				$row[2] = domicilio
				$row[3] = entrecalle
				$row[4] = ycalle
			*/
			while (($row = fgetcsv($handle,0, "|")) !== FALSE){
				$row = $this->clean_row($row);
				$nombre = $this->character($row[1]);//nombre
				$domicilio = $this->character($row[2]);//domicilio
				$entrecalle = $this->character($row[3]);//entrecalle
				$ycalle = $this->character($row[4]);//ycalle
				if($nombre->e || $domicilio->e || $entrecalle->e || $ycalle->e){
					echo $row[0].'<br />';
					$escuela = new escuela($row[0]);
					$escuela->debug = false;
					$escuela->update('nombre,domicilio,entrecalle,ycalle',array($nombre->s,$domicilio->s,$entrecalle->s,$ycalle->s));
				}
			}
		}
	}

	/*
	* Funcion Privada check_nl.
	*/
	private function check_nl(){ 
		$handle = $this->open_file('escuelas.csv');
		if ($handle){
			$nocount = $i = 0;
			$escuela = new escuela();
			//$escuela->debug = true;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE){
				if($row[11] == '019' && $row[29] == '12' && $row[37] == 2){
					var_dump($row);
					$i++;
				}
			}
			echo $i;
		}
	}

	/*
	* Funcion Privada import_schools.
	*/
	private function import_schools(){ 
		$handle = $this->open_file('escuelas.csv');
		if ($handle){
			$nocount = $i = 0;
			$escuela = new escuela();
			//$escuela->debug = true;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
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

	/*
	* Funcion Privada character.
	* \param $s
	*/
	private function character($s){
		$len = strlen($s);
		$s2 = array();
		$e = false;
		$j = false;
		for($i = 0;$i < $len;$i++){
			if(ord($s[$i])==165 || ord($s[$i])== 164){//Ñ
				$s2[$i] = 'Ñ';
				$e = true;
			}elseif(ord($s[$i]) == 181){ //Á
				$s2[$i] = 'Á';
				$e = true;
			}elseif(ord($s[$i]) == 144){ //É
				$s2[$i] = 'É';
				$e = true;
			}elseif(ord($s[$i]) == 214){ //Í
				$s2[$i] = 'Í';
				$e = true;
			}elseif(ord($s[$i]) == 224){ //Ó
				$s2[$i] = 'Ó';
				$e = true;
			}elseif(ord($s[$i]) == 154){ //Ü
				$s2[$i] = 'Ü';
				$e = true;
			}elseif(ord($s[$i]) > 127){
				$s2[$i] = $s[$i];
				$e = true;
				$j = true;
			}else{
				$s2[$i] = $s[$i];
			}
		}
		$s3 = implode('',$s2);
		if($j){
			echo 'UNKNOW: '.$s3.'<br />';
		}
		$info->s = $s3;
		$info->e = $e;
		return $info;
	}

	/*
	* Funcion Privada update_locales.
	*/
	private function update_locales(){
		$handle = $this->open_file('escuelas.csv');
		$localidad =  new localidad();
		$localidad2 =  new localidad();
		$localidad->debug = true;
		$states = array();
		if($handle){
			$i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);

				if (!isset($states[$row[11]]) || !isset($states[$row[11]] [$row[9]]) || !isset($states[$row[11]][$row[9]][$row[7]]) ) {
					$q = new municipio();
					$q->debug = false;
					$q->search_clause = "municipios.municipio = {$row[9]} AND municipios.entidad = {$row[11]}";
					$county = $q->read('id');
// 					$localidad->create('municipio,nombre,entidad,localidad',array($county[0]->id,$row[8],$row[11],$row[7]));
// 					$states[$row[11]][$row[9]][$row[7]]->id = $localidad->id;
					$states[$row[11]][$row[9]][$row[7]]->localidad = $row[7];
					$states[$row[11]][$row[9]][$row[7]]->entidad = $row[11];
					$states[$row[11]][$row[9]][$row[7]]->municipio = $county[0]->id;
					$states[$row[11]][$row[9]][$row[7]]->count = 1;
					$states[$row[11]][$row[9]][$row[7]]->nombre = $row[8];
				}else{
					$states[$row[11]][$row[9]][$row[7]]->count++;
				}
			}
			foreach($states as $state){	
				foreach($state as $county){
					foreach($county as $localidad){
						$info = $this->character($localidad->nombre);
						if($info->e){
							$localidad2->search_clause = "localidad = '{$localidad->localidad}'
								AND entidad = {$localidad->entidad}
								AND municipio = '{$localidad->municipio}'
								AND cct_count = '{$localidad->count}'"; 
							$localidad2s = $localidad2->read('id,nombre');
							echo $localidad2s[0]->id.' / '.$localidad->nombre.' / '.$info->s.'<br />';
							if(isset($localidad2s[0]->id)){
								$localidad3 = new localidad($localidad2s[0]->id);
								$localidad3->debug = false;
								$localidad3->update('nombre',array($info->s));
							}
						}
					}
				}
			}	
			fclose($handle);
		}else{
			'open fail';
		}
	}

	/*
	* Funcion Privada import_locales.
	*/
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

	/*
	* Funcion Privada update_counties.
	*/
	private function update_counties(){
		$handle = $this->open_file('escuelas.csv');
		$county =  new municipio();
		$county2 =  new municipio();
		$county->debug = true;
		$states = array();
		if ($handle){
			$i = 0;
			while (($row = fgetcsv($handle,0, "|")) !== FALSE) {
				$row = $this->clean_row($row);
				if(!isset($states[$row[11]]) || !isset($states[$row[11]][$row[9]])){
					$states[$row[11]][$row[9]]->municipio = $row[9];
					$states[$row[11]][$row[9]]->entidad = $row[11];
					$states[$row[11]][$row[9]]->nombre = $row[10];
					$states[$row[11]][$row[9]]->count = 1;
				}else{
					$states[$row[11]][$row[9]]->count++;
				}
			}
			foreach($states as $state){
				foreach($state as $county){
					$info = $this->character($county->nombre);
					if($info->e){
						$county2->debug = true;
						$county2->search_clause = "municipio = '{$county->municipio}' 
								AND entidad = '{$county->entidad}' 
								AND cct_count = '{$county->count}'";
						$county2s = $county2->read('id,nombre');
						echo $county2s[0]->nombre.' ';
						echo $county->municipio.' / '.$county->entidad.' / '.$county->nombre.' / '.$county->count.'<br />';
						echo '<br />';
						if(isset($county2s[0]->id)){
							$county3 = new municipio($county2s[0]->id);
							$county3->update('nombre',array($info->s));
						}
					}
				}
			}
			fclose($handle);
		}else{
			'open fail';
		}
	}

	/*
	* Funcion Privada import_counties.
	*/
	private function import_counties(){
		$handle = $this->open_file('escuelas.csv');
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
					$states[$row[11]][$row[9]]->nombre = $row[10];
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

	/*
	* Funcion Privada import_states.
	*/
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

	/*
	* Funcion Privada import_generic.
	*/
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
	
	/*
	* Funcion Privada open_file.
	*/
	private function open_file($file){
		return fopen($_SERVER['DOCUMENT_ROOT']."/files/$file", "r");
	}

	/*
	* Funcion Privada clean_row.
	*/
	private function clean_row($row){
		foreach($row as $key => $cell) $row[$key] = $cell == 'NO ESPECIFICADO' ? '' : $cell;
		return $row;
	}
	
	/*
	* Funcion Privada loop_tables.
	*/
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

	/*
	* Funcion Privada import_colonias.
	*/
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

	/*
	* Funcion Privada import_no_confiables.
	*/
	private function import_no_confiables(){
		$handle = $this->open_file('escuelasNoConfiables.csv');
		if($handle){
			$i = 0;
			while(($row = fgetcsv($handle,0, ";")) !== FALSE) {
				$cct = $row[2];
				$poco_conbiable = $row[74];
				$total_evaluado = $row[79];
				$escuela = new escuela($cct);
				$escuela->read('cct,poco_confiables,total_evaluados');
				if($escuela){
					if(isset($escuela->poco_confiables) && isset($escuela->total_evaluados)){
						$_poco_confiables_ =  ($escuela->poco_confiables + $poco_conbiable);
						$_total_evaluados_ = ($escuela->total_evaluados + $total_evaluado);
						$escuela->update('poco_confiables,total_evaluados',array($_poco_confiables_,$_total_evaluados_));
					}else{
						echo $cct.' isset<br />';
					}
				}else{
					echo $cct.' else<br />';
				}
				$i++;
				
			}
			echo $i.'<br />';
		}
	}

	/*
	* Funcion Privada update_pruebas_totales_enlace.
	*/
	private function update_pruebas_totales_enlace(){
		//secundarias y preparatorias
		$enlace = new enlace();
		$enlace->debug = true;
		$enlace->search_clause = "nivel = 'secundaria' || nivel = 'bachillerato'";
		$per_page = 10000;
		$enlaceP = new pagination('enlace',$per_page,$enlace->search_clause);
		$document_pages = $enlaceP->document_pages;
		$query = "SELECT COUNT(1) as total FROM enlaces WHERE {$enlace->search_clause};";
		$result = $enlace->ExecuteReturnObject($query);
		$total_items = $result[0]->total;
		echo 'document_pages: '.$document_pages.'<br />';
		echo 'total_items: '.$total_items.'<br />';
		for($i = 1; $i <= $document_pages;$i++){
			$start =  ($i-1)*$per_page;
			$end = $per_page;
			$limit = ($total_items > $per_page) ? "$start, $end" : false;
			$enlace->limit = $limit;
			$enlaces = $enlace->read("cct,alumnos_que_contestaron_total");
			if($enlaces){
				foreach($enlaces as $e){
					$escuela = new escuela($e->cct);
					$escuela->read('total_evaluados');
					$total_evaluados = $escuela->total_evaluados + $e->alumnos_que_contestaron_total;
					$escuela->update('total_evaluados',array($total_evaluados));
				}
			}
			unset($enlaces);

		}		
	}
}
?>