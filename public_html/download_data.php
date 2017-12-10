<?php

require_once "includes/autoload.php"; 

set_time_limit(30*60);


$handle = fopen( "grocery_data/train_sample1.csv", "rw" );
d($handle);

exit;

$pdo = DbConn::getPdo();

$sql = "INSERT INTO train_sample1 VALUES ( ".implode( "),(", $out ).")";

$handle = fopen( "grocery_data/train_sample1.csv", "r" );
