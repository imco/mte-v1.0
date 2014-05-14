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
		$captcha = new Recaptcha($this->config->recaptcha_public_key,$this->config->recaptcha_private_key);
		if($captcha->check_answer($this->config->http_address,
			$this->post('recaptcha_challenge_field'),
			$this->post('recaptcha_response_field'))){
				$this->contact_status = $this->send_email(
				$this->config->contact_email,
				'Correo electronico desde Mejora tu escuela de: '.$this->post('email'),
				$this->post('mensaje'),
				'system@mejoratuescuela.org',
				$this->post('nombre')
			);
		}
		$this->header_folder ='contacto';
		$this->include_theme('index','index');
	}
}
?>
