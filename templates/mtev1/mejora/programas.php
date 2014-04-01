<div class='container mejora programs'>

	<a class="tools" href="/mejora">
		<span class="icon"></span>
		Herramientas de mejora
	</a>
	<a class="support select" href="#">
		<span class="icon"></span>
		Programas de apoyo
	</a>

	<div class="column">
		<div class="program">
			<p>Programas federales</p>
			<ul>
		                <?php 
				$temas = array();
		                foreach($this->programas_federales as $programa){
					echo "<li>";
					$this->print_img_tag("programas/{$programa->id}.jpg");
					echo "<a href='/programas/index/{$programa->id}'>{$programa->nombre}</a></li>";
					$temas[$programa->id] = $programa->tema_especifico;
		                }
		                ?>
			</ul>	
		</div>
		<div class="program">
			<p>Programas de organizaciones de la sociedad civil</p>
			<ul>
				<?php 
				foreach($this->programas_osc as $programa){
					$datoExtra = "";
					if($programa->id==5)
						$datoExtra = " (datos del 2012)";
					echo "<li>";
					$this->print_img_tag("programas/{$programa->id}.jpg");
					echo "<a href='/programas/index/{$programa->id}'>{$programa->nombre}{$datoExtra}</a></li>";
					$temas[$programa->id] = $programa->tema_especifico;
				}
                ?>
			</ul>	
		</div>

	</div>
	<div class="column">
		<div class="subject list">
			<p>Tema de enfoque</p>
			<ul>
				<?php foreach($temas as $id => $name) 
					echo "<li><a href='/programas/index/{$id}'>{$name}</a></li>";
				
				?>

			</ul>
			<?php 
			?>
		</div>	

		<div class="subject">
			<p>Nivel escolar</p>
			<ul>
			<?php
				$estado = $this->get('estado')? $this->get('estado'):false;
				$n = $this->get('nivel')?$this->get('nivel'):false;
				$nivel = array('primaria','secundaria','bachillerato');
				foreach($nivel as $name){
					$on = $n == $name?'on':'';
					echo "<li class='$on'>
						<a href='/mejora/programas/?estado=$estado&nivel=$name'>{$this->capitalize($name)}</a>
					</li>";
				}
				echo "<span class='hidden nivelE'>$n</span>"
			?>

			</ul>
		</div>

		<div class="subject">
			<p>Zonas de impacto</p>
			<select id="" name="" class='custom-select'>

				<option value='0'> Estado</option>
				<?php 
				foreach($this->entidades as $entidad){
					
					$selected = $estado == $entidad->id ? "selected='selected'" : '';
					echo "<option $selected value='{$entidad->id}'>".$this->capitalize($entidad->nombre)."</option>";
				} 
				?>
			</select>

		</div>
	</div>
	<div class="clear"></div>
</div>
