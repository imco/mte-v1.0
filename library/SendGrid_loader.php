<?php

define("ROOT_DIR", __dir__ . DIRECTORY_SEPARATOR);

function sendGridLoader($string)
{
  if ($string == 'SendGrid' || stripos($string, 'SendGrid\\') === 0)
  {
    $file = str_replace('\\', '/', "$string.php");
    var_dump( ROOT_DIR . $file);exit; 
    include_once ROOT_DIR . $file;
  }
}

spl_autoload_register("sendGridLoader");
