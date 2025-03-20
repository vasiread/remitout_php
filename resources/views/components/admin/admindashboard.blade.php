<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
</head>

<body>
    @extends('layouts.app')

    
    <div class="admindashboard-container">
        <div class="admindashboardcontainer-firstsection">
            <h1>Hi, Admin name</h1>
            <div class="admindashboardcontainer-firstsectionbuttoncontainer">
                <button id="manage-student-admindashboard">Manage Student</button>
                <button id="referral-link-admindashboard">Generate Referral Link</button>
            </div>
        </div>
        <div class="admindashboardcontainer-secondsection">
            <h1>Reports</h1>
            <div class="admindashboardsecondsection-buttongroups">
                <button id="showall-buttongroups">Show All <i class="fa-solid fa-chevron-down"></i></button>
                <div class="postgrad-buttongroups" id="postgrad-reports">
                    <div id="postgrad-buttongroups-insideshow">
                        Graduate <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-content-postgrad">
                        <a href="#">Post Graduate</a>
                        <a href="#">Under Graduate</a>
                        <a href="#">Others</a>
                    </div>
                </div>

                <button id="calender-buttongroups"> Calendar <img src="assets/images/Icons/calendar_month.png"
                        alt=""></button>
                <button id="download-buttongroups">Download Report</button>
            </div>
        </div>
        <div class="admindashboardcontainer-thirdsection">
            <div class="admindashboard-firstpart">
                <div class="reports-registeration">
                    <div class="reports-registeration-sectionone">
                        <p>Reports on registration</p>
                        <button id="calender-reportsregister">Calendar <img src="assets/images/Icons/calendar_month.png"
                                alt=""></button>
                        <input type="date" id="date-picker" style="display:none">

                    </div>
                    <div class="reports-registeration-graph">
                        <div id="chart_div" style="width: 100%; height: 162px;"></div>
                    </div>
                </div>
                <div class="source-registeration">
                    <p id="source-registeration-header">Source on registration</p>
                    <div class="donutregistration-chart-container">
                        <canvas id="donutRegistrationChart"></canvas>
                        <div class="donutgraphinfos">
                            @php
$registrationSourceAnalysis = [
    ['color' => 'rgba(111, 37, 206, 1)', 'AnalyseName' => 'ADDS', 'OverallStrength' => '8,085', 'OverallStrengthPercent' => '13%'],
    ['color' => 'rgba(181, 142, 229, 1)', 'AnalyseName' => 'Organic', 'OverallStrength' => '8,085', 'OverallStrengthPercent' => '77%'],
    ['color' => 'rgba(226, 211, 245, 1)', 'AnalyseName' => 'SC Referral', 'OverallStrength' => '8,085', 'OverallStrengthPercent' => '10%'],
];
                            @endphp

                            @foreach ($registrationSourceAnalysis as $source)
                                <div class="graphviewofregistrations">
                                    <div class="graphviewofregistrations-firstpart">
                                        <div class="points"
                                            style="background-color: {{ $source['color'] }}; width: 11px; height: 11px;">
                                        </div>
                                        <p>{{ $source['AnalyseName'] }}</p>
                                    </div>
                                    <div class="graphviewofregistrations-secondpart">
                                        <p>{{ $source['OverallStrength'] }}</p>
                                        <p id='donutRegistrationChart-percentage'>{{ $source['OverallStrengthPercent'] }}
                                        </p>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="admindashboard-secondpart">
                <div class="totalundergrads-admin">
                    <h4>Total Undergrads</h4>
                    <div class="totalundergrads-info">
                        <h1>60</h1>
                        <p>Female <span>20</span> </p>
                        <p>Male <span>20</span> </p>
                        <p>Others <span>20</span> </p>
                    </div>
                </div>
                <div class="totalpostgrads-admin">
                    <h4>Total Postgrads</h4>
                    <div class="totalpostgrads-info">
                        <h1>150</h1>
                        <p>Female <span>20</span> </p>
                        <p>Male <span>20</span> </p>
                        <p>Others <span>20</span> </p>
                    </div>
                </div>
                <div class="ageratio-graph-admin">
                    <div class="agerationcolumn-firstsection">
                        <p id="ageratio-header">Age ratio of students</p>
                        <div class="postgrad-buttongroups" id="postgrad-ageratio">
                            <div id="postgrad-buttongroups-insideshow">
                                Graduate <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="dropdown-content-postgrad">
                                <a href="#">Post Graduate</a>
                                <a href="#">Under Graduate</a>
                                <a href="#">Others</a>
                            </div>
                        </div>
                    </div>
                    <div class="ageratio-donutregistration-chart-container">
                        <canvas id="ageratio-donutRegistrationChart"></canvas>
                        <div class="ageratio-donutgraphinfos">
                            @php
