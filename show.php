<?php
include('connection.php');
$con = $database->databaseConnection();
$sel = "SELECT * FROM registration";
 $stmt = $con->prepare($sel);
$data = $stmt->execute();
$row = $stmt->rowCount();
// echo "<pre>";
// print_r($row);
if ($row > 0) {
	while ($res = $stmt->fetch(PDO::FETCH_OBJ)){
		// print_r($res);
		$FetchData[]= $res;
	}

// echo "<pre>";
// print_r($FetchData);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
		
</head>
<body>
	<h1 align="center">Show</h1>
	<table border="1" cellpadding="1" cellspacing="1" align="center">
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Password</th>
		<th>Contact</th>
		<th>Image</th>
		<th colspan="2">Action</th>
		</tr>
		<?php

  foreach ($FetchData as $value) {?>
  	
 
    <tr>
      <td><?php echo $value->name; ?> </td>
      <td><?php echo $value->email; ?> </td>
      <td><?php echo $value->password; ?> </td>
      <td><?php echo $value->contact; ?> </td>
      <td ><img src="Upload/<?php echo $value->image;?>"style="width: 50px;height: 50px;"></td>
      <td><a href="edit.php?editid=<?php echo $value->id; ?>">Edit</td>
      	<td><a href="delete.php?delid=<?php echo $value->id; ?>">Delete</td>
        
    </tr>
    <?php
    
     }
  ?>
		
	</table>
</body>
</html>