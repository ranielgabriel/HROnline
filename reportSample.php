<html>

<body>
							<div id="chart7" class="panel-collapse collapse in">
						      	<div class="panel-body container-fluid" style="width: 100% ;height: 450px ;overflow-y: scroll;">
						      		<div id="chart7" class="panel-collapse collapse in">
								      	 <div class="panel-body">
								      		<canvas id="myChart7" height="120px"></canvas>
								     	</div>
							    	</div>
						      		<hr>
						     	</div>
					    	</div>
							

							<?php
								include('auth.php');/*session_start()*/
								include('connect.php');
								$_SESSION['previous-page'] = 'reports.php';
									/*Monthly*/
									
										$now = new \DateTime('now');
										$month = $now->format('m');
										$year = $now->format('Y');
										$lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
										$startDate = $year."-".$month."-1";
										$endDate = $year."-".$month."-".$lastDay;
										
										$monthsql = "SELECT SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '".$startDate."' 
										AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '".$endDate."' THEN 1 ELSE 0 END) as 'january', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-02-01'
										AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-02-28' THEN 1 ELSE 0 END) as 'february', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-03-01' THEN 1 ELSE 0 END) as 'march', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-04-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-04-30' THEN 1 ELSE 0 END) as 'april', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-05-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-05-31' THEN 1 ELSE 0 END) as 'may', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-06-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-06-30' THEN 1 ELSE 0 END) as 'june', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-07-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-07-31' THEN 1 ELSE 0 END) as 'july', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-08-01' AND  DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-08-31' THEN 1 ELSE 0 END) as 'august', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-09-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-09-30' THEN 1 ELSE 0 END) as 'september',  SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-10-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-10-31' THEN 1 ELSE 0 END) as 'october', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-11-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-11-30' THEN 1 ELSE 0 END) as 'november', SUM(CASE WHEN DATE_FORMAT(`Timestamp`, '%Y-%m-%d') >= '2017-12-01' AND DATE_FORMAT(`Timestamp`, '%Y-%m-%d') <= '2017-12-31' THEN 1 ELSE 0 END) as 'december' FROM tbl_application";
										if($monthresult = $conn->query($monthsql)){
											while($row = $monthresult->fetch_assoc()){
												echo "<script>monthly.push(".$row['january'].")</script>";
												echo "<script>monthly.push(".$row['february'].")</script>";
												echo "<script>monthly.push(".$row['march'].")</script>";
												echo "<script>monthly.push(".$row['april'].")</script>";
												echo "<script>monthly.push(".$row['may'].")</script>";
												echo "<script>monthly.push(".$row['june'].")</script>";
												echo "<script>monthly.push(".$row['july'].")</script>";
												echo "<script>monthly.push(".$row['august'].")</script>";
												echo "<script>monthly.push(".$row['september'].")</script>";
												echo "<script>monthly.push(".$row['october'].")</script>";
												echo "<script>monthly.push(".$row['november'].")</script>";
												echo "<script>monthly.push(".$row['december'].")</script>";
											}
										}



							?>


</body>
</html>