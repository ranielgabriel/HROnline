<?php
	
	include('auth.php');/*session_start()*/
	include('connect.php');
	$currentYear ="";
	//unset($_SESSION['currentYear']);
	$_SESSION['previous-page'] = 'reportsMarketing.php';
	$id = $_SESSION['id'];
	$startDate = "";
	$endDate = "";
	if(isset($_POST['startDate'])){
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		unset($_POST['startDate']);
		unset($_POST['endDate']);
	}else{
		$startDate = date('Y-m-d', strtotime('first day of this month'));
		$endDate = date('Y-m-d', strtotime('-1d')); 
	}
	$currentYear = date('Y',strtotime($endDate)); 
?>

	<!DOCTYPE html>
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
	</head>
	<body style = 'background-color:#dfe5ec'>
		<style type="text/css">
			.active{
				background-color: #1a1a1a;
			}
			ul {
			  list-style-type: none;
			}
			.rightTwoPercent{
				margin-right: 2%;
			}
			#navHead,#topDiv{
			background-color: #03a9f4;
			}
		</style>
<?php include('sidenaveMarketing.php');?>

		<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>

		<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<!-- Inline CSS based on choices in "Settings" tab -->
		<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


		<div id="main" >
			<div class="row"style = "position:fixed; z-index:1; width:100%; margin-top:-20px; background-color:#dfe5ec;" id = 'topDiv'>
				<nav  class="navbar navbar-inverse" >
				  <div class="container-fluid" id= 'navHead' style = 'background-color:#dfe5ec;'>
						<a class="navbar-brand" style="cursor:pointer; z-index:1;" href="#"><h4 style="font-family:'Trebuchet MS', Helvetica, sans-serif; cursor:pointer; z-index:1; color:#00008B;" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4></a>		  
						<!--span style = " position:absolute;left:0;right:0;text-align: center; " ><h2 id ='thisYear' style = ' color:black;'><?php echo $currentYear;?> </h2></span-->
						<span style = " position:absolute;left:0;right:0;text-align:center;"><h3 style="color:#00008B;">R E P O R T S </h3></span>
					</div>
				</nav>
			</div>
		
			<div class="row" style = 'margin-top:4%;'>
				<div class="col-md-12">
					<!-- REPORTS -->
					<div  id="reportscontainer2" >				
						<h1></h1>
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color:#97b6ca;'>
									<h4 style='color:black'><b>Monthly Number of Applicants (<span id="thisYear"><?php echo $currentYear; ?></span>)</b>
										<legend class="text-center"><i href="#chart7" data-parent="#accordion" data-toggle="collapse" class="fa fa-angle-down pull-right "></i></legend></h4>
									</div>
									<div id="chart7" class="panel-collapse collapse in">
										<div class="panel-body container-fluid" style="width: 100% ;height: 450px ;">
										<span class ="btn"><a  style = "float:right; top:10%;" class = "fa fa-print" id ="printFixData" onclick = "save()">Print</a></span>  
                                            <div class="container">
                                            <h2 style="font-family:'Trebuchet MS', Helvetica, sans-serif; margin-left:16em;"><!--Months Graph--> </h2>
											<div id="chart7" class="panel-collapse collapse in">
                                              
                                        </div>
												<div class="panel-body">
													<canvas id="myChart7" height="90" class = "Annual Report"></canvas>
												</div>
											</div>
											<hr>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<h1></h1>
					<div class = "row">
					<div class="col-lg-12">
					<div class="panel-heading " style = 'background-color:#97b6ca;color:black'>
					<h4><b>Total Number of Applicants within Set Date</b></h4>
						<legend class="text-center" style ='margin-bottom:1%;'><i href="#adjustDate" data-parent="#accordion" data-toggle="collapse" class="fa fa-angle-down pull-right collapsed" aria-expanded = 'false' aria-controls='adjustDate'> </i></legend>
					<h1> </h1>
					</div>
					<div id ='adjustDate' class="collapse" style = 'background-color: #dfe5ec; padding-top:1.5%;'>
						<div class= 'row' > 
							<div class="bootstrap-iso" >
							   <div class="col-md-6 col-sm-6 col-xs-12">
								 <div class="form-group ">
									  <div class="col-sm-10" style = "margin-bottom:2%;">
										  <label for="date"  style ='color:black;'>
												Start Date
										  </label>
										  <div class="input-group">
											<div class="input-group-addon">
												 <i class="fa fa-calendar">
												 </i>
											</div>
											<input class="form-control" id="dateStart" name="date"  type="text"/>
										   </div>
									  </div>
								 </div>
							   </div> 
							</div>
							<div class="bootstrap-iso" >
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group ">
										<div class="col-sm-10" style = "margin-bottom:2%; float:right;" >
											<label for="date" style ='color:black;'>
												End Date
											</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input class="form-control" id="dateEnd" name="date" type="text"/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					<div class = 'row' >
					<div class="col-lg-10" style = 'width:70%; margin-left:16%'>
						<div class="panel panel-info">								
							<div class="panel-heading " style = 'background-color:#dab358'>
								<legend class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Application<i href="#jobChart" data-parent="#accordion" data-toggle="collapse"></i></legend>
							</div>
							<center>
							<div id="jobChart" class="panel-collapse collapse in">
								<div class="panel-body">
									<div id ='myTableContainer'>
										<table id = 'tblTitleJob'>
											<thead>
													<th>Job Titles</th>
													<th>Number of Applicants</th>
											</thead>
											<tbody>
												<?php
													include 'chartPosition.php';
												?>
											</tbody>
										</table>	
									</div>
								</div>
							</div>
							</center>
							</div>
						</div>
					</div>
					<h1></h1>
					 
						<div class="row" style = 'margin-left:10%;'>
							<div class="col-md-5">
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color:#dab358'>
										<h3 class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Age Bracket </h3>
										<legend class="text-center"><i href="#chart3" data-parent="#accordion" data-toggle="collapse" ></i></legend>
									</div>
									<div id="chart3" class="panel-collapse collapse in">
                                        <div class="container"></div>
										<div class="panel-body">
											<canvas id="myChart3" height="180px"></canvas>
											<hr>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5" style = 'margin-right:10%; float:right;'>
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color:#dab358'>
										<h3 class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Gender</h3>
										<legend class="text-center"><i data-toggle="collapse" data-parent="#accordion" href="#chart2" ></i></legend>
									</div>
									<div id="chart2" class="panel-collapse collapse in">
                                        <div class="container"></div>
										<div class="panel-body">
											<canvas id="myChart2" height="180px"></canvas>
											<hr>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						</div>
						</div>
						<h1></h1>
						<h1></h1>
					<div class = "row">
					<div class="col-lg-12">
					<div class="panel-heading " style = 'background-color:#97b6ca;color:black;'>
					<h4><b>Application Source and Status Graph</b><legend class="text-center" style ='margin-bottom:1%;'><i href="#fixInfo" data-parent="#accordion" data-toggle="collapse" class="fa fa-angle-down pull-right collapsed" aria-expanded = 'false' aria-controls='fixInfo'></i></legend></h4>

					</div>
					<div id ='fixInfo' class="collapse" style = 'background-color: #dfe5ec; padding-top:2%;'>	
						<h1></h1>
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color:#dab358'>
										<h3 class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Application Source</h3>
									</div>
									<div id="chart1" class="panel-collapse collapse in">
                                        <div class="container"></div>   
										<div class="panel-body">
											<canvas id="myChart" height="180px"></canvas>
											<hr>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color: #dab358'>
										<h3 class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Applicant Status</h3>
									</div>
									<div id="chart4" class="panel-collapse collapse in">
                                        <div class="container"></div>
										<div class="panel-body">
											<canvas id="myChart4" height="180px"></canvas>
											<hr>
										</div>
									</div>
									</div>
							</div>
						</div>
						<h1></h1>
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color:#dab358'>
									<h3 class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Activity</h3>
									</div>
									<div id="chart1" class="panel-collapse collapse in">
                                        <div class="container"></div>
										<div class="panel-body">
											<canvas id="myChart6" height="180px"></canvas>
											<hr>
										</div>
									</div>
								</div>
							</div>
													<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading " style = 'background-color:#dab358'>
									<h3 class="text-center" style="font-family:'Trebuchet MS', Helvetica, sans-serif;color:white;">Applicant Source</h3>
									</div>
									<div id="chart9" class="panel-collapse collapse in">
                                          <div class="container"></div>
										<div class="panel-body">
											<canvas id="myChart9" height="180px"></canvas>
											<hr>
										</div>
									</div>
								</div>
							</div>
						</div>

						</div>
					<h1></h1>
					</div>
					</div>
					</div>
						
				</div>
			</div>
		</div>

		<!--START-->
	<footer class="panel-footer" style="background-color:#F0F8FF;">
		<center><p style="color: black; font-size:90%">
			Private and Confidential. Anderson Group BPO Inc. &copy; 2017
		</p></center>
	</footer>
