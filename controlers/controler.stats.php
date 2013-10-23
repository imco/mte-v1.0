<?php
class stats extends main{
	/* Controlador: host/stats/*
	   Se encarga de actualizar los resultados de:
	   	Promedio general, por estado y a nivel nacional.
		Rank por estado.
		Numero de escuelas a nivel estatal y nacional.

	*/
	public function index(){
		//$this->histogram(12);
	}
	public function rank_states(){
		/* Actualiza los datos del rank para cada entidad. */
		$q = new entidad();
		$q->search_clause = '1';
		$q->debug = true;
		$q->order_by = 'promedio_general DESC';
		$entidades = $q->read('id,promedio_general,rank');
		$i = 1;
		foreach($entidades as $entidad){
			$entidad->debug = true;
			$entidad->update('rank',array($i++));
		}

	}
	public function histogram(){
		set_time_limit(100000);
		$nivel = $this->get('id') ? $this->get('id') : 12;
		$sql = "SELECT cct,nombre,promedio_general FROM escuelas WHERE nivel = '$nivel' AND promedio_general IS NOT NULL";//" OR nivel = '13' or nivel = '22' or nivel = '21'";
		$result = mysql_query($sql);
		$this->data = array();
		for($i = 0;$i<901;$i++){
			$this->data[$i][0] = $i;
			$this->data[$i][1] = 0;
		}
		$i = 0;
		while($row = mysql_fetch_assoc($result)){
			$this->data[round($row['promedio_general'])][1]++;
			//if($i++ == 100) break;
		}
		$this->include_template('index','stats');
	}
	public function entidad_promedios(){
		/* Actualiza los datos del promedio a nivel estatal para cada estado estado. */
		$calificaciones = array('matematicas','espaniol','general');
		$controles = array(1 => 'publicas', 2 => 'privadas');
		for($i=1;$i<=32;$i++){
			$entidad = new entidad($i);
			$entidad->debug = true;
			foreach($calificaciones as $calificacion){				
					$sql = "
						SELECT AVG(promedio_$calificacion) FROM escuelas
						WHERE `entidad` = $i AND rank_entidad IS NOT NULL;
					";
					echo $sql.'<br/>';
					$result = mysql_query($sql);
					$result = mysql_fetch_row($result);
					$entidad->update("promedio_".$calificacion,$result);
			}
		}
	}

	public function nacional_promedios(){
		/* Actualiza los datos del promedio a nivel nacional para cada entidad. */
		$niveles = array(12 => 'primaria', 13 => 'secundaria', 22 => 'bachillerato');
		$calificaciones = array('matematicas','espaniol');
		for($i=1;$i<=32;$i++){
			$entidad = new entidad($i);
			$entidad->debug = true;
			foreach($niveles as $nivel => $name){
				foreach($calificaciones as $calificacion){
					$sql = "SELECT AVG(promedio_$calificacion) FROM escuelas WHERE (nivel = $nivel) AND rank_entidad IS NOT NULL;";
					$result = mysql_query($sql);
					$result = mysql_fetch_row($result);
					$entidad->update("promedio_nacional_".$calificacion."_".$name,$result);
				}
			}
			$sql = "SELECT AVG(promedio_general) FROM escuelas;";
			$result = mysql_query($sql);
			$result = mysql_fetch_row($result);
			$entidad->update('promedio_nacional_general',$result);
		}
	}

	public function entidad_totales(){
		/* Actualiza los datos del numero de escuelas pertenecientes a cada uno de los niveles (primaria, secundaria y bachillerato) a nivel estatal. */
		$niveles = array(12 => 'primaria', 13 => 'secundaria', 22 => 'bachillerato');
		for($i=1;$i<=32;$i++){
			$entidad = new entidad($i);
			$entidad->debug = true;
			$sql = "SELECT count(cct) FROM escuelas WHERE (nivel = 12 OR nivel = 13 OR nivel = 22) AND entidad = $i AND control = 1";
			$result = mysql_query($sql);
			$result = mysql_fetch_row($result);

			$sql = "SELECT count(cct) FROM escuelas WHERE (nivel = 12 OR nivel = 13 OR nivel = 22) AND entidad = $i AND control = 2";
			$result2 = mysql_query($sql);
			$result2 = mysql_fetch_row($result2);


			$sql = "SELECT count(cct) FROM escuelas WHERE nivel = 12 AND entidad = $i";
			$result3 = mysql_query($sql);
			$result3 = mysql_fetch_row($result3);

			$sql = "SELECT count(cct) FROM escuelas WHERE nivel = 13 AND entidad = $i";
			$result4 = mysql_query($sql);
			$result4 = mysql_fetch_row($result4);

			$sql = "SELECT count(cct) FROM escuelas WHERE nivel = 22 AND entidad = $i";
			$result5 = mysql_query($sql);
			$result5 = mysql_fetch_row($result5);

			$entidad->update(
				'escuelas_publicas,escuelas_privadas,numero_escuelas_primaria,numero_escuelas_secundaria,numero_escuelas_bachillerato',
				array(
					$result[0],$result2[0],$result3[0],$result4[0],$result5[0]
					)
				);
		}
	}

	public function nacional_totales(){
		/* Actualiza los datos del numero de escuelas pertenecientes a cada uno de los niveles (primaria, secundaria y bachillerato) a nivel nacional. */
		$niveles = array(12 => 'primaria', 13 => 'secundaria', 22 => 'bachillerato');
		for($i=1;$i<=32;$i++){
			$entidad = new entidad($i);
			$entidad->debug = true;
			foreach($niveles as $nivel => $name){	
				$sql = "SELECT count(cct) FROM escuelas WHERE nivel = $nivel";
				$result = mysql_query($sql);
				$result = mysql_fetch_row($result);
				$entidad->update("numero_nacional_escuelas_".$name,$result);
				
			}
		}

	
	}
}
?>
