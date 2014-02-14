<?php
class entidad extends memcached_table{
	function info(){
		$this->table_name = "entidades";
		$this->has_many['municipios'] = 'municipio';
		$this->has_many_keys['municipios'] = 'entidad';
		$this->has_many['localidades'] = 'localidad';
		$this->has_many_keys['localidades'] = 'entidad';
	}
}
class municipio extends table{
	function info(){
		$this->table_name = "municipios";
		$this->objects['entidad'] = 'entidad';
	}	

}
class localidad extends table{
	function info(){
		$this->table_name = "localidades";
		$this->has_many['escuelas'] = "escuela";
		$this->has_many_keys['escuelas'] = "localidad";
	}

}
class enlace extends table{
	function info(){
		$this->table_name = 'enlaces';
		$this->objects['escuelas'] = 'id_cct';
	}

}
class nivel extends table{
	function info(){
		$this->table_name = "niveles";
	}
}

class subnivel extends table{
	function info(){
		$this->table_name = "subniveles";
	}
}
class servicio extends table{
	function info(){
		$this->table_name = "servicios";
	}
}
class modalidad extends table{
	function info(){
		$this->table_name = "modalidades";
	}
}
class control extends table{
	function info(){
		$this->table_name = "controles";
	}
}
class subcontrol extends table{
	function info(){
		$this->table_name = "subcontroles";
	}
}
class sostenimiento extends table{
	function info(){
		$this->table_name = "sostenimientos";
	}
}
class status extends table{
	function info(){
		$this->table_name = "statuses";
	}
}
class turno extends table{
	function info(){
		$this->table_name = "turnos";
	}
}
class tipo extends table{
	function info(){
		$this->table_name = "tipos";
	}
}
class colonia extends table{
	function info(){
		$this->table_name = "colonias";
	}
}
class calificacion extends table{
	function info(){
		$this->table_name = 'calificaciones';
		#$this->objects['cct'] = 'escuela';

		$this->has_many['likes'] = 'calificacion_like';
		$this->has_many_keys['likes'] = 'calificacion';
        $this->has_many['calificaciones'] = 'calificacion_pregunta';
        $this->has_many_keys['preguntas'] = 'calificacion';
	}

    function setCalificaciones($preguntas,$calificaciones){
        $calicacion_list = json_decode($calificaciones);
        $preguntas_list = json_decode($preguntas);

        $sql = "insert into calificaciones_preguntas (pregunta,calificacion,calificacion_pregunta) values ";

        foreach ($calicacion_list as $key => $calificacion) {
            $pregunta = $preguntas_list[$key];
            $sql .= "({$pregunta},{$this->id},$calificacion),";
        }
        $sql = rtrim($sql,",");

        mysql_query($sql);
    }

}
class calificacion_like extends table{
	function info(){
		$this->table_name = 'calificacion_likes';
		$this->objects['calificacion'] = 'calificacion';

	}
}
class pregunta extends table {
    function info() {
        $this->table_name = 'preguntas';
    }

    function getPreguntasConPromedio($escuela = false){
        $sql = "select p.id,p.titulo,SUM(cp.calificacion_pregunta)/COUNT(cp.calificacion_pregunta) as promedio from preguntas p
                left join calificaciones_preguntas cp on cp.pregunta = p.id
                left join calificaciones c on c.id = cp.calificacion
                where c.cct = '$escuela'
                group by  p.id,p.titulo";

        $result = mysql_query($sql);

        $preguntas = array();
        $i = 0;
        if($result && mysql_num_rows($result)){
            while($row = mysql_fetch_row($result)){
                $pregunta = new pregunta($row[0]);
                $pregunta->titulo = $row[1];
                $pregunta->promedio = number_format($row[2], 1, '.', ',');
                $preguntas[$i++] = $pregunta;
            }
        }

        return count($preguntas) ? $preguntas:false;
    }
}
class reporte_ciudadano extends table{
	function info(){
		$this->table_name = 'reportes_ciudadanos';
		$this->objects['cct'] = 'escuela';

		$this->has_many['likes'] = 'reporte_ciudadano_like';
		$this->has_many_keys['likes'] = 'denuncia'; 
	}
}
class reporte_ciudadano_like extends table{
	function info(){
		$this->table_name = 'reportes_ciudadano_likes';
		$this->objects['reporte_ciudadano'] = 'reporte_ciudadano';
	}
}

class newsletters extends table{
	function info(){
		$this->table_name = 'newsletters';
	}
}

class user_search extends table{
	function info(){
		$this->table_name = 'user_search';
	}
}
class firma extends table{
	function info(){
		$this->table_name = "firmas";
	}
	public function count(){
		$sql = "SELECT COUNT(*) FROM firmas WHERE 1";
		$result = $this->execute_sql($sql);
		if($result){
			$row = mysql_fetch_row($result);
			return $row[0];
		}else{
			return false;
		}
	}
}
class firma_img extends table{
	function info(){
		$this->table_name = "firmas_images";
	}
}
class programa extends table{
	function info(){
		$this->table_name = "programas";
	}
} 

class banner extends table{
	function info(){
		$this->table_name = "banners";
	}
}

class page_banner extends table{
	function info(){
		$this->table_name = "page_banners";
		$this->objects['banner'] = 'banner';
	}
}
?>
