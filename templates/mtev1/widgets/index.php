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
 		<h1><?=$this->widget->title?></h1>
 		<p><?=$this->widget->text?></p>
 		<form action='http://www.mejoratuescuela.org/compara/#resultados' method='get' accept-charset='utf-8'>
 			<p>
 				<input type='text' placeholder='Busca tu escuela aquí' name='term' />
 				<input type='hidden' name='search' value='true' class='submit'/>
 				<input type='submit' value='' class='submit'/>
 			</p>
 			<div class='clear'></div>
 		</form>
 		<h3><?=$this->widget->news_title?></h3>
 		<ul><?php foreach($this->widget->news_items as $item) echo "<li><a href='$item->url'>$item->title</a></li>"; ?></ul>
 	</div>
 </body>
 </html>
