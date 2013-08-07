<?php
class irving_config extends default_config{
	public function irving_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela.no-ip.info/';
		$this->mxnphp_dir = "/var/www/mxnphp/";
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'compara';
		$this->db_user = 'irving';
		$this->db_pass = 'irvingg';
		
		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>