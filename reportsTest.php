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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFyMbzSLvFDAhAuKbi2KtWeqgD2Q9do3c">
    </script>

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

    <!-- Monthly Applicants Function -->
    <!-- <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAnnotations);

        function drawAnnotations() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Applicants');
            data.addColumn({
                type: 'string',
                role: 'annotation'
            });
            data.addColumn('number', 'Quick Apply Applicants');
            data.addColumn({
                type: 'string',
                role: 'annotation'
            });

            data.addRows([
                ['January', 100, '100', 25, '25'],
                ['February', 1170, '1170', 460, '460'],
                ['March', 11700, '11700', 460, '460'],
                ['April', 11220, '11220', 460, '460'],
                ['May', 10470, '10470', 460, '460'],
                ['June', 2050, '2050', 460, '460'],
                ['July', 8170, '8170', 460, '460'],
                ['August', 7170, '7170', 460, '460'],
                ['September', 6170, '6170', 460, '460'],
                ['October', 4170, '4170', 460, '460'],
                ['November', 660, '660', 1120, '1120'],
                ['December', 9030, '9030', 54, '54']
            ]);

            var options = {
                // title: 'Motivation and Energy Level Throughout the Day',
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 14,
                        color: '#000',
                        auraColor: 'none'
                    }
                },
                legend: {
                    position: 'top',
                    alignment: 'center'
                },
                bar: {
                    groupWidth: '70%'
                },
                backgroundColor: 'transparent'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('monthlyApplicantsChart'));
            chart.draw(data, options);
        }
    </script> -->

    <!-- <script type="text/javascript">
        // Monthly Applicants Chart
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Applicants', 'Quick Apply Applicants', { role: 'annotation' }],
            ['January', 1000, 400, ''],
            ['February', 1170, 460, ''],
            ['March', 1170, 460, ''],
            ['April', 1170, 460, ''],
            ['May', 1170, 460, ''],
            ['June', 1170, 460, ''],
            ['July', 1170, 460, ''],
            ['August', 1170, 460, ''],
            ['September', 1170, 460, ''],
            ['October', 1170, 460, ''],
            ['November', 660, 1120, ''],
            ['December', 1030, 54, '']
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);

        var options = {
            title: 'Monthly Applicants',
            subtitle: 'Applicants and Quick Apply Applicants, 2018',
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 14,
                        color: '#000',
                        auraColor: 'none'
                    }
                },
            chart: {
                // title: 'Monthly Applicants',
                // subtitle: 'Applicants and Quick Apply Applicants, 2018',
                // alignment: 'center'
            },
            series: {
                0: {
                    color: 'blue',
                    visibleInLegend: true,
                    annotations: {
                        textStyle: {
                            fontSize: 100,
                            color: 'red'
                        }
                    }
                },
                1: {
                    color: 'red',
                    visibleInLegend: true
                }
            },
            legend: {
                alignment: 'center'
            },
            height: 700,
            backgroundColor: 'transparent'
        };

        var chart = new google.charts.Bar(document.getElementById('monthlyApplicantsChart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script> -->

    <!-- Age Bracket Function -->
    <script type="text/javascript">
        // Age Bracket Chart
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Month", "Applicants", {
                    role: "style"
                }],
                ["18-25", 100, "color: #17A398; fill-opacity: 0.7; stroke-color: black; stroke-width: 2; stroke-opacity: .5;"],
                ["26-30", 200, "color: #17A398; fill-opacity: 0.7; stroke-color: black; stroke-width: 2; stroke-opacity: .5;"],
                ["31-35", 300, "color: #17A398; fill-opacity: 0.7; stroke-color: black; stroke-width: 2; stroke-opacity: .5;"],
                ["36-42", 400, "color: #17A398; fill-opacity: 0.7; stroke-color: black; stroke-width: 2; stroke-opacity: .5;"],
                ["42-50", 500, "color: #17A398; fill-opacity: 0.7; stroke-color: black; stroke-width: 2; stroke-opacity: .5;"],
                ["51 and up", 600, "color: #17A398; fill-opacity: 0.7; stroke-color: black; stroke-width: 2; stroke-opacity: .5;"]
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                // title: "Monthly Applicants",
                bar: {
                    groupWidth: "80%"
                },
                legend: {
                    position: "none"
                },
                backgroundColor: 'transparent',
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("ageBracketChart"));
            chart.draw(view, options);
        }
    </script>

    <!-- <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                ['.NET Developer', 4],
                ['Accountant', 1],
                ['Admin Assistant', 1],
                ['Asst. Project Manager', 1],
                ['Bookkeeper', 1],
                ['Business Development Manager', 1],
                ['Content Writer', 1],
                ['Contract Center Agent', 1],
                ['CSR - English', 1],
                ['CSR - Mandarin', 1],
                ['CSR Recruitment Outsourcing', 1],
                ['Customer Service Representative', 1],
                ['Dynamics CRM Developer', 1],
                ['Email Marketing Specialist', 1],
                ['Finance Manager', 1],
                ['Finance Officer', 1],
                ['Front End Web and HTML Designer', 1],
                ['H.R', 1],
                ['H.R Assistant', 1],
                ['H.R Associate', 1],
                ['H.R Manager', 1],
                ['Intern', 1],
                ['IT Admin', 1],
                ['IT Help desk', 1],
                ['IT Help desk Manager', 1],
                ['IT Help desk Team Lead', 1],
                ['IT Manager', 1],
                ['IT Telesales Lead', 1],
                ['Jr. IT Admin', 1],
                ['Lead Gen Specialist', 1],
                ['Lead Gen Team Manager', 1],
                ['Lead Gen: Data Analyst', 1],
                ['Lead Generation Specialist', 1],
                ['Lead Verification Specialist', 1],
                ['Marketing Assistant', 1],
                ['Marketing Associate', 1],
                ['Marketing Manager', 1],
                ['Marketing Research Analyst', 1],
                ['Marketing Specialist', 1],
                ['Online Content Coordinator', 1],
                ['Operations Manager', 1],
                ['Other', 1],
                ['Outbound Sales Rep.', 1],
                ['Product and Customer Data Integrity Officer', 1],
                ['Product and Customer Database Updating Officer (Ph', 1],
                ['Project Manager', 1],
                ['Recruitment Assistant (RPO)', 1],
                ['Recruitment Assistant – Team Leader (RPO)', 1],
                ['Reports Analyst', 1],
                ['Research and Lead Gen Analyst', 1],
                ['Researcher and Lead Generation Agent', 1],
                ['Sales Lead Generation Specialist', 1],
                ['Senior .Net Developer', 1],
                ['Senior Software Developer', 1],
                ['Shopify Developer', 1],
                ['Social Content Manager', 1],
                ['Software Developer', 1],
                ['Team Lead', 1],
                ['Telesales Agent', 1],
                ['Virtual Assistant', 1],
                ['Virtual Assistant - Team Lead', 1],
                ['Web Developer', 1]
            ]);

            // Set chart options
            var options = {
                // 'title': 'How Much Pizza I Ate Last Night',
                'legend': {
                    position: 'top', alignment: 'center'
                },
                // 'width': 400,
                'height': 700,
                'is3D': false,
                pieHole: 0.1,
                backgroundColor: 'transparent',
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('jobTitleApplicantsChart'));
            chart.draw(data, options);
        }
    </script> -->

    <!-- Applicant Status Function -->
    <!-- <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Status');
            data.addColumn('number', 'Applicants');
            data.addRows([
                ['Pending', 3],
                ['No Show', 1],
                ['Interview', 1],
                ['Fail/Reject', 1],
            ]);

            // Set chart options
            var options = {
                // 'title': 'How Much Pizza I Ate Last Night',
                'legend': {
                    position: 'top', alignment: 'center'
                },
                // 'width': 400,
                'height': 700,
                'is3D': true,
                backgroundColor: 'transparent',
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('applicantStatusChart'));
            chart.draw(data, options);
        }
    </script> -->

    <!-- Applicant Source Function Function -->
    <!-- <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            dataApplicantSource = new google.visualization.DataTable();
            dataApplicantSource.addColumn('string', 'Source');
            dataApplicantSource.addColumn('number', 'Applicants');
            dataApplicantSource.addRows([
                ['Jobstreet', 3],
                ['Linked In', 3],
                ['Facebook', 3],
                ['Referral', 3],
                ['AndersonGroup Site', 1],
                ['Application', 1],
                ['Jobfair', 1],
                ['Indeed', 1],
            ]);

            // Set chart options
            var options = {
                // 'title': 'How Much Pizza I Ate Last Night',
                'legend': {
                    position: 'left', alignment: 'center'
                },
                // 'width': 400,
                'height': 700,
                'is3D': true,
                backgroundColor: 'transparent',
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('applicantSourceChart'));
            chart.draw(dataApplicantSource, options);
        }
    </script> -->

    <!-- Applicant Location Function -->
    <!-- <script>
        google.charts.load('current', {
            'packages': ['map']
        });
        google.charts.setOnLoadCallback(drawMap);

        function drawMap() {
            var data = google.visualization.arrayToDataTable([
                ['Lat', 'Long', 'Name'],
                // [14.6091, 121.0223, 'NCR'],
                [14.5764, 121.0851, 'Pasig'],
                [14.5547, 121.0244, 'Makati'],
                [14.6507, 121.1029, 'Marikina'],
                [14.5794, 121.0359, 'Mandaluyong'],
                [14.6760, 121.0437, 'Quezon'],
                [14.7566, 121.0450, 'Caloocan'],
                [14.5378, 121.0014, 'Pasay'],
                [14.4793, 121.0198, 'Parañaque'],
                [14.4081, 121.0415, 'Muntinlupa'],
                [14.4445, 120.9939, 'Las Piñas'],
                [14.5176, 121.0509, 'Taguig'],
                [16.0832, 120.6200, 'Ilocos Region'],
                [16.9754, 121.8107, 'Cagayan Valley'],
                [15.4828, 120.7120, 'Central Luzon'],
                [14.1008, 121.0794, 'CALABARZON'],
                [9.8432, 118.7365, 'MIMAROPA'],
                [13.4210, 123.4137, 'Bicol Region'],
                [11.0050, 122.5373, 'Western Visayas'],
                [9.8169, 124.0641, 'Central Visayas'],
                [12.2446, 125.0388, 'Estern Visayas'],
                [8.1541, 123.2588, 'Zamboanga Peninsula'],
                [8.0202, 124.6857, 'Northern Mindanao'],
                [7.3042, 126.0893, 'Davao Region'],
                [6.2707, 124.6857, 'SOCCSKSARGEN'],
                [8.8015, 125.7407, 'CARAGA'],
                [6.9568, 124.2422, 'ARMM'],
                [17.3513, 121.1719, 'Cordillera Administrative Region'],
            ]);
            var options = {
                height: 700,
                mapType: 'normal',
                showTooltip: true,
                showInfoWindow: true
            };

            var map = new google.visualization.Map(document.getElementById('applicantLocationsChart'));

            map.draw(data, options);
        };
    </script> -->
</html>