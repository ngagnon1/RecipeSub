<?php

require_once "includes/autoload.php"; 

echo 'hi 3';

$pdo = DbConn::getPdo();

$sql = "SELECT * FROM Groc_df_v LIMIT 10";

$fetcher  = $pdo->query($sql);

$cnt = 0;
while( $r = $fetcher->fetch() ){
  echo implode( ', ', $r )."<br/>";
}
