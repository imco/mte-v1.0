<div class='perfil container'>
	<div class='ranking'>
		
	</div>
	<h1><?=$this->capitalize($this->escuela->nombre)?></h1>

	<div class='clear'></div>
	<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
	<div id='mapa'></div>
	<div class='info'>
		<div class='column'>
			<h3><?=$this->capitalize($this->escuela->nivel->nombre)?> <?=$this->capitalize($this->escuela->nombre)?></h3>
			<p><?=$this->capitalize($this->escuela->domicilio)?></p>
			<p><?=$this->capitalize($this->escuela->localidad->nombre)?></p>
			<p><?=$this->capitalize($this->escuela->municipio->nombre)?>, <?=$this->capitalize($this->escuela->entidad->nombre)?></p>

			<ul class='features'>				
				<li><?=$this->capitalize($this->escuela->turno->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->nivel->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->subnivel->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->control->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->subcontrol->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->sostenimiento->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->tipo->nombre)?></li>
			</ul>
		</div>
		<div class='column'>
			<p><?=$this->capitalize($this->escuela->servicio->nombre)?></p>
			<p><?=$this->escuela->cct?></p>
		</div>
		<div class='clear'></div>
	</div>
</div>