<div class='perfil container B'>
	<div class='column left'>
		<div class='head'>
			<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
		</div>
		<div class='info_B'>
			<div class='column left'>
				<h2>
					<?=$this->capitalize($this->escuela->nivel->nombre)?> | <?=$this->capitalize($this->escuela->turno->nombre)?> | <?=$this->capitalize($this->escuela->control->nombre)?>
				</h2>
				<p class='address'>
					<span class='icon'></span>
					<?=$this->capitalize($this->escuela->domicilio)?>
					<?=$this->capitalize($this->escuela->localidad->nombre)?>, 
					<?=$this->capitalize($this->escuela->entidad->nombre)?>
				</p>
			</div>
			<div class='column right'>
				<p class='email'>
					<span class='icon'></span>
					<?=$this->escuela->correoelectronico?>
					<div class='clear'></div>
				</p>
				<p class='tel'>
					<span class='icon'></span>
					<?=$this->escuela->telefono?>
					<div class='clear'></div>
				</p>
			</div>
			<div class='clear'></div>
		</div>
		<input type='hidden' id='map-selected' value='<?=$this->escuela->cct?>' name='map-selected'/>
		<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
		<div id='mapa' class='map'></div>
		<?php $this->include_template('map-infobox','global'); ?>
		<div class='clear'></div>
		<ul class='tabs'>
			<li></li>
			<li><a href='#' class='result'>
				<span class='icon'></span>
				Resultados educativos
			</a></li>
			<li><a href='#'  class='infor'>
				<span class='icon'></span>
				Más información
			</a></li>
			<li><a href='#' class='reportes'>
				<span class='icon'></span>
				Presupuestos Asignados
			</a></li>
			<li class='on'><a href='#' class='long comentarios'>
				<span class='icon'></span>
				Comentarios con calificación
			</a></li>
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
				<a name='reportes_ciudadanos'></a>
				<div class='gray-box presupuestos'>
					<h2>Promedio nacional</h2>
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
			</div>
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
	</div>
	<div class='column right'>
		<div class='rank'>
			<div class='posicion'>
				<?php $this->print_img_tag('home/posicion.png');?>
				<p>Posición </p>
				<p>Nivel Nacional</p>
				<h2>
					<?=isset($this->escuela->rank_entidad) ? $this->escuela->rank_entidad : '--' ?>
				</h2>
			</div>
		</div>
		<div class='semaforo'>
			<?php $on = $this->config->semaforos[$this->escuela->semaforo]?>
			<h2>Semáforo Educativo</h2>
			<div class='level reprobado<?= $on=='Reprobado'?' on':''?>'>
				<p>Reprobado</p>
				<span class='icon'></span>
				<div class='clear'></div>
			</div>
			<div class='level panzazo<?= $on=='De panzazo'?' on':''?>'>
				<p>De panzazo</p>
				<span class='icon'></span>
				<div class='clear'></div>
			</div>
			<div class='level bien<?= $on=='Bien'?' on':''?>'>
				<p>Bien</p>
				<span class='icon'></span>
				<div class='clear'></div>
			</div>
			<div class='level excelente<?= $on=='Excelente'?' on':''?>'>
				<p>Excelente</p>
				<span class='icon'></span>
				<div class='clear'></div>
			</div>
		</div>
		<div class='clear'></div>
		<div class='califica'>
			<div class='title'>
				<?php $this->print_img_tag('home/califica.png');?>
				<p>Califica</p>
				<p>tu escuela</p>
			</div>
			<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form'>
					<p class='rater'>
						<span class='tit'>Arrastra la barra para asignar una calificion</span>
						<span class='ranker' id='rank-bar'><span class='bar'></span></span>
						<span class='label' id='rank-label'></span>
						<input type='hidden' id='rank-value' name='calificacion' value='' class='required'/>
						<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' />
					</p>
					<p>
						<input type='text' placeholder='Tu nombre' name='nombre' class='required' />
						<input type='text' class='required email' placeholder='Correo eléctronico' name='email' />
						<select class='custom-select' name='ocupacion' >
							<option value=''>Ocupación</option>
							<option value='alumno'>alumno</option>
							<option value='exalumno'>exalumno</option>
							<option value='padredefamilia'>padre de familia</option>
							<option value='maestro'>maestro</option>
							<option value='director'>director</option>
							<option value='ciudadano'>ciudadano</option>
						</select>
						<textarea placeholder='Comentario' name='comentario' class='required'></textarea>
						<input type='submit' value='Calificar' />
					</p>
			</form>
		</div>
	</div>
	<div class='clear'></div>
</div>

<?php $this->include_template('resultados','compara')?>