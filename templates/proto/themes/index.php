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
 				<select>
			 		<option value=''>Nivel de Escolaridad</option>
					<?php foreach($this->niveles as $nivel) echo "<option value='{$nivel->id}'>{$nivel->nombre}</option>"; ?>
			 	</select>
 			</td>
			<td>
				<select>
			 		<option value=''>Estado</option>
					<?php foreach($this->niveles as $nivel) echo "<option value='{$nivel->id}'>{$nivel->nombre}</option>"; ?>
			 	</select>

			</td>
 		</tr>
 	
	</table>

 </form>

 </body>
 </html>