<a name='resultados'></a>
<div class='search-map container'>
	<?php $showing = $this->pagination->count > 100 ? "Mostrando las primeras 100" : ''?>
	<h1>Se encontraron <?= $this->pagination->count ?> <span>Escuelas de acuerdo a su búsqueda. <?=$showing?></span></h1>
	<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
	<div id='mapa' class='map'></div>
	<?php $this->include_template('map-infobox','global'); ?>
	<div class='map-resultados resultados'>
		<div class='head'>
			<div class='icon'></div>
			<div class='schools'>Resultados</div>
		</div>
		<div class='list jscrollpane'>
			<?php
			if(isset($this->escuelas_digest->escuelas)){
				echo "<table>";
				foreach($this->escuelas_digest->escuelas as $escuela){
					$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
					echo "<tr $on><td class='checkbox'><a href='{$escuela->cct}' class='compara-escuela'></a></td><td class='school'><a href='/escuelas/index/{$escuela->cct}'>{$escuela->nombre}</a></td></tr>";
				}
				echo "</table>";
			}
			?>
			
		</div>
		<?php $sufix = $this->compara_cookie ? implode('-',$this->compara_cookie) : ''; ?>
		<a class="compara-main-button button-frame" href="/compara/escuelas/<?=$sufix?>">
			<span class="button">Compara</span>
		</a>
	</div>
</div>
