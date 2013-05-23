<div class=' container comparar resultados'>
	<div class='compara-tabs'>
		<a href='#' class='general on'><span></span>General</a>
		<a href='#' class='posicion-nacional'><span></span>Posición Nacional</a>
		<a href='#' class='resultados-por-anio'><span></span>Resultados por año</a>
		<a href='#' class='desempeno-de-alumnos'><span></span>Desempeño de Alumnos</a>
		<a href='#' class='mapa'><span></span>Mapa</a>
		<div class='clear'></div>
		<div class='shadow'></div>
	</div>
	<table>
		<tr>
			<th class='school'>Escuelas comparadas</th>
			<th>Nivel Escolar</th>
			<th class='rank'>Ranking Estatal</th>
			<th>Privada | Pública</th>
			<th class='calificacion'>Calificación Enlace de Español</th>
			<th class='calificacion'>Calificación Enlace de Matematicas</th>			
			<th class='semaforos'>Semaforo Educativo</th>
		</tr>
		<?php 
		foreach($this->escuelas as $escuela){
			$escuela->get_semaforo();
			echo "<tr>";
			echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
			echo "<td>".$this->capitalize($escuela->nivel->nombre)."</td>";
			echo "<td class='rank'><span>".$escuela->rank_entidad."</span></td>";
			echo "<td>".$this->capitalize($escuela->control->nombre)."</td>";
			echo "<td class='rank'><span>".round($escuela->promedio_espaniol)."</span></td>";
			echo "<td class='rank'><span>".round($escuela->promedio_matematicas)."</span></td>";
			echo "<td class='semaforo sem{$escuela->semaforo}'><span></span></td>";
			echo "</tr>";
		}
		?>
	</table>
</div>