<?php
phpinfo();
/*
$env = getenv('APPLICATION_ENV');
if($env != "")
	$config_name= $env;
else
	$config_name = 'production_config';

require_once "config/config.default_config.php"; 
require_once "config/config.$config_name.php";
//echo $config_name;
$config = new $config_name();
require_once $config->mxnphp_dir."/scripts/autoload.php";
$mxnphp = new mxnphp($config);
$mxnphp->load_model();
$mxnphp->load_controler();
*/
?>
