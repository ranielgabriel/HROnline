<?php
	include('connect.php');
	if(isset($_POST['ExamineeModelToPass'])){

	$datavalue = json_decode($_POST['ExamineeModelToPass'],true);
	$datavalue1 = $_POST['ExamineeModelToPass'];
	$numberOfExam = count($datavalue['ExamsTaken']);
	for($x = 0 ; $x < $numberOfExam; $x++){

		$sql= "INSERT INTO tbl_examresult (`ReferenceCode`,`Fullname`,`Position`,`DateTaken`,`ExamName`,`TestScore`,`TestTotal`) VALUES ('".$datavalue['RefCode']."','".$datavalue['Fullname']."','".$datavalue['Position']."','".$datavalue['DateTaken']."','".$datavalue['ExamsTaken'][$x]['ExamName']."','".$datavalue['ExamsTaken'][$x]['TestSetScore']."','".$datavalue['ExamsTaken'][$x]['TestSetTotal']."')";
		$conn->query($sql);
	}
}
?>