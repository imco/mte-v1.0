<?php
require_once("test.default.php");

class escuelasTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new escuelas($this->config);
	}
	
	public function testAll_grados(){
		$fields = array('grados','promedio_matematicas','promedio_espaniol','promedio_general','total_evaluados');
		$fieldsTxt = "tipo,cct,".implode(",",$fields)."\n";
		//echo $fieldsTxt;
		$nivel = new nivel();
		$nivel->search_clause = 1;
		$niveles = $nivel->read('id');
		foreach($niveles as $n){
			$this->escuela_grados($n->id,$fields);
		
		}
	}
	
	private function escuela_grados($nivel,$fields){
		$escuela = new escuela();
		$escuela->search_clause = "nivel = $nivel";
		$escuela = $escuela->read('cct,grados,promedio_matematicas,promedio_espaniol,promedio_general,total_evaluados');
		foreach($escuela as $e){
			if($e->cct != "NA"){
				$enlace =  new enlace();	
				$enlace->search_clause = 'cct="'.$e->cct.'" AND anio = "2013"';
				$enlaces = $enlace->read('id,anio,nivel,grado,turnos,puntaje_espaniol,puntaje_matematicas,puntaje_geografia,alumnos_que_contestaron_total');
				$values = array();
				foreach($fields as $key){
					$values[] = $e->$key;
				}
				if(count($enlaces)){
					$grados = $sum_spa = $sum_mat = $sum_geo = 0;
					$alumnos_total = 0;
					foreach($enlaces as $enlace){
						if($enlace->alumnos_que_contestaron_total != 0 && ($enlace->puntaje_espaniol != 0 && $enlace->puntaje_matematicas != 0)){
							$grados++;
							$sum_spa += $enlace->puntaje_espaniol;
							$sum_mat += $enlace->puntaje_matematicas;
							$alumnos_total += $enlace->alumnos_que_contestaron_total;
						}
					}
					$prom_mat = $sum_mat / $grados;
					$prom_spa = $sum_spa / $grados;
					$gen = ($prom_spa * .2) + ($prom_mat *.8);
					$expected = array($grados,$prom_mat,$prom_spa,$gen,$alumnos_total);
				}else{
					$expected = array(0,0,0,0,0);
					continue;
				}
				//$dataNow = "actual,".$e->cct;
				//$dataNew = "nuevo,".$e->cct;
				if($e->grados != $expected[0]){
					/*
					foreach($values as $i=>$value){
						$dataNow.=",".$value;
						$dataNew.=",".$expected[$i];

					}
					echo $dataNow."\n";
					echo $dataNew."\n";
					*/
					$this->AssertEquals($values,$expected);
				}

			
			}
		}

	}

}

//$tmp = new escuelasTest();
//$tmp->setUp();
//$tmp->all_grados();

?>
