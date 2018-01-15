<?php

require_once "includes/autoload.php"; 

echo 'hi 3';

$pdo = DbConn::getPdo();

$sql = "SELECT * FROM EatingWellRecipeIngredientTmpa WHERE PartB IS NULL LIMIT 1000";

$fetcher  = $pdo->query($sql);

$out = array();
while( $r = $fetcher->fetch() ){
  $new = preg_replace( '/[^A-Z0-9 ]/', ' ', $r['PartA'] );
  $out = array(
    "orig" => $r['IngredientText'],
    "new" => $new,
  );
}
d($out);
exit;

$cnt = 0;
$measurements = array();
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
      $insert_q = $pdo->prepare( "INSERT INTO EatingWellRecipeIngredientTmpa ( EatingWellRecipeIngredientId, PartA, PartB, PartC ) VALUES ( ?, ?, ?, ? )" );
      $insert_q->execute( array( $r['EatingWellRecipeIngredientId'], $r['IngredientText'], $measurement, $remainder ) );
    }
  }
}
d($out);
d($measurements);
