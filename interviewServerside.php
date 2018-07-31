<?php
	session_start();
	if(isset($_SESSION['newapp'])){
		if($_SESSION['newapp'] == 'new'){

		}elseif($_SESSION['newapp'] == 'submitted'){
			header('location: like.php');
			exit();
		}
	}else{
		header('location: like.php');
		exit();
	}

	include("connect.php");
	$interviewID = mysqli_real_escape_string($conn,$_POST['interviewID']); 
	$interviewStatus = mysqli_real_escape_string($conn,$_POST['interviewStatus']); 
	$comment = mysqli_real_escape_string($conn,$_POST['comment']); 	
	$InterviewStage = mysqli_real_escape_string($conn,$_POST['InterviewStage']); 	
	$referNo = mysqli_real_escape_string($conn,$_POST['referenceNumber']); 	
	
	$interview = "update tbl_interview set `Comment`='$comment',`Status`='$interviewStatus' where `ID` = '$interviewID'";
	$conn->query($interview);
	
	$interview2 = "update tbl_application set `Note`='$comment' where `REFERENCE_NO` = '$referNo'";
	$conn->query($interview2); 

?>
<html>
<head>
	<title>AndersonPH | ARMS</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body background='bg2.jpg' style="background-position: center center;background-repeat:  no-repeat;background-attachment: fixed;background-size:  cover;">
	<h3 style="text-align:center; color: #e6e6e6; text-shadow: 2px 2px #404040;padding-top: 15%">Like our page and follow us on twitter for more updates!</h3>
  
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
   

</body>
</html>