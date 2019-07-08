<?php
session_start();
include('connection.php');
$con = $database->databaseConnection();

if (isset($_REQUEST['login'])) {
	$name = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	if (empty($name)||empty($password)) {
		$msg =  "Eroor Message";
	}else{

	
	
	$login = "SELECT * FROM registration WHERE email=? AND password=? ";
//echo 	$login ="SELECT * FROM registration WHERE password =? AND (email=? OR mobile=? OR name=?)";

	$stmt = $con->prepare($login);
	$data = $stmt->execute(array($name,$password));
	$res = $stmt->rowCount();
	$FetchData = $stmt->fetch(PDO::FETCH_OBJ);
	// echo "<pre>";
	// print_r($data);
	//exit;

	
	if ($res > 0) {
			// echo "<pre>";
			// print_r($res);
			 // print_r($_SESSION);

		$_SESSION['UserData']= $FetchData;	 
		$_SESSION['email']= $name;
		header('location:userpage.php');
	}

}

}

?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1 align="center">Registration</h1>
	<form method="post">
		<table  border="1" align="center" cellpadding="1" cellspacing="1">
			
			<tr>
				<td>Email</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>Paaword</td>
				<td><input type="password" name="password"></td>
			</tr>
			
			<tr>
				
				<td colspan="2" align="center"><input type="submit" name="login" value="Login"></td>
			</tr>
		</table>
	</form>
</body>
</html>