<?php
class jafet_config extends default_config{
	public function jafet_config(){
		parent::__construct();
		//error_reporting(0);
		//Site
		$this->http_address = 'http://comparatuescuela.local/';
		$this->mxnphp_dir = "c:/wamp/www/mxnphp/";

		$this->blog_address = 'http://blog.mejoratuescuela.org/';
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'cte_optimizada';
		$this->db_user = 'root';
		$this->db_pass = '***REMOVED***';

		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>