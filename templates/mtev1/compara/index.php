<div class=' container comparar resultados'>
	<div class='compara-tabs'>
		<a href='#' class='general on'><span></span>General</a>
		<a href='#' class='posicion-nacional'><span></span>Posición Nacional</a>
		<a href='#' class='resultados-por-anio'><span></span>Resultados por año</a>
		<a href='#' class='desempeno-de-alumnos'><span></span>Desempeño de Alumnos</a>
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
	<div class="share-bt comp">
		<div class="social">
			<a href="#" class='share-face' 
	 	 	onclick="
			      window.open(
	            		'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
		          	'El perfil', 
			       	'width=626,height=436'); 
				 return false;">
				  </a>

				<div class="tweet">
				  <span class="twitter-icon"></span>
				  <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-text="Compara: <? 		if($this->escuelas){;
			  	for($i=0;$i<count($this->escuelas)-1;$i++){
			  		echo $this->capitalize($this->escuelas[$i]->nombre).', ';
				}
					echo $this->capitalize($this->escuelas[$i]->nombre);
			  	} ?>" data-via='mejoratuescuela'>
			  	Tweet
				  </a>
				</div>
			  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
		</div>
		<a href="#" class="button-frame">
			<span class="bt-share">Compartir</span>
		</a>
	</div>
</div>
