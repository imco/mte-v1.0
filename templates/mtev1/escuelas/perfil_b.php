<div class='perfil container B'>
	<div class="box-head">
		<div class='head'>
			<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
			<a href="/compara/escuelas" class="button-frame"><span class="compara-button orange-effect">Comparar</span></a>
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
					<div class='rank'>
						<div class='posicion'>
							<?php $this->print_img_tag('perfil/blue/posicion.png');?>
							<p>Posición estatal</p>
							<h2>
								<?=isset($this->escuela->rank_entidad) ? number_format($this->escuela->rank_entidad ,0): '--' ?> <span>de</span> <?=number_format($this->entidad_cct_count,0)?>
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
			<div id='map-data' class='hidden'><?=json_encode($this->escuelas_digest)?></div>
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
				
				<p class='director'>
					<!--<span class='icon sprit2'></span>
					Nombre del Director
					<span class='title'></span>-->
				</p>

			</div>
			<div class="box_info">
				<p class='tel'>
					Teléfonos:
					<span class='icon sprit2'></span>
					<span itemprop="telephone" class='title'>
						<?=$this->escuela->telefono?>
					</span>
					<span class='clear'></span>
				</p>
				<p class='email'>
					<span class='icon sprit2'></span>
					Correo electrónico:<!--Correo electrónico:-->
					<span itemprop="email" class='title'>
						<?=$this->str_limit($this->escuela->correoelectronico,20);?>
					</span>
					<span class='clear'></span>
				</p>

				<!--<p class='web'>
					<?=$this->str_limit($this->escuela->paginaweb,21) ?>
				</p>-->				
			</div>
			<?php if($this->escuela->censo_2013){foreach($this->escuela->censo_2013 as $e){ ?>
				<div class="clear"></div>
				<div class='censo-box'>
					<span class='text'>Número de Alumnos:</span>
					<span class='num'><?= $e['num_alumnos'] ?></span>
				</div>
				<div class='censo-box'>
					<span class='text'>Total de personal:</span>
					<span class='num'><?= $e['num_personal'] ?></span>
				</div>
				<div class='censo-box'>
					<span class='text'>Grupos:</span>
					<span class='num'><?= $e['num_grupos'] ?></span>
				</div>
			<?php break;}} ?>
			<div class='clear'></div>
		</div>
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<!--<p>Deja aquÃ­ un comentario sobre esta escuela</p>-->
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja aquí un comentario sobre esta escuela' name='comentario' class='required'></textarea>
				
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
<!--					--><?//=$this->get_captcha();?>
					<p><input type='submit' value='Enviar' /></p>
					<p>Aviso de privacidad.
						<span>
						En ningún momento haremos público tu correo electrónico con tu reporte o comentario.
						</span>
					</p>
				</div>

			</fieldset>		
		</form>
			<ul class='tabs <?=$this->escuela->infraestructura?"":"no-infra"?>'>
				<li><a href='#tab-calificacion' class='reportes'>
					<span class='triangle'></span>
					Comentarios 
					y reportes
				</a></li>
				<?php if($this->escuela->infraestructura){ ?>
					<li><a href='#tab-infraescructura' class='result'>
						<span class='triangle'></span>
						Infraestructura escolar
					</a></li>
				<? } ?>
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
						<p>Resultados ENLACE <span>matemáticas</span></p>
					
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
						<p>Resultados ENLACE <span>español</span></p>
					
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
			<?php 
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
					echo '<p class="gray_text comm"><span class="icon"></span>Comentarios</p>';
					foreach($this->escuela->calificaciones as $calificacion){
						$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
                        $coment = stripslashes($coment);
						$text_calificacion = isset($calificacion->calificacion)?'<span>Calificación <br /> otorgada</span>':'';
						$ocupacion = $calificacion->ocupacion =='padredefamilia' || $calificacion->ocupacion == 'Padre de familia' ? 'Padre de familia':($this->capitalize($calificacion->ocupacion));
						$cali = $calificacion->calificacion;
						$cali = $cali > 10?$cali/10:$cali;//error cuendo en la db se calificaba de a 100
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
						<?php
						foreach($this->programas_federales as $programa){
						?>
						<li class='<?=$this->escuela->{$programa->m_collection} && count($this->escuela->{$programa->m_collection})?"on":""?>'><a href="/programas/index/<?=$programa->id?>">
							<?=$programa->nombre?>
							<?php
							//var_dump($this->escuela->{$programa->m_collection});
							if($this->escuela->{$programa->m_collection} && isset($this->escuela->{$programa->m_collection}[0]['anio'])){
								$anios = array();
								foreach($this->escuela->{$programa->m_collection} as $p) $anios[] = $p['anio'];
								echo implode(",",$anios);
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
						?>
						<li class='<?=$this->escuela->{$programa->m_collection} && count($this->escuela->{$programa->m_collection})?"on":""?>'><a href="/programas/index/<?=$programa->id?>">
							<?=$programa->nombre?>
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
