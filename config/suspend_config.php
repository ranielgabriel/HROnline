<?php
include('connect.php');

	$id = $_POST['id'];

	$sqlSuspend = " UPDATE tbl_application_info SET status = '2', last_update = Now() WHERE reference_code = '".$id."' ";
	$result = $conn->query($sqlSuspend);
	if ($result == true) {
		echo "Account has been Suspend";
	}
	else {
		echo "An Error has occured!";
	}
?>