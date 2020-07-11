<?php
if (isset($_SESSION['admin']))
	header("Location: admin/");

if (!isset($_SESSION['admin']))
	header("Location: ./login.php");

if (isset($_GET['logout'])) {
	session_start();
	unset($_SESSION['admin']);
	session_unset();
	session_destroy();
	header("Location: ./login.php");
}

exit;
?>