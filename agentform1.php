<?php 
session_start();
date_default_timezone_set('Asia/Manila');
if (isset($_POST['submit'])) {
	include 'connect.php';

// retrieve applicant id
	$client_id = $_POST['ref_number'];

// retrieve answers in quetions 1-4
	$answer1 = $_POST['ans1'];
	$answer2 = $_POST['ans2'];
	$answer3 = $_POST['ans3'];
	$answer4 = $_POST['ans4'];

// initial interviewer Note
	$IIN = $_POST['InitialInterviewerNotes'];
	$typing = $_POST['typeskills'];
	$communication = $_POST['communicationskill'];
	$work_avail = $_POST['workavailability'];
	$accuracy = $_POST['accuracy'];
	$exp_sal = $_POST['expectedsalary'];
	$expectations = $_POST['expectation'];

//checkbox choices
	$emp_issue = $_POST['emp_issue'];
	$med_issue = $_POST['med_issue'];
	$plan_abroad = $_POST['plan_abroad'];
	$martial_issue = $_POST['martial_issue'];
	$custody_issue = $_POST['custody_issue'];
	$plan_school = $_POST['plan_school'];
	
//descriptions
	$emp_issue_text = $_POST['emp_issue_text'];
	$med_issue_text = $_POST['med_issue_text'];
	$plan_abroad_text = $_POST['plan_abroad_text'];
	$martial_issue_text = $_POST['martial_issue_text'];
	$custody_issue_text = $_POST['custody_issue_text'];
	$plan_school_text = $_POST['plan_school_text'];

// insert statement
$sql_insert = "INSERT INTO tbl_recruitsquestions(ID, question1_ans, question2_ans, question3_ans, question4_ans,note, typing_skill, communication_skill, work_avail, accuracy, expected_salary, expectation, emp_issue, med_issue, plan_abroad, martial_issue, custody_issue, plan_sch, emp_issue_text, martial_issue_text, med_issue_text, custody_issue_text, plan_abroad_text, plan_school_text)VALUES('".$client_id."','".$answer1."','".$answer2."','".$answer3."','".$answer4."','".$IIN."','".$typing."','".$communication."','".$work_avail."','".$accuracy."', '".$exp_sal."', '".$expectations."','".$emp_issue."','".$med_issue."', '".$plan_abroad."', '".$martial_issue."', '".$custody_issue."', '".$plan_school."', '".$emp_issue_text."', '".$med_issue_text."', '".$plan_abroad_text."', '".$martial_issue_text."', '".$custody_issue_text."', '".$plan_school_text."')";
$result = $conn->query($sql_insert);

if ($result) {
	echo '<script type="text/javascript">alert("Informations successfully save!!");window.location="question.php";</script>';}
else  {
	echo '<script type="text/javascript">alert("Failed to save information!")</script>';
}
$conn->close();
}
?>