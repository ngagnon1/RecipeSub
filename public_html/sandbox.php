<?php

require_once "includes/autoload.php"; 

echo 'hi 3';

$pdo = DbConn::getPdo();

$sql = "SELECT * FROM EatingWellRecipeIngredient LIMIT 1000";

$fetcher  = $pdo->query($sql);

$cnt = 0;
$measurements = array();
$out = array();
while( $r = $fetcher->fetch() ){
  $pattern = '/^[0-9]+\s+([\w\-]+)(.*)/';
  if( preg_match( $pattern, $r['IngredientText'] ) ){
    $measurement = preg_replace( $pattern, '$1', $r['IngredientText'] );
    $remainder = preg_replace( $pattern, '$2', $r['IngredientText'] );
    if( !in_array($measurement,$measurements) ){
      $measurements[] = $measurement;
      $out[] = array(
        "original" => $r['IngredientText'],
        "extract" => $measurement,
        "remainder" => $remainder,
      );
      $insert_q = $pdo->prepare( "INSERT INTO EatingWellRecipeIngredientTmpa ( EatingWellRecipeIngredientId, PartA, PartB, PartC ) VALUES ( ?, ?, ? )" );
      $insert_q->execute( $r['EatingWellRecipeIngredientId'], $r['IngredientText'], $measurement, $remainder );
    }
  }
}
d($out);
d($measurements);
