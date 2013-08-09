<a name='resultados'></a>
<div class='resultados container conoce'>
	<h1><?=$this->resultados_title;?></h1>
	<hr/>
	<span class='tooltip'>
		Ver perfil
	</span>
	<table>
		<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas</th>
			<!--
			<th class='matematicas'>Calificacion Enlace de Matemáticas</th>
			<th class='espanol'>Calificacion Enlace de Español</th>
			--!>
			<th class='nivel'>Nivel escolar</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Ranking estatal</th>
			<!--
			<th class='rank'>Semáforo educativo</th>
			-->
		</tr>
	<?php
	if(isset($this->escuelas_digest->escuelas)){
		foreach($this->escuelas_digest->escuelas as $escuela){
			$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
			echo "
			<tr $on>
				<td class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$escuela->nombre." | ".
					"<span>".$escuela->direccion."</span>".
				"</a></td>
				<!--
				<td class='rank matematicas'><span>".round($escuela->promedio_matematicas)."</span></td> 
     				<td class='rank espanol'><span>".round($escuela->promedio_espaniol)."</span></td>
				-->
				<td class='nivel'>".$escuela->nivel."</td>
				<td class='control'>".$escuela->control."</td>
				<td class='rank'><span>{$escuela->rank}</span></td>
				<!--
				<td class='semaforo sem{$escuela->semaforo}'><span></span>
					<div class='icon'><span class='icon-popup'>
						".$this->config->semaforos[$escuela->semaforo]."
					</span></div>
				</td>
				-->
				
			</tr>
			";
		}
	}	
	?>
	</table>
	<?php if($this->location == 'escuelas'){ ?>
	<div class="share-bt">
		<div class="social">
			<div class="btns">
				<a href="#" class='share-face' 
		 	 	onclick="
				      window.open(
		            		'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
			          	'El perfil de <?=$this->escuela->nombre; ?> via https://www.facebook.com/MejoraTuEscuela', 
				       	'width=626,height=436'); 
					 return false;">
					  </a>
	
				<div class="tweet">
	
					  <span class="twitter-icon"></span>
					  <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-text="El perfil de <?=$this->capitalize($this->escuela->nombre); ?> " data-via='mejoratuescuela'>
				  	Tweet
					  </a>
	
					  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
			</div>
	
		</div>
		<a href="#" class="button-frame">
			<span class="bt-share">
				<?php $this->print_img_tag('compartir/compartir.png');?>
				Compartir
			</span>
		</a>
	</div>
	<?php } ?>
	<div class="clear"></div>
	<div class='pagination'><?php
	if(isset($this->pagination)){
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
		$this->pagination->echo_paginate('/compara/?'.$query,'p',5,false,$labels); 
	}
	?></div>
	<?php $sufix = $this->compara_cookie ? implode('-',$this->compara_cookie) : ''; ?>
	<a id='compara-main-button' class="button-frame" href="/compara/escuelas/<?=$sufix?>">
		<span class="button">Compara</span>
	</a>
</div>
