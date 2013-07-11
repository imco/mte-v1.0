<div class='blog container'>
	<div class='column left'>
	<?php for($p=0;$p<2;$p++) { ?>
		<div class='post'>
			<h1 class='title'>Titulo de la Nota para Blog</h1>
			<h2 class='info'>Nombre del Autor | 
				<span class='date'>día. Mes. Año</span>
			</h2>

			<p>
				<?php $this->print_img_tag('schoolchildren.png'); ?>
				This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet,
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam molestie id magna eu eleifend. Donec nec ligula porta, interdum ante sit amet, ullamcorper odio. Sed lacinia porta mi, quis iaculis nibh eleifend et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent rutrum magna quis consequat sodales. Praesent sit amet urna dignissim, dignissim enim at, imperdiet eros. Maecenas viverra arcu dapibus lectus fermentum tempus. Nulla sit amet sapien rutrum, consectetur felis id, sagittis nisl. Nullam quis nunc ultricies, eleifend tortor vitae, pharetra mauris. 			</p>
			<div class='share-bt bl'>
				<div class='social'>
					<div class='btns'>
						<a href='#' class='share-face' 
				 	 	onclick="
						      window.open(
				            		'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
					          	'El perfil', 
						       	'width=626,height=436'); 
							 return false;">
						  </a>
		
						<div class='tweet'>
							<span class='twitter-icon'></span>
							 <a href='https://twitter.com/share' class='twitter-share-button' data-lang='en' data-text='Blog title' data-via='mejoratuescuela'>
							  </a>
						</div>
						  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
				</div>
				<a href='#' class='button-frame'>
					<span class='bt-share'>
						<?php $this->print_img_tag('compartir/compartir.png');?>
						Compartir
					</span>
				</a>
			</div>
			<div class='clear'></div>
			<div class='shadow'></div>
		</div>
		<?php } ?>
	</div>
	<div class='column right'>
		<h1>NOTAS RECIENTES</h1>

		<ul>
		<?php for($i=0;$i<10;$i++){ ?>
			<li><a href=''>Titulo de la Nota para Blog</a></li>
		<?php } ?>
		</ul>
	</div>
	<div class='clear'></div>
</div>
