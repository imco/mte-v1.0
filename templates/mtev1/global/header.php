<div class='menu <?= $this->location?>'><div class='container'>
	<a href='/' class='logo'><?php $this->print_img_tag('home/logo.png'); ?></a>	
	<a href='/compara'>Comparador</a>
	<a href='/califica-tu-escuela'>Califica tu escuela</a>
	<a href='/resultados-nacionales'>Resultados Nacionales</a>
	<a href='/peticiones'>Peticiones</a>
	<a href='/ayuda'>Ayuda</a>
	<form method='get' action='/compara/#resultados' accept-charset='utf-8' ><input type='text' name='term' placeholder='Buscar' /><input type='hidden' name='search' value='true' /></form>
	<div class='social'>
		<a href='https://www.facebook.com/MejoraTuEscuela' class='fb'></a>
		<a href='https://twitter.com/mejoratuescuela' class='twitter'></a>
	</div>
	<div class='clear'></div>
</div></div>
<div class="breadcrumb">
	<ul>
<?php if(true){ ?>
		<li>
			<a href="/">
				<?php $this->print_img_tag('home.png'); ?>"
			</a>
		</li>
	<?php foreach($this->breadcrumb as $url => $breadcrumb){ ?>
			<li>
				<?if($url!='#') {?>
					<a href="<?=$url ?>"><?=$breadcrumb ?></a>
				<?php } else echo $breadcrumb ?>
					
			</li>
			<?php } ?>
<?php	} ?>	
	</ul>
</div>
