<?php
class califica_tu_escuela extends main{
	public function index(){		
		$this->header_folder ='califica_tu_escuela';
		$this->load_calificaciones();
		//$this->include_theme('index','index');
		$this->califica();

	}
	public function califica(){
		$this->title_header = 'Califica tu escuela';
		$this->subtitle_header = 'Una vez que conoces y has comparado tu escuela, te invitamos a<br />que califiques algunos aspectos de la misma. Las calificaciones<br />ayudan a detectar áreas de mejora y a reconocer los<br />logros alcanzados.';
		$this->header_folder = 'compara';
		if($this->escuela_info()){
			$this->breadcrumb = array('/califica-tu-escuela/'=>'Califica tu escuela','#'=>$this->escuela->nombre);
			$this->include_theme('index','califica');
		
		}else{
			#header("location: /compara/");
			$this->breadcrumb = array('#'=>'Califica');
			$this->load_compara_cookie();
			if($this->get('term')){
				$this->instruction = 'Selecciona una escuela';
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
				
			}else if($this->compara_cookie){
				$this->instruction = 'Selecciona la escuela que quieres calificar';
				$this->instruction2 = 'Éstas son escuelas que has revisado recientemente:';
				$temp = isset($this->escuelas)?$this->escuelas:array();
				$params2->ccts = $this->compara_cookie;
				$this->get_escuelas($params2);
				$this->escuelas = array_merge($temp,$this->escuelas);
			}else{
				$this->instruction = '¿Qué escuela quieres calificar?';
				$this->instruction2 = 'Búscala aquí';
			}
			$this->include_theme('index','index');
		}
	}

	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		$this->escuela->read("cct,nombre,nivel=>nombre,turno=>nombre,entidad=>nombre");
		if(isset($this->escuela->cct)){
			return true;
		}else{
			return false;
		}
	}

	private function load_calificaciones(){
		$q = new calificacion();
		$q->search_clause = '1';
		$q->order_by = 'califica_tu_escuela.likes DESC';
		$this->calificaciones = $q->read('cct=>cct,cct=>nombre,cct=>entidad=>id,nombre_input,ocupacion,denuncia,likes,publicar,id');
	}
}
?>
