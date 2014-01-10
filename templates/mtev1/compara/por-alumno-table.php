<table class='desemp'>
	<tr>
		<th class='school' rowspan='2'>Escuelas comparadas</th>
		<th colspan='4' >Español</th>
		<th colspan='4' >Matemáticas</th>
		<th rowspan='2' class='calificacion'>Alumnos que tomaron la prueba</th>
		<th rowspan='2' class='calificacion'>Muestras poco confiables</th>
	</tr>
	<tr>
		

		<th class='calificacion'>Reprobado</th>
		<th class='calificacion'>De panzazo</th>
		<th class='calificacion'>Bien</th>
		<th class='calificacion'>Excelente</th>

		<th class='calificacion'>Reprobado</th>
		<th class='calificacion'>De panzazo</th>
		<th class='calificacion'>Bien</th>
		<th class='calificacion'>Excelente</th>
		

	</tr>
	<?php 
	if($this->escuelas!=null)
	foreach($this->escuelas as $escuela){
		$scores = array();
		for($i = 2006;$i<2013;$i++){
			$scores[$i] = new stdClass();
			$scores[$i]->mat = array_fill(0,4,0);
			$scores[$i]->esp = array_fill(0,4,0);
			$scores[$i]->alumnos = 0;
		}
		echo "<tr>";
		echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
		if($escuela->enlaces){
			foreach($escuela->enlaces as $enlace){
				$scores[$enlace->anio]->mat[0] += $enlace->alumnos_en_nivel0_matematicas;
				$scores[$enlace->anio]->mat[1] += $enlace->alumnos_en_nivel1_matematicas;
				$scores[$enlace->anio]->mat[2] += $enlace->alumnos_en_nivel2_matematicas;
				$scores[$enlace->anio]->mat[3] += $enlace->alumnos_en_nivel3_matematicas;

				$scores[$enlace->anio]->esp[0] += $enlace->alumnos_en_nivel0_espaniol;
				$scores[$enlace->anio]->esp[1] += $enlace->alumnos_en_nivel1_espaniol;
				$scores[$enlace->anio]->esp[2] += $enlace->alumnos_en_nivel2_espaniol;
				$scores[$enlace->anio]->esp[3] += $enlace->alumnos_en_nivel3_espaniol;

				$scores[$enlace->anio]->alumnos += $enlace->alumnos_que_contestaron_total;
			}
		}

		foreach($scores as $year => $score){
			if($year == 2012){//estaba 2013
				foreach($score->esp as $esp){
					$pct = $score->alumnos ? round($esp/$score->alumnos*100)."%" : '--';
					echo "<td class='rank'>$pct</td>";
				}
				foreach($score->mat as $esp){
					$pct = $score->alumnos ? round($esp/$score->alumnos*100)."%" : '--';
					echo "<td class='rank'>$pct</td>";

				}
				$total = $score->alumnos;
			}
		}
		$conf = $total ? round($escuela->poco_confiables/$total * 100).'%' : '--';
		echo "<td class='rank'>{$total}</td>";
		echo "<td class='rank'>{$conf}</td>";		
		echo "</tr>";
		$total = null;
	}
	?>
</table>
