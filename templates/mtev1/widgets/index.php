<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<?php
		$css_scripts = array(
			"widget.css",
			"jquery-ui.css"
		);
		$js_scripts = array(
			"jquery.js",
			"jquery-ui.js"
		);
		
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min--mte-widget");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte-widget");
		$cssmin->tag('css');
		$jsmin->tag('js');
	?>
	<title><?=$this->page_title;?></title>
 </head>
 <body>
 	<div id='container'>
 		<a href='http://www.mejoratuescuela.org' title='Mejora tu Escuela'><?php $this->print_img_tag('reforma-widget-logo.png','Meoratuescuela.org') ?></a>
 		<h1>Ayuda a transformar tu colegio</h1>
 		<p>Consulta los resultados de Enlace de las escuelas públicas y privadas del País y aprende cómo puedes ayudar a mejorar la educación de tu</p>
 		<form action='' method='get' accept-charset='utf-8'>
 			<p>
 				<input type='text' placeholder='Busca tu escuela aquí' name='term' />
 				<input type='submit' value='' class='submit'/>
 			</p>
 			<div class='clear'></div>
 		</form>
 		<h3>Cabeza de la nota aquí</h3>
 		<ul><li><a href=''>nota</a></li></ul>
 	</div>
 </body>
 </html>
