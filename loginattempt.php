<?php
  session_save_path('tmp');
  session_start();
  if(isset($_POST['code'])){
  echo "<script>alert(".$_POST['code'].")</script>";
    if(strtoupper($_POST['code']) == $_SESSION['code']){
      unset($_SESSION['loginattempt']);
      unset($_SESSION['loginerror']);
      header('location: adminloginpage.php');
    }else{
      $num = rand(100,999);//captcha code
      $str = 'ANDRS'.$num;
      $shuffled = str_shuffle($str);
      $_SESSION['code'] = $shuffled;
    }
  }
?>
<html>
    <head>
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    </head>
   
    <body bgcolor = "#FFFFFF">
      <hr style="padding-bottom: 1%">
      <div align = "center">
        <div style = "width:300px; border: solid 1px #333333; " align = "left">
          <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <?php
              if(!empty($_SESSION['loginerror'])){
                echo"<div id='loginerror' class='alert alert-dismissible alert-danger'>
                  <button type='button' class='close' data-dismiss='alert'>×</button>
                  <p id='notif' style='text-align:center;'>".$_SESSION['loginerror']."</p>
                  </div>";
              }
            ?>
            <div id="captchadiv">
              <img src="captcha.php" class="">
              <form action="loginattempt.php" method="POST">
                <div class="container-fluid">
                  <input type="text" class="form-control" name="code" placeholder="Enter the value you see">
                  <input type="submit" class="btn btn-sm btn-raised btn-danger"></input>
                </div>
              </form>
            </div>
        </div>
      </div>
    </body>
</html>
