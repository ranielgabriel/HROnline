<?php
include('connect.php');

	$id = $_POST['id'];

	$sqlDelete = " UPDATE tbl_application_info SET status = '3', last_update = Now() WHERE reference_code = '".$id."' ";
	$result = $conn->query($sqlDelete);
	if ($result == true) {
		echo "Account has been removed!";
	}
	else {
		echo "An Error has occured!";
	}
?>