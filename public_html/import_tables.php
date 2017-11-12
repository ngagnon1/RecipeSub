<?php
      require_once "includes/autoload.php"; 
$handle = fopen( "grocery_data/train_sample1.csv", "r" );

$line = fgetcsv($handle);


$out = array();
while( $line = fgetcsv($handle) ){
  if( $cnt++ > 0 ){
    d($handle,$line);
    exit;
  }
}


//$data=file_get_lines("grocery_data/train_sample1.csv");


