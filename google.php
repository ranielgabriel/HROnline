<?php

	include('auth.php');/*session_start()*/
	$_SESSION['previous-page'] = 'google.php';
	$id = isset($_GET['id']) ? $_GET['id']:'';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Application List</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="shortcut icon" href="favicon.ico" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1; charset=UTF-8">
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

<?php
	$id = $_SESSION['id'];
	include('connect.php');
	$sql = "SELECT * FROM tbl_admin WHERE id = '$id'";
	$result = $conn->query($sql);
	$adminAccountInfo = $result->fetch_assoc();
	echo '<script>console.log('.json_encode($adminAccountInfo).')</script>';
?>
	</head>

<body style = 'background-color: white'>
 <?php  header('Content-Type: text/html; charset=ISO_8859-1'); ?>
<style type="text/css">
.showhidden{
	pointer-events: none;
}
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
		include('sidenavhtml.php');

		if(!empty($_SESSION['queryerror'])){
			//unset($_SESSION['query']);
			echo"<div id = 'removeme' class='alert alert-dismissible alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>×</button>
					<p style='text-align:center;'><i class = 'fa fa-warning'></i> ".$_SESSION['queryerror']."</p>
					</div>";
		}
		if(!empty($_SESSION['uploadnotice'])){
			if(strpos($_SESSION['uploadnotice'], 'rows successfully uploaded') !== false){
				$noticeclass = 'alert alert-dismissible alert-success';
			}else{
				$noticeclass = 'alert alert-dismissible alert-danger';
			}
			echo"<div id = 'removeme' class='".$noticeclass."'>
					<button type='button' class='close' data-dismiss='alert'>×</button>
					<p style='text-align:center;'><i class = 'fa fa-warning'></i> ".$_SESSION['uploadnotice']."</p>
					</div>";
		}
	?>
	<div id="main" >
			    <div id='refreshthis'>
					<?php
						include('connect.php');
						$sql = "select (select COUNT(*) from tbl_application where  (DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 and `Status` = 'Pending') or `Status` in('No Show','Rejected', 'Declined','Fail','Failed','failed') or `Status` like '%Interview%' or `Status` like '%Hired%' ) 
						+ (select COUNT(*) FROM tbl_application where source='jobfair' AND (DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 and `Status` = 'Pending') or `Status` in('No Show','Rejected', 'Declined','Fail','Failed','failed') or `Status` like '%Interview%' ) as 'total', (select (select SUM(CASE WHEN Status = 'Pending' and  DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 THEN 1 ELSE 0 END) from tbl_application)) as 'Pending',

						(select (select SUM(CASE WHEN Status = 'Initial Interview' THEN 1 ELSE 0 END) from tbl_application)) as 'Initial Interview',

						(select (select SUM(CASE WHEN Status = 'Second Interview' THEN 1 ELSE 0 END) from tbl_application)) as 'Second Interview',

						(select (select SUM(CASE WHEN Status = 'Third Interview' THEN 1 ELSE 0 END) from tbl_application)) as 'Third Interview',

						(select (select SUM(CASE WHEN Status = 'Final Interview' THEN 1 ELSE 0 END) from tbl_application)) as 'Final Interview',

						(select (select SUM(CASE WHEN Status like '%Hired%' THEN 1 ELSE 0 END) from tbl_application)) as 'Hired',

						(select (select SUM(CASE WHEN lcase(Status) like '%fail%'  THEN 1 ELSE 0 END) from tbl_application)) as 'Fail',

						(select (select SUM(CASE WHEN Status = 'Rejected' THEN 1 ELSE 0 END) from tbl_application)) as 'Rejected',

						(select (select SUM(CASE WHEN Status = 'Declined' THEN 1 ELSE 0 END) from tbl_application)) as 'Declined',

						(select (select SUM(CASE WHEN Status = 'No Show' THEN 1 ELSE 0 END) from tbl_application)) as 'No Show',

						(select (select COUNT(*) from tbl_application where not (DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 and `Status` = 'Pending') and  `Status` not in('No Show','Rejected', 'Declined','Fail','Failed','failed') and  `Status` not like '%Interview%' and  `Status` not like '%Hired%' )) as 'Archived'

						";

						$result = $conn->query($sql);

						$row = $result->fetch_assoc();

					?>

				</div>

			<nav style="width:103.25%; margin-top:-2%; margin-left:-2%; background-color:#F0F8FF;">

			  <div class="container-fluid">

				<ul class="nav navbar-nav">

				  <li data-toggle="dropdown-toggle"><a data-toggle='modal'><h4 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px; padding-right:10px; padding-left: -10px" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4></a></li>

				  

				  <li class="dropdown "><a data-toggle="dropdown" href="#" ><h4 style ="color:gray; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px;">File</h4></span></a>

								<ul class="dropdown-menu ">

								<li><a href = '#' data-toggle='modal' data-target='#myModal' >Upload</a></li>

								<li><a>Print</a>

									<ul id = 'ulPrint'></ul>

								</li>

								<li  ><a id = 'ulSave'></a>

									<ul></ul>

								</li>

								</ul>

				  </li>

				  <li class="dropdown" ><a data-toggle="dropdown" href="#" ><h4 style ="color:gray; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px;">Application Status</h4> </span></a>

							  <ul class="dropdown-menu">

								<li><a href="google.php?show=''&id=<?php echo $id;?>">All (<?php echo $row['total'] ?>)</a></li>

								<li><a href="google.php?show=Pending&id=<?php echo $id;?>">Pending (<?php echo $row['Pending'] ?>)</a></li>

								<li><a href="google.php?show=Initial Interview&id=<?php echo $id;?>">Initial Interview (<?php echo $row['Initial Interview'] ?>)</a></li>

								<li><a href="google.php?show=Second Interview&id=<?php echo $id;?>">Second Interview (<?php echo $row['Second Interview'] ?>)</a></li>

								<li><a href="google.php?show=Third Interview&id=<?php echo $id;?>">Third Interview (<?php echo $row['Third Interview'] ?>)</a></li>

								<li><a href="google.php?show=Final Interview&id=<?php echo $id;?>">Final Interview (<?php echo $row['Final Interview'] ?>)</a></li>

								<li><a href="google.php?show=Hired&id=<?php echo $id;?>">Hired(<?php echo $row['Hired'] ?>)</a></li>

								<!--<li><a href="google.php?show=Fail">Fail (<?php echo $row['Fail'] ?>)</a></li>-->

								<li><a href="google.php?show=No Show&id=<?php echo $id;?>">No Show (<?php echo $row['No Show'] ?>)</a></li>

								<li><a href="google.php?show=Rejected&id=<?php echo $id;?>">Rejected (<?php echo $row['Rejected'] ?>)</a></li>

								<li><a href="google.php?show=Declined&id=<?php echo $id;?>">Declined (<?php echo $row['Declined'] ?>)</a></li>

								<li><a href="google.php?show=Archived&id=<?php echo $id;?>">Archived (<?php echo $row['Archived'] ?>)</a></li>

							  </ul>

				  </li>

					<li class="dropdown"><a data-toggle="dropdown" href="#"><h4 style = 'color:gray; font-family:"Trebuchet MS", Helvetica, sans-serif; padding-top:5px;'>Show/Hide Column</h4> </span></a>

						<ul class="dropdown-menu">

						<li><a class = "showHideColumn" href="#"data-columnindex="1">Name<input type = 'checkbox'style ='float:right;'class ='ddcheckbox'></input></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="2">Reference Code<input type = 'checkbox'style ='float:right;'class ='ddcheckbox deact'></input></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="3">Course<input type = 'checkbox' style ='float:right'class ='ddcheckbox deact'></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="4">Email<input type = 'checkbox' style ='float:right'class ='ddcheckbox'></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="5">Phone<input type = 'checkbox' style ='float:right'class ='ddcheckbox deact'></a></li>

						<li><a class = "showHideColumn " href="#"data-columnindex="6">Address<input type = 'checkbox' style ='float:right'class ='ddcheckbox'></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="7">Age<input type = 'checkbox' style ='float:right'class ='ddcheckbox'></a></li>

						<li><a class = "showHideColumn"href="#" data-columnindex="8">Job Title<input type = 'checkbox' style ='float:right'class ='ddcheckbox deact'></a></li>

						<li><a class = "showHideColumn " href="#"data-columnindex="9">Previous Jobs<input type = 'checkbox' style ='float:right'class ='ddcheckbox'></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="10">Schedule<input type = 'checkbox' style ='float:right'class ='ddcheckbox'></a></li>

						<li><a class = "showHideColumn" href="#"data-columnindex="11">Note<input type = 'checkbox' style ='float:right'class ='ddcheckbox'></a></li>

						</ul>

					</li>

					<!--START-->

					<li>
					    <?php
						$id = isset($_GET['id']) ? $_GET['id'] : ' ';
						echo'
						<style>
						h4{
							color:gray;
							font-family:Trebuchet MS;
							Helvetica;
							sans-serif; 
							padding-top:5px;
						}
						</style>
						<a href="ViewInterviewStatus.php?id='.$id.'"><h4>View Interview Status</h4></a>';
						?>
					</li>

					<li>
                        <?php
						$id = isset($_GET['id']) ? $_GET['id'] : ' ';
						echo'
						<style>
						h4{
							color:gray;
							font-family:Trebuchet MS;
							Helvetica;
							sans-serif; 
							padding-top:5px;
						}
						</style>
						<a href="vis.php?id='.$id.'"><h4>Exam Results</h4></a>';
						?>

					</li>

					<!--END-->

				</ul>

				</div>

			</nav>



	<div class="row"><!--Status Change-->

		<div class="col-md-12">

			<div class="" id='googlecontainer'>

				<!--h5 style="text-align:center;"></h5-->

				<div class="dropdown" style='z-index: 1' id ='statusDropdown'>

					<a id='withselected' href="#"  style = 'background-color: #00008B;'class="btn btn-danger   btn btn-sm btn-raised dropdown-toggle" data-toggle="dropdown">

					<i <i class="fa fa-toggle-down"></i></i>

					Change Status

					</a>

					<ul class="dropdown-menu" id = 'ulStatus'>

						<li class="dropdown-header">Change stage to:</li>

						<li id='InitialInterview' style = "position:absolute; visibility:hidden;" class= "openOveride"><button class=' btn btn-default' data-toggle='modal' data-target ='#interviewModal' data-type='Initial Interview'><i class="fa fa-users"></i> Initial Interview</button></li>

						<li id='SecondInterview'style = "position:absolute; visibility:hidden;" class= "openOveride"><button class=' btn btn-default' data-toggle='modal' onclick = 'setValValue("Second Interview")' data-target ='#interviewModal' data-type='Second Interview'><i class="fa fa-users"></i> Second Interview</button></li>

						<li id='ThirdInterview'style = "position:absolute; visibility:hidden;" class= "openOveride"><button class=' btn btn-default' data-toggle='modal' onclick = 'setValValue("Third Interview")'data-target ='#interviewModal' data-type='Third Interview'><i class="fa fa-users"></i> Third Interview</button></li>

						<li id='FinalInterview'style = "position:absolute; visibility:hidden;"class= "openOveride"><button class=' btn btn-default' data-toggle='modal' onclick = 'setValValue("Final Interview")'data-target ='#interviewModal'data-type='Final Interview'><i class="fa fa-users"></i> Final Interview</button></li>			

						<li id='HireAccept'style = "position:absolute; visibility:hidden;"class= "openOveride"><button class=' btn btn-default' data-toggle='modal' data-target =''data-type='hiredAccepted'><i class="fa fa-handshake-o"></i> Hired</button></li>

						<li><button style="color:red" class='actionbtn btn btn-default' data-type='Rejected' data-hcolor='white' data-content="Are you sure you want to reject the selected application/s?" data-headerx="Reject Application<br><h6><i class='fa fa-warning'></i></h6>" data-headercolor='#ff4d4d'><i class="fa fa-warning"></i> Reject</button></li>

						<li><button style="color:red" class= 'btn btn-default' data-type='Declined' data-hcolor='white' data-toggle='modal' data-target='#declineModal' data-headerx="Decline Application<br><h6><i class='fa fa-ban'></i></h6>" data-headercolor='#ff4d4d'><i class="fa fa-ban"></i> Decline</button></li>
						
						<li><button class='actionbtn2 btn btn-danger openOveride' data-type='No Show' style = "position:absolute; visibility:hidden;"><i class="fa fa-eye-slash"></i> No Show</button></li>

						<li></li>

						<li class="dropdown-header">Change status to:</li>

						<li><button  class='actionbtn2 btn btn-default openOveride' data-type='Passed - Endorsed' style = "position:absolute; visibility:hidden;"><i class="fa fa-check fa-check-o"></i>Passed - Endorsed</button></li>

						<li><button  class='actionbtn2 btn btn-default openOveride' data-type='Failed' style = "position:absolute; visibility:hidden;"><i class="fa fa-close"></i>Failed</button></li>

						<li><button  class='actionbtn2 btn btn-default openOveride' data-type='Passed' style = "position:absolute; visibility:hidden;"><i class="fa fa-check"></i>Passed</button></li>
						<li></li>

						<li id = 'override'><button style="color:green" class=' btn btn-default'  >@<i class="fa fa-default"></i> Override</button></li>

					</ul>

				</div>

			</div>

				<!--h5 style="text-align:center;"></h5-->

				<div id = 'myData'>

				<table name="" id="myTable" class="table table-striped table-hover" style="width:100%;">

					<thead>

						<tr>

							<th>Select</th>

							<th>Name</th>

							<th>Reference Code</th>

							<th>Course</th>

							<th>Email</th>

							<th>Phone</th>

							<th>Address</th>

							<th>Age</th>

							<th>Job Title</th>

							<th>Previous Jobs</th>

							<th>Schedule</th>

							<th>Note</th>

							<th>Stage</th>

							<th>Status</th>

							<th>Action</th>

						</tr>

					</thead>

					<tbody>

						<?php  

							include('connect.php');

							include('noShow.php');

							$setSession = 0;

							if(!empty($_SESSION['googlequery']) && !isset($_GET['show'])){

								$sql = $_SESSION['googlequery'];	

								unset($_SESSION['queryerror']);

								unset($_SESSION['googlequery']);

								$setSession += 1;

							}else{

								$sql = "SELECT tbl_application.ID as 'ID',

											`NAME` as `Name`,

											`reference_no` as `ReferenceCode`,

											`Timestamp` as 'Timestamp',

											`Email Address` as 'Email',

											`Contact No.` as 'Contact Number',

											tbl_application.`status` as 'Status',

											`Current Address` as 'Address',

											concat(`3.2 Position Title`, ' ', `2.2 Position Title`,' ',`1.2 Position Title`,' ',`4.2 Position Title`) as 'PreviousJobs',

											`Col_degree Course` as 'Course',

											(select `position_name` from tbl_position where `id` = `Position`) as 'Job Title',

											'tbl_application' as 'Source',

											`Age` as 'Age',

											`Note` as 'note',

											(CASE 

											  WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''

											  ELSE SCHEDULE

											END) as `schedule`,

											(Select tbl_interview.Status from tbl_interview where tbl_interview.ReferenceNo = tbl_application.reference_no and tbl_interview.InterviewStage = tbl_application.status limit 1) as 'Stage'

									FROM tbl_application";

							}

								

							if($setSession==0){

								if(isset($_GET['show']) && $_GET['show'] == 'Pending'){

									$sql = $sql." WHERE tbl_application.Status = 'Pending' and DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60";

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Initial Interview'){

									$sql = $sql." WHERE tbl_application.Status = 'Initial Interview'  ";							

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Second Interview'){

									$sql = $sql." WHERE tbl_application.Status = 'Second Interview'";

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Third Interview'){

									$sql = $sql." WHERE tbl_application.Status = 'Third Interview'  ";

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Final Interview'){

									$sql = $sql." WHERE tbl_application.Status = 'Final Interview'  ";

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Hired'){

									$sql = $sql." WHERE tbl_application.Status like '%Hired%' ";

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'No Show'){

									$sql = $sql." WHERE tbl_application.Status = 'No Show' ";

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Rejected'){

									$sql = $sql." WHERE tbl_application.Status = 'Rejected'";						

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Declined'){

									$sql = $sql." WHERE tbl_application.Status = 'Declined'";						

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Fail'){

									$sql = $sql." WHERE tbl_application.Status like '%Fail%'";						

								}

								elseif(isset($_GET['show']) && $_GET['show'] == 'Archived'){

									$sql = $sql." WHERE  not (DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60 and tbl_application.`Status` = 'Pending') and  tbl_application.`Status` not in('No Show','Rejected', 'Declined','Fail','Failed','failed') and  tbl_application.`Status` not like '%Interview%' and  tbl_application.`Status` not like '%Hired%' ";						

								}

								else{

									$sql = $sql." WHERE tbl_application.Status = 'Pending' and DATEDIFF(now(),DATE_FORMAT(`Timestamp`, '%Y-%m-%d'))<60   or tbl_application.`Status` in('No Show','Rejected', 'Declined','Fail','Failed','failed') or tbl_application.`Status` like '%Interview%' or tbl_application.`Status` like '%hire%' ";

								}

							}
							$sql = $sql." ORDER BY `Timestamp` desc ";

							unset($_SESSION['show']);

							$result = $conn->query($sql);

							if ($result->num_rows > 0) {

								while($row = $result->fetch_assoc()) {

									if($row['Status'] == 'Pending'){

										$class = 'label label-default';

									}

									elseif($row['Status'] == 'Initial Interview'){

										$class = 'label label-success';

									}

									elseif($row['Status'] == 'Second Interview'){

										$class = 'label label-success';

									}

									elseif(strpos($row['Status'], 'Hired') !== false){

										$class = 'label label-info';

									}

									elseif($row['Status'] == 'Final Interview'){

										$class = 'label label-success';

									}

									elseif($row['Status'] == 'Rejected'){

										$class = 'label label-danger';

									}

									elseif($row['Status'] == 'Declined'){

										$class = 'label label-danger';

									}

									elseif($row['Status'] == 'No Show'){

										$class = 'label label-warning';

									}

									elseif($row['Status'] == 'Fail'){

										$class = 'label label-danger';

									}else{

										$class = 'label label-danger';

									}

									if($row['Stage'] == 'Pending'){

										$class2 = 'label label-default';

									}elseif($row['Stage'] == 'Passed'){

										$class2 = 'label label-info';

									}elseif($row['Stage'] == 'Failed' || $row['Stage'] == 'No Show'){

										$class2 = 'label label-danger';

									}elseif($row['Stage'] == 'Passed - Endorsed'){

										$class2 = 'label label-primary';

									}else{

										$class2 = 'a';

									}
									

									$diff =  date_diff(new DateTime(date("Y-m-d", strtotime($row['Timestamp']))),new DateTime(date('Y-m-d')));

									$intDiff = intval($diff->format("%a")."");

									

										

										

										echo"<tr name = '".$row['Source']."'>

												<td><input id='cb".$row['ID']."' data-id='".$row['ID']."' type='checkbox' class='checkbox showhidden'/>

												</td>

												<td>".ucwords(strtolower(utf8_decode($row['Name'])))."</td>

												<td>".$row['ReferenceCode']."</td>

												<td>".$row['Course']."</td>

												<td>".$row['Email']."</td>

												<td><h6>".$row['Contact Number']."</h6></td>

												<td>".str_replace('N/A','',utf8_decode($row['Address']))."</td>

												<td><h6>".$row['Age']."</h6></td>

												<td>".$row['PreviousJobs']."</td>

												<td><h6>".$row['Job Title']."</h6></td>

												<td><h6 id = 'sched".$row['ID']."'>".$row['schedule']."</h6></td>";
										
										if($row['Status'] != 'Declined'){
											echo"<td><span id ='".$row['Source']."".$row['ID']."note' >".$row['note']."</span></td>";
										} else { echo"<td><span  style='color: red' id ='".$row['Source']."".$row['ID']."note' >".$row['note']."</span></td>";}
												// <td style='padding-top:23px'><span id='span".$row['ID']."' style='color:white; font-size: 105%;' class='".$class."' >".$row['Status']."</span>
										echo"<td style='padding-top:23px'><span id='span".$row['ID']."' style='color:white; font-size: 105%;' class='".$class."' >".$row['Status']."</span>

												</td>

												<td style='padding-top:23px'><span id='span".$row['ID']."' style='color:white; font-size: 105%;' class='".$class2."' >".$row['Stage']."</span>

												</td>

												<td>

												<div style = 'border-style: solid; border-color:#dab358; margin-bottom:10%; margin-top:10%;'>

												<a  title='View Information' href='printableResume.php?id=".$row['ID']."&&ref=".$row['ReferenceCode']."' target='_blank' class='btn btn-primary btn-raised btn-sm'><i class='fa fa-eye'></i></a> 

												<button title='Email' class='btn btn-raised btn-sm btn-primary clickme' data-toggle='modal' data-email='".$row['Email']."' data-name='".$row['Name']."' data-id='".$row['ID']."'><i class='fa fa-envelope'></i></button>

												

												<button title='Schedule' class='btn btn-raised btn-sm btn-primary schedulebtn' data-name='".$row['Name']."' data-id='".$row['Source'].",".$row['ID'].",".$row['Status'].",schedule'><i class='	fa fa-calendar-check-o'></i></button>

												<button title='Notes' class='btn btn-raised btn-sm btn-primary notebtn' data-toggle='modal' data-target ='#noteModal' data-name='".$row['Name']."' data-id='".$row['Source'].",".$row['ID']."' ><i class='fa fa-sticky-note-o'></i></button>";
										

										if (($row['Status'] == 'Initial Interview') ||
										($row['Status'] == 'Second Interview') ||
										($row['Status'] == 'Third Interview') ||
										($row['Status'] == 'Final Interview')){
											echo"<button title='Comment' id='commentbutton' class='btn btn-raised btn-sm btn-success commentbtn' data-toggle='modal' data-target ='#commentModal' data-name='".$row['Name']."' data-id='tbl_interview,".$row['ID']. ',' . $row['ReferenceCode'] . "' ><i class='fa fa-comment-o'></i></button></div></td></tr>";
										} else {
											echo"</div></td>

											 </tr>";
										}
										
									

								}

							

							unset($_SESSION['googlequery']);							

							}

								

						$conn->close();

						?>

					</tbody>

				</table>

				</div>

			</div>

			

		</div>

	</div>


	<!-- Google query -->

	<div id="googlequery" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header" style="background-color: #00008B">

	        <button type="button" class="close" data-dismiss="modal" >&times;</button>

	        <h4 class="modal-title" style="color:white"><i class="fa fa-search"></i> Filter</h4>

	      </div>

	      <div class="modal-body">

	        <form action='query.php' method='POST'>

	        	<div class="row">

	        		<div class="col-md-6">

	        			<div class="form-group floating-label">

								<label class="control-label">Age</label>

		        				<input  data-toggle="dropdown" href="#" class="form-control" placeholder = ' Bracket' readonly></input>

								<ul class="dropdown-menu">

									<li><a  href="#">18-25<input name = 'age1' value = "1" type = 'checkbox'style ='float:right;'></a></li>

									<li><a  href="#">26-30<input name = 'age2' value = "1"type = 'checkbox' style ='float:right'></a></li>

									<li><a 	href="#">31-35<input name = 'age3' value = "1" type = 'checkbox' style ='float:right'></a></li>

									<li><a  href="#">36-40<input name = 'age4' value = "1" type = 'checkbox' style ='float:right'></a></li>

									<li><a  href="#">41-45<input name = 'age5' value = "1" type = 'checkbox' style ='float:right'></a></li>

									<li><a 	href="#">46-50<input name = 'age6' value = "1" type = 'checkbox' style ='float:right'></a></li>

									<li><a  href="#">51 and above<input name = 'age7' value = "1" type = 'checkbox' style ='float:right'></a></li>

								</ul>

						</div>

		        		<div class="form-group floating-label">

			        		<label class="control-label">Gender</label>

			        		<select class="form-control" name="googlegenderquery">

			        			<option selected value="All">All</option>

			        			<option value="Male">Male</option>

			        			<option value="Female">Female</option>

			        		</select>

			        	</div>

			        	<div class="form-group floating-label">

			        		<label class="control-label">Course</label>

			        		<input class="form-control" type="text" name="googlequerycourse" placeholder="eg. Information Technology">

			        	</div>

			        	<div class=" floating-label">

			        		<div class="input-group">

			        			<label for="from" class="control-label">Application Date</label>
			        			<br><br>

			        			<span class="fa fa-calendar" style= "width:10%"></span>

				        		<input class="form-control date" data-provide="datepicker" name="googlequeryappdate1" placeholder="FROM:" style= "width:45%" id="from" data-date-autoclose="true"  data-date-end-date="1d" data-date-format="yyyy-mm-dd" readonly>

								<span class="fa fa-calendar" style= "width:10%"></span>

				        		<input class="form-control date" data-provide="datepicker" name="googlequeryappdate2" placeholder="TO:"  style= "width:45%"id="from" data-date-autoclose="true"  data-date-end-date="1d" data-date-format="yyyy-mm-dd" readonly>

							</div>



						</div>

	        		</div>

	        		<div class="col-md-6">

	        			<div class="form-group floating-label">

		        			<label class="control-label">Position Applying for</label>

		        			<select class='form-control' name="googlepositionquery">

							<!--START-->

			        			<?php  

			        				include('connect.php');

			        				$sql = "SELECT Position_name FROM tbl_position";

							    	$result = $conn->query($sql);

							    	if ($result->num_rows > 0){

							    		while($row = $result->fetch_assoc()) {

							    			echo "<option value='".$row['Position_name']."'>".$row['Position_name']."</option>";

							    		}

							    	}

			        			?>

							<!--END-->

			        			<option value="0" selected>All</option>

		        			</select>

	        			</div>

						<!--REGION-->

	        			<div class="form-group floating-label">

			        		<label class="control-label">Region</label>

							<select class='form-control' id = 'selRegion' name="googleRegionquery" onchange = "regionQuery()">

							<!--START-->

			        			<?php  

			        				include('connect.php');

			        				$sql = "SELECT * FROM tbl_region WHERE Region_name LIKE '%Metro%'";

							    	$result = $conn->query($sql);

							    	if ($result->num_rows > 0){

							    		while($row = $result->fetch_assoc()) {

							    			echo "<option value='".$row['Region_name']."'>".$row['Region_name']."</option>"; //Manila

							    			//echo "<option value='".$row['id']."'>".$row['Region_name']."</option>"; //Province

							    		}

							    	}

			        			?>

							<!--END-->

								<option value="All" selected>All</option>	

		        			</select>

			        	</div>

						

						<!--PROVINCE-->

						<div class="form-group floating-label" id="province_city" name="googleprovince_cityquery"></div>

						<!--MUNICIPALITY-->

						<div class="form-group floating-label" id="municipality" name="googlemunicipalityquery"style="padding-top: 15px"> </div>

			        	<div class="form-group floating-label">

			        		<label class="control-label">Recent Position</label>

			        		<input type="text" name="googlequeryworkexp" class="form-control" placeholder=" e.g Web Developer">

			        	</div>

						</div>

	        		</div>

	        	</div>

	      <div class="modal-footer">

	        <button name="googlequerybtn" type="submit" class="btn btn-primary btn-raised " style='background-color:#00008B;'>Submit</button>

	        <button type="button" class="btn btn-default btn-raised " data-dismiss="modal">Close</button>

	      </div>

		</div>



	</form>

	    </div>



	  </div>

	</div>



	<!-- Email Modal -->

	<div id="emailmodal" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class='modal-header' style='background-color: #00008B'>

	        <button type='button' class='close' data-dismiss='modal'>&times;</button>

	        <h4 class='modal-title' style='color:white'>Email Content</h4>

	      </div>

	      <div class="modal-body">

	      <button class="btn btn-xs btn-raised btn-info pull-right" onclick="viewmsgs()">Messages</button>

	        <form action='delete.php' method='POST'>

	        	<div class='form-group floating-label'>

	        		<label class='control-label'>Email</label>

	        		<input class='form-control' id="showemail" type='text' disabled>

	        	</div>

	    		<div class='input-group form-group label-floating'>

	    			<label class='control-label' for='intmsg'>Subject</label>

	    			<input type='text' class='form-control' name='intsub' value='<?php echo $_SESSION['email_subject'] ?>'>

	    		</div>

	    		<div class='input-group form-group label-floating'>

	       			<label class='control-label' for='intmsg'>Message</label>

	       			<textarea name='intmsg' id='intmsg' class='form-control' required style='height: 100px;'><?php echo $_SESSION['email_message']; ?></textarea>

	       			<span class='input-group-addon'>

				        <span class='fa fa-envelope'></span>

				    </span>

	       		</div>

	       		<input type="hidden" id="emailadd" name="emailadd">

	       		<input type="hidden" id='appname' name="appname">

	       		<input type="hidden" id='appid' name="appid">

	       		<input type="hidden" name="imfrom" value="google">

	      </div>

	      <div class='modal-footer'>

	        <button type='submit' name='sendemail' class='btn btn-sm btn-raised btn-info btn-default' onclick="waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 5000);">Send <i class="fa fa-paper-plane"></i></button>

	        <button class='btn btn-sm btn-raised btn-default' data-dismiss='modal'>Close</button>

	        </form>

	      </div>

	    </div>

	  </div>

	  

	</div>



	<!-- Load csv modal -->

	<div id="myModal" class="modal fade" role="dialog" style="padding-top: 5%">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header" style="background-color:#00008B; color:white">

	        <button type="button" class="close" data-dismiss="modal">&times;</button>

	        <h4 class="modal-title">Upload CSV</h4>

	        <i class="fa fa-warning"></i> <small style="text-align:left">Please make sure that the file matches the database column sequence</small>

	      </div>

	      <div class="modal-body">

	        <form action="csvupload.php" method="POST" enctype='multipart/form-data'>

			<div class="form-control">

                        <label for="from">CSV Origin</label>

                          <select name="fromsource" id = "from" required>

                            <option disabled selected="true">--Select--</option>

                            <option value="indeed">Indeed</option>

                            <option value="jobfair">Job Fair</option>

                            <option value="application">Application</option>

                        </select>

                    </div>

				<div class="form-group">

				  	<input required="" type="file" id="inputFile4" name="csvhere" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

			 	 	<div class="input-group">

						<input type="text" readonly="" class="form-control" placeholder="Choose CSV file">

						<span class="input-group-btn input-group-sm">

							<button type="button" class="btn btn-fab btn-fab-mini">

								<i class="fa fa-paperclip"></i>

							</button>

						</span>

					</div>

				</div>

				<input type="hidden" name="imfrom" value='google'>

	      </div>

	      <div class="modal-footer">

	      	<button class="btn btn-raised btn-sm" style="background-color:#00008B; color: white;" name="loadtest" type="submit">Upload</button>

	        <button class='btn btn-sm btn-raised btn-default' data-dismiss='modal'>Close</button>

	        </form>

	      </div>

	    </div>

	  </div>

	</div>


	<!-- Decline Modal -->
	<div id="declineModal" class="modal fade" role="dialog" style="padding-top 5%">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #8b0000; color:white">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-comment-o"></i> Reason</h4><br>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="form-group">
								<label for="reason">Reason:</label>
								<textarea class="form-control" rows="5" id="reasonValue" style="color: #FF0000"></textarea>
							</div>
						</div>
					</div>
					<input type="hidden" name="imfrom" value="google">
					<div class="modal-footer">
						<div>
						<button class="btn btn-raised btn-warning btn-sm" class="form-control" style="background-color: #8b0000" id="declineMod" onclick="statusUpdate2()">OK</button>
						<button class="btn btn-raised btn-default btn-sm" class="form-control" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>
	</div>
	

	<!--Comment Modal -->

	<div id="commentModal" class="modal fade" role="dialog" style="padding-top: 5%">
		
		<div class="col-md-6">
			<div class="modal-dialog">
			
				<div class="modal-content">
					<div class="modal-header" style="background-color: #00008B; color:white">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<h4 class="modal-title"><i class="fa fa-comment"></i> Comment</h4><br>

					</div>

					<div class="modal-body">
								
						<div class="form-group">

							<div class="form-group">

								<label for="comment">Write comment:</label>

								<textarea class="form-control" rows="5" id="commentValue"></textarea>

							</div>

						</div>

						<input type="hidden" name="imfrom" value='google'>

					</div>

					<div class="modal-footer">

						<button style="background-color: #00008B" class="btn btn-raised btn-warning btn-sm" class="form-control" id="commentMod" type="submit">OK</button>

						<button class='btn btn-sm btn-raised btn-default' data-dismiss='modal'>Cancel</button>

					</div>

				</div>

			</div>
		</div>

		<div class="col-md-6" id="infooo">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"> Informations </h4>
					</div>
					<!-- modal body -->
					<div class="modal-body">
						<p id="rightinfo" ></p>
						
					</div>
					<!-- modal footer -->
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- Note Modal -->
	<div id="noteModal" class="modal fade" role="dialog" style="padding-top: 5%">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header"  style="background-color: #00008B; color:white">

	        <button type="button" class="close" data-dismiss="modal">&times;</button>

	        <h4 class="modal-title"><i class="fa fa-sticky-note"></i> Note</h4><br>

	      </div>

	      <div class="modal-body">

	       

				<div class="form-group">

				  

					<div class="form-group">

					  <label for="comment">Write note:</label>

					  <textarea class="form-control" rows="5" id="noteValue"></textarea>

					</div>

				</div>

				<input type="hidden" name="imfrom" value='google'>

	      </div>

	      <div class="modal-footer">

	      	<button style="background-color: #00008B" class="btn btn-raised btn-warning btn-sm" class="form-control" id="noteMod" type="submit">OK</button>

	        <button class='btn btn-sm btn-raised btn-default' data-dismiss='modal'>Cancel</button>

	      </div>

	    </div>

	  </div>

	</div>

	

	

	<!--Action Modal -->

	<div id="delmodal" class="modal fade" role="dialog">

	  <div class="modal-dialog">

	    <div class="modal-content">

			<div id='headercolor' class="modal-header">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title"><p id='headerx'></p></h4>

			</div>

			<div class="modal-body" id='content'>	



			</div>

			<input type="hidden" id="type">

									<div class  = 'divEmail' style= "width:45%;display:inline-block; margin-left:5%; visibility: hidden;" >

							<span style= "width:45%;" >Enter your email account:</span>

							<button  class = "btn btn-raised btn-primary btn-sm" data-toggle = "modal" data-target ="#modalPass"  id="">confirm</button>

						</div>

			<div class="modal-footer">

				<button onclick="statusUpdate()" class="btn btn-raised btn-sm">Ok</button>

				<button type="button" class="btn btn-raised btn-sm btn-default" data-dismiss="modal" style="">Cancel</button>

			</div>

	    </div>

	  </div>

	</div>



	<!-- For interview-->

	<div id="interviewModal" class="modal fade" role="dialog" style="padding-top: 5%">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header" style="background-color: #00008B; color:white">

	        <button type="button" class="close" data-dismiss="modal">&times;</button>

	        <h4 class="modal-title"><i class="fa fa-calendar check-o"></i>Schedule</h4>

	      </div>

	      <div class="modal-body">

				<div class="form-group">

					<div class="form-group">

						<div>

							<span style= "width:45%;" >Interviewer :</span>

							<div  style = "display:inline-block;">

								<input type="text" class = "form-control" id="interviewerFName" placeholder = "First Name"  style= "width:45%;display:inline-block; " value="<?php echo $adminAccountInfo['firstname']?>">

								<input type="text" class = "form-control" id="interviewerMName" placeholder = "Middle Name"  style= "width:45%; display:inline-block;margin-left:5%;" value="<?php echo $adminAccountInfo['middlename']?>">

								<input type="text" class = "form-control" id="interviewerLName" placeholder = "Last Name"  style= "width:45%;display:inline-block; " value="<?php echo $adminAccountInfo['lastname']?>">

								<input type="text" class = "form-control" id="interviewerEmail" placeholder = "Email Address"   style= "width:45%;display:inline-block; margin-left:5%;" value="<?php echo $adminAccountInfo['email']?>">

							</div>

						</div>

						<h1></h1>

						<div >

						<div style= "width:45%;display:inline-block;">

							<div  >

								<span style= "width:45%; text-align: right;" >Time: </span>

								<input id="timeInterview"  data-date-format="HH:mm:ss" type="text"  class="input-small form-control"></input>

							</div>

							<div >

								<span style= " text-align: right;" >Date: </span>

								<input type="text"  id="dateInterview" class="form-control date" data-provide="datepicker"  data-date-autoclose="true"  data-date-start-date="1d" data-date-format="yyyy-mm-dd" readonly >

							</div>

						</div>

						

						<div  class  = 'divEmail' style= "width:45%;display:inline-block; margin-left:5%; visibility: hidden" >



							<span style= "width:45%;" >Enter your email account:</span>

							<button  class = "btn btn-raised btn-primary btn-sm" data-toggle = "modal" data-target ="#modalPass"  id="interviewConfirm">confirm</button>

						</div>

						<h1></h1>

						<div>

					</div>

			<div class="modal-footer">

	      	<button class="btn btn-raised btn-warning btn-sm" style="background-color: #00008B"class="form-control" name="forIntervew"  onclick="waitingDialog.show();setTimeout(function () {waitingDialog.hide();}, 2000);" type="submit">OK</button>

	        <button class='btn btn-sm btn-raised btn-default' data-dismiss='modal'>Cancel</button>

			</div>

				</div>

				<input type="text" name="imfrom" value='google'>

	      </div>



	

	    </div>

	  </div>

	</div>	  </div>

	</div>

	<!--Accepted-->	

	<div id="acceptModal" class="modal fade" role="dialog" style="padding-top: 5%">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header" style="background-color: #00008B; color:white">

	        <button type="button" class="close" data-dismiss="modal">&times;</button>

	        <h4 class="modal-title"><i class="fa fa-address-card-o check-o"></i> Hired</h4>

	      </div>

	      <div class="modal-body">

				<div class="form-group">

					<div class="form-group">

						<div style = "width:50% display:inline-block;">

						<div>

							<span style= "width:45%; text-align: right;" >Hired Date: </span>

							<input type="text"  id="acceptDate" class="form-control date" data-provide="datepicker"  style= "width:45%;" data-date-autoclose="true" data-date-format="yyyy-mm-dd" readonly  >			

						</div>

						<div >

							<span style= "width:45%; text-align: right;" >Position : </span>

							<input type="text" class = "form-control" id="acceptPosition"  style= "width:45%;" >

						</div>

						<div >

							<span style= "width:45%; text-align: right;" >Department: </span>

							<input type="text" class = "form-control" id="acceptDepartment"  style= "width:45%;" >

						</div>

						</div>

						<div  class  = 'divEmail' style= "width:45%;display:inline-block; margin-left:5%; visibility:hidden;" >

							<span style= "width:45%;" >Enter your email account:</span>

							<button  class = "btn btn-raised btn-primary btn-sm" data-toggle = "modal" data-target ="#modalPass"  id="">confirm</button>

						</div>

					</div>

					 <div class="modal-footer">

						<button class="btn btn-raised btn-warning btn-sm" style="background-color: #00008B"class="form-control" name="acceptedOk" type="submit">OK</button>

						<button id = "cancelBtn" class='btn btn-sm btn-raised btn-default' data-dismiss='modal'>Cancel</button>

					</div>

				</div>

	      </div>



	

	    </div>

	  </div>

	</div>

	<div id="modalPass" class="modal fade" role="dialog" style="padding-top: 5%">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header" style="background-color:#00008B; color:white">

	        <button type="button" class="close" data-dismiss="modal">&times;</button>

	        <h4 class="modal-title"><i class="fa fa-key"></i> Email</h4>

	      </div>

	      <div class="modal-body">

				<div class="form-group">

					<div class="form-group">

						<div>

							<input type="text" class = "form-control" id="userEmail" placeholder = "EMAIL ADDRESS" >

							<input type="password" class = "form-control" id="userPass" placeholder = "PASSWORD" >

						</div>

					</div>

					 <div class="modal-footer">

						<button class="btn btn-raised btn-warning btn-sm" style="background-color: #00008B"class="form-control" name="confirmEmail" type="submit">OK</button>

						<button class='btn btn-sm btn-raised btn-default' data-toggle='modal' data-target = '#modalPass'>Cancel</button>

					</div>

				</div>

	      </div>

	    </div>

	  </div>

	</div>

	

	

	

