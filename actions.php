<?php  

	include('auth.php');

	include('connect.php');



	

	if(isset($_POST['hire'])){

		$sql2 = "UPDATE tbl_application SET `Schedule`='',`Note`='',   `Status` = 'Hired ".$_POST['department']."(".$_POST['position'].") ".$_POST['startDate']."'  , `Timestamp` = '".date('Y-m-d')."' , `Timestamp` = '".date('Y-m-d')."' WHERE id = '".$_POST['id']."' ";

		$result2 = $conn->query($sql2);

		if($result2){

			echo 'success';

		}else{

			echo "error on hire";

		}

	}else{
		
		$source = $_POST['source'];

		$id = $_POST['ids'];

		$type = $_POST['types'];//status

		$selSql = "select reference_no,name,`email address`  as email,(select position_name from tbl_position where id = tbl_application.position) as position from tbl_application where id in ($id)";

		$searchResult = $conn->query($selSql);

		$row = $searchResult->fetch_assoc();

		$userPass = $_POST['passUser'];

		$userAccount = $_POST['accountUser'];

		$interviewersAccount = $_POST['interviewerAccount'];

		

		$fname = $_POST["fname"];

		$lname = $_POST["lname"];

		$mname = $_POST["mname"];

		$state = $_POST['status'];

		if($type == 'Declined'){
			$reasonValue = $_POST['note'];

		}

		//for rejected applicant

		if($type != 'interview'){

			if($type == 'Rejected'){

				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				$mail->Host = 'relay-hosting.secureserver.net';
                
				$mail->Port = 587;

				$mail->SMTPSecure = 'tls';

				$mail->SMTPAuth = true;

				$mail->Username = "phrecruitment@andersongroup.uk.com";

				$mail->Password = "Password123";

				$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');

				$mail->addReplyTo('no-reply@example.com');

				$mail->addAddress($row['email']);

                $mail->isHTML(true);       
                // $mail = new PHPMailer;
                // // $mail->SMTPDebug = 1;
                // $mail->IsSMTP();
                // $mail->Host = 'smtp.gmail.com';
                // $mail->Port = 587;
                // $mail->SMTPSecure = 'tls';
                // $mail->SMTPAuth = true;
                // $mail->Username = "andersonhronline@gmail.com";
                // $mail->Password = "Password321";
                // $mail->SetFrom('phrecruitment@andersonbpoinc.com','Anderson Group PH');
                // $mail->AddReplyTo('no-reply@example.com');
                // $mail->AddAddress($row['email']);
                // $mail->IsHTML(true);                           

				$mail->AddEmbeddedImage('aga.png', 'logo', 'aga.png');

				$bodyContent = "<a href='http://andersonbpoinc.com'><img style='text-align:center;' src='cid:logo'></a></br><hr >";

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Dear '.$row['name'].' ,</p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Thank you for your recent inquiry into the position open at Anderson Group Philippines. We certainly appreciate your interest in working for our business.</p>';

				$bodyContent .= '<p>After reviewing your credentials, we have determined that your qualifications do not suit our needs at this time.</p>';

				$bodyContent .= '<p>We will keep your application on file for future reference. </p>';

				$bodyContent .= '<p>Again, thank you for your interest in Anderson Group Philippines. </p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Sincerely,</p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Human Resources Department</p>';

				$mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';

				$mail->Body    = $bodyContent;

				$mail->AltBody = 'Anderson';

				if (!$mail->send()) {

					echo "Rejected Mailer Error: " . $mail->ErrorInfo;

				} else{

					//$sql = "DELETE FROM $source WHERE id IN ($id)";

					$sql = "UPDATE $source SET `Status` = 'Rejected',`Schedule`='0000-00-00 00:00:00',`Note`='', `Timestamp` = '".date('Y-m-d')."' WHERE id IN ($id)";

					$result = $conn->query($sql);

					if($result){

						echo "Updated";

					}else{

						echo "Rejected Failed";

					}

				}

			}
			//for declined applicant
			elseif($type == 'Declined'){

				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				$mail->Host = 'relay-hosting.secureserver.net';
                
				$mail->Port = 587;

				$mail->SMTPSecure = 'tls';

				$mail->SMTPAuth = true;

				$mail->Username = "phrecruitment@andersongroup.uk.com";

				$mail->Password = "Password123";

				$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');

				$mail->addReplyTo('no-reply@example.com');

				$mail->addAddress($row['email']);

				$mail->isHTML(true);     
				  
                // $mail = new PHPMailer;
                // // $mail->SMTPDebug = 1;
                // $mail->IsSMTP();
                // $mail->Host = 'smtp.gmail.com';
                // $mail->Port = 587;
                // $mail->SMTPSecure = 'tls';
                // $mail->SMTPAuth = true;
                // $mail->Username = "andersonhronline@gmail.com";
                // $mail->Password = "Password321";
                // $mail->SetFrom('phrecruitment@andersonbpoinc.com','Anderson Group PH');
                // $mail->AddReplyTo('no-reply@example.com');
                // $mail->AddAddress($row['email']);
                // $mail->IsHTML(true);                           

				$mail->AddEmbeddedImage('aga.png', 'logo', 'aga.png');

				$bodyContent = "<a href='http://andersonbpoinc.com'><img style='text-align:center;' src='cid:logo'></a></br><hr >";

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Dear '.$row['name'].' ,</p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Thank you for your recent inquiry into the position open at Anderson Group Philippines. We certainly appreciate your interest in working for our business.</p>';

				$bodyContent .= '<p>After reviewing your credentials, we have determined that your qualifications do not suit our needs at this time.</p>';

				$bodyContent .= '<p>We will keep your application on file for future reference. </p>';

				$bodyContent .= '<p>Again, thank you for your interest in Anderson Group Philippines. </p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Sincerely,</p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Human Resources Department</p>';

				$mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';

				$mail->Body    = $bodyContent;

				$mail->AltBody = 'Anderson';

				if (!$mail->send()) {

					echo "REJECT Mailer Error: " . $mail->ErrorInfo;

				} else{

					//$sql = "DELETE FROM $source WHERE id IN ($id)";

					$sql = "UPDATE $source SET `Status` = 'Declined',`Schedule`='0000-00-00 00:00:00',`Note`='$reasonValue', `Timestamp` = '".date('Y-m-d')."' WHERE id IN ($id)";
					
					$result = $conn->query($sql);

					if($result){
						echo "Updated";
						
					}else{

						echo "Declined Failed";

					}


				}

			}
			else{

				//$schedule = $_POST["schedule"];

				$selSql = "select reference_no,status from tbl_application where id in ($id)";

				$searchResult = $conn->query($selSql);

				$row = $searchResult->fetch_assoc();

				$sql = "UPDATE tbl_interview SET `Status` = '$type' WHERE referenceNo = '".$row['reference_no']."' and interviewStage = '".$row['status']."'";

				$result = $conn->query($sql);

				if ($result) {

					echo "success";

				}

			}

		}else{	

			$schedule = $_POST["schedule"];

			$num_of_tests = 100000;

			 $correct = $incorrect = 0;

			 for( $i = 0; $i < $num_of_tests; $i++ )

			 {

			  $GLOBALS['rand_str'] = substr( "abcdefghijklmnopqrstuvwxyz" ,mt_rand( 0 ,25 ) ,1 ) .substr( md5( time( ) ) ,1,9 );

			  $first_char_of_rand_str = substr( $GLOBALS['rand_str'] ,0 ,1 );

			  if( ord( $first_char_of_rand_str ) < ord( 'a' ) or ord( $first_char_of_rand_str ) > ord( 'z' ) )

			  {

			   $incorrect++;

			   echo $GLOBALS['rand_str'] ,'<br>';

			  }

			  else

			  {

			   $correct++;

			  }

			 }



			 $rand_str;

					

			$sql = "UPDATE $source SET  `Schedule`  = '$schedule',`Status` = '$state', `Timestamp` = '".date('Y-m-d')."' WHERE id IN ($id)";

			$result = $conn->query($sql);

			

			if ($result) {

						

				//email for the interviewer

				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				$mail->Host = 'relay-hosting.secureserver.net';

				$mail->Port = 587;

				$mail->SMTPSecure = 'tls';

				$mail->SMTPAuth = true;

				$mail->Username = "phrecruitment@andersongroup.uk.com";

				$mail->Password = "Password123";

				$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');

				$mail->addReplyTo('no-reply@example.com');

				$mail->addAddress($interviewersAccount);

				$mail->isHTML(true);                                 
				
                // $mail = new PHPMailer;
                // // $mail->SMTPDebug = 1;
                // $mail->IsSMTP();
                // $mail->Host = 'smtp.gmail.com';
                // $mail->Port = 587;
                // $mail->SMTPSecure = 'tls';
                // $mail->SMTPAuth = true;
                // $mail->Username = "andersonhronline@gmail.com";
                // $mail->Password = "Password321";
                // $mail->SetFrom('phrecruitment@andersonbpoinc.com','Anderson Group PH');
                // $mail->AddReplyTo('no-reply@example.com');
                // $mail->AddAddress($interviewersAccount);
                // $mail->IsHTML(true); 
				$mail->AddEmbeddedImage('aga.png', 'logo', 'aga.png');

				$bodyContent = "<a href='http://andersonbpoinc.com'><img style='text-align:center;' src='cid:logo'></a></br><hr >";

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Dear '.$fname.',</p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Please be advised that you have been assigned to an interview with an applicant</p>';

				$bodyContent .= '<p>Name:  <b>'.$row['name'].'</b> </p>';
				$bodyContent .= '<p>Date:   '.$schedule.'</p>';
				$bodyContent .= '<br>';

				$bodyContent .= 'To manage your applicant, click the link: <br>

				<a href="andersonbpoinc.com/application/update_resume_form.php?ref='.$row['reference_no'].'&&iNt3RvI3w3r='.$rand_str.'"> andersonbpoinc.com/application/update_resume_form.php?ref='.$row['reference_no'].'&&iNt3RvI3w3r='.$rand_str.'</a>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Thank you</p>';

				$bodyContent .= '<br>';

				$bodyContent .= '<p>Anderson Group PH</p>';

				$mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';

				$mail->Body    = $bodyContent;

				$mail->AltBody = 'Anderson';



				if (!$mail->send()) {

					echo "Email not sent.";

					echo "Mailer Error: interviewer" . $mail->ErrorInfo;

				}else{

					$mail = new PHPMailer;

					$mail->Host = 'relay-hosting.secureserver.net';

					$mail->Port = 587;

					$mail->SMTPSecure = 'tls';

					$mail->SMTPAuth = true;

					$mail->Username = "phrecruitment@andersongroup.uk.com";

					$mail->Password = "Password123";

					$mail->setFrom('phrecruitment@andersongroup.uk.com','Anderson Group PH');

					$mail->addReplyTo('no-reply@example.com');

					$mail->addAddress($row['email']);

					$mail->isHTML(true);

                    // $mail = new PHPMailer;
                    // // $mail->SMTPDebug = 1;
                    // $mail->IsSMTP();
                    // $mail->Host = 'smtp.gmail.com';
                    // $mail->Port = 587;
                    // $mail->SMTPSecure = 'tls';
                    // $mail->SMTPAuth = true;
                    // $mail->Username = "andersonhronline@gmail.com";
                    // $mail->Password = "Password321";
                    // $mail->SetFrom('phrecruitment@andersonbpoinc.com','Anderson Group PH');
                    // $mail->AddReplyTo('no-reply@example.com');
                    // $mail->AddAddress($row['email']);
                    // $mail->IsHTML(true); 
					$mail->AddEmbeddedImage('aga.png', 'logo', 'aga.png');

					$bodyContent = "<a href='http://andersonbpoinc.com'><img style='text-align:center;' src='cid:logo'></a></br><hr >";

					$bodyContent = "<a href='http://andersonbpoinc.com'><img style='text-align:center;' src='cid:logo'></a></br><hr >";

					$bodyContent .= '<br>';

					$bodyContent .= '<p>Dear '.$row['name'].' ,</p>';

					$bodyContent .= '<br>';

					$bodyContent .= '<p>Thank you for your application in Anderson Group - Philippines</p>';

					$bodyContent .= '<br>';

					$bodyContent .= '<p>We are pleased to invite you for an interview as follows: </p>';

					$bodyContent .= '<p>Date and Time:  '.$schedule.'</p>';

					$bodyContent .= '<p>Venue: 11F Wynsum Corporate Plaza, #22 F. Ortigas Jr. Road, Ortigas Center, Pasig City Philippines</p>';

					$bodyContent .= '<p>Contact Number: 09175152420</p>';

					$bodyContent .= '<p>Please reply to make a confirmation with us.</p>';

					$bodyContent .= '<br>';

					$bodyContent .= '<p>Sincerely,</p>';

					$bodyContent .= '<p>Anderson Group Philippines</p>';

					$mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';

					$mail->Body    = $bodyContent;

					$mail->AltBody = 'Anderson';

						

					if (!$mail->send()) {

						echo "Email not sent.";

						echo "Mailer Error: " . $mail->ErrorInfo;

					} else{

						$sqlSelect = "select * from tbl_interview  where interviewStage = '".$state."' and referenceNo = '".$row['reference_no']."' ";

						$selectResult = $conn->query($sqlSelect);

						if ($selectResult->num_rows > 0) {

							$sqlUpdate = "update tbl_interview set interviewerFirstname = '".$fname."', interviewerMiddlename = '".$mname."', interviewerLastname = '".$lname."', interviewcode = '".$rand_str."', status = 'Pending' where interviewStage = '".$state."' and referenceNo = '".$row['reference_no']."'";

							$updateResult = $conn->query($sqlUpdate);

							if($updateResult){echo "success";

							}else{echo "failed";}

						}else{

							 $sql2 = " insert into tbl_interview(interviewStage,referenceNo, interviewerFirstname, interviewerMiddlename, interviewerLastname, interviewcode,status) values('".$state."','".$row['reference_no']."','$fname','$mname','$lname','$rand_str','Pending')";

							$result2 = $conn->query($sql2);

							if($result2){echo "success";

							}else{echo "failed";}

						}

					}

				}

			}else{echo "Error";}

		}

	}

?>