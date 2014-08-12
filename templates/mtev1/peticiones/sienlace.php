<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8 " />
    <meta property="og:description" content="Yo ya firmé la petición #SíENLACE2014 porque la evaluación es nuestro derecho. Súmate hoy en: http://ow.ly/spTvS @Mejoratuescuela" />
    <meta property="og:title" content="#SiENLACE2014" />
    <meta property='og:image' content='http://www.mejoratuescuela.org/templates/mtev1/img/sienlace/logo.jpg' />   
	<link rel="shortcut icon" href="<?=$this->config->http_address?>templates/<?=$this->config->theme?>/img/sienlace/favicon.ico" />
    <link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css' />
    <?php
        $css_scripts = array('bootstrap-fileupload.min.css','sienlace.css');  
        $js_scripts = array(
            'jquery.js',
            'enlace/jquery-migrate-1.1.1.min.js',
            'enlace/jquery-ui-1.9.2.min.js',
            'enlace/bootstrap.min.js',
            'enlace/bootstrap-fileupload.min.js',
            'enlace/jquery.uniform.min.js',
            'enlace/forms.js',
            'sienlace.js'
        );
        $cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-mte");
        $jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
        $cssmin->tag('css');
        $jsmin->tag('js');
    ?>
	<title>#SíENLACE2014</title>
