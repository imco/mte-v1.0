<?php

/**
* Clase mejora Extiende main.
* Controlador: host/mejora
*/
class mejora extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->title_header = 'Mejora tu escuela';
		$this->subtitle_header = 'Aquí encontrarás herramientas para que actúes como agente <br />de cambio positivo en tu comunidad educativa. <br />¡Participa e involúcrate!';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Mejora');
		$this->meta_description = "Tú puedes ayudar a tus hijos a hacer sus tareas y formar hábitos de lectura. En Mejora tu escuela tenemos tips para papás y niños que les ayudarán a aprender mejor.";
		$this->include_theme('index','index');
	}

	public function enviar(){
		$this->contact_status = $this->send_email(
			$this->config->contact_email,
			'Correo electronico desde Mejora tu escuela desde sección "mejora": '.$this->post('email'),
			$this->post('mensaje'),
			'system@mejoratuescuela.org',
			'sección mejora' 
		);
		$this->index();
	}
}
?>
