<?php
session_start();
include('connect.php');
$cnt=0;
if(isset($_GET['ref_code']))
{
	$ref_num = mysqli_real_escape_string($conn,$_GET['ref_code']);
	$select_ref = "SELECT * from tbl_application";
	$result = $conn->query($select_ref);

		while ($row = $result->fetch_assoc()) {
			if($row["REFERENCE_NO"]==$ref_num)
			{	$cnt++;
				if($row['Status']=='Pending'||$row['Status']=='Unfinished'){
				$_SESSION['ref_number'] = $row["REFERENCE_NO"];
				Header("Location:update_resume_form.php?ref=".$row["REFERENCE_NO"]."");
				
				$_SESSION['refcode_not_found']='no';
				}
				$app_status = $row['Status'];
			}
			
			
		}
	$result->free();
	
	
	if($cnt==0){
		$_SESSION['refcode_not_found']='yes';
		header("Location:index.php");
		exit();
	}else if($app_status<>'Pending'&&$app_status<>'Unfinished'){
		$_SESSION['refcode_not_found']='submitted';
		header("Location:index.php");
		exit();
	}
}



?>
