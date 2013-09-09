<?php
$niveles = array(12 => 'primarias',13 => 'secundarias',22 => 'bachilleratos')
?>
<div class='container home'>
	<div class='column'>
		<div class='video'>
		
		</div>
		<h1 class='cap subtitle blue'><?php $this->print_img_tag('home/posicion.png');?> 5 mejores <?=$niveles[$this->nivel_5]?> en <?=$this->capitalize($this->get_abreviatura_estado($this->user_location->nombre))?>.
			<span><a href='/resultados-nacionales/'>+Ver más estados</a></span>
		</h1>
		<div class='gray-box'>
				<p class='title'>NOMBRE
					<span class='location'> | DIRECCIÓN</span>
				</p>
			<ol class='mejores'>
				<?php
				foreach($this->escuelas_digest->escuelas as $escuela){
					echo "
						<li>
							<a href='/escuelas/index/{$escuela->cct}'>{$escuela->nombre}</a>
							<span class='location'> | {$escuela->localidad}, {$escuela->entidad} | {$escuela->control} </span>
						</li>
					";
				}

				?>
			</ol>
		</div>
		<div class='notas'>
			<div class='white-box column'>
				<?php $this->print_img_tag('/home/notas1.jpg');?>
				<h2>Consulta las listas de útiles escolares</h2>
				<hr/>
				<p>La SEP y PROFECO dan a conocer la lista de útiles para el ciclo escolar 2012-2014
				</p>
				<p><a href='http://www.comunicacion.sep.gob.mx/index.php/comunicados/agosto/231-comunicado-118-dan-a-conocer-sep-y-profeco-la-lista-de-utiles-para-el-ciclo-escolar-2013-2014' >Leer más</a></p>
			</div>
			<div class='white-box column'>
				<?php $this->print_img_tag('/home/notas4.jpg');?>
				<h2>
				Los 10 quehaceres de nuestra familia
				</h2>
				<hr/>
				<p>
				Conoce 10 prácticas y actividades que te ayudarán a mejorar la educación de tus hij@s. Desde cómo desarrollar autonomía en el aprendizaje hasta cómo establecer mejores hábitos de estudio.
				</p>
				<p><a href='http://www.consejosescolares.sep.gob.mx/images/pdf/10quehaceres.pdf' >Descarga la guía completa aquí.</a></p>
			</div>
			<div class='white-box column'>
				<?php $this->print_img_tag('/home/notas2.jpg');?>
				<h2>Habilidad lectora</h2>
				<hr/>
				<p>
				Conoce los estándares nacionales de habilidad lectora y utiliza el cronómetro y la calculadora de velocidad lectora para medir cuantas palabras puede leer tu hij@ por minuto.
				</p>
				<p><a href=' http://www.leer.sep.gob.mx' >Para utilizar la herramienta haz click aquí</a></p>
			</div>
			<div class='white-box column'>
				<?php $this->print_img_tag('/home/notas3.jpg');?>
				<h2>
				¿Conoces los resultados ENLACE de tu hij@?
				</h2>
				<hr/>
				<p>Consulta aquí las calificaciones individuales de tu hij@ en la prueba ENLACE
				</p>
				<p><a href='http://www2.sepdf.gob.mx/SIEBDF01/Calif/calif000.jsp' >Leer más</a></p>
			</div>
			<div class='clear'></div>
		</div>
	</div>
	<div class='column right'>
		<div class='gray-box newsletter'>
			<?php if($this->get('news') && $this->get('news')!='false'){ 
						echo "<p>Registrado correctamente</p>";
			}else{
				if($this->get('news')=='false')
					echo "<p>Error intentalo de nuevo</p>";
				else
					echo "<p>Mantente informado</p>";
			
			  ?>
			<?php $this->print_img_tag('news.png');?>
			<form method='post' action='/home/newsletter/' accept-charstet='utf-8' class='newsletter' >
				<input name='correo' type='text' placeholder='Tu correo' class='required email' />
				<p class='check'><input type='checkbox' name='aviso' class='required' checked="checked" />	
					<a href='/aviso-de-privacidad'>Aceptar aviso de privacidad</a>
				</p>

				<input type='submit' value='Suscríbete' />
			</form>
			<?php } ?>
		</div>
		<a href='/peticiones/' class='banner orange peticiones'>
			<?php $this->print_img_tag('home/peticiones.png');?>
			Peticiones
		</a>
		<a href='/resultados-nacionales/' class='banner green resultados'><?php $this->print_img_tag('home/resultados.png');?>Resultados por estado</a>

		<a href="https://www.facebook.com/MejoraTuEscuela" class='gray-box' target='_blank' >
			<?php $this->print_img_tag('home/facebook_banner.jpg'); ?>
			/MejoraTuEscuela
		</a>
		<a href='https://twitter.com/mejoratuescuela' class='gray-box twitter' target='_blank' >
			<span class='icon'></span>
			@MejoraTuEscuela
		</a>
		<div class='clear'></div>
		<ul id='tweets' class='gray-box tweets'></ul>
	</div>
	<div class='clear'></div>
</div>
