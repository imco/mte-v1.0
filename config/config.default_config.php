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
		$this->semaforos = array('Reprobado','Elemental','Bien','Excelente');
		$this->semaforo_rangos[12] = array(400,480,590,900);
		$this->semaforo_rangos[13] = array(400,467,575,900);
		$this->semaforo_rangos[22] = array(349,416,497,900);
	}
}
?>