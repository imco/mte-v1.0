<?php
class califica_tu_escuela extends main{
	public function index(){		
		$this->header_folder ='califica_tu_escuela';
		$this->load_calificaciones();
		$this->include_theme('index','index');

	}
	public function califica(){
		if($this->escuela_info()){
			$this->title_header = 'Califica tu escuela';
			$this->header_folder = 'compara';
			$this->breadcrumb = array('/califica-tu-escuela/'=>'Califica tu escuela','#'=>$this->escuela->nombre);
			$this->include_theme('index','califica');
		
		}else{
			header("location: /compara/");
		}
	}

	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		$this->escuela->read("cct,nombre");
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
