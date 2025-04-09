<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

 
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

        <div class="backdrop" id="backdrop"></div>

                <!-- Referral Modal -->
            <div class="referral-triggered-view hidden" id="referralModal">
                <div class="referral-triggered-view-headersection">
                    <h3>Generate Referral Link</h3>
                    <span class="close-icon" id="closeModal">&#10005;</span>
                </div>
                <div class="referral-triggered-view-content">
                    <input type="text" id="referralLink" placeholder="Copy Link here">
                </div>
                <div class="referral-triggered-view-footer">
                    <button id="cancelBtn">
                        <span class="cancel-icon">&#10005;</span> Cancel
                    </button>
                    <button id="generateBtn">Generate</button>
                </div>
            </div>



        <div class="admindashboardcontainer-secondsection">
            <h1>Reports</h1>
            <div class="admindashboardsecondsection-buttongroups">
                 <div class="show-all-admin-button-container">
                    <button id="showall-buttongroups">Show All <i class="fa-solid fa-chevron-down"></i></button>
                    <div class="show-all-admin-options" id="dropdown-options">
                        <button>Registration Reports</button>
                        <button>No of grads</button>
                        <button>Registration Source</button>
                        <button>Age ratio Reports</button>
                        <button>Funnel Reports</button>
                        <button>Destination countries</button>
                        <button>Cities</button>
                        <button>NBFC: Generation Leads</button>
                        <button>Point of entry</button>
                        <button>SC: Generation Leads</button>
                        <button>Sem Rush</button>
                    </div>
                </div>


                
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


    <div class="calendar-wrapper">
        <button id="calender-buttongroups"> Calendar <img src="assets/images/Icons/calendar_month.png" alt=""></button>
        <button id="download-buttongroups">Download Report</button>

        <div class="calendar-container">
            <div class="calendar-input-container">
                <div class="calendar-date-input calendar-active" id="calendar-start-date-input">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>Start Date</span>
                </div>
                <div class="calendar-date-input" id="calendar-end-date-input">
                    <span>End Date</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" style="margin-left: auto;">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
            </div>

            <div class="calendar-header">
                <button class="calendar-nav-btn calendar-prev-month">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <div class="calendar-month-year-selector">
                    <select id="calendar-month-select">
                        <option value="0">January</option>
                        <option value="1">February</option>
                        <option value="2">March</option>
                        <option value="3">April</option>
                        <option value="4">May</option>
                        <option value="5">June</option>
                        <option value="6">July</option>
                        <option value="7">August</option>
                        <option value="8">September</option>
                        <option value="9">October</option>
                        <option value="10">November</option>
                        <option value="11">December</option>
                    </select>
                    <select id="calendar-year-select">
                        <!-- Years will be populated by JavaScript -->
                    </select>
                </div>
                <button class="calendar-nav-btn calendar-next-month">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>

            <div class="calendar-grid">
                <div class="calendar-weekday">Mo</div>
                <div class="calendar-weekday">Tu</div>
                <div class="calendar-weekday">We</div>
                <div class="calendar-weekday">Th</div>
                <div class="calendar-weekday">Fr</div>
                <div class="calendar-weekday">Sa</div>
                <div class="calendar-weekday">Su</div>
            </div>
        </div>
    </div>
                

                


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
                        <div id="chart_div" style="width: 100%; height: 160px;"></div>
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

    <div class="admindashboardcontainer-fourth-section">
       <div class="admin-dashboard-container-four">
        <div class="admin-dashboard-row">
            <!-- Cities Section -->
            <div class="admin-city-column">
                <div class="admin-city-section">
                    <div class="admin-city-header">
                        <div class="admin-city-title">Cities</div>
                        <div class="admin-city-filter-sort-container">
                            <button class="admin-city-filter-btn">Filter <i class="fas fa-chevron-down"></i></button>
                            <button class="admin-city-sort-btn">Sort <i class="fas fa-chevron-down"></i></button>
                        </div>
                    </div>
                    <table class="admin-city-table" id="city-table">
                        <thead>
                            <tr>
                                <th>City</th>
                                <th>State</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>No. students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kolkata</td>
                                <td>West Bengal</td>
                                <td>50</td>
                                <td>40</td>
                                <td class="admin-city-data-value" data-value="90">90</td>
                            </tr>
                            <tr>
                                <td>Bengaluru</td>
                                <td>Karnataka</td>
                                <td>40</td>
                                <td>80</td>
                                <td class="admin-city-data-value" data-value="120">120</td>
                            </tr>
                            <tr>
                                <td>Delhi</td>
                                <td>Delhi</td>
                                <td>20</td>
                                <td>40</td>
                                <td class="admin-city-data-value" data-value="60">60</td>
                            </tr>
                            <tr>
                                <td>Delhi</td>
                                <td>Delhi</td>
                                <td>20</td>
                                <td>40</td>
                                <td class="admin-city-data-value" data-value="60">60</td>
                            </tr>
                            <tr>
                                <td>Delhi</td>
                                <td>Delhi</td>
                                <td>20</td>
                                <td>40</td>
                                <td class="admin-city-data-value" data-value="60">60</td>
                            </tr>
                            <tr>
                                <td>Delhi</td>
                                <td>Delhi</td>
                                <td>20</td>
                                <td>40</td>
                                <td class="admin-city-data-value" data-value="60">60</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="admin-city-pagination">
                        <div class="admin-city-pagination-btn"><i class="fas fa-chevron-left"></i></div>
                        <div class="admin-city-pagination-text">1-10 / 30</div>
                        <div class="admin-city-pagination-btn"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Countries Section -->
            <div class="admin-desti-country-column">
                <div class="admin-desti-country-section">
                    <div class="admin-desti-country-header">
                        <div class="admin-desti-country-title">Destination Countries</div>
                        <div class="admin-desti-country-filter-sort-container">
                            <button class="admin-desti-country-filter-btn">Filter <i
                                    class="fas fa-chevron-down"></i></button>
                            <button class="admin-desti-country-sort-btn">Sort <i
                                    class="fas fa-chevron-down"></i></button>
                        </div>
                    </div>
                    <table class="admin-desti-country-table" id="country-table">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Continent</th>
                                <th>Female</th>
                                <th>Male</th>
                                <th>No. students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>USA</td>
                                <td>North America</td>
                                <td>50</td>
                                <td>40</td>
                                <td class="admin-desti-country-data-value" data-value="90">90</td>
                            </tr>
                            <tr>
                                <td>Canada</td>
                                <td>North America</td>
                                <td>40</td>
                                <td>30</td>
                                <td class="admin-desti-country-data-value" data-value="70">70</td>
                            </tr>
                            <tr>
                                <td>Norway</td>
                                <td>Europe</td>
                                <td>90</td>
                                <td>40</td>
                                <td class="admin-desti-country-data-value" data-value="130">130</td>
                            </tr>
                            <tr>
                                <td>Canada</td>
                                <td>North America</td>
                                <td>40</td>
                                <td>30</td>
                                <td class="admin-desti-country-data-value" data-value="70">70</td>
                            </tr>
                            <tr>
                                <td>Canada</td>
                                <td>North America</td>
                                <td>40</td>
                                <td>30</td>
                                <td class="admin-desti-country-data-value" data-value="70">70</td>
                            </tr>
                            <tr>
                                <td>Canada</td>
                                <td>North America</td>
                                <td>40</td>
                                <td>30</td>
                                <td class="admin-desti-country-data-value" data-value="70">70</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="admin-desti-country-pagination">
                        <div class="admin-desti-country-pagination-btn"><i class="fas fa-chevron-left"></i></div>
                        <div class="admin-desti-country-pagination-text">1-10 / 30</div>
                        <div class="admin-desti-country-pagination-btn"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---fifth section-->

    <div class="admindashboardcontainer-fifth-section">
        <div class="dashboard-row-bar-chart">
        <!-- NBFC Lead Generation -->
        <div id="nbfc-lead-chart_container">
            <div class="nbfc-lead-header">
                <h2 class="nbfc-lead-title">NBFCs: Lead Generation</h2>
                <div class="nbfc-lead-converted-dropdown">
                    <select>
                        <option selected>Converted</option>
                    </select>
                </div>
            </div>
            <div class="nbfc-lead-subheader">
                <div class="nbfc-lead-label">NBFCs Vs</div>
                <div class="nbfc-lead-legend">
                    <div class="nbfc-lead-legend-item">
                        <div class="nbfc-lead-legend-color" style="background-color: #E6D5F5;"></div>
                        <span>No. Of Leads</span>
                    </div>
                    <div class="nbfc-lead-legend-item">
                        <div class="nbfc-lead-legend-color" style="background-color: #6C3EE8;"></div>
                        <span>Time Taken</span>
                    </div>
                </div>  
            </div>
              <div class="nbfc-lead-weeks-info">23 in 2 weeks</div>
           
            <div id="nbfc-lead-chart_div" style="width: 100%; height: 170px;"></div>
           <div class="nbfc-lead-pagination">
              <span><i class="fas fa-chevron-left"></i></span>
              <span>1 - 8</span>
              <span>/</span>
              <span>15</span>
              <span><i class="fas fa-chevron-right"></i></span>
           </div>


         
        </div>

        <!-- Student Counsellors -->
        <div class="sc-lead-container">
            <div class="sc-lead-header">
                <h3 class="sc-lead-title">Student Counsellors: Lead Generation</h3>
                <select class="sc-lead-select">
                    <option>Converted</option>
                </select>
            </div>
            <div class="sc-lead-legend">
                <div class="sc-lead-legend-item">
                    <div class="sc-lead-legend-color"></div>
                    <span>No. Of Leads</span>
                </div>
            </div>
            <div class="sc-lead-chart-wrapper">
                <canvas id="leadChart"></canvas>
            </div>
            <div class="sc-lead-pagination">
               <span><i class="fas fa-chevron-left"></i></span>
               <span>1 - 8</span>
               <span>/</span>
               <span>15</span>
              <span><i class="fas fa-chevron-right"></i></span>
            </div>

        </div>
    </div>






