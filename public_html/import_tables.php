<?php
      require_once "includes/autoload.php"; 
$handle = fopen( "grocery_data/train_sample1.csv", "r" );

$line = fgetcsv($handle);


$out = array();
$pdo = DbConn::getPdo();
$cnt = 0;
while( $line = fgetcsv($handle) ){
  if( $cnt++ > 0 ){
    $line[1] = "\"".date('Y-m-d',strtotime($line[1]))."\"";
    foreach( $line as &$l ){
      $l = $l == ""? "NULL": $l;
    }
    $out[] = implode( ", ", $line );
  }
  if( count($out) > 1000 ){
    $sql = "INSERT INTO train_sample1 ( ".implode( "),(", $out ).")";
    d($sql);
    exit;
    $pdo->query($sql)->execute();
  }
}


//$data=file_get_lines("grocery_data/train_sample1.csv");


