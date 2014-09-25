<div class="container bases">
	<img src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/banner.jpg" alt="Bases de datos censo" style='margin-bottom:-2px' />
	<img src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/banerdescarga.jpg" alt="pasos" />
	<form class='file-search-form' method='get' action='#'   >
			<label>Bases de datos del censo por estado</label>
			<input type='text' name='state' ng-model='state' placeholder='Buscar estado' />
			<input type='submit' value='' class='submit' />
			<div class='clear'></div>
	</form>
	
	<table class='file-table'>
		<thead>
			<tr>
				<th>Estado</th>
				<th>Archivos</th>
				<th>Codificación</th>
				<th>Elegir servicio de descarga</th>
				<th class='download'>Descargar</th>
			</tr>
		</thead>
		<tbody>
			<tr class='space'><td></td><td></td><td></td><td></td><td></td></tr>
			<tr class='state' >
				<td>
					<img src='/templates/mtev1/img/bases/estados/9.png' alt='yucatan' />
					<p class='title1'>Baja California Sur</p>
				</td>
				<td>
					<select >
						<option>CONAFE</option>
						<option>CONAFE</option>
						<option>CONAFE</option>
					</select>
				</td>
				<td>
					<p class='options'>
						<span class='checkbox pull-left'></span>
						Windows
					</p>
					<div class='clear'></div>
					<p class='options'>
						<span class='checkbox pull-left selected'></span>
						UTF8
					</p>
					<div class='clear'></div>
				</td>
				<td class='services'>
						<div class='service'>
							<div class='checkbox'></div>
							<div class='icon rackspace'></div>
							<p>Rackspace</p>
						</div>
						<div class='service'>
							<div class='checkbox'></div>
							<div class='icon amazon'></div>
							<p>Amazon</p>
						</div>
						<div class='service'>
							<div class='checkbox'></div>
							<div class='icon google'></div>
							<p>Google</p>
						</div>
				</td>
				<td class='download'>
					<p><a href='#'></a></p>
				</td>
			</tr>
		</tbody>

	</table>

</div>