<div class="admindashboardcontainer-sixth-section">
    <div class="point-entry">
        <div class="point-entry-donut">
            <div class="point-entry-title">Point of entry</div>
            <div class="point-entry-chart-container">
                <div class="point-entry-chart-wrapper">
                    <canvas id="donutChart" width="103" height="103"
                        style="display: block; box-sizing: border-box; height: 103px; width: 103px;"></canvas>
                </div>
                <div class="point-entry-legend-container">
                    <div class="point-entry-legend">
                        <div class="point-entry-legend-item">
                            <div class="point-entry-legend-color" style="background-color: #6F25CE;"></div>
                            <span>LinkedIn Posts</span>
                        </div>
                        <div class="point-entry-legend-item">
                            <div class="point-entry-legend-color" style="background-color: #8863C9;"></div>
                            <span>Twitter Advertisements</span>
                        </div>
                        <div class="point-entry-legend-item">
                            <div class="point-entry-legend-color" style="background-color: #A894D9;"></div>
                            <span>WhatsApp Advertisements</span>
                        </div>
                    </div>
                    <div class="point-entry-legend">
                        <div class="point-entry-legend-item">
                            <div class="point-entry-legend-color" style="background-color: #C5B6E5;"></div>
                            <span>Schools & Institutions</span>
                        </div>
                        <div class="point-entry-legend-item">
                            <div class="point-entry-legend-color" style="background-color: #E2D9F2;"></div>
                            <span>Others</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="point-entry-dashboard">
             <div class="point-entry-dashboard-image">
                 <img src="assets/images/semrush-seo.png" alt="SEMRUSH Logo">
             </div>
          </div>


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
    initializeNewDonutChart(); 
    initializeLeadChart();
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

