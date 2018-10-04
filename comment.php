<?php

	$id = $_GET['id'];

	$commentsql = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Initial Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql);

		$row = $result->fetch_assoc();

		echo "

					<div class='col-xs-12'>

						<div class='col-xs-12'>

							<label>Initial Interviewer:</label>

							".$row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>

							".nl2br($row['Comment'])."

						</div>	

					</div>";



	$commentsql2 = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Second Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql2);

		$row = $result->fetch_assoc();

		echo "

					<div class='col-xs-12'>

						<div class='col-xs-12'>

							<label>Second Interviewer:</label>

							".$row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>

							".nl2br($row['Comment'])."

						</div>	

					</div>";



	$commentsql3 = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Third Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql3);

		$row = $result->fetch_assoc();

		echo "

					<div class='col-xs-12'>

						<div class='col-xs-12'>

							<label>Third Interviewer:</label>

							".$row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>

							".nl2br($row['Comment'])."

						</div>	

					</div>";



	$commentsql4 = "

		SELECT tbl_interview.Comment, tbl_interview.interviewerFirstname, tbl_interview.interviewerLastname, tbl_interview.interviewerMiddlename, tbl_application.REFERENCE_NO, tbl_application.id

		FROM tbl_interview, tbl_application

		WHERE tbl_interview.InterviewStage = 'Final Interview' AND tbl_application.id = '$id' AND tbl_interview.ReferenceNo = tbl_application.REFERENCE_NO";



		$result = $conn->query($commentsql4);

		$row = $result->fetch_assoc();

		echo "

					<div class='col-xs-12'>

						<div class='col-xs-12'>

							<label>Final Interviewer:</label>

							".$row["interviewerLastname"].", ".$row["interviewerFirstname"]." ".$row["interviewerMiddlename"]."<br>

							".nl2br($row['Comment'])."

						</div>	

					</div>";

?>