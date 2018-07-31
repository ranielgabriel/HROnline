<?php  
	include('auth.php');
	include('connect.php');

	$id = $_POST['id'];
	$source = $_POST['source'];

	$sql = "SELECT * FROM tbl_emails WHERE `source` = '$source' AND `id` = '$id'";
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();

	$returnthis = "";
	while($row = $result->fetch_assoc()) {
		$returnthis .= "<blockquote><small class='text-muted'>Message:</small> ".$row['message']."</br>
		<small class='text-muted'>Sent on: ".date("F d, Y H:i", strtotime($row['timestamp']))."</small></blockquote><hr>";
	}

	echo $returnthis;
?>