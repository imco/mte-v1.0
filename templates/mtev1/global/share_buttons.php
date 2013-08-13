<div class="share-bt comp">
	<div class="social">
		<div class="btns">
			
			<?php 
			$url_logo = $this->config->http_address."templates/".$this->config->theme."/img/home/logo.png";
			$url = $this->config->http_address.$this->location;
			if($this->location == 'peticiones'){
				$title = 'Firma la peticion :';
				$description = $this->petition['title'];
				$url = $this->config->http_address.'/peticiones/index/'.$this->petition_number;
			}else if($this->location == 'resultados_nacionales'){
				$url = $this->config->http_address.$this->location."/".$this->get('action')."/".$this->get('id');
				$title = "Resultados de ".$this->capitalize($this->entidad->nombre);
			}
			
			?>
			<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?=$url?>&p[images][0]=<?=$url_logo?>&p[title]=<?=$title?>&p[summary]=<?=$description?>" class='share-face' target='_blank' >
				  </a>

				<div class="tweet">
				  <span class="twitter-icon"></span>
				  <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-text=" <?php 		if($this->location == 'compara' &&  isset($this->escuelas)){;
				  echo 'Compara:';
			  	for($i=0;$i<count($this->escuelas)-1;$i++){
			  		echo $this->capitalize($this->escuelas[$i]->nombre).', ';
				}
					echo $this->capitalize($this->escuelas[$i]->nombre);
			}else{
				echo $title;
			
			} ?>" data-via='mejoratuescuela'>
			  	Tweet
				  </a>
				</div>
			  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
	<a href="#" class="button-frame">
		<span class="bt-share">
			<?php $this->print_img_tag('compartir/compartir.png');?>
			Compartir
		</span>
	</a>
</div>
