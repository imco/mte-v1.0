<a name='resultados'></a>
<div class='resultados container'>
	<h1><?=$this->resultados_title;?></h1>
	<hr/>
	<table>
		<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas</th>
			<th class='matematicas'>Calificación ENLACE de matemáticas</th>
			<th class='espanol'>Calificación ENLACE de español</th>
			<th class='nivel'>Nivel</th>
			<th class='turno'>Turno</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Posición estatal</th>
			<th class='rank'>Semáforo educativo <span class='infor I'>i</span> </th>
		</tr>
	<?php
	if(isset($this->escuelas)){
		$turnos = array(100 => 'Matutino', 200 => 'Vespertino', 500 => 'Continuo (tiempo completo)', 400 => 'Discontinuo', 300 => 'Nocturno', 120 => 'Matutino y vespertino');
		foreach($this->escuelas as $escuela){
			$esc = new escuela();
			$esc->poco_confiables = $escuela->poco_confiables;
			$esc->total_evaluados = $escuela->total_evaluados;
			$esc->promedio_general = $escuela->promedio_general;
			$esc->nivel->id = $escuela->nivel;
			$esc->nivel->nombre = $escuela->nom_nivel;

			$esc->grados = $escuela->grados;
			$esc->get_semaforo();
			//$escuela->get_semaforo();
			$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
			$controles = array(1=>'Pública', 2=>'Privada');
			
			$matematicas = $escuela->promedio_matematicas >= 0 && ($esc->semaforo <= 3 || $esc->semaforo==6) ? round($escuela->promedio_matematicas) : '';
			$espaniol = $escuela->promedio_espaniol >= 0 &&  ($esc->semaforo <= 3 || $esc->semaforo==6) ? round($escuela->promedio_espaniol) : '';
			$rank_entidad = $escuela->rank_entidad > 0 ? number_format($escuela->rank_entidad,0) : '';

			echo "
			<tr $on>
				<td class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." | ".
					"<span>".$this->capitalize($escuela->nom_localidad).", ".$this->capitalize($escuela->nom_entidad)." | ".$turnos[$escuela->turno]."</span>".
				"</a></td>
				<td class='rank matematicas'><span>".$matematicas."</span></td> 
     				<td class='rank espanol'><span>".$espaniol."</span></td>
				<td class='nivel'>".$this->capitalize($escuela->nom_nivel)."</td>
				<td class='turno'>".$turnos[$escuela->turno]."</td>
				<td class='control'>".$controles[$escuela->control]."</td>
				<td class='rank'><span>".$rank_entidad."</span>
						<span>de ".number_format($escuela->entidad_cct_count,0)."</span>
				</td>
				<td class='semaforo sem{$esc->semaforo}'><span class='sprit2'></span>
					<div class='icon'><span class='icon-popup'>
						<p class='infor I'>i</p>
						<p class='title_semaforo'>
							".$this->config->semaforos[$esc->semaforo]."
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

		$url = $this->get("action")=="escuelas"?"/compara/escuelas/?":"/compara/?";
		$next = $end < $pages ? '<a class="next_page" href="'.$url.$query.'p='.$next.'#resultados">&gt;&gt;</a>' : '';
		$last = $end + 1 < $pages ? '<a class=" last_page" href="'.$url.$query.'p='.$pages.'#resultados">últimas &gt;&gt;</a>' : '';
		$prev = $start - 1;
		$prev = $prev > 0 ? "<a class='prev_page' href='".$url."{$query}p=$prev#resultados'>&lt;&lt;</a>" : '';
		$first = $start > 2 ? "<a class='first_page' href='".$url."{$query}p=1#resultados'>&lt;&lt; primeras</a>" : '';

		echo $first.$prev;
		for($i=$start;$i<=$end;$i++){
			$on = $i == $current ? 'class="on"' : '';
			echo "<a href='".$url."{$query}p=$i#resultados' $on>$i</a>";
		}
		echo $next.$last;
	}
	?>
<?php
	
	?></div>
	<?php $sufix = $this->compara_cookie ? implode('-',$this->compara_cookie) : ''; ?>
	<a id='' class="button-frame compara-main-button" href="/compara/escuelas/<?=$sufix?>">
		<span class="button">Compara</span>
	</a>
</div>
