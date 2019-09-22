<?php ob_start();

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "knowledgesheer";

// $db['db_host'] = "localhost";
// $db['db_user'] = "knowpkqm_knowledgesheer";
// $db['db_pass'] = "Ashwin@123";
// $db['db_name'] = "knowpkqm_knowledgesheer";

foreach($db as $key => $value){
	define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);

$query = "SET NAMES utf8";
mysqli_query($connection,$query);

?>