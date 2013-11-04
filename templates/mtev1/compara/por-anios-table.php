<table>
	<tr>
		<th class='school'>Escuelas comparadas</th>
		<th class='calificacion'>2006</th>
		<th class='calificacion'>2007</th>
		<th class='calificacion'>2008</th>
		<th class='calificacion'>2009</th>
		<th class='calificacion'>2010</th>
		<th class='calificacion'>2011</th>
		<th class='calificacion'>2012</th>
		<th class='calificacion'>2013</th>
		<th class='semaforos'>Semaforo Educativo</th>
	</tr>
	<?php 
	if($this->escuelas!=null)
	foreach($this->escuelas as $escuela){
		$scores = array();
		for($i = 2006;$i<=2013;$i++){
			$scores[$i]->sum = 0;
			$scores[$i]->count = 0;
		}
		echo "<tr>";
		echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
		//$escuela->debug = true;
		$escuela->key = 'cct';
		$escuela->read('
			enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>anio,enlaces=>id,
			enlaces=>alumnos_en_nivel0_matematicas,enlaces=>alumnos_en_nivel1_matematicas,enlaces=>alumnos_en_nivel2_matematicas,enlaces=>alumnos_en_nivel3_matematicas,
			enlaces=>alumnos_en_nivel0_espaniol,enlaces=>alumnos_en_nivel1_espaniol,enlaces=>alumnos_en_nivel2_espaniol,enlaces=>alumnos_en_nivel3_espaniol,
			enlaces=>alumnos_que_contestaron_total
		');
		if($escuela->enlaces){
			foreach($escuela->enlaces as $enlace){
				if($enlace->puntaje_espaniol != 0 || $enlace->puntaje_matematicas != 0){
					$scores[$enlace->anio]->sum += $enlace->puntaje_espaniol + $enlace->puntaje_matematicas;
					$scores[$enlace->anio]->count++;
				}
			}
		}
		foreach($scores as $year => $score){
			$avg = $score->count ? round($score->sum/($score->count*2)) : '--';
			echo "<td class='rank'>$avg</td>";
		}					
		echo "<td class='semaforo sem{$escuela->semaforo}'><span></span></td>";
		echo "</tr>";
	}
	?>
</table>
