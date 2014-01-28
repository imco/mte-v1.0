<?php

/**
* Clase mapa extiende main.
* Controlador: host/mapa
*/
class mapa extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Se encarga de mostrar la vista adecuada al usuario. */
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();	
		$params->limit = '0,1000';
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->draw_map = true;
		$this->include_theme('index','index');
	}
}
?>
