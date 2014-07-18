<?php

require_once "AutoLoader.php";
class defaultTest extends PHPUnit_Framework_TestCase{
//class defaultTest{

	public function setUp(){
		$path = __DIR__."/../"; 
		//export APPLICATION_ENV="name_config"
		$config_name = getenv('APPLICATION_ENV');
		//$config_name = "travis_config";
		require_once $path."config/config.default_config.php";
		require_once $path."config/config.$config_name.php";
		$this->config = new $config_name();
		$this->pathProject = $path;
		//autoloads
		AutoLoader::registerDirectory($this->pathProject."controlers");
		AutoLoader::registerDirectory($this->pathProject."models");
		AutoLoader::registerDirectory($this->config->mxnphp_dir."/classes");
		AutoLoader::registerDirectory($this->pathProject."components");
		AutoLoader::registerDirectory($this->config->mxnphp_dir."/classes/components");
		AutoLoader::registerDirectory($this->pathProject."library");
		AutoLoader::registerClass('turno',$this->pathProject."models/model.general.php");

	}
}
?>
