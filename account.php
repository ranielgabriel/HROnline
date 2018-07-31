
<?php
	include('auth.php');
	$_SESSION['previous-page'] = 'account.php';
unset($_SESSION['neco']);
//$_SESSION['neco'] = 3;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accounts Page</title>
	
 <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="css/sidenav.css">
      <link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
      <link rel="stylesheet" type="text/css" href="css/tether.css">
      <link rel="stylesheet" href="custom_js/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="custom_js/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="custom_css/user_logs.css">

    <style type="text/css">
    a:hover{
		color:white;
	}
	.navi:hover{
                color:white;  
                background-color: #00008B;
            }
	a.active {background-color:#1a1a1a;}

</style>
</head>
<body>

<?php
	

	$id = $_GET['id'];
	include 'sidenavhtml.php';

	?>

<div id="main">
	<h5 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:10px; padding-right:10px; padding-left:10px;" onclick="openNav()"><i class="fa fa-bars"></i> Menu </h5>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="row" style="text-align: center padding-top:50px">
				<div class="col-md-4">
					<div class="col-md-12 card">
						<legend style="text-align: center"> <br> Admin Account</legend>
						<?php
							$id = $_SESSION['id'];
							include('connect.php');
							$sql = "SELECT * FROM tbl_admin WHERE id = '$id'";
							$result = $conn->query($sql);
  							$row = $result->fetch_assoc();
						?>
						<form role="form" name="accountform">
							<div class="form-group">
						      <label class="col-md-2 control-label">Username</label>
						      <div class="col-md-1"></div>
						      <div class="col-md-8">
						        <input name="newusername" id="newusername" type="text" class="form-control" disabled value="<?php echo $row['username']; ?>">
						      </div>
						    </div>
						    <div class="form-group">
						    	<label class="col-md-2 control-label">Password</label>
						    	<div class="col-md-1"></div>
								<div class="col-md-8">
									<input name="newpassword" id="newpassword" type="password" disabled class="form-control" value="*********">
									<h6><span class="text-danger" id="passwordnotice1"></span></h6>
								</div>
						    </div>
						    <div class="form-group" id="cnewpassword">
						    	<label class="col-md-2 control-label">Confirm Password</label>
						    	<div class="col-md-1"></div>
								<div class="col-md-8">
									<input id="cnewpasswordx" type="password" class="form-control" value="*********">
									<h6><span class="text-danger" id="passwordnotice2"></span></h6>
								</div>
						    </div>
						    <div class="form-group">
						    	<label class="col-md-2 control-label">Email</label>
						    	<div class="col-md-1"></div>
								<div class="col-md-8">
									<input name="newemail" id="newemail" type="text" disabled class="form-control" value="<?php echo $row['email']; ?>">
								</div>
						    </div>
						    <div class="form-group">
						    	<label class="col-md-2 control-label">Email Password</label>
						    	<div class="col-md-1"></div>
								<div class="col-md-8">
									<input name="newemailpassword" id="newemailpassword" type="password" disabled class="form-control" value="12345">
								</div>
						    </div>
						    <div class="form-group" id="cnewemailpassword">
						    	<label class="col-md-2 control-label">Confirm Email Password</label>
						    	<div class="col-md-1"></div>
								<div class="col-md-8">
									<input id="cnewemailpasswordx" type="password" class="form-control" value="12345">
									<h6><span class="text-danger" id="epasswordnotice2"></span></h6>
								</div>
						    </div>
						    <div class="form-group">
						    	<button onclick="hideagain()" id="cancelbtn" class="btn btn-sm btn-raised pull-right btn-danger" type="button">Cancel</button>
						    </div>
						    <div class="form-group">
						    	<button onclick="accountupdatefn()" id="submitbtn" class="btn btn-sm btn-raised pull-right btn-primary" type="button">Submit</button>
						    </div>
						    <div class="form-group">
						    	<button id="changebtn" onclick="enablefunction()" class="btn btn-sm btn-raised pull-right btn-primary" type="button">Change</button>
						    </div>
						</form>
					</div>
				</div>
				<div class="col-md-4">
					<div class="col-md-12 card">
						<legend>  <br> Rollback</legend>
						<div class="form-group">
							<button style="margin-top: 60%;" data-toggle='modal' data-target='#myModal' type="button" name="" class="btn btn-raised btn-danger btn-sm pull-right">Rollback <i class="fa fa-database"></i></button>
						</div>
					<!-- Rollback modal -->
				  	<div id="myModal" class="modal fade" role="dialog">
				 	    <div class="modal-dialog">
					      <div class="modal-content">
					        <div class="modal-header" style="background-color: #ff4d4d">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title" style="color:white">Database Rollback</h4>
					          <p style="color:white">Remove batch of rows of applications <!--from recently uploaded CSV--></p>
					        </div>
					        <div class="modal-body">
						        <div class="form-group">
							 	 	<div class="input-group">
							 	 		<select class="select form-control" name="rollback" id="rollback">
									  		<option value="tbl_application WHERE source='indeed'">Indeed</option>
									  		<option value="tbl_application WHERE source='jobfair'">Job Fair</option>
									  		<option value="tbl_application WHERE source='application'">Application</option>
									  	</select>
										
										<!--select class="select form-control" name="rollback" id="rollback">
									  		<option value="tbl_upload WHERE applicant_source='indeed'">Indeed</option>
									  		<option value="tbl_upload WHERE applicant_source='jobfair'">Job Fair</option>
									  		<option value="tbl_upload WHERE applicant_source='application'">Application</option>
									  	</select-->
										
										<span class="input-group-btn input-group-sm">
											<button onclick= "anotherfunction()" type="button" class="btn btn-sm btn-raised btn-danger">
												<i class="fa fa-backward" title="Click to execute"></i>
											</button>
										</span>
									</div>
								</div>
					      	</div>
						    <div class="modal-footer">
						    	<button type="button" class="btn btn-raised btn-sm btn-default" data-dismiss="modal">Cancel</button>
						    </div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="col-md-12 card">
						<form>
						<legend> <br> Email Setting</legend>
						<div class="form-group">
							<label class="col-md-2 control-label">Default Subject</label>
							<div class="col-md-1"></div>
							<div class="col-md-8">
					        	<input id='newemailsubject' type="text" class="form-control" value="<?php echo $row['email_subject'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Default Message</label>
							<div class="col-md-1"></div>
							<div class="col-md-8">
					        	<textarea id="newemailmessage" class="form-control" style="height: 128px"><?php echo $row['email_message'] ?></textarea>
							</div>
						</div>
						<button onclick="saveemaildefault()" type="button" name="saveemailbtn" class="btn btn-sm btn-raised btn-primary pull-right">Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>

<div id="sureroll" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">    
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ff4d4d">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white">Rollback Database</h4>
      </div>
      <div class="modal-body">
        <p id="fromx">Are you sure you want to delete the recent batch of rows?</p>
      </div>
      <div class="modal-footer">
		<img src="ajax-loader.gif" id="loading-indicator" style="display:none" />
      	<button onclick="rollbackfunction()" class="btn btn-raised btn-danger btn-sm">Yes</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="margin-top: 6%">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!--START-->
	<footer class="panel-footer" style="background-color:#F0F8FF; margin-top:14.1%;">
		<br>
		<center><p style="color: black; font-size:80%">
			Private and Confidential. Anderson Group BPO Inc. &copy; 2017
		</p></center>
		<hr>
	</footer>
<!--END-->

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
		$(document).ready(function() {
        	$(".select").dropdown({"optionClass": "withripple"});
	      	$().dropdown({autoinit: "select"});
			document.getElementById("cnewpassword").style.display = "none";
      		document.getElementById("cancelbtn").style.display = "none";
      		document.getElementById("submitbtn").style.display = "none";
      		document.getElementById("cnewemailpassword").style.display = "none";

			$("#newpassword").keyup(validate);
		  	$("#cnewpasswordx").keyup(validate);
	  		$("#newemailpassword").keyup(validate2);
		  	$("#cnewemailpasswordx").keyup(validate2);

		  	/*document.getElementById('hideme3').style.display = "none";
		  	document.getElementById('hideme2').style.display = "none";*/

			var idleInterval = setInterval(timerIncrement, 60000); // Check every 60 Seconds

		    $(this).mousemove(function (e) {
		        idleTime = 0;
		    });
		    $(this).keypress(function (e) {
		        idleTime = 0;
		    });
		});
		document.addEventListener('touchmove', function(e) {
		    idleTime = 0;
		}, false);
		document.addEventListener('touchstart', function(e) {
		    idleTime = 0;
		}, false);
		function timerIncrement() {
		    idleTime++;
		    if (idleTime == 30) { // minutes
		    	/*<?php  
		    		$_SESSION['loginerror'] = 'You were idle for too long!';
		    	?>*/
		        window.location = 'adminloginpage.php';
		    }
		}
		$.material.init();
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

		function validate() {
		  var cnewpassword = $("#cnewpasswordx").val();
		  var newpassword = $("#newpassword").val();
		  var enewpassword = $("#newemailpassword").val();
		  var cenewpassword = $("#cnewemailpasswordx").val();
	  		if(cnewpassword == newpassword) {
		       $("#passwordnotice2").text("");
		       if(cenewpassword == enewpassword)    {
		       		document.getElementById('submitbtn').disabled = false;
		       }
		    }
		    else {
		        $("#passwordnotice2").text("Passwords do not match!");
		        document.getElementById('submitbtn').disabled = true;
		    }
		}
		function validate2() {
		  var cnewpassword = $("#cnewpasswordx").val();
		  var newpassword = $("#newpassword").val();
		  var enewpassword = $("#newemailpassword").val();
		  var cenewpassword = $("#cnewemailpasswordx").val();

		    if(enewpassword == cenewpassword) {
		       $("#epasswordnotice2").text("");
		       if(newpassword == cnewpassword)    {
		       		document.getElementById('submitbtn').disabled = false;
		       }
		    }
		    else {
		        $("#epasswordnotice2").text("Passwords do not match!");
		        document.getElementById('submitbtn').disabled = true;
		    }
		    
		}

      	function enablefunction(){
      		document.getElementById("changebtn").style.visibility = "hidden";
      		document.getElementById("newusername").disabled = false;
      		document.getElementById("newpassword").disabled = false;
      		document.getElementById("newemail").disabled = false;
      		document.getElementById("newemailpassword").disabled = false;
			document.getElementById('cnewpassword').style.display='block';
      		document.getElementById('cancelbtn').style.display='block';
      		document.getElementById('submitbtn').style.display='block';
      		document.getElementById('submitbtn').disabled = true;
      		document.getElementById("cnewemailpassword").style.display = "block";
      	}
      	function hideagain(){
      		document.getElementById("cnewpassword").style.display = "none";
      		document.getElementById("cancelbtn").style.display = "none";
      		document.getElementById("submitbtn").style.display = "none";
      		document.getElementById("cnewemailpassword").style.display = "none";
      		document.getElementById("newusername").disabled = true;
      		document.getElementById("newpassword").disabled = true;
      		document.getElementById("newemail").disabled = true;
      		document.getElementById("newemailpassword").disabled = true;
      		document.getElementById("changebtn").style.visibility = "visible";
      	}

      	function rollbackfunction(){
      		var selectvalue = document.getElementById("rollback").value;
      		
      		$.ajax({
      			url: "rollback.php",
      			type: "POST",
      			data: {table: selectvalue},
      			success: function(data){
      				$('#sureroll').modal('hide');
      				alert(data);
      			},
      			error: function(data){
      				alert(data);
      			}
      		});

      	}

      	function saveemaildefault(){
      		var newemailmessage = document.getElementById("newemailmessage").value;
      		var newemailsubject = document.getElementById("newemailsubject").value;

      		$.ajax({
      			url: "accountsetting.php",
      			type: "POST",
      			data: {subject: newemailsubject, message: newemailmessage, isset: "email"},
      			success: function(data){
      				alert("Success: "+data);
      			},
      			error:function(data){
      				alert("Fail: " +data);
      			}
      		});
      	}

	  	function accountupdatefn(){
	  		var newusername = document.getElementById('newusername').value;
	  		var newpassword = document.getElementById('newpassword').value;
	  		var newemail = document.getElementById('newemail').value;
	  		var newemailpassword = document.getElementById('newemailpassword').value;
	  		
	  		$.ajax({
	  			url: "accountsetting.php",
	  			type: "POST",
	  			data: {accountupdate: "true",newusername: newusername, newpassword: newpassword, newemail: newemail, newemailpassword: newemailpassword},
	  			success: function(data){
	  				alert(data);
	  				hideagain();
	  			},
	  			error: function(data){
	  				alert(data);
	  			}
	  		});
	  	}
	</script>
	</body>
</html>
