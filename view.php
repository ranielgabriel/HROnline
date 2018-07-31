<?php
	/*NOTE: Replace every col-md- with col-xs- for printing*/
	include('connect.php');//sql connection
	include('auth.php');//for authenticated user's only

	$id = $_GET['id'];
	//if
	$sql = "SELECT * FROM tbl_application WHERE id = '$id'";
	
	/*IF VARIABLES*/
	$na = '<label>Not Available</label>';
	$family = '';
	$heiwei = '';
	$reblood = '';
	$education = '';
	$workexperience = '';
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$position = $row['POSITION'];
			$sql2 = "SELECT * FROM tbl_position WHERE id = '$position'";
	    	$result2 = $conn->query($sql2);

	    	/*IF FIELD IS NULL*/
	    	if(empty($row['EMPLOYMENT_DATE'])){
	    		$row['EMPLOYMENT_DATE'] = $na;
	    	}
	    	else{
	    		$row['EMPLOYMENT_DATE'] = date("F d, Y", strtotime($row['EMPLOYMENT_DATE']));
	    	}
	    	if(empty($row['SALARY'])){
	    		$row['SALARY'] = $na;
	    	}
	    	else{
	    		if($row['SALARY'] == 'Intern'){
	    			$row['SALARY'] = '';
	    		}else{
	    		$row['SALARY'] = '₱ '.$row['SALARY'];
	    		}
	    	}
	    	if(empty($row['AGE'] && !empty($row['DATE OF BIRTH']))){
	    		$row['AGE'] =  $diff = (date('Y') - date('Y',strtotime($row['DATE OF BIRTH'])));
	    	}
	    	/*Personal Info*/
	    		if(!empty($row['DATE OF BIRTH'])){
	    			$row['DATE OF BIRTH']="<div class='row'>
												<div class='col-xs-6'>
													<label class='control-label'>Date of Birth</label>
													<h6>".date('F d, Y',strtotime($row['DATE OF BIRTH']))."</h6>
												</div>
												<div class='col-xs-6'>
													<label class='control-label'>Age</label>
													<h6>".$row['AGE']."</h6>
												</div>
											</div>";
	    		}
	    		if(!empty($row['HEIGHT']) && !empty($row['WEIGHT'])){
	    			$heiwei = "<div class='row'>
									<div class='col-xs-6'>
										<label class='control-label'>Weight</label>
										<h6>".$row['WEIGHT']."</h6>
									</div>
									<div class='col-xs-6'>
										<label class='control-label'>Height</label>
										<h6>".$row['HEIGHT']."</h6>
									</div>
								</div>";
	    		}
	    		if(!empty($row['NICKNAME'])){
	    			$row['NICKNAME'] ="<label class='control-label'>Nickname</label>
								<h6>".$row['NICKNAME']."</h6>";
	    		}
	    		if(!empty($row['RELIGION'] && !empty($row['BLOODTYPE']))){
		    		$reblood = "<div class='row'>
									<div class='col-xs-6'>
										<label class='control-label'>Religion</label>
										<h6>".$row['RELIGION']."</h6>
									</div>
									<div class='col-xs-6'>
										<label class='control-label'>Bloodtype</label>
										<h6>".$row['BLOODTYPE']."</h6>
									</div>
								</div>";
		    	}
	    	/*Contact Info*/
		    	if(!empty($row['HOME_TELNUM'])){
		    		$row['HOME_TELNUM'] = "<label class='control-label'>Home Tel No.:</label>
										<h6>".$row['HOME_TELNUM']."</h6>";
		    	}
		    	if(!empty($row['MOBILE_NUMBER'])){
		    		$row['MOBILE_NUMBER'] = "<label class='control-label'>Mobile No.:</label>
										<h6>".$row['MOBILE_NUMBER']."</h6>";
		    	}
		    	if(!empty($row['CONTACT NAME'])){
		    		$row['CONTACT NAME'] = "<label class='control-label'>Contact Person In case of emergency:</label>
										<h6>".$row['CONTACT NAME'].": ".$row['CONTACT DETAILS']."</h6>";
		    	}
		    	if(!empty($row['EMAIL ADDRESS'])){
		    		$row['EMAIL ADDRESS'] = "<label class='control-label'>Email Address:</label>
										<h6>".$row['EMAIL ADDRESS']."</h6>";
		    	}
		    	if(!empty($row['SKYPE_USERID'])){
		    		$row['SKYPE_USERID'] = "<label class='control-label'>Skype user ID:</label>
										<h6>".$row['SKYPE_USERID']."</h6>";
		    	}
		    	
	    	/*Family*/
		    	if(!empty($row['FATHER\'S NAME'])){
		    		$row['FATHER\'S NAME'] = "<label class='control-label'>Father's Name:</label>
										<h6>".$row['FATHER\'S NAME']."</h6>";
		    	}
		    	if(!empty($row['MOTHER\'S MAIDEN NAME'])){
		    		$row['MOTHER\'S MAIDEN NAME'] = "<label class='control-label'>Mother's Name:</label>
										<h6>".$row['MOTHER\'S MAIDEN NAME']."</h6>";
		    	}
		    	if(!empty($row['MOTHER\'S MAIDEN NAME']) && !empty($row['FATHER\'S NAME'])){
		    		$family = "<div class='card col-xs-12'><p><strong><i class='fa fa-group'></i> FAMILY BACKGROUND</p></strong>
									<div class='col-xs-12'>
										<div class='col-xs-6'><!-- HEY! -->
											".$row['FATHER\'S NAME']."
											".$row['FATHER PLACEBIRTH']."
										</div>
										<div class='col-xs-6'><!-- HEY! -->
											".$row['MOTHER\'S MAIDEN NAME']."
											".$row['MOTHER PLACEBIRTH']."
										</div>
										</div>
									</div>
								";
		    	}
		    	/*$sql3 = "SELECT * FROM tbl_child WHERE ID = '$id'";
		    	$result3 = $conn->query($sql3);
		    	if ($result3->num_rows > 0){
		    		while($row3 = $result3->fetch_assoc()){
		    		$children = "<div class='col-xs-12'>
		    						<div class='col-xs-6'>".$row3['CHILD_NAME']."</div>
		    						<div class='col-xs-6'>".$row['CHILD_AGE']."</div>
		    					</div>";
		    		}
		    		$family.=$children."</div>";
		    	}*/
		    	$sql4 = "SELECT * FROM tbl_siblings WHERE ID = '$id'";
		    	$result4 = $conn->query($sql4);
		    	if ($result4->num_rows > 0){
		    		while($row4 = $result4->fetch_assoc()){
		    		$siblings = "<div class='col-xs-12'>
		    						<div class='col-xs-6'>".$row4['SIBLING_NAME']."</div>
		    					</div>";
		    		}
		    		$family.=$siblings."</div>";
		    	}
		    	/*CHILDREN & SIBLING HERE $family*/
		    /*Work Experience*/
		    if(!empty($row['1. Inclusive Dates'])){
		    		$workexperience = "<div class='card col-xs-12'><p><strong><i class='fa fa-briefcase'></i> WORK EXPERIENCE</p></strong>
		    		<div class='col-xs-12 row' style='text-align:center;'>
		    			<div class='col-xs-2'><label class='control-label'>Inclusive Dates</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Employer's Details</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Position Title</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Supervisor Details</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Monthly Salary</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Reason for Leaving</label></div>
		    		";
	    	}
	    	$x = 1;
		    while($x < 7){
		    	if(!empty($row[$x.'. Inclusive Dates'])){
					if(!empty($row[$x.'.4 Monthly Salary'])){
						$row[$x.'.4 Monthly Salary'] = "P ".$row[$x.'.4 Monthly Salary'];
					}
	    		$workexperience = $workexperience. "<hr><div class='row'>
								<div class='col-xs-2'><!-- HEY! -->
									<h6>".$row[$x.'. Inclusive Dates']."</h6>
								</div>
								<div class='col-xs-2'><!-- HEY! -->
									<h6>".$row[$x.'.1 Employer\'s Name, Address and Phone']."</h6>
								</div>
								<div class='col-xs-2'><!-- HEY! -->
									<h6>".$row[$x.'.2 Position Title']."</h6>
								</div>
								<div class='col-xs-2'><!-- HEY! -->
									<h6>".$row[$x.'.3 Name_Position and Contact No. of Immediate Supervisor']."</h6>
								</div>
								<div class='col-xs-2'><!-- HEY! -->
									<h6>".$row[$x.'.4 Monthly Salary']."</h6>
								</div>
								<div class='col-xs-2'><!-- HEY! -->
									<h6>".$row[$x.'.5 Reason for Leaving']."</h6>
								</div>
							</div>";
		    	}
		    	$x++;
		    }
		    $workexperience = $workexperience."</div>";
		    
		    /*Educational Background*/
		    if(!empty($row['ELEM_Name of School']) || !empty($row['HS_Name of School']) || !empty($row['COL_Name of School'])){
		    	$education = "<div class='card col-xs-12'><p><strong><i class='fa fa-graduation-cap'></i> EDUCATIONAL BACKGROUND</p></strong>
		    		<div class='col-xs-12 row' style='text-align:center;'>
		    			<div class='col-xs-4'><label class='control-label'>Name of School</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Year Graduated</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Highest Grades Earned</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Inclusive Dates</label></div>
		    			<div class='col-xs-2'><label class='control-label'>Academic Honors</label></div>
		    	";
		    }
		    $level = ['ELEM_', 'HS_', 'COL_'];
		    foreach($level as $lvl){
		    	if($row[$lvl.'Name of School']){
		    		$education.="<hr><div class='row'>
		    		<div class='col-xs-4'><!-- HEY! -->
						<h6>".$row[$lvl.'Name of School']."</h6>
					</div>
		    		<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row[$lvl.'Year Graduated']."</h6>
					</div>
					<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row[$lvl.'Highest Grade/ Level/ Units Earned']."</h6>
					</div>
					<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row[$lvl.'Inclusive Dates of Attendance']."</h6>
					</div>
					<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row[$lvl.'Scholarship/ Academic Honors Received']."</h6>
					</div>					
					</div>";
		    	}
		    }
		    if(!empty($row['GRAD_Name of School'])){
		    	$education.="<hr><div class='row'>
		    		<div class='col-xs-4'><!-- HEY! -->
						<h6>".$row['GRAD_Name of School']."</h6>
					</div>
		    		<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row['GRAD_Year Graduated']."</h6>
					</div>
					<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row['GRAD_Highest Grade/ Level/ Units Earned']."</h6>
					</div>
					<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row['GRAD_Inclusive Dates of Attendance']."</h6>
					</div>
					<div class='col-xs-2'><!-- HEY! -->
						<h6>".$row['GRAD_Scholarship']."</h6>
					</div>					
					</div>";
		    }
		    /*professional qualification*/
		    $professional = "";
		    if(!empty($row['PROF_License1'])){
		    	$professional .= "<div class='card col-xs-12'><p><strong><i class='fa fa-id-card'></i> PROFESSIONAL QUALIFICATIONS</p></strong>
		    			<div class='col-xs-12 row' style='text-align:center;'>
		    			<div class='col-xs-2'>License/Certification</div>
		    			<div class='col-xs-2'>Rating</div>
		    			<div class='col-xs-2'>Date Granted</div>
		    			<div class='col-xs-2'>Granting Institution</div>
		    			<div class='col-xs-2'>License Number</div>
		    			<div class='col-xs-2'>Date Released</div>
		    		";
		    }
		    $number = ['1', '2', '3'];
		    foreach($number as $pq){
		    	if(!empty($row['PROF_License'.$pq])){
		    		$professional .= "<hr><div class='row'>
		    		<div class='col-xs-2'><h6>".$row['PROF_License'.$pq]."</h6></div>
		    		<div class='col-xs-2'><h6>".$row['PROF_Rating'.$pq]."</h6></div>
		    		<div class='col-xs-2'><h6>".$row['PROF_DateGranted'.$pq]."</h6></div>
		    		<div class='col-xs-2'><h6>".$row['PROF_Institution'.$pq]."</h6></div>
		    		<div class='col-xs-2'><h6>".$row['PROF_Licensenum'.$pq]."</h6></div>
		    		<div class='col-xs-2'><h6>".$row['PROF_DateReleased'.$pq]."</h6></div>
		    		</div>";
		    	}
		    }
		    /*language*/
		    $language = "";
		    if(!empty($row['ONE_LANGUAGE'])){
		    	$language = "<div class='card col-xs-12'><p><strong><i class='fa fa-language'></i> LANGUAGE PRFICEINCY</p></strong>
		    		<div class='col-xs-12 row' style='text-align:center;'>
		    		<div class='col-xs-3'>Language</div>
		    		<div class='col-xs-3'>Speak</div>
		    		<div class='col-xs-3'>Read</div>
		    		<div class='col-xs-3'>Write</div>
		    	";
		    }
		    $langnum = ['ONE_', 'TWO_', 'THREE_', 'FOUR_', 'FIVE_'];
		    foreach($langnum as $lang){
		    	if(!empty($row[$lang.'LANGUAGE'])){
		    		$language .= "<hr><div class='row'>
		    		<div class='col-xs-2'><h6>".$row[$lang.'LANGUAGE']."</h6></div>
		    		<div class='col-xs-2'><h6>".$row[$lang.'SPEAK']."</h6></div>
		    		<div class='col-xs-2'><h6>".$row[$lang.'READ']."</h6></div>
		    		<div class='col-xs-2'><h6>".$row[$lang.'WRITE']."</h6></div>
		    		</div>";
		    	}
		    }
		    /*other info*/
		    $otherinfo = "";
		    if(!empty($row['SKILLS1']) || !empty($row['RECOGNITION1']) || !empty($row['ORG1'])){
		    	$otherinfo = "<div class='card col-xs-12'><p><strong> OTHER INFORMATION</p></strong>";
		    }
		    
	    	if(!empty($row['SKILLS1'])){
	    		$otherinfo .= "<hr><div class='row'>
	    		<div class='col-xs-2'><h6>Skills</h6></div>
	    		<div class='col-xs-2'><h6>".$row['SKILLS1']."</h6></div>
	    		<div class='col-xs-2'><h6>".$row['SKILLS2']."</h6></div>
	    		<div class='col-xs-2'><h6>".$row['SKILLS3']."</h6></div>
	    		</div>";
	    	}
	    	if(!empty($row['RECOGNITION1'])){
	    		$otherinfo .= "<hr><div class='row'>
	    		<div class='col-xs-2'><h6>Recognition</h6></div>
	    		<div class='col-xs-2'><h6>".$row['RECOGNITION1']."</h6></div>
	    		<div class='col-xs-2'><h6>".$row['RECOGNITION2']."</h6></div>
	    		<div class='col-xs-2'><h6>".$row['RECOGNITION3']."</h6></div>
	    		</div>";
	    	}
	    	if(!empty($row['ORG1'])){
	    		$otherinfo .= "<hr><div class='row'>
	    		<div class='col-xs-2'><h6>Organization</h6></div>
	    		<div class='col-xs-2'><h6>".$row['ORG1']."</h6></div>
	    		<div class='col-xs-2'><h6>".$row['ORG2']."</h6></div>
	    		<div class='col-xs-2'><h6>".$row['ORG3']."</h6></div>
	    		</div>";
	    	}

	    	if ($result2->num_rows > 0){
	    		while($row2 = $result2->fetch_assoc()) {

				echo "<!DOCTYPE html>
				<html>
				<head>
					<title>".$row['NAME']."'s Application </title>
				</head>
			
				<body class='container-fluid'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
					<!-- <link rel='stylesheet' type='text/css' href='css/dataTables.bootstrap.css'> -->
					<link rel='stylesheet' type='text/css' href='css/bootstrap-material-design.css'>
					<link rel='stylesheet' type='text/css' href='css/dataTables.material.css'>
					<link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
					<link rel='stylesheet' type='text/css' href='css/sidenav.css'>
					<style type='text/css'>
						.active {
							background-color: #494949;
						}
						label{
							color: grey;
							font-style: italic;
						}
						p{
							font-weight: 500;
						}

						.printbreak{
						
							page-break-before: always;
						
						}
					</style>
					<div class='row'>
						<div class='col-xs-8'>
						<h3 style='margin-top:5%'>APPLICATION FORM</h3>
						".$row['NAME']."'s Application form </br>
						<label>Application Date:</label> ".date("F d, Y", strtotime($row['Timestamp']))."
						</div>
						<div class='col-xs-4'>
							<img class='img-responsive pull-right' src='ag.png' width='110%' height='100px' style='margin-top:5%;'/>
						</div>
					</div>
					<hr>

					<div class='row'>
						<div class='card col-xs-12'>
							<div class='col-xs-6'>
								<label class='control-label'>Position Applying for:</label>
								<h6>".$row2['position_name']."</h6>
								<label class='control-label'>Amenable to shifting schedule:</label>
								<h6>".$row['SHIFTING_SCHEDULE']."</h6>
								<label class='control-label'>Willing to work on Weekends/Holidays:</label>
								<h6>".$row['WEEKENDS_HOLIDAYS']."</h6>
							</div>
							<div class='col-xs-2'></div>
							<div class='col-xs-6'>
								<label class='control-label'>Available Date for Employment:</label>
								<h6>".$row['EMPLOYMENT_DATE']."</h6>
								<label class='control-label'>Expected Salary:</label>
								<h6>". $row['SALARY']."</h6>
							</div>
						</div>
						
						<div class='card col-xs-12'><p><strong><i class='fa fa-user-o'></i> PERSONAL INFORMATION</p></strong>
						<div class='col-xs-12'>
							<div class='col-xs-6'><!-- HEY!-->
								<label class='control-label'>Name</label>
								<h6>".$row['NAME']."</h6>
								".$row['DATE OF BIRTH']."
								<label class='control-label'>Sex</label>
								<h6>".$row['GENDER']."</h6>
								".$heiwei."
							</div>
							<div class='col-xs-6'><!-- HEY!-->
								".$row['NICKNAME']."</h6>
								<label class='control-label'>Place of Birth</label>
								<h6>".$row['PLACE OF BIRTH']."</h6>
								<label class='control-label'>Civil Status</label>
								<h6>Single</h6>
								".$reblood."
							</div>
						</div>
						</div>
						<div class='card col-xs-12'><p><strong><i class='fa fa-phone'></i> CONTACT INFORMATION</p></strong>
						<div class='col-xs-12'>
							<div class='col-xs-6'><!--HEY -->
								".$row['HOME_TELNUM']."
								".$row['MOBILE_NUMBER']."
								".$row['CONTACT NAME']."
							</div>
							<div class='col-xs-6'><!--HEY -->
								".$row['EMAIL ADDRESS']."
								".$row['SKYPE_USERID']."
								
							</div>
						</div>
						</div>
						<hr>
						".$family."
						<div class='printbreak'></div>".$workexperience."
						</div>".$education."
						</div>".$professional."
						</div>".$language."
						</div>".$otherinfo."
						
					<button style='position: fixed; bottom: 5px; right: 10px;' onclick='window.print();' class='btn btn-raised pull-right hidden-print btn-info'><i class='fa fa-print'></i> Print</button>
					
					
					<script type='text/javascript'>
						$(document).ready(function(){
						    $('#myTable').DataTable({
						    	'bLengthChange': false,
						    });
							$.material.init();
						});

					</script>

				</body>
				</html>";
	    		}
	    	}
		}
	}


