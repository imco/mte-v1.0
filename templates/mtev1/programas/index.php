<div class="container programas">
	<div class="column left">
		<?php $idImg = $this->get('id');
		$existsImg = file_exists($this->config->document_root."templates/mtev1/img/programas/{$idImg}.jpg");
		if($existsImg){ 
			echo "<div class='wrap_title'><div class='wr_img'>";
				$this->print_img_tag("programas/{$idImg}.jpg");
			echo "</div>";
		}?>

		<?php if($existsImg) echo '<div class="title_with_img">'; 
		$datoExtra = "";
		if($this->programa->id==5)
			$datoExtra = " (datos del 2012)";
		?>
		<h1 class="title"><?php echo $this->programa->nombre.$datoExtra; ?></h1>
		<div class="white-box">
			<!--<h3>Objetivo del programa</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic consectetur quam odio. Necessitatibus, voluptatibus optio facilis ullam quas amet quidem nobis pariatur maxime sit magni reiciendis inventore nemo. Corporis, fugit.</p>
			-->
			<p><span class="blue">Tema específico que atiende el programa</span> <?php echo $this->programa->tema_especifico; ?></p>
		</div>
		<?php if($existsImg) echo "</div><div class='clear'></div></div>"; ?>
		<h2 class="title">Descripción del programa</h2>
		<div class="white-box">
			<p><?php echo $this->programa->descripcion; ?></p>
		</div>


		<div class="info">
			<h2 class="title">¿Qué debe hacer una escuela que está interesada en participar en el proyecto?</h2>
			<div class="white-box">
				<p><?php echo $this->programa->requisitos; ?></p>
			</div>
			<h2 class="title">Página web del programa</h2>
			<div class="white-box">
				<a href="http://<?=$this->programa->sitio_web;?>" ><?php echo $this->programa->sitio_web; ?></a>
			</div>
			<h2 class="title">Contacto</h2>
			<div class="white-box">
				<p>
					<?php echo $this->programa->telefono; ?>
					|<?php echo $this->programa->telefono_contacto; ?>
					|<?php echo $this->programa->mail; ?>
				</p>
			</div>
		</div>

	<h2 class="title">Zonas de cobertura</h2>
        <div id="map-programas">
            <script src="http://d3js.org/d3.v3.min.js"></script>
            <script src="http://d3js.org/topojson.v0.min.js"></script>
            <script>

            var x = d3.scale.linear()
                .domain([0, width])
                .range([0, width]);

            var y = d3.scale.linear()
                .domain([0, height])
                .range([height, 0]);

            var width = 680,
                height = 500;

            var projection = d3.geo.mercator()
                .scale(1200)
                .center([-94.34034978813841, 24.012062015793]);

            var svg = d3.select(".container.programas .column.left #map-programas").append("svg")
                .attr("width", width)
                .attr("height", height);

            var g = svg.append("g");

            var path = d3.geo.path()
                .projection(projection);

            d3.json("/mx_tj.json", function(error, mx) {
              /*svg.selectAll("path")
                .data(topojson.object(mx, mx.objects.municipios2).geometries)
                .enter().append("path")
                .attr("d", d3.geo.path().projection(projection))
                .attr("fill", "transparent")
                .style("stroke", "#333")
                .style("stroke-width", ".2px")
                .attr("class", "muns");
                */

              g.selectAll("path")
                .data(topojson.object(mx, mx.objects.estados2).geometries)
                .enter().append("path")
                .attr("d", d3.geo.path().projection(projection))
                .attr("fill", "#C4EAD1")
                .style("stroke", "#40AA6C");

               g.selectAll("path")
                .data(topojson.object(mx, mx.objects.estados2).properties)
                //.enter().append("path")
                .attr("class",function(d) { return "e"+d.id; })
                .text(function(d) { return "e"+d.id; });



                /*svg.selectAll(".place-label")
                    .data(topojson.object(mx, mx.objects.estados2).properties)
                  .enter().append("text")
                    .attr("class", "place-label")
                    .attr("transform", function(d) { return "translate(" + d3.geo.path().projection(projection) + ")"; })
                    .attr("dy", ".35em")
                    .text(function(d) { return d.id; });

                svg.selectAll(".place-label")
                .attr("x", function(d) { return d.geometry.coordinates[0] > -1 ? 6 : -6; })
                .style("text-anchor", function(d) { return d.geometries.coordinates[0] > -1 ? "start" : "end"; });*/


            });
            </script>
            <div class="overlay-map">
            <?php
            //var_dump($this->programa->entidad_escuelas_count);
            foreach ($this->entidades as $key => $estado) {
                if(isset($this->programa->entidad_escuelas_count[$estado->id]) && $this->programa->entidad_escuelas_count[$estado->id] > 0){?>
                <div class='statemarker e<?=$estado->id?>'>
                    <div class="info">
                        <h4><?=$estado->nombre?></h4>
                        <p>Participa en (<?= $this->programa->entidad_escuelas_count[$estado->id]?>) Escuelas <br><a class='estado_escuela_link' href='<?= $this->config->http_address ?>programas/estado_escuelas?id=<?=$this->programa->id ?>&es=<?=$estado->id?>'>Ver lista de escuelas</a></p>

                    </div>
                    <img src='/templates/mtev1/img/COMPARADOR/pinmap.png'/>
                </div>
            <?php
                }
            }
            ?>
            </div>
            <div id='escuelas_estado_list'></div>
        </div>
    </div>
	<div class="column right">
		<h1>Otros programas</h1>
		<div class="lista-programas">
			<h2>Programas federales</h2>
			<ul>
                <?php 
                foreach($this->programas_federales as $programa){
                    $on = $programa->id == $this->programa->id ? 'class="on"' : '';
                    echo "<li $on><a href='/programas/index/{$programa->id}'>{$programa->nombre}</a></li>";
                }
                ?>
			</ul>			
		</div>

		<div class="lista-programas">
			<h2>Programas OSC´s</h2>
			<ul>
				<?php 
                foreach($this->programas_osc as $programa){
                    $on = $programa->id == $this->programa->id ? 'class="on"' : '';
		    $datoExtra = "";
		    if($programa->id==5)
		    	$datoExtra = " (datos del 2012)";
                    echo "<li $on><a href='/programas/index/{$programa->id}'>{$programa->nombre}{$datoExtra}</a></li>";
                }
                ?>
			</ul>			
		</div>

		<div class="share-blue">
			<a href="javascript:window.print()" class="option print"><span class="icon"></span>Imprimir</a>
			<a href="#" class="option share"><span class="icon"></span></span>Compartir</a>	
			<?php
			//if($this->location == 'escuelas' && $this->get('action')=='index')
				$this->include_template('share_buttons_simple','global');
			?>
		</div>
	</div>
	<div class="clear"></div>
</div>
