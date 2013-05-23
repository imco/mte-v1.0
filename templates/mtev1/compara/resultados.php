<a name='resultados'></a>
<div class='resultados container'>
	<h1>Resultados</h1>
	<hr/>
	<table>
		<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas</th>
			<th class='nivel'>Nivel</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Ranking Estatal</th>
		</tr>
	<?php
	if($this->escuelas){
		foreach($this->escuelas as $escuela){
			$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
			echo "
			<tr $on>
				<td class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." | ".
					"<span>".$this->capitalize($escuela->localidad->nombre).", ".$this->capitalize($escuela->entidad->nombre)."</span>".
				"</a></td>
				<td class='nivel'>".$this->capitalize($escuela->nivel->nombre)."</td>
				<td class='control'>".$this->capitalize($escuela->control->nombre)."</td>
				<td class='rank'><span>{$escuela->rank_entidad}</span></td>
			</tr>
			";
		}
	}	
	?>
	</table>
	<div class='pagination'><?php 
	$labels->prev_page = "<< primeras";
	$labels->prev = "<<";
	$labels->next_page = "últimas >>";
	$labels->next = ">>";
	$labels->hash = '#resultados';
	$token = $this->get('search') ? '&' : '?';
	$this->pagination->echo_paginate($_SERVER["REQUEST_URI"].$token,'p',5,false,$labels); 
	?></div>
	<?php
	$sufix = $this->compara_cookie ? implode('-',$this->compara_cookie) : '';
	?>
	<a id='compara-main-button' class="button-frame" href="/compara/escuelas/<?=$sufix?>">
		<span class="button">Compara</span>
	</a>
</div>