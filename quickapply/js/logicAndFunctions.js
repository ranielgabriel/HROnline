$('document').ready(function () {
    console.log("Document is ready.");
    var applicant;

    $('#myModal').modal('show');
    // Call the function
    getAllPositions();

    // When the button with id=submit is clicked.
    $("#submit").click(function (e) {
        // e.preventDefault();
        // console.log("Submit is Clicked.");

        // Call the function
        addQuickApplicant();
    });

    function addQuickApplicant() {

        // Function for passing all the information of the applicant to the php file for insertion in the database
        applicant = [{

            // Position
            position: $("#positionApplying option:selected").val(),

            // Lastname
            lastname: $("#lastname").val(),

            // Firstname
            firstname: $("#firstname").val(),

            // Expected Salary
            salaryExpectation: $("#salaryExpectation").val(),

            // Mobile Number
            mobileNumber: $("#mobileNumber").val(),

            // Available date of Employment
            employmentDate: $("#employmentDate").val(),

            // School
            school: $("#school").val(),

            // Course
            collegeDegree: $("#collegeDegree").val(),

            // Finished Year
            finishedYear: $("#finishedYear").val(),

            // Recent Company
            recentCompany: $("#recentCompany").val(),

            // Recent Position
            recentPosition: $("#recentPosition").val(),

            // Date Started in recent company
            dateStarted: $("#from").val(),

            // Date Ended in recent company
            dateEnded: $("#to").val(),

            // Essay Answer
            essayAnswer: $("#essayAnswer").val(),

            // Amenable for shifting schedule?
            shiftingSchedule: $("[name=schedule]:checked").val(),

            // Amenable for project base?
            contractual: $("[name=contractual]:checked").val(),

            // Amenable to work in holidays?
            holidays: $("[name=holidays]:checked").val(),

            // Graduate or Undergraduate
            graduateUndergraduate: $("[name=graduateUndergraduate]:checked").val(),

            // Has BPO Experience?
            bpoExperience: $("[name=bpoExperience]:checked").val(),

            // Related experience in position applying for?
            relatedExperienceInPosition: $("[name=relatedExperience]:checked").val()
        }];

        if(positionToGet != ''){
            applicant[0]['position'] = positionToGet;
        }

        // Check if all the fields is not empty.
        for (x in applicant[0]) {
            if (applicant[0][x] == "") {
                return alert('Fill all the fields.');
            }
        }

        $.ajax({

            // URL of the PHP file
            url: "api/addQuickApplicant.php",

            // Request method
            type: "POST",

            // Parameters / Data to be passed
            data: {

                applicant: JSON.stringify(applicant)
            },

            // Data type
            dataType: 'json',

            // If the URL is  successfully loaded.
            success: function (msg) {
                alert(msg.message);
                window.location.replace('http://andersonbpoinc.com/application/like.php');
            },
            error: function (msg) {
                console.log(msg.responseText);
            }
        });
        console.log(applicant);
    }


    function getAllPositions() {
        // Functions for getting all the positions from the database
        $.ajax({
            url: "api/getAllPositions.php",
            type: "GET",
            data: {
                position: positionToGet
            },
            dataType: 'json',
            success: function (msg) {
                // console.log(msg.message);
                $("#positionsContainer").append(msg["code"]);

            },
            error: function (msg) {
                console.log(msg.responseText);
            }
        });
    }


});