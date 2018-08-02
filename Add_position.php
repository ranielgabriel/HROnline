<html>
<?php
include('auth.php');
	$_SESSION['previous-page'] = 'account.php';
unset($_SESSION['neco']);

include('connect.php');
$ref_code = $_GET['id'];

$msg1 = "";
$msg2 = "";
$msg3 = "";

if (isset($_POST['submit'])) {
	$pos = $_POST['position'];
	$des = $_POST['description'];

	$sql_sel="SELECT * FROM tbl_position WHERE position_name = '$pos'";
	$result = $conn->query($sql_sel);
	$row = $result->fetch_assoc();
	if ($_POST['position']==$row['position_name']) {
			$msg1 = "Position already exist!";
		}
		else{
			$sql = "INSERT INTO tbl_position (position_name, position_desc,status) VALUES ('".$pos."','".$des."','1')"; 
		$res = $conn->query($sql); 
		if ($res==true) 
			{ $msg2 = "New position has been added"; }
		else { $msg3 = "Failed to add position"; }
	}	
}
?>  
   <head>
      <title>Add New Position</title>
      
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
	<nav style="width:103.25%;  margin-left:-2%; background-color:transparent;border-bottom: solid;">
			 <div class="container-fluid">
				<ul class="nav navbar-nav">
				  <h5 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif;padding-left: 15px;" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h5>
				</ul>
            </div>
     </nav>
   <div class="row">
	   	<div class="col-md-5">
	   		<div class="container">
	   			<div class="">
	   				<center>
	   					<h4 style="color: black; font-weight: bold; ">Add New Positions</h4>
	   					
	   				</center>
	   				<form class="form-horizontal" method="POST" action="Add_position.php?id=<?php echo $ref_code;?>">
	   					<div class="container">
	   						<div class="form-group">
	   							<center>
	   							<span style="font-weight: bold;color:red;"><?php echo $msg1;?></span>
	   							<span style="font-weight: bold;color:red;"><?php echo $msg2;?></span>
	   							<span style="font-weight: bold;color:red;"><?php echo $msg3;?></span>
	   						</center>
	   						</div>
	   						<div class="form-group">
	   							<div class="row">
	   								<div class="col-sm-3">
	   									<label style="padding-left: 20%;font-weight: bold;">Position:</label>
	   								</div>
	   								<div class="col-sm-9">
	   									<input type="text" name="position" id="position" class="form-control" required>
	   								</div>
	   							</div>
	   				    	</div>
	   				    	<div class="form-group">
	   				    		<div class="row">
	   								<div class="col-sm-3">
	   									<label style="padding-left: 20%;font-weight: bold;">Description:</label>
	   								</div>
	   								<div class="col-sm-9">
	   									<input type="text" name="description" id="description" class="form-control" required>
	   								</div>
	   							</div>
	   				    	</div>
	   				    	<div class="form-group">
	   							<button type="submit" name="submit" id="submit" class="btn btn-raised btn-primary pull-right btn-md" style="padding-left: 5%;padding-right: 5%;"> ADD</button>
	   				    	</div>
	   					</div>
	   				</form>
	   				
	   			</div>
	   		</div>
	   	</div>
	   	<div class="col-md-7">
	   		<div class="container">
			  <center>
			  	<h4 style="font-weight: bold;">List of Position</h4>
			  </center>           
			  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			    <thead>
			      <tr>
			      	<th style="display: none;">ID</th>
			        <th>Position</th>
			        <th>Desciption</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php
			    	$sql = "SELECT * FROM tbl_position WHERE status = '1' ORDER BY position_name ASC";
			    	$result = $conn->query($sql);
			    	if($result->num_rows > 0){
                        while($row = $result->fetch_array()) {
			    	?>
			      <tr>
			      	<td style="display: none;"><?php echo $row['id'];?></td>
			        <td><?php echo $row['position_name'];?></td>
			        <td><?php echo $row['position_desc'];?></td>
			        <td><a href="#" data-content="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onClick="return remove_pos(this);" title="Remove" style="padding-left:20px;padding-right:20px;color: black">Remove</a></td>
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

	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>	
	<script type="text/javascript" src="js/material.js"></script>
	<script type="text/javascript" src="js/jquery.dropdown.js"></script>

	<script type="text/javascript" src="custom_js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="custom_js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="custom_js/dataTables.bootstrap.min.js" ></script>

	<script type="text/javascript">
		 function remove_pos(e) {
            
            var id = $(e).attr('data-content');
                        
            var del = confirm("Are you sure to remove this position?");
            if (del == true) {
                $.ajax({
                    type: "POST",
                    url: 'remove_config.php',
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
        
		$(document).ready(function() {
    $('#example').DataTable();
} );
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

 <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/material.js"></script>
  <script type="text/javascript" src="custom_js/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="custom_js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="custom_js/dataTables.bootstrap.min,js"></script>
  
	<script src="js/bootstrap.min.js"></script>
	<!-- <style>
		#select{
			width:150px;
		}
		#select option{
			width:150px;
		}
	
	</style> -->
</body>
</html>