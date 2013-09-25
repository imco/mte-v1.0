<!--<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="/templates/mtev1/img/home/favicon.ico" />
	<title>Mejora tu escuela</title>
 </head>
 <body>
 	<img src='/templates/mtev1/img/home/update.jpg' alt='Mejora tu escuela' />
 </body>
 </html>-->
<?php
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
