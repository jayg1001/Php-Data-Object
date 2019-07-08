
<?php

include('connection.php');
$con = $database->databaseConnection();

// 	$host = "localhost";
// 	$db_name = "pdo";
// 	$username = "root";
// 	$password ="";
	
// $con = new PDO ("mysql:host=". $host. ";dbname=" . $db_name,$username, $password);
// echo "<pre>";
// print_r($database->databaseConnection());
// exit;
//$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  $sql = "SELECT * FROM registration";
// foreach ($con->query($sql) as $row)
//     {
//     	print_r($row);
//     // echo $row["collection_brand"] ." - ". $row["collection_year"] ."<br/>";
//     }

// echo "<pre>";
// print_r($con);
// exit;
// 			$con->exec("set name utf8");
if (isset($_REQUEST['submit']))
{
 	$filename = $_FILES['image']['name'];
 	$file_tmp_name = $_FILES['image']['tmp_name'];
 	// echo "<pre>"; 	
 	// print_r($filetmpname);

 	//move_uploaded_file($_FILES['image']['tmp_name'], "Uplode/".$filename);
 	move_uploaded_file($file_tmp_name, "Upload/".$filename);
 	
 	// echo "<pre>";
 	// print_r($_FILES);
 	//exit;

	

	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$contact = $_REQUEST['contact'];
	$image =$filename;


	   $ins = "INSERT INTO registration(name,email,password,contact,image)values(?,?,?,?,?)";
	  // echo "<pre>";
	  // print_r($database->con);
	$data = $stmt = $con->prepare($ins);
	// echo "<pre>";
	// print_r($data);

	$res =  $stmt->execute(array($name,$email,$password,$contact,$image));
	// $data = $stmt->excute(array($name,$email,$password,$contact));
	// echo "<pre>";
	// print_r($res);
	if ($res) {
		
		?>
		<script type="text/javascript">
			alert('Successfully inserted');
			window.location.href ='login.php';
		</script>
		<?php
	}else{
		echo "Error";
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
	<form method="post" enctype="multipart/form-data">
		<table  border="1" align="center" cellpadding="1" cellspacing="1">
			<tr>
				<td>Name</td>
				<td><input type="text" onblur="requiredfill(this.value,'name')" name=" name"><span id="name"></span></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" onblur="requiredfill(this.value,'email')" name="email"><span id="email"></td>
			</tr>
			<tr>
				<td>Paaword</td>
				<td><input type="password" onblur="requiredfill(this.value,'password')"name="password"><span id="password"></td>
			</tr>
			<tr>
				<td>Contact</td>
				<td><input type="text" onblur="requiredfill(this.value,'contact')" name="contact"><span id="contact"></td>
			</tr>
			<tr>
				<td>Image</td>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				
				<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <script type="text/javascript">
	function requiredfill(e,id)
	{
		// console.log();
		// alert(e);
		if (e == '') {
			$("#"+id).text('Filed is Required' );
		}else{
			$("#"+id).text('');
		}
	}



</script>