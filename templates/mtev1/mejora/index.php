<?php 
$infografias = array('entorno'=>'Entorno',
		'participacion-mejora'=>'Participación',
		'aprendizaje'=>'Aprendizaje'
	);
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=1391573024393890";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>

<div class='container mejora'>
	<div class="wrap_tools">
		<a class="tools select" href="#">
			<span class="icon"></span>
			Herramientas de mejora
		</a>
		<a class="support" href="/mejora/programas/">
			<span class="icon"></span>
			Programas de apoyo
		</a>	
	</div>
	<div class="overlay-transparent"></div>
	<div class="display">
		<span class="close"></span>
		<div class="column left">
			<a class='move to-left' href="#back"></a>
			<?php $this->print_img_tag('mejora/1.jpg');?>
			<a class='move to-right' href="#next"></a>
		</div>
		<div class="column right">
			<div class="header">
				<span class="icon"></span>
				<p>3 temas para platicar con el maestro de tus hijos</p>
				<a class="download" href="">Descargar PDF</a>
			</div>
			<div class="wrap_content">
				<p>
				</p>
				<a href="" class='nota_completa'>
					<span class="icon"></span>
					Leer nota completa
				</a>
				<div class="info_share">

				</div>
			</div>
		</div>

	</div>
	<div class="column">
		<h1 class='banner green'><?=$this->get('id')?$infografias[$this->get('id')]:'Infografías más recientes' ?></h1>
		<div class="wrap">
			<?=file_get_contents($this->config->blog_address."mejora".($this->get('id')?'/?mejora='.$this->get('id'):'')) ?>
			<!--
			<div class="share-bt bl left" style='position:absolute;left:0;bottom:0;'>
				<a class="button-frame static" href="<?=$this->config->blog_address?>">
					<span class="bt-share button-efect orange-effect">		
						Más notas
					</span>
				</a>
			</div>
			<div class='clear'></div>	
		</div>
		-->

	</div>
	<div class="column">
		<h2 class='banner green'>Mejora tu...</h2>
		<ul>
			<li><a href="/mejora/index/entorno"><span class="icon"></span>Entorno</a></li>
			<li><a href="/mejora/index/participacion-mejora"><span class="icon"></span>Participación</a></li>
			<li><a href="/mejora/index/aprendizaje"><span class="icon"></span>Aprendizaje</a></li>

		</ul>

		<div class="gray-box form">
			<form action='<?=$this->config->blog_address; ?>' method='GET' accept-charset='utf-8' class='general-search' id='general-search'>
					<input name='s' id='name-input' type='text' placeholder="Busca una infografia" />
					<input type='submit' value='BUSCAR' />
			</form>
		</div>

		<div class="gray-box">
			<?php 
			if(isset($this->contact_status) && $this->contact_status){
				echo "<p>Gracias por tu mensaje.</p>";
			}else{
			?>
				<p>Si te interesa algún otro <br />
				tema que no aparezca en <br /> nuestra sección,
				<br />
				<span>ESCRÍBENOS:</span>
				</p>
				<form action="/mejora/enviar" method='post' accept-charset='utf-8' >
					<textarea name="mensaje" cols="30" rows="10" placeholder='Mensaje'></textarea>
					<input type="text" placeholder='Tu correo' name='email'/>
					<input type="submit" value='Envía al equipo de MTE'/>
				</form>
			<?php } ?>
		</div>
	</div>


	<div class='clear'></div>
</div>
