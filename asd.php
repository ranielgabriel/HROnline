<?php

	include('connect.php');

	// $sql = "DELETE FROM tbl_application WHERE `NAME` = 'Rizal'";
	// $result = $conn->query($sql);
	// if ($result) {
		// echo "yey!";
	// }else{
		// echo "failed";
	// }

	//$sql = "SHOW COLUMNS FROM tbl_examresult";
	$sql = "SELECT * FROM tbl_ ";
	/*$sql = "INSERT INTO tbl_nonagentquestionnaire(intQuestion_ID, interviewquestion) VALUES ('3','Describe a situation you feel has prepared you for this role?')";
	$result = $conn->query($sql);
	echo "successful";
	$sql1 = "INSERT INTO tbl_nonagentquestionnaire(intQuestion_ID, interviewquestion) VALUES ('4','What is your strongest personal quality?')";
	$result1 = $conn->query($sql1); 
	echo "successful";
	$sql3 = "INSERT INTO tbl_nonagentquestionnaire(intQuestion_ID, interviewquestion) VALUES ('5','What are some of your leadership experiences? Can you give an example?')";
	$result3 = $conn->query($sql3);
	echo "successful";
	$sql4 = "INSERT INTO tbl_nonagentquestionnaire(intQuestion_ID, interviewquestion) VALUES ('6','If successful, what can you contribute to Anderson Group Philippines? ')";  
	$result4 = $conn->query($sql4);
	echo "successful";
	$sql5 = "INSERT INTO tbl_nonagentquestionnaire(intQuestion_ID, interviewquestion) VALUES ('7','What are the three things your former manager would like you to improve on?')";
	$result5 = $conn->query($sql5);
	echo "successful"; */
	
	//edward
	//$sql = "SELECT * FROM tbl_essay WHERE APPLICANT_ID='8810'";
	/*$sql = "UPDATE tbl_admin
SET role = 'Admin'
WHERE username = 'marvin'";
	$result = $conn->query($sql);
	 if($result){
        echo "successful";

    }*/

/*	if($result){
		//while($row = $result->fetch_assoc()){
			//if($result){
			//print_r($row);
			//echo $row['Answer']."<br>";
			echo "<br>";
			echo "yay!";
		}
		else{
		echo "aaaaaaahhhh";
	}*/



//delete code

	$sql = "DELETE FROM tbl_useractionlogs WHERE username =  'marvin'";
	
	$result = $conn->query($sql);
	
    if ($result){

    	echo "Record Deleted!";

    }
    else{
    	echo "Error!";
 	}

?>