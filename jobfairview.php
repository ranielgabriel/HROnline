<?php 
	include('auth.php');
	include('connect.php');

	$id = $_GET['idjf'];
	$sql = "SELECT * FROM tbl_applicant2 WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo ucfirst($row['Name']); ?> 's Application</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' href='css/bootstrap.css'>
	<link rel='stylesheet' type='text/css' href='css/bootstrap-material-design.css'>
	<link rel='stylesheet' type='text/css' href='css/dataTables.material.css'>
	<link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel='stylesheet' type='text/css' href='css/sidenav.css'>
	<style type='text/css'>
		.active {
			background-color: #494949;
		}
		label{
			color: grey;
			font-style: italic;
		}
		p{
			font-weight: 500;
		}
		.printbreak{
			page-break-before: always;
		}
	</style>
</head>
<body class="container-fluid">
	<div class='row'>
		<div class='col-xs-8'>
		<h3 style='margin-top:5%'>APPLICATION FORM</h3>
		<?php echo ucfirst($row['Name']); ?>'s Applciation form </br>
		</div>
		<div class='col-xs-4'>
			<img class='img-responsive pull-right' src='ag.png' width='110%' height='100px' style='margin-top:5%;'/>
		</div>
	</div>
	<hr>

	<div class='row'>
		<div class='card col-xs-12'>
			<div class='col-xs-6'>
				<label class='control-label'>Name</label>
				<h6><?php echo ucfirst($row['Name']); ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Age</label>
				<h6><?php echo ucfirst($row['Age']); ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Gender</label>
				<h6><?php echo ucfirst($row['Gender']); ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Address</label>
				<h6><?php echo ucwords($row['Address']); ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Degree</label>
				<h6><?php echo ucwords($row['Degree']); ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Course</label>
				<h6><?php echo ucfirst($row['Course']); ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Contact Number</label>
				<h6><?php 
					echo $row['Globe'];
					if(!empty($row['Smart'])){
						echo " | ".$row['Smart'];
					}
					?>
				</h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Email</label>
				<h6><?php echo $row['Email']; ?></h6>
			</div>
			<div class='col-xs-6'>
				<label class='control-label'>Expertise</label>
				<h6><?php echo ucfirst($row['Expertise']); ?></h6>
			</div>
			<?php
				$recentjob = "";
				if(!empty($row['Recent Company'])){
					$recentjob = "<div class='col-xs-6 row'>
									<div class='col-xs-4'>
										<label class='control-label'>Recent Company</label>
										<h6>".$row['Recent Company']."</h6>
									</div>
									<div class='col-xs-4'>
										<label class='control-label'>Recent Position</label>
										<h6>".$row['Recent Position']."</h6>
									</div>
									<div class='col-xs-4'>
										<label class='control-label'>Recent Duration</label>
										<h6>".$row['Recent Duration']."</h6>
									</div>
								</div>";
				}
				$position = "";
				if(!empty($row['Positiontoapply'])){
					$position = $row['Positiontoapply'];
				}
				if(!empty($row['Positiontoapply2'])){
					$position .= " | ".$row['Positiontoapply2'];
				}
				if(!empty($row['Positiontoapply3'])){
					$position .= " | ".$row['Positiontoapply3'];
				}
			?>
			<?php echo $recentjob; ?>

			<div class='col-xs-6'>
				<label class='control-label'>Position Applying for</label>
				<h6><?php echo $position; ?></h6>
			</div>
		</div>
	</div>
	<button style='position: fixed; bottom: 5px; right: 10px;' onclick='window.print();' class='btn btn-raised pull-right hidden-print btn-info'><i class='fa fa-print'></i> Print</button>
</body>
</html>