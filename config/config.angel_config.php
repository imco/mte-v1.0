<?php
class angel_config extends default_config{
	public function angel_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela/';
		$this->mxnphp_dir = "/wamp/www/mxnphp";

		$this->blog_address = 'http://blog.mejoratuescuela.org/';
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = '***REMOVED***';
		$this->db_user = '***REMOVED***';
		$this->db_pass = '***REMOVED***';

		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>