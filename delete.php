<?php
	include('auth.php');
	include('connect.php');
	/**/
	if(isset($_GET['id'])){/*Reject Application*/

		$_SESSION['container'] = 2;
		$id = $_GET['id'];

		$sql = "UPDATE tbl_applicant SET status='3' WHERE id='$id'";

		if ($conn->query($sql) === TRUE) {
		    header('location: adminside.php');
		} else {
		    echo "Error updating record: " . $conn->error;
		}
	}
	elseif(isset($_GET['idjs'])){/*Change job status*/

		$id = $_GET['idjs'];

		$check = $conn->query("SELECT status FROM tbl_position WHERE id = $id");

		if($check->num_rows > 0){
			while($row = $check->fetch_assoc()){
				$status = $row['status'];
			}
		}

		if($status == 1){
			$sql = "UPDATE tbl_position SET status='2' WHERE id='$id'";
		}
		elseif($status == 2){
			$sql = "UPDATE tbl_position SET status='1' WHERE id='$id'";
		}
		$result = $conn->query($sql);
		
	}
	elseif(isset($_GET['idj'])){/*Delete Job position*/

		$id = $_GET['idj'];

		$sql = "DELETE FROM tbl_position WHERE id = '$id'";

		if ($conn->query($sql) === TRUE) {
		    header('location: jobposition.php');
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}
	elseif(isset($_POST['editpos'])){/*Edit Position*/

		$id = $_POST['editposid'];
		$newname = $_POST['newposname'];
		$newdesc = $_POST['newposdesc'];
		
		$sql = "UPDATE tbl_position SET position_name = '$newname', position_desc = '$newdesc' WHERE id = '$id'";

		if ($conn->query($sql) === TRUE) {
		    header('location: jobposition.php');
		} else {
		    echo "Error adding record: " . $conn->error;
		}
		
	}
	elseif(isset($_POST['newpos'])){/*Add new Position*/

		$name = $_POST['posname'];
		$desc = $_POST['posdesc'];

		$sql = "INSERT INTO tbl_position (position_name, position_desc, status) VALUES ('$name','$desc','1')";

		if ($conn->query($sql) === TRUE) {
		    header('location: jobposition.php');
		} else {
		    echo "Error adding record: " . $conn->error;
		}
	}
	elseif(isset($_GET['perdel'])){/*Permanently delete Application*/
		
		$_SESSION['container'] = 3;
		$id = $_GET['perdel'];

		$sql = "DELETE FROM tbl_applicant WHERE id = '$id'";

		if ($conn->query($sql) === TRUE) {
		    header('location: adminside.php');
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}
	elseif(isset($_POST['sendemail'])){/*Send email*/
		/*PHPMAILER*/
		/*get admin account details | supply as sender*/
		ob_start();
		$id = $_SESSION['id'];
		include('connect.php');
		$sql = "SELECT * FROM tbl_admin WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->Host = 'relay-hosting.secureserver.net';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = "phrecruitment@andersongroup.uk.com";
		$mail->Password = "Password123";
		$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');
		$mail->addAddress($_POST['emailadd'], $_POST['appname']);   // Add a recipient
		//$mail->addCC($row['email']);//cc to sender
		//$mail->addBCC('bcc@example.com');

		$mail->isHTML(true);  // Set email format to HTML
		$mail->AddEmbeddedImage('ag.png', 'logo', 'ag.png');
		$bodyContent = "<img style='text-align:center;' src='cid:logo'></br>";
		$bodyContent .= '</br></br><p>'.$_POST['intmsg'].'</p>';

		$mail->Subject = $_POST['intsub'];
		$mail->Body    = $bodyContent;
		$mail->SMTPDebug = 1;

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			/*insert into tbl_emails*/
			/*from, id, msgs*/
			$source = $_POST['imfrom'];
			$appid = $_POST['appid'];
			$message = $_POST['intmsg'];
			$sql2 = "INSERT INTO tbl_emails (source, id, message) VALUES ('$source', '$appid', '$message')";
			$result2 = $conn->query($sql2);
			if($result){
				// if($source == "Indeed"){
					// header("location: indeed.php");
				// }
				// elseif($source == "Jobfair"){
			    	// header("location: jobfair.php");
				// }
				// elseif($source == "Application"){
					header("location: google.php");
				//}
			}
		}
		
		/*MANUAL EMAIL*/
			/*$email = $_POST['emailadd'];
			$message = "Interview Date: ".date("M d, Y", strtotime($_POST['intdate']))."%0D%0ATime: ".$_POST['inttime']."%0D%0A%0D%0A%0D%0A".$_POST['intmsg']."";
			$date = $_POST['intdate'];
			echo  "<script>window.open('adminside.php')</script>";
			echo '<meta http-equiv="refresh" content="0;url=mailto: '.$email.'?Subject=Anderson%20Recruitment&body='.$message.'">';
			echo "<script>setTimeout(window.close, 50);</script>";*/
		/**/
	}

?>