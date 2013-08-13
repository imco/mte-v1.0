<div class='perfil container'>
	<div class='ranking'>
		
	</div>
	<h1><?=$this->capitalize($this->escuela->nombre)?></h1>

	<div class='clear'></div>
	<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
	<div id='mapa'></div>
	<div class='info'>
		<div class='column'>
			<h3><?=$this->capitalize($this->escuela->nombre)?></h3>
			<p><?=$this->capitalize($this->escuela->domicilio)?></p>
			<p><?=$this->capitalize($this->escuela->localidad->nombre)?></p>
			<p><?=$this->capitalize($this->escuela->municipio->nombre)?>, <?=$this->capitalize($this->escuela->entidad->nombre)?></p>

			<ul class='features'>				
				
				<li><?=$this->capitalize($this->escuela->nivel->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->turno->nombre)?></li>
				<li><?=$this->capitalize($this->escuela->control->nombre)?></li>

				
			</ul>
		</div>
		<div class='column'>
			<p>Clave SEP: <?=$this->escuela->cct?></p>
			<p>Servicio: <?=$this->capitalize($this->escuela->servicio->nombre)?></p>
			<p>Subnivel: <?=$this->capitalize($this->escuela->subnivel->nombre)?></p>
			<p>Subcontrol: <?=$this->capitalize($this->escuela->subcontrol->nombre)?></p>
			<p>Sostenimiento: <?=$this->capitalize($this->escuela->sostenimiento->nombre)?></p>
			<p>Tipo:<?=$this->capitalize($this->escuela->tipo->nombre)?></p>
			<div class='contact'>
				<p>Telefono: <?=$this->escuela->telefono?></p>
				<p>Correo Electronico: <?=$this->escuela->correoelectronico?></p>
				<p>Pagina Web: <?=$this->escuela->paginaweb?></p>
			</div>
		</div>
		<div class='clear'></div>
	</div>
	<ul class='tabs'>
		<li><a href='#' >Comentarios | Reviews</a></li>
		<li><a href='#' >Mas Info</a></li>
		<li><a href='#' >Analisis</a></li>
		<li><a href='#' >Consejos Escolares</a></li>
	</ul>
	<div class='clear'></div>
</div>