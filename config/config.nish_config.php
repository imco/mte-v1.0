<?php
class nish_config extends default_config{
	public function nish_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela/';
		$this->mxnphp_dir = "/home/nish/webdev/mxnphp/";
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'comparatuescuela';
		$this->db_user = 'root';
		$this->db_pass = 'qwer1985*';
		
		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>