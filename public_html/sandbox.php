<?php

require_once "includes/autoload.php"; 

echo 'hi 3';

$pdo = DbConn::getPdo();

$sql = "SELECT * FROM EatingWellRecipeIngredient LIMIT 1000";

$fetcher  = $pdo->query($sql);

$cnt = 0;
$measurements = array();
while( $r = $fetcher->fetch() ){
  $pattern = '/^[0-9]+\s+([\w\-]+).*/';
  if( preg_match( $pattern, $r['IngredientText'] ) ){
    $measurement = preg_replace( $pattern, '$1', $r['IngredientText'] );
    if( !in_array($measurements,$measurement) ){
      $measurements[] = $measurement;
    }
  }
}
d($measurements);
