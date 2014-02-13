<?php
$imgsBanners = $this->get_banners();
if($imgsBanners){
?>

<div id='main-banner' class='banners_<?=$this->location?>'>
	<div class="wrap_banners">
	
	<?php $on = 'on';
	foreach($imgsBanners as $img => $url){
		echo "<div class='wrap_banner $on'>
			<a href='{$url}' ><img src='{$this->config->http_address}/templates/mtev1/img/banners/{$img}' alt='$img' />";
			$this->print_img_tag('banners/sombra_banner.png');
		echo "</a></div>";
		$on = '';
	} ?>
	</div>
</div>
<?php } ?>
