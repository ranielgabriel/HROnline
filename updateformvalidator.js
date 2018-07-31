
$("#submitInterviewForm").on('click', function(e){
	$( "#hiddenSubmitInterview" ).trigger( "click" );
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
$( "#apply_position" ).on( "change", function() {
	var apply_position1 = document.getElementById("apply_position").value;
	document.getElementById("positionErrorMessage").style.display = 'none';
	if(apply_position1=='Select Position'){
		document.getElementById("positionErrorMessage").style.display = 'block';
		document.getElementById("apply_position").style.borderColor = "red";
	}
});
$( "#fnext" ).on( "click", function() {
  var apply_position = document.getElementById("apply_position").value;
		var lastName = document.getElementById("lname").value;
		var firstName = document.getElementById("fname").value;
		var employ_date = document.getElementById("empdate").value;
		var date_ofbirth = document.getElementById("bday123").value;
		var placeofbirth = document.getElementById("placeofbirth").value;
		
		function fnext_required(){
			$("#apply_position").blur();
			$("#lname").blur();
			$("#fname").blur();
			$("#empdate").blur();
			$("#bday123").blur();
			$("#placeofbirth").blur();
		}
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
		}else{
			document.getElementById("container1").style.display="none";
			document.getElementById("container2").style.display="block";
		}
});
$( "#snext" ).on( "click", function() {
		
	var curhome = document.getElementById("current_home_num").value;
	var curbar = document.getElementById("current_barangay").value;
	var curadd = document.getElementById("curaddress").value;
	var mobilenum = document.getElementById("mobile_number").value;
	var conperson = document.getElementById("contactperson").value;
	var cperson_contact = document.getElementById("contactpersonno").value;
	var email = document.getElementById("email").value;
	var moblieNumber_value = document.getElementById("mobile_number").value;
	var emailHelp = document.getElementById("emailhelp").value;
	var res = moblieNumber_value.substring(6, 7);
	var num = mobilenum.replace(/[^0-9]/g, '');
	var htmlContent;
	var node = document.getElementById('emailhelp');
	htmlContent = node.innerHTML;
	
	function snext_required(){
		$("#curaddress").blur();
		$("#current_home_num").blur();
		$("#current_barangay").blur();
		$("#email").blur();
		$("#mobile_number").blur();
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
	}else if(mobilenum.length!=18){
		snext_required();
		$("#mobile_number").focus();
	}else if(conperson==""){
		snext_required();
		$("#contactperson").blur();
	}else if(cperson_contact==""){
		snext_required();
		$("#contactpersonno").focus();
	}else if(num.length!=12){
		document.getElementById("number_validator").style.display="block";
	}else if(res!=9){
		document.getElementById("number_validator").style.display="block";
	}else if(num.length==0){
		alert("empty number!");
	}else{ 
	if(htmlContent=='Email already taken!'){
		$('#email').focus();
	}else{
		document.getElementById("container2").style.display="none";
		document.getElementById("container3").style.display="block";
	
	}
	}

});
$( "#source" ).on( "change", function() {
	var source2 = document.getElementById("source").value;
	document.getElementById("source_validator").style.display = 'none';
	if(source2=='-Select Here-'){
		document.getElementById("source_validator").style.display = 'block';
	}
});
$( "#lnext" ).on( "click", function() {
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
	}else if(source=='-Select Here-'){
		lnext_required();
		document.getElementById("source").style.borderColor = "red";
		document.getElementById("source_validator").style.display="block";
	}else{
		document.getElementById('container6').style.display='block';
		document.getElementById('container5').style.display='none';
	}

});
$( "#frnext" ).on( "click", function() {
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
		}else if(msalary==''){
			frnext_required();
			$("#monthlysalary").focus();
		}else if(rson==''){
			frnext_required();
			$("#reason").focus();
		}else{
			document.getElementById('container4').style.display='none'; 
			document.getElementById('container5').style.display='block';
		}

	}else if(stat_ap=='grad'){	
		$('#employers_name1').attr('required', false);
		$('#employers_address').attr('required', false);
		$('#position-title').attr('required', false);
		$('#reason').attr('required', false);
		$('#monthlysalary').attr('required', false);
		document.getElementById('container4').style.display='none'; 
		document.getElementById('container5').style.display='block';
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
						$('input,select, textarea').attr('required', false);
						$( "#submitForm" ).trigger( "click" );
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
