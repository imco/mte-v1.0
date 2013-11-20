<div class='container resultados-nacionales'>
	<form action='' class='search-estado'>
		<a href='/preguntas-frecuentes#pregunta2' class='como'>
		<?php $this->print_img_tag('resultados/i.png')?>
		¿Cómo calculamos estos resultados?
		</a>
		<select class='custom-select' name='estado' >
			<option value=''>Busca tu estado</option>
			<?php
			$this->load_entidades('nombre');
			foreach($this->entidades as $entidad){ 
				echo "<option value='{$entidad->id}'>".$this->capitalize($entidad->nombre)."</option>";
			}
			?>
				

		</select>
	
	</form>
	<div class="wrap_resultados">
		<h1 class='full-blue'>Resultados Nacionales Por Estado</h1>
		<?php
		$rank = 1;
		$this->load_entidades('rank ASC');
		foreach($this->entidades as $entidad){
			echo "<a href='/resultados-nacionales/entidad/{$entidad->id}' class='state-box'>";
			$this->print_img_tag('entidades/'.$entidad->id.'.jpg');
			echo "<span class='h2'>".$this->capitalize($entidad->nombre)."</span><span class='hover'>Ver Resultados</span><span class='rank'>".$rank++."º</a>";
		}
		?>
	</div>
	<div class='clear'></div>
</div>
