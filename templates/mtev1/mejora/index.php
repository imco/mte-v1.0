<div class='container mejora'>
	<?php $column = array('left','center','right');
	$url = $this->config->http_address."files/infografias/";
	?>
	<div class='column <?=$column[0]?>'>
	
		<div class='mejorar'>
			<h1>
				<?php $this->print_img_tag('mejora/1.jpg') ?>

				<a href="<?=$url."MTE_01.pdf"?>">
				<span>Descargar</span>
				</a>
			</h1>
			<h2>3 Temas para platicar con el maestro de tus hijos</h2>
			<hr />
			<p></p>
		</div>
		<div class='mejorar'>
			<h1>
				<?php $this->print_img_tag('mejora/3.jpg') ?>


				<a href="<?=$url."MTE_4.pdf"?>">
								<span>Descargar</span>
				</a>
			</h1>
			<h2>Calendario escolar 2013-2014</h2>
			<hr />
			<p></p>
		</div>
	</div>
	<div class='column <?=$column[1]?>'>
	
		<div class='mejorar'>
			<h1>
				<?php $this->print_img_tag('mejora/2.jpg') ?>
				<a href="<?=$url."MTE_2.pdf"?>">
								<span>Descargar</span>
				</a>

				</h1>
			<h2>10 Consejos para que tus hijos aprendan mejor</h2>
			<hr />
			<p></p>
		</div>
	</div>
	<div class='column <?=$column[2]?>'>
	
		<div class='mejorar'>
			<h1>
				<?php $this->print_img_tag('mejora/4.jpg') ?>

				<a href="<?=$url."MTE_03.pdf"?>">
								<span>Descargar</span>
				</a>
			</h1>
			<h2>¿En qué te debes fijar de la infraestructura de la escuela?</h2>
			<hr />
			<p></p>
		</div>
	</div>

	<div class='clear'></div>
</div>
