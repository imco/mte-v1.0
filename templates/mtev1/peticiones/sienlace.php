<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8 " />
    <link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css' />
    <?php
        $css_scripts = array('sienlace.css');
        $js_scripts = array(
            'jquery.js',
            'sienlace.js'
        );
        $cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-mte");
        $jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
        $cssmin->tag('css');
    ?>
	<title>#SiENLACE2014</title>
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
                            <a class="text">ya somos</a>
                            <a class="number firma-count"><?=$this->firmas?></a>
                        </div>
						<a class="logo" href="/"><?php $this->print_img_tag('sienlace/logo.jpg');?></a>
                        <div class="social">
                            <a href="/" class="icon animate-BG tw"></a>
                            <a href="/" class="icon animate-BG fb"></a>
                        </div>
					</div>
				</div>
				<div id='content'>
                    <div class="singin">
                        <div class='container row-fluid'>
                            <div class="span8">
                                <h4>La evaluación de desempeño es un mecanismo fundamental para mejorar la calidad del sistema educativo mexicano. Como resultado de la Reforma Educativa, el Instituto Nacional para la Evaluación de la Educación (INEE) quedó como institución responsable de llevar a cabo estas evaluaciones.</h4>
                                <h4>Desde el año 2006, la prueba Enlace permitía medir el desempeño de más de quince millones de alumnos de primaria, secundaria y bachillerato. Esta prueba era el único termómetro que permitía realizar un diagnóstico nacional de las herramientas educativas que reciben las niñas y niños mexicanos.</h4>
                                <h4>El INEE anunció en diciembre pasado que sus pruebas de evaluación para educación primaria y secundaria estarán listas hasta el 2015. Como consecuencia, NO SE APLICARÁ LA PRUEBA ENLACE EN 2014 en estos niveles. La pregunta clave para la SEP y el INEE es: ¿por qué no esperar a que la nueva prueba esté lista antes de cancelar ENLACE?</h4>
                                <h4>Como resultado de la Reforma Educativa, la responsabilidad de llevar a cabo las evaluaciones nacionales de alumnos estará a cargo del INEE. Sin embargo, recientemente el INEE anunció que sus pruebas, para educación primaria y secundaria, no estarán listas hasta el 2015.</h4>
                                <h3>La prueba ENLACE es imperfecta, puede y debe mejorarse, pero no podemos perder la única medición que existe hoy sobre el estado de la educación en México.</h3>
                                <h2>Hacemos un llamado a la acción #SíEnlace2014 <span>porque:</span> </h2>
                                <div class="whytext animate-height">
                                    <div class="screen">
                                        <ol>
                                            <li>Los alumnos mexicanos tienen derecho a contar con parámetros para conocer la calidad de la educación que están recibiendo.</li>
                                            <li>Los padres de familia tenemos el derecho a tener información para exigir y elegir una mejor educación para nuestros hijos.</li>
                                            <li>Los maestros tenemos derecho a saber qué programas funcionan y cuáles son las mejores prácticas para replicar en nuestras escuelas.</li>
                                            <li>Los contribuyentes tenemos derecho a contar con un sistema de rendición de cuentas sobre los más de $400,000 millones de pesos que anualmente se destinan a la educación básica en México.</li>
                                            <li>Todos los ciudadanos tenemos derecho a conocer los resultados de nuestro sistema educativo, pieza clave para el desarrollo de nuestro país.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <form action="/home/sign" method="post" accept-charset="utf-8" class="singform" id='singForm'>
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre_input" value="" required="required" />
                                    <label>Apellido:</label>
                                    <input type="text" name="apellido_input" value="" required="required" />
                                    <label>Correo electrónico:</label>
                                    <input type="text" name="email_input" value="" required="required" />
                                    <!--<label>País:</label>
                                    <input type="text" name="pais_input" value="" required="required" />-->
                                    <label>Código Postal:</label>
                                    <input type="text" name="cp_input" value="" required="required" />
                                    <label>¿Por qué es importante para ti? (Opcional):</label>
                                    <textarea name='comentario_input'></textarea>
                                    <input type="submit" value="Firma" class="submit" />
                                    <div class="clear"></div>
                                </form>
                                <p class="message">Gracias a ti ya somos <a class='firma-count'><?=$this->firmas?></a></p>
                                <h2> <a class="icon-helpus"></a> ¡Ayúdanos a <br /> difundir esta petición! </h2>
                                <div class="share">
                                    <div class="span12">
                                        <div id="fb-root"></div>
                                        <script>(function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s); js.id = id;
                                                js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=141448832714787";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>
                                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                                    </div>
                                    <div class="span12">
                                        <div class="g-plusone" data-size="medium"></div>
                                        <script type="text/javascript">
                                            window.___gcfg = {lang: 'es-419'};

                                            (function() {
                                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                                po.src = 'https://apis.google.com/js/platform.js';
                                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                            })();
                                        </script>
                                    </div>
                                    <div class="span12">
                                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://something.com" data-hashtags="SíEnlace2014">Tweet</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
					<div class='container center'>
                        <div class="share">

                        </div>
                        <div class="gallery">
                            <div class="screen">
                                <div class="reel">

                                </div>
                            </div>
                        </div>
                        <div class="uploadphoto">
                            <h2>¿Ya firmaste? <br />
                            Ahora sube tu foto aquí:</h2>
                            <form action="" method="post" accept-charset="utf-8" class="uploadYP row-fluid" id="uploadYP" >
                                <div class="span4">
                                    <input type="text" name="name" class="" value="" placeholder="Nombre" />
                                </div>
                                <div class="span4">
                                    <a class="fakefile">Seleccionar archivo</a>
                                    <input type="file" name="photo" class="single-image"  value="" placeholder="Seleccionar archivo" />
                                </div>
                                <div class="span4">
                                    <input type="submit" value="Enviar" class="submit" />
                                </div>
                            </form>
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
                <?php for($i=0;$i<10;$i++){ ?>
                    <a href="" class="span2-5">Sponsor Logo</a>
                <?php } ?>
            </div>
            <div class="bottom">
                <p>
                    2014. Instituto Mexicano para la Competitividad A.C. <a href="http://mejoratuescuela.org/">www.MejoraTuEscuela.org</a>
                    <a class="icon fb"></a>
                    <a class="icon tw"></a>
                </p>
            </div>
		</div>
	</div>
<?php $jsmin->tag('js'); ?>
</body>
</html>