<div class="container programas">
	<div class="column left">
		<h1 class="title">Programa Escuela Segura</h1>
		<div class="white-box">
			<h3>Objetivo del programa</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic consectetur quam odio. Necessitatibus, voluptatibus optio facilis ullam quas amet quidem nobis pariatur maxime sit magni reiciendis inventore nemo. Corporis, fugit.</p>
			<p><span class="blue">Tema especifico que atiende el prgrama</span> Seguridad escolar</p>
		</div>
		<h2 class="title">Descripcion del programa</h2>
		<div class="white-box">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, fugiat, illum repellat facilis laborum ducimus voluptatem doloribus odit amet deleniti similique deserunt dolor laboriosam eos qui enim perspiciatis maxime architecto.</p>
		</div>
		<h2 class="title green">Clave CCT de las escuelas en las que se trabaja(2013/2014)</h2>
		<div class="white-box map">
			<table>
				<?php for($countT=0;$countT<3;$countT++): ?>
				<tr>
					<td>CCT 873420 | Colegio Alexandre</td>
					<td><a href="#" class="button-frame"><span class="button">Ver escuela</span></a></td>
					<div class="clear"></div>
				</tr>
				<?php endfor; ?>
			</table>
		</div>

		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B'>
			<fieldset>
				<!--<p>Deja aquí un comentario sobre esta escuela</p>-->
				<div class="comment-cloud"></div>
				<textarea placeholder='Deja un comentario aqui' name='comentario' class='required'></textarea>
				
				<div class="box-hidden">
					<input type='text' placeholder='Nombre' name='nombre' />
					<input type='text' class='required email' placeholder='Email (obligatorio)' name='email' />
					<select class='custom-select required' name='ocupacion' >
						<option value=''>¿Quién eres?</option>
						<option value='alumno'>Alumno</option>
						<option value='exalumno'>Exalumno</option>
						<option value='padredefamilia'>Padre de familia</option>
						<option value='maestro'>Maestro</option>
						<option value='director'>Director</option>
						<option value='ciudadano'>Ciudadano</option>
					</select>
					<?=$this->get_captcha();?>
					<p><input type='submit' value='Enviar' /></p>
					<p>Aviso de privacidad.
						<span>
						En ningún momento haremos público tu correo electrónico con tu reporte o comentario.
						</span>
					</p>
				</div>

			</fieldset>		
		</form>

		<div class="info">
			<h2 class="title">¿Que debe hacer una escuela que esta interesada en participar en el proyecto?</h2>
			<div class="white-box">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, corporis consequuntur esse quasi debitis voluptates dolores sapiente error libero architecto veniam non accusantium. Sunt, labore ex ea tempora. Culpa, saepe.</p>
			</div>
			<h2 class="title">Pagina web del programa</h2>
			<div class="white-box">
				<a href="#" >http://basica.sep.gob.mx/escuelasegura</a>
			</div>
			<h2 class="title">Contácto</h2>
			<div class="white-box">
				<p>33 01 600(Ciudad de Mexico) o desde los Estados al 01 800 767 8368 o via correo electronico: <a href="#">quejas@sep.gob.mx</a> con copia para <a href="#">escuelasegura@sep.gob.mx</a></p>
			</div>
		</div>
	</div>
	<div class="column right">
		<h1>Otros programas</h1>
		<div class="lista-programas">
			<h2>Programas federales</h2>
			<ul>
				<li><a href="#">Programa escuelas de calidad</a></li>
				<li><a href="#">Programa escuela segura</a></li>
				<li><a href="#">Programa escuelas tiempo completo</a></li>
			</ul>			
		</div>

		<div class="lista-programas">
		<h2>Programas OSC´s</h2>
		<ul>
			<li><a href="#">Escuela siempre Abierta</a></li>
			<li><a href="#">Programa escuela segura</a></li>
			<li><a href="#">Programa escuelas tiempo completo</a></li>
			<li><a href="#">Programa escuelas de calidad</a></li>
			<li><a href="#">Programa nacional de lectura</a></li>
			<li><a href="#">Escuela de Jornada Amplia</a></li>

		</ul>			
		</div>

		<div class="share-blue">
			<a href="javascript:window.print()" class="option print"><span class="icon"></span>Imprimir</a>
			<a href="#" class="option share"><span class="icon"></span></span>Compartir</a>	
			<?php
			//if($this->location == 'escuelas' && $this->get('action')=='index')
				$this->include_template('share_buttons_simple','global');
			?>
		</div>
	</div>
</div>