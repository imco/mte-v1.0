<div class='container reportes datos-abiertos'>
	<?php foreach($this->files as $file){ ?>
	<div class='reporte'>
		<div class='top'>
			<h2><?=$file->nombre?></h2>
			<hr/>
			<p><?=$file->descripcion?></p>
		</div>
		<a href='#' class='button share'>COMPARTIR</a>
		<a href='<?=$file->url?>' class='button descargar share'><span></span>DESCARGAR</a>
	</div>
	<?php } ?>
	<div class='clear'></div>
</div>
