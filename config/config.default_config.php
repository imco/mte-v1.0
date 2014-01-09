<?php
class default_config{
	public function __construct(){
		//system configuration
		$this->site_name =  'comparatuescuela.org';
		$this->theme = 'mtev1';
		$this->default_controler = 'home';
		$this->default_action = 'index';
		$this->blog_address = 'http://blog.mejoratuescuela.org/';
		//Security 
		$this->secured = false;
		
		//Sofware
		$this->document_root = $_SERVER['DOCUMENT_ROOT']."/";
		$this->lang = "en";
		$this->dev_mode = true;
		$this->search_location = false;
		$this->memcache_host = '***REMOVED***';
		
		//MTE
		$this->semaforos = array('Reprobado','De panzazo','Bien','Excelente','No tomó la <br /> prueba <br />ENLACE','Poco confiable','Esta escuela no tomó la prueba ENLACE para todos los años','La prueba ENLACE no esta disponible para este nivel escolar');

		//Change.org
		$this->change_api_key = '***REMOVED***';
		$this->change_secret_token = '***REMOVED***';

		//twitter
		$this->twitter_access_token ='599751421-kgIYMkGn9Qf8YxanUJvEA8oaUCqaR0xMFJh6gQ1S';
		$this->twitter_access_token_secret = 'xA2osI7KtxKA1WG6pTwVduDM1Avnw2Umw94fJoNxo';
		$this->twitter_consumer_key = '***REMOVED***';
		$this->twitter_consumer_secret = '***REMOVED***';

		//hoot suite
		$this->hootSuite_api_key = '***REMOVED***';

		//recapcha
		$this->recaptcha_public_key = '***REMOVED***';
		$this->recaptcha_private_key = '***REMOVED***';

		$this->contact_email = 'contacto@mejoratuescuela.org';
		$this->tynt = false;
		
		//signs sizes
		$this->icon_sizes = json_decode('[
			{"width":"50","height":"50","slug":"tiny"},
			{"width":"156","height":"112","slug":"signs" , "resize_type":"best fit"}
		]');
	}
}
?>
