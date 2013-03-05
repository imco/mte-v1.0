<?php
$nivel = $argv[1];
ini_set('auto_detect_line_endings',true);
$n = count($argv);
$files = 0;
for( $i=2; $i<$n; $i++){
	$files++;
	$file = $nivel.'-csv/'.$argv[$i];
	if (($handle = fopen($file, "r")) !== FALSE) {
		$row = 0;
		$flag = false;
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
			$espanol = ($data[10]+$data[13]+$data[16]+$data[19])/4;
			$matematicas = ($data[11]+$data[14]+$data[17]+$data[20])/4;
			$ciencias = ($data[12]+$data[15]+$data[18]+$data[21])/4;
			
			$tercer_eval = $data[75];
			$cuarto_eval = $data[76];
			$quinto_eval = $data[77];
			$sexto_eval = $data[78];
			$total_eval = $data[79];

			$espanol_insuf = ($data[22]/100)*$tercer_eval + ($data[26]/100)*$cuarto_eval + ($data[30]/100)*$quinto_eval + ($data[34]/100)*$sexto_eval;
			$espanol_elem = ($data[23]/100)*$tercer_eval + ($data[27]/100)*$cuarto_eval + ($data[31]/100)*$quinto_eval + ($data[35]/100)*$sexto_eval;
			$espanol_bueno = ($data[24]/100)*$tercer_eval + ($data[28]/100)*$cuarto_eval + ($data[32]/100)*$quinto_eval + ($data[36]/100)*$sexto_eval;
			$espanol_excel = ($data[25]/100)*$tercer_eval + ($data[29]/100)*$cuarto_eval + ($data[33]/100)*$quinto_eval + ($data[37]/100)*$sexto_eval;

			$matematicas_insuf = ($data[38]/100)*$tercer_eval + ($data[42]/100)*$cuarto_eval + ($data[46]/100)*$quinto_eval + ($data[50]/100)*$sexto_eval;
			$matematicas_elem = ($data[39]/100)*$tercer_eval + ($data[43]/100)*$cuarto_eval + ($data[47]/100)*$quinto_eval + ($data[51]/100)*$sexto_eval;
			$matematicas_bueno = ($data[40]/100)*$tercer_eval + ($data[44]/100)*$cuarto_eval + ($data[48]/100)*$quinto_eval + ($data[52]/100)*$sexto_eval;
			$matematicas_excel = ($data[41]/100)*$tercer_eval + ($data[45]/100)*$cuarto_eval + ($data[49]/100)*$quinto_eval + ($data[53]/100)*$sexto_eval;
			
			$ciencia_insuf = ($data[54]/100)*$tercer_eval + ($data[58]/100)*$cuarto_eval + ($data[62]/100)*$quinto_eval + ($data[66]/100)*$sexto_eval;
			$ciencia_elem = ($data[55]/100)*$tercer_eval + ($data[59]/100)*$cuarto_eval + ($data[63]/100)*$quinto_eval + ($data[67]/100)*$sexto_eval;
			$ciencia_bueno = ($data[56]/100)*$tercer_eval + ($data[60]/100)*$cuarto_eval + ($data[64]/100)*$quinto_eval + ($data[68]/100)*$sexto_eval;
			$ciencia_excel = ($data[57]/100)*$tercer_eval + ($data[61]/100)*$cuarto_eval + ($data[65]/100)*$quinto_eval + ($data[69]/100)*$sexto_eval;
			
			$total_calculado = ( number_format($matematicas_insuf,0)+number_format($matematicas_elem,0)+number_format($matematicas_bueno,0)+number_format($matematicas_excel,0));
			if( abs($total_calculado -$total_eval) >2 && !$flag ){
//			   	echo "archivo: $file\n";
			   	$debug[$file][] = "$row {$data[2]} -> calculado $total_calculado vs. oficial $total_eval";
//			   	$flag = true;
			}
			if($data[3]=='MATUTINO')
				$data[2] = $data[2].'1';
			elseif($data[3]=='VESPERTINO')
				$data[2] = $data[2].'2';
			elseif($data[3]=='NOCTURNO')
				$data[2] = $data[2].'3';
			/*else{
				echo "turno: {$data[3]}\n";
			}*/
			$query = "INSERT INTO enlaces_escuela VALUES(
				'{$data[2]}',
				'2012,
				'$nivel',
				$espanol,
				$matematicas,
				$espanol_insuf,
				$espanol_elem,
				$espanol_bueno,
				$espanol_excel,
				$matematicas_insuf,
				$matematicas_elem
				$matematicas_bueno,
				$matematicas_excel,
				$total_calculado,
				$ciencias,
				$ciencia_insuf,
				$ciencia_elem,
				$ciencia_bueno,
				$ciencia_excel
			)";
			echo "$query\n";
			$row++;
		}
	}/*else
		echo 'salio';*/
}
//var_dump($debug);
?>
