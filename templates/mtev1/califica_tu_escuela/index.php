<div class='container califica_select'>
	<!--<div class="circle">
	</div>-->
	<h1>
	<?php $this->print_img_tag('header/califica.png')?>
	<?=$this->instruction?></h1>
	<h2><?=$this->instruction2 ?></h2>
</div>	
<?php if(!$this->compara_cookie || $this->get('term')) {?>
<div class='select_search_wrap'>
	<div class='califica_select_search'>
		<?php $this->include_template('simple_search','global'); ?>
	</div>
	<div class='decorations_out'>
		<hr />
		<hr />
	</div>	
</div>
<?php } ?>
<div class='container califica_select'>


	<?php if(isset($this->escuelas)){ ?>
	<div class="clear"></div>
	<div class="resultados">
		<!--<p>Resultado de la búsqueda</p>-->
		<table>
		<!--<tr>
			<th class='checkbox'></th>
			<th class='school'>Escuelas</th>
		</tr>
		-->
		<?php
		$turnos = array(100 => 'Matutino', 200 => 'Vespertino', 500 => 'Continuo (tiempo completo)', 400 => 'Discontinuo', 300 => 'Nocturno', 120 => 'Matutino y vespertino');
		foreach($this->escuelas as $escuela){
			$on = '';
			if($this->compara_cookie && in_array($escuela->cct,$this->compara_cookie)){
				$on = "class='on'";
				$escuela->nom_localidad = $escuela->localidad->nombre;
				$escuela->nom_entidad = $escuela->entidad->nombre;
				$turno = $this->capitalize($escuela->turno->nombre);
				
			}else{
				$turno = $turnos[$escuela->turno];
			}
			//$on = $this->compara_cookie && in_array($escuela->cct,$this->compara_cookie) ? "class='on'" : '';
			
			echo "
			<tr $on>
				<td class='checkbox'><a class='compara-escuela' href='{$escuela->cct}'></a></td>
				<td class='school'><a href='/escuelas/index/{$escuela->cct}'>".
					$this->capitalize($escuela->nombre)." | ".
					"<span>".$this->capitalize($escuela->nom_localidad).", ".$this->capitalize($escuela->nom_entidad)." | ".$turno."</span>".
				"</a></td>
				<td class='calificar'><a class='calificar-school' href='/califica-tu-escuela/califica/{$escuela->cct}'> <span class='icon'></span> Calificar </a></td>


			</tr>
			";
		}
	}	
	?>
		</table>
	</div>
	<div class='clear'></div>
</div>
<?php if($this->compara_cookie && !$this->get('term')) {?>

<h2 class='buscaOtra'>Si la escuela que quieres calificar no está aquí, búscala...</h2>
<div class='select_search_wrap'>
	<div class='califica_select_search'>
		<?php $this->include_template('simple_search','global'); ?>
	</div>
	<div class='decorations_out'>
		<hr />
		<hr />
	</div>	
</div>
<?php } ?>
