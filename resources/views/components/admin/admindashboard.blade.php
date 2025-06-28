<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Added jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    @extends('layouts.app')


    <div class="admindashboard-container">
        <div class="mobile-main-container">
            <!-- Header section -->
            <div class="admindashboardcontainer-firstsection">
                @if (session()->has('admin'))
                    <h1>Hi, {{ session('admin.name') }}</h1> {{-- or session('admin.name') if available --}}
                @else
                    <h1>Hi, Guest</h1>
                @endif
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


            <div class="mobile-admin-dashboard-modal" id="mobile-admin-dashboard-modal">
                <div class="mobile-admin-dashboard-modal-content">
                    <div class="mobile-admin-dashboard-modal-header">
                        <h1>Hi, Admin name</h1>
                        <button class="mobile-admin-dashboard-close-modal-btn"
                            id="mobile-admin-dashboard-close-modal-btn">
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

            <div class="referral-triggered-view hidden" id="referralModal">
                <div class="referral-triggered-view-headersection">
                    <h3>Generate Referral Link</h3>
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828778.png" alt="Close Icon"
                        class="close-icon" id="closeModal">
                </div>
                <div class="referral-triggered-view-content">
                    <input type="text" id="referralLink" placeholder="Copy Link here">
                </div>
                <div class="referral-triggered-view-footer" id="modalFooter">
                    <button id="cancelBtn">
                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828778.png" alt="Cancel Icon"
                            class="cancel-icon">
                        Cancel
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
                            <button data-report="sc-generation-leads-approved">SC: Generation Leads Approved</button>
                            <button data-report="sem-rush">Sem Rush</button>
                        </div>
                    </div>



                    <div class="postgrad-buttongroups" id="postgrad-reports" style="display: none;">
                        <div id="postgrad-buttongroups-insideshow-id">
                            Graduate <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="dropdown-content-postgrad" id="postgrad-overallprogress">
                            <a href="#">Post Graduate</a>
                            <a href="#">Under Graduate</a>
                            <a href="#">Others</a>
                        </div>
                    </div>


                    <div class="calendar-wrapper">
                        <button id="calender-buttongroups" style="display:none"> Calendar <img
                                src="assets/images/Icons/calendar_month.png" alt=""></button>
                        <button id="download-buttongroups">Download Report</button>

                        <div class="calendar-container" style="display:none">
                            <div class="calendar-input-container">
                                <div class="calendar-date-input calendar-active" id="calendar-start-date-input">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>Start Date</span>
                                </div>
                                <div class="calendar-date-input" id="calendar-end-date-input">
                                    <span>End Date</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" style="margin-left: auto;">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                            </div>

                            <div class="calendar-header">
                                <button class="calendar-nav-btn calendar-prev-month">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                        <input type="text" id="searchinput-admindashboard" class="admin-dashboard-search-input"
                            placeholder="Search" />
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
                            <div class="admin-dashboard-filter-tag">Registration Reports <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">No of grads <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">Registration Source <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">Age ratio Reports <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">Funnel Reports <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">Destination countries <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">Cities <span
                                    class="admin-dashboard-close-tag">×</span>
                            </div>
                            <div class="admin-dashboard-filter-tag">NBFC: Generation Leads <span
                                    class="admin-dashboard-close-tag">×</span>
                            </div>
                            <div class="admin-dashboard-filter-tag">Point of entry <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">SC: Generation Leads <span
                                    class="admin-dashboard-close-tag">×</span></div>
                            <div class="admin-dashboard-filter-tag">Sem Rush <span
                                    class="admin-dashboard-close-tag">×</span></div>
                        </div>

                        <div class="admin-dashboard-divider"></div>

                        <div class="admin-dashboard-collapsed-tags" id="collapsedTags">
                            <div class="admin-dashboard-filter-tags">
                                <div class="admin-dashboard-filter-tag" id="admin-dashboard-filter-tag-city">
                                    Cities
                                    <span class="admin-dashboard-close-tag">×</span>
                                </div>
                                <div class="admin-dashboard-filter-tag" id="admin-dashboard-filter-tag-nbfc-lead">
                                    NBFC: Generation Leads
                                    <span class="admin-dashboard-close-tag">×</span>
                                </div>
                                <div class="admin-dashboard-filter-tag">
                                    Point of entry <span class="admin-dashboard-close-tag">×</span>
                                </div>
                                <div class="admin-dashboard-filter-tag" id="admin-dashboard-filter-tag-sc-lead">
                                    SC: Generation Leads
                                    <span class="admin-dashboard-close-tag">×</span>
                                </div>
                                <div class="admin-dashboard-filter-tag" id="admin-dashboard-filter-tag-semrush">
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
        </div>

        <div class="admindashboardcontainer-thirdsection">
            <div class="admindashboard-firstpart">
                <div class="reports-registeration" data-report="registration-reports">
                    <div class="reports-registeration-sectionone">
                        <p>Reports on registration</p>

                        <div style="position: relative; display: inline-block;">
                            <button id="calendar-trigger-button"
                                style="position: relative; z-index: 1;width: 100px;
                                    height: 28px;
                                    font-size: 12px;
                                    padding: 2px 6px;
                                    border-radius: 4px;border:1px solid rgba(82, 82, 82, 0.24);background:transparent;color:rgba(93, 92, 92, 1);font-weight: 500;display:flex;justify-content: space-between;align-items: center;">
                                Calendar <img src={{ asset('assets/images/stat_minus_black.png') }} alt="">
                            </button>
                            <input type="month" id="date-picker-linegraph"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                      opacity: 0; cursor: pointer; z-index: 2;">
                        </div>



                    </div>
                    <div class="reports-registeration-graph">
                        <div id="chart_div" style="width: 100%; height: 160px;"></div>
                    </div>
                </div>

                <div class="source-registeration" data-report="registration-source">
                    <p id="source-registeration-header">Source on registration</p>
                    <div class="donutregistration-chart-container">
                        <canvas id="donutRegistrationChart"></canvas>
                        <div class="donutgraphinfos" id="donutGraphInfosContainer"></div>

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
                            <div id="postgrad-buttongroups-insideshow-age-ratio-id">
                                Graduate <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="dropdown-content-postgrad" id="postgrad-ageratioprogress">
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
            <div class="admindashboard-thirdpart" data-report="funnel-reports">
                <div class="funnelreport-analyze-header">
                    <p id="funnel-analyze-header">Funnel Report</p>
                    <div class="postgrad-buttongroups" id="postgrad-funnelreports">
                        <div id="postgrad-buttongroups-insideshow-funnelreports-id">
                            Graduate <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="dropdown-content-postgrad" id="postgrad-funnelreportsprogress">
                            <a href="#" data-value="bachelors">Post Graduate</a>
                            <a href="#" data-value="masters">Under Graduate</a>
                            <a href="#" data-value="others">Others</a>
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

                        <p id="incomplete-count"> </p>
                        <p id="dummy-1"> </p>
                        <p id="dummy-2">1 </p>
                        <p id="offer-issued"> </p>
                        <p id="offer-rejected"> </p>
                        <p id="offer-accepted"> </p>

                    </div>



                </div>




            </div>
        </div>

        <div class="admindashboardcontainer-fourth-section">
            <div class="admin-dashboard-container-four">
                <div class="admin-dashboard-row">
                    <!-- Cities Section -->
                    <div class="admin-city-column" data-report="cities">
                        <div class="admin-city-section">
                            <div class="admin-city-header">
                                <div class="admin-city-title">Cities</div>
                                <div class="admin-city-filter-sort-container">
                                    <button class="admin-city-filter-btn" id="city-filter-btn">Filter <i
                                            class="fas fa-chevron-down"></i></button>
                                    <button class="admin-city-sort-btn" id="city-sort-btn">Sort <i
                                            class="fas fa-chevron-down"></i></button>
                                </div>
                            </div>
                            <table class="admin-city-table" id="city-table">
                                <thead>
                                    <tr>
                                        <th data-sort="city">City <i class="fas fa-sort"></i></th>
                                        <th data-sort="state">State <i class="fas fa-sort"></i></th>
                                        <th data-sort="female">Female <i class="fas fa-sort"></i></th>
                                        <th data-sort="male">Male <i class="fas fa-sort"></i></th>
                                        <th data-sort="total_students">No. students <i class="fas fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="city-table-body">
                                    <!-- Rows will be populated dynamically -->
                                </tbody>
                            </table>
                            <div class="admin-city-pagination">
                                <div class="admin-city-pagination-btn" id="city-prev-btn"><i
                                        class="fas fa-chevron-left"></i></div>
                                <div class="admin-city-pagination-text" id="city-pagination-text">1-10 / 30</div>
                                <div class="admin-city-pagination-btn" id="city-next-btn"><i
                                        class="fas fa-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- Countries Section -->
                    <div class="admin-desti-country-column" data-report="destination-countries">
                        <div class="admin-desti-country-section">
                            <div class="admin-desti-country-header">
                                <div class="admin-desti-country-title">Destination Countries</div>
                                <div class="admin-desti-country-filter-sort-container">
                                    <button class="admin-desti-country-filter-btn" id="country-filter-btn">Filter <i
                                            class="fas fa-chevron-down"></i></button>
                                    <!-- <button class="admin-desti-country-sort-btn" id="country-sort-btn">Sort <i class="fas fa-chevron-down"></i></button> -->
                                </div>
                            </div>
                            <table class="admin-desti-country-table" id="country-table">
                                <thead>
                                    <tr>
                                        <th data-sort="country">Country <i class="fas fa-sort"></i></th>
                                        <th data-sort="female">Female <i class="fas fa-sort"></i></th>
                                        <th data-sort="male">Male <i class="fas fa-sort"></i></th>
                                        <th data-sort="total_students">No. students <i class="fas fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="country-table-body">
                                    <!-- Rows will be populated dynamically -->
                                </tbody>
                            </table>
                            <div class="admin-desti-country-pagination">
                                <div class="admin-desti-country-pagination-btn" id="country-prev-btn"><i
                                        class="fas fa-chevron-left"></i></div>
                                <div class="admin-desti-country-pagination-text" id="country-pagination-text">1-10 / 0
                                </div>
                                <div class="admin-desti-country-pagination-btn" id="country-next-btn"><i
                                        class="fas fa-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!---fifth section-->

            <div class="admindashboardcontainer-fifth-section">
                <div class="dashboard-row-bar-chart">
                    <!-- NBFC Lead Generation -->
                    <div id="nbfc-lead-chart_container" data-report="nbfc-generation-leads">
                        <div class="nbfc-lead-header">
                            <h2 class="nbfc-lead-title">NBFCs: Lead Generation</h2>
                            <div class="nbfc-lead-converted-dropdown">
                                <select id="convertedDropdown">
                                    <option selected hidden>Filter</option>
                                    <option value="converted">Converted</option>
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
                        <!-- <div class="nbfc-lead-weeks-info">23 in 2 weeks</div> -->
                        <div id="nbfc-lead-chart_div" style="width: 100%; height: 170px;"></div>
                        <div class="nbfc-lead-pagination">
                            <button class="nbfc-lead-prev-btn" id="nbfc-lead-prev-btn"><i
                                    class="fas fa-chevron-left"></i></button>
                            <span class="nbfc-lead-page-range" id="nbfc-lead-page-range">1 - 5</span>
                            <span>/</span>
                            <span class="nbfc-lead-total-items" id="nbfc-lead-total-items">11</span>
                            <button class="nbfc-lead-next-btn" id="nbfc-lead-next-btn"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <!-- Student Counsellors -->
                    <div class="sc-lead-container" data-report="sc-generation-leads">
                        <div class="sc-lead-header">
                            <h3 class="sc-lead-title">Student Counsellors: Lead Generation</h3>
                            <select class="sc-lead-select" id="scLeadDropdown">
                                <option selected disabled hidden>Filter</option>
                                <option value="converted">Converted</option>
                            </select>
                        </div>
                        <div class="sc-lead-legend">
                            <div>Referral No. Vs</div>
                            <div class="sc-lead-legend-item">
                                <div class="sc-lead-legend-color" style="background-color: #d3b8f0;"></div>
                                <span>No. Of Leads</span>
                            </div>
                        </div>
                        <div class="sc-lead-chart-wrapper">
                            <canvas id="leadChart" style="height: 170px;"></canvas>
                        </div>
                        <div class="sc-lead-pagination">
                            <button class="sc-lead-prev-btn" id="sc-lead-prev-btn"><i
                                    class="fas fa-chevron-left"></i></button>
                            <span class="sc-lead-page-range" id="sc-lead-page-range">1 - 2</span>
                            <span>/</span>
                            <span class="sc-lead-total-items" id="sc-lead-total-items">2</span>
                            <button class="sc-lead-next-btn" id="sc-lead-next-btn"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>






                <div class="admindashboardcontainer-sixth-section">
                    <div class="sc-lead-container" data-report="sc-generation-leads-approved">
                        <div class="sc-lead-header">
                            <h3 class="sc-lead-title">Student Counsellors: Approved Profiles</h3>
                            <select class="sc-lead-select">
                                <option>Approved</option>
                            </select>
                        </div>
                        <div class="sc-lead-legend">
                            <div class="sc-lead-legend-item">
                                <div class="sc-lead-legend-color" style="background-color: #d3b8f0;"></div>
                                <span>No. Of Approved Profiles</span>
                            </div>
                        </div>
                        <div class="sc-lead-chart-wrapper">
                            <canvas id="approvedProfileChart" style="height: 170px;"></canvas>
                        </div>
                        <div class="sc-lead-pagination">
                            <button class="sc-lead-prev-btn" id="sc-approved-prev-btn"><i
                                    class="fas fa-chevron-left"></i></button>
                            <span class="sc-lead-page-range" id="sc-approved-page-range">1 - 2</span>
                            <span>/</span>
                            <span class="sc-lead-total-items" id="sc-approved-total-items">2</span>
                            <button class="sc-lead-next-btn" id="sc-approved-next-btn"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <div class="point-entry" data-report="point-of-entry">
                        <div class="point-entry-donut">
                            <div class="point-entry-title">Point of entry</div>
                            <div class="point-entry-chart-container">
                                <div class="point-entry-chart-wrapper">
                                    <canvas id="donutChart" width="103" height="103"
                                        style="display: block; box-sizing: border-box; height: 103px; width: 103px;"></canvas>
                                </div>
                                <div class="point-entry-legend-container">
                                    <!-- <div class="point-entry-legend">
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
                    </div> -->
                                </div>
                            </div>
                        </div>

                        <!-- <div class="point-entry-dashboard">
             <div class="point-entry-dashboard-image">
                 <img src="assets/images/semrush-seo.png" alt="SEMRUSH Logo">
             </div>
          </div> -->


                    </div>

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
        google.charts.load('current', {
            packages: ['corechart', 'bar', 'line']
        });

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
                initializeDonutGraphSource();

                fetchReferralAcceptedCounts();
                initializePaginationAndFilters();
                updateProfileCompletionByGender();
                initializeCitiesTable();
                initializeCountriesTable();
                initializePostgradDropdowns();
                updateVisibleReportsFromFilters();

                const isMobileView = document.querySelector('.admindashboardcontainer-secondsection-mobile');
                if (isMobileView) {
                    initializeFilterPanel();
                }
            } catch (error) {
                console.error('Initialization error:', error);
            }
        });

        // Chart Initialization
        const initializeCharts = () => {
            // Centralize Google Charts callback to avoid multiple setOnLoad calls
            google.charts.setOnLoadCallback(() => {
                drawNBFCChart();

                const datePicker = document.getElementById('date-picker-linegraph');
                const selectedDateText = document.getElementById('selected-date');

                initializeRegistrationLineGraph(); // No arguments = default/overall

                if (datePicker) {
                    datePicker.addEventListener('change', function() {
                        const [year, month] = this.value.split('-');
                        const button = document.getElementById('calendar-trigger-button');

                        // Optional: show selected month/year in the button
                        if (button) {
                            button.innerHTML =
                                `${getMonthName(month)} ${year} <img src="assets/images/Icons/calendar_month.png" alt="">`;
                        }

                        if (selectedDateText) {
                            selectedDateText.textContent = `Selected: ${month}/${year}`;
                        }

                        initializeRegistrationLineGraph(month, year);
                    });
                }

                // Utility function
                function getMonthName(monthNumber) {
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ];
                    return months[parseInt(monthNumber, 10) - 1];
                }

            });

            // initializeDonutGraphAgeRatio();
            initializeNewDonutChart();
            initializeLeadChart();
            initializeLeadSuccessChart();
        };

        const button = document.querySelector(".calendar-wrapper #download-buttongroups");
        const mobButton = document.querySelector(".admin-dashboard-download-button");

        if (button) {
            button.addEventListener('click', () => {
                window.location.href = '/download-user-report';
            });
        } else {
            console.error("Desktop download button not found!");
        }

        if (mobButton) {
            mobButton.addEventListener('click', () => {
                window.location.href = '/download-user-report';
            });
        } else {
            console.error("Mobile download button not found!");
        }


        // Registration Line Graph with API Data
        const initializeRegistrationLineGraph = (month = null, year = null) => {
            const chartDiv = document.getElementById('chart_div');
            if (!chartDiv) return console.error('chart_div not found');

            const requestBody = (month && year) ? {
                month: String(month).padStart(2, '0'),
                year: String(year)
            } : {};

            fetch('/reports-on-generation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(requestBody)
                })
                .then(response => response.json())
                .then(data => {
                    // console.log('✅ Actual data from API:', data);

                    if (!data.days_of_week || !data.registration_counts || data.days_of_week.length !== data
                        .registration_counts.length) {
                        throw new Error('Invalid API response');
                    }

                    const dataTable = new google.visualization.DataTable();
                    dataTable.addColumn('string', 'Day');
                    dataTable.addColumn('number', 'Registrations');
                    dataTable.addColumn({
                        type: 'string',
                        role: 'annotation'
                    });

                    const maxCount = Math.max(...data.registration_counts);
                    const rows = data.days_of_week.map((day, i) => [
                        day,
                        data.registration_counts[i],
                        data.registration_counts[i] === maxCount ? String(maxCount) : null
                    ]);

                    dataTable.addRows(rows);

                    const view = new google.visualization.DataView(dataTable);
                    view.setColumns([0, 1, 2]);

                    const options = {
                        maintainAspectRatio: false,
                        hAxis: {
                            title: 'Day of the Week',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        vAxis: {
                            title: 'Registrations',
                            viewWindow: {
                                min: 0,
                                max: Math.max(maxCount + 10, 50)
                            },
                            textStyle: {
                                color: '#333'
                            }
                        },
                        annotations: {
                            alwaysOutside: true,
                            textStyle: {
                                color: '#000',
                                fontSize: 12
                            }
                        },
                        pointSize: 5,
                        series: {
                            0: {
                                lineWidth: 2,
                                pointShape: 'circle',
                                color: 'rgb(163, 171, 189)'
                            }
                        },
                        legend: 'none',
                        chartArea: {
                            width: '80%',
                            height: '70%'
                        }
                    };

                    const chart = new google.visualization.LineChart(chartDiv);
                    chart.draw(view, options);
                })
                .catch(error => {
                    console.error('Error fetching Reports on Registration data:', error);
                });
        };


        //Undergrad and Postgrad Chart
        // Function to update profile completion by gender and degree
        const updateProfileCompletionByGender = () => {
            const undergradTotal = $('.totalundergrads-info h1');
            const undergradFemale = $('.totalundergrads-info p:nth-child(2) span');
            const undergradMale = $('.totalundergrads-info p:nth-child(3) span');
            const undergradOthers = $('.totalundergrads-info p:nth-child(4) span');

            const postgradTotal = $('.totalpostgrads-info h1');
            const postgradFemale = $('.totalpostgrads-info p:nth-child(2) span');
            const postgradMale = $('.totalpostgrads-info p:nth-child(3) span');
            const postgradOthers = $('.totalpostgrads-info p:nth-child(4) span');

            // Fetch data from API (POST request)
            fetch('/getprofilecompletionbygender', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content') // Required for POST in Laravel
                    },
                    body: JSON.stringify({}) // Empty body; adjust if API requires data
                })
                .then(response => {
                    // console.log('Raw response:', response);
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    // console.log('Fetched Profile Completion by Gender data:', data);

                    // Validate the API response structure
                    if (!data.success || !data.data || typeof data.data !== 'object' ||
                        !data.data.degree_summary || typeof data.data.degree_summary !== 'object') {
                        // console.log('Validation failed. Data structure:', data);
                        throw new Error('Invalid API response: Missing or invalid data structure');
                    }

                    // Extract data for Undergrads (UG)
                    const ugData = data.data.degree_summary.UG;
                    const ugTotal = ugData.total || 0;
                    const ugFemale = ugData.female || 0;
                    const ugMale = ugData.male || 0;
                    const ugOthers = ugData.other || (ugTotal - ugFemale -
                        ugMale); // Fallback to total if others not provided

                    // Extract data for Postgrads (PG)
                    const pgData = data.data.degree_summary.PG;
                    const pgTotal = pgData.total || 0;
                    const pgFemale = pgData.female || 0;
                    const pgMale = pgData.male || 0;
                    const pgOthers = pgData.other || (pgTotal - pgFemale -
                        pgMale); // Fallback to total if others not provided

                    // Update Undergrads
                    undergradTotal.textContent = ugTotal;
                    undergradFemale.textContent = ugFemale;
                    undergradMale.textContent = ugMale;
                    undergradOthers.textContent = ugOthers;

                    // Update Postgrads
                    postgradTotal.textContent = pgTotal;
                    postgradFemale.textContent = pgFemale;
                    postgradMale.textContent = pgMale;
                    postgradOthers.textContent = pgOthers;
                })
                .catch(error => {
                    console.error('Error fetching Profile Completion by Gender data:', error);
                    // Fallback to static data if API fails
                    undergradTotal.textContent = 60;
                    undergradFemale.textContent = 20;
                    undergradMale.textContent = 20;
                    undergradOthers.textContent = 20;

                    postgradTotal.textContent = 150;
                    postgradFemale.textContent = 20;
                    postgradMale.textContent = 20;
                    postgradOthers.textContent = 20;

                    // console.log('Using fallback data: Undergrads: 60 (20, 20, 20), Postgrads: 150 (20, 20, 20)');
                });
        };


        const initializeDonutGraphSource = () => {
            fetch('/api/sourceregister', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const adds = data["ADDS"]?.count || 0;
                    const organic = data["Organic"]?.count || 0;
                    const scReferral = data["SC Referral"]?.count || 0;

                    const total = adds + organic + scReferral;

                    const addsPercent = total ? ((adds / total) * 100).toFixed(1) : 0;
                    const organicPercent = total ? ((organic / total) * 100).toFixed(1) : 0;
                    const scReferralPercent = total ? ((scReferral / total) * 100).toFixed(1) : 0;

                    // Update chart
                    const ctx = document.getElementById('donutRegistrationChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['ADDS', 'Organic', 'SC Referral'],
                            datasets: [{
                                data: [addsPercent, organicPercent, scReferralPercent],
                                backgroundColor: [
                                    'rgba(111, 37, 206, 1)',
                                    'rgba(181, 142, 229, 1)',
                                    'rgba(226, 211, 245, 1)'
                                ],
                                borderWidth: 0,
                                cutout: '30%'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.label}: ${context.raw}%`;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    const sources = [{
                            name: 'ADDS',
                            color: 'rgba(111, 37, 206, 1)',
                            count: adds.toLocaleString(),
                            percent: `${addsPercent}%`
                        },
                        {
                            name: 'Organic',
                            color: 'rgba(181, 142, 229, 1)',
                            count: organic.toLocaleString(),
                            percent: `${organicPercent}%`
                        },
                        {
                            name: 'SC Referral',
                            color: 'rgba(226, 211, 245, 1)',
                            count: scReferral.toLocaleString(),
                            percent: `${scReferralPercent}%`
                        }
                    ];

                    const container = document.getElementById('donutGraphInfosContainer');
                    container.innerHTML = ''; // Clear existing content

                    sources.forEach(source => {
                        const div = document.createElement('div');
                        div.className = 'graphviewofregistrations';
                        div.innerHTML = `
                    <div class="graphviewofregistrations-firstpart">
                        <div class="points" style="background-color: ${source.color}; width: 11px; height: 11px;"></div>
                        <p>${source.name}</p>
                    </div>
                    <div class="graphviewofregistrations-secondpart">
                        <p>${source.count}</p>
                        <p id="donutRegistrationChart-percentage">${source.percent}</p>
                    </div>
                `;
                        container.appendChild(div);
                    });
                })
                .catch(error => {
                    console.error('Error fetching /sourceregister:', error);
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
                        backgroundColor: ['rgba(111, 37, 206, 1)', 'rgba(167, 121, 224, 1)',
                            'rgba(203, 176, 237, 1)', 'rgba(226, 211, 245, 1)'
                        ],
                        borderWidth: 0,
                        cutout: '50%'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        };

        // Function to fetch and display cities data with sorting, filtering, and pagination
        function initializeCitiesTable() {
            const tableBody = $('#city-table-body');
            const prevBtn = $('#city-prev-btn');
            const nextBtn = $('#city-next-btn');
            const paginationText = $('#city-pagination-text');
            const filterBtn = $('#city-filter-btn');
            const sortBtn = $('#city-sort-btn');

            let currentPage = 1;
            const itemsPerPage = 10;
            let fullData = [];
            let filteredData = [];
            let sortColumn = 'city';
            let sortDirection = 'asc';
            let filterCity = '';
            let filterState = '';

            // Fetch data from API
            fetch('/city-stats', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    // console.log('Raw response:', response);
                    if (!response.ok) {
                        // console.log('Response status:', response.status, 'Status text:', response.statusText);
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log('Fetched Cities data:', data);

                    // Validate the API response structure
                    if (!Array.isArray(data)) {
                        // console.log('Validation failed: Data is not an array', data);
                        throw new Error('Invalid API response: Expected an array of city data');
                    }

                    // Process and normalize data
                    fullData = data.map(item => ({
                        city: item.city || 'N/A',
                        state: item.state || 'N/A',
                        female: Number(item.female) || 0, // Convert to number
                        male: Number(item.male) || 0, // Convert to number
                        total_students: Number(item.total) || 0 // Use total as total_students
                    }));
                    filteredData = [...fullData];
                    updateTable(fullData.length);
                })
                .catch(error => {
                    console.error('Error fetching Cities data:', error);
                    fullData = [];
                    filteredData = [];
                    updateTable(0);
                    alert('Failed to fetch cities data. Please check the API or try again later.');
                });

            // Function to update the table based on current page, sort, and filter
            function updateTable(totalItems) {
                // Apply filter
                filteredData = fullData.filter(item => {
                    return filterCity ? item.city.toLowerCase().includes(filterCity.toLowerCase()) : true;
                });


                // Apply sort
                filteredData.sort((a, b) => {
                    const valueA = a[sortColumn];
                    const valueB = b[sortColumn];
                    if (typeof valueA === 'string') {
                        return sortDirection === 'asc' ?
                            valueA.localeCompare(valueB) :
                            valueB.localeCompare(valueA);
                    }
                    return sortDirection === 'asc' ?
                        valueA - valueB :
                        valueB - valueA;
                });

                // Calculate pagination
                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = Math.min(startIdx + itemsPerPage, filteredData.length);
                const paginatedData = filteredData.slice(startIdx, endIdx);

                // Log the paginated data for debugging
                // console.log('Paginated table data:', paginatedData);

                // Update table body
                tableBody.innerHTML = '';
                if (paginatedData.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="5">No data available</td></tr>';
                } else {
                    paginatedData.forEach(item => {
                        const row = `
                    <tr>
                        <td>${item.city}</td>
                        <td>${item.state}</td>
                        <td>${item.female}</td>
                        <td>${item.male}</td>
                        <td class="admin-city-data-value" data-value="${item.total_students}">${item.total_students}</td>
                    </tr>
                `;
                        tableBody.innerHTML += row;
                    });
                }

                // Update pagination text
                paginationText.textContent = `${startIdx + 1}-${endIdx} / ${totalItems}`;
                prevBtn.style.visibility = currentPage === 1 ? 'hidden' : 'visible';
                nextBtn.style.visibility = endIdx >= filteredData.length ? 'hidden' : 'visible';
            }

            // Pagination event listeners
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable(fullData.length);
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentPage < Math.ceil(filteredData.length / itemsPerPage)) {
                    currentPage++;
                    updateTable(fullData.length);
                }
            });

            // Sorting event listeners
            document.querySelectorAll('#city-table thead th').forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.getAttribute('data-sort');
                    if (sortColumn === column) {
                        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        sortColumn = column;
                        sortDirection = 'asc';
                    }
                    currentPage = 1; // Reset to first page on sort
                    updateTable(fullData.length);
                });
            });

            // Filtering (basic implementation)
            filterBtn.addEventListener('click', () => {
                const cityInput = prompt('Filter by City (leave empty to clear):', filterCity);
                // const stateInput = prompt('Filter by State (leave empty to clear):', filterState);

                filterCity = cityInput || '';
                // filterState = stateInput || '';
                currentPage = 1; // Reset to first page on filter
                updateTable(fullData.length);
            });

            // Sorting button (optional, can be used for custom sorting logic if needed)
            sortBtn.addEventListener('click', () => {
                alert('Click on column headers to sort!');
            });
        };

        const initializeCountriesTable = () => {
            // Utility functions for DOM queries (assumed to be available from your codebase)
            const $ = (selector, context = document) => context.querySelector(selector);
            const $$ = (selector, context = document) => Array.from(context.querySelectorAll(selector));

            // DOM elements
            const tableBody = $('#country-table-body');
            const prevBtn = $('#country-prev-btn');
            const nextBtn = $('#country-next-btn');
            const paginationText = $('#country-pagination-text');
            const filterBtn = $('#country-filter-btn'); // Filter button is now uncommented in HTML

            // State variables
            let currentPage = 1;
            const itemsPerPage = 6; // Matches your original setting
            let fullData = [];
            let filteredData = [];
            let filterCountry = ''; // Store the filter value for the country column

            // Validate DOM elements
            const validateElements = () => {
                const elements = [{
                        element: tableBody,
                        id: 'country-table-body'
                    },
                    {
                        element: prevBtn,
                        id: 'country-prev-btn'
                    },
                    {
                        element: nextBtn,
                        id: 'country-next-btn'
                    },
                    {
                        element: paginationText,
                        id: 'country-pagination-text'
                    },
                    {
                        element: filterBtn,
                        id: 'country-filter-btn'
                    }
                ];

                elements.forEach(({
                    element,
                    id
                }) => {
                    if (!element) {
                        console.warn(`Element with ID '${id}' not found in the DOM.`);
                    }
                });

                return tableBody && prevBtn && nextBtn && paginationText && filterBtn;
            };

            if (!validateElements()) {
                console.error('Required DOM elements for Countries Table are missing. Initialization aborted.');
                return;
            }

            // Apply filtering based on the country name
            const applyFilter = () => {
                filteredData = fullData.filter(item => {
                    return filterCountry ?
                        item.country.toLowerCase().includes(filterCountry.toLowerCase()) :
                        true;
                });
                currentPage = 1; // Reset to first page after filtering
                updateTable(filteredData.length);
            };

            // Update the table with paginated data
            const updateTable = (totalItems) => {
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                currentPage = Math.min(currentPage, Math.max(1, totalPages));

                const start = (currentPage - 1) * itemsPerPage;
                const end = Math.min(start + itemsPerPage, filteredData.length);
                const pageData = filteredData.slice(start, end);

                tableBody.innerHTML = '';
                if (pageData.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="4">No data available</td></tr>';
                } else {
                    pageData.forEach(item => {
                        tableBody.innerHTML += `
                    <tr>
                        <td>${item.country}</td>
                        <td>${item.female}</td>
                        <td>${item.male}</td>
                        <td class="admin-desti-country-data-value" data-value="${item.total_students}">${item.total_students}</td>
                    </tr>
                `;
                    });
                }

                // Update pagination text in the format "start-end / total"
                paginationText.textContent = `${start + 1}-${end} / ${totalItems}`;
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages || totalPages === 0;
            };

            // Fetch data from the API
            fetch('/dest-countries', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') || ''
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status} - ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log('Fetched Destination Countries data:', JSON.stringify(data, null, 2));

                    // Validate the API response structure (assuming it could be an array or an object with a 'data' property)
                    let countriesData = data;
                    if (data.data && Array.isArray(data.data)) {
                        countriesData = data.data; // Handle { data: [...] } structure
                    } else if (!Array.isArray(data)) {
                        throw new Error('Invalid API response: Expected an array of country data');
                    }

                    // Map the data to ensure all fields are present
                    fullData = countriesData.map(item => ({
                        country: item.country || 'N/A',
                        female: Number(item.female) || 0,
                        male: Number(item.male) || 0,
                        total_students: Number(item.total_students) || 0
                    }));
                    filteredData = [...fullData];
                    updateTable(fullData.length);
                })
                .catch(error => {
                    console.error('Error fetching Destination Countries data:', error);
                    // Fallback to hardcoded data for testing
                    fullData = [{
                            country: "Norway",
                            female: 90,
                            male: 40,
                            total_students: 130
                        },
                        {
                            country: "USA",
                            female: 50,
                            male: 40,
                            total_students: 90
                        },
                        {
                            country: "Canada",
                            female: 40,
                            male: 30,
                            total_students: 70
                        },
                        {
                            country: "UK",
                            female: 20,
                            male: 10,
                            total_students: 30
                        },
                        {
                            country: "Germany",
                            female: 15,
                            male: 25,
                            total_students: 40
                        },
                        {
                            country: "France",
                            female: 10,
                            male: 5,
                            total_students: 15
                        },
                        {
                            country: "Australia",
                            female: 25,
                            male: 20,
                            total_students: 45
                        },
                        {
                            country: "Japan",
                            female: 30,
                            male: 15,
                            total_students: 45
                        },
                        {
                            country: "India",
                            female: 60,
                            male: 50,
                            total_students: 110
                        },
                        {
                            country: "Brazil",
                            female: 35,
                            male: 25,
                            total_students: 60
                        }
                    ];
                    filteredData = [...fullData];
                    updateTable(fullData.length);
                    alert(
                        'Failed to fetch destination countries data. Using hardcoded data for testing. Please check the API.'
                    );
                });

            // Pagination event listeners
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable(filteredData.length);
                }
            });

            nextBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable(filteredData.length);
                }
            });

            filterBtn.addEventListener('click', () => {
                const userInput = prompt('Filter by Country (leave empty to clear filter):', filterCountry);
                filterCountry = userInput ? userInput.trim() : '';
                applyFilter();

            });
            // Sort state
            let sortColumn = '';
            let sortAscending = true;

            // Sorting event listener for table headers
            $$('th[data-sort]').forEach(th => {
                th.addEventListener('click', () => {
                    const column = th.getAttribute('data-sort');
                    if (sortColumn === column) {
                        sortAscending = !sortAscending; // toggle sort direction
                    } else {
                        sortColumn = column;
                        sortAscending = true; // default ascending when new column is selected
                    }

                    filteredData.sort((a, b) => {
                        const valA = a[column];
                        const valB = b[column];

                        // String sort for 'country', numeric for others
                        if (typeof valA === 'string') {
                            return sortAscending ?
                                valA.localeCompare(valB) :
                                valB.localeCompare(valA);
                        } else {
                            return sortAscending ?
                                valA - valB :
                                valB - valA;
                        }
                    });

                    // Optional: Update sort icons
                    $$('th[data-sort] i').forEach(icon => {
                        icon.className = 'fas fa-sort'; // reset
                    });
                    const icon = th.querySelector('i');
                    if (icon) {
                        icon.className = sortAscending ? 'fas fa-sort-up' : 'fas fa-sort-down';
                    }

                    updateTable(filteredData.length);
                });
            });

        };

        document.addEventListener('DOMContentLoaded', () => {
            initializeCountriesTable();
        });


        // Point of Entry Donut Chart with API Data
        const initializeNewDonutChart = () => {
            const ctx = $('#donutChart')?.getContext('2d');
            if (!ctx) return console.error('donutChart canvas not found');

            // Fetch data from API
            fetch('/getstatusofusersadmin', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    // console.log('Fetched point of entry data:', data);

                    // Extract labels and values from the API response
                    const labels = data.categories || [];
                    const values = data.counts || [];
                    const colors = ['#6F25CE', '#8863C9', '#A894D9', '#C5B6E5', '#E2D9F2'].slice(0, labels
                        .length); // Default colors

                    // Log the extracted data for debugging
                    // console.log('Chart labels:', labels);
                    // console.log('Chart values:', values);
                    // console.log('Chart colors:', colors);

                    // Validate data
                    if (labels.length !== values.length) {
                        throw new Error('Mismatch between categories and counts');
                    }

                    // Generate the chart
                    const chart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: colors,
                                borderWidth: 0,
                                cutout: '70%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });

                    // Generate and update the legend
                    generatePointEntryLegend(labels, colors);
                })
                .catch(error => {
                    console.error('Error fetching point of entry data:', error);
                    // Fallback to static data if API fails
                    const fallbackData = {
                        categories: ['youtube', 'Google', 'Friend', 'Others'],
                        counts: [45, 20, 15, 10, 10]
                    };
                    const labels = fallbackData.categories;
                    const values = fallbackData.counts;
                    const colors = ['#6F25CE', '#8863C9', '#A894D9', '#C5B6E5', '#E2D9F2'].slice(0, labels.length);

                    // console.log('Using fallback data:', fallbackData);

                    // Generate the chart with fallback data
                    const chart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: colors,
                                borderWidth: 0,
                                cutout: '70%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });

                    // Generate and update the legend with fallback data
                    generatePointEntryLegend(labels, colors);
                });
        };

        // Generate Legend Dynamically
        const generatePointEntryLegend = (labels, colors) => {
            const legendContainer = $('.point-entry-legend-container');
            if (!legendContainer) return console.error('Legend container not found');

            // Clear existing legend
            legendContainer.innerHTML = '';

            // Create two columns for the legend
            const column1 = document.createElement('div');
            column1.className = 'point-entry-legend';
            const column2 = document.createElement('div');
            column2.className = 'point-entry-legend';

            labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.className = 'point-entry-legend-item';

                const colorBox = document.createElement('div');
                colorBox.className = 'point-entry-legend-color';
                colorBox.style.backgroundColor = colors[index];

                const labelSpan = document.createElement('span');
                labelSpan.textContent = label;

                legendItem.appendChild(colorBox);
                legendItem.appendChild(labelSpan);

                // Distribute items into two columns
                if (index < Math.ceil(labels.length / 2)) {
                    column1.appendChild(legendItem);
                } else {
                    column2.appendChild(legendItem);
                }
            });

            legendContainer.appendChild(column1);
            legendContainer.appendChild(column2);
        };


        // NBFC Chart with API Data and Pagination
        const drawNBFCChart = () => {
            const chartDiv = document.getElementById('nbfc-lead-chart_div');
            if (!chartDiv) return console.error('nbfc-lead-chart_div not found');

            let currentPage = 1;
            const itemsPerPage = 5;
            let fullData = [];

            const prevBtn = document.getElementById('nbfc-lead-prev-btn');
            const nextBtn = document.getElementById('nbfc-lead-next-btn');
            const pageRange = document.getElementById('nbfc-lead-page-range');
            const totalItems = document.getElementById('nbfc-lead-total-items');
            const convertedDropdown = document.getElementById('convertedDropdown');

            const fetchAndRender = () => {
                const isConverted = convertedDropdown?.value === 'converted';
                const query = isConverted ? '?converted=true' : '';

                fetch(`/nbfc-lead-gens${query}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (!data.nbfcs || !Array.isArray(data.nbfcs) ||
                            !data.lead_counts || !Array.isArray(data.lead_counts) ||
                            !data.time_taken || !Array.isArray(data.time_taken) ||
                            data.nbfcs.length !== data.lead_counts.length ||
                            data.nbfcs.length !== data.time_taken.length) {
                            throw new Error('Invalid API response');
                        }

                        fullData = [
                            ['NBFC', 'No. Of Leads', 'Time Taken']
                        ];
                        for (let i = 0; i < data.nbfcs.length; i++) {
                            fullData.push([data.nbfcs[i], data.lead_counts[i], data.time_taken[i]]);
                        }

                        totalItems.textContent = fullData.length - 1;
                        currentPage = 1;
                        updateChart();
                    })
                    .catch(error => {
                        console.error('Error fetching NBFC lead generation data:', error);
                        fullData = [
                            ['NBFC', 'No. Of Leads', 'Time Taken'],
                            ['ICICI', 55, 67],
                            ['Baroda', 65, 45],
                            ['AXIS', 60, 80],
                            ['SBI', 90, 50],
                            ['Canara', 45, 48],
                            ['HDFC', 75, 60]
                        ];
                        totalItems.textContent = fullData.length - 1;
                        currentPage = 1;
                        updateChart();
                    });
            };

            // Add dropdown listener
            convertedDropdown.addEventListener('change', () => {
                fetchAndRender();
            });

            const updateChart = () => {
                const startIdx = (currentPage - 1) * itemsPerPage + 1;
                const endIdx = Math.min(startIdx + itemsPerPage - 1, fullData.length - 1);
                const paginatedData = [fullData[0], ...fullData.slice(startIdx, endIdx + 1)];

                const dataTable = google.visualization.arrayToDataTable(paginatedData);
                const options = {
                    width: '100%',
                    height: 170,
                    colors: ['#E6D5F5', '#6C3EE8'],
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
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
                    bar: {
                        groupWidth: '60%'
                    },
                    backgroundColor: 'transparent',
                    chartArea: {
                        width: '90%',
                        height: '70%'
                    }
                };

                const chart = new google.visualization.ColumnChart(chartDiv);
                chart.draw(dataTable, options);

                pageRange.textContent = `${startIdx} - ${endIdx}`;
            };

            // Pagination button listeners
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateChart();
                }
            });

            nextBtn.addEventListener('click', () => {
                const maxPage = Math.ceil((fullData.length - 1) / itemsPerPage);
                if (currentPage < maxPage) {
                    currentPage++;
                    updateChart();
                }
            });

            // Dropdown listener


            // Initial fetch
            fetchAndRender();
        };


        const dropdown = document.getElementById('convertedDropdown');

        dropdown.addEventListener('change', function() {
            if (this.value === 'converted') {
                this.selectedIndex = 1; // Show "Filter" again
            }
        });

        // Optional: Reset dropdown on focus so that "Filter" is always shown at top
        dropdown.addEventListener('focus', function() {
            this.selectedIndex = 0;
        });

        // Lead Chart with API Data and Pagination
        let leadChartInstance = null; // Track the current chart instance

        const initializeLeadChart = (converted = false) => {
            const ctx = $('#leadChart')?.getContext('2d');
            if (!ctx) return console.error('leadChart canvas not found');

            let currentPage = 1;
            const itemsPerPage = 5;
            let fullLabels = [];
            let fullData = [];
            const prevBtn = $('#sc-lead-prev-btn');
            const nextBtn = $('#sc-lead-next-btn');
            const pageRange = $('#sc-lead-page-range');
            const totalItems = $('#sc-lead-total-items');

            // Use different URLs based on converted value
            const url = converted ? '/sc-lead-gens?converted=true' : '/sc-lead-gens';

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (!data.student_counsellors || !Array.isArray(data.student_counsellors) ||
                        !data.lead_counts || !Array.isArray(data.lead_counts) ||
                        data.student_counsellors.length !== data.lead_counts.length) {
                        throw new Error('Invalid API response: Mismatched or missing data arrays');
                    }

                    fullLabels = data.student_counsellors;
                    fullData = data.lead_counts;
                    totalItems.textContent = fullLabels.length;
                    updateChart();

                    prevBtn.onclick = () => {
                        if (currentPage > 1) {
                            currentPage--;
                            updateChart();
                        }
                    };

                    nextBtn.onclick = () => {
                        if (currentPage < Math.ceil(fullLabels.length / itemsPerPage)) {
                            currentPage++;
                            updateChart();
                        }
                    };
                })
                .catch(error => {
                    console.error('Error fetching lead generation data:', error);
                    fullLabels = ['Fallback1', 'Fallback2'];
                    fullData = [5, 10];
                    totalItems.textContent = fullLabels.length;
                    updateChart();
                });

            function updateChart() {
                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = Math.min(startIdx + itemsPerPage, fullLabels.length);
                const paginatedLabels = fullLabels.slice(startIdx, endIdx);
                const paginatedData = fullData.slice(startIdx, endIdx);

                // Destroy previous chart if it exists
                if (leadChartInstance) {
                    leadChartInstance.destroy();
                }

                leadChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: paginatedLabels,
                        datasets: [{
                            label: 'No. Of Leads',
                            data: paginatedData,
                            backgroundColor: '#d3b8f0',
                            barThickness: 11
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
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        family: 'Poppins',
                                        size: 12
                                    },
                                    color: '#5D5C5C'
                                }
                            }
                        }
                    }
                });

                pageRange.textContent = `${startIdx + 1} - ${endIdx}`;
            }
        };

        // On load (default – no ?converted param)
        initializeLeadChart(false);

        // Dropdown handler
        const scDropdown = document.getElementById('scLeadDropdown');

        scDropdown.addEventListener('change', function() {
            const isConverted = this.value === 'converted';

            initializeLeadChart(isConverted);


        });

        // Optional: reset to default on focus
        scDropdown.addEventListener('focus', function() {
            this.selectedIndex = 0;
        });



        const initializeLeadSuccessChart = () => {
            const ctx = $('#approvedProfileChart')?.getContext('2d');
            if (!ctx) return console.error('approvedProfileChart canvas not found');

            let currentPage = 1;
            const itemsPerPage = 5; // Set to 5 for scalability
            let fullLabels = [];
            let fullData = [];
            const prevBtn = $('#sc-approved-prev-btn');
            const nextBtn = $('#sc-approved-next-btn');
            const pageRange = $('#sc-approved-page-range');
            const totalItems = $('#sc-approved-total-items');

            // Fetch data from API
            fetch('/referralacceptedcounts', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    // console.log('Fetched SC users approved profiles data:', data);

                    // Validate the API response structure
                    if (!data || typeof data !== 'object') {
                        throw new Error('Invalid API response: Expected object');
                    }

                    // Store the full dataset
                    fullLabels = Object.keys(data); // SC Referral Codes
                    fullData = Object.values(data); // Approved Counts

                    // Update total items
                    totalItems.textContent = fullLabels.length;

                    // Draw the initial chart with the first page
                    updateChart();

                    // Add event listeners for pagination
                    prevBtn.addEventListener('click', () => {
                        if (currentPage > 1) {
                            currentPage--;
                            updateChart();
                        }
                    });

                    nextBtn.addEventListener('click', () => {
                        if (currentPage < Math.ceil(fullLabels.length / itemsPerPage)) {
                            currentPage++;
                            updateChart();
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching SC users approved profiles data:', error);
                    // Fallback to static data if API fails
                    // fullLabels = ['SCREF87324409', 'SCREF87324468', 'SCREF75333418'];
                    // fullData = [3, 1, 0];

                    // Update total items
                    totalItems.textContent = fullLabels.length;

                    // Draw the chart with fallback data
                    updateChart();
                });

            // Function to update the chart based on the current page
            function updateChart() {
                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = Math.min(startIdx + itemsPerPage, fullLabels.length);
                const paginatedLabels = fullLabels.slice(startIdx, endIdx);
                const paginatedData = fullData.slice(startIdx, endIdx);

                // Log the paginated data for debugging
                // console.log('Paginated chart data:', { labels: paginatedLabels, data: paginatedData });

                // Create the chart
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: paginatedLabels,
                        datasets: [{
                            label: 'No. Of Approved Profiles',
                            data: paginatedData,
                            backgroundColor: '#d3b8f0',
                            barThickness: 11
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
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        family: 'Poppins',
                                        size: 12
                                    },
                                    color: '#5D5C5C'
                                }
                            }
                        }
                    }
                });

                // Update pagination display
                pageRange.textContent = `${startIdx + 1} - ${endIdx}`;
            }
        };

        // Highlight Highest Values in Tables
        const highlightHighestValues = () => {
            ['city-table', 'country-table'].forEach(tableId => {
                const valueClass = tableId === 'city-table' ? 'admin-city-data-value' :
                    'admin-desti-country-data-value';
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
            const handlers = [{
                    selector: '.admin-city-pagination-btn',
                    action: () => console.log('City pagination clicked')
                },
                {
                    selector: '.admin-city-filter-btn',
                    action: () => console.log('City filter clicked')
                },
                {
                    selector: '.admin-city-sort-btn',
                    action: () => console.log('City sort clicked')
                },
                {
                    selector: '.admin-desti-country-pagination-btn',
                    action: () => console.log('Country pagination clicked')
                },
                {
                    selector: '.admin-desti-country-filter-btn',
                    action: () => console.log('Country filter clicked')
                },
                {
                    selector: '.admin-desti-country-sort-btn',
                    action: () => console.log('Country sort clicked')
                }
            ];

            handlers.forEach(({
                selector,
                action
            }) => {
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
                console.error('Dropdown elements missing:', {
                    dropdownButton,
                    dropdownOptions,
                    icon,
                    container
                });
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
                    fallbackMessage.textContent =
                        `No data available for ${$(`[data-report="${reportId}"]`, dropdownOptions)?.textContent || 'this report'}.`;
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
                dropdownOptions.classList.toggle('show');
                icon.classList.toggle('show-all-admin-rotate-icon');
                // Ensure all options are visible in the dropdown
                $$('.show-all-admin-options button', dropdownOptions).forEach(option => {
                    option.style.display = 'block';
                    option.style.visibility = 'visible';
                });
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
                dropdownOptions.classList.remove('show');
                icon.classList.remove('show-all-admin-rotate-icon');
            };

            // Bind events directly
            dropdownButton.addEventListener('click', toggleDropdown);
            $$('.show-all-admin-options button', dropdownOptions).forEach(option => {
                option.addEventListener('click', handleOptionClick);
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.show-all-admin-button-container') && dropdownOptions.classList.contains(
                        'show')) {
                    // console.log('Closing dropdown due to outside click');
                    dropdownOptions.classList.remove('show');
                    icon.classList.remove('show-all-admin-rotate-icon');
                }
            });

            // Initialize with all reports visible
            showAllReports();
        };


        const initializeCalendar = () => {
            const calendarConfigs = [{
                    buttonId: 'calender-buttongroups',
                    containerClass: '.calendar-container',
                    wrapperClass: '.calendar-wrapper',
                    isMobile: false
                },
                {
                    buttonId: 'calendarButton',
                    containerClass: '.calendar-container',
                    wrapperClass: '.calendar-wrapper',
                    isMobile: true
                }
            ];

            calendarConfigs.forEach(config => {
                const calendarButton = $(`#${config.buttonId}`);
                const calendarContainer = $(`${config.wrapperClass} ${config.containerClass}`);
                const calendarGrid = $(`${config.wrapperClass} .calendar-grid`);
                const monthSelect = $(`${config.wrapperClass} #calendar-month-select`);
                const yearSelect = $(`${config.wrapperClass} #calendar-year-select`);
                const startDateInput = $(`${config.wrapperClass} #calendar-start-date-input`);
                const endDateInput = $(`${config.wrapperClass} #calendar-end-date-input`);
                const prevMonthBtn = $(`${config.wrapperClass} .calendar-prev-month`);
                const nextMonthBtn = $(`${config.wrapperClass} .calendar-next-month`);

                if (!calendarButton || !calendarContainer || !calendarGrid || !monthSelect || !yearSelect || !
                    startDateInput || !endDateInput || !prevMonthBtn || !nextMonthBtn) {
                    console.error(`Calendar elements missing for ${config.buttonId}`, {
                        calendarButton,
                        calendarContainer,
                        calendarGrid,
                        monthSelect,
                        yearSelect,
                        startDateInput,
                        endDateInput,
                        prevMonthBtn,
                        nextMonthBtn
                    });
                    return;
                }

                let currentDate = new Date();
                let startDate = null;
                let endDate = null;
                let selectionMode = 'start';
                let isCalendarOpen = false;

                const populateYearSelect = () => {
                    const currentYear = new Date().getFullYear();
                    yearSelect.innerHTML = '';
                    for (let year = currentYear - 5; year <= currentYear + 5; year++) {
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        if (year === currentYear) option.selected = true;
                        yearSelect.appendChild(option);
                    }
                };

                const toggleCalendar = (e) => {
                    e.stopPropagation();
                    isCalendarOpen = !isCalendarOpen;
                    // console.log(
                    //     `Toggling calendar for ${config.buttonId}: ${isCalendarOpen ? 'open' : 'closed'}`
                    // );
                    calendarContainer.style.display = isCalendarOpen ? 'block' : 'none';
                    if (isCalendarOpen) {
                        if (config.isMobile) {
                            // console.log('Applying mobile view styles');
                            calendarContainer.classList.add('mobile-visible');
                            setTimeout(() => {
                                calendarContainer.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }, 100); // Delay to ensure display is applied
                        } else {
                            calendarContainer.classList.remove('mobile-visible');
                        }
                        renderCalendar(); // Ensure calendar is rendered when opened
                    } else {
                        calendarContainer.classList.remove('mobile-visible');
                    }
                };

                const updateMonthYearSelects = () => {
                    monthSelect.value = currentDate.getMonth();
                    yearSelect.value = currentDate.getFullYear();
                };

                const renderCalendar = () => {
                    // console.log(
                    //     `Rendering calendar for ${currentDate.toLocaleString('default', { month: 'long', year: 'numeric' })}`
                    // );
                    const days = $$(`${config.wrapperClass} .calendar-day`);
                    days.forEach(el => el.remove());

                    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                    let firstDayIndex = firstDay.getDay() - 1;
                    if (firstDayIndex < 0) firstDayIndex = 6;

                    const prevMonthLastDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0)
                        .getDate();
                    for (let i = prevMonthLastDay - firstDayIndex + 1; i <= prevMonthLastDay; i++) {
                        addDayToCalendar(i, 'calendar-other-month', new Date(currentDate.getFullYear(),
                            currentDate.getMonth() - 1, i));
                    }

                    const today = new Date();
                    for (let i = 1; i <= lastDay.getDate(); i++) {
                        const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);
                        const classes = [];
                        if (today.toDateString() === date.toDateString()) classes.push('calendar-today');
                        if (startDate && startDate.toDateString() === date.toDateString()) classes.push(
                            'calendar-selected-start');
                        if (endDate && endDate.toDateString() === date.toDateString()) classes.push(
                            'calendar-selected-end');
                        if (startDate && endDate && date > startDate && date < endDate) {
                            classes.push('calendar-in-range');
                            if (i === 1 || new Date(currentDate.getFullYear(), currentDate.getMonth(), i -
                                    1) <= startDate) {
                                classes.push('calendar-first-in-range');
                            }
                            if (i === lastDay.getDate() || new Date(currentDate.getFullYear(), currentDate
                                    .getMonth(), i + 1) >= endDate) {
                                classes.push('calendar-last-in-range');
                            }
                        }
                        addDayToCalendar(i, classes.join(' '), date);
                    }

                    const daysRendered = firstDayIndex + lastDay.getDate();
                    const remainingDays = 7 - (daysRendered % 7);
                    if (remainingDays < 7) {
                        for (let i = 1; i <= remainingDays; i++) {
                            addDayToCalendar(i, 'calendar-other-month', new Date(currentDate.getFullYear(),
                                currentDate.getMonth() + 1, i));
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
                            // console.log(`Selected date: ${date.toLocaleDateString()}`);
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
                    startDateInput.innerHTML = startDate ?
                        `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                ${startDate.getDate().toString().padStart(2, '0')}/${(startDate.getMonth() + 1).toString().padStart(2, '0')}/${startDate.getFullYear()}` :
                        `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span>Start Date</span>`;

                    endDateInput.innerHTML = endDate ?
                        `${endDate.getDate().toString().padStart(2, '0')}/${(endDate.getMonth() + 1).toString().padStart(2, '0')}/${endDate.getFullYear()}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: auto;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>` :
                        `<span>End Date</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: auto;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>`;
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

                calendarButton.addEventListener('click', toggleCalendar);

                calendarContainer.addEventListener('click', e => e.stopPropagation());

                document.addEventListener('click', e => {
                    if (isCalendarOpen && !calendarContainer.contains(e.target) && e.target !==
                        calendarButton) {
                        // console.log('Closing calendar due to outside click');
                        isCalendarOpen = false;
                        calendarContainer.style.display = 'none';
                        calendarContainer.classList.remove('mobile-visible');
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

                populateYearSelect();
                updateMonthYearSelects();
                renderCalendar();
            });
        };
        // Referral Modal
        const initializeReferralModal = () => {
            const referralLinkBtn = document.getElementById('referral-link-admindashboard');
            const referralLinkBtnMob = document.getElementById('referral-link-admindashboard-mobile');
            const modal = document.getElementById('referralModal');
            const backdrop = document.getElementById('backdrop');
            const closeBtn = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const generateBtn = document.getElementById('generateBtn');
            const inputField = document.getElementById('referralLink');
            const modalFooter = document.getElementById('modalFooter');
            const mobPopupForOptions = document.querySelector(".mobile-admin-dashboard-modal-content");

            if (!referralLinkBtn || !modal || !backdrop || !closeBtn || !cancelBtn || !generateBtn || !inputField || !
                modalFooter) {
                return console.error('Referral modal elements missing');
            }

            const openModal = () => {
                modal.classList.remove('hidden');
                backdrop.classList.add('active');
                inputField.value = '';
                modalFooter.innerHTML = `
            <button id="cancelBtn">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828778.png" alt="Cancel Icon" class="cancel-icon">
                Cancel
            </button>
            <button id="generateBtn">Generate</button>
        `;
                addModalListeners();
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                backdrop.classList.remove('active');
                inputField.value = '';
            };

            const toggleModal = () => {
                const isOpen = !modal.classList.contains('hidden');
                if (isOpen) {
                    closeModal();
                } else {
                    if (mobPopupForOptions) mobPopupForOptions.style.display = "none"; // optional
                    openModal();
                }
            };

            const updateFooterButtons = (link) => {
                modalFooter.innerHTML = `
            <button id="cancelBtn">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828778.png" alt="Cancel Icon" class="cancel-icon">
                Cancel
            </button>
            <div class="button-group">
                <div class="copy-button-container">
                    <button id="copyBtn">
                        <img src="assets/images/content_copy-icon.png" alt="Copy Icon" class="copy-icon">
                        Copy Link
                    </button>
                </div>
                <div class="share-button-container">
                    <button id="shareBtn">
                        <img src="assets/images/share-icon.png" alt="Share Icon" class="share-icon">
                        Share
                    </button>
                </div>
            </div>
        `;

                document.getElementById('cancelBtn').addEventListener('click', closeModal);
                document.getElementById('copyBtn').addEventListener('click', () => {
                    navigator.clipboard.writeText(link).then(() => {
                        alert('Link copied to clipboard!');
                    });
                });
                document.getElementById('shareBtn').addEventListener('click', () => {
                    alert('Share this link: ' + link);
                });
            };

            const addModalListeners = () => {
    const newCancelBtn = document.getElementById('cancelBtn');
    const newGenerateBtn = document.getElementById('generateBtn');

    if (newCancelBtn) newCancelBtn.addEventListener('click', closeModal);

        if (newGenerateBtn) {
            newGenerateBtn.addEventListener('click', () => {
                const referralId = Math.random().toString(36).substr(2, 8); 
                const baseUrl = "/signup";  
                const url = new URL(baseUrl, window.location.origin);
                url.searchParams.set("adminref", referralId);

                const newLink = url.toString();  
                inputField.value = newLink;
                updateFooterButtons(newLink);
            });
        }
};


            referralLinkBtn?.addEventListener('click', openModal);
            referralLinkBtnMob?.addEventListener('click', toggleModal);

            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            cancelBtn?.addEventListener('click', closeModal);
            generateBtn?.addEventListener('click', () => {
                const newLink = `https://example.com/referral?code=${Math.random().toString(36).substr(2, 8)}`;
                inputField.value = newLink;
                updateFooterButtons(newLink);
            });
        };


        const initializeMobileMenu = () => {
            const mobileModal = $('#mobile-admin-dashboard-modal');
            const mobileMenuBtn = $('#mobile-admin-dashboard-menu-btn');
            const closeModalBtn = $('#mobile-admin-dashboard-close-modal-btn');
            const manageStudentBtn = $('#manage-student-admindashboard-mobile');
            const referralLinkBtnMob = $('#referral-link-admindashboard-mobile');
            const manageStudentDesktopBtn = $('#manage-student-admindashboard');
            const referralLinkDesktopBtn = $('#referral-link-admindashboard');
            const backdrop = $('#backdrop');
            const modalContent = $('.mobile-admin-dashboard-modal-content', mobileModal);

            // Validate elements
            if (!mobileModal || !mobileMenuBtn || !closeModalBtn || !backdrop || !manageStudentBtn || !
                referralLinkBtnMob || !manageStudentDesktopBtn || !referralLinkDesktopBtn || !modalContent) {
                return console.error('Mobile menu elements missing');
            }

            const openModal = e => {
                e.stopPropagation();
                mobileModal.style.display = 'flex';
                modalContent.style.display = 'block'; // Ensure content is visible
                modalContent.style.visibility = 'visible';
                backdrop.classList.add('active'); // Show backdrop
            };

            const closeModal = e => {
                if (e) e.stopPropagation();
                mobileModal.style.display = 'none';
                modalContent.style.display = 'none'; // Hide content explicitly
                backdrop.classList.remove('active'); // Hide backdrop
            };

            // Toggle the modal on hamburger menu click
            mobileMenuBtn.removeEventListener('click', openModal);
            mobileMenuBtn.addEventListener('click', e => {
                e.stopPropagation();
                if (mobileModal.style.display === 'flex') {
                    closeModal(e);
                } else {
                    openModal(e);
                }
            });

            closeModalBtn.removeEventListener('click', closeModal);
            closeModalBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside (on the backdrop part of the modal)
            mobileModal.addEventListener('click', e => {
                if (e.target === mobileModal) closeModal(e);
            });

            // Ensure backdrop click closes the mobile modal and referral modal
            backdrop.addEventListener('click', e => {
                closeModal(e);
                const referralModal = $('#referralModal');
                if (referralModal && !referralModal.classList.contains('hidden')) {
                    referralModal.classList.add('hidden');
                    backdrop.classList.remove('active');
                }
            });

            // Trigger desktop button clicks from mobile buttons
            manageStudentBtn.addEventListener('click', e => {
                e.stopPropagation();
                closeModal(e);
                manageStudentDesktopBtn.click();
            });

            referralLinkBtnMob.addEventListener('click', e => {
                e.stopPropagation();
                closeModal(e);
                referralLinkDesktopBtn.click();
            });
        };


        const initializeFilterPanel = () => {
            // Ensure mobile view
            const isMobileView = document.querySelector('.admindashboardcontainer-secondsection-mobile');
            if (!isMobileView) {
                console.log('Not in mobile view, skipping filter panel initialization.');
                return;
            }

            // console.log('Initializing filter panel for mobile view.');

            const filterButton = $('#filterButton');
            const filterPanel = $('#filterPanel');
            const closeFilterBtn = $('#closeFilterBtn');
            const showAllBtn = $('#showAllBtn');
            const collapsedTags = $('#collapsedTags');
            const topTagsContainer = $(
                '.admin-dashboard-filter-panel > .admin-dashboard-filter-container > .admin-dashboard-filter-tags');
            const bottomTagsContainer = $('#collapsedTags .admin-dashboard-filter-tags');
            const panelsToggle = $('#panelsToggle');
            const panelsIconButton = $('#panelsIcon');

            if (!filterButton || !filterPanel || !closeFilterBtn || !showAllBtn || !collapsedTags || !
                topTagsContainer || !bottomTagsContainer || !panelsToggle || !panelsIconButton) {
                console.error('One or more critical filter panel elements are missing. Aborting initialization.');
                return;
            }

            const allTags = [{
                    id: 'admin-dashboard-filter-tag-registration',
                    text: 'Registration Reports',
                    report: 'registration-reports'
                },
                {
                    id: '',
                    text: 'No of grads',
                    report: 'no-of-grads'
                },
                {
                    id: 'admin-dashboard-filter-tag-source',
                    text: 'Registration Source',
                    report: 'registration-source'
                },
                {
                    id: '',
                    text: 'Age ratio Reports',
                    report: 'age-ratio-reports'
                },
                {
                    id: 'admin-dashboard-filter-tag-funnel',
                    text: 'Funnel Reports',
                    report: 'funnel-reports'
                },
                {
                    id: '',
                    text: 'Destination countries',
                    report: 'destination-countries'
                },
                {
                    id: 'admin-dashboard-filter-tag-city',
                    text: 'Cities',
                    report: 'cities'
                },
                {
                    id: 'admin-dashboard-filter-tag-nbfc-lead',
                    text: 'NBFC: Generation Leads',
                    report: 'nbfc-generation-leads'
                },
                {
                    id: '',
                    text: 'Point of entry',
                    report: 'point-of-entry'
                },
                {
                    id: 'admin-dashboard-filter-tag-sc-lead',
                    text: 'SC: Generation Leads',
                    report: 'sc-generation-leads'
                },
                {
                    id: 'admin-dashboard-filter-tag-sc-lead-approved',
                    text: 'SC: Approved Profiles',
                    report: 'sc-generation-leads-approved'
                },
                {
                    id: 'admin-dashboard-filter-tag-semrush',
                    text: 'Sem Rush',
                    report: 'sem-rush'
                }
            ];

            let topTags = [...allTags];
            let bottomTags = [];

            const openFilterPanel = () => {
                // console.log('Opening filter panel');
                filterPanel.style.display = 'flex';
                renderTags();
            };

            const closeFilterPanel = () => {
                // console.log('Closing filter panel');
                filterPanel.style.display = 'none';
            };

            const updatePanelCount = () => {
                panelsToggle.textContent = `${topTags.length} Panels`;
            };

            const updateVisibleReports = () => {
                // console.log('Updating visible reports based on active tags:', topTags.map(t => t.text));
                const activeTags = topTags.map(tag => tag.text.toLowerCase());
                const reportMapping = {
                    'registration reports': 'registration-reports',
                    'no of grads': 'no-of-grads',
                    'registration source': 'registration-source',
                    'age ratio reports': 'age-ratio-reports',
                    'funnel reports': 'funnel-reports',
                    'destination countries': 'destination-countries',
                    'cities': 'cities',
                    'nbfc: generation leads': 'nbfc-generation-leads',
                    'point of entry': 'point-of-entry',
                    'sc: generation leads': 'sc-generation-leads',
                    'sc: approved profiles': 'sc-generation-leads-approved',
                    'sem rush': 'sem-rush'
                };

                const reports = document.querySelectorAll('[data-report]');
                reports.forEach(report => {
                    const reportId = report.getAttribute('data-report');
                    const tagText = Object.keys(reportMapping).find(key => reportMapping[key] === reportId);
                    const shouldShow = tagText && activeTags.includes(tagText.toLowerCase());
                    // console.log(
                    //     `Report ${reportId}: Tag "${tagText || 'N/A'}" ${shouldShow ? 'shown' : 'hidden'}`
                    // );
                    report.style.display = shouldShow ? 'block' : 'none';
                });
            };

            const renderTags = () => {
                // console.log('Rendering tags - Top:', topTags.map(t => t.text), 'Bottom:', bottomTags.map(t => t
                //     .text));

                topTagsContainer.innerHTML = '';
                bottomTagsContainer.innerHTML = '';

                // Render top tags (with "X")
                topTags.forEach(tag => {
                    const tagElement = document.createElement('div');
                    tagElement.className = 'admin-dashboard-filter-tag';
                    if (tag.id) tagElement.id = tag.id;
                    tagElement.innerHTML = `${tag.text} <span class="admin-dashboard-close-tag">×</span>`;
                    topTagsContainer.appendChild(tagElement);
                });

                bottomTags.forEach(tag => {
                    const tagElement = document.createElement('div');
                    tagElement.className = 'admin-dashboard-filter-tag';
                    if (tag.id) tagElement.id = tag.id;
                    tagElement.textContent = tag.text;
                    tagElement.style.display = 'inline-flex';
                    tagElement.style.cursor = 'pointer'; // Indicate clickability
                    bottomTagsContainer.appendChild(tagElement);
                });

                // Log rendered HTML for debugging
                // console.log('Top tags HTML:', topTagsContainer.innerHTML);
                // console.log('Bottom tags HTML:', bottomTagsContainer.innerHTML);

                // Toggle collapsed section visibility
                if (bottomTags.length > 0) {
                    collapsedTags.classList.add('show');
                    showAllBtn.innerHTML = 'Show Less <i class="fa-solid fa-chevron-up"></i>';
                } else {
                    collapsedTags.classList.remove('show');
                    showAllBtn.innerHTML = 'Show All <i class="fa-solid fa-chevron-down"></i>';
                }

                updatePanelCount();
                updateVisibleReports();
            };

            // Event listeners
            filterButton.addEventListener('click', openFilterPanel);
            panelsIconButton.addEventListener('click', (e) => {
                e.stopPropagation();
                openFilterPanel();
            });

            closeFilterBtn.addEventListener('click', closeFilterPanel);
            showAllBtn.addEventListener('click', () => {
                console.log('Show All/Show Less clicked');
                if (collapsedTags.classList.contains('show')) {
                    topTags = [...allTags];
                    bottomTags = [];
                }
                collapsedTags.classList.toggle('show');
                showAllBtn.innerHTML = collapsedTags.classList.contains('show') ?
                    'Show Less <i class="fa-solid fa-chevron-up"></i>' :
                    'Show All <i class="fa-solid fa-chevron-down"></i>';
                renderTags();
            });

            filterPanel.addEventListener('click', e => {
                if (!e.target.closest('.admin-dashboard-filter-container')) {
                    console.log('Clicked outside filter container, closing panel');
                    closeFilterPanel();
                }
            });

            topTagsContainer.addEventListener('click', e => {
                if (e.target.classList.contains('admin-dashboard-close-tag')) {
                    e.stopPropagation(); // Prevent closing the filter panel
                    const tagElement = e.target.closest('.admin-dashboard-filter-tag');
                    const tagText = tagElement.textContent.replace('×', '').trim();
                    const tag = topTags.find(t => t.text === tagText);
                    if (tag) {
                        console.log(`Removing tag from top: ${tagText}`);
                        topTags = topTags.filter(t => t.text !== tagText);
                        bottomTags.push(tag);
                        console.log(`Moved tag to bottom: ${tagText}`);
                        renderTags();
                    } else {
                        console.warn(`Tag not found in topTags: ${tagText}`);
                    }
                }
            });

            bottomTagsContainer.addEventListener('click', e => {
                if (e.target.classList.contains('admin-dashboard-filter-tag')) {
                    e.stopPropagation(); // Prevent closing the filter panel
                    const tagText = e.target.textContent.trim();
                    const tag = bottomTags.find(t => t.text === tagText);
                    if (tag) {
                        console.log(`Activating tag: ${tagText}`);
                        bottomTags = bottomTags.filter(t => t.text !== tagText);
                        topTags.push(tag);
                        renderTags();
                    } else {
                        console.warn(`Tag not found in bottomTags: ${tagText}`);
                    }
                }
            });

            console.log('Rendering initial tags');
            renderTags();
        };

        let ageratioChart;

        function loadAgeRatioChart(degreeType = '') {
            // Map user-friendly labels to backend values
            let mappedDegreeType = degreeType;

            if (degreeType === "Post Graduate") {
                mappedDegreeType = "Masters";
            } else if (degreeType === "Under Graduate") {
                mappedDegreeType = "Bachelors";
            } else if (degreeType === "Others") {
                mappedDegreeType = "Others";
            }

            fetch("{{ route('admin.ageratio.calculation') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        degree_type: mappedDegreeType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const ageRatio = data.age_ratio || {};
                        const ageLabels = Object.keys(ageRatio);
                        const ageData = Object.values(ageRatio);

                        const isDataEmpty = ageLabels.length === 0 || ageData.every(value => value === 0);

                        // Destroy existing chart if present
                        if (typeof ageratioChart !== 'undefined' && ageratioChart) {
                            ageratioChart.destroy();
                        }

                        const ctx = document.getElementById('ageratio-donutRegistrationChart')?.getContext('2d');
                        if (!ctx) {
                            console.error('Canvas context not found');
                            return;
                        }

                        if (isDataEmpty) {
                            // Show placeholder chart with 1 segment
                            ageratioChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['No Data'],
                                    datasets: [{
                                        data: [1],
                                        backgroundColor: ['#e0e0e0'],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                        tooltip: {
                                            enabled: false
                                        }
                                    }
                                }
                            });

                            // Optional: Show text notice on chart area
                            document.getElementById('ageratio-header').textContent = "No age ratio<br> data available";
                        } else {
                            const ageColors = [
                                'rgba(111, 37, 206, 1)',
                                'rgba(167, 121, 224, 1)',
                                'rgba(203, 176, 237, 1)',
                                'rgba(226, 211, 245, 1)'
                            ];

                            ageratioChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ageLabels,
                                    datasets: [{
                                        data: ageData,
                                        backgroundColor: ageColors.slice(0, ageData.length),
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    }
                                }
                            });

                            document.getElementById('ageratio-header').textContent = "Age ratio of students";
                        }
                    } else {
                        alert('Error: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        }

        loadAgeRatioChart();




        function funnelreport(degreeType = '') {
            // console.log("funnelreport working for:", degreeType);

            const url = degreeType ?
                `/retrievedashboarddetails?degree_type=${degreeType}` :
                '/retrievedashboarddetails';

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const counts = data.counts;

                        document.getElementById('offer-issued').innerText = counts.offerIssuedStudentsCount;
                        document.getElementById('offer-rejected').innerText = counts.offerRejectedByStudentCount;
                        document.getElementById('offer-accepted').innerText = counts.offerAcceptedAndClosedCount;

                        document.getElementById('incomplete-count').innerText = counts.incompleteProfileCount;
                        document.getElementById('dummy-1').innerText = counts.completedProfileCount;
                    } else {
                        console.error('Failed to fetch dashboard details.');
                    }
                })
                .catch(err => console.error('Dashboard data error:', err));
        }

        function funnelReportDropdown() {
            const toggle = document.getElementById('postgrad-buttongroups-insideshow-funnelreports-id');
            const dropdown = document.getElementById('postgrad-funnelreportsprogress');

            toggle.addEventListener('click', function() {
                dropdown.classList.toggle('show');
            });

            const links = dropdown.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedValue = this.getAttribute('data-value');
                    dropdown.classList.remove('show');
                    funnelreport(selectedValue); // Call with selected degreeType
                });
            });
        }

        function fetchReferralAcceptedCounts() {
            fetch('/referralacceptedcounts')
                .then(response => response.json())
                // .then(data => {
                //     console.log("Referral Accepted Counts:", data);
                // })
                .catch(error => {
                    console.error('Fetch failed:', error);
                });
        }

        function monthYearPicker() {
            const button = document.getElementById('calender-reportsregister');
            const input = document.getElementById('date-picker-linegraph');

            button.addEventListener('click', function() {
                input.click();
            });

            input.addEventListener('change', function() {
                const selectedMonthYear = this.value;
                const [year, month] = selectedMonthYear.split('-');

                button.innerHTML =
                    `Calendar ${getMonthName(month)} ${year} <img src="assets/images/Icons/calendar_month.png" alt="">`;
            });

            function getMonthName(monthNumber) {
                const months = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];
                return months[parseInt(monthNumber, 10) - 1];
            }
        }
        const initializePostgradDropdowns = () => {
            const postgradButtons = $$('.postgrad-buttongroups');

            postgradButtons.forEach(button => {
                const toggleButton = $('.postgrad-buttongroups-insideshow', button);
                const dropdownContent = $('.dropdown-content-postgrad', button);
                const icon = $('.fa-chevron-down', toggleButton);

                if (!toggleButton || !dropdownContent || !icon) {
                    console.error('Missing elements for postgrad dropdown:', {
                        toggleButton,
                        dropdownContent,
                        icon
                    });
                    return;
                }

                const toggleDropdown = (e) => {
                    e.stopPropagation();
                    dropdownContent.classList.toggle('show');
                    icon.classList.toggle('rotate-icon');
                    // console.log(
                    //     `Dropdown ${dropdownContent.classList.contains('show') ? 'opened' : 'closed'} for`,
                    //     button.id);
                };

                const closeDropdown = () => {
                    dropdownContent.classList.remove('show');
                    icon.classList.remove('rotate-icon');
                };

                $$('.dropdown-content-postgrad a', button).forEach(option => {
                    option.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();

                        const degreeType = option.textContent.trim();
                        toggleButton.innerHTML =
                            `${degreeType} <i class="fa-solid fa-chevron-down"></i>`;

                        if (button.id === 'postgrad-ageratio') {
                            loadAgeRatioChart(degreeType);
                        }

                        closeDropdown();
                        // console.log(`Selected degree type: ${degreeType} for`, button.id);
                    });
                });

                toggleButton.addEventListener('click', toggleDropdown);

                document.addEventListener('click', (e) => {
                    if (!button.contains(e.target) && dropdownContent.classList.contains('show')) {
                        closeDropdown();
                        // console.log('Closed dropdown due to outside click for', button.id);
                    }
                });
            });
        };

        function updateVisibleReportsFromFilters() {
            const activeTags = Array.from(document.querySelectorAll('.admin-dashboard-filter-tag'))
                .map(tag => tag.textContent.trim().replace('×', '').trim().toLowerCase());

            const reports = document.querySelectorAll('[data-report]');

            reports.forEach(report => {
                const reportType = report.getAttribute('data-report').replace(/-/g, ' ').toLowerCase();
                const shouldShow = activeTags.some(tag => reportType.includes(tag));
                report.style.display = shouldShow ? 'block' : 'none';
            });
        }

        // Watch for clicks on close icons to update the view
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('admin-dashboard-close-tag')) {
                // Remove the tag from the DOM
                const tagElement = e.target.closest('.admin-dashboard-filter-tag');
                if (tagElement) {
                    tagElement.remove();
                    updateVisibleReportsFromFilters(); // Re-run filtering
                }
            }
        });


        function funnelReportDropdown() {
            const toggle = document.getElementById('postgrad-buttongroups-insideshow-funnelreports-id');
            const dropdown = document.getElementById('postgrad-funnelreportsprogress');

            toggle.addEventListener('click', function() {
                dropdown.classList.toggle('show');
            });

            const links = dropdown.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedValue = this.getAttribute('data-value');
                    dropdown.classList.remove('show');
                    funnelreport(selectedValue);
                });
            });
        }

        function ageRatioDropdown() {
            // Toggle dropdown visibility
            document.getElementById('postgrad-buttongroups-insideshow-age-ratio-id').addEventListener('click', function() {
                const dropdown = document.getElementById('postgrad-ageratioprogress');
                dropdown.classList.toggle('show');
            });

            // Handle dropdown item clicks and trigger chart update
            const dropdownItems = document.querySelectorAll('#postgrad-ageratioprogress a');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedDegreeType = this.textContent.trim();

                    // Optional: update the button text to show the selected type
                    document.getElementById('postgrad-buttongroups-insideshow-age-ratio-id').innerHTML =
                        `${selectedDegreeType} <i class="fa-solid fa-chevron-down"></i>`;

                    // Hide the dropdown
                    document.getElementById('postgrad-ageratioprogress').classList.remove('show');

                    // Load the chart
                    loadAgeRatioChart(selectedDegreeType);
                });
            });
        }


        function searchMobFunctionality() {
            const searchInput = document.getElementById('searchinput-admindashboard');
            if (!searchInput) {
                console.error('Search input element not found');
                return;
            }

            // Mapping of display names and aliases to data-report values
            const reportMapping = {
                'registration reports': 'registration-reports',
                'no of grads': 'no-of-grads',
                'total undergrad': 'no-of-grads',
                'total postgrad': 'no-of-grads',
                'registration source': 'registration-source',
                'no age ratio data available': 'age-ratio-reports',
                'funnel reports': 'funnel-reports',
                'destination countries': 'destination-countries',
                'cities': 'cities',
                'nbfc: generation leads': 'nbfc-generation-leads',
                'point of entry': 'point-of-entry',
                'sc: generation leads': 'sc-generation-leads',
                'sc: generation leads approved': 'sc-generation-leads-approved',
                'sem rush': 'sem-rush'
            };

            // Get all report names and aliases for searching
            const reportNames = Object.keys(reportMapping);

            searchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                // console.log('Search query:', query);

                // Get all report containers
                const reports = document.querySelectorAll('[data-report]');
                if (!reports.length) {
                    console.warn('No report containers found with [data-report]');
                    return;
                }

                if (!query) {
                    // If search is empty, show all reports
                    reports.forEach(report => {
                        report.style.display = 'block';
                    });
                    // console.log('Search cleared, showing all reports');
                    return;
                }

                // Find matching report names or aliases
                const matchedReports = reportNames.filter(name => name.toLowerCase().includes(query));
                // console.log('Matched report names:', matchedReports);

                // Convert matched names to their data-report values (deduplicate)
                const matchedReportIds = [...new Set(matchedReports.map(name => reportMapping[name
                    .toLowerCase()]))];
                // console.log('Matched report IDs:', matchedReportIds);

                // Show/hide reports based on matches
                reports.forEach(report => {
                    const reportId = report.getAttribute('data-report');
                    const shouldShow = matchedReportIds.includes(reportId);
                    report.style.display = shouldShow ? 'block' : 'none';
                    // console.log(`Report ${reportId}: ${shouldShow ? 'shown' : 'hidden'}`);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            funnelreport();
            ageRatioDropdown();
            funnelReportDropdown();
            searchMobFunctionality();

           












        });
    </script>
</body>

</html>
