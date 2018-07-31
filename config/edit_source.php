<?php
include('connect.php');

	$id = $_POST['id'];
	$newApp = $_POST['newApp'];

	$sqlUpdate ="UPDATE tbl_sourceapplication SET source_name = '".$newApp."' WHERE application_num = '".$id."' ";
	$result = $conn->query($sqlUpdate);
	if ($result == true) {
		echo "Application source has been changed!";
	}
	else {
		echo "An Error has occured!";
	}
?>