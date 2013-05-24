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
		<div class='tab on'>
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
		<div class='tab'><?php $this->include_template('por-anios-table','compara');?></div>
		<div class='tab'><?php $this->include_template('por-alumno-table','compara');?></div >
	</div>
</div>