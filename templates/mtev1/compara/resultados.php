<a name='resultados'></a>
<div class='resultados container'>
	<h1>Escuelas Similares</h1>
	<hr/>
	<table>
		<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas Similares</th>
			<th class='nivel'>Nivel</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Ranking Estatal</th>
		</tr>
	<?php
	if($this->escuelas){
		foreach($this->escuelas as $escuela){
			echo "
			<tr>
				<td class='checkbox'><a class='compara-escuela' href='#'></a></td>
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
	<?php $this->pagination->echo_paginate($_SERVER["REQUEST_URI"].'&#resultados','p',5); ?>
</div>