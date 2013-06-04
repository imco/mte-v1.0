<div class='menu <?= $this->location?>'><div class='container'>
	<a href='/' class='logo'><?php $this->print_img_tag('home/logo.png'); ?></a>	
	<a href='/compara'>Comparador</a>
	<a href='/reportes-ciudadanos'>Reportes Ciudadanos</a>
	<a href='/datos-abiertos'>Datos Abiertos</a>
	<a href='/ayuda'>Ayuda</a>
	<form method='get' action='/compara/#resultados' accept-charset='utf-8' ><input type='text' name='term' placeholder='Buscar' /><input type='hidden' name='search' value='true' /></form>
	<div class='social'>
		<a href='https://www.facebook.com/MejoraTuEscuela' class='fb'></a>
		<a href='https://twitter.com/mejoratuescuela' class='twitter'></a>
	</div>
	<div class='clear'></div>
</div></div>
