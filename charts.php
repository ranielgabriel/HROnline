<!DOCTYPE html>

<?php
	//include ('connect.php');
	$dbhandle = new mysqli('localhost','root','','hr_online_app_db4');
	$query = "SELECT * FROM tbl_application";
	$res = $dbhandle->query($query);
	include ('reports.php');
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['source'],
		  
		  
		  <?php
			while ($row=$res->fetch_assoc()){
				echo "['".$row['country']."'],";
			}
		  
		  ?>
        ]);

        var options = {
          title: 'Visits from Countries',
          pieHole: 0.2,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    //<div id="donutchart" style="width: 900px; height: 500px;"></div>
  </body>
</html>