<table>
	<tr>
		<th class='school'>Escuelas comparadas</th>
		<th>Nivel Escolar</th>
		<th class='rank'>Posición <?=$this->current_rank->name?></th>
		<th>Privada | Pública</th>
		<th class='calificacion'>Calificación Enlace de Español</th>
		<th class='calificacion'>Calificación Enlace de Matematicas</th>			
		<th class='semaforos'>Semaforo Educativo</th>
	</tr>
	<?php 
	foreach($this->escuelas as $escuela){
		$escuela->get_semaforo();
		$slug = $this->current_rank->slug;
		echo "<tr>";
		echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
		echo "<td>".$this->capitalize($escuela->nivel->nombre)."</td>";
		echo "<td class='rank'><span>".$escuela->$slug."</span></td>";
		echo "<td>".$this->capitalize($escuela->control->nombre)."</td>";
		echo "<td class='rank'><span>".round($escuela->promedio_espaniol)."</span></td>";
		echo "<td class='rank'><span>".round($escuela->promedio_matematicas)."</span></td>";
		echo "<td class='semaforo sem{$escuela->semaforo}'><span></span></td>";
		echo "</tr>";
	}
	?>
</table>