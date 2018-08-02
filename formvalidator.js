
$("#submitForm").on('click', function(e){
	document.getElementById("AgreeSubmit").value = "I Agree";
	$( "#submitAllData" ).trigger( "click" );
});
$("#agreement").on('click', function(e) {
		$.ajax({
			url: "address.php",
			type: "GET",
			data: {agree:'validatedApplicant'},
			success: function(data){
				
			},
			error: function(data){
				alert(data);
			}
		});
});


$("#question1").on('keydown', function(e) {
				var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
				if (words <= 300) {
					$('#word_left1').text(300-words)
				}else{
					if (e.which !== 8) e.preventDefault();
				}if(words > 250){
					$("#word_left1").css('color', 'red');
					
				}if(words < 250){
					$("#word_left1").css('color', 'black');
				}
			});
			$("#question2").on('keydown', function(e) {
				var words2 = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
				if (words2 <= 300) {
					$('#word_left2').text(300-words2)
				}else{
					if (e.which !== 8) e.preventDefault();
				}if(words2 > 250){
					$("#word_left2").css('color', 'red');
					
				}if(words2 < 250){
					$("#word_left2").css('color', 'black');
				}
			});
			$("#question3").on('keydown', function(e) {
				var words3 = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
				if (words3 <= 300) {
					$('#word_left3').text(300-words3)
				}else{
					if (e.which !== 8) e.preventDefault();
				}if(words3 > 250){
					$("#word_left3").css('color', 'red');
					
				}if(words3 < 250){
					$("#word_left3").css('color', 'black');
				}
			});
			$("#question4").on('keydown', function(e) {
				var words4 = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
				if (words4 <= 300) {
					$('#word_left4').text(300-words4)
				}else{
					if (e.which !== 8) e.preventDefault();
				}if(words4 > 250){
					$("#word_left4").css('color', 'red');
					
				}if(words4 < 250){
					$("#word_left4").css('color', 'black');
				}
			});		
    		$("#btn_freshgrad").click(function(){
				$("button").removeClass("active");
				$(this).addClass("active");
				document.getElementById("app_stat").value = 'grad';
				$('#employers_name1').attr('required', false);
				$('#employers_address').attr('required', false);
				$('#position-title').attr('required', false);
				$('#reason').attr('required', false);
				$('#monthlysalary').attr('required', false);
				$("#employers_name1").blur();
				$("#employers_address").blur();
				$("#position-title").blur();
				$("#reason").blur();
    		});
			$("#btn_experienced").click(function(){
				
				$("button").removeClass("active");
				$(this).addClass("active");
				document.getElementById("app_stat").value = 'exp';
    		});
