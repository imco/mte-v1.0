<div class='container califica'>
	<h2>Califica tu escuela seleccionando para cada campo una calificación del 1-10.
	<br />
	Estas calificaciones se promedian para generar la calificacion general de tu escuela.
	</h2>

	<div class='calificacion'>
		<h2>Preparación de los maestros</h2>
		<p>¿Qué tan preparados y capacitados están los maestros 
		<br />
		de tu escuela?
		</p>
		<div class='wrap_cal'>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
			<span>5</span>
			<span>6</span>
			<span>7</span>
			<span>8</span>
			<span>9</span>
			<span>10</span>
		</div>

		<div class='clear'></div>
	</div>
	<div class='calificacion'>
		<h2>Asistencia de los maestros</h2>
		<p>¿Los maestros faltan a clases constantemente o siem- 
		<br />
		pre están en el aula?
		</p>
		<div class='wrap_cal'>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
			<span>5</span>
			<span>6</span>
			<span>7</span>
			<span>8</span>
			<span>9</span>
			<span>10</span>
		</div>

	</div>

	<div class='calificacion'>
		<h2>Relación con padres de familia</h2>
		<p>¿Cómo es la relación de los maestros y director con los 
		<br />
		padres de familia?
		</p>
		<div class='wrap_cal'>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
			<span>5</span>
			<span>6</span>
			<span>7</span>
			<span>8</span>
			<span>9</span>
			<span>10</span>
		</div>

	</div>
	<div class='calificacion'>
		<h2>Infraestructura de la escuela</h2>
		<p>¿La escuela cuenta con las instalaciones necesarias
		<br />
		para dar clases?
		</p>
		<div class='wrap_cal'>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
			<span>5</span>
			<span>6</span>
			<span>7</span>
			<span>8</span>
			<span>9</span>
			<span>10</span>
		</div>

	</div>

	<div class='calificacion'>
		<h2>Participación de padres de familia</h2>
		<p>¿Los padres de familia participan de manera activa y
		<br />
		organizada en la escuela?
		</p>
		<div class='wrap_cal'>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
			<span>5</span>
			<span>6</span>
			<span>7</span>
			<span>8</span>
			<span>9</span>
			<span>10</span>
		</div>
	</div>
	<div class='calificacion'>
		<h2>Honestidad y transparencia</h2>
		<p>¿Las evaluaciones y exámenes se administran de
		<br />
		manera honesta y transparente?
		</p>
		<div class='wrap_cal'>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>4</span>
			<span>5</span>
			<span>6</span>
			<span>7</span>
			<span>8</span>
			<span>9</span>
			<span>10</span>
		</div>

	</div>
	<div class='clear'></div>
	<p class='promedio'>
		En promedio, calificas a tu escuela con:
		<br />
		<span></span>
	</p>

	<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='calificacion-form B container'>
		<fieldset>
			<p>Deja aquí un comentario sobre esta escuela</p>
			<input type='text' placeholder='Nombre' name='nombre' class='required' />
			<input type='text' class='required email' placeholder='Correo electrónico (obligatorio)' name='email' />
			<select class='custom-select' name='ocupacion' >
				<option value=''>¿Quién eres?</option>
				<option value='alumno'>Alumno</option>
				<option value='exalumno'>Exalumno</option>
				<option value='padredefamilia'>Padre de familia</option>
				<option value='maestro'>Maestro</option>
				<option value='director'>Director</option>
				<option value='ciudadano'>Ciudadano</option>
			</select>
			<textarea placeholder='Escribe aquí' name='comentario' class='required'></textarea>
			<p>Aviso de privacidad.
				<span>
				En ningún momento haremos público tu correo electrónico con tu reporte o comentario
				</span>
			</p>
			<input type="hidden" id="rank-value" name="calificacion" value="" class="required">
			<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' class='required' />
			<p class='button-frame' >
				<input type='submit' value='Enviar calificación y comentario' class='button button-efect blue' />
			</p>
		</fieldset>		
	</form>



	<div class='clear'></div>
</div>
