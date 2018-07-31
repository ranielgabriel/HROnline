<?php

	session_start();

	

	$_SESSION['newapp'] = 'new';

	include('connect.php');

	

?>

<!DOCTYPE html>

<html>

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

					
					<h6 style="padding-top: 30px"><i class="fa fa-book"> </i><b>Question</b> </h6>  

					<hr>


					<div class="row col-md-12" >

<form action="" method="post">
					<form action="" method="post">
					<div class="form-group">
					<?php
						/*$id = $_GET['id'];
						$employeeType = $_GET['type'];*/

						$cnt_res = $conn->query("SELECT * from tbl_application where REFERENCE_NO = '18038'");

							

							while($row10 = $cnt_res->fetch_assoc()) {

								$myID = $row10['ID']; 

							}	


					?>
						<label class="control-label">Applicant ID</label>
						<input type="text" name="ref_number" id = "ref_number" value = "18038" class="form-control" required readonly="">
						<br>
						<input type="text" name="type" id = "type" value = "Non-Agent" class="form-control" required readonly>
					</div>
					
					<div class="form-group">
					<?php
						include 'connect.php';
						
						$errormsg="";


						$cnts_res = $conn->query("SELECT * from tbl_nonagentquestionaire");
						$row_cnts = $cnts_res->num_rows;
						echo'<input type="hidden" id="interviewquestion_count" name="interviewquestion_count" value="'.$row_cnts.'">';
						$cnts = 1;
						while($row4 = $cnts_res->fetch_assoc()) {
							$question = utf8_encode($row4['interviewquestion']);
							echo'<div class="form-group">
								<div class="form-group label-floating">
								  <label for="question<b>'.$cnts.'</b>" style=""><b> '.$cnts.'. </b>'.$question.'</label>
								  <textarea class="form-control" rows="5" name="questions'.$cnts.'" id="questions'.$cnts.'" ></textarea>
								
								 
								</div>
							</div>
								<br>';
								if (isset($_POST['interviewquestionbtn'])) {
									echo "<script>window.close();</script>";
									$questions = $_POST['questions'.$cnts.''];
									$myID = $_POST['ref_number'];
									$type = $_POST['type'];
									$sqlInsert = "INSERT INTO `tbl_answer`  (Applicant_ID,Answer, intQuestion_ID, Apptype) VALUES ('$myID','$questions','$cnts','$type')";
	
									$result = $conn->query($sqlInsert);
									if ($result){
										$errormsg ="Answers Submitted Successfully!";
									}else{
										$errormsg="Error!";
									}
									
								}	
								$cnts++;

									 
						}
						?>	
					</div>
					
					<div class="modal-footer">

					<div class="form-group">
						<input type="submit" value = "Submit" name="interviewquestionbtn" id ="interviewquestionbtn1" class="btn btn-primary">
						
					</div>
					</div>
					</form>

				</div>

</div>
			

		