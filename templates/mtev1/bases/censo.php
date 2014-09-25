<div class="container bases" ng-controller='fileController'>
	<img src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/banner.jpg" alt="Bases de datos censo" style='margin-bottom:-2px' />
	<div class='container quienes_somos'><div class='wrap_text'>
	<p>El 31 de marzo la SEP anunció los resultados definitivos del Censo Educativo y el portal en el que la ciudadanía podría consultar estos resultados. Sin embargo el IMCO ha precisado que sólo podía conocerse el 16% de los datos que se recabaron a nivel escuela. Con el objetivo de obtener la totalidad de los datos, realizamos una solicitud de información a la SEP y al INEGI, a través del IFAI, para que los pusieran a disposición de la ciudadanía.  </p>
	<p>A diferencia de la SEP, el INEGI respondió a nuestra solicitud de manera favorable mediante el oficio 201/30/2014. Hoy el IMCO, con la información proporcionada por el INEGI, da a conocer el 77% de los datos del Censo. </p>

	<p>Aquí puedes descargar:</p>
	<ol>
	<li><a href="http://storage.googleapis.com/cemabe/TR_INMUEBLES.DBF.zip">Archivo Inmueble</a>: Datos sobre características del inmueble de todas las escuelas excepto CONAFE.</li>
	<li><a href="http://storage.googleapis.com/cemabe/TR_CENTROS.DBF.zip">Archivo Centros de Trabajo</a>: Datos sobre características de los centros de trabajo (escuelas) excepto CONAFE. </li>
	<li><a href="http://storage.googleapis.com/cemabe/TR_CONAFE.DBF.zip">Archivo CONAFE</a>: Datos sobre características del inmueble y centros de trabajo de esta modalidad.</li>
	</ol>
	</div></div>

	<img src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/banerdescarga.jpg" alt="pasos" />
	<form class='file-search-form' method='get' action='#'   >
			<label>Bases de datos del censo por estado</label>
			<input type='text' name='state' ng-model='searchText' placeholder='Buscar estado' />
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
		<tbody ng-cloak ng-repeat='entidad in entidades | filter:searchText' >
			<tr class='space'><td></td><td></td><td></td><td></td><td></td></tr>
			<tr  class='state'>
				<td>
					<img ng-src='/templates/mtev1/img/bases/estados/{{entidad.entidad}}.png' alt='{{entidad.nombre}}' />
					<p class='title1' ng-bind='entidad.nombre'></p>
				</td>
				<td>
					<select ng-options='opt for opt in options' ng-model='entidad.census' ></select>
				</td>
				<td>
					<p class='options'>
						<span class='checkbox pull-left' ng-click='entidad.format = "win"' ng-class='entidad.format == "win" ? "selected":""'></span>
						Windows
					</p>
					<div class='clear'></div>
					<p class='options'>
						<span class='checkbox pull-left' ng-click='entidad.format = "utf"' ng-class='entidad.format == "utf" ? "selected":""'></span>
						UTF8
					</p>
					<div class='clear'></div>
				</td>
				<td class='services'>
						<div class='service'>
							<div class='checkbox' ng-click='entidad.service = "g"' ng-class='entidad.service == "g" ? "selected":""'></div>
							<div class='icon google'></div>
							<p>Google</p>
						</div>
						<div class='service'>
							<div class='checkbox' ng-click='entidad.service = "r"' ng-class='entidad.service == "r" ? "selected":""'></div>
							<div class='icon rackspace'></div>
							<p>Rackspace</p>
						</div>
						<div class='service'>
							<div class='checkbox' ng-click='entidad.service = "a"' ng-class='entidad.service == "a" ? "selected":""'></div>
							<div class='icon amazon'></div>
							<p>Amazon</p>
						</div>
				</td>
				<td class='download'>
					<p><a ng-href='{{getLink(entidad)}}'></a></p>
				</td>
			</tr>
		</tbody>

	</table>

</div>
