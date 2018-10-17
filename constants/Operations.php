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

	function getAllApplicantStatus(){
		$stmt = "SELECT 
		SUM(CASE WHEN tbl_application.status ='Pending' THEN 1 ELSE 0 END) AS 'Pending',
		SUM(CASE WHEN tbl_application.status ='No Show' THEN 1 ELSE 0 END) AS 'No Show',
		SUM(CASE WHEN tbl_application.status LIKE '%Interview%' THEN 1 ELSE 0 END) AS 'Interview',
		SUM(CASE WHEN tbl_application.status ='Rejected' THEN 1 ELSE 0 END) AS 'Fail/Reject'
		FROM tbl_application";

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

	function getAllApplicantLocation(){
		$stmt ="SELECT 
		DISTINCT CURRENT_MUNICIPALITY AS 'Place', 
		COUNT(CURRENT_MUNICIPALITY) AS 'Total'
		FROM tbl_application
        WHERE tbl_application.CURRENT_REGION = 'Metro Manila (NCR)' AND
        CURRENT_MUNICIPALITY != ''
        GROUP BY CURRENT_MUNICIPALITY
        
        UNION
        
        SELECT 
		DISTINCT CURRENT_REGION AS 'Place', 
		COUNT(CURRENT_REGION) AS 'Total'
		FROM tbl_application
        WHERE CURRENT_REGION != ''
		GROUP BY CURRENT_REGION
		";

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

	function getAllMonthlyApplicant(){
		$currentYear = date('Y');
		$stmt = "SELECT 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-01-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') < '".$currentYear."-02-01' THEN 1 ELSE 0 END) as 'January', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-02-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') < '".$currentYear."-03-01' THEN 1 ELSE 0 END) as 'February', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-03-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-03-31' THEN 1 ELSE 0 END) as 'March',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-04-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-04-30' THEN 1 ELSE 0 END) as 'April', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-05-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-05-31' THEN 1 ELSE 0 END) as 'May',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-06-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-06-30' THEN 1 ELSE 0 END) as 'June',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-07-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-07-31' THEN 1 ELSE 0 END) as 'July',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-08-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-08-31' THEN 1 ELSE 0 END) as 'August', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-09-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-09-30' THEN 1 ELSE 0 END) as 'September',  
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-10-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-10-31' THEN 1 ELSE 0 END) as 'October',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-11-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-11-30' THEN 1 ELSE 0 END) as 'November', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-12-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-12-31' THEN 1 ELSE 0 END) as 'December'  
		FROM tbl_application";

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

	function getAllDailyApplicant(){
		$currentYear = date('Y');
		$stmt = "SELECT DISTINCT myTable.Date, SUM(myTable.Total) AS 'Total' FROM (
			SELECT 
			DATE_FORMAT(`Timestamp`, '%Y-%m-%d') AS 'Date', 
			COUNT(DATE(`TIMESTAMP`)) AS 'Total'
			FROM tbl_application
			GROUP BY TIMESTAMP) AS myTable
			WHERE myTable.Date LIKE '%2018%'
        GROUP BY myTable.Date";

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

	function getAllQuickApplyDailyApplicant(){
		$currentYear = date('Y');
		$stmt = "SELECT DISTINCT myTable.Date, SUM(myTable.Total) AS 'Total' FROM (
			SELECT 
			DATE_FORMAT(`Timestamp`, '%Y-%m-%d') AS 'Date', 
			COUNT(DATE(`TIMESTAMP`)) AS 'Total'
			FROM tbl_quick_applications
			GROUP BY TIMESTAMP) AS myTable
			WHERE myTable.Date LIKE '%2018%'
        GROUP BY myTable.Date";

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

	function getAllMonthlyQuickApplyApplicant(){
		$currentYear = date('Y');
		$stmt = "SELECT 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-01-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') < '".$currentYear."-02-01' THEN 1 ELSE 0 END) as 'January', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-02-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') < '".$currentYear."-03-01' THEN 1 ELSE 0 END) as 'February', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-03-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-03-31' THEN 1 ELSE 0 END) as 'March',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-04-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-04-30' THEN 1 ELSE 0 END) as 'April', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-05-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-05-31' THEN 1 ELSE 0 END) as 'May',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-06-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-06-30' THEN 1 ELSE 0 END) as 'June',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-07-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-07-31' THEN 1 ELSE 0 END) as 'July',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-08-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-08-31' THEN 1 ELSE 0 END) as 'August', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-09-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-09-30' THEN 1 ELSE 0 END) as 'September',  
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-10-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-10-31' THEN 1 ELSE 0 END) as 'October',
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-11-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-11-30' THEN 1 ELSE 0 END) as 'November', 
		SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$currentYear."-12-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$currentYear."-12-31' THEN 1 ELSE 0 END) as 'December'  
		FROM tbl_quick_applications";

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

	function getAllApplicantAge(){
		$stmt = "SELECT 
		SUM(CASE WHEN `Age` >= 18 AND `Age` <= 25 THEN 1 ELSE 0 END) as '18 to 25',
		SUM(CASE WHEN `Age` >= 26 AND `Age` <= 30 THEN 1 ELSE 0 END) as '26 to 30',
		SUM(CASE WHEN `Age` >= 31 AND `Age` <= 35 THEN 1 ELSE 0 END) as '31 to 35',
		SUM(CASE WHEN `Age` >= 36 AND `Age` <= 42 THEN 1 ELSE 0 END) as '36 to 42',
		SUM(CASE WHEN `Age` >= 43 AND `Age` <= 50 THEN 1 ELSE 0 END) as '43 to 50',
		SUM(CASE WHEN `Age` >= 51 THEN 1 ELSE 0 END) as '51 and up'
		FROM tbl_application";

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

	function getAllJobTitle(){
		$stmt = "SELECT 
		DISTINCT position, 
		COUNT(position) AS 'Total'
		FROM tbl_application 
		GROUP BY position 
		ORDER BY `total` DESC";

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

// END OF CLASS //
}