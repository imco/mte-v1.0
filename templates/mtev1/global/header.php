<div class='menu <?= $this->location?>'><div class='container'>
	<a href='/' class='logo'><?php $this->print_img_tag('home/logo.png'); ?></a>	
	<a href='/comparador'>Comparador</a>
	<a href='/reportes-ciudadanos'>Reportes Ciudadanos</a>
	<a href='/datos-abiertos'>Datos Abiertos</a>
	<a href='/ayuda'>Ayuda</a>
	<form method='get' action='/buscar/' accept-charset='utf-8' ><input type='text' placeholder='Buscar' /></form>
	<div class='social'>
		<a href='http://facebook.com' class='fb'></a>
		<a href='http://twitter.com' class='twitter'></a>
	</div>
	<div class='clear'></div>
</div></div>