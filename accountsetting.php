<?php
	include("auth.php");
	include("connect.php");
	$id = $_SESSION['id'];
	if(isset($_POST['isset'])){
		$message = mysqli_real_escape_string($conn, $_POST['message']);
		$subject = mysqli_real_escape_string($conn, $_POST['subject']);

		$sql = "UPDATE tbl_admin SET email_subject = '$subject', email_message = '$message' WHERE id = '$id'";
		if ($conn->query($sql) === TRUE) {
			$_SESSION['email_message'] = $message;
			$_SESSION['email_subject'] = $subject;
		    echo "Email setting saved!";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}
	elseif(isset($_POST['accountupdate'])){
	  $newusername = mysqli_real_escape_string($conn, $_POST['newusername']);
	  $newpassword =  md5($_POST['newpassword']);
	  $newemail = mysqli_real_escape_string($conn, $_POST['newemail']);
	  $newemailpassword = md5($_POST['newemailpassword']);

	  $newFirstName = mysqli_real_escape_string($conn, $_POST['newFirstName']);
	  $newMiddleName = mysqli_real_escape_string($conn, $_POST['newMiddleName']);
	  $newLastName = mysqli_real_escape_string($conn, $_POST['newLastName']);

	  $sql = "UPDATE tbl_admin SET username = '$newusername', password = '$newpassword', email = '$newemail', email_password = '$newemailpassword' , firstname = '$newFirstName', middlename = '$newMiddleName', lastname = '$newLastName' WHERE id = '$id'";
		if($conn->query($sql) === TRUE){
			echo "Account updated successfully!";
		}
		else{
			echo "Error updating record: " . $conn->error;
		}
	}

	$conn->close();
?>