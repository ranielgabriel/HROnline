<?php

include '../../constants/Operations.php';

// Create an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	$db = new Operations();
    $monthlyApplicants = $db->getAllMonthlyApplicant();
    $monthlyQuickApplyApplicants = $db->getAllMonthlyQuickApplyApplicant();

	$response['error'] = false;
	$response['applicants'] = $monthlyApplicants;
	$response['quickApplyApplicants'] = $monthlyQuickApplyApplicants;
	$response['message'] = 'These are all the monthly applicants.';

}else{

	// If the request method is incorrect.
	$response['error'] = true;
	$response['message'] = 'Method is not correct';

}

// Print the $response array in JSON format
echo json_encode($response);