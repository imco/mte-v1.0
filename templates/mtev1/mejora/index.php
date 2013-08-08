<div class='container mejora'>
	<?php $column = array('left','center','right');
	for($i = 0;$i<3;$i++){ ?>
	<div class='column <?=$column[$i]?>'>
	
	<?php for($j=0;$j<3;$j++){ ?>
		<div class='mejorar'>
			<h1>
				<?php $this->print_img_tag('header/mejora.png') ?>
				mejora 
				<br />
				<span>
					tu escuela
				</span>
			</h1>
			<h2>¿Cómo participar en un consejo escolar?</h2>
			<hr />
			<?php if(($i==0 && $j==1) || ($i==1 && $j==0) || $i==2 && $j==2) {
				echo '<p>proin gravida nibh vel velit auctor alquet. Aenan sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagtttut- tis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. proin gravida nibh vel velit auctor alquet. Aenan sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagtttut- tis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.';
			} else 
			echo '<p>proin gravida nibh vel velit auctor alquet. Aenan sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagtttut- tis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.</p>';
			?>
			<a href=''>Descargar+</a>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<div class='clear'></div>
</div>
