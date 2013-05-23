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
	<div class='compara-tab-container'>
		<div class='tab'>
			<?php 
			$this->current_rank->name = 'Estatal';
			$this->current_rank->slug = 'rank_entidad';
			$this->include_template('compare-table','compara');
			?>
		</div>
		<div class='tab'>
			<?php 
			$this->current_rank->name = 'Nacional';
			$this->current_rank->slug = 'rank_nacional';
			$this->include_template('compare-table','compara');
			?>
		</div>
		<div class='tab on'>
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
					<th class='semaforos'>Semaforo Educativo</th>
				</tr>
				<?php 
				foreach($this->escuelas as $escuela){
					$scores = array();
					for($i = 2006;$i<2013;$i++){
						$scores[$i]->sum = 0;
						$scores[$i]->count = 0;
					}
					echo "<tr>";
					echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
					//$escuela->debug = true;
					$escuela->read('enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>anio,enlaces=>id');
					if($escuela->enlaces){
						foreach($escuela->enlaces as $enlace){
							//var_dump($enlace->anio);
							$scores[$enlace->anio]->sum += $enlace->puntaje_espaniol + $enlace->puntaje_matematicas;
							$scores[$enlace->anio]->count++;
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
		</tab>
	</div>
</div>