<!--START-->
<!--Interview Status-->
<div id="interViewStatus" class="modal fade" role="dialog" style="padding-top: 5%;">
	<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #00008B; color:white;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Interview 3Status</h4>
	      </div>

	      <div class="modal-body">
			<div>
			<table id = "interviewStatus">
				<thead>
					<th>&nbsp;Applicant&nbsp;&nbsp;&nbsp;</th>
					<th>Interview Stage</th>
					<th>Schedule&nbsp;</th>
					<th>Interviewer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Status</th>
				</thead>
				<tbody>
					<?php  
						include('connect.php');

						$sql = "SELECT a.Name as 'f',
									b.interviewStage as 'e',
									(CASE 
										WHEN `Schedule` ='0000-00-00 00:00:00' THEN ''
										ELSE SCHEDULE
									END) as `s`,
									concat(b.interviewerFirstName,' ',b.interviewerMiddleName,' ',b.interviewerLastName) as 'interviewer',
									b.status as 'g'
								FROM `tbl_application` AS a, `tbl_interview` AS b
								WHERE a.reference_no = b.referenceNo AND a.status like '%Interview'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>".$row['f']."</td>";
								echo "<td>".$row['e']."</td>";
								echo "<td>".$row['s']."</td>";
								echo "<td>".$row['interviewer']."</td>";
								echo "<td>".$row['g']."</td>";
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
			</div>
	      </div>
	    </div>
	  </div>
	</div>

	<!--Exam Results-->
	<div id="examResults" class="modal fade" role="dialog" style="padding-top: 5%;">
	<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #00008B; color:white;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Exam Results</h4>
	      </div>

	      <div class="modal-body">
			<div>
			<table>
				<thead><b>
					<th>Reference<br>Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Applicant/Examinee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Applied Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Examination<br>Date</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Score&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>Item<br>Total</th>
				</b></thead>
				<tbody>
					<?php  
						include('connect.php');
						$sql = "SELECT b.ReferenceCode as 'r',
									b.Fullname as 'f',
									b.Position as 'p',
									b.DateTaken as 'd',
									b.TestScore as 's',
									b.TestTotal as 't'
								FROM `tbl_application` AS a, `tbl_examresult` AS b
								WHERE a.reference_no = b.ReferenceCode";
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>".$row['r']."</td>";
								echo "<td>".$row['f']."</td>";
								echo "<td>".$row['p']."</td>";
								echo "<td>".$row['d']."</td>";
								echo "<td>".$row['s']."</td>";
								echo "<td>".$row['t']."</td>";
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
			</div>
	      </div>
	    </div>
	  </div>
	</div>
	
  <footer class="panel-footer" style="background-color:#F0F8FF;">

		<center><p style="color: black; font-size:90%">

			Private and Confidential. Anderson Group BPO Inc. &copy; 2017

		</p></center>

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



