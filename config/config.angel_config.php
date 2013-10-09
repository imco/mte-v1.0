<?php
class angel_config extends default_config{
	public function angel_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela/';
		$this->mxnphp_dir = "c:/wamp/www/mxnphp/";
		
		$this->blog_address = 'http://comparatuescuela-blog.proyects.spaceshiplabs.com/';
		
		$this->db_host = '***REMOVED***';
		$this->db_name = '***REMOVED***';
		$this->db_user = '***REMOVED***';
		$this->db_pass = '***REMOVED***';

		//Database
		/*$this->db_host = '***REMOVED***';
		$this->db_name = 'compara';
		$this->db_user = 'root';
		$this->db_pass = '';*/

		
		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>