<?php
class sample_config extends default_config{
	public function sample_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://mysite.com/';
		$this->mxnphp_dir = "/var/www/mxnphp";
		$this->blog_address = 'http://blog.mysite.com';

		//Database
		$this->db_host = 'localhost';
		$this->db_name = 'dbname';
		$this->db_user = 'user';
		$this->db_pass = 'password';

		$this->memcache_host = '127.0.0.1';

		//MXNPHP
		$this->dev_mode = false;
		$this->debug = false;
		$this->tynt = true;
		$this->solr_server = 'http://localhost:8983/solr/mte/';


		/****
		  Keys
		 ****/
		//Change.org
		$this->change_api_key = 'api';
		$this->change_secret_token = 'secret';
		//Twitter
		$this->twitter_access_token ='tweet';
		$this->twitter_access_token_secret = 'secret';
		$this->twitter_consumer_key = 'consumer';
		$this->twitter_consumer_secret = 'secret';
		//Hoot Suite
		$this->hootSuite_api_key = 'api';
		//recapcha
		$this->recaptcha_public_key = 'public';
		$this->recaptcha_private_key = 'private';
		//sweetcaptcha
		$this->SWEETCAPTCHA_APP_ID = 12345; // your application id (change me)
		$this->SWEETCAPTCHA_KEY = 'key'; // your application key (change me)
		$this->SWEETCAPTCHA_SECRET = 'secret'; // your application secret (change me)
		$this->SWEETCAPTCHA_PUBLIC_URL ='url'; // public http url to this file
		//sendGrid
		$this->send_grid_user = "user";
		$this->send_grid_key  = "password";
		//rack space
		$this->rack_space_user = "user";
		$this->rack_space_key = "key";
		//Mongo
		$this->mongo_server = 'localhost';
		$this->mongo_user = 'user';
		$this->wordpress_key = "password";
	}
}
?>
