<a name='resultados'></a>
<div class='resultados container'>
	<h1>Escuelas Similares</h1>
	<table>
		<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas Similares</th>
			<th class='nivel'>Nivel</th>
			<th class='control'>Privada | Pública</th>
			<th class='rank'>Ranking Nacional</th>
		</tr>
	<?php
	if($this->escuelas){
		foreach($this->escuelas as $escuela){
			echo "
			<tr>
				<td class='checkbox'><a href='#'></a></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." | ".
					"<span>".$this->capitalize($escuela->localidad->nombre).", ".$this->capitalize($escuela->entidad->nombre)."</span>".
				"</a></td>
				<td class='nivel'>{$escuela->nivel->nombre}</td>
				<td class='control'>{$escuela->control->nombre}</td>
				<td class='rank'><span>{$escuela->rank_entidad}</span></td>
			</tr>
			";
		}
	}	
	?>
	</table>
</div>