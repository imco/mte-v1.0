<div class='container home quienes_somos'>
	<div class='column'>
		<div class='wrap_text'>
			<p>MejoraTuEscuela.org es una iniciativa ciudadana, independiente y sin fines de lucro.</p>
			<p>Nuestro equipo está integrado por miembros del Instituto Mexicano para la Competitividad A.C. (IMCO) con apoyo de la fundación Omidyar Network.</p>
			<p>A través de esta plataforma queremos promover la participación ciudadana para mejorar la educación en México. Estamos convencidos que la educación en nuestro país sólo mejorará con el compromiso activo de todos los miembros de la comunidad educativa, en particular los padres de familia.</p>
			<p>MejoraTuEscuela.org te invita a buscar y conocer cómo está la escuela de tus hijos, compararla con otras escuelas en tu zona, calificarla y darnos tu opinión sobre las cosas que necesitan mejorar y las que ya se están haciendo bien. Finalmente, te damos herramientas para que te vuelvas un miembro activo y comprometido que gestione cambios positivos y mejoras en tu comunidad educativa.</p>
			<p>MejoraTuEscuela.org es una plataforma de todos y para todos los mexicanos. Te invitamos a que la uses y nos ayudes a difundirla. ¡Gracias!</p>
			<p class="info">
				Para más información, escríbenos a:
				<span>contacto@mejoratuescuela.org</span>
				<br />
				o comunícate a los teléfonos de:
				<br />
				IMCO con Alexandra Zapata: 
				<span>(55)5985-1017 al 19.</span>
			</p>
			<a href='http://imco.org.mx/home/' >
				<?php $this->print_img_tag('quienes_somos/imco_qs.png'); ?>
			</a>
			<!--<a href='http://www.mexicanosprimero.org/' >
				<?php //$this->print_img_tag('quienes_somos/mexicanos1ero_qs.png'); ?>		
			</a>-->
			<a href='http://www.omidyar.com/' >
				<?php $this->print_img_tag('quienes_somos/on_qs.png'); ?>
			</a>
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
				<p class='check'><input type='checkbox' name='aviso' class='required' />	
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

		<a href="https://www.facebook.com/MejoraTuEscuela" class='gray-box'>
			<?php $this->print_img_tag('home/facebook_banner.jpg'); ?>
			/MejoraTuEscuela
		</a>
		<a href='https://twitter.com/mejoratuescuela' class='gray-box twitter'>
			<span class='icon'></span>
			@MejoraTuEscuela
		</a>
		<div class='clear'></div>
		<ul id='tweets' class='gray-box tweets'></ul>
	</div>
	<div class='clear'></div>
</div>
