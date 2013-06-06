<div class='container peticion'>
	<h1><?=$this->peticion['title'] ?><span class='shadow'></span></h1>
	<div class='content'>
		<h2><?=$this->peticion['title'] ?></h2>
		<p><?=$this->peticion['overview'] ?></p>
		<p><a href='<?=$this->peticion['url'] ?>'>Leer más</a></p>

	</div>
	<form action='/peticiones/firmar' method='post' accept-charset='utf-8'>
		<h2>Firma Aquí</h2>
		<p><input type='text' name='email' placeholder='Email' /></p>
		<p><input type='text' name='nombre' placeholder='Nombre' /></p>
		<p><select name='pais' class='custom-select' >
			<option value=''>País</option>
			<?php $this->include_template('countries','peticiones'); ?>
		</select></p>
		<p><input type='text' name='ciudad' placeholder='Ciudad' /></p>
		<p><input type='text' name='cp' placeholder='Código Postal' /></p>
		<p><input type='checkbox' name='public' />publicar mi firma</p>
		<p><input type='submit' value='Firmar' /></p>
	</form>	
	
	<div class='firmas'>
		<div class='img'></div>
		<h3>Gracias a ti ya somos</h3>
		<h2><?=$this->peticion['signature_count']?></h2>
	</div>
	<div class='clear'></div>
</div>