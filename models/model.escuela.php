<?php
class escuela extends table{
	function info(){
		$this->table_name = "escuelas";
		$this->key = 'cct';
		$this->objects['localidad'] = 'localidad';
		$this->objects['entidad'] = 'entidad';
		$this->objects['municipio'] = 'municipio';
		$this->objects['nivel'] = 'nivel';
		$this->objects['turno'] = 'turno';
		$this->objects['tipo'] = 'tipo';
		$this->objects['subnivel'] = 'subnivel';
		$this->objects['servicio'] = 'servicio';
		$this->objects['control'] = 'control';
		$this->objects['subcontrol'] = 'subcontrol';
		$this->objects['sostenimiento'] = 'sostenimiento';
		$this->objects['status'] = 'status';

		$this->has_many['enlaces'] = 'enlace';
		$this->has_many_keys['enlaces'] = 'cct';

		$this->has_many['calificaciones'] = 'calificacion';
		$this->has_many_keys['calificaciones'] = 'cct';

		$this->has_many['reportes_ciudadanos'] = 'reporte_ciudadano';
		$this->has_many_keys['reportes_ciudadanos'] = 'cct';

		$this->semaforos = array('Reprobado','De Panzazo','Bien','Excelente','Sin Enlace','Poco confiable');
		#$this->semaforo_rangos[12] = array(433,524,615,900);
		$this->semaforo_rangos[12] = array(559,601,662,900);
		$this->semaforo_rangos[13] = array(511,544,591,900);
		$this->semaforo_rangos[22] = array(551,580,632,900);
		$this->semaforo_poco_confiable = 10;

	}
	function get_semaforo(){
		$this->semaforo = 4;
		$porcentaje_poco_confiable = $this->poco_confiables > 0 && $this->total_evaluados > 0?($this->poco_confiables * 100) / $this->total_evaluados:0;
		$this->porcentaje_poco_confiable = number_format($porcentaje_poco_confiable,2);
		$turnos = isset($this->turno->num) ? $this->turno->num : 1;

		if(isset($this->grados) && $this->grados>0 ){
			echo 'entro 1';exit;
			if($this->nivel->nombre != "BACHILLERATO"  && ($this->grados < 4 * $turnos && $this->nivel->nombre == "PRIMARIA") || ($this->grados < 3 * $turnos && $this->nivel->nombre == "SECUNDARIA") ){
				$this->semaforo = 6;//no se cuentan
			}else if($porcentaje_poco_confiable > 0 && $porcentaje_poco_confiable >= $this->semaforo_poco_confiable){
				$this->semaforo = 5;//no confiables
			}elseif( $promedio_general > 0){
				var_dump( $promedio_general, $semaforo_rangos[$nivel_id][0] );
				if( $promedio_general < $semaforo_rangos[$nivel_id][0]){
					$this->semaforo=0;
				}elseif( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][1] ){
					$this->semaforo = 1;
				}elseif( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][2] ){
					$this->semaforo = 2;
				}else
					$this->semaforo = 3;
			}
		}
/*
		if(isset($this->grados) && $this->grados>0 ){
			if( $this->nivel->nombre != "BACHILLERATO"  && ($this->grados < 4 * $turnos && $this->nivel->nombre == "PRIMARIA") || ($this->grados < 3 * $turnos && $this->nivel->nombre == "SECUNDARIA") ){
				$this->semaforo = 6;
			}else if($porcentaje_poco_confiable > 0 && $porcentaje_poco_confiable >= $this->semaforo_poco_confiable){
				$this->semaforo = 5;
			}else if(isset($this->semaforo_rangos[$this->nivel->id]) && $this->promedio_general > 0){
				while($this->promedio_general > $this->semaforo_rangos[$this->nivel->id][$this->semaforo])$this->semaforo++;
			}
		}*/
	}
	function rank($nivel,$entidad = false,$municipio = false){
		$entidad_clause = $entidad ? " AND entidad LIKE '$entidad'" : '';
		$sql = "SET @rownum = 0, @rank = 0, @prev_val = NULL; ";
		mysql_query($sql);
		$sql = "UPDATE escuelas t1
				JOIN (
				SELECT @rownum := @rownum + 1 AS row,
				@rank := IF(@prev_val!=promedio_general,@rownum,@rank) AS rank,
				@prev_val := promedio_general AS promedio_general,
				cct
				FROM escuelas
				WHERE nivel LIKE '$nivel' $entidad_clause AND `promedio_general` IS NOT NULL
				ORDER BY promedio_general DESC) t2
				ON t1.cct=t2.cct
				SET t1.rank_entidad=t2.rank;";
		return mysql_query($sql);		
	}
	function get_chart($materia){
		$grados = array();
		$enlaces = array();
		$puntaje_name = 'puntaje_'.$materia;
		if(isset($this->enlaces) && $this->enlaces){
			$variable = array();
			foreach($this->enlaces as $enlace){
				$enlaces[$enlace->anio][$enlace->grado] = $enlace->$puntaje_name;
				$grados[$enlace->grado] = $enlace->grado;
			}
			ksort($enlaces);
			$grados = array_values($grados);
			sort($grados);
			$keys = array_flip($grados);
			array_unshift($grados,'Año');
			$variable[] = $grados;
			foreach($enlaces as $anio => $grados){				
				$row = array_fill(0,count($keys),0);
				foreach($grados as $key => $puntaje){
					//var_dump($keys[$key]);
					$row[$keys[$key]] = intval($puntaje);
				}
				array_unshift($row,strval($anio));
				$variable[] = $row;
			}
		}else{
			$variable = false;
		}
		return $variable;
	}
}
?>
