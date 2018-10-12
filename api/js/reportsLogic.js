$(document).ready(function () {

    console.log('Page is ready.');
    getAllApplicantSource();
    getAllApplicantStatus();
});

function getAllApplicantSource() {
    $.ajax({
        url: 'api/reports/getAllApplicantSource.php',
        type: 'GET',
        success: function (msg) {
            console.log(msg);
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                // Create the data table.
                var dataApplicantSource = new google.visualization.DataTable();
                dataApplicantSource.addColumn('string', 'Source');
                dataApplicantSource.addColumn('number', 'Applicants');
                // dataApplicantSource.addRows([
                //     ['Jobstreet', 3],
                //     ['Linked In', 3],
                //     ['Facebook', 3],
                //     ['Referral', 3],
                //     ['AndersonGroup Site', 1],
                //     ['Application', 1],
                //     ['Jobfair', 1],
                //     ['Indeed', 1],
                // ]);
                $.each(msg['source'], function (index, value) {
                    $.each(msg['source'][index], function (index, value) {
                        dataApplicantSource.addRows([
                            [index, parseInt(value)],
                        ]);
                    });
                });

                // Set chart options
                var options = {
                    // 'title': 'How Much Pizza I Ate Last Night',
                    'legend': {
                        position: 'right',
                        alignment: 'center'
                    },
                    // 'width': 400,
                    'height': 700,
                    'is3D': true,
                    backgroundColor: 'transparent',
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('applicantSourceChart'));
                chart.draw(dataApplicantSource, options);
            }
        }
    });
}

function getAllApplicantStatus() {
    $.ajax({
        url: 'api/reports/getAllApplicantStatus.php',
        type: 'GET',
        success: function (msg) {

            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                // Create the data table.
                var dataApplicantStatus = new google.visualization.DataTable();
                dataApplicantStatus.addColumn('string', 'Status');
                dataApplicantStatus.addColumn('number', 'Applicants');
                // dataApplicantStatus.addRows([
                //     ['Pending', 3],
                //     ['No Show', 1],
                //     ['Interview', 1],
                //     ['Fail/Reject', 1],
                // ]);

                $.each(msg['status'], function (index, value) {
                    $.each(msg['status'][index], function (index, value) {
                        dataApplicantStatus.addRows([
                            [index, parseInt(value)],
                        ]);
                    });
                });

                // Set chart options
                var options = {
                    // 'title': 'How Much Pizza I Ate Last Night',
                    'legend': {
                        position: 'top',
                        alignment: 'center'
                    },
                    // 'width': 400,
                    'height': 700,
                    'is3D': true,
                    backgroundColor: 'transparent',
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('applicantStatusChart'));
                chart.draw(dataApplicantStatus, options);
            }
        }
    });
}