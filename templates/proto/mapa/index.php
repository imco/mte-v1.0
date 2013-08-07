<div class='resultados container'>
	<h1>Mapa</h1>
	<div id='map-data' class='hidden'><?=json_encode($this->escuelas_digest)?></div>
	<div id='mapa'></div>
</div>
<?php $this->include_template('general_search','global'); ?>