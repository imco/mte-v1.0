<div class='menu <?= ($this->get('action')=='escuelas')?' resultados':($this->location=='escuelas' && $this->get('action')=='index'?'compara':$this->location)?>'><div class='container'>
	<a href='/' class='logo'><?php $this->print_img_tag('logo_mejora.png'); ?></a>
	<a class='prncipal' href='/compara/'>1 CONOCE
		<span class='icon'></span>
	</a>
	<a class='prncipal' href='/compara/escuelas/'>2 COMPARA
		<span class='icon'></span>
	</a>
	<a class='prncipal' href='/califica-tu-escuela/califica/'>3 CALIFICA
		<span class='icon'></span>
	</a>
	<a class='prncipal' href='/mejora'>4 MEJORA
		<span class='icon'></span>
	</a>
	<div class='submenu'>
		<a href='/quienes-somos'>¿Quiénes somos?</a>
		<a href='/preguntas-frecuentes'>Preguntas frecuentes</a>
		<div class='social'>
			<a href='https://twitter.com/mejoratuescuela' class='twitter' target='_blank' >
			</a>
			<a href='https://www.facebook.com/MejoraTuEscuela' class='fb sprites' target='_blank' ></a>
			<div class='clear'></div>
		</div>
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
