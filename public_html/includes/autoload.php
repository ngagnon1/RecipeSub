<?php

error_reporting( E_ALL );

require_once( $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php' );

spl_autoload_register(function ($class_name) {
  $fname = "{$_SERVER['DOCUMENT_ROOT']}/includes/$class_name.php";
  if( file_exists($fname) )
    require_once $fname;
});
