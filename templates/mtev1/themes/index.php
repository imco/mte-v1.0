<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="<?=$this->config->http_address?>/templates/<?=$this->config->theme?>/img/home/favicon.ico" />
	<?php
		$css_scripts = array(
			"reset.css",
			"main.css",
			"jquery-ui.css",
			"jquery.jscrollpane.css"
		);
		$js_scripts = array(
			"jquery.js",
			"jquery-ui.js",
			"jquery.tweet.js",
			'jquery.mousewheel.js',
			'jquery.jscrollpane.min.js',
			'jquery.formatDate.js',
			'jquery.customSelect.min.js',
			'jquery.validate.min.js',
			'jquery.cookie.js',
			"interactions.js"
		);
		if($this->location == 'escuelas'){
			$js_scripts[] = 'school-charts.js';
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		if($this->draw_charts){
			$js_scripts[] = 'entidad-charts.js';
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		if($this->draw_map){
			echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlzbyX3J7GwOXdoRwMDfYVbqxNG1D9Jy0&sensor=true"></script>';
			$js_scripts[] = 'infobox_packed.js';
			$js_scripts[] = 'map.js';
		}
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-mte");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
		$cssmin->tag('css');
		//$jsmin->tag('js'); js abajo.
		if($this->location == 'escuelas'){
			echo '<meta name="description" content="El perfil de '.$this->escuela->nombre.' via https://www.facebook.com/MejoraTuEscuela" />';
		}else if($this->location == 'compara'){
			echo '<meta name="description" content="Escuelas comparadas: ';
			$i=0;
			for($i=0;$i<count($this->escuelas)-1;$i++){
				echo $this->capitalize($this->escuelas[$i]->nombre).', ';
			}
			echo $this->capitalize($this->escuelas[$i]->nombre);
			echo ' via https://www.facebook.com/MejoraTuEscuela" />';	
		}
	?>
	<title><?=$this->page_title;?></title>
	<link rel="canonical" href="<?=$this->config->http_address.
					(isset($_GET['controler'])?$_GET['controler']:'').
					(isset($_GET['action'])?"/".$_GET['action']:'').
					(isset($_GET['id'])?"/".$_GET['id']:'')
					?>" />
 </head>
 <body>
 	<div id="wrap"><div id="main" class="clearfix"><div id="topBackRepeat">
		<div id='header'>
			<?php 
			$this->include_template('header','global'); 
			$this->include_template('header',$this->header_folder); 
			?>
		</div>
		<div id='content'><?php $this->include_template($this->template,$this->location);?></div>
	</div></div></div>	
	<div id='footer'><?php $this->include_template('footer','global'); ?></div>	 
	<?php $jsmin->tag('js'); ?>
 </body>
 </html>
