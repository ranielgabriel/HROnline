<?php 
	session_start();
	include('connect.php');
	if(isset($_POST['ivalid'])){
		echo "58.69.5.74";
	}
	if(isset($_POST['validate'])){
		$app = $_POST['applicantId'];
		$mail_status = "UPDATE tbl_application SET `email_status` = '1' WHERE `ID` = '$app'";
	   	$conn->query($mail_status);
	}

//filter start
	if (isset($_POST['ajaxprovince'])) {
		$id = $_POST['rid'];

		$returnthis = "";

		$sql = "SELECT * FROM tbl_prov WHERE Region_id = '$id'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$province = utf8_encode($row['Province_name']);
			echo "<option value='".$row['ID']."_".$row['Province_name']."'>".$province."</option>";
		}
	}
	
/*--START--*/
	if (isset($_POST['ajaxcities'])) {
		$id = $_POST['pid'];
		$returnthis = "";

		$sql = "SELECT * FROM tbl_cities WHERE prov_id = '$id' AND reg_id='0'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$cities = utf8_encode($row['Cities']);
			echo "<option value='".$cities."'>".$cities."</option>";
		}
	}

	if (isset($_POST['ajaxmanila'])) {
		//$id = $_POST['rid'];
		$returnthis = "";

		$sql = "SELECT * FROM tbl_cities WHERE Provinces='Metro Manila (NCR)'";
		//$sql = "SELECT Cities FROM `tbl_cities` INNER JOIN `tbl_region` ON tbl_cities.reg_id=tbl_region.id";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$cities2 = utf8_encode($row['Cities']);
			echo "<option value='".$cities2."'>".$cities2."</option>";
		}
	}
/*--END--*/
//end of filter

	if(isset($_GET['email'])){
		$email = $_GET['email'];
		$sql = "SELECT * FROM tbl_application WHERE `EMAIL ADDRESS` = '$email' and `EMAIL ADDRESS` <>''";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			echo "Email already taken!";
		}		
	}
	
	if(isset($_GET['updateemail'])){
		$uemail = $_GET['updateemail'];
		$refer = $_GET['refer'];
		$sql = "SELECT * FROM tbl_application WHERE `REFERENCE_NO` = '$refer'";
		$result = $conn->query($sql);
		$Ecount=0;
		while($row4 = $result->fetch_assoc()) {
			if($row4['EMAIL ADDRESS'] == $uemail){
				echo'email';
				$Ecount++;
			}
		}
		if($Ecount==0){
			$usql = "SELECT * FROM tbl_application WHERE `EMAIL ADDRESS` = '$uemail'";
			$result = $conn->query($usql);
				if($result->num_rows > 0){
				echo "Email already taken!";
			}	
		}
	
	}
	if(isset($_GET['agree'])){
		$_SESSION['newapp'] = $_GET['agree'];
	}
	
?>