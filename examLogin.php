<?php
session_start();


?>
<html>
<head>
	<title>Application Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker3.css">
	<link rel="stylesheet" type="text/css" href="css/ripples.css">
	<link rel="stylesheet" type="text/css" href="css/inputmask.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<!-- Javascript file -->
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript">
		var sample = "Angelica Lawas Cruz";
	</script>
	<style>
	.main{
    margin-top: 50px;
	}

	.main-content {
	/*    background-color:#009edf;*/
		border: 2px solid #009edf;
		margin: 0 auto;
		max-width: 30%;
		padding: 20px 40px;
		color: #ccc;
		text-shadow: none;

	}


	


	.form-header{
		max-width: 500px;
		margin: 0 auto;
		background-color: #009edf;
		color: #fff;
		width: 30%;
		padding: 5px 0px;
		border-top-right-radius:10px ;
		border-top-left-radius:10px 
	}
	.remember{
		color: black;
	}
	</style>
</head>
<body>
	<section class="login-info">
<div class="container">
  <div class="row main">
       <div class="form-header">
          <h3 class="text-center">Exam Login</h3>
        </div>
		
    <div class="main-content">
          <form method="POST" autocomplete="off" action="checkApplicant.php">
		  <div class="form-group">
			<div class="input-group">
				<input type="text" maxlength="10" style="text-align:center;" class="form-control" name="ref" placeholder="Enter your Reference Code" required >
				<center><p style="color:#cc0000;display:<?php 
				if(isset($_SESSION['ValidateLoginExam'])){
					if($_SESSION['ValidateLoginExam']==1){
						echo'block';
					}else{
						echo'none';
					}
						unset($_SESSION['ValidateLoginExam']);
				}else{
					echo'none';
				}?>;">Invalid Reference Code.</p></center>
			</div>
          </div>
          
        
          <div class="form-group" style="margin-top:10%;">
              <input href="#" type="submit" value="Login" class="btn btn-primary pull-right"></input>
          </div>
		  <br>
          <form>

      </div>
    </div>
</div>
</section>
	<?php
		$raiven = "<script type='text/javascript'>document.write(sample);</script>";
		echo $raiven;
		?>
</body>
</html>
