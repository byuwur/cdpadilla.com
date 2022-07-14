<?php
$u = "root";
$p = "12345679";
$p = "12345679";
$s = "localhost";
$db = "cdpadilla";
$conn = new mysqli($s, $u, $p, $db) or die('No database connection.');
mysqli_set_charset($conn, "utf8");
if ($conn->connect_errno) {
	printf("Connect failed: " . $conn->connect_error);
	exit();
}
?>