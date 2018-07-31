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
	<meta name="viewport" content="width=device-width, initial-scale=1; charset=ISO-8859-1">
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
<body style = 'background-color: white' onload="check();">
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
	
#ulPrint div a, #ulSave div a{
padding: 0;
border: none;
background: none;
}
#ulPrint div a span, #ulSave div span{
float: left;
}

.font{
	color: black;
}
.space{
	padding-left: 10px;
}
</style>
	<?php  
		include('sidenavhtml.php');
	?>


	<div id="main" >
			<nav style="width:103.25%; margin-top:-2%; margin-left:-2%; background-color:#F0F8FF;">
			  <div class="container-fluid">
				<ul class="nav navbar-nav">
				  <li data-toggle="dropdown-toggle"><a data-toggle='modal'><h4 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px; padding-right:10px; padding-left: -10px" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4></a></li>
				</ul>
				</div>
			</nav>

	<div class="row"><!--Status Change-->
		<div class="col-md-12">
				<div id = 'myData'>
				<center><h3 style="font-weight: bold;margin-bottom: 2%;margin-top:-2%;">General List</h3></center>
				<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr class="info">
                          <th>No.</th>
                          <th>Reference No.</th>
                          <th>Name of Applicant</th>
                          <th>Applicant's Details</th>
                          <th>Status</th>
                          <th>Action</th>
                          <th>Last Update</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
                        include('connect.php');

                        $sql = "SELECT * FROM tbl_application_info";
                          $result = $conn->query($sql);
                          if($result->num_rows > 0){
                              while($row = $result->fetch_assoc()) {
                        ?>
                        <tr id="stat">
                          <td><?php echo $row['application_no']; ?></td>
                          <td><?php echo $row['reference_code']; ?></td>
                          <td><?php echo $row['last_name'].",".$row['first_name']." ".$row['extension_name']." ".$row['middle_name']; ?></td>
                           <td>
                             <center>
                                    <a href="#" class="btn btn-primary btn-sm" title="View User" data-id="<?php echo $row['reference_code']; ?>" 
                                    data-toggle="modal" data-target="#modal_user_view" onClick="return view_client(this); view_client1(this);"> <i class="fa fa-eye"></i> View</a> &nbsp;
                              </center>
                          </td>

                          <td><?php if($row['status']=="1") { echo '<span style="font-weight:bold" class="text-success">Active</span>'; }   else if ($row['status'] == "2") { echo '<span style="font-weight:bold" class="text-warning">Suspend</span>'; } 
                          else if ($row['status'] == "3") { echo '<span style="font-weight:bold" class="text-danger">Remove</span>'; } ?></td>
                          <td>
                            <center>
                            <?php 
                            if($row['status'] =="1") 
                            { echo "
                           		<a href='#' style='font-weight:bold;' id='btnSuspend' class='btn btn-warning btn-sm' onClick='return suspend_accnt(this);' title='Suspend' data-content= ".$row['reference_code']." >Suspend</a>
                           		<a href='#' style='font-weight:bold;' id='btnDelete' class='btn btn-danger btn-sm' onClick='return delete_accnt(this);' title='Del' data-content= ".$row['reference_code']." >Remove</a>
                            "; }   
                            else if ($row['status'] == "2")
                            {echo "
                        		<a href='#' style='font-weight:bold;' id='btnActivate' class='btn btn-success btn-sm' onClick='return activate_accnt(this);' title='Activate' data-content= ".$row['reference_code']."  >Active</a>
                           		<a href='#' style='font-weight:bold;' id='btnDelete' class='btn btn-danger btn-sm' onClick='return delete_accnt(this);' title='Del' data-content= ".$row['reference_code']." >Remove</a>
                        	"; } 
                            else if ($row['status'] == "3")
                            {echo "
                        		<a href='#' style='font-weight:bold;' id='btnActivate' class='btn btn-success btn-sm' onClick='return activate_accnt(this);' title='Activate' data-content= ".$row['reference_code']."  >Active</a>
                           		<a href='#' style='font-weight:bold;' id='btnSuspend' class='btn btn-warning btn-sm' onClick='return suspend_accnt(this);' title='Suspend' data-content= ".$row['reference_code']." >Suspend</a>
                            ";} 
                            ?>
                            </center>
                          </td>
                          <td><?php echo $row['last_update']; ?></td>
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
	  </div>
<div id="modal_user_view" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color:;">
            <button type="button" class="close red" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Clients Information</h4> -->
          </div>
          <div class="modal-body">
			  <ul class="nav nav-tabs">
			    <li><a data-toggle="tab" href="#home"><span class="text-red">Personal Information</span></a></li>
			    <li><a data-toggle="tab" href="#menu1">Contact Information</a></li>
			    <li><a data-toggle="tab" href="#menu2">Work Experience</a></li>
			    <li><a data-toggle="tab" href="#menu3">Educational Background</a></li>
			    <li><a data-toggle="tab" href="#menu4">Other Information</a></li>
			  </ul>
		<form method="POST" action="" enctype="multipart/form-data">	  
			<div class="tab-content">
			    <div id="home" class="tab-pane fade in active">
			      <h4 style="font-weight: bold;">Personal Information</h4>
			      <hr style="margin-top: -2px;">
				        <div class="row">
					      	<div class="col-md-6">
					      		<label class="font">Applicant's Name:</label>
					      		<input type="text" name="applicant_name" id="applicant_name" class="form-control space" readonly>
					      	</div>
					      	<div class="col-md-6">
					      		<div class="col-sm-6">
					      			<label class="font">Gender:</label>
					      			<input type="text" name="gender" id="gender" class="form-control space" readonly>
					      		</div>
					      		<div class="col-sm-6">
					      			<label class="font">Date of Birth:</label>
					      			<input type="text" name="dob" id="dob" class="form-control space" readonly>
					      		</div>
					      	</div>
				        </div><br>
				        <div class="row">
					      	<div class="col-md-6">
					      		<label class="font">Place of Birth:</label>
					      		<input type="text" name="pob" id="pob" class="form-control space" readonly>
					      	</div>
					      	<div class="col-md-6">
					      		<div class="col-sm-6">
					      			<label class="font">Citizenship:</label>
					      			<input type="text" name="citizenship" id="citizenship" class="form-control space" readonly>
					      		</div>
					      		<div class="col-sm-6">
					      			<label class="font">Civil Status:</label>
					      			<input type="text" name="cstat" id="cscstat" class="form-control space" readonly>
					      		</div>
					      	</div>
				        </div><br>
					    <div class="row">
					      	<div class="col-md-12">
					      		<label class="font">Current Address:</label>
					      		<input type="text" name="cur_add" id="cur_add" class="form-control space" readonly>
					      	</div>
					    </div><br>
					    <div class="row">
					      	<div class="col-md-12">
					      		<label class="font">Provincial Address:</label>
					      		<input type="text" name="pro_add" id="pro_add" class="form-control space" readonly>
					      	</div>
					    </div>
			    </div>
			    <div id="menu1" class="tab-pane fade">
			      <h4 style="font-weight: bold;">Contact Information</h4>
			      <hr style="margin-top: -2px;">
					    <div class="row">
					    	<div class="col-md-6">
					    		<label class="font">Email Address:</label>
					    		<input type="text" name="email_ad" id="email_ad" class="form-control space" readonly>
					    	</div>
					    	<div class="col-md-6">
					    		<label class="font">Skype ID:</label>
					    		<input type="text" name="skype_acc" id="skype_acc" class="form-control space" readonly>
					    	</div>
					    </div><br>
					    <div class="row">
					    	<div class="col-md-6">
					    		<label class="font">Facebook Account:</label>
					    		<input type="text" name="fb_acc" id="fb_acc" class="form-control space" readonly>
					    	</div>
					    	<div class="col-md-6">
					    		<label class="font">Twitter Account:</label>
					    		<input type="text" name="twit_acc" id="twit_acc" class="form-control space" readonly>
					    	</div>
					    </div><br>
					    <div class="row">
					    	<div class="col-md-6">
					    		<label class="font">Home Tel #:</label>
					    		<input type="text" name="home_tel" id="home_tel" class="form-control space" readonly>
					    		
					    	</div>
					    	<div class="col-md-6">
					    		<label class="font">Mobile No.:</label>
					    		<input type="text" name="mobile_no" id="mobile_no" class="form-control space" readonly>
					    	</div>
					    </div><br>
					    <div class="row">
					    	<div class="col-md-6">
					    		<label class="font">Contact Person in case of Emergency:</label>
					    		<input type="text" name="contact_person" id="contact_person" class="form-control space" readonly>
					    		
					    	</div>
					    	<div class="col-md-6">
					    		<label class="font">Contact Person Details:</label>
					    		<input type="text" name="contact_details" id="contact_details" class="form-control space" readonly>
					    	</div>
					    </div>
			    </div>
			    <div id="menu2" class="tab-pane fade">
			    </div>
			    <div id="menu3" class="tab-pane fade">
			      <h4 style="font-weight: bold;"> Educational Background</h4>
			      <hr style="margin-top: -2px;">
			      	<div class="row">
			      		<div class="col-md-12">
			      			<h5 style="font-weight: bold;">Primary:</h5>
			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="col-md-4">
			      			<label class="font">Name of School</label>
			      			<input type="text" name="school_name" id="school_name" class="form-control space" readonly>
			      		</div>
			      		<div class="col-md-4">
			      			<label class="font">From - To:</label>
			      			<input type="text" name="fromTo" id="fromTo" class="form-control space" readonly>
			      		</div>
			      		<div class="col-md-4">
			      			<label class="font">Scholarship/Honors:</label>
			      			<input type="text" name="Scholarship" id="Scholarship" class="form-control space" readonly>
			      		</div>
			        </div>
			        <div class="row">
			      		<div class="col-md-12">
			      			<h5 style="font-weight: bold;">Secondary:</h5>
			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="col-md-4">
			      			<label class="font">Name of School</label>
			      			<input type="text" name="school_name1" id="school_name1" class="form-control space" readonly>
			      		</div>
			      		<div class="col-md-4">
			      			<label class="font">From - To:</label>
			      			<input type="text" name="fromTo1" id="fromTo1" class="form-control space" readonly>
			      		</div>
			      		<div class="col-md-4">
			      			<label>Scholarship/Honors:</label>
			      			<input type="text" name="Scholarship1" id="Scholarship1" class="form-control space" readonly>
			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="col-md-12">
			      			<h5 style="font-weight: bold;">Tertiary:</h5>
			      		</div>
			      	</div>
			        <div class="row">
				      	<div class="col-md-4">
				      		<label class="font">Name of School</label>
				      		<input type="text" name="school_name2" id="school_name2" class="form-control space" readonly>
				      	</div>
				      	<div class="col-md-4"><label>From - To:</label>
				      		<input type="text" name="fromTo2" id="fromTo2" class="form-control space" readonly>
				      	</div>
				      	<div class="col-md-4"><label>Degree Course / Vocational:</label>
				      		<input type="text" name="degree" id="degree" class="form-control space" readonly>
				      	</div>
			      	</div>
			      	<div class="row">
			      		
			      	</div>
			    </div>
			    <div id="menu4" class="tab-pane fade">
			    </div>
			</div>
		</form>

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

	  function view_client(e) {
            
            var member_id = $(e).attr('data-id');
 
            $.ajax({
                type: "POST",
                url: 'config/view_details.php',
                data: {member_id : member_id},
                success:(function(data){
                    var dt = JSON.parse(data);
                    
                    $('input#applicant_name').val(dt.name);
                    $('input#gender').val(dt.gender);
                    $('input#dob').val(dt.dob);
                    $('input#pob').val(dt.pob);
                    $('input#citizenship').val(dt.citizenship);
                    $('input#cstat').val(dt.citizenship);
                    $('input#cur_add').val(dt.current_address);
                    $('input#pro_add').val(dt.provincial_address);

                    $('input#email_ad').val(dt.mail);
                    $('input#skype_acc').val(dt.skype);
                    $('input#fb_acc').val(dt.facebook);
                    $('input#twit_acc').val(dt.twitter);
                    $('input#home_tel').val(dt.home_contact);
                    $('input#mobile_no').val(dt.mobile_contact);
                    $('input#contact_person').val(dt.contact_person);
                    $('input#contact_details').val(dt.contact_details);

                    $('input#school_name').val(dt.primary);
                    $('input#fromTo').val(dt.p_date);
                    $('input#Scholarship').val(dt.p_award);
                    $('input#school_name1').val(dt.secondary);
                    $('input#fromTo1').val(dt.s_date);
                    $('input#Scholarship1').val(dt.s_award);
                    $('input#school_name2').val(dt.tertiary);
                    $('input#fromTo2').val(dt.t_date);
                    $('input#degree').val(dt.t_degree);

                    var txtResult = "<h4 style='font-weight: bold;''>Work Experience</h4><hr style='margin-top: -2px;'>";

                    for(a = 1; a <= 4; a++){
                      var inclusiveDate = eval("dt.inclusivDate" + a);
                      var company_name = eval("dt.company_name" + a);
                      var company_address = eval("dt.company_address" + a);
                      var contact_no = eval("dt.contact_no" + a);
                      var position_title = eval("dt.position_title" + a);
                      var supervisor_name = eval("dt.supervisor_name" + a);
                      var salary = eval("dt.salary" + a);
                      var reason_leaving = eval("dt.reason_leaving" + a);

                      txtResult += "<div class='row'>";
                      txtResult += "<div class='col-md-3'>";
                      txtResult += "<label class='font'>From - To:</label><input value='" + inclusiveDate + "' type='text' name='inclusivedate' id='inclusivedate' class='form-control space'></div>";

                      txtResult += '<div class="col-md-4"><label class="font">Company Name:</label><input value="' + company_name + '" type="text" name="comp_name" id="comp_name" class="form-control space"></div>';
                      txtResult += '<div class="col-md-5"><label class="font">Company Address:</label><input value="' + company_address + '" type="text" name="" class="form-control space"></div>';
                      txtResult += '<div class="col-md-3"><label class="font">Contact Number:</label><input value="' + contact_no + '" type="text" name="cont_num" id="cont_num" class="form-control space"></div>';
                      txtResult += '</div><br>';
                      txtResult += '<div class="row">'
                      txtResult += '<div class="col-md-4"><label class="font">Position Title:</label><input value="' + position_title + '" type="text" name="position" id="position" class="form-control space"></div>'
                      txtResult +='<div class="col-md-5"><label class="font">Name of immediate supervisor:</label><input value="' + supervisor_name + '" type="text" name="supervisor_name" id="supervisor_name" class="form-control space"></div>'
                      txtResult +='<div class="col-md-3"><label class="font">Salary:</label><input  value="' + salary + '" type="text" name="salary" id="salary" class="form-control space"></div></div><br><div class="row"><div class="col-md-12"><label class="font">Reason for Leaving:</label><input  value="' + reason_leaving + '" type="text" name="reason" id="reason" class="form-control space"></div></div><hr style="border: 4px solid silver">';
                    }
					document.getElementById("menu2").innerHTML = txtResult;

					var txtcontent = "<h4 style='font-weight: bold;'>Professional Qualifications</h4><hr style='margin-top: -2px;'>";

					for(b = 1; b <= 3; b++){
						 var License = eval("dt.license" + b);
						 var Rating = eval("dt.rating" + b);
						 var Date_granted = eval("dt.granted" + b);
						 var Granting_Institution = eval("dt.institution" + b);
						 var Licensed_number = eval("dt.license_num" + b);
						 var Date_release = eval("dt.release" + b);


						txtcontent += '<div class="row">';
						txtcontent += '<div class="col-md-4"><label class="font">License/Certification</label><input type="text" value="'+ License +'" class="form-control space"></div>';
						txtcontent += '<div class="col-md-4"><label class="font">Rating</label><input type="text" value="'+ Rating +'" class="form-control space"></div>';
						txtcontent += '<div class="col-md-4"><label class="font">Date Granted:</label><input type="text" value="'+ Date_granted +'" class="form-control space"></div>';
						txtcontent += '</div>';
						txtcontent += '<div class="row">';
						txtcontent += '<div class="col-md-4"><label class="font">Granting Institution:</label><input type="text" value="'+ Granting_Institution +'" class="form-control space"></div>';
						txtcontent += '<div class="col-md-4"><label class="font">License Number:</label><input type="text" value="'+ Licensed_number +'" class="form-control space"></div>';
						txtcontent += '<div class="col-md-4"><label class="font">Date Release:</label><input type="text" value="'+ Date_release +'" class="form-control space"></div>';
						txtcontent += '</div><br><br><hr style="border: 4px solid silver">';

					

					}
					document.getElementById("menu4").innerHTML = txtcontent;
                                                            
                })
            });
            
            return true;
        } 

</script>
<script type="text/javascript">

		 function delete_accnt(e) {
            
            var id = $(e).attr('data-content');
          
            var del = confirm("Are you sure to remove this account?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/delete_config.php',
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

         function activate_accnt(e) {
            
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to activate this account?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/activate_config.php',
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

         function suspend_accnt(e) {
            
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to suspend this account?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/suspend_config.php',
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
	function activateAccount(e){

		var id = $(e).attr('data-content');

	}
</script>
</body>
</html>
