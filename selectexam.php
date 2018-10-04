<?php
include('connect.php');
$selectInterview = "SELECT * from tbl_examresult";
		$resultI = $conn->query($selectInterview);
			while ($row = $resultI->fetch_assoc()) {
				
					echo $row['ReferenceCode'].'Fullname'.$row['Fullname'].'Position'.$row['Position'].'Date Taken'.$row['DateTaken'].'ExamName'.$row['ExamName'].'TestScore'.$row['TestScore'].'TestTotal'.$row['TestTotal'];
				}
				?>