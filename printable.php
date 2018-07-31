<?php 

	include('connect.php');//sql connection

	include('auth.php');//for authenticated user's only



	$id = $_GET['id'];

	//if

	$sql = "SELECT * FROM tbl_application WHERE id = '$id'";

	$result = $conn->query($sql);

	$row = $result->fetch_assoc();



	/*$positionid = $row['POSITION'];

	$position_name = "SELECT * FROM tbl_position WHERE id = $positionid";

	$positionresult = $conn->query($position_name);

	$position = $positionresult->fetch_assoc();*/



	$sqllanguage = "SELECT * FROM tbl_languages WHERE id = '$id'";

	$language_result = $conn->query($sqllanguage);

	$language = $language_result->fetch_assoc();



	$sqlchild = "SELECT * FROM tbl_child WHERE ID = '$id'";

	$child_result = $conn->query($sqlchild);

	$child = $child_result->fetch_assoc();



	$sqlsibling = "SELECT * FROM tbl_siblings WHERE ID = '$id'";

	$sibling_result = $conn->query($sqlsibling);

	$sibling = $sibling_result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

	<title></title>

	<meta charset="UTF-8">

	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="shortcut icon" href="favicon.ico" />



	<!-- <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css"> -->



	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">



	<link rel="stylesheet" type="text/css" href="css/dataTables.material.css">



	<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">



	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">



	<link rel="stylesheet" type="text/css" href="css/sidenav.css">



	<link rel="stylesheet" type="text/css" href="css/datepicker3.css">



	<link rel="stylesheet" type="text/css" href="css/bootstrap-timepicker.min.css">



	<link rel = "stylesheet" type = "text/css" href = "css/dataTables.tableTools.min.css">



	<link rel = "stylesheet" type = "text/css" href = "css/dataTables.tableTools.css">



	<link rel = "stylesheet" type = "text/css" href = "css/buttons.dataTables.min.css">



	<link rel = "stylesheet" type = "text/css" href = "css/buttons.dataTables.css">



	<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.min.css">

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



        body, div{

            -webkit-region-break-inside: avoid;

        }

        



		.large {

		    width: 130px;

		    font-size: 13px;

		    float: right;

		}

		.small {

		    width: 70px;

		    float: right;

		}

        

        @media all {

            .printbreak	{ display: none; }

        }



        @media print {

            .printbreak	{ display: block; page-break-before: always;}

            body, div {position: relative;  -webkit-region-break-inside: avoid; }

            

        }



	</style>

</head>

