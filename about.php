<?php
	include('auth.php');/*session_start()*/
	$_SESSION['previous-page'] = 'google.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Application List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    
	<!-- <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.material.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/sidenav.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker3.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-timepicker.min.css">
	<link rel = "stylesheet" type = "text/css" href = "css/dataTables.tableTools.min.css">
	<link rel = "stylesheet" type = "text/css" href = "css/dataTables.tableTools.css">
	<link rel = "stylesheet" type = "text/css" href = "css/buttons.dataTables.min.css">
	<link rel = "stylesheet" type = "text/css" href = "css/buttons.dataTables.css">
	<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.min.css">

	</head>
<body style = 'background-image: url("bg2.jpg");background-size:cover;background-repeat:no-repeat;'>
<style type="text/css">
.sb-search {
	position: relative;
	margin-top: 10px;
	width: 0%;
	min-width: 60px;
	height: 60px;
	float: right;
	overflow: hidden;

	-webkit-transition: width 0.3s;
	-moz-transition: width 0.3s;
	transition: width 0.3s;

	-webkit-backface-visibility: hidden;
}
#myTable tr.selected {
background-color: #83b4ef !important; //color when selected
}

	.active {
		background-color: white;
	}
	ul {
	  list-style-type: none;
	}
		#bgImg {
		
		  position: absolute;
		  top: 1%;
		  left: 8%;
		  right: 5%;
		  z-index: 0;
		  background-attachment: fixed;
		  background-position: center;

 
	}
	
#ulPrint div a, #ulSave div a{
	padding: 0;
border: none;
background: none;

}
	
	#ulPrint div a span, #ulSave div span{
	float: left;

}
</style>
	<?php  
		

	$id = isset($_GET['id']) ? $_GET['id'] : ' ';
	include 'sidenavhtml.php';
	?>
	<div id="main" >
        <nav style="width:103.25%; margin-top:-2%; margin-left:-2%; background-color:transparent">
			 <div class="container-fluid">
				<ul class="nav navbar-nav">
				  <h4 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:10px; padding-right:10px; padding-left:10px" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4>
				</ul>
            </div>
        </nav>
        <div class="col-sm-2"></div>
        <div class="col-sm-8" style="margin-top:1em; ">
					<br><br><br><div class="col-md-12 card">
						<img src="ag.png" alt="andersonrecruitlogo.png" style="width:75%;height:75%; margin-top:2em; margin-left:8em;"/>
						<div class="modal-body" style="text-align: justify;text-justify: inter-word;font-size:14px;">
                            <!--Anderson Recruitment Management System (ARMS)-->
                            
				<p>&nbsp &nbsp &nbsp Anderson Recruits is an online recruitment system which can be accessed by corporate recruiters via web browsers anytime.The system offers sophisticated features such as real-time online application form, candidate search etc. What's more, a powerful filtering technology is incorporated to let HR professionals screen out unqualified candidates and reduce their workload. With the Candidate Alert technology and customizable searching criteria, the system will automatically search on the database for the newly registered job seekers and alert the users to ensure that they don’t miss out on any talents. The Human Resources department implemented this system in order to automate many of the tasks of the application process.</p>
					<CENTER>
						<p style="font-size:12px;"><strong>Arth Da&ntilde;o &nbsp|&nbsp
						John Loyd Camince &nbsp|&nbsp
						Edward John Flores &nbsp|&nbsp
						Carby Leonor &nbsp|&nbsp
						Raiven Kenn Lopez  &nbsp|&nbsp
                        Jomariette Kristine Suarez  &nbsp|&nbsp
                        Neco Caramonte &nbsp|&nbsp
                    	Mark Arjel Cabais &nbsp|&nbsp
                    	John Edrell Abong &nbsp|&nbsp
                    	Bryan Diola
                    	</strong></p></br>
					</CENTER>
                        <h6 class="text-muted" align="center">Version 3.0</h6>
					</div>
						
					</div>
				</div>
        <div class="col-sm-2"></div>
    </div>

	<!--START-->
	<footer class="panel-footer" style="background-color:#F0F8FF; margin-top:44.1%;">
		<center><p style="color: black; font-size:90%">
			Private and Confidential. Anderson Group BPO Inc. &copy; 2017
		</p></center>
	</footer>
	<!--END-->

	<script type="text/javascript">

		function openNav() {
		    document.getElementById("mySidenav").style.width = "300px";
		    document.getElementById("main").style.marginLeft = "300px";
		}
		function closeNav() {
		    document.getElementById("mySidenav").style.width = "0";
		    document.getElementById("main").style.marginLeft= "0";
		}
		setTimeout(function(){
		  $('#removeme').fadeOut();
		  <?php unset($_SESSION['uploadnotice']);
		  		unset($_SESSION['queryerror']); ?>
		}, 5000);
		
	</script>
</body>
</html>