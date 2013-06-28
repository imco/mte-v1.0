<?php
class stats extends main{
	public function index(){
		//$this->histogram(12);
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
		$calificaciones = array('general','matematicas','espaniol');
		$niveles = array(12 => 'primaria', 13 => 'secundaria', 22 => 'bachillerato');
		for($i=1;$i<=32;$i++){
			$entidad = new entidad($i);
			$entidad->debug = true;
			foreach($calificaciones as $calificacion){
				foreach($niveles as $nivelid => $nivel){
					$sql = "
						SELECT AVG(promedio_$calificacion) AS {$nivel}_$calificacion FROM escuelas
						WHERE `entidad` = $i AND `nivel` = $nivelid;
					";
					echo $sql.'<br/>';
					$result = mysql_query($sql);
					$result = mysql_fetch_row($result);
					$entidad->update($nivel."_".$calificacion,$result);
				}
			}
		}
	}
}
?>