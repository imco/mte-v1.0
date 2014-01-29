<?php
	/**
	* Clase califica_tu_escuela Extiende main.
	* Controlador: host/califica_tu_escuela
	* Brinda al usuario la posibilidad de otorgar una califcación a una determinada escuela
	*/
class califica_tu_escuela extends main{
	
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){		
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->header_folder ='califica_tu_escuela';
		$this->load_calificaciones();
		//$this->include_theme('index','index');
		$this->califica();
	}

	/**
	* Funcion Publica califica.
	* De acuerdo a la interacción del usuario al momento de iniciar este controlador si procede de:
	* Algún perfil mostrara la vista de calificación de esta escuela.
	* Cualquier otra parte:
	* Si existen datos en la cookie 'escuelas' de perfiles previamente visitados muestra estos y deja al usuario la 
	* posibilidad de escoger alguna así como realizar una búsqueda para calificar alguna otra escuela
	* Si la cookie esta vacía muestra un buscador para encontrar la escuela que el usuario desea calificar
	*/
	public function califica(){
		$this->get_metadata();
		$this->title_header = 'Califica tu escuela';
		$this->subtitle_header = 'Una vez que conoces y has comparado tu escuela, te invitamos a<br />que califiques algunos aspectos de la misma. Las calificaciones<br />ayudan a detectar áreas de mejora y a reconocer los<br />logros alcanzados.';
		$this->header_folder = 'compara';
		if($this->escuela_info()){
			$this->breadcrumb = array('/califica-tu-escuela/'=>'Califica tu escuela','#'=>$this->escuela->nombre);
            $aux = new pregunta();
            $aux->search_clause = "1 = 1";
            $this->preguntas = $aux->read('id,titulo,pregunta,descripcion_valor_minimo,descripcion_valor_maximo');
            //$this->escuela = new escuela($this->get('id'));
            //$this->escuela->read('');
			$this->include_theme('index','califica');
		
		}else{
			#header("location: /compara/");
			$this->breadcrumb = array('#'=>'Califica');
			//$this->load_compara_cookie();
			$cookie = explode('-',$this->cookie('escuelas_vistas'));
			$cookie = array_merge($cookie,explode('-',$this->cookie('escuelas')));
			$cookie = array_unique($cookie);
			if($this->get('term')){
				$this->instruction = 'Selecciona una escuela';
				$params = new stdClass();
				$params->term = $this->get('term');
				$params->control = $this->get('control');
				$params->nivel = $this->get('nivel');
				$params->entidad = $this->get('entidad');
				$params->municipio = $this->get('municipio');
				$params->localidad = $this->get('localidad');
				$p = $this->get('p') ? $this->get('p') : 1;
				$this->get_escuelas_new($params,$p);
			
				$this->cct_count_entidad();
				$this->resultados_title = 'Resultados de tu búsqueda';
				$this->set_info_user_search($this->num_results);
				
				/*
				$params->pagination = 6;
				$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC';
				$this->get_escuelas($params);
				$this->process_escuelas();
				*/
				
			}else if($cookie && $this->get('id') != "undefined"){
				$this->instruction = 'Selecciona la escuela que quieres calificar';
				$this->instruction2 = 'Éstas son escuelas que has revisado recientemente:';
				//$temp = isset($this->escuelas)?$this->escuelas:array();
				$params2 = new stdClass();
				$params2->ccts = $cookie;
				$this->get_escuelas($params2);
				$this->escuelas = array_unique($this->escuelas);
				$this->cookie_vistas = $cookie;
			}else{
				$this->instruction = '¿Qué escuela quieres calificar?';
				$this->instruction2 = 'Búscala aquí';
			}
			$this->include_theme('index','index');
		}
	}

	/**
	* Funcion Publica escuela_info.
	* Lee la información de la escuela que se calificara y la guarda en el atributo 'escuela'.
	*/
	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		$this->escuela->key = 'cct';
		$this->escuela->fields['cct'] = $this->get('id');
		//$this->escuela->control->id
		$this->escuela->read("cct,nombre,nivel=>nombre,turno=>nombre,entidad=>nombre,control=>id");
		if(isset($this->escuela->cct)){
			return true;
		}else{
			return false;
		}
	}

	/**
	* Funcion Privada load_calificaciones.
	* Guarda en el atributo 'calificaciones' todas las calificaciones de todas las escuelas ordenadas en forma descendente.
	*/
	private function load_calificaciones(){
		$q = new calificacion();
		$q->search_clause = '1';
		$q->order_by = 'califica_tu_escuela.likes DESC';
		$this->calificaciones = $q->read('cct=>cct,cct=>nombre,cct=>entidad=>id,nombre_input,ocupacion,denuncia,likes,publicar,id');
	}

	/**
	* Funcion Publica get metadata.
	* Contiene los datos a mostrar en el meta tag description a las vistas que pertenezcan a este controlador 
	*/
	public function get_metadata(){
		$this->meta_description = "¿Qué puede mejorar en la escuela de tus hijos? Califica las instalaciones, trabajo de los maestros y relación con los padres de familia aquí. Deja un comentario sobre tu escuela.";
	}
}
?>
