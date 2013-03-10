<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<?php
		$css_scripts = array(
			"reset.css",
			"main.css",
			"jquery-ui.css" 
		);
		
		$js_scripts = array(
			"jquery.js",
			"interactions.js",
			"jquery-ui.js"
		);
		
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-zavia-erp");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-zavia-erp");
		$cssmin->tag('css');
		$jsmin->tag('js');
	?>
 </head>
 <body>
 <div id='header'><?php $this->include_template('header','global'); ?></div>
 <div id='content'>
 	<?php $this->include_template($this->template,$this->location);	?>
	<?php $this->include_template('general_search','global'); ?>
</div>
 </body>
 </html>