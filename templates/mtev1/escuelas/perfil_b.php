<div class='perfil container B'>
	<div class='head'>
		<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
		<a href="#" class="button-frame"><span class="compara-button">Comparar</span></a>
		<div class="clear"></div>
	</div>
	<div class='info_B top'>
			<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
			<ul class="data">
				<li>Clave <?=$this->escuela->cct?></li>
				<li><?=$this->capitalize($this->escuela->nivel->nombre)?></li>
				<li>Turno <?=$this->capitalize($this->escuela->turno->nombre)?></li>
				<li><?=$controles[$this->escuela->control->id]?></li>
				<div class="clear"></div>
			</ul>
	</div>
	<div class='column left'>
		<div class='map-wrap'>	
			<div class='info_B lateral' itemscope itemtype="http://schema.org/LocalBusiness">
				<div class="top-info">
					<div class='rank'>
						<div class='posicion'>
							<?php $this->print_img_tag('home/posicion.png');?>
							<p>Posición estatal</p>
							<h2>
								<?=isset($this->escuela->rank_entidad) ? number_format($this->escuela->rank_entidad ,0): '--' ?> de <?=number_format($this->entidad_cct_count,0)?>
							</h2>
						</div>
					</div>
					<div class="cal-escuela">
						<a href="#" class="button-frame"><span class="button-califica"><span class="icon-cal"></span>Califica tu escuela</span></a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="box">
					<p class='hidden' itemprop="name"><?=$this->capitalize($this->escuela->nombre)?></p>
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
					<!--<p class='director'>
						<span class='icon'></span>
						Director/Directora
						<span class='title'>
							
						</span>
						<div class='clear'></div>
					</p>-->
					<p class='tel'>
						Teléfonos:
						<span class='icon sprit2'></span>
						<span itemprop="telephone" class='title'>
							<?=$this->escuela->telefono?>
						</span>
					<div class='clear'></div>
					</p>
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
			</div>
			<input type='hidden' id='map-selected' value='<?=$this->escuela->cct?>' name='map-selected'/>
			<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
			<div id='mapa' class='map'></div>
			<?php $this->include_template('map-infobox','global'); ?>
			<div class='clear'></div>
		</div>
			<ul class='tabs'>
				<li></li>

				<li><a href='#'  class='infor'>
					<span class='icon sprit2'></span>
					<span class='triangle'></span>
					Más información
				</a></li>
				<li><a href='#' class='reportes'>
					<span class='icon sprit2'></span>
					<span class='triangle'></span>
					Presupuestos asignados
				</a></li>
				<li><a href='#' class='result'>
					<span class='icon sprit2'></span>
					<span class='triangle'></span>
					Resultados educativos
				</a></li>
				<li class='on'><a href='#' class='long comentarios'>
					<span class='icon sprit2'></span>
					<span class='triangle'></span>
					Comentarios con calificación
				</a></li>
				<div class='clear'></div>
			</ul>

		<div class='tab-container'>
			<div class='tab jscrollpane on calificacion-tab'>
				<a name='calificaciones'></a>
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
			</div>
			<!---->
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
				<a name='reportes_ciudadanos'></a>
				<div class='gray-box presupuestos'>
					<!-- <h2>Promedio nacional</h2> -->
					<h2>Esta escuela no tiene información de presupuesto disponible.</h2>
					<!--
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
					-->
				</div>
			</div>
			<div class='tab jscrollpane'>
				<h2>En construcción.</h2>
				<!--<div class='mas-info'>
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
				</div>-->
			</div>

			<div class='tab jscrollpane'>
				
			</div>
		</div>	
	</div>
	<div class='column right'>
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
		<p class='total_alumnos'>
			Número de alumnos <br />
			evaluados <br />
			<span>
			<?=number_format($this->escuela->total_evaluados)?>
			</span>
		</p>
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
			<a href='/califica_tu_escuela/califica/<?=$this->escuela->cct?>' class='title'>
				<?php //$this->print_img_tag('home/califica.png');?>
				<span class="icon sprit2"></span>
				<p>Califica tu escuela</p>
				
			</a>			
			<div class='title petitions'>

			</div>
		</div>
	</div>
	<div class='clear'></div>
</div>
<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B container'>
	<fieldset>
		<p>Deja aquí un comentario sobre esta escuela</p>
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
		<textarea placeholder='Escribe aquí' name='comentario' class='required'></textarea>
		<p>Aviso de privacidad.
			<span>
			En ningún momento haremos público tu correo electrónico con tu reporte o comentario.
			</span>
		</p>
			<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' class='required' />
			<?=$this->get_captcha();?>
		<p><input type='submit' value='Enviar' /></p>
	</fieldset>		
</form>

<?php $this->include_template('resultados-escuela','compara')?>