<script type="text/javascript">

    /**

 * Module for displaying "Waiting for..." dialog using Bootstrap

 *

 * @author Eugene Maslovich <ehpc@em42.ru>

 */



var waitingDialog = waitingDialog || (function ($) {

    'use strict';



	// Creating modal dialog's DOM

	var $dialog = $(

		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +

		'<div class="modal-dialog modal-m">' +

		'<div class="modal-content">' +

			'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +

			'<div class="modal-body">' +

				'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +

			'</div>' +

		'</div></div></div>');



	return {

		/**

		 * Opens our dialog

		 * @param message Custom message

		 * @param options Custom options:

		 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";

		 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".

		 */

		show: function (message, options) {

			// Assigning defaults

			if (typeof options === 'undefined') {

				options = {};

			}

			if (typeof message === 'undefined') {

				message = 'Loading';

			}

			var settings = $.extend({

				dialogSize: 'm',

				progressType: '',

				onHide: null // This callback runs after the dialog was hidden

			}, options);



			// Configuring dialog

			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);

			$dialog.find('.progress-bar').attr('class', 'progress-bar');

			if (settings.progressType) {

				$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);

			}

			$dialog.find('h3').text(message);

			// Adding callbacks

			if (typeof settings.onHide === 'function') {

				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {

					settings.onHide.call($dialog);

				});

			}

			// Opening dialog

			$dialog.modal();

		},

		/**

		 * Closes dialog

		 */

		hide: function () {

			$dialog.modal('hide');

		}

	};



})(jQuery);



