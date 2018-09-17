<?php

include '../constants/Operations.php';

// Create an array
$response = array();

// Create an empty variable
$positionsToDisplay = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	// Check if the position variable for GET is set and not empty
	if(isset($_GET['position']) and $_GET['position'] != ''){

		$position = $_GET['position'];

		$response['positions'] = $position;

		// Put the HTML code in the code JSON variable
		$response['code'] = "<input readonly type='select' id='positionApplying' value='" . $position . "'>";
		$response['error'] = false;
		$response['message'] = $position . " is what you are applying for.";

	}else{

		$db = new Operations();
		$result = $db->getAllPositions("");

		$response['positions'] = $result;

		// Loop in each of the position and add the position name in the $positionsToDisplay variable
		foreach ($response['positions'] as $position ) {
			$positionsToDisplay = $positionsToDisplay . "<option value='" . $position['position_name'] . "'>" . $position['position_name'] . "</option>";
		}

		// Put the HTML code in the code JSON variable
		$response['code'] = "<select id='positionApplying'><option disabled selected value=''>Select Position</option>" . $positionsToDisplay . "</select><div id='positionErrorMessage' style='display: none; color: red;'>Select your position here.</div>";

		// If there is no error
		$response['error'] = false;
		$response['message'] = 'These are all the positions available';
	}

}else{

	// If the request method is incorrect.
	$response['error'] = true;
	$response['message'] = 'Method is not correct';

}

// Print the $response array in JSON format
echo json_encode($response);