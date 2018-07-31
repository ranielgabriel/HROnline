<?php  
	include('connect.php');
	include('auth.php');
	$options = [
	    'cost' => 11,
	];

	$sql = "SELECT * FROM tbl_admin WHERE id = '2'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$hash = password_hash($row['password'], PASSWORD_DEFAULT);
		}
	}
	
	$sql = "UPDATE tbl_admin SET password = '$hash' WHERE id = '2'";

	if ($conn->query($sql) === TRUE) {
	    header('location: adminloginpage.php');
	} else {
	    echo "Error updating record: " . $conn->error;
	}
?>