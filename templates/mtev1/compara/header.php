<div class='compara container'>
	<div class='titles'>
		<h1><?php echo isset($this->title_header)?$this->title_header:'Compara tu escuela' ?></h1>
		<hr/>
		<h2>
			<?php echo isset($this->subtitle_header) ?$this->subtitle_header:'
			MejoraTuEscuela.org es una plataforma de participacion <br />
			ciudadana que busca promover cambios positivos <br />
			en la educacion de México.';
			?>
		</h2>
	</div>
	<div class='clear'></div>
	<?php //$this->include_template('general_search','global'); ?>
	<div class='decorations'>
		<div class='wrap-triangle'>
			<div class='triangle'>
				<?php $this->print_img_tag('home/blco_header.png');?>
			</div>
		</div>
		<div class='triangle2'></div>
		<div class='circle'></div>
		<div class='circle'></div>
		<div class='circle'></div>
		<div class='circle'></div>
		<hr />
		<hr />
		<hr />
		<hr />
		<?php $this->print_img_tag('home/palomita.png');?>
		<?php $this->print_img_tag('home/birrete_small.png');?>
		<?php $this->print_img_tag('home/footer_vineta.png');?>
	</div>
</div>
<div class='decorations compara'>
	<hr /><hr /><hr />
</div>
