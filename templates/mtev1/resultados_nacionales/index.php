<div class='container resultados-nacionales'>
	<h1 class='full-blue'>Resultados Nacionales Por Estado</h1>
	<?php
	foreach($this->entidades as $entidad){
		echo "<a href='/resultados-nacionales/entidad/{$entidad->id}' class='state-box'>";
		$this->print_img_tag('entidades/'.$entidad->id.'.jpg');
		echo "<span class='h2'>{$entidad->nombre}</span><span class='hover'>Ver Resultados</span></a>";
	}
	?>
	<div class='clear'></div>
</div>