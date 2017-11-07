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
  d($crawler);
  exit;
}




echo 'ff';
