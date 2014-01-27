<div class='perfil container B'>
	<div class="box-head">
		<div class='head'>
			<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
			<a href="/compara/escuelas" class="button-frame"><span class="compara-button orange-effect">Comparar</span></a>
			<div class="clear"></div>
		</div>
		<div class='info_B top'>
				<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
				<!--<ul class="data">
					<li>Clave <?=$this->escuela->cct?></li>
					<li><?=$this->capitalize($this->escuela->nivel->nombre)?></li>
					<li>Turno <?=$this->capitalize($this->escuela->turno->nombre)?></li>
					<li><?=$controles[$this->escuela->control->id]?></li>
					<div class="clear"></div>
				</ul>-->
		</div>		
	</div>
	<div class='column left'>
		<div class='map-wrap'>	
			<div class='info_B lateral' itemscope itemtype="http://schema.org/LocalBusiness">
				<div class="top-info">
					<div class='rank'>
						<div class='posicion'>
							<?php $this->print_img_tag('perfil/blue/posicion.png');?>
							<p>Posición estatal</p>
							<h2>
								<?=isset($this->escuela->rank_entidad) ? number_format($this->escuela->rank_entidad ,0): '--' ?> de <?=number_format($this->entidad_cct_count,0)?>
							</h2>
						</div>
					</div>
					<div class="cal-escuela">
						<span class="hidden CCT"><?=$this->escuela->cct?></span>
						<a href="/califica_tu_escuela/califica/<?=$this->escuela->cct?>" class="button-frame"><span class="button-califica"><span class="icon-cal"></span>Califica tu escuela</span></a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="box">
					<p class='hidden' itemprop="name"><?=$this->capitalize($this->escuela->nombre)?></p>
					<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
					<ul class="data">
						<li>Clave <?=$this->escuela->cct?></li>
						<li><?=$this->capitalize($this->escuela->nivel->nombre)?></li>
						<li>Turno <?=$this->capitalize($this->escuela->turno->nombre)?></li>
						<li><?=$controles[$this->escuela->control->id]?></li>
						<li>Entidad: <?=$this->capitalize($this->escuela->entidad->nombre)?></li>
						<li>Municipio: <?=$this->capitalize($this->escuela->municipio->nombre)?></li>
						<li>Localidad: <?=$this->capitalize($this->escuela->localidad->nombre)?></li>
						<div class="clear"></div>
					</ul>				
				</div>
			</div>

			<input type='hidden' id='map-selected' value='<?=$this->escuela->cct?>' name='map-selected'/>
			<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
			<div id='mapa' class='map'></div>
			<?php $this->include_template('map-infobox','global'); ?>
			<div class='clear'></div>
		</div>
		<div class="info_B bottom">
			<div class="box_info">
				<p class='address' itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<span class='icon sprit2'></span>
					Dirección:
					<span class='title'>
						<span itemprop="streetAddress"><?=$this->capitalize($this->escuela->domicilio)?></span>
						<span itemprop="addressLocality"><?=$this->capitalize($this->escuela->localidad->nombre)?></span>, 
						<span itemprop="addressRegion"><?=$this->capitalize($this->escuela->entidad->nombre)?></span>
						<span itemprop="addressCountry" content="MX"></span>
					</span>
				</p>
				<p class='tel'>
					Teléfonos:
					<span class='icon sprit2'></span>
					<span itemprop="telephone" class='title'>
						<?=$this->escuela->telefono?>
					</span>
				<div class='clear'></div>
				</p>

			</div>
			<div class="box_info">
				<p class='email'>
					<span class='icon sprit2'></span>
					Mail:
					<span itemprop="email" class='title'>
						<?=$this->str_limit($this->escuela->correoelectronico,20);?>
					</span>
					<div class='clear'></div>
				</p>

				<p class='web'>
					<?=$this->str_limit($this->escuela->paginaweb,21) ?>
				</p>				
			</div>
			<div class="clear"></div>
		</div>
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<!--<p>Deja aquí un comentario sobre esta escuela</p>-->
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja aqui un comentario sobre esta escuela' name='comentario' class='required'></textarea>
				
				<div class="box-hidden">
					<input type='text' placeholder='Nombre' name='nombre' />
					<input type='text' class='required email' placeholder='Email (obligatorio)' name='email' />
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
					<p>Aviso de privacidad.
						<span>
						En ningún momento haremos público tu correo electrónico con tu reporte o comentario.
						</span>
					</p>
				</div>

			</fieldset>		
		</form>
			<ul class='tabs'>
				<li><a href='#tab-calificacion' class='reportes'>
					<span class='triangle'></span>
					Comentarios 
					y reportes
				</a></li>
				<li><a href='#tab-infraescructura' class='result'>
					<span class='triangle'></span>
					Infraestructura escolar
				</a></li>
				<li class='on'><a href='#tab-charts' class='long comentarios'>
					<span class='triangle'></span>
					Desempeño académico
				</a></li>
				<div class='clear'></div>
			</ul>

		<div class='tab-container'>
			<!--  jscrollpane-->
			<div class='head t-tabs'><p class='title-tabs'>Desempeño académico</p></div>
			<div class='tab charts on' id='tab-charts'><div class='chart-box'>
				<div class="n_alumnos border_b">
					<p>Número de alumnos evaluados</p>
					<span class="number"><?=$this->escuela->total_evaluados?></span>
				</div>
				<div class="n_alumnos border_b">
					<p>Porcentaje de alumnos en nivel reprobado</p>
					<span class="number"><?=$this->escuela->pct_reprobados."%"?></span>
				</div>
				<div class="wrap_chart border_b">
					<div class="info_chart">
						<span class="icon "></span>
						<p>Resultados enlace <span>matemáticas</span></p>
					
					</div>
					<div class="chart_content">
					<?php if($this->escuela->line_chart_espaniol ){
						echo "<div id='line-chart-data-matematicas' class='hidden'>".json_encode($this->escuela->line_chart_matematicas)."</div><div id='profile-line-chart-matematicas' class='chart'></div>";
					} ?>				
					</div>
					<div class="legend_chart">
						<div class="wrap_lc">
							<p><span class="circle"></span>3</p>
							<p><span class="circle"></span>4</p>
							<p><span class="circle"></span>5</p>
							<p><span class="circle"></span>6</p>					
						</div>

						<p class="under">_ _ _ _</p>
						<p>Promedio nacional</p>
					</div>
				</div>
				<div class="wrap_chart border_b">
					<div class="info_chart">
						<span class="icon"></span>
						<p>Resultados enlace <span>español</span></p>
					
					</div>
					<div class="chart_content">
					<?php if($this->escuela->line_chart_espaniol ){
						echo "<div id='line-chart-data-espaniol' class='hidden'>".json_encode($this->escuela->line_chart_espaniol)."</div><div id='profile-line-chart-espaniol' class='chart'></div>";
				}
				?>
					</div>

					<div class="legend_chart">
						<div class="wrap_lc">
							<p><span class="circle"></span>3</p>
							<p><span class="circle"></span>4</p>
							<p><span class="circle"></span>5</p>
							<p><span class="circle"></span>6</p>
						</div>
						<p class="under">_ _ _ _</p>
						<p>Promedio nacional</p>
					</div>
				</div>

			</div></div>
			<div class='head t-tabs'><p class='title-tabs'>Infraestructura escolar</p></div>
			<div class='tab on infraestructura-tab' id='tab-infraescructura'>
				<h2>Informacion disponible corresponde al ciclo xxx</h2>
				<p class="border_b">Total de Aulas en uso 35</p>
				<p class="question">¿Con qué instalaciones cuenta esta escuela?</p>
				<table class='info_table'>
					<tbody>
						<tr>
							<th>Instalaciones</th>
							<th>esta escuela</th>
						</tr>
						<tr>
							<td>Agua entubada</td>
							<td><span class='not cel'></span></td>
						</tr>
						<tr>
							<td>Luz</td>
							<td><span class='not cel'></span></td>
						</tr>
						<tr>
							<td>Barda o cercado perimetral</td>
							<td><span class='true cel'></span></td>
						</tr>
						<tr>
							<td>Canchas deportivas</td>
							<td><span class='true cel'></span></td>
						</tr>
						<tr>
							<td>Patio de la escuela</td>
							<td><span class='not cel'></span></td>
						</tr>
						<tr>
							<td>Baños</td>
							<td><span class='not cel'></span></td>
						</tr>
						<tr>
							<td>Sala de cómputo</td>
							<td><span class='true cel'></span></td>
						</tr>
					
					</tbody>
				</table>
				
			</div>

			<div class='head t-tabs'><p class='title-tabs'>Comentarios</p></div>
			<div class='tab on calificacion-tab' id='tab-calificacion'>
				<a name='calificaciones'></a>
				<p class="gray_text start"><span class="icon"></span>Calificación global de la escuela según usuarios</p>
				<?php if($this->escuela->calificaciones){
					$cp = 0;
					$pt = 0;
					$otp = array(0,0,0,0,0,0);
					foreach($this->escuela->calificaciones as $calificacion){
						if(isset($calificacion->calificacion)){
							$cp++;
							$pt += $calificacion->calificacion;
						}
						$other = json_decode($calificacion->calificaciones);
						for($i=0;$i<count($otp);$i++){
							$otp[$i] += $other[$i];
						}

					}
				
					$pro = $pt/$cp;
					$cali = "Calificación global {$pro}";
					
					for($i=0;$i<count($otp);$i++){
						$otp[$i] /= $cp;
					}
					$ci = 0;
				}

				?>
				<p class="border_b"><?=$cali?></p>

				<p class="gray_text list"><span class="icon"></span>Calificación promedio por pregunta</p>

				<table class='info_table'>

					<tbody>
						<tr>
							<td>Asistencia de los maestros</td>
							<td>
								<span class="cel"><?=$otp[$ci++]?></span>
							</td>
						</tr>
						<tr>
							<td>Preparación de los maestros</td>
							<td>
								<span class="cel"><?=$otp[$ci++]?></span>
							</td>
						</tr>
						<tr>
							<td>Infraestructura de la escuela</td>
							<td>
								<span class="cel"><?=$otp[$ci++]?></span>
							</td>
						</tr>
						<tr>
							<td>Relación con padres de familia</td>
							<td>
								<span class="cel"><?=$otp[$ci++]?></span>
							</td>
						</tr>
						<tr>
							<td>Honestidad y transparencia</td>
							<td>
								<span class="cel"><?=$otp[$ci++]?></span>
							</td>
						</tr>
						<tr>
							<td>Participación de padres de familia</td>
							<td>
								<span class="cel"><?=$otp[$ci++]?></span>
							</td>
						</tr>
					</tbody>
				</table>

				<p class="gray_text comm"><span class="icon"></span>Comentarios</p>

				<div class="wrap_comments">
					<div class="comment">
						<p><span class="icon"></span>Calificacion: 10 <span>| 10. Enero. 2014</span></p>
						<p>Nombre.- Este es el formato de comentario para "Comentarios y calificaciones ciudadanas". Este es el formato de comentario para "comentarios y calificaciones ciudadanas"."</p>
					</div>
					<?php if($this->escuela->calificaciones){ 
					foreach($this->escuela->calificaciones as $calificacion){
						$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
                        $coment = stripslashes($coment);
						$text_calificacion = isset($calificacion->calificacion)?'<span>Calificación <br /> otorgada</span>':'';
						
						$ocupacion = $calificacion->ocupacion =='padredefamilia' || $calificacion->ocupacion == 'Padre de familia' ? 'Padre de familia':($this->capitalize($calificacion->ocupacion));
						$cali = $calificacion->calificacion;
						$cali = $cali > 10?$cali/10:$cali;//error cuendo en la db se calificaba de a 100
						//var_dump(json_decode($calificacion->calificaciones));
						date_default_timezone_set('America/Mexico_City');
						$time = date("d M Y",strtotime($calificacion->timestamp));
						echo <<<EOD
					<div class="comment">
						<p><span class="icon"></span>Calificacion: {$cali} <span>| {$time}</span></p>
						<p>{$calificacion->nombre} ({$ocupacion}).- {$calificacion->comentario}
						</p>
					</div>
EOD;
						}
					} ?>
				</div>

				<!--

				<?php if(isset($this->escuela->calificaciones)) {?>
				<a href='top' class="sort recientes"><span class="triangle"></span> Más recientes</a>
				<a href='bottom' class="sort populares on"><span class="triangle"></span>Más populares</a>
				<?php
				}
				if($this->escuela->calificaciones){
				echo '<div class="container comments">';
					foreach($this->escuela->calificaciones as $calificacion){
						$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
                        $coment = stripslashes($coment);
						$text_calificacion = isset($calificacion->calificacion)?'<span>Calificación <br /> otorgada</span>':'';
						
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
						<p>Sé el primero en escribir un comentario</p>
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
			<!---->

			<!--
			<div class='tab jscrollpane'>
				<a name='reportes_ciudadanos'></a>
				<div class='gray-box presupuestos'>
					 <h2>Promedio nacional</h2>
					<h2>Esta escuela no tiene información de presupuesto disponible.</h2>
					
					<div class='column left'>
						<h3 class='gray'>
							Presupuesto anual para la Escuela
							<span>$89,000</span>
						</h3>
						<h3 class='blue'>Presupuesto para esta Escuela</h3>
						<p>Presupuesto anual $97,000</p>
					</div>
					<div class='column right'>
						<h3 class='gray'>
							Salario mensual por maestro
							<span>$89,000</span>
						</h3>
						<h3 class='blue'>Salario mensual por maestro</h3>
						<div class="salarios">
							<p>Maria Martinez
								<span>$7564
									<a href="">REPORTAR
										<span class="icon"></span>
									</a>
								</span>
							</p>
							<p>presupuesto anual 
								<span>$7564
									<a href="">REPORTAR
										<span class="icon"></span>
									</a>
								</span>
							</p>
							<p>presupuesto anual 
								<span>$7564
									<a href="">REPORTAR
										<span class="icon"></span>
									</a>
								</span>
							</p>
							<p>presupuesto anual 
								<span>$7564
									<a href="">REPORTAR
										<span class="icon"></span>
									</a>
								</span>
							</p>
						</div>

					</div>
					
				</div>
			</div>-->
			<!--
			<div class='tab jscrollpane'>
				<h2>En construcción.</h2>
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
						<div class='comment-info'>
							<p class='rating'><?=round($this->escuela->total_evaluados,2)?><a href='#'></a></p>
							<h2>Número de alumnos evaluados</h2>
						</div>
						<?php if($this->escuela->nivel->id == 12){ ?>
							<div class='comment-info'>
								<p class='rating'><?=round($this->escuela->poco_confiables,2)?><a href='#'></a></p>
								<h2>Resultados no confiables</h2>
							</div>					
						<?php } ?>
						<div class='comment-info'>
							<p class='rating'><?=round($this->escuela->promedio_espaniol,2)?><a href='#'></a></p>
							<h2>Promedio de Español</h2>
						</div>					
						<div class='comment-info'>
							<p class='rating'><?=round($this->escuela->promedio_matematicas,2)?><a href='#'></a></p>
							<h2>Promedio de Matemáticas</h2>
						</div>					
						<div class='comment-info'>
							<p class='rating'><?=round($this->escuela->promedio_general,2)?><a href='#'></a></p>
							<h2>Promedio general</h2>
						</div>					
					</div>
				</div>
			</div>
			
			<div class='tab jscrollpane'>
				
			</div>-->
		</div>	
	</div>
	<div class='column right'>
		<div class="box">
			<div class='semaforo'>
				<?php $on = $this->config->semaforos[$this->escuela->semaforo]?>
				<h2>Semáforo educativo</h2>
				<div class='level excelente<?= $on=='Excelente'?' on':''?>'>
					<p>Excelente</p>
					<span class='icon sprit2'></span>
					<div class='clear'></div>
				</div>
				<div class='level bien<?= $on=='Bien'?' on':''?>'>
					<p>Bien</p>
					<span class='icon sprit2'></span>
					<div class='clear'></div>
				</div>
				<div class='level panzazo<?= $on=='De panzazo'?' on':''?>'>
					<p>De panzazo</p>
					<span class='icon sprit2'></span>
					<div class='clear'></div>
				</div>
				<div class='level reprobado<?= $on=='Reprobado'?' on':''?>'>
					<p>Reprobado</p>
					<span class='icon sprit2'></span>
					<div class='clear'></div>
				</div>
				<?php
					if($this->escuela->semaforo >= 4){
						$semaforos = array('Escuela que no tomó prueba ENLACE','Escuela no Confiable','Esta escuela no tomó la prueba ENLACE para todos los años','La prueba ENLACE no esta disponible para este nivel escolar');
						echo "<div class='sem-overlay'><div class='icon sprit2 icon{$this->escuela->semaforo}'></div><div class='clear'></div>
						<p>".
						$semaforos[$this->escuela->semaforo-4]."</p></div>";
					}
				?>
			</div>
			<div class='clear'></div>
			<!--<p class='total_alumnos'>
				Número de alumnos <br />
				evaluados <br />
				<span>
				<?=number_format($this->escuela->total_evaluados)?>
				</span>
			</p>-->
			<div class='clear'></div>
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
				<!--<div class='title petitions'>
				</div>-->
				<div class="share-blue">
					<a href="javascript:window.print()" class="option print"><span class="icon"></span>Imprimir</a>
					<a href="#" class="option share"><span class="icon"></span></span>Compartir</a>	
					<?php
					if($this->location == 'escuelas' && $this->get('action')=='index')
						$this->include_template('share_buttons_simple','global');
					?>
					<div class="clear"></div>
				</div>

				<div class="lista-programas federales">
					<h2>Programas federales</h2>
					<ul>
						<li class='on'><a href="#">Programa escuelas de calidad 2008, 2009, 2010</a></li>
						<li><a href="#">Programa escuela segura 2008, 2009</a></li>
						<li><a href="#">Programa escuelas tiempo completo 2007</a></li>
					</ul>			
				</div>

				<div class="lista-programas osc">
					<h2>Programas OSC´s</h2>
					<ul>
						<li><a href="#">Escuela siempre Abierta</a></li>
						<li><a href="#">Programa escuela segura</a></li>
						<li><a href="#">Programa escuelas tiempo completo</a></li>
						<li><a href="#">Programa escuelas de calidad</a></li>
						<li><a href="#">Programa nacional de lectura</a></li>
						<li><a href="#">Escuela de Jornada Amplia</a></li>

					</ul>			
				</div>

			</div>
		</div>
	</div>
	<div class='clear'></div>
</div>

<?php $this->include_template('resultados-escuela','compara')?>
