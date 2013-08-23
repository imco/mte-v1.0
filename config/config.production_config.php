<?php
class production_config extends default_config{
	public function production_config(){
		parent::__construct();
		//Site
		$this->http_address = 'http://mejoratuescuela.org/';
		$this->mxnphp_dir = "/mnt/stor9-wc1-dfw1/630517/www.mejoratuescuela.org/web/mxnphp/";
		
		//Database
		/*$this->db_host = 'mysql51-014.wc1.dfw1.stabletransit.com';
		$this->db_name = '630517_1Mk0_Mt3';
		$this->db_user = '630517_Imc0T3';
		$this->db_pass = '***REMOVED***';


		$this->db_host = '184.106.242.65';
		$this->db_name = 'comparatuescuela';
		$this->db_user = 'root';
		$this->db_pass = 'RtG/()rERtfkfGKLF';
		
		$this->db_host = 'mysql51-030.wc1.dfw1.stabletransit.com';
		$this->db_name = '***REMOVED***';
		$this->db_user = '***REMOVED***';
		$this->db_pass = '***REMOVED***';
		
		*/

		$this->db_host = '192.237.193.101';
		$this->db_name = '***REMOVED***';
		$this->db_user = '***REMOVED***';
		$this->db_pass = '***REMOVED***';
		

		//MXNPHP
		$this->dev_mode = true;

		//twitter
		$this->twitter_access_token ='124797851-HRntQp0YIVs3zDhbLoZMjogOI3Er8qXAp4yfsT7h';
		$this->twitter_access_token_secret = 'jmWHX3BeB53tzZUwc1ymtWj33vr10lixJ4WMXtXGY';
		$this->twitter_consumer_key = 'BRnaonyDBNhbRjXiiWsA';
		$this->twitter_consumer_secret = 'lPI2SPRNMP1xOL3QaVizwDK5N47kOzxi0GvxwJl4';
		
	}
}
?>
