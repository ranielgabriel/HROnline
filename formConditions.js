$(document).ready(function () {

	// Hide everything first
	$("#contrad").hide();
	$("#removeWorkid").hide();
	$("#salary_group").hide();
	$("#Expdate").hide();
	$("#Intdate").hide();

	$("#btn_intern").on('click', function () {
		
		// Disabled the essay question
		$("#question1").prop("readonly", "true").val("N/A"); 
		$("#question2").prop("readonly", "true").val("N/A");
		$("#question3").prop("readonly", "true").val("N/A");
		$("#question4").prop("readonly", "true").val("N/A");

		// Choose Intern as position Automatically.
		$("#apply_position").prop("disabled", true).val("Intern").change();
		
		// Show internship starting date
		$("#Intdate").show();

		$(".interns").addClass("active");
		$(".experienced").removeClass("active");
		$(".fresh").removeClass("active");
	});

	$("#btn_experienced").on('click', function () {
		// $("#apply_position").prop("disabled", false).val("Select Position").change();
		$("apply_position").find("#removeIntern").remove();
		// $("#Intdate").hide();
		$("#Expdate").show();
		$("#salary_group").show();
		$("#removeWorkid").show();
		$("#contrad").show();
	});

	$("#btn_freshgrad").on('click', function (event) {
		// $("#apply_position").prop("disabled", false).val("Select Position").change();
		$("#Intdate").hide();
		$("#Expdate").show();
		$("#salary_group").show();
		$("#removeWorkid").hide();
		$("#contrad").show();
	});
});