<?php
class contacto extends main{
	public function index(){		
		$this->header_folder ='contacto';		
		$this->breadcrumb = array('#'=>'Contacto');
		$this->include_theme('index','index');
	}
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
