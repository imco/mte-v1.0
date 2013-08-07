<?php
class nish_config extends default_config{
	public function nish_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela/';
		$this->mxnphp_dir = "/home/nish/Development/framework";
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'comparatuescuela';
		$this->db_user = 'root';
		$this->db_pass = '';
		
		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>