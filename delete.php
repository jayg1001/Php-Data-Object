<?php
include('connection.php');
$con = $database->databaseConnection();
if (isset($_REQUEST['delid'])) {

	$id = $_REQUEST['delid'];

 $del = "DELETE FROM registration WHERE id='$id'";
$stmt = $con->prepare($del);
$res = $stmt->execute();
// echo "<pre>";
// print_r($res);
if ($res) {
	?>
	<script type="text/javascript">
		alert('Deleted Data');
		window.location.href='userpage.php';
	</script>
	<?php
}



}
?>