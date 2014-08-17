<div class='perfil container B'>
	<div class="box-head">
		<div class='head'>
			<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
			<a href="/compara/escuelas" class="button-frame"><span class="compara-button orange-effect">Comparar</span></a>
			<?php if (isset($this->escuela->turnos) && count($this->escuela->turnos) > 1) {?>
                <span class="select-turno">
                    <select class="compara-button blue custom-select" id="turno_selector">
                        <?php foreach($this->escuela->turnos as $turno) {
                            $selected = "";
                            if ($turno->id == $this->escuela->selected_rank->turnos_eval) {
                                $selected = "selected='selected'";
                            }
                            echo "<option value='{$turno->id}' {$selected}>{$turno->nombre}</option>";
                        } ?>
                    </select>
                </span>
			<?php } ?>
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
								<?=isset($this->escuela->selected_rank->rank_entidad) ? number_format($this->escuela->selected_rank->rank_entidad ,0): '--' ?> <span>de</span> <?=number_format($this->entidad_cct_count,0)?>
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
						<li><span>Clave:</span> <?=$this->escuela->cct?></li>
						<li><span><?=$this->capitalize($this->escuela->nivel->nombre)?></span></li>
						<li><span>Turno:</span> <?=$this->capitalize($this->escuela->turno->nombre)?></li>
						<li><span><?=$controles[$this->escuela->control->id]?></span></li>
						<?php if( isset($this->escuela->censo_2013['persona_responsable']) && strlen(trim($this->escuela->censo_2013['persona_responsable']))>0 ){ ?>
							<!--<li>Persona responsable: <?=$this->capitalize($this->escuela->censo_2013['persona_responsable'])?></li>-->
						<?php } ?>							
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
					<li><span>Calle:</span> <?=$this->capitalize($this->escuela->domicilio)?></li>
					<li><span>Municipio:</span> <?=$this->capitalize($this->escuela->municipio->nombre)?></li>
				</ul>

			</div>
			<div class="box_info">
				<ul>
					<li><span>Localidad:</span> <?=$this->capitalize($this->escuela->localidad->nombre)?></li>
					<li><span>Entidad:</span> <?=$this->capitalize($this->escuela->entidad->nombre)?></li>
				</ul>
			</div>
			<?php if($this->censo){ ?>
            <?php foreach ($this->censo['turnos'] as $turno) {
                    if (count($this->censo['turnos']) > 1) {?>
                        <h4 style="color:#339dd1;font-weight: bold;"><?= $turno->nombre ?></h4>
                    <?php } ?>
				<div class='censo-box'>
					<span class='text'>Número de alumnos:</span>
					<span class='num'><?= $turno->alumnos ?></span>
				</div>
				<div class='censo-box'>
					<span class='text'>Total de personal:</span>
					<span class='num'><?= $turno->personal ?></span>
				</div>
				<div class='censo-box'>
					<span class='text'>Grupos:</span>
					<span class='num'><?= $turno->grupos ?></span>
				</div>
			<?php }
            } ?>
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
				<li><a href='#tab-calificacion' class='reportes'>
					<span class='triangle'></span>
					Comentarios 
					y reportes
				</a></li>
				<?php //if($this->escuela->infraestructura){ ?>
					<li><a href='#tab-infraescructura' class='result'>
						<span class='triangle'></span>
						Infraestructura escolar
					</a></li>
				<? //} ?>
                <?php
                foreach(array_reverse($this->escuela->rank) as $rank) {
                    $selected = $rank->turnos_eval == $this->escuela->selected_rank->turnos_eval;
                    $style = $selected ? "" : "style='display:none;'";
                    ?>
                    <li <?= $style ?> class='on turnos_switch turnos_switch_<?=$rank->turnos_eval?>'>
                        <a href='#tab-charts-<?=$rank->turnos_eval?>' class='long comentarios'>
                        <span class='triangle'></span>
                        Desempeño académico  <?= $this->capitalize($rank->turno_nombre) ?>
                        </a>
                    </li>
                <?php } ?>
				<div class='clear'></div>
			</ul>

		<div class='tab-container'>
        <?php
        foreach($this->escuela->rank as $rank) {
            $selected = $rank->turnos_eval == $this->escuela->selected_rank->turnos_eval;
            $style = $selected ? "" : "style='display:none;'";
            ?>
            <div <?= $style ?> class='head t-tabs turnos_switch turnos_switch_<?=$rank->turnos_eval?>'><p class='title-tabs'>Desempeño académico <?= $this->capitalize($rank->turno_nombre) ?></p></div>

            <div <?= $style ?> class='tab charts on turnos_switch turnos_switch_<?=$rank->turnos_eval?>' id='tab-charts-<?= $rank->turnos_eval ?>'>
                <div class='chart-box'>
                    <div class="n_alumnos border_b">
                        <p>Número de alumnos evaluados</p>
                        <span class="number"><?=$rank->total_evaluados?></span>
                    </div>
                    <div class="n_alumnos border_b">
                        <p>Porcentaje de alumnos en nivel reprobado</p>
                        <span class="number"><?=$rank->pct_reprobados."%"?></span>
                    </div>
                    <div class="wrap_chart border_b">
                        <div class="info_chart">
                            <span class="icon "></span>
                            <p>Resultados ENLACE <span>matemáticas</span></p>

                        </div>
                        <div class="chart_content">
                            <?php if($this->escuela->matematicas_charts && isset($this->escuela->matematicas_charts[$rank->turnos_eval])){
                                echo "<div id='line-chart-data-matematicas-{$rank->turnos_eval}' class='hidden'>".json_encode($this->escuela->matematicas_charts[$rank->turnos_eval])."</div><div id='profile-line-chart-matematicas-{$rank->turnos_eval}' name='matematicas-{$rank->turnos_eval}' class='chart'></div>";
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
                            <?php if($this->escuela->espaniol_charts && isset($this->escuela->espaniol_charts[$rank->turnos_eval])){
                                echo "<div id='line-chart-data-espaniol-{$rank->turnos_eval}' class='hidden'>".json_encode($this->escuela->espaniol_charts[$rank->turnos_eval])."</div><div id='profile-line-chart-espaniol-{$rank->turnos_eval}' name='espaniol-{$rank->turnos_eval}' class='chart'></div>";
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

                </div>
            </div>
        <?php } ?>
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
		<?php if($this->censo && ($infra = $this->censo['infraestructura'])){  ?>
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
            <?php
            if ($this->escuela->semaforos) {
                foreach ($this->escuela->semaforos as $semaforo) {
                    $style = "style='display:none;'";
                    if ($semaforo->turno == $this->escuela->selected_rank->turnos_eval) {
                        $style = "";
                    }
            ?>
			<div class='semaforo turnos_switch turnos_switch_<?=$semaforo->turno?>' <?= $style ?>>
				<?php $on = $this->config->semaforos[$semaforo->semaforo];?>
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
            </div>
				<?php
                        if($semaforo->semaforo >= 4 && $semaforo->semaforo < 8){
                            $semaforos = array('Esta escuela no tomó la prueba ENLACE','Los resultados de esta escuela no son confiables<br>(i)','Esta escuela no tomó la prueba ENLACE para todos los años','La prueba ENLACE no esta disponible para este nivel escolar');
                            echo "<div class='sem-overlay turnos_switch turnos_switch_{$semaforo->turno}' ><div class='icon sprit2 icon{$semaforo->semaforo}'></div><div class='clear'></div>
                            <p>".
                                $semaforos[$semaforo->semaforo-4]."</p><div class='popup-faq opc".($semaforo->semaforo)."'><p>Para más información consulta nuestra sección de <a href='/preguntas-frecuentes'>preguntas frecuentes</a></p></div></div>";
                        } else if ($semaforo->semaforo == 8){ //
                            echo "<div class='sem-overlay-brighter turnos_switch turnos_switch_{$semaforo->turno}'><div class='sprit-grey'></div><div class='clear'></div>
                            <p>NO HAY DATOS DE DESEMPEÑO DISPONIBLES PARA ESTA ESCUELA</p></div>";
                        }
                    }
                }
				?>
			<div class='clear'></div>
			<div class='califica'>
				<div class="share-blue">
					<a href="javascript:window.print()" class="option print"><span class="icon"></span>Imprimir</a>
					<a href="#" class="option share"><span class="icon"></span></span>Compartir</a>	
					<?php
					if($this->location == 'escuelas' && $this->get('action')=='index')
						$this->include_template('share_buttons_simple','global');
					?>
					<div class="clear"></div>
				</div>
			<?php if($this->censo){ ?>
				<div class="box-yesno ">
					<?php //$this->print_img_tag('padres-de-familia.png'); ?>
					<img src="/templates/mtev1/img/padres-de-familia.png" alt="Asociacion de padres de familia">
					<p>¿Cuenta con Asociación de padres de familia?</p>
					<?php $on = $this->censo['infraestructura']['Asociación de padres de familia']; ?>
					<div class="yes <?=$on=='S'?'on':'';?>"><span class="circle"></span>Sí</div>
					<div class="no <?=$on!='S'?'on':'';?>"><span class="circle"></span>No</div>
				</div>
				<div class="box-yesno orange">
					<?php //$this->print_img_tag('consejo.png'); ?>
					<img src="/templates/mtev1/img/consejo.png" alt="Consejo">
					<p>¿Cuenta con Consejo de participacion social?</p>
					<?php $on = $this->censo['infraestructura']['Consejo de participación social']; ?>
					<div class="yes <?=$on=='S'?'on':'';?>"><span class="circle"></span>Sí</div>
					<div class="no <?=$on!='S'?'on':'';?>"><span class="circle"></span>No</div>
				</div>
				<div class="box-yesno green">
					<p>¿Esta escuela fue censada?</p>
					<?php $on = $this->censo['status']; ?>
					<div class="yes <?=$on=='Censado'?'on':'';?>"><span class="circle"></span>Sí</div>
					<div class="no <?=$on!='Censado'?'on':'';?>"><span class="circle"></span>No</div>
				</div>
			<?php } ?>
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
						    $datoExtra = "";
						    if($programa->id==5)
						    	$datoExtra = " (datos del 2012)";
						?>

						<li class='<?=$this->escuela->{$programa->m_collection} && count($this->escuela->{$programa->m_collection})?"on":""?>'><a href="/programas/index/<?=$programa->id?>">
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
