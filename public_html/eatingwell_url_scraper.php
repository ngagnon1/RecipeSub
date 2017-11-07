<?php

require_once( $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php' );

use Goutte\Client;

$client = new Client();
$gzl = new GuzzleHttp\Client( array(
  'curl' => array(
    CURLOPT_SSL_VERIFYPEER => false,
  ),
) );
$client->setClient($gzl);

for( $i=0; $i< 100; $i++ ){
  $recipe_id = 261291+$i;
  $crawler = $client->request('GET', "/http://www.eatingwell.com/recipe/$recipe_id");

  $ingredients = array();
  $crawler->filter('span[itemprop="ingredients"]')->each(function ($node) {
    global $ingredients;
    $ingredients[] = $node->html();
  });
  d($ingredients);
  
  d($crawler
    $crawler->html()
  );
  exit;
}




echo 'ff';