<body style= 'margin-left:3%; margin-bottom:3%;'>

	<div class='col-xs-4'>

		<img class='img-responsive' src='ag.png' width='250%' height='200%' style='margin-left:100%;'>

	</div>

	

	<div class='row card'>

		<div class='col-xs-8'>

		<h3 style='position: "center"'>APPLICATION FORM</h3>

		<p style="font-size:20px;"><b><?php echo utf8_decode($row['NAME']);?><br/></b></p>

		<label>Application Date:</label><?php echo date("F d, Y", strtotime($row['Timestamp'])) ?>

		</div>



	

		<div class="row col-xs-12" >

			<div class="col-xs-6">

				<label><i> Position Applying for:</i></label>

				<!--input style="width: 183px;font-size: 13px; float: right;" type="text" value="--><?php echo $row['POSITION'] ?>

			</div>

			<div class="col-xs-6">

				<label style="font-size: 13px"><i> Available Date for Employment:</i></label>

				<!--input type="text" style="width: 140px; font-size: 13px; float: right" value="--><?php echo $row['EMPLOYMENT_DATE'] ?>

			</div>

		</div>

		<div class="row col-xs-12">

			<div class="col-xs-6">

				<label style="font-size: 15px"><i>Are you Amenable for Shifting Schedule?</i></label>

				<!--input type="text" style="width: 40px; float: right" value="--><?php echo $row['SHIFTING_SCHEDULE'] ?>

			</div>

			<div class="col-xs-6">

				<label ><i>Expected Salary:</i></label>

				<!--input style="width: 140px; font-size: 13px; float: right" type="text" value="--><?php echo $row['SALARY'] ?>

			</div>

			<div class="col-xs-6">

				<label style="font-size: 14px"><i>Are you willing to work on weekends/holiday?</i></label>

				<!--input type="text" style="width: 40px; float: right" value="--><?php echo $row['WEEKENDS_HOLIDAYS'] ?>

			</div>

		</div>

	</div>

	<div class="row card" style="padding-top: 1%;">

		<div class="col-xs-12">

			<label><i class="fa fa-user-o"></i> PERSONAL INFORMATION</label>

		</div>

		<div class="col-xs-6">

			<div class="col-xs-12">

				<label>Nickname:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo utf8_decode($row['NICKNAME']); ?>

			</div>

			<div class="col-xs-12">

				<label>Birth date:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['DATE OF BIRTH'] ?>

			 </div>

			<div class="col-xs-12">

				<label>Place of Birth:</label>

			 	<!--input type="text" style="width: 180px; float: right; font-size: 13px" value="--><?php echo utf8_decode($row['PLACE OF BIRTH']); ?>

			</div>

			<div class="col-xs-12">

				<label>Blood Type:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['BLOODTYPE'] ?>

			</div>

			<div class="col-xs-12">

				<label>Height:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['HEIGHT'] ?>

			</div>

		</div>

		<div class="col-xs-6">

			<div class="col-xs-12">

				<label>Civil Status:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['CIVIL STATUS'] ?>

			</div>

			<div class="col-xs-12">

				<label>Age:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['AGE'] ?>

			 </div>

			<div class="col-xs-12">

				<label>Gender:</label>

			 	<!--input type="text" style="width: 180px; float: right"  value="--><?php echo $row['GENDER'] ?>

			</div>

			<div class="col-xs-12">

				<label>Religion:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['RELIGION'] ?>

			</div>

			<div class="col-xs-12">

				<label>Weight:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['WEIGHT'] ?>

			</div>

		</div>

		<div class="col-xs-12">

			<div class="col-xs-12">

				<label>Current Address:</label>

				<!--textarea style="height: 2 ;width: 560px; float: right"--><?php echo utf8_decode($row['CURRENT ADDRESS']); ?><!--/textarea-->

			</div>

			<div class="col-xs-12">

				<label>Provincial Address:</label>

				<!--textarea style="height: 2 ;width: 560px; float: right"--><?php echo utf8_decode($row['PROVINCIAL_ADDRESS']); ?><!--/textarea-->

			</div>

		</div>

	</div>

	<div class="row card" style="padding-top: 1%;">

		<div class="col-xs-12">

			<label><i class="fa fa-phone"></i> CONTACT INFORMATION</label>

		</div>

		<div class="col-xs-6">

			<div class="col-xs-12">

				<label>Mobile No.:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['MOBILE_NUMBER'] ?>

			</div>

			<div class="col-xs-12">

				<label><small>Optional</small> Mob. #:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['MOBILE_NUMBER2'] ?>

			 </div>

			<div class="col-xs-12">

				<label>Email Address:</label>

			 	<!--input type="text" style="width: 180px; float: right; font-size: 13px" value="--><?php echo $row['EMAIL ADDRESS'] ?>

			</div>

			<div class="col-xs-12">

				<label>Facebook:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['FB_Account'] ?>

			</div>

			<div class="col-xs-12">

				<label>Contact Person:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['CONTACT NAME'] ?>

			</div>

		</div>

		<div class="col-xs-6">

			<div class="col-xs-12">

				<label>Home Tel Number:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['HOME_TELNUM'] ?>

			</div>

			<div class="col-xs-12">

				<label><small>Optional</small> Mob. #:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['MOBILE_NUMBER3'] ?>

			 </div>

			<div class="col-xs-12">

				<label>Skype:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['SKYPE_USERID'] ?>

			</div>

			<div class="col-xs-12">

				<label>Twitter:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['Twitter_Account'] ?>

			</div>

			<div class="col-xs-12">

				<label>Contact Detail:</label>

			 	<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['CONTACT DETAILS'] ?>

			</div>

		</div>

		

		

	</div>		

	<div class="printbreak"></div>

    <div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label><i class="fa fa-group"> </i> FAMILY BACKGROUND</label>

		</div>

		<?php 

			if (!empty($row['SPOUSE\'S NAME'])) {

				echo "

					<div class='col-xs-12'>

						<div class='col-xs-12'>

							<label>Spouse Name:</label>"

							//<!--input type='text' style='width: 550px; float: right' value='""'-->

							.$row['SPOUSE\'S NAME']."

						</div>

						<div class='col-xs-12'>

							<label>Occupation:</label>"

						 	//<input type='text' style='width: 550px; float: right;' value='""'>

							.$row['SPOUSE\'S OCCUPATION']."

						</div>

					</div>

				";

			}

		 ?>

		

		<div class="col-xs-12">

			<div class="col-xs-12">

				<label>Father's Name:</label>

				<!--input type="text" style="width: 550px; float: right" value="--><?php echo utf8_decode($row['FATHER\'S NAME']); ?>

			</div>

			<div class="col-xs-12">

				<label>Place of Birth:</label>

			 	<!--input type="text" style="width: 550px; float: right;" value="--><?php echo utf8_decode($row['FATHER PLACEBIRTH']); ?>

			</div>

		</div>

		<div class="col-xs-12">

			<div class="col-xs-12">

				<label>Mother's Name:</label>

				<!--input type="text" style="width: 550px; float: right" value="--><?php echo utf8_decode($row['MOTHER\'S MAIDEN NAME']); ?>

			</div>

			<div class="col-xs-12">

				<label>Place of Birth:</label>

			 	<!--input type="text" style="width: 550px; float: right;" value="--><?php echo utf8_decode($row['MOTHER PLACEBIRTH']); ?>

			</div>

		</div>

	

	

		<?php 

		if (!empty($sibling['SIBLING_NAME'])) {

			echo "

				<div class='col-xs-12'>

					<div class='col-xs-8'>

						<label><b>Sibling's Name</b></label>

					</div>

					<div class='col-xs-4'>

						<label><b>Sibling's Age</b></label>

					</div>

				</div>

			";

		}

	 	?>

		<?php 

			$dependentCounter = 1;

		 ?>

		<div class="col-xs-12">

			<div class="col-xs-12">

				<?php 

					

					while($sibling = $sibling_result->fetch_assoc()){

						if (!empty($sibling['SIBLING_NAME'])) {

							echo "

								<div class = 'col-xs-8'>"

									//<input type='text' style='width: 400px; float: right;' value='""'></input>

									.$sibling['SIBLING_NAME']."

								</div>

								<div class = 'col-xs-4'>"

									//<input type='text' style='width: 50px;' value='""'></input>

									.$sibling['SIBLING_AGE']."

								</div>

							";

						}

					$dependentCounter++;

					}

				 ?>

			</div>

		</div>

		<?php 

			if (!empty($child['CHILD_NAME'])) {

				echo "

					<div class='col-xs-12'>

						<div class='col-xs-8'>

							<label><b>Dependent's Name</b></label>

						</div>

						<div class='col-xs-4'>

							<label><b>Dependent's Age</b></label>

						</div>

					</div>

				";

			}

		 ?>

		

		<div class="col-xs-12">

			<div class="col-xs-12">

				<?php 

					while($child = $child_result->fetch_assoc()){

						if (!empty($child['CHILD_NAME'])) {

							echo "

								<div class = 'col-xs-8'>"

									//<input type='text' style='width: 400px; float: right;' value='""'></input>

									.$child['CHILD_NAME']."

								</div>

								<div class = 'col-xs-4'>"

									//<input type='text' style='width: 50px;' value='""'></input>

									.$child['CHILD_AGE']."

								</div>

							";

						}

					$dependentCounter++;

					}

				 ?>

			</div>

		</div>

	</div>



	<div class="printbreak"></div>



	<div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label><i class="fa fa-briefcase"> </i> WORK EXPERIENCE</label>

		</div>

	<?php

		$counter = 1;

		$printbreakCounter = 1;

		while($counter < 7){

			if(!empty($row[$counter.'. Inclusive Dates'])){

			$explodeSupervisor = explode("/", $row[$counter.'.3 Name_Position and Contact No. of Immediate Supervisor']);

			$explodeDates = explode("-", $row[$counter.'. Inclusive Dates']);

			$explodeCompany = explode("/", $row[$counter.'.1 Employer\'s Name, Address and Phone']);

				if (!empty($explodeDates[1])) {

					$CompanyDate = $explodeDates[1];

				}

				else{

					$CompanyDate = "";

				}

				echo "	<div class='col-xs-12'>

							<label>$counter.</label>

						</div>

						<div class='col-xs-12'>

						<div class='col-xs-6'>

							<label>Position Title:</label>"

						 	//<input type='text' style='width: 180px; float: right; font-size: 13px' value='""'>

							.$row[$counter.'.2 Position Title']."

						</div>

						<div class='col-xs-6'>

							<label>Company Name:</label>"

						 	//<input type='text' style='width: 180px; float: right' value='":'>

							.$explodeCompany[0]."

						</div>

						</div>

						<div class='col-xs-12'>

							<div class='col-xs-3'>

								<label>From:</label>"

							 	//<input type='text' style='width: 110px; float: right; font-size: 13px' value='""'>

								.$explodeDates[0]."

							</div>

							<div class='col-xs-3'>

								<label>To:</label>"

							 	//<input type='text' style='width: 120px; float: right; font-size: 13px'value='""'>

								.$CompanyDate."

							</div>

							<div class='col-xs-6'>

								<label>Monthly Salary:</label>"

							 	//<input type='text' style='width: 180px; float: right' value='""'>

								.$row[$counter.'.4 Monthly Salary']."

							</div>

						</div>

						<div class='col-xs-12'>

							<div class='col-xs-6'>

								<label>Name of Supervisor:</label>"

							 	//<input type='text' style='width: 180px; float: right; font-size: 13px' value='""'>

								.$explodeSupervisor[0]."

							</div>



							<div class='col-xs-6'>

								<label>Contact No.:</label>"

							 	//<input type='text' style='width: 180px; float: right' value='""'>

								.$row[$counter.'.6 Emp_phone']."

							</div>

						</div>

						<div class='col-xs-12' style='margin-bottom: 15px'>

							<div class='col-xs-12'>

								<label>Reason of leaving:</label>"

								//<input type='text' style='width: 550px; float: right' value='""'>

								.$row[$counter.'.5 Reason for Leaving']."

							</div>

						</div>";

						$printbreakCounter++;

			}

			$counter++;

		}

	?>		

	</div>