<!--END-->
		
		</body>
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>	
		<script type="text/javascript" src="js/material.js"></script>
		<script type="text/javascript" src="js/tether.js"></script>
		<script type="text/javascript" src="js/FileSaver.min.js"></script>
		<script type="text/javascript" src="js/canvas-toBlob.js"></script>
		<script type="text/javascript" src="js/chart.min.js"></script>
		<script type="text/javascript" src="js/dataTables.material.js"></script>
		<script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>
		<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="js/buttons.print.min.js"></script>
		<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="js/dataTables.tableTools.min.js"></script>
		<script src="js/Chart.js"></script>
	<script type="text/javascript">
		var total = [];
		var genderJF = [];
		var genderG = [];
		var ageJobfair = [];
		var ageGoogle = [];
		var locationG = [];
		var locationJF = [];
		var locationI = [];
		var statusNew = 0;
		var statusSched = 0;
		var statusAccepted = 0;
		var statusComment = 0;
		var activeLog = 0;
		var inactiveLog = 0;
		var currentDate = 0;
		var monthly = [];
		var allSource = [];
		var idleTime = 0;
		curDate = new Date();
		var time = new Date();
		var createdDateTo2 = "";
		var createdDateTo = "";
		var myTable;
		var startDate = "<?php echo $startDate;?>";
		var endDate = "<?php echo $endDate;?>";
		$(document).ready(function () {
			 myTable = $('#tblTitleJob').DataTable({
				"bLengthChange": false,
				"order": [[ 1, "desc" ]],
				"dom": 'Bfrtip',
				"columnDefs": [
					{ "width": "50%", "targets": 0 }
				],        buttons: [
            				{ 'extend': 'print',
							text: 'Print',
								customize: function ( win ) {
									$(win.document.body)
									.css( 'font-size', '10pt' ).css( 'text-align', 'center' );
								$(win.document.body).find( 'table' )
									.css( 'font-size', '8pt' ).css('position','absolute').css('left','30%').css('margin-top','10%');
								var canvas = document.getElementById("myChart3");
								var dataUrl = canvas.toDataURL();
								var canvas2 = document.getElementById("myChart2");
								var dataUrl2 = canvas2.toDataURL();
								$(win.document.body).append('<div class = "row" style = "margin-top:80%;">');
								$(win.document.body).append('<img id = "bgImg" src="'+dataUrl+'" style=" z-index:-.1; height:30%; width:30%;margin-right:10%; opacity:2;" />');					
								$(win.document.body).append('<img id = "bgImg" src="'+dataUrl2+'" style="  z-index:-.1; height:30%; width:30%;margin-right:10%" />');
								
								$(win.document.body).append('</div>');
							}
							
				}]
			 });
			 $('#tblTitleJob_filter').prop('style','margin-bottom:5%');
			//$("#reportscontainer").hide();
			var idleInterval = setInterval(timerIncrement, 60000); // Check every 60 Seconds

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			var date_input=$('input[name="date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				autoclose: true,
			});
			
			$('#dateStart').datepicker('setDate',startDate);
			$('#dateEnd').datepicker('setDate',endDate);
			
			$('#dateStart').change(function(){
				if(new Date($(this).datepicker('getDate')) >= new Date($('#dateEnd').datepicker('getDate')))
					{
						$(this).datepicker('setDate',startDate);
					}
				else{
					startDate = $(this).val();
					dateChange();
					}
			});
			
			$('#dateEnd').change(function(){
				if(new Date($(this).datepicker('getDate')) <= new Date($('#dateStart').datepicker('getDate')))
					{
						$(this).datepicker('setDate',endDate);
					}
				else{
					endDate = $(this).val();
					dateChange();
				}	
			});
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			$(this).mousemove(function (e) {
				idleTime = 0;
			});
			$(this).keypress(function (e) {
				idleTime = 0;
			});

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
		function openNav() {
			document.getElementById("mySidenav").style.width = "300px";
			document.getElementById("main").style.marginLeft = "300px";
		}
		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft= "0";
		}

		function googlefunction(){
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {googlequerybtn: 1},
				success: function(){
					window.location = "google.php";
				},
				error: function(){
					alert("Error!");
				}
			});
		}
		function changeYear(process){
					$.ajax({
				url: "query.php",
				type: "POST",
				data: {currentYear: process},
				success: function(data){
					location.reload();
				},
				error: function(){
					alert('Error!');
				}
			});

			  function save() {
				document.getElementById("myChart7").style.border = "2px solid";
				var canvas = document.getElementById();
				var dataURL = canvas.toDataURL();
				document.getElementById("canvasimg").src = dataURL;
				document.getElementById("canvasimg").style.display = "inline";

				document.getElementById("imageDownload").href = dataURL;

			}
			
			
		}
		$("#myTable tbody").on('click', '.posclick', function(){   		
			var position = $(this).data('id');

			$.ajax({
				url: "query.php",
				type: "POST",
				data: {reportposition: 1, position},
				success: function(){
					window.open('google.php');
				},
				error: function(){
					alert('Error!');
				}
			});
		});
	</script>
	<?php
	include 'reportSql.php';			
	?>
	<script>
			// $("#saveChart").click(function() {
				 // $("#chart7").print();
			// });
			

		
			
			
			
		function save(){
			var canvas = document.getElementById("myChart7");
			var dataUrl = canvas.toDataURL(); //attempt to save base64 string to server using this var  
			var windowContent = '<!DOCTYPE html>';
			windowContent += '<html>'
			windowContent += '<head><title>Print</title></head>';
			windowContent += '<body>'
			windowContent += '<div style = "border-style: double;"><h1 style = "text-align: center;" >'+canvas.className+' for 2017</h1> </div>'
			windowContent += '<img src="' + dataUrl + '" style = "position:absolute; width:80%; height:30%; left:10%; top:20%;">';
			windowContent += '</body>';
			windowContent += '</html>';
			var printWin = window.open('','','');
			printWin.document.open();
			printWin.document.write(windowContent);
			printWin.document.close();
			printWin.focus();
			printWin.print();
			printWin.close();
			
		}


			
			
			
							var data =  {
									labels: ["Application", "Jobfair", "Indeed"],//
									datasets: [{
										label: '# of Applications',
										data: total,
										backgroundColor: [
											'rgba(54, 162, 235, 1)',
											'rgba(255, 99, 132, 1)',
											'rgba(255, 206, 86, 1)'
										],
										borderColor: [
											'rgba(54, 162, 235, 1)',
											'rgba(255,99,132,1)',
											'rgba(255, 206, 86, 1)'
										],
										borderWidth: 2
									}]
								};

					var canvas = document.getElementById("myChart");
					var ctx = canvas.getContext("2d");
					var midX = canvas.width/2;
					var midY = canvas.height/2
					var totalValue = getTotalValue(data);

					// Create a pie chart
					var myPieChart = new Chart(ctx, {
						type: "doughnut",
						data: data,
						showTooltips: false,
						options:{
						"onComplete": drawSegmentValues}
					});

					var radius = myPieChart.outerRadius;

					function drawSegmentValues()
					{
						for(var i=0; i<myPieChart.segments.length; i++) 
						{
							ctx.fillStyle="white";
							var textSize = canvas.width/10;
							ctx.font= textSize+"px Verdana";
							// Get needed variables
							var value = Math.floor(myPieChart.segments[i].value/totalValue*100)+'%';
							var startAngle = myPieChart.segments[i].startAngle;
							var endAngle = myPieChart.segments[i].endAngle;
							var middleAngle = startAngle + ((endAngle - startAngle)/2);

							// Compute text location
							var posX = (radius/2) * Math.cos(middleAngle) + midX;
							var posY = (radius/2) * Math.sin(middleAngle) + midY;

							// Text offside by middle
							var w_offset = ctx.measureText(value).width/2;
							var h_offset = textSize/4;

							ctx.fillText(value, posX - w_offset, posY + h_offset);
						}
					}

					function getTotalValue(arr) {
						var total = 0;
						for(var i=0; i<arr.length; i++){
							total += arr[i].value;}
						return total;
					}
	
			
			
	
		// var ctx = document.getElementById("myChart");
		// var myChart = new Chart(ctx, {
			// type: 'pie',
			// data: {
				// labels: ["Google", "Jobfair", "Indeed"],//
				// datasets: [{
					// label: '# of Applications',
					// data: total,
					// backgroundColor: [
						// 'rgba(54, 162, 235, 1)',
						// 'rgba(255, 99, 132, 1)',
						// 'rgba(255, 206, 86, 1)'
					// ],
					// borderColor: [
						// 'rgba(54, 162, 235, 1)',
						// 'rgba(255,99,132,1)',
						// 'rgba(255, 206, 86, 1)'
					// ],
					// borderWidth: 2
				// }]
			// },
			// options:{"animation": {
				  // "duration": 1,
				  // "onComplete": function() {
					  
					  
					  
					  
					  
					  
					  
					  
					// var chartInstance = this.chart,
					// ctx = chartInstance.ctx;
					// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					 // ctx.textAlign = 'center';
					 // ctx.textBaseline = 'center';
					// ctx.fillStyle = "black";
					// this.data.datasets.forEach(function(dataset, i) {
					  // var meta = chartInstance.controller.getDatasetMeta(i);
					  // meta.data.forEach(function(bar, index) {
						// var data = dataset.data[index];
						// ctx.fillText(data, bar._model.x, bar._model.y - 5);
					  // });
					// });
				  // }
				// }	
				
			// }
			// });

