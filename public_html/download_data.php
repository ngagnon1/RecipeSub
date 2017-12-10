<?php

require_once "includes/autoload.php"; 

set_time_limit(30*60);

$handle = fopen( "grocery_data/grocdbkitten.csv", "rw" );

$pdo = DbConn::getPdo();

$offset = $_REQUEST['offset'];

$sql = "SELECT * FROM Groc_db_v LIMIT $offset, 100";

$pdo->query($sql)->execute();

