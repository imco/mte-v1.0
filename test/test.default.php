<?php

class defaultTest extends PHPUnit_Framework_TestCase{

	public function setUp(){
		$path = __DIR__."/../"; 
		//export APPLICATION_ENV="name_config"
		$config_name = getenv('APPLICATION_ENV');
		require_once $path."config/config.default_config.php"; 
		require_once $path."config/config.$config_name.php";
		$config = new $config_name();
		$this->config = $config;
		$this->pathProject = $path;
		$this->requires();
	}

	protected function require_contoler($nameController){
		require_once $this->pathProject."controlers/controler.main.php";
		if($nameController != "main")
			require_once $this->pathProject."controlers/controler.".$nameController.".php";
		return new $nameController($this->config);
	}

	private function requires(){
		require_once $this->pathProject."models/model.general.php";
		require_once $this->pathProject."models/model.escuela.php";
		require_once $this->pathProject."/library/ApiHootSuite.php";
	
	}

}

class controler{

	public function dbConnect(){ 
		$path = __DIR__."/../";

		
	}
	
	public function request($request){
		return false;
	}

	public function cookie($cookie){
		return false;
	}

	public function get($get){
		return false;
	}
}

class memcached_table extends table{

}

class table{

	public $search_clause = "";

	public function read(){
		return null;
	}
}

?>
