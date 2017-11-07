<?php

require_once( $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php' );

use Goutte\Client;

$pdo = DbConn::getPdo();

$client = new Client();
$gzl = new GuzzleHttp\Client( array(
  'curl' => array(
    CURLOPT_SSL_VERIFYPEER => false,
  ),
) );
$client->setClient($gzl);

for( $i=0; $i< 100; $i++ ){
  $statement = $pdo->prepare("SELECT * FROM EatingWellRecipe WHERE PageNumber=?");
  $page_id = $i;
  $statement->execute([$page_id]);
  $existing = $statement->fetch();
  if( !$existing ){
    $url = "http://www.eatingwell.com/recipes/?page=$page_id";
    $crawler = $client->request('GET', $url);
    $urls = array();
    $crawler->filter('a[data-internal-referrer-link="recipe hub"]')->each(function ($node) {
      $url = $node->attr("href");
      $id_pattern = '/.*\/recipe\/([0-9]+).*/';
      if( preg_match( $id_pattern, $url ) ){
        $id = preg_replace( $id_pattern, '$1', $url );
        d($url,$id);
        exit;
      } 
    });

    exit;

    $r_q = $pdo->prepare( "INSERT INTO EatingWellRecipe (RecipeNumber,RecipeName,Url) VALUES (?,?,?)" );
    $r_q->execute([$page_id,$title,$url]);
    $r_id = $pdo->lastInsertId();
    $i_q = $pdo->prepare( "INSERT INTO EatingWellRecipeIngredient (EatingWellRecipeId,IngredientText) VALUES (?,?)" );
    if( count($ingredients) ){
      foreach( $ingredients as $i ){
        $i_q->execute([(int)$r_id,$i]);
      }
    }
  }
}




echo 'ff';
