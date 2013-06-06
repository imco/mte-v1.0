<div class='container peticion'>
	<h1><?=$this->peticion['title'] ?><span class='shadow'></span></h1>
	<div class='content'>
		<h2><?=$this->peticion['title'] ?></h2>
		<p><?=$this->peticion['overview'] ?></p>
		<p><a href='<?=$this->peticion['url'] ?>'>Leer más</a></p>

	</div>
	<form action='/peticiones/firmar' method='post' class='petition-form' accept-charset='utf-8'>
		<?php 
		if(isset($this->sign_result) && $this->sign_result->result != 'failure'){
			echo "<h2>Gracias por firmar la peticion</h2>";
		}else{
			if(isset($this->sign_result) && $this->sign_result->result == 'failure'){
				echo "<h2>Error</h2>";
				echo "<p>".$this->sign_result->messages[0].'</p>';
			}else{
				echo "<h2>Firma Aquí</h2>";
			}
		?>			
			<p><input type='text' name='nombre' placeholder='Nombre' class='required' /></p>	
			<p><input type='text' name='email' placeholder='Email'  class='required email' /></p>
			<p><select name='pais' class='custom-select' class='required'  >
				<option value=''>País</option>
				<?php $this->include_template('countries','peticiones'); ?>
			</select></p>
			<p><input type='text' name='ciudad' placeholder='Ciudad'  class='required' /></p>
			<p><input type='text' name='cp' placeholder='Código Postal' class='required'  /></p>
			<p>
				<input type='submit' value='Firmar' />
				<input type='hidden' value='<?=$this->petition_url?>' name='petition_url' />
			</p>
			<p><input type='checkbox' name='public' checked='checked' />publicar mi firma</p>
		<?php } ?>
	</form>	
	
	<div class='firmas'>
		<div class='img'></div>
		<h3>Gracias a ti ya somos</h3>
		<h2><?=$this->peticion['signature_count']?></h2>
	</div>
	<div class='clear'></div>
</div>