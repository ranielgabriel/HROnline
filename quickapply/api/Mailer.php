<?php
    require '../../PHPMailer/PHPmailerAutoload.php';

    $mail = new PHPMailer;

    // PHPMailer Settings
    $mail -> isSMTP();
    $mail -> SMTPDebug = 2; // Change value into 2 or 3 to Enter Debug Mode
    $mail -> Host = 'smtp.gmail.com';
    $mail -> Port = 587;
    $mail -> SMTPSecure = 'tls';
    $mail -> SMTPAuth = true;

    // Username and Password andersonhronline@gmail.com
    $mail -> Username = 'andersonhronline@gmail.com';
    $mail -> Password = 'Password321';

    $mail -> SetFrom('phrecruitment@andersonbpoinc.com', 'Anderson Group PH');
    $mail -> AddReplyTo('no-reply@example.com');
    $mail -> AddAddress('ignar@andersonbpoinc.com');
    $mail -> isHTML(true);
    $mail -> AddEmbeddedImage('../aga.png', '../logo', '../aga.png');

    // Email Content
    $bodyContent = 'hi';

    // Email Content Extra
    $mail -> Subject = 'Anderson Group Philippines | Anderson.Recruits';
    $mail -> Body = $bodyContent;
    $mail -> AltBody = 'Anderson';

    // Checks if email has been sent successfully
    if(!$mail -> send()){
        echo "Quick Application Mailer Error" . $mail -> ErrorInfo;
    } else {
        echo "Quick Application Mail Sent";
    }

?>