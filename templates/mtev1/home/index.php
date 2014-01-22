<?php
$niveles = array(12 => 'primarias',13 => 'secundarias',22 => 'bachilleratos')
?>
<div class='container home'>
	<div class='column'>
		<div class='video'>
		
		</div>
		<h1 class='cap subtitle blue'><?php $this->print_img_tag('home/posicion.png');?> 5 mejores <?=$niveles[$this->nivel_5]?> en <?=$this->get_abreviatura_estado($this->user_location->nombre)?>
			<span><a href='/resultados-nacionales/'>+Ver más estados</a></span>
		</h1>
		<div class='gray-box'>
				<p class='title'>NOMBRE
					<span class='location'> | DIRECCIÓN</span>
				</p>
			<ol class='mejores'>
				<?php
				if($this->escuelas_digest->escuelas){
					foreach($this->escuelas_digest->escuelas as $escuela){
					echo "
						<li>
							<a href='/escuelas/index/{$escuela->cct}'>{$escuela->nombre}</a>
							<span class='location'> | {$escuela->localidad}, {$escuela->entidad} | {$escuela->control} </span>
						</li>
					";
				}}

				?>
			</ol>
		</div>
		<div id='notas-container' class='notas'>
			<?=file_get_contents($this->config->blog_address."notas")?>
			<div class='clear'></div>
			<div class="share-bt bl home" style='position:absolute;right:0;bottom:30px'>
				<a class="button-frame static" href="<?=$this->config->blog_address?>">
					<span class="bt-share">		
						Consulta más información en nuestro blog
					</span>
				</a>
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
		<a href='http://blog.mejoratuescuela.org/' class='banner blue'>
			<?php $this->print_img_tag('home/blog2.png');?>
			Blog
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
