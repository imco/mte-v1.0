<div class='perfil container'>
	<div class='head'>
		<?php $rank = isset($this->escuela->rank_entidad) ? $this->escuela->rank_entidad : '--' ?>
		<div class='ranking'>
			<h1><?=$rank?></h1>
			<p>Posición <br/>Nivel Estatal</p>
		</div>
		<div class='nivel <?php echo str_replace(' ', '-', $this->config->semaforos[$this->escuela->semaforo]) ?>'>
			<div class='bubble'></div>
			<span class='text'><?=$this->config->semaforos[$this->escuela->semaforo]?></span>
			<?php if($this->escuela->semaforo == 4) { ?>
				<div class='pop-up-triangle shadow'></div>
				<div class='pop-up'>
					<p>Escuela que <strong>no administra la prueba ENLACE</strong> a sus alumnos.</p>

				</div>
				<div class='pop-up-triangle'></div>
			<? }else if($this->escuela->semaforo == 5){?>
				<div class='pop-up-triangle shadow'></div>
				<div class='pop-up'>
					<p class='Poco-confiable'>Escuela en donde arriba del 10% de los resultados se catalogan como <strong>"no confiables". (<?= $this->escuela->porcentaje_poco_confiable ?>%)"</strong></p>
				</div>
			<?php }?>
			<div class='pop-up-triangle'></div>
		</div>
		<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
		<div class='semaforo'>
			<h2>Semáforo Educativo</h2>
			<h3 class='nivel reprobado'>Reprobado</h3>
			<h3 class='nivel elemental'>De Panzaso</h3>
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
		<div class='tab jscrollpane on'>
			<a name='calificaciones'></a>
			<?php
			if($this->escuela->calificaciones){
				foreach($this->escuela->calificaciones as $calificacion){
					echo <<<EOD
					<div class='comment'>
						<p class='rating'>{$calificacion->calificacion}%<span class='likes'>{$calificacion->likes}</span><a href='/escuelas/like_calificacion/{$calificacion->id}/'></a></p>
						<h2>{$calificacion->nombre}</h2>
						<p>{$calificacion->comentario}</p>
					</div>
EOD;
				}
			}else{?>
				<div class='buble-sin-comentario'>
					<div class='lapiz'></div>
					<p>Sé el primero en escribir un comentario</p>
				</div>
			<?php }
			?>
		</div>
		<div class='tab jscrollpane'></div>
		<div class='tab jscrollpane'></div>
		<div class='tab jscrollpane'><div class=' chart-box'>
			<?php 
			if($this->escuela->line_chart_espaniol ){
				echo "<h2>Resultados ENLACE español</h2>";
				echo "<div id='line-chart-data-espaniol' class='hidden'>".json_encode($this->escuela->line_chart_espaniol)."</div><div id='profile-line-chart-espaniol' class='chart'></div>";
				echo "<h2>Resultados ENLACE matematicas</h2>";
				echo "<div id='line-chart-data-matematicas' class='hidden'>".json_encode($this->escuela->line_chart_matematicas)."</div><div id='profile-line-chart-matematicas' class='chart'></div>";
			}else{

			} 
			?>
		</div></div>
		<div class='tab jscrollpane'>
			
		</div>
	</div>	
	<div class='gray-box'>
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form'>
			<p>En ningún momento haremos público tu correo electrónico con tu comentario</p>
			<div class='column'>
				<p>
					<input type='text' placeholder='Tu nombre' name='nombre' class='required' />
					<select class='custom-select' name='ocupacion' >
						<option value=''>Ocupación</option>
						<option value='ocupacion 1'>Ocupación 1</option>
						<option value='ocupacion 2'>Ocupación 2</option>
						<option value='ocupacion 3'>Ocupación 3</option>
						<option value='ocupacion 4'>Ocupación 4</option>
					</select>
					<textarea placeholder='Comentario' name='comentario' class='required'></textarea>
				</p>
			</div>
			<div class='column'>
				<p>
					<input type='text' class='required email' placeholder='Correo eléctronico' name='email' />
				</p>
				<p class='rater'>
					Califica esta escuela
					<span class='ranker' id='rank-bar'><span class='bar'></span></span>
					<span class='label' id='rank-label'>6.8%</span>
					<input type='hidden' id='rank-value' name='calificacion' value='' class='required'/>
					<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' />
				</p>
			</div>
			<div class='clear'></div>
			<p><input type='submit' value='Califica tu escuela' /></p>
		</form>
	</div>
	<div class='gray-box reportar'>
		<form method='post' action='/escuelas/reportar/' accept-charstet='utf-8' class='reporte-form'>
			<h2>Tu reporte será completamente anónimo</h2>
			<p>En ningún momento haremos público tu correo electrónico con tu comentario</p>
			<fieldset>
				<p class='column'><input type='text' placeholder='Tu nombre' name='nombre_input' class='required' /></p>
				<p class='column'><input type='text' class='required email' placeholder='Correo eléctronico' name='email_input' /></p>
				<p><textarea name='denuncia' class='required' placeholder='Denuncia'></textarea></p>
				<p class='column'><select class='custom-select' name='ocupacion' >
					<option value=''>Ocupación</option>
					<option value='ocupacion 1'>Ocupación 1</option>
					<option value='ocupacion 2'>Ocupación 2</option>
					<option value='ocupacion 3'>Ocupación 3</option>
					<option value='ocupacion 4'>Ocupación 4</option>
				</select></p>
				<p class='column'><select class='custom-select' name='categoria' >
					<option value=''>Categoría de tu Reporte</option>
					<option value='ocupacion 1'>Ocupación 1</option>
					<option value='ocupacion 2'>Ocupación 2</option>
					<option value='ocupacion 3'>Ocupación 3</option>
					<option value='ocupacion 4'>Ocupación 4</option>
				</select></p>
				<div class='clear'></div>
				<p class='strong'>
					<input type='checkbox' name='publicar' /> Quiero que mi reporte se publique en el perfil de la escuela
				</p>
				<p>
					<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' />
					<input type='submit' value='Enviar' />
				</p>
			</fieldset>
			<div class='clear'></div>
		</form>
	</div>	
</div>