<?php

require_once "includes/autoload.php"; 

set_time_limit(30*60);

$handle = fopen( "grocery_data/groc_df_v.csv", "a" );

$pdo = DbConn::getPdo();

$offset = $_REQUEST['offset'];

$sql = "SELECT * FROM Groc_df_v LIMIT $offset, 100";

$fetcher  = $pdo->query($sql);


while( $r = $fetcher->fetch() ){
  fputcsv( $handle, $r );
}
d(
  $fetcher->fetchAll()
  ,file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/grocery_data/groc_df_v.csv' )
);
