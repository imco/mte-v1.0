<form action='/search' method='post' accept-charset='utf-8' class='home-form container'>
 	<table>
 		<tr>
 			<td>
 				<select name=''>
			 		<option value=''>Nivel de Escolaridad</option>
					<?php foreach($this->niveles as $nivel) echo "<option value='{$nivel->id}'>".ucwords(strtolower($nivel->nombre))."</option>"; ?>
			 	</select>
 			</td>
			<td>
				<select name='' id='state-input'>
			 		<option value=''>Estado</option>
					<?php foreach($this->entidades as $entidad) echo "<option value='{$entidad->id}'>".ucwords(strtolower($entidad->nombre))."</option>"; ?>
			 	</select>

			</td>
 		</tr>
 		<tr>
 			<td>
 				<select name='' id='municipio-input'>
			 		<option value=''>Municipio</option>
					<?php foreach($this->municipios as $municipio) echo "<option value='{$municipio->id}'>".ucwords(strtolower($municipio->nombre)).", ".ucwords(strtolower($municipio->entidad->nombre))."</option>"; ?>
			 	</select>
 			</td>
			<td>					
 				<select name='' id='localidad-input' disabled='disabled'>
			 		<option value=''>Localidad</option>
			 	</select>
			</td>
 		</tr>
 		<tr>
 			<td>
 			</td>
			<td>
				<input name='nombre' id='name-input' type='text' placeholder='Nombre' />
			</td>
 		</tr>
	</table>
	<input type='submit' value='Buscar'/>
 </form>