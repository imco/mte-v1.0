<?php
class escuelas extends main{
	public function index(){
		$this->escuela_info();
		$params->limit = '0,20';
		$params->localidad = $this->escuela->localidad->id;
		$params->nivel = $this->escuela->nivel->id;
		$this->get_escuelas($params);
		$this->process_escuelas();
		//$this->escuelas_digest->escuelas = array();
		$this->escuelas_digest->escuelas[] = $this->escuela;
		$this->escuelas_digest->centerlat = $this->escuela->latitud;
		$this->escuelas_digest->centerlong = $this->escuela->longitud;
		$this->escuelas_digest->zoom++;
		$this->include_theme('index','index');
	}
	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		//$this->escuela->debug = true;
		$this->escuela->read('cct,nombre,domicilio,paginaweb,entrecalle,ycalle,entidad=>nombre,municipio=>nombre,localidad=>nombre,localidad=>id,codigopostal,telefono,telextension,fax,faxextension,correoelectronico,turno=>nombre,latitud,longitud,tipo=>nombre,nivel=>nombre,nivel=>id,subnivel=>nombre,servicio=>nombre,control=>nombre,subcontrol=>nombre,sostenimiento=>nombre,status=>nombre');
	}



}
?>