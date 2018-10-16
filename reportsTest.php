<?php
	
	include('auth.php');/*session_start()*/
	include('connect.php');
	$currentYear ="";
	//unset($_SESSION['currentYear']);
	$_SESSION['previous-page'] = 'reports.php';
	$id = $_SESSION['id'];
	$startDate = "2017-01-01";
	$endDate = date('Y-m-d');
	/* if(isset($_POST['startDate'])){
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		unset($_POST['startDate']);
		unset($_POST['endDate']);
	}else{
		$startDate = date('Y-m-d', strtotime('first day of this month'));
		$endDate = date('Y-m-d', strtotime('-1d')); 
	} */
	$currentYear = date('Y',strtotime($endDate)); 
?>
<html>

    <head>
        <title>Reports and Summary</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
        <link rel="stylesheet" type="text/css" href="css/dataTables.material.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <!--<link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">-->
        <link rel="stylesheet" type="text/css" href="css/sidenav.css">

        <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>

    <body style='background-color:#dfe5ec'>
        <style type="text/css">
            .active {
                background-color: #1a1a1a;
            }

            ul {
                list-style-type: none;
            }

            .rightTwoPercent {
                margin-right: 2%;
            }

            #navHead,
            #topDiv {
                background-color: #03a9f4;
            }
        </style>
        <?php 
            include ('sidenavhtml.php');
        ?>
        <script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>

        <!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
        <!-- Inline CSS based on choices in "Settings" tab -->
        <style>
            .bootstrap-iso .formden_header h2,
            .bootstrap-iso .formden_header p,
            .bootstrap-iso form {
                font-family: Arial, Helvetica, sans-serif;
                color: black
            }

            .bootstrap-iso form button,
            .bootstrap-iso form button:hover {
                color: white !important;
            }

            .asteriskField {
                color: red;
            }
        </style>

        <div style="position:fixed;bottom:20px;right:20px;z-index:100;background-color:#f44336;color:#fff;box-shadow:0 1px 6px 0 rgba(0, 0, 0, 0.12), 0 1px 6px 0 rgba(0, 0, 0, 0.12)" id="printReport" class="btn" onclick="save()">Print</div>

        <div id="main">
            <div class="row" style="z-index:1; width:100%; margin-top:-20px; background-color:#dfe5ec;" id='topDiv'>
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid" id='navHead' style='background-color:#dfe5ec;'>
                        <a class="navbar-brand" style="cursor:pointer; z-index:1;" href="#">
                            <h4 style="font-family:'Trebuchet MS', Helvetica, sans-serif; cursor:pointer; z-index:1; color:#00008B;"
                                onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4>
                        </a>
                        <span style=" position:absolute;left:0;right:0;text-align:center;">
                            <h3 style="color:#00008B;">R E P O R T S </h3>
                        </span>
                    </div>
                </nav>
            </div>

            <!--Div that will hold the pie chart-->
            <div class="col-md-12 container">
                <h1 class="text-center">Monthly Applicants</h1>
                <div id="monthlyApplicantsChart"></div>
            </div>

            <div class="col-md-12 container" style="margin: 10% 0 10% 0">
                <h1 class="text-center">Job Title Applicants</h1>
                <div id="jobTitleApplicantsChart"></div>
            </div>

            <div class="col-md-12 container" style="margin: 0 0 10% 0">
                <h1 class="text-center">Age Bracket</h1>
                <div id="ageBracketChart"></div>
            </div>

            <div class="col-md-12 container" style="margin: 0 0 10% 0">
                <h1 class="text-center">Applicant Status</h1>
                <div id="applicantStatusChart"></div>
            </div>

            <div class="col-md-12 container" style="margin: 0 0 10% 0">
                <h1 class="text-center">Applicant Source</h1>
                <div id="applicantSourceChart"></div>
            </div>

            <div class="col-md-12 container" style="margin: 0 0 10% 0">
                <h1 class="text-center">Applicant Locations</h1>
                <div id="applicantLocationsChart"></div>
            </div>

        </div>
    </body>

    <script src="api/js/reportsLogic.js"></script>

    <!-- Side Nav Function -->
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
            document.getElementById("main").style.marginLeft = "300px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</html>