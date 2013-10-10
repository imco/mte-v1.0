<?php
class comments extends main{
	public function index(){
		#$this->search('/test/i');
		$this->search('/(http|https|ftp|www)/i');
	}

	public function search($patron){
		$calificacion = new calificacion();
		$calificacion->search_clause .= ' 1 ';
		$calificaciones = $calificacion->read('id,cct,comentario');
		#var_dump($calificaciones);
		$total = 0;
		for($i=0;$i<count($calificaciones);$i++){
			#$comentario = $calificacion->comentario;
			$ca = $calificaciones[$i];
			#var_dump($ca->id);
			#continue;
			if(preg_match($patron,$ca->comentario)){
				echo "id: ".$ca->id." CCT: ".$ca->cct->cct."<br />",
				$ca->comentario." <br /><br />";
				$total++;
			}
				
		}
		echo "Total: {$total}";
	}
}
?>
