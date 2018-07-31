
<?php
include('auth.php');

$_SESSION['previous-page'] = 'createAccount.php';


				$ln = "";
				$fn = "";
				$mn = "";
				$em = "";
				$em2 = "";
				$contact = "";
				$us = "";
				$pas = "";
				$pas2 = "";
				$usererrormsg = "";
				$emailerror = "";
				$erroremail = "";
				$whitespaceerror = "";
				$errormsg = "";		
?>
	<html>
   
   <head>
      <title>Create Account</title>
      
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/ripples.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.material.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/sidenav.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
	<link rel="stylesheet" type="text/css" href="css/tether.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="css/createAccount.css">
   </head>
   
   <body>

		<?php
			$id = $_GET['id'];
			include 'sidenavhtml.php';
		?> 

	<div id="main">
	<nav style="width:103.25%;  margin-left:-2%; background-color:transparent">
			 <div class="container-fluid">
				<ul class="nav navbar-nav">
				  <h5 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:10px; padding-right:10px; padding-left:10px" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h5>
				</ul>
            </div>


		   <hr style="padding-bottom: 1%">

		  <div class="row">
		  <div class="col-md-4"></div>


                    <div class="col-md-4">
					<div class="col-md-12 card">

  			<legend style="text-align: center"> <br> Create Account</legend>
     
					<!-- lastname, firstname, middlename, email, username, password, role -->
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							
							<form role="form" name="createform">


                               <div class="form-group">
						      <label class="col-md-2 control-label" for="usertx"><b>Username:</b></label>
						      <div class="col-md-1"></div>
						      <div class="col-md-8">
									<input type="text" class="form-control" name="ustx"  required><br>
									<span class="col-sm-offset-2 col-sm-12 error"><?php echo $usererrormsg; echo $whitespaceerror;?></span>
								</div>
								</div>
								
							<div class="form-group">
						     <label class="col-md-2 control-label" for ="passtx"><b>Password:</b></label>
						      <div class="col-md-1"></div>
						      <div class="col-md-8">

									<input type="password" class="form-control" id="password" name="passtx" data-toggle="popover" title="Password Strength" required><br>
								</div>
								</div>


						      <div class="form-group">
						     <label class="col-md-2 control-label" for ="emailtx"><b>Email Address:</b></label>
						      <div class="col-md-1"></div>
						      <div class="col-md-8">
						      	<input type="text" class="form-control" name="emailtx"  required>
									<span class="col-sm-offset-2 col-sm-12 error"><?php echo $usererrormsg; echo $whitespaceerror;?></span>
								</div>
								</div>


						<div class="container">
						     <label class="col-md-5 control-label" for ="desctx"><br><br><b>Select Role:</b></label>
						      <div class="col-md-4">
						      <div class="col-md-3">
						      <br>
						      
								<select class="btn btn-primary dropdown-toggle" title="Select one" data-style="btn-primary" name="cusSelectbox">
									<option>Admin</option>
									<option>User</option>
								</select>

									<script>
										$(document).ready(function(){
										    $(".dropdown-toggle").dropdown();
										});
										</script>
									</div>

				<?php

				include 'connect.php';

				if (isset ($_POST['ustx']) && isset($_POST['passtx'])){
					$username = $_POST['ustx'];
					//$password = $_POST['passtx'];
					$role = $_POST['cusSelectbox'];
					$pas = (md5(mysqli_real_escape_string($conn, $_POST["passtx"])));
					$email = $_POST['emailtx'];
					$check = "SELECT * FROM tbl_admin WHERE username = '$username'";
					$checkexist = mysqli_query($conn, $check);

					if (mysqli_num_rows($checkexist) > 0) {
						$errormsg = "Username already exist!";
					}else{
						$insertquery = "INSERT INTO `tbl_admin` (username,password,email,role) VALUES ('$username','$pas','$email','$role')";
						$executeinsert  = mysqli_query($conn, $insertquery);
						$errormsg = "Account registered successfully.";
					}

					echo '<script type="text/javascript">alert("'.$errormsg.'");
									</script>';
				}

				?>


					
				</div>

								<button type="submit" style="margin:auto; display:block;" id="butt" class="btn btn-sm btn-raised btn-primary">Create Account</button>
								 <p><span style="color:red;"><?php ;?></span></p>
								   <div class="col-md-1"></div>
						      <div class="col-md-8"></div>
						      </div>
							</form>	

						</form>
						</div>
						</div>
						</div>
						</nav>
						
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>	
	<script type="text/javascript" src="js/material.js"></script>
	<script type="text/javascript" src="js/jquery.dropdown.js"></script>
	<script type="text/javascript" src="js/dataTables.material.js"></script>	
	<!-- <script type="text/javascript" src="js/dataTables.bootstrap.js"></script> -->
	<script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>
	<script type="text/javascript" src="js/tether.js"></script>
	<script type="text/javascript">
		var idleTime = 0;
		

		 
		function anotherfunction(){
			$('#sureroll').modal('show');
			$('#myModal').modal('hide');
		}
		function openNav() {
		    document.getElementById("mySidenav").style.width = "300px";
		    document.getElementById("main").style.marginLeft = "300px";
		}

		function closeNav() {
		    document.getElementById("mySidenav").style.width = "0";
		    document.getElementById("main").style.marginLeft= "0";
		}
		</script>

		 <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
		  <script type="text/javascript" src="js/bootstrap.js"></script>
		  <script type="text/javascript" src="js/material.js"></script>

  
	  <script type="text/javascript">
		    $.material.init();
		    $(document).ready(function() {
		     //$('select').material_select();
		    });
		     $(function () {

			var defaultselectbox = $('#cusSelectbox');
			var numOfOptions = $('#cusSelectbox').children('option').length;

			// hide select tag
			defaultselectbox.addClass('s-hidden');

			// wrapping default selectbox into custom select block
			defaultselectbox.wrap('<div class="cusSelBlock"></div>');

			// creating custom select div
			defaultselectbox.after('<div class="selectLabel"></div>');

			// getting default select box selected value
			$('.selectLabel').text(defaultselectbox.children('option').eq(0).text());

			// appending options to custom un-ordered list tag
			var cusList = $('<ul/>', { 'class': 'options'} ).insertAfter($('.selectLabel'));

			// generating custom list items
			for(var i=0; i< numOfOptions; i++) {
				$('<li/>', {
				text: defaultselectbox.children('option').eq(i).text(),
				rel: defaultselectbox.children('option').eq(i).val()
				}).appendTo(cusList);
			}

			// open-list and close-list items functions
			function openList() {
				for(var i=0; i< numOfOptions; i++) {
					$('.options').children('li').eq(i).attr('tabindex', i).css(
						'transform', 'translateY('+(i*100+100)+'%)').css(
						'transition-delay', i*30+'ms');
				}
			}

			function closeList() {
				for(var i=0; i< numOfOptions; i++) {
					$('.options').children('li').eq(i).css(
						'transform', 'translateY('+i*0+'px)').css('transition-delay', i*0+'ms');
				}
				$('.options').children('li').eq(1).css('transform', 'translateY('+2+'px)');
				$('.options').children('li').eq(2).css('transform', 'translateY('+4+'px)');
			}

			// click event functions
			$('.selectLabel').click(function () {
				$(this).toggleClass('active');
				if( $(this).hasClass('active') ) {
					openList();
					focusItems();
				}
				else {
					closeList();
				}
			});

			$(".options li").on('keypress click', function(e) {
				e.preventDefault();
				$('.options li').siblings().removeClass();
				closeList();
				$('.selectLabel').removeClass('active');
				$('.selectLabel').text($(this).text());
				defaultselectbox.val($(this).text());
				$('.selected-item p span').text($('.selectLabel').text());
			});
			
		});

function focusItems() {

	$('.options').on('focus', 'li', function() {
		$this = $(this);
		$this.addClass('active').siblings().removeClass();
	}).on('keydown', 'li', function(e) {
		$this = $(this);
		if (e.keyCode == 40) {
			$this.next().focus();
			return false;
		} else if (e.keyCode == 38) {
			$this.prev().focus();
			return false;
		}
	}).find('li').first().focus();

}


  </script>

	<script src="js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>


	<!-- <style>
		#select{
			width:150px;
		}
		#select option{
			width:150px;
		}
	
	</style> -->
</body>
</html>