/*--START--*/
		var ctx2 = document.getElementById("myChart2");
		var	myChart2 = new Chart(ctx2, {
			type: 'horizontalBar',
			data: {
				labels: ["Male", "Female"],
				datasets:[
					{
						data: genderG,
						label: 'GENDER',
						backgroundColor: ['#0000FF','#FF1493'],
						borderColor: ['#0000FF','#FF1493'],
						borderWidth: 1
					}
				],
/*--END--*/
			},	options:{
                    legend: {
                        display: false
                    },
					scales: {
							xAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
									
					},"animation": {
							  "duration": 1,
							  "onComplete": function() {
								var chartInstance = this.chart,
								ctx = chartInstance.ctx;
								ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
								ctx.textAlign = 'left';
								ctx.textBaseline = 'center';
								ctx.fillStyle = "black";
								this.data.datasets.forEach(function(dataset, i) {
								  var meta = chartInstance.controller.getDatasetMeta(i);
								  meta.data.forEach(function(bar, index) {
									var data = dataset.data[index];
									ctx.fillText(data, bar._model.x, bar._model.y - 5);
								  });
								});
							  }
						},   
					}
		});

				
// datechange function
			function dateChange(){
				genderG = [];
				ageGoogle = [];
				$.ajax({
					url: "queryDateChange.php",
					type: "POST",
					data: {dateStart: startDate, dateEnd: endDate,changeDateValue:1},
					success: function(dta){

					myTable.destroy();
					$('#myTableContainer').html("<table id = 'tblTitleJob'><thead><th>Job Title</th><th>Number of Applicant</th></thead><tbody>"+dta+"</tbody></table>");
					 myTable = $('#tblTitleJob').DataTable({
						"bLengthChange": false,
						"order": [[ 1, "desc" ]],
						"dom": 'Bfrtip',
						"columnDefs": [
							{ "width": "50%", "targets": 0 }
						], buttons: [
            				{ 'extend': 'print',
							text: 'Print',
								customize: function ( win ) {
									$(win.document.body)
									.css( 'font-size', '10pt' ).css( 'text-align', 'center' );
								$(win.document.body).find( 'table' )
									.css( 'font-size', '8pt' ).css('position','absolute').css('left','30%').css('margin-top','10%');
								var canvas = document.getElementById("myChart3");
								var dataUrl = canvas.toDataURL();
								var canvas2 = document.getElementById("myChart2");
								var dataUrl2 = canvas2.toDataURL();
								$(win.document.body).append('<div class = "row" style = "margin-top:80%;">');
								$(win.document.body).append('<img id = "bgImg" src="'+dataUrl+'" style=" z-index:-.1; height:30%; width:30%;margin-right:10%; opacity:2;" />');					
								$(win.document.body).append('<img id = "bgImg" src="'+dataUrl2+'" style="  z-index:-.1; height:30%; width:30%;margin-right:10%" />');
								
								$(win.document.body).append('</div>');
							}
							
				}]
					 });	
					},
					error: function(data){
						alert(data);
						}
				});
				
				
					$.ajax({
					url: "queryDateChange.php",
					type: "POST",
					data: {dateStart: startDate, dateEnd: endDate,gender:1},
					success: function(dta){
					genderG = dta.split(',');
					
					var ctx2 = document.getElementById("myChart2");
					var	myChart2 = new Chart(ctx2, {
						type: 'horizontalBar',
						data: {
							labels: ["Male", "Female"],
							datasets:[
								{	/*--START--*/
									data: genderG,
									label: "",
									backgroundColor: ['#0000FF','#FF1493'],
									borderColor: ['#0000FF','#FF1493'],
									borderWidth: 1
									/*--END--*/
								}
								
							]
						},options:{
							// "animation": {
										  // "duration": 1,
										  // "onComplete": function() {
											// var chartInstance = this.chart,
											// ctx = chartInstance.ctx;
											// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
											// ctx.textAlign = 'right';
											// ctx.textBaseline = 'top';
											// ctx.fillStyle = "black";
											// this.data.datasets.forEach(function(dataset, i) {
											  // var meta = chartInstance.controller.getDatasetMeta(i);
											  // meta.data.forEach(function(bar, index) {
												// var data = dataset.data[index];
												// ctx.fillText(data, bar._model.x, bar._model.y - 5);
											  // });
											// });
										  // }
										// }, 
										scales: {
											yAxes: [{
												ticks: {
													beginAtZero: true
												}
											}]
										}
						}
					});
					},
					error: function(data){
						alert(data);
						}
				});
				$.ajax({
					url: "queryDateChange.php",
					type: "POST",
					data: {dateStart: startDate, dateEnd: endDate,age:1},
					success: function(dta){
					ageGoogle = dta.split(',');
							var ctx3 = $('#myChart3');
							var myChart3 = new Chart(ctx3, {
								type: 'bar',
								data: {
									labels: ['18-25 Yrs.', '26-30 Yrs.', '31-35 Yrs.', '36-42 Yrs.', '43-50 Yrs.', '50 and up'],
									datasets: [
										{
											data: ageGoogle,
											label: "",
											backgroundColor: ['rgba(54, 162, 235, 2)','#a861cf','#6bc23b','#c2923b','#cf6188','#878aa0'],
											borderColor: ['rgba(54, 162, 235, 2)','#a861cf','#6bc23b','#c2923b','#cf6188','#878aa0'],
											borderWidth: 1
										}
									]
								},
								options: {
									scales: {
										yAxes: [{
											ticks: {
												beginAtZero:true
											}
										}]
									},"animation": {
												  "duration": 1,
												  "onComplete": function() {
													var chartInstance = this.chart,
													ctx = chartInstance.ctx;
													ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
													ctx.textAlign = 'center';
													ctx.textBaseline = 'bottom';
													ctx.fillStyle = "black";
													this.data.datasets.forEach(function(dataset, i) {
													  var meta = chartInstance.controller.getDatasetMeta(i);
													  meta.data.forEach(function(bar, index) {
														var data = dataset.data[index];
														ctx.fillText(data, bar._model.x, bar._model.y - 5);
													  });
													});
												  }
												}
								},tooltips: {
												callbacks: {
															title: function(tooltipItems, data) {
															  return '';
															},
															label: function(tooltipItem, data) {
																  var datasetLabel = '';
																  var label = data.labels[tooltipItem.index];
																  return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
																}
															}
											}
							});

					},
					error: function(data){
						alert(data);
						}
				});
				
			}
