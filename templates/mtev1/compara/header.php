<?php if(isset($this->principal) && $this->principal){?>
<div class='compara_search'>
	<div class='titles'>
		<h1>Conoce tu escuela</h1>

	</div>
	<hr />
	<h2 class='sb-title'>
			El primer paso para poder mejorar tu centro escolar es saber cómo está. <br />

			Te invitamos a que conozcas y compartas esta información.
	</h2>
	<?php $this->include_template('general_search','global'); ?>
	<div class='clear'></div>

</div>

<?php }else{ ?>
<div class='std_header container '>
	<?php $this->print_img_tag('header/ninio.jpg',false,'img','ninio') ?>
	<div class='titles'>
		<span><?php echo isset($this->title_header)?$this->title_header:'Compara tu escuela' ?></span>

	</div>

	<div class='clear'></div>
	<h2 class='sb-title'>
		
		<?php echo isset($this->subtitle_header) ?$this->subtitle_header:'
			El primer paso para poder mejorar tu centro escolar es saber cómo <br />
			está. Te invitamos a que conozcas y compartas esta información.';
		?>

	
	</h2>
</div>
<?php } ?>
