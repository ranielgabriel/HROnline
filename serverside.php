<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	if($_SESSION['newapp'] == 'submitted'){
		header('location: like.php');
		exit();
	}
	if($_SESSION['newapp'] <> 'validatedApplicant'){
		header('Location:index.php');
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

	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

		__gaTracker('create', 'UA-76297316-1', 'auto');
		__gaTracker('set', 'forceSSL', true);
		__gaTracker('send','pageview');
	</script>

<title>Anderson Recruitment Management System</title>
</head>
 <?php

include("connect.php");
	

	//COMPANY
	//$apply_position = mysqli_real_escape_string($conn,$_POST['apply_position']);
	$position= mysqli_real_escape_string($conn,$_POST['position_name']);
	if($position=='Others'){
		$position = mysqli_real_escape_string($conn,$_POST['other_position']."(Others)");
	}
	$sched = mysqli_real_escape_string($conn,$_POST['sched']); 
	$holidays = mysqli_real_escape_string($conn,$_POST['holidays']); 
	$contractual = mysqli_real_escape_string($conn,$_POST['cont']); 
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
	
	/* $height=mysqli_real_escape_string($conn,$_POST['feet']." ' " .$_POST['inch']);
	$WEIGHT= mysqli_real_escape_string($conn,$_POST['weight']);
	$BLOODTYPE= mysqli_real_escape_string($conn,$_POST['btype']); */
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
	$cstatusspec=mysqli_real_escape_string($conn,$_POST['cstatus']);
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
	$ONE_CONTACTNUM = mysqli_real_escape_string($conn,$_POST['contactnum']);
			try { 
				if (empty($ONE_CONTACTNUM)) {
					 $ONE_CONTACTNUM= " "; 
				} 
				else { 
					 $ONE_CONTACTNUM =  $ONE_CONTACTNUM;} 
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
	$TWO_CONTACTNUM = mysqli_real_escape_string($conn,$_POST['contactnum']);
			try { 
				if (empty($TWO_CONTACTNUM)) {
					 $TWO_CONTACTNUM= " "; 
				} 
				else { 
					 $TWO_CONTACTNUM =  $TWO_CONTACTNUM;} 
				}
			catch (Exception $e) { }

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
	$THREE_CONTACTNUM = mysqli_real_escape_string($conn,$_POST['contactnum']);
			try { 
				if (empty($THREE_CONTACTNUM)) {
					 $THREE_CONTACTNUM= " "; 
				} 
				else { 
					 $THREE_CONTACTNUM =  $THREE_CONTACTNUM;} 
				}
			catch (Exception $e) { }

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
	$FOUR_CONTACTNUM = mysqli_real_escape_string($conn,$_POST['contactnum']);
			try { 
				if (empty($FOUR_CONTACTNUM)) {
					 $FOUR_CONTACTNUM= " "; 
				} 
				else { 
					 $FOUR_CONTACTNUM =  $FOUR_CONTACTNUM;} 
				}
			catch (Exception $e) { }

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
	$FIVE_CONTACTNUM = mysqli_real_escape_string($conn,$_POST['contactnum']);
			try { 
				if (empty($FIVE_CONTACTNUM)) {
					 $FIVE_CONTACTNUM= " "; 
				} 
				else { 
					 $FIVE_CONTACTNUM =  $FIVE_CONTACTNUM;} 
				}
			catch (Exception $e) { }


	$CERTIFY=mysqli_real_escape_string($conn,$_POST['submit']); 


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
//referenceCode
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

	
	$myname = $lname." , ".$fname." ".$mname." ".$ename;
	$time = date("h:i a");
	$date = date("Y-m-d");
		
	
	//Save to database
	$app_stat = $_POST['app_stat'];
	$c_s_result=$_POST['siblingchild'];
	if(isset($_SESSION['Application_Status'])){
		$application_status='Unfinished';
	}else{
		$application_status='Pending';


$pob = $_POST['bplace'];
$cur_add = $_POST['currentaddress'].",".$_POST['current_home_num'].",".$_POST['current_barangay'];
$prov_add = $_POST['provinceaddress'].",".$_POST['provincial_home_num'].",".$_POST['provincial_barangay'];
$mail = $_POST['email'];
$skype_accnt = $_POST['skype_userid'];
$fb_accnt = $_POST['facebook'];
$twitter_acct = $_POST['twitter'];
$contact_pers = $_POST['contact_name'];
$contact_dets = $_POST['contact_details'];


		$sql_personalinfo = "INSERT INTO tbl_application_info(reference_code, first_name, middle_name, last_name, extension_name, nickname, dob, pob, gender, civil_status, citizenship, current_address, provincial_address, date_registered, status ) VALUES('$rand_str','$fname', '$mname', '$lname', '$ename', '$nickname', '$bday123', '$pob', '$sex', '$cstatus', '$citizenship', '$cur_add','$prov_add',Now(),'1')";
			$conn->query($sql_personalinfo);

		$sql_contact_info = "INSERT INTO tbl_contact_info (reference_no, email_address, skype_id, facebook_acct, twitter_acct, home_tel, mobile_no, contact_person, contact_no) VALUES('$rand_str', '$mail','$skype_accnt','$fb_accnt','$twitter_acct','$home_telnum','$mobile_num','$contact_pers','$contact_dets')";
		$conn->query($sql_contact_info);

		$sql_work_info = "INSERT INTO tbl_work_info (`reference_code`, `inclusive_date1`, `company_name1`, `company_address1`, `contact_no1`, `position_title1`, `supervisor_name1`, `salary1`, `reason_leaving1`, `inclusive_date2`, `company_name2`, `company_address2`, `contact_no2`, `position_title2`, `supervisor_name2`, `salary2`, `reason_leaving2`, `inclusive_date3`, `company_name3`, `company_address3`, `contact_no3`, `position_title3`, `supervisor_name3`, `salary3`, `reason_leaving3`, `inclusive_date4`, `company_name4`, `company_address4`, `contact_no4`, `position_title4`, `supervisor_name4`, `salary4`, `reason_leaving4`, `inclusive_date5`, `company_name5`, `company_address5`, `contact_no5`, `position_title5`, `supervisor_name5`, `salary5`, `reason_leaving5`)VALUES('$rand_str','$ONE_DATES', '$one_company','$one_compadd','$one_contactnum', '$ONE_POSITION', '$ONE_SUPERVISOR', '$ONE_SALARY', '$ONE_REASON', '$TWO_DATES','$two_company','$two_compadd','$two_contactnum', '$TWO_POSITION', '$TWO_SUPERVISOR', '$TWO_SALARY', '$TWO_REASON', '$THREE_DATES', '$three_company','$three_compadd','$three_contactnum', '$THREE_POSITION', '$THREE_SUPERVISOR', '$THREE_SALARY', '$THREE_REASON', '$FOUR_DATES','$four_company','$four_compadd','$four_contactnum', '$FOUR_POSITION', '$FOUR_SUPERVISOR', '$FOUR_SALARY', '$FOUR_REASON','$FIVE_DATES','$five_company','$five_compadd','$five_contactnum', '$FIVE_POSITION', '$FIVE_SUPERVISOR', '$FIVE_SALARY', '$FIVE_REASON')";
		$conn->query($sql_work_info);


$sch1 = $_POST['elem_name'];
$dtcover1 = $_POST['elem_datefrom']."-".$_POST['elem_dateto'];
$awards1 = $_POST['elem_scholarship'];
$sch2 = $_POST['hs_name'];
$dtcover2 = $_POST['hs_datefrom']."-".$_POST['hs_dateto'];
$awards2 = $_POST['hs_scholarship'];
$sch3 = $_POST['col_name'];
$dtcover3 = $_POST['col_datefrom']."-".$_POST['col_dateto'];
$degree = $_POST['col_degree'];
$awards3 = $_POST['col_scholarship'];

		$sql_education_info = "INSERT INTO tbl_education_info (`reference_no`, `primary_school`, `date_cover1`, `awards1`, `secondary_school`, `date_cover2`, `awards2`, `tertiary_school`, `date_cover3`, `degree_course`, `awards3`)VALUES('$rand_str','$sch1','$dtcover1','$awards1','$sch2','$dtcover2','$awards2','$sch3','$dtcover3','$degree','$awards3')";
		$conn->query($sql_education_info);



	 // $sql_insert="INSERT INTO tbl_applicantinfo (`reference_code` ,`firstname`,`middlename`,`lastname`,`status`, `date_registered`)VALUES('$rand_str','$fname','$mname','$lname','1',Now());";
	 // $conn->query($sql_insert);
	
	 $sql= "INSERT INTO tbl_application (`POSITION` , `APPLICATION_SOURCE`, `SHIFTING_SCHEDULE` ,`CONTRACTUAL_EMPLOYMENT` , `WEEKENDS_HOLIDAYS` , `EMPLOYMENT_DATE` , `NAME` , `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `EXTENSIONNAME`, `NICKNAME` , `GENDER` , `CIVIL STATUS` , `CITIZENSHIP`, `EMAIL ADDRESS` ,  `FATHER'S NAME`, `F_LNAME` , `F_FNAME` , `F_MNAME` , `MOTHER'S MAIDEN NAME`, `M_LNAME` , `M_FNAME`, `M_MNAME` , `DATE OF BIRTH`,

		 `1. Inclusive Dates`, `1.1 Employer's Name, Address and Phone`, `1.2 Position Title`, `1.3 Name_Position and Contact No. of Immediate Supervisor`, `1.4 Monthly Salary`, `1.6 Emp_phone`, `1.5 Reason for Leaving`, 
		 `2. Inclusive Dates`, `2.1 Employer's Name, Address and Phone`, `2.2 Position Title`, `2.3 Name_Position and Contact No. of Immediate Supervisor`, `2.4 Monthly Salary`, `2.5 Reason for Leaving`, `2.6 Emp_phone`,
		 `3. Inclusive Dates`, `3.1 Employer's Name, Address and Phone`, `3.2 Position Title`, `3.3 Name_Position and Contact No. of Immediate Supervisor`, `3.4 Monthly Salary`, `3.5 Reason for Leaving`, `3.6 Emp_phone`,
		 `4. Inclusive Dates`, `4.1 Employer's Name, Address and Phone`, `4.2 Position Title`, `4.3 Name_Position and Contact No. of Immediate Supervisor`, `4.4 Monthly Salary`, `4.5 Reason for Leaving`, `4.6 Emp_phone`,
		 `5. Inclusive Dates`, `5.1 Employer's Name, Address and Phone`, `5.2 Position Title`, `5.3 Name_Position and Contact No. of Immediate Supervisor`, `5.4 Monthly Salary`, `5.5 Reason for Leaving`, `5.6 Emp_phone`, `CERTIFY`,
		 `SALARY`, `SKYPE_USERID`, `CONTACT NAME`, `CONTACT DETAILS`, `MOBILE_NUMBER`, `SPOUSE'S OCCUPATION`, `HOME_TELNUM`,`REFERENCE_NO`,`APPLICANT_STATUS`,`HAVE_CHILD`,`Status`,`source`) VALUES

		 ('$position', '$application_source', '$sched' , '$holidays' ,'$contractual' ,'$empdate' , '$name' , '$lname', '$fname', '$mname', '$ename', '$nickname', '$sex', '$cstatus', '$citizenship', '$EMAIL', '$father_name' ,'$flname', '$ffname', '$fmidname' , '$mother_name', '$mlname' , '$mfname' , '$mmname' , '$bday123','$ONE_DATES', '$ONE_EMPNAME', '$ONE_POSITION', '$ONE_SUPERVISOR', '$ONE_SALARY', '$ONE_CONTACTNUM', '$ONE_REASON', '$TWO_DATES', '$TWO_EMPNAME', '$TWO_POSITION', '$TWO_SUPERVISOR', '$TWO_SALARY', '$TWO_REASON', '$TWO_CONTACTNUM',  '$THREE_DATES', '$THREE_EMPNAME', '$THREE_POSITION', '$THREE_SUPERVISOR', '$THREE_SALARY', '$THREE_REASON', '$THREE_CONTACTNUM', '$FOUR_DATES', '$FOUR_EMPNAME', '$FOUR_POSITION', '$FOUR_SUPERVISOR', '$FOUR_SALARY', '$FOUR_REASON', '$FOUR_CONTACTNUM', '$FIVE_DATES', '$FIVE_EMPNAME', '$FIVE_POSITION', '$FIVE_SUPERVISOR', '$FIVE_SALARY', '$FIVE_REASON ', '$FIVE_CONTACTNUM', '$CERTIFY', '$salary_expectation','$SKYPE_USERID', '$CONTACT_NAME', '$CONTACT_DETAILS', '$mobile_num', '$Spouse_occupation', '$home_telnum','$rand_str','$app_stat','$c_s_result','$application_status','application')";

}
 
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
	if($EMAIL!=''){
		$hr="";
		if($CERTIFY=="I Agree"){
			$hr="yes";

		}else{
			$hr="no";
		}
		echo"<script type='text/javascript'>";
		echo'$.ajax ({
		type: "POST",
		url: "mailer.php",
		data: { email : "'.$EMAIL.'",ref: "'.$rand_str.'" ,hr: "'.$hr.'"},
		success: function( result ) {
			$.ajax ({
			type: "POST",
			url: "address.php",
			data: { validate : "'.$EMAIL.'",applicantId: "'.$last_id.'" },
			success: function( result ) {
			
			}
			});
		}
		});';
		echo"</script>";
		
	}
    $birthPlaceCountry = "";
	   if($_POST['birthPlaceCountry']<>'') {
	   	 $birthPlaceCountry = utf8_encode($_POST['birthPlaceCountry']);
	   	 $sqlbirthPlaceCountry = "UPDATE tbl_application SET `PLACE OF BIRTH` = '$birthPlaceCountry',`PBO_MUNICIPALITY`='',`PBO_PROVINCE`='',`PBO_REGION`='' WHERE `ID` = '$last_id'";
	   	 $result = $conn->query($sqlbirthPlaceCountry);
	   }

	   	$birthPlaceProvince = "";
			if (!empty($_POST['birthPlaceProvince'])) { 
						$birthPlaceProvince = utf8_encode($_POST['birthPlaceProvince']); 
			    }

		$birthPlaceCity = "";
			if (!empty($_POST['birthPlaceCity'])) { 
						$birthPlaceCity = utf8_encode($_POST['birthPlaceCity']); 
			    }  

   		$birthPlaceRegion = "";
		   if($_POST['birthPlaceRegion']<>'') {
		   	 $birthPlaceRegion = utf8_encode($_POST['birthPlaceRegion']);
			 $konkat1 = $birthPlaceCity." , ".$birthPlaceProvince." ".$birthPlaceRegion;
			 $konkat = utf8_encode($konkat1);
		   	 $sql456 = "UPDATE tbl_application SET `PLACE OF BIRTH` = '$konkat',`PBO_MUNICIPALITY`='$birthPlaceCity',`PBO_PROVINCE`='$birthPlaceProvince',`PBO_REGION`='$birthPlaceRegion' WHERE `ID` = '$last_id'";
		   	 $result = $conn->query($sql456);
		   }
		 $curHomeStreet = "";
		 	if (!empty($_POST['current_home_num'])) { 
						$curHomeStreet = utf8_encode($_POST['current_home_num']); 
			}
		$curBarangay = "";
		 	if (!empty($_POST['current_barangay'])) { 
						$curBarangay = utf8_encode($_POST['current_barangay']); 
			}
		 $curAddCity = "";
		 	if (!empty($_POST['curAddCity'])) { 
						$curAddCity = utf8_encode($_POST['curAddCity']); 
			}

			$curAddProvince = "";
			if (!empty($_POST['curAddProvince']))   {
				$curAddProvince = utf8_encode($_POST['curAddProvince']);
			}

			$curAddRegion = "";
			if(!empty($_POST['curAddRegion'])) {
				$curAddRegion = utf8_encode($_POST['curAddRegion']);
			}

			
			if($_POST['current_home_num']<>''&&$_POST['current_barangay']<>'') {
				$current_address1 = $curHomeStreet.' '.$curBarangay." , ".$curAddCity." , ".$curAddProvince." ".$curAddRegion;
				$current_address = utf8_encode($current_address1);
				$sqlcuradd = "UPDATE tbl_application SET `CURRENT ADDRESS` = '$current_address',`CURRENT_HOME_STREET`='$curHomeStreet',`CURRENT_BARANGAY`='$curBarangay',`CURRENT_MUNICIPALITY`='$curAddCity',`CURRENT_PROVINCE`='$curAddProvince', `CURRENT_REGION`='$curAddRegion' WHERE `ID` = '$last_id' "; 
				$result = $conn->query($sqlcuradd);
			}
			
			$provHomeStreet = "";
		 	if (!empty($_POST['provincial_home_num'])){ 
						$provHomeStreet = utf8_encode($_POST['provincial_home_num']); 
			}
			$provBarangay = "";
		 	if (!empty($_POST['provincial_barangay'])) { 
						$provBarangay = utf8_encode($_POST['provincial_barangay']); 
			}
			$provAddCity = "";
		 	if (!empty($_POST['provAddCity'])) { 
						$provAddCity = utf8_encode($_POST['provAddCity']); 
			}

			$provAddProvince = "";
			if (!empty($_POST['provAddProvince']))   {
				$provAddProvince = utf8_encode($_POST['provAddProvince']);
			}

			$provAddRegion = "";
			if(!empty($_POST['provAddRegion'])) {
				$provAddRegion = utf8_encode($_POST['provAddRegion']);
			}

			
				$provincial_address1 = $provHomeStreet.' '.$provBarangay." , ".$provAddCity." , ".$provAddProvince." ".$provAddRegion;
				$provincial_address = utf8_encode($provincial_address1);
				$sqlprovadd = "UPDATE tbl_application SET `PROVINCIAL_ADDRESS` = '$provincial_address',`PROV_HOME_STREET`='$provHomeStreet',`PROV_BARANGAY`='$provBarangay',`PROV_MUNICIPALITY`='$provAddCity',`PROV_PROVINCE`='$provAddProvince',`PROV_REGION`='$provAddRegion' WHERE `ID` = '$last_id' "; 
				$result = $conn->query($sqlprovadd);
			



	$facebook = "";
		   if(!empty($_POST['facebook'])) {
		   	 $facebook = $_POST['facebook'];
		   	 $sqlfacebook = "UPDATE tbl_application SET `FB_Account` = '$facebook' 
		   	 										WHERE `ID` = '$last_id'";
		   	 $result = $conn->query($sqlfacebook);
		   }

   	$twitter = "";
		   if(!empty($_POST['twitter'])) {
		   	 $twitter = $_POST['twitter'];
		   	 $sqltwitter = "UPDATE tbl_application SET `Twitter_Account` = '$twitter' 
		   	 									   WHERE `ID` = '$last_id'";
		   	 $result = $conn->query($sqltwitter);
		   }

   	$mobile_num2 = "";
		   if(!empty($_POST['mobile_num2']) && $_POST['mobile_num2'] != '09__-___-____') {
		   	 $mobile_num2 = $_POST['mobile_num2'];
		   	 $sqlmobile_num2 = "UPDATE tbl_application SET `MOBILE_NUMBER2` = '$mobile_num2' 
		   	 										  WHERE `ID` = '$last_id'";
		   	 $result = $conn->query($sqlmobile_num2);
		   }


   	$mobile_num3 = "";
		   if(!empty($_POST['mobile_num3']) && $_POST['mobile_num3'] != '09__-___-____') {
		   	 $mobile_num3 = $_POST['mobile_num3'];
		   	 $sqlmobile_num3 = "UPDATE tbl_application SET `MOBILE_NUMBER3` = '$mobile_num3' 
		   	 										  WHERE `ID` = '$last_id'";
		   	 $result = $conn->query($sqlmobile_num3);
		   }  


   $dob = new DateTime($bday123); 
   $interval =  $dob ->diff(new DateTime);
   $age = $interval->y;

	   	if(!empty($_POST['bday123'])) {
	   	 $sql502 = "UPDATE tbl_application SET `AGE` = '$age' 
	   	 								  WHERE `ID` = '$last_id'";
	   	 $result = $conn->query($sql502);
	   	}

		if(!empty($_POST['religion123'])){
			$RELIGION = $_POST['religion123'];
			$sql205 = "UPDATE tbl_application SET `RELIGION` = '$RELIGION' 
											WHERE `ID` = '$last_id'";
			$result = $conn->query($sql205);
		}

	$checkup = "";
		if(!empty($_POST['checkup'])) {
		   	 $checkup = $_POST['checkup'];
		   	 $sqlcheckup = "UPDATE tbl_application SET `Physical Checkup` = '$checkup' 
		   	 									 WHERE `ID` = '$last_id'";
		   	 $result = $conn->query($sqlcheckup);
		} 

		$fatherCountry = "";
		if(!empty($_POST['fatherCountry'])) {
			$fatherCountry = utf8_encode($_POST['fatherCountry']);
			$sqlfatherCountry = "UPDATE tbl_application SET `FATHER PLACEBIRTH` = '$fatherCountry',`F_MUNICIPALITY`='',`F_PROVINCE`='',`F_REGION`='' WHERE `ID` = '$last_id'";
			$result = $conn->query($sqlfatherCountry);
		}
		$fatherProvince = "";
		if(!empty($_POST['fatherProvince'])) {
			$fatherProvince = utf8_encode($_POST['fatherProvince']);
		}
		$fatherCity = "";
		if(!empty($_POST['fatherCity'])) {
			$fatherCity = utf8_encode($_POST['fatherCity']);
		}
		$fatherRegion = "";
		if(!empty($_POST['fatherRegion'])) {
			$fatherRegion = utf8_encode($_POST['fatherRegion']);
			$fplacebirth1= $fatherCity." , ".$fatherProvince." ".$fatherRegion;
			$fplacebirth = utf8_encode($fplacebirth1);
			$sqlfplacebirth = "UPDATE tbl_application SET `FATHER PLACEBIRTH` = '$fplacebirth',`F_MUNICIPALITY`='$fatherCity',`F_PROVINCE`='$fatherProvince',`F_REGION`='$fatherRegion' WHERE `ID` = '$last_id'";
			$result = $conn->query($sqlfplacebirth);
		}

		$motherCountry = "";
		if(!empty($_POST['motherCountry'])) {
			$motherCountry = utf8_encode($_POST['motherCountry']);
			$sqlMOTHERCountry = "UPDATE tbl_application SET `MOTHER PLACEBIRTH` = '$motherCountry ',`M_MUNICIPALITY`='',`M_PROVINCE`='',`M_REGION`='' WHERE `ID` = '$last_id'";
			$result = $conn->query($sqlMOTHERCountry);
		}
		$motherProvince = "";
		if(!empty($_POST['motherProvince'])) {
			$motherProvince = utf8_encode($_POST['motherProvince']);
		}
		$motherCity = "";
		if(!empty($_POST['motherCity'])) {
			$motherCity = utf8_encode($_POST['motherCity']);
		}
		$motherRegion = "";
		if(!empty($_POST['motherRegion'])) {
			$motherRegion = utf8_encode($_POST['motherRegion']);
			$mplacebirth1= $motherCity." , ".$motherProvince." ".$motherRegion;
			$mplacebirth = utf8_encode($mplacebirth1);
			$sqlmplacebirth = "UPDATE tbl_application SET `MOTHER PLACEBIRTH` = '$mplacebirth',`M_MUNICIPALITY`='$motherCity',`M_PROVINCE`='$motherProvince',`M_REGION`='$motherRegion' WHERE `ID` = '$last_id'";
			$result = $conn->query($sqlmplacebirth);
		}
		//Essay
			for($q_counter=1; $q_counter <= 4; $q_counter++){
				$question = mysqli_real_escape_string($conn,$_POST['question'.$q_counter]);
				$questions = "INSERT INTO tbl_essay (`APPLICANT_ID`,`Answer`,`Question_ID`) VALUES ('$last_id','$question','$q_counter')";
				$result = $conn->query($questions);
						
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
			$Spouse_name = $spouse_firstname." ".$spouse_midname." ".$spouse_lastname;
	 		$sqlSpousename = "UPDATE `tbl_application` SET `SPOUSE'S NAME` = '$Spouse_name',`S_LNAME`='$spouse_lastname',`S_FNAME`='$spouse_firstname',`S_MNAME`='$spouse_midname' WHERE `ID` = '$last_id'";	
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
	 		$widowed_name = $widowed_fname."%%".$widowed_midname."**".$widowed_lname;
	 		$sqlWidowedname = "UPDATE `tbl_application` SET `SPOUSE'S NAME` = '$widowed_name' 
	 												   WHERE `ID` = '$last_id'";	
	 		 $result = $conn->query($sqlWidowedname);	
	 	}

   		//REFERENCES
			$ONE_REFNAME= mysqli_real_escape_string($conn,$_POST['ONE_REFNAME']);
			$ONE_REFADDRESS = mysqli_real_escape_string($conn,$_POST['ONE_REFADDRESS']);
			$ONE_REFCONTACT = mysqli_real_escape_string($conn,$_POST['ONE_REFCONTACT']);
			$sql401 = "UPDATE tbl_application SET `REF_Name` = '$ONE_REFNAME', 
												`REF_Address` = '$ONE_REFADDRESS', 
												`REF_ContactNum` = '$ONE_REFCONTACT' 
												WHERE `ID` = '$last_id'";
			$result = $conn->query($sql401);
		

			$TWO_REFNAME= mysqli_real_escape_string($conn,$_POST['TWO_REFNAME']);
			$TWO_REFADDRESS = mysqli_real_escape_string($conn,$_POST['TWO_REFADDRESS']);
			$TWO_REFCONTACT = mysqli_real_escape_string($conn,$_POST['TWO_REFCONTACT']);
			$sql402 = "UPDATE tbl_application SET `REF_Name2` = '".$TWO_REFNAME."', 
												`REF_Address2` = '".$TWO_REFADDRESS."', 
												`REF_ContactNum2` = '".$TWO_REFCONTACT."' 
												WHERE `ID` = '$last_id'";
			$result = $conn->query($sql402);
		

			$THREE_REFNAME= mysqli_real_escape_string($conn,$_POST['THREE_REFNAME']);
			$THREE_REFADDRESS = mysqli_real_escape_string($conn,$_POST['THREE_REFADDRESS']);
			$THREE_REFCONTACT = mysqli_real_escape_string($conn,$_POST['THREE_REFCONTACT']);
			$sql403 = "UPDATE tbl_application SET `REF_Name3` = '".$THREE_REFNAME."', 
											`REF_Address3` = '".$THREE_REFADDRESS."', 
											`REF_ContactNum3` = '".$THREE_REFCONTACT."' 
											WHERE `ID` = '$last_id'";
			$result = $conn->query($sql403);


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
	$ELEM_DateTo = "";
			if (!empty($_POST['elem_dateto'])) { 
				$ELEM_DateTo = $_POST['elem_dateto'];
			} 
				else {
				 $ELEM_DateTo = "";
			}

			if(!empty($_POST['elem_name'])){
				$ELEM_Name= mysqli_real_escape_string($conn,$_POST['elem_name']);
				$sql201 = "UPDATE tbl_application SET `ELEM_Name of School` = '$ELEM_Name', 
													`ELEM_Year Graduated` = '$ELEM_DateTo',
													`ELEM_Inclusive Dates of Attendance` = '$ELEM_Year', 
													`ELEM_Scholarship/ Academic Honors Received` = '$ELEM_Scholarship' 
												 WHERE `ID` = '$last_id'";
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
	$HS_DateTo = "";
				if (!empty($_POST['hs_dateto'])) { 
					$HS_DateTo = $_POST['hs_dateto'];
				} 
					else {
					$HS_DateTo = "";
				}

			if(!empty($_POST['hs_name'])){
				$HS_Name= mysqli_real_escape_string($conn,$_POST['hs_name']);
				$sql202 = "UPDATE tbl_application SET `HS_Name of School` = '$HS_Name', 
													`HS_Year Graduated` = '$HS_DateTo',
													`HS_Inclusive Dates of Attendance` = '$HS_Year', 
													`HS_Scholarship/ Academic Honors Received` = '$HS_Scholarship' 
												  WHERE `ID` = '$last_id'";
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
		else {
			$col_dateto = "";
		}

	$COL_Scholarship = "";
		if (!empty($_POST['col_scholarship'])) { 
				$COL_Scholarship = $_POST['col_scholarship']; 
	    } 


	
	$College_graduate = $_POST['col_grad'];
	
	$COL_Name = "";
	
			$COL_Name= mysqli_real_escape_string($conn,$_POST['col_name']);
			if($col_datefrom==''&&$col_dateto==''){
				$COL_YearGrad = '';
			}else{
			$COL_YearGrad = $col_datefrom." - ".$col_dateto;
			}
			$sql203 = "UPDATE tbl_application SET `COL_Name of School` = '$COL_Name', 
												`COL_Degree Course` = '$COL_Degree', 
												`COL_Year Graduated` = '$col_dateto',
												`COL_Inclusive Dates of Attendance` = '$COL_YearGrad', 
												`COL_Scholarship/ Academic Honors Received` = '$COL_Scholarship', 
												`COL_Graduated` = '$College_graduate' 
												WHERE `ID` = '$last_id'";
			$result = $conn->query($sql203);
		if($College_graduate=='NO'){
			$col_datefrom2 = $_POST['col_datefrom2'];
			$COL_YearGrad = $col_datefrom2." - ";
		$delGrad = "UPDATE tbl_application SET `COL_Inclusive Dates of Attendance` = '$COL_YearGrad' WHERE `ID` = '$last_id'";
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
				$GRAD_Scholarship = mysqli_real_escape_string($conn,$_POST['grad_scholarship']); 
	    } 
	    else {
	    		 $GRAD_Scholarship = "";
	}

	$GRAD_Graduated = "";
	if (!empty($_POST['Graduated'])) { 
				$GRAD_Graduated = $_POST['Graduated']; 
	    } 
	    else {
	    		 $GRAD_Graduated = "NO";
	}
	$GRAD_DateTo = "";
	if (!empty($_POST['grad_dateto'])) { 
		$GRAD_DateTo = $_POST['grad_dateto'];
	} 
		else {
		$GRAD_DateTo = "";
	}

		if(!empty($_POST['grad_name'])){
		$GRAD_Name= mysqli_real_escape_string($conn,$_POST['grad_name']);
		$sql203 = "UPDATE tbl_application SET `GRAD_Name of School` = '$GRAD_Name', 
											 `GRAD_Degree Course` = '$GRAD_Degree', 
											 `GRAD_Inclusive Dates of Attendance` = '$GRAD_Year', 
											 `GRAD_Scholarship` = '$GRAD_Scholarship', 
											 `GRAD_Graduated?` = 'GRAD_Graduated',
											 `GRAD_Year Graduated` = '$GRAD_DateTo'
											 WHERE `ID` = '$last_id'";
		$result = $conn->query($sql203);
	}


	$PROF_Rating1 = "";
	if (!empty($_POST['rating'])) { 
				$PROF_Rating1 = $_POST['rating']; 
	    } 
	    else {
	    		 $PROF_Rating1 = "";
	}

	$PROF_DateGranted1 = "";
	if (!empty($_POST['dategranted'])) { 
				$PROF_DateGranted1 = $_POST['dategranted']; 
	    } 
	    else {
	    		 $PROF_DateGranted1 = "";
	}

	$PROF_Institution1 = "";
	if (!empty($_POST['institution'])) { 
				$PROF_Institution1 = mysqli_real_escape_string($conn,$_POST['institution']); 
	    } 
	    else {
	    		 $PROF_Institution1 = "";
	}

	$PROF_Licensennum1 = "";
	if (!empty($_POST['licensenum'])) { 
				$PROF_Licensennum1 = $_POST['licensenum']; 
	    } 
	    else {
	    		 $PROF_Licensennum1 = "";
	}

	$PROF_DateReleased1 = "";
	if (!empty($_POST['datereleased'])) { 
				$PROF_DateReleased1 = $_POST['datereleased']; 
	    } 
	    else {
	    		 $PROF_DateReleased1 = "";
	}


	if(!empty($_POST['license'])){
		$PROF_License1 = $_POST['license'];
		$sql101 = "UPDATE tbl_application SET `PROF_License1` = '$PROF_License1', 
											  `PROF_Rating1` = '$PROF_Rating1',
											  `PROF_DateGranted1` = '$PROF_DateGranted1', 
											  `PROF_Institution1` = '$PROF_Institution1',
											  `PROF_Licensennum1` = '$PROF_Licensennum1', 
											  `PROF_DateReleased1` = '$PROF_DateReleased1' 
											  WHERE `ID` = '$last_id'";
		$result = $conn->query($sql101);
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
					$PROF_Institution2 = mysqli_real_escape_string($conn,$_POST['institution2']); 
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
												 WHERE `ID` = '$last_id'";
			$result = $conn->query($sql29);
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
					$PROF_Institution3 = mysqli_real_escape_string($conn,$_POST['institution3']); 
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
												 WHERE `ID` = '$last_id'";
			$result = $conn->query($sql30);
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
    $errors= array();
	$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg'); 
	$applicantFolder =  "ApplicantPhoto/" ;
		$file_name = $_FILES['fileup']['name'];
		define ("MAX_SIZE","400");
		$ext = strtolower(substr(strrchr($file_name, '.'), 1)); //Get extension
		$image_name = $rand_str  . '.' . $ext; //New image name
		
		
		
		
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
		
		$insertPhoto = "UPDATE tbl_application SET `PHOTO_DIRECTORY`='$filename' WHERE `ID` = '$last_id'";
					
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
					$ONE_LANGUAGE = $_POST['language'];
					$sql102 = "INSERT INTO tbl_languages 
								(`ID`, `ONE_LANGUAGE`, `ONE_SPEAK`, `ONE_READ`, `ONE_WRITE`) VALUES 
								('$last_id', '$ONE_LANGUAGE', '$ONE_SPEAK', '$ONE_READ', '$ONE_WRITE')";
					$result = $conn->query($sql102);

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
												   WHERE `ID` = '$last_id'";
				$result = $conn->query($sql26);
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
												   WHERE `ID` = '$last_id'";
				$result = $conn->query($sql25);
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
												   WHERE `ID` = '$last_id'";
				$result = $conn->query($sql24);
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
												   WHERE `ID` = '$last_id'";
				$result = $conn->query($sql23);
			}
	
	//OtherInfo
		//SKILLS
			$SKILLS1 = "";
			if(!empty($_POST['skill1'])){
				$SKILLS1 = mysqli_real_escape_string($conn,$_POST['skill1']);
			}
			else{
				$SKILLS1 = "";
			}
			$SKILLS2 = "";
			if(!empty($_POST['skill2'])){
				$SKILLS2 = mysqli_real_escape_string($conn,$_POST['skill2']);
			}
			else{
				$SKILLS2 = "";
			}
			$SKILLS3 = "";
			if(!empty($_POST['skill3'])){
				$SKILLS3 = mysqli_real_escape_string($conn,$_POST['skill3']);
			}
			else{
				$SKILLS3 = "";
			}
		//RECOGNITION
			$RECOGNITION1 = "";
			if(!empty($_POST['recognition1'])){
				$RECOGNITION1 = mysqli_real_escape_string($conn,$_POST['recognition1']);
			}
			else{
				$RECOGNITION1 = "";
			}
			$RECOGNITION2 = "";
			if(!empty($_POST['recognition2'])){
				$RECOGNITION2 = mysqli_real_escape_string($conn,$_POST['recognition2']);
			}
			else{
				$RECOGNITION2 = "";
			}
			$RECOGNITION3 = "";
			if(!empty($_POST['recognition3'])){
				$RECOGNITION3 = mysqli_real_escape_string($conn,$_POST['recognition3']);
			}
			else{
				$RECOGNITION3 = "";
			}
		//ORGANIZATION
			$ORG1 = "";
			if(!empty($_POST['org1'])){
				$ORG1 = mysqli_real_escape_string($conn,$_POST['org1']);
			}else{
				$ORG1 = "";
			}
			$ORG2 = "";
			if(!empty($_POST['org2'])){
				$ORG2 = mysqli_real_escape_string($conn,$_POST['org2']);
			}else{
				$ORG2 = "";
			}
			$ORG3 = "";
			if(!empty($_POST['org3'])){
				$ORG3 = mysqli_real_escape_string($conn,$_POST['org3']);
			}else{
				$ORG3 = "";
			}

			$sqlotherinfo = "INSERT INTO tbl_othersinfo (`ID`,`SKILLS1`,`SKILLS2`,`SKILLS3`,`RECOGNITION1`,`RECOGNITION2`,`RECOGNITION3`,`ORG1`,`ORG2`, `ORG3`) VALUES ('$last_id','$SKILLS1','$SKILLS2','$SKILLS3','$RECOGNITION1','$RECOGNITION2','$RECOGNITION3','$ORG1','$ORG2','$ORG3')";
			$result = $conn->query($sqlotherinfo);
	//Otherinfo

	//SIBLINGS
		$counter = 1;
		for($counter; $counter < 10; $counter++){
			if(!empty($_POST['sibling'.$counter])){
				$SIBLING = $_POST['sibling'.$counter];
				$SIBLING_AGE = $_POST['sibling_age'.$counter];
				$siblingsql = "INSERT INTO tbl_siblings (`ID`,`SIBLING_NAME`,`SIBLING_AGE`) VALUES ('$last_id','$SIBLING','$SIBLING_AGE')";
				$result = $conn->query($siblingsql);
			}
		}
 	//CHILD
		$counter = 1;
		for($counter; $counter < 10; $counter++){
			if(!empty($_POST['child_name'.$counter])){
				$child = $_POST['child_name'.$counter];
				$child_age = $_POST['child_age'.$counter];
				$sqlchild = "INSERT INTO tbl_child(`ID`, `CHILD_NAME`, `CHILD_AGE`) VALUES ('$last_id','$child','$child_age')";
				$result = $conn->query($sqlchild);
			}
		}

	$doo = date("m-d-Y"); 
	$resume_dir = "Applicant resume/";
	$resume_file = $resume_dir . basename($last_id.'-'.$name.' - '.$_FILES['fileToUpload']['name']);
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
	
	$applicantipaddress ='';
	$_SESSION['newapp'] = 'submitted';
?> 
<script type="text/javascript" src="http://l2.io/ip.js?var=userip"></script> 
<script type="text/javascript"> 
	$('document').ready(function () {
		$('#Mymodal').modal('show');
		$('#exam').css('display','none');
		var IpAddress="";
		if(typeof userip === 'undefined'){
			$.getJSON("http://jsonip.com/?callback=?", function (data) {
				IpAddress = data.ip;
			});
		}else{
			IpAddress = userip;
		}
		$.ajax ({
		type: "POST",
		url: "address.php",
		data: { ivalid : IpAddress },
		success: function( result ) {
			if(IpAddress==result){
			var a_href = $('#exam').attr('href');
			$('#exam').attr('href','http://agpdsk00142:1818/Examination/TakeExam?ref=<?php echo $rand_str;?>&&fname=<?php echo $fname;?>&&mname=<?php echo $mname;?>&&lname=<?php echo $lname;?>&&pos=<?php echo $position;?>');
			$('#exam').css('display','block');
		}
		}
		});
	});
</script>  
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
			  <h4 class="modal-title"><b>R E F E R E N C E&nbsp;&nbsp;&nbsp;C O D E<b></h4>
			</div>
			<div class="modal-body">
			<center>
			<h6>Your application form has been successfully sent.</h6>
			<h5><b>Please remember your Reference Code:</h5><h3 style="color:blue;"><?php echo $rand_str;?><a></b></h3><br>
			  <?php
				if(isset($_SESSION['Application_Status'])){
					echo'<h5 style="color:#ff6d00;">Note: Use this code to resume your application form.</h5>';
				}else{
					echo'<h5 style="color:#ff6d00;">Note: Use this code to edit your application form and to take our exam.</h5>';
				}
				?>
			<br><b><a id="exam" style="text-decoration:none; background:blue; color:white; padding:1%; border-radius:10px; width:70%;">Click here to proceed to your Exam</a></b></center>
			</div>
			
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
			</div>
		  </div>
		</div>
		</div>
	</div>
</body>

</html>