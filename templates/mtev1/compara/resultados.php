<a name='resultados'></a>
<div class='resultados container'>
	<h1><?=$this->resultados_title;?></h1>
	<hr/>
	<table>
		<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas</th>
			<th class='matematicas'>Calificacion Enlace de Matemáticas</th>
			<th class='espanol'>Calificacion Enlace de Español</th>
			<th class='nivel'>Nivel</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Posición estatal</th>
			<th class='rank'>Semáforo educativo</th>
		</tr>
	<?php
	if(isset($this->escuelas)){
		foreach($this->escuelas as $escuela){
			$esc = new escuela();
			$esc->poco_confiables = $escuela->poco_confiables;
			$esc->total_evaluados = $escuela->total_evaluados;
			$esc->promedio_general = $escuela->promedio_general;
			$esc->nivel->id = $escuela->nivel;
			$esc->get_semaforo();
			$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
			$controles = array(1=>'Publica', 2=>'Privada');
			$matematicas = $escuela->promedio_matematicas >= 0 ? round($escuela->promedio_matematicas) : '';
			$espaniol = $escuela->promedio_espaniol >= 0 ? round($escuela->promedio_espaniol) : '';
			$rank_entidad = $escuela->rank_entidad > 0 ? $escuela->rank_entidad : '';


			echo "
			<tr $on>
				<td class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." | ".
					"<span>".$this->capitalize($escuela->nom_localidad).", ".$this->capitalize($escuela->nom_entidad)."</span>".
				"</a></td>
				<td class='rank matematicas'><span>".$matematicas."</span></td> 
     				<td class='rank espanol'><span>".$espaniol."</span></td>
				<td class='nivel'>".$this->capitalize($escuela->nom_nivel)."</td>
				<td class='control'>".$controles[$escuela->control]."</td>
				<td class='rank'><span>{$rank_entidad}</span></td>
				<td class='semaforo sem{$esc->semaforo}'><span></span>
					<div class='icon'><span class='icon-popup'>
						".$this->config->semaforos[$esc->semaforo]."
					</span></div>
				</td>
			</tr>
			";
		}
	}	
	?>
	</table>
	<!--
	<div class="share-bt">
		<div class="social">
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
		<a href="#" class="button-frame">
			<span class="bt-share">Compartir</span>
		</a>
	</div>-->
	<div class="clear"></div>
	<div class='pagination'>
	<?php
	if($this->num_results > 10){
		$pages = ceil($this->num_results/10);
		$current = $this->get('p') ? $this->get('p') : 1;
		$start = $current - 3;
		$start = $start > 0 ? $start : 1;
		$end = $start + 4;
		$end = $end <= $pages ? $end : $pages;
		$get = $_GET;
		if(isset($get['action'])) unset($get['action']);
		if(isset($get['p'])) unset($get['p']);
		unset($get['controler']);
		$query = http_build_query($get);
		$query .= $query != '' ? '&' : '';

		$next = $end + 1;
		$next = $end < $pages ? '<a class="next_page" href="/compara/?'.$query.'p='.$next.'#resultados">&gt;&gt;</a>' : '';
		$last = $end + 1 < $pages ? '<a class=" last_page" href="/compara/?'.$query.'p='.$pages.'#resultados">últimas &gt;&gt;</a>' : '';
		$prev = $start - 1;
		$prev = $prev > 0 ? "<a class='prev_page' href='/compara/?{$query}p=$prev#resultados'>&lt;&lt;</a>" : '';
		$first = $start > 2 ? "<a class='first_page' href='/compara/?{$query}p=1#resultados'>&lt;&lt; primeras</a>" : '';

		echo $first.$prev;
		for($i=$start;$i<=$end;$i++){
			$on = $i == $current ? 'class="on"' : '';
			echo "<a href='/compara/?{$query}p=$i#resultados' $on>$i</a>";
		}
		echo $next.$last;
	}
	?>
<?php
	
	?></div>
	<?php $sufix = $this->compara_cookie ? implode('-',$this->compara_cookie) : ''; ?>
	<a id='compara-main-button' class="button-frame" href="/compara/escuelas/<?=$sufix?>">
		<span class="button">Compara</span>
	</a>
</div>
