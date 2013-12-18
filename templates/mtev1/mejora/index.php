<?php 
$infografias = array('entorno-social'=>'Entorno Social',
		'infraestructura'=>'Infraestructura',
		'aprendizaje'=>'Mejora tu aprendizaje'
	);
?>
<div class='container mejora'>
	<div class="column">
		<h1 class='banner green'><?=$this->get('id')?$infografias[$this->get('id')]:'Infografías más recientes' ?></h1>
		<div class="wrap">
			<?=file_get_contents($this->config->blog_address."mejora".($this->get('id')?'/?mejora='.$this->get('id'):'')) ?>

			<div class="share-bt bl left" style='position:absolute;left:0;bottom:0;'>
				<a class="button-frame static" href="<?=$this->config->blog_address?>">
					<span class="bt-share button-efect">		
						Más notas
					</span>
				</a>
			</div>
			<div class='clear'></div>	
		</div>

	</div>
	<div class="column">
		<h2 class='banner green'>Mejora tu...</h2>
		<ul>
			<li><a href="/mejora/index/entorno-social"><span class="icon"></span>Entorno social</a></li>
			<li><a href="/mejora/index/infraestructura"><span class="icon"></span>Infraestructura</a></li>
			<li><a href="/mejora/index/aprendizaje"><span class="icon"></span>Mejora tu aprendizaje</a></li>

		</ul>

		<div class="gray-box">
			<p>Si te interesa algún otro <br />
 tema que no aparezca en <br /> nuestra sección,
			<br />
			<span>ESCRÍBENOS:</span>
			</p>
			<form action="">
				<textarea id="" name="" cols="30" rows="10" placeholder='Mensaje'></textarea>
				<input type="text" placeholder='Tu correo'/>
				<input type="submit" value='Envía al equipo de MTE'/>
			</form>
		</div>
	
	</div>


	<div class='clear'></div>
</div>
