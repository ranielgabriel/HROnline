$(document).ready(function () {

    console.log('Page is ready.');
    
    getAllMonthlyApplicant();
    getAllApplicantSource();
    getAllApplicantStatus();
    getAllApplicantLocation();

});

function getAllMonthlyApplicant(){
    $.ajax({
        url: 'api/reports/getAllMonthlyApplicant.php',
        type: 'GET',
        success: function (msg) {
            google.charts.load('current', {
                packages: ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawAnnotations);

            function drawAnnotations() {
                var arrayMonthlyApplicantsToShow = [];

                // for (var i = 0; msg['applicants'].length; i++){

                $.each(msg['applicants'], function (index, value) {
                    $.each(msg['applicants'][index], function (index, value) {
                        // console.log(index + ": " + value);
                        // console.log(msg['quickApplyApplicants'][0][index]);
                        arrayMonthlyApplicantsToShow.push([index, parseInt(value), value, parseInt(msg['quickApplyApplicants'][0][index]), msg['quickApplyApplicants'][0][index]]);
                    });
                });
                console.log(arrayMonthlyApplicantsToShow);
                
                var dataMonthlyApplicants = new google.visualization.DataTable();
                dataMonthlyApplicants.addColumn('string', 'Month');
                dataMonthlyApplicants.addColumn('number', 'Applicants');
                dataMonthlyApplicants.addColumn({
                    type: 'string',
                    role: 'annotation'
                });

                dataMonthlyApplicants.addColumn('number', 'Quick Apply Applicants');
                dataMonthlyApplicants.addColumn({
                    type: 'string',
                    role: 'annotation'
                });
                

                // dataMonthlyApplicants.addRows([
                //     ['January', 100, '100', 25, '25'],
                //     ['February', 1170, '1170', 460, '460'],
                //     ['March', 11700, '11700', 460, '460'],
                //     ['April', 11220, '11220', 460, '460'],
                //     ['May', 10470, '10470', 460, '460'],
                //     ['June', 2050, '2050', 460, '460'],
                //     ['July', 8170, '8170', 460, '460'],
                //     ['August', 7170, '7170', 460, '460'],
                //     ['September', 6170, '6170', 460, '460'],
                //     ['October', 4170, '4170', 460, '460'],
                //     ['November', 660, '660', 1120, '1120'],
                //     ['December', 9030, '9030', 54, '54']
                // ]);
                dataMonthlyApplicants.addRows(arrayMonthlyApplicantsToShow);

                var options = {
                    animation: {
                        startup: true,
                        duration: 10
                    },
                    annotations: {
                        alwaysOutside: true,
                        textStyle: {
                            fontSize: 14,
                            color: '#000',
                            auraColor: 'none'
                        },
                        stem: {
                            color: 'black',
                            length: 5
                        },
                        style: 'point'
                    },
                    legend: {
                        position: 'top',
                        alignment: 'center'
                    },
                    bar: {
                        groupWidth: '70%'
                    },
                    backgroundColor: 'transparent',
                    dataOpacity: .8
                };
                var chart = new google.visualization.ColumnChart(document.getElementById('monthlyApplicantsChart'));
                chart.draw(dataMonthlyApplicants, options);
            }
        }
    });
}

function getAllApplicantSource() {
    $.ajax({
        url: 'api/reports/getAllApplicantSource.php',
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
                var dataApplicantSource = new google.visualization.DataTable();
                dataApplicantSource.addColumn('string', 'Source');
                dataApplicantSource.addColumn('number', 'Applicants');

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
                    legend: {
                        position: 'right',
                        alignment: 'center'
                    },
                    // 'width': 400,
                    height: 700,
                    is3D: true,
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
                    legend: {
                        position: 'top',
                        alignment: 'center'
                    },
                    // 'width': 400,
                    height: 700,
                    is3D: true,
                    backgroundColor: 'transparent',
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('applicantStatusChart'));
                chart.draw(dataApplicantStatus, options);
            }
        }
    });
}

