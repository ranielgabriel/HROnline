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

	// ###### READ #######
	function getAllPositions($position){
		// This function is for getting all the positions from the database

		// If the $position is set just return the position
		if($position != ""){
			return $position;
		}

		// Else return all the positions from the database
		$stmt = "SELECT * FROM tbl_position WHERE status = 1 ORDER BY position_name ASC";
		$result = $this->con->query($stmt);
		$temp = array();
		if($result->num_rows>0){
			while($row = mysqli_fetch_assoc($result)){
				$temp[] = $row;
			}
		}

		header('Content-type: application/json');
		return $temp;
	}
	// ###### READ #######

	// ###### CREATE #######
	// This function will insert a Quick applicant in the database
	function insertQuickApplicantToDatabase($position, $firstname, $lastname,  $expected_salary, $mobile_number, $available_date, $school, $course, $finished_year, $recent_company, $recent_position, $date_started, $date_ended, $essay_answer, $shifting_schedule, $contractual, $holidays, $graduate_undergraduate, $bpo_experience, $related_experience_in_position){

		$stmt = $this->con->prepare("INSERT INTO `tbl_quick_applications`(`position`,`firstname`, `lastname`, `expected_salary`, `mobile_number`, `available_date`, `school`, `course`, `finished_year`, `recent_company`, `recent_position`, `date_started`, `date_ended`, `essay_answer`, `shifting_schedule`, `contractual`, `holidays`, `graduate_undergraduate`, `bpo_experience`, `related_experience_in_position`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

		$stmt->bind_param("ssssssssssssssssssss", $position ,$firstname, $lastname, $expected_salary, $mobile_number, $available_date, $school, $course, $finished_year, $recent_company, $recent_position, $date_started, $date_ended, $essay_answer, $shifting_schedule, $contractual, $holidays, $graduate_undergraduate, $bpo_experience, $related_experience_in_position);

		if($stmt->execute()){

			// If the SQL ran without error
			return 0;
		}else{

			// If the SQL ran with error
			return 1;
		}
	}
	// ###### CREATE #######

	// ###### DELETE #######
	// This function will delete a quick apply applicant in the database
	function deleteQuickApplicant($id){

		$stmt = $this->con->prepare("DELETE FROM tbl_quick_applications WHERE id = ?");

		$stmt->bind_param("i", $id);

		if($stmt->execute()){

			// If the SQL ran without error
			return 0;
		}else{

			// If the SQL ran with error
			return 1;
		}
	}
	// ###### DELETE #######

// END OF CLASS //
}