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
			$params->order_by = ' ISNULL(escuelas_para_rankeo.rank_entidad), escuelas_para_rankeo.rank_entidad ASC';
			$this->load_compara_cookie();
			$this->get_escuelas($params);
			if($this->compara_cookie){
				$temp = $this->escuelas;
				$params2 = new stdClass();
				$params2->ccts = $this->compara_cookie;
                $params2->one_turn = true;
				$this->get_escuelas($params2);
				$this->escuelas = array_merge($temp,$this->escuelas);
			}
			$tmp = $this->escuelas;
			$params = new stdClass();
			$params->ccts = array($this->escuela->cct);
			$this->get_escuelas($params);
			$this->escuelas = array_merge($tmp,$this->escuelas);

			$this->escuelas = array_unique($this->escuelas);


			$this->process_escuelas();
			$this->cct_count_entidad();
			$this->get_metadata();
			$this->load_programas();
			//$this->escuelas_digest = new stdClass();
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
			if($this->escuela->paginaweb && substr($this->escuela->paginaweb,0,7)!='http://'){
				$this->escuela->paginaweb = "http://".$this->escuela->paginaweb;
			}
			if($this->escuela->nivel->nombre != 'PREESCOLAR')
				$this->include_theme('index','perfil_b');
			else{
				$this->include_theme('index','preescolar');
			}
		}else{
			header('HTTP/1.0 404 Not Found');
		}
	}
	/**
	* Funcion Publica escuela_info.
	* Lee la información de la escuela con CCT en la url: host/escuelas/index/CCT, sí la información de esta escuela esta 
	* en la base de datos el atributo 'escuela' contendrá los datos de esta y un booleano verdadero es devuelto en caso contrario se devuelve un falso.
	*/
	public function escuela_info($id=false){
		if(!$id)
			$id = $this->get('id');
		$this->escuela = new escuela($id);
		$this->escuela->debug = false;
		$this->escuela->has_many_order_by['calificaciones'] = 'calificaciones.timestamp DESC';
		$this->escuela->key = 'cct';
        $this->escuela->cct = $id;
		$this->escuela->fields['cct'] = $id;
		$this->escuela->read("id,cct,calificaciones=>calificacion,calificaciones=>id,calificaciones=>likes,calificaciones=>comentario,calificaciones=>nombre,calificaciones=>ocupacion,calificaciones=>timestamp,calificaciones=>activo,calificaciones=>acepta_nombre");
        $this->escuela->key = 'id';
        $this->escuela->has_many_keys["enlaces"] = "id_cct";
        //$this->escuela->has_many_keys["calificaciones"] = "id_cct";

        if(isset($this->escuela->cct)){
			$this->escuela->read("
				id,nombre,domicilio,paginaweb,
				entidad=>nombre,entidad=>id,municipio=>id,municipio=>nombre,localidad=>nombre,localidad=>id,
				telefono,correoelectronico,
				turno=>id,turno=>nombre,
				latitud,longitud,
				nivel=>nombre,nivel=>id,
				control=>id,control=>nombre,
				enlaces=>id,enlaces=>anio,enlaces=>grado,enlaces=>turnos,enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>nivel,				
				reportes_ciudadanos=>id,reportes_ciudadanos=>likes,reportes_ciudadanos=>denuncia,reportes_ciudadanos=>nombre_input,reportes_ciudadanos=>publicar,
				rank=>promedio_general,rank=>promedio_matematicas,rank=>promedio_espaniol,rank=>total_evaluados,rank=>pct_reprobados,rank=>poco_confiables,rank=>turnos_eval,rank=>rank_entidad,rank=>rank_nacional,rank=>anio
			");
			#$this->debug = true;
            $this->escuela->get_mongo_info($this->mongo_connect());
            $this->escuela->get_turnos();
			$this->escuela->get_semaforos();
            $this->escuela->get_charts();
            $this->escuela->clean_ranks();
			$nivel = "numero_escuelas_".strtolower($this->escuela->nivel->nombre);
			$entidad_info = new entidad($this->escuela->entidad->id);
			$entidad_info->debug = false;
			$entidad_info->read($nivel);
			if($this->escuela->nivel->id == 11  || $this->escuela->nivel->id ==  12 || $this->escuela->nivel->id == 22)
				$this->entidad_cct_count = $entidad_info->$nivel;
			else
				$this->entidad_cct_count = 0;
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
		$captcha = new Recaptcha($this->config->recaptcha_public_key,$this->config->recaptcha_private_key);
		$calificacion = new stdClass();
		if($captcha->check_answer($this->config->http_address,
			$this->post('recaptcha_challenge_field'),
			$this->post('recaptcha_response_field'))){
				$comment = strip_tags($this->post('comentario'));
				$accept_name = ($this->post('accept')!=null) ? 1 : 0;
				$calificacion = new calificacion();
				if(!$this->isSpam(array(
			                'author' => $this->post('nombre'),
	        		        'email' => $this->post('email'),
			                'body' => $comment
				))){
					//$calificacion->debug = true;
					$calificacion->create('nombre,email,cct,comentario,ocupacion,calificacion,user_agent,acepta_nombre',array(
						$this->post('nombre'),
						$this->post('email'),
						$this->post('cct'),
						$comment,
						$this->post('ocupacion'),
						stripslashes($this->post('calificacion')),
						$_SERVER['HTTP_USER_AGENT'],
						$accept_name
					));
					if($this->post("calificaciones")) $calificacion->setCalificaciones($this->post('preguntas'),$this->post('calificaciones'));				
				}else{					
					//spam
				}

		}

		$location = $calificacion->id ? "/escuelas/index/".$this->post('cct')."#calificaciones" : "/escuelas/index/".$this->post('cct')."/e=ce#calificaciones";
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
			if($this->escuela->rank_entidad<=5){
				$description="La escuela ".$this->capitalize($this->escuela->nombre)." es una de las cinco mejores ".strtolower($this->escuela->nivel->nombre)."s en el estado de ".$this->capitalize($this->escuela->entidad->nombre);
				$description=$description.". Consulta las calificaciones de ENLACE en español y matemáticas, desempeño por alumno, datos de infraestructura y opiniones de otros padres de familia.";
			}else{
				$description = "La escuela ".strtolower($this->escuela->nivel->nombre)." ".strtolower($this->escuela->control->nombre)." ".$this->capitalize($this->escuela->nombre)." ocupa el lugar ";
				$description = $description.(isset($this->escuela->rank_entidad) ? number_format($this->escuela->rank_entidad ,0): '--')." de ".number_format($this->entidad_cct_count,0);
				if($this->escuela->entidad->id!=9){
					$description=$description." en el estado de ";
				}
				$description = $description.$this->capitalize($this->escuela->entidad->nombre).".";
			}
		}else{
			if( $this->escuela->cct[2] === 'B' && $this->escuela->nivel!=12 && $this->escuela->nivel!=13 && $this->escuela->nivel!=22){
				$description = 'Conoce la información sobre las bibliotecas más cercanas a tu casa o escuela , datos sobre la ubicación, infraestructura, servicios con los que cuenta y opiniones de miembros de la comunidad educativa.';
			}else{
				$description = "No contamos con información suficiente para calificar el aprovechamiento académico en la escuela de nivel ".strtolower($this->escuela->nivel->nombre)." ".$this->capitalize($this->escuela->nombre).", es posible que esta institución no haya tomado la prueba ENLACE 2013 o no se haya tomado en todos sus grupos.";
			}
		}
		$this->meta_description = $description." Conoce datos y características de la escuela su infraestructura y las opiniones de otros padres.";
		if($this->escuela->nivel->nombre=="PREESCOLAR")
			$this->meta_description = "Conoce la información sobre el preescolar, datos sobre la ubicación, infraestructura, personal, servicios con los que cuenta y opiniones de otros padres de familia.";
	}

	private function isSpam($params=array()){
		//SPAM test.
		/*$params = array(
	                'author' => 'viagra-test-123',
	                'email' => 'test@example.com',
	                'body' => 'This is a test comment'
        	);*/
		$params["permalink"] = 'http://www.mejoratuela.org'.$_SERVER['REQUEST_URI'];
		$params["website"] = 'http://www.mejoratuescuela.org/';
		$akismet = new Akismet('http://www.mejoratuescuela.org/',$this->config->wordpress_key, $params);
		if($akismet->errorsExist()){
			//keys error
			return false;
		}else{
			return $akismet->isSpam();
		}
	}
}
?>
