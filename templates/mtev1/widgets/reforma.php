<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<?php
		$css_scripts = array(
			"widget.css",
			"jquery-ui.css"
		);		
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min--mte-widget");
		$cssmin->tag('css');
	?>
	<title><?=$this->page_title;?></title>
 </head>
 <body>
 	<div id='container'>
 		<form action='http://www.mejoratuescuela.org/compara/#resultados' method='get' accept-charset='utf-8' target="_blank">
 			<p>
 				<input type='text' placeholder='Busca tu escuela aquí' name='term' />
 				<input type='hidden' name='search' value='true' class='submit'/>
 				<input type='submit' value='' class='submit'/>
 				<input name='source' type='hidden' value='reforma' />
 			</p>
 			<div class='clear'></div>
 		</form> 		
 	</div>
 </body>
 </html>
