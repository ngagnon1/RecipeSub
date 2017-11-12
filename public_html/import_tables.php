<?php
      require_once "includes/autoload.php"; 
$handle = fopen( "grocery_data/train_sample1.csv", "r" );

$line = fgetcsv($handle);

d($handle,$line);

//$data=file_get_lines("grocery_data/train_sample1.csv");


