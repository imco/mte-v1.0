<div class='container home quienes_somos'>
	<div class='column'>
		<div class='wrap_text'>
			<p>MejoraTuEscuale.org es una iniciativa ciudadana, independiente y sin fines de lucro.</p>
			<p>Nuestro equipo esta integrado por miembros del Instituto Mexicano para la Competitivida A.C (IMCO) y de Mexicanos Primero A.C con apoyo de la fundación Omidyar Network</p>
			<p>A través de esta plataforma queremos promover la participación ciudadana para mejorar la educación en México. Estamos convencidos que la educación en nuestro pais sólo mejorará con el compromiso activo de todos los miembros de la comunidad educativa, en particular los padres de familia.</p>
			<p>MejoraTuEscuela.org te invita a buscar y conocer como esta la escuela de tus hijos, compararla con otras escuelas en tu zona, calificarla y darnos tu opinión sobre las cosas que necesitan mejorar y las que ya se están haciendo bien. Finalment, te damos herramientas para que te vuelvas un miembro activo y comprometido que gestione cambios positivos y mejoras en tu comunidad educativa.</p>
			<p>MejoraTuEscuela.org es una plataforma de todos y para todos los mexicanos. Te invitamos a que la uses y nos ayudes difundirla. ¡Gracias!</p>
			<p class="info">
				Para mas información, escribenos a:
				<span>contacto@mejoratuescuela.org</span>
				<br />
				o comunicate a los teléfonos de:
				<br />
				IMCO con Alexandra Zapata: 
				<span>(55)5985-1017 al 19.</span>
			</p>
			<?php $this->print_img_tag('home/imco_footer.png'); ?>

			<?php $this->print_img_tag('home/mexprimero_footer.png'); ?>
		</div>
	</div>
	<div class='column right'>
		<div class='gray-box newsletter'>
			<p>Mantente informado</p>
			<?php $this->print_img_tag('news.png');?>
			<form action="">
				<input name='' type='text' placeholder='Tu correo'/>
				<input type='submit' value='Suscribirme' />
			</form>
			<a href='/aviso-de-privacidad'>Aviso de privacidad</a>
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
