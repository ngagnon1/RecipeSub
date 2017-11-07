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
$recipes_q = $pdo->prepare("SELECT * FROM EatingWellRecipe WHERE RecipeName IS NULL");

while( $row = $recipes_q->fetch() ){
  d($row);
  exit;
  $statement = $pdo->prepare("SELECT * FROM EatingWellRecipe WHERE RecipeNumber=?");
  $recipe_id = 261291+$i;
  $statement->execute([$recipe_id]);
  $existing = $statement->fetch();
  if( !$existing ){
    $url = "http://www.eatingwell.com/recipe/$recipe_id";
    $crawler = $client->request('GET', $url);

    $ingredients = array();
    $title = "";
    $crawler->filter('h3[itemprop="name"]')->each(function ($node) {
      global $title;
      $title = $node->html();
    });
    $crawler->filter('span[itemprop="ingredients"]')->each(function ($node) {
      global $ingredients;
      $ingredients[] = $node->html();
    });

    $r_q = $pdo->prepare( "INSERT INTO EatingWellRecipe (RecipeNumber,RecipeName,Url) VALUES (?,?,?)" );
    $r_q->execute([$recipe_id,$title,$url]);
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
