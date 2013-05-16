<div class='perfil container'>
	<div class='head'>
		<div class='ranking'>
			<h1>46</h1>
			<p>Posición <br/>Nivel Nacional</p>
		</div>
		<div class='nivel <?=$this->config->semaforos[$this->escuela->semaforo]?>'><div class='bubble'></div><?=$this->config->semaforos[$this->escuela->semaforo]?></div>
		<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
		<div class='semaforo'>
			<h2>Semáforo Educativo</h2>
			<h3 class='nivel reprobado'>Reprobado</h3>
			<h3 class='nivel elemental'>Elemental</h3>
			<h3 class='nivel bien'>Bien</h3>
			<h3 class='nivel excelente'>Excelente</h3>
		</div>
	</div>
	
	<div class='info'>
		<h1><?=$this->capitalize($this->escuela->nombre)?></h1>
		<h2><?=$this->capitalize($this->escuela->nivel->nombre)?> | <?=$this->capitalize($this->escuela->turno->nombre)?> | <?=$this->capitalize($this->escuela->control->nombre)?></h2>
		<hr />
		<p class='icon dom'>
			<?=$this->capitalize($this->escuela->domicilio)?><br/>
			<?=$this->capitalize($this->escuela->localidad->nombre)?>, <?=$this->capitalize($this->escuela->entidad->nombre)?> <br />
			<?=$this->capitalize($this->escuela->municipio->nombre)?> <br/>
			<?=$this->escuela->cct?>
		</p>
		<p class='icon fon'><?=$this->escuela->telefono?></p>
		<p class='icon email'><?=$this->escuela->correoelectronico?></p>
		<p class='website'><?=$this->escuela->paginaweb?></p>


			<!--<p>Clave SEP: </p>
			<p>Servicio: <?=$this->capitalize($this->escuela->servicio->nombre)?></p>
			<p>Subnivel: <?=$this->capitalize($this->escuela->subnivel->nombre)?></p>
			<p>Subcontrol: <?=$this->capitalize($this->escuela->subcontrol->nombre)?></p>
			<p>Sostenimiento: <?=$this->capitalize($this->escuela->sostenimiento->nombre)?></p>
			<p>Tipo:<?=$this->capitalize($this->escuela->tipo->nombre)?></p>
			<div class='contact'>
				<p>Telefono: </p>
				<p>Correo Electronico: </p>
				<p>Pagina Web: </p>
			</div> -->
	</div>

	<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
	<div id='mapa' class='map'></div>
	
	<ul class='tabs'>
		<li><a href='#' class='on'>Comentarios</a></li>
		<li><a href='#' >Denuncia</a></li>
		<li><a href='#' >Analisis</a></li>
		<li><a href='#' >Consejos Escolares</a></li>
	</ul>
	<div class='tab'>
		<div class='comment'>
			<p class='rating'>6.8%</p>
			<h2>This is Photoshop's Version of Lorem Ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet tempor</p>
		</div>
		<div class='comment'>
			<p class='rating'>6.8%</p>
			<h2>This is Photoshop's Version of Lorem Ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet tempor</p>
		</div>
		<div class='comment'>
			<p class='rating'>6.8%</p>
			<h2>This is Photoshop's Version of Lorem Ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet tempor</p>
		</div>
		<div class='comment'>
			<p class='rating'>6.8%</p>
			<h2>This is Photoshop's Version of Lorem Ipsum</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet tempor</p>
		</div>

	</div>	
</div>