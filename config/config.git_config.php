<?php
class git_config extends default_config{
	public function git_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela.proyects.spaceshiplabs.com/';
		$this->mxnphp_dir = "/var/www/mxnphp/";
		$this->contact_email = 'aero.uriel@gmail.com';
		
		//Database
		$this->db_host = '***REMOVED***';
		$this->db_name = 'comparatuescuela';
		$this->db_user = 'root';
		$this->db_pass = 'RtG/()rERtfkfGKLF';
/*
		
		$this->db_host = '***REMOVED***';
		$this->db_name = '***REMOVED***';
		$this->db_user = '***REMOVED***';
		$this->db_pass = '***REMOVED***';
*/		
		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>