// New function for your additional donut chart
const initializeNewDonutChart = () => {
    // Make sure you have a canvas with id="donutChart" in your HTML
    var ctx = document.getElementById('donutChart').getContext('2d');
    var donutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["LinkedIn Posts", "Twitter Advertisements", "WhatsApp Advertisements", "Schools & Institutions", "Others"],
            datasets: [{
                data: [45, 20, 15, 10, 10],
                backgroundColor: ["#6F25CE", "#8863C9", "#A894D9", "#C5B6E5", "#E2D9F2"],
                borderWidth: 0,
                hoverOffset: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            },
            elements: {
                arc: {
                    borderWidth: 0
                }
            }
        }
    });
};

// Function to highlight the highest values in each table
function highlightHighestValues() {
    // Highlight highest values in city table
    highlightTableValues('city-table', 'admin-city-data-value');

    // Highlight highest values in country table
    highlightTableValues('country-table', 'admin-desti-country-data-value');
}

function highlightTableValues(tableId, valueClass) {
    const table = document.getElementById(tableId);
    if (!table) return;

    const valueCells = table.querySelectorAll('.' + valueClass);
    if (valueCells.length === 0) return;

    // Find the highest value
    let highestValue = 0;
    valueCells.forEach(cell => {
        const value = parseInt(cell.getAttribute('data-value'));
        if (value > highestValue) {
            highestValue = value;
        }
    });

    // Highlight cells with highest value
    valueCells.forEach(cell => {
        const value = parseInt(cell.getAttribute('data-value'));
        if (value === highestValue) {
            cell.classList.add('highlighted');
        }
    });
}

