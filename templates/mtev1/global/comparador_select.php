<div class="comparador_select ">
	<span class="icon fs"></span>
	<p class='Nselected'>Escuelas seleccionadas para comparar (<span><?=count($this->school_to_compare) ?></span>)</p>
	<div class="open_wrap">
		<div class="selected">
			<ul>
				<?php foreach($this->school_to_compare as $school) {
					echo "<li><span class='icon'></span>$school->nombre
						<span class='hidden'>$school->cct</span></li>";
				}?>

			</ul>
			<a class="button-frame" href="" id="compara-main-button">
				<span class="bt-share">Comparar</span>
			</a>
		</div>
		<div class="visited">
			<p class='Nvisited'>Escuelas visitadas (<span><?=count($this->school_view)?></span>)</p>
			<ul>
				<?php foreach($this->school_view as $school) {
					echo "<li><span class='icon'></span>$school->nombre
					<span class='hidden'>$school->cct</span></li>";
				}?>
			</ul>
			<?php $this->print_img_tag('select/flechita_carrar.png') ?>
		</div>
	</div>

</div>

