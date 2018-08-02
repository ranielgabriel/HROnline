<?php

	session_start();

	

	$_SESSION['newapp'] = 'new';

	include('connect.php');

	

?>

<!DOCTYPE html>

<html>
<style type="text/css">
	.img{

		position: absolute;

		top: 350px;

		left: 8%;

		right: 5%;

		z-index: 0;

		background-attachment: fixed;

		background-position: center;



	}



</style>
<head>

	<title>Interview Form</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

	<link rel="shortcut icon" href="favicon.ico" />	

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">

	<link rel="stylesheet" type="text/css" href="css/datepicker3.css">

	<link rel="stylesheet" type="text/css" href="css/ripples.css">

	<link rel="stylesheet" type="text/css" href="css/inputmask.css">

	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>

	<!-- Javascript file -->

	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript" src="js/material.js"></script>

	<script type="text/javascript" src="js/angular.js"></script>

	<script type="text/javascript" src="js/app.js"></script>

	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

	<script type="text/javascript" src="js/jquery.dropdown.js"></script>

	<script type="text/javascript" src="js/inputmask.js"></script>

	<script type="text/javascript" src="js/jquery.inputmask.js"></script>



<div class="card container" id="questcon1">

					<img class="img" src="lady liberty.png" style=" width: 90%;">
					<h6 style="padding-top: 30px"><i class="fa fa-book"> </i><b>Question</b> </h6>  

					<hr>


					<div class="row col-md-12" >

<form action="" method="post">
					<form action="" method="post">
					<div class="form-group">
					<?php
						/*$id = $_GET['ref'];
						$employeeType = $_GET['type'];*/

						$cnt_res = $conn->query("SELECT * from tbl_application where REFERENCE_NO = '26515'");

							

							while($row10 = $cnt_res->fetch_assoc()) {

								$myID = $row10['ID']; 

							}	
//<?php echo $myID; 
//php echo $employeeType; 
					?>
						<label class="control-label">Applicant ID</label>
						<input type="text" name="ref_number" id = "ref_number" value = "26515" class="form-control" required readonly="">
						<br>
						<input type="text" name="type" id = "type" value = "" class="form-control" required readonly><br>
						<i><textarea class="form-control" rows="3" name="desc" id="desc" readonly >In this part of the application process the interview can ask any relevant question based on the role being applied for. The form outlines 4 general topics that can be used as an outline of the entire conversation</textarea></i>
					</div>
					
					<div class="form-group">
					<?php
						include 'connect.php';
						
						$errormsg="";


						$cnts_res = $conn->query("SELECT * from tbl_secondinterviewquestions");
						$row_cnts = $cnts_res->num_rows;
						echo'<input type="hidden" id="interviewquestion_count" name="interviewquestion_count" value="'.$row_cnts.'">';
						$cnts = 1;
						while($row4 = $cnts_res->fetch_assoc()) {
							$question = utf8_encode($row4['sec_interview_question']);
							echo'<div class="form-group">
								<div class="form-group label-floating">
								  <label for="question<b>'.$cnts.'</b>" style=""><b> '.$cnts.'. </b>'.$question.'</label>
								  <textarea class="form-control" rows="5" name="questions'.$cnts.'" id="questions'.$cnts.'" ></textarea>
								
								 
								</div>
							</div>
								<br>';
								if (isset($_POST['interviewquestionbtn1'])) {
									//echo "<script>window.close();</script>";
									$questions = $_POST['questions'.$cnts.''];
									$myID = $_POST['ref_number'];
									$type = $_POST['type'];
									$sqlInsert = "INSERT INTO `tbl_secondinterviewanswers`  (APPLICANT_ID,sec_interview_answer, sec_interview_id) VALUES ('$myID','$questions','$cnts')";
	
									$result = $conn->query($sqlInsert);
									if ($result){
										$errormsg ="Answers Submitted Successfully!";
									}else{
										$errormsg="Error!";
									}
									echo '<script type="text/javascript">alert("'.$errormsg.'");
									window.close();</script>';	
								}	
								$cnts++;
								
						}
						?>	
					</div>
					
					<div class="modal-footer">

					<div class="form-group">
						<input type="submit" value = "Submit" name="interviewquestionbtn1" id ="interviewquestionbtn1" class="btn btn-primary">
						
					</div>
					</div>
					</form>
					
				</div>

</div>
			

		