// Run the highlight function when the page loads
document.addEventListener('DOMContentLoaded', highlightHighestValues);

// Function to handle pagination for cities
document.querySelectorAll('.admin-city-pagination-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Pagination logic would go here
        console.log('City pagination clicked');
    });
});

// Function to handle filter buttons for cities
document.querySelectorAll('.admin-city-filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Filter logic would go here
        console.log('City filter clicked');
    });
});

// Function to handle sort buttons for cities
document.querySelectorAll('.admin-city-sort-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Sort logic would go here
        console.log('City sort clicked');
    });
});

// Function to handle pagination for destination countries
document.querySelectorAll('.admin-desti-country-pagination-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Pagination logic would go here
        console.log('Country pagination clicked');
    });
});

// Function to handle filter buttons for destination countries
document.querySelectorAll('.admin-desti-country-filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Filter logic would go here
        console.log('Country filter clicked');
    });
});

// Function to handle sort buttons for destination countries
document.querySelectorAll('.admin-desti-country-sort-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Sort logic would go here
        console.log('Country sort clicked');
    });
});

// NBFC chart
google.charts.load('current', { 'packages': ['corechart', 'bar'] });
google.charts.setOnLoadCallback(drawNBFCChart);

function drawNBFCChart() {
    var data = google.visualization.arrayToDataTable([
        ['NBFC', 'No. Of Leads', 'Time Taken'],
        ['ICICI', 55, 67],
        ['Baroda', 65, 45],
        ['AXIS', 60, 80],
        ['SBI', 90, 50],
        ['Canara', 45, 48],
        ['Baroda', 70, 55],
        ['SBI', 65, 85],
        ['HDFC', 75, 60]
    ]);

    var options = {
        title: null, // Remove title
        width: 440,
        height: 200,
        colors: ['#E6D5F5', '#6C3EE8'],
        legend: {
            position: 'none' // We'll create our own legend
        },
        hAxis: {
            title: null, // We'll add this ourselves
            textStyle: {
                fontSize: 10
            },
            gridlines: {
                color: 'transparent'
            }
        },
        vAxis: {
            gridlines: {
                color: 'transparent'
            },
            baselineColor: 'transparent',
            textPosition: 'none'
        },
        bar: { groupWidth: '60%' },
        backgroundColor: 'transparent',
        chartArea: {
            backgroundColor: 'transparent',
            width: '90%',
            height: '70%',
            top: '10%',
            left: '5%'
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('nbfc-lead-chart_div'));
    chart.draw(data, options);
}

// Lead chart
const initializeLeadChart = () => {
    const ctx = document.getElementById('leadChart').getContext('2d');
    const leadChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["54635", "65783", "56374", "92874", "36057", "10847", "34015", "57610"],
            datasets: [{
                label: "No. Of Leads",
                data: [5, 12, 10, 4, 18, 8, 6, 10],
                backgroundColor: "#d3b8f0",
                barThickness: 11,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        display: false,
                        font: {
                            family: "Poppins, sans-serif",
                            size: 12
                        },
                        color: "#5D5C5C"
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: "Poppins, sans-serif",
                            size: 12
                        },
                        color: "#5D5C5C"
                    },
                    border: {
                        display: false
                    }
                }
            },
            layout: {
                padding: {
                    top: 10
                }
            }
        }
    });
};

  const dropdownButton = document.getElementById('showall-buttongroups');
        const dropdownOptions = document.getElementById('dropdown-options');
        const icon = document.querySelector('.fa-chevron-down');

        // Toggle dropdown on button click
        dropdownButton.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdownOptions.classList.toggle('show');
            icon.classList.toggle('show-all-admin-rotate-icon');
        });

        // Close dropdown when clicking on an option
        const options = document.querySelectorAll('.show-all-admin-options button');
        options.forEach(option => {
            option.addEventListener('click', function () {
                console.log('Selected:', this.textContent);
                dropdownOptions.classList.remove('show');
                icon.classList.remove('show-all-admin-rotate-icon');
                // You can add custom functionality here
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.show-all-admin-button-container')) {
                dropdownOptions.classList.remove('show');
                icon.classList.remove('show-all-admin-rotate-icon');
            }
        });


       const calendarGrid = document.querySelector('.calendar-grid');
            const monthSelect = document.getElementById('calendar-month-select');
            const yearSelect = document.getElementById('calendar-year-select');
            const startDateInput = document.getElementById('calendar-start-date-input');
            const endDateInput = document.getElementById('calendar-end-date-input');
            const prevMonthBtn = document.querySelector('.calendar-prev-month');
            const nextMonthBtn = document.querySelector('.calendar-next-month');
            const calendarButton = document.getElementById('calender-buttongroups');
            const calendarContainer = document.querySelector('.calendar-container');
            const calendarWrapper = document.querySelector('.calendar-wrapper');

            let currentDate = new Date();
            let startDate = null;
            let endDate = null;
            let selectionMode = 'start'; // 'start' or 'end'
            let isCalendarOpen = false;

            // Populate year select with a range of years
            const currentYear = new Date().getFullYear();
            for (let year = currentYear - 5; year <= currentYear + 10; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }

            // Initialize the calendar
            updateMonthYearSelects();
            renderCalendar();

            // Allow clicking on the input fields to switch selection mode
            startDateInput.addEventListener('click', function (e) {
                e.stopPropagation();
                selectionMode = 'start';
                startDateInput.classList.add('calendar-active');
                endDateInput.classList.remove('calendar-active');
            });

            endDateInput.addEventListener('click', function (e) {
                e.stopPropagation();
                selectionMode = 'end';
                startDateInput.classList.remove('calendar-active');
                endDateInput.classList.add('calendar-active');
            });

            // Calendar button to toggle calendar visibility
            calendarButton.addEventListener('click', function (e) {
                e.stopPropagation();
                toggleCalendar();
            });

            // Handle clicks inside the calendar (prevent propagation)
            calendarContainer.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            // Handle clicks outside the calendar to close it
            document.addEventListener('click', function (e) {
                // If calendar is open and click is outside calendar container and button
                if (isCalendarOpen && !calendarContainer.contains(e.target) && e.target !== calendarButton) {
                    closeCalendar();
                }
            });

            // Calendar navigation
            prevMonthBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateMonthYearSelects();
                renderCalendar();
            });

            nextMonthBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateMonthYearSelects();
                renderCalendar();
            });

            // Month and year selection
            monthSelect.addEventListener('change', function (e) {
                e.stopPropagation();
                currentDate.setMonth(parseInt(this.value));
                renderCalendar();
            });

            yearSelect.addEventListener('change', function (e) {
                e.stopPropagation();
                currentDate.setFullYear(parseInt(this.value));
                renderCalendar();
            });

            function toggleCalendar() {
                if (isCalendarOpen) {
                    closeCalendar();
                } else {
                    openCalendar();
                }
            }

            function openCalendar() {
                calendarContainer.style.display = 'block';
                isCalendarOpen = true;
            }

            function closeCalendar() {
                calendarContainer.style.display = 'none';
                isCalendarOpen = false;
            }

            function updateMonthYearSelects() {
                monthSelect.value = currentDate.getMonth();
                yearSelect.value = currentDate.getFullYear();
            }

            function renderCalendar() {
                // Clear the days part of the grid
                const dayElements = calendarGrid.querySelectorAll('.calendar-day');
                dayElements.forEach(el => el.remove());

                // Get first day of month and last day of month
                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

                // Get the day of week of the first day (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
                // Adjust for Monday as first day of week
                let firstDayIndex = firstDay.getDay() - 1;
                if (firstDayIndex < 0) firstDayIndex = 6; // Sunday becomes last day (index 6)

                // Get days from previous month to fill the calendar
                const prevMonthLastDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0).getDate();

                // Fill calendar with days
                for (let i = prevMonthLastDay - firstDayIndex + 1; i <= prevMonthLastDay; i++) {
                    addDayToCalendar(i, 'calendar-other-month', new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, i));
                }

                // Current month days
                const today = new Date();
                for (let i = 1; i <= lastDay.getDate(); i++) {
                    const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);
                    const classes = [];

                    // Check if this day is today
                    if (today.getDate() === i &&
                        today.getMonth() === currentDate.getMonth() &&
                        today.getFullYear() === currentDate.getFullYear()) {
                        classes.push('calendar-today');
                    }

                    // Check if this day is selected start date
                    if (startDate &&
                        date.getDate() === startDate.getDate() &&
                        date.getMonth() === startDate.getMonth() &&
                        date.getFullYear() === startDate.getFullYear()) {
                        classes.push('calendar-selected-start');
                    }

                    // Check if this day is selected end date
                    if (endDate &&
                        date.getDate() === endDate.getDate() &&
                        date.getMonth() === endDate.getMonth() &&
                        date.getFullYear() === endDate.getFullYear()) {
                        classes.push('calendar-selected-end');
                    }

                    // Check if this day is in date range
                    if (startDate && endDate && date > startDate && date < endDate) {
                        classes.push('calendar-in-range');

                        // Add classes for first and last days in range for rounded corners
                        if (i === 1 || new Date(currentDate.getFullYear(), currentDate.getMonth(), i - 1) <= startDate) {
                            classes.push('calendar-first-in-range');
                        }
                        if (i === lastDay.getDate() || new Date(currentDate.getFullYear(), currentDate.getMonth(), i + 1) >= endDate) {
                            classes.push('calendar-last-in-range');
                        }
                    }

                    addDayToCalendar(i, classes.join(' '), date);
                }

                // Next month days to fill remaining cells
                const daysRendered = firstDayIndex + lastDay.getDate();
                const remainingDays = 7 - (daysRendered % 7);
                if (remainingDays < 7) {
                    for (let i = 1; i <= remainingDays; i++) {
                        addDayToCalendar(i, 'calendar-other-month', new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, i));
                    }
                }
            }

            function addDayToCalendar(dayNumber, classes, date) {
                const dayElement = document.createElement('div');
                dayElement.className = `calendar-day ${classes}`;
                dayElement.textContent = dayNumber;

                // Add date selection behavior
                if (!classes.includes('calendar-other-month')) {
                    dayElement.addEventListener('click', function (e) {
                        e.stopPropagation();
                        if (selectionMode === 'start') {
                            startDate = new Date(date);

                            // If end date is before start date, reset end date
                            if (endDate && endDate < startDate) {
                                endDate = null;
                            }

                            // Auto switch to end date mode after selecting start date
                            selectionMode = 'end';
                            startDateInput.classList.remove('calendar-active');
                            endDateInput.classList.add('calendar-active');
                        } else {
                            // Only set end date if we already have a start date
                            if (startDate) {
                                endDate = new Date(date);

                                // Swap dates if end date is before start date
                                if (endDate < startDate) {
                                    const temp = startDate;
                                    startDate = endDate;
                                    endDate = temp;
                                }
                            } else {
                                // If no start date, set start date instead
                                startDate = new Date(date);
                                selectionMode = 'end';
                                startDateInput.classList.remove('calendar-active');
                                endDateInput.classList.add('calendar-active');
                            }
                        }

                        updateInputs();
                        renderCalendar();
                    });
                }

                calendarGrid.appendChild(dayElement);
            }

            function updateInputs() {
                // Format and update start date input
                if (startDate) {
                    const formattedStartDate = `${startDate.getDate().toString().padStart(2, '0')}/${(startDate.getMonth() + 1).toString().padStart(2, '0')}/${startDate.getFullYear()}`;
                    startDateInput.innerHTML = `
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        ${formattedStartDate}
                    `;
                } else {
                    startDateInput.innerHTML = `
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Start Date</span>
                    `;
                }

                // Format and update end date input
                if (endDate) {
                    const formattedEndDate = `${endDate.getDate().toString().padStart(2, '0')}/${(endDate.getMonth() + 1).toString().padStart(2, '0')}/${endDate.getFullYear()}`;
                    endDateInput.innerHTML = `
                        ${formattedEndDate}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: auto;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    `;
                } else {
                    endDateInput.innerHTML = `
                        <span>End Date</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: auto;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    `;
                }
            }
            

        // Call the lead chart initialization
        // Get button reference from your admin dashboard
        const referralLinkBtn = document.getElementById('referral-link-admindashboard');
        const modal = document.getElementById('referralModal');
        const backdrop = document.getElementById('backdrop');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const generateBtn = document.getElementById('generateBtn');
        const inputField = document.getElementById('referralLink');

        // Event listener for the Generate Referral Link button
        referralLinkBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            backdrop.classList.add('active'); // Show the backdrop with blur
        });

        function closeModal() {
            modal.classList.add('hidden');
            backdrop.classList.remove('active'); // Hide the backdrop
            inputField.value = '';
        }

        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal); // Close when clicking outside

        generateBtn.addEventListener('click', () => {
            const generatedLink = `https://example.com/referral?code=${Math.random().toString(36).substr(2, 8)}`;
            inputField.value = generatedLink;
        });

       
       
         
       

 // Get button reference from your admin dashboard
        const referralLinkBtn = document.getElementById('referral-link-admindashboard');
        const modal = document.getElementById('referralModal');
        const backdrop = document.getElementById('backdrop');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const generateBtn = document.getElementById('generateBtn');
        const inputField = document.getElementById('referralLink');

        // Event listener for the Generate Referral Link button
        referralLinkBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            backdrop.classList.add('active'); // Show the backdrop with blur
        });

        function closeModal() {
            modal.classList.add('hidden');
            backdrop.classList.remove('active'); // Hide the backdrop
            inputField.value = '';
        }

        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal); // Close when clicking outside

        generateBtn.addEventListener('click', () => {
            const generatedLink = `https://example.com/referral?code=${Math.random().toString(36).substr(2, 8)}`;
            inputField.value = generatedLink;
        });



    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



    </script>
</body>

</html>