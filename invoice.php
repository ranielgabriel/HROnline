<?php
	require ('fpdf181/fpdf.php');
	include('connect.php');
	include('auth.php');//for authenticated user's only
	$id = $_GET['id'];
	$query = mysqli_query($conn, "SELECT * from tbl_application where id = '$id'");
	while($data=mysqli_fetch_array($query)){
	
	if (((!empty($data['GRAD_Name of school'])) || (!empty($data['SPOUSE\'S NAME']))){
	$pdf = new FPDF();
	$pdf->addPage();
	//set font
	$pdf->SetFont('Arial','',20);
	
	//cell
	
	$pdf->Cell(0, 5, 'Application Form',0,0,"C");
	$pdf->Cell(59, 5, '',0,1);//end of line
	$pdf->Cell(130, 5, '',0,0);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	//setfont to arial 12
	
	
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(130, 5,$data['NAME'],0,0,"L");
	$pdf->Cell(59, 5, '',0,1);//end of line
	$pdf->Cell(130, 5, '',0,0);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	$pdf->SetFont('Arial','I',11);
	$pdf->Cell(35, 5, 'Application Date:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['Timestamp'],0,1);
	$pdf->Cell(59, 5, '',0,1);
	//end of line
	
	//position
	$pdf->Cell(35, 5, 'Position Applying for:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(55, 5, $data['POSITION'],0,1);//end of line
	$pdf->SetFont('Arial','I',9);
	$pdf->Cell(59, 5, '',0,1);
	//date of employment
	
	//shifting schedule
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(73, 5, 'Are you Amenable for Shifting Schedule?',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(21, 5, $data['SHIFTING_SCHEDULE'],0,0);
	$pdf->Cell(50, 5, 'Available Date for employment:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['EMPLOYMENT_DATE'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//expected salary
	
	//work on holidays/weekends
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(73, 5, 'Are you willing to work on weekends/holiday? ',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(21, 5, $data['WEEKENDS_HOLIDAYS'],0,0);//end of line
	$pdf->SetFont('Arial','I',11);
	$pdf->Cell(30, 5, 'Expected Salary:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['SALARY'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	//personal information
	
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'PERSONAL INFORMATION',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	//nickname
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(20, 5, 'Nickname:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65, 5, $data['NICKNAME'],0,0);//end of line
	//status
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Civil Status:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['CIVIL STATUS'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//nickname
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(20, 5, 'Birth Date:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65, 5, $data['DATE OF BIRTH'],0,0);//end of line
	//status
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Age:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['AGE'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//nickname
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Place of Birth:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['PLACE OF BIRTH'],0,0);//end of line
	//status
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Gender:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['GENDER'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//nickname
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Blood Type:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['BLOODTYPE'],0,0);//end of line
	//status
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Religion:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['RELIGION'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//nickname
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Height:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['HEIGHT'],0,0);//end of line
	//status
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Weight:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['WEIGHT'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	//current address
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Current Address:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['CURRENT ADDRESS'],0,0);//end of line
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);
	
	//provincial address
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Provincial Address:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['PROVINCIAL_ADDRESS'],0,0);//end of line
	$pdf->Cell(59, 5, '',0,1);
	
	//CONTACT INFORMATION
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'CONTACT INFORMATION',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	//MOBILE NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(20, 5, 'Mobile No.:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65, 5, $data['MOBILE_NUMBER'],0,0);//end of line
	//HOME TEL NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Home Tel Number:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['HOME_TELNUM'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//OPTIONALNUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(20, 5, 'Optional Mob. #:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(65, 5, $data['MOBILE_NUMBER2'],0,0);//end of line
	//OPTIONAL NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Optional Mob. #:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['MOBILE_NUMBER3'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//EMAIL ADDRESS
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Email Address:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['EMAIL ADDRESS'],0,0);//end of line
	//SKYPE
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Skype:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['SKYPE_USERID'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//FB ACCNT
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Facebook:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['FB_Account'],0,0);//end of line
	//TWITTER ACCNT
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Twitter:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['Twitter_Account'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//CONTACT PERSON
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Contact Person:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['CONTACT NAME'],0,0);//end of line
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Contact Detail:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['CONTACT DETAILS'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	//FAMILY BACKGROUND
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'FAMILY BACKGROUND',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	
				
					$pdf->SetFont('Arial','I',10);
					$pdf->Cell(25, 5, 'Spouse Name:',0,0);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(60, 5, $data['SPOUSE\'S NAME'],0,0);//end of line
					//CONTACT PERSON'S NUMBER
					$pdf->SetFont('Arial','I',10);
					$pdf->Cell(30, 5, 'Occupation:',0,0);
					$pdf->SetFont('Arial','',10);
					$pdf->Cell(10, 5, $data['SPOUSE\'S OCCUPATION'],0,1);
					$pdf->Cell(59, 5, '',0,1);//end of line;
	
			
	//CONTACT PERSON
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, "Father's Name:",0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['FATHER\'S NAME'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Place of Birth:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['FATHER PLACEBIRTH'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, "Mother's Name:",0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['MOTHER\'S MAIDEN NAME'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Place of Birth:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['MOTHER PLACEBIRTH'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	$selectSiblings = mysqli_query($conn, "Select * from tbl_siblings where `ID` = '$id'");
	while($siblings=mysqli_fetch_array($selectSiblings)){
	if (!empty($siblings['SIBLING_NAME'])) {
			 //nickname
			echo	$pdf->SetFont('Arial','I',10);
			echo	$pdf->Cell(30, 5, "Sibling's Name:",0,0);
			echo	$pdf->SetFont('Arial','',10);
			echo	$pdf->Cell(65, 5, $siblings['SIBLING_NAME'],0,0);//end of line
				//status
			echo	$pdf->SetFont('Arial','I',10);
			echo	$pdf->Cell(30, 5, 'Age:',0,0);
			echo	$pdf->SetFont('Arial','',10);
			echo	$pdf->Cell(10, 5, $siblings['SIBLING_AGE'],0,1);
			echo	$pdf->Cell(59, 5, '',0,1);//end of line;
		}
	}
		
	//EDUCATIONAL BACKGROUND
	$pdf->Cell(59, 5, '',0,1);

	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'EDUCATIONAL BACKGROUND',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'PRIMARY',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
		//ELEM School NAME
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Name of School:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['ELEM_Name of School'],0,0);//end of line
	
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Scholarship:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(35, 5, $data['ELEM_Scholarship/ Academic Honors Received'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line

	//DATE
	$explodeElemDates = explode("-", $data['ELEM_Inclusive Dates of Attendance']);
	if (!empty($explodeElemDates[1])) {
			$ElemDates = $explodeElemDates[1];
		}
		else{
			$ElemDates = "";
		}
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'From:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30, 5, $explodeElemDates,0,0);//end of line
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'To:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $ElemDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//HIGH School NAME
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'SECONDARY',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Name of School:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['HS_Name of School'],0,0);//end of line
	
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25	, 5, 'Scholarship:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['HS_Scholarship/ Academic Honors Received'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line

	//DATE
	$explodeHSDates = explode("-", $data['HS_Inclusive Dates of Attendance']);
	if (!empty($explodeHSDates[1])) {
			$HSDates = $explodeHSDates[1];
		}
		else{
			$HSDates = "";
		}
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'From:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30, 5, $explodeHSDates[0],0,0);//end of line
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'To:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $HSDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//HIGH School NAME
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'TERTIARY',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Name of School:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['COL_Name of School'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(20, 5, 'Course:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['COL_Degree Course'],0,0);//end of line
	
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25	, 5, 'Scholarship:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['COL_Scholarship/ Academic Honors Received'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line

	//DATE
	$explodeColDates = explode("-", $data['COL_Inclusive Dates of Attendance']);
	if (!empty($explodeColDates[1])) {
			$ColDates = $explodeColDates[1];
		}
		else{
			$ColDates = "";
		}
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'From:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30, 5, $explodeColDates[0],0,0);//end of line
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'To:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $ColDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//GRAD School
	echo	$pdf->Cell(35, 5, 'Name of School:',0,0);
	echo	$pdf->SetFont('Arial','',10);
	echo	$pdf->Cell(75, 5, $data['GRAD_Name of School'],0,1);//end of line
	echo	$pdf->Cell(59, 5, '',0,1);
	echo	$pdf->SetFont('Arial','I',10);
	echo	$pdf->Cell(35, 5, 'Course:',0,0);
	echo	$pdf->SetFont('Arial','',10);
	echo	$pdf->Cell(75, 5, $data['GRAD_Degree Course'],0,0);//end of line
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(25	, 5, 'Scholarship:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['GRAD_Scholarship'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	$explodeGradDates = explode("-", $data['GRAD_Inclusive Dates of Attendance']);
	if (!empty($explodeGradDates[1])){
			$GradDates = $explodeGradDates[1];
		}
		else{
			$GradDates = "";
		}
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'From:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30, 5, $explodeGradDates[0],0,0);//end of line
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'To:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $GradDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	//WORK EXPERIENCE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'WORK EXPERIENCE',0,1,"L");//END OF LINE
	$counter = 1;
	while($counter < 6){
			if(!empty($data[$counter.'. Inclusive Dates'])){
			$explodeSupervisor = explode("/", $data[$counter.'.3 Name_Position and Contact No. of Immediate Supervisor']);
			$explodeDates = explode("-", $data[$counter.'. Inclusive Dates']);
			$explodeCompany = explode("/", $data[$counter.'.1 Employer\'s Name, Address and Phone']);
				if (!empty($explodeSupervisor[2])) {
					$supervisorContact = $explodeSupervisor[2];
				}
				else{
					$supervisorContact = "";
				}
				if (!empty($explodeDates[1])) {
					$CompanyDate = $explodeDates[1];
				}
				else{
					$CompanyDate = "";
				}
				echo	$pdf->Cell(59, 5, '',0,1);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(35, 5, $counter,0,1);
				echo	$pdf->Cell(35, 5, 'Position Title:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $data[$counter.".2 Position Title"],0,1);//end of line
				echo	$pdf->Cell(59, 5, '',0,1);
				echo	$pdf->Cell(35, 5, 'Company Name:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $explodeCompany[0],0,1);
				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','I',10);
				$pdf->Cell(10, 5, 'From:',0,0);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(30, 5, $explodeDates[0],0,0);//end of line
				//CONTACT PERSON'S NUMBER
				$pdf->SetFont('Arial','I',10);
				$pdf->Cell(10, 5, 'To:',0,0);
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(10, 5, $explodeDates[1],0,1);
				$pdf->Cell(59, 5, '',0,1);//end of line
				echo	$pdf->Cell(35, 5, 'Monthly Salary:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $data[$counter.'.4 Monthly Salary'],0,1);
				$pdf->Cell(59, 5, '',0,1);
				echo	$pdf->Cell(35, 5, 'Name of Supervisor:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $explodeSupervisor[0],0,0);
				
				echo	$pdf->Cell(35, 5, 'Contact No.:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $supervisorContact,0,1);
				$pdf->Cell(59, 5, '',0,1);
				echo	$pdf->Cell(35, 5, 'Reason of Leaving:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $data[$counter.'.5 Reason for Leaving'],0,1);
				$pdf->Cell(59, 5, '',0,1);
				
							
			}
			$counter++;
		}
	
				 
		//Professional Qualifications
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'PROFESSIONAL QUALIFICATIONS',0,1,"L");//END OF LINE	
				
		
	/*	$profCounter = 1;
			$profnumber = 1;

			while ($profCounter < 4) {
				if (!empty($data['PROF_License'.$profCounter])) {
					echo 
					$pdf->Cell(59, 5, '',0,1);
				echo	$pdf->Cell(35, 5, 'Liscense Certification:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $data['PROF_License'.$profCounter],0,0);
				
				echo	$pdf->Cell(35, 5, 'Liscense Number:',0,0);
				echo	$pdf->SetFont('Arial','',10);
				echo	$pdf->Cell(75, 5, $data['PROF_Licensennum'.$profCounter],0,1);
					
				}
			$profCounter++;
			$profnumber++;
			}*/


	
	
	$pdf->Output();
	
	
	}
	}

?>