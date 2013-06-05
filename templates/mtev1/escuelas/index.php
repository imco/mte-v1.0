<div class='perfil container'>
	<div class='head'>
		<?php $rank = isset($this->escuela->rank_entidad) ? $this->escuela->rank_entidad : '--' ?>
		<div class='ranking'>
			<h1><?=$rank?></h1>
			<p>Posición <br/>estatal</p>
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
					<p class='Poco-confiable'>Escuela en donde arriba del 10% de los resultados se catalogan como <strong>"no confiables". (<?= $this->escuela->porcentaje_poco_confiable ?>%)</strong></p>
				</div>
				<div class='pop-up-triangle'></div>
			<?php }?>			
		</div>
		<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
		<div class='semaforo'>
			<h2>Semáforo educativo</h2>
			<h3 class='nivel reprobado'>Reprobado</h3>
			<h3 class='nivel elemental'>De panzazo</h3>
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
<!-- 		<p>Clave SEP: </p> -->
	</div>
	<input type='hidden' id='map-selected' value='<?=$this->escuela->cct?>' name='map-selected'/>
	<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
	<div id='mapa' class='map'></div>
	<?php $this->include_template('map-infobox','global'); ?>

	<div class='clear'></div>
	<ul class='tabs'>
		<li><a href='#' class='long' >Asociaciones de padres de familia</a></li>
		<li><a href='#' >Resultados educativos</a></li>
		<li><a href='#' >Más información</a></li>
		<li><a href='#' >Reportes ciudadanos</a></li>
		<li class='on'><a href='#' class='long'>Comentarios con calificación</a></li>
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
					<p>Sé el primero en escribir un comentario</p>
				</div>
			<?php }
			?>
		</div>
		<div class='tab jscrollpane'>
			<!-- 	html y css terminado	 -->
			<a name='reportes_ciudadanos'></a>
			<?php
			if($this->escuela->reportes_ciudadanos){
				foreach ($this->escuela->reportes_ciudadanos as $reporte_ciudadano){
					if(isset($reporte_ciudadano->publicar))
					echo <<<EOD
					<div class='comment reporte'>
						<p class='rating'>{$reporte_ciudadano->likes}<a href='/escuelas/like_reportar/{$reporte_ciudadano->id}/'></a></p>
						<h2>{$reporte_ciudadano->nombre_input}</h2>
						<p>{$reporte_ciudadano->denuncia}</p>
					</div>
EOD;
				}
			}else{?>
				<div class='buble-sin-comentario'>
					<p>Sé el primero en escribir un reporte</p>
				</div>
			<?php }
			?>
		</div>
			<!-- 		 Mas información-->
		<div class='tab jscrollpane'>
			<div class='mas-info'>
				<div class='left'>	
					<h2>Servicio</h2>
					<h3><?=$this->capitalize($this->escuela->servicio->nombre)?></h3>
					<p>Clave del servicio educativo.</p>
					
					<h2>Subnivel</h2>
					<h3><?=$this->capitalize($this->escuela->subnivel->nombre)?></h3>
					<p>Clave del subnivel educativo.</p>
					
					<h2>Subcontrol</h2>
					<h3><?=$this->capitalize($this->escuela->subcontrol->nombre)?></h3>
					<p>Clave del subcontrol administrativo.</p>
					
					<h2>Sostenimiento</h2>
					<h3><?=$this->capitalize($this->escuela->sostenimiento->nombre)?></h3>
					<p>Clave de sostenimiento.</p>

					<h2>Tipo</h2>
					<h3><?=$this->capitalize($this->escuela->tipo->nombre)?></h3>
					<p>Clave del tipo educativo.</p>
				</div>
				<div class='right'>
<!-- 					<h2>This is Photoshop's version of Lorem</h2> -->
<!-- 					<h3>This is Photoshop's version of Lorem Ipsum.</h3> -->
<!-- 					<p>Proim gravida nibh vel velit auctor aliquet. Aenean sollicitudin, -->
<!-- 					lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagit- -->
<!-- 					tis sem nibh id elit.</p> -->
					<div class='comment-info'>
						<p class='rating'><?=$this->capitalize($this->escuela->total_evaluados)?><a href='#'></a></p>
						<h2>Número de alumnos evaluados</h2>
					</div>
					<?php if($this->escuela->nivel->id == 12){ ?>
						<div class='comment-info'>
							<p class='rating'><?=$this->capitalize($this->escuela->poco_confiables)?><a href='#'></a></p>
							<h2>Resultados no confiables</h2>
						</div>					
					<?php } ?>
					<div class='comment-info'>
						<p class='rating'><?=$this->capitalize($this->escuela->promedio_espaniol)?><a href='#'></a></p>
						<h2>Promedio de Español</h2>
					</div>					
					<div class='comment-info'>
						<p class='rating'><?=$this->capitalize($this->escuela->promedio_matematicas)?><a href='#'></a></p>
						<h2>Promedio de Matemáticas</h2>
					</div>					
					<div class='comment-info'>
						<p class='rating'><?=$this->capitalize($this->escuela->promedio_general)?><a href='#'></a></p>
						<h2>Promedio general</h2>
					</div>					
				</div>
			</div>
		</div>
		<div class='tab jscrollpane charts'><div class='chart-box'>
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
					<option value='ocupacion 1'>Categoría 1</option>
					<option value='ocupacion 2'>Categoría 2</option>
					<option value='ocupacion 3'>Categoría 3</option>
					<option value='ocupacion 4'>Categoría 4</option>
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

<?php $this->include_template('resultados','compara')?>
