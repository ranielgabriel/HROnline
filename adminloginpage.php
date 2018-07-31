<?php

    session_save_path('tmp');
    session_start();
    include ('connect.php');
    $username = "";

  if(!empty($_SESSION['previous-page'])){
      if($_SESSION['previous-page'] == 'google.php'  || $_SESSION['previous-page'] == 'jobposition.php' || $_SESSION['previous-page'] == 'account.php' || $_SESSION['previous-page'] == 'reports.php'){
        unset($_SESSION['admin']);
      unset($_SESSION['currentYear']);
        unset($_SESSION['email_message']);
        unset($_SESSION['email_subject']);
        unset($_SESSION['jobfairquery']);
        unset($_SESSION['googlequery']);
        unset($_SESSION['indeedquery']);
        unset($_SESSION['loginerror']);
      }
    }
  
  if(isset($_SESSION['loginattempt']) ){ //
	 if($_SESSION['loginattempt'] != null){
		$temp = intval($_SESSION['loginattempt']);
		 if($temp >= 5){	
			$num = rand(100,999);//captcha code
			$str = 'ANDRS'.$num;
			$shuffled = str_shuffle($str);
			$_SESSION['code'] = $shuffled;
			$_SESSION['loginerror'] = "You have exceeded the login attempt limit!";
			header('location: loginattempt.php');			
		}
	}         
 }
  // echo '<p style="padding-top:.9%">Current PHP version: ' . phpversion() . '</p>';
?>

<html>  
   <head>
      <title>Login Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
      <link rel="stylesheet" type="text/css" href="css/ripples.css">
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="custom_css/adminloginpage.css">
   </head>
  
  <body class="login-img3-body">
    <div class="row">
      <div class="col-xs-12 col-md-12 col-sm-12">
          <center><img src="img/ag.png" class="img-res"></center>
        </div>
      </div>
      <div class="login-block">
        <h1 style="margin-bottom:5px;">Login</h1>

          <form action="loginbtn.php" method="post">
            <input id="username" type="text" name="username" required="" placeholder="Enter username" />
            <input id="password" type="password" name="password" required="" placeholder="Enter password" />
            <button id='login_id'  type="submit" name="action">Log In</button>
            <p class="text-center" style="text-align: center"> <a aria-expanded="false" data-longtext="Forgot Password" href="adminResetPasswordEmail.php" role="button" class="a-5-mbi">Forgot Password?</a></p>
          </form>

      </div>
                <?php
                
                  $slqInsertUser = "INSERT INTO tbl_userlogs (username, loggedInDate) VALUES ($username, CURRENT_TIMESTAMP())";
                 $result1 = $conn->query($slqInsertUser);
                 
                  if(!empty($_SESSION['loginerror'])){
                    echo"<div id='loginerror' class='alert alert-dismissible alert-danger'>
                      <button type='button' class='close' data-dismiss='alert'>×</button>
                      <p id='notif' style='text-align:center;'>".$_SESSION['loginerror']."</p>
                      </div>";
					  
                  }

                ?>
  <!-- scripts -->
  <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/material.js"></script>
  <script type="text/javascript">
    $.material.init();
    $(document).ready(function() {
     //$('select').material_select();
    });
  </script>

   </body>
</html>