</script>



	<script type="text/javascript">

		var sendersEmail = "";

		var sendersPassword = "";

		var interviewerEmail = "";

		var interviewerFName = "";

		var interviewerLName = "";

		var interviewerMName = "";

		var checkarr = [];

		var checkTblApplication = [];

		var checkTblApplicant2 = [];

		var checkTblApplicant3 = [];

		var tblName = [];

		var idleTime = 0;

		var check = 0;

		var statusTdNum = 7;

		var schedTdNum = 5;

		var selectedColumns = [1,2,3,4,5,6,7,8,9,10];

		var myTable;

		var interviewType='';

		var schedID = [];

		var sched;

		var commentID = [];

		var idHolder = [];

		var idStatus = [];

		var firstStatus = "";

		var checkSimilarity = false;

		var hiredID = "";

		var adminID = '<?php echo $_SESSION["id"]?>';

		

////////////////////////////////////////////////////////////////////////////////////		

		$('ul.nav li.dropdown').hover(function(){

        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);

        }, function(){

        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);

        });


////////////////////////////////////////////////////////////////////////////////////


		$(document).ready(function(){


			$.material.init();

			$('.ddcheckbox').prop('checked',true);

			$('.deact').prop('checked',false);

			document.getElementById('withselected').style.visibility = "hidden";

			$('.showHideColumn').on('click', function(event){

			event.stopPropagation();

			});
			$('#InitialInterview').on("click",function(event){

				setValValue("Initial Interview");
				<?php
				date_default_timezone_set("Singapore");
					$userID = $_GET['id'];
					$date = date("Y-m-d h:i:sa");
					$selectUser = "SELECT * FROM tbl_userlogs WHERE log_id = '$userID'";
					$resultUser = $conn->query($selectUser);
					while($rowUser=$resultUser->fetch_assoc()){
						$user = $rowUser['username'];
					}
					
						$sqlInsert = "INSERT INTO tbl_useractionlogs (username, updated_fieldname, updated_date, new_value) VALUES ('$user','Status', '$date', 'Initial Interview' ) ";
						$resultUserAction = $conn->query($sqlInsert);
					
				?>						

			});



			if(adminID == 1 ){

				$('.divEmail').prop('style','visibility:visible');

			}else{

				<?php 

				$sql = "select * from tbl_admin where id = '".$_SESSION['id']."'";

				$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {

								echo "

									sendersEmail = '".$row['email']."';

									sendersPassword = '".$row['email_password']."';

								";

						}

					}

				?>

			}

			
			$('html').click(function(e){

				if ( $(e.target).hasClass('dropbtn')){	

				}else{

					$('ul .dropdown  .dropdown-content').attr('style','display:none');

				}

			});

			$('ul .dropdown ').on('click', function(event){

				if ( $(this).find('.dropdown-content').css('display') == 'block')

				{

				$('ul .dropdown  .dropdown-content').attr('style','display:none');

					}else{

				$('ul .dropdown  .dropdown-content').attr('style','display:none');

				$(this).find('.dropdown-content').attr('style','display:block');

				}

			});

			

			$('#override').click(function(event){

				event.stopPropagation();

					$('.openOveride').prop('style','position:static;visibility:visible;');							

			});

			

			$('#statusDropdown').on('hidden.bs.dropdown', function () {


					$('.openOveride').prop('style','position:absolute;visibility:hidden;');

										if(checkSimilarity == true){

					if(idStatus[0] == "Pending"){

						$("#InitialInterview").prop('style','position:static;visibility:visible;');	

					}else if(idStatus[0] == "Initial Interview"){

						$("#SecondInterview").prop('style','position:static;visibility:visible;');

					}else if(idStatus[0] == "Second Interview"){

						$("#ThirdInterview").prop('style','position:static;visibility:visible;');

						$("#FinalInterview").prop('style','position:static;visibility:visible;');	

					}else if(idStatus[0] == "Third Interview"){

						$("#FinalInterview").prop('style','position:static;visibility:visible;');	

					}else if(idStatus[0] == "Final Interview"){

						$("#HireAccept").prop('style','position:static;visibility:visible;');	

										}}

				

			});

			
			/// decline
			/* $('#declineMod').click(function(){
				$.ajax({

					url: 'actions.php',
					type: 'POST',
					dataType: 'html',
					data:{value: $('#reasonValue').val()},

					success: function(data){
						$('#declineModal').modal('toggle');
					},

					error: function(data){
						alert(data);
					}
				});
			}); */
			///	Note submit function

			$('#noteMod').click(function(){

					$.ajax({

						url: 'query.php',

						type: 'POST',

						dataType: 'html',	

						data:{ID: noteID[1], Table:noteID[0] , note: 1,value:$('#noteValue').val()},

						success:function (data){

							$('#noteModal').modal('toggle');

							$('#'+noteID[0]+''+noteID[1]+'note').html($('#noteValue').val());

						},

						error: function(data){

							alert(data);	

						}	

					});

				});

			// note modal
			$('.notebtn').click(function(){

				noteID = $(this).data('id').split(',');


				$.ajax({

					url: 'query.php',

					type: 'POST',

					dataType: 'html',

					data:{ID: noteID[1],Table:noteID[0], noteValue: 1},

					success:function (data){

						$('#noteValue').val(data);

						

					},

					error: function(data){

						alert(data);	

					}	

				});	

			});

			
			/// Comment submit function
			$('#commentMod').click(function(){
				
				$.ajax({

					url: 'query.php',

					type: 'POST',

					dataType: 'html',	

					data:{ID: commentID[1],
						 Table:commentID[0],
						 comment: 1,
						 value: $('#commentValue').val(),
						 ReferenceCode: commentID[2],
						 Stage: $("#span" + commentID[1]).html()},

					success:function (data){

						$('#commentModal').modal('toggle');
						
						// $('#'+commentID[0]+''+commentID[1]+'comment').html($('#commentValue').val());

					},

					error: function(data){

						alert(data);	

					}	

					});

			});

			
// 			// Comment modal
			$('.commentbtn').click(function(){

				commentID = $(this).data('id').split(',');

				// console.log($("#span" + commentID[1]).html() + commentID[2]);

				$.ajax({

					url: 'query.php',

					type: 'POST',

					dataType: 'html',

					data:{ID: commentID[1],Table:commentID[0], commentValue: 1, Stage: $("#span" + commentID[1]).html(), information: 1},

					success:function (data){

						$('#commentValue').val(data);
						// $('#rightinfo').html(data);
						

					},

					error: function(data){

						alert(data);	

					}	

				});	

			});
			$('.commentbtn').click(function(){

				commentID = $(this).data('id').split(',');

				// console.log($("#span" + commentID[1]).html() + commentID[2]);

				$.ajax({

					url: 'query.php',

					type: 'POST',

					dataType: 'html',

					data:{ID: commentID[1],Table:commentID[0], commentValue: 1, Stage: $("#span" + commentID[1]).html()},

					success:function (data){

						$('#commentValue').val(data);
						// $('#rightinfo').html(data);
						

					},

					error: function(data){

						alert(data);	

					}	

				});	

				$.ajax({

					url: 'query.php',

					type: 'POST',

					dataType: 'html',

					data:{ID: commentID[1],Table:commentID[0], Stage: $("#span" + commentID[1]).html(), information: 1},

					success:function (data){

						// $('#commentValue').val(data);
						$('#rightinfo').html(data);
						

					},

					error: function(data){

						alert(data);	

					}	

				});	

			});

			
			

			////Sending interview

			

			$('.schedulebtn').click(function(){

				schedID = $(this).data('id').split(',');

				interviewType = schedID[2]; 

				var tempText = $('#span'+schedID[1]).html();

				

				if(tempText.toLowerCase().indexOf('interview')>=0  || tempText == "Hired") {

								$.ajax({

					url: 'query.php',

					type: 'POST',

					dataType: 'html',

					data:{ID: schedID[1],Table:schedID[0], schedValue: 1},

					success:function (data){

						var timeDate = data.split(" ");

						var myTime = timeDate[1].split(":00");

						$("#timeInterview").val(myTime[0]);

						$("#dateInterview").val(timeDate[0]);

						$('#interviewModal').modal('show');	

					},

					error: function(data){

						alert(data);	

					}	

				});	

				}else{

					alert('Change status for interview to access this function.');

				}



			});

			$('button[name=confirmEmail]').click(function(){

				sendersEmail = $('#userEmail').val();

				sendersPassword = $('#userPass').val();

				$('#modalPass').modal('hide');

			});

			$('button[name=forIntervew]').click(function(){

                

				if($('#dateInterview').val()=="" || $('#interviewerFName').val() == "" || $('#interviewerLName').val() == ""|| $('#interviewerEmail').val() == ""){

					alert('Please complete the form');

				}else if(sendersEmail == "" || sendersPassword == ""){

					alert("please confirm your email account");

				}else{

                    

					interviewerFName = $('#interviewerFName').val();

					interviewerLName = $('#interviewerLName').val();

					interviewerMName = $('#interviewerMName').val();

					interviewerEmail = $('#interviewerEmail').val(); 

					var interviewTime = $('#timeInterview').val();

					var interviewDate = $('#dateInterview').val();

					sched = interviewDate +' '+interviewTime;

					$('#type').val('interview');
	
					if(checkTblApplication.length>0){

					actionfunction('tbl_application',checkTblApplication);				

					checkTblApplication  = [];

					}	

					if(checkTblApplicant2.length>0){

					actionfunction('tbl_applicant2',checkTblApplicant2);

					checkTblApplicant2 = [];

					}		

					if(checkTblApplicant3.length>0){

					actionfunction('tbl_applicant3',checkTblApplicant3);

					checkTblApplicant3 = [];

					}

                    

				}

			});

			$('input[name = forIntervew]').click(function(){

				var timeInterview = $('#timeInterview').val();

				var dateInterview = $('#dateInterview').val();

				actionfunction('tbl_application',checkTblApplication);

				actionfunction('tbl_applicant2',checkTblApplicant2);

				actionfunction('tbl_applicant3',checkTblApplicant3);

				checkTblApplication  = [];

				checkTblApplicant2 = [];

				checkTblApplicant3 = []

			});

			$('#timeInterview').timepicker({

				template: false,

                showInputs: false,

                minuteStep: 5,

				showMeridian: false 

            });

			$('#timeInterview').timepicker().on('changeTime.timepicker', function(e) {

				var timePicked = $('#timeInterview').val();

				if(timePicked.length < 5)   

					$('#timeInterview').val("0" + timePicked);

			});



			$('#HireAccept').click(function(){

				if(check>1){

					alert("This function requires one selected row only!");

				}else{

					$('#acceptModal').modal('show');

				}

			});

			

			$('button[name=acceptedOk]').click(function(){

				if($('#acceptDate').val()=="" || $('#acceptDepartment').val()=="" || $('#acceptPosition').val()==""){

					alert("Please Complete the form");

				}else if(sendersEmail == '' || sendersPassword == ''){

					alert("Complete your email");

				}else{

					var rowID = "";

					var rowSource = ""

					if(checkTblApplication.length>0){

					 hiredID = checkTblApplication[0]+"-tbl_application";

					 rowID = checkTblApplication[0];

					 rowSource = "tbl_application";

					 checkTblApplication  = [];

					}



					$.ajax({

						url: 'actions.php',

						type: 'POST',

						dataType: 'html',

						data:{id: hiredID, startDate:$('#acceptDate').val(),department:$('#acceptDepartment').val(),position:$('#acceptPosition').val(),hire:1 },

						success:function (data){

							alert(data);

							if(data =="success"){

								$('#sched'+rowID).html("");

								$('#'+rowSource+''+rowID+'note').html("");

								$('#span'+rowID).html("Hired \n"+$('#acceptDepartment').val()+"("+$('#acceptPosition').val()+")\n   "+$('#acceptDate').val()+"").removeClass("label-success").addClass("label-info");

								$('#acceptDate').val('');

								$('#acceptDepartment').val('');

								$('#acceptPosition').val('');

								$('#acceptModal').modal('hide');

								

							}

						},

						error: function(data){

							alert(data);	

						}	

					});	

				}			

			});			



			

			///managing table

			$('#myTable').on('draw.dt', function(e) {

				if ($('#select_all').is(':checked')) {

					$('.checkbox').prop('checked', true);

				}				

			});

			$('.checkbox').click(function(e){

				trCheckBox($(this),$(this ).closest( "tr" ));

				

			});



			$('#myTable tbody').on( 'mouseup', 'tr', function (e) {	

				trCheckBox($( this).find( ".checkbox" ),$(this));	

				///$('#InitialInterview').hide();

			});



			$('#interviewStatus').DataTable({

				"autoWidth": false,

			    "order": [[ 1, "asc" ]],

				"scrollY": "500px",

				"scrollX": "100%",

				"processing": true,

				"paging": true,

				"pagingType": "full_numbers",

			    "pageLength": 50,

				"orderClasses" : false,

				 dom: 'Bfrtip',

				buttons: [],

		    });

	//////////TABLE MANAGEMENT//////////

		     myTable = $('#myTable').DataTable({

				select: {

					style: 'multi'

				},

				"autoWidth": false,

				"columnDefs": [{ targets: -1,visible: false}],

				"scrollY": '75vh',

			    "scrollX": "90%",

				"processing": true,

				"paging": true,

				"pagingType": "full_numbers",

			    "pageLength": 40,

				"orderClasses" : false,

				 dom: 'Bfrtip',

				buttons: [],

				columnDefs: [ {

					targets: -1,

					visible: false

				} ],

				"aoColumnDefs": [

					{ "bSortable": false, "aTargets": [ 0 ] }

				]

		    });

			

			var $buttonPrint = new $.fn.dataTable.Buttons(myTable, {

				buttons: [

					{

						'extend':'csv',

						'sFileName' : '.csv',

						text: 'Save',

						exportOptions: {

								columns:  selectedColumns 

							},

					},

				]

			}).container().appendTo($('#ulSave'));

						

			var $buttonPrintSelected= new $.fn.dataTable.Buttons(myTable, {

				buttons: [

				{ 'extend': 'print',

					text: 'All',

					exportOptions: {

						columns:  selectedColumns 

					},

						customize: function ( win ) {

							$(win.document.body)

							.css( 'font-size', '10pt' );

						$(win.document.body).find( 'table' )

							.addClass( 'compact' )

							.css( 'font-size', 'inherit' );

					}

				},

					{extend: 'print',

						text: 'Selected', 

						exportOptions: {

							columns:  selectedColumns,

							modifier: {

								selected: true,

							}

						},

						customize: function ( win ) {

							$(win.document.body)

								.css( 'font-size', '10pt')

								.prepend(

									'<img id = "bgImg" src="http://andersongroup.ph/application/lady liberty.png" style="position:absolute; top:center; right:center; z-index:-.1; opacity:.5; " />'

								);

							$(win.document.body).css("z-index","-.1");

		 

							$(win.document.body).find( 'table' )

								.addClass( 'compact' )

								.css( 'font-size', 'inherit' );

						myTable.rows('tr').deselect();

						$('.checkbox').prop('checked',false);

						}

					},			



				]

					}).container().appendTo($('#ulPrint'));

					$('div#myTable_filter').prop('style','top:20px;left:50px;');

					

					///searchtab 

					var $filterBtn = "<div id = 'repo' style = 'display:inline-block; float:right;margin-top:2%'><div style = 'float:left' ><button data-toggle='modal' data-target='#googlequery' class='btn btn-info btn-raised btn-sm' style = 'margin-right:10px;  background-color:#00008B;'><i class='fa fa-search'></i> Filter</button></div><div id ='reposition'  style = 'float:right;'></div></div>";

					$('.container-fluid').append($filterBtn);

					$('#myTable_filter label input').detach().appendTo('#reposition').prop('placeholder','  Search here...').prop('style','color:black').prop('style','border-radius:30px');

					$('#myTable_filter label').detach();

					$('#myTable_filter').prop('style','float:right');

			$buttonPrintSelected.attr('style','padding: 0; border: none; background: none;');

			$buttonPrintSelected.prop('href','#');			

			$('ul.dropdown-menu div.dt-buttons a').attr('style','height: 100%; width: 100%');

			$('#ulPrint div a').prop('href','#'); 

			$('ul.dropdown-menu div.dt-buttons a').addClass('actionbtn2 btn btn-default');

			$('.showHideColumn').mouseout(function(){

				var column = myTable.column( $(this).attr('data-columnindex') );

				if(column.visible() == true){

					$(this).attr('style','text-decoration:none !important;');

				}

			});

			$('.ddcheckbox').on( 'click', function (e) {$(this).prop('checked',!$(this).prop('checked'));});

			myTable.column('5').visible(false);

			myTable.column('2').visible(false);

			myTable.column('3').visible(false);

			myTable.column('8').visible(false);

			$('.showHideColumn').on( 'click', function (e) {

			var column = myTable.column( $(this).attr('data-columnindex') );

			column.visible( ! column.visible());

			$(this).find('.ddcheckbox').prop('checked',!$(this).find('.ddcheckbox').prop('checked'));

			if(column.visible() == true){

			}else{

				$(this).attr('style','color:gray !important;');

			}

				var colNum = $(this).attr('data-columnindex');

				if(column.visible()==true){

					selectedColumns.push(colNum);

					selectedColumns.sort();

					statusTdNum +=1;

					schedTdNum += 1;

				}else{

					for(var i = selectedColumns.length - 1; i >= 0; i--) {

						if(selectedColumns[i] == colNum) {

						   selectedColumns.splice(i, 1);	

							statusTdNum -=1;

							schedTdNum -=1;

					}

					}

				}

			});

			

		    $("#myTable tbody").on('click', '.clickme', function(){

	   			$("#emailadd").val($(this).data('email'));

	   			$("#showemail").val($(this).data('email'));

				$("#appname").val($(this).data('name'));

				$("#appid").val($(this).data('id'));

				$('#emailmodal').modal('show');

	   		});

			

			$('#googlecontainer ul').on('click', '.actionbtn', function() {//change status

				document.getElementById('headerx').innerHTML = $(this).data('headerx');

				document.getElementById('headerx').style.color = $(this).data('hcolor');

				document.getElementById('content').innerHTML = $(this).data('content');

				$('#type').val($(this).data('type'));

				$('#headercolor').css({backgroundColor: $(this).data('headercolor')});

				$('#delmodal').modal('show');

			});



			$('#googlecontainer ul').on('click', '.actionbtn2', function() {

				$('#type').val($(this).data('type'));

				if(checkTblApplication.length>0){

				actionfunction('tbl_application',checkTblApplication);				

				checkTblApplication  = [];

				}	

				if(checkTblApplicant2.length>0){

				actionfunction('tbl_applicant2',checkTblApplicant2);

				checkTblApplicant2 = [];

				}		

				if(checkTblApplicant3.length>0){

				actionfunction('tbl_applicant3',checkTblApplicant3);

				checkTblApplicant3 = [];

				}

			});

			

			var idleInterval = setInterval(timerIncrement, 60000); // Check every 60 Seconds

		    $(this).mousemove(function (e) {

		        idleTime = 0;

		    });

		    $(this).keypress(function (e) {

		        idleTime = 0;

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

		    	<?php  

		    		$_SESSION['loginerror'] = 'You were idle for too long!';

		    	?>

		        window.location = 'adminloginpage.php';

		    }

		}

		});

		function setValValue(value){

				interviewType = value;

		}

		function checkAllElementIfEqual(state) {

			return idStatus[0]== state;

		}

		function removeOneID(myID) {

			for(i=idHolder.length-1;i>=0;i--){

				if(idHolder[i]==myID){

					idHolder.splice(i,1);

					idStatus.splice(i,1);

				}

			}

		}



		function trCheckBox(checkBox,tr){

			tr.toggleClass( "selected" );

			checkBox.prop('checked',!  checkBox.prop('checked'));

			if(checkBox.is(':checked')){

				idHolder.push(checkBox.data('id'));

				idStatus.push($('#span'+checkBox.data('id')).text());

				if(idHolder.length == 1){

					checkSimilarity = true;

				}else{

					idHolder.push(checkBox.data('id'));

					idStatus.push($('#span'+checkBox.data('id')).text());

					checkSimilarity = idStatus.every(checkAllElementIfEqual);

					if(!checkSimilarity){

						$('.openOveride').prop('style','position:absolute;visibility:hidden;');

					}

				}



				if(tr.attr('name') == 'tbl_application'){

					checkTblApplication.push(checkBox.data('id'));

				}else if(tr.attr('name') == 'tbl_applicant2'){

					checkTblApplicant2.push(checkBox.data('id'));

				}else{

					checkTblApplicant3.push(checkBox.data('id'));

				}

				check += 1;

			}else{

				removeOneID(checkBox.data('id'));

				checkSimilarity = idStatus.every(checkAllElementIfEqual);

				if(tr.attr('name') == 'tbl_application'){

					checkTblApplication.splice(-1,1);

				}else if(tr.attr('name') == 'tbl_applicant2'){

					checkTblApplicant2.splice(-1,1);

				}else{

					checkTblApplicant3.splice(-1,1);

				}

				check -= 1;

			}

			if(check > 0){ 

				document.getElementById('withselected').style.visibility = "visible";

				if(checkSimilarity == true){

				if(idStatus[0] == "Pending"){

					$("#InitialInterview").prop('style','position:static;visibility:visible;');	

				}else if(idStatus[0] == "Initial Interview"){

					$("#SecondInterview").prop('style','position:static;visibility:visible;');	

				}else if(idStatus[0] == "Second Interview"){

					$("#ThirdInterview").prop('style','position:static;visibility:visible;');	

					//$("#FinalInterview").prop('style','position:static;visibility:visible;');	

				}else if(idStatus[0] == "Third Interview"){

					$("#FinalInterview").prop('style','position:static;visibility:visible;');	

				}else if(idStatus[0] == "Final Interview"){

					$("#HireAccept").prop('style','position:static;visibility:visible;');	

				}

			}

			}else{

			document.getElementById('withselected').style.visibility = "hidden";;

				}

								

			

		}		

		function statusUpdate(){

				$('#type').val('Rejected');
				
			if(checkTblApplication.length>0){

				if(sendersEmail == '' || sendersPassword == ''){

					alert('Please complete your email');

				}else{

				actionfunction('tbl_application',checkTblApplication);				

				checkTblApplication  = [];

				}

			}	
		
		

		

			// if(checkTblApplicant2.length>0){

			// actionfunction('tbl_applicant2',checkTblApplicant2);

			// checkTblApplicant2 = [];

			// }		

			// if(checkTblApplicant3.length>0){

			// actionfunction('tbl_applicant3',checkTblApplicant3);

			// checkTblApplicant3 = [];

			// }

		}

		 // for decline
		function statusUpdate2(){
			$('#type').val('Declined');
			var reasonValuex = $('#reasonValue').val();
			if(checkTblApplication.length>0){
				if(sendersEmail == '' || sendersPassword == ''){
					alert('Please complete your email');
				} else {
					actionfunction('tbl_application',checkTblApplication);
					checkTblApplication = [];
				}
			}
		} 



