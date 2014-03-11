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

