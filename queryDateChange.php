<?php

	include('auth.php');

	include('connect.php');

	$startDate = "";

	$endDate = "";

			

				$sql = " from(SELECT tbl_application.ID as 'ID',

											`NAME` as `Name`,

											`Timestamp` as 'Timestamp',

											`Email Address` as 'Email',

											`Contact No.` as 'Contact Number',

											`status` as 'Status',

											`Current Address` as 'Address',

											concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'Previous Jobs',

											`Col_degree Course` as 'Course',

											(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',

											'tbl_application' as 'Source',

											`Gender` as 'Gender',

											`Age` as 'Age',

											`Note` as 'note',

											(CASE 

											  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''

											  ELSE SCHEDULE

											END) as `schedule`

									FROM tbl_application )myTable";

	

	

	if(isset($_POST['changeDateValue'])){

		

	$startDate = $_POST['dateStart'];

	$endDate = $_POST['dateEnd'];

						$positionsql2 = "

										SELECT

											SUM(CASE WHEN POSITION = 'H. R.' THEN 1 ELSE 0 END) as 'HR',

											SUM(CASE WHEN POSITION = 'Marketing Manager' THEN 1 ELSE 0 END) as 'MM', 

											SUM(CASE WHEN POSITION = 'IT Helpdesk Team Lead' THEN 1 ELSE 0 END) as 'ITlead',

											SUM(CASE WHEN POSITION = 'Web Developer' THEN 1 ELSE 0 END) as 'webdev',

											SUM(CASE WHEN POSITION = 'Customer Service Representative' THEN 1 ELSE 0 END) as 'CSR',

											SUM(CASE WHEN POSITION = 'Content Writer' THEN 1 ELSE 0 END) as 'CW',

											SUM(CASE WHEN POSITION = 'Accountant' THEN 1 ELSE 0 END) as 'accountant',

											SUM(CASE WHEN POSITION = 'Business Development Manager' THEN 1 ELSE 0 END) as 'BDM',

											SUM(CASE WHEN POSITION = 'Telesales Agent' THEN 1 ELSE 0 END) as 'TA',

											SUM(CASE WHEN POSITION = 'Software Developer' THEN 1 ELSE 0 END) as 'sofdev',

											SUM(CASE WHEN POSITION = 'IT Helpdesk' THEN 1 ELSE 0 END) as 'IThelp',

											SUM(CASE WHEN POSITION = 'Outbound Sales Rep.' THEN 1 ELSE 0 END) as 'OSR',

											SUM(CASE WHEN POSITION = 'Senior .NET Developer' THEN 1 ELSE 0 END) as 'SND',

											SUM(CASE WHEN POSITION = 'IT Manager' THEN 1 ELSE 0 END) as 'ITmanager',

											SUM(CASE WHEN POSITION = 'Project Manager' THEN 1 ELSE 0 END) as 'PM',

											SUM(CASE WHEN POSITION = 'Senior Software Developer' THEN 1 ELSE 0 END) as 'SSD',

											SUM(CASE WHEN POSITION = '.NET Developer' THEN 1 ELSE 0 END) as 'NETdev',

											SUM(CASE WHEN POSITION = 'Contract Centre Agent' THEN 1 ELSE 0 END) as 'CCA',

											SUM(CASE WHEN POSITION = 'Intern' THEN 1 ELSE 0 END) as 'intern',

											SUM(CASE WHEN POSITION = 'Finance Officer' THEN 1 ELSE 0 END) as 'FO',

											SUM(CASE WHEN POSITION = 'Admin Assistant' THEN 1 ELSE 0 END) as 'AA',

											SUM(CASE WHEN POSITION = 'Front End Web and HTML Designer' THEN 1 ELSE 0 END) as 'frontWeb',

											SUM(CASE WHEN POSITION = 'Various Position' THEN 1 ELSE 0 END) as 'VP',

											SUM(CASE WHEN POSITION = 'Reports Analyst' THEN 1 ELSE 0 END) as 'RA',

											SUM(CASE WHEN POSITION = 'HR Manager' THEN 1 ELSE 0 END) as 'HRmanager',

											SUM(CASE WHEN POSITION = 'IT Admin' THEN 1 ELSE 0 END) as 'ITadmin',

											SUM(CASE WHEN POSITION = 'IT Telesales Lead' THEN 1 ELSE 0 END) as 'ITtelesales',

											SUM(CASE WHEN POSITION = 'IT Helpdesk Manager' THEN 1 ELSE 0 END) as 'ITHM',

											SUM(CASE WHEN POSITION = 'Lead Verification Specialist' THEN 1 ELSE 0 END) as 'LVS',

											SUM(CASE WHEN POSITION = 'Customer Service Representative - English' THEN 1 ELSE 0 END) as 'CSRenglish',

											SUM(CASE WHEN POSITION = 'Customer Service Representative - Mandarin' THEN 1 ELSE 0 END) as 'CSRmandarin',

											SUM(CASE WHEN POSITION = 'Finance Manager' THEN 1 ELSE 0 END) as 'FM',

											SUM(CASE WHEN POSITION = 'Others' THEN 1 ELSE 0 END) as 'others'

						

										FROM 

    										tbl_application

    									WHERE

    										timestamp BETWEEN '$startDate' AND '$endDate'

    										";

										

   										$result = $conn->query($positionsql2);

										$row = $result->fetch_assoc();

									

										echo "

											<tr><td>Human Resource</td>

											<td>".$row['HR']."</td></tr>

											<tr><td>Marketing Manager</td>

											<td>".$row['MM']."</td></tr>

											<tr><td>IT Helpdesk Team Lead</td>

											<td>".$row['ITlead']."</td></tr>

											<tr><td>Web Developer</td>

											<td>".$row['webdev']."</td></tr>

											<tr><td>Customer Service Representative</td>

											<td>".$row['CSR']."</td></tr>

											<tr><td>Content Writer</td>

											<td>".$row['CW']."</td></tr>

											<tr><td>Accountant</td>

											<td>".$row['accountant']."</td></tr>

											<tr><td>Business Development Manager</td>

											<td>".$row['BDM']."</td></tr>

											<tr><td>Telesales Agent</td>

											<td>".$row['TA']."</td></tr>

											<tr><td>Software Developer</td>

											<td>".$row['sofdev']."</td></tr>

											<tr><td>IT Helpdesk</td>

											<td>".$row['IThelp']."</td></tr>

											<tr><td>Outbound Sales Representative</td>

											<td>".$row['OSR']."</td></tr>

											<tr><td>Senior .NET Developer</td>

											<td>".$row['SND']."</td></tr>

											<tr><td>IT Manager</td>

											<td>".$row['ITmanager']."</td></tr>

											<tr><td>Project Manager</td>

											<td>".$row['PM']."</td></tr>

											<tr><td>Senior Software Developer</td>

											<td>".$row['SSD']."</td></tr>

											<tr><td>.NET Developer</td>

											<td>".$row['NETdev']."</td></tr>

											<tr><td>Contract Centre Agent</td>

											<td>".$row['CCA']."</td></tr>

											<tr><td>Intern</td>

											<td>".$row['intern']."</td></tr>

											<tr><td>Finance Officer</td>

											<td>".$row['FO']."</td></tr>

											<tr><td>Admin Assistant</td>

											<td>".$row['AA']."</td></tr>

											<tr><td>Front End Web and HTML Designer</td>

											<td>".$row['frontWeb']."</td></tr>

											<tr><td>Various Position</td>

											<td>".$row['VP']."</td></tr>

											<tr><td>Reports Analyst</td>

											<td>".$row['RA']."</td></tr>

											<tr><td>HR Manager</td>

											<td>".$row['HRmanager']."</td></tr>

											<tr><td>IT Admin</td>

											<td>".$row['ITadmin']."</td></tr>

											<tr><td>IT Telesales Lead</td>

											<td>".$row['ITtelesales']."</td></tr>

											<tr><td>IT Helpdesk Manager</td>

											<td>".$row['ITHM']."</td></tr>

											<tr><td>Lead Verification Specialist</td>

											<td>".$row['LVS']."</td></tr>

											<tr><td>Customer Service Representative - English</td>

											<td>".$row['CSRenglish']."</td></tr>

											<tr><td>Customer Service Representative - Mandarin</td>

											<td>".$row['CSRmandarin']."</td></tr>

											<tr><td>Finance Manager</td>

											<td>".$row['FM']."</td></tr>

											<tr><td>Others</td>

											<td>".$row['others']."</td></tr>

											

											";

	}

	

	

	if(isset($_POST['gender'])){

		

		$startDate = $_POST['dateStart'];

	$endDate = $_POST['dateEnd'];	



									

				$gerndersql1 = "SELECT  SUM(CASE WHEN UPPER(`Gender`) = 'MALE' THEN 1 ELSE 0 END) as 'maleGoogle', SUM(CASE WHEN `Gender` like 		'%FEMALE%' THEN 1 ELSE 0 END) as 'femaleGoogle'  ".$sql."  where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$result = $conn->query($gerndersql1);

				$row = $result->fetch_assoc();

				echo $row['maleGoogle'].",".$row["femaleGoogle"];			

	}

	

	if(isset($_POST['age'])){

		

		$startDate = $_POST['dateStart'];

		$endDate = $_POST['dateEnd'];					

			$agebracket1 = "SELECT SUM(CASE WHEN `Age` >= 17 AND `Age` < 26 THEN 1 ELSE 0 END) as '1st', SUM(CASE WHEN `Age` > 25 AND `Age` < 31 THEN 1 ELSE 0 END) as '2nd', SUM(CASE WHEN `Age` > 30 AND `Age` < 36 THEN 1 ELSE 0 END) as '3rd', SUM(CASE WHEN `Age` > 35 AND `Age` <= 42 THEN 1 ELSE 0 END) as '4th', SUM(CASE WHEN `Age` > 42 AND `Age` <= 50 THEN 1 ELSE 0 END) as '5th', SUM(CASE WHEN `Age` > 50 THEN 1 ELSE 0 END) as '6th'  ".$sql." where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$result = $conn->query($agebracket1);

				$row = $result->fetch_assoc();

				echo $row['1st'].",".$row['2nd'].",".$row['3rd'].",".$row['4th'].",".$row['5th'].",".$row['6th'];

						

	}
	if((isset($_POST['statusNew']))&&(isset($_POST['statusSched']))&&(isset($_POST['statusAccepted']))&&(isset($_POST['statusComment']))){
		$startDate = $_POST['dateStart'];

		$endDate = $_POST['dateEnd'];		



			$statusNew = "SELECT SUM(CASE WHEN `Status` = 'Pending' THEN 1 ELSE 0 END) as '1st'".$sql." where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$resultNew = $conn->query($statusNew);

				$row = $resultNew->fetch_assoc();

				echo $row['1st'];
			$statusSched = "SELECT SUM(CASE WHEN `Status` = 'No Show' THEN 1 ELSE 0 END) as '2nd'".$sql." where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$resultSched = $conn->query($statusSched);

				$row = $resultSched->fetch_assoc();

				echo $row['2nd'];
			$statusAccepted = "SELECT SUM(CASE WHEN `Status` = 'Interview' THEN 1 ELSE 0 END) as '3rd'".$sql." where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$resultAccepted = $conn->query($statusAccepted);

				$row = $resultAccepted->fetch_assoc();

				echo $row['3rd'];
			$statusComment = "SELECT SUM(CASE WHEN `Status` = 'Pending' THEN 1 ELSE 0 END) as '4th'".$sql." where  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."'";

				$resultComment = $conn->query($statusComment);

				$row = $resultComment->fetch_assoc();

				echo $row['4th'];
				

						

	}

?>