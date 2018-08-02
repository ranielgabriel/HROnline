<html>
<?php
include('auth.php');
include('connect.php');
$ref_code = $_GET['id'];
?>   
   <head>
      <title>Application Source List</title>
      
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/sidenav.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
	<link rel="stylesheet" type="text/css" href="css/tether.css">
	<link rel="stylesheet" href="custom_js/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custom_js/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">

    <style type="text/css">
  #source_app,#source, #position_name, #position_name1, #pos_desc, #pos_desc1 {
  	border:1px solid black;
  	border-radius:5px;
  }
  h4.title{
  	font-weight: bold;
  }
	</style>
   </head>

   <body>
    <?php
	$id = $_GET['id'];
		include 'sidenavhtml.php';
	?>
	<div id="main" style="padding-bottom: 0px;">
		<nav style="width:103.25%;  margin-left:-2%; background-color:transparent;border-bottom: solid;">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
				  <h5 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif;padding-left: 15px;" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h5>
				</ul>
		    </div>
	    </nav>
    </div>
	<ul class="nav nav-tabs" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" href="#SoureList" role="tab" data-toggle="tab">Application Source List |</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Position List |</a>
	  </li>
		<li class="nav-item">
	    <a class="nav-link" href="#unavailable" role="tab" data-toggle="tab">Unavailable List |</a>
	  </li>
	</ul>
		<!-- Tab panes -->
		<div class="tab-content">
