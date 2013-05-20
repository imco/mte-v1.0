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
	<div class='clear'></div>
	<ul class='tabs'>
		<li><a href='#' class='long' >Asociaciones de Padres de Familia</a></li>
		<li><a href='#' >Resultados Educativos</a></li>
		<li><a href='#' >Más Informacion</a></li>
		<li><a href='#' >Reportes Ciudadanos</a></li>
		<li class='on'><a href='#' class='long'>Comentarios con Calificacion</a></li>
	</ul>
	<div class='tab-container'>
		<div class='tab jscrollpane'>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
			<div class='comment'>
				<p class='rating'>6.8%<span class='likes'>145</span></p>
				<h2>This is Photoshop's Version of Lorem Ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam enim felis, auctor eget condimentum vel, mollis vel nisl. Phasellus aliquet</p>
			</div>
		</div>
	</div>	
	<div class='gray-box'>
		<form method='post' action='' accept-charstet='utf-8'>
			<p>En ningún momento haremos público tu correo electrónico con tu comentario</p>
			<div class='column'>
				<p><input type='text' placeholder='Tu nombre' name='nombre' /></p>
				<p><select class='custom-select' name='ocupacion' >
					<option value=''>Ocupación</option>
					<option value=''>Ocupación 1</option>
					<option value=''>Ocupación 1</option>
					<option value=''>Ocupación 1</option>
					<option value=''>Ocupación 1</option>
				</select></p>
				<p><textarea placeholder='Comentario' name='comentario'></textarea></p>
			</div>
			<div class='column'>
				<p><input type='text' placeholder='Correo eléctronico' name='email' /></p>
				<p class='rating'>
					Califica esta escuela
					<span class='ranker'></span>
				</p>
			</div>
			<div class='clear'></div>
			<p><input type='submit' value='Califica tu escuela' /></p>
		</form>
	</div>
</div>