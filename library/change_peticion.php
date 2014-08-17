<?php
ini_set('display_errors',1);
date_default_timezone_set('America/Mexico_City');

require_once 'ApiChange.php';

/*
$api_key = 'b75cb3d3b200a53ae5c0f3cc72921305db69736fa836fec3b2fed6ee202affb9';
$petition_url = 'http://www.change.org/petitions/juan-perez-prueba-para-api';
$x = new ApiChange($api_key, '67d0f60ce212323b4c8a545bb7f74d4c478ca1a358931e9ce2fa9174063b7672');

$parameters['source'] = 'www.mejoratuescuela.org/peticion';
$parameters['email'] = 'oscar.mekler@gmail.com';
$parameters['first_name'] = 'John';
$parameters['last_name'] = 'Doe';
$parameters['address'] = '1 Market St';
$parameters['city'] = 'Philadelphia';
$parameters['state_province'] = 'PA';
$parameters['postal_code'] = '19144';
$parameters['country_code'] = 'US';

$petition_auth_key = '7da3e3e782ffb15728a5fcb66fe0250a4aafbbf7c150b4cc69e1d3eb3608903f';
var_dump($x->regresa_info_peticion($petition_url));
var_dump($x->regresa_razones_peticion($petition_url));
//var_dump( $x->suma_firma_peticion($petition_url, $petition_auth_key, $parameters));
*/


$api_key = '***REMOVED***';
$petition_url = 'http://www.change.org/peticiones/autoridades-educativas-del-gobierno-del-estado-de-m%C3%A9xico-exigimos-saber-como-se-gastan-nuestras-cuotas-en-la-escuela-%C3%A1ngel-maria-garibay-kintana';
$secret_token = '***REMOVED***';
$x = new ApiChange( $api_key, $secret_token );

$parameters['source'] = 'www.mejoratuescuela.org/peticiones';
$parameters['email'] = 'oscar.mekler@gmail.com';
$parameters['first_name'] = 'Paco';
$parameters['last_name'] = 'Mekler';
$parameters['city'] = 'Ciudad de Mexico';
$parameters['postal_code'] = '11560';
$parameters['country_code'] = 'MX';

$petition_auth_key = '3d123d2998aa55899a372ac09aef99f166e74c854df7ec877497533ee996103b';

var_dump($x->regresa_info_peticion($petition_url));
#$x->pedir_auth_key_peticion( $petition_url );

//echo "\nSe ha solicitado la auth_key";
//var_dump( $x->suma_firma_peticion($petition_url, $petition_auth_key, $parameters));
?>