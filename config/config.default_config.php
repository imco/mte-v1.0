<?php
class default_config{
	public function __construct(){
		//system configuration
		$this->site_name =  'comparatuescuela.org';
		$this->theme = 'mtev1';
		$this->default_controler = 'home';
		$this->default_action = 'index';
	
		//Security 
		$this->secured = false;
		
		//Sofware
		$this->document_root = $_SERVER['DOCUMENT_ROOT']."/";
		$this->lang = "en";
		$this->dev_mode = false;
		
		//MTE
		$this->semaforos = array('Reprobado','Elemental','Bien','Excelente','No Enlace');
	}
}
?>