<form action='/compara#resultados' method='get' accept-charset='utf-8' class='general-search' id='general-search'>
	<p class='button-frame'>
		<input name='term' id='name-input' type='text' placeholder='Búscar Escuela' value='<?=$this->request('term');?>' />
		<input type='submit' class='integrated' value='' />
		<input type='hidden' name='search' value='true' />
	</p>
	<p class='adv-search'><a href='/compara/' >Búsqueda Avanzada</a></p>
 </form>
<div class="decorations simple">
	<hr />
	<hr />
	<hr />
	<hr />
	<hr />	
	<?php $this->print_img_tag('home/palomita.png');?>
	<?php $this->print_img_tag('home/birrete_small.png');?>
</div>

