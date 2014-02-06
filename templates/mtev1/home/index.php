<?php
$niveles = array(12 => 'primarias',13 => 'secundarias',22 => 'bachilleratos')
?>
<div class='container home'>
	<div class='column'>
		<div class='video'>
		<iframe width="595" height="335" src="//www.youtube.com/embed/G4FOZyoB74Y" frameborder="0" allowfullscreen></iframe>
		</div>
		<h1 class='cap subtitle blue'><?php $this->print_img_tag('home/posicion.png');?> <span class='title_smaller'>5 mejores <?=$niveles[$this->nivel_5]?> en</span> <?=$this->get_abreviatura_estado($this->user_location->nombre)?>
			<span><a href='/resultados-nacionales/'>+Ver más estados</a></span>
		</h1>
		<div class='gray-box'>
				<p class='title'>NOMBRE
					<span class='location'> | DIRECCIÓN</span>
				</p>
			<ol class='mejores'>
				<?php
				if($this->escuelas_digest->escuelas){
					foreach($this->escuelas_digest->escuelas as $escuela){
					echo "
						<li>
							<a href='/escuelas/index/{$escuela->cct}'>{$escuela->nombre}</a>
							<span class='location'> | {$escuela->localidad}, {$escuela->entidad} | {$escuela->control} </span>
						</li>
					";
				}}

				?>
			</ol>
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
