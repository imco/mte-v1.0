<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>

 </head>
 <body>
 <form action='/search' method='post' accept-charset='utf-8'>
 	<table>
 		<tr>
 			<td>
 				<select name=''>
			 		<option value=''>Nivel de Escolaridad</option>
					<?php foreach($this->niveles as $nivel) echo "<option value='{$nivel->id}'>{$nivel->nombre}</option>"; ?>
			 	</select>
 			</td>
			<td>
				<select name=''>
			 		<option value=''>Estado</option>
					<?php foreach($this->entidades as $entidad) echo "<option value='{$entidad->id}'>{$entidad->nombre}</option>"; ?>
			 	</select>

			</td>
 		</tr>
 		<tr>
 			<td>
 				<select name=''>
			 		<option value=''>Municipio</option>
					<?php foreach($this->municipios as $municipio) echo "<option value='{$municipio->id}'>{$municipio->nombre}</option>"; ?>
			 	</select>
 			</td>

 		</tr>
 	
	</table>

 </form>

 </body>
 </html>