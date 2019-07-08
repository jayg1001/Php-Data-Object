<?php
session_start();
include('connection.php');
$con = $database->databaseConnection();
// echo "<pre>";
// print_r($_SESSION['email']);

if (isset($_SESSION['UserData'])) {
	session_destroy();
	header('location:login.php');
}
?>