<?php
class califica_tu_escuela extends main{
	public function index(){		
		$this->header_folder ='califica_tu_escuela';
		$this->load_calificaciones();
		$this->include_theme('index','index');

	}
	private function load_calificaciones(){
		$q = new calificacion();
		$q->search_clause = '1';
		$q->order_by = 'califica_tu_escuela.likes DESC';
		$this->calificaciones = $q->read('cct=>cct,cct=>nombre,cct=>entidad=>id,nombre_input,ocupacion,denuncia,likes,publicar,id');
	}
}
?>