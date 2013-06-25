<?php
class egreso_nomina extends table{
	public function info(){
		$this->table_name = 'egresos_nomina';
		$this->objects['cct'] = 'escuela';
		$this->objects['rfc'] = 'maestro';
	}
}
class maestro extends table{
	public function info(){
		$this->table_name = 'maestros';
		$this->key = 'rfc';

	}

}
?>