<?php

require_once "includes/autoload.php"; 

set_time_limit(30*60);

$handle = fopen( "grocery_data/groc_df_v.csv", "a" );

$pdo = DbConn::getPdo();

$offset = $_REQUEST['offset'];

$sql = "SELECT * FROM Groc_df_v LIMIT $offset, 9000";

$fetcher  = $pdo->query($sql);


while( $r = $fetcher->fetch() ){
  fputcsv( $handle, $r );
}
echo "done!";
