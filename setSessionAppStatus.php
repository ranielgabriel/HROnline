<?php
session_start();
//$_SESSION['Email_Staus'] = $_POST['emailStat'];
$_SESSION['Application_Status'] = "Unfinished";
echo $_SESSION['Application_Status'];
?>