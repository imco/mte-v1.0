<div class='menu <?= ($this->get('action')=='escuelas')?' resultados':($this->location=='escuelas' && $this->get('action')=='index'?'compara':$this->location)?>'><div class='container'>
	<a href='/' class='logo'><?php $this->print_img_tag('home/logo.png'); ?></a>
	<a href='/compara/'>CONOCE
		<span class='icon sprites'></span>
		<span class='circle'></span>
		<span class='decor'>1</span>
	</a>
	<a href='/compara/escuelas/'>COMPARA
		<span class='icon sprites'></span>
		<span class='circle'></span>
		<span class='decor'>2</span>
	</a>
	<a href='/califica-tu-escuela/califica/'>CALIFICA
		<span class='icon sprites'></span>
		<span class='circle'></span>
		<span class='decor'>3</span>
	</a>
	<a href='/mejora'>MEJORA
		<span class='icon sprites'></span>
		<span class='circle'></span>
		<span class='decor'>4</span>
	</a>
	<!--
	<a href='/resultados-nacionales'>Resultados Nacionales</a>
	<a href='/peticiones'>Peticiones</a>
	-->
	<div class='submenu'>
		<div class='social'>
			<a href='https://twitter.com/mejoratuescuela' class='twitter sprites' target='_blank' >
			</a>
			<a href='https://www.facebook.com/MejoraTuEscuela' class='fb sprites' target='_blank' ></a>
			<div class='clear'></div>
		</div>
		<!--<form method='get' action='/compara/#resultados' accept-charset='utf-8' ><input type='text' name='term' placeholder='Buscar' /><input type='hidden' name='search' value='true' />
			<input type='submit' value='' />
			<div class='clear'></div>
		</form>-->
		<a href='/quienes-somos'>¿Quiénes somos?</a>
		<a href='/preguntas-frecuentes'>Preguntas frecuentes</a>

	</div>

	<div class='clear'></div>
</div></div>

<div class="breadcrumb <?=$this->location."_breadcrumb" ?>">
	<ul>
<?php if($this->breadcrumb){ ?>
		<li>
			<a href="/">
				<?php $this->print_img_tag('breadcrumb/home.png'); ?>
			</a>
		</li>

	<?php foreach($this->breadcrumb as $url => $breadcrumb){ ?>
			<li>
				<?php if($url!='#') {?>
					<a href="<?=$url ?>"><?=$breadcrumb ?></a>
				<?php } else { ?>
					<a class='current' href="<?=$url ?>"><?=$breadcrumb?></a>
				<?php } ?>	
			</li>
			<?php } ?>
<?php	} ?>	
	</ul>
</div>
<a href='/peticiones/sienlace' id='sienlace-banner'><span></span></a>