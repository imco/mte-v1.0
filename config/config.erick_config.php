<?php
class erick_config extends default_config{
	public function erick_config(){
		parent::__construct();
		error_reporting(0);
		//Site
		$this->http_address = 'http://mte.local/';
		$this->mxnphp_dir = "c:/wamp/www/mxnphp/";

		$this->blog_address = 'http://blog.mejoratuescuela.org/';
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'enlace';//mejoratuescuela
		$this->db_user = 'root';
		$this->db_pass = '';

		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>