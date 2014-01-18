<form action='<?=$this->get('action') == 'califica'?'/califica-tu-escuela/califica':'/compara#resultados'?>' method='get' accept-charset='utf-8' class='general-search' id='general-search'>
	<p class='button-frame'>
		<input name='term' id='name-input' type='text' placeholder='Busca tu escuela' value='<?=$this->request('term');?>' />
		<input type='submit' class='integrated' value='' />
		<span class='icon sprites'></span>
		<input type='hidden' name='search' value='true' />
	</p>
	<p class='adv-search'><a href='/compara/' >Búsqueda avanzada
		<span class='icon sprites'></span>
	</a></p>
 </form>

