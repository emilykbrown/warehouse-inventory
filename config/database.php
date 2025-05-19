<?php

$host = "localhost";
$dbName = "warehouse_inventory";
$userName = "root";
$password = "";

try {
	$con = new PDO("mysql:host={$host};dbname={$dbName}",$userName,$password);
    // echo "Connection good";
}

catch(PDOException $e) {
	echo "Connection error: ".$e->getMessage();
}


?>