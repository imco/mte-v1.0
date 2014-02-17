<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<?php
		$css_scripts = array("widget-escuelas.css");		
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min--mte-widget-3");
		$cssmin->tag('css');
		$js_scripts = array("jquery.js");		
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min--mte-widget-3");
		$jsmin->tag('js');
	?>
	<script type="text/javascript">
		$().ready(function(){
			var iframe = window.parent.document.getElementById('mte-escuela-widget-iframe');
			var container = document.getElementById('container');
			iframe.style.height = container.offsetHeight+'px';
		});
	</script>
	<title><?=$this->page_title;?></title>
 </head>
 <body>
 	<div id='container'>
 		<div class='head'>
	 		<a href='http://www.mejoratuescuela.org' class='logo' title='Mejora tu Escuela'><?php $this->print_img_tag('/widget/mejora.png','Meoratuescuela.org') ?></a>
 		</div>
 		<div class='blue-box <?=$this->escuela->rank_entidad <= 10 ? 'medal':''?>'>
 			<span></span>
 			<h1><?=$this->capitalize($this->escuela->nombre)?></h1>
 			<h2><?=$this->capitalize($this->escuela->localidad->nombre)?>, <?=$this->capitalize($this->escuela->entidad->nombre)?> | <?=$this->capitalize($this->escuela->control->nombre)?></h2>			
 		</div>
 		<div class='rank-box'>
			<p>Posición estatal</p>
			<p class='large'><?=$this->escuela->rank_entidad?></p>
			<p class='gray'>de <?=$this->escuela->entidad_total?></p>
 		</div>
 		<p><a target="_blank" class='button' href='<?=$this->config->http_address."escuelas/index/".$this->escuela->cct?>'>Ver perfil de la escuela</a></p>
 		<div class='footer'>
 			<a target="_blank" href='<?=$this->config->http_address?>'>www.mejoratuescuela.org</a>
 		</div>
 	</div>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-4404650-7', 'mejoratuescuela.org');
ga('send', 'pageview');
</script>
 </body>
 </html>
