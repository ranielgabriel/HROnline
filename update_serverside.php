<?php
session_start();
?>
<?php
	if(isset($_SESSION['newapp'])){
		if($_SESSION['newapp'] == 'new'){

		}elseif($_SESSION['newapp'] == 'submitted'){
			header('location: like.php');
			exit();
		}
	}else{
		header('location: like.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>	
<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/bootstrap.js"></script>
<title>Anderson Recruitment Management System</title>
<script type="text/javascript">
	$('document').ready(function () {
		$('#Mymodal').modal('show');
	});
</script>
</head>
<?php

error_reporting(0);

include("connect.php");
//echo "Connected successfully";
$ref_idS=$_POST['reference_code'];
$sql01 = "SELECT ID FROM `tbl_application` where REFERENCE_NO = '$ref_idS '";
					$result3 = $conn->query($sql01);
					while($row = $result3->fetch_assoc()){
						$rf_id = $row["ID"];
					}
					
					
	//siblings and child delete
	$c_s_result=$_POST['siblingchild'];
	
	if($c_s_result==1){
		$delAllSiblings = "Delete from tbl_siblings where ID = '$rf_id'";
		$result = $conn->query($delAllSiblings);
	}else{
		$delAllChild = "Delete from tbl_child where ID = '$rf_id'";
		$result = $conn->query($delAllChild);
	}
	//COMPANY
	$position= mysqli_real_escape_string($conn,$_POST['position_name']);
	$sched = mysqli_real_escape_string($conn,$_POST['sched']); 
	$holidays = mysqli_real_escape_string($conn,$_POST['holidays']); 
	$empdate = mysqli_real_escape_string($conn,$_POST['empdate']); 	
	$salary_expectation= $_POST['salaryexpectation']; 



	$application_source =$_POST['sourcex'];
	//$application_sourcespec = mysqli_real_escape_string($conn,$_POST['sourcespec']);
	if($application_source == "Others"){
		$application_source = mysqli_real_escape_string($conn,$_POST['sourcespec']);
	}


	//PERSONAL INFORMATION
	$sex= mysqli_real_escape_string($conn,$_POST['sex123']); 
	$nickname= mysqli_real_escape_string($conn,$_POST['nickname123']);
	$bday123= $_POST['bday123']; 
	$citizenship = mysqli_real_escape_string($conn,$_POST['citizen']);
	
	$height=mysqli_real_escape_string($conn,$_POST['feet']." ' " .$_POST['inch']);
	$WEIGHT= mysqli_real_escape_string($conn,$_POST['weight']);
	$BLOODTYPE= mysqli_real_escape_string($conn,$_POST['btype']);
	$home_telnum= mysqli_real_escape_string($conn,$_POST['home_telnum']);
	$EMAIL= mysqli_real_escape_string($conn,$_POST['email']);


	//CONTACT INFORMATION
	$CONTACT_NAME= mysqli_real_escape_string($conn,$_POST['contact_name']);
	$CONTACT_DETAILS= mysqli_real_escape_string($conn,$_POST['contact_details']);
	if($_POST['mobile_num'] == '09__-___-____'){
		$mobile_num = "";
	}else{
		$mobile_num= mysqli_real_escape_string($conn,$_POST['mobile_num']);
	}
	$SKYPE_USERID= mysqli_real_escape_string($conn,$_POST['skype_userid']);




	//NAME
	$lname=mysqli_real_escape_string($conn,$_POST['lname']);
	$fname=mysqli_real_escape_string($conn,$_POST['fname']);
	$mname=mysqli_real_escape_string($conn,$_POST['mname']);
	$ename=mysqli_real_escape_string($conn,$_POST['ename']);
	if (empty($ename)) { 
		$ename = ""; 
	}
	$name = $lname." , ".$fname." ".$mname." ".$ename;
	


	//CIVIL STATUS
	$cstatus=mysqli_real_escape_string($conn,$_POST['cstatus']);
	$cstatusspec=mysqli_real_escape_string($conn,$_POST['cstatusspec']);
		if($cstatus == "Others"){
		$cstatus = $cstatusspec;
	} 


	//FATHER
	$flname= mysqli_real_escape_string($conn,$_POST['flname']);
	$ffname= mysqli_real_escape_string($conn,$_POST['ffname']);
	$fmidname= mysqli_real_escape_string($conn,$_POST['fmname']);
	$father_name = $flname." , ".$ffname." ".$fmidname;
		if (!empty($father_name) && strlen($father_name) <= 4) { 
			$father_name= ""; 
		} 
		else {
		 	$father_name= $father_name;
		} 


	//MOTHER
	$mlname= mysqli_real_escape_string($conn,$_POST['mother_lname']);
	$mfname= mysqli_real_escape_string($conn,$_POST['mother_fname']);
	$mmname= mysqli_real_escape_string($conn,$_POST['mother_midname']);
	$mother_name = $mlname." , ".$mfname." ".$mmname; 
		if (!empty($mother_name) && strlen($mother_name) <= 4) { 
			$mother_name= ""; 
		} 
		else {
			 $mother_name= $mother_name;
		}

	
	$one_datefrom = mysqli_real_escape_string($conn,$_POST['datefrom']);
	$one_dateto = mysqli_real_escape_string($conn,$_POST['dateto']);
	$ONE_DATES = $one_datefrom. " - " .$one_dateto;
			try { 
					if (!empty($ONE_DATES) && strlen($ONE_DATES) <= 3){ 
						$ONE_DATES = ""; 
					} 
					else {
						$ONE_DATES = $ONE_DATES; 
					}
				}
			catch (Exception $e) { }

	$one_company = "";
		if (!empty($_POST['company_name'])) {
			$one_company = mysqli_real_escape_string($conn,$_POST['company_name']);
		}
	$one_contactnum = "";
		if (!empty($_POST['contactnum'])) { 
			$one_contactnum = mysqli_real_escape_string($conn,$_POST['contactnum']); 
		} 
	$one_compadd = mysqli_real_escape_string($conn,$_POST['compadd']);
		if (empty($one_compadd)) {
			 $one_compadd = " "; 
		} 
		else {
			 	 $one_compadd = $one_compadd;
		}
	$ONE_EMPNAME = $one_company. "$$". $one_contactnum. "%%". $one_compadd;
			try { 
				if (strlen($ONE_EMPNAME) < 8) {
					 $ONE_EMPNAME = ""; 
				} 
				else { 
					 $ONE_EMPNAME = $ONE_EMPNAME;} 
				}
			catch (Exception $e) { }

	$ONE_POSITION = mysqli_real_escape_string($conn,$_POST['position']);
			try { 
				if (empty($ONE_POSITION)) {
					 $ONE_POSITION = " "; 
				} 
				else { 
					 $ONE_POSITION = $ONE_POSITION;} 
				}
			catch (Exception $e) { }
	$ONE_SUPERVISOR	= mysqli_real_escape_string($conn,$_POST['supervisor']);
			try { 
				if (empty($ONE_SUPERVISOR)) {
					$ONE_SUPERVISOR = " "; 
				} 
				else {
					$ONE_SUPERVISOR = $ONE_SUPERVISOR;} 
				}
			catch (Exception $e) { }
	$ONE_SALARY = mysqli_real_escape_string($conn,$_POST['salary']);
			try { 
				if (empty($ONE_SALARY)) {
					 $ONE_SALARY= " "; 
				} 
				else { 
					 $ONE_SALARY =  $ONE_SALARY;} 
				}
			catch (Exception $e) { }
	$ONE_REASON = mysqli_real_escape_string($conn,$_POST['reason']);
			try { 
				if (empty($ONE_REASON)) { 
					$ONE_REASON= " "; 
				} 
				else { 
					$ONE_REASON=$ONE_REASON;} 
				}
			catch (Exception $e) { }

	//WORK EXPERIENCE 2
	$two_datefrom ="";
			if (!empty($_POST['datefrom2'])) { 
				$two_datefrom = mysqli_real_escape_string($conn,$_POST['datefrom2']); 
			} 
	$two_dateto = "";
			if (!empty($_POST['dateto2'])) {
				$two_dateto = mysqli_real_escape_string($conn,$_POST['dateto2']); 
				} 
	$TWO_DATES = $two_datefrom. " - ".$two_dateto;
			try { 
				if (!empty($TWO_DATES) && strlen($TWO_DATES) <= 3) { 
					$TWO_DATES = ""; 
			} 
			else {
					$TWO_DATES = $TWO_DATES;} 
			}
			catch (Exception $e) { }


	$two_company = "";
			if (!empty($_POST['company_name2'])) { 
				$two_company = mysqli_real_escape_string($conn,$_POST['company_name2']); 
			} 
	$two_contactnum = "";
			if (!empty($_POST['contactnum2'])) {
				$two_contactnum = mysqli_real_escape_string($conn,$_POST['contactnum2']); 
				} 
	$two_compadd = "";
			if (!empty($_POST['compadd2'])) {
				$two_compadd = mysqli_real_escape_string($conn,$_POST['compadd2']); 
				} 
	$TWO_EMPNAME = $two_company. "$$". $two_contactnum. "%%". $two_compadd;
			try {
				 if (!empty($TWO_EMPNAME) && strlen($TWO_EMPNAME) <= 6) { 
				 		$TWO_EMPNAME = ""; 
				 } 
				 else {
				 		$TWO_EMPNAME = $TWO_EMPNAME;} 
				 }
			catch (Exception $e) { }

	$TWO_POSITION = "";
			if (!empty($_POST['position2'])) {
				$TWO_POSITION = mysqli_real_escape_string($conn,$_POST['position2']); 
			} 
	$TWO_SUPERVISOR	=  "";
			if (!empty($_POST['supervisor2'])) { 
				$TWO_SUPERVISOR = mysqli_real_escape_string($conn,$_POST['supervisor2']); 
			} 
	$TWO_SALARY = "";
			if (!empty($_POST['salary2'])) {
				$TWO_SALARY = mysqli_real_escape_string($conn,$_POST['salary2']); 
			} 
	$TWO_REASON = "";
	 		if (!empty($_POST['reason2'])) { 
	 			$TWO_REASON = mysqli_real_escape_string($conn,$_POST['reason2']); 
	 		}


	$three_datefrom = "";
			if (!empty($_POST['datefrom3'])) { 
				$three_datefrom = mysqli_real_escape_string($conn,$_POST['datefrom3']); 
			} 
	$three_dateto = "";
			if (!empty($_POST['dateto3'])) {
			    $three_dateto= mysqli_real_escape_string($conn,$_POST['dateto3']); 
			} 
	$THREE_DATES = $three_datefrom. " - ".$three_dateto;
			if (!empty($THREE_DATES) && strlen($THREE_DATES) < 5){ 
				$THREE_DATES = mysqli_real_escape_string($conn,$THREE_DATES); 
			}

	$three_company = "";
			if (!empty($_POST['company_name3'])) { 
				$three_company = mysqli_real_escape_string($conn,$_POST['company_name3']); 
			} 
	$three_contactnum = "";
			if (!empty($_POST['contactnum3'])) {
				 $three_contactnum = mysqli_real_escape_string($conn,$_POST['contactnum3']); 
			} 
	$three_compadd = "";
			if (!empty($_POST['compadd3'])) {
				$three_compadd = mysqli_real_escape_string($conn,$_POST['compadd3']); 
			}

	$THREE_EMPNAME = $three_company."$$".$three_contactnum."%%".$three_compadd;
			try {
				 if (!empty($THREE_EMPNAME) && strlen($THREE_EMPNAME) <= 6) { 
				 		$THREE_EMPNAME = ""; 
				 } 
				 else {
				 		$THREE_EMPNAME = $THREE_EMPNAME;} 
				 }
			catch (Exception $e) { }
	
	$THREE_POSITION = "";
			if (!empty($_POST['position3'])) { 
				$THREE_POSITION = mysqli_real_escape_string($conn,$_POST['position3']); 
			}
	$THREE_SUPERVISOR= ""; 
			if (!empty($_POST['supervisor3'])) { 
				$THREE_SUPERVISOR = mysqli_real_escape_string($conn,$_POST['supervisor3']); 
			}
	$THREE_SALARY = "";
			if (!empty($_POST['salary3'])) { 
				$THREE_SALARY = mysqli_real_escape_string($conn,$_POST['salary3']);
			}
	$THREE_REASON = ""; 
			if (!empty($_POST['reason3'])) { 
				$THREE_REASON = mysqli_real_escape_string($conn,$_POST['reason3']); 
			}


	//WORK EXPERIENCE4
	$four_datefrom = "";
			if (!empty($_POST['datefrom4'])) { 
				$four_datefrom = mysqli_real_escape_string($conn,$_POST['datefrom4']); 
			}
	$four_dateto =  "";
			if (!empty($_POST['dateto4'])) { 
				$four_dateto = mysqli_real_escape_string($conn,$_POST['dateto4']); 
			}
	$FOUR_DATES = $four_datefrom. " - ".$four_dateto;
			if (strlen($FOUR_DATES) <= 3) { 
				$FOUR_DATES = ""; 
			} 
			else {
				$FOUR_DATES = $FOUR_DATES;
			}

	$four_company =  "";
			if (!empty($_POST['company_name4'])) {
				$four_company = mysqli_real_escape_string($conn,$_POST['company_name4']); 
			}
	$four_contactnum =  "";
			if (!empty($_POST['contactnum4'])) { 
				$four_contactnum = mysqli_real_escape_string($conn,$_POST['contactnum4']); 
			}
	$four_compadd =  "";
			if (!empty($_POST['compadd4'])) { 
				$four_compadd = mysqli_real_escape_string($conn,$_POST['compadd4']); 
			}
	$FOUR_EMPNAME = $four_company. "$$". $four_contactnum. "%%". $four_compadd;
			try {
				 if (strlen($FOUR_EMPNAME) <= 6) { 
				 		$FOUR_EMPNAME = " "; 
				 } 
				 else {
				 		$FOUR_EMPNAME = $FOUR_EMPNAME;} 
				 }
			catch (Exception $e) { }
			

	$FOUR_POSITION = ""; 
			if (!empty($_POST['position4'])) {
				$FOUR_POSITION =  mysqli_real_escape_string($conn,$_POST['position4']); 
			}

	$FOUR_SUPERVISOR= ""; 
			if (!empty($_POST['supervisor4'])) { 
				$FOUR_SUPERVISOR= mysqli_real_escape_string($conn,$_POST['supervisor4']); 
			}
	$FOUR_SALARY =  ""; 
			if (!empty($_POST['salary4'])) {
			    $FOUR_SALARY = mysqli_real_escape_string($conn,$_POST['salary4']); 
			}
	$FOUR_REASON =  "";
			if (!empty($_POST['reason4'])) { 
				$FOUR_REASON = mysqli_real_escape_string($conn,$_POST['reason4']); 
			}

	//WORK EXPERIENCE 5
	$five_datefrom = ""; 
			if (!empty($_POST['datefrom5'])) { 
				$five_datefrom = mysqli_real_escape_string($conn,$_POST['datefrom5']); 
			}
	$five_dateto = ""; 
			if (!empty($_POST['dateto5'])) { 
				$five_dateto =  mysqli_real_escape_string($conn,$_POST['dateto5']); 
			}
	$FIVE_DATES = $five_datefrom. " - ".$five_dateto;
			if (strlen($FIVE_DATES) <= 3) {
				 $FIVE_DATES = ""; 
			} 
			else { 
				 $FIVE_DATES = $FIVE_DATES;
			}

	$five_company = ""; 
			if (!empty($_POST['company_name5'])) {
				 $five_company = mysqli_real_escape_string($conn,$_POST['company_name5']); 
			}
	$five_contactnum = ""; 
			if (!empty($_POST['contactnum5'])) {
				 $five_contactnum = mysqli_real_escape_string($conn,$_POST['contactnum5']); 
			}
	$five_compadd = "";
			if (!empty($_POST['compadd5'])) { 
				$five_compadd = mysqli_real_escape_string($conn,$_POST['compadd5']); 
			}
	$FIVE_EMPNAME = $five_company. "$$". $five_contactnum. "%%". $five_compadd;
			if (strlen($FIVE_EMPNAME) <= 6) { 
				$FIVE_EMPNAME = ""; 
			} 
			else {
				$FIVE_EMPNAME = $FIVE_EMPNAME;
			}

	$FIVE_POSITION = ""; 
			if (!empty($_POST['position5'])) {
				 $FIVE_POSITION = mysqli_real_escape_string($conn,$_POST['position5']); 
			}
	$FIVE_SUPERVISOR= ""; 
			if (!empty($_POST['supervisor5'])) { 
				$FIVE_SUPERVISOR= mysqli_real_escape_string($conn,$_POST['supervisor5']); 
			}
	$FIVE_SALARY = ""; 
			if (!empty($_POST['salary5'])) {
				 $FIVE_SALARY = mysqli_real_escape_string($conn,$_POST['salary5']); 
			}
	$FIVE_REASON = ""; 
			if (!empty($_POST['reason5'])) {	
				 $FIVE_REASON = mysqli_real_escape_string($conn,$_POST['reason5']); 
			}


	$CERTIFY=mysqli_real_escape_string($conn,$_POST['submit']); 
//ESSAY
	
	$sqlDELEssay = "DELETE from tbl_essay where APPLICANT_ID = '$rf_id '";
	$result = $conn->query($sqlDELEssay);
	$q_count = 4;
	$q_counter = 1;
		for($q_counter; $q_counter <= 4; $q_counter++){
			$question = $_POST['question'.$q_counter];
			$questions = "INSERT INTO tbl_essay (`APPLICANT_ID`,`Answer`,`Question_ID`) VALUES ('$rf_id','$question','$q_counter')";
			$result = $conn->query($questions);
					
		}

//interview question


		$CERTIFY=mysqli_real_escape_string($conn,$_POST['interviewButton']); 

	
	$sqlDelAns = "DELETE from tbl_answer where Applicant_ID = '$rf_id '";
	$resultA = $conn->query($sqlDelAns);
	$iq_count = 4;
	$iq_counter = 1;
		for($iq_counter; $iq_counter <= 7; $iq_counter++){
			$questionI = $_POST['question'.$iq_counter];
			$questionsI = "INSERT INTO tbl_essay (`Applicant_ID`,`Answer`,`interview_ID`) VALUES ('$rf_id','$interviewQ','$iq_counter')";
			$result1 = $conn->query($questionsI);
					
		}
//SPOUSE

	 $socc= "";
	 	if (!empty($_POST['spouse_occ'])) { 
	 		$socc= $_POST['spouse_occ']; 
	 	} 
	 $sempname= "";
	 	if (!empty($_POST['spouse_empname'])) { 
	 		$sempname= $_POST['spouse_empname']; 

	 	}

	 	$Spouse_occupation = $socc."^^".$sempname;
	 	if(strlen($Spouse_occupation) <= 3){
	 		$Spouse_occupation = "";
	 	}
		
		$ref_id=$_POST['reference_code'];
		echo"<script type='text/javascript'>";
		echo'$.ajax ({
				type: "POST",
				url: "address.php",
				data: { validate : "'.$EMAIL.'",applicantId: "'.$ref_id.'" },
				success: function( result ) {
					$.ajax ({
					type: "POST",
					url: "mailer.php",
					data: { email : "'.$EMAIL.'",ref: "'.$ref_id.'",hr: "yes" },
					success: function( result ) {
						
					}
					});
				}
				});';
		echo"</script>";
			
	 
		  
	  
		
	 $sql01 = "SELECT ID FROM `tbl_application` where REFERENCE_NO = '$ref_id '";
			$result3 = $conn->query($sql01);
			while($row = $result3->fetch_assoc()){
				$rf_id = $row["ID"];
			}
		$have_child = $_POST["siblingchild"];
		$workcomment1 = $_POST['workcomment'];
		$workcomment2 = $_POST['workcomment2'];
		$workcomment3 = $_POST['workcomment3'];
		$workcomment4 = $_POST['workcomment4'];
		$workcomment5 = $_POST['workcomment5'];
		$ap_stat = $_POST["app_stat"];

		$sql = "UPDATE tbl_application SET 
					`HAVE_CHILD`='$have_child', 
					`APPLICATION_SOURCE`='$application_source',
					`SHIFTING_SCHEDULE`='$sched',
					`WEEKENDS_HOLIDAYS` = '$holidays',
					`EMPLOYMENT_DATE` ='$empdate', 
					`NAME`='$name',
					`LASTNAME`='$lname',
					`FIRSTNAME`='$fname',
					`MIDDLENAME`='$mname',
					`EXTENSIONNAME`='$ename', 
					`NICKNAME`='$nickname', 
					`GENDER` ='$sex', 
					`CIVIL STATUS`='$cstatus', 
					`CITIZENSHIP`='$citizenship', 
					`EMAIL ADDRESS`='$EMAIL', 
					`FATHER'S NAME`='$father_name',
					`F_LNAME`='$flname',
					`F_FNAME`='$ffname', 
					`F_MNAME`='$fmidname' , 
					`MOTHER'S MAIDEN NAME`='$mother_name',
					`M_LNAME`='$mlname',
					`M_FNAME`='$mfname',
					`M_MNAME`='$mmname',
					`DATE OF BIRTH`='$bday123',
					`1. Inclusive Dates`='$ONE_DATES', 
					`1.1 Employer's Name, Address and Phone`='$ONE_EMPNAME', 
					`1.2 Position Title`='$ONE_POSITION', 
					`1.3 Name_Position and Contact No. of Immediate Supervisor`='$ONE_SUPERVISOR',
					`1.4 Monthly Salary`='$ONE_SALARY', 
					`1.5 Reason for Leaving`='$ONE_REASON',
					`1.6 Emp_phone`='$one_contactnum',
					`1.7 WorkComment` = '$workcomment1',
					`2. Inclusive Dates`='$TWO_DATES', 
					`2.1 Employer's Name, Address and Phone`='$TWO_EMPNAME', 
					`2.2 Position Title`='$TWO_POSITION', 
					`2.3 Name_Position and Contact No. of Immediate Supervisor`='$TWO_SUPERVISOR', 
					`2.4 Monthly Salary`='$TWO_SALARY', 
					`2.5 Reason for Leaving`='$TWO_REASON',
					`2.6 Emp_phone`='$two_contactnum',
					`2.7 WorkComment` = '$workcomment2',
					`3. Inclusive Dates`='$THREE_DATES', 
					`3.1 Employer's Name, Address and Phone`='$THREE_EMPNAME', 
					`3.2 Position Title`='$THREE_POSITION', 
					`3.3 Name_Position and Contact No. of Immediate Supervisor`='$THREE_SUPERVISOR', 
					`3.4 Monthly Salary`='$THREE_SALARY', 
					`3.5 Reason for Leaving`='$THREE_REASON', 
					`3.6 Emp_phone`='$three_contactnum',
					`3.7 WorkComment` = '$workcomment3',
					`4. Inclusive Dates`='$FOUR_DATES', 
					`4.1 Employer's Name, Address and Phone`='$FOUR_EMPNAME', 
					`4.2 Position Title`='$FOUR_POSITION', 
					`4.3 Name_Position and Contact No. of Immediate Supervisor`='$FOUR_SUPERVISOR', 
					`4.4 Monthly Salary`='$FOUR_SALARY', 
					`4.5 Reason for Leaving`='$FOUR_REASON',
					`4.6 Emp_phone`='$four_contactnum',
					`4.7 WorkComment` = '$workcomment4',
					`5. Inclusive Dates`='$FIVE_DATES', 
					`5.1 Employer's Name, Address and Phone`='$FIVE_EMPNAME', 
					`5.2 Position Title`='$FIVE_POSITION', 
					`5.3 Name_Position and Contact No. of Immediate Supervisor`='$FIVE_SUPERVISOR', 
					`5.4 Monthly Salary`='$FIVE_SALARY', 
					`5.5 Reason for Leaving`='$FIVE_REASON', 
					`5.6 Emp_phone`='$five_contactnum',
					`5.7 WorkComment` = '$workcomment5',
					`CERTIFY`='$CERTIFY',`SALARY`='$salary_expectation', 
					`HEIGHT`='$height', `WEIGHT`='$WEIGHT', `BLOODTYPE`='$BLOODTYPE', 
					`SKYPE_USERID`='$SKYPE_USERID', 
					`CONTACT NAME`='$CONTACT_NAME',
					`CONTACT DETAILS`='$CONTACT_DETAILS', 
					`MOBILE_NUMBER`='$mobile_num', 
					`SPOUSE'S OCCUPATION`='$Spouse_occupation', 
					`HOME_TELNUM`='$home_telnum',
					`APPLICANT_STATUS`='$ap_stat',
					`Status`='Pending' where `REFERENCE_NO`='$ref_id'";

			 



	if ($conn->query($sql) === TRUE) {
		echo "";
 	} else {
 	    echo "Error: " . $sql . "<br>" . $conn->error;
 	} 

 	$last_id = "";
	$sql2 = "SELECT ID FROM `tbl_application` ORDER BY ID";
	$result = $conn->query($sql2);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row4 = $result->fetch_assoc()) {
			$last_id = $row4['ID'];
	    }
   }

    $birthPlaceCountry = "";
	   if($_POST['birthPlaceCountry']<>'') {
	   	 $birthPlaceCountry = $_POST['birthPlaceCountry'];
	   	 $sqlbirthPlaceCountry = "UPDATE tbl_application SET `PLACE OF BIRTH` = '$birthPlaceCountry' ,`PBO_MUNICIPALITY`='',`PBO_PROVINCE`='',`PBO_REGION`='' WHERE `ID` = '$rf_id'";
	   	 $result = $conn->query($sqlbirthPlaceCountry);
	   }

	   	$birthPlaceProvince = "";
			if (!empty($_POST['birthPlaceProvince'])) { 
						$birthPlaceProvince = $_POST['birthPlaceProvince']; 
			    }

		$birthPlaceCity = "";
			if (!empty($_POST['birthPlaceCity'])) { 
						$birthPlaceCity = $_POST['birthPlaceCity']; 
			    }  

   		$birthPlaceRegion = "";
		   if($_POST['birthPlaceRegion']<>'') {
			   
		   	 $birthPlaceRegion = $_POST['birthPlaceRegion'];
		   	 $konkat = $birthPlaceCity." , ".$birthPlaceProvince." ".$birthPlaceRegion;
		   	 $sql456 = "UPDATE tbl_application SET `PLACE OF BIRTH` = '$konkat',`PBO_MUNICIPALITY`='$birthPlaceCity',`PBO_PROVINCE`='$birthPlaceProvince',`PBO_REGION`='$birthPlaceRegion' WHERE `ID` = '$rf_id'";
		   	 $result = $conn->query($sql456);
		   }
		   
		$curHomeStreet = "";
		 	if (!empty($_POST['current_home_num'])) { 
						$curHomeStreet = $_POST['current_home_num']; 
			}
		$curBarangay = "";
		 	if (!empty($_POST['current_barangay'])) { 
						$curBarangay = $_POST['current_barangay']; 
			}
		 $curAddCity = "";
		 	if (!empty($_POST['curAddCity'])) { 
						$curAddCity = $_POST['curAddCity']; 
			}

			$curAddProvince = "";
			if (!empty($_POST['curAddProvince']))   {
				$curAddProvince = $_POST['curAddProvince'];
			}

			$curAddRegion = "";
			if(!empty($_POST['curAddRegion'])) {
				$curAddRegion = $_POST['curAddRegion'];
			}

			
			if($_POST['current_home_num']<>''&&$_POST['current_barangay']<>'') {
				
				$current_address1 = $curHomeStreet.' '.$curBarangay." , ".$curAddCity." , ".$curAddProvince." ".$curAddRegion;
				$current_address = utf8_decode($current_address1);
				$sqlcuradd = "UPDATE tbl_application SET `CURRENT ADDRESS` = '$current_address',`CURRENT_HOME_STREET`='$curHomeStreet',`CURRENT_BARANGAY`='$curBarangay',`CURRENT_MUNICIPALITY`='$curAddCity',`CURRENT_PROVINCE`='$curAddProvince', `CURRENT_REGION`='$curAddRegion' WHERE `ID` = '$rf_id' "; 
				$result = $conn->query($sqlcuradd);
			}
			
			$provHomeStreet = "";
		 	if (!empty($_POST['provincial_home_num'])) { 
						$provHomeStreet = $_POST['provincial_home_num']; 
			}
			$provBarangay = "";
		 	if (!empty($_POST['provincial_barangay'])) { 
						$provBarangay = $_POST['provincial_barangay']; 
			}
			$provAddCity = "";
		 	if (!empty($_POST['provAddCity'])) { 
						$provAddCity = $_POST['provAddCity']; 
			}

			$provAddProvince = "";
			if (!empty($_POST['provAddProvince']))   {
				$provAddProvince = $_POST['provAddProvince'];
			}

			$provAddRegion = "";
			if(!empty($_POST['provAddRegion'])) {
				$provAddRegion = $_POST['provAddRegion'];
			}

	
				$provincial_address = $provHomeStreet.' '.$provBarangay." , ".$provAddCity." , ".$provAddProvince." ".$provAddRegion;
				$sqlprovadd = "UPDATE tbl_application SET `PROVINCIAL_ADDRESS` = '$provincial_address',`PROV_HOME_STREET`='$provHomeStreet',`PROV_BARANGAY`='$provBarangay',`PROV_MUNICIPALITY`='$provAddCity',`PROV_PROVINCE`='$provAddProvince',`PROV_REGION`='$provAddRegion' WHERE `ID` = '$rf_id' ";
				$result = $conn->query($sqlprovadd);
			



	$facebook = "";
		   if(!empty($_POST['facebook'])) {
		   	 $facebook = $_POST['facebook'];
		   	 $sqlfacebook = "UPDATE tbl_application SET `FB_Account` = '$facebook' 
		   	 										WHERE `ID` = '$rf_id'";
		   	 $result = $conn->query($sqlfacebook);
		   }

   	$twitter = "";
		   if(!empty($_POST['twitter'])) {
		   	 $twitter = $_POST['twitter'];
		   	 $sqltwitter = "UPDATE tbl_application SET `Twitter_Account` = '$twitter' 
		   	 									   WHERE `ID` = '$rf_id'";
		   	 $result = $conn->query($sqltwitter);
		   }

   	$mobile_num2 = "";
		   if(!empty($_POST['mobile_num2']) && $_POST['mobile_num2'] != '09__-___-____') {
		   	 $mobile_num2 = $_POST['mobile_num2'];
		   	 $sqlmobile_num2 = "UPDATE tbl_application SET `MOBILE_NUMBER2` = '$mobile_num2' 
		   	 										  WHERE `ID` = '$rf_id'";
		   	 $result = $conn->query($sqlmobile_num2);
		   }else{
				$sqlDELnum = "UPDATE tbl_application SET `MOBILE_NUMBER2`='' where ID = '$rf_id'";
				$result = $conn->query($sqlDELnum);
		   }


   	$mobile_num3 = "";
		   if(!empty($_POST['mobile_num3']) && $_POST['mobile_num3'] != '09__-___-____') {
		   	 $mobile_num3 = $_POST['mobile_num3'];
		   	 $sqlmobile_num3 = "UPDATE tbl_application SET `MOBILE_NUMBER3` = '$mobile_num3' 
		   	 										  WHERE `ID` = '$rf_id'";
		   	 $result = $conn->query($sqlmobile_num3);
		   }else{
				$sqlDELnum2 = "UPDATE tbl_application SET `MOBILE_NUMBER3`='' where ID = '$rf_id'";
				$result = $conn->query($sqlDELnum2);
		   }  


   $dob = new DateTime($bday123); 
   $interval =  $dob ->diff(new DateTime);
   $age = $interval->y;

	   	if(!empty($_POST['bday123'])) {
	   	 $sql502 = "UPDATE tbl_application SET `AGE` = '$age' 
	   	 								  WHERE `ID` = '$rf_id'";
	   	 $result = $conn->query($sql502);
	   	}

		if(!empty($_POST['religion123'])){
			$RELIGION = $_POST['religion123'];
			$sql205 = "UPDATE tbl_application SET `RELIGION` = '$RELIGION' 
											WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql205);
		}

	$checkup = "";
		if(!empty($_POST['checkup'])) {
		   	 $checkup = $_POST['checkup'];
		   	 $sqlcheckup = "UPDATE tbl_application SET `Physical Checkup` = '$checkup' 
		   	 									 WHERE `ID` = '$rf_id'";
		   	 $result = $conn->query($sqlcheckup);
		} 

		$fatherCountry = "";
		if(!empty($_POST['fatherCountry'])) {
			$fatherCountry = $_POST['fatherCountry'];
			$sqlfatherCountry = "UPDATE tbl_application SET `FATHER PLACEBIRTH` = '$fatherCountry', `F_MUNICIPALITY`='',`F_PROVINCE`='',`F_REGION`='' WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlfatherCountry);
		}
		$fatherProvince = "";
		if(!empty($_POST['fatherProvince'])) {
			$fatherProvince = $_POST['fatherProvince'];
		}
		$fatherCity = "";
		if(!empty($_POST['fatherCity'])) {
			$fatherCity = $_POST['fatherCity'];
		}
		$fatherRegion = "";
		if(!empty($_POST['fatherRegion'])) {
			$fatherRegion = $_POST['fatherRegion'];
			$fplacebirth= $fatherCity." , ".$fatherProvince." ".$fatherRegion;
			$sqlfplacebirth = "UPDATE tbl_application SET `FATHER PLACEBIRTH` = '$fplacebirth',`F_MUNICIPALITY`='$fatherCity',`F_PROVINCE`='$fatherProvince',`F_REGION`='$fatherRegion' WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlfplacebirth);
		}

		$motherCountry = "";
		if(!empty($_POST['motherCountry'])) {
			$motherCountry = $_POST['motherCountry'];
			$sqlmotherCountry = "UPDATE tbl_application SET `MOTHER PLACEBIRTH` = '$motherCountry', `M_MUNICIPALITY`='',`M_PROVINCE`='',`M_REGION`='' WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlmotherCountry);
		}
		$motherProvince = "";
		if(!empty($_POST['motherProvince'])) {
			$motherProvince = $_POST['motherProvince'];
		}
		$motherCity = "";
		if(!empty($_POST['motherCity'])) {
			$motherCity = $_POST['motherCity'];
		}
		$motherRegion = "";
		if(!empty($_POST['motherRegion'])) {
			$motherRegion = $_POST['motherRegion'];
			$mplacebirth= $motherCity." , ".$motherProvince." ".$motherRegion;
			$sqlmplacebirth = "UPDATE tbl_application SET `MOTHER PLACEBIRTH` = '$mplacebirth',`M_MUNICIPALITY`='$motherCity',`M_PROVINCE`='$motherProvince',`M_REGION`='$motherRegion' WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlmplacebirth);
		}

		//SPOUSE
	 	$spouse_firstname= "";
	 	if (!empty($_POST['spouse_firstname'])) { 
	 		$spouse_firstname =$_POST['spouse_firstname']; 
	 	} 

		$spouse_midname= "";
	 	if (!empty($_POST['spouse_midname'])) { 
	 		$smidname = $_POST['spouse_midname']; 
	 	}

	 	$spouse_lastname= "";
	 	if(!empty($_POST['spouse_lastname'])) {
	 		$spouse_lastname = $_POST['spouse_lastname'];
	 		$Spouse_name = $spouse_firstname." ".$smidname." ".$spouse_lastname;
	 		$sqlSpousename = "UPDATE `tbl_application` SET `SPOUSE'S NAME` = '$Spouse_name',`S_LNAME`='$spouse_lastname',`S_FNAME`='$spouse_firstname',`S_MNAME`='$smidname' WHERE `ID` = '$rf_id'";	
	 		 $result = $conn->query($sqlSpousename);	
	 	}

		//WIDOWED
	 	$widowed_fname =""; 
	 	if (!empty($_POST['widowed_fname'])) { 
	 		$widowed_fname = $_POST['widowed_fname']; 
	 	} 

	 	$widowed_midname=""; 
	 	if (!empty($_POST['widowed_midname'])) { 
	 		$widowed_midname = $_POST['widowed_midname']; 
	 	} 

	 	$widowed_lname=""; 
	 	if(!empty($_POST['widowed_lname'])) {
	 		$widowed_lname = $_POST['widowed_lname'];
	 		$widowed_name = $widowed_fname." ".$widowed_midname." ".$widowed_lname;
	 		$sqlWidowedname = "UPDATE `tbl_application` SET `SPOUSE'S NAME`,`S_LNAME`='$spouse_lastname',`S_FNAME`='$widowed_fname',`S_MNAME`='$widowed_midname' = '$widowed_lname'  WHERE `ID` = '$rf_id'";	
	 		 $result = $conn->query($sqlWidowedname);	
	 	}

   		//REFERENCES
	   	if(!empty($_POST['ONE_REFNAME'])){
			$ONE_REFNAME= $_POST['ONE_REFNAME'];
			$ONE_REFADDRESS = $_POST['ONE_REFADDRESS'];
			$ONE_REFCONTACT = $_POST['ONE_REFCONTACT'];
			$sql401 = "UPDATE tbl_application SET `REF_Name` = '$ONE_REFNAME', 
												`REF_Address` = '$ONE_REFADDRESS', 
												`REF_ContactNum` = '$ONE_REFCONTACT' 
												WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql401);
		}

		if(!empty($_POST['TWO_REFNAME'])){
			$TWO_REFNAME= $_POST['TWO_REFNAME'];
			$TWO_REFADDRESS = $_POST['TWO_REFADDRESS'];
			$TWO_REFCONTACT = $_POST['TWO_REFCONTACT'];
			$sql402 = "UPDATE tbl_application SET `REF_Name2` = '$TWO_REFNAME', 
												`REF_Address2` = '$TWO_REFADDRESS', 
												`REF_ContactNum2` = '$TWO_REFCONTACT' 
												WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql402);
		}

		if(!empty($_POST['THREE_REFNAME'])){
			$THREE_REFNAME= $_POST['THREE_REFNAME'];
			$THREE_REFADDRESS = $_POST['THREE_REFADDRESS'];
			$THREE_REFCONTACT = $_POST['THREE_REFCONTACT'];
			$sql403 = "UPDATE tbl_application SET `REF_Name3` = '$THREE_REFNAME', 
											`REF_Address3` = '$THREE_REFADDRESS', 
											`REF_ContactNum3` = '$THREE_REFCONTACT' 
											WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql403);
		}


   	//ELEMENTARY
    $ELEM_Year = "";
			if (!empty($_POST['elem_datefrom'])) { 
						$ELEM_Year = $_POST['elem_datefrom']. " - ".$_POST['elem_dateto']; 
			    } 
			    else {
			    		 $ELEM_Year = "";
			}

	$ELEM_Scholarship = "";
			if (!empty($_POST['elem_scholarship'])) { 
						$ELEM_Scholarship = $_POST['elem_scholarship'];
			    } 
			    else {
			    		 $ELEM_Scholarship = "";
			}

			if(!empty($_POST['elem_name'])){
				$ELEM_Name= $_POST['elem_name'];
				$sql201 = "UPDATE tbl_application SET `ELEM_Name of School` = '$ELEM_Name', 
													`ELEM_Inclusive Dates of Attendance` = '$ELEM_Year', 
													`ELEM_Scholarship/ Academic Honors Received` = '$ELEM_Scholarship' 
												 WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql201);
			}

	//HIGHSCHOOL
    $HS_Year = "";
				if (!empty($_POST['hs_datefrom'])) { 
						$HS_Year = $_POST['hs_datefrom']. " - ".$_POST['hs_dateto']; 
			    } 
			    else {
			    		 $HS_Year = "";
			}

	$HS_Scholarship= ""; 
				if (!empty($_POST['hs_scholarship'])) { 
						$HS_Scholarship = $_POST['hs_scholarship']; 
			    } 
			    else {
			    		 $HS_Scholarship = "";
			}

			if(!empty($_POST['hs_name'])){
				$HS_Name= $_POST['hs_name'];
				$sql202 = "UPDATE tbl_application SET `HS_Name of School` = '$HS_Name', 
													`HS_Inclusive Dates of Attendance` = '$HS_Year', 
													`HS_Scholarship/ Academic Honors Received` = '$HS_Scholarship' 
												  WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql202);
			}

	//COLLEGE
	$COL_Degree = "";
		if (!empty($_POST['col_degree'])) { 
				$COL_Degree = $_POST['col_degree']; 
	    } 

	$col_datefrom = "";
		if (!empty($_POST['col_datefrom'])) { 
				$col_datefrom =  $_POST['col_datefrom'];
	    }

	    $col_dateto = "";
	    if(!empty($_POST['col_dateto'])) {
	    	$col_dateto = $_POST['col_dateto'];
	    } 

	$COL_Scholarship = "";
		if (!empty($_POST['col_scholarship'])) { 
				$COL_Scholarship = $_POST['col_scholarship']; 
	    } 


	
	$College_graduate = $_POST['col_grad'];
	
	$COL_Name = "";
	
			$COL_Name= $_POST['col_name'];
			if($col_datefrom==''&&$col_dateto==''){
				$COL_YearGrad = '';
			}else{
			$COL_YearGrad = $col_datefrom." - ".$col_dateto;
			}
			$sql203 = "UPDATE tbl_application SET `COL_Name of School` = '$COL_Name', 
												`COL_Degree Course` = '$COL_Degree', 
												`COL_Inclusive Dates of Attendance` = '$COL_YearGrad', 
												`COL_Scholarship/ Academic Honors Received` = '$COL_Scholarship', 
												`COL_Graduated` = '$College_graduate' 
												WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql203);
		if($College_graduate=='NO'){
			$col_datefrom2 = $_POST['col_datefrom2'];
			$COL_YearGrad = $col_datefrom2." - ";
		$delGrad = "UPDATE tbl_application SET `COL_Inclusive Dates of Attendance` = '$COL_YearGrad' WHERE `ID` = '$rf_id'";
			$result = $conn->query($delGrad);
		
	}
		



	//Grad School	
	$GRAD_Degree = "";
	if (!empty($_POST['grad_degree'])) { 
				$GRAD_Degree = $_POST['grad_degree']; 
	    } 
	    else {
	    		 $GRAD_Degree = "";
	}

	$GRAD_Year = "";
	if (!empty($_POST['grad_datefrom'])) { 
				$GRAD_Year =  $_POST['grad_datefrom']. " - ".$_POST['grad_dateto'];
	    } 
	    else {
	    		 $GRAD_Year = "";
	}

	$GRAD_Scholarship = "";
	if (!empty($_POST['grad_scholarship'])) { 
				$GRAD_Scholarship = $_POST['grad_scholarship']; 
	    } 
	    else {
	    		 $GRAD_Scholarship = "";
	}

	
	    

		
		$GRAD_Name= $_POST['grad_name'];
		$sql203 = "UPDATE tbl_application SET `GRAD_Name of School` = '$GRAD_Name', 
											 `GRAD_Degree Course` = '$GRAD_Degree', 
											 `GRAD_Inclusive Dates of Attendance` = '$GRAD_Year', 
											 `GRAD_Scholarship` = '$GRAD_Scholarship', 
											 `GRAD_Graduated?` = 'GRAD_Graduated', `COL_Graduated` = '$College_graduate' 
											 WHERE `ID` = '$rf_id'";
		$result = $conn->query($sql203);
	


	$PROF_Rating1 = "";
	if (!empty($_POST['rating1'])) { 
				$PROF_Rating1 = $_POST['rating1']; 
	    } 
	    else {
	    		 $PROF_Rating1 = "";
	}

	$PROF_DateGranted1 = "";
	if (!empty($_POST['dategranted1'])) { 
				$PROF_DateGranted1 = $_POST['dategranted1']; 
	    } 
	    else {
	    		 $PROF_DateGranted1 = "";
	}

	$PROF_Institution1 = "";
	if (!empty($_POST['institution1'])) { 
				$PROF_Institution1 = $_POST['institution1']; 
	    } 
	    else {
	    		 $PROF_Institution1 = "";
	}

	$PROF_Licensennum1 = "";
	if (!empty($_POST['licensenum1'])) { 
				$PROF_Licensennum1 = $_POST['licensenum1']; 
	    } 
	    else {
	    		 $PROF_Licensennum1 = "";
	}

	$PROF_DateReleased1 = "";
	if (!empty($_POST['datereleased1'])) { 
				$PROF_DateReleased1 = $_POST['datereleased1']; 
	    } 
	    else {
	    		 $PROF_DateReleased1 = "";
	}


	if(!empty($_POST['license1'])){
		$PROF_License1 = $_POST['license1'];
		$sql101 = "UPDATE tbl_application SET `PROF_License1` = '$PROF_License1', 
											  `PROF_Rating1` = '$PROF_Rating1',
											  `PROF_DateGranted1` = '$PROF_DateGranted1', 
											  `PROF_Institution1` = '$PROF_Institution1',
											  `PROF_Licensennum1` = '$PROF_Licensennum1', 
											  `PROF_DateReleased1` = '$PROF_DateReleased1' 
											  WHERE `ID` = '$rf_id'";
		$result = $conn->query($sql101);
	}else{
			$sqlclear = "UPDATE tbl_application SET `PROF_License1` = '', 
												 `PROF_Rating1` = '', 
			  									 `PROF_DateGranted1` = '', 
			  									 `PROF_Institution1` = '', 
												 `PROF_Licensennum1` = '', 
												 `PROF_DateReleased1` = '' 
												 WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlclear);
		}

	$PROF_Rating2 = "";
		if (!empty($_POST['rating2'])) { 
					$PROF_Rating2 = $_POST['rating2']; 
		    } 
		    else {
		    		 $PROF_Rating2 = "";
		}

	$PROF_DateGranted2 = "";
		if (!empty($_POST['dategranted2'])) { 
					$PROF_DateGranted2 = $_POST['dategranted2']; 
		    } 
		    else {
		    		 $PROF_DateGranted2 = "";
		}

	$PROF_Institution2 = "";
		if (!empty($_POST['institution2'])) { 
					$PROF_Institution2 = $_POST['institution2']; 
		    } 
		    else {
		    		 $PROF_Institution2 = "";
		}

	$PROF_Licensennum2 = "";
		if (!empty($_POST['licensenum2'])) { 
					$PROF_Licensennum2 = $_POST['licensenum2']; 
		    } 
		    else {
		    		 $PROF_Licensennum2 = "";
		}

	$PROF_DateReleased2 = "";
		if (!empty($_POST['datereleased2'])) { 
					$PROF_DateReleased2 = $_POST['datereleased2']; 
		    } 
		    else {
		    		 $PROF_DateReleased2 = "";
		}

		if(!empty($_POST['license2'])){
			$PROF_License2 = $_POST['license2'];
			$sql29 = "UPDATE tbl_application SET `PROF_License2` = '$PROF_License2', 
												 `PROF_Rating2` = '$PROF_Rating2', 
			     								 `PROF_DateGranted2` = '$PROF_DateGranted2', 
			     								 `PROF_Institution2` = '$PROF_Institution2', 
												 `PROF_Licensennum2` = '$PROF_Licensennum2', 
												 `PROF_DateReleased2` = '$PROF_DateReleased2' 
												 WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql29);
		}else{
			$sqlclear = "UPDATE tbl_application SET `PROF_License2` = '', 
												 `PROF_Rating2` = '', 
			  									 `PROF_DateGranted2` = '', 
			  									 `PROF_Institution2` = '', 
												 `PROF_Licensennum2` = '', 
												 `PROF_DateReleased2` = '' 
												 WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlclear);
		}

	$PROF_Rating3 = "";
		if (!empty($_POST['rating3'])) { 
					$PROF_Rating3 = $_POST['rating3']; 
		    } 
		    else {
		    		 $PROF_Rating3 = "";
		}

	$PROF_DateGranted3 = "";
		if (!empty($_POST['dategranted3'])) { 
					$PROF_DateGranted3 = $_POST['dategranted3']; 
		    } 
		    else {
		    		 $PROF_DateGranted3 = "";
		}

	$PROF_Institution3 = "";
		if (!empty($_POST['institution3'])) { 
					$PROF_Institution3 = $_POST['institution3']; 
		    } 
		    else {
		    		 $PROF_Institution3 = "";
		}

	$PROF_Licensennum3 = "";
		if (!empty($_POST['licensenum3'])) { 
					$PROF_Licensennum3 = $_POST['licensenum3']; 
		    } 
		    else {
		    		 $PROF_Licensennum3 = "";
		}

	$PROF_DateReleased3 = "";
		if (!empty($_POST['datereleased3'])) { 
					$PROF_DateReleased3 = $_POST['datereleased3']; 
		    } 
		    else {
		    		 $PROF_DateReleased3 = "";
		}


		if(!empty($_POST['license3'])){
			$PROF_License3 = $_POST['license3'];
			$sql30 = "UPDATE tbl_application SET `PROF_License3` = '$PROF_License3', 
												 `PROF_Rating3` = '$PROF_Rating3', 
			  									 `PROF_DateGranted3` = '$PROF_DateGranted3', 
			  									 `PROF_Institution3` = '$PROF_Institution3', 
												 `PROF_Licensennum3` = '$PROF_Licensennum3', 
												 `PROF_DateReleased3` = '$PROF_DateReleased3' 
												 WHERE `ID` = '$rf_id'";
			$result = $conn->query($sql30);
		}else{
			$sqlclear = "UPDATE tbl_application SET `PROF_License3` = '', 
												 `PROF_Rating3` = '', 
			  									 `PROF_DateGranted3` = '', 
			  									 `PROF_Institution3` = '', 
												 `PROF_Licensennum3` = '', 
												 `PROF_DateReleased3` = '' 
												 WHERE `ID` = '$rf_id'";
			$result = $conn->query($sqlclear);
		}
	
	//Upload Image to Folder
	
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; } 
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	 }
	if(file_exists($_FILES['fileup']['tmp_name']) || is_uploaded_file($_FILES['fileup']['tmp_name'])){
		$del_img = $_POST['img_directory'];
		$img_name = $_POST['reference_code'];
		unlink($del_img);
		$errors= array();
		$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg'); 
		$applicantFolder =  "ApplicantPhoto/" ;
			$file_name = $_FILES['fileup']['name'];
			define ("MAX_SIZE","400");
			$ext = strtolower(substr(strrchr($file_name, '.'), 1)); //Get extension
			$image_name = $img_name  . '.' . $ext; //New image name
			
			
			
			
			$file_size =$_FILES['fileup']['size'];
			$file_tmp =$_FILES['fileup']['tmp_name'];
			$image =$_FILES['fileup']['name'];
			$file_type=$_FILES['fileup']['type'];
			$image =$_FILES["fileup"]["name"];
			$uploadedfile = $_FILES['fileup']['tmp_name'];

			if($file_size > 5097152){
				$errors[]='File size must be less than 5 MB';
			}
			if ($image) 
		{
		  $filename = stripslashes($_FILES['fileup']['name']);
				$extension = getExtension($filename);
		  $extension = strtolower($extension);
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
			echo ' Unknown Image extension ';
			$errors=1;
		}
		 else
		{
		   $size=filesize($_FILES['fileup']['tmp_name']);
		 
		if ($size > MAX_SIZE*10000000)
		{
		 echo "You have exceeded the size limit";
		 $errors=1;
		}
		 
		if($extension=="jpg" || $extension=="jpeg" )
		{
		$uploadedfile = $_FILES['fileup']['tmp_name'];
		$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($extension=="png")
		{
		$uploadedfile = $_FILES['fileup']['tmp_name'];
		$src = imagecreatefrompng($uploadedfile);
		}
		else 
		{
		$src = imagecreatefromgif($uploadedfile);
		}
		 
		list($width,$height)=getimagesize($uploadedfile);

		$newwidth=1024;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);


		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
		 $width,$height);


		$filename = $applicantFolder.$image_name;

	}


		
		if(empty($errors)==true){
			
            if(is_dir($applicantFolder)==false){
                mkdir($applicantFolder, 0777,true);
				// Create directory if it does not exist
            }
            if(is_dir("$applicantFolder/".$image_name)==false){
				
				imagejpeg($tmp,$filename,50);
				imagedestroy($src);
				imagedestroy($tmp);
            }else{									// rename the file if another one exist
                $new_dir="$applicantFolder/".$image_name.time();
                 rename($filename,$new_dir) ;				
            }
		 		
        }else{
                print_r($errors);
        }
		
		$insertPhoto = "UPDATE tbl_application SET `PHOTO_DIRECTORY`='$filename' WHERE `REFERENCE_NO` = '$ref_id '";
					
		$result = $conn->query($insertPhoto);
  }
}

	//LANGUAGES ;
		$ONE_SPEAK = "";
			if (!empty($_POST['speak'])) { 
						$ONE_SPEAK = $_POST['speak'];
			    } 
			     else {
						$ONE_SPEAK = "NO"; 
			}

		$ONE_READ = "";
			if (!empty($_POST['read'])) { 
						$ONE_READ = $_POST['read'];
			}
			     else {
						$ONE_READ = "NO";
			}

		$ONE_WRITE = "";
			if (!empty($_POST['write'])) { 
						$ONE_WRITE = $_POST['write']; 
			    } 
			    else {
			    		 $ONE_WRITE = "NO";
			}

		 	if(!empty($_POST['language'])){
					$ref_id = $_POST['reference_code'];
					$sql = "SELECT ID FROM `tbl_application` where REFERENCE_NO = '$ref_id '";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						$r_id = $row["ID"];
					}
					
					$ONE_LANGUAGE = $_POST['language'];
					
					$countresult = $conn->query("SELECT * From tbl_languages where ID = '$rf_id'");
					
					if($countresult->num_rows > 0){
						$sql102 = "UPDATE tbl_languages SET `ONE_LANGUAGE`='$ONE_LANGUAGE', `ONE_SPEAK`='$ONE_SPEAK', `ONE_READ`='$ONE_READ', `ONE_WRITE`='$ONE_WRITE' where ID ='$rf_id'";
						$result = $conn->query($sql102);
						
					}else{
						$sqlins = "INSERT INTO tbl_languages (`ID`, `ONE_LANGUAGE`, `ONE_SPEAK`, `ONE_READ`, `ONE_WRITE`) VALUES 
						('$rf_id', '$ONE_LANGUAGE', '$ONE_SPEAK', '$ONE_READ', '$ONE_WRITE')";
						$result = $conn->query($sqlins);
					}
			}
			if($_POST['language']==''){
				$sqlDEL = "DELETE from tbl_languages where ID = '$rf_id '";
				$result = $conn->query($sqlDEL);
			}

		$TWO_SPEAK = "";
			if (!empty($_POST['speak2'])) { 
						$TWO_SPEAK = $_POST['speak2'];
			    } 
			     else {
						$TWO_SPEAK = "NO"; 
			}

		$TWO_READ = "";
			if (!empty($_POST['read2'])) { 
						$TWO_READ = $_POST['read2']; 
			    } 
			     else {
			     		$TWO_READ = "NO"; 
			}

		$TWO_WRITE = "";
			if (!empty($_POST['write2'])) { 
						$TWO_WRITE = $_POST['write2']; 
			    } 
			     else {
			     		$TWO_WRITE = "NO"; 
			}	
			 if(!empty($_POST['language2'])){
				$TWO_LANGUAGE = $_POST['language2'];
				$sql26 = "UPDATE tbl_languages SET `TWO_LANGUAGE` = '$TWO_LANGUAGE', 
												   `TWO_SPEAK` = '$TWO_SPEAK', 
												   `TWO_READ` = '$TWO_READ', 
												   `TWO_WRITE` = '$TWO_WRITE' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql26);
			}if(empty($_POST['language2'])){
				$sqlDEL = "UPDATE tbl_languages SET `TWO_LANGUAGE` = '', 
												   `TWO_SPEAK` = '', 
												   `TWO_READ` = '', 
												   `TWO_WRITE` = '' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sqlDEL);
			}


		$THREE_SPEAK = "";
			if (!empty($_POST['speak3'])) { 
						$THREE_SPEAK = $_POST['speak3']; 
			    } 
			     else {
			     		$THREE_SPEAK = "NO"; 
			}	
		$THREE_READ = "";
			if (!empty($_POST['read3'])) { 
						$THREE_READ = $_POST['read3']; 
			    } 
			     else {
			     		$THREE_READ = "NO"; 
			}
		$THREE_WRITE = "";
			if (!empty($_POST['write3'])) { 
						$THREE_WRITE = $_POST['write3']; 
			    } 
			     else {
			     		$THREE_WRITE = "NO"; 
			}
				
			if(!empty($_POST['language3'])){
				$THREE_LANGUAGE = $_POST['language3'];
				$sql25 = "UPDATE tbl_languages SET `THREE_LANGUAGE` = '$THREE_LANGUAGE', 
												   `THREE_SPEAK` ='$THREE_SPEAK', 
												   `THREE_READ` = '$THREE_READ', 
												   `THREE_WRITE` = '$THREE_WRITE' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql25);
			}if(empty($_POST['language3'])){
				$sql23 = "UPDATE tbl_languages SET `THREE_LANGUAGE` = '', 
												   `THREE_SPEAK` ='', 
												   `THREE_READ` = '', 
												   `THREE_WRITE` = '' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql23);
			}


		$FOUR_SPEAK = "";
			if (!empty($_POST['speak4'])) { 
						$FOUR_SPEAK = $_POST['speak4']; 
			    } 
			     else {
			     		$FOUR_SPEAK = "NO"; 
			}

		$FOUR_READ ="";
			if (!empty($_POST['read4'])) { 
						$FOUR_READ = $_POST['read4']; 
			    } 
			     else {
			     		$FOUR_READ = "NO"; 
			}	
		$FOUR_WRITE = "";
			if (!empty($_POST['write4'])) { 
					$FOUR_WRITE = $_POST['write4']; 
		    } 
		     else {
		     		$FOUR_WRITE = "NO"; 
			}
			 if(!empty($_POST['language4'])){
				$FOUR_LANGUAGE = $_POST['language4'];
				$sql24 = "UPDATE tbl_languages SET `FOUR_LANGUAGE` ='$FOUR_LANGUAGE', 
												   `FOUR_SPEAK` ='$FOUR_SPEAK', 
												   `FOUR_READ` = '$FOUR_READ', 
												   `FOUR_WRITE` = '$FOUR_WRITE' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql24);
			}if(empty($_POST['language4'])){
				$sql23 = "UPDATE tbl_languages SET `FOUR_LANGUAGE` = '', 
												   `FOUR_SPEAK` ='', 
												   `FOUR_READ` = '', 
												   `FOUR_WRITE` = '' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql23);
			}

		$FIVE_SPEAK = "";
			if (!empty($_POST['speak5'])) { 
						$FIVE_SPEAK = $_POST['speak5']; 
			    } 
			     else {
			     		$FIVE_SPEAK = "NO"; 
			}
		$FIVE_READ = "";
			if (!empty($_POST['read5'])) { 
						$FIVE_READ = $_POST['read5']; 
			    } 
			     else {
			     		$FIVE_READ = "NO"; 
			}
		$FIVE_WRITE = "";
			if (!empty($_POST['write5'])) { 
						$FIVE_WRITE = $_POST['write5']; 
			    } 
			     else {
			     		$FIVE_WRITE = "NO"; 
			}
		
			if(!empty($_POST['language5'])){
				$FIVE_LANGUAGE = $_POST['language5'];
				$sql23 = "UPDATE tbl_languages SET `FIVE_LANGUAGE` = '$FIVE_LANGUAGE', 
												   `FIVE_SPEAK` ='$FIVE_SPEAK', 
												   `FIVE_READ` = '$FIVE_READ', 
												   `FIVE_WRITE` = '$FIVE_WRITE' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql23);
			}if(empty($_POST['language5'])){
				$sql23 = "UPDATE tbl_languages SET `FIVE_LANGUAGE` = '', 
												   `FIVE_SPEAK` ='', 
												   `FIVE_READ` = '', 
												   `FIVE_WRITE` = '' 
												   WHERE `ID` = '$rf_id'";
				$result = $conn->query($sql23);
			}

	//OtherInfo
		//SKILLS
			$SKILLS1 = "";
			if(!empty($_POST['skill1'])){
				$SKILLS1 = $_POST['skill1'];
			}
			else{
				$SKILLS1 = "";
			}
			$SKILLS2 = "";
			if(!empty($_POST['skill2'])){
				$SKILLS2 = $_POST['skill2'];
			}
			else{
				$SKILLS2 = "";
			}
			$SKILLS3 = "";
			if(!empty($_POST['skill3'])){
				$SKILLS3 = $_POST['skill3'];
			}
			else{
				$SKILLS3 = "";
			}
		//RECOGNITION
			$RECOGNITION1 = "";
			if(!empty($_POST['recognition1'])){
				$RECOGNITION1 = $_POST['recognition1'];
			}
			else{
				$RECOGNITION1 = "";
			}
			$RECOGNITION2 = "";
			if(!empty($_POST['recognition2'])){
				$RECOGNITION2 = $_POST['recognition2'];
			}
			else{
				$RECOGNITION2 = "";
			}
			$RECOGNITION3 = "";
			if(!empty($_POST['recognition3'])){
				$RECOGNITION3 = $_POST['recognition3'];
			}
			else{
				$RECOGNITION3 = "";
			}
		//ORGANIZATION
			$ORG1 = "";
			if(!empty($_POST['org1'])){
				$ORG1 = $_POST['org1'];
			}else{
				$ORG1 = "";
			}
			$ORG2 = "";
			if(!empty($_POST['org2'])){
				$ORG2 = $_POST['org2'];
			}else{
				$ORG2 = "";
			}
			$ORG3 = "";
			if(!empty($_POST['org3'])){
				$ORG3 = $_POST['org3'];
			}else{
				$ORG3 = "";
			}
					$sql01 = "SELECT ID FROM `tbl_application` where REFERENCE_NO = '$ref_id '";
					$result3 = $conn->query($sql01);
					while($row = $result3->fetch_assoc()){
						$rf_id = $row["ID"];
					}
					
			$sqlsel = "SELECT ID from tbl_othersinfo where ID='$rf_id'";
					$sel_res = $conn->query($sqlsel);
					
			if($sel_res->num_rows > 0){
				$sqlupd = "UPDATE tbl_othersinfo SET `SKILLS1`='$SKILLS1',`SKILLS2`='$SKILLS2',`SKILLS3`='$SKILLS3',`RECOGNITION1`='$RECOGNITION1',`RECOGNITION2`='$RECOGNITION2',`RECOGNITION3`='$RECOGNITION3',`ORG1`='$ORG1',`ORG2`='$ORG2', `ORG3`='$ORG3' WHERE ID = '$rf_id'";
				$conn->query($sqlupd);
			}else{
				$sqlins = "INSERT INTO tbl_othersinfo (`ID`,`SKILLS1`,`SKILLS2`,`SKILLS3`,`RECOGNITION1`,`RECOGNITION2`,`RECOGNITION3`,`ORG1`,`ORG2`, `ORG3`) VALUES ('$rf_id','$SKILLS1','$SKILLS2','$SKILLS3','$RECOGNITION1','$RECOGNITION2','$RECOGNITION3','$ORG1','$ORG2','$ORG3')";
				$result = $conn->query($sqlins);
			}
						
			
			
			
	//Otherinfo

	//SIBLINGS
		$delsiblingsql = "Delete from tbl_siblings where ID = '$rf_id'";
		$result = $conn->query($delsiblingsql);
		$counter = 1;
		for($counter; $counter < 10; $counter++){
			if(!empty($_POST['sibling'.$counter])){
				$SIBLING = $_POST['sibling'.$counter];
				$SIBLING_AGE = $_POST['sibling_age'.$counter];
				$siblingsql = "INSERT INTO tbl_siblings (`ID`,`SIBLING_NAME`,`SIBLING_AGE`) VALUES ('$rf_id','$SIBLING','$SIBLING_AGE')";
				$result = $conn->query($siblingsql);
			}
		}
 	//CHILD
		$delchild = "Delete from tbl_child where ID = '$rf_id'";
		$result = $conn->query($delchild);
		$counter = 1;
		for($counter; $counter < 10; $counter++){
			if(!empty($_POST['child_name'.$counter])){
				$child = $_POST['child_name'.$counter];
				$child_age = $_POST['child_age'.$counter];
				$sqlchild = "INSERT INTO tbl_child (`ID`,`CHILD_NAME`,`CHILD_AGE`) VALUES ('$rf_id','$child','$child_age') ";
				$result = $conn->query($sqlchild);
			}
		}


	$doo = date("m-d-Y"); 
	$resume_dir = "resume/";
	$resume_file = $resume_dir . basename($ref_id.' - '.$_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = pathinfo($resume_file,PATHINFO_EXTENSION);

	if(empty($_FILES['fileToUpload']['name'])){
		echo "";
	} else if($imageFileType != "docx" && $imageFileType != "pdf") {
	    echo "Sorry, only DOCX and PDF files are allowed.";
	    $uploadOk = 0;
	} else if ($_FILES['fileToUpload']['size'] > (1e+7)) {
	    echo "Sorry, your file is too large."; 
	    $uploadOk = 0;
	} else if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	} else {
	    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $resume_file)) {
	        //echo "The file ". basename( $_FILES['fileToUpload']['name']). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
	
	
	$_SESSION['newapp'] = 'submitted';
?>

<body background='bg2.jpg' style="background-position: center center;background-repeat:  no-repeat;background-attachment: fixed;background-size:  cover;">
	<hr style="padding-top: 150px">
	<h3 style="text-align:center; color: #e6e6e6; text-shadow: 2px 2px #404040">Like our page and follow us on twitter for more updates!</h3>
  
	<p style="text-align:center;">
	<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAndersonGroupPH%2F&tabs=Header&width=450&height=130&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId" width="450" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe><br/>
	
	<script>
	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
  <a class="twitter-follow-button"
    href="https://twitter.com/andersongroupph"
    data-size="large">
  Follow @AndersonGroupPH</a>

  <script>window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };

    return t;
  }(document, "script", "twitter-wjs"));</script>
  <div class="row" style="text-align: center">
    <a href="http://andersongroup.ph"> <button class="btn bnt-primary">Return</button></a>
  </div>
  <div class="container">
	  <div id="Mymodal" role="dialog" class="modal fade">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" data-dismiss="modal" class="close">&times;</button>
			  <h4 class="modal-title">Reference Code</h4>
			</div>
			<div class="modal-body">
				Your application form has been successfully sent. 
				Go back to our company for your exam.
			  <p>Please remember your Reference Code: <b><a style="color:blue;"><?php echo $ref_idS;?><a></b></p>
				<?php 
					if(isset($_SESSION['Application_Status'])){
						echo'<p style="color:#ff6d00;">Note: Use this code to resume your application form.</p>';
					}else{
						echo'<p style="color:#ff6d00;">Note: Use this code to edit your application form and to take our exam.</p>';
					}
				?>
			</div>
			
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</body>

</html>