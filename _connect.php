<?php
    $u="mateus_root";
	$p="12345679";
    $s="localhost";
	$db="cdpadilla";
	$conn = new mysqli($s, $u, $p, $db) or die('No database connection.');
	mysqli_set_charset($conn, "utf8");
	if ($conn->connect_errno) {
		printf("Connect failed: " . $conn->connect_error);
		exit();
	}
	/*$db="mysql:dbname=cdpadilla;host=localhost";
	try {
		$conn = new PDO($db, $u, $p);
		mysqli_set_charset($conn, "utf8");
	} catch (PDOException $e) {
		printf("Connection failed: " . $e->getMessage());
		exit();
	}*/
?>