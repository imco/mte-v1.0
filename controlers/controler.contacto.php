<?php
class contacto extends main{
	public function index(){		
		$this->header_folder ='contacto';		
		$this->breadcrumb = array('#'=>'Contacto');
		$this->include_theme('index','index');
	}
	public function enviar(){
		$this->send_email(
			$this->post('contacto@mejoratuescuela.org'),
			'Correo electronico desde Mejora tu escuela',
			$this->post('mensaje'),
			$this->post('email'),
			$this->post('nombre')
		);
	}
}
?>
