<div class=' container comparar resultados'>
	<div class='compara-tabs'>
		<a href='#' class='general on'><span></span>General</a>
		<a href='#' class='posicion-nacional'><span></span>Posición nacional</a>
		<a href='#' class='resultados-por-anio'><span></span>Resultados por año</a>
		<a href='#' class='desempeno-de-alumnos'><span></span>Desempeño por alumno</a>
		<a href='#' class='mapa' id='compare-map-tab'><span></span>Mapa</a>
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
		<div class='tab'><?php $this->include_template('por-alumno-table','compara');?></div>
		<div class='tab'>
			<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
			<div id='mapa' class='map'></div>
			<?php $this->include_template('map-infobox','global'); ?>
			<input type='hidden' id='map-initialized' name='map-initialized' value='false'/>
		</div>
	</div>

</div>
	<div class='add-escuela-wrap'>
		<div class='add-escuela'>
				<div class='decorations'>
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<hr />
					<div class='circle'></div>
					<div class='circle'></div>
					<div class='circle'></div>
					<div class='circle'></div>
					<div class='triangle1'></div>
					<div class='triangle2'></div>
					<?php $this->print_img_tag('home/birrete_small.png');?>
					<?php $this->print_img_tag('home/palomita.png');?>
					<?php $this->print_img_tag('home/comparador.png');?>
					
				</div>
			<a class='button-frame' href='/compara/'>
				<span class='button'>Agrega otra escuela</span>
			</a>
			<?php $this->include_template('general_search','global'); ?>
			
		</div>
		<div class='decorations out'>
			<hr />
			<hr />
			<hr />
			<hr />
		</div>
	</div>
