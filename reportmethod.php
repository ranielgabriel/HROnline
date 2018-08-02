<?php  
	include('auth.php');
	include('connect.php');

	$id = $_SESSION['id'];
	$loc1 = $_POST['locationarray'][0];
	$loc2 = $_POST['locationarray'][1];
	$loc3 = $_POST['locationarray'][2];
	$loc4 = $_POST['locationarray'][3];
	$loc5 = $_POST['locationarray'][4];
	
	$sql = "UPDATE tbl_admin SET Location1 = '$loc1', Location2 = '$loc2', Location3 = '$loc3', Location4 = '$loc4', Location5 = '$loc5' WHERE id = '$id'";
	$result = $conn->query($sql);
	
?>