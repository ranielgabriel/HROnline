<html>

<head>

<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>	

<script type="text/javascript" src="js/jquery-3.1.1.js"></script>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

		__gaTracker('create', 'UA-76297316-1', 'auto');
		__gaTracker('set', 'forceSSL', true);
		__gaTracker('send','pageview');
	</script>

<title>Anderson Recruitment Management System</title>

<script type="text/javascript" src="http://l2.io/ip.js?var=userip"></script> 

<script type="text/javascript"> 

	$('document').ready(function () {

		$('#Mymodal').modal('show');

		$('#exam').css('display','none');

		var IpAddress="";

		if(typeof userip === 'undefined'){

			$.getJSON("http://jsonip.com/?callback=?", function (data) {

				IpAddress = data.ip;

			});

		}else{

			IpAddress = userip;

		}

		$.ajax ({

		type: "POST",

		url: "address.php",

		data: { ivalid : IpAddress },

		success: function( result ) {

			if(IpAddress==result){

			var a_href = $('#exam').attr('href');

			$('#exam').attr('href','http://localhost:8080/HROnlineV2/index.php?ref=<?php echo'raiven';?>&&fname=<?php echo'raiven';?>&&mname=<?php echo'flores';?>&&lname=<?php echo'lopez';?>');

			$('#exam').css('display','block');

		}

		}

		});

		

	});

</script>  





</head>

<body background='bg2.jpg' style="background-position: center center;background-repeat:  no-repeat;background-attachment: fixed;background-size:  cover;">

	<hr style="padding-top: 150px">

	<h3 style="text-align:center; color: #e6e6e6; text-shadow: 2px 2px #404040">Like our page and follow us on twitter for more updates!</h3>

  

	<p style="text-align:center;">

	<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAndersonGroupPH%2F&tabs=Header&width=450&height=130&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId" width="450" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe><br/>

	

	<script>

	(function(d, s, id) {

	var js, fjs = d.getElementsByTagName(s)[0];

	if (d.getElementById(id)) return;

	js = d.createElement(s); js.id = id;

	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";

	fjs.parentNode.insertBefore(js, fjs);

	}(document, 'script', 'facebook-jssdk'));</script>

	

  <a class="twitter-follow-button"

    href="https://twitter.com/andersongroupph"

    data-size="large">

  Follow @AndersonGroupPH</a>



  <script>window.twttr = (function(d, s, id) {

    var js, fjs = d.getElementsByTagName(s)[0],

      t = window.twttr || {};

    if (d.getElementById(id)) return t;

    js = d.createElement(s);

    js.id = id;

    js.src = "https://platform.twitter.com/widgets.js";

    fjs.parentNode.insertBefore(js, fjs);



    t._e = [];

    t.ready = function(f) {

      t._e.push(f);

    };



    return t;

  }(document, "script", "twitter-wjs"));</script>

  <div class="row" style="text-align: center">

    <a href="http://andersongroup.ph"> <button class="btn bnt-primary">Return</button></a>

  </div>

	<div class="container">

		<div id="Mymodal" role="dialog" class="modal fade">

		<div class="modal-dialog">

		  <div class="modal-content">

			<div class="modal-header">

			  <button type="button" data-dismiss="modal" class="close">&times;</button>

			  <h4 class="modal-title">Reference Code</h4>

			</div>

			<div class="modal-body">

				Your application form has been successfully sent.

			  <p>Please remember your Reference Code:</p>

			  <a id="exam">Click Here for Exam</a>

			  <?php 

				if(isset($_SESSION['Application_Status'])){

					echo'<p style="color:#ff6d00;">Note: Use this code to resume your application form.</p>';

				}else{

					echo'<p style="color:#ff6d00;">Note: Use this code to edit your application form and to take our exam.</p>';

				}

				?>

			</div>

			

			<div class="modal-footer">

			  <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>

			</div>

		  </div>

		</div>

		</div>

	</div>

</body>



</html>