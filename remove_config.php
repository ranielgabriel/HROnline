<?php
include('connect.php');

	$id = $_POST['id'];

	$del_annc = "UPDATE tbl_position SET status = '0'  WHERE id = '".$id."' ";
	$result = $conn->query($del_annc);
	if ($result == true) {
		echo "Position Has been remove!";
	}
	else {
		echo "Cannot remove position!";
	}
?>