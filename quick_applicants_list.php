<?php
	include('auth.php');/*session_start()*/
	$_SESSION['previous-page'] = 'google.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Application List</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.material.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/sidenav.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker3.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.min.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
	<link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/buttons.dataTables.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="custom_css/quick_apply_applicants.css">

</head>

<body style='background-color: white'>
	<?php  header('Content-Type: text/html; charset=ISO_8859-1'); ?>
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

		#ulPrint div a,
		#ulSave div a {
			padding: 0;
			border: none;
			background: none;
		}

		#ulPrint div a span,
		#ulSave div span {
			float: left;
		}
	</style>
	<?php  
		include('sidenavhtml.php');
	?>


	<div id="main">
		<nav style="width:103.25%; margin-top:-2%; margin-left:-2%; background-color:#F0F8FF;">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li data-toggle="dropdown-toggle"><a data-toggle='modal'>
							<h4 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px; padding-right:10px; padding-left: -10px"
							    onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4>
						</a></li>
				</ul>
			</div>
		</nav>

		<div class="row">
			<!--Status Change-->
			<div class="col-md-12"><br><br>
				<div id='myData'>
					<center>
						<h3 style="font-weight: bold;margin-bottom: 2%;margin-top:-2%;">Quick Apply Applicant List</h3>
					</center>
					<table name="" id="myTable" class="table table-bordered table-hover table-responsive" style="width:100%; ">
						<thead>
							<col width="200">
							<tr>
								<th>ID</th>
								<th>Position Applying</th>
								<th>Name</th>
								<th>Mobile Number</th>
								<th>Graduate/Undergraduate</th>
								<th>Course</th>
								<th>Finished Year</th>
								<th>Recent Company</th>
								<th>Recent Position</th>
								<th>BPO Experience</th>
								<th>Related Experience in Position</th>
							</tr>
						</thead>
						<?php  
						include('connect.php');
						$sql = "SELECT * FROM tbl_quick_applications ORDER BY id";
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
					?><tbody>
						<tr>
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['position'];?></td>
							<td><?php echo $row['lastname'] . ', ' . $row['firstname'] ;?></td>
							<td><?php echo $row['mobile_number'];?></td>
							<td><?php echo $row['graduate_undergraduate'];?></td>
							<td><?php echo $row['course'];?></td>
							<td><?php echo $row['finished_year'];?></td>
							<td><?php echo $row['recent_company'];?></td>
							<td><?php echo $row['recent_position'];?></td>
							<td><?php echo $row['bpo_experience'];?></td>
							<td><?php echo $row['related_experience_in_position'];?></td>
						</tr>
						<?php
                            }
                            }
                            $conn->close();
                            ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div style="position:fixed;bottom:25px;right:25px">
			<a class="getCSV">Save as CSV</a>
			<!-- <a class="getExcel" onclick="window.open('data:application/vnd.ms-excel,' + document.getElementById('myTable').outerHTML.replace(/ /g, '%20'));">Save as Excel</a> -->
		</div>
	</div>

	<footer class="panel-footer" style="background-color:#F0F8FF;">
		<center>
			<p style="color: black; font-size:90%">
				Private and Confidential. Anderson Group BPO Inc. &copy; 2017
			</p>
		</center>
	</footer>
	<!--END-->

	<script type="text/javascript" src="js/tether.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/buttons.Html5.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/material.js"></script>
	<script type="text/javascript" src="js/buttons.print.min.js"></script>
	<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="js/dataTables.tableTools.min.js"></script>
	<script type="text/javascript" src="js/dataTables.material.js"></script>
	<script type="text/javascript" src="js/dataTables.select.min.js"></script>
	<script type="text/javascript" src="js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>
	<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
	<script type="text/javascript">
		$('.clockpicker').clockpicker();
	</script>
	<script type="text/javascript" src="js/csv.js"></script>
	<script type="text/javascript">
		$('.getCSV').click( function() { 
			exportTableToCSV.apply(this, [$('#myTable'), 'quickApplyApplicants.csv']);
		});
	</script>

	<script type="text/javascript">
		function openNav() {
			document.getElementById("mySidenav").style.width = "300px";
			document.getElementById("main").style.marginLeft = "300px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft = "0";
		}
		setTimeout(function () {
			$('#removeme').fadeOut();
			<?php unset($_SESSION['uploadnotice']);
		  		unset($_SESSION['queryerror']); ?>
		}, 5000);
	</script>
</body>

</html>