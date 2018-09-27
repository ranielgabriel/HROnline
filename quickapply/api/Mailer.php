<?php
    require 'PHPMailer/PHPMailerAutoload.php';

    // Decode the JSON format of applicant variable from POST to string
    $applicant = json_decode($_POST['applicant']);

    // Get the first object of the array
    $applicant = $applicant[0];


    $mail = new PHPMailer;

    // PHPMailer Settings

    // Local Testing ####
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->AddAddress('ranielramosgabriel@gmail.com');
    // Local Testing ####

    // Live ###
    // $mail->Host = 'relay-hosting.secureserver.net';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;

    // Username and Password andersonhronline@gmail.com
    $mail->Username = 'phrecruitment@andersongroup.ph.com';
    $mail->Password = 'Password123';

    $mail->SetFrom('phrecruitment@andersongroup.ph.com','Anderson Group PH');
    $mail->AddReplyTo('no-reply@example.com');
    // $mail->AddAddress('andersonhronline@gmail.com');
    // $mail->addAddress('phrecruitment@andersonbpoinc.com');
    $mail->isHTML(true);
    $mail->AddEmbeddedImage('../../aga.png', 'logo', '../../aga.png');

    // Email Content
    $bodyContent = "<a href='http://andersonbpoinc.com'><img style='text-align:center;' src='cid:logo'></a></br><hr >";
    $bodyContent .= "A new applicant is applying for the position <b>".$applicant->position."</b> via Quick Apply.";
    $bodyContent .= "<br>The basic information of the applicant are shown on the table provided:";
    $bodyContent .= "<br>";
    $bodyContent .=        "<table style='table, th, td {
   border: 1px solid black;}'>";
    $bodyContent .=            "<tr><th colspan='2'><label><b><center>Basic Information</center></b></label></th></tr>";
    $bodyContent .=            "<tr><td><b>Position:</b></td><td>" . $applicant->position . "</td></tr>";
    $bodyContent .=            "<tr><td><b>First Name:</b></td><td>" . $applicant->firstname . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Last Name:</b></td><td>" . $applicant->lastname . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Shifting Schedule</b></td><td>" . $applicant->shiftingSchedule . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Openness to project-based employment:</b></td><td>" . $applicant->contractual . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Willingness to work during holidays:</b></td><td>" . $applicant->holidays . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Expected Salary:</b></td><td>" . $applicant->salaryExpectation . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Mobile Number:</b></td><td>" . $applicant->mobileNumber . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Available Date for Employment:</b></td><td>" . $applicant->employmentDate . "</td></tr>";
    $bodyContent .=            "<tr><td></td><td></td></tr>";
    $bodyContent .=            "<tr><td></td></tr>";
    $bodyContent .=            "<tr><td></td></tr>";
    $bodyContent .=            "<tr><th colspan='2'><label><b><center>Educational Information</center></b></label></th></tr>";
    $bodyContent .=            "<tr><td><b>School:</b></td><td>" . $applicant->school . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Course:</b></td><td>" . $applicant->collegeDegree . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Graduate / Undergraduate:</b></td><td>" . $applicant->graduateUndergraduate . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Finished what year in college:</b></td><td>" . $applicant->finishedYear . "</td></tr>";
    $bodyContent .=            "<tr><td></td><td></td></tr>";
    $bodyContent .=            "<tr><td></td></tr>";
    $bodyContent .=            "<tr><td></td></tr>";
    $bodyContent .=            "<tr><th colspan='2'><label><b><center>Work Experience</center></b></label></th></tr>";
    $bodyContent .=            "<tr><td><b>BPO Experience:</b></td><td>" . $applicant->bpoExperience . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Related experience to the position:</b></td><td>" . $applicant->relatedExperienceInPosition . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Most recent company:</b></td><td>" . $applicant->recentCompany . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Date Started:</b></td><td>" . $applicant->dateStarted . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Date Ended:</b></td><td>" . $applicant->dateEnded . "</td></tr>";
    $bodyContent .=            "<tr><td><b>Position:</b></td><td>" . $applicant->recentPosition . "</td></tr>";
    $bodyContent .=            "<tr><td></td><td></td></tr>";
    $bodyContent .=            "<tr colspan='2'><td><label><b>Essay:</b></label></td></tr>";
    $bodyContent .=            "<tr colspan='2'><td>" . $applicant->essayAnswer . "</td></tr>";
    $bodyContent .=        "</table>";
    $bodyContent .="</div>";


    // Email Content Extra
    $mail->Subject = 'Anderson Group Philippines | Anderson.Recruits';
    $mail->Body = $bodyContent;
    $mail->AltBody = 'Anderson';

    // Checks if email has been sent successfully
    if(!$mail -> send()){
        echo "Quick Application Mailer Error " . $mail->ErrorInfo;
    } else {
        echo "Quick Application Mail Sent";
    }

?>