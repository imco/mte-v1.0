<?php
class escuela extends memcached_table{
	public function info(){
		$this->table_name = "escuelas";
		$this->key = 'id';
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
		$this->has_many_keys['reportes_ciudadanos'] = 'id_cct';

        $this->has_many['rank'] = 'rank';
        $this->has_many_keys['rank'] = 'id';

		$this->semaforos = array('Reprobado','De Panzazo','Bien','Excelente','Sin Enlace','Poco confiable');
		#$this->semaforo_rangos[12] = array(433,524,615,900);
		$this->semaforo_rangos[12] = array(559,601,662,900);
		$this->semaforo_rangos[13] = array(511,544,591,900);
		$this->semaforo_rangos[22] = array(551,580,632,900);
		$this->semaforo_poco_confiable = 10;

	}
	public function get_semaforo(){
		$this->semaforo = 4;
		$porcentaje_poco_confiable = $this->poco_confiables > 0 && $this->total_evaluados > 0?($this->poco_confiables * 100) / $this->total_evaluados:0;
		$this->porcentaje_poco_confiable = number_format($porcentaje_poco_confiable,2);
		$turnos = isset($this->turno->num) ? $this->turno->num : 1;

		if($this->nivel->nombre=="PREESCOLAR"){
			$this->semaforo = 7;		
		}

		if(isset($this->grados) && $this->grados>0 ){
			if($this->nivel->nombre != "BACHILLERATO"  && ($this->grados < 4 * $turnos && $this->nivel->nombre == "PRIMARIA") || ($this->grados < 3 * $turnos && $this->nivel->nombre == "SECUNDARIA") ){
				$this->semaforo = 6;//no se cuentan
			}else{
				
				if($porcentaje_poco_confiable > 0 && $porcentaje_poco_confiable >= $this->semaforo_poco_confiable){
					$this->semaforo = 5;//no confiables
				}else{
					
					if( $this->promedio_general > 0){
						
						if( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][0])
							$this->semaforo=0;
						else
							if( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][1] )
								$this->semaforo = 1;
							else
								if( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][2] )
									$this->semaforo = 2;
								else
									$this->semaforo = 3;
				}
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
	}

    public function get_semaforos(){
        $semaforo = 4;
        $this->semaforo = $semaforo;

        if($this->nivel->nombre=="PREESCOLAR"){
            $semaforo->semaforo = 7;
            $this->semaforo = $semaforo;
            return;
        }

        if (isset($this->rank) && count($this->rank) > 0) {
            foreach ($this->rank as $rank) {
                $this->get_semaforo_new($rank);

                foreach($this->turnos as $turno){
                    if ($rank->turnos_eval == $turno->id) {
                        $rank->turno = array();
                        $rank->turno[0]->nombre = $turno->nombre;
                    }
                }
            }

        }
    }

    private function get_semaforo_new($rank){
        if (!$rank) return false;

        $semaforo = 4;

        if ($rank->promedio_general > 0) {//si todos los anios fueron evaluados
            if (!isset($rank->rank_entidad) && !isset($rank->rank_nacional)) {
                $semaforo = 5;//poco confiable
            }
            else if( $rank->promedio_general < $this->semaforo_rangos[$this->nivel->id][0])
                $semaforo = 0;//amarillo
            else
                if( $rank->promedio_general < $this->semaforo_rangos[$this->nivel->id][1] )
                    $semaforo = 1;//verde
                else
                    if( $rank->promedio_general < $this->semaforo_rangos[$this->nivel->id][2] )
                        $semaforo = 2;//naranja
                    else
                        $semaforo = 3;//reprobado
        } else {
            $semaforo = 6;//no se cuentan
        }

        if ($this->semaforo >  $semaforo) {
            $this->semaforo = $semaforo;
            $this->selected_rank = $rank;
        }
        $rank->semaforo = $semaforo;
        return $semaforo;
    }

