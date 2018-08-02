<?php
require 'PHPMailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$ref = $_POST['ref'];
$concat = "";
//$email = $_POST['email'];
include('connect.php');
$select_ref = "select * from tbl_application where reference_no = '$ref'";
$result = $conn->query($select_ref);
	while ($row = $result->fetch_assoc()) {
	 if($row["email_status"]==1){
		if($row["hr_email"]==0){
			$email='phrecruitment@andersongroup.uk.com';
			$concat= "&&iNt3RvIs3w3r";
			$mail_hr = "update tbl_application set `hr_email` = '1' where `reference_no` = '$ref'";
			$conn->query($mail_hr);
		}
	}else{
		$concat = "";
		$email=$_POST['email'];//'phrecruitment@andersongroup.uk.com'; //
		$mail_status = "update tbl_application set `email_status` = '1' where `reference_no` = '$ref'";
		$conn->query($mail_status);
	}
 }
$result->free();
		
$mail = new PHPMailer;
$mail->Host = 'relay-hosting.secureserver.net';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "phrecruitment@andersongroup.uk.com";
$mail->Password = "Password123";
$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');
$mail->addReplyTo('no-reply@example.com');
$mail->addAddress($email);
$mail->isHTML(true);                                 
$mail->AddEmbeddedImage('aga.png', 'logo', 'aga.png');
$bodyContent = "<a href='http://andersongroup.ph'><img style='text-align:center;' src='cid:logo'></a></br><hr >";
$bodyContent .= '<br>';
$bodyContent .= '<p>Dear Candidate,</p>';
$bodyContent .= '<br>';
$bodyContent .= '<p>Thank you for your interest in working with Anderson Group Philippines.</p>';
$bodyContent .= '<p>Please wait for further instructions from our recruitment team.</p>';
$bodyContent .= '<p>Should you not hear from us within the next 10 working days, feel free</p>';
$bodyContent .= '<p>to contact us at 025565199 to follow up on your application.</p>';
$bodyContent .= '<p>For your reference, your application code is : <a href="" style="text-decoration:none;"><b>'.$ref.'</b></a></p>';
$bodyContent .= 'To manage your application click the following link: <br>
<a href="http://andersongroup.ph/application/update_resume_form.php?ref='.$ref.'"> http://andersongroup.ph/application/update_resume_form.php?ref='.$ref.'</a>';
$bodyContent .= '<br>';
$bodyContent .= '<p>Thank you and Goodluck</p>';
$bodyContent .= '<br>';
$bodyContent .= '<p>Anderson Group PH</p>';
$mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';
$mail->Body    = $bodyContent;
$mail->AltBody = 'Anderson';


if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	if(isset($_POST["hr"])){
		if($_POST["hr"]=="yes"){
			$mail_hr2 = "update tbl_application set `hr_email` = '1' where `reference_no` = '$ref'";
			$conn->query($mail_hr2);
			
			$mail = new PHPMailer;
			$mail->Host = 'relay-hosting.secureserver.net';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = "phrecruitment@andersongroup.uk.com";
			$mail->Password = "Password123";
			$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');
			$mail->addReplyTo('no-reply@example.com');
			$mail->addAddress("kenlopez123@yahoo.com");
			$mail->isHTML(true);                                 
			$mail->AddEmbeddedImage('aga.png', 'logo', 'aga.png');
			$bodyContent = "<a href='http://andersongroup.ph'><img style='text-align:center;' src='cid:logo'></a></br><hr >";
			$bodyContent .= '<br>';
			$bodyContent .= '<p>Dear Candidate,</p>';
			$bodyContent .= '<br>';
			$bodyContent .= '<p>Thank you for your interest in working with Anderson Group Philippines.</p>';
			$bodyContent .= '<p>Please wait for further instructions from our recruitment team.</p>';
			$bodyContent .= '<p>Should you not hear from us within the next 10 working days, feel free</p>';
			$bodyContent .= '<p>to contact us at 025565199 to follow up on your application.</p>';
			$bodyContent .= '<p>For your reference, your application code is : <a href="" style="text-decoration:none;"><b>'.$ref.'</b></a></p>';
			$bodyContent .= 'To manage your application click the following link: <br><a href="http://andersongroup.ph/application/update_resume_form.php?ref='.$ref.'">http://andersongroup.ph/application/update_resume_form.php?ref='.$ref.'</a>';
			$bodyContent .= '<br>';
			$bodyContent .= '<p>Thank you and Goodluck</p>';
			$bodyContent .= '<br>';
			$bodyContent .= '<p>Anderson Group PH</p>';
			$mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';
			$mail->Body    = $bodyContent;
			$mail->AltBody = 'Anderson';
   
		if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo"second message sent!";
}
	}
}
}?>