/*--START--*/

		function regionQuery(){

			var id = $('#selRegion option:checked').val();
			document.getElementById('municipality').innerHTML = "";

			if(id =='All'){

						document.getElementById('province_city').innerHTML = "";

			}else if(id == 'Metro Manila (NCR)'){

				$.ajax({

					url: 'address.php',

					type: 'POST',

					dataType: 'html',

					data:{rid: id, ajaxmanila: 1},

					success:function (data){

						document.getElementById('province_city').innerHTML = "<label class='control-label'>City</label><select class='select form-control' name='cities' >"+data+"</select>";

					},

					error: function(data){

						alert(data);	

					}	

				});

			}else{

				$.ajax({

					url: 'address.php',

					type: 'POST',

					dataType: 'html',

					data:{rid: id, ajaxprovince: 1},

					success:function (data){

						document.getElementById('province_city').innerHTML = "<label class='control-label'>Province</label><select class='select form-control' onchange='prov_function()' name='cities' id='selProv'>"+data+"</select>";

					},

					error: function(data){

						alert(data);	

					}	

				});

			}

		}

		

		function prov_function(){///provincial

		var id = $('#selProv option:checked').val();

							$.ajax({

					url: 'address.php',

					type: 'POST',

					dataType: 'html',

					data:{pid: id, ajaxcities: 1},

					success:function (data){

						document.getElementById('municipality').innerHTML = "<label class='control-label'>City/Municipality</label><select class='select form-control'  name='municipality' id='selProv'>"+data+"</select>";

					},

					error: function(data){

						alert(data);	

					}	

				});

		}

