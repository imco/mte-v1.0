<?php
class git_config extends default_config{
	public function git_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://comparatuescuela.projects.spaceshiplabs.com/'; 
		$this->blog_address = 'http://comparatuescuelablog.projects.spaceshiplabs.com/';
		//$this->blog_address = 'http://blog.mejoratuescuela.org/';
		$this->mxnphp_dir = "/var/www/mxnphp/";
		$this->contact_email = 'aero.uriel@gmail.com';

		$this->solr_server = 'http://busquedas.mejoratuescuela.org/solr/mte/';
		
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

		$this->db_host = '***REMOVED***';
		$this->db_name = 'cte_optimizada';
		$this->db_user = 'root';
		$this->db_pass = '***REMOVED***';

		$this->contact_email = 'aero.urie@gmail.com';
		*/
		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>
