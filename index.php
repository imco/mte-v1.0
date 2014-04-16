<?php
#error_reporting(0);
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
ini_set('post_max_size', '5M');
ini_set('upload_max_filesize', '5M');
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
?>
