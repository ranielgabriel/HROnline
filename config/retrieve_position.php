<?php
include('connect.php');
	$id = $_POST['id'];

	$del_annc = "UPDATE tbl_position SET status = '1'  WHERE id = '".$id."' ";
	$result = $conn->query($del_annc);
	if ($result == true) {
		echo "Position has been retrieve!";
	}
	else {
		echo "Cannot retrieve position!";
	}
?>