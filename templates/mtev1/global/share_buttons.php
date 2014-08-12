<div class="share-bt comp  <?=$this->location."_".($this->get('action')?$this->get('action'):"") ?>">
	<div class="social">
		<div class="btns">
			
			<?php 
			$url_logo = $this->config->http_address."templates/".$this->config->theme."/img/home/logo.png";
			$url = $this->config->http_address.$this->location;
			if($this->location == 'peticiones'){
				$title = 'Firma la peticion :';
				$description = $this->petition['title'];
				$url = $this->config->http_address.'peticiones/index/'.$this->petition_number++;
			}else if($this->location == 'resultados_nacionales'){
				$url = $this->config->http_address.$this->location."/".$this->get('action')."/".$this->get('id');
				$title = "Resultados de ".$this->capitalize($this->entidad->nombre);
			}else if($this->location == 'escuelas' && $this->get('action')=='index'){
				$url = $url."/index/".$this->get('id');
				$title = "El perfil de ".$this->capitalize($this->escuela->nombre);
				$description = $title;
			}else if($this->location == 'compara' && $this->get('action') == 'escuelas' && $this->get('id')){
				$title = "compara: ";
			  	for($i=0;$i<count($this->escuelas)-1;$i++){
			  		$title = $title.$this->capitalize($this->escuelas[$i]->nombre).', ';
				}
				$title = $title.$this->capitalize($this->escuelas[$i]->nombre);
				$url = $url."/escuelas/".$this->get('id');

			}
			
			/*$urlFb = $this->shorten_url($url."#facebook");
			$urlTwitter = $this->shorten_url($url."#twitter");
			$urlMail = $this->shorten_url($url."#mail");
			*/
			$urlFb = $url."#facebook";
			$urlTwitter = $url."#twitter";
			$urlMail = $url."#mail";

			?>
			<span class="hidden sharing share-face"><?=$urlFb?></span>
			<span class="hidden sharing share-twitter"><?=$urlTwitter?></span>
			<span class="hidden sharing share-mail"><?=str_replace('#','%23',$urlMail)?></span>
			<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?=$urlFb?>&p[images][0]=<?=$url_logo?>&p[title]=<?=$title?>&p[summary]=<?=$description?>" class='share-face' target='_blank' >
				  </a>

				<div class="tweet">
				<a class='share-twitter' href="http://twitter.com/home?status=<?=$title." ".$urlTwitter," por @mejoratuescuela"?> " target='_blank' >
				  <span class="twitter-icon"></span>
				</a>
				</div>
			<a class='share-mail' href="mailto:?subject=<?=$title?>&amp;body=<?=$description.": ".$urlMail?>" target='_blank' ></a>

		</div>
	</div>
	<a href="#" class="button-frame">
		<span class="bt-share button-efect orange-effect">
			<?php $this->print_img_tag('compartir/compartir.png');?>
			Compartir
		</span>
	</a>

</div>