$( "#agreement" ).on( "click", function() {
		var apply_position = document.getElementById("apply_position").value;
		//var apply_position1 = document.getElementById("apply_position1").value;
		var lastName = document.getElementById("lname").value;
		var firstName = document.getElementById("fname").value;
		var employ_date = document.getElementById("empdate").value;
		var date_ofbirth = document.getElementById("bday123").value;
		var placeofbirth = document.getElementById("placeofbirth").value;
		var otherpos = document.getElementById("otherpositionDiv").value;
		var source = document.getElementById("source").value;
		var cstatus = document.getElementById("cstatus").value;
		
		function fnext_required(){
			$("#apply_position").blur();
			$("#lname").blur();
			$("#fname").blur();
			$("#empdate").blur();
			$("#bday123").blur();
			$("#placeofbirth").blur();
			$("#source").blur();
			$("#cstatus").blur();
		}
		
		if(source=="Select Source"){
			$("#source").blur();
			$("#source").focus();
			document.getElementById("source").style.borderColor = "10px solid red";
			document.getElementById("sourcevalidator").style.display="block";	
		}

		if (cstatus=="Select Civil Status"){
			$("#cstatus").blur();
			$("#cstatus").focus();
			document.getElementById("cstatus").style.borderColor = "10px solid red";
			document.getElementById("cstatusvalidator").style.display="block";
		}
		
		if(apply_position=="Others"){
			if(otherpos==""){
				fnext_required();
				$("#otherpositionDiv").blur();
				$("#otherpositionDiv").focus();
				
			}else{
				if( apply_position =="Select Position"){
				fnext_required();
				document.getElementById("positionErrorMessage").style.display = 'block';
					$("#apply_position").focus();
				}else if( lastName ==""){
					fnext_required();
					$("#lname").focus();
				}else if(firstName==""){
					fnext_required();
					$("#fname").focus(); 
				}else if(employ_date==""){
					fnext_required();
					$("#empdate").focus();
				}else if(date_ofbirth==""){
					fnext_required();
					$("#bday123").focus();
				}else if(placeofbirth==""){
					fnext_required();
					$("#placeofbirth").focus();
				}else if(source=="Select Source"){
					$("#source").blur();
					$("#source").focus();
					document.getElementById("source").style.borderColor = "red";
					document.getElementById("sourcevalidator").style.display="block";	
				}
				// else{
				// 	document.getElementById("container1").style.display="none";
				// 	document.getElementById("container2").style.display="block";
				// }
			}
		}else{
			if(apply_position =="Select Position"){
			fnext_required();
			document.getElementById("apply_position").style.borderColor = "red";
			document.getElementById("positionErrorMessage").style.display = 'block';
				$("#apply_position").focus();
			}else if( lastName ==""){
				fnext_required();
				$("#lname").focus();
			}else if(firstName==""){
				fnext_required();
				$("#fname").focus(); 
			}else if(employ_date==""){
				fnext_required();
				$("#empdate").focus();
			}else if(date_ofbirth==""){
				fnext_required();
				$("#bday123").focus();
			}else if(placeofbirth==""){
				fnext_required();
				$("#placeofbirth").focus();
			}else if(source=="Select Source"){
				$("#source").blur();
				$("#source").focus();
				document.getElementById("source").style.borderColor = "red";
				document.getElementById("sourcevalidator").style.display="block";	
			}
			// else{
			// 	document.getElementById("container1").style.display="none";
			// 	document.getElementById("container2").style.display="block";
			// }
		}
		 
});
$("#apply_position").on('change',function(e){
	$('#position_data').attr('value',$(this).val());
});
$( "#agreement" ).on( "click", function() {

	document.getElementById("positionErrorMessage").style.display = 'none';
		var emailvalue =  $('#email').val();
		$.ajax({
			url: "address.php",
			type: "GET",
			data: {email:emailvalue},
			success: function(data){
				
				if(data=='Email already taken!'){
					$('#email').focus();
					document.getElementById('emailhelp').innerHTML = data;
				}
			},
			error: function(data){
				alert(data);
			}
		});
		
	var curhome = document.getElementById("current_home_num").value;
	var curbar = document.getElementById("current_barangay").value;
	var curadd = document.getElementById("curaddress").value;
	var mobilenum = document.getElementById("mobile_number").value;

	var mobilenum2 = document.getElementById("celno2").value;
	var mobilenum3 = document.getElementById("celno3").value;
	
	var conperson = document.getElementById("contactperson").value;
	var cperson_contact = document.getElementById("contactpersonno").value;
	var email = document.getElementById("email").value;

	var emailIndex = email.indexOf("@");
	var emailLength = email.length;
	var emailValidation = email.substring(emailIndex,emailLength);

	var moblieNumber_value = document.getElementById("mobile_number").value;
	
	var moblieNumber_value2 = document.getElementById("celno2").value;
	var moblieNumber_value3 = document.getElementById("celno3").value;

	var emailHelp = document.getElementById("emailhelp").value;
	var res = moblieNumber_value.substring(6, 7);

	var res2 = moblieNumber_value2.substring(6, 7);
	var res3 = moblieNumber_value3.substring(6, 7);
	
	var num = mobilenum.replace(/[^0-9]/g, '');

	var num2 = mobilenum2.replace(/[^0-9]/g, '');
	var num3 = mobilenum2.replace(/[^0-9]/g, '');

	var htmlContent;
	var node = document.getElementById('emailhelp');
	htmlContent = node.innerHTML;
	
	function snext_required(){
		$("#curaddress").blur();
		$("#current_home_num").blur();
		$("#current_barangay").blur();
		$("#email").blur();
		$("#mobile_number").blur();

		//$("#celno2").blur();
		//$("#celno3").blur();

		$("#contactperson").blur();
		$("#contactpersonno").blur();
	}
	if(curadd==""){
		snext_required();
		$("#curaddress").focus();
	}else if( curhome ==""){
		snext_required();
		$("#current_home_num").focus();
	}else if(curbar==""){
		snext_required();
		$("#current_barangay").focus();
	}else if(email==""){
		snext_required();
		$("#email").focus();
	}else if (emailValidation != "@gmail.com" && emailValidation != "@yahoo.com"){
		snext_required();
		document.getElementById("email_validator").style.display="block";
		$("#email").focus();
	}else if(mobilenum.length!=18){
		snext_required();
		$("#mobile_number").focus();

		/*
	}else if(mobilenum2.length!=18	&& mobilenum2 != null) {
		snext_required();
		$("#celno2").focus();
		/*
	}else if(mobilenum3.length!=18){
		snext_required();
		$("#celno3").focus();
	*/

	}else if(conperson==""){
		snext_required();
		$("#contactperson").blur();
	}else if(cperson_contact==""){
		snext_required();
		$("#contactpersonno").blur();
		$("#contactpersonno").focus();
	}else if(num.length!=12){
		document.getElementById("number_validator").style.display="block";
	}else if(res!=9){
		document.getElementById("number_validator").style.display="block";
/*
	}else if(num2.length!=12){
		document.getElementById("number_validator2").style.display="block";
	}else if(res2!=9){
		document.getElementById("number_validator2").style.display="block";
	}else if(num3.length!=12){
		document.getElementById("number_validator3").style.display="block";
	}else if(res3!=9){
		document.getElementById("number_validator3").style.display="block";
*/
		
	}else if(num.length==0){
		alert("empty number!");
	}else if(htmlContent=='Email already taken!'){
		$('#email').focus();
	}else{ 
		document.getElementById("email_validator").style.display="none";		
		// document.getElementById("container2").style.display="none";
		// document.getElementById("container3").style.display="block";
	}

});
$( "#agreement" ).on( "click", function() {
	var rname1 = document.getElementById('rname').value;
	var company_name1 = document.getElementById('company_name1').value;
	var email1 = document.getElementById('email1').value;
	var rname2 = document.getElementById('rname2').value;
	var cname2 = document.getElementById('cname2').value;
	var eadd2 = document.getElementById('eadd2').value;
	var rname3 = document.getElementById('rname3').value;
	var cname3 = document.getElementById('cname3').value;
	var eadd3 = document.getElementById('eadd3').value;
	var source = document.getElementById('source').value;
	var cstatus = document.getElementById("cstatus").value;

	
	function lnext_required(){
		$("#rname").blur();
		$("#company_name1").blur();
		$("#email1").blur();
		$("#rname2").blur();
		$("#cname2").blur();
		$("#eadd2").blur();
		$("#rname3").blur();
		$("#cname3").blur()
		$("#eadd3").blur();
		$("#cstatus").blur();
	}
	if(rname1==''){
		lnext_required();
		$("#rname").focus();
	}else if(company_name1==''){
		lnext_required();
		$("#company_name1").focus();
	}else if(email1==''){
		lnext_required();
		$("#email1").focus();
	}else if(rname2==''){
		lnext_required();
		$("#rname2").focus();
	}else if(cname2==''){
		lnext_required();
		$("#cname2").focus();
	}else if(eadd2==''){
		lnext_required();
		$("#eadd2").focus();
	}else if(rname3==''){
		lnext_required();
		$("#rname3").focus();
	}else if(cname3==''){
		lnext_required();
		$("#cname3").focus()
	}else if(eadd3==''){
		lnext_required();
		$("#eadd3").focus();
	}
	// else if(source=='Select Source'){
	// 	lnext_required();
	// 	document.getElementById("source").style.borderColor = "10px solid red";
	// 	document.getElementById("sourcevalidator").style.display="block";
	// }else if (cstatus=='Select Civil Status'){
	// 	lnext_required();
	// 	document.getElementById("cstatus").style.display="block"
	// 	document.getElementById("cstatusvalidator").style.borderColor = "10px solid red";
	// }
	// else{
	// 	document.getElementById('container6').style.display='block';
	// 	document.getElementById('container5').style.display='none';
	// }

});
$( "#agreement" ).on( "click", function() {
	var stat_ap = $('#app_stat').val();
	if(stat_ap=='exp'){
		$('#employers_name1').attr('required', true);
		$('#employers_address').attr('required', true);
		$('#position-title').attr('required', true);
		$('#reason').attr('required', true);
		$('#monthlysalary').attr('required', true);
		var emp1 = document.getElementById('employers_name1').value;
		var empadd = document.getElementById('employers_address').value;
		var emppos = document.getElementById('position-title').value;
		var rson = document.getElementById('reason').value;
		var msalary = document.getElementById('monthlysalary').value;
		function frnext_required(){
			$("#employers_name1").blur();
			$("#employers_address").blur();
			$("#position-title").blur();
			$("#monthlysalary").blur();
			$("#reason").blur();
		}
		
		if(emp1==''){
			frnext_required();
			$("#employers_name1").focus();
		}else if(empadd==''){
			frnext_required();
			$("#employers_address").blur();
		}else if(emppos==''){
			frnext_required();
			$("#position-title").focus();
		}else if(msalary==="0"){
			$("#monthlysalary").blur();
			$("#monthlysalary").focus();
			document.getElementById("salary_validator").style.display="block";
			document.getElementById("salary_validator").style.borderColor = "red";
			frnext_required();
		}else if(msalary==''){
			frnext_required();
			$("#monthlysalary").focus();
		}else if(rson==''){
			frnext_required();
			$("#reason").focus();
		}
		// else{
		// 	document.getElementById('container4').style.display='none'; 
		// 	document.getElementById('container5').style.display='block';
		// }

	}else if(stat_ap=='grad'){	
		$('#employers_name1').attr('required', false);
		$('#employers_address').attr('required', false);
		$('#position-title').attr('required', false);
		$('#reason').attr('required', false);
		$('#monthlysalary').attr('required', false);
		// document.getElementById('container4').style.display='none'; 
		// document.getElementById('container5').style.display='block';
}
});
$( "#source" ).on( "change", function() {
	var source2 = document.getElementById("source").value;
	document.getElementById("sourcevalidator").style.display = 'none';
	if(source2=='Select Source'){
		document.getElementById("source").style.borderColor = '10px solid red';
		document.getElementById("sourcevalidator").style.display = 'block';

	}
});

