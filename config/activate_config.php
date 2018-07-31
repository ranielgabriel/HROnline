<?php
include('connect.php');

	$id = $_POST['id'];

	$sqlDelete = " UPDATE tbl_application_info SET status = '1', last_update = Now() WHERE reference_code = '".$id."' ";
	$result = $conn->query($sqlDelete);
	if ($result == true) {
		echo " Account has been Activated";
	}
	else {
		echo "An Error has occured!";
	}
?>