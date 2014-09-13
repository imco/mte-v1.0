<div class='perfil container B preescolar'>
	<div class="box-head">
		<div class='head'>
			<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
			<div class="clear"></div>
		</div>
		<div class='info_B top'>
			<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
		</div>		
	</div>
	<div class='column left'>
		<div class='map-wrap'>	
			<div class='info_B lateral' itemscope itemtype="http://schema.org/LocalBusiness">
				<div class="top-info">
					<div class="cal-escuela">
						<span class="hidden CCT"><?=$this->escuela->cct?></span>
						<a href="/califica_tu_escuela/califica/<?=$this->escuela->cct?>" class="button-frame"><span class="button-califica orange-effect"><span class="icon-cal"></span>Califica tu escuela</span></a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="box">
					<p class='hidden' itemprop="name"><?=$this->capitalize($this->escuela->nombre)?></p>
					<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
					<ul class="data">
						<li><span>Clave:</span> <?=$this->escuela->cct?></li>
						<li><span>Turno:</span> <?=$this->capitalize($this->escuela->turno->nombre)?></li>
						<li><span><?=$controles[$this->escuela->control->id]?></span></li>
						<li><span>Teléfonos:</span> <?=$this->escuela->telefono?></li>
						<li><span>Correo electrónico:</span> <?=$this->str_limit($this->escuela->correoelectronico,24);?></li>
						<?php if($this->escuela->paginaweb){ ?>
							<li><a href="<?=$this->escuela->paginaweb?>"><?=$this->str_limit($this->escuela->paginaweb,21) ?></a></li>
						<?php } ?>
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
		<div class="info_B bottom">
			<div class="box_info">
				<ul>
					<!--<li class='address' itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						Dirección:
						<span class='title'>
							<span itemprop="streetAddress"><?=$this->capitalize($this->escuela->domicilio)?></span>
							<span itemprop="addressLocality"><?=$this->capitalize($this->escuela->localidad->nombre)?></span>, 
							<span itemprop="addressRegion"><?=$this->capitalize($this->escuela->entidad->nombre)?></span>
							<span itemprop="addressCountry" content="MX"></span>
						</span>
					</li>-->
					<li><span>Calle:</span> <?=$this->capitalize($this->escuela->domicilio)?></li>
					<li><span>Municipio:</span> <?=$this->capitalize($this->escuela->municipio->nombre)?></li>
				</ul>

			</div>
			<div class="box_info">
				<ul>
					<li><span>Localidad:</span> <?=$this->capitalize($this->escuela->localidad->nombre)?></li>
					<li><span>Entidad:</span> <?=$this->capitalize($this->escuela->entidad->nombre)?></li>
				</ul>

				<!--<p class='web'>
					<?=$this->str_limit($this->escuela->paginaweb,21) ?>
				</p>-->				
			</div>
			<?php if($this->escuela->censo){
				$tmpPersons = $this->escuela->censo;
			?>
				
				<div class="clear"></div>
				<div class='censo-box'>
					<span class='text'>Número de alumnos:</span>
					<span class='num'><?= $tmpPersons['num_alumnos'] ?></span>
				</div>
				<div class='censo-box'>
					<span class='text'>Total de personal:</span>
					<span class='num'><?= $tmpPersons['num_personal'] ?></span>
				</div>
				<div class='censo-box'>
					<span class='text'>Grupos:</span>
					<span class='num'><?= $tmpPersons['num_grupos'] ?></span>
				</div>
			<?php } ?>
			<div class='clear'></div>
		</div>
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<!--<p>Deja aquÃ­ un comentario sobre esta escuela</p>-->
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja aquí un comentario sobre esta escuela' name='comentario' class='required'></textarea>
				
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
			<!--  jscrollpane-->

			<!--<?php 
			if($this->escuela->infraestructura){
					$aulas = $fields = '';
					foreach($this->escuela->infraestructura as $key => $item){
						if(isset($item[1]) && $key > 1 && $key!=8 && $key<11){
							$val = strtolower($item[1]);
							$k = trim(preg_replace('/  1\z/i','',$item[0]));
							//var_dump($k);
							if($k == 'Total de aulas') $aulas = $val;
							else $fields .= "<tr><td>{$k}</td><td><span class='{$val} cel'>{$val}</span></td></tr>";
						}
					}
			?>
				<div class='head t-tabs'><p class='title-tabs'>Infraestructura escolar</p></div>
				<div class='tab on infraestructura-tab' id='tab-infraescructura'>
					<h2>Información disponible corresponde al ciclo 2007</h2>
					<?php if($aulas){ ?><p class="border_b">Total de aulas en uso <?=$aulas?></p><?}?>
					<p class="question">¿Con qué instalaciones cuenta esta escuela?</p>
					<table class='info_table'>
						<tbody>
							<tr>
								<th>Instalaciones</th>
								<th></th>
							</tr>
							<?=$fields?>
						</tbody>
					</table>
				</div>
			<?php } ?>-->
		<?php if($this->escuela->censo && ($infra = $this->escuela->censo['infraestructura'])){  ?>
			<div class='head t-tabs'><p class='title-tabs'>Infraestructura escolar</p></div>
			<div class='tab on infraestructura-tab' id='tab-infraescructura'>
				<h2>Información disponible corresponde al ciclo 2013/2014</h2>
				<!--<p class="border_b">Total de aulas en uso</p>-->
				<p class="question">¿Con qué instalaciones cuenta esta escuela?</p>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Instalaciones</th>
							<th>esta escuela</th>
						</tr>
						<tr><td>Aulas para clase</td><td><span class=" cel"> <?=$infra['Aulas para impartir clase']?></span></td></tr>
						<?php $on = $infra['Áreas deportivas y recreativas'] ?>
						<tr><td>Áreas deportivas o recreativas</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Áreas deportivas y recreativas'] ?>
						<tr><td>Patio o plaza cívica</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<tr><td>Sala de cómputo</td><td><span class=" cel"><?=$infra['Aulas de cómputo']?></span></td></tr>
						<tr><td>Cuartos para baño o sanitarios</td><td><span class=" cel"><?=$infra['Cuartos para baños o sanitarios']?></span></td></tr>
						<tr><td>Tazas sanitarias</td><td><span class=" cel"><?=$infra['Tazas sanitarias']?></span></td></tr>
						<?php $on = $infra['Letrina u hoyo negro'] ?>
						<tr><td>Letrinas y hoyo negro</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<tr><td>Lavamanos</td><td><span class=" cel"><?=$infra['Lavamanos']?></span></td></tr>
					</tbody>
				</table>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Servicios</th>
							<th>esta escuela</th>
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
						<?php $on = $infra['Cooperativa, cafetería o tienda escolar'] ?>
						<tr><td>Cafetería</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>
						<?php $on = $infra['Enfermería o servicio médico'] ?>
						<tr><td>Servicio médico</td><td><span class="<?=$on=='S'?'si':'no'?> cel"><?=$on?></span></td></tr>

					</tbody>
				</table>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Seguridad</th>
							<th>esta escuela</th>
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
				<p class="gray_text start"><span class="icon"></span>Calificación global de la escuela según usuarios:</p>
				<?php
                $cp = 0;
                $pt = 0;
				if($this->escuela->calificaciones){
					foreach($this->escuela->calificaciones as $calificacion){
						if(isset($calificacion->calificacion)){
							$cp++;
							$pt += $calificacion->calificacion;
						}
					}
					$pro = $pt/$cp;
					$pro = number_format($pro,2);
					$cali = "Calificación global {$pro}";
				}else{
					$cali = "Calificación global n/a";
				}
				?>
				<p class="border_b"><?=$cali?></p>

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
				<!--

				<?php if(isset($this->escuela->calificaciones)) {?>
				<a href='top' class="sort recientes"><span class="triangle"></span> MÃ¡s recientes</a>
				<a href='bottom' class="sort populares on"><span class="triangle"></span>MÃ¡s populares</a>
				<?php
				}
				if($this->escuela->calificaciones){
				echo '<div class="container comments">';
					foreach($this->escuela->calificaciones as $calificacion){
						$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
                        $coment = stripslashes($coment);
						$text_calificacion = isset($calificacion->calificacion)?'<span>CalificaciÃ³n <br /> otorgada</span>':'';
						
						$ocupacion = $calificacion->ocupacion =='padredefamilia' || $calificacion->ocupacion == 'Padre de familia' ? 'Padre de familia':($this->capitalize($calificacion->ocupacion));
						$cali = $calificacion->calificacion;
						$cali = $cali > 10?$cali/10:$cali;//error cuendo en la db se calificaba de a 100
						//var_dump(json_decode($calificacion->calificaciones));
						echo <<<EOD
						<div class='comment'>
							<p class='rating'>{$text_calificacion} {$cali}<span class='likes'>{$calificacion->likes}</span><a href='/escuelas/like_calificacion/{$calificacion->id}/'></a></p>
							<h2>{$calificacion->nombre} ({$ocupacion}) </h2>
							<p>{$coment}</p>
							<span class='hidden timestamp'>$calificacion->timestamp</span>
						</div>
EOD;
					}
				echo "</div>";
				}else{?>
					<div class='buble-sin-comentario'>
						<p>SÃ© el primero en escribir un comentario</p>
					</div>
				<?php }
				if($this->get('error')){
					echo "
						<span>
						Error no ingreso las letras de control correctamente.
						</span>
						";
				}
				?>
				-->
			</div>
		</div>	
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<!--<p>Deja aquÃ­ un comentario sobre esta escuela</p>-->
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja aquí un comentario sobre esta escuela' name='comentario' class='required'></textarea>
				
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
				<div class='title'>
					<p>Porcentaje de 
					<br />
					alumnos en 
					<br />
					nivel "Reprobado"
					<br />
					<span><?=number_format($this->escuela->pct_reprobados*100,1)?> %</span>
					</p>
				</div>
				<div class="preescolar-image">
					<h3>Preescolar</h3>
					<img src="/templates/mtev1/img/cubitos.png" alt="Preescolar">
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
			<?php if($this->escuela->censo){ ?>
				<div class="box-yesno ">
					<?php //$this->print_img_tag('padres-de-familia.png'); ?>
					<img src="/templates/mtev1/img/padres-de-familia.png" alt="Asociacion de padres de familia">
					<p>¿Cuenta con Asociación de padres de familia?</p>
					<?php $on = $this->escuela->censo['infraestructura']['Asociación de padres de familia']; ?>
					<div class="yes <?=$on=='S'?'on':'';?>"><span class="circle"></span>Sí</div>
					<div class="no <?=$on!='S'?'on':'';?>"><span class="circle"></span>No</div>
				</div>
				<div class="box-yesno orange">
					<?php //$this->print_img_tag('consejo.png'); ?>
					<img src="/templates/mtev1/img/consejo.png" alt="Consejo">
					<p>¿Cuenta con Consejo de participacion social?</p>
					<?php $on = $this->escuela->censo['infraestructura']['Consejo de participación social']; ?>
					<div class="yes <?=$on=='S'?'on':'';?>"><span class="circle"></span>Sí</div>
					<div class="no <?=$on!='S'?'on':'';?>"><span class="circle"></span>No</div>
				</div>
				<div class="box-yesno green">
					<p>¿Esta escuela fue censada?</p>
					<?php $on = $this->escuela->censo['status']; ?>
					<div class="yes <?=$on=='Censado'?'on':'';?>"><span class="circle"></span>Sí</div>
					<div class="no <?=$on!='Censado'?'on':'';?>"><span class="circle"></span>No</div>
				</div>
			<?php } ?>
				<!--
				<div class="influencia">
					<a class="button" href="#">
						<span class="icon">!</span>
						<span class="txt">¿En mi escuela 
						<br />
						hay INFLUENCIA?</span>
					</a>
					<form class="influencia pop" action="">
						<textarea id="" name="" placeholder="Comentario:"></textarea>
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
						<input type="submit" value="ENVIAR" />
	
					</form>
				</div>-->


				<div class="lista-programas federales">
					<h2>Programas federales</h2>
					<ul>
						<?php
						foreach($this->programas_federales as $programa){
						?>
						<li class='<?= isset($this->escuela->programas[$programa->m_collection]) ?"on":""?>'><a href="/programas/index/<?=$programa->id?>">
							<?=$programa->nombre?>
							<?php
							//var_dump($this->escuela->{$programa->m_collection});
							if(isset($this->escuela->programas[$programa->m_collection]->anios)){
								echo implode(",",$this->escuela->programas[$programa->m_collection]->anios);
							}
							?>
						</a></li>
						<?} ?>
					</ul>			
				</div>

				<div class="lista-programas osc">
					<h2>Programas OSC's</h2>
					<ul>
						<?php
						foreach($this->programas_osc as $programa){
						    $datoExtra = "";
						    if($programa->id==5)
						    	$datoExtra = " (datos del 2012)";
						?>

						<li class='<?= isset($this->escuela->programas[$programa->m_collection]) ?"on":""?>'><a href="/programas/index/<?=$programa->id?>">
							<?=$programa->nombre.$datoExtra?>
						</a></li>
						<? } ?>
					</ul>			
				</div>

			</div>
		</div>
	</div>
	<div class='clear'></div>
</div>

<?php $this->include_template('resultados-escuela','compara')?>
