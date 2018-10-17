<?php

include '../../constants/Operations.php';

// Create an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	$db = new Operations();
	$result = $db->getAllJobTitle();

	$response['error'] = false;
	$response['position'] = $result;
	$response['message'] = 'These are all the job title and the number of applicants per title.';

}else{

	// If the request method is incorrect.
	$response['error'] = true;
	$response['message'] = 'Method is not correct';

}

// Print the $response array in JSON format
echo json_encode($response);