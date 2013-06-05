<?php
$niveles = array(12 => 'primarias',13 => 'secundarias',22 => 'bachilleratos')
?>
<div class='container home'>
	<div class='column'>
		<h1 class='cap subtitle'><?php $this->print_img_tag('home/posicion.png');?> Mejores <?=$niveles[$this->publica->nivel->id]?>
			<span><a href='/compara/?search=true&amp;nivel=<?=$this->publica->nivel?>#resultados'>+Ver posiciones</a></span>
		</h1>
		<div class='gray-box wrap'>
			<div class="two-column left">
				<h1><?=$this->publica->rank_nacional?>&ordm; LUGAR PÚBLICA</h1>
				<h2><?=$this->capitalize($this->publica->nombre)?></h2>
				<p><?=$this->capitalize($this->publica->localidad->nombre)?>, <?=$this->capitalize($this->publica->entidad->nombre)?></p>
				<h3><a href="/escuelas/index/<?=$this->publica->cct?>">Ver perfil</a></h3>
			</div>
			<div class="two-column right">
				<h1><?=$this->privada->rank_nacional?>&ordm; LUGAR PRIVADA</h1>
				<h2><?=$this->capitalize($this->privada->nombre)?></h2>
				<p><?=$this->capitalize($this->privada->localidad->nombre)?>, <?=$this->capitalize($this->privada->entidad->nombre)?></p>
				<h3><a href="/escuelas/index/<?=$this->privada->cct?>">Ver perfil</a></h3>
			</div>
		</div>
		<h1 class='cap subtitle blue'><?php $this->print_img_tag('home/posicion.png');?> 5 mejores <?=$niveles[$this->nivel_5]?> en <?=$this->capitalize($this->user_location->nombre)?>
			<span><a href='/compara/?search=true&amp;entidad=<?=$this->user_location->id?>&amp;nivel=<?=$this->nivel_5?>#resultados'>+Ver más</a></span>
		</h1>
		<div class='gray-box'>
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
		<!--<div class='notas'>
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
		<div>
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
		</div>-->
	</div>
	<div class='column right'>
		<div class='gray-box newsletter'>
			<p>Mantente informado</p>
			<?php $this->print_img_tag('news.png');?>
			<form action="">
				<input name='' type='text' placeholder='Tu correo'/>
				<input type='submit' value='Suscribirme' />
			</form>
		</div>
		<a href='/compara/' class='banner orange'><?php $this->print_img_tag('home/comparador.png');?> Compara tu Escuela</a>
		<a href='/reportes-ciudadanos/' class='banner green'><?php $this->print_img_tag('home/denuncia_banner.png');?>Reportes ciudadanos</a>

		<a href="https://www.facebook.com/MejoraTuEscuela" class='gray-box'>
			<?php $this->print_img_tag('home/facebook_banner.jpg'); ?>
			/MejoraTuEscuela
		</a>
		<h2 class='twitcap'><?php $this->print_img_tag('home/twitter_logo.png') ?></h2>
		<div class='gray-box tweets'>
			<div class='tweet'>
				<?php $this->print_img_tag('home/voluntario1.jpg'); ?>
				<p><a href="" class='user'>babtiste</a> @mejoratu escuela. Nam a nisl nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. aliquet. </p>
			</div>
			<hr/>
			<div class='tweet'>
				<?php $this->print_img_tag('home/voluntario1.jpg'); ?>
				<p><a href="" class='user'>babtiste</a> @mejoratu escuela. Nam a nisl nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. aliquet. </p>
			</div>
			<hr/>
			<div class='tweet'>
				<?php $this->print_img_tag('home/voluntario1.jpg'); ?>
				<p><a href="" class='user'>babtiste</a> @mejoratu escuela. Nam a nisl nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. aliquet. </p>
			</div>
		</div>
	</div>
	<!--<div class='circle'>
		<a href='#'></a>
		<a class='line' href='#'></a>
		<a class='line' href='#'></a>
		<a class='line' href='#'></a>
		<div class="line1"></div>
		<div class="line2"></div>
	
	</div>-->
	<div class='clear'></div>
</div>
