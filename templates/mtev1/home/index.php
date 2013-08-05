<?php
$niveles = array(12 => 'primarias',13 => 'secundarias',22 => 'bachilleratos')
?>
<div class='container home'>
	<div class='column'>
		<div class='video'>
		
		</div>
		<h1 class='cap subtitle blue'><?php $this->print_img_tag('home/posicion.png');?> 5 mejores <?=$niveles[$this->nivel_5]?> en <?=$this->capitalize($this->user_location->nombre)?>
			<span><a href='/compara/?search=true&amp;entidad=<?=$this->user_location->id?>&amp;nivel=<?=$this->nivel_5?>#resultados'>+Ver más estados</a></span>
		</h1>
		<div class='gray-box'>
				<p class='title'>NOMBRE
					<span class='location'> | DIRECCIÓN</span>
				</p>
			<ol class='mejores'>
				<?php
				foreach($this->escuelas_digest->escuelas as $escuela){
					echo "
						<li>
							<a href='/escuelas/index/{$escuela->cct}'>{$escuela->nombre}</a>
							<span class='location'> | {$escuela->localidad}, {$escuela->entidad} | {$escuela->control} </span>
						</li>
					";
				}

				?>
			</ol>
		</div>
		<div class='notas'>
			<div class='white-box column'>
				<?php $this->print_img_tag('schoolchildren.png');?>
				<h2>Notas relevantes</h2>
				<hr/>
				<p>roin iaculis elementum fermentum. Aenean odio augue, hendrerit id consectetur quis, lacinia ac augue. Sed non mauris lectus, sedconsectetur quis, lacinia ac augue. Sed non mauris lectus, sed </p>
				<p><a href="/">Leer más</a></p>
			</div>
			<div class='white-box column'>
				<?php $this->print_img_tag('schoolchildren.png');?>
				<h2>Notas relevantes</h2>
				<hr/>
				<p>roin iaculis elementum fermentum. Aenean odio augue, hendrerit id consectetur quis, lacinia ac augue. Sed non mauris lectus, sedconsectetur quis, lacinia ac augue. Sed non mauris lectus, sed </p>
				<p><a href="/">Leer más</a></p>
			</div>
			<div class='white-box column'>
				<?php $this->print_img_tag('schoolchildren.png');?>
				<h2>Notas relevantes</h2>
				<hr/>
				<p>roin iaculis elementum fermentum. Aenean odio augue, hendrerit id consectetur quis, lacinia ac augue. Sed non mauris lectus, sedconsectetur quis, lacinia ac augue. Sed non mauris lectus, sed </p>
				<p><a href="/">Leer más</a></p>
			</div>
			<div class='white-box column'>
				<?php $this->print_img_tag('schoolchildren.png');?>
				<h2>Notas relevantes</h2>
				<hr/>
				<p>roin iaculis elementum fermentum. Aenean odio augue, hendrerit id consectetur quis, lacinia ac augue. Sed non mauris lectus, sedconsectetur quis, lacinia ac augue. Sed non mauris lectus, sed </p>
				<p><a href="/">Leer más</a></p>
			</div>
			<div class='clear'></div>
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
