<?php
/**
* Clase escuelas Extiende main
* Controlador: /escuelas/*
* Contiene todo lo usado en los perfiles de las escuelas.
*/
class escuelas extends main{
	/**
	* Funcion Publica index.
	*/
	public function index(){
		if($this->escuela_info()){
			$params = new stdClass();
			$params->limit = '0,8';
			$params->localidad = $this->escuela->localidad->id;
			$params->nivel = $this->escuela->nivel->id;		
			#$params->ccts = array($this->escuela->cct);
			$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC';

			$this->load_compara_cookie();
			//$this->debug = true;
			$this->get_escuelas($params);
			//$this->escuelas[] = $this->escuela;
		
			if($this->compara_cookie){
				$temp = $this->escuelas;
				$params2 = new stdClass();
				$params2->ccts = $this->compara_cookie;
				$this->get_escuelas($params2);
				$this->escuelas = array_merge($temp,$this->escuelas);
			}
			$this->escuelas = array_unique($this->escuelas);

			$this->process_escuelas();
			$this->cct_count_entidad();
			$this->get_metadata();
			$this->escuelas_digest->zoom = 16;
			$this->escuelas_digest->centerlat = $this->escuela->latitud;
			$this->escuelas_digest->centerlong = $this->escuela->longitud;
			$this->header_folder = 'escuelas';
			$this->draw_map = true;
			$this->page_title = $this->capitalize($this->escuela->nombre).' - '.$this->escuela->cct.' - Mejora tu Escuela';
			$this->resultados_title = 'Escuelas similares <span>| Cercanas</span>';
			$this->breadcrumb = array(
				'/compara/'=>'Escuelas',
				'/compara/?search=true&entidad='.$this->escuela->entidad->id.'#resultados' => $this->capitalize($this->escuela->entidad->nombre),
				'/compara/?search=true&municipio='.$this->escuela->municipio->id.'&entidad='.$this->escuela->entidad->id.'#resultados' => $this->capitalize($this->escuela->municipio->nombre),
				'#'=> $this->capitalize($this->escuela->nombre)
			);
			//$this->include_theme('index','index');
			$this->title_header = 'Conoce tu escuela';
			$this->subtitle_header = 'El primer paso para poder mejorar tu centro escolar es saber cómo está. Te invitamos a que conozcas y compartas esta información.';
			$this->header_folder = 'compara';
			$this->include_theme('index','perfil_b');
		}else{
			header('HTTP/1.0 404 Not Found');
		}
	}

	/**
	* Funcion Publica escuela_info.
	* Lee la información de la escuela con CCT en la url: host/escuelas/index/CCT, sí la información de esta escuela esta 
	* en la base de datos el atributo 'escuela' contendrá los datos de esta y un booleano verdadero es devuelto en caso contrario se devuelve un falso.
	*/
	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		//$this->escuela->debug = true;
		$this->escuela->has_many_order_by['calificaciones'] = 'calificaciones.likes DESC';
		$this->escuela->key = 'cct';
		$this->escuela->fields['cct'] = $this->get('id');
		$this->escuela->read("cct");
		if(isset($this->escuela->cct)){
			$this->escuela->read("
				id,nombre,domicilio,paginaweb,promedio_general,promedio_matematicas,promedio_espaniol,rank_entidad,rank_nacional,poco_confiables,total_evaluados,pct_reprobados,grados,
				entidad=>nombre,entidad=>id,municipio=>id,municipio=>nombre,localidad=>nombre,localidad=>id,
				telefono,correoelectronico,
				turno=>nombre,latitud,longitud,
				nivel=>nombre,nivel=>id,
				control=>id,control=>nombre,
				enlaces=>id,enlaces=>anio,enlaces=>grado,enlaces=>turnos,enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>nivel,
				calificaciones=>calificacion,calificaciones=>id,calificaciones=>likes,calificaciones=>comentario,calificaciones=>nombre,calificaciones=>ocupacion,calificaciones=>timestamp,
				reportes_ciudadanos=>id,reportes_ciudadanos=>likes,reportes_ciudadanos=>denuncia,reportes_ciudadanos=>nombre_input,reportes_ciudadanos=>publicar
			");


		//if(isset($this->escuela->cct)){
			$this->escuela->get_semaforo();
			$this->escuela->get_mongo_info($this->mongo_connect());
			$this->escuela->line_chart_espaniol = $this->escuela->get_chart('espaniol');
			$this->escuela->line_chart_matematicas = $this->escuela->get_chart('matematicas');
			$nivel = "numero_escuelas_".strtolower($this->escuela->nivel->nombre);
			$entidad_info = new entidad($this->escuela->entidad->id);
			$entidad_info->debug = false;
			$entidad_info->read($nivel);
			$this->entidad_cct_count = $entidad_info->$nivel;

            $aux = new pregunta();
            if (isset($this->escuela->calificaciones) && $this->escuela->calificaciones) {
                $this->preguntas = $aux->getPreguntasConPromedio($this->escuela->cct);
            } else {
                $aux->search_clause = " 1 = 1 ";
                $this->preguntas = $aux->read('id,titulo');
            }


			return true;
		}else{
			return false;
		}
	}