</head>
<body>
	<div id="overlay"></div>	
	<div id="wrap" >
		<div id="main" class="clearfix">
			<div id="topBackRepeat">
				<div id='header'>
					<div class='container'>
                        <div class="label">
                            <a class="icon"></a>
                            <a class="text">Ya somos</a>
                            <a class="number firma-count"><?=$this->firmas?></a>
                        </div>
						<a class="logo" href="<?=$this->config->http_address?>/peticiones/sienlace"><?php $this->print_img_tag('sienlace/logo.jpg');?></a>
                        <!--<div class="social">
                            <a href="https://twitter.com/MejoraTuEscuela" class="icon animate-BG tw"></a>
                            <a href="https://www.facebook.com/MejoraTuEscuela" class="icon animate-BG fb"></a>
                        </div>-->

					</div>
				</div>
				<div id='content'>
                    <div class="singin">
                        <div class='container row-fluid'>
                            <div class="span12">
                                <?php $this->include_template('sienlace-share','peticiones');?>
                                <h4>La evaluación de desempeño es un mecanismo fundamental para mejorar la calidad del sistema educativo mexicano.  Como resultado de la Reforma Educativa, el Instituto Nacional para la Evaluación de la Educación (INEE) quedó como institución responsable, junto con las autoridades educativas, de llevar a cabo estas evaluaciones.</h4>
                                <h4>Desde el año 2006, la prueba ENLACE permitía medir el desempeño de más de quince millones de alumnos de primaria, secundaria y bachillerato. Esta prueba era de los únicos termómetros que permitía realizar un diagnóstico nacional de los avances educativos de cada niña y niño mexicano.</h4>
                                <h4>El INEE y la SEP anunciaron, el diciembre pasado, que sus pruebas de evaluación para educación primaria y secundaria estarán listas hasta el 2015. Como consecuencia, <span class='white'>NO SE APLICARÁ LA PRUEBA ENLACE EN 2014 </span>en estos niveles. La pregunta clave para la SEP y el INEE es: ¿por qué no esperar a que la nueva prueba esté lista antes de cancelar ENLACE?</h4>
                                <!--<h4>Como resultado de la Reforma Educativa, la responsabilidad de llevar a cabo las evaluaciones nacionales de alumnos estará a cargo del INEE. Sin embargo, recientemente el INEE anunció que sus pruebas, para educación primaria y secundaria, no estarán listas hasta el 2015.</h4>-->
                                <h3>La prueba ENLACE es imperfecta, puede y debe mejorarse, pero no podemos perder la medición más significativa que existe hoy sobre el estado de la educación en México.</h3>
                            </div>
                            <div class="span8 nomargin">
                                <h2>Hacemos un llamado a la acción #SíEnlace2014 <span>porque:</span> </h2>
                                <div class="whytext animate-height">
                                    <div class="screen">
                                        <ol>
                                            <li><b>Los alumnos mexicanos</b> tenemos derecho a contar con parámetros para conocer la calidad de los servicios educativos que estamos recibiendo.</li>
                                            <li><b>Los padres de familia</b> tenemos derecho a tener información para exigir y elegir una mejor educación para nuestros hijos.</li>
                                            <li><b>Los maestros</b> tenemos derecho a saber qué programas funcionan y cuáles son las mejores prácticas para replicarlas en nuestras escuelas.</li>
                                            <li><b>Los contribuyentes</b> tenemos derecho a contar con un sistema de rendición de cuentas sobre los más de 400,000 millones de pesos que anualmente se destinan a la educación básica en México.</li>
                                            <li><b>Todos los ciudadanos</b> tenemos derecho a conocer los resultados de nuestro sistema educativo, pieza clave para el desarrollo de nuestro país.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <form action="/peticiones/sign" method="post" accept-charset="utf-8" class="singform" id='singForm'>
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre_input" value="" required="required" />
                                    <label>Apellido:</label>
                                    <input type="text" name="apellido_input" value="" required="required" />
                                    <label>Correo electrónico:</label>
                                    <input type="text" name="email_input" value="" required="email" />
                                    <!--<label>País:</label>
                                    <input type="text" name="pais_input" value="" required="required" />-->
                                    <label>Código Postal:</label>
                                    <input type="text" name="cp_input" value="" required="required" />
                                    <label>¿Por qué es importante para ti? (Opcional):</label>
                                    <textarea name='comentario_input'></textarea>
                                    <input type="submit" value="Firma" class="submit" />
                                    <div class="clear"></div>
                                </form>
                                <p class="message">Gracias a ti ya somos <br /> <a id='firma-count2' class='hidden firma-count'><?=$this->firmas?></a></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
					<div class='container center'>
                        <div class="gallery">
                            <div class="screen">
                                <div class="reel" style="width:<?php echo count($this->photos)*156*12 ?>px">
					<?php
					if( $this->thephoto ){
						if(in_array($this->thephoto->filename,$this->cdn_photos)){
							echo "<a><img alt='SiEnlace2014' src='".$this->cdn_url."/".$this->thephoto->filename."' /></a>";
						
						}else
							echo "<a><img alt='SiEnlace2014' src='{$this->config->http_address}signs/signs/{$this->thephoto->filename}' /></a>";
					}
										//for( $i=0;$i<10;$i++ ){
					if( $this->photos ){foreach( $this->photos as $photo ){
						$filePath = false;
						if(in_array($photo->filename,$this->cdn_photos)){
							$filePath = $this->cdn_url."/".$photo->filename;	
						}else if(file_exists("{$this->config->document_root}signs/signs/{$photo->filename}")){
							$filePath = "{$this->config->http_address}signs/signs/{$photo->filename}";
						}

						if($filePath && $photo->filename!=""){
							echo "<a><img alt='SiEnlace2014' src='$filePath' /></a>";
						}
					}}
										//}
					?>
                                </div>
                            </div>
                        </div>
                         <h2><a class="icon-helpus"></a> ¡Ayúdanos a difundir esta petición! </h2>
						
                        <div class="uploadphoto">
                            <h2>¿Ya firmaste? <br />
                            Ahora escribe #SíENLACE2014, tómate una foto y súbela aquí:</h2>
                            <form action="/peticiones/uphoto/" method="post" accept-charset="utf-8" class="uploadYP row-fluid" id="uploadYP" enctype="multipart/form-data" >
                                <div class="span4">
                                    <input type="text" name="email" class="" placeholder="Correo electrónico" />
                                </div>
                                <div class="span4 ">
                                    <!--<a class="fakefile">Seleccionar archivo</a>-->
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="input-append">
											<div class="uneditable-input span3">
												<i class="iconfa-file fileupload-exists"></i>
												<span class="fileupload-preview"></span>
											</div>
											<span class="btn btn-file"><span class="fileupload-new">Seleccionar Archivo</span>
												<span class="fileupload-exists">Cambiar</span>
												<input type="file" name="profile_input" />
											</span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Quitar</a>
										</div>
									</div>
                                </div>
                                <div class="span4">
                                    <input type="submit" value="Enviar" class="submit" />
                                </div>
                            </form>
							<div class='photo-result'></div>
                        </div>

					</div>
					<div class='clear'></div>
				</div>
			</div>   
			<div class='clear'></div>   
		</div>
		<div class='clear'></div>
	</div>
	<div id='footer'>
		<div class='container'>
			<h4><a>Aliados</a></h4>
            <div class="allies row-fluid">
                <?php for($i=0;$i<0;$i++){ ?>
                    <a href="" class="span2-5">Sponsor Logo</a>
                <?php } ?>
                <!--<a class="ally span2-5" target='_blank' href="http://http://www.amnu.org.mx/"><?php $this->print_img_tag('sienlace/logo-2-75-pixeles.png','ANMU');?></a>-->
                <a class="ally span2-5" target='_blank' href="http://www.afavordelomejor.org/"><?php $this->print_img_tag('sienlace/afavor.png','A favor de lo mejor');?></a>
                <a class="ally span2-5" target='_blank' href="http://ccaemexico.wordpress.com/"><?php $this->print_img_tag('sienlace/logo2.png','Consejo Ciudadano Autónomo por la Educación');?></a>
                <!--<a class="ally span2-5" target='_blank' href="http://http://deportesparacompartir.org.mx/"><?php $this->print_img_tag('sienlace/logo-1-75-pixeles.png','Deportes para compartir');?></a>-->

                <a class="ally span2-5" target='_blank' href="http://ensenapormexico.org/site/"><?php $this->print_img_tag('sienlace/ensenapormexico.png','Enseña por México');?></a>
                <a class="ally span2-5" target='_blank' href="http://www.ifie.edu.mx/"><?php $this->print_img_tag('sienlace/ifie.png','IFIE');?></a>
                <a class="ally span2-5" target='_blank' href="http://www.imco.org.mx/"><?php $this->print_img_tag('sienlace/imco.jpg','IMCO');?></a>
                <a class="ally span2-5" target='_blank' href="http://www.masciudadania.org/"><?php $this->print_img_tag('sienlace/masciudadania.png','Más Ciudadanía');?></a>

                <a class="ally span2-5" target='_blank' href="http://www.mejoratuescuela.org/"><?php $this->print_img_tag('sienlace/mte.jpg','MejoraTuEscuela.org');?></a>
                <a class="ally span2-5" target='_blank' href="http://www.mexicanosprimero.org/"><?php $this->print_img_tag('sienlace/logo1.png','Mexicanos Primero');?></a>
                <a class="ally span2-5" target='_blank' href="http://proeducacion.org.mx/"><?php $this->print_img_tag('sienlace/logo_proed.png','Proeducacion');?></a>
                <a class="ally span2-5" target='_blank' href="http://www.cemefi.org/rededucacion/"><?php $this->print_img_tag('sienlace/logo3.png','Red por la Educación');?></a>
                
                <a class="ally span2-5" target='_blank' href="http://http://www.senm.org/"><?php $this->print_img_tag('sienlace/sociedadenmovimiento.png','Sociedad en Movimiento');?></a>
                <!--<a class="ally span2-5" target='_blank' href="http://www.sumaporlaeducacion.org.mx/"><?php $this->print_img_tag('sienlace/logo_suma_educacion.png','Suma x la educación');?></a>-->
            </div>
            <div class="bottom">
                <p>
                    2014. Instituto Mexicano para la Competitividad A.C. <a href="http://mejoratuescuela.org/">www.MejoraTuEscuela.org</a>
                    <a href='/aviso-de-privacidad' class="link">Aviso legal y de privacidad</a> 
                    <a href='/contacto' class="link">Contáctanos</a>
                </p>
            </div>
		</div>
	</div>
<?php $jsmin->tag('js'); ?>
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