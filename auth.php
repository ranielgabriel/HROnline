<?php  
	/*AUTHENTICATION*/
	session_save_path('tmp');
	session_start();
	if($_SESSION['admin'] != 'administrator'){
		header('location: adminloginpage.php');
	}
?>