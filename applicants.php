<?php
	require_once('auth.php');
	require_once('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Applicants List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.material.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/sidenav.css">
	<link rel="stylesheet" type="text/css" href="custom_css/applicants.css">
</head>
<body>
	<?php include('sidenavhtml.php'); ?>
	<div id="main">
		<div class="row" style="z-index:1; margin-top:-20px;" id="topDiv">
			<nav  class="navbar navbar-inverse" >
				<div class="container-fluid" id= 'navHead' style = 'background-color:#dfe5ec;'>
					<a class="navbar-brand" style="cursor:pointer; z-index:1;" href="#"><h4 style="font-family:'Trebuchet MS', Helvetica, sans-serif; cursor:pointer; z-index:1; color:#00008B;" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4></a>
					<span style = "position:absolute;left:0;right:0;text-align:center;"><h3 style="color:#00008B;">Applicants List</h3></span>
				</div>
			</nav>
		</div>
		<div class="">
			<form id="search-form"> 
				<input type="text" id="search" placeholder="Search" required />
				<div id="search-icon"></div>
			</form>
			<div class="table-responsive">
				<div id="result"></div>
				<div id="initial-table">
					
					<center>
						<h4> TOTAL:
						<?php
							include('connect.php');
							$sql="SELECT * FROM tbl_application WHERE NOT NAME=',' AND NOT `EMAIL ADDRESS`='' ORDER BY ID";
                         	$result = $conn->query($sql);
          						if($result->num_rows > 0){
          							$count = $result->num_rows;
										if($count <= 1) {$label = "applicant";} 
										else {$label = "applicants";}
							echo $count.' '.$label; 
					 		}
                            $conn->close();
                            ?>
						</h4>
					</center>
					<table id="applicants" class="table table-bordered table-hover table-responsive">
						<thead>
						<col width="200">
						<col width="30">
							<tr>
								<th>Name</th>
								<th>Position Applied</th>
								<th>Employment Date</th>
								<th>Application Source</th>
								<th>Education Status</th>
								<th>School</th>
								<th>Course</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="result">
							<?php
                        		include('connect.php');
                        			$sql="SELECT ID, NAME, POSITION, `EMAIL ADDRESS`, EMPLOYMENT_DATE, APPLICATION_SOURCE, `COL_Name of School`, `GRAD_Degree Course`, COL_Graduated FROM tbl_application WHERE NOT NAME=',' AND NOT `EMAIL ADDRESS`='' ORDER BY ID";
                          				$result = $conn->query($sql);
                          					if($result->num_rows > 0){
                          						 $count = $result->num_rows;
													if($count <= 1) {
														$label = "applicant";
													} else {
														$label = "applicants";
													}
                              					while($row = $result->fetch_assoc()) {
                       		?>
                       		<tr class="applicant-data" data-toggle="modal" data-target="#applicant-info" data-id="<?php echo $row['ID']; ?>">
                       			<td><?php echo $row['NAME']; ?></td>
                       			<td><?php echo $row['POSITION']; ?></td>
                       			<td><?php echo $row['EMPLOYMENT_DATE']; ?></td>
                       			<td><?php echo $row['APPLICATION_SOURCE']; ?></td>
                       			<td><?php if ($row['COL_Graduated']=="YES") 
                       			{ echo "Graduated"; } 
                       			else if ($row['COL_Graduated']=="NO") 
                       			{ echo "Undergraduate"; }
                       			?></td>
                       			<td><?php echo $row['COL_Name of School']; ?></td>
                       			<td><?php echo $row['GRAD_Degree Course']; ?></td>
                       			<td>
                       				<!-- Button for remove record. Reported bug: modal still appearing -->
	                       			<button class="btn btn-danger btn-sm" onClick="return remove_applicant(this);" data-dismiss="modal" title="Remove" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['ID']; ?>"><span class="fa fa-trash"></span>
	                       			</button>
	                       		</td>
	                       		</tr>
                       		 <?php
	                            }
	                            	}
                            $conn->close();
                            ?>

						</tbody>
					</table>
					<center>
						<span>Total: <?php echo $count.' '.$label; ?></span>
					</center>
				</div>
			</div>
			<div style="position:fixed;bottom:25px;right:25px">
				<a class="getCSV">Save as CSV</a>
				<a class="getExcel" onclick="window.open('data:application/vnd.ms-excel,' + document.getElementById('applicants').outerHTML.replace(/ /g, '%20'));">Save as Excel</a>
			</div>
		</div>
	</div>
	<div id="applicant-info" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Applicant Information</h4>
				</div>
				<div id="modal-info"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/csv.js"></script>
	<script type="text/javascript">
		$('.getCSV').click( function() { 
			exportTableToCSV.apply(this, [$('#applicants'), 'applicants.csv']);
		});
	</script>
	<script type="text/javascript">
		$('input').on('keypress', function(e) {
			return e.which !== 13;
		});
	</script>
	<script type="text/javascript">
		function openNav() {
			document.getElementById("mySidenav").style.width = "300px";
			document.getElementById("main").style.marginLeft = "300px";
		}
		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft= "0";
		}
	</script>
	<script type="text/javascript">
		$('#search-icon').click(function(){
			$('#search').focus();
			$('#search').css('width','50%');
			$('#search').css('opacity','1');
		});
		$('#search').focusout(function(){
			$('#search').css('width','0');
			$('#search').css('opacity','0');
		});
	</script>
	<script type="text/javascript">
		function fill(Value) {
		  	$('#search').val(Value);
			$('#result').hide();
		}
		$(document).ready(function() {
		  	$("#search").keyup(function() {
		       	var name = $('#search').val();
		       	if (name == "") {
					$("#initial-table").show();
		            $("#result").html("");
		     	}
		     	else {
		           	$.ajax({
		               type: "POST",
		               url: "search.php",
		               data: {
		                   search: name
		               },
		               success: function(html) {
						   $("#initial-table").hide();
		                   $("#result").html(html).show();
		               }
		            });
				    $.ajax({
		               type: "POST",
		               url: "jsonsearch.php",
		               data: {
		                   jsonsearch: name
		               },
					   dataType: "json"
		            });
		       }
		   });
		});
	</script>
	<script type="text/javascript">
		$('.applicant-data').click(function(e) {
			var applid = $(this).attr("data-id");
           	$.ajax({
               type: "POST",
               url: "applicant-data.php",
               data: {
                   aid: applid
               },
               success: function(html) {
                   $("#modal-info").html(html).show();
               }
           });
		});
	</script>

	<script type="text/javascript">
		// remove application source
		 function remove_applicant(e) {
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to remove this record?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/remove_applicant.php',
                    data: {id : id},
                    success:(function(data){
                        alert(data);
                        location.reload();
                    })
                });
                return true;
            } else {
                return false;
            }
        }
	</script>
</body>
</html>