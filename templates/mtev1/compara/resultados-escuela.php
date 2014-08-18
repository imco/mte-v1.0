<div class='changeAjax'><a name='resultados'></a>
<div class='resultados container'>
	<h1><?=$this->resultados_title;?></h1>
	<hr/>
	<table>
		<tr>
			<!--<th class='checkbox'></th>-->
			<th class='school'>Escuelas</th>
			<th class='matematicas'>Calificación ENLACE de matemáticas</th>
			<th class='espanol'>Calificación ENLACE de español</th>
			<th class='nivel'>Nivel</th>
			<th class='turno'>Turno</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Posición estatal</th>
			<th class='rank'>Semáforo educativo  <span class='infor I'>i</span></th>
		</tr>
	<?php
	if(isset($this->escuelas)){
		foreach($this->escuelas as $escuela){
			$escuela->get_semaforos();
			$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
			$controles = array(1=>'Pública', 2=>'Privada');
			$matematicas = $escuela->promedio_matematicas >= 0 && ($escuela->semaforo <= 3 || $escuela->semaforo ==6) ? round($escuela->promedio_matematicas) : '';
			$espaniol = $escuela->promedio_espaniol >= 0 && ($escuela->semaforo <= 3 || $escuela->semaforo ==6) ? round($escuela->promedio_espaniol) : '';
			$rank_entidad = $escuela->rank_entidad > 0 ? number_format($escuela->rank_entidad,0) : '';
            //$count_semaforos = count($escuela->semaforos);
			//<td class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></td>
            //rowspan='{$count_semaforos}'
			echo "
			<tr $on>
				<td class='school' >
				<div class='message-del'><p><span class='triangle'></span>Eliminar escuela del comparador</p></div>
				<div class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></div>
				<a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." | ".
					"<span>".$this->capitalize($escuela->localidad->nombre).", ".$this->capitalize($escuela->entidad->nombre)." | ".$this->capitalize($escuela->turno->nombre)."</span>".
				"</a></td>
				<td class='rank matematicas'><span>".$matematicas."</span></td>
     			<td class='rank espanol'><span>".$espaniol."</span></td>
				<td class='nivel'>".$this->capitalize($escuela->nivel->nombre)."</td>
				<td class='turno'>".$this->capitalize($escuela->turno->nombre)."</td>
				<td class='control'>".$controles[$escuela->control->id]."</td>
				<td class='rank'><span>".$rank_entidad."</span>
					<span>de ".number_format($escuela->entidad_cct_count,0)."</span>
				</td>
				<td class='semaforo sem{$escuela->semaforo}'><span class='sprit2'></span>
					<div class='icon'><span class='triangle'></span><span class='icon-popup'>
						<!--<p class='infor I'>i</p>-->
						<p class='title_semaforo'>
							".$this->config->semaforos[$escuela->semaforo]."
						</p>
						"/*
						descripcion del semáforo
						*/."
					</span></div>
				</td>
			</tr>
			";
		}
	}	
	?>
	</table>
	<div class="clear"></div>
	<div class='pagination'><?php
	if(isset($this->pagination)){
		$labels = new stdClass();
		$labels->prev_page = "<< primeras";
		$labels->prev = "<<";
		$labels->next_page = "últimas >>";
		$labels->next = ">>";
		$labels->hash = '#resultados';
		$get = $_GET;
		if(isset($get['action'])) unset($get['action']);
		if(isset($get['p'])) unset($get['p']);
		unset($get['controler']);
		$query = http_build_query($get);
		$query .= $query != '' ? '&' : '';
		if($this->get("action")=="escuelas")
			$this->pagination->echo_paginate('/compara/escuelas?'.$query,'p',5,false,$labels); 
		else
			$this->pagination->echo_paginate('/compara/?'.$query,'p',5,false,$labels); 
	}
	?></div>
	<?php
	if($this->location != 'escuelas' && $this->get('action')=='index')
		$this->include_template('share_buttons','global');
	?>

	<?php $sufix = $this->compara_cookie ? implode('-',$this->compara_cookie) : ''; ?>
	<a id='' class="button-frame compara-main-button" href="/compara/escuelas/<?=$sufix?>">
		<span class="button button-efect orange-effect">Comparar</span>
	</a>
</div></div>
