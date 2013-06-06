<div class='container peticion'>
	<h1><?=$this->peticion['title'] ?><span class='shadow'></span></h1>
	<div class='content'>
		<h2><?=$this->peticion['title'] ?></h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fermentum dignissim egestas. Etiam sagittis diam id molestie euismod. Cras nec imperdiet ipsum. Curabitur elementum ullamcorper viverra. Donec eget vestibulum augue. Cras luctus purus ultricies arcu scelerisque, quis scelerisque turpis volutpat. Nullam id lorem in est consequat interdum et in dolor. Curabitur volutpat, sapien quis dictum porta, tortor lorem convallis lorem, sed iaculis purus tellus in lorem. Curabitur faucibus ullamcorper justo sed sodales. Duis et rutrum tellus, eget faucibus mauris. . Duis et rutrum tellus, eget faucibus mauris . Duis et rutrum tellus, eget faucibus mauris</p>
		<p><a href=''>Leer más</a></p>

	</div>
	<form action='/peticiones/firmar' method='post' accept-charset='utf-8'>
		<h2>Firma Aquí</h2>
		<p><input type='text' name='email' placeholder='Email' /></p>
		<p><input type='text' name='nombre' placeholder='Nombre' /></p>
		<p><select name='pais' class='custom-select' >
			<option value=''>País</option>
			<?php $this->include_template('countries','peticiones'); ?>
		</select></p>
		<p><input type='text' name='ciudad' placeholder='ciudad' /></p>
		<p><input type='text' name='pais' placeholder='pais' /></p>
		<p><input type='submit' value='Firmar' /></p>


	</form>	
	
	<div class='firmas'>
		<div class='img'></div>
		<h3>Gracias a ti ya somos</h3>
		<h2>23,997</h2>
	</div>
	<div class='clear'></div>
</div>
