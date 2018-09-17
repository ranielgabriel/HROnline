<?php
	require ('fpdf181/fpdf.php');
	include ('connect.php');
	

	
class PDF extends FPDF{
	
	function header(){
		$today = date("F j, Y"); 
		 $this->SetFont('Arial','I',8);
		 $this->Cell(0,0,$today,0,0,"R");
	
		$this->Cell(12);
		$this->Image('aa.png', 70,10,70);
		$this->Cell(12);
		$this->Cell(59, 5, '',0,1);//end of line
		$this->Cell(59, 5, '',0,1);//end of line
		
		$this->Cell(59, 5, '',0,1);//end of line
		
	}
	function Footer()
{
	
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,0,'Page '.$this->PageNo(),0,0,"C");
	//$this->Cell(0,0,$today,0,1);
}
	
}
	$id = $_GET['id'];
	$selectID = "SELECT *
	FROM tbl_application 
	WHERE tbl_application.ID = '$id'";

	$resultSelect = $conn->query($selectID);
	while($data = mysqli_fetch_array($resultSelect)){
	//$app_date = date("F d, Y", strtotime($data['Timestamp']);
		
		$pdf = new PDF();
		$pdf->AddPage();

		$pdf->SetFont('Arial','B',16);
		$pdf->SetTitle('Application Form');

		$pdf->Cell(0, 5, 'Application Form', 0, 1, 'C');
		$pdf->Cell(59, 5, '',0,1);//end of line
		$pdf->Line( 10, 45, 200, 45);
		
		
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(130, 5,$data['NAME'],0,0,"L");
	

	
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Application Date:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5,date("F d, Y", strtotime($data["Timestamp"])),0,1);
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);
	//end of line
	
	
	//position
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(40, 5, 'Position Applying for:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(55, 5, $data['POSITION'],0,1);//end of line
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(59, 5, '',0,1);
	//date of employment

	
	
	//shifting schedule
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(85, 5, 'Are you Amenable for Shifting Schedule?',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(12, 5, $data['SHIFTING_SCHEDULE'],0,0);

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(55, 5, 'Available Date for employment:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['EMPLOYMENT_DATE'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(85, 5, 'Are you Amenable for Contractual Employment?',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(12, 5, $data['CONTRACTUAL_EMPLOYMENT'],0,0);

	
	//expected salary
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Expected Salary:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['SALARY'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	
	//work on holidays/weekends
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(85, 5, 'Are you willing to work on Weekends/ Holidays? ',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(12, 5, $data['WEEKENDS_HOLIDAYS'],0,0);//end of line
	$pdf->Cell(59, 5, '',0,1);
	
	
	//personal information
	
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Personal Information',0,1,"L", TRUE);//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	//nickname
	/* $pdf->SetFont('Arial','B',10);
	$pdf->Cell(20, 5, 'Nickname:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(65, 5, $data['NICKNAME'],0,0);//end of line */
	//status
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25, 5, 'Civil Status:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['CIVIL STATUS'],0,0);
	//GENDER
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(18, 5, 'Gender:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['GENDER'],0,1);
	$pdf->Cell(65, 5, '',0,1);//end of line
	//RELIGION
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25, 5, 'Religion:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['RELIGION'],0,0);	
	//APPLICATION_SOURCE
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(18, 5, 'Source:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['APPLICATION_SOURCE'],0,1);//end of line 
	$pdf->Cell(65, 5, '',0,1);//end of line
	//BLOOD TYPE
	/* $pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Blood Type:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['BLOODTYPE'],0,0);//end of line */
	//BIRTHDAY
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25, 5, 'Birth Date:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['DATE OF BIRTH'],0,0);//end of line
	//AGE
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(18, 5, 'Age:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['AGE'],0,1);
	$pdf->Cell(65, 5, '',0,1);//end of line
	//PLACE OF BIRTH
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Place of Birth:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['PLACE OF BIRTH'],0,1);//end of line
	$pdf->Cell(65, 5, '',0,1);//end of line
	//HEIGHT
	/* $pdf->SetFont('Arial','I',10);
	$pdf->Cell(25, 5, 'Height:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60, 5, $data['HEIGHT'],0,0);//end of line
	//WEIGHT
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(30, 5, 'Weight:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $data['WEIGHT'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line */
	
	//current address
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Current Address:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['CURRENT ADDRESS'],0,0);//end of line
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);
	
	//provincial address
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Provincial Address:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['PROVINCIAL_ADDRESS'],0,0);//end of line
	$pdf->Cell(59, 5, '',0,1);
	
	//CONTACT INFORMATION
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Contact Information',0,1,"L", true);//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	//MOBILE NUMBER
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Mobile No.:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(55, 5, $data['MOBILE_NUMBER'],0,0);//end of line
	//HOME TEL NUMBER
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Home Tel Number:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['HOME_TELNUM'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//OPTIONALNUMBER
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Optional Mob. #:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(55, 5, $data['MOBILE_NUMBER2'],0,0);//end of line
	//OPTIONAL NUMBER
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Optional Mob. #:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['MOBILE_NUMBER3'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//EMAIL ADDRESS
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Email Address:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(55, 5, $data['EMAIL ADDRESS'],0,0);//end of line
	//SKYPE
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Skype:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['SKYPE_USERID'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//FB ACCNT
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Facebook:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(55, 5, $data['FB_Account'],0,0);//end of line
	//TWITTER ACCNT
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Twitter:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['Twitter_Account'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//CONTACT PERSON
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Contact Person:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(55, 5, $data['CONTACT NAME'],0,0);//end of line
	//CONTACT PERSON'S NUMBER
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35, 5, 'Contact Detail:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['CONTACT DETAILS'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	
	
	//SIBLINGS
	$selectSiblings = mysqli_query($conn, "Select * from tbl_siblings where `ID` = '$id'");
	while($siblings=mysqli_fetch_array($selectSiblings)){
	if (!empty($siblings['SIBLING_NAME'])) {
			 //SIBLING'S NAME
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(30, 5, "Sibling's Name:",0,0);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(55, 5, $siblings['SIBLING_NAME'],0,0);//end of line
				//SIBLING'S AGE
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(35, 5, 'Age:',0,0);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(10, 5, $siblings['SIBLING_AGE'],0,1);
			$pdf->Cell(59, 5, '',0,1);//end of line;
		}else{
			$pdf->Cell(59, 5, '',0,1);//end of line;
		}
	}
	//DEPENDENTS
	$selectChild = mysqli_query($conn, "Select * from tbl_child where `ID` = '$id'");
	while($child=mysqli_fetch_array($selectChild)){
	if (!empty($child['CHILD_NAME'])) {
			 //DEPENDENT'S NAME
			$pdf->SetFont('Arial','I',10);
			$pdf->Cell(35, 5, "Dependent's Name:",0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(65, 5, $child['CHILD_NAME'],0,0);//end of line
				//DEPENDENT'S AGE
			$pdf->SetFont('Arial','I',10);
			$pdf->Cell(30, 5, 'Age:',0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10, 5, $child['CHILD_AGE'],0,1);
			$pdf->Cell(59, 5, '',0,1);//end of line;
		}else{
			$pdf->Cell(59, 5, '',0,1);//end of line;
		}
		
	}
	
	//EDUCATIONAL BACKGROUND
	$pdf->Cell(59, 5, '',0,1);
	$pdf->Cell(59, 5, '',0,1);

	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Educational Background',0,1,"L", true);//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	/* $pdf->SetFont('Arial','I',12);
	$pdf->Cell(10, 5, 'Primary',0,1,"L");//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
		//ELEM School NAME
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Name of School:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['ELEM_Name of School'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
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
		//FROM
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'From:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30, 5, $explodeElemDates[0],0,0);//end of line
	//TO
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'To:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $ElemDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line */
	//HIGH School NAME
	//SECONDARY
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(85, 5, 'Secondary',0,0,"L");
	//TERTIARY
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10, 5, 'Tertiary',0,1,"L");
	$pdf->Cell(59, 5, '',0,1);//END OF LINE
	// SECONDARY SCHOOL NAME
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15, 5, 'School:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(70, 5, $data['HS_Name of School'],0,0);
	// COLLEGE SCHOOL NAME
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15, 5, 'School:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(75, 5, $data['COL_Name of School'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	// SECONDARY SCHOLARSHIP
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(23, 5, 'Scholarship:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(62, 5, $data['HS_Scholarship/ Academic Honors Received'],0,0);
	// COLLEGE SCHOLARSHIP
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(23, 5, 'Scholarship:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['COL_Scholarship/ Academic Honors Received'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line

	//DATE
	$explodeHSDates = explode("-", $data['HS_Inclusive Dates of Attendance']);
	if (!empty($explodeHSDates[1])) {
			$HSDates = $explodeHSDates[1];
		}
		else{
			$HSDates = "";
		}
		//FROM
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12, 5, 'From:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(18, 5, $explodeHSDates[0],0,0);//end of line
	//TO
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7, 5, 'To:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(48, 5, $HSDates,0,0);

	//DATE
	$explodeColDates = explode("-", $data['COL_Inclusive Dates of Attendance']);
	if (!empty($explodeColDates[1])) {
			$ColDates = $explodeColDates[1];
		}
		else{
			$ColDates = "";
		}
		//FROM
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(12, 5, 'From:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(18, 5, $explodeColDates[0],0,0);//end of line
	//TO
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(7, 5, 'To:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $ColDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	
	// COLLEGE COURSE
	$pdf->Cell(85,5,'',0,0);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15, 5, 'Course:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(75, 5, $data['COL_Degree Course'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);

	//GRADUATE SCHOOL
	if (!empty($data['GRAD_Name of school'])){
		
	$pdf->Cell(35, 5, 'Name of School:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['GRAD_Name of School'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(35, 5, 'Course:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(75, 5, $data['GRAD_Degree Course'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
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
		//FROM
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'From:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30, 5, $explodeGradDates[0],0,0);//end of line
	//TO
	$pdf->SetFont('Arial','I',10);
	$pdf->Cell(10, 5, 'To:',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10, 5, $GradDates,0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	}else{
		$pdf->Cell(59, 5, '',0,1);//end of line
	}
	if ($data['POSITION'] == 'Intern'){

	} else {
		//WORK EXPERIENCE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Work Experience',0,1,"L", true);//END OF LINE
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
				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(4, 5, $counter.")",0,0);

				$pdf->Cell(33, 5, 'Position Title:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $data[$counter.".2 Position Title"],0,1);//end of line

				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(37, 5, 'Company Name:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $explodeCompany[0],0,1);

				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(12, 5, 'From:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(20, 5, $explodeDates[0],0,0);//end of line
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(8, 5, 'To:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(10, 5, $explodeDates[1],0,1);

				$pdf->Cell(59, 5, '',0,1);//end of line
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(37, 5, 'Monthly Salary:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $data[$counter.'.4 Monthly Salary'],0,1);

				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(37, 5, 'Name of Supervisor:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $explodeSupervisor[0],0,1);

				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(37, 5, 'Contact No.:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $supervisorContact,0,1);

				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(37, 5, 'Reason of Leaving:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $data[$counter.'.5 Reason for Leaving'],0,1);
				$pdf->Cell(59, 5, '',0,1);
						
			}
			$counter++;
			
			
		}
	}
	
	
	$profCounter = 1;
	$profnumber = 1;

			while ($profCounter < 4) {
				if (!empty($data['PROF_License'.$profCounter])) {
				//Professional Qualifications
				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','BI',12);
				$pdf->SetFillColor(255, 187, 80);
				$pdf->Cell(190, 5, 'Professional Qualifications',0,1,"L", true);//END OF LINE	
				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(40, 5, 'Liscense Certification:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $data['PROF_License'.$profCounter],0,1);
				$pdf->Cell(59, 5, '',0,1);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(40, 5, 'Liscense Number:',0,0);
				$pdf->SetFont('Arial','U',10);
				$pdf->Cell(75, 5, $data['PROF_Licensennum'.$profCounter],0,1);
					
				}
			$profCounter++;
			$profnumber++;
			}
			
	//LANGUAGE PROFICIENCY
	$languageArray = "SELECT *
	FROM tbl_languages
	WHERE ID = '$id'";

	$languageSelect = $conn->query($languageArray);
	$languagesOfApplicant = mysqli_fetch_array($languageSelect);
	if(!empty($languagesOfApplicant['ONE_LANGUAGE'])){
		$pdf->Cell(59, 5, '',0,1);
		$pdf->SetFont('Arial','BI',12);
		$pdf->SetFillColor(255, 187, 80);
		$pdf->Cell(190, 5, 'Language Proficiency',0,1,"L", true);//END OF LINE	
		$languages = array();	
		$stringCounter = ['ONE_','TWO_','THREE_','FOUR_','FIVE_'];
		foreach ($stringCounter as $counter) {		
			$languages[$counter . 'LANGUAGE'] = $languagesOfApplicant[$counter . 'LANGUAGE'];		
			$languages[$counter . 'READ'] = $languagesOfApplicant[$counter . 'READ'];		
			$languages[$counter . 'WRITE'] = $languagesOfApplicant[$counter . 'WRITE'];		
			$languages[$counter . 'SPEAK'] = $languagesOfApplicant[$counter . 'SPEAK'];		
			if (!empty($languages[$counter . 'LANGUAGE'])) {			
				$pdf->Cell(59, 5, '',0,1);		
				$pdf->SetFont('Arial','B',10);		
				$pdf->Cell(20, 5, 'Language:',0,0);			
				$pdf->SetFont('Arial','U',10);			
				$pdf->Cell(75, 5, $languages[$counter . 'LANGUAGE'] ,0,1);							
				$pdf->SetFont('Arial','B',10);					
				$pdf->Cell(20, 5, 'Speak:',0,0);			
				$pdf->SetFont('Arial','U',10);			
				$pdf->Cell(75, 5, $languages[$counter . 'SPEAK'],0,1);						
				$pdf->SetFont('Arial','B',10);		
				$pdf->Cell(20, 5, 'Read:',0,0);			
				$pdf->SetFont('Arial','U',10);			
				$pdf->Cell(75, 5, $languages[$counter . 'READ'],0,0);			
				$pdf->Cell(59, 5, '',0,1);		
				$pdf->SetFont('Arial','B',10);		
				$pdf->Cell(20, 5, 'Write:',0,0);			
				$pdf->SetFont('Arial','U',10);			
				$pdf->Cell(75, 5, $languages[$counter . 'WRITE'],0,1);	
				}	
			}
	}
	
	
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Other Information',0,1,"L", true);//END OF LINE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(45, 5, 'Last Physical Check-up:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(30, 5, $data['Physical Checkup'],0,0);//end of line
	$pdf->Cell(59, 5, '',0,1);
	
	//CHARACTER REFERENCE
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Character Reference',0,1,"L", true);//END OF LINE
	$referenceCounter = "";

			while ($referenceCounter < 4) {
				if (!empty($data['REF_Name'.$referenceCounter])) {
					echo 
					$pdf->Cell(59, 5, '',0,1);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(30, 5, 'Name:',0,0);
					$pdf->SetFont('Arial','U',10);
					$pdf->Cell(30, 5, utf8_decode($data['REF_Name'.$referenceCounter]),0,0);//end of line
					$pdf->Cell(59, 5, '',0,1);
					$pdf->Cell(59, 5, '',0,1);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(30, 5, 'Company Name:',0,0);
					$pdf->SetFont('Arial','U',10);
					$pdf->Cell(75, 5, utf8_decode($data['REF_Address'.$referenceCounter]),0,1);
					$pdf->Cell(59, 5, '',0,1);
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell(30, 5, 'Contact Number:',0,0);
					$pdf->SetFont('Arial','U',10);
					$pdf->Cell(75, 5, $data['REF_ContactNum'.$referenceCounter],0,1);
					$pdf->Cell(59, 5, '',0,1);
					
				}
			$referenceCounter++;
			}
	
	//FAMILY BACKGROUND
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Family Background',0,1,"L", true);//END OF LINE
	
	if ((!empty($data['SPOUSE\'S NAME']))){
	//SPOUSE'S NAME
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Spouse Name:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['SPOUSE\'S NAME'],0,0);//end of line
	//SPOUSE'S OCCUPATION
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Occupation:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['SPOUSE\'S OCCUPATION'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line;
	}else{
		$pdf->Cell(59, 5, '',0,1);//end of line;
	}
	
	//FATHER'S NAME
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, "Father's Name:",0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['FATHER\'S NAME'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	//FATHER'S PLACE OF BIRTH
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Place of Birth:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['FATHER PLACEBIRTH'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
	//MOTHER'S NAME
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, "Mother's Name:",0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(60, 5, $data['MOTHER\'S MAIDEN NAME'],0,1);//end of line
	$pdf->Cell(59, 5, '',0,1);
	//MOTHER'S PLACE OF BIRTH
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30, 5, 'Place of Birth:',0,0);
	$pdf->SetFont('Arial','U',10);
	$pdf->Cell(10, 5, $data['MOTHER PLACEBIRTH'],0,1);
	$pdf->Cell(59, 5, '',0,1);//end of line
			
	//ESSAY PART
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Essay',0,1,"L", true);//END OF LINE
	$pdf->Cell(59, 5, '',0,1);

	$selectEssay = "SELECT tbl_essay.Answer, tbl_question.Question FROM tbl_essay INNER JOIN tbl_question
	ON tbl_essay.Question_ID = tbl_question.Question_ID
	WHERE tbl_essay.APPLICANT_ID = '$id'";

	$questionCountSelect = "SELECT COUNT(*) AS QuestionCount FROM tbl_question";
	$resultQuestionCountSelect = $conn->query($questionCountSelect);
	$questionCount = mysqli_fetch_array($resultQuestionCountSelect);
	
	$resultEssay = $conn->query($selectEssay);
	$questionNumber = 1;
	$questions = array();

	while($essayAnswer = mysqli_fetch_array($resultEssay)){
		$questions[$questionNumber] = $essayAnswer['Question'];
		if($questionCount['QuestionCount'] >= $questionNumber){
			$pdf->Cell(59, 5, '',0,1);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(7, 5, $questionNumber.".",0,0);
			$pdf->Cell(30, 5, $essayAnswer['Question'],0,0);//end of line
			$pdf->Cell(59, 5, '',0,1);
			$pdf->Cell(59, 5, '',0,1);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(15, 5, 'Answer:',0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(175, 5, $essayAnswer['Answer'],0,1);
		}
		$questionNumber++;
	}

	//INTERVIEWER COMMENT
	$pdf->Cell(59, 5, '',0,1);
	$pdf->SetFont('Arial','BI',12);
	$pdf->SetFillColor(255, 187, 80);
	$pdf->Cell(190, 5, 'Interviewer\'s Comment',0,1,"L",true);//END OF LINE
	$pdf->Cell(59, 5, '',0,1);

	$commentsql =	
"

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Initial Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql);

		$row = $result->fetch_assoc();


		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(37, 5, "Initial Interviewer:",0,0);
		$pdf->SetFont('Arial','U',10);
		$pdf->Cell(60, 5, $row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"],0,1);//end of line
		$pdf->Cell(59, 5, '',0,1);
		//CONTACT PERSON'S NUMBER
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(37, 5, "Comments:",0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(150, 5, ($row['Comment']),0,1);
		$pdf->Cell(59, 5, '',0,1);

	$commentsql2 = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Second Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql2);

		$row = $result->fetch_assoc();


			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(37, 5, "Second Interviewer:",0,0);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(60, 5, $row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"],0,1);//end of line
			$pdf->Cell(59, 5, '',0,1);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(37, 5, "Comments:",0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(150, 5, ($row['Comment']),0,1);
			$pdf->Cell(59, 5, '',0,1);

	$commentsql3 = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Third Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql3);

		$row = $result->fetch_assoc();


			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(37, 5, "Third Interviewer:",0,0);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(60, 5, $row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"],0,1);//end of line
			$pdf->Cell(59, 5, '',0,1);
			
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(37, 5, "Comments:",0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(150, 5, ($row['Comment']),0,1);
			$pdf->Cell(59, 5, '',0,1);

	$commentsql4 = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Final Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql4);

		$row = $result->fetch_assoc();


			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(37, 5, "Final Interviewer:",0 ,0);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(60, 5, $row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"],0,1);//end of line
			$pdf->Cell(59, 5, '',0,1);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(37, 5, "Comments:",0,0);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(150, 5, ($row['Comment']),0,1);
			$pdf->Cell(59, 5, '',0,1);	
			
			
			
			
			
            $pdf->SetTextColor(47, 84, 150);	
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(35, 25, "                                                Authorization Letter",0,1);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',10);	
            $pdf->Cell(35, 5, "I have read the Privacy Policy and hereby authorize and give my consent for Anderson Group BPO, Inc. to collect, record,",0,1);
			$pdf->Cell(35, 10, "organize,update or modify, retrieve, consult, use, consolidate, block, erase or destruct my personal data as part of my" ,0,1);
			$pdf->Cell(35, 5, "information. I hereby affirm my right to be informed, object to processing, access and rectify, suspend or withdraw my",0,1);
			$pdf->Cell(35, 10, "personal data, and be indemnified in case of damages pursuant to the provisions of the Republic Act No. 10173 of the",0,1);
			$pdf->Cell(35, 5, "Philippines,  Data Privacy Act of 2012 and Regulation (EU) 2016/679, General Data Protection Regulation, whichever is",0,1);
			$pdf->Cell(35, 10, "applicable, and its corresponding implementing rules and regulations.",0,1);
				    
		
		$pdf->Output();

	}



?>