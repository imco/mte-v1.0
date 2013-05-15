<!DOCTYPE html>
 <html lang="es" style="width: 100%; height: 100%;">
 <head>
	<meta charset="utf-8"/>
	 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<?php
		$js_scripts = array(
			"jquery.js",
			"charts.js"
		);
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
		$jsmin->tag('js');
	?>
 </head>
 <body style="width: 100%; height: 100%;">
 	<div id="chart_div" style="width: 100%; height: 100%;"></div>
 	<div id='data' style='display:none'><?=json_encode($this->data)?></div>
 </body>
 </html>