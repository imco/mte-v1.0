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
		$this->change_api_key = false;
		$this->change_secret_token = false;

		//twitter
		$this->twitter_access_token = false;
		$this->twitter_access_token_secret = false;
		$this->twitter_consumer_key = false;
		$this->twitter_consumer_secret = false;

		//hoot suite
		$this->hootSuite_api_key = false;

		//recapcha
		$this->recaptcha_public_key = false;
		$this->recaptcha_private_key = false;


		$this->contact_email = 'contacto@mejoratuescuela.org';
		$this->image_email = 'sonny@spaceshiplabs.com';
		$this->image_email = 'ariadna.camargo@imco.org.mx';
		$this->tynt = false;


		//sweetcaptcha
		$this->SWEETCAPTCHA_APP_ID = 40218; // your application id (change me)
		$this->SWEETCAPTCHA_KEY = false;
		$this->SWEETCAPTCHA_SECRET = false;
		$this->SWEETCAPTCHA_PUBLIC_URL ='sweetcaptcha.php'; // public http url to this file
		
		//signs sizes
		$this->icon_sizes = json_decode('[
			{"width":"50","height":"50","slug":"tiny"},
			{"width":"156","height":"112","slug":"signs" ,"resize_type":"best fit"}
		]');

		//sendGrid
		$this->send_grid_user = false;
		$this->send_grid_key  = false;

		//rack space
		$this->rack_space_user = false;
		$this->rack_space_key = false;

		$this->mongo_server = false;
        $this->mongo_user = false;
	}
}
?>
