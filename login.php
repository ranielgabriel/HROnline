<?php
  session_save_path('tmp');
  session_start();
  if(!empty($_SESSION['previous-page'])){
    if($_SESSION['previous-page'] == 'google.php' || $_SESSION['previous-page'] == 'indeed.php' || $_SESSION['previous-page'] == 'jobfair.php' || $_SESSION['previous-page'] == 'jobposition.php' || $_SESSION['previous-page'] == 'account.php' || $_SESSION['previous-page'] == 'reports.php'){
      unset($_SESSION['admin']);
      unset($_SESSION['previous-page']);
      unset($_SESSION['id']);
      unset($_SESSION['pass']);
      unset($_SESSION['email_message']);
      unset($_SESSION['email_subject']);
      unset($_SESSION['jobfairquery']);
      unset($_SESSION['googlequery']);
      unset($_SESSION['indeedquery']);
      unset($_SESSION['loginerror']);
    }
  }
  if(isset($_SESSION['loginattempt']) && !empty($_SESSION['loginattempt'] && $_SESSION['loginattempt'] >= 5)){
    $num = rand(100,999);//captcha code
    $str = 'ANDRS'.$num;
    $shuffled = str_shuffle($str);
    $_SESSION['code'] = $shuffled;
    $_SESSION['loginerror'] = "You have exceeded the login attempt limit!";
    header('location: loginattempt.php');
  }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
      <link rel="stylesheet" type="text/css" href="css/ripples.css">
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
      
   </head>
   
   <body bgcolor = "#FFFFFF">
   <hr style="padding-bottom: 1%">
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>				
            <div style = "margin:30px" id="logindiv">
               <form action = "loginbtn.php" method = "post">
                <div class="form-group label-floating">
                  <label for="username" class="control-label">Username</label>
                  <input id="username" type = "text" name = "username" class = "form-control" required="" />
                </div>
                <div class="form-group label-floating">
                  <label for="password" class="control-label">Password</label>
                  <input id ="password" type = "password" name = "password" class = "form-control" required="" /><br/><br />
                </div> 
                  <button id='login_id' class="btn btn-raised btn-primary btn-sm" type="submit" name="action">Log In</button> 
               </form>
            </div>
                <?php
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