<!--NOTES-->



	





	<script type="text/javascript" src="js/tether.js"></script>



	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>



	<script type="text/javascript" src="js/jquery.dataTables.js"></script>



	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>



	<script type="text/javascript" src="js/buttons.Html5.min.js"></script>



	<script type="text/javascript" src="js/bootstrap.min.js"></script>	



	<script type="text/javascript" src="js/material.js"></script>



	<script type="text/javascript" src="js/buttons.print.min.js"></script>



	<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>



	<script type="text/javascript" src="js/dataTables.tableTools.min.js"></script>



	<script type="text/javascript" src="js/dataTables.material.js"></script>



	<script type="text/javascript" src="js/dataTables.select.min.js"></script>



	<script type="text/javascript" src="js/buttons.flash.min.js"></script>



	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>



	<script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>



	<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>



	<script type="text/javascript">



	    $('.clockpicker').clockpicker();



	</script>



	<?php

		if ($printbreakCounter > 4) {

			echo "<div class='printbreak'> </div><div> </div>"; 

		}

		else{			

		}



		$explodeElemDates = explode("-", $row['ELEM_Inclusive Dates of Attendance']);

		$explodeHSDates = explode("-", $row['HS_Inclusive Dates of Attendance']);

		$explodeColDates = explode("-", $row['COL_Inclusive Dates of Attendance']);

		$explodeGradDates = explode("-", $row['GRAD_Inclusive Dates of Attendance']);

		if (!empty($explodeGradDates[1])){

			$GradDates = $explodeGradDates[1];

		}

		else{

			$GradDates = "";

		}

		if (!empty($explodeColDates[1])) {

			$ColDates = $explodeColDates[1];

		}

		else{

			$ColDates = "";

		}

		if (!empty($explodeHSDates[1])) {

			$HSDates = $explodeHSDates[1];

		}

		else{

			$HSDates = "";

		}

		if (!empty($explodeElemDates[1])) {

			$ElemDates = $explodeElemDates[1];

		}

		else{

			$ElemDates = "";

		}

	 ?>



	 	<div class="printbreak"></div>



		<div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label><i class="fa fa-graduation-cap"> </i> EDUCATIONAL BACKGROUND</label>

		</div>

		

		<div class="col-xs-12">

		<label><b>PRIMARY:</b></label>

			<div class="col-xs-12">

				<label>Name of school:</label>

				<!--input type="text" style="width: 580px; float: right" value="--><?php echo utf8_decode($row['ELEM_Name of School']); ?>

			</div>

		</div>

		<div class="col-xs-12">

			<div class="col-xs-3">

				<label>From:</label>

			 	<!--input type="text" style="width: 110px; float: right; font-size: 13px" value="--><?php echo $explodeElemDates[0] ?>

			</div>

			<div class="col-xs-3">

				<label>To:</label>

			 	<!--input type="text" style="width: 120px; float: right; font-size: 13px" value="--><?php echo $ElemDates ?>

			</div>

			<div class="col-xs-6">

				<label>Scholarship:</label>

				<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['ELEM_Scholarship/ Academic Honors Received'] ?>

			</div>

		</div>

		

		<div class="col-xs-12">

		<label><b>Secondary:</b></label>

			<div class="col-xs-12">

				<label>Name of school:</label>

				<!--input type="text" style="width: 580px; float: right" value="--><?php echo utf8_decode($row['HS_Name of School']); ?>

			</div>

		</div>

		<div class="col-xs-12">

			<div class="col-xs-3">

				<label>From:</label>

			 	<!--input type="text" style="width: 110px; float: right; font-size: 13px" value="--><?php echo $explodeHSDates[0] ?>

			</div>

			<div class="col-xs-3">

				<label>To:</label>

			 	<!--input type="text" style="width: 120px; float: right; font-size: 13px" value="--><?php echo $HSDates ?>

			</div>

			<div class="col-xs-6">

				<label>Scholarship:</label>

				<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['HS_Scholarship/ Academic Honors Received'] ?>

			</div>

		</div>

		<div class="col-xs-12">

		

		<label><b>Tertiary:</b></label>

			<div class="col-xs-12">

				<label>Name of school:</label>

				<!--input type="text" style="width: 580px; float: right" value="--><?php echo utf8_decode($row['COL_Name of School']); ?>

			</div>

			<div class="col-xs-12">

				<label>Course:</label>

				<!--input type="text" style="width: 580px; float: right" value="--><?php echo $row['COL_Degree Course'] ?>

			</div>

		</div>

		<div class="col-xs-12">

			<div class="col-xs-3">

				<label>From:</label>

			 	<!--input type="text" style="width: 110px; float: right; font-size: 13px" value="--><?php echo $explodeColDates[0] ?>

			</div>

			<div class="col-xs-3">

				<label>To:</label>

			 	<!--input type="text" style="width: 120px; float: right; font-size: 13px" value="--><?php echo $ColDates ?>

			</div>

			<div class="col-xs-6">

				<label>Scholarship:</label>

				<!--input type="text" style="width: 180px; float: right" value="--><?php echo $row['COL_Scholarship/ Academic Honors Received'] ?>

			</div>

		</div>

		<?php 

			if (!empty($row['GRAD_Name of school'])) {

				echo "

				<div class='col-xs-12'>

					<label><b>Graduated School:</b></label>

						<div class='col-xs-12'>

							<label>Name of school:</label>"

							//<input type='text' style='width: 580px; float: right' value='""'>

							.$row['GRAD_Name of School']."

						</div>

						<div class='col-xs-12'>

							<label>Course:</label>"

							//<input type='text' style='width: 580px; float: right' value='":'>

							.$row['GRAD_Degree Course']."

						</div>

					</div>

					<div class='col-xs-12'>

						<div class='col-xs-3'>

							<label>From:</label>"

						 	//<input type='text' style='width: 110px; float: right; font-size: 13px' value='""'>

							.$explodeGradDates[0]."

						</div>

						<div class='col-xs-3'>

							<label>To:</label>"

						 	//<input type='text' style='width: 120px; float: right; font-size: 13px' value='""'>

							.$GradDates."

						</div>

						<div class='col-xs-6'>

							<label>Scholarship:</label>"

							//<input type='text' style='width: 180px; float: right' value='"">

							.$row['GRAD_Scholarship']."'

						</div>

					</div>

				";

			}

		 ?>

		 </div>

	

	<div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label><i class="fa fa-id-card"> </i> Professional Qualifications</label>

		</div>

		<?php  

			$profCounter = 1;

			$profnumber = 1;



			while ($profCounter < 4) {

				if (!empty($row['PROF_License'.$profCounter])) {

					echo "

						<div class='col-xs-12'>

							<label>$profCounter.</label>

						</div>

						<div class='col-xs-12'>

							<div class='col-xs-6'>

								<label>Liscense Certification:</label>"

							 	//<input type='text' style='width: 170px; float: right; font-size: 13px' value='""'>

								.$row['PROF_License'.$profCounter]."

							</div>

							<div class='col-xs-6'>

								<label>Liscense Number:</label>"

							 	//<input type='text' style='width: 180px; float: right' value='""'>

								.$row['PROF_Licensennum'.$profCounter]."

							</div>

						</div>";

				}

			$profCounter++;

			}

		?>

		

	</div>



	<div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label><i class="fa fa-language"> </i> Language proficiency</label>

		</div>

		<?php 

			$languages = ['ONE_','TWO_', 'THREE_', 'FOUR_', 'FIVE_'];

			foreach ($languages as $lang) {

				if (!empty($language[$lang.'LANGUAGE'])) {

					echo "

						<div class='col-xs-12'>

							<div class='col-xs-5'>

								<label>Language:</label>"." "

								//<input type='text' style='float: right; width: 180px' value='""'>

								.$language[$lang.'LANGUAGE']."

							</div>

						</div>

						<div class='col-xs-12'>

							<div class='col-xs-4'>

								<label>Speak:</label>"

								//<input type='text' style='float: right; width: 130px' value='""'>

								.$language[$lang.'SPEAK']."

							</div>

							<div class='col-xs-4'>

								<label>Read:</label>"

								//<input type='text' style='float: right; width: 130px' value='""'>

								.$language[$lang.'READ']."

							</div>

							<div class='col-xs-4'>

								<label>Write:</label>"

								//<input type='text' style='float: right; width: 130px' value='""'>

								.$language[$lang.'WRITE']."

							</div>

						</div>";	

				}

			}

		 ?>



	</div>

	<div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label>Other Information</label>

			<div class="col-xs-12">

				<div class="col-xs-7">

					<label>Last Physical Check-up</label>

					<!--input type="text" style="width: 200px; float: right" value="--><?php echo $row['Physical Checkup'] ?>

				</div>

			</div>

		</div>

	</div>



	<div class="row card" style="padding-top: 1%;">

    	<div class="col-xs-12">

			<label> Character Reference</label>

		</div>

		<?php

			$referenceCounter = "";



			while ($referenceCounter < 4) {

				if (!empty($row['REF_Name'.$referenceCounter])) {

					echo "

					<div class='col-xs-12'>

						<div class='col-xs-12'>

							<label>Name:</label>"

							//<input type='text' style='width: 600px; float: right' value='""'>

							.utf8_decode($row['REF_Name'.$referenceCounter])."

						</div>

						<div class='col-xs-6'>

							<label>Company Name:</label>"

							//<input type='text' style='width: 180px; float: right' value='""'>

							.utf8_decode($row['REF_Address'.$referenceCounter])."

						</div>

						<div class='col-xs-6'>

							<label>Contact Number:</label>"

							//<input type='text' style='width: 180px; float: right' value='""'>

							.$row['REF_ContactNum'.$referenceCounter]."

						</div>

					</div>";

				}

			$referenceCounter++;

			}

		?>

	</div>
	<div class="printbreak"></div>
	<div class="row card" style="padding-top: 1%;">
