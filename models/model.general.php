<?php
class cp extends table{
	function info(){
		$this->table_name = "cps";
	}
}
class entidad extends table{
	function info(){
		$this->table_name = "entidades";
	}
}
class municipio extends table{
	function info(){
		$this->table_name = "municipios";
	}	

}
class localidad extends table{
	function info(){
		$this->table_name = "localidades";
	}

}
class escuela extends table{
	function info(){
		$this->table_name = "escuelas";
	}

}
class nivel extends table{
	function info(){
		$this->table_name = "niveles";
	}
}

class subnivel extends table{
	function info(){
		$this->table_name = "subniveles";
	}
}
class servicio extends table{
	function info(){
		$this->table_name = "servicios";
	}
}
class modalidad extends table{
	function info(){
		$this->table_name = "modalidades";
	}
}
class control extends table{
	function info(){
		$this->table_name = "controles";
	}
}
class subcontrol extends table{
	function info(){
		$this->table_name = "subcontroles";
	}
}
class sostenimiento extends table{
	function info(){
		$this->table_name = "sostenimientos";
	}
}
class status extends table{
	function info(){
		$this->table_name = "statuses";
	}
}
class turno extends table{
	function info(){
		$this->table_name = "turnos";
	}
}
?>