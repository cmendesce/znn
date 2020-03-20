<?php

$db_username = getenv("DB_USER") ?: "root";
$db_password = getenv("DB_PASS");
$db_name = getenv("DB_NAME");
$db_host = getenv("DB_HOST");
$db_port = getenv("DB_PORT") ?: 3306;
$fidelity = getenv("FIDELITY") ?: "high";

$conn = "mysql:host=$db_host;port=$db_port;dbname=$db_name";
$pdo = new PDO($conn, $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function query ($stm) {
	$pdo =  $GLOBALS["pdo"];
	$result = $pdo->query($stm);
	if (!$result) {
		echo("connection info: $conn user: $db_username pass: $db_password");
		die("Execute query error, because: ". print_r($pdo->errorInfo(), true));
	}
	return $result;
}

function resolve_fidelity() {
	$fidelity = getenv("FIDELITY") ?: "high";
	return $fidelity;
}

?>