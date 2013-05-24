<?php
class escuelas extends main{
	public function index(){
		$this->escuela_info();
		$params->limit = '0,20';
		$params->localidad = $this->escuela->localidad->id;
		$params->nivel = $this->escuela->nivel->id;
		$params->cct = $this->escuela->cct;
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->escuelas_digest->zoom += 2;
		$this->escuelas_digest->escuelas[] = $this->escuela;
		$this->escuelas_digest->centerlat = $this->escuela->latitud;
		$this->escuelas_digest->centerlong = $this->escuela->longitud;
		$this->header_folder = 'escuelas';
		$this->draw_map = true;
		$this->page_title = $this->capitalize($this->escuela->nombre).' - '.$this->escuela->cct.' - Mejora tu Escuela';
		$this->include_theme('index','index');
	}
	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		//$this->escuela->debug = true;
		$this->escuela->read("
			cct,nombre,colonia,domicilio,paginaweb,entrecalle,ycalle,promedio_general,promedio_matematicas,promedio_espaniol,rank_entidad,rank_nacional,rank_municipio,poco_confiables,total_evaluados,
			entidad=>nombre,municipio=>nombre,localidad=>nombre,localidad=>id,
			codigopostal,telefono,telextension,fax,faxextension,correoelectronico,
			turno=>nombre,latitud,longitud,tipo=>nombre,
			nivel=>nombre,nivel=>id,subnivel=>nombre,servicio=>nombre,
			control=>nombre,subcontrol=>nombre,sostenimiento=>nombre,status=>nombre,
			enlaces=>id,enlaces=>anio,enlaces=>grado,enlaces=>turnos,enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>nivel,
			calificaciones=>calificacion,calificaciones=>id,calificaciones=>likes,calificaciones=>comentario,calificaciones=>nombre
		");
		$this->escuela->get_semaforo();
		$this->escuela->line_chart_espaniol = $this->escuela->get_chart('espaniol');
		$this->escuela->line_chart_matematicas = $this->escuela->get_chart('matematicas');
	}
	public function calificar(){
		$comment = strip_tags($this->post('comentario'));
		$calificacion = new calificacion();
		$calificacion->create('nombre,email,cct,comentario,ocupacion,calificacion,user_agent',array(
			$this->post('nombre'),
			$this->post('email'),
			$this->post('cct'),
			$comment,
			$this->post('ocupacion'),
			$this->post('calificacion'),
			$_SERVER['HTTP_USER_AGENT']
		)); 
		$location = $calificacion->id ? "/escuelas/index/".$this->post('cct')."#calificaciones" : "/escuelas/index/".$this->post('cct')."/e=ce#calificaciones";
		header("location: $location");
	}
	public function like_calificacion(){
		$calif = new calificacion($this->get('id'));
		$calif->read('id,cct=>cct,likes=>id,likes=>ip');
		$calif->update('likes',array(count($calif->likes)+1));
		$like = new calificacion_like();
		$like->create('calificacion,ip,user_agent',array(
			$calif->id,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['HTTP_USER_AGENT']
		));
		header('location: /escuelas/index/'.$calif->cct->cct.'#calificaciones');
	}
}
?>