<?php
	require_once('auth.php');
	require_once('connect.php');
	if(isset($_POST['jsonsearch'])) {
		$name = $_POST['jsonsearch'];
		$string = '%'.$name.'%';
		$query = "SELECT ID, NAME, POSITION, `EMAIL ADDRESS` FROM tbl_application WHERE (NAME LIKE '$string' OR POSITION LIKE '$string' OR `EMAIL ADDRESS` LIKE '$string') AND NOT NAME=',' AND NOT `EMAIL ADDRESS`='' ORDER BY ID";
		$result = $conn->query($query);
		$jsonResult = [];
		while($row = $result->fetch_assoc()){
		    array_push($jsonResult, [
		      	'name'     => $row['NAME'],
		     	'position' => $row['POSITION'],
		      	'email'    => $row['EMAIL ADDRESS']
		    ]);
		}
		$showResult = json_encode($jsonResult);
		echo $showResult;
	}
?>