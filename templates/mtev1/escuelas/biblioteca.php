<div class='perfil container B perfil-custom perfil-biblioteca'>
	<div class="box-head">
		<div class='head'>
			<h1 class='main-name'>Nombre de la Biblioteca</h1>
			<div class="clear"></div>
		</div>
		<div class='info_B top'>
		</div>		
	</div>
	<div class='column left'>
		<div class='map-wrap'>
			<div class='info_B lateral' itemscope itemtype="http://schema.org/LocalBusiness">
				<div class="top-info">
					<div class="cal-escuela">
						<span class="hidden CCT"><?=$this->escuela->cct?></span>
						<a href="/califica_tu_escuela/califica/<?=$this->escuela->cct?>" class="button-frame"><span class="button-califica orange-effect"><span class="icon-cal"></span>Califica tu biblioteca</span></a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="box">
					<p class='hidden' itemprop="name"><?=$this->capitalize($this->escuela->nombre)?></p>
					<ul class="data">
						<li>
							<span>Domicilio: <?=$this->capitalize($this->escuela->domicilio)?>,  
							<?=$this->capitalize($this->escuela->municipio->nombre)?>, <?=$this->capitalize($this->escuela->localidad->nombre)?>, 
							<?=$this->capitalize($this->escuela->entidad->nombre)?>
							</span>
						</li>
						<li><span>Teléfono: <?=$this->escuela->telefono?></span></li>
						<li><span>Correo electronico: <?=$this->str_limit($this->escuela->correoelectronico,24);?></span></li>
						<?php if($this->escuela->paginaweb){ ?>
							<li><a href="<?=$this->escuela->paginaweb?>"><?=$this->str_limit($this->escuela->paginaweb,21) ?></a></li>
						<?php } ?>
						<li><span>Horario de atención:</span></li>
						<div class="clear"></div>
					</ul>				
				</div>
			</div>

			<input type='hidden' id='map-selected' value='<?=$this->escuela->cct?>' name='map-selected'/>
			<div id='map-data' class='hidden'><?=json_encode($this->escuelas_digest)?></div>
			<div id='mapa' class='map'></div>
			<?php $this->include_template('map-infobox','global'); ?>
			<div class='clear'></div>
		</div>
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja aquí un comentario sobre esta biblioteca' name='comentario' class='required'></textarea>
				
				<div class="box-hidden">
					<input type='text' placeholder='Nombre' name='nombre' />
					<input type='text' class='required email' placeholder='Correo electrónico (obligatorio)' name='email' />
					<select class='custom-select required' name='ocupacion' >
						<option value=''>¿Quién eres?</option>
						<option value='alumno'>Alumno</option>
						<option value='exalumno'>Exalumno</option>
						<option value='padredefamilia'>Padre de familia</option>
						<option value='maestro'>Maestro</option>
						<option value='director'>Director</option>
						<option value='ciudadano'>Ciudadano</option>
					</select>
					<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' class='required' />
					<?=$this->get_captcha();?>
					<p><input type='submit' value='Enviar' /></p>
					<p class='accept'><input type="checkbox" name="accept" value="1" checked/><span>Quiero que mi nombre se publique junto con mi comentario.</span></p>
					<p class='advice'>
						Tu correo electrónico NO aparecerá con tu comentario. <br>
						Si no quieres que tu comentario se publique en el perfil de la escuela, escríbenos 
						a: contacto@mejoratuescuela.org
					</p>
				</div>

			</fieldset>		
		</form>
			<ul class='tabs <?=$this->escuela->infraestructura?"":"no-infra"?>'>
			<!---<ul class='tabs <?=$this->escuela->infraestructura?"":"no-infra"?>'>-->
				<li class=""><a href='#tab-calificacion' class='reportes'>
					<span class='triangle'></span>
					Comentarios 
					y reportes
				</a></li>
				<?php //if($this->escuela->infraestructura){ ?>
					<li class="on"><a href='#tab-infraescructura' class='result'>
						<span class='triangle'></span>
						Infraestructura escolar
					</a></li>
				<? //} ?>
				<div class='clear'></div>
			</ul>

		<div class='tab-container'>
		<?php if($this->escuela->censo && ($infra = $this->escuela->censo['infraestructura'])){  ?>
			<div class='head t-tabs'><p class='title-tabs'>Infraestructura escolar</p></div>
			<div class='tab on infraestructura-tab' id='tab-infraescructura'>
				<h2>Información disponible corresponde al ciclo 2013/2014</h2>
				<!--<p class="border_b">Total de aulas en uso</p>-->
				<p class="question">¿Con qué instalaciones cuenta esta biblioteca?</p>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Instalaciones</th>
							<th>esta biblioteca</th>
						</tr>
						<tr><td>Aulas para clase</td><td><span class=" cel"> <?=$infra['Aulas para impartir clase']?></span></td></tr>
						<?php $on = $infra['Áreas deportivas y recreativas'] ?>
						<tr><td>Áreas deportivas o recreativas</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Áreas deportivas y recreativas'] ?>
						<tr><td>Patio o plaza cívica</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<tr><td>Sala de cómputo</td><td><span class=" cel"><?=$infra['Aulas de cómputo']?></span></td></tr>
						<tr><td>Cuartos para baño o sanitarios</td><td><span class=" cel"><?=$infra['Cuartos para baños o sanitarios']?></span></td></tr>
						<tr><td>Tazas sanitarias</td><td><span class=" cel"><?=$infra['Tazas sanitarias']?></span></td></tr>
					</tbody>
				</table>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Servicios</th>
							<th>esta biblioteca</th>
						</tr>
						<?php $on = $infra['Energía eléctrica'] ?>
						<tr><td>Energia eléctrica</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Servicio de agua de la red pública'] ?>
						<tr><td>Servicio de agua de la red pública</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Drenaje'] ?>
						<tr><td>Drenaje</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Cisterna o aljibe'] ?>
						<tr><td>Cisterna o aljibe</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Servicio de internet'] ?>
						<tr><td>Servicio de internet</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Teléfono'] ?>
						<tr><td>Teléfono</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>

					</tbody>
				</table>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Seguridad</th>
							<th>esta biblioteca</th>
						</tr>
						<?php $on = $infra['Señales de protección civil'] ?>
						<tr><td>Señales de protección civil</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Rutas de evacuación'] ?>
						<tr><td>Rutas de evacuación</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Salidas de emergencia'] ?>
						<tr><td>Salidas de emergencia</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Zonas de seguridad'] ?>
						<tr><td>Zonas de seguridad</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
					</tbody>
				</table>
			</div>
		<?php } ?>
			<div class='head t-tabs'><p class='title-tabs'>Comentarios</p></div>
			<div class='tab on calificacion-tab' id='tab-calificacion'>
				<a name='calificaciones'></a>
				<p class="gray_text start"><span class="icon"></span>Calificación global de la biblioteca según usuarios:</p>
				<p class="border_b">Calificación global n/a</p>

				<p class="gray_text list"><span class="icon"></span>Calificación promedio por pregunta:</p>

				<table class='info_table'>

					<tbody>
                        <?php
                        if ($this->preguntas) {
                            foreach($this->preguntas as $pregunta) {
                                echo "<tr>
                                        <td>{$pregunta->titulo}</td>
                                        <td class='cel'>".(isset($pregunta->promedio) ? $pregunta->promedio:"n/a")."</td>
                                    </tr>";
                            }
                        }
                        ?>
					</tbody>
				</table>
				<div class="wrap_comments">
					<?php if($this->escuela->calificaciones){ 
						//var_dump($this->escuela->calificaciones);
					echo '<p class="gray_text comm"><span class="icon"></span>Comentarios</p>';
					foreach($this->escuela->calificaciones as $calificacion){
						if(isset($calificacion->activo) && $calificacion->activo){
							$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
	                			        $coment = stripslashes($coment);
							$text_calificacion = isset($calificacion->calificacion)?'<span>Calificación <br /> otorgada</span>':'';
							$ocupacion = $calificacion->ocupacion =='padredefamilia' || $calificacion->ocupacion == 'Padre de familia' ? 'Padre de familia':($this->capitalize($calificacion->ocupacion));
							$cali = $calificacion->calificacion;
							$cali = $cali > 10?$cali/10:$cali;//error cuendo en la db se calificaba de a 100
							$nombreCalificacion  = ($calificacion->acepta_nombre == 1) ? $calificacion->nombre : ''; 
							date_default_timezone_set('America/Mexico_City');
							$time = date("d M Y",strtotime($calificacion->timestamp));
							echo <<<EOD
						<div class="comment">
							<p><span class="icon"></span>Calificación: {$cali} <span>| {$nombreCalificacion} ({$ocupacion}) </span></p>
							<p>{$time}.- {$calificacion->comentario}
							</p>
						</div>
EOD;
							}
						}
					} ?>
				</div>
			</div>
		</div>	
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja aquí un comentario sobre esta biblioteca' name='comentario' class='required'></textarea>
				
				<div class="box-hidden">
					<input type='text' placeholder='Nombre' name='nombre' />
					<input type='text' class='required email' placeholder='Correo electronico (obligatorio)' name='email' />
					<select class='custom-select required' name='ocupacion' >
						<option value=''>¿Quién eres?</option>
						<option value='alumno'>Alumno</option>
						<option value='exalumno'>Exalumno</option>
						<option value='padredefamilia'>Padre de familia</option>
						<option value='maestro'>Maestro</option>
						<option value='director'>Director</option>
						<option value='ciudadano'>Ciudadano</option>
					</select>
					<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' class='required' />
<!--					--><?//=$this->get_captcha();?>
					<p><input type='submit' value='Enviar' /></p>
					<p class='accept'><input type="checkbox" name="accept" value="1" checked/><span>Quiero que mi nombre se publique junto con mi comentario.</span></p>
					<p class='advice'>
						Tu correo electrónico NUNCA aparecerá con tu comentario. <br>
						Si no quieres que tu comentario se publique en el perfil de la escuela, escríbenos 
						a: contacto@mejoratuescuela.org
					</p>
				</div>

			</fieldset>		
		</form>
	</div>
	<div class='column right'>
		<div class="box">
			<div class='califica'>	
				<div class="section-image">
					<h3>Biblioteca</h3>
					<img src="/templates/mtev1/img/biblio.png" alt="Biblioteca">
				</div>	
				<div class="share-blue">
					<a href="javascript:window.print()" class="option print"><span class="icon"></span>Imprimir</a>
					<a href="#" class="option share"><span class="icon"></span></span>Compartir</a>	
					<?php
					if($this->location == 'escuelas' && $this->get('action')=='index')
						$this->include_template('share_buttons_simple','global');
					?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div class='clear'></div>
</div>

