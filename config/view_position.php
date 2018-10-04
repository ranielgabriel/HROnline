<?php
    // ALLOWED
	include('connect.php');
	
	$id_position = $_POST['id_position'];

	$sql = "SELECT `id`,`position_name`, `position_desc`  FROM tbl_position WHERE id = '".$id_position."' ";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$position = $row['position_name'];
		$description = $row['position_desc'];
		$id = $row['id'];

		$data = array('position_name' => $position,
					  'position_description' => $description,
					  'position_id' => $id
					);		
	}
		
	echo json_encode($data);

?>