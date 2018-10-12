<?php

include '../../constants/Operations.php';

// Create an array
$response = array();

// Create an empty variable
$positionsToDisplay = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	$db = new Operations();
	$result = $db->getAllApplicantSource();

	$response['error'] = false;
	$response['source'] = $result;
	$response['message'] = 'These are all the applicant source.';

}else{

	// If the request method is incorrect.
	$response['error'] = true;
	$response['message'] = 'Method is not correct';

}

// Print the $response array in JSON format
echo json_encode($response);