<?php
function connectDB() {
	$dbHost = "localhost";
	$dbPort = "3306";
	$dbUser = "admin";
	$dbPass = "admin";
	$dbName = "citsdb";
	//Create Connection
	static $pdo;

	if (!$pdo) {

		$dsn = "mysql:host=$dbHost;dbname=$dbName;port=$dbPort";
		$opt = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];
		$pdo = new PDO($dsn, $dbUser, $dbPass, $opt);
	}
	return $pdo;
}

?>