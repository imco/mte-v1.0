<div class='resultados container'>
	<h1>Resultados</h1>
	<table>
	<?php
	if($this->escuelas){
		foreach($this->escuelas as $escuela){
			echo "
			<tr>
				<td class='checkbox'><a href='#'></a></td>
				<td class='score'></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." (".$this->capitalize($escuela->nivel->nombre).") | ".
					$this->capitalize($escuela->localidad->nombre).", ".$this->capitalize($escuela->entidad->nombre).
				"</a></td>
			</tr>
			";
		}
	}	
	?>
	</table>
</div>
<?php $this->include_template('general_search','global'); ?>