function getAllApplicantLocation(){
    $.ajax({
        url: 'api/reports/getAllApplicantLocation.php',
        type: 'GET',
        success: function (msg) {
            google.charts.load('current', {
                'packages': ['map']
            });
            google.charts.setOnLoadCallback(drawMap);
    
            function drawMap() {

                var arrayLocationsToShow = [];
                $.each(msg['location'], function (index, value) {
                    $.each(msg['location'][index], function (index, value) {
                        arrayLocationsToShow.push([getLatLng(index)[0], getLatLng(index)[1], index + ': ' + value]);
                    });
                });

                var dataApplicantLocation = new google.visualization.DataTable();
                dataApplicantLocation.addColumn('number', 'Lat');
                dataApplicantLocation.addColumn('number', 'Long');
                dataApplicantLocation.addColumn('string', 'Name');
                dataApplicantLocation.addRows(arrayLocationsToShow);

                var options = {
                    height: 700,
                    mapType: 'normal',
                    showTooltip: true,
                    showInfoWindow: true
                };
    
                var map = new google.visualization.Map(document.getElementById('applicantLocationsChart'));
    
                map.draw(dataApplicantLocation, options);
            };
        }
    });
}

function getLatLng(location){
    var latlng = [];
    switch(location) {
        case 'Pasig':
            latlng[0] = 14.5764;
            latlng[1] = 121.0851;
            return latlng;
        case 'Makati':
            latlng[0] = 14.5547;
            latlng[1] = 121.0244;
            return latlng;
        case 'Marikina':
            latlng[0] = 14.6507;
            latlng[1] = 121.1029;
            return latlng;
        case 'Mandaluyong':
            latlng[0] = 14.5794;
            latlng[1] = 121.0359;
            return latlng;
        case 'Quezon':
            latlng[0] = 14.6760;
            latlng[1] = 121.0437;
            return latlng;
        case 'Caloocan':
            latlng[0] = 14.7566;
            latlng[1] = 121.0450;
            return latlng;
        case 'Pasay':
            latlng[0] = 14.5378;
            latlng[1] = 121.0014;
            return latlng;
        case 'Parañaque':
            latlng[0] = 14.4793;
            latlng[1] = 121.0198;
            return latlng;
        case 'Muntinlupa':
            latlng[0] = 14.4081;
            latlng[1] = 121.0415;
            return latlng;
        case 'Las Piñas':
            latlng[0] = 14.4445;
            latlng[1] = 120.9939;
            return latlng;
        case 'Taguig':
            latlng[0] = 14.5176;
            latlng[1] = 121.0509;
            return latlng;
        case 'Ilocos Region':
            latlng[0] = 16.0832;
            latlng[1] = 120.6200;
            return latlng;
        case 'Cagayan Valley':
            latlng[0] = 16.9754;
            latlng[1] = 121.8107;
            return latlng;
        case 'Central Luzon':
            latlng[0] = 15.4828;
            latlng[1] = 120.7120;
            return latlng;
        case 'CALABARZON':
            latlng[0] = 14.1008;
            latlng[1] = 121.0794;
            return latlng;
        case 'MIMAROPA':
            latlng[0] = 9.8432;
            latlng[1] = 118.7365;
            return latlng;
        case 'Bicol Region':
            latlng[0] = 13.4210;
            latlng[1] = 123.4137;
            return latlng;
        case 'Western Visayas':
            latlng[0] = 11.0050;
            latlng[1] = 122.5373;
            return latlng;
        case 'Central Visayas':
            latlng[0] = 9.8169;
            latlng[1] = 124.0641;
            return latlng;
        case 'Eastern Visayas':
            latlng[0] = 12.2446;
            latlng[1] = 125.0388;
            return latlng;
        case 'Zamboanga Peninsula':
            latlng[0] = 8.1541;
            latlng[1] = 123.2588;
            return latlng;
        case 'Northern Mindanao':
            latlng[0] = 8.0202;
            latlng[1] = 124.6857;
            return latlng;
        case 'Davao Region':
            latlng[0] = 7.3042;
            latlng[1] = 126.0893;
            return latlng;
        case 'SOCCSKSARGEN':
            latlng[0] = 6.2707;
            latlng[1] = 124.6857;
            return latlng;
        case 'CARAGA':
            latlng[0] = 8.8015;
            latlng[1] = 125.7407;
            return latlng;
        case 'ARMM':
            latlng[0] = 6.9568;
            latlng[1] = 124.2422;
            return latlng;
        case 'CAR':
            latlng[0] = 17.3513;
            latlng[1] = 121.1719;
            return latlng;
        default:
            return 'None';
    }
}