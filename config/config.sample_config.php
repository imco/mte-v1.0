<?php
class sample_config extends default_config{
	public function sample_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela/';
		$this->mxnphp_dir = "/var/www/mxnphp";

		$this->blog_address = 'http://blog.mejoratuescuela.org/';
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'mejoratuescuela';
		$this->db_user = 'mejora';
		$this->db_pass = 'contraseña';

		//MXNPHP
		$this->dev_mode = true;

		/****
		Keys
		****/
		//Change.org
		$this->change_api_key = false;
		$this->change_secret_token = false;
		//Twitter
		$this->twitter_access_token = false;
		$this->twitter_access_token_secret = false;
		$this->twitter_consumer_key = false;
		$this->twitter_consumer_secret = false;
		//Hoot Suite
		$this->hootSuite_api_key = false;
		//recapcha
		$this->recaptcha_public_key = false;
		$this->recaptcha_private_key = false;
		//sweetcaptcha
		$this->SWEETCAPTCHA_APP_ID false;
		$this->SWEETCAPTCHA_KEY = false;
		$this->SWEETCAPTCHA_SECRET = false;
		$this->SWEETCAPTCHA_PUBLIC_URL = false;
		//sendGrid
		$this->send_grid_user = false;
		$this->send_grid_key  = false;
		//rack space
		$this->rack_space_user = false;
		$this->rack_space_key = false;
		//Mongo
		$this->mongo_server = false;
		$this->mongo_user = false;
		
	}
}
?>