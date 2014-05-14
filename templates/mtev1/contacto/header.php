<div class='container reportes-ciudadanos contacto'>
	<div class='box'>
		<h1><span></span>Contáctanos</h1>
		<div class='content'>
			<form action='/contacto/enviar/' method='post' class = 'contacto-form'  >
				<input name='nombre' type='text' placeholder='Nombre' class='required' />
				<input name='email' type='text' placeholder='Correo Electrónico' class='required email'/>
				<textarea name='mensaje' rows='7' cols='68'  placeholder='Mensaje' class='required' ></textarea>
				<?=$this->get_captcha();?>
				<input type="submit" value="Enviar" />
			</form>
		</div>	
		<p><span class='icon'></span>contacto@mejoratuescuela.org</p>
		<p class='tel'><span class='icon'></span>5985-1017</p>
		<p class='tel'><span class='icon'></span>5985-1018</p>
		<p class='tel'><span class='icon'></span>5985-1019</p>	
		<?php 	if(isset($this->contact_status) && $this->contact_status)
				echo '<h3 class="msj" >Mensaje enviado</h3>';
			else if(isset($this->contact_status) && !$this->contact_status)
				echo '<h3 class="msj" >Error</h3>';
		?>
		<div class='clear'></div>
	</div>

</div>
