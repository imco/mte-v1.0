<table class='general'>
	<tr>
		<th class='checkbox compara_table'></th>
		<th class='school'>Escuelas comparadas</th>
		<th>Nivel Escolar</th>
        <th>Privada | Pública</th>
        <th class='turno'>Turno</th>
		<th class='rank'>Posición Estatal</th>
		<th class='rank'>Posición Nacional</th>
		<th class='calificacion'>Calificación ENLACE de español</th>
		<th class='calificacion'>Calificación ENLACE de matemáticas</th>			
		<th class='semaforos'>Semáforo educativo <span class='infor I'>i</span></th>
	</tr>
	<?php 
	if($this->escuelas!=null)
	foreach($this->escuelas as $escuela){
        $escuela->get_turnos();
		$escuela->get_semaforos();
		$controles = array(1=>'Pública', 2=>'Privada');
		//$slug = $this->current_rank->slug;
		//$slugTotal = $this->current_rank->name=="Nacional"?"nacional_cct_count":"entidad_cct_count";
        $count_semaforos = count($escuela->rank) ? count($escuela->rank) : 1;
		echo "<tr class='on'>";
		echo "<td class='checkbox compara_table' rowspan='{$count_semaforos}'><a class='compara-escuela' href='{$escuela->cct}'></a>
                <div class='icon'>
                <span class='icon-popup'>
                    <span class='triangle remove'></span>
                Dejar de comparar</span>
                </div>
            </td>";
		echo "<td class='school' rowspan='{$count_semaforos}' style='display:table-cell;'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
		echo "<td rowspan='{$count_semaforos}'>".$this->capitalize($escuela->nivel->nombre)."</td>";
        echo "<td rowspan='{$count_semaforos}'>".$controles[$escuela->control->id]."</td>";

        if (isset($escuela->rank) && count($escuela->rank)) {
            foreach($escuela->rank as $key=>$rank) {
                $matematicas = $rank->promedio_matematicas >= 0 && $rank->semaforo <= 3 ? round($rank->promedio_matematicas) : '';
                $espaniol = $rank->promedio_espaniol >= 0 && $rank->semaforo <= 3 ? round($rank->promedio_espaniol) : '';
                $r_entidad_text = $rank->rank_entidad != '' ? "de {$escuela->entidad_cct_count}" : '';
                $r_nacional_text = $rank->rank_nacional != '' ? "de {$escuela->nacional_cct_count}" : '';

                if ($key > 0) {
                    echo "<tr class='on'>";
                }

                echo "<td class='turno'>".$this->capitalize($rank->turno[0]->nombre)."</td>";//cambiar
                echo "<td class='rank'>".$rank->rank_entidad."<br />
                            $r_entidad_text
                </td>";
                echo "<td class='rank'>".$rank->rank_nacional."<br />
                            $r_nacional_text
                </td>";
                echo "<td class='rank'><span>".$espaniol."</span></td>";
                echo "<td class='rank'><span>".$matematicas."</span></td>";
                echo "<td class='semaforo sem{$rank->semaforo}'><span class='sprit2'></span>
                        <div class='icon'><span class='triangle'></span><span class='icon-popup'>
                                <p class='infor I'>i</p>
                                <p class='title_semaforo'>
                                    ".$this->config->semaforos[$rank->semaforo]."
                                </p>
                                "/*
                                descripcion del semáforo
                                */."
                        </span></div>
                </td>";
                if ($key > 0) {
                    echo "</tr>";
                }

            }
	    } else {
            echo "<td class='turno'>Matutino</td>";//cambiar
            echo "<td class='rank'>0<br /></td>";
            echo "<td class='rank'><br /></td>";
            echo "<td class='rank'><span>0</span></td>";
            echo "<td class='rank'><span>0</span></td>";
            echo "<td class='semaforo sem4'><span class='sprit2'></span>
                        <div class='icon'><span class='triangle'></span><span class='icon-popup'>
                                <p class='infor I'>i</p>
                                <p class='title_semaforo'>
                                   Esta escuela no tomó la prueba ENLACE
                                </p>
                        </span></div>
                </td>";
            echo "</tr>";
        }
    }
	?>
</table>
