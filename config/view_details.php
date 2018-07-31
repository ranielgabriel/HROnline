<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ))
{
    // ALLOWED
	include('connect.php');
	
	$member_id = $_POST['member_id'];

	$sql = "SELECT AI.*, CI.*, EI.*, WI.*, AP.* 
	FROM tbl_application_info AS AI INNER JOIN  
		 tbl_contact_info AS CI INNER JOIN 
		 tbl_education_info AS EI INNER JOIN 
		 tbl_work_info AS WI INNER JOIN 
		 tbl_application  AS AP 
		 WHERE AI.reference_code = CI.reference_no 
		 AND AI.reference_code = EI.reference_no 
		 AND AI.reference_code = WI.reference_code 
		 AND AI.reference_code = AP.REFERENCE_NO 
		 AND AI.reference_code = '".$member_id."'";

	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$fullname = $row['last_name'].", ".$row['first_name']." ".$row['extension_name']." ".$row['middle_name'];
		$sex = $row['gender'];
		$dob = $row['dob'];
		$pob = $row['pob'];
		$cstat = $row['civil_status'];
		$cs = $row['citizenship'];
		$cur_add = $row['current_address'];
		$prov_add = $row['provincial_address'];
		
		$em = $row['email_address'];
		$skype = $row['skype_id'];
		$facebook = $row['facebook_acct'];
		$twitter = $row['twitter_acct'];
		$home_contact = $row['home_tel'];
		$mobile_contact = $row['mobile_no'];
		$contact_person = $row['contact_person'];
		$contact_details = $row['contact_no'];

		$sch1 = $row['primary_school'];
		$dtcover1 = $row['date_cover1'];
		$awards1 = $row['awards1'];
		$sch2 = $row['secondary_school'];
		$dtcover2 = $row['date_cover2'];
		$awards2 = $row['awards2'];
		$sch3 = $row['tertiary_school'];
		$dtcover3 = $row['date_cover3'];
		$degree = $row['degree_course'];
		// $awards3 = $row['awards3'];

		$data = array('name' => $fullname,
					  'gender' => $sex,
					  'dob' => $dob,
					  'pob' => $pob,
					  'civil_status' => $cstat,
					  'citizenship' => $cs,
					  'current_address' => $cur_add,
					  'provincial_address' => $prov_add,
					  'mail' => $em,
					  'skype' => $skype,
					  'facebook' => $facebook,
					  'twitter' => $twitter,
					  'home_contact' => $home_contact,
					  'mobile_contact' => $mobile_contact,
					  'contact_person' => $contact_person,
					  'contact_details' => $contact_details,
					  'primary' => $sch1,
					  'p_date' => $dtcover1,
					  'p_award' => $awards1,
					  'secondary' => $sch2,
					  's_date' => $dtcover2,
					  's_award' => $awards2,
					  'tertiary' => $sch3,
					  't_date' => $dtcover3,
					  't_degree' => $degree,
					  'inclusivDate1' => $row['inclusive_date1'],
					  'company_name1' => $row['company_name1'],
					  'company_address1' => $row['company_address1'],
					  'contact_no1' => $row['contact_no1'],
					  'position_title1' => $row['position_title1'],
			          'supervisor_name1' => $row['supervisor_name1'],
			          'salary1' => $row['salary1'],
			          'reason_leaving1' => $row['reason_leaving1'],
			          'inclusivDate2' => $row['inclusive_date2'],
			          'company_name2' => $row['company_name2'],
			          'company_address2' => $row['company_address2'],	
			          'contact_no2' => $row['contact_no2'],
			          'position_title2' => $row['position_title2'],
			          'supervisor_name2' => $row['supervisor_name2'],
			          'salary2' => $row['salary2'],
			          'reason_leaving2' => $row['reason_leaving2'],
			          'inclusivDate3' => $row['inclusive_date3'],
			          'company_name3' => $row['company_name3'],
			          'company_address3' => $row['company_address3'],
			          'contact_no3' => $row['contact_no3'],
			          'position_title3' => $row['position_title3'],
			          'supervisor_name3' => $row['supervisor_name3'],
			          'salary3' => $row['salary3'],
			          'reason_leaving3' => $row['reason_leaving3'],
			          'inclusivDate4' => $row['inclusive_date4'],
			          'company_name4' => $row['company_name4'],
			          'company_address4' => $row['company_address4'],
			          'contact_no4' => $row['contact_no4'],
			          'position_title4' => $row['position_title4'],
			          'supervisor_name4' => $row['supervisor_name4'],
			          'salary4' => $row['salary4'],
			          'reason_leaving4' => $row['reason_leaving4'],
					  'license1' => $row['PROF_License1'],
					  				// 'license2' => $row['PROF_License2'],
					  				// 'license3' => $row['PROF_License3'],
					  'rating1' => $row['PROF_Rating1'],
					  				// 'rating2' => $row['PROF_Rating2'],
					  				// 'rating3' => $row['PROF_Rating3'],
					  'granted1' => $row['PROF_DateGranted1'],
					  				// 'granted2' => $row['PROF_DateGranted2'],
					  				// 'granted3' => $row['PROF_DateGranted3'],
					  'institution1' => $row['PROF_Institution1'],
					  				// 'institution2' => $row['PROF_Institution2'],
					  				// 'institution3' => $row['PROF_Institution3'],
					  'license_num1' => $row['PROF_Licensennum1'],
					  				// 'license_num2' => $row['PROF_Licensennum2'],
					  				// 'license_num3' => $row['PROF_Licensennum3'],
					  'release1' => $row['PROF_DateReleased1']
					  				// 'release2' => $row['PROF_DateReleased2'],
					  				// 'release3' => $row['PROF_DateReleased3']



					);		
	}
		
	echo json_encode($data);

}
else {
    // DENIED
	exit(header('location:index.php'));
} 


?>