<div class='container reportes'>
	<?php 
	if($this->reportes){
		foreach($this->reportes as $reporte){ 
			$entidad = new entidad($reporte->escuela->entidad);
			$entidad->read('nombre,id');
	?>
		<div class='reporte'>
			<div class='top'>
				<h2>Reporte Ciudadano</h2>
				<hr/>
				<p><?=$reporte->denuncia?></p>
				<p><a href='/escuelas/index/<?=$reporte->escuela->cct?>'><?=$this->capitalize($reporte->escuela->nombre)?></a></p>
				<p><a href='/compara/?search=true&amp;entidad=<?=$entidad->id?>'><?=$this->capitalize($entidad->nombre)?></a></p>
				<p class='auth'>Por <?=$reporte->nombre_input?></p>
			</div>
			<div class='button votes '><?=$reporte->likes?><span>VOTOS</span></div>
			<a href='#' class='button share'>COMPARTIR</a>
			<a href='/' class='button vote'><span></span>VOTAR</a>
		</div>
		<?php 
		}
	}else{


	} 
		?>
	<div class='clear'></div>
</div>