$registrationSourceAnalysis = [
    ['color' => 'rgba(111, 37, 206, 1)', 'studentRangeValue' => '16 - 20'],
    ['color' => 'rgba(167, 121, 224, 1)', 'studentRangeValue' => '21 - 25'],
    ['color' => 'rgba(203, 176, 237, 1)', 'studentRangeValue' => '26 - 30'],
    ['color' => 'rgba(226, 211, 245, 1)', 'studentRangeValue' => '30 - 40'],
];
                            @endphp

                            @foreach ($registrationSourceAnalysis as $source)
                                <div class="ageratio-graphviewofratios">
                                    <div class="ageratio-points"
                                        style="background-color: {{ $source['color'] }}; width: 11px; height: 11px;">
                                    </div>
                                    <p>{{ $source['studentRangeValue'] }}</p>



                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="admindashboard-thirdpart">
                <div class="funnelreport-analyze-header">
                    <p id="funnel-analyze-header">Funnel Report</p>
                    <div class="postgrad-buttongroups" id="postgrad-funnelreports">
                        <div id="postgrad-buttongroups-insideshow">
                            Graduate <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="dropdown-content-postgrad">
                            <a href="#">Post Graduate</a>
                            <a href="#">Under Graduate</a>
                            <a href="#">Others</a>
                        </div>
                    </div>

                </div>
                <div class="funnelreport-analyze-diagram">
                    <div class="funnelreport-analyse-left">
                        <div>
                            <p>Incomplete application</p>
                        </div>
                        <div>
                            <p>Complete application</p>
                        </div>
                        <div>
                            <p>Pending with Queries</p>
                        </div>
                        <div>
                            <p>Offer issued
                                to student</p>
                        </div>
                        <div>
                            <p>Offer rejected
                                to student</p>
                        </div>
                        <div>
                            <p>Offer Accepted
                                & closed</p>
                        </div>
                    </div>
                    <div class="funnelreport-analyse-right" id="funnelreport-rightsideid">
                        <p>140</p>
                        <p>360</p>
                        <p>10</p>
                        <p>100</p>
                        <p>20</p>
                        <p>200</p>

                    </div>



                </div>




            </div>
        </div>

    </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initializeRegisterationLineGraph();
            initializeDonutGraphSource();
            initializeDonutGraphAgeRatio();


        });

        const initializeRegisterationLineGraph = () => {
            google.charts.load('current', { packages: ['corechart', 'line'] });
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Day');
                data.addColumn('number', 'Registrations');
                data.addColumn({ type: 'string', role: 'annotation' });

                data.addRows([
                    ['Mon', 100, null], ['Tue', 123, null], ['Wed', 174, "13"], ['Thu', 118, null],
                    ['Fri', 145, null], ['Sat', 92, null]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, 2, {
                    calc: function (data, row) {
                        return data.getValue(row, 2);
                    },
                    type: 'string',
                    role: 'annotation'
                }]);

                var options = {
                    maintainAspectRatio: false, // Disable aspect ratio to allow 100% width

                    hAxis: {
                        title: 'Day of the Week',
                        opacity: 0
                    },
                    vAxis: {
                        title: 'Registrations',
                        viewWindow: { min: 0, max: 200 },
                    },
                    annotations: {
                        alwaysOutside: true,
                        textStyle: {
                            opacity: 0
                        },
                        stem: {
                            length: 4
                        }
                    },
                    pointSize: 5,
                    series: {
                        0: {
                            lineWidth: 2,
                            pointShape: 'circle', color: 'rgb(163, 171, 189)',
                        },
                    },
                    dataOpacity: 0.3,
                    legend: 'none'
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                chart.draw(view, options);
            }
        }

        const initializeDonutGraphSource = () => {
            var ctx = document.getElementById('donutRegistrationChart').getContext('2d');
            var donutRegistrationChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['ADDS', 'Organic', 'SC Referral'],
                    datasets: [{
                        label: 'Registeration Sources',
                        data: [25, 30, 45],
                        backgroundColor: [
                            'rgba(111, 37, 206, 1)',      // ADDS
                            'rgba(111, 37, 206, 0.2)',    // Organic
                            'rgba(111, 37, 206, 0.4)'     // SC Referral
                        ],
                        borderWidth: 0,
                        cutout: 30,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            display: false,
                        },

                        tooltip: {
                            enabled: true
                        },
                        label: {
                            font: {
                                size: 16,
                                family: "Poppins",
                            }
                        },
                    }
                }
            });

        };



        const initializeDonutGraphAgeRatio = () => {
            var ctx = document.getElementById('ageratio-donutRegistrationChart').getContext('2d');
            var donutRegistrationChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['16 - 20', '21 - 25', '26 - 30', '30-40'],
                    datasets: [{
                        label: 'Age Ratio of Students',
                        data: [25, 30, 40, 21],
                        backgroundColor: [
                            'rgba(111, 37, 206, 1)',
                            'rgba(167, 121, 224, 1)',
                            'rgba(203, 176, 237, 1)',
                            'rgba(226, 211, 245, 1)'
                        ],
                        borderWidth: 0,
                        cutout: 30,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            display: false,
                        },

                        tooltip: {
                            enabled: true
                        },
                        label: {
                            font: {
                                size: 16,
                                family: "Poppins",
                            }
                        },
                    }
                }
            });

        };



    </script>
</body>

</html>