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
			'jquery.mousewheel.js',
			'jquery.jscrollpane.min.js',
			'jquery.formatDate.js',
			'jquery.customSelect.min.js',
			'jquery.validate.min.js',
			'jquery.cookie.js',
			'school-charts.js',
			'masonry.pkgd.min.js',
			'infobox_packed.js',
			'imagesloaded.pkgd.min.js',
			'map.js',
			'interactions.js'
		);
		if($this->location == 'escuelas'){
			//$js_scripts[] = 'school-charts.js'; // si no hay cambios en el js no renderizara 
			//correctamente el min.
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		if($this->draw_charts){
			//$js_scripts[] = 'entidad-charts.js';
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		if($this->draw_map){
			echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlzbyX3J7GwOXdoRwMDfYVbqxNG1D9Jy0&sensor=true"></script>';
			//$js_scripts[] = 'infobox_packed.js';
			//$js_scripts[] = 'map.js';
		}
		if($this->angular){
			echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.3/angular.min.js"></script>';
			$js_scripts[] = 'infobox_packed.js';
			//$js_scripts[] = 'map.js';
		}
		//var_dump($js_scripts);
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-mte");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
		$cssmin->tag('css');
		//$jsmin->tag('js'); js abajo.
		if(isset($this->meta_description)) echo "<meta name='description' content='{$this->meta_description}' />";
	?>
	<title><?=$this->page_title;?></title>

	<meta property='og:image:type' content='image/png'>
	<meta property='og:image' content='http://www.mejoratuescuela.org/templates/mtev1/img/logo200_200.jpg' />	
	<meta property='og:description' content='MejoraTuEscuela.org es una plataforma que busca promover la participación ciudadana para transformar la educación en México' />
	
<?php
$canonical = $this->config->http_address.(isset($_GET['controler'])?$_GET['controler']:'').(isset($_GET['action'])?"/".$_GET['action']:'').(isset($_GET['id'])?"/".$_GET['id']:'');					
?>
	<meta property='og:title' content='Mejora tu escuela'>
	<meta property='og:url' content='<?=$canonical?>'>
	<link rel="canonical" href="<?=$canonical?>" />
 </head>
 <body>
 	<div id="wrap"><div id="main" class="clearfix"><div id="topBackRepeat">
 		
		<?php $this->include_template('comparador_select','global'); ?>
		<div id='header'>
			<?php 
			$this->include_template('header','global'); 
			$this->include_template('header',$this->header_folder); 
			?>
		</div>
		<div class='header_shadow'></div>
		<div id='content'>
			<?php $this->include_template('banner_space','global'); ?>
			<?php $this->include_template($this->template,$this->location);?>
		</div>
	</div></div></div>	
	<div id='footer'><?php $this->include_template('footer','global'); ?></div>	 

	<?php 
	$jsmin->tag('js'); 
	//if(isset($this->config->tynt) && $this->config->tynt) $this->include_template('tynt','global');
	?>
 </body>
 </html>
