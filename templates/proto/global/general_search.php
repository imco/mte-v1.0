<form action='/busqueda' method='get' accept-charset='utf-8' class='home-form container' id='general-search'>
 	<table>
 		<tr>
 			<td>
 				<select name='nivel' id='nivel-input'>
			 		<option value=''>Nivel de Escolaridad</option>
					<?php 
					foreach($this->niveles as $nivel){
						$selected = $this->request('nivel') == $nivel->id && $this->request('nivel') != '' ? "selected='selected'" : '';
						echo "<option $selected value='{$nivel->id}'>".$this->capitalize($nivel->nombre)."</option>"; 
					}
					?>
			 	</select>
 			</td>
			<td>
				<select name='entidad' id='state-input'>
			 		<option value=''>Estado</option>
					<?php 
					foreach($this->entidades as $entidad){
						$selected = $this->request('entidad') == $entidad->id ? "selected='selected'" : '';
						echo "<option $selected value='{$entidad->id}'>".$this->capitalize($entidad->nombre)."</option>";

					} 
					?>
			 	</select>

			</td>
 		</tr>
 		<tr>
 			<td>
 				<select name='municipio' id='municipio-input'>
			 		<option value=''>Municipio</option>
					<?php 
					foreach($this->municipios as $municipio){
						$selected = $this->request('municipio') == $municipio->id ? "selected='selected'" : '';
						echo "<option $selected value='{$municipio->id}'>".$this->capitalize($municipio->nombre).", ".$this->capitalize($municipio->entidad->nombre)."</option>";
					} 
					?>
			 	</select>
 			</td>
			<td>					
				<?php $disabled = !$this->localidades ? "disabled='disabled'" : ''; ?>
 				<select name='localidad' id='localidad-input' <?=$disabled?>>
			 		<option value=''>Localidad</option>
			 		<?php
			 		if($this->localidades){
			 			foreach($this->localidades as $localidad){
							$selected = $this->request('localidad') == $localidad->id ? "selected='selected'" : '';
							echo "<option $selected value='{$localidad->id}'>".$this->capitalize($localidad->nombre)."</option>";
						} 
			 		}
			 		?>
			 	</select>
			</td>
 		</tr>
 		<tr>
 			<td>
 			</td>
			<td>
				<input name='term' id='name-input' type='text' placeholder='Nombre' value='<?=$this->request('term');?>' />
			</td>
 		</tr>
	</table>
	<p class='submits'>
		<input type='submit' value='Buscar'/>
		<input type='submit' value='Mapa' id='map-button' class='on'/>

	</p>
 </form>