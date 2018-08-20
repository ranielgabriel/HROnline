<?php

include '../constants/Operations.php';

// Create an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Check if the POST for applicant is set
	if (isset($_POST['applicant'])
		) {

		// Instantiate the Operation class
		$db = new Operations();

		// Decode the JSON format of applicant variable from POST to string
		$applicant = json_decode($_POST['applicant']);

		// Get the first object of the array
		$applicant = $applicant[0];

		// Put the data of the applicant in the variable
		$response['applicant'] = $applicant;

		// Call the function from $db
		$result = $db->insertQuickApplicantToDatabase(
			$applicant->position,
			$applicant->firstname,
			$applicant->lastname,
			$applicant->salaryExpectation,
			$applicant->mobileNumber,
			$applicant->employmentDate,
			$applicant->school,
			$applicant->collegeDegree,
			$applicant->finishedYear,
			$applicant->recentCompany,
			$applicant->recentPosition,
			$applicant->dateStarted,
			$applicant->dateEnded,
			$applicant->essayAnswer,
			$applicant->shiftingSchedule,
			$applicant->contractual,
			$applicant->holidays,
			$applicant->graduateUndergraduate,
			$applicant->bpoExperience,
			$applicant->relatedExperienceInPosition
		);

		if($result == 0){

			// If there is no error
			$response['error'] = false;
			$response['message'] = 'Application successfully sent.';
		}elseif($result == 1){

			// If there is error
			$response['error'] = true;
			$response['message'] = 'Error sending application.';
		}

	}else{

		// If there is/are missing field(s)
		$response['error'] = true;
		$response['message'] = 'Please fill the required fields';

	}
}else{

	// If the request method is incorrect.
	$response['error'] = true;
	$response['message'] = 'Method is not correct';

}

// Print the $response array in JSON format
echo json_encode($response);