<?php  
	
	include("auth.php");
	include("connect.php");
	$table = $_POST['table'];

	$sql = 'SELECT DATE_FORMAT(`Timestamp`, \'%Y-%m-%d %H:%i\') as \'recent\' FROM '.$table.' GROUP BY `Timestamp` HAVING COUNT(0) >= 20 ORDER BY `Timestamp` DESC LIMIT 1';
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	//$sql2 = 'SELECT * FROM '.$table.' WHERE DATE_FORMAT(`Timestamp`, \'%Y-%m-%d %H:%i\') = \''.$row['recent'].'\'';
	$sql2 = 'SELECT *, DATEDIFF(`Timestamp`, CURRENT_DATE()) as \'days_passed\' FROM '.$table.' AND DATE_FORMAT(`Timestamp`, \'%Y-%m-%d %H:%i\') = \''.$row['recent'].'\'';
	$result2 = $conn->query($sql2);
	$row2 = $result->fetch_assoc();
	
	$sql3 = 'DELETE FROM '.$table.' AND DATE_FORMAT(`Timestamp`, \'%Y-%m-%d %H:%i\') = \''.$row['recent'].'\'';
	$result3 = $conn->query($sql3);
	if(!$result3){
		echo  "Something went wrong! " . mysqli_error($conn);
	}
	else{
		echo mysqli_affected_rows($conn)." rows deleted ";
	}

?>