$( "#cstatus" ).on( "change", function() {
	var civilstatus = document.getElementById("cstatus").value;
	document.getElementById("cstatusvalidator").style.display = 'none';
	if(civilstatus=='Select Civil Status'){
		document.getElementById("cstatusvalidator").style.display = 'block';
		
	}
});

$( "#apply_position" ).on( "change", function() {
	var apply_position1 = document.getElementById("apply_position").value;
	document.getElementById("positionErrorMessage").style.display = 'none';
	if(apply_position1=='Select Position'){
		document.getElementById("positionErrorMessage").style.display = 'block';
		document.getElementById("apply_position").style.borderColor = "red";
	}
});
//Save and Quit Force SUBMIT
$( "#saveQuit" ).on( "click", function() {
	
	var apply_position = document.getElementById("apply_position").value;
	var lastName = document.getElementById("lname").value;
	var firstName = document.getElementById("fname").value;
	var employ_date = document.getElementById("empdate").value;
	var date_ofbirth = document.getElementById("bday123").value;
	var placeofbirth = document.getElementById("placeofbirth").value;
	var email1 = document.getElementById("email").value;
	var otherpos = document.getElementById("otherpositionDiv").value;
	var source = document.getElementById("source").value;
	var civilstatus = document.getElementById("cstatus").value;
		
		
	
		if(email1==''){
			document.getElementById('SaveandQuit').innerHTML = 'Note: A reference code will appear once you click "yes". This will allow you to continue your application form.';
		}else{
			document.getElementById('SaveandQuit').innerHTML = "Note: A <b>reference code </b>will also be sent to your email. Don't worry, you may still continue where you left off.";
		}
	
	function required_field(){
		$("#apply_position").blur();
		$("#lname").blur();
		$("#fname").blur();
		$("#empdate").blur();
		$("#bday123").blur();
		$("#placeofbirth").blur();
		$("#source").blur();
		$("#cstatus").blur();
	}

	if(source=="Select Source"){
			$("#source").blur();
			$("#source").focus();
			document.getElementById("source").style.borderColor = "red";
			document.getElementById("sourcevalidator").style.display="block";	
		}

		if (cstatus=="Select Civil Status"){
			$("cstatus").blur();
			$("cstatus").focus();
			document.getElementById("cstatus").style.borderColor = "red";
			document.getElementById("cstatusvalidator").style.display="block";
		}

	if(apply_position=="Others"){
		if(otherpos==""){
			required_field();
			$("#otherpositionDiv").blur();
			$("#otherpositionDiv").focus();
			
		}else if( apply_position =="Select Position"){
				required_field();
				document.getElementById("apply_position").style.border = "10px solid red";
				document.getElementById("positionErrorMessage").style.display = 'block';
				$("#apply_position").focus();
			}else if(lastName ==""){
				required_field();
				$("#lname").focus();
			}else if(firstName==""){
				required_field();
				$("#fname").focus();
			}else if(employ_date==""){
				required_field();
				$("#empdate").focus();
			}
			else if(date_ofbirth==""){
				required_field();
				$("#bday123").focus();
			}else if(placeofbirth==""){
				required_field();
				$("#placeofbirth").focus();
			}else if(source=="Select Source"){
				required_field();
				$("#source").focus();
			}else{
				//document.getElementById("positionErrorMessage").style.display = 'none';
				$('#SaveQuitModal').modal('show');
				//$('input,select, textarea').attr('required', false);
				//$( "#submitForm" ).trigger( "click" );
			}
		
	}
	else if( apply_position =="Select Position"){
			required_field();
			document.getElementById("apply_position").style.border = "10px solid red";
			document.getElementById("positionErrorMessage").style.display = 'block';
			$("#apply_position").focus();
			 
		}else if(lastName ==""){
			required_field();
			$("#lname").focus();
		}else if(firstName==""){
			required_field();
			$("#fname").focus();
		}else if(employ_date==""){
			required_field();
			$("#empdate").focus();
		}
		else if(date_ofbirth==""){
			required_field();
			$("#bday123").focus();
		}else if(placeofbirth==""){
			required_field();
			$("#placeofbirth").focus();
		}else if(source=="Select Source"){
			required_field();
			$("#source").focus();
		}else{
			//document.getElementById("positionErrorMessage").style.display = 'none';
			$('#SaveQuitModal').modal('show');
			//$('input,select, textarea').attr('required', false);
			//$( "#submitForm" ).trigger( "click" );
		}
	
	
});
$( "#saveQuit2" ).on( "click", function() {
	
	$('#SaveQuitModal').modal('show');
	var email2 = document.getElementById("email").value;
		if(email2==''){f
			document.getElementById('SaveandQuit').innerHTML = 'Note: A reference code will appear once you click "yes". This will allow you to continue your application form.';
		}else{
			document.getElementById('SaveandQuit').innerHTML = "Note: A <b>reference code </b>will also be sent to your email. Don't worry, you may still continue where you left of.";
		}

});
$( "#saveQuit3" ).on( "click", function() {
	
	$('#SaveQuitModal').modal('show');
	var email3 = document.getElementById("email").value;
		if(email3==''){
			document.getElementById('SaveandQuit').innerHTML = 'Note: A reference code will appear once you click "yes". This will allow you to continue your application form.';
		}else{
			document.getElementById('SaveandQuit').innerHTML = "Note: A <b>reference code </b>will also be sent to your email. Don't worry, you may still continue where you left of.";
		}
});
$( "#saveQuit4" ).on( "click", function() {
	
	$('#SaveQuitModal').modal('show');
	var email4 = document.getElementById("email").value;
		if(email4==''){
			document.getElementById('SaveandQuit').innerHTML = 'Note: A reference code will appear once you click "yes". This will allow you to continue your application form.';
		}else{
			document.getElementById('SaveandQuit').innerHTML = "Note: A <b>reference code </b>will also be sent to your email. Don't worry, you may still continue where you left of.";
		}

});
$( "#saveQuit5" ).on( "click", function() {
	
	$('#SaveQuitModal').modal('show');
	var email5 = document.getElementById("email").value;
		if(email5==''){
			document.getElementById('SaveandQuit').innerHTML = 'Note: A reference code will appear once you click "yes". This will allow you to continue your application form.';
		}else{
			document.getElementById('SaveandQuit').innerHTML = "Note: A <b>reference code </b>will also be sent to your email. Don't worry, you may still continue where you left of.";
		}

});

