<?php
	//ALLOWED
	include 'connect.php';
		$position = $_POST['position'];
		$description = $_POST['description'];


		$sqlSelect = "SELECT * FROM tbl_position WHERE position_name = '".$position."'";
		$result = $conn->query($sqlSelect);
		$row = $result->fetch_assoc();
		if ($_POST['position']==$row['position_name']) {
			echo "Position already exist";
		}
		else{
		$sql = "INSERT INTO tbl_position (position_name, position_desc, status) VALUES ('".$position."','".$description."','1')"; 
		$res = $conn->query($sql); 
		if ($res==true){
			echo "New Position Added";
			} 
		else { 
			echo "Failed to Add new Position";
			}
		}
?>