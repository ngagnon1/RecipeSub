<?php

require_once "includes/autoload.php"; 

set_time_limit(30*60);

$handle = fopen( "grocery_data/grocdbkitten.csv", "w" );

$pdo = DbConn::getPdo();

$offset = $_REQUEST['offset'];

$sql = "SELECT * FROM Groc_df_v LIMIT $offset, 100";

$fetcher  = $pdo->query($sql);

d($fetcher->fetchAll());
