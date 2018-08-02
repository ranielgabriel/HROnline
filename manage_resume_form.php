<?php
	session_start();
	
	$_SESSION['newapp'] = 'new';
	include('connect.php');
	
	$cnt=0;
	if(isset($_GET['ref'])&&!(isset($_GET['iNt3RvI3w3r'])))
	{
		$ref_num = mysqli_real_escape_string($conn,$_GET['ref']);
		$select_ref = "SELECT * from tbl_application";
		$result = $conn->query($select_ref);
			while ($row = $result->fetch_assoc()) {
				if($row["REFERENCE_NO"]==$ref_num)
				{	$cnt++;
					if($row['Status']=='Pending'||$row['Status']=='Unfinished'){
					$_SESSION['ref_number'] = $row["REFERENCE_NO"];
					
					//Header("Location:update_resume_form.php?ref=".$row["REFERENCE_NO"]."");
					
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
	}else{
		$Icnt=0;
		if($_GET['iNt3RvI3w3r']!=''){
		$Interviewnumber = $_GET['iNt3RvI3w3r'];
		$selectInterview = "SELECT * from tbl_interview where InterviewCode = '$Interviewnumber'";
		$resultI = $conn->query($selectInterview);
			while ($row = $resultI->fetch_assoc()) {
				if($row["InterviewCode"]==$Interviewnumber)
				{
					$Icnt++;
					if($row['Status']!='Pending'){
						$_SESSION['refcode_not_found']='Interviewer';
						header("Location:index.php");
					}
				}else{
				
				}
			}
			if($Icnt==0){
				$_SESSION['refcode_not_found']='yes';
				header("Location:index.php");
				exit();
			}	
		}else{
			header("Location:index.php");
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Application Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>	
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

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="custom_css/manage_resume_form.css">
	

	<?php
	if(isset($_GET['iNt3RvI3w3r'])){
		echo"<script>";
		echo"$( document ).ready(function() {";
		echo'$("input").prop("disabled", true);';
		echo'$("select").prop("disabled", true);';
		echo'$("textarea").prop("disabled", true);';
		echo'$("#comment").prop("disabled", false);';
		echo'$("#i1").prop("disabled", false);';
		echo'$("#i2").prop("disabled", false);';
		echo'$("#i3").prop("disabled", false);';
		echo'$("#submitFormButton").css("display", "none");';
		echo'$("#interviewerForm :input").attr("disabled", false);';
		echo'$("#interviewerName").attr("disabled", true);';
		echo'$("#lastSubmit").css("display", "none");';
		echo'$("#fsubmit").css("display", "none");';
		echo"});";
		echo"</script>";
	}
	?>

<style type="text/css">

	
	
</style>
<script type="text/javascript">
$(document).ready(function(){
	
	
});
</script>
</head>
<body>
<?php
error_reporting(0);
	include('connect.php');
	$reference_no = $_GET['ref'];
	$result_select = "SELECT * from tbl_application where REFERENCE_NO = '$reference_no'";
	
	$resultS = $conn->query($result_select);
	while($row = $resultS->fetch_assoc()){
		$position = $row["POSITION"];
		 $fname = $row["FIRSTNAME"];
		 $lname = $row["LASTNAME"];
		 $mname = $row["MIDDLENAME"];
		 $ename = $row["EXTENSIONNAME"];
		 $nick_name = $row["NICKNAME"];
		 $salary = $row["SALARY"];
		 $schedule = $row["SHIFTING_SCHEDULE"];
		 $cem= $row["CONTRACTUAL_EMPLOYMENT"]
		 $bday = $row["DATE OF BIRTH"];
		 $empdate = $row["EMPLOYMENT_DATE"];
		 $salary = $row["SALARY"];
		 $gender = $row["GENDER"];
		 $place_birth = utf8_decode($row["PLACE OF BIRTH"]);
		 $citizenship = $row["CITIZENSHIP"];
		 $civil_status = $row["CIVIL STATUS"];
		 $height = $row["HEIGHT"];
		 $weight = $row["WEIGHT"];
		 $bloodtype = $row["BLOODTYPE"];
		 $religion = $row["RELIGION"];
		 $current_address = utf8_decode($row["CURRENT ADDRESS"]);
		 $prov_address = utf8_decode($row["PROVINCIAL_ADDRESS"]);
		 $email = $row["EMAIL ADDRESS"];
		 $skype = $row["SKYPE_USERID"];
		 $fb = $row["FB_Account"];
		 $twit = $row["Twitter_Account"];
		 $hometel = $row["HOME_TELNUM"];
		 $mob_num = $row["MOBILE_NUMBER"];
		 $mob_num2 = $row["MOBILE_NUMBER2"];
		 $mob_num3 = $row["MOBILE_NUMBER3"];
		 $contact_name = $row["CONTACT NAME"];
		 $contact_details = $row["CONTACT DETAILS"];
		 $f_fname = $row["F_FNAME"];
		 $f_mname = $row["F_MNAME"];
		 $f_lname = $row["F_LNAME"];
		 $m_fname = $row["M_FNAME"];
		 $m_lname = $row["M_LNAME"];
		 $m_mname = $row["M_MNAME"];
		 $father_placebirth = utf8_decode($row["FATHER PLACEBIRTH"]);
		 $mother_name = utf8_decode($row["MOTHER'S MAIDEN NAME"]);
		 $mother_placebirth = utf8_decode($row["MOTHER PLACEBIRTH"]);
		 $elem_name = $row["ELEM_Name of School"];
		 $elem_scholar = $row["ELEM_Scholarship/ Academic Honors Received"];
		 $elem_inclusive_date = $row["ELEM_Inclusive Dates of Attendance"];
		 $grad_inclusive_date = $row["GRAD_Inclusive Dates of Attendance"];
		 $hs_name = $row["HS_Name of School"];
		 $hs_inclusive_date = $row["HS_Inclusive Dates of Attendance"];
		 $col_inclusive_date = $row["COL_Inclusive Dates of Attendance"];
		 $hs_scholar = $row["HS_Scholarship/ Academic Honors Received"];
		 $col_name = $row["COL_Name of School"];
		 $col_course = $row["COL_Degree Course"];
		 $col_scholar = $row["COL_Scholarship/ Academic Honors Received"];
		 $grad_name = $row["GRAD_Name of School"];
		 $grad_degree = $row["GRAD_Degree Course"];
		 $grad_scholar = $row["GRAD_Scholarship"];
		 $spouse_name = $row["SPOUSE'S NAME"];
		 $spouse_occ = $row["SPOUSE'S OCCUPATION"];
		 $inc_date1 = $row["1. Inclusive Dates"];
		 $inc_date2 = $row["2. Inclusive Dates"];
		 $inc_date3 = $row["3. Inclusive Dates"];
		 $inc_date4 = $row["4. Inclusive Dates"];
		 $inc_date5 = $row["5. Inclusive Dates"];
		 $emp_info1 = $row["1.1 Employer's Name, Address and Phone"];
		 $emp_info2 = $row["2.1 Employer's Name, Address and Phone"];
		 $emp_info3 = $row["3.1 Employer's Name, Address and Phone"];
		 $emp_info4 = $row["4.1 Employer's Name, Address and Phone"];
		 $emp_info5 = $row["5.1 Employer's Name, Address and Phone"];
		 $pos_title1 = $row["1.2 Position Title"];
		 $pos_title2 = $row["2.2 Position Title"];
		 $pos_title3 = $row["3.2 Position Title"];
		 $pos_title4 = $row["4.2 Position Title"];
		 $pos_title5 = $row["5.2 Position Title"];
		 $pos_title1 = $row["1.3 Name_Position and Contact No. of Immediate Supervisor"];
		 $pos_title2 = $row["2.3 Name_Position and Contact No. of Immediate Supervisor"];
		 $pos_title3 = $row["3.3 Name_Position and Contact No. of Immediate Supervisor"];
		 $pos_title4 = $row["4.3 Name_Position and Contact No. of Immediate Supervisor"];
		 $pos_title5 = $row["5.3 Name_Position and Contact No. of Immediate Supervisor"];
		 $msalary = $row["1.4 Monthly Salary"];
		 $msalary = $row["2.4 Monthly Salary"];
		 $msalary = $row["3.4 Monthly Salary"];
		 $msalary = $row["4.4 Monthly Salary"];
		 $msalary = $row["5.4 Monthly Salary"];
		 $reason1 = $row["1.5 Reason for Leaving"];
		 $reason2 = $row["2.5 Reason for Leaving"];
		 $reason3 = $row["3.5 Reason for Leaving"];
		 $reason4 = $row["4.5 Reason for Leaving"];
		 $reason5 = $row["5.5 Reason for Leaving"];
		 $license1 = $row["PROF_License1"];
		 $rating1 = $row["PROF_Rating1"];
		 $li_date_granted1 = $row["PROF_DateGranted1"];
		 $prof_insti1 = $row["PROF_Institution1"];
		 $liscence_num1 = $row["PROF_Licensennum1"];
		 $liscence_release1 = $row["PROF_DateReleased1"];
		 $license2 = $row["PROF_License2"];
		 $rating2 = $row["PROF_Rating2"];
		 $li_date_granted2 = $row["PROF_DateGranted2"];
		 $prof_insti2 = $row["PROF_Institution2"];
		 $liscence_num2 = $row["PROF_Licensennum2"];
		 $liscence_release2 = $row["PROF_DateReleased2"];
		 $license3 = $row["PROF_License3"];
		 $rating3 = $row["PROF_Rating3"];
		 $li_date_granted3 = $row["PROF_DateGranted3"];
		 $prof_insti3 = $row["PROF_Institution3"];
		 $liscence_num3 = $row["PROF_Licensennum3"];
		 $liscence_release3 = $row["PROF_DateReleased3"];
		 $checkup = $row["Physical Checkup"];
		 $ref_name1 = $row["REF_Name"];
		 $ref_name2 = $row["REF_Name2"];
		 $ref_name3 = $row["REF_Name3"];
		 $ref_add1 = $row["REF_Address"];
		 $ref_add2 = $row["REF_Address2"];
		 $ref_add3 = $row["REF_Address3"];
		 $ref_num1 = $row["REF_ContactNum"];
		 $ref_num2 = $row["REF_ContactNum2"];
		 $ref_num3 = $row["REF_ContactNum3"];
		 $app_source = $row["APPLICATION_SOURCE"];
		 $blood = $row["BLOODTYPE"];
		 $hdays = $row["WEEKENDS_HOLIDAYS"];
		 $pbo_mun = utf8_decode($row["PBO_MUNICIPALITY"]);
		 $pbo_pro = utf8_decode($row["PBO_PROVINCE"]);
		 $pbo_reg = utf8_decode($row["PBO_REGION"]);
		 $curStreet = utf8_decode($row["CURRENT_HOME_STREET"]);
		 $curBarangay = utf8_decode($row["CURRENT_BARANGAY"]);
		 $curMunicupality = utf8_decode($row["CURRENT_MUNICIPALITY"]);
		 $curProvince = utf8_decode($row["CURRENT_PROVINCE"]);
		 $curRegion = utf8_decode($row["CURRENT_REGION"]);
		 $provStreet = utf8_decode($row["PROV_HOME_STREET"]);
		 $provBarangay = utf8_decode($row["PROV_BARANGAY"]);
		 $provMunicipality = utf8_decode($row["PROV_MUNICIPALITY"]);
		 $provProvince = utf8_decode($row["PROV_PROVINCE"]);
		 $provRegion = utf8_decode($row["PROV_REGION"]);
		 $f_municipality = utf8_decode($row["F_MUNICIPALITY"]);
		 $f_province = utf8_decode($row["F_PROVINCE"]);
		 $f_region = utf8_decode($row["F_REGION"]);
		 $m_municipality = utf8_decode($row["M_MUNICIPALITY"]);
		 $m_province = utf8_decode($row["M_PROVINCE"]);
		 $m_region = utf8_decode($row["M_REGION"]);
		 $have_child = $row["HAVE_CHILD"];
		 $app_stat = $row["APPLICANT_STATUS"];
		 $college_grad = $row["COL_Graduated"];
		 $s_lname = $row["S_LNAME"];
		 $s_fname = $row["S_FNAME"];
		 $s_mname = $row["S_MNAME"];
		 $ap_stat = $row["Status"];
		 $col_gradd = $row["COL_Graduated"];
		 $image_directory = $row["PHOTO_DIRECTORY"];
		 $email_status = $row["email_status"];
	}if(isset($_GET['iNt3RvI3w3r'])){
		$interviewNumber = $_GET['iNt3RvI3w3r'];
		$interview_select = "SELECT * from tbl_interview where InterviewCode = '$interviewNumber'";
		$resultI = $conn->query($interview_select);
		while($row = $resultI->fetch_assoc()){
			$ifname = $row["interviewerFirstname"];
			$imname = $row["interviewerMiddlename"];
			$ilname = $row["interviewerLastname"];
			$interviewID = $row["ID"];
			$InterviewStage = $row["InterviewStage"];
		}
	}
	?>
	
<hr style="padding-bottom: 1%;">
<div style="display: <?php if(isset($_GET['iNt3RvI3w3r']))echo"block";else echo"none";?>;">
	<div class="row">
		<div class="col-md-1"></div>
			<div class="form-group">
			<div class="col-md-10">
				<button type="button" data-toggle="modal" data-target="#interviewModal" id="interviewButton" class="btn btn-primary pull-right">Interview</button>
			</div>
		</div>
	</div>
	
		<!-- About Modal -->
	
	<div id="interviewModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title"><center>Interview Result</center></h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" id="interviewerForm" action="interviewServerside.php">
					<div style="background-color:#D3D3D3;border-color:gray;" class="form-control">
					
					 <?php
						$referenceCode = $_GET['ref'];
						$interviewCode = $_GET['iNt3RvI3w3r'];
						if($InterviewStage=='Second Interview'){
							echo'<h5>Initial Interview:</h5>';
							$interview_select = "SELECT * from tbl_interview where ReferenceNo = '$referenceCode' and InterviewStage='Initial Interview'";
							$resultI = $conn->query($interview_select);
							while($row = $resultI->fetch_assoc()){
									echo "Name:   ".$row["interviewerLastname"].",".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>";
									echo "Comment:   ".$row['Comment']."";
								}
						} if($InterviewStage=='Third Interview'){
							
							
							$interview_select = "SELECT * from tbl_interview where ReferenceNo = '$referenceCode' and (InterviewStage='Initial Interview' OR InterviewStage='Second Interview')";
							$resultI = $conn->query($interview_select);
							$temp ="Initial";
							while($row = $resultI->fetch_assoc()){
									
									echo'<h5>'.$temp.' Interview:</h5>';
									echo "Name:   ".$row["interviewerLastname"].",".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>";
									echo "Comment:   ".$row['Comment']."";
									$temp = "Second";
								}
						}if($InterviewStage=='Final Interview'){
							
							
							$interview_select = "SELECT * from tbl_interview where ReferenceNo = '$referenceCode' and InterviewStage='Initial Interview' OR InterviewStage='Second Interview' OR InterviewStage='Third Interview'";
							$resultI = $conn->query($interview_select);
							$temp =["Initial","Second","Third"];
							$c = 0;
							while($row = $resultI->fetch_assoc()){
								
									echo'<h5>'.$temp[$c].' Interview:</h5>';
									echo "Name:   ".$row["interviewerLastname"].",".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>";
									echo "Comment:   ".$row['Comment']."";
									$c++;
								}
						}
					?> 
					</div>
					</br>
					<fieldset>
					<legend><?php echo $InterviewStage;?></legend>
					<input type="hidden" name="interviewID" value="<?php echo $interviewID;?>">
					<input type="hidden" name="InterviewStage" value="<?php echo $InterviewStage;?>">
					
					<input type="hidden" name="referenceNumber" value="<?php echo $reference_no;?>">
					
					<div class="form-group">
					  <label for="interviewerName" class="col-lg-2 control-label">Interviewer</label>
					  <div class="col-lg-10">
						<input type="text" class="form-control" id="interviewerName" value="<?php echo $ilname.', '.$ifname.' '.$imname?>" placeholder="Interviewer's Name">
					  </div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Status</label>
						<div class="col-lg-10">
						<div class="radio">
						  <label>
							<input type="radio" name="interviewStatus" id="i1" value="Passed" checked="">
							Passed
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="interviewStatus" id="i2" value="Failed">
							Failed
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="interviewStatus" id="i3" value="Endorsed">
							Passed - Endorse to next step
						  </label>
						</div>
						</div>
					</div>
				<div class="form-group">
				  <label for="comment" class="col-lg-2 control-label">Comment</label>
				  <div class="col-lg-10">
					<textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
				  </div>
				</div>
				</fieldset>
				<input type="submit" id="hiddenSubmitInterview" style="visibility: hidden;"/>
				</form>				
			</div>
		  <div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
			  <button id="submitInterviewForm" class="btn btn-success btn-raised">Submit</button>
		  </div>
		</div>
	  </div>
	</div>
</div>

<!--START-->
	<a href="http://andersongroup.ph/">
		<center> <img class="img-fluid logo" src="ag.png" style="width:50%;height:100%;"> </center>
	</a>
	<br>
<!--END-->

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="update_serverside.php" autocomplete="off" name="myForm" novalidate id="myForm" ng-app="" method="post" enctype="multipart/form-data" data-toggle="validator">
				<div class="card container" id="container1">
					<img class="img" src="lady liberty.png" style=" width: 85%;" >
					<center>
					<div class="row col-md-12" id="candidate_container" >
					
							<div class="form-group">
							<div class="form-group label-floating" >
									
									
									
									<?php if($app_stat=='grad')echo'<h2>FRESH GRADUATE</h2>';else {echo"<h2>EXPERIENCE CANDIDATE</h2>";}?>
								</div>
							</div>
					
					</div>
									
									
							
					</center>
					<div class="row col-md-12">
						
						<div class="col-md-6">
							<div class="form-group">
							<br>
								<label for="position">Position applying for:</label>
		      						      								
											<input type='text' id='apply_position' disabled class='form-control' value="<?php echo $position;?>" name='position_name' />
		      							
	      					</div>
	      					<div class="form-group">
				    			<label>Are You amenable to shifting schedule?</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="sched" id="sched2" value="YES" disabled <?php if($schedule=='YES')echo'checked';?>>
						            YES
						          </label>
						          <label>
						            <input type="radio" name="sched" id="sched2" value="NO" disabled <?php if($schedule=='NO')echo'checked';?>>
						            NO
						          </label>
						        </div>
						    </div>
							
						    <div class="form-group">
				    			<label>Are You willing to work on weekends/holidays?</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="holidays" id="holidays2" value="YES" disabled <?php if($hdays=='YES')echo'checked';?>>
						            YES
						          </label>
								  
						          <label>
						            <input type="radio" name="holidays" id="holidays2" value="NO" disabled <?php if($hdays=='NO')echo'checked';?>>
						            NO
						          </label>
						        </div>
						    </div>

							<div class="form-group">
				    			<label>Are You amenable contractual employment?</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="contract" id="contract2" value="YES" disabled <?php if($cem=='YES')echo'checked';?>>
						            YES
						          </label>
								  
						          <label>
						            <input type="radio" name="contract" id="contract2" value="NO" disabled <?php if($cem=='NO')echo'checked';?>>
						            NO
						          </label>
						        </div>
						    </div>
						</div>
						
						<div class="col-md-6 sample">
							<div class="form-group">
								<br>
								<div class="form-group"><!-- EMPLOYMENT DATE -->
			      					<label><i class="fa fa-calendar" ></i> Available date for employment <label class="text-danger">*</label></label>
			      					<div class="input-group">
				      					<input data-provide="datepicker" autocomplete="off" onkeydown="return false;" class="form-control date" name="empdate" id ="empdate" data-date-disable-touch-keyboard="true" data-date-end-date="+30d" data-date-autoclose="true" data-date-format="MM dd, yyyy" style="color: transparent;text-shadow: 0 0 0 black;" disabled required>	
			      						<span class="input-group-addon add-on"><a href="" onclick="$('#empdate').focus();"><span class="fa fa-calendar"></span></a>
									</div>
			      					<div class="help-block with-errors" style="color: red"></div>
			  					</div>
							</div>
							
							<div class="form-group" id="salary_group" ><!-- SALARY -->
		  						<label for="salary"></i>Expected Salary</label>
								<div class="input-group">
									<select id="salary" class="select form-control" name="salaryexpectation" disabled>
										<option value="Intern" <?php if($salary == 'Intern')echo'selected'?>>Intern</option>
										<option value="10,000.00 - 15,000.00" <?php if($salary == '10,000.00 - 15,000.00')echo'selected'?>>&#8369;10,000.00 - &#8369;15,000.00</option>
										<option value="16,000.00 - 20,000.00"<?php if($salary == '16,000.00 - 20,000.00')echo'selected'?>>&#8369;16,000.00 - &#8369;20,000.00</option>
										<option value="21,000.00 - 25,000.00" <?php if($salary == '21,000.00 - 25,000.00')echo'selected'?>>&#8369;21,000.00 - &#8369;25,000.00</option>
										<option value="26,000.00 - 30,000.00" <?php if($salary == '26,000.00 - 30,000.00')echo'selected'?>>&#8369;26,000.00 - &#8369;30,000.00</option>
										<option value="31,000.00 - 35,000.00" <?php if($salary == '31,000.00 - 35,000.00')echo'selected'?>>&#8369;31,000.00 - &#8369;35,000.00</option>
										<option value="36,000.00 - 40,000.00" <?php if($salary == '36,000.00 - 40,000.00')echo'selected'?>>&#8369;36,000.00 - &#8369;40,000.00</option>
										<option value="41,000.00 - 50,000.00" <?php if($salary == '41,000.00 - 50,000.00')echo'selected'?>>&#8369;41,000.00 - &#8369;50,000.00</option>
										<option value="51,000.00 - 55,000.00" <?php if($salary == '51,000.00 - 55,000.00')echo'selected'?>>&#8369;51,000.00 - &#8369;55,000.00</option>
									</select><span class="input-group-addon add-on"><span class="fa fa-arrow-down"></span>
								</div>
							</div>
						</div>						
					</div>

					<!-- personal information -->
					<div class="row col-md-12">
						<h6 style="margin-top: 2%"><i class="fa fa-user-o"></i><b> PERSONAL INFORMATION</b></h6>
						
						<hr style="padding-bottom: 10px;">
						<div class="col-md-6">
							<div class="form-group label-floating" >
								<label for="lname" class="control-label">Last Name <label class="text-danger">*</label></label>
								<input class="form-control" value="<?php echo $lname;
								?>" type="text" minlength="2" name="lname" id="lname" disabled required>
								<div class="help-block with-errors" style="color: red"></div>
							</div>	
							<div class="form-group label-floating">
								<label for="fname" class="control-label">First Name <label class="text-danger">*</label></label>
								<input name="fname" id="fname" value="<?php echo $fname;
								?>" class="form-control"  minlength="2" disabled required  >
								<div class="help-block with-errors" style="color: red"></div>
							</div>
							<div class="form-group label-floating">
								<label for="mname" class="control-label">Middle Name</label>
								<input type="text" name="mname" disabled value="<?php echo $mname;
								?>" id="mname" class="form-control">
								
							</div>
							<div class="form-group label-floating">
								<label for="ename" class="control-label">Name Extension</label>
								<input type="text" name="ename" disabled value="<?php echo $ename;
								?>" id="ename" class="form-control">
							</div>
  

							<div class="form-group">
				    			<label>Gender</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="sex123" id="s1" value="Male" disabled <?php if($gender=="Male")echo'checked';?>>
						            MALE	
						          </label>
						          <label>
						            <input type="radio" name="sex123" id="s1" value="Female" disabled <?php if($gender=="Female")echo'checked';?>>
						            FEMALE
						          </label>
						        </div>
						    </div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label for="nickname" class="control-label">Nick Name</label>
								<input type="text" value ="<?php echo $nick_name;?>" name="nickname123" id="nickname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating ">
								<label for="date-ofbirth" class="control-label"><i class="fa fa-calendar" ></i> Date of Birth <label class="text-danger">*</label></label>
								
								<div class="input-group" id="datePicker">
									<input data-provide="datepicker" style="color: transparent;text-shadow: 0 0 0 black;" name="bday123" id="bday123" value ="<?php echo $bday;?>" class="form-control date" data-date-end-date="-17y" data-date-autoclose="true" onkeydown="return false;" data-date-format="MM dd, yyyy" disabled required>
									<span class="input-group-addon add-on"><a href="" onclick="$('#bday123').focus();"><span class="fa fa-calendar"></span></a>
									
           			 			</div>
           			 			<div class="help-block with-errors" style="color: red"></div>
							</div>
							<div class="form-group label-floating">
								<label for="placeofbirth" class="control-label">Select place of birth <label class="text-danger">*</label></label>
								<input type="text" disabled value="<?php
								if($pbo_mun==''&&$pbo_reg==''&&$pbo_pro==''){
									echo $place_birth;
								}
								else if($pbo_pro==''){
									echo $pbo_mun;
								}else {
									echo $pbo_mun.', '.$pbo_pro;
								}
								?>" name="bplace"  id="placeofbirth" class="form-control" data-toggle="modal" data-target="#modalPB" readonly>
							</div>
								
							<div class="form-group label-floating">
								<label for="citizen" class="control-label" >Citizenship <label class="text-danger">*</label></label>
								<select class="select form-control" name="citizen" id="citizen" disabled>
								
										      		<?php  
						      							include('connect.php');
						      							$sql = "SELECT * FROM `tbl_citizenship`";
						      							$result = $conn->query($sql);
						      							while($row = $result->fetch_assoc()){
															
						      								if ($row['Citizenship'] == $citizenship) {
						      									echo "<option value='".$row['Citizenship']."' selected>".$row['Citizenship']."</option>";
						      								}
						      								else{
						      									echo "<option value='".$row['Citizenship']."'>".$row['Citizenship']."</option>";		
						      								}
						      							}
						      						?>
										      	</select>
								<div class="help-block with-errors" style="color: red"></div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group label-static">
										<label for="cstatus" class="control-label">Civil Status</label>
				      					<select id="cstatus" class="select form-control" name="cstatus" onchange="showspec(this)" disabled>
											<?php if($civil_status!='Single'&&$civil_status!='Married'&&$civil_status!='Annuled'&&$civil_status!='Widowed'&&$civil_status!='Separated')echo '<option value="'.$civil_status.'">'.$civil_status.'</option>'; ?>
											
				      						<option value="Single" <?php if($civil_status=='Single')echo'selected';?>>Single</option>
				      						<option value="Married" <?php if($civil_status=='Married')echo'selected';?>>Married</option>
				      						<option value="Annuled" <?php if($civil_status=='Annuled')echo'selected';?>>Annuled</option>
				      						<option value="Widowed" <?php if($civil_status=='Widowed')echo'selected';?>>Widowed</option>
				      						<option value="Separated" <?php if($civil_status=='Separated')echo'selected';?>>Separated</option>
				      						<option value="Others">Others</option>
				      					</select>
									</div>
								</div>
									<!-- <div class="switch form-group" >
								<label><input onchange="checkspec(this)" type="checkbox" name="child2" id="child2" value="1"> Do You Have Child/Children</label> -->
							

								<div class="col-md-6">
									<div id="other_div" style="display:none;" class="form-group label-floating">
					      				<label class="control-label" for="wewe">Civil Status<label class="text-danger">*</label></label>
					      				<input type="text" name="cstatusspec" class="form-control" id="wewe" >
			      					</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row ">
					<div class="col-md-12">
						
					<button type="button" id="fnext" style="margin-bottom: 2%" class="btn btn-primary pull-right">NEXT</button>
					</div>	
					</div>
				</div> <!-- End of container 1 -->

				<div id="modalPB" class="modal fade" role="dialog" >
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								        <h3 class="modal-title"><center>Select your birthplace</center></h3>
								      </div>
								      <div class="modal-body">
								      <div class="form-group">
								      	<div class="">
								      		<label>
								      			<input type="checkbox" name="outsidecountry" onclick="if(this.checked){showCountry()} else {hideCountry()}"> If Birthplace is outside the Philippines
								      		</label>
								      	</div>
								      </div>
								      <div id="country" style="display:none;">
									      <select class="select form-control" name="Country_name" id="countryid" onchange="countryfunction(this)">
									      		<?php  
					      							include('connect.php');
					      							$sql = "SELECT * FROM `tbl_country`";
					      							$result = $conn->query($sql);
					      							while($row = $result->fetch_assoc()){
					      							echo "<option value='".$row['Country_name']."'>".$row['Country_name']."</option>";

					      							}
					      						?>
									      	</select>
								      	</div>
								      	<div id="phil">
									      	<div id="region">
										      	<select class="select form-control" name="Region_name" id="regionid" onchange="regionfunction(this)">
										      		<?php  
						      							include('connect.php');
						      							$sql = "SELECT * FROM `tbl_region`";
						      							$result = $conn->query($sql);
						      							while($row = $result->fetch_assoc()){
						      							echo "<option value='".$row['id']."_".$row['Region_name']."'>".$row['Region_name']."</option>";
						      							}
						      						?>
										      	</select>
										    </div>  	
										    <div id="province">
										    	
										    </div>
											<div id="cities" style="padding-top: 15px">
												
											</div>
										</div>
									      </div>
								      <div class="modal-footer">
								      <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
								        
								      </div>
								    </div>
								  </div>
				</div>

				<div class="card container" id="container2" style="display:none;">
					<img class="img" src="lady liberty.png" style=" width: 85%; " >
					<h6 style="padding-top: 2%;"><i class="fa fa-user-o"></i> <b>PERSONAL INFORMATION</b></h6>
					
					<hr style="padding-bottom: 10px;">
					<div class="row col-md-12">
						<div class="col-md-6">
							<label>Height</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">Feet (ft.)</label>
										<input type="number" value="<?php 
										
										
										$exp_data = explode(" ' ",$height);
										echo $exp_data[0];
										?>" name="feet" class="form-control" id="feet" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label for="inches" class="control-label">Inches (in.)</label>
										<input type="number" value='<?php echo $exp_data[1];?>' name="inch" class="form-control" id="inches" disabled>
									</div>
								</div>
							</div>
							<div class="form-group label-floating">
								<label for="bloodtype" class="control-label">Blood type</label>
								<select class="select form-control" id="bloodtype" name="btype" disabled>
									<option <?php if($blood=="O+")echo 'selected';?> value="O+">O+</option>
									<option <?php if($blood=="BA")echo 'selected';?> value="BA">B+&#45;</option>
									<option <?php if($blood=="Om")echo 'selected';?> value="Om">O&#45;</option>
									<option <?php if($blood=="Bm")echo 'selected';?> value="Bm">B&#45;</option>
									<option <?php if($blood=="A+")echo 'selected';?> value="A+">A+</option>
									<option <?php if($blood=="AB+")echo 'selected';?> value="AB+">AB+</option>
									<option <?php if($blood=="Am")echo 'selected';?> value="Am">A&#45;</option>
									<option <?php if($blood=="ABm")echo 'selected';?> value="ABm"> AB&#45;</option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<label>Weight</label>
							<div class="form-group label-floating">
								<label for="pounds" class="control-label">Pounds (lbs:)</label>
								<input type="number" name="weight" value="<?php echo $weight;?>" class="form-control" id="pounds" disabled>
							</div>
							<div class="form-group label-floating">
								<label for="religion" class="control-label">Religion</label>
								<input type="text" name="religion123" value="<?php echo $religion;?>" class="form-control" id="religion" disabled>
							</div>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-6">
							<label>Select Current Address<label class="text-danger">*</label></label>
								<div class="form-group label-floating">
								<input class="form-control" value='<?php 
								if($curProvince==''){
									echo $curMunicupality;
								}
								else{
									echo $curMunicupality.', '.$curProvince;
								}
								?>' type="text" id="curaddress" name="currentaddress" data-toggle="modal" data-target="#modalCA" style="color: transparent;text-shadow: 0 0 0 black;" autocomplete="off" onkeydown='return false;'required disabled />
								<div class="help-block with-errors" style="color:red"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label class="control-label" for="currendaddress">Current Address (Number, Street, Subdivision, Barangay)<label class="text-danger">*</label></label>
								
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="current_home_num">Home No. and Street<label class="text-danger">*</label></label>
									<input type="text" name="current_home_num" value='<?php echo $curStreet;?>' class="form-control" id="current_home_num" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="current_barangay">Barangay<label class="text-danger">*</label></label>
									<input type="text" name="current_barangay" value='<?php echo $curBarangay;?>' class="form-control" id="current_barangay" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
								
							</div>
							
							<div class="help-block with-errors" style="color: red"></div>
							</div>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-6">
							<label>Select Provincial Address</label>
							<input class="form-control" value='<?php
							if($provProvince==''){
								echo $provMunicipality;
							}
							else{
								echo $provMunicipality.', '.$provProvince;
							}
							?>' type="text" id="provaddress" name="provinceaddress" data-toggle="modal" data-target="#modalPA" readonly disabled>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label class="control-label" for="provincialaddress">Provincial Address (Number, Street, Subdivision, Barangay)</label>
								<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="provincial_home_num">Home No. and Street</label>
									<input type="text" value="<?php echo $provStreet;?>" name="provincial_home_num" class="form-control" id="provincial_home_num" disabled>
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="provincial_barangay">Barangay</label>
									<input type="text" value="<?php echo $provBarangay;?>" name="provincial_barangay" class="form-control" id="provincial_barangay" disabled>
								</div>
							</div>
							</div>
						</div>
					</div>

					<!-- contact -->
					<div class="row col-md-12">
						<h6 style="padding-top:5%"><i class="fa fa-phone"></i><b> CONTACT INFORMATION</b></h6>
						<hr>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label" for="email">E-Mail Address<label class="text-danger">*</label></label>
										<input onblur="updateemail();" value="<?php echo $email;?>" type="email" name="email" class="form-control" id="email" required disabled>
										<div id='emailhelp' class="help-block with-errors" style="color: red"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label" for="skype">Skype User Id</label>
										<input type="text" value="<?php echo $skype;?>" name="skype_userid" class="form-control" id="skype" disabled>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group label-floating">
										<label class="control-label" for="facebook">Facebook account</label>
										<input class="form-control" value="<?php echo $fb;?>" type="text" name="facebook" disabled>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group label-floating">
										<label class="control-label" for="twitter">Twitter account</label>
										<div class="input-group">
											<span class="input-group-addon">@</span>
											<input class="form-control" value='<?php echo $twit;?>' type="text" name="twitter" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--  -->
							<div class="row col-md-6">
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="telno">Home Tel No.</label>
									<input data-inputmask="'mask': '(99)-999-9999'" type="text" name="home_telnum" class="form-control" id="telno" ng-minlength="7" value="<?php echo $hometel;?>" disabled>
								</div> 
							</div>
							<script>
								//document.getElementById("#celno").val("09");
								var xxx = document.getElementById("#celno");
							</script>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="celno">Mobile No.<label class="text-danger">*</label></label>
									<input data-inputmask="'mask': '(+63) 999-999-9999'" type="text" name="mobile_num" class="form-control" id="mobile_number" minlength='11' value="<?php echo $mob_num;?>" required disabled>
									<span style="color: red;display:none;" id="number_validator">Invalid Contact Number.</span>
									<div class="help-block with-errors" style="color: red;"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="celno2">Mobile No.<small>(Optional)</small></label>
									<input value="<?php echo $mob_num2;?>" data-inputmask="'mask': '9999-999-9999'" type="text" name="mobile_num2" class="form-control" id="celno2" disabled >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="celno3">Mobile No.<small>(Optional)</small></label>
									<input value="<?php echo $mob_num3;?>" data-inputmask="'mask': '9999-999-9999'" type="text" name="mobile_num3" class="form-control" id="celno3" disabled>
								</div>
							</div>
							<div class="col-md-6" ng-app="">
								<div class="form-group label-floating">
									<label style="font-size: 11px;" class="control-label text-sm" for="contactperson">Contact Person in case of emergency</label><label class="text-danger">*</label>
									<input class="form-control" value="<?php echo $contact_name;?>" type="text" name="contact_name" id="contactperson" minlength="2" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="contactpersonno" style="font-size: 11px">Contact Details</label><label class="text-danger">*</label>
									<input class="form-control" type="number" value="<?php echo $contact_details;?>" name="contact_details" id="contactpersonno" minlength="2" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
						</div>
					</div>


					<!-- buttons -->
					<button type="button" href="#container1" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container1').style.display='block';document.getElementById('container2').style.display='none';">PREVIOUS</button>
					<button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" id="snext">NEXT</button> <!--  -->
				</div> <!-- End of container 2 -->

				<div id="modalCA" class="modal fade" role="dialog" >
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								        <h3 class="modal-title"><center>Select your current address</center></h3>
								      </div>
								      <div class="modal-body">
								     
								      	<div id="phil">
									      	<div id="region">
										      	<select class="select form-control" name="Region_name" id="cregionid" onchange="cregionfunction(this)" disabled>
										      		<?php  
						      							include('connect.php');
						      							$sql = "SELECT * FROM `tbl_region`";
						      							$result = $conn->query($sql);
						      							while($row = $result->fetch_assoc()){
						      							echo "<option value='".$row['id']."_".$row['Region_name']."'>".$row['Region_name']."</option>";
						      							}
						      						?>
										      	</select>
										    </div>  	
										    <div id="cprovince"></div>
											<div id="ccities" style="padding-top: 15px"></div>
										</div>
									      </div>
								      <div class="modal-footer">
								      <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
								        
								      </div>
								    </div>
								  </div>
				</div>
				<div id="modalPA" class="modal fade" role="dialog" >
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								        <h3 class="modal-title"><center>Select your provincial address</center></h3>
								      </div>
								      <div class="modal-body">
								     
								      	<div id="phil">
									      	<div id="region">
										      	<select class="select form-control" name="Region_name" id="pregionid" onchange="pregionfunction(this)" disabled>
										      		<?php  
						      							include('connect.php');
						      							$sql = "SELECT * FROM `tbl_region`";
						      							$result = $conn->query($sql);
						      							while($row = $result->fetch_assoc()){
						      							echo "<option value='".$row['id']."_".$row['Region_name']."'>".$row['Region_name']."</option>";
						      							}
						      						?>
										      	</select>
										    </div>  	
										    <div id="pprovince"></div>
											<div id="pcities" style="padding-top: 15px"></div>
										</div>
									      </div>
								      <div class="modal-footer">
								      <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
								        
								      </div>
								    </div>
								  </div>
				</div>

				<div class="card container" id = "container3" style="display:none;">
					<img class="img" src="lady liberty.png" style=" width: 85%;">
					<h6 style="padding-top: 30px"><i class="fa fa-group"> </i><b> FAMILY BACKGROUND</b></h6>
					<hr style="padding-bottom: 10px;">
					<!-- for married ones -->
					<div id="married_div" class="row col-md-12">
						<h2 style="padding-top: 2%;" align="center"> Spouse </h2>
						<div class="col-md-6">
							<div class="form-group label-floating">
					      		<label class="control-label" for="slname">Spouse's Last Name</label>
					      		<input id="slname" type="text" value="<?php
								
								echo $s_lname;
								
								?>"  name="spouse_lastname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="sfname">Spouse's First Name</label>
					      		<input id="sfname" type="text" value="<?php
								
								echo $s_fname;
								
								?>" name="spouse_firstname" class="form-control" >
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="smname">Spouse's Middle Name</label>
					      		<input id="smname" type="text" value="<?php
								
								echo $s_mname;
								
								?>"  name="spouse_midname" class="form-control" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label class="control-label" for="occupation">Spouse's Occupation</label>
								<input type="text" name="spouse_occ" value="<?php
									if($spouse_occ==''){
									echo'';
									}else{
									$sp_res = explode("^^",$spouse_occ);
									echo $sp_res[0];
									}
								?>" id="occupation" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="employer-name">Company Name</label>
								<input type="text" value="<?php
									if($spouse_occ==''){
									echo'';
									}else{
									$sp_res2 = explode("^^",$spouse_occ);
									echo $sp_res2[1];
									}
								?>" name="spouse_empname" id="employer-name" class="form-control" disabled>
								
							</div>
						</div>
					</div> <!-- end for married ones -->
								<!-- for widowed ones -->
					<div id="widowed_div" class="row col-md-12">
						<h2 style="padding-top: 2%;" align="center"> Spouse </h2>
						<div class="col-md-6">
							<div class="form-group label-floating">
					      		<label class="control-label" for="slname">Spouse's Last Name</label>
					      		<input id="slname" type="text" value="<?php
									if($spouse_name==''){
										echo'';
									}else{
										$sl = explode("%%",$spouse_name);
										echo $sl[0];
									}
								?>"  name="widowed_lname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="sfname">Spouse's First Name</label>
					      		<input id="sfname" type="text" value="<?php
									if($spouse_name==''){
										echo'';
									}else{
										$sf = explode("%%",$spouse_name);
										$sf2 = explode("**",$sf[1]);
										echo $sf2[0];
									}
								?>"  name="widowed_fname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="smname">Spouse's Middle Name</label>
					      		<input id="smname" type="text" value="<?php
									if($spouse_name==''){
										echo'';
									}else{
										$sm = explode("%%",$spouse_name);
										$sm2 = explode("**",$sm[1]);
										echo $sm2[1];
									}
								?>" name="widowed_midname" class="form-control" disabled>
							</div>
						</div>
						<div class="col-md-6">
						</div> 
					</div> <!-- end for widowed ones -->
					<div class="row col-md-12">
						<div class="col-md-6">
							<h3 style="padding-top: 3%;" align="center">Father's Information</h3>
							<div class="form-group label-floating">
								<label class="control-label" for="flname">Father's Last name</label>
								<input type="text" name="flname" value="<?php echo $f_lname;?>" id="flname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="ffname">Father's First Name</label>
								<input type="text" name="ffname" value="<?php
								echo $f_fname;
								?>" id="ffname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="fmname">Father's Middle Name</label>
								<input type="text" name="fmname" value="<?php
								echo $f_mname;
								?>" id="fmname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="fplace_birth">Place of Birth</label>
								<input type="text" name="father_placebirth" value='<?php
								if($f_province==''&&$f_municipality==''&&$f_region==''){
									echo $father_placebirth;
								}
								else if($f_province==''){
									echo $f_municipality;
								}
								else{
									echo $f_municipality.', '.$f_province;
								}
							?>' id="fplace_birth" class="form-control" data-toggle="modal" data-target="#modalFPB" readonly disabled>
							</div>
						</div>
						<div class="col-md-6">
							<h3 style="padding-top: 3%;" align="center">Mother's Information</h3>
							<div class="form-group label-floating">
								<label class="control-label" for="mlname">Mother's Maiden name</label>
								<input type="text" name="mother_lname" value="<?php
								echo $m_lname;
								?>" id="mlname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="mfname">Mother's First Name</label>
								<input type="text" name="mother_fname" value="<?php
								echo $m_fname;
								?>" id="mfname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="mmname">Mother's Middle Name</label>
								<input type="text" name="mother_midname" value="<?php
								echo $m_mname;
								?>" id="mmname" class="form-control" disabled>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="mplace_birth">Place of Birth</label>
								<input type="text" name="mother_placebirth" value='<?php
								if($m_province==''&&$m_municipality==''&&$m_region==''){
									echo $mother_placebirth;
								}
								else if($m_province==''){
									echo $m_municipality;
								}
								else{
									echo $m_municipality.', '.$m_province;
								}
							?>' id="mplace_birth" class="form-control" data-toggle="modal" data-target="#modalMPB" readonly disabled>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<label class="switch col-md-4">
							<input id="positive" type="checkbox" <?php if($have_child==1)echo'checked';?>>
							<div class="slider round"></div>
						</label>
						<h5 class="col-md-5">  Do you have Child/Children?</h5>	
					</div>
					
                    <div class="wawsibling btn-group-sm" data-click-state=<?php echo $have_child;?> style="display:<?php if($have_child==1)echo'none'; else echo'block';?>;" id="siblings">
                    	<div class="row">
                    		<div class="col-md-12">	
                      			<!-- <button type="button" class="btn btn-sm btn-raised btn-info add_field_button_sibling">Add Sibling</button> -->
                    		</div>
                    	</div>
                      <div class="input_fields_wrap_sibling">
                        <!-- third sibling -->
						<?php
						include('connect.php');
							$ref_id = $_GET['ref'];
							$result_sib = "SELECT s.*,a.* from tbl_siblings s inner join tbl_application a on a.ID = s.ID where a.REFERENCE_NO = '$ref_id'";
							$s_count = 1;
							
							
							$resultSiblings = $conn->query($result_sib);
							while($row = $resultSiblings->fetch_assoc()){
								echo'<div class="row col-md-12" >
								  <div class="col-md-6">
									<div class="col-md-7">
									  <div class="form-group label-floating">
										<label class="control-label" for="sibling" >Enter sibling name</label>
										<input type="text" value="'.$row["SIBLING_NAME"].'" name="sibling'.$s_count.'" id="sibling" class="form-control" disabled>
									  </div>
									</div> 
									<div class="col-md-3">
									  <div class="form-group label-floating">
										<label class="control-label" for="sage">Age</label>
										<input id="sage" class="form-control" value="'.$row["SIBLING_AGE"].'" type="number" name="sibling_age'.$s_count.'" disabled />
									  </div>
									</div>
									<button type=button style="margin-top: 8%" class="btn btn-raised btn-danger btn-sm pull-right remove_field">Remove</button>
								  </div>
								</div>';
								$s_count++;
							}
							
							
							if($s_count == 1)
							{
							echo'<div class="row col-md-12">
								<div class="col-md-6">
									<div class="col-md-7">
										<div class="form-group label-floating">
											<label class="control-label" for="sibling" >Enter sibling name</label>
											<input type="text" name="sibling1" id="sibling" class="form-control" disabled>
										</div>
									</div> 
									<div class="col-md-3">
									  <div class="form-group label-floating">
										<label class="control-label" for="sage">Age</label>
										<input id="sage" class="form-control" type="number" name="sibling_age1" disabled />
									  </div>
									</div>
								</div>
							</div>';
							}
						?>
                        
                      </div>
                    </div>

                    <div class="wawchild btn-group-sm" id="children" data-click-state='' style="display:<?php if($have_child==1)echo'block';else echo'none';?>;">
                      <div class="input_fields_wrap">
                        <div class="row col-md-12">
                        <div class="col-md-6">
                            <!-- fillings -->
                          </div>
                        <div class="col-md-6">
                          <!-- <button type="button" class="btn btn-raised btn-sm btn-info add_field_button">Add Dependents</button> -->
                        </div>
                          <div class="col-md-6">
                            <!-- fillings -->
                          </div>
	                    </div>
						
						
	                    <?php
						include('connect.php');
							$ref_id = $_GET['ref'];
							$resultC = "SELECT c.*,a.* from tbl_child c inner join tbl_application a on a.ID = c.ID where a.REFERENCE_NO = '$ref_id'";
							$c_count = 1;
							
							$resultchild = $conn->query($resultC);
							while($row = $resultchild->fetch_assoc()){
								echo'<div class="row col-md-12" id="1chi">
									<div class="col-md-6">
										<!-- fillings -->
									</div>
									<div class="col-md-6">
										<div class="col-md-7">
										  <div class="form-group label-floating">
											<label class="control-label" for="child" >Enter child name</label>
											<input type="text" value="'.$row["CHILD_NAME"].'" name="child_name'.$c_count.'" id="child" class="form-control" disabled>
										  </div>
										</div> 
										<div class="col-md-3">
										  <div class="form-group label-floating">
											<label class="control-label" for="age">Age</label>
											<input id="age" class="form-control" value="'.$row["CHILD_AGE"].'" type="number" name="child_age'.$c_count.'" disabled />
										  </div>
										</div>
										<!-- <button type=button style="margin-top: 8%" class="btn btn-raised btn-sm btn-danger pull-right remove_field">Remove</button> -->
									</div>
								</div>';
								$c_count++;
							}
							
							if($c_count== 1)
							{
								echo'<div class="row col-md-12" id="1chi">
										<div class="col-md-6">
											<!-- fillings -->
										</div>
										<div class="col-md-6">
											<div class="col-md-7">
											  <div class="form-group label-floating">
												<label class="control-label" for="child" >Enter child name</label>
												<input type="text" name="child_name1" id="child" class="form-control" disabled>
											  </div>
											</div> 
											<div class="col-md-3">
											  <div class="form-group label-floating">
												<label class="control-label" for="age">Age</label>
												<input id="age" class="form-control" type="number" name="child_age1" disabled />
											  </div>
											</div>
											<!-- <button type=button style="margin-top: 8%" class="btn btn-raised btn-sm btn-danger pull-right remove_field">Remove</button> -->
										</div>
									</div>';
								
							}
						?>
						
						
                    </div>
                </div>

					<!-- buttons -->
					<button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container2').style.display='block';document.getElementById('container3').style.display='none';">PREVIOUS</button>
					<button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" onclick="document.getElementById('container3').style.display='none'; document.getElementById('container4').style.display='block';">NEXT</button>	
				</div> <!-- end of container 3 -->

				<div id="modalFPB" class="modal fade" role="dialog" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h3 class="modal-title"><center>Select your father's birthplace</center></h3>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="">
								      	<label>
								      		<input type="checkbox" name="" onclick="if(this.checked){fshowCountry()} else {fhideCountry()}" disabled> If Birthplace is outside the Philippines
								      	</label>
								    </div>
								</div>
								<div id="fcountry" style="display:none;">
									<select class="select form-control" name="fCountry_name" id="fcountryid" onchange="fcountryfunction(this)" disabled>
									    <?php  
					      					include('connect.php');
					      					$sql = "SELECT * FROM `tbl_country`";
					      					$result = $conn->query($sql);
					      					while($row = $result->fetch_assoc()){
												echo "<option value='".$row['Country_name']."'>".$row['Country_name']."</option>";
						      				}
						      			?>
									</select>
								</div>
								<div id="fphil">
									<div id="fregion">
										<select class="select form-control" name="fRegion_name" id="fregionid" onchange="fregionfunction(this)" disabled>
										    <?php  
						      					include('connect.php');
						      					$sql = "SELECT * FROM `tbl_region`";
						      					$result = $conn->query($sql);
						      					while($row = $result->fetch_assoc()){
						      					echo "<option value='".$row['id']."_".$row['Region_name']."'>".$row['Region_name']."</option>";
						      					}
						      				?>
										</select>
									</div>  	
									<div id="fprovince">
										    	
									</div>
									<div id="fcities" style="padding-top: 15px">
												
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>        
							</div>
						</div>
					</div>
				</div>


				<div id="modalMPB" class="modal fade" role="dialog" >
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h3 class="modal-title"><center>Select your mother's birthplace</center></h3>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="">
								      	<label>
								      		<input type="checkbox" name="" onclick="if(this.checked){mshowCountry()} else {mhideCountry()}" disabled > If Birthplace is outside the Philippines
								      	</label>
								    </div>
								</div>
								<div id="mcountry" style="display:none;">
									<select class="select form-control" name="mCountry_name" id="mcountryid" onchange="mcountryfunction(this)" disabled>
									    <?php  
					      					include('connect.php');
					      					$sql = "SELECT * FROM `tbl_country`";
					      					$result = $conn->query($sql);
					      					while($row = $result->fetch_assoc()){
					      					echo "<option value='".$row['Country_name']."'>".$row['Country_name']."</option>";
						      				}
						      			?>
									</select>
								</div>
								<div id="mphil">
									<div id="mregion">
										<select class="select form-control" name="mRegion_name" id="mregionid" onchange="mregionfunction(this)" disabled>
										    <?php  
						      					include('connect.php');
						      					$sql = "SELECT * FROM `tbl_region`";
						      					$result = $conn->query($sql);
						      					while($row = $result->fetch_assoc()){
						      					echo "<option value='".$row['id']."_".$row['Region_name']."'>".$row['Region_name']."</option>";
						      					}
						      				?>
										</select>
									</div>  	
									<div id="mprovince">
										    	
									</div>
									<div id="mcities" style="padding-top: 15px">
												
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>        
							</div>
						</div>
					</div>
				</div>

                <div class="card container" id = "container4" style="display:none;">
                	<img class="img" src="lady liberty.png" style=" width: 85%;">
                    <h6 style="padding-top: 30px"><i class="fa fa-briefcase"> </i><b> WORK EXPERIENCE <small>(Most recent on top)</small></b></h6>  
                    <hr>
                           <!-- <button type="button" class="btn btn-raised btn-sm btn-info add_field_button_work">Add Work Experience</button> -->
                    
					<?php 
						include('connect.php');
						$ref_code = $_GET["ref"];
						$stor_count=0;
						$sql = "SELECT * FROM `tbl_application` where REFERENCE_NO = '$ref_code'";
						$result = $conn->query($sql);
						echo"<div class='input_fields_wrap_work'>";
						while($row = $result->fetch_assoc()){
							if($row["1.1 Employer's Name, Address and Phone"]==''){
								
							}
							else{
							echo'<script>var t_count = 1;</script>';
							if($row['1. Inclusive Dates']==''){
								$date11 = '';
								$date22 = '';
							}else{
								$date1= explode(" - ",$row['1. Inclusive Dates']);
								$date11 = $date1[0];
								$date22 = $date1[1];
							}
							
							$tempE = explode("$$",$row["1.1 Employer's Name, Address and Phone"]);
							$tempA = explode("%%",$tempE[1]);
							$tempC = explode("%%",$row["1.1 Employer's Name, Address and Phone"]);
							$res_con = explode("$$",$tempC[0]); 
							$stor_count++;
							echo'
								<div class="row col-md-12">
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="from"><i class="fa fa-calendar"></i> From:</label>
									  <div class="input-group">
										<input class="form-control date" value="'.$date11.'" data-provide="datepicker" name="datefrom" id="from" data-date-autoclose="true"   data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="to"><i class="fa fa-calendar"></i> To:</label>
									  <div class="input-group">
										<input class="form-control date" data-provide="datepicker" value="'.$date22.'" name="dateto" id="dateto" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_name">Company Name</label>
									  <input disabled class="form-control" type="text" value="'.$tempE[0].'" name="company_name" id="employers_name1"';
									  if($app_stat=='exp'){
										  echo 'required';
									  }
									  echo'>
									  <div class="help-block with-errors" style="color: red;"></div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_contact_number">Contact number</label>
									  <input class="form-control" type="number" value="'.$res_con[1].'" name="contactnum" id="employers_contact_number" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_address">Company address</label>
									  <input class="form-control" type="text" value="'.$tempA[1].'" name="compadd" id="employers_address" disabled>
									</div>
								  </div>
								  </div>
								  <div class="row col-md-12">
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="position-title">Position Title</label>
									  <input class="form-control" type="text" value="'.$row["1.2 Position Title"].'" name="position" id="position-title" disabled>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group label-floating">
									  <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
									  <input class="form-control" type="text" value="'.$row["1.3 Name_Position and Contact No. of Immediate Supervisor"].'" name="supervisor" id="name-supervisor" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="monthly-salary">Monthly salary</label>
									  <input class="form-control" type="number" value="'.$row["1.4 Monthly Salary"].'" name="salary" id="monthlysalary" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="reason">Reason of leaving</label>
									  <input class="form-control" value="'.$row["1.5 Reason for Leaving"].'" type="text" name="reason" id="reason" disabled>
									</div>
								  </div>
							  </div>';
							}
							if($row['2. Inclusive Dates']==''||$row["2.1 Employer's Name, Address and Phone"]==''||$row["2.2 Position Title"]==''||$row["2.3 Name_Position and Contact No. of Immediate Supervisor"]==''||$row["2.4 Monthly Salary"]==''||$row["2.5 Reason for Leaving"]==''){
								
							}
							else{
								echo'<script>t_count++;</script>';
							$date2= explode(" - ",$row['2. Inclusive Dates']);
							$tempE2 = explode("$$",$row["2.1 Employer's Name, Address and Phone"]);
							$tempA2 = explode("%%",$tempE2[1]);
							$tempC2 = explode("%%",$row["2.1 Employer's Name, Address and Phone"]);
							$res_con2 = explode("$$",$tempC2[0]); 
							
							$stor_count++;
							echo'
								<div class="row col-md-12">
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="from"><i class="fa fa-calendar"></i> From:</label>
									  <div class="input-group">
										<input class="form-control date" value="'.$date2[0].'" data-provide="datepicker" name="datefrom2" id="from" data-date-autoclose="true"   data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="to"><i class="fa fa-calendar"></i> To:</label>
									  <div class="input-group">
										<input class="form-control date" data-provide="datepicker" value="'.$date2[1].'" name="dateto2" id="to" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_name">Company Name</label>
									  <input class="form-control" type="text" value="'.$tempE2[0].'" name="company_name2" id="employers_name1" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_contact_number">Contact number</label>
									  <input class="form-control" type="number" value="'.$res_con2[1].'" name="contactnum2" id="employers_contact_number" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_address">Company address</label>
									  <input class="form-control" type="text" value="'.$tempA2[1].'" name="compadd2" id="employers_address" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="position-title">Position Title</label>
									  <input class="form-control" type="text" value="'.$row["2.2 Position Title"].'" name="position2" id="position-title" disabled>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group label-floating">
									  <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
									  <input class="form-control" type="text" value="'.$row["2.3 Name_Position and Contact No. of Immediate Supervisor"].'" name="supervisor2" id="name-supervisor" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="monthly-salary">Monthly salary</label>
									  <input class="form-control" type="number" value="'.$row["2.4 Monthly Salary"].'" name="salary2" id="monthly-salary" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="reason">Reason of leaving</label>
									  <input class="form-control" value="'.$row["2.5 Reason for Leaving"].'" type="text" name="reason2" id="reason" disabled>
									</div>
								  </div>
								  <!-- <button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button> -->
							  </div>';
							}if($row['3. Inclusive Dates']==''||$row["3.1 Employer's Name, Address and Phone"]==''||$row["3.2 Position Title"]==''||$row["3.3 Name_Position and Contact No. of Immediate Supervisor"]==''||$row["3.4 Monthly Salary"]==''||$row["3.5 Reason for Leaving"]==''){
								
							}
							else{
								echo'<script>t_count++;</script>';
							$stor_count++;
							$date3= explode(" - ",$row['3. Inclusive Dates']);
							$tempE3 = explode("$$",$row["3.1 Employer's Name, Address and Phone"]);
							$tempA3 = explode("%%",$tempE3[1]);
							$tempC3 = explode("%%",$row["3.1 Employer's Name, Address and Phone"]);
							$res_con3 = explode("$$",$tempC3[0]); 
							
							
							echo'
								<div class="row col-md-12">
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="from"><i class="fa fa-calendar"></i> From:</label>
									  <div class="input-group">
										<input class="form-control date" value="'.$date3[0].'" data-provide="datepicker" name="datefrom3" id="from" data-date-autoclose="true"   data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="to"><i class="fa fa-calendar"></i> To:</label>
									  <div class="input-group">
										<input class="form-control date" data-provide="datepicker" value="'.$date3[1].'" name="dateto3" id="to" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_name3">Company Name</label>
									  <input class="form-control" type="text" value="'.$tempE3[0].'" name="company_name3" id="employers_name2" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_contact_number">Contact number</label>
									  <input class="form-control" type="number" value="'.$res_con3[1].'" name="contactnum3" id="employers_contact_number" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_address">Company address</label>
									  <input class="form-control" type="text" value="'.$tempA3[1].'" name="compadd3" id="employers_address" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="position-title">Position Title</label>
									  <input class="form-control" type="text" value="'.$row["3.2 Position Title"].'" name="position3" id="position-title" disabled>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group label-floating">
									  <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
									  <input class="form-control" type="text" value="'.$row["3.3 Name_Position and Contact No. of Immediate Supervisor"].'" name="supervisor3" id="name-supervisor" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="monthly-salary">Monthly salary</label>
									  <input class="form-control" type="number" value="'.$row["3.4 Monthly Salary"].'" name="salary3" id="monthly-salary" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="reason">Reason of leaving</label>
									  <input class="form-control" value="'.$row["3.5 Reason for Leaving"].'" type="text" name="reason3" id="reason" disabled>
									</div>
								  </div>
								  <!-- <button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button> -->
							  </div>';
							}if($row['4. Inclusive Dates']==''||$row["4.1 Employer's Name, Address and Phone"]==''||$row["4.2 Position Title"]==''||$row["4.3 Name_Position and Contact No. of Immediate Supervisor"]==''||$row["4.4 Monthly Salary"]==''||$row["4.5 Reason for Leaving"]==''){
								
							}
							else{
								echo'<script>t_count++;</script>';
							$stor_count++;
							$date4= explode(" - ",$row['4. Inclusive Dates']);
							$tempE4 = explode("$$",$row["4.1 Employer's Name, Address and Phone"]);
							$tempA4 = explode("%%",$tempE3[1]);
							$tempC4 = explode("%%",$row["4.1 Employer's Name, Address and Phone"]);
							$res_con4 = explode("$$",$tempC3[0]); 
							
							
							echo'
								<div class="row col-md-12">
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="from"><i class="fa fa-calendar"></i> From:</label>
									  <div class="input-group">
										<input class="form-control date" value="'.$date4[0].'" data-provide="datepicker" name="datefrom4" id="from" data-date-autoclose="true"   data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="to"><i class="fa fa-calendar"></i> To:</label>
									  <div class="input-group">
										<input class="form-control date" data-provide="datepicker" value="'.$date4[1].'" name="dateto4" id="to" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_name">Company Name</label>
									  <input class="form-control" type="text" value="'.$tempE4[0].'" name="company_name4" id="employers_name3" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_contact_number">Contact number</label>
									  <input class="form-control" type="number" value="'.$res_con4[1].'" name="contactnum4" id="employers_contact_number" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_address">Company address</label>
									  <input class="form-control" type="text" value="'.$tempA4[1].'" name="compadd4" id="employers_address" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="position-title">Position Title</label>
									  <input class="form-control" type="text" value="'.$row["4.2 Position Title"].'" name="position4" id="position-title" disabled>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group label-floating">
									  <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
									  <input class="form-control" type="text" value="'.$row["4.3 Name_Position and Contact No. of Immediate Supervisor"].'" name="supervisor4" id="name-supervisor" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="monthly-salary">Monthly salary</label>
									  <input class="form-control" type="number" value="'.$row["4.4 Monthly Salary"].'" name="salary4" id="monthly-salary" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="reason">Reason of leaving</label>
									  <input class="form-control" value="'.$row["4.5 Reason for Leaving"].'" type="text" name="reason4" id="reason" disabled>
									</div>
								  </div>
								  <!-- <button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button> -->
							  </div>';
							}if($row['5. Inclusive Dates']==''||$row["5.1 Employer's Name, Address and Phone"]==''||$row["5.2 Position Title"]==''||$row["5.3 Name_Position and Contact No. of Immediate Supervisor"]==''||$row["5.4 Monthly Salary"]==''||$row["5.5 Reason for Leaving"]==''){
								
							}
							else{
								echo'<script>t_count++;</script>';
							$stor_count++;
							$date5= explode(" - ",$row['5. Inclusive Dates']);
							$tempE5 = explode("$$",$row["5.1 Employer's Name, Address and Phone"]);
							$tempA5 = explode("%%",$tempE5[1]);
							$tempC5 = explode("%%",$row["5.1 Employer's Name, Address and Phone"]);
							$res_con5 = explode("$$",$tempC5[0]); 
							
							
							echo'
								<div class="row col-md-12">
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="from"><i class="fa fa-calendar"></i> From:</label>
									  <div class="input-group">
										<input class="form-control date" value="'.$date5[0].'" data-provide="datepicker" name="datefrom5" id="from" data-date-autoclose="true"   data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="to"><i class="fa fa-calendar"></i> To:</label>
									  <div class="input-group">
										<input class="form-control date" data-provide="datepicker" value="'.$date5[1].'" name="dateto5" id="to" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_name">Company Name</label>
									  <input class="form-control" type="text" value="'.$tempE5[0].'" name="company_name5" id="employers_name4" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_contact_number">Contact number</label>
									  <input class="form-control" type="number" value="'.$res_con5[1].'" name="contactnum5" id="employers_contact_number" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_address">Company address</label>
									  <input class="form-control" type="text" value="'.$tempA5[1].'" name="compadd5" id="employers_address" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="position-title">Position Title</label>
									  <input class="form-control" type="text" value="'.$row["5.2 Position Title"].'" name="position5" id="position-title" disabled>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group label-floating">
									  <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
									  <input class="form-control" type="text" value="'.$row["5.3 Name_Position and Contact No. of Immediate Supervisor"].'" name="supervisor5" id="name-supervisor" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="monthly-salary">Monthly salary</label>
									  <input class="form-control" type="number" value="'.$row["5.4 Monthly Salary"].'" name="salary5" id="monthly-salary" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="reason">Reason of leaving</label>
									  <input class="form-control" value="'.$row["5.5 Reason for Leaving"].'" type="text" name="reason5" id="reason" disabled>
									</div>
								  </div>
								  <!-- <button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button> -->
							  </div>';
							} 
							
						
						
						}
						
						if($stor_count==0){
							echo'
								<div class="row col-md-12">
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="from"><i class="fa fa-calendar"></i> From:</label>
									  <div class="input-group">
										<input class="form-control date"  data-provide="datepicker" name="datefrom" id="from" data-date-autoclose="true"   data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="to"><i class="fa fa-calendar"></i> To:</label>
									  <div class="input-group">
										<input class="form-control date" data-provide="datepicker"  name="dateto" id="to" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
									  </div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_name">Company Name</label>
									  <input class="form-control" type="text"  name="company_name" id="employers_name1" disabled>
									  <div class="help-block with-errors" style="color: red"></div>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_contact_number">Contact number</label>
									  <input class="form-control" type="number"  name="contactnum" id="employers_contact_number" disabled>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="employers_address">Company address</label>
									  <input class="form-control" type="text"  name="compadd" id="employers_address" disabled>
									  <div class="help-block with-errors" style="color: red"></div>
									</div>
								  </div>
								  </div>
								  <div class="row col-md-12">
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="position-title">Position Title</label>
									  <input class="form-control" type="text"  name="position" id="position-title" disabled>
									  <div class="help-block with-errors" style="color: red"></div>
									</div>
								  </div>
								  <div class="col-md-4">
									<div class="form-group label-floating">
									  <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
									  <input class="form-control" type="text"  name="supervisor" id="name-supervisor" disabled>
									</div>
								  </div>
								  <div class="col-md-2">
									<div class="form-group label-floating">
									  <label class="control-label" for="monthly-salary">Monthly salary</label>
									  <input class="form-control" type="number"  name="salary" id="monthlysalary" disabled>
									  <div class="help-block with-errors" style="color: red"></div>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group label-floating">
									  <label class="control-label" for="reason">Reason of leaving</label>
									  <input class="form-control"  type="text" name="reason" id="reason" disabled>
									  <div class="help-block with-errors" style="color: red"></div>
									</div>
								  </div>
								  
							  </div>';
						}
						echo"</div>";
					?>
					

                    <div class="row col-md-12">
	                    <h6 style="margin-top: 30px; pull-left"><i class="fa fa-graduation-cap"> </i><b> EDUCATIONAL BACKGROUND </b></h6>
	                    <hr>
	                    	<div class="col-md-12">
	                    		<label><b>Primary:</b></label>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="school">Name of School</label>
	                    			<input type="text" value="<?php echo $elem_name;?>" name="elem_name" class="form-control" id="school" disabled>
	                    		</div>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
	                    		<div class="input-group input-daterange">
									<input data-provide="datepicker" value="<?php
									if($elem_inclusive_date!=''){
									$elem_from = explode(" - ",$elem_inclusive_date);
									echo $elem_from[0];
									}
									?>" name="elem_datefrom" id="pfrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
									<div class="input-group-addon">to</div>
									<input data-provide="datepicker" value="<?php
									if($elem_inclusive_date!=''){
									$elem_to = explode(" - ",$elem_inclusive_date);
									echo $elem_to[1];
									}
									?>" name="elem_dateto" id="pto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
								</div>
			                   <!--  <div class="col-md-6">
			                    	<div class="form-group label-floating">
			                    		<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
			                    		<input data-provide="datepicker"  name="elem_datefrom" id="pfrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly>
			                    	</div>
			                    </div>
			                    <div class="col-md-6">
			                    	<div class="form-group label-floating">
			                    		<label class="control-label" for="pto"><i class="fa fa-calendar" ></i> To:</label>
			                    		<input data-provide="datepicker" name="elem_dateto" id="pto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly>
			                    	</div>
			                    </div> -->
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
	                    			<input type="text" value="<?php echo $elem_scholar;?>" class="form-control" id="scholarship" name="elem_scholarship" disabled>
	                    		</div>
	                    	</div>
	                    	<div class="col-md-12">
	                    		<label><b>Secondary:</b></label>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="school">Name of School</label>
	                    			<input type="" value="<?php echo $hs_name;?>" name="hs_name" class="form-control" id="school" disabled>
	                    		</div>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
	                    		<div class="input-group input-daterange">
									<input data-provide="datepicker" value="<?php
									if($hs_inclusive_date!=''){
									$hs_from = explode(" - ",$hs_inclusive_date);
									echo $hs_from[0];
									}
									?>" name="hs_datefrom" id="sfrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
									<div class="input-group-addon">to</div>
									<input data-provide="datepicker" value="<?php
									if($hs_inclusive_date!=''){
									$hs_to = explode(" - ",$hs_inclusive_date);
									echo $hs_to[1];
									}
									?>" name="hs_dateto" id="sto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
								</div>


		                    	<!-- <div class="col-md-6">
		                    		<div class="form-group label-floating">
		                    			<label class="control-label" for="sfrom"><i class="fa fa-calendar" ></i> From:</label>
		                    			<input data-provide="datepicker" name="hs_datefrom" id="sfrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d">
		                    		</div>
		                    	</div>
		                    	<div class="col-md-6">
		                    		<div class="form-group label-floating">
		                    			<label class="control-label" for="sto"><i class="fa fa-calendar" ></i> To:</label>
		                    			<input data-provide="datepicker" name="hs_dateto" id="sto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly>
		                    		</div>
		                    	</div> -->
		                    </div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
	                    			<input type="text" value="<?php echo $hs_scholar;?>" class="form-control" id="scholarship" name="hs_scholarship" disabled>
	                    		</div>
	                    	</div>
	                    	<div class="col-md-12">
	                    		<label><b>Tertiary:</b></label>
	                    		<label style="padding-left: 2%">
	                    			<input type="checkbox" name="college_grad" id="college_grad" value="<?php echo $college_grad;?>" onclick="if(this.checked){showTertiary()} else {hideTertiary()}" 
									<?php
										
											if($college_grad=="YES"){
												echo 'checked'; 
												
											}else{
												echo "";
											}
										
									?> disabled>Graduated 
	                    		</label>
	                    	</div>
	                    	<div id="tertiary">
		                    	<div class="col-md-4">
		                    		<div class="form-group label-floating">
		                    			<label class="control-label" for="school">Name of School</label>
		                    			<input type="" name="col_name" id="col_name" value="<?php echo $col_name;?>" class="form-control" id="school" disabled>
		                    		</div>
		                    	</div>
								
		                    	<div class=" col-md-3" id="col_from" style="display: <?php if($college_grad=="YES"){echo"block";}else{echo"none";}?>; ">
		                    		<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
									
		                    		<div class="input-group input-daterange">
										<input data-provide="datepicker" value="<?php
									$col_from = explode(" - ",$col_inclusive_date);
									echo $col_from[0];
									?>" name="col_datefrom" id="col_datefrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
											<div class="input-group-addon">to</div>
											
											<input data-provide="datepicker" value="<?php
											if($col_inclusive_date!=''){
												$col_to = explode(" - ",$col_inclusive_date);
												echo $col_to[1];
											}else{
												echo'';
											}
										?>" name="col_dateto" id="col_dateto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
									</div>

			                    </div>
								
								<div class=" col-md-3" id="col_to" style="display: <?php if($college_grad=='NO'){echo'block';}else{echo"none";}?>; ">
		                    		<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
									
		                    		<div class="input-group input-daterange">
										<input data-provide="datepicker" value="<?php
									$col_from = explode(" - ",$col_inclusive_date);
									echo $col_from[0];
									?>" name="col_datefrom2" id="col_datefrom2" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
											
									</div>

			                    </div>
								
								
								
			                    <div class="row col-md-5">
			                    	<div class="col-md-6">
			                    		<div class="form-group label-floating">
			                    			<label class="control-label" for="degree" style="font-size: small;">Degree Course /Vocational</label>
			                    			<input type="text" id="col_degree" value="<?php echo $col_course;?>" class="form-control" name="col_degree" disabled>
			                    		</div>
			                    	</div>
			                    	<div class="col-md-6">
			                    		<div class="form-group label-floating">
			                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
			                    			<input type="text" class="form-control" value="<?php echo $col_scholar;?>" id="col_scholarship" name="col_scholarship" disabled>
			                    		</div>
			                    	</div>
			                    </div>
		                    </div>
		                    <div id="gradStudies" >
		                    	<div class="col-md-12">
		                    		<label><b>Graduate Studies:</b></label>
		                    	</div>
		                    	<div class="col-md-4">
		                    		<div class="form-group label-floating">
		                    			<label class="control-label" for="school">Name of School</label>
		                    			<input type="" name="grad_name" value="<?php echo $grad_name;?>" class="form-control" id="grad_name" disabled>
		                    		</div>
		                    	</div>
		                    	<div class=" col-md-3">
		                    		<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
		                    		<div class="input-group input-daterange">
										<input data-provide="datepicker" value="<?php
										if($grad_inclusive_date!=''){
											$grad_from = explode(" - ",$grad_inclusive_date);
											echo $grad_from[0];}
										else{
											echo"";
										}
									?>" name="grad_datefrom" id="grad_datefrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
										<div class="input-group-addon">to</div>
										<input data-provide="datepicker" value="<?php
										if($grad_inclusive_date!=''){
											$grad_to = explode(" - ",$grad_inclusive_date);
											echo $grad_to[1];
										}
										else{
											echo'';
										}
									?>" name="grad_dateto" id="grad_dateto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly disabled>
									</div>

			                    	<!-- <div class="col-md-6">
			                    		<div class="form-group label-floating">
			                    			<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> From:</label>
			                    			<input data-provide="datepicker" name="grad_datefrom" id="pfrom" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly>
			                    		</div>
			                    	</div>
			                    	<div class="col-md-6">
			                    		<div class="form-group label-floating">
			                    			<label class="control-label" for="pfrom"><i class="fa fa-calendar" ></i> To:</label>
			                    			<input data-provide="datepicker" name="grad_dateto" id="pto" class="form-control date" data-date-autoclose="true"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-end-date="-1d" readonly>
			                    		</div>
			                    	</div> -->
			                    </div>
			                    <div class="row col-md-5">
			                    	<div class="col-md-6">
			                    		<div class="form-group label-floating">
			                    			<label class="control-label" for="degree" style="font-size: small;">Degree Course /Vocational</label>
			                    			<input type="text" id="grad_degree" value="<?php echo $grad_degree;?>" class="form-control" name="grad_degree" disabled>
			                    		</div>
			                    	</div>
			                    	<div class="col-md-6">
			                    		<div class="form-group label-floating">
			                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
			                    			<input type="text" class="form-control" value="<?php echo $grad_scholar;?>" id="grad_scholarship" name="grad_scholarship" disabled>
			                    		</div>
			                    	</div>
			                    </div>
		                    </div>
                    </div>
                    <div class="col-md-12">
                    	<h6 style="padding-top: 30px"><i class="fa fa-id-card"> </i><b> Professional Qualifications</b></small></h6>  
                    	<hr>
                            <!-- <button type="button" class="btn btn-raised btn-info btn-sm add_field_button_professional">Add Professional Qualification</button> -->
                    </div>
                    <div class="input_fields_wrap_professional">                     	
	                    <?php
							include("connect.php");
							$prof_count = 0;
							$license_select = "SELECT * FROM `tbl_application` where REFERENCE_NO = '$ref_code'";
							$license_result = $conn->query($license_select);
							while($row = $license_result->fetch_assoc()){
							if($row['PROF_License1']!='' ){
									echo'<script type="text/javascript">var l_count = 1;</script>';
									echo'<div class="row col-md-12">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="license">License/Certification</label>
												<input type="text" value="'.$row['PROF_License1'].'" class="form-control" name="license1" id="license" disabled>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group label-floating">
												<label class="control-label" for="rate">Rating</label>
												<input type="text" id="rate" value="'.$row['PROF_Rating1'].'" class="form-control" name="rating1" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dateg"><i class="fa fa-calendar" ></i> Date Grandted</label>
													<input data-provide="datepicker" value="'.$row['PROF_DateGranted1'].'" id="dateg" class="form-control date" name="dategranted1" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="institution">Granting Institution</label>
												<input type="text" class="form-control" value="'.$row['PROF_Institution1'].'" id="institution" name="institution1" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="license-number">License Number</label>
												<input type="number" class="form-control" value="'.$row['PROF_Licensennum1'].'" id="license-number" name="licensenum1" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dater"><i class="fa fa-calendar" ></i> Date Release</label>
													<input data-provide="datepicker" value="'.$row['PROF_DateReleased1'].'" class="form-control date" id="dater" name="datereleased1" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
									</div>';
									$prof_count++;
								}
								if($row['PROF_License2']!='' ){
									echo'<script type="text/javascript">l_count++;</script>';
									echo'<div class="row col-md-12">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="license">License/Certification</label>
												<input type="text" value="'.$row['PROF_License2'].'" class="form-control" name="license2" id="license" disabled>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group label-floating">
												<label class="control-label" for="rate">Rating</label>
												<input type="text" id="rate" value="'.$row['PROF_Rating2'].'" class="form-control" name="rating2" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dateg"><i class="fa fa-calendar" ></i> Date Grandted</label>
													<input data-provide="datepicker" value="'.$row['PROF_DateGranted2'].'" id="dateg" class="form-control date" name="dategranted2" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="institution">Granting Institution</label>
												<input type="text" class="form-control" value="'.$row['PROF_Institution2'].'" id="institution" name="institution2" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="license-number">License Number</label>
												<input type="number" class="form-control" value="'.$row['PROF_Licensennum2'].'" id="license-number" name="licensenum2" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dater"><i class="fa fa-calendar" ></i> Date Release</label>
													<input data-provide="datepicker" value="'.$row['PROF_DateReleased2'].'" class="form-control date" id="dater" name="datereleased2" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
									</div>';
									$prof_count++;
								}
								if($row['PROF_License3']!=''){
									echo'<script type="text/javascript">l_count++;</script>';
									echo'<div class="row col-md-12">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="license">License/Certification</label>
												<input type="text" value="'.$row['PROF_License3'].'" class="form-control" name="license3" id="license" disabled>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group label-floating">
												<label class="control-label" for="rate">Rating</label>
												<input type="text" id="rate" value="'.$row['PROF_Rating3'].'" class="form-control" name="rating3" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dateg"><i class="fa fa-calendar" ></i> Date Grandted</label>
													<input data-provide="datepicker" value="'.$row['PROF_DateGranted3'].'" id="dateg" class="form-control date" name="dategranted3" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="institution">Granting Institution</label>
												<input type="text" class="form-control" value="'.$row['PROF_Institution3'].'" id="institution" name="institution3" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="license-number">License Number</label>
												<input type="number" class="form-control" value="'.$row['PROF_Licensennum3'].'" id="license-number" name="licensenum3" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dater"><i class="fa fa-calendar" ></i> Date Release</label>
													<input data-provide="datepicker" value="'.$row['PROF_DateReleased3'].'" class="form-control date" id="dater" name="datereleased3" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
									</div>';
									$prof_count++;
								}
								if($prof_count==0){
									
									echo'<div class="row col-md-12">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="license">License/Certification</label>
												<input type="text" value="" class="form-control" name="license1" id="license" disabled>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group label-floating">
												<label class="control-label" for="rate">Rating</label>
												<input type="text" id="rate" value="" class="form-control" name="rating1" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dateg"><i class="fa fa-calendar" ></i> Date Grandted</label>
													<input data-provide="datepicker" value="" id="dateg" class="form-control date" name="dategranted1" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="institution">Granting Institution</label>
												<input type="text" class="form-control" value="" id="institution" name="institution1" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="license-number">License Number</label>
												<input type="number" class="form-control" value="" id="license-number" name="licensenum1" disabled>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group label-floating">
												<label class="control-label" for="dater"><i class="fa fa-calendar" ></i> Date Release</label>
													<input data-provide="datepicker" value="" class="form-control date" id="dater" name="datereleased1" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
											</div>
										</div>
									</div>';
								}
								
							}
							
							
							?>
                    </div>

                        <!-- buttons -->
                    <button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container3').style.display='block';document.getElementById('container4').style.display='none';">PREVIOUS</button>
                    <button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" id="frnext">NEXT</button>
					
                </div> <!-- end of container 4 -->

                <div class="card container" id="container5" style="display:none;">
					<img class="img" src="lady liberty.png" style=" width: 85%;" >
                	<h6 style="padding-top: 30px"><i class="fa fa-language"> </i><b> Language proficiency</b> </h6>  
                    <hr>
					<!-- <button type="button" class="btn btn-raised btn-sm btn-info add_field_button_language" value="Add another text input" onClick="addInput('dynamicInput');">Add Language</button> -->
					<div class="input_fields_wrap_language" >
						<?php
						include("connect.php");
						$lang_count=0;
							$lang_select = "SELECT l.*,a.ID FROM tbl_languages l inner join tbl_application a on a.ID = l.id where a.REFERENCE_NO = '$ref_code'";
							$lang_result = $conn->query($lang_select);
							while($row = $lang_result->fetch_assoc()){
								if($row["ONE_LANGUAGE"]!=''&&$row["ONE_SPEAK"]!=''&&$row["ONE_READ"]!=''&&$row["ONE_WRITE"]!=''){
									$lang_count++;
								echo'<div class="row col-md-12" id="dynamicInput">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="language">Language you know</label>
												<input type="text" value="'.$row["ONE_LANGUAGE"].'" class="form-control" id="language" name=" language" disabled>
											</div>
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-1">
											<div class="form-group">
												<label> 
													<input type="checkbox" name="speak" value="yes"';
													if($row["ONE_SPEAK"]=='yes')echo'checked';else echo'';
													echo' disabled> Speak
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="write" value="yes"';
													if($row["ONE_WRITE"]=='yes')echo'checked';else echo'';
													echo' disabled> Write
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="read" value="yes"'; 
													if($row["ONE_READ"]=='yes')echo'checked';else echo'';
													echo' disabled> Read
												</label>
											</div>
										</div>
									</div>';
								}if($row["TWO_LANGUAGE"]!=''&&$row["TWO_SPEAK"]!=''&&$row["TWO_READ"]!=''&&$row["TWO_WRITE"]!=''){
									$lang_count++;
									echo'<div class="row col-md-12" id="dynamicInput">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="language">Language you know</label>
												<input type="text" value="'.$row["TWO_LANGUAGE"].'" class="form-control" id="language" name="language2" disabled>
											</div>
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="speak2" value="yes"'; 
													if($row["TWO_SPEAK"]=='yes')echo'checked';else echo'';echo' disabled> Speak
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="write2" value="yes"'; 
													if($row["TWO_WRITE"]=='yes')echo'checked';else echo'';
													echo' disabled> Write
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="read2" value="yes"';
													if($row["TWO_READ"]=='yes')echo'checked';else echo'';
													echo' disabled> Read
												</label>
											</div>
										</div><button type=button class="btn btn-sm btn-raised btn-danger remove_field" style="margin-top: 3%">Remove</button>
									</div>';
								}if($row["THREE_LANGUAGE"]!=''&&$row["THREE_SPEAK"]!=''&&$row["THREE_READ"]!=''&&$row["THREE_WRITE"]!=''){
									$lang_count++;
									echo'<div class="row col-md-12" id="dynamicInput">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="language">Language you know</label>
												<input type="text" value="'.$row["THREE_LANGUAGE"].'" class="form-control" id="language" name=" language3" disabled>
											</div>
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-1">
											<div class="form-group">
												<label> 
													<input type="checkbox" name="speak3" value="yes"';
													if($row["THREE_SPEAK"]=='yes')echo'checked';else echo'';
													echo' disabled> Speak
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="write3" value="yes"';
													if($row["THREE_WRITE"]=='yes')echo'checked';else echo'';
													echo' disabled> Write
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="read3" value="yes"';
													if($row["THREE_READ"]=='yes')echo'checked';else echo'';
													echo' disabled> Read
												</label>
											</div>
										</div><button type=button class="btn btn-sm btn-raised btn-danger remove_field" style="margin-top: 3%">Remove</button>
									</div>';
								}if($row["FOUR_LANGUAGE"]!=''&&$row["FOUR_SPEAK"]!=''&&$row["FOUR_READ"]!=''&&$row["FOUR_WRITE"]!=''){
									$lang_count++;
									echo'<div class="row col-md-12" id="dynamicInput">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="language">Language you know</label>
												<input type="text" value="'.$row["FOUR_LANGUAGE"].'" class="form-control" id="language" name=" language4" disabled>
											</div>
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-1">
											<div class="form-group">
												<label> 
													<input type="checkbox" name="speak4" value="yes"';
													if($row["FOUR_SPEAK"]=='yes')echo'checked';else echo'';
													echo' disabled> Speak
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="write4" value="yes"';
													if($row["FOUR_SPEAK"]=='yes')echo'checked';else echo'';
													echo' disabled> Write
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="read4" value="yes"';
													if($row["FOUR_READ"]=='yes')echo'checked';else echo'';
													echo' disabled> Read
												</label>
											</div>
										</div><button type=button class="btn btn-sm btn-raised btn-danger remove_field" style="margin-top: 3%">Remove</button>
									</div>';
								}if($row["FIVE_LANGUAGE"]!=''&&$row["FIVE_SPEAK"]!=''&&$row["FIVE_READ"]!=''&&$row["FIVE_WRITE"]!=''){
									$lang_count++;
									echo'<div class="row col-md-12" id="dynamicInput">
										<div class="col-md-3">
											<div class="form-group label-floating">
												<label class="control-label" for="language">Language you know</label>
												<input type="text" value="'.$row["FIVE_LANGUAGE"].'" class="form-control" id="language" name=" language5" disabled>
											</div>
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-1">
											<div class="form-group">
												<label> 
													<input type="checkbox" name="speak5" value="yes"';
													if($row["FIVE_SPEAK"]=='yes')echo'checked';else echo'';
													echo' disabled> Speak
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="write5" value="yes"';
													if($row["FIVE_WRITE"]=='yes')echo'checked';else echo'';
													echo' disabled> Write
												</label>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label>  
													<input type="checkbox" name="read5" value="yes"';
													if($row["FIVE_READ"]=='yes')echo'checked';else echo'';
													echo' disabled> Read
												</label>
											</div>
										</div><!-- <button type=button class="btn btn-sm btn-raised btn-danger remove_field" style="margin-top: 3%">Remove</button> -->
									</div>';
								}
							}
							if($lang_count==0){
								echo'<div class="row col-md-12" id="dynamicInput">
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label" for="language">Language you know</label>
									<input type="text" class="form-control" id="language" name=" language" disabled>
								</div>
							</div>
							<div class="col-md-12"></div>
							<div class="col-md-1">
								<div class="form-group">
									<label> 
										<input type="checkbox" name="speak" value="yes" disabled> Speak
									</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>  
										<input type="checkbox" name="write" value="yes" disabled> Write
									</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>  
										<input type="checkbox" name="read" value="yes" disabled> Read
									</label>
								</div>
							</div>
						</div>';
							}
						?>
						
						
					</div>

					<h6 style="padding-top: 30px"><b> Other Information</b> </h6>
					<hr>
					<div class="row col-md-4" >			
						<div class="form-group label-floating">
							<label class="control-label" for="checkup"><i class="fa fa-calendar" ></i> Last physical check-up </label>
							<div class="input-group">
								<input data-provide="datepicker" id="checkup" value="<?php echo $checkup;?>" class="form-control date" name="checkup" data-date-autoclose="true"  data-date-format="MM dd, yyyy" data-date-end-date="-1d" readonly disabled>
								<span class="input-group-addon add-on"><span class="fa fa-calendar"></span>
							</div>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-4">
							<div class="input_fields_wrap_skill">
								<!-- <button type="button" class="btn btn-raised btn-sm btn-info add_field_button_skill">ADD</button> -->
									<?php 
										include("connect.php");
										$other_select = "SELECT o.*, a.ID FROM tbl_othersinfo o inner join tbl_application a on a.ID = o.ID WHERE a.REFERENCE_NO = '$ref_code'";
										$skill_result = $conn->query($other_select);
										$c = 1;
										$skill_c = 0;
										while($row = $skill_result->fetch_assoc()){
											if($row["SKILLS1"]!=''){
												$skill_c++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="skill1">Special Skill/Hobbies</label>
														<input type="text" class="form-control" value="'.$row["SKILLS1"].'" id="skill1" name="skill1" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
												</div>';
											}if($row["SKILLS2"]!=''){
												$skill_c++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="skill2">Special Skill/Hobbies</label>
														<input type="text" class="form-control" value="'.$row["SKILLS2"].'" id="skill2" name="skill2" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
												</div>';
											}if($row["SKILLS3"]!=''){
												$skill_c++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="skill3">Special Skill/Hobbies</label>
														<input type="text" class="form-control" value="'.$row["SKILLS3"].'" id="skill3" name="skill3" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
												</div>';
											}
											
												$c++;
										}
										if($skill_c==0){
											echo'<div class="form-group label-floating">
														<label class="control-label" for="skill1">Special Skill/Hobbies</label>
														<input type="text" class="form-control" id="skill1" name="skill1" disabled>
											</div>';
										}
											?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input_fields_wrap_nacad">
								<!-- <button type="button" class="btn btn-raised btn-sm btn-info add_field_button_nacad">ADD</button> -->
								<?php 
										include("connect.php");
										$other_select = "SELECT o.*, a.ID FROM tbl_othersinfo o inner join tbl_application a on a.ID = o.ID WHERE a.REFERENCE_NO = '$ref_code'";
										$rec_result = $conn->query($other_select);
										$x = 1;
										$ac_count=0;
										while($row = $rec_result->fetch_assoc()){
											if($row["RECOGNITION1"]!=''){
												$ac_count++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="nacad">Non-Academic Distinction / Recognition</label>
														<input type="text" class="form-control" value="'.$row["RECOGNITION1"].'" id="nacad" name="recognition1" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
													</div>';
											}if($row["RECOGNITION2"]!=''){
												$ac_count++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="nacad">Non-Academic Distinction / Recognition</label>
														<input type="text" class="form-control" value="'.$row["RECOGNITION2"].'" id="nacad" name="recognition2" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
													</div>';
											}if($row["RECOGNITION3"]!=''){
												$ac_count++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="nacad">Non-Academic Distinction / Recognition</label>
														<input type="text" class="form-control" value="'.$row["RECOGNITION3"].'" id="nacad" name="recognition3" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
													</div>';
											}
											
											$x++;
										}
											if($ac_count==0){
												echo'<div class="form-group label-floating">
													<label class="control-label" for="nacad1">Non-Academic Distinction / Recognition</label>
													<input type="text" class="form-control" id="nacad1" name="recognition1" disabled>
												</div>';
											}
										?>
								
								
								
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="input_fields_wrap_org">
								<!-- <button type="button" class="btn btn-raised btn-sm btn-info add_field_button_org">ADD</button> -->
									<?php 
										include("connect.php");
										$org_select = "SELECT o.*, a.ID FROM tbl_othersinfo o inner join tbl_application a on a.ID = o.ID WHERE a.REFERENCE_NO = '$ref_code'";
										$org_result = $conn->query($other_select);
										$y = 1;
										$org_count =0;
										while($row = $org_result->fetch_assoc()){
											if($row["ORG1"]!=''){
												$org_count++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="org1">Membership in Association / Organization</label>
														<input type="text" class="form-control" value="'.$row["ORG1"].'" id="org1" name="org1" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
												</div>';
											}if($row["ORG2"]!=''){
												$org_count++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="org2">Membership in Association / Organization</label>
														<input type="text" class="form-control" value="'.$row["ORG2"].'" id="org" name="org2" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
												</div>';
											}if($row["ORG3"]!=''){
												$org_count++;
												echo'<div class="form-group label-floating">
														<label class="control-label" for="org3">Membership in Association / Organization</label>
														<input type="text" class="form-control" value="'.$row["ORG3"].'" id="org3" name="org3" disabled><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>
												</div>';
											}
											$y++;
										}
											if($org_count==0){
												echo'<div class="form-group label-floating">
													<label class="control-label" for="org1">Membership in Association / Organization</label>
													<input type="text" class="form-control" id="org1" name="org1" disabled>
												</div>';
											}
										?>
								
							</div>
						</div>
					</div>
					
					<div class="row col-md-12">			
					<h6 style="margin-top: 10px"><b> Character Reference</b> (Person not related by consanguity or affinity to you)</h6>
					</div>
					<div class="">
						<div class="row col-md-12">
							<div class="col-md-5">
								<div class="form-group label-floating">
									<label class="control-label" for="rname">Name<label class="text-danger">*</label></label>
									<input type="text" class="form-control" value="<?php echo $ref_name1;?>" id="rname" name="ONE_REFNAME" minlength="2" required disabled>
           			 				<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label" for="cname">Company Name<label class="text-danger">*</label></label>
									<input type="text" class="form-control" value="<?php echo $ref_add1;?>" id="company_name1" name="ONE_REFADDRESS" minlength="2" required disabled>
           			 				<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label" for="eadd">Tel No. / Email Address<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="email1" value="<?php echo $ref_num1;?>" name="ONE_REFCONTACT" minlength="2" required disabled>
           			 				<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
						</div>
						<div class="row col-md-12">
							<div class="col-md-5">
								<div class="form-group label-floating">
									<label class="control-label" for="rname2">Name<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="rname2" value="<?php echo $ref_name2;?>" name="TWO_REFNAME" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label" for="cname">Company Name<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="cname2" value="<?php echo $ref_add2;?>" name="TWO_REFADDRESS" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label" for="eadd2">Tel No. / Email Address<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="eadd2" value="<?php echo $ref_num2;?>" name="TWO_REFCONTACT" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
						</div>
						<div class="row col-md-12">
							<div class="col-md-5">
								<div class="form-group label-floating">
									<label class="control-label" for="rname">Name<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="rname3" value="<?php echo $ref_name3;?>" name="THREE_REFNAME" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label" for="cname3">Company Name<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="cname3" value="<?php echo $ref_add3;?>" name="THREE_REFADDRESS" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label" for="eadd3">Tel No. / Email Address<label class="text-danger">*</label></label>
									<input type="text" class="form-control" id="eadd3" value="<?php echo $ref_num3;?>" name="THREE_REFCONTACT" required disabled>
									<div class="help-block with-errors" style="color: red"></div>
								</div>
							</div>
						</div>
						<div class="row col-md-12">
					      <div class="col-md-4">
					      	<div class="form-group">
					      		<label for="inputFile">File</label>
					      		<input type="file" name="fileToUpload" id="fileToUpload" accept="application/msword, application/pdf" disabled>
						 	 	<div class="input-group">
									<input type="text" readonly="" class="form-control" placeholder="Upload Resume in PDF or DocX Format">
									<span class="input-group-btn input-group-sm">
										<button type="button" class="btn btn-fab btn-fab-mini">
											<i class="fa fa-paperclip"></i>
										</button>
									</span>
								</div>
					      	</div>
					      </div>
						  <div class="col-md-4">
					      	<div class="form-group label-floating">
						        <center><label class="control-label" for="source">Your Photo:</label><br>
						        <a href="#" onclick="document.getElementById('fileup').click(); return false;"><img style="border-radius:50%;" id="blah" src="<?php if($image_directory!=''){echo $image_directory;}else{echo'img/profileBanner.png';}?>" width=100 height=100 alt="your image" /></a></br></br><center>
								<input type="file" name="fileup" id="fileup" accept="image/*" onchange="readURL(this);" disabled />
					      	</div>
					      </div>
					      <!--<div class="col-md-4">
					      	<div class="form-group label-floating">
						        <label class="control-label" for="source">Application Source</label>
						        <select id="source" name="sourcex" class="select form-control" onchange="showsource(this)">
									<?php if($app_source!='Twitter'&&$app_source!='My Opportunity'&&$app_source!='Linked In'&&$app_source!='Indeed'&&$app_source!='Facebook'&&$app_source!='Referral'&&$app_source!='Jobstreet'){echo '<option value="'.$app_source.'">'.$app_source.'</option>'; }?>
									
						        	<option value="Twitter" <?php if($app_source=='Twitter')echo'selected';?>>Twitter</option>
						        	<option value="My Opportunity" <?php if($app_source=='My Opportunity')echo'selected';?>>My Opportunity</option>
						        	<option value="Linked In" <?php if($app_source=='Linked In')echo'selected';?>>Linked In</option>
						        	<option value="Indeed" <?php if($app_source=='Indeed')echo'selected';?>>Indeed</option>
						        	<option value="Facebook" <?php if($app_source=='Facebook')echo'selected';?>>Facebook</option>
						        	<option value="Referral" <?php if($app_source=='Referral')echo'selected';?>>Referral</option>
						        	<option value="Jobstreet" <?php if($app_source=='Jobstreet')echo'selected';?>>Jobstreet</option>
						        	<option value="Others">Others</option>
						        </select>
					      	</div>
					      </div> 
						  <div class="col-md-4">
							<div id="souceothers" style="display:none;" class="form-group label-floating">
						      	<label class="control-label" for="sourcespec">Please specify</label>
						      	<input type="text" id="sourcespec" class="form-control" name="sourcespec">
						    </div>
						  </div> -->
						  
						</div>
					</div>
					
                	<input type="hidden" value="<?php echo $ap_stat;?>" name="ap_stat" id="ap_stat">
                	<!-- buttons -->
                	<button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container4').style.display='block';document.getElementById('container5').style.display='none';">PREVIOUS</button>
					<?php
					if(isset($_GET['iNt3RvI3w3r'])){
						echo'<button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" id="lnext">NEXT</button>';
					}
					if($ap_stat=='Unfinished'){
						echo'<button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" id="lnext">NEXT</button>';
					}else{
						echo'<button type="button" style="margin-bottom: 1%" id="fsubmit" class="btn btn-raised btn-info btn-md pull-right" data-toggle="modal" data-target="#modald">SUBMIT</button>';
					}
					?>
                    
                </div><!-- end of container 5 -->
				<!-- Start of container 6 -->
				<div class="card container" id="container6" style="display:none;">
					<img class="img" src="lady liberty.png" style=" width: 85%;">
					<h6 style="padding-top: 30px"><i class="fa fa-book"> </i><b> Essay Questions</b> </h6>  
					<hr>
					<div class="row col-md-12" >
						<?php
						include("connect.php");
						$ref_number = $_GET['ref'];
						$cnt_res = $conn->query("SELECT * from tbl_application where REFERENCE_NO = '$ref_number'");
							
							while($row10 = $cnt_res->fetch_assoc()) {
								$myID = $row10['ID']; 
							}
						
							$cnt_res = $conn->query("SELECT * from tbl_question");
							$row_cnt = $cnt_res->num_rows;
							echo'<input type="hidden" id="question_count" name="question_count" value="'.$row_cnt.'">';
							$cnt = 1;
							
							while($row4 = $cnt_res->fetch_assoc()) {
									$question = utf8_encode($row4['Question']);
									$questionID = $row4['Question_ID'];
								$get_ans = $conn->query("SELECT * from tbl_essay where Question_ID = '$questionID' and APPLICANT_ID = '$myID'");
								if($get_ans->num_rows > 0){
									while($row5 = $get_ans->fetch_assoc()) {
										$answer = $row5["Answer"];
										echo'<div class="form-group">
										<div class="form-group label-floating">
											  <label for="question'.$cnt.'" style="font-weight: 600;"><b> '.$cnt.'. </b>'.$question.'</label>
											  <textarea class="form-control" rows="5" name="question'.$cnt.'" id="question'.$cnt.'" required>'.$answer.'</textarea>
											  <p style="float:right;"><b><span id="word_left'.$cnt.'">300</span></b>(Max.300 words)</p>
											  <div class="help-block with-errors" style="color: red"></div>
											</div>
											</div>
											<br>';
										$cnt++;
									}
								}else{
								for ($x = 1; $x <= 4; $x++) {
									echo'<div class="form-group">
										<div class="form-group label-floating">
										  <label for="question'.$x.'" style="font-weight: 600;"><b> '.$x.'. </b>'.$question.'</label>
										  <textarea class="form-control" rows="5" name="question'.$x.'" id="question'.$x.'" required></textarea>
										  <p style="float:right;"><b><span id="word_left'.$x.'">300</span></b>(Max.300 words)</p>
										  <div class="help-block with-errors" style="color: red"></div>
										</div>
									</div>
									<br>';
								
								}
							}
									
						}
							
						?>
						
						
						<button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container5').style.display='block';document.getElementById('container6').style.display='none';">PREVIOUS</button>
						<button type="button" id="lastSubmit" style="margin-bottom: 1%" class="btn btn-raised btn-info btn-md pull-right"  data-toggle="modal" data-target="#modald">SUBMIT</button>
					</div>
				</div><!-- end of container 6 -->

                <div id="modald" class="modal fade" role="dialog" >
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				        <h3 class="modal-title"><center>Terms and Agreement</center></h3>
				      </div>
				      <div class="modal-body">
				      <p><medium>
				        I certify that the information contained in this application is
				        correct to the best of my knowledge. I understand that to falsify
				        information is grounds for refusing to hire me, or for discharge
				        should I be hired. I authorize any person, organization or 
				        company listed on this application to furnish you any and all 
				        information concerning my previous employment, education, and 
				        qualifications for employment, I agree to abide by the rules and
				        regulations of the company, which rules may be changed, withdrawn,
				        added or interpreted at any time, at the company's sole option and
				        without prior notice to me. I also acknowledge that my employment
				        may be terminated, or any offer or acceptance of employment 
				        withdrawn, at any time, with or without cause, and with or without
				        prior notice at the option of the company or myself.
				      </medium></p>
				      </div>
				      <div class="modal-footer">
				      <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
				        <input type="submit" class="btn btn-success btn-raised" name="submit" value="I Agree">
				      </div>
				    </div>
				  </div>
				</div>
				<input type="hidden" id="email_stats" name="email_stats" value="<?php echo $email_status;?>">
				<input type="hidden" id="col_grad" name="col_grad" value="<?php echo $col_gradd;?>">
				<input type="hidden" id="img_directory" name="img_directory" value="<?php echo $image_directory;?>">
				
				<input type="hidden" id="birthPlaceCountry" name="birthPlaceCountry" value="">
				<input type="hidden" id="birthPlaceRegion" name="birthPlaceRegion" value="">
				<input type="hidden" id="birthPlaceProvince" name="birthPlaceProvince" value="">
				<input type="hidden" id="birthPlaceCity" name="birthPlaceCity" value="">

				<input type="hidden" id="curAddRegion" name="curAddRegion" value="<?php echo $curRegion;?>">
				<input type="hidden" id="curAddProvince" name="curAddProvince" value="<?php echo $curProvince;?>">
				<input type="hidden" id="curAddCity" name="curAddCity" value="<?php echo $curMunicupality;?>">

				<input type="hidden" id="provAddRegion" name="provAddRegion" value="<?php echo $provRegion;?>">
				<input type="hidden" id="provAddProvince" name="provAddProvince" value="<?php echo $provProvince;?>">
				<input type="hidden" id="provAddCity" name="provAddCity" value="<?php echo $provMunicipality;?>">

				<input type="hidden" id="fatherCountry" name="fatherCountry" value="">
				<input type="hidden" id="fatherRegion" name="fatherRegion" value="<?php echo $f_region;?>">
				<input type="hidden" id="fatherProvince" name="fatherProvince" value="<?php echo $f_province;?>">
				<input type="hidden" id="fatherCity" name="fatherCity" value="<?php echo $f_municipality;?>">

				<input type="hidden" id="motherCountry" name="motherCountry" value="">
				<input type="hidden" id="motherRegion" name="motherRegion" value="">
				<input type="hidden" id="motherProvince" name="motherProvince" value="">
				<input type="hidden" id="motherCity" name="motherCity" value="">
				<input type="hidden" id="reference_code" name="reference_code" value="<?php echo $reference_no;?>">
				
				<input type="hidden" id="siblingchild" name="siblingchild" value="<?php echo $have_child;?>">
				<input type="hidden" id="app_stat" name="app_stat" value="<?php echo $app_stat;?>">
			</form>				
		</div>
		<div class="col-md-1"></div>
		
	</div>
	
	<footer class="panel-footer" style="background-color:#F0F8FF;">
		<center><p style="color: black; font-size:90%">
			Private and Confidential. Anderson Group BPO Inc. &copy; 2017
		</p></center>
	</footer>
	
	<script type="text/javascript" src="updateformvalidator.js"></script>
	<script type="text/javascript" src="js/validator.js"></script>	
	<!-- <script src="components/angular/angular.js"></script> -->
	<!-- <script src="components/angular-materializecss-datepicker/angular-materializecss-datepicker.js"></script> -->
	<script type="text/javascript">
		var click_count = 0;
		function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#blah')
					.attr('src', e.target.result)
					.width(100)
					.height(100);
			};

			reader.readAsDataURL(input.files[0]);
		}
		}
	</script>
	<script type="text/javascript">
	$( document ).ready(function() {
		$("#empdate").datepicker("update", "<?php echo $empdate;?>");
	});
		function updateemail(){
			var emailvalue =  $('#email').val();
			var refer_code =  $('#reference_code').val();
			$.ajax({
				url: "address.php",
				type: "GET",
				data: {updateemail:emailvalue,refer:refer_code},
				success: function(data){
					if(data=='Email already taken!'){
						$('#email').focus();
						document.getElementById('emailhelp').innerHTML = data;
					}
				},
				error: function(data){
					alert(data);
				}
			});
		}
			//count first question
			var q1 = document.getElementById("question1").value;
			var wordss1 = $.trim(q1).length ? q1.match(/\S+/g).length : 0;
			$('#word_left1').text(300-wordss1);
			//count second question
			var q2 = document.getElementById("question2").value;
			var wordss2 = $.trim(q2).length ? q2.match(/\S+/g).length : 0;
			$('#word_left2').text(300-wordss2);
			//count third question
			var q3 = document.getElementById("question3").value;
			var wordss3 = $.trim(q3).length ? q3.match(/\S+/g).length : 0;
			$('#word_left3').text(300-wordss3);
			//count third question
			var q4 = document.getElementById("question4").value;
			var wordss4 = $.trim(q4).length ? q4.match(/\S+/g).length : 0;
			$('#word_left4').text(300-wordss4);
			
		
		
			
		var civil_stat = $('#cstatus').val();
		if(civil_stat=='Married'){
			document.getElementById('married_div').style.display='block';
			document.getElementById('widowed_div').style.display='none';/*hide widowed status*/
		}
		else if(civil_stat=='Widowed'){
			document.getElementById('married_div').style.display='none';
			document.getElementById('widowed_div').style.display='block';/*show widowed status*/
		}else if(civil_stat=='Separated'){
			document.getElementById('widowed_div').style.display='none';/*hide widowed status*/
			document.getElementById('married_div').style.display='block';/*show separated status*/
		}else if(civil_stat=='Annuled'){
			document.getElementById('widowed_div').style.display='none';/*hide widowed status*/
			document.getElementById('married_div').style.display='none';/*show separated status*/
		}else{
			document.getElementById('widowed_div').style.display='none';/*hide widowed status*/
			document.getElementById('married_div').style.display='none';/*show separated status*/
		}
		

		// function for toggle child/sibling
		
    		$("#positive").click(function(){
       			if($("#siblings").attr('data-click-state') == 1) {
				$("#siblings").attr('data-click-state', 0);
				$("#siblings").show();
				$("#children").hide();
				document.getElementById("siblingchild").value=0;
				$('.wawchild input[type="text"]').val('');
				$('.wawchild input[type="number"]').val('');
				
				} else {
				$("#siblings").attr('data-click-state', 1);
				$("#children").show();
				$("#siblings").hide();
				document.getElementById("siblingchild").value=1;
				$('.wawsibling input[type="text"]').val('');
				$('.wawsibling input[type="number"]').val('');
				
				}
		});
		

		//functions for Birth Place
		function countryfunction(selectedCountry){
			$( "#birthPlaceCountry" ).val( selectedCountry.options[selectedCountry.selectedIndex].text )

			var country = $('#countryid').val();
			$("#placeofbirth").val(country);
			document.getElementById('birthPlaceRegion').value='';
			document.getElementById('birthPlaceCity').value='';
			document.getElementById('birthPlaceProvince').value='';


		}

		function regionfunction(selectedRegion){
			$( "#birthPlaceRegion" ).val( selectedRegion.options[selectedRegion.selectedIndex].text )

			var regid = $('#regionid').val();
			var splitted = regid.split("_");
			var rid = splitted[0];
			var rname = splitted[1];

			if (rid == 1) {
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, rname: rname, ajaxmanila: 1},
					success:function (data){
						document.getElementById('cities').innerHTML = "<select class='select form-control' onchange='ncrfunction(this)' name='cities' id='cityid'>"+data+"</select>";
		     			document.getElementById('province').style.display='none';
						document.getElementById('birthPlaceProvince').value='';
						
					},
					error: function(data){
						alert(data);	
					}
				});
			}
			else{
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, rname: rname, ajaxprovince: 1},
					success: function(data){
		     			document.getElementById('province').style.display='block';
						document.getElementById('province').innerHTML = "<select class='select form-control' onchange='provincefunction(this)' name='province' id='provinceid'>"+data+"</select>";
		     			document.getElementById('cities').style.display='block';
					},
					error: function(data){
						alert(data);	
					}
				});
			}
		}

		function ncrfunction(selectedCity){
			var cname = $('#cityid').val();
			$("#placeofbirth").val(cname);
			$( "#birthPlaceCity" ).val( selectedCity.options[selectedCity.selectedIndex].text )
		}

		var pid = "";
		var pname = "";

		function provincefunction(selectedProvince){

			$( "#birthPlaceProvince" ).val( selectedProvince.options[selectedProvince.selectedIndex].text )

			var provid = $('#provinceid').val();
			var provsplit = provid.split("_");
			pid = provsplit[0];
			pname = provsplit[1];

			$.ajax({
				url: "address.php",
				type: "POST",
				data: {pid: pid, pname: pname, ajaxcities: 1},
				success: function(data){
					document.getElementById('cities').innerHTML = "<select class='select form-control' onchange='citiesfunction(this)' name='cities' id='cityid'>"+data+"</select>";
				},
				error: function(data){
					alert(data);
				}
			});
		}

		function citiesfunction(selectedCity){

			var cname = $('#cityid').val();
			$("#placeofbirth").val(cname +", "+pname);


			$( "#birthPlaceCity" ).val( selectedCity.options[selectedCity.selectedIndex].text )
		}


		//functions for current address

		function cregionfunction(selectedCRegion){
			$( "#curAddRegion" ).val( selectedCRegion.options[selectedCRegion.selectedIndex].text )
			var regid = $('#cregionid').val();
			var splitted = regid.split("_");
			var rid = splitted[0];
			var rname = splitted[1];

			if (rid == 1) {
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, rname: rname, ajaxmanila: 1},
					success:function (data){
						document.getElementById('ccities').innerHTML = "<select class='select form-control' onchange='cncrfunction(this)' id='ccityid'>"+data+"</select>";
		     			document.getElementById('cprovince').style.display='none';
						document.getElementById('curAddProvince').value='';
						
					},
					error: function(data){
						alert(data);	
					}
				});
			}
			else{
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, rname: rname, ajaxprovince: 1},
					success: function(data){
						document.getElementById('cprovince').style.display='block';
						document.getElementById('cprovince').innerHTML = "<select class='select form-control' onchange='cprovincefunction(this)' id='cprovinceid'>"+data+"</select>";
		     			document.getElementById('ccities').style.display='block';
					},
					error: function(data){
						alert(data);	
					}
				});
			}
		}

		function cncrfunction(selectedCCity){
			var cname = $('#ccityid').val();
			$("#curaddress").val(cname);
			$( "#curAddCity" ).val( selectedCCity.options[selectedCCity.selectedIndex].text )
		}

		var pid = "";
		var cpname = "";

		function cprovincefunction(selectedCProvince){
			$( "#curAddProvince" ).val( selectedCProvince.options[selectedCProvince.selectedIndex].text )
			var provid = $('#cprovinceid').val();
			var provsplit = provid.split("_");
			pid = provsplit[0];
			cpname = provsplit[1];

			$.ajax({
				url: "address.php",
				type: "POST",
				data: {pid: pid, cpname: cpname, ajaxcities: 1},
				success: function(data){
					document.getElementById('ccities').innerHTML = "<select class='select form-control' onchange='ccitiesfunction(this)' id='ccityid'>"+data+"</select>";
				},
				error: function(data){
					alert(data);
				}
			});
		}
		function ccitiesfunction(selectedCCity){
			var cname = $('#ccityid').val();
			$("#curaddress").val(cname +", "+cpname);
			$( "#curAddCity" ).val( selectedCCity.options[selectedCCity.selectedIndex].text )
		}

		//functions for provincial address

		function pregionfunction(selectedPRegion){
			$( "#provAddRegion" ).val( selectedPRegion.options[selectedPRegion.selectedIndex].text )
			var regid = $('#pregionid').val();
			var splitted = regid.split("_");
			var rid = splitted[0];
			var rname = splitted[1];

			if (rid == 1) {
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, rname: rname, ajaxmanila: 1},
					success:function (data){
						document.getElementById('pcities').innerHTML = "<select class='select form-control' onchange='pncrfunction(this)' id='pcityid'>"+data+"</select>";
		     			document.getElementById('pprovince').style.display='none';
						document.getElementById('provAddProvince').value='';
					},
					error: function(data){
						alert(data);	
					}
				});
			}
			else{
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, rname: rname,ajaxprovince: 1},
					success: function(data){
						document.getElementById('pprovince').style.display='block';
						document.getElementById('pprovince').innerHTML = "<select class='select form-control' onchange='pprovincefunction(this)' id='pprovinceid'>"+data+"</select>";
		     			document.getElementById('pcities').style.display='block';
					},
					error: function(data){
						alert(data);	
					}
				});
			}
		}

		function pncrfunction(selectedPCity){
			var pname = $('#pcityid').val();
			$("#provaddress").val(pname);
			$( "#provAddCity" ).val( selectedPCity.options[selectedPCity.selectedIndex].text )
		}

		var pid = "";
		var ppname = "";

		function pprovincefunction(selectedPProvince){
			$( "#provAddProvince" ).val( selectedPProvince.options[selectedPProvince.selectedIndex].text )
			var provid = $('#pprovinceid').val();
			var provsplit = provid.split("_");
			pid = provsplit[0];
			ppname = provsplit[1];

			$.ajax({
				url: "address.php",
				type: "POST",
				data: {pid: pid, ppname: ppname, ajaxcities: 1},
				success: function(data){
					document.getElementById('pcities').innerHTML = "<select class='select form-control' onchange='pcitiesfunction(this)' id='pcityid'>"+data+"</select>";
				},
				error: function(data){
					alert(data);
				}
			});
		}
		function pcitiesfunction(selectedPCity){
			var cname = $('#pcityid').val();
			$("#provaddress").val(cname +", "+ppname);
			$( "#provAddCity" ).val( selectedPCity.options[selectedPCity.selectedIndex].text )
		}

		//for father place of birth
		function fcountryfunction(selectedfCountry){
			$( "#fatherCountry" ).val( selectedfCountry.options[selectedfCountry.selectedIndex].text )
			var country = $('#fcountryid').val();
			$("#fplace_birth").val(country);
		}

		function fregionfunction(selectedfRegion){
			$( "#fatherRegion" ).val( selectedfRegion.options[selectedfRegion.selectedIndex].text )
			var regval = $('#fregionid').val();
			var regsplit = regval.split("_");
			var rid = regsplit[0];
			var fregname = regsplit[1];

			if (rid == 1) {
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, fregname: fregname, ajaxmanila: 1},
					success:  function(data){
						document.getElementById('fcities').innerHTML = "<select class='select form-control' onchange='fncrfunction(this)' id='fcityid'>"+data+"</select>";
		     			document.getElementById('fprovince').style.display='none';
						document.getElementById('fatherProvince').value='';
					},
					error: function(data){
						alert(data);
					}
				});
			}
			else{
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, fregname: fregname, ajaxprovince: 1},
					success: function(data){
						document.getElementById('fprovince').style.display='block';
						document.getElementById('fprovince').innerHTML = "<select class='select form-control' onchange='fprovincefunction(this)' id='fprovinceid'>"+data+"</select>";
		     			document.getElementById('fcities').style.display='block';
					},
					error: function(data){
						alert(data);	
					}
				});
			}
		}

		function fncrfunction(selectedfCity){
			var fregname = $('#fcityid').val();
			$("#fplace_birth").val(fregname);
			$( "#fatherCity" ).val( selectedfCity.options[selectedfCity.selectedIndex].text )
		}

		var pid = "";
		var fname = "";

		function fprovincefunction(selectedfProvince){
			$( "#fatherProvince" ).val( selectedfProvince.options[selectedfProvince.selectedIndex].text )
			var fprovid = $('#fprovinceid').val();
			var fprovsplit = fprovid.split("_");
			pid = fprovsplit[0];
			fname = fprovsplit[1];

			$.ajax({
				url: "address.php",
				type: "POST",
				data: {pid: pid, fname: fname, ajaxcities: 1},
				success: function(data){
					document.getElementById('fcities').innerHTML = "<select class='select form-control' onchange='fcitiesfunction(this)' id='fcityid'>"+data+"</select>";
				},
				error: function(data){
					alert(data);
				}
			});
		}
		function fcitiesfunction(selectedfCity){
			var cname = $('#fcityid').val();
			$("#fplace_birth").val(cname +", "+fname);
			$( "#fatherCity" ).val( selectedfCity.options[selectedfCity.selectedIndex].text )
		}

		//for mother place of birth
		function mcountryfunction(selectedmCountry){
			$( "#motherCountry" ).val( selectedmCountry.options[selectedmCountry.selectedIndex].text )
			var country = $('#mcountryid').val();
			$("#mplace_birth").val(country);
		}

		function mregionfunction(selectedmRegion){
			$( "#motherRegion" ).val( selectedmRegion.options[selectedmRegion.selectedIndex].text )
			var regval = $('#mregionid').val();
			var regsplit = regval.split("_");
			var rid = regsplit[0];
			var mregname = regsplit[1];

			if (rid == 1) {
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, mregname: mregname, ajaxmanila: 1},
					success:  function(data){
						document.getElementById('mcities').innerHTML = "<select class='select form-control' onchange='mncrfunction(this)' id='mcityid'>"+data+"</select>";
		     			document.getElementById('mprovince').style.display='none';
						document.getElementById('motherProvince').value='';
					},
					error: function(data){
						alert(data);
					}
				});
			}
			else{
				$.ajax({
					url: "address.php",
					type: "POST",
					data: {rid: rid, mregname: mregname, ajaxprovince: 1},
					success: function(data){
						document.getElementById('mprovince').innerHTML = "<select class='select form-control' onchange='mprovincefunction(this)' id='mprovinceid'>"+data+"</select>";
		     			document.getElementById('mcities').style.display='block';
					},
					error: function(data){
						alert(data);	
					}
				});
			}
		}

		function mncrfunction(selectedmCity){
			var mregname = $('#mcityid').val();
			$("#mplace_birth").val(mregname);
			$( "#motherCity" ).val( selectedmCity.options[selectedmCity.selectedIndex].text )
		}

		var pid = "";
		var mname = "";

		function mprovincefunction(selectedmProvince){
			$( "#motherProvince" ).val( selectedmProvince.options[selectedmProvince.selectedIndex].text )
			var mprovid = $('#mprovinceid').val();
			var mprovsplit = mprovid.split("_");
			pid = mprovsplit[0];
			mname = mprovsplit[1];

			$.ajax({
				url: "address.php",
				type: "POST",
				data: {pid: pid, mname: mname, ajaxcities: 1},
				success: function(data){
					document.getElementById('mcities').innerHTML = "<select class='select form-control' onchange='mcitiesfunction(this)' id='mcityid'>"+data+"</select>";
				},
				error: function(data){
					alert(data);
				}
			});
		}
		function mcitiesfunction(selectedmCity){
			var cname = $('#mcityid').val();
			$("#mplace_birth").val(cname +", "+mname);
			$( "#motherCity" ).val( selectedmCity.options[selectedmCity.selectedIndex].text )
		}

		//for not graduate
		function hideTertiary(){
			document.getElementById('col_grad').value = "NO";
			document.getElementById('col_to').style.display = "block";
			document.getElementById('col_from').style.display = "none";
		}
		function showTertiary(){
			document.getElementById('col_grad').value = "YES";
			document.getElementById('col_to').style.display = "none";
			document.getElementById('col_from').style.display = "block";
		}


		// function for select civil status
		function showspec(elem){
		   if(elem.value == "Others"){
	      		document.getElementById('other_div').style.display = "block";
	      		document.getElementById('widowed_div').style.display = "none";
		  		document.getElementById('married_div').style.display = "none";
		   }
		   else if (elem.value == "Married") {
		   		document.getElementById('married_div').style.display = "block";
		   		document.getElementById('widowed_div').style.display = "none";
		   		document.getElementById('other_div').style.display = "none";
		   }
		   else if (elem.value == "Widowed") {
		   		document.getElementById('widowed_div').style.display = "block";
		   		document.getElementById('married_div').style.display = "none";
		   		document.getElementById('other_div').style.display = "none";
		   }
		    else if (elem.value == "Separated") {
		   		document.getElementById('married_div').style.display = "block";
		   		document.getElementById('widowed_div').style.display = "none";
		   		document.getElementById('other_div').style.display = "none";
		   }

		  else{
		  		document.getElementById('other_div').style.display = "none";
		  		document.getElementById('widowed_div').style.display = "none";
		  		document.getElementById('married_div').style.display = "none";
		  }
		}

		function showCountry(){
			document.getElementById('country').style.display = "block";
			document.getElementById('phil').style.display = "none";
		};

		function hideCountry(){
			document.getElementById('phil').style.display = "block";
			document.getElementById('country').style.display = "none";
		};

		function fshowCountry(){
			document.getElementById('fcountry').style.display = "block";
			document.getElementById('fphil').style.display = "none";
			document.getElementById('fatherCity').value = "";
			document.getElementById('fatherRegion').value = "";
			document.getElementById('fatherProvince').value = "";
		};

		function fhideCountry(){
			document.getElementById('fphil').style.display = "block";
			document.getElementById('fcountry').style.display = "none";
		};

		function mshowCountry(){
			document.getElementById('mcountry').style.display = "block";
			document.getElementById('mphil').style.display = "none";
			document.getElementById('motherCity').value = "";
			document.getElementById('motherRegion').value = "";
			document.getElementById('motherProvince').value = "";
		};

		function mhideCountry(){
			document.getElementById('mphil').style.display = "block";
			document.getElementById('mcountry').style.display = "none";
		};

		function showsource(source){
			if (source.value == 'Others') {
				document.getElementById('souceothers').style.display = "block";
			}
			else{
				document.getElementById('souceothers').style.display = "none";
			}
		}

		      $(document).ready(function() {
		        $(".select").dropdown({"optionClass": "withripple"});

		      });

		      $().dropdown({autoinit: "select"});

            // function for adding fields child
            $(document).ready(function() { 
                var max_fields = 10; 
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_button = $(".add_field_button"); //Add button ID
                
                var x = 3; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-6"></div><div class="col-md-6"><div class="col-md-7"><div class="form-group label-floating"><label class="control-label" for="child" >Enter child name</label><input type="text" name="child_name' + x + '" id="child" class="form-control"></div></div> <div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="age">Age</label><input id="age" class="form-control" type="number" name="child_age' + x + '"/></div></div><button type=button style="margin-top: 8%" class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });


 

            // function for adding fields sibling
            $(document).ready(function() { 
                var max_fields = 10; 
                var wrapper = $(".input_fields_wrap_sibling"); //Fields wrapper
                var add_button = $(".add_field_button_sibling"); //Add button ID
                
                var x = 3; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-6"><div class="col-md-7"><div class="form-group label-floating"><label class="control-label" for="sibling" >Enter sibling name</label><input type="text" id="sibling" class="form-control" name="sibling' + x + '"></div></div> <div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="sage">Age</label><input id="sage" name="sibling_age' + x + '" class="form-control" type="number"/></div></div><button type=button style="margin-top: 7%" class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

            // function for adding fields work
            $(document).ready(function() { 
                var max_fields = 5; 
                var wrapper = $(".input_fields_wrap_work"); //Fields wrapper
                var add_button = $(".add_field_button_work"); //Add button ID
                 //Add button ID
				var x = <?php echo $stor_count;?>;
                
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class=""><div class="row col-md-12"><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="from"><i class="fa fa-calendar" ></i> From:</label><div class="input-group"><input class="form-control date" data-provide="datepicker" name="datefrom' + x + '" id="from"  data-date-min-view-mode="1" data-date-format="M yyyy" data-date-autoclose="true"  data-date-end-date="-1d" readonly><span class="input-group-addon add-on"><span class="fa fa-calendar"></span></div></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="to"><i class="fa fa-calendar" ></i> To:</label><div class="input-group"><input class="form-control date" data-provide="datepicker" name="dateto' + x + '" id="to"  data-date-min-view-mode="1" data-date-autoclose="true"  data-date-format="M yyyy" data-date-end-date="-1d" readonly><span class="input-group-addon add-on"><span class="fa fa-calendar"></span></div></div></div><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="employers_name">Company`s Name</label><input class="form-control" type="text" name="company_name' + x + '" id="employers_name"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="employers_contact_number">Contact number</label><input class="form-control" type="number" name="contactnum' + x + '" id="employers_contact_number"></div></div><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="employers_address">Company`s address</label><input class="form-control" type="text" name="compadd' + x + '" id="employers_address"></div></div><div class ="col-md-3"><div class="form-group label-floating"><label class="control-label" for="position-title">Position Title</label><input class="form-control" type="text" name="position' + x + '" id="position-title"></div></div><div class="col-md-4"><div class="form-group label-floating"><label class="control-label" for="name-supervisor">Name of immediate supervisor</label><input class="form-control" type="text" name="supervisor' + x + '" id="name-supervisor"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="monthly-salary">Monthly salary</label><input class="form-control" type="number" name="salary' + x + '" id="monthly-salary"></div></div><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="reason">Reason of leaving</label><input class="form-control" type="text" name="reason' + x + '" id="reason"></div></div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></div>'); //add input box
						
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

            // function for adding fields professional qualification
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_professional"); //Fields wrapper
                var add_button = $(".add_field_button_professional"); //Add button ID
                
                var x = <?php echo $prof_count;?>; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="license">License/Certification</label><input type="text" class="form-control" name="license' + x + '" id="license"></div></div><div class="col-md-1"><div class="form-group label-floating"><label class="control-label" for="rate">Rating</label><input type="text" id="rate" class="form-control" name="rating' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="dateg"><i class="fa fa-calendar" ></i> Date Grandted</label><input data-provide="datepicker" id="dateg" class="form-control date" name="dategranted' + x + '" data-date-format="MM dd, yyyy" data-date-autoclose="true"  data-date-end-date="-1d" readonly></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="institution">Granting Institution</label><input type="text" class="form-control" id="institution" name="institution' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="license-number">License Number</label><input type="number" class="form-control" id="license-number" name="licensenum' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="dater"><i class="fa fa-calendar" ></i> Date Release</label><input data-provide="datepicker" class="form-control date" id="dater" name="datereleased' + x + '" data-date-format="MM dd, yyyy" data-date-autoclose="true"  data-date-end-date="-1d" readonly></div></div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></br>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

             // function for adding fields language
            $(document).ready(function() { 
                var max_fields = 5; 
                var wrapper = $(".input_fields_wrap_language"); //Fields wrapper
                var add_button = $(".add_field_button_language"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="language">Language you know</label><input type="text" class="form-control" id="language" name="language' + x + '"></div></div><div class="col-md-12"></div><div class="col-md-1"><div class="form-group"><label><input type="checkbox" name="speak' + x + '" value= "yes"> Speak</label></div></div><div class="col-md-1"><div class="form-group"><label> <input type="checkbox" name="write' + x + '" value="yes"> Write</label></div></div><div class="col-md-1"><div class="form-group"><label> <input type="checkbox" name="read' + x + '" value="yes"> Read</label></div></div><button type=button class="btn btn-sm btn-raised btn-danger remove_field" style="margin-top: 3%">Remove</button></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

            // function for adding fields Skills and hobbies
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_skill"); //Fields wrapper
                var add_button = $(".add_field_button_skill"); //Add button ID
                
                var x = <?php echo $skill_c;?>; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="form-group label-floating"><label class="control-label" for="skill">Special Skill/Hobbies</label><input type="text" class="form-control" id="skill" name="skill' + x + '"><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });


            // function for adding fields Non-academic
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_nacad"); //Fields wrapper
                var add_button = $(".add_field_button_nacad"); //Add button ID
                
                var x = <?php echo $ac_count;?>; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="form-group label-floating"><label class="control-label" for="nacad">Non-Academic Distinction / Recognition</label><input type="text" class="form-control" id="nacad" name="recognition' + x + '"><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });
        
        	// function for adding fields Members in Association and Organizations
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_org"); //Fields wrapper
                var add_button = $(".add_field_button_org"); //Add button ID
                
                var x = <?php echo $org_count;?>; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="form-group label-floating"><label class="control-label" for="org">Membership in Association / Organizations</label><input type="text" class="form-control" id="org" name="org' + x + '"><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

       

            // function for toggle child/sibling
	

		//Input mask
		    $(document).ready(function(){
				$(":input").inputmask();
			  	or
			  	Inputmask().mask(document.querySelectorAll("input"));
			});

	





	</script>
</body>
</html>
