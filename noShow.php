<?php
	$updateSql = "update tbl_application set `Status`='No Show' where
	`Status` like '%Interview%' and DATE_FORMAT(`Schedule`, '%Y-%m-%d')=DATE_FORMAT(subdate(Now(), 1), '%Y-%m-%d')";
	$result = $conn->query($updateSql);
	if($result){

	}else{
		
	}
	
	
?>