<table class='general'>
	<tr>
		<th class='checkbox compara_table'></th>
		<th class='school'>Escuelas comparadas</th>
		<th>Nivel Escolar</th>
		<th class='rank'>Posición Estatal</th>
		<th class='rank'>Posición Nacional</th>
		<th>Privada | Pública</th>
		<th class='calificacion'>Calificación ENLACE de español</th>
		<th class='calificacion'>Calificación ENLACE de matemáticas</th>			
		<th class='semaforos'>Semáforo educativo <span class='infor I'>i</span></th>
	</tr>
	<?php 
	if($this->escuelas!=null)
	foreach($this->escuelas as $escuela){
		$escuela->get_semaforo();
		$slug = $this->current_rank->slug;
		$slugTotal = $this->current_rank->name=="Nacional"?"nacional_cct_count":"entidad_cct_count";
		$matematicas = $escuela->promedio_matematicas >= 0 && $escuela->semaforo <= 3 ? round($escuela->promedio_matematicas) : '';
		$espaniol = $escuela->promedio_espaniol >= 0 && $escuela->semaforo <= 3 ? round($escuela->promedio_espaniol) : '';
		$r_entidad_text = $escuela->rank_entidad != '' ? "de {$escuela->entidad_cct_count}" : '';
		$r_nacional_text = $escuela->rank_nacional != '' ? "de {$escuela->nacional_cct_count}" : '';
		echo "<tr class='on'>";
		echo "<td class='checkbox compara_table'><a class='compara-escuela' href='{$escuela->cct}'></a>
			<div class='icon'>
			<span class='icon-popup'>Dejar de comparar</span>
			</div>
		</td>";
		echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
		echo "<td>".$this->capitalize($escuela->nivel->nombre)."</td>";
		echo "<td class='rank'>".$escuela->rank_entidad."<br />	
					$r_entidad_text
		</td>";
		echo "<td class='rank'>".$escuela->rank_nacional."<br />	
					$r_nacional_text
		</td>";
		echo "<td>".$this->capitalize($escuela->control->nombre)."</td>";
		echo "<td class='rank'><span>".round($espaniol)."</span></td>";
		echo "<td class='rank'><span>".round($matematicas)."</span></td>";
		echo "<td class='semaforo sem{$escuela->semaforo}'><span></span>
				<div class='icon'><span class='icon-popup'>
						<p class='infor I'>i</p>
						<p class='title_semaforo'>
							".$this->config->semaforos[$escuela->semaforo]."
						</p>
						"/*
						descripcion del semáforo
						*/."
				</span></div>
		</td>";
		echo "</tr>";
	}
	?>
</table>
<?php	if($this->location == 'compara' && $this->get('action') == 'escuelas' && $this->get('id'))
		$this->include_template('share_buttons','global');
	
