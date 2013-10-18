<?php
class sample_config extends default_config{
	public function sample_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela/';
		$this->mxnphp_dir = "/var/www/mxnphp/";

		$this->blog_address = 'http://blog.mejoratuescuela.org/';
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'mejoratuescuela';
		$this->db_user = 'mejora';
		$this->db_pass = 'contraseña';

		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>