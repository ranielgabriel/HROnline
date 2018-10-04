<?php  
  session_save_path('tmp');
  include('connect.php');
  	
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);
	$role=  mysqli_real_escape_string($conn,$_POST['role']);
	date_default_timezone_set("Singapore");
	$date = date("Y-m-d h:i:sa");
	$sql = "SELECT * FROM tbl_admin WHERE username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$_SESSION["role"] = $row["role"];
	$roleUser = $row["role"];
	if ($roleUser == 'Admin'){
		$userRole = "HR";
	}else{
		$userRole = "User";
	}
	$hashed = $row['password'];//DB PASSWORD

	$user = $_POST['username'];

  if (md5($password) == $hashed) {
	if($_SESSION["role"]=="Admin"){
		session_save_path('tmp');
		session_start();
		$_SESSION['admin'] = "administrator";
		$_SESSION['id'] = $row['id'];
		$_SESSION['email_message'] = $row['email_message'];
		$_SESSION['email_subject'] = $row['email_subject'];
		
		unset($_SESSION['loginattempt']);
		unset($_SESSION['loginerror']);
		$_SESSION['loginattempt'] = 0;
		$insertLogs = "INSERT INTO tbl_userlogs (username, loggedInDate, role) VALUES ('$user','$date','$userRole')";
		$resultLogs = $conn->query($insertLogs);
		$selectLog = "SELECT * FROM tbl_userlogs WHERE loggedInDate = '$date'";
		$resLog = $conn->query($selectLog);
		while($row = $resLog->fetch_assoc()){
			$logId = $row['log_id'];
		}
		
		header("location:google.php?id=$logId");
	}else{
		session_save_path('tmp');
		session_start();
		$_SESSION['admin'] = "administrator";
		$_SESSION['id'] = $row['id'];
		$_SESSION['email_message'] = $row['email_message'];
		$_SESSION['email_subject'] = $row['email_subject'];
		
		unset($_SESSION['loginattempt']);
		unset($_SESSION['loginerror']);
		$_SESSION['loginattempt'] = 0;
		$insertLogs = "INSERT INTO tbl_userlogs (username, loggedInDate, role) VALUES ('$user','$date','$userRole')";
		$resultLogs = $conn->query($insertLogs);
		header('location:reportsMarketing.php');
	}
	
  }
  else{
    session_save_path('tmp');
    session_start();
    $_SESSION['loginerror'] = "Incorrect username or password!";
	
    $_SESSION['loginattempt'] += 1;
    header('location: adminloginpage.php');
	
  }
  
	
  
  $conn->close();
    
	
?>