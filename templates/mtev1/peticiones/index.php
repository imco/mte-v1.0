<div class='container peticion'>
	<h1 class='title'>
		Estas peticiones se crean en alianza con 
		<a href='http://www.change.org/'>change.org</a>
		<a href='http://www.change.org/es-LA/start-a-petition'>Inicie una petición</a>
	</h1>
	<?php 
	$this->petition_number = 1;
	$on = $this->get('id')?$this->get('id'):1;
	foreach($this->petition_info as $this->petition){ 
	?>
	<h1><?=$this->petition['title'] ?><span class='shadow'></span></h1>
	<div class='wrap_peticion <?php echo $on==$this->petition_number?'on':''; $this->petition_number; ?>'>

		<div class='content jscrollpane'>
			<h2><?=$this->petition['title'] ?></h2>
			<p><?=$this->petition['overview'] ?></p>
			<p><a href='<?=$this->petition['url'] ?>'>Leer más</a></p>

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
				<p><input type='text' name='email' placeholder='Correo electrónico'  class='required email' /></p>
				<p><select name='pais' class='custom-select' class='required'  >
					<option value=''>País</option>
					<?php $this->include_template('countries','peticiones'); ?>
				</select></p>
				<p><input type='text' name='ciudad' placeholder='Ciudad'  class='required' /></p>
				<p><input type='text' name='cp' placeholder='Código Postal' class='required'  /></p>
				<p><input type='checkbox' name='public' checked='checked' />publicar mi firma</p>
				<p>
					<input type='submit' value='Firma' />
					<input type='hidden' value='<?=$this->petition['url']?>' name='petition_url' />
					<input type='hidden' value='<?=$this->petition_number?>' name='number' />
				</p>

			<?php } ?>
		</form>	
	
		<div class='firmas'>
			<div class='img'></div>
			<h3>Gracias a ti ya somos</h3>
			<h2><?=$this->petition['signature_count']?></h2>
			<?php $this->include_template('share_buttons','global')?>
		</div>
		<div class='clear'></div>
	</div>
	<?php } ?>
</div>