$( "#okay_button" ).on( "click", function() {
	var modal_reference_code = document.getElementById('ref_code').value;
	
	if(modal_reference_code !='' ){
		window.location.replace("updateresume.php?ref_code=" + modal_reference_code);
	
	}
});

$( "#ref_yes" ).on( "click", function() {
	var email = document.getElementById('email').value;
	var val_storage="";
	if(email!=''){
		val_storage="emailSet";
	}else{
		val_storage="emailNotSet";
	}
		$.ajax({
		url: "setSessionAppStatus.php",
		type: "POST",
		data: {emailStat: val_storage},
		success: function(result){
			$.ajax({
			url: "address.php",
			type: "GET",
			data: {agree:'validatedApplicant'},
			success: function(data){
				$('input,select, textarea').attr('required', false);
			$( "#submitAllData" ).trigger( "click" );
			},
			error: function(data){
				alert(data);
			}
		});
			
		}
	});
});
$("#mobile_number").on('keydown', function(e) {
			var moblieNumber_value = this.value;
			var res = moblieNumber_value.substring(6, 7);
			
			if(res!='9'){
				document.getElementById("number_validator").style.display="block";
				
			}else if(res=='9'){
				document.getElementById("number_validator").style.display="none";
			}
});

$("#celno2").on('keydown', function(e) {
	var moblieNumber_value2 = this.value;
	var res2 = moblieNumber_value2.substring(6, 7);
	
	if(res2!='9'){
		document.getElementById("number_validator2").style.display="block";
		
	}else if(res2=='9'){
		document.getElementById("number_validator2").style.display="none";
	}
});

$("#celno3").on('keydown', function(e) {
	var moblieNumber_value3 = this.value;
	var res3 = moblieNumber_value3.substring(6, 7);
	
	if(res3!='9'){
		document.getElementById("number_validator3").style.display="block";
		
	}else if(res3=='9'){
		document.getElementById("number_validator3").style.display="none";
	}
});

$("#employer_celno").on('keydown', function(e) {
	var employer_mobileNum = this.value;
	var employer_mobileNumStr = employer_mobileNum.substring(6, 7);
	
	if(employer_mobileNumStr!='9'){
		document.getElementById("employerNumber_validator").style.display="block";
		
	}else if(employer_mobileNumStr=='9'){
		document.getElementById("employerNumber_validator").style.display="none";
	}
});

$("#ref_code").on('keypress', function(e) {
	var modal_reference_code = document.getElementById('ref_code').value;
	// document.getElementById("okay_button").disabled = false;

	if(modal_reference_code.length==9){
		document.getElementById("okay_button").disabled = false;

	}else
	{
		document.getElementById("okay_button").disabled = true;
	}
});