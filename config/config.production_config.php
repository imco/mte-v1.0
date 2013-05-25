<?php
class production_config extends default_config{
	public function production_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://mejoratuescuela.org/';
		$this->mxnphp_dir = "/mnt/stor9-wc1-dfw1/630517/www.mejoratuescuela.org/web/mxnphp/";
		
		//Database
		$this->db_host = 'mysql51-014.wc1.dfw1.stabletransit.com';
		$this->db_name = 'comparatuescuela';
		$this->db_user = '630517_Imc0T3';
		$this->db_pass = '***REMOVED***';
		
		//MXNPHP
		$this->dev_mode = false;
		
	}
}
?>