<div class="col-xs-12">

    	<div class="col-xs-12">

			<label><i class="fa fa-id-card"> </i>Essay </label>

		</div>

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

										echo'<div class="col-xs-12">


											  <label for="question'.$cnt.'" style="font-weight: 600;"><b> '.$cnt.'. </b>'.$question.'</label>
											  </div>
											  <div class="col-xs-12">

							<div class="col-xs-12">
											  <textarea disabled class="form-control" rows="5" name="question'.$cnt.'" id="question'.$cnt.'" required>'.$answer.'</textarea>

											  

											</div>

											</div>

											<br>';

										$cnt++;

									}

								}else{

								for ($x = 1; $x <= 4; $x++) {

									echo'<div class="col-xs-12">

										<div class="form-group label-floating">

										  <label for="question'.$x.'" style="font-weight: 600;"><b> '.$x.'. </b>'.$question.'</label>
										  	</div>
										  	<div class="col-xs-12">

							<div class="col-xs-6">
										  <textarea disabled class="form-control" rows="5" name="question'.$x.'" id="question'.$x.'" required></textarea>
										  </div></div>

										  

									

									<br>';

								

								}

							}

									

						}

					

		?>

		

	</div>
</div>



	<div class="printbreak"></div>

	<div class="row card" style="padding-top: 1%;">

	<div class="col-xs-12">

    	<div class="col-xs-12">

			<label> Terms and Agreement </label>

		</div>

		<center>

		<p>With the consent of the applicant, the following statements have been agreed.</p>

		<p align="justify" style="width: 85%"><medium>

			"I certify that the information contained in this application is

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

			prior notice at the option of the company or myself."

		</medium></p>

		</center>

		</div>

		</div>



	<div class="printbreak"></div>

	<div class="row card" style="padding-top: 1%; padding-bottom: 1%;">

    	<div class="col-xs-12">

			<label><i class="fa fa-comment"> </i>  Interviewer Comments</label>

		</div><left>

		<?php

			include ('comment.php');

		?>

		</left>

	</div>
		<?php
			$id = $_GET['id'];
			$ref=$_GET['ref'];

		?>


		<a href="printableResume.php?id=<?php echo $id?>&&ref=<?php echo $ref?>"><button style='position: fixed; bottom: 20px; right: 20px;' class='btn btn-raised pull-right hidden-print btn-info'><i class='fa fa-print'></i> Print</button></a>

	</div>

	

</body>

</html>

