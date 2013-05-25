<?php
class reportes_ciudadanos extends main{
	public function index(){		
		$this->header_folder ='reportes_ciudadanos';
		
		$this->load_reportes();

		$this->include_theme('index','index');

	}
	private function load_reportes(){
		$q = new reporte_ciudadano();
		$q->search_clause = '1';
		$q->order_by = 'reportes_ciudadanos.likes DESC';
		$this->reportes = $q->read('cct=>cct,cct=>nombre,cct=>entidad=>id,nombre_input,ocupacion,denuncia,likes,publicar,id');
	}
}
?>