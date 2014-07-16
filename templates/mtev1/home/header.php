<div class=' home  container'>	
	<?php 
		$logo = array('header/ninio.jpg','header/ninia.png');
		$child = $this->cookie("child");
		$child = $child===false?rand(0,1):($child==0?1:0);
		$this->print_img_tag($logo[$child],false,'img','ninio');
		$this->set_cookie("child",$child);
	?>
	<div class='titles'>
		<h1>
			MejoraTuEscuela.org es una plataforma de participación ciudadana <br />
			para transformar la educación en México
		</h1>
	</div>
	<!--
	<a href='/compara/' class='button-frame'><span class='button'>Compara tu escuela</span></a>
	-->
	<div class='clear'></div>
	<?php $this->include_template('simple_search','global'); ?>
</div>