/*--END--*/		
		


		function actionfunction(nameTbl,myArray) {	///////status and stage algorithm

			$('#delmodal').modal('hide');
			$('#declineModal').modal('hide');
			var typex = $('#type').val();
			var reasonValuex = $('#reasonValue').val();
			var comment = "";

			var idsx = myArray.toString();

			$.ajax({

				url: "actions.php",

				type: "POST",

				dataType: "html",

				data: {
				source: nameTbl, 
				note: reasonValuex,	
				types: typex, 
				ids: idsx, 
				schedule: sched,
				status: interviewType,
				fname: interviewerFName,
				lname: interviewerLName,
				mname: interviewerMName,
				passUser: sendersPassword,
				accountUser: sendersEmail,
				interviewerAccount: interviewerEmail},

				success: function(data){

					var setClass = "";
					location.reload();
					alert(data);

					if(typex == 'Rejected'){

			    		setClass = 'label-danger';

			    	}

					else if(typex == 'Declined'){

			    		setClass = 'label-danger';

			    	}

			    	else if(typex == 'No show'){

			    		setClass = 'label-danger';

			    	}

			    	else if(typex == 'Failed' || typex == 'No Show'){

			    		setClass = 'label-danger';

			    	}

			    	else if(typex == 'Passed'){

			    		setClass = 'label-info';

			    	}

			    	else if(typex == 'Passed - Endorsed'){

			    		setClass = 'label-primary';

			    	}



					$.each(myArray, function (index, value) {

						var dt = $("#myTable").dataTable();

						var dtNodes = dt.fnGetNodes();

						var dtNodeCount = dtNodes.length;

						

						for (var i = 0; i < dtNodeCount; i++) {

							$.each(myArray, function (index, value) {

								

								if(dtNodes[i].cells[0].innerHTML.includes(value)){

									if(typex=='interview'){

										dtNodes[i].cells[schedTdNum].innerHTML = "<h6 id='sched"+value+"' ' >"+sched+"</h6>";

										dtNodes[i].cells[statusTdNum].innerHTML = "<span id='span"+value+"' style='color:white; font-size: 105%;' class='label label-success'>"+interviewType+"</span>";

										dtNodes[i].cells[statusTdNum+1].innerHTML = "<span id='span"+value+"' style='color:white; font-size: 105%;'  class='label label-default'>Pending</span>";

										dtNodes[i].cells[0].innerHTML = "<input id='cb"+value+"' data-id='"+value+"' type='checkbox' class='checkbox'/>";

									}else if(typex == 'Passed' || typex == 'Failed' || typex == 'Passed - Endorsed' || typex == 'No Show'){

										dtNodes[i].cells[statusTdNum+1].innerHTML = "<span id='span"+value+"' style='color:white; font-size: 105%;'  class='label "+setClass+"'>"+typex+"</span>";

									}else{

										dtNodes[i].cells[schedTdNum].innerHTML = "<h6 id='sched"+value+"' ' ></h6>";

										dtNodes[i].cells[statusTdNum].innerHTML = "<span id='span"+value+"' style='color:white; font-size: 105%;'  class='label "+setClass+"'>"+typex+"</span>";

										dtNodes[i].cells[0].innerHTML = "<input id='cb"+value+"' data-id='"+value+"' type='checkbox' class='checkbox'/>";

										dtNodes[i].cells[statusTdNum+1].innerHTML = "<span id='span"+value+"' style='color:white; font-size: 105%;'  ></span>";

									}

								}

							});

						}

					});

					if(typex == 'interview'){

			    	$('#interviewModal').modal('hide');

						if(adminID == 0 ){

							sendersEmail = '';

							sendersPassword = '';

							$('#interviewerAccount').val('');

							$('#interviewerEmail').val('');

							$('#interviewerFName').val('');

							$('#interviewerLName').val('');

							$('#interviewerMName').val('');

							$('#dateInterview').val('');

							$('#userEmail').val('');

							$('#userPass').val('');

						}

			    	}

					 document.getElementById('withselected').style.visibility = "hidden";

						$('.checkbox').prop('checked',false);

						idHolder = [];

						idStatus = [];

						$('.openOveride').prop('style','position:absolute;visibility:hidden;');

						checkSimilarity = false;

						if($('tr').hasClass('selected')){

							myTable.rows( 'tr' ).deselect()

						}

						$('#refreshthis').load(document.URL +  ' #refreshthis');

						



				},

				error: function(data){

					alert(data);

				}

			});

		}

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

		function viewmsgs(){

			var id = $('#appid').val();



			$.ajax({

				url: "viewemail.php",

				type: "POST",

				data: {id: id, source: "google"},

				dataType: "html",

				success: function(data){

					var messages = data;

					document.getElementById('datahere').innerHTML = data;

					$('#mowdal').modal('show');

				},

				error: function(data){

					alert("Error!" + data);

				}

			});

		}

	</script>



	<div id="mowdal" class="modal fade" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header" style='color:white;background-color: #00008B'>

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Message History</h4>

				</div>

				<div class="modal-body">

					<div style="width: 100% ;height: 450px ;overflow-y: scroll;">

						<p id="datahere"></p>

					</div>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>

			</div>

		</div>

	</div>

</body>

</html>