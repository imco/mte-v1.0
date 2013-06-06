<div class='container reportes'>
	<?php 
	if($this->calificaciones){
		foreach($this->calificaciones as $calificacion){ 
			$entidad = new entidad($calificacion->escuela->entidad);
			$entidad->read('nombre,id');
	?>
		<div class='calificacion'>
			<div class='top'>
				<h2>calificacion Ciudadano</h2>
				<hr/>
				<p><?=$calificacion->denuncia?></p>
				<p><a href='/escuelas/index/<?=$calificacion->escuela->cct?>'><?=$this->capitalize($calificacion->escuela->nombre)?></a></p>
				<p><a href='/compara/?search=true&amp;entidad=<?=$entidad->id?>#resultados'><?=$this->capitalize($entidad->nombre)?></a></p>
				<p class='auth'>Por <?=$calificacion->nombre_input?></p>
			</div>
			<div class='button votes '><?=$calificacion->likes?><span>VOTOS</span></div>
			<a href='#' class='button share'>COMPARTIR</a>
			<a href='/escuelas/like_reportar/<?=$calificacion->id?>' class='button vote'><span></span>VOTAR</a>
		</div>
		<?php 
		}
	}else{


	} 
		?>
	<div class='clear'></div>
</div>
