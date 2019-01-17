<?php

require 'vendor/autoload.php';
if (file_exists(__DIR__ . '.env')) {
	$dotenv = Dotenv\Dotenv::create(__DIR__);
	$dotenv->load();
}

$db_username = getenv("DB_USER");
$db_password = getenv("DB_PASS");
$db_name = getenv("DB_NAME");
$db_host = getenv("DB_HOST");
$db_port = getenv("DB_PORT");
$sleep = getenv("SLEEP_TIME") ?: 0;
$fidelity = getenv("FIDELITY") ?: "high";

$pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_username, $db_password);


function query ($stm) {
	$pdo =  $GLOBALS["pdo"];
	$result = $pdo->query($stm);
	if (!$result) {
		die("Execute query error, because: ". print_r($pdo->errorInfo(), true));
	}
	return $result;
}

?>