	/**
	* Funcion Publica calificar.
	* Obtienen la calificación brindada por el usuario y se guarda en la tabla calificaciones
	*/
	public function calificar(){
//        $sweetcaptcha = new sweetcaptcha(
//            $this->config->SWEETCAPTCHA_APP_ID,
//            $this->config->SWEETCAPTCHA_KEY,
//            $this->config->SWEETCAPTCHA_SECRET,
//            $this->config->SWEETCAPTCHA_PUBLIC_URL
//        );
//
//		if((isset($_POST['sckey']) && isset($_POST['scvalue']) && $sweetcaptcha->check(array('sckey' => $_POST['sckey'], 'scvalue' => $_POST['scvalue'])) == "true")){
			$comment = strip_tags($this->post('comentario'));
			$calificacion = new calificacion();
			//$calificacion->debug = true;
			$calificacion->create('nombre,email,cct,comentario,ocupacion,calificacion,user_agent',array(
				$this->post('nombre'),
				$this->post('email'),
				$this->post('cct'),
				$comment,
				$this->post('ocupacion'),
				stripslashes($this->post('calificacion')),
				$_SERVER['HTTP_USER_AGENT']
			));

            $calificacion->setCalificaciones($this->post('preguntas'),$this->post('calificaciones'));

			$location = $calificacion->id ? "/escuelas/index/".$this->post('cct')."#calificaciones" : "/escuelas/index/".$this->post('cct')."/e=ce#calificaciones";

//		}else{
//			$location = "/escuelas/index/".$this->post('cct')."/e=captcha#calificaciones";
//		}
//
        header("location: $location");
	}

	/**
	* Funcion Publica like_calificacion.
	* Obtienen metadatos del usuario que se almacenan en la tabla calificación_like e incrementa en uno el campo 'like' de la calificación elegida
	*/
	public function like_calificacion(){
		$calif = new calificacion($this->get('id'));
		$calif->read('id,cct,likes=>id,likes=>ip');
		$calif->update('likes',array(count($calif->likes)+1));
		$like = new calificacion_like();
		$like->create('calificacion,ip,user_agent',array(
			$calif->id,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['HTTP_USER_AGENT']
		));
		header('location: /escuelas/index/'.$calif->cct.'#calificaciones');
	}

	/**
	* Funcion Publica reportar.
	* Obtienen el reporte brindado por el usuario y se guarda en la tabla reportes_ciudadanos
	*/
	public function reportar(){
		$denuncia = strip_tags($this->post('denuncia'));
		$reporte_ciudadano = new reporte_ciudadano();
		$reporte_ciudadano->create('nombre_input,email_input,denuncia,ocupacion,categoria,publicar,cct,user_agent',array(
			$this->post('nombre_input'),
			$this->post('email_input'),
			$denuncia,
			$this->post('ocupacion'),
			$this->post('categoria'),
			$this->post('publicar'),
			$this->post('cct'),
			$_SERVER['HTTP_USER_AGENT']
		));
		$location = $reporte_ciudadano->id ? "/escuelas/index/".$this->post('cct')."#reportes_ciudadanos" : "/escuelas/index/".$this->post('cct')."/e=ce#reportes_ciudadanos"; 
		header("location: $location");
	}

	/**
	* Funcion Publica like_reportar.
	* Obtienen la calificación brindada por el usuario y se guarda en la tabla reportes_ciudadanos
	*/
	public function like_reportar(){
		$reporte = new reporte_ciudadano($this->get('id'));
		$reporte->read('id,cct=>cct,likes=>id,likes=>ip');
		$reporte->update('likes',array(count($reporte->likes)+1));
		$like = new reporte_ciudadano_like();
		$like->create('denuncia,ip,user_agent',array(
			$reporte->id,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['HTTP_USER_AGENT']
		));
		header('location: /escuelas/index/'.$reporte->cct->cct.'#reportes_ciudadanos');
	}

	/**
	* Funcion Publica str_limit.
	* Recibe como parametros: $str una cadena de caracteres, $limit el tamaño máximo de cada palabra contenida en la cadena 
	* $str. una cadena con el espacio aplicado cada $limit es regresada
	* \param $str string
	* \param $limit integer
	*/
	public function str_limit($str,$limit){
		$length = strlen($str)/$limit;
		$newStr = "";
		$temp = 0;
		for($i=0;$i<$length;$i++){
			$newStr = $newStr." ".substr($str,$temp,$limit);
			$temp += $limit;
		}
		return $newStr;
	}

	/**
	* Funcion Publica get_metada.
	* Contiene los datos a mostrar en el meta tag description a las vistas que pertenezcan a este controlador
	*/
	public function get_metadata(){
		if(isset($this->escuela->rank_nacional)){
			$description = "La escuela de nivel ".strtolower($this->escuela->nivel->nombre)." ".$this->capitalize($this->escuela->nombre)." ";
			if($this->escuela->rank_entidad<=10){
				$description =$description."obtuvo una de las mejores calificaciones en la prueba ENLACE 2013 en el ";
			if($this->escuela->entidad->id!=9){
				$description=$description." Estado de ";
			}
			$description = $description.$this->capitalize($this->escuela->entidad->nombre);
			if($this->escuela->rank_nacional<=10){
				$description = $description." y a nivel nacional";
			}
			$description = $description.".";

		}else{
			$semaforosd = array("MALO", "ACEPTABLE", "BUENO", "EXCELENTE");
			$description = $description."tiene un aprovechamiento académico ".$semaforosd[$this->escuela->semaforo]." en comparación con otras escuelas que presentaron la prueba ENLACE 2013.";
		}

		}else{
			$description = "No contamos con información suficiente para calificar el aprovechamiento académico en la escuela de nivel ".strtolower($this->escuela->nivel->nombre)." ".$this->capitalize($this->escuela->nombre).", es posible que esta institución no haya tomado la prueba ENLACE 2013 o no se haya tomado en todos sus grupos.";
		}
		$this->meta_description = $description." El primer paso para mejorar tu centro escolar es saber como está. Te invitamos a que conozcas y compartas esta información.";
	}
}
?>
