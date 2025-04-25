<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    @extends('layouts.app')

    <div class="admindashboard-container">
       
        <div class="admindashboardcontainer-firstsection">
            <h1>Hi, Admin name</h1>
            <div class="admindashboardcontainer-firstsectionbuttoncontainer">
                <button id="manage-student-admindashboard">Manage Student</button>
                <button id="referral-link-admindashboard">
                    Generate Referral Link
                </button>
            </div>
            <!-- Mobile menu button with two bars -->
            <button class="mobile-admin-dashboard-menu-btn" id="mobile-admin-dashboard-menu-btn">
                <span class="two-bar"></span>
                <span class="two-bar"></span>
            </button>
        </div>

        <!-- Mobile Modal -->
        <div class="mobile-admin-dashboard-modal" id="mobile-admin-dashboard-modal">
            <div class="mobile-admin-dashboard-modal-content">
                <div class="mobile-admin-dashboard-modal-header">
                    <h1>Hi, Admin name</h1>
                    <button class="mobile-admin-dashboard-close-modal-btn" id="mobile-admin-dashboard-close-modal-btn">
                        ✕
                    </button>
                </div>
                <button class="mobile-admin-dashboard-action-btn" id="manage-student-admindashboard-mobile">
                    Manage Students
                </button>
                <button class="mobile-admin-dashboard-action-btn" id="referral-link-admindashboard-mobile">
                    Generate Referral Link
                </button>
            </div>
        </div>

        <div class="backdrop" id="backdrop"></div>

        <!-- Referral Modal -->
        <div class="referral-triggered-view hidden" id="referralModal">
            <div class="referral-triggered-view-headersection">
                <h3>Generate Referral Link</h3>
                <span class="close-icon" id="closeModal">✕</span>
            </div>
            <div class="referral-triggered-view-content">
                <input type="text" id="referralLink" placeholder="Copy Link here">
            </div>
            <div class="referral-triggered-view-footer">
                <button id="cancelBtn">
                    <span class="cancel-icon">✕</span> Cancel
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
                        <button data-report="all">Show All</button>
                        <button data-report="registration-reports">Registration Reports</button>
                        <button data-report="no-of-grads">No of grads</button>
                        <button data-report="registration-source">Registration Source</button>
                        <button data-report="age-ratio-reports">Age ratio Reports</button>
                        <button data-report="funnel-reports">Funnel Reports</button>
                        <button data-report="destination-countries">Destination countries</button>
                        <button data-report="cities">Cities</button>
                        <button data-report="nbfc-generation-leads">NBFC: Generation Leads</button>
                        <button data-report="point-of-entry">Point of entry</button>
                        <button data-report="sc-generation-leads">SC: Generation Leads</button>
                        <button data-report="sem-rush">Sem Rush</button>
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
                    <button id="calender-buttongroups"> Calendar <img src="assets/images/Icons/calendar_month.png"
                            alt=""></button>
                    <button id="download-buttongroups">Download Report</button>

                    <div class="calendar-container">
                        <div class="calendar-input-container">
                            <div class="calendar-date-input calendar-active" id="calendar-start-date-input">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Start Date</span>
                            </div>
                            <div class="calendar-date-input" id="calendar-end-date-input">
                                <span>End Date</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    style="margin-left: auto;">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                        </div>

                        <div class="calendar-header">
                            <button class="calendar-nav-btn calendar-prev-month">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

        <div class="admindashboardcontainer-secondsection-mobile">
            <div class="admin-dashboard-search-filter-container">
                <div class="admin-dashboard-search-box">
                    <div class="admin-dashboard-search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="admin-dashboard-search-input" placeholder="Search" />
                </div>

                <button class="admin-dashboard-filter-button" id="filterButton">
                    Filters
                    <img src="assets/images/filter-icon.png" alt="Admin filter icon" />
                </button>

                <button class="admin-dashboard-calendar-button" id="calendarButton">
                    <i class="far fa-calendar"></i>
                </button>
            </div>

            <div class="admin-dashboard-showing-panels" id="showPanelsArea">
                <div>
                    <span class="admin-dashboard-showing-text">Showing</span>
                    <span class="admin-dashboard-panels-count" id="panelsToggle">11 Panels</span>
                </div>
                <button class="mobile-admin-dashboard-panel-btn" id="panelsIcon">
                    <span class="two-bar"></span>
                    <span class="two-bar"></span>
                </button>
            </div>

            <button class="admin-dashboard-download-button">Download Report</button>

            <div class="admin-dashboard-filter-panel" id="filterPanel">
                <div class="admin-dashboard-filter-container">
                    <div class="admin-dashboard-filter-header">
                        <div class="admin-dashboard-filter-title">Showing</div>
                        <button class="admin-dashboard-close-btn" id="closeFilterBtn">
                            ×
                        </button>
                    </div>

                    <div class="admin-dashboard-filter-tags">
                        <div class="admin-dashboard-filter-tag">
                            Registration Reports
                            <span class="admin-dashboard-close-tag">×</span>
                        </div>
                        <div class="admin-dashboard-filter-tag">
                            No of grads <span class="admin-dashboard-close-tag">×</span>
                        </div>
                        <div class="admin-dashboard-filter-tag">
                            Registration Source
                            <span class="admin-dashboard-close-tag">×</span>
                        </div>
                        <div class="admin-dashboard-filter-tag">
                            Age ratio Reports <span class="admin-dashboard-close-tag">×</span>
                        </div>
                        <div class="admin-dashboard-filter-tag">
                            Funnel Reports <span class="admin-dashboard-close-tag">×</span>
                        </div>
                        <div class="admin-dashboard-filter-tag">
                            Destination countries
                            <span class="admin-dashboard-close-tag">×</span>
                        </div>
                    </div>

                    <div class="admin-dashboard-divider"></div>

                    <div class="admin-dashboard-collapsed-tags" id="collapsedTags">
                        <div class="admin-dashboard-filter-tags">
                            <div class="admin-dashboard-filter-tag">
                                Cities <span class="admin-dashboard-close-tag">×</span>
                            </div>
                            <div class="admin-dashboard-filter-tag">
                                NBFC: Generation Leads
                                <span class="admin-dashboard-close-tag">×</span>
                            </div>
                            <div class="admin-dashboard-filter-tag">
                                Point of entry <span class="admin-dashboard-close-tag">×</span>
                            </div>
                            <div class="admin-dashboard-filter-tag">
                                SC: Generation Leads
                                <span class="admin-dashboard-close-tag">×</span>
                            </div>
                            <div class="admin-dashboard-filter-tag">
                                Sem Rush <span class="admin-dashboard-close-tag">×</span>
                            </div>
                        </div>
                    </div>

                    <button class="admin-dashboard-show-all-btn" id="showAllBtn">
                        Show All <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="admindashboardcontainer-thirdsection">
            <div class="admindashboard-firstpart">
                <div class="reports-registeration" data-report="registration-reports">
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
                <div class="source-registeration" data-report="registration-source">
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
            <div class="admindashboard-secondpart" data-report="no-of-grads">
                <div class="admindashboard-second-main-container">
                    <div class="totalundergrads-admin">
                        <h4>Total Undergrads</h4>
                        <div class="totalundergrads-info">
                            <h1>60</h1>
                            <p>Female <span>20</span></p>
                            <p>Male <span>20</span></p>
                            <p>Others <span>20</span></p>
                        </div>
                    </div>
                    <div class="totalpostgrads-admin">
                        <h4>Total Postgrads</h4>
                        <div class="totalpostgrads-info">
                            <h1>150</h1>
                            <p>Female <span>20</span></p>
                            <p>Male <span>20</span></p>
                            <p>Others <span>20</span></p>
                        </div>
                    </div>
                </div>
                <div class="ageratio-graph-admin" data-report="age-ratio-reports">
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
                                        style="background-color: {{ $source['color'] }}; width: 11px; height: 11px;"></div>
                                    <p>{{ $source['studentRangeValue'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="admindashboard-thirdpart" data-report="funnel-reports">
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
                            <p>Offer issued to student</p>
                        </div>
                        <div>
                            <p>Offer rejected to student</p>
                        </div>
                        <div>
                            <p>Offer Accepted & closed</p>
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

        <div class="admindashboardcontainer-fourth-section" data-report="destination-countries">
            <div class="admin-dashboard-container-four">
                <div class="admin-dashboard-row">
                    <!-- Cities Section -->
                    <div class="admin-city-column">
                        <div class="admin-city-section">
                            <div class="admin-city-header">
                                <div class="admin-city-title">Cities</div>
                                <div class="admin-city-filter-sort-container">
                                    <button class="admin-city-filter-btn">Filter <i
                                            class="fas fa-chevron-down"></i></button>
                                    <button class="admin-city-sort-btn">Sort <i
                                            class="fas fa-chevron-down"></i></button>
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
                                <div class="admin-desti-country-pagination-btn"><i class="fas fa-chevron-left"></i>
                                </div>
                                <div class="admin-desti-country-pagination-text">1-10 / 30</div>
                                <div class="admin-desti-country-pagination-btn"><i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fifth Section -->
        <div class="admindashboardcontainer-fifth-section" data-report="nbfc-generation-leads">
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
        </div>

        <div class="admindashboardcontainer-sixth-section" data-report="point-of-entry">
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

    <script>
        // Utility functions for DOM queries
        const $ = (selector, context = document) => context.querySelector(selector);
        const $$ = (selector, context = document) => Array.from(context.querySelectorAll(selector));

        // Load Google Charts
        google.charts.load('current', { packages: ['corechart', 'bar', 'line'] });

        // Initialize all components on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', () => {
            try {
                initializeCharts();
                initializeCalendar();
                initializeDropdown();
                initializeReferralModal();
                initializeMobileMenu();
                initializeFilterPanel();
                highlightHighestValues();
                initializePaginationAndFilters();

                // Add the downloadPDF function and event listener
                const downloadPDF = () => {
                    // Check if jsPDF is available
                    if (!window.jspdf || !window.jspdf.jsPDF) {
                        console.error('jsPDF library is not loaded. Please ensure the jsPDF script is included and loaded.');
                        alert('Failed to download PDF: jsPDF library not loaded.');
                        return;
                    }

                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF({
                        orientation: 'portrait',
                        unit: 'mm',
                        format: 'a4'
                    });

                    try {
                        // Define colors and styles
                        const primaryColor = [239, 108, 0]; // Orange color for REMITOUT
                        const secondaryColor = [70, 70, 70]; // Dark gray for headings
                        const bgHeaderColor = [55, 55, 55]; // Background color for top header

                        // Add header background
                        doc.setFillColor(bgHeaderColor[0], bgHeaderColor[1], bgHeaderColor[2]);
                        doc.rect(0, 0, doc.internal.pageSize.getWidth(), 15, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.setFontSize(10);
                        doc.text('Admin-Dashboard Report', 10, 10);

                        // Reset text color
                        doc.setTextColor(0, 0, 0);

                        // Add REMITOUT logo on the left side (simulated with text)
                        doc.setFillColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                        doc.rect(53, 53, 10, 10, 'F');
                        doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                        doc.setFontSize(18);
                        doc.setFont('helvetica', 'bold');
                        doc.text('REMITOUT', 70, 60);

                        // Add authority information on right
                        doc.setTextColor(0, 0, 0);
                        doc.setFontSize(9);
                        doc.setFont('helvetica', 'normal');
                        doc.text('Authority name', doc.internal.pageSize.getWidth() - 60, 57);
                        doc.text('Designation', doc.internal.pageSize.getWidth() - 60, 63);
                        doc.text('Date of data export', doc.internal.pageSize.getWidth() - 60, 69);
                        doc.text('Time of data export', doc.internal.pageSize.getWidth() - 60, 75);

                        // Dashboard Reports title with underline
                        doc.setFontSize(18);
                        doc.setFont('helvetica', 'bold');
                        doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                        doc.text('Dashboard Reports', 53, 115);

                        // Title on right
                        doc.text('November', doc.internal.pageSize.getWidth() - 53, 115, { align: 'right' });

                        // Underline
                        doc.setDrawColor(200, 200, 200);
                        doc.line(53, 120, doc.internal.pageSize.getWidth() - 53, 120);

                        // Generate tables with styling
                        // Registration Section
                        doc.setTextColor(0, 0, 0);
                        doc.setFontSize(12);
                        doc.text('Registration', 53, 135);
                        doc.autoTable({
                            startY: 140,
                            margin: { left: 53 },
                            headStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0], fontStyle: 'bold' },
                            head: [['Date', 'Name', 'Type', 'Source', 'Point of entry']],
                            body: [
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                                ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn']
                            ],
                            theme: 'plain',
                            styles: {
                                fontSize: 9,
                                cellPadding: 4
                            }
                        });

                        // Cities Section
                        doc.addPage();
                        doc.setFontSize(12);
                        doc.text('Cities', 53, 50);
                        doc.autoTable({
                            startY: 55,
                            margin: { left: 53 },
                            headStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0], fontStyle: 'bold' },
                            head: [['City', 'State', 'Female', 'Male', 'other', 'No. students']],
                            body: [
                                ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                                ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                                ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                                ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                                ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                                ['Kolkata', 'West Bengal', 50, 40, 40, 90]
                            ],
                            theme: 'plain',
                            styles: {
                                fontSize: 9,
                                cellPadding: 4
                            }
                        });

                        // Destination Countries Section
                        doc.setFontSize(12);
                        doc.text('Destination Countries', 53, doc.autoTable.previous.finalY + 20);
                        doc.autoTable({
                            startY: doc.autoTable.previous.finalY + 25,
                            margin: { left: 53 },
                            headStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0], fontStyle: 'bold' },
                            head: [['Country', 'Continent', 'Female', 'Male', 'other', 'No. students']],
                            body: [
                                ['Canada', 'Europe', 50, 40, 40, 90],
                                ['Canada', 'Europe', 50, 40, 40, 90],
                                ['Canada', 'Europe', 50, 40, 40, 90],
                                ['Canada', 'Europe', 50, 40, 40, 90],
                                ['Canada', 'Europe', 50, 40, 40, 90],
                                ['Canada', 'Europe', 50, 40, 40, 90],
                                ['Canada', 'Europe', 50, 40, 40, 90]
                            ],
                            theme: 'plain',
                            styles: {
                                fontSize: 9,
                                cellPadding: 4
                            }
                        });

                        // NBFCs Section
                        doc.setFontSize(12);
                        doc.text('NBFCs', 53, doc.autoTable.previous.finalY + 20);
                        doc.autoTable({
                            startY: doc.autoTable.previous.finalY + 25,
                            margin: { left: 53 },
                            headStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0], fontStyle: 'bold' },
                            head: [['NBFC Name', 'Student Name', 'Unique ID', 'Type', 'Proposal status', 'Start Date', 'Time taken']],
                            body: [
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days'],
                                ['Bank Of Baroda', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Pending', '11/11/2024', '12 days']
                            ],
                            theme: 'plain',
                            styles: {
                                fontSize: 9,
                                cellPadding: 4
                            }
                        });

                        // Student Counsellors Section
                        if (doc.autoTable.previous.finalY > 200) {
                            doc.addPage();
                            doc.setFontSize(12);
                            doc.text('Student Counsellors', 53, 50);
                            doc.autoTable({
                                startY: 55,
                                margin: { left: 53 },
                                headStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0], fontStyle: 'bold' },
                                head: [['Referral code', 'Student Name', 'Unique ID', 'Type', 'Proxy Application', 'Date']],
                                body: [
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024']
                                ],
                                theme: 'plain',
                                styles: {
                                    fontSize: 9,
                                    cellPadding: 4
                                }
                            });
                        } else {
                            doc.setFontSize(12);
                            doc.text('Student Counsellors', 53, doc.autoTable.previous.finalY + 20);
                            doc.autoTable({
                                startY: doc.autoTable.previous.finalY + 25,
                                margin: { left: 53 },
                                headStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0], fontStyle: 'bold' },
                                head: [['Referral code', 'Student Name', 'Unique ID', 'Type', 'Proxy Application', 'Date']],
                                body: [
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024'],
                                    ['8475908b9y', 'Geetha Muthuswamy', 'JBUK.JKMIB8899', 'Undergraduate', 'Yes', '11/11/2024']
                                ],
                                theme: 'plain',
                                styles: {
                                    fontSize: 9,
                                    cellPadding: 4
                                }
                            });
                        }

                        // Add footer with logo on every page
                        const totalPages = doc.internal.getNumberOfPages();
                        for (let i = 1; i <= totalPages; i++) {
                            doc.setPage(i);

                            // Add footer with logo
                            const footerY = doc.internal.pageSize.getHeight() - 20;

                            // REMITOUT logo in footer (simulated with text and shape)
                            doc.setFillColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                            doc.rect(53, footerY, 6, 6, 'F');
                            doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                            doc.setFontSize(12);
                            doc.setFont('helvetica', 'bold');
                            doc.text('REMITOUT', 63, footerY + 5);

                            // Add footer line
                            doc.setDrawColor(200, 200, 200);
                            doc.line(53, footerY + 10, doc.internal.pageSize.getWidth() - 53, footerY + 10);
                        }

                        // Save the PDF
                        doc.save('Dashboard_Report_November_2024.pdf');
                    } catch (error) {
                        console.error('Error generating PDF:', error);
                        alert('Failed to generate PDF. Please check the console for details.');
                    }
                };

                // Function to generate actual data for the PDF (replace with your data fetching logic)
                function fetchReportData() {
                    // This is where you would fetch actual data from your database or API
                    // For now, we're returning mock data
                    return {
                        registrationData: [
                            ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                            ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                            ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                            ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                            ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn'],
                            ['11/12/2024', 'Geetha Muthuswamy', 'ADDS', 'Source', 'LinkedIn']
                        ],
                        citiesData: [
                            ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                            ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                            ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                            ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                            ['Kolkata', 'West Bengal', 50, 40, 40, 90],
                            ['Kolkata', 'West Bengal', 50, 40, 40, 90]
                        ],
                        // Add other data structures as needed
                    };
                }

                // Add event listener to your specific button
                document.addEventListener('DOMContentLoaded', function () {
                    const downloadButton = document.getElementById('download-buttongroups');
                    if (downloadButton) {
                        downloadButton.addEventListener('click', downloadPDF);
                    } else {
                        console.error("Button with ID 'download-buttongroups' not found");
                    }
                });

                // Add an event listener to trigger the download
                document.getElementById('downloadPdfButton').addEventListener('click', downloadPDF);

                // Attach the event listener to the download button
                const downloadButton = $('#download-buttongroups');
                if (downloadButton) {
                    downloadButton.addEventListener('click', downloadPDF);
                } else {
                    console.error('Download button (#download-buttongroups) not found in the DOM.');
                }
            } catch (error) {
                console.error('Initialization error:', error);
            }
        });

        // Chart Initialization
        const initializeCharts = () => {
            google.charts.setOnLoadCallback(() => {
                initializeRegistrationLineGraph();
                drawNBFCChart();
            });
            initializeDonutGraphSource();
            initializeDonutGraphAgeRatio();
            initializeNewDonutChart();
            initializeLeadChart();
        };

        // Registration Line Graph
        const initializeRegistrationLineGraph = () => {
            const chartDiv = $('#chart_div');
            if (!chartDiv) return console.error('chart_div not found');

            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Day');
            data.addColumn('number', 'Registrations');
            data.addColumn({ type: 'string', role: 'annotation' });

            data.addRows([
                ['Mon', 100, null], ['Tue', 123, null], ['Wed', 174, '174'], ['Thu', 118, null],
                ['Fri', 145, null], ['Sat', 92, null]
            ]);

            const view = new google.visualization.DataView(data);
            view.setColumns([0, 1, 2]);

            const options = {
                maintainAspectRatio: false,
                hAxis: { title: 'Day of the Week', textStyle: { color: '#333' } },
                vAxis: { title: 'Registrations', viewWindow: { min: 0, max: 200 }, textStyle: { color: '#333' } },
                annotations: { alwaysOutside: true, textStyle: { color: '#000', fontSize: 12 } },
                pointSize: 5,
                series: { 0: { lineWidth: 2, pointShape: 'circle', color: 'rgb(163, 171, 189)' } },
                legend: 'none',
                chartArea: { width: '80%', height: '70%' }
            };
            // const options = {
            //     maintainAspectRatio: false,
            //     hAxis: { title: 'Day of the Week', textStyle: { color: '#333' } },
            //     vAxis: { title: 'Registrations', viewWindow: { min: 0, max: 200 }, textStyle: { color: '#333' } },
            //     annotations: { alwaysOutside: true, textStyle: { color: '#000', fontSize: 12 } },
            //     pointSize: 5,
            //     series: { 0: { lineWidth: 2, pointShape: 'circle', color: 'rgb(163, 171, 189)' } },
            //     legend: 'none',
            //     chartArea: { width: '80%', height: '70%' }
            // };

            const chart = new google.visualization.LineChart(chartDiv);
            chart.draw(view, options);
        };

        // Donut Graph for Registration Sources
        const initializeDonutGraphSource = () => {
            const ctx = $('#donutRegistrationChart')?.getContext('2d');
            if (!ctx) return console.error('donutRegistrationChart canvas not found');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['ADDS', 'Organic', 'SC Referral'],
                    datasets: [{
                        label: 'Registration Sources',
                        data: [25, 30, 45],
                        backgroundColor: ['rgba(111, 37, 206, 1)', 'rgba(181, 142, 229, 1)', 'rgba(226, 211, 245, 1)'],
                        borderWidth: 0,
                        cutout: '50%'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    }
                }
            });
        };

        // Donut Graph for Age Ratio
        const initializeDonutGraphAgeRatio = () => {
            const ctx = $('#ageratio-donutRegistrationChart')?.getContext('2d');
            if (!ctx) return console.error('ageratio-donutRegistrationChart canvas not found');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['16 - 20', '21 - 25', '26 - 30', '30-40'],
                    datasets: [{
                        label: 'Age Ratio of Students',
                        data: [25, 30, 40, 21],
                        backgroundColor: ['rgba(111, 37, 206, 1)', 'rgba(167, 121, 224, 1)', 'rgba(203, 176, 237, 1)', 'rgba(226, 211, 245, 1)'],
                        borderWidth: 0,
                        cutout: '50%'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    }
                }
            });
        };

        // Additional Donut Chart
        const initializeNewDonutChart = () => {
            const ctx = $('#donutChart')?.getContext('2d');
            if (!ctx) return console.error('donutChart canvas not found');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['LinkedIn Posts', 'Twitter Advertisements', 'WhatsApp Advertisements', 'Schools & Institutions', 'Others'],
                    datasets: [{
                        data: [45, 20, 15, 10, 10],
                        backgroundColor: ['#6F25CE', '#8863C9', '#A894D9', '#C5B6E5', '#E2D9F2'],
                        borderWidth: 0,
                        cutout: '70%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { display: false }, tooltip: { enabled: true } }
                }
            });
        };

        // NBFC Chart
        const drawNBFCChart = () => {
            const chartDiv = $('#nbfc-lead-chart_div');
            if (!chartDiv) return console.error('nbfc-lead-chart_div not found');

            const data = google.visualization.arrayToDataTable([
                ['NBFC', 'No. Of Leads', 'Time Taken'],
                ['ICICI', 55, 67], ['Baroda', 65, 45], ['AXIS', 60, 80], ['SBI', 90, 50],
                ['Canara', 45, 48], ['HDFC', 75, 60]
            ]);

            const options = {
                width: '100%',
                height: 200,
                colors: ['#E6D5F5', '#6C3EE8'],
                legend: { position: 'none' },
                hAxis: { textStyle: { fontSize: 10 }, gridlines: { color: 'transparent' } },
                vAxis: { gridlines: { color: 'transparent' }, baselineColor: 'transparent', textPosition: 'none' },
                bar: { groupWidth: '60%' },
                backgroundColor: 'transparent',
                chartArea: { width: '90%', height: '70%' }
            };

            const chart = new google.visualization.ColumnChart(chartDiv);
            chart.draw(data, options);
        };

        // Lead Chart
        const initializeLeadChart = () => {
            const ctx = $('#leadChart')?.getContext('2d');
            if (!ctx) return console.error('leadChart canvas not found');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['54635', '65783', '56374', '92874', '36057', '10847', '34015', '57610'],
                    datasets: [{
                        label: 'No. Of Leads',
                        data: [5, 12, 10, 4, 18, 8, 6, 10],
                        backgroundColor: '#d3b8f0',
                        barThickness: 11
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: true } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false }, ticks: { display: false } },
                        x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 12 }, color: '#5D5C5C' } }
                    }
                }
            });
        };

        // Highlight Highest Values in Tables
        const highlightHighestValues = () => {
            ['city-table', 'country-table'].forEach(tableId => {
                const valueClass = tableId === 'city-table' ? 'admin-city-data-value' : 'admin-desti-country-data-value';
                const table = $(`#${tableId}`);
                if (!table) return;

                const valueCells = $$(`.${valueClass}`, table);
                if (!valueCells.length) return;

                const highestValue = Math.max(...valueCells.map(cell => parseInt(cell.dataset.value || 0)));
                valueCells.forEach(cell => {
                    if (parseInt(cell.dataset.value) === highestValue) {
                        cell.classList.add('highlighted');
                    }
                });
            });
        };

        // Pagination and Filter Handlers
        const initializePaginationAndFilters = () => {
            const handlers = [
                { selector: '.admin-city-pagination-btn', action: () => console.log('City pagination clicked') },
                { selector: '.admin-city-filter-btn', action: () => console.log('City filter clicked') },
                { selector: '.admin-city-sort-btn', action: () => console.log('City sort clicked') },
                { selector: '.admin-desti-country-pagination-btn', action: () => console.log('Country pagination clicked') },
                { selector: '.admin-desti-country-filter-btn', action: () => console.log('Country filter clicked') },
                { selector: '.admin-desti-country-sort-btn', action: () => console.log('Country sort clicked') }
            ];

            handlers.forEach(({ selector, action }) => {
                $$(selector).forEach(btn => {
                    btn.removeEventListener('click', action);
                    btn.addEventListener('click', action);
                });
            });
        };

        // Updated Dropdown Initialization
        const initializeDropdown = () => {
            const dropdownButton = $('#showall-buttongroups');
            const dropdownOptions = $('#dropdown-options');
            const icon = $('.fa-chevron-down', dropdownButton);
            const container = $('.admindashboard-container');

            if (!dropdownButton || !dropdownOptions || !icon || !container) {
                console.error('Dropdown elements missing:', { dropdownButton, dropdownOptions, icon, container });
                return;
            }

            let currentReport = 'all';

            const fallbackMessage = document.createElement('div');
            fallbackMessage.className = 'report-fallback';
            fallbackMessage.style.padding = '20px';
            fallbackMessage.style.textAlign = 'center';
            fallbackMessage.style.color = '#666';
            container.appendChild(fallbackMessage);

            const showAllReports = () => {
                $$('[data-report]').forEach(report => {
                    report.style.removeProperty('display');
                    report.style.removeProperty('visibility');
                    report.style.display = '';
                    report.style.visibility = '';
                    console.log('Restoring visibility for:', report.dataset.report);
                });
                fallbackMessage.style.display = 'none';
                dropdownButton.innerHTML = `Show All <i class="fa-solid fa-chevron-down"></i>`;
                currentReport = 'all';
            };

            const showReport = (reportId) => {
                const reportContainer = $(`[data-report="${reportId}"]`);
                if (!reportContainer) {
                    $$('[data-report]').forEach(report => {
                        report.style.display = 'block';
                        report.style.visibility = 'hidden';
                    });
                    fallbackMessage.textContent = `No data available for ${$(`[data-report="${reportId}"]`, dropdownOptions)?.textContent || 'this report'}.`;
                    fallbackMessage.style.display = 'block';
                } else {
                    $$('[data-report]').forEach(report => {
                        if (report.dataset.report === reportId) {
                            report.style.display = 'block';
                            report.style.visibility = 'visible';
                        } else {
                            report.style.display = 'block';
                            report.style.visibility = 'hidden';
                        }
                    });
                    fallbackMessage.style.display = 'none';
                }
                const selectedOption = $(`[data-report="${reportId}"]`, dropdownOptions);
                const optionText = selectedOption ? selectedOption.textContent.trim() : 'Unknown';
                dropdownButton.innerHTML = `Show: ${optionText} <i class="fa-solid fa-chevron-down"></i>`;
                currentReport = reportId;
            };

            const toggleDropdown = (e) => {
                e.stopPropagation();
                console.log('Toggling dropdown, current class:', dropdownOptions.className);
                if (currentReport !== 'all' && !dropdownOptions.classList.contains('show')) {
                    showAllReports();
                }
                dropdownOptions.classList.toggle('show');
                icon.classList.toggle('show-all-admin-rotate-icon');
                if (dropdownOptions.classList.contains('show')) {
                    console.log('Dropdown opened with all options');
                } else {
                    console.log('Dropdown closed');
                }
            };

            const handleOptionClick = (e) => {
                e.stopPropagation();
                const reportId = e.target.dataset.report;
                console.log('Option selected:', reportId);
                if (reportId === 'all') {
                    showAllReports();
                } else if (reportId) {
                    showReport(reportId);
                }
            };

            dropdownButton.addEventListener('click', toggleDropdown);
            $$('.show-all-admin-options button', dropdownOptions).forEach(option => {
                option.addEventListener('click', handleOptionClick);
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.show-all-admin-button-container') && dropdownOptions.classList.contains('show')) {
                    console.log('Closing dropdown due to outside click');
                    dropdownOptions.classList.remove('show');
                    icon.classList.remove('show-all-admin-rotate-icon');
                }
            });

            showAllReports();
        };

        // Calendar
        const initializeCalendar = () => {
            const calendarGrid = $('.calendar-grid');
            const monthSelect = $('#calendar-month-select');
            const yearSelect = $('#calendar-year-select');
            const startDateInput = $('#calendar-start-date-input');
            const endDateInput = $('#calendar-end-date-input');
            const prevMonthBtn = $('.calendar-prev-month');
            const nextMonthBtn = $('.calendar-next-month');
            const calendarButton = $('#calender-buttongroups');
            const calendarContainer = $('.calendar-container');

            if (!calendarGrid || !monthSelect || !yearSelect || !startDateInput || !endDateInput || !calendarButton || !calendarContainer) {
                return console.error('Calendar elements missing');
            }

            let currentDate = new Date();
            let startDate = null;
            let endDate = null;
            let selectionMode = 'start';
            let isCalendarOpen = false;

            const currentYear = new Date().getFullYear();
            for (let year = currentYear - 5; year <= currentYear + 5; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) option.selected = true;
                yearSelect.appendChild(option);
            }

            const toggleCalendar = () => {
                isCalendarOpen = !isCalendarOpen;
                calendarContainer.style.display = isCalendarOpen ? 'block' : 'none';
            };

            const updateMonthYearSelects = () => {
                monthSelect.value = currentDate.getMonth();
                yearSelect.value = currentDate.getFullYear();
            };

            const renderCalendar = () => {
                $$('.calendar-day', calendarGrid).forEach(el => el.remove());

                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                let firstDayIndex = firstDay.getDay() - 1;
                if (firstDayIndex < 0) firstDayIndex = 6;

                const prevMonthLastDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0).getDate();
                for (let i = prevMonthLastDay - firstDayIndex + 1; i <= prevMonthLastDay; i++) {
                    addDayToCalendar(i, 'calendar-other-month', new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, i));
                }

                const today = new Date();
                for (let i = 1; i <= lastDay.getDate(); i++) {
                    const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);
                    const classes = [];
                    if (today.toDateString() === date.toDateString()) classes.push('calendar-today');
                    if (startDate && startDate.toDateString() === date.toDateString()) classes.push('calendar-selected-start');
                    if (endDate && endDate.toDateString() === date.toDateString()) classes.push('calendar-selected-end');
                    if (startDate && endDate && date > startDate && date < endDate) {
                        classes.push('calendar-in-range');
                        if (i === 1 || new Date(currentDate.getFullYear(), currentDate.getMonth(), i - 1) <= startDate) {
                            classes.push('calendar-first-in-range');
                        }
                        if (i === lastDay.getDate() || new Date(currentDate.getFullYear(), currentDate.getMonth(), i + 1) >= endDate) {
                            classes.push('calendar-last-in-range');
                        }
                    }
                    addDayToCalendar(i, classes.join(' '), date);
                }

                const daysRendered = firstDayIndex + lastDay.getDate();
                const remainingDays = 7 - (daysRendered % 7);
                if (remainingDays < 7) {
                    for (let i = 1; i <= remainingDays; i++) {
                        addDayToCalendar(i, 'calendar-other-month', new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, i));
                    }
                }
            };

            const addDayToCalendar = (dayNumber, classes, date) => {
                const dayElement = document.createElement('div');
                dayElement.className = `calendar-day ${classes}`;
                dayElement.textContent = dayNumber;

                if (!classes.includes('calendar-other-month')) {
                    dayElement.addEventListener('click', e => {
                        e.stopPropagation();
                        if (selectionMode === 'start') {
                            startDate = new Date(date);
                            if (endDate && endDate < startDate) endDate = null;
                            selectionMode = 'end';
                            startDateInput.classList.remove('calendar-active');
                            endDateInput.classList.add('calendar-active');
                        } else {
                            endDate = new Date(date);
                            if (startDate && endDate < startDate) {
                                [startDate, endDate] = [endDate, startDate];
                            }
                            selectionMode = 'start';
                            startDateInput.classList.add('calendar-active');
                            endDateInput.classList.remove('calendar-active');
                        }
                        updateInputs();
                        renderCalendar();
                    });
                }
                calendarGrid.appendChild(dayElement);
            };

            const updateInputs = () => {
                startDateInput.innerHTML = startDate
                    ? `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                       ${startDate.getDate().toString().padStart(2, '0')}/${(startDate.getMonth() + 1).toString().padStart(2, '0')}/${startDate.getFullYear()}`
                    : `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span>Start Date</span>`;

                endDateInput.innerHTML = endDate
                    ? `${endDate.getDate().toString().padStart(2, '0')}/${(endDate.getMonth() + 1).toString().padStart(2, '0')}/${endDate.getFullYear()}
                       <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: auto;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>`
                    : `<span>End Date</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: auto;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>`;
            };

            startDateInput.addEventListener('click', e => {
                e.stopPropagation();
                selectionMode = 'start';
                startDateInput.classList.add('calendar-active');
                endDateInput.classList.remove('calendar-active');
            });

            endDateInput.addEventListener('click', e => {
                e.stopPropagation();
                selectionMode = 'end';
                startDateInput.classList.remove('calendar-active');
                endDateInput.classList.add('calendar-active');
            });

            calendarButton.addEventListener('click', e => {
                e.stopPropagation();
                toggleCalendar();
            });

            calendarContainer.addEventListener('click', e => e.stopPropagation());

            document.addEventListener('click', e => {
                if (isCalendarOpen && !calendarContainer.contains(e.target) && e.target !== calendarButton) {
                    toggleCalendar();
                }
            });

            prevMonthBtn.addEventListener('click', e => {
                e.stopPropagation();
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateMonthYearSelects();
                renderCalendar();
            });

            nextMonthBtn.addEventListener('click', e => {
                e.stopPropagation();
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateMonthYearSelects();
                renderCalendar();
            });

            monthSelect.addEventListener('change', () => {
                currentDate.setMonth(parseInt(monthSelect.value));
                renderCalendar();
            });

            yearSelect.addEventListener('change', () => {
                currentDate.setFullYear(parseInt(yearSelect.value));
                renderCalendar();
            });

            updateMonthYearSelects();
            renderCalendar();
        };

        // Referral Modal
        const initializeReferralModal = () => {
            const referralLinkBtn = $('#referral-link-admindashboard');
            const referralLinkBtnMobile = $('#referral-link-admindashboard-mobile');
            const modal = $('#referralModal');
            const backdrop = $('#backdrop');
            const closeBtn = $('#closeModal');
            const cancelBtn = $('#cancelBtn');
            const generateBtn = $('#generateBtn');
            const inputField = $('#referralLink');

            if (!referralLinkBtn || !modal || !backdrop || !closeBtn || !cancelBtn || !generateBtn || !inputField) {
                return console.error('Referral modal elements missing');
            }

            const openModal = () => {
                modal.classList.remove('hidden');
                backdrop.classList.add('active');
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                backdrop.classList.remove('active');
                inputField.value = '';
            };

            referralLinkBtn.addEventListener('click', openModal);
            referralLinkBtnMobile?.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);

            generateBtn.addEventListener('click', () => {
                inputField.value = `https://example.com/referral?code=${Math.random().toString(36).substr(2, 8)}`;
            });
        };

        // Mobile Menu Modal
        const initializeMobileMenu = () => {
            const mobileModal = $('#mobile-admin-dashboard-modal');
            const mobileMenuBtn = $('#mobile-admin-dashboard-menu-btn');
            const closeModalBtn = $('#mobile-admin-dashboard-close-modal-btn');
            const manageStudentBtn = $('#manage-student-admindashboard-mobile');

            if (!mobileModal || !mobileMenuBtn || !closeModalBtn) {
                return console.error('Mobile menu elements missing');
            }

            const openModal = e => {
                e.stopPropagation();
                mobileModal.style.display = 'flex';
            };

            const closeModal = e => {
                if (e) e.stopPropagation();
                mobileModal.style.display = 'none';
            };

            mobileMenuBtn.removeEventListener('click', openModal);
            mobileMenuBtn.addEventListener('click', openModal);

            closeModalBtn.removeEventListener('click', closeModal);
            closeModalBtn.addEventListener('click', closeModal);

            mobileModal.addEventListener('click', e => {
                if (e.target === mobileModal) closeModal(e);
            });

            manageStudentBtn?.addEventListener('click', e => {
                e.stopPropagation();
                console.log('Manage Students clicked');
                closeModal(e);
            });
        };

        // Filter Panel
        const initializeFilterPanel = () => {
            const filterButton = $('#filterButton');
            const filterPanel = $('#filterPanel');
            const closeFilterBtn = $('#closeFilterBtn');
            const showAllBtn = $('#showAllBtn');
            const collapsedTags = $('#collapsedTags');
            const panelsToggle = $('#panelsToggle');
            const showPanelsArea = $('#showPanelsArea');

            if (!filterButton || !filterPanel || !closeFilterBtn || !showAllBtn || !collapsedTags || !panelsToggle || !showPanelsArea) {
                return console.error('Filter panel elements missing');
            }

            const openFilterPanel = () => {
                filterPanel.style.display = 'flex';
            };

            const closeFilterPanel = () => {
                filterPanel.style.display = 'none';
            };

            const updatePanelCount = () => {
                const visibleTags = $$('.admin-dashboard-filter-tag').length;
                panelsToggle.textContent = `${visibleTags} Panels`;
            };

            filterButton.addEventListener('click', openFilterPanel);
            showPanelsArea.addEventListener('click', openFilterPanel);
            closeFilterBtn.addEventListener('click', closeFilterPanel);

            showAllBtn.addEventListener('click', () => {
                collapsedTags.classList.toggle('show');
                showAllBtn.innerHTML = collapsedTags.classList.contains('show')
                    ? 'Show Less <i class="fa-solid fa-chevron-up"></i>'
                    : 'Show All <i class="fa-solid fa-chevron-down"></i>';
            });

            filterPanel.addEventListener('click', e => {
                if (!e.target.closest('.admin-dashboard-filter-container') && e.target !== filterButton) {
                    closeFilterPanel();
                }
            });

            document.addEventListener('click', e => {
                if (e.target.classList.contains('admin-dashboard-close-tag')) {
                    e.target.parentElement.remove();
                    updatePanelCount();
                }
            });

            updatePanelCount();
        };
    </script>
</body>

</html>