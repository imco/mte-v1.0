<?php
/**
* Clase datos_abiertos Extiende main.
* Controlador: host/datos_abiertos
*/
class datos_abiertos extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->header_folder ='datos_abiertos';
		$this->load_file_list();
		$this->include_theme('index','index');
	}

	/**
	* Funcion Privada load_file_list.
	* Carga el objeto en formato json con la información de las escuelas que incluye: nombre,url,descripción
	* Estos datos las almacena en el atributo 'files'
	*/
	private function load_file_list(){
		/* Carga el objeto en formato json con la información de las escuelas que incluye: nombre,url,descripción. 
		   Estos datos las almacena en el atributo 'files'.
		*/
		$files = file_get_contents($this->config->document_root.'/files/files-index.js');
		$this->files = json_decode($files);
	}
}
?>
