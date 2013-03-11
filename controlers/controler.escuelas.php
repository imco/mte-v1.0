<?php
class escuelas extends main{
	public function index(){
		$this->escuela_info();
		$this->include_theme('index','index');
	}
	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		$this->escuela->read('cct,nombre,domicilio,entrecalle,ycalle,entidad=>nombre,municipio=>nombre,localidad=>nombre,codigopostal,telefono,telextension,fax,faxextension,correoelectronico,paginaweb,turno=>nombre,latitud,longitud,tipo=>nombre,nivel=>nombre,subnivel=>nombre,servicio=>nombre,control=>nombre,subcontrol=>nombre,sostenimiento=>nombre,status=>nombre');
	}

}
?>