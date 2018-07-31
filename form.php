<!DOCTYPE html>
<html>
<head>
	<title>Application Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker3.css">
	<link rel="stylesheet" type="text/css" href="css/ripples.css">
	<link rel="stylesheet" type="text/css" href="css/inputmask.css">
	
	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css"> -->
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

	<!-- link to custom css -->
	<link rel="stylesheet" type="text/css" href="custom_css/form.css">
	<!-- link for google material-icon -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>

<hr style="padding-bottom: 1%;">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="serverside.php" name="myForm" novalidate id="myForm" ng-app="" method="post" enctype="multipart/form-data">
				<div class="card container" id="container1">
								<img src="ag.png" >
					<legend style="margin-top: 20px; text-align: center"><i class="fa fa-wpforms"></i> APPLICATION FORM</legend>
					<br>
					<div class="row col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="position">Position applying for:</label>
		      					<select id="position" name="position_name" class="select form-control" required="true">
		      						<span><i class="fa fa-angle-down"></i></span>

		      				
		      						<?php  
		      							include('connect.php');
		      							$sql = "SELECT * FROM tbl_position WHERE status = 1 ORDER BY position_name ASC";
		      							$result = $conn->query($sql);
		      							while($row = $result->fetch_assoc()){
		      							echo "<option value='".$row['position_desc']."'>".$row['position_name']."</option>";
		      							}
		      						?>

		      					</select>
	      					</div>
	      					<div class="form-group">
				    			<label>Are You amenable to shifting schedule?</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="sched" id="sched2" value="YES">
						            YES
						          </label>
						          <label>
						            <input type="radio" name="sched" id="sched2" value="NO" checked>
						            NO
						          </label>
						        </div>
						    </div>
								<div class="form-group">
				    			<label>Are you amenable to contractual employment?</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="contract" id="contract2" value="YES">
						            Yes
						          </label>
						          <label>
						            <input type="radio" name="contract" id="contract2" value="NO" checked>
						            No
						          </label>
						      </div>
						    </div>
						    <div class="form-group">
				    			<label>Are You willing to work on weekends/holidays?</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="holidays" id="holidays2" value="YES">
						            YES
						          </label>
						          <label>
						            <input type="radio" name="holidays" id="holidays2" value="NO" checked>
						            NO
						          </label>
						        </div>
						    </div>
						</div>

						<div class="col-md-6 sample">
							<div class="form-group">
								<div class="form-group input-group "><!-- EMPLOYMENT DATE -->
			      					<label>Available date for employment</label>
			      					<input data-provide="datepicker" class="form-control" ng-model="empdate" name="empdate" data-date-start-date="today" data-date-format="MM dd, yyyy" required>
			      					<span class="input-group-addon">
			      						<span><i class="fa fa-calendar" style="margin-top: 35px"></i></span>
									<span ng-show="!myForm.empdate.$pristine && myForm.empdate.$error.required" style="color:red;">This is required. </span>
			      					</span>
			  					</div>
							</div>
							<div class="form-group"><!-- SALARY -->
		  						<label for="salary">Expected Salary</label>
		      					<select id="salary" class="select form-control" name="salary" required>
		      						<option value="10,000.00 - 15,000.00">₱10,000.00 - ₱15,000.00</option>
		      						<option value="16,000.00 - 20,000.00">₱16,000.00 - ₱20,000.00</option>
		      						<option value="21,000.00 - 25,000.00">₱21,000.00 - ₱25,000.00</option>
		      						<option value="26,000.00 - 30,000.00">₱26,000.00 - ₱30,000.00</option>
		      						<option value="31,000.00 - 35,000.00">₱31,000.00 - ₱35,000.00</option>
		      						<option value="36,000.00 - 40,000.00">₱36,000.00 - ₱40,000.00</option>
		      						<option value="41,000.00 - 50,000.00">₱41,000.00 - ₱50,000.00</option>
		      						<option value="51,000.00 - 55,000.00">₱51,000.00 - ₱55,000.00</option>
		      					</select>
							</div>
						</div>						
					</div>

					<!-- personal information -->
					<div class="row col-md-12">
						<h6 style="margin-top: 2%"><i class="fa fa-user-o"></i><b> PERSONAL INFORMATION</b></h6>
						<hr style="padding-bottom: 10px;">
						<div class="col-md-6">
							<div class="form-group label-floating" >
								<label for="lname" class="control-label">Last Name</label>
								<input class="form-control" type="text" ng-minlength="2" name="lname" ng-model="lname" required>
								<span class="help-block" ng-show="!myForm.lname.$untouched && myForm.lname.$error.required" style="color:red;">This is required. </span>
								<span class="help-block" ng-show="myForm.lname.$dirty && myForm.lname.$error.minlength" style="color:red;">This is too short </span>

							</div>	
							<div class="form-group label-floating">
								<label for="fname" class="control-label">First Name</label>
								<input name="fname" id="fname" class="form-control" ng-model="fname" ng-minlength="2" required capitalized-fisrt >
								<span class="help-block" ng-show="!myForm.fname.$pristine && myForm.fname.$error.required" style="color:red;">This is required. </span>
								<span class="help-block" ng-show="myForm.fname.$dirty && myForm.fname.$error.minlength" style="color:red;">This is too short </span>

							</div>
							<div class="form-group label-floating">
								<label for="mname" class="control-label">Middle Name</label>
								<input type="text" name="mname" ng-model="mname" id="mname" class="form-control">
								
							</div>
							<div class="form-group label-floating">
								<label for="ename" class="control-label">Name Extension</label>
								<input type="text" name="ename" id="ename" class="form-control">
							</div>
  

							<div class="form-group">
				    			<label>Sex</label>
				    			<div class="radio radio-primary">
						          <label>
						            <input type="radio" name="sex123" id="s1" value="Male" checked="true">
						            MALE	
						          </label>
						          <label>
						            <input type="radio" name="sex123" id="s1" value="Female" >
						            FEMALE
						          </label>
						        </div>
						    </div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label for="nickname" class="control-label">Nick Name</label>
								<input type="text" name="nickname123" id="nickname" class="form-control">
							</div>
							<div class="form-group label-floating input-group">
								<label for="date-ofbirth" class="control-label">Date of Birth</label>
								<input data-provide="datepicker" name="bday123" id="date-ofbirth" ng-model="bday123" class="form-control" data-date-end-date="-17y" data-date-format="MM dd, yyyy" required>
								<span class="input-group-addon">
			      					<span><i class="fa fa-calendar" ></i></span>
								<span ng-show="myForm.bday123.$touched && myForm.bday123.$error.required" style="color:red;">This is required. </span>
			      				</span>
							</div>
							<div class="form-group label-floating">
								<label for="place-of-birth" class="control-label">Place of Birth</label>
								<input type="text" name="bplace" id="place-of-birth" class="form-control" ng-model="placeOfBirth" ng-minlength="2" required>
								<span class="help-block" ng-show="!myForm.bplace.$pristine && myForm.bplace.$error.required" style="color:red;">This is required. </span>
								<span class="help-block" ng-show="myForm.bplace.$dirty && myForm.bplace.$error.minlength" style="color:red;">This is too short </span>
							</div>
							<div class="form-group label-floating">
								<label for="citizen" class="control-label" >Citizenship</label>
								<input type="text" id="citizen" name="citizen" class="form-control" ng-model="citizen" ng-minlength="2" required>
								<span class="help-block" ng-show="!myForm.citizen.$pristine && myForm.citizen.$error.required" style="color:red;">This is required. </span>
								<span class="help-block" ng-show="myForm.citizen.$dirty && myForm.citizen.$error.minlength" style="color:red;">This is too short </span>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group label-static">
										<label for="cstatus" class="control-label">Civil Status</label>
				      					<select id="cstatus" class="select form-control" name="cstatus" onchange="showspec(this)" required>
				      						<option value="Single">Single</option>
				      						<option value="Married">Married</option>
				      						<option value="Annuled">Annuled</option>
				      						<option value="Widowed">Widowed</option>
				      						<option value="Separated">Separated</option>
				      						<option value="Others">Others</option>
				      					</select>
									</div>
								</div>
									<!-- <div class="switch form-group" >
								<label><input onchange="checkspec(this)" type="checkbox" name="child2" id="child2" value="1"> Do You Have Child/Children</label> -->
							

								<div class="col-md-6">
									<div id="other_div" class="form-group label-floating">
					      				<label class="control-label" for="wewe">Civil Status</label>
					      				<input type="text" name="cstatusspec" class="form-control" id="wewe" >
			      					</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" style="margin-bottom: 2%" class="btn btn-raised btn-primary pull-right" onclick="document.getElementById('container1').style.display='none'; document.getElementById('container2').style.display='block';" ng-disabled="myForm.citizen.$invalid || myForm.bplace.$invalid || myForm.bday.$invalid || myForm.fname.$invalid || myForm.lname.$invalid || myForm.empdate.$invalid ">NEXT</button><!--  -->
				</div> <!-- End of container 1 -->

				<div class="card container" id="container2">
					<h6 style="padding-top: 2%;"><i class="fa fa-user-o"></i> <b>PERSONAL INFORMATION</b></h6>
					<hr style="padding-bottom: 10px;">
					<div class="row col-md-12">
						<div class="col-md-6">
							<label>Height</label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label for="feet" class="control-label">Feet (ft.)</label>
										<input type="number" name="feet" class="form-control" id="feet">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label for="inches" class="control-label">Inches (in.)</label>
										<input type="number" name="inch" class="form-control" id="inches">
									</div>
								</div>
							</div>
							<div class="form-group label-floating">
								<label for="bloodtype" class="control-label">Blood type</label>
								<select class="select form-control" id="bloodtype" name="btype">
									<option value="O+">O+</option><option value="B+A">B+–</option>
									<option value="O–">O–</option><option value="B–">B–</option>
									<option value="A+">A+</option><option value="AB+">AB+</option>
									<option value="A–">A–</option><option value="AB–"> AB–</option>
								</select>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="currendaddress">Current Address (Number, Street, Subdivision)</label>
								<textarea class="form-control" id="currendaddress" ng-minlenght="2" ng-model="curadd" rows="3" name="curadd" required></textarea>
								<span class="help-block" ng-show="!myForm.curadd.$pristine && myForm.curadd.$error.required" style="color:red;">This is required. </span>
								<span class="help-block" ng-show="myForm.curadd.$dirty && myForm.curadd.$error.minlength" style="color:red;">This is too short </span>
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="provincialaddress">Provincial Address (Number, Street, Subdivision)</label>
								<textarea class="form-control" id="provincialaddress" rows="3" name="provadd"></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<label>Weight</label>
							<div class="form-group label-floating">
								<label for="pounds" class="control-label">Pounds (lbs:)</label>
								<input type="number" name="weight" class="form-control" id="pounds">
							</div>
							<div class="form-group label-floating">
								<label for="religion" class="control-label">Religion</label>
								<input type="text" name="religion123" class="form-control" id="religion">
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group label-floating">
										<label class="control-label" for="disctrict1">City/Municipality</label>
										<input class="form-control" id="disctrict1" type="text" name="curdis" ng-minlength="2" ng-model="curdis" required></input>
										<span class="help-block" ng-show="!myForm.curdis.$pristine && myForm.curdis.$error.required" style="color:red;">This is required. </span>
										<span class="help-block" ng-show="myForm.curdis.$dirty && myForm.curdis.$error.minlength" style="color:red;">This is too short </span>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group label-floating">
										<label class="control-label" for="municipality">Province</label>
										<input class="form-control" id="municipality" type="text" name="curmuni" ng-model="curmuni" ng-minlength="2"></input>
										<span class="help-block" ng-show="!myForm.curmuni.$pristine && myForm.curmuni.$error.required" style="color:red;">This is required. </span>
										<span class="help-block" ng-show="myForm.curmuni.$dirty && myForm.curmuni.$error.minlength" style="color:red;">This is too short </span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group label-floating">
										<label class="control-label" for="zipcode1">Zip Code</label>
										<input class="form-control" id="zipcode1" type="number" name="curzip" ng-minlength="2" ng-model="curzip" required></input>
										<span class="help-block" ng-show="!myForm.curzip.$pristine && myForm.curzip.$error.required" style="color:red;">This is required. </span>
										<span class="help-block" ng-show="myForm.curzip.$dirty && myForm.curzip.$error.minlength" style="color:red;">This is too short </span>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group label-floating">
										<label class="control-label" for="disctrict2">City/Municipality</label>
										<input class="form-control" id="disctrict2" type="text" name="provdis"></input>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group label-floating">
										<label class="control-label" for="municipality2">Province</label>
										<input class="form-control" id="municipality2" type="text" name="provmuni"></input>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group label-floating">
										<label class="control-label" for="zipcode2">Zip Code</label>
										<input class="form-control" id="zipcode2" type="number" name="provzip"></input>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- contact -->
					<div class="row col-md-12">
					<h6 style="padding-top:5%"><i class="fa fa-phone"></i><b> CONTACT INFORMATION</b></h6>
					<hr style="padding-bottom: 10px;">
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label class="control-label" for="email">E-Mail Address</label>
								<input type="email" name="email" ng-model="mail" class="form-control" id="email" required>
								<p ng-show="!myForm.email.$valid " class="help-block">E-mail Address is required</p>
							</div>
							<div class="row">
								<div class="col-md-6" ng-app="">
									<div class="form-group label-floating">
										<label style="font-size: 11px;" class="control-label text-sm" for="contactperson">Contact Person in case of emergency</label>
										<input class="form-control" type="text" name="contact_name" id="contactperson" ng-minlength="2" ng-model="contact_name" required>
										<span class="help-block" ng-show="!myForm.contact_name.$pristine && myForm.contact_name.$error.required" style="color:red;">This is required. </span>
										<span class="help-block" ng-show="myForm.contact_name.$dirty && myForm.contact_name.$error.minlength" style="color:red;">This is too short </span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label" for="contactpersonno">{{contact_name}}'s Contact Details</label>
										<input class="form-control" type="number" name="contact_details" id="contactpersonno" ng-model="contact_details" ng-minlength="2" required>
										<span class="help-block" ng-show="!myForm.contact_details.$pristine && myForm.contact_details.$error.required" style="color:red;">This is required. </span>
										<span class="help-block" ng-show="myForm.contact_details.$dirty && myForm.contact_details.$error.minlength" style="color:red;">This is too short </span>
									</div>
								</div>
							</div>
						</div>
						<!--  -->
							<div class="row col-md-6">
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="celno">Mobile No.</label>
									<input data-inputmask="'mask': '9999-999-9999'" type="text" name="mobile_num" class="form-control" id="celno" ng-model="mobile_num" ng-minlength="2" required>
									<span class="help-block" ng-show="!myForm.mobile_num.$pristine && myForm.mobile_num.$error.required" style="color:red;">This is required. </span>
									<span class="help-block" ng-show="myForm.mobile_num.$dirty && myForm.mobile_num.$error.minlength" style="color:red;">This is too short </span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="telno">Home Tel No.</label>
									<input data-inputmask="'mask': '(999)-9999'" type="text" name="home_telnum" class="form-control" id="telno" ng-minlength="2" ng-model="home_telnum">
								</div> 
							</div>
							<div class="col-md-12">
								<div class="form-group label-floating">
									<label class="control-label" for="skype">Skype User Id</label>
									<input type="text" name="skype_userid" class="form-control" id="skype">
								</div>
							</div>
						</div>
					</div>


					<!-- buttons -->
					<button type="button" href="#container1" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container1').style.display='block';document.getElementById('container2').style.display='none';">PREVIOUS</button>
					<button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" onclick="document.getElementById('container2').style.display='none'; document.getElementById('container3').style.display='block';" ng-disabled="myForm.home_telnum.$invalid || myForm.mobile_num.$invalid || myForm.contact_details.$invalid || myForm.contact_name.$invalid || myForm.email.$invalid || myForm.curmuni.$invalid || myForm.curdis.$invalid || myForm.curzip.$invalid">NEXT</button>
				</div> <!-- End of container 2 -->
				<!-- <input type="submit" name="" class="btn btn-primary btn-raised" ng-disabled="myForm.$invalid"> -->
				<div class="card container" id = "container3">
					<h6 style="padding-top: 30px"><i class="fa fa-group"> </i><b> FAMILY BACKGROUND</b></h6>
					<hr style="padding-bottom: 10px;">
					<!-- for married ones -->
					<div id="married_div" class="row col-md-12">
						<h2 style="padding-top: 2%;" align="center"> Spouse </h2>
						<div class="col-md-6">
							<div class="form-group label-floating">
					      		<label class="control-label" for="slname">Spouse's Last Name</label>
					      		<input id="slname" type="text" name="spouse_lname" class="form-control" ng-minlength="2" ng-model="spouse_lname" required>
								<span ng-show="!myForm.spouse_lname.$pristine && myForm.spouse_lname.$error.required" style="color:red;">This is required. </span>
								<span ng-show="myForm.spouse_lname.$dirty && myForm.spouse_lname.$error.minlength" style="color:red;">This is too short </span>
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="sfname">Spouse's First Name</label>
					      		<input id="sfname" type="text" name="spouse_fname" class="form-control" >
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="smname">Spouse's Middle Name</label>
					      		<input id="smname" type="text" name="spouse_midname" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<label class="control-label" for="occupation">Spouse's Occupation</label>
								<input type="text" name="spouse_occ" id="occupation" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="employer-name">Company Name</label>
								<input type="text" name="spouse_empname" id="employer-name" class="form-control">
							</div>
						</div>
					</div> <!-- end for married ones -->
								<!-- for widowed ones -->
					<div id="widowed_div" class="row col-md-12">
						<h2 style="padding-top: 2%;" align="center"> Spouse </h2>
						<div class="col-md-6">
							<div class="form-group label-floating">
					      		<label class="control-label" for="slname">Spouse's Last Name</label>
					      		<input id="slname" type="text" name="spouse_lname" class="form-control" >
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="sfname">Spouse's First Name</label>
					      		<input id="sfname" type="text" name="spouse_fname" class="form-control" >
							</div>
							<div class="form-group label-floating">
					      		<label class="control-label" for="smname">Spouse's Middle Name</label>
					      		<input id="smname" type="text" name="spouse_midname" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
						</div> 
					</div> <!-- end for widowed ones -->
					<div class="row col-md-12">
						<div class="col-md-6">
							<h3 style="padding-top: 3%;" align="center">Father's Information</h3>
							<div class="form-group label-floating">
								<label class="control-label" for="flname">Father's Last name</label>
								<input type="text" name="flname" id="flname" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="ffname">Father's First Name</label>
								<input type="text" name="ffname" id="ffname" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="fmname">Father's Middle Name</label>
								<input type="text" name="fmname" id="fmname" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="fplace-birth">Place of Birth</label>
								<input type="text" name="father_placebirth" id="fplace-birth" class="form-control">
							</div>

								<label class="switch col-md-4">
								  <input id="positive" type="checkbox">
								  <div class="slider round"></div>
								</label>
								<h5 class="col-md-5">  Do you have Child/Children?</h5>
							
						
						</div>
						<div class="col-md-6">
							<h3 style="padding-top: 3%;" align="center">Mother's Information</h3>
							<div class="form-group label-floating">
								<label class="control-label" for="mlname">Mother's Maiden name</label>
								<input type="text" name="mother_lname" id="mlname" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="mfname">Mother's First Name</label>
								<input type="text" name="mother_fname" id="mfname" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="mmname">Mother's Middle Name</label>
								<input type="text" name="mother_midname" id="mmname" class="form-control">
							</div>
							<div class="form-group label-floating">
								<label class="control-label" for="mplace-birth">Place of Birth</label>
								<input type="text" name="mother_placebirth" id="mplace-birth" class="form-control">
							</div>
						</div>
					</div>

                    <div class="waw btn-group-sm" id="siblings">
                      <button type="button" class="btn btn-raised btn-info add_field_button_sibling">Add Sibling</button>
                      <div class="input_fields_wrap_sibling">
                        <div class="row col-md-12">
                          <div class="col-md-6">
                            <div class="col-md-8">
                              <div class="form-group label-floating">
                                <label class="control-label" for="sibling" >Enter sibling name</label>
                                <input type="text" name="siblings" id="sibling" class="form-control">
                              </div>
                            </div> 
                            <div class="col-md-2">
                              <div class="form-group label-floating">
                                <label class="control-label" for="sage">Age</label>
                                <input id="sage" class="form-control" type="number" name="sibling_age"/>
                              </div>
                            </div>
                          </div>
                        </div> <!-- second sibling -->
                        <div class="row col-md-12">
                          <div class="col-md-6">
                            <div class="col-md-8">
                              <div class="form-group label-floating">
                                <label class="control-label" for="sibling" >Enter sibling name</label>
                                <input type="text" name="sibling2" id="sibling" class="form-control">
                              </div>
                            </div> 
                            <div class="col-md-2">
                              <div class="form-group label-floating">
                                <label class="control-label" for="sage">Age</label>
                                <input id="sage" class="form-control" type="number" name="sibling_age2"/>
                              </div>
                            </div>
                            <button type=button style="margin-top: 5%" class="btn btn-raised btn-sm btn-danger pull-right remove_field" >Remove</button>
                          </div>
                        </div><!-- third sibling -->
                        <div class="row col-md-12" >
                          <div class="col-md-6">
                            <div class="col-md-8">
                              <div class="form-group label-floating">
                                <label class="control-label" for="sibling" >Enter sibling name</label>
                                <input type="text" name="sibling3" id="sibling" class="form-control">
                              </div>
                            </div> 
                            <div class="col-md-2">
                              <div class="form-group label-floating">
                                <label class="control-label" for="sage">Age</label>
                                <input id="sage" class="form-control" type="number" name="sibling_age3"/>
                              </div>
                            </div>
                            <button type=button style="margin-top: 5%" class="btn btn-raised btn-danger btn-sm pull-right remove_field">Remove</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="waw btn-group-sm" id="children" style="display: none;">
                      <div class="input_fields_wrap">
                        <div class="row col-md-12">
                        <div class="col-md-6">
                            <!-- fillings -->
                          </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-raised btn-sm btn-info add_field_button">Add Child</button>
                        </div>
                          <div class="col-md-6">
                            <!-- fillings -->
                          </div>
	                    </div>
	                    <div class="row col-md-12" id="1chi">
	                    	<div class="col-md-6">
	                    		<!-- fillings -->
	                    	</div>
	                    	<div class="col-md-6">
	                            <div class="col-md-8">
	                              <div class="form-group label-floating">
	                                <label class="control-label" for="child" >Enter child name</label>
	                                <input type="text" name="child_name" id="child" class="form-control">
	                              </div>
	                            </div> 
	                            <div class="col-md-2">
	                              <div class="form-group label-floating">
	                                <label class="control-label" for="age">Age</label>
	                                <input id="age" class="form-control" type="number" name="child_age"/>
	                              </div>
	                            </div>
	                        </div>
	                    </div>
                        <div class="row col-md-12" id="2chi">
                          <div class="col-md-6">
                            <!-- fillings -->
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-8">
                              <div class="form-group label-floating">
                                <label class="control-label" for="child" >Enter child name</label>
                                <input type="text" name="child_name2" id="child" class="form-control">
                              </div>
                            </div> 
                            <div class="col-md-2">
                              <div class="form-group label-floating">
                                <label class="control-label" for="age">Age</label>
                                <input id="age" class="form-control" type="number" name="child_age2"/>
                              </div>
                            </div>
                            <button type=button style="margin-top: 5%" class="btn btn-raised btn-sm btn-danger pull-right remove_field">Remove</button>
                          </div>
                        </div>
                        <div class="row col-md-12" id="3chi">
                          <div class="col-md-6">
                            <!-- fillings -->
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-8">
                              <div class="form-group label-floating">
                                <label class="control-label" for="child" >Enter child name</label>
                                <input type="text" name="child_name3" id="child" class="form-control">
                              </div>
                            </div> 
                            <div class="col-md-2">
                              <div class="form-group label-floating">
                                <label class="control-label" for="age">Age</label>
                                <input id="age" class="form-control" type="number" name="child_age3"/>
                              </div>
                            </div>
                            <button type=button style="margin-top: 5%" class="btn btn-raised btn-danger btn-sm pull-right remove_field">Remove</button>
                          </div>
                        </div>
                      </div>
                    </div>

					<!-- buttons -->
					<button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container2').style.display='block';document.getElementById('container3').style.display='none';">PREVIOUS</button>
					<button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" onclick="document.getElementById('container3').style.display='none'; document.getElementById('container4').style.display='block';">NEXT</button>	
				</div> <!-- end of container 3 -->

                <div class="card container" id = "container4">
                    <h6 style="padding-top: 30px"><i class="fa fa-briefcase"> </i><b> WORK EXPERIENCE <small>(Most recent on top)</small></b></h6>  
                    <hr>
                            <button type="button" class="btn btn-raised btn-sm btn-info add_field_button_work">Add Work Experience</button>
                    <div class="input_fields_wrap_work">
                      <div class="row col-md-12">
                          <div class="col-md-2">
                            <div class="form-group label-floating">
                              <label class="control-label" for="from">From:</label>
                              <input class="form-control" data-provide="datepicker" name="datefrom" id="from"  data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group label-floating">
                              <label class="control-label" for="to">To:</label>
                              <input class="form-control" data-provide="datepicker" name="dateto" id="to" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group label-floating">
                              <label class="control-label" for="employers_name">Company Name</label>
                              <input class="form-control" type="text" name="company_name" id="employers_name">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group label-floating">
                              <label class="control-label" for="employers_contact_number">Contact number</label>
                              <input class="form-control" type="number" name="contactnum" id="employers_contact_number">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group label-floating">
                              <label class="control-label" for="employers_address">Company's address</label>
                              <input class="form-control" type="text" name="compadd" id="employers_address">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group label-floating">
                              <label class="control-label" for="position-title">Postion Title</label>
                              <input class="form-control" type="text" name="position" id="position-title">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group label-floating">
                              <label class="control-label" for="name-supervisor">Name of immediate supervisor</label>
                              <input class="form-control" type="text" name="supervisor" id="name-supervisor">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group label-floating">
                              <label class="control-label" for="monthly-salary">Monthly salary</label>
                              <input class="form-control" type="number" name="salary" id="monthly-salary">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group label-floating">
                              <label class="control-label" for="reason">Reason of leaving</label>
                              <input class="form-control" type="text" name="reason" id="reason">
                            </div>
                          </div>
                          <br><br><br><br><br><br><br><br><br>
                      </div>
                    </div>

                    <div class="row col-md-12">
	                    <h6 style="padding-top: 30px pull-left"><i class="fa fa-graduation-cap"> </i><b> EDUCATIONAL BACKGROUND </b></h6>
	                    <hr>
	                    	<div class="col-md-12">
	                    		<label><b>Primary:</b></label>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="school">Name of School</label>
	                    			<input type="text" name="elem_name" class="form-control" id="school">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="pfrom">From:</label>
	                    			<input data-provide="datepicker"  name="elem_datefrom" id="pfrom" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="pto">To:</label>
	                    			<input data-provide="datepicker" name="elem_dateto" id="pto" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
	                    			<input type="text" class="form-control" id="scholarship" name="elem_scholarship">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-12">
	                    		<label><b>Secondary:</b></label>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="school">Name of School</label>
	                    			<input type="" name="hs_name" class="form-control" id="school">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="sfrom">From:</label>
	                    			<input data-provide="datepicker" name="hs_datefrom" id="sfrom" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="sto">To:</label>
	                    			<input data-provide="datepicker" name="hs_dateto" id="sto" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
	                    			<input type="text" class="form-control" id="scholarship" name="hs_scholarship">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-12">
	                    		<label><b>Tertiary:</b></label>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="school">Name of School</label>
	                    			<input type="" name="col_name" class="form-control" id="school">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="pfrom">From:</label>
	                    			<input data-provide="datepicker" name="col_datefrom" id="pfrom" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="pfrom">To:</label>
	                    			<input data-provide="datepicker" name="col_dateto" id="pto" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="degree">Degree Course /Vocational</label>
	                    			<input type="text" id="degree" class="form-control" name="col_degree">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
	                    			<input type="text" class="form-control" id="scholarship" name="col_scholarship">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-12">
	                    		<label><b>Graduate Studies:</b></label>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="school">Name of School</label>
	                    			<input type="" name="grad_name" class="form-control" id="school">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="pfrom">From:</label>
	                    			<input data-provide="datepicker" name="grad_datefrom" id="pfrom" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="pfrom">To:</label>
	                    			<input data-provide="datepicker" name="grad_dateto" id="pto" class="form-control" data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="degree">Degree Course /Vocational</label>
	                    			<input type="text" id="degree" class="form-control" name="grad_degree">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="scholarship">Scholarship/Honors</label>
	                    			<input type="text" class="form-control" id="scholarship" name="grad_scholarship">
	                    		</div>
	                    	</div>
                    </div>
                    <div class="col-md-12">
                    	<h6 style="padding-top: 30px"><i class="fa fa-id-card"> </i><b> Professional Qualifications</b></small></h6>  
                    	<hr>
                            <button type="button" class="btn btn-raised btn-info btn-sm add_field_button_professional">Add Professional Qualification</button>
                    </div>
                    <div class="input_fields_wrap_professional">                     	
	                    <div class="row col-md-12">
	                    	<div class="col-md-3">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="license">License/Certification</label>
	                    			<input type="text" class="form-control" name="license" id="license">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-1">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="rate">Rating</label>
	                    			<input type="text" id="rate" class="form-control" name="rating">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-2">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="dateg">Date Grandted</label>
	                    			<input data-provide="datepicker" id="dateg" class="form-control" name="dategranted" data-date-format="MM dd, yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-2">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="institution">Granting Institution</label>
	                    			<input type="text" class="form-control" id="institution" name="institution">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-2">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="license-number">License Number</label>
	                    			<input type="number" class="form-control" id="license-number" name="licensenum">
	                    		</div>
	                    	</div>
	                    	<div class="col-md-2">
	                    		<div class="form-group label-floating">
	                    			<label class="control-label" for="dater">Date Release</label>
	                    			<input data-provide="datepicker" class="form-control" id="dater" name="datereleased" data-date-format="MM dd, yyyy" data-date-end-date="-1d">
	                    		</div>
	                    	</div>
	                    </div>
                    </div>

                        <!-- buttons -->
                    <button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container3').style.display='block';document.getElementById('container4').style.display='none';">PREVIOUS</button>
                    <button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-primary pull-right" onclick="document.getElementById('container4').style.display='none'; document.getElementById('container5').style.display='block';">NEXT</button>
                </div> <!-- end of container 4 -->

                <div class="card container" id="container5">
                	<h6 style="padding-top: 30px"><i class="fa fa-language"> </i><b> Language proficiency</b> </h6>  
                    <hr>
					<button type="button" class="btn btn-raised btn-info add_field_button_language" value="Add another text input" onClick="addInput('dynamicInput');">Add Language</button>
					<div class="input_fields_wrap_language" >
						<div class="row col-md-12" id="dynamicInput">
							<div class="col-md-3">
								<div class="form-group label-floating">
									<label class="control-label" for="language">Language you know</label>
									<input type="text" class="form-control" id="language" name=" language">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
										<label> 
										<input type="checkbox" name="speak" value="yes"> Speak
										</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
										<label> 
										<input type="checkbox" name="write" value="yes"> Write
										</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
										<label> 
										<input type="checkbox" name="read" value="yes"> Read
										</label>
								</div>
							</div>
						</div>
					</div>

					<h6 style="padding-top: 30px"><b> Other Information</b> </h6>
					<hr>
					<div class="row col-md-12">
						<div class="row col-md-4">
							<div class="input_fields_wrap_skill">
									<button type="button" class="btn btn-raised btn-info add_field_button_skill">ADD</button>
								<div class="form-group label-floating">
									<label class="control-label" for="skill">Special Skill/Hobbies</label>
									<input type="text" class="form-control" id="skill" name="skill">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input_fields_wrap_nacad">
									<button type="button" class="btn btn-raised btn-info add_field_button_nacad">ADD</button>
								<div class="form-group label-floating">
									<label class="control-label" for="nacad">Non-Academic Distinction / Recognition</label>
									<input type="text" class="form-control" id="nacad" name="recognition">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="input_fields_wrap_org">
									<button type="button" class="btn btn-raised btn-info add_field_button_org">ADD</button>
								<div class="form-group label-floating">
									<label class="control-label" for="org">Membership in Association / Organization</label>
									<input type="text" class="form-control" id="org" name="org">
								</div>
							</div>
						</div>
					</div>
					<div class="row col-md-12" style="margin-top: 10px">			
						<div class="col-md-5">
							<div class="form-group">
								<label style="font-size: 25px">Have you ever been formally charged?</label>
								<div class="radio radio-primary">
									<label>
										<input 	type="radio" name="charge" value ="yes" onclick="document.getElementById('charged').style.display='block';" >YES
									</label>
									<label>
										<input type="radio" name="charge" value="no" onclick="document.getElementById('charged').style.display='none';" checked>NO
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-7"  id="charged">
							<div class="form-group label-floating">
								<textarea class="form-control floating-label" value="yes" name="chargespec" style="height: 60px" placeholder="If Yes, give details:"></textarea>
							</div>
						</div>
					</div>
					<div class="row col-md-12" style="margin-top: 10px">			
						<div class="col-md-5">
							<div class="form-group">
								<label style="font-size: 25px">Have you ever been Guilty of any administrative offense?</label>
								<div class="radio radio-primary" onchange="bya(this)">
									<label>
										<input 	type="radio" name="offense" value="yes" onclick="document.getElementById('offense').style.display='block';">YES
									</label>
									<label>
										<input type="radio" name="offense" value="no" onclick="document.getElementById('offense').style.display='none';" checked>NO
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-7" style="margin-top: 25px" id="offense">
							<div class="form-group">
							<textarea class="form-control floating-label" name="offensespec" style="height: 75px" placeholder="If Yes, give details:"></textarea>
							</div>
						</div>
					</div>
					<div class="row col-md-12" style="margin-top: 10px">			
						<div class="col-md-5">
							<div class="form-group">
								<label style="font-size: 25px">Have you ever been convivted of any crime or violation of any law, decree, ordinance or regulation by any court of tribunal?</label>
								<div class="radio radio-primary">
									<label>
										<input 	type="radio" name="tribunal" value="yes"  onclick="document.getElementById('tribunal').style.display='block';">YES
									</label>
									<label>
										<input type="radio" name="tribunal" value="no" onclick="document.getElementById('tribunal').style.display='none';" checked>NO
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-7" style="margin-top: 25px" id="tribunal">
							<textarea class="form-control floating-label" value="yes" name="tribunalspec" style="height: 75px" placeholder="If Yes, give details:"></textarea>
						</div>
					</div>
					<div class="row col-md-12" style="margin-top: 10px">			
						<div class="row col-md-5">
							<div class="form-group">
								<label style="font-size: 25px">Have you ever been separated froom the service in any of the following modes:
								Resignition, Retirement, Dropped from rolls, dismissal, termination, end of term, finished contract, AWOL or phased out, in the public or private sector?</label>
								<div class="radio radio-primary" >
									<label>
										<input 	type="radio" name="sector" onclick="document.getElementById('sector').style.display='block';">YES
									</label>
									<label>
										<input type="radio" name="sector" value="no" onclick="document.getElementById('sector').style.display='none';" checked>NO
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-7 waw" style="margin-top: 30px" id="sector">
							<div class="form-group label-floating">
						    	<label for="textArea" class="control-label">If Yes, give details:</label>
						    	<textarea class="form-control" value="yes" name="sectorspec" style="height: 75px"></textarea>
						    </div>
						</div>
					<h6 style="margin-top: 280px"><b> Character Reference</b> (Person not related by consanguity or affinity to you)</h6>
					</div>
					<div class="">
						<div class="row col-md-12">
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="rname">Name</label>
									<input type="text" class="form-control" id="rname" name="ONE_REFNAME" ng-model="ONE_REFNAME" ng-minlength="2" required>
									<span class="help-block" ng-show="!myForm.ONE_REFNAME.$pristine && myForm.ONE_REFNAME.$error.required" style="color:red;">This is required. </span>
									<span class="help-block" ng-show="myForm.ONE_REFNAME.$dirty && myForm.ONE_REFNAME.$error.minlength" style="color:red;">This is too short </span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label" for="cname">Company Name</label>
									<input type="text" class="form-control" id="cname" name="ONE_REFADDRESS" ng-model="ONE_REFADDRESS" ng-minlength="2" required>
									<span class="help-block" ng-show="!myForm.ONE_REFADDRESS.$pristine && myForm.ONE_REFADDRESS.$error.required" style="color:red;">This is required. </span>
									<span class="help-block" ng-show="myForm.ONE_REFADDRESS.$dirty && myForm.ONE_REFADDRESS.$error.minlength" style="color:red;">This is too short </span>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label" for="eadd">Tel No. / Email Address</label>
									<input type="text" class="form-control" id="eadd" name="ONE_REFCONTACT" ng-model="ONE_REFCONTACT" ng-minlength="2" required>
									<span class="help-block" ng-show="!myForm.ONE_REFCONTACT.$pristine && myForm.ONE_REFCONTACT.$error.required" style="color:red;">This is required. </span>
									<span class="help-block" ng-show="myForm.ONE_REFCONTACT.$dirty && myForm.ONE_REFCONTACT.$error.minlength" style="color:red;">This is too short </span>
								</div>
							</div>
						</div>
						<div class="row col-md-12">
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="rname">Name</label>
									<input type="text" class="form-control" id="rname" name="TWO_REFNAME">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label" for="cname">Company Name</label>
									<input type="text" class="form-control" id="cname" name="TWO_REFADDRESS">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label" for="eadd">Tel No. / Email Address</label>
									<input type="text" class="form-control" id="eadd" name="TWO_REFCONTACT">
								</div>
							</div>
						</div>
						<div class="row col-md-12">
							<div class="col-md-6">
								<div class="form-group label-floating">
									<label class="control-label" for="rname">Name</label>
									<input type="text" class="form-control" id="rname" name="THREE_REFNAME">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group label-floating">
									<label class="control-label" for="cname">Company Name</label>
									<input type="text" class="form-control" id="cname" name="THREE_REFADDRESS">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label" for="eadd">Tel No. / Email Address</label>
									<input type="text" class="form-control" id="eadd" name="THREE_REFCONTACT">
								</div>
							</div>
						</div>
						<div class="row col-md-12">
						  <div class="col-md-2">
						  	<div class="form-group">
						      	<label for="inputFile" class="col-md-1">File</label>
						  	</div>
						  </div>
					      <div class="col-md-4">
					      	<div class="form-group">
					      		 <input type="text" class="form-control" placeholder="Upload Updated Resume">
						       <input type="file" name="fileToUpload" id="fileToUpload">
					      	</div>
					      </div>
					      <div class="col-md-3">
					      	<div class="form-group label-floating">
						        <label class="control-label" for="source">Application Source</label>
						        <select id="source" name="source" class="select form-control" onchange="showsource(this)">
						        	<option value="Twitter">Twitter</option>
						        	<option value="My Opportunity">My Opportunity</option>
						        	<option value="Linked In">Linked In</option>
						        	<option value="Indeed">Indeed</option>
						        	<option value="Facebook">Facebook</option>
						        	<option value="Job fair">Job fair</option>
						        	<option value="Job street">Job streets</option>
						        	<option value="yes">Others</option>
						        </select>
					      	</div>
					      </div>
						  <div class="col-md-3">
							<div id="souceothers" class="form-group label-floating">
						      	<label class="control-label" for="sourcespec">Please specify</label>
						      	<input type="text" id="sourcespec" class="form-control" name="sourcespec">
						    </div>
						  </div>
						</div>
					</div>
					
                	<!-- buttons -->
                	<button type="button" class="btn btn-raised btn-primary pull-left" onclick="document.getElementById('container4').style.display='block';document.getElementById('container5').style.display='none';">PREVIOUS</button>
                    <button type="button" style="margin-bottom: 1%" class="btn btn-raised btn-info btn-md pull-right" data-toggle="modal" data-target=".modal">SUBMIT</button>
                </div><!-- end of container 5 -->

                <div id="#modald" class="modal fade" role="dialog" >
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				        <h3 class="modal-title"><center>Terms and Agreement</center></h3>
				      </div>
				      <div class="modal-body">
				      <p><medium>
				        I Certify that the information contained in this application is
				        correct to the best of my knowledge. I understand that to falsify
				        information is grounds for refusing to hire me, or for discharge
				        should I be hired. I authorize any person, organization or 
				        company listed on this application to furnish you any and all 
				        information concerning my previous employment, education, and 
				        qualifications for employment, I agree to abide by the rules and
				        regulations of the company, which rules may be changed, withdrawn,
				        added or interpreted at any time, at the company's sole option and
				        without prior notice to me. I also acknowledge that my employment
				        may be terminated, or any offer or acceptance of employment 
				        withdrawn, at any time, with or without cause, and with or without
				        prior notice at the option of the company or myself.
				      </medium></p>
				      </div>
				      <div class="modal-footer">
				      <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom: 2.5%">Close</button>
				        <input type="submit" class="btn btn-success btn-raised" name="submit" value="yes">I Agree
				      </div>
				    </div>
				  </div>
				</div>
			</form>				
		</div>
		<div class="col-md-1"></div>
	</div>
	
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/material.js"></script>
	<script type="text/javascript" src="js/angular.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/jquery.dropdown.js"></script>
	<script type="text/javascript" src="js/inputmask.js"></script>
	<script type="text/javascript" src="js/inputmask.extensions.js"></script>
	<script type="text/javascript" src="js/jquery.inputmask.js"></script>
	<!-- <script src="components/angular/angular.js"></script> -->
	<!-- <script src="components/angular-materializecss-datepicker/angular-materializecss-datepicker.js"></script> -->

	<script type="text/javascript">
		$.material.init();

		$( document ).ready(function() {
		    document.getElementById('container2').style.display='none';/*hide all containers !first*/
		    document.getElementById('container3').style.display='none';/*hide all containers !first*/
		    document.getElementById('container4').style.display='none';/*hide all containers !first*/
		    document.getElementById('container5').style.display='none';/*hide all containers !first*/
		    document.getElementById('other_div').style.display='none';/*hide specify civil status*/
		    document.getElementById('married_div').style.display='none';/*hide married status*/
		    document.getElementById('widowed_div').style.display='none';/*hide widowed status*/
		    document.getElementById('charged').style.display='none';
		    document.getElementById('offense').style.display='none';
		    document.getElementById('tribunal').style.display='none';
		    document.getElementById('sector').style.display='none';
		    document.getElementById('souceothers').style.display='none';
		    /*window.onbeforeunload = function() {
			  return "Data will be lost if you leave the page, are you sure?";
			};*/
			//*prompt on refresh
		});


		// function for toggle child/sibling
		$(document).ready(function(){
    		$("#positive").click(function(){
       			$(".waw").toggle();
    		});
		});

		// function for select civil status
		function showspec(elem){
		   if(elem.value == "Others"){
	      		document.getElementById('other_div').style.display = "block";
	      		document.getElementById('widowed_div').style.display = "none";
		  		document.getElementById('married_div').style.display = "none";
		   }
		   else if (elem.value == "Married") {
		   		document.getElementById('married_div').style.display = "block";
		   		document.getElementById('widowed_div').style.display = "none";
		   		document.getElementById('other_div').style.display = "none";
		   }
		   else if (elem.value == "Widowed") {
		   		document.getElementById('widowed_div').style.display = "block";
		   		document.getElementById('married_div').style.display = "none";
		   		document.getElementById('other_div').style.display = "none";
		   }
		    else if (elem.value == "Separated") {
		   		document.getElementById('married_div').style.display = "block";
		   		document.getElementById('widowed_div').style.display = "none";
		   		document.getElementById('other_div').style.display = "none";
		   }

		  else{
		  		document.getElementById('other_div').style.display = "none";
		  		document.getElementById('widowed_div').style.display = "none";
		  		document.getElementById('married_div').style.display = "none";
		  }
		}

		function showsource(source){
			if (source.value == 1) {
				document.getElementById('souceothers').style.display = "block";
			}
			else{
				document.getElementById('souceothers').style.display = "none";
			}
		}

		      $(document).ready(function() {
		        $(".select").dropdown({"optionClass": "withripple"});

		      });

		      $().dropdown({autoinit: "select"});

            // function for adding fields child
            $(document).ready(function() { 
                var max_fields = 10; 
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_button = $(".add_field_button"); //Add button ID
                
                var x = 3; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-6"></div><div class="col-md-6"><div class="col-md-8"><div class="form-group label-floating"><label class="control-label" for="child" >Enter child name</label><input type="text" name="child_name' + x + '" id="child" class="form-control"></div></div> <div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="age">Age</label><input id="age" class="form-control" type="number" name="child_age' + x + '"/></div></div><button type=button style="margin-top: 5%" class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });


 

            // function for adding fields sibling
            $(document).ready(function() { 
                var max_fields = 10; 
                var wrapper = $(".input_fields_wrap_sibling"); //Fields wrapper
                var add_button = $(".add_field_button_sibling"); //Add button ID
                
                var x = 3; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-6"><div class="col-md-8"><div class="form-group label-floating"><label class="control-label" for="sibling" >Enter sibling name</label><input type="text" id="sibling" class="form-control" name="sibling' + x + '"></div></div> <div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="sage">Age</label><input id="sage" name="sibling_age' + x + '" class="form-control" type="number"/></div></div><button type=button style="margin-top: 5%" class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

            // function for adding fields work
            $(document).ready(function() { 
                var max_fields = 5; 
                var wrapper = $(".input_fields_wrap_work"); //Fields wrapper
                var add_button = $(".add_field_button_work"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class=""><div class="row col-md-12"><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="from">From:</label><input class="form-control" data-provide="datepicker" name="datefrom' + x + '" id="from"  data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="to">To:</label><input class="form-control" data-provide="datepicker" name="dateto' + x + '" id="to"  data-date-min-view-mode="1" data-date-format="MM yyyy" data-date-end-date="-1d"></div></div><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="employers_name">Company`s Name</label><input class="form-control" type="text" name="company_name' + x + '" id="employers_name"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="employers_contact_number">Contact number</label><input class="form-control" type="number" name="contactnum' + x + '" id="employers_contact_number"></div></div><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="employers_address">Company`s address</label><input class="form-control" type="text" name="compadd' + x + '" id="employers_address"></div></div><div class ="col-md-3"><div class="form-group label-floating"><label class="control-label" for="position-title">Postion Title</label><input class="form-control" type="text" name="position' + x + '" id="position-title"></div></div><div class="col-md-4"><div class="form-group label-floating"><label class="control-label" for="name-supervisor">Name of immediate supervisor</label><input class="form-control" type="text" name="supervisor' + x + '" id="name-supervisor"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="monthly-salary">Monthly salary</label><input class="form-control" type="number" name="salary' + x + '" id="monthly-salary"></div></div><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="reason">Reason of leaving</label><input class="form-control" type="text" name="reason' + x + '" id="reason"></div></div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

            // function for adding fields professional qualification
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_professional"); //Fields wrapper
                var add_button = $(".add_field_button_professional"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="license">License/Certification</label><input type="text" class="form-control" name="license' + x + '" id="license"></div></div><div class="col-md-1"><div class="form-group label-floating"><label class="control-label" for="rate">Rating</label><input type="text" id="rate" class="form-control" name="rating' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="dateg">Date Grandted</label><input data-provide="datepicker" id="dateg" class="form-control" name="dategranted' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="institution">Granting Institution</label><input type="text" class="form-control" id="institution" name="institution' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="license-number">License Number</label><input type="number" class="form-control" id="license-number" name="licensenum' + x + '"></div></div><div class="col-md-2"><div class="form-group label-floating"><label class="control-label" for="dater">Date Release</label><input data-provide="datepicker" class="form-control" id="dater" name="datereleased' + x + '"></div></div><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

             // function for adding fields language
            $(document).ready(function() { 
                var max_fields = 5; 
                var wrapper = $(".input_fields_wrap_language"); //Fields wrapper
                var add_button = $(".add_field_button_language"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row col-md-12"><div class="col-md-3"><div class="form-group label-floating"><label class="control-label" for="language">Language you know</label><input type="text" class="form-control" id="language" name="language' + x + '"></div></div><div class="col-md-1"><div class="form-group"><label><input type="checkbox" name="speak' + x + '" value= "yes"> Speak</label></div></div><div class="col-md-1"><div class="form-group"><label> <input type="checkbox" name="write' + x + '" value="yes"> Write</label></div></div><div class="col-md-1"><div class="form-group"><label> <input type="checkbox" name="read' + x + '" value="yes"> Read</label></div></div><button type=button class="btn btn-raised btn-danger remove_field">Remove</button></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

            // function for adding fields Skills and hobbies
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_skill"); //Fields wrapper
                var add_button = $(".add_field_button_skill"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="form-group label-floating"><label class="control-label" for="skill">Special Skill/Hobbies</label><input type="text" class="form-control" id="skill" name="skills' + x + '"><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });


            // function for adding fields Non-academic
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_nacad"); //Fields wrapper
                var add_button = $(".add_field_button_nacad"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="form-group label-floating"><label class="control-label" for="nacad">Non-Academic Distinction / Recognition</label><input type="text" class="form-control" id="nacad" name="recognition' + x + '"><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });
        
        	// function for adding fields Members in Association and Organizations
            $(document).ready(function() { 
                var max_fields = 3; 
                var wrapper = $(".input_fields_wrap_org"); //Fields wrapper
                var add_button = $(".add_field_button_org"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="form-group label-floating"><label class="control-label" for="org">Membership in Association / Organizations</label><input type="text" class="form-control" id="org" name="org' + x + '"><button type=button class="btn btn-raised btn-sm btn-danger remove_field pull-right">Remove</button>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });

       

            // function for toggle child/sibling
		$(document).ready(function(){
    		$("#yun").click(function(){
       			$(".waw").toggle();
    		});
		});

		//Input mask
		    $(document).ready(function(){
				$(":input").inputmask();
			  	or
			  	Inputmask().mask(document.querySelectorAll("input"));
			});

	





	</script>
</body>
</html>