	public function rank($nivel,$entidad = false,$municipio = false){
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
	public function get_mongo_info($client){
		if($client){
            $db = $client->selectDB("censo_completo_2013");
            $collection = $db->selectCollection('datos_escuelas_v2');
            $escuelas = $collection->find(array( 'cct_escuelas' => $this->cct))->sort(array('id_turno'=>1));
            $first = false;
            $censo = false;
            foreach($escuelas as $escuela) {
                if (!$first) {
                    $first = true;
                    $censo = $escuela;
                    $censo['turnos'] = array();
                }
                $turno = new stdClass();
                $variables = array('turno'=>'nombre','num_alumnos'=>'alumnos','num_personal'=>'personal','num_grupos'=>'grupos','id_turno'=>'id');
                foreach( $variables as $key=>$val) {
                    if(isset($escuela[$key]) && strlen(trim($escuela[$key]))>0)
                        $turno->$val = $escuela[$key];
                }
                $censo['turnos'][] = $turno;
            }
            $this->censo = $censo;

            $db = $client->selectDB("mte_produccion");
            $c = $db->selectCollection('snie');
            $this->snie = $c->find(array('cct'=>$this->cct));
            $this->infraestructura = false;

            if($this->snie){
                $keys = array(12=>'primaria_pub_infraestructura',13=>'primaria_pub_infraestructura',22=>'primaria_pub_infraestructura');

                foreach($this->snie as $e){
                    $this->infraestructura = json_decode($e[$keys[$this->nivel->id]]);
                    break;
                }
                $this->infraestructura = is_array($this->infraestructura) ? $this->infraestructura : false;
            }

//			//Programas Federales
//			$db = $client->selectDB("mte_programas");
//			$programas = array('pec','pes','petc','siat');
//			$this->load_programas($programas,$db);
//			//OSCs
//			$programas = array('proeducacion','tarahumara','teach_mexico','mexprim','empresa_impulsa','emprender_impulsa','emprendedores_impulsa','dinero_impulsa','fundacion_televisa','naciones_unidas');
//			$this->load_programas($programas,$db);

            $db = $client->selectDB("mte_programas");
            $this->load_programas2($db);

			$client->close();
		}else{
			$programas = array('censo_2013','snie','infraestructura', 'pec','pes','petc','siat','proeducacion','tarahumara','teach_mexico','mexprim','empresa_impulsa','emprender_impulsa','emprendedores_impulsa','dinero_impulsa','fundacion_televisa','naciones_unidas');
			foreach($programas as $programa){
				$this->$programa = false;
			}
		}
	}
	public function get_turnos(){
        $sql = "select distinct e.turnos_eval,t.nombre from escuelas_para_rankeo e inner join turnos t on t.id = e.turnos_eval where e.id = {$this->id}";
        $result = mysql_query($sql);
        $this->turnos = array();
        while ($row = mysql_fetch_assoc($result)){
            $turno = new stdClass();
            $turno->id = $row['turnos_eval'];
            $turno->nombre = $row['nombre'];
            $this->turnos[] = $turno;
        };
    }
    public function get_charts(){
        $this->line_chart_espaniol = $this->get_chart('espaniol');
        $this->line_chart_matematicas = $this->get_chart('matematicas');

        $this->espaniol_charts = array();
        $this->matematicas_charts = array();

        foreach($this->rank as $rank){
            $this->espaniol_charts[$rank->turnos_eval] = $this->get_chart('espaniol',$rank->turnos_eval);
            $this->matematicas_charts[$rank->turnos_eval] = $this->get_chart('matematicas',$rank->turnos_eval);
        }
    }
    public function get_chart($materia,$turno = false){
        $grados = array();
        $enlaces = array();
        $puntaje_name = 'puntaje_'.$materia;
        if(isset($this->enlaces) && $this->enlaces){
            $variable = array();
            foreach($this->enlaces as $enlace){
                if ($turno && $enlace->turnos != $turno) {
                    continue;
                }
                #if(isset($enlaces[$enlace->anio][$enlace->grado])){
                #	echo 'mult';
                #	$enlaces[$enlace->anio][$enlace->grado] = round(
                #		( $enlaces[$enlace->anio][$enlace->grado] + $enlace->$puntaje_name )
                #	/ (count($enlaces[$enlace->anio][$enlace->grado]) + 1));
                #}else{
                $enlaces[$enlace->anio][$enlace->grado] = round($enlace->$puntaje_name);
                #}
                $grados[$enlace->grado] = $enlace->grado;
            }
            ksort($enlaces);
            //var_dump($enlaces);
            $grados = array_values($grados);
            sort($grados);
            $keys = array_flip($grados);
            array_unshift($grados,'Año');
            $variable[] = $grados;
            foreach($enlaces as $anio => $grados){
                $row = array_fill(0,count($keys),0);
                foreach($grados as $key => $puntaje){
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
    public function get_turnos_rank(){
        $rank = new rank();
        //$rank->debug = true;
        $rank->search_clause = "escuelas_para_rankeo.id = {$this->id}";
        $ranks = $rank->read('id,turnos_eval,promedio_general,promedio_matematicas,promedio_espaniol,total_evaluados,pct_reprobados,poco_confiables,rank_entidad,rank_nacional');
        $this->rank = $ranks;
    }
    private function load_programas($programas,$db){
		foreach($programas as $programa){
			$c = $db->selectCollection($programa);
			$this->$programa = $c->find(array('cct'=>$this->cct));
			$this->$programa = iterator_to_array($this->$programa);
		}
	}
    private function load_programas2($db){
        $c = $db->selectCollection("normalizados");
        $results = $c->find(array('cct'=>$this->cct));
        $this->escuela->programas2 = array();
        foreach($results as $res){
            //var_dump($res);
            if (!isset($this->escuela->programas2[$res['programa']])) {
                $programa = new stdClass();
                $programa->anios = array();
                $this->escuela->programas2[$res['programa']] = $programa;
            }
            $this->escuela->programas2[$res['programa']]->anios[] = $res['anio'];
        }
        var_dump($this->escuela->programas2);
    }
}
?>