//end of dateChange function

		var ctx3 = $('#myChart3');
		var myChart3 = new Chart(ctx3, {
			type: 'bar',
			data: {
				labels: ['18-25 Yrs.', '26-30 Yrs.', '31-35 Yrs.', '36-42 Yrs.', '43-50 Yrs.', '50 and up'],
				datasets: [
					{
						data: ageGoogle,
						label: "Age Bracket",
						backgroundColor: ['rgba(54, 162, 235, 2)','#a861cf','#6bc23b','#c2923b','#cf6188','#878aa0'],
						borderColor: ['rgba(54, 162, 235, 2)','#a861cf','#6bc23b','#c2923b','#cf6188','#878aa0'],
						borderWidth: 1
					}
				]
			},
			options: {
                 legend: {
                        display: false
                    },
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},"animation": {
				  "duration": 1,
				  "onComplete": function() {
					var chartInstance = this.chart,
					ctx = chartInstance.ctx;
					ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';
					ctx.fillStyle = "black";
					this.data.datasets.forEach(function(dataset, i) {
					  var meta = chartInstance.controller.getDatasetMeta(i);
					  meta.data.forEach(function(bar, index) {
						var data = dataset.data[index];
						ctx.fillText(data, bar._model.x, bar._model.y - 5);
					  });
					});
				  }
				}
			},tooltips: {
							callbacks: {
										title: function(tooltipItems, data) {
										  return '';
										},
										label: function(tooltipItem, data) {
											  var datasetLabel = '';
											  var label = data.labels[tooltipItem.index];
											  return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
											}
										}
			},
		});
		var ctx9 = $('#myChart9');
		var myChart9 = new Chart(ctx9, {
			type: 'bar',
			data: {
				labels: ['Jobstreet', 'Linked In', 'Facebook', 'From a Friend','Website','Others'],
				datasets: [
					{
						data: allSource,
						label:'Application Source',
						backgroundColor: 'rgba(54, 162, 235, 2)',
						borderColor: 'rgba(54, 162, 235, 1)',
						borderWidth: 1
					}
				]
			},
			options: {legend:false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},"animation": {
				  "duration": 1,
				  "onComplete": function() {
					var chartInstance = this.chart,
					ctx = chartInstance.ctx;
					ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';
					ctx.fillStyle = "black";
					this.data.datasets.forEach(function(dataset, i) {
					  var meta = chartInstance.controller.getDatasetMeta(i);
					  meta.data.forEach(function(bar, index) {
						var data = dataset.data[index];
						ctx.fillText(data, bar._model.x, bar._model.y - 5);
					  });
					});
				  }
				}
			},tooltips: {
							callbacks: {
										title: function(tooltipItems, data) {
										  return '';
										},
										label: function(tooltipItem, data) {
											  var datasetLabel = '';
											  var label = data.labels[tooltipItem.index];
											  return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
											}
										}
			},
		});

		
		
		
		
		var ctx4 = $('#myChart4');
		var myChart4 = new Chart(ctx4, {
			type: 'doughnut',
			data: {
				labels: ['Pending', 'No Show', 'Interview', 'Fail/Reject'],
				datasets:[
					{
						data: [statusNew, statusSched, statusAccepted, statusComment],
						backgroundColor: ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)',],
						borderColor: ['rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)'],
						borderWidth: 1
					}
				]
			}
		});


		var ctx7 = $('#myChart7');
		var myChart7 = new Chart(ctx7, {
			type: 'bar',
			data: {
				labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
				datasets: [{
					label: 'Total in month',
					data: monthly,
					backgroundColor: [
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
						'rgba(115, 91, 79, 0.3)',
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)',
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(153, 102, 255, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {legend:false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
				"animation": {
				  "duration": 1,
				  "onComplete": function() {
					var chartInstance = this.chart,
					ctx = chartInstance.ctx;
					ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';
					ctx.fillStyle = "black";
					this.data.datasets.forEach(function(dataset, i) {
					  var meta = chartInstance.controller.getDatasetMeta(i);
					  meta.data.forEach(function(bar, index) {
						var data = dataset.data[index];
						ctx.fillText(data, bar._model.x, bar._model.y - 5);
					  });
					});
				  }
				}
				
			},	
		});
		
		
		

		var ctx = document.getElementById("myChart6");
		var myChart6 = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["Active", "Inactive"],//
				datasets: [{
					label: 'Number of Applications',
					data: [activeLog,inactiveLog],
					backgroundColor: [
						'rgba(54, 162, 235, 1)',
						'rgba(255, 99, 132, 1)',
						'rgba(255, 206, 86, 1)'
					],
					borderColor: [
						'rgba(54, 162, 235, 1)',
						'rgba(255,99,132,1)',
						'rgba(255, 206, 86, 1)'
					],
					borderWidth: 2
				}],
			}
		});
		
		$("#myChart").click(function(e){
			var activeBars = myChart.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			/*--START--*/
			if(imfrom == 'Application'){
				imfrom = 'application';
			}else if(imfrom == 'Jobfair'){
				imfrom = 'jobfair';
			}else if(imfrom =='Indeed'){
				imfrom = 'indeed';
			}
			/*--END--*/
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {tbl:imfrom, reports: 1},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});

		$("#myChart2").click(function(e){
			var activeBars = myChart2.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {gender:imfrom, reports: 1, dateStart: startDate, dateEnd: endDate},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});
		$("#myChart3").click(function(e){
			var activeBars = myChart3.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {age:imfrom, reports: 1, dateStart: startDate, dateEnd: endDate},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});	
		$("#myChart9").click(function(e){
			var activeBars = myChart9.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {source:imfrom, reports: 1,year:$('#thisYear').text()},
				success: function(data){
						window.open('google.php');
				},
				error: function(data){
					alert(data);
				}
			});
		});
		$("#myChart4").click(function(e){
			var activeBars = myChart4.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {status:imfrom, reports: 1,year:$('#thisYear').text()},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});
		$("#myChart5").click(function(e){
			var activeBars = myChart5.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {position:imfrom, reports: 1,year:$('#thisYear').text()},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});
		
		$("#myChart6").click(function(e){
			var activeBars = myChart6.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {activity:imfrom, reports: 1},
				success: function(data){
						window.open('google.php');
				},
				error: function(data){
					alert(data);
				}
			});
		});
		$("#myChart7").click(function(e){
			var activeBars = myChart7.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {month:imfrom, reports: 1,year:$('#thisYear').text()},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});
		$("#myChart8").click(function(e){
			var activeBars = myChart8.getElementAtEvent(e);
			var imfrom;
			var index = activeBars[0]['_chart'].config.data;
			var idx = activeBars[0]['_index'];
			imfrom = index.labels[idx];
			$.ajax({
				url: "query.php",
				type: "POST",
				data: {total:imfrom, reports: 1,sDate:createdDateTo,eDate:createdDateTo2},
				success: function(data){
						window.open('google.php');

				},
				error: function(data){
					alert(data);
				}
			});
		});
		
			$("#printFixData").click(function(e){
			var canvas1 = document.getElementById("myChart");
			var dataUrl1 = canvas1.toDataURL();			
			var canvas2 = document.getElementById("myChart4");
			var dataUrl2 = canvas2.toDataURL();		
			var canvas3 = document.getElementById("myChart6");
			var dataUrl3 = canvas3.toDataURL();
			var canvas4 = document.getElementById("myChart9");
			var dataUrl4 = canvas4.toDataURL();
			var windowContent = '<!DOCTYPE html>';
			windowContent += '<html>'
			windowContent += '<head><title>Print</title></head>';
			windowContent += '<body>'
			windowContent += '<div style = "border-style: double;"><h1 style = "text-align: center;" >Fix Data</h1> </div>'
			windowContent += '<div style = "margin-top:20%;">';
			windowContent += '<img src="' + dataUrl1 + '" style = " width:40%; height:30%; left:10%; top:20%;">';
			windowContent += '<img src="' + dataUrl2 + '" style = " width:40%; height:30%; margin-left:10%; top:20%;">';
			windowContent += '</div>';
			windowContent += '<div style = "margin-top:20%;">';
			windowContent += '<img src="' + dataUrl3 + '" style = " width:40%; height:30%; left:10%; top:20%;">';
			windowContent += '<img src="' + dataUrl4 + '" style = " width:40%; height:30%; margin-left:30% top:20%;">';
			windowContent += '</div>';
			windowContent += '</body>';
			windowContent += '</html>';
			var printWin = window.open('','','');
			printWin.document.open();
			printWin.document.write(windowContent);
			printWin.document.close();
			printWin.focus();
			printWin.print();
			printWin.close();

			
		});
		
	</script>


</html>