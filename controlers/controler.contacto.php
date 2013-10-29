<?php
	/**
	* Clase contacto Extiende main.
	* Controlador: host/contacto
	*/
class contacto extends main{

	/**
	* Funcion Publica index.
	* Se encarga de mostrar la vista adecuada al usuario
	*/
	public function index(){
		$this->header_folder ='contacto';		
		$this->breadcrumb = array('#'=>'Contacto');
		$this->include_theme('index','index');
	}

	/**
	* Funcion Publica enviar.
	* Obtiene los datos del formulario de contacto y estos son enviados a la dirección de correo electrónico del atributo del archivo de configuración 'contact_email'.
	*/
	public function enviar(){
		$this->contact_status = $this->send_email(
			$this->config->contact_email,
			'Correo electronico desde Mejora tu escuela',
			$this->post('mensaje'),
			$this->post('email'),
			$this->post('nombre')
		);
		$this->header_folder ='contacto';
		$this->include_theme('index','index');
	}
}
?>
