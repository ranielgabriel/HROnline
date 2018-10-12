<?php

// This class stores all the functions for CRUD (Create, Read, Update, Delete) operations of the database for the Quick Apply service of the HR Online System.
class Operations
{
//START OF CLASS//

	// Call $con variable for connecting or manipulating the SQL Database
	private $con;

	function __construct(){

	// Constructor for connection
	require_once dirname(__FILE__).'/DbConnect.php';

	$db = new DbConnect();

	$this->con = $db->connect();

	}

	function getAllApplicantSource(){
		$stmt = "SELECT source_name FROM tbl_sourceapplication WHERE flag = 0";
		$result = $this->con->query($stmt);
		$temp = array();
		if($result->num_rows>0){
			while($row = mysqli_fetch_assoc($result)){
				// $temp[] = $row;
				$source = $row['source_name'];
				$temp[] = $this->getAllApplicantBySource($source);
			}
		}

		header('Content-type: application/json');
		return $temp;
	}

	function getAllApplicantBySource($source){
		$stmt = "SELECT SUM(CASE WHEN tbl_application.APPLICATION_SOURCE ='$source' THEN 1 ELSE 0 END) AS '$source' FROM tbl_application";
		$result = $this->con->query($stmt);
		// header('Content-type: application/json');
		return mysqli_fetch_assoc($result);
	}

// END OF CLASS //
}