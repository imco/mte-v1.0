<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<?php
		$css_scripts = array(
			"reset.css",
			"main.css"
		);
		
		$js_scripts = array(
			"jquery.js",
			"interactions.js"
		);
		
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-zavia-erp");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-zavia-erp");
		$cssmin->tag('css');
		$jsmin->tag('js');
	?>
 </head>
 <body>
 <div id='header'></div>
 <div id='content'>
	 <form action='/search' method='post' accept-charset='utf-8' class='home-form'>
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
					<input name='nombre' type='text' placeholder='Nombre' />
				</td>
	 		</tr>
		</table>
		<input type='submit' value='Buscar'/>
	 </form>
</div>
 </body>
 </html>