<!--start source -->		
			<div role="tabpanel" class="tab-pane fade in active" id="SoureList">
			  	<div class="container">
				   	<div class="row">
				   		<center><h4 class="title">Application Source List</h4></center>
				   		<div class="col-md-12">
				   			<button class="btn btn-raised btn-sm pull-right btn-primary" data-toggle="modal" data-target="#new_source">Add New Source</button>
				   			 <table id="example" class="table  table-bordered" cellspacing="0" width="100%">				   
								  <thead>
							      <tr>
							      	<th style="display: none;">No</th>
							        <th>Source Name</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<!-- view the application list -->
							    	<?php
							    	$sql = "SELECT `application_num`, `source_name` FROM tbl_sourceapplication WHERE flag = '0' ORDER BY application_num ASC";
							    	$result = $conn->query($sql);
							    	if($result->num_rows > 0){
				                        while($row = $result->fetch_array()) {
							    	?> 
							      <tr>
							      	<td style="display: none;"><?php echo $row['application_num'];?></td>
							        <td><?php echo $row['source_name'];?></td>
							        <td>
							        	<a href="#" data-toggle="modal" data-target="#edit_source"  onClick="return edit_source(this);" class="btn btn-primary btn-sm" title="Update" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['application_num']; ?>"> <span class="fa fa-pencil"></span></a>

							        	<a href="#" class="btn btn-danger btn-sm" onClick="return remove_source(this);" title="Remove" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['application_num']; ?>"><span class="fa fa-trash"></span></a>
							        </td>

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
	<!--end source -->	


	<!--start position list -->		
		  	<div role="tabpanel" class="tab-pane fade" id="buzz">
		  		<div class="container">
				   	<div class="row">
				   		<center><h4 class="title"> Position List</h4></center>
				   		<div class="col-md-12">
				   			<button class="btn btn-raised btn-sm pull-right btn-primary" data-toggle="modal" data-target="#position_mod">Add New Position</button>
				   			 <table id="example1" class="table  table-bordered" cellspacing="0" width="100%">
							    <thead>
							      <tr>
							      	<th style="display:none;">No</th>
							        <th>Position Name</th>
							        <th>Description</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<!-- view the application list -->
							    	<?php
							    	include('connect.php');
							    	$sql="SELECT `id`, `position_name`,`position_desc` FROM tbl_position WHERE status = '1'";
							    	$result = $conn->query($sql);
							    	if($result->num_rows > 0){
				                        while($row = $result->fetch_array()) {
							    	?> 
							      <tr>
							      	<td style="display:none;"><?php echo $row['id'];?></td>
							        <td><?php echo $row['position_name'];?></td>
							        <td><?php echo $row['position_desc'];?></td>
							        <td>
							        	<a href="#" data-toggle="modal" data-target="#edit_position"  onClick="return edit_position(this);" class="btn btn-primary btn-sm" title="Update" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['id']; ?>"> <span class="fa fa-pencil"></span></a>
					        			<a href="#" class="btn btn-danger btn-sm" onClick="return remove_position(this);" title="Remove" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['id']; ?>"><span class="fa fa-trash"></span></a>
							        </td>

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
<!--start position list -->		

<!--start unavailable position list -->	
				<div role="tabpanel" class="tab-pane fade" id="unavailable">
					<div class="container">
						<div class="row">
							<center><h4 class="title"> Unavailable Position List</h4></center>
								<div class="col-md-12">
									<!-- <button class="btn btn-raised btn-sm pull-right btn-primary" data-toggle="modal" data-target="#position_mod">Add New Position</button> -->
										<table id="example2" class="table  table-bordered" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th style="display:none;">No</th>
													<th>Position Name</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
<!-- view the application list -->
											<?php
													include('connect.php');
													$sql="SELECT `id`, `position_name`,`position_desc` FROM tbl_position WHERE status = '0'";
													$result = $conn->query($sql);
													if($result->num_rows > 0)
													{
															while($row = $result->fetch_array())
															{
															?> 
															<tr>
																<td style="display:none;"><?php echo $row['id'];?></td>
																<td><?php echo $row['position_name'];?></td>
																<td><?php echo $row['position_desc'];?></td>
																<td>
																	<a href="#" data-toggle="modal" data-target="#edit_position"  onClick="return edit_position(this);" class="btn btn-primary btn-sm" title="Update" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['id']; ?>"> <span class="fa fa-pencil"></span></a>
																	<a href="#" class="btn btn-danger btn-sm" onClick="return retrieve_position(this);" title="Retrieve" style="padding-left:20px;padding-right:20px;color: black" data-content="<?php echo $row['id']; ?>"><span class="	fa fa-archive"></span></a>
																</td>

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
			</div>
				
<!-- end Tab panes -->


<!-- Modal for new source-->
<div id="new_source" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center><h4 class="modal-title title">CREATE NEW APPLICATION SOURCE</h4></center><hr style="border-bottom: 2px solid silver">
      </div>
      <div class="modal-body">
	      <div class="container">
	      	<form method="POST" action="" id="frmsrc" name="frmsrc" enctype="multipart/form-data" onSubmit="return source_add();">
	      		<div class="form-group" style="margin-top:0px">
	      			<label style="color:black;">Enter application source:</label>
	      			<input type="text" name="source_app" id="source_app" class="form-control">
	      			<p id="err"></p>
	      		</div>	
	      	</form>
      </div>
      </div>
      <!-- button for floating window update position -->
      <div class="modal-footer">
      	<button type="submit" form="frmsrc" class="btn btn btn-raised btn-primary btn-md">Add</button>
       </div>
      </div>
  </div>
</div>

<!-- Modal for editing source-->
<div id="edit_source" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center><h4 class="modal-title title">UPDATE APPLICATION SOURCE</h4></center><hr style="border-bottom: 2px solid silver">
      </div>
      <div class="modal-body">
	      <div class="container">
	      	<form method="POST" action="" id="frmUpdate" name="frmUpdate" enctype="multipart/form-data" onSubmit="return source_edit();">
	      		<div class="form-group" style="margin-top:0px">
	      			<input type="hidden" name="idField" id="idField">
	      			<label style="color:black;">Enter new application source:</label>
	      			<input type="text" name="source" id="source" class="form-control">
	      		</div>	
	      	</form>
      </div>
      </div>
      <!-- button for floating window update position -->
      <div class="modal-footer">
      	<button type="submit" form="frmUpdate" class="btn btn btn-raised btn-primary btn-md">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- ********************************************* -->

<!-- Modal for creating new position-->
<div id="position_mod" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center><h4 class="modal-title title">CREATE NEW POSITION</h4></center><hr style="border-bottom: 2px solid silver">
      </div>
      <div class="modal-body">
	    <div class="container">
	      	<form method="POST" action="" id="frmPosition" name="frmPosition" enctype="multipart/form-data" onSubmit="return pos_add();">
	      		<div class="form-group" style="margin-top:0px">
	      			<label style="color:black;">Enter New Position:</label>
	      			<input type="text" name="position_name" id="position_name" class="form-control">
	      		</div>
	      		<div class="form-group" style="margin-top:0px;">
	      			<label style="color:black;">Enter Position's Description:</label>
	      			<textarea class="form-control" id="pos_desc" name="pos_desc" rows="5"></textarea>
	      		</div>	
	      	</form>
      	</div>
      </div>
      <!-- button for floating window update position -->
      <div class="modal-footer">
      	<button type="submit" form="frmPosition" class="btn btn btn-raised btn-primary btn-md">Add</button>
       </div>
      </div>
  </div>
</div>

<!-- Modal for creating new position-->
<div id="edit_position" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center><h4 class="modal-title title">UPDATE POSITION</h4></center><hr style="border-bottom: 2px solid silver">
      </div>
      <div class="modal-body">
	    <div class="container">
	      	<form method="POST" action="" id="frmEdit" name="frmEdit" enctype="multipart/form-data" onSubmit="return pos_edit();">
	      		<div class="form-group" style="margin-top:0px">
	      			<input type="hidden" name="pos_id" id="pos_id">
	      			<label style="color:black;">Enter New Position:</label>
	      			<input type="text" name="position_name1" id="position_name1" class="form-control">
	      		</div>
	      		<div class="form-group" style="margin-top:0px;">
	      			<label style="color:black;">Enter Position's Description:</label>
	      			<textarea class="form-control" id="pos_desc1" name="pos_desc1" rows="5"></textarea>
	      		</div>	
	      	</form>
      	</div>
      </div>
      <!-- button for floating window update position -->
      <div class="modal-footer">
      	<!-- <button type="submit" class="btn btn btn-raised btn-primary btn-md"  onclick="copy_pos();">Update</button> -->
      	<button type="submit" form="frmEdit" class="btn btn btn-raised btn-primary btn-md pull-right" id="doSubmit" name="doSubmit">Submit</button>
       </div>
      </div>
  </div>
</div>
<!-- ********************************************* -->

	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>	
	<script type="text/javascript" src="js/material.js"></script>
	<script type="text/javascript" src="js/jquery.dropdown.js"></script>
	<script type="text/javascript" src="custom_js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="custom_js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="custom_js/dataTables.bootstrap.min.js" ></script>
	<script type="text/javascript">
		// script for table 
		$(document).ready(function() {
    		$('#example').DataTable();
		} );
	</script>
	<script type="text/javascript">
		// script for table 
		$(document).ready(function() {
    		$('#example1').DataTable();
		} );

		$(document).ready(function() {
    		$('#example2').DataTable();
		} );
	</script>
	<script type="text/javascript">
	// add new position
		function pos_add(){
			 event.preventDefault();
				var position  = $('input#position_name').val();
				var description = document.getElementById("pos_desc").value;
				$.ajax({
					type: "POST",
					url: 'config/add_position.php',
					data:{position : position, description : description},
					success:(function(data){
						alert(data);
						location.reload();
					})
				});
			};
	// remove position
		function remove_position(e) {
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to remove this source application?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/remove_position.php',
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

function retrieve_position(e) {
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to retrieve this source application?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/retrieve_position.php',
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

    // display position to be edited
        function edit_position(e){
        	 var id_position = $(e).attr('data-content');

        	 $.ajax({
                type: "POST",
                url: 'config/view_position.php',
                data: {id_position : id_position},
                success:(function(data){
                    var dt = JSON.parse(data);
                    
                    $('input#position_name1').val(dt.position_name);
                    $('textarea#pos_desc1').html(dt.position_description);
                    $('input#pos_id').val(dt.position_id);  
                })
            });
            return true;
        } 
        // submit edited position
        function pos_edit(e){
			 event.preventDefault();

			 	var id = $('input#pos_id').val();
			 	var pos = $('input#position_name1').val();
			 	var des = document.getElementById("pos_desc1").value

				$.ajax({
					type: "POST",
					url: 'config/update_position.php',
					data:{id : id,  pos : pos, des : des},
					success:(function(data){
						alert(data);
						location.reload();
					})
				});
			}
	</script>
	<!-- *********************************************** -->
	<script type="text/javascript"> 
	// add new application source
		function source_add(){
			 event.preventDefault();
			 var source = document.getElementById("source_app").value;
    			$.ajax({
					type: "POST",
					url: 'config/add_source.php',
					data:{source : source},
					success:(function(data){
						alert(data);
						location.reload();
					})
				});
			}
	// remove application source
		 function remove_source(e) {
            var id = $(e).attr('data-content');
            var del = confirm("Are you sure to remove this source application?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'config/remove_source.php',
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
// edit application source
        function edit_source(e){
        	 var ids = $(e).attr('data-content');
        	 document.getElementById("idField").value = ids;
        	}

        function source_edit(){
			 event.preventDefault();

			 	var id  = $('input#idField').val();
			 	var newApp = $('input#source').val();
			 	// alert(newApp);

				$.ajax({
					type: "POST",
					url: 'config/edit_source.php',
					data:{id : id,  newApp : newApp},
					success:(function(data){
						alert(data);
						location.reload();
					})
				});
			}
	</script>

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
</body>
</html>