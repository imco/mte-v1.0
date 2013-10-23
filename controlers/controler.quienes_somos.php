<?php
class quienes_somos extends main{
	/* Controlador: host/quienes_somos/*
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->title_header = '¿Quiénes somos?';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'¿Quiénes somos?');
		$this->subtitle_header = '
			MejoraTuEscuela.org es una plataforma que busca <br />
			promover la participación ciudadana para transformar <br />
			la educación en México.';
		$this->include_theme('index','index');
	}
}

?>
