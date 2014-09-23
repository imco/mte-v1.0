<?php

/**
* Clase bibliotecas Extiende main.
* Controlador: host/bibliotecas
*/
class bibliotecas extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->title_header = 'Programas';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('/mejora/bibliotecas/'=>'Bibliotecas');
		$this->subtitle_header = '
			MejoraTuEscuela.org es una plataforma que busca <br />
			promover la participación ciudadana para transformar <br />
			la educación en México.';
		$this->include_theme('index','index');
	}
}