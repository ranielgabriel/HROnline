<?php
include('connect.php');

	$id = $_POST['id'];
	$pos = $_POST['pos'];
	$des = $_POST['des'];

	$sqlUpdate ="UPDATE tbl_position SET `position_name` = '".$pos."',`position_desc` = '".$des."'   WHERE `id` = '".$id."' ";
	$result = $conn->query($sqlUpdate);
	if ($result == true) {
		echo "Position has been changed!";
	}
	else {
		echo "An Error has occured!";
	}
?>