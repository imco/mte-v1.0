<div class='container ayuda'>
	<div class='ayuda'>
		<h2>Metodología</h2>
		<hr/>
		<h2>Nota metodológica para educación básica</h2>
		<!--
		<ol>
			<li><a href='#pregunta1'>¿Dónde obtiene su información Mejora tu escuela?</a></li>
			<li><a href='#pregunta2'>¿Cómo calculamos las calificaciones de matemáticas y español de una escuela?</a></li>
			<li><a href='#pregunta3'>¿Cómo se define el nivel de una escuela en el semáforo de calidad educativa?</a></li>
		</ol>
		 -->
		<div class="text-ayuda">
			<div class="section-one">
				<a name='pregunta1'></a>
				<h3>Las calificaciones globales por centro escolar (CCT) se calcularon de la siguiente manera:</h3>
				<p><span class="space"></span>En las bases de datos con resultados desglosados a nivel alumno, en primer lugar agrupamos los resultados por materia, matemáticas y español. Para cada uno de los dos dominios hicimos promedios por grado escolar. Posteriormente, agrupamos los promedios de cada materia por nivel escolar, es decir, para primaria, agrupamos tercero, cuarto, quinto y sexto. Para secundaria, primero, segundo y tercero.  Así  obtuvimos el promedio por materia por cada centro escolar.</p>
				<p><span class="space"></span>Los promedios de matemáticas y de español por cada centro escolar están ponderados con pesos 80-20. A matemáticas le asignamos un peso mucho mayor porque la distribución de calificaciones de matemáticas tienen una varianza mucho menor y una distribución de probabilidad diferente a las calificaciones de español. Esto nos lleva a pensar que los resultados de las dos materias surgen de procesos cognitivos distintos; es decir, el buen dominio de la lengua española se aprende en casa y el buen dominio de las matemáticas se aprende en la escuela.  </p>
				<p><span class="space"></span>Para cada escuela, se calcula una calificación global promediando las cifras ponderadas de español y matemáticas. Esto resulta en una lista de todos los centros escolares (identificados por su código CCT) con su calificación global correspondiente. Las posiciones estatales y nacionales están basadas en esta lista.</p>
				<h3>Los cortes para los cuatro distintos niveles de calidad educativa (“excelente”, “bien”, “de panzazo”, “reprobados”) se calcularon de la siguiente manera:</h3>
				<p> <span class="space"></span>       	Primero, de la gráfica de distribución eliminamos las escuelas en las que alguno de los grados escolares no tomó la prueba con el fin de asegurar que la distribución no estuviera sesgada hacia abajo.   Así definimos los cortes.
				</p>
				<p>El 50% de las escuelas con las calificaciones más bajas en la distribución teórica corresponden al nivel “reprobado”. El siguiente 20% de las escuelas se clasifican en el nivel “de panzazo”, el siguiente 20% entran al nivel “bien” y finalmente, el mejor 10% de las escuelas están en el nivel “excelente”.
				</p>
				<p>
				Para el 2012, los cortes para
					<span class="subrayado">primaria</span>
					son:
					<br />
					664 < <span class="green">Excelente</span>
					<br />
					587 < <span class="amarillo">Bien</span> < 664
					<br />
					546 < 
					<span class="naranja">De panzazo</span>< 587
					<br />
					<span class="red">Reprobado </span> <546
					
				</p>
				<p>
				Para el 2012, los cortes para
					<span class="subrayado">secundaria</span>
					son:
					<br />
					622 < <span class="green">Excelente</span>
					<br />
					567 < <span class="amarillo">Bien</span> < 622
					<br />
					530 < 
					<span class="naranja">De panzazo</span>< 567
					<br />
					<span class="red">Reprobado </span> <530
				</p>
				<h3>Nota metodológica para educación media superior
				</h3>
				<p><span class="space"></span>A diferencia de las bases de datos para educación básica, en educación media superior (bachillerato) no se reportan las calificaciones exactas a nivel alumno. La base indica, simplemente, en qué rango de desempeño se ubicó el resultado del alumno.
				<br />
				Para poder generar calificaciones, asignamos una calificación intermedia para cada una de esas categorías similar a las calificaciones que vemos en primaria y secundaria para estar en cada uno de esos rangos. Asignamos entonces ese resultado intermedio a cada uno de los alumnos dependiendo de los rangos en los que se reporta que se ubicó su calificación.

				</p>
				<p><span class="space"></span>
				       Con estos resultados pudimos continuar con la metodología descrita para educación básica, en donde agrupamos por materia, por grado, y finalmente por centro escolar ponderando los resultados de matemáticas y español con un peso de 80-20. Las calificaciones globales se utilizaron para generar las posiciones estatales y nacionales.
				       <br />
<span class="space"></span>
				               	Al momento de graficar los resultados por centro escolar, la distribución para educación media superior fue muy similar a las distribuciones para primaria y secundaria, lo que facilitó que se siguiera la misma metodología en la asignación de cortes para los distintos niveles de calidad.
				</p>
				<p>
				Para el 2013, los cortes para
					<span class="subrayado">bachillerato</span>
					son:
					<br />
					632 < <span class="green">Excelente</span>
					<br />
					580 < <span class="amarillo">Bien</span> < 632
					<br />
					551 < 
					<span class="naranja">De panzazo</span>< 580
					<br />
					<span class="red">Reprobado </span> <551
				</p>
				<p>
				Las siguientes gráficas muestran las distribuciones teóricas para los distintos niveles educativos. Los cortes, y por lo tanto, niveles de calidad educativa se identifican por color (verde= excelente, amarillo= bien, naranja= de panzazo, rojo= reprobado)
				</p>
				<?php $this->print_img_tag('metodologia/Primaria2012Ultimo.png');
				$this->print_img_tag('metodologia/Secundaria2012Ultimo.png');
				$this->print_img_tag('metodologia/Bachillerato2013.png');
				?>
				<h3>Otras consideraciones y preguntas frecuentes acerca de la metodología:
				</h3>
				<p>1. ¿Por qué no utilizan los cortes que usa la SEP?
				<br />
				<span class="space"></span>
				Los cortes de la SEP están diseñados para categorizar alumnos, no escuelas. En otras palabras, que un alumno obtenga una calificación de 708 en una prueba, lo cual lo ubicaría en el nivel “excelente”, es mucho más fácil a que una escuela obtenga esa misma calificación como promedio de todos sus estudiantes. Por lo tanto, no sería correcto extrapolar los cortes para resultados individuales de alumnos a una base de promedios por escuela.

				</p>
				<p>
				2. ¿Cómo se incorporan los indicadores de resultados no confiables? 
				<br />
<span class="space"></span>
					En las bases de datos de educación básica, la SEP incluye un indicador que identifica pruebas de alumnos en donde hay evidencia de prácticas de copia. Estas pruebas las identifica como “no confiables”. A las escuelas en las que más  del 10% de los alumnos tienen resultados “no confiables”, MejoraTuEscuela.org les asigna un ícono de “no confiable” en lugar de su calificación correspondiente en el semáforo educativo. Nuestro mensaje en este sentido es que  una escuela en donde hay altos porcentajes de copia merece una clasificación mucho peor que una escuela honesta con desempeños malos. 

				</p>
			</div>	
		</div>
	</div>
	<div class='clear'></div>
</div>
