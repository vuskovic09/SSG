<?php
	try {
		$pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "Connected";
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>
