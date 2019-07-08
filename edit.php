<?php
include('connection.php');
$con = $database->databaseConnection();

 $id = $_REQUEST['editid'];
// print_r($where);
//  echo "<pre>";
// print_r($id);

 echo  $selwhere = "SELECT * FROM registration WHERE id ='$id' "; 
$stmt = $con->prepare($selwhere);
$data = $stmt->execute();
// echo "<pre>";
// print_r($data);
while ($res = $stmt->fetch(PDO::FETCH_OBJ)) {
	$FetchData[]= $res;
	// echo "<pre>";
	// print_r($FetchData);

}

if (isset($_REQUEST['update']))

 {
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$contact = $_REQUEST['contact'];
	if (isset($_REQUEST['update'])) 
	{
		// echo "hi";
			$filename = $_FILES['image']['name'];
			// echo "<pre>";
			// print_r($filename);
			// print_r($_FILES['image']['error']);
		if ($filename && $_FILES['image']['error'] == 0) 
		{
			//echo "hii";
 			$file_tmp_name = $_FILES['image']['tmp_name'];
 			move_uploaded_file($file_tmp_name, "Upload/".$filename);
		}else{
			$filename = $_REQUEST['image_hidden'];
		}
	}
	$image= $filename;

	// $filename = $_FILES['image']['name'];
 // 	$file_tmp_name = $_FILES['image']['tmp_name'];
 // 	// echo "<pre>"; 	
 // 	// print_r($filetmpname);

 // 	//move_uploaded_file($_FILES['image']['tmp_name'], "Uplode/".$filename);
 // 	move_uploaded_file($file_tmp_name, "Upload/".$filename);

	//$upd = "UPDATE registration SET name = :name,email=:email,password=:password,contact=:contact WHERE id = '$id'";
 $upd = "UPDATE registration SET name = ?,email=?,password=?,contact=?,image=? WHERE id = '$id'";
	$stmt = $con->prepare($upd);
	// $stmt->bindParam(':name',$name);
	// $stmt->bindParam(':password',$password);
	// $stmt->bindParam(':email',$email);
	// $stmt->bindParam(':contact',$contact);
	// $res = $stmt->execute();
	if($stmt->execute(array($name,$email,$password,$contact,$image))){
		echo "Successfully updated Profile";
	}// End of if profile is ok 
	else{
		print_r($stmt->errorInfo()); // if any error is there it will be posted
		$msg="Error While Recored updated ";
	}
	// $con->$stmt->bindParam('name', $_REQUEST['name']);
 //    $con->    $stmt->bindParam('email', $_REQUEST['email']);
 //    $con->    $stmt->bindParam('password', $_REQUEST['password']);
 //    $con->    $stmt->bindParam('contact', $_REQUEST['contact']);     
	// $res = $stmt->execute();
	// echo "<pre>";
	// print_r($res);
	if ($stmt) {
		?>
		<script type="text/javascript">
			 alert('record updated');
			 window.location.href ='show.php';
		</script>
		<?php
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
				<td><input type="text" name=" name" value="<?php echo $FetchData[0]->name;?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" value="<?php echo $FetchData[0]->email;?>"></td>
			</tr>
			<tr>
				<td>Paaword</td>
				<td><input type="password" name="password" value="<?php echo $FetchData[0]->password;?>"></td>
			</tr>
			<tr>
				<td>Contact</td>
				<td><input type="text" name="contact" value="<?php echo $FetchData[0]->contact;?>"></td>
			</tr>
			<tr>
				<td>Image</td>
				<td><input type="file" name="image"></td>
				<td><input type="hidden" name="image_hidden" value="<?php echo $FetchData[0]->image;?>"></td>
			</tr>
			<tr>
				
				<td colspan="2" align="center"><input type="submit" name="update" value="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>