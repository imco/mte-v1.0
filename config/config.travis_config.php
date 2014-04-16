<?php
class travis_config{
	public function travis_config(){
		$path = __DIR__."/../"; 
		$this->mxnphp_dir = $path."mxnphp";
		$this->db_host = getenv('DBHOST');
		$this->db_name = getenv('DBNAME');
		$this->db_user = getenv('DBUSER');
		$this->db_pass = getenv('DBPASS');
	}
}
?>
