<html>
<head>
<script type="text/javascript" src="js/angular.js"></script>
	
</head>
<script type="text/javascript">
		var list = [
			{ refcode: "XYZ123ASD", position: "Senior Intern", fullname: "Raiven Kenn Lopez",datetaken: "01/10/16" ,examtaken:[{examtype: "Written", total: 100, score: 69},{examtype: "Logic", total: 101, score: 69}], },
		];
		var llength = list.length;
		for(var x = 0; x < llength ; x++){
			var referenceCode= list[x].refcode;
			var position= list[x].position;
			var fullname= list[x].fullname;
			var datetaken= list[x].datetaken;
			var examtakenlength= list[x].examtaken.length;
			for(var y= 0; y < examtakenlength; y++){
				var examtype = list[x].examtaken[y].examtype;
				var examtotal = list[x].examtaken[y].total;
				var scoretotal = list[x].examtaken[y].score;
				
			}
			$.ajax ({
				type: "POST",
				url: "address.php",
				data: { ivalid : IpAddress },
				success: function( result ) {
					
				}
			});
		
		}
	</script>
<body>
<?php
	$referenceCode = "<script type='text/javascript'>document.write(referenceCode);</script>";
	$position = "<script type='text/javascript'>document.write(position);</script>";
	$fullname = "<script type='text/javascript'>document.write(fullname);</script>";
	$datetaken = "<script type='text/javascript'>document.write(datetaken);</script>";
	$examtype = "<script type='text/javascript'>document.write(examtype);</script>";
	$examtotal = "<script type='text/javascript'>document.write(examtotal);</script>";
	$scoretotal = "<script type='text/javascript'>document.write(scoretotal);</script>";
	$examtakenlength = "<script type='text/javascript'>document.write(examtakenlength);</script>";
	$examcount = $examtakenlength;
	$ex = intval($examcount);
	echo $ex;
	for($x = 0; $x < $examcount; $x++){
		echo "asdga";
	}
	// echo $referenceCode;
	// echo $position;
	// echo $fullname;
	// echo $datetaken;
	// echo $examtype;
	// echo $examtotal;
	// echo $scoretotal;
?>
</body>
</html>