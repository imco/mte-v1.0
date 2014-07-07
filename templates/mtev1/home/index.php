<div class='container home'>
	<div class='column'>
		<div class='video'>
		<iframe width="595" height="335" src="//www.youtube.com/embed/G4FOZyoB74Y" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="changeAjax">
			<?php $this->include_template("top5","home/single"); ?>
		</div>
		<div id='notas-container' class='notas'>
			<?=file_get_contents($this->config->blog_address."notas")?>
			<div class='clear'></div>
			<div class="share-bt bl home" style='position:absolute;right:0;bottom:30px'>
				<a class="button-frame static" href="<?=$this->config->blog_address?>">
					<span class="bt-share">		
						Consulta más información en nuestro blog
					</span>
				</a>
			</div>
			<div class='clear'></div>

		</div>
	</div>
	<!--<div class='column right'>-->
	<?php $this->include_template('sidebar','home');?>
	<div class='clear'></div>
</div>
