<div class='container califica'>
	<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
	<h1>Estás calificando la escuela: <?=$this->capitalize($this->escuela->nombre)?> | <?=$this->capitalize($this->escuela->entidad->nombre)?> | <?=$this->capitalize($this->escuela->nivel->nombre)?> | <?=$this->capitalize($this->escuela->turno->nombre)?> | <?=$controles[$this->escuela->control->id]?></h1>
	<h2>Califica tu escuela seleccionando para cada campo una calificación del 1-10.
	<br />
	Estas calificaciones se promedian para generar la calificación general de tu escuela.
	</h2>

    <?php
        if ($this->preguntas) {
            foreach($this->preguntas as $pregunta) {
                echo "<div class='calificacion'>
                    <input type='hidden' class='pregunta' value='{$pregunta->id}' />
                    <h2>{$pregunta->titulo}</h2>
                    <p>{$pregunta->pregunta}</p>
                    <p>
                        1 = {$pregunta->descripcion_valor_minimo}
                        <br />
                        10 = {$pregunta->descripcion_valor_maximo}
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
                </div>";
            }
        }
    ?>

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
			<select class='custom-select required' name='ocupacion' >
				<option value=''>¿Quién eres?</option>
				<option value='alumno'>Alumno</option>
				<option value='exalumno'>Exalumno</option>
				<option value='padredefamilia'>Padre de familia</option>
				<option value='maestro'>Maestro</option>
				<option value='director'>Director</option>
				<option value='ciudadano'>Ciudadano</option>
			</select>
			<div class="other_info">			
				<textarea placeholder='Escribe aquí' name='comentario' class='required'></textarea>
				<p>Aviso de privacidad.
					<span>
					En ningún momento haremos público tu correo electrónico con tu reporte o comentario
					</span>
				</p>
				<input type="hidden" id="rank-value" name="calificacion" value="" class="required">
				<input type="hidden" id="rank-question" name="calificaciones" value="" class="required">
                <input type='hidden' id='rank-question-id' name="preguntas" value="">
				<input type='hidden' id='cct' name='cct' value='<?=$this->get('id')?>' class='required' />
				<?=$this->get_captcha();?>
				<p class='button-frame' >
					<input type='submit' value='Enviar calificación y comentario' class='button button-efect blue' />
				</p>
				<p class='accept'><input type="checkbox" name="accept" value="1" checked /><span>Quiero que mi nombre se publique junto con mi comentario.</span></p>
				<p class='advice'>
					Tu correo electrónico NUNCA aparecerá con tu comentario. <br>
					Si no quieres que tu comentario se publique en el perfil de la escuela, escríbenos  <br>
					a: contacto@mejoratuescuela.org
				</p>
			</div>
		</fieldset>		
	</form>



	<div class='clear'></div>
</div>
