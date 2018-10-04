<?php

include '../constants/Operations.php';

// Create an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Check if the POST for id is set
	if (isset($_POST['id'])
		) {

		// Instantiate the Operation class
		$db = new Operations();

		// Get the id variable from POST
		$id = $_POST['id'];

		// Put the data of the id in the variable
		$response['id'] = $id;

		// Call the function from $db
		$result = $db->deleteQuickApplicant($response['id']);

		if($result == 0){

			// If there is no error
			$response['error'] = false;
			$response['message'] = 'Applicant successfully deleted.';

		}elseif($result == 1){

			// If there is error
			$response['error'] = true;
			$response['message'] = 'Error deleting applicant.';
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