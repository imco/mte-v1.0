<?php
class cp extends table{
	function info(){
		$this->table_name = "cps";
	}
}
class state extends table{
	function info(){
		$this->table_name = "entidades";
	}
}
class county extends table{
	function info(){
		$this->table_name = "municipios";
	}	

}
class localidad extends table{
	function info(){
		$this->table_name = "localidades";
	}

}
class senator extends table{
	function info(){
		$this->table_name = "senadores";
	}
}
class escuela extends table{
	function info(){
		$this->table_name = "escuelas";
	}

}
?>