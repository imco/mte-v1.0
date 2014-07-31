	<div class='column right'>
		<div class='gray-box newsletter'>
			<?php if($this->get('news') && $this->get('news')!='false'){ 
						echo "<p class='news_register'>Registrado correctamente</p>";
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
		<?php
		/*<a href='/resultados-nacionales/' class='banner green resultados'><?php $this->print_img_tag('home/resultados.png');?>Resultados por estado</a>*/
		?>

		<a href='http://blog.mejoratuescuela.org/' class='banner blue'>
			<?php $this->print_img_tag('home/blog2.png');?>
			Blog
		</a>
		<?php
		/*<a href='peticiones/sienlace' class='banner orange peticiones'>
			<?php $this->print_img_tag('home/peticiones.png');?>
			Peticiones
		</a>*/
		?>


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
