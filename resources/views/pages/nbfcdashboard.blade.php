<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remitout-NBFC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>


    <link rel="stylesheet" href="assets/css/nbfc.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>

    @extends('layouts.app')
    @section('title', 'nbfcdashboard')

    @section('nbfcdashboard')



    @php
$profileImgPath = 'images/admin-student-profile.png';
$uploadPanName = '';
$profileIconPath = "assets/images/account_circle.png";
$phoneIconPath = "assets/images/call.png";
$mailIconPath = "assets/images/mail.png";
$pindropIconPath = "assets/images/pin_drop.png";
$discordIconPath = "assets/images/icons/discordicon.png";
$viewIconPath = "assets/images/visibility.png";



    @endphp

    <nav class="nbfc-navbar">
        <div class="nbfc-logo">
            <img src="/assets/images/nbfc-logo.png" alt="Remitout Logo">
        </div>

        <div class="nbfc-nav-right">
            <div class="nbfc-search-container" id="nbfc-search-container-id-index">
                <img src="assets/images/search.png" alt="Search" class="nbfc-search-icon">
                <input type="text" class="nbfc-search-input" id="nbfc-search-input-id" placeholder="Search">
            </div>

            <button class="nbfc-dark-mode">
                <img src="/assets/images/notifications_unread.png" alt="the notification icon"
                    class="notification-icon">
            </button>

            <div class="nbfc-profile">
                <div class="nbfc-avatar"></div>
                <span class="nbfc-profile-text">Bank Rep</span>
                <div class="nbfc-dropdown-icon"></div>
            </div>
        </div>

        <!-- Add an id to the mobile menu button -->
        <button id="nbfcMobileMenuBtn" class="nbfc-mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div class="nbfc-mobile-sidebar">
        <ul class="nbfc-mobile-menu-top">
            <li class="active">
                <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
            </li>
            <li>
                <i class="fas fa-inbox"></i> Inbox
            </li>
        </ul>

        <ul class="nbfc-mobile-menu-bottom">
            <li>
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </li>
            <li>
                <i class="fa-solid fa-headset"></i> Support
            </li>
        </ul>
    </div>

    <div class="nbfc-mobile-overlay"></div>

    <div class="nbfcstudentdashboardprofile-togglesidebar">
        <ul class="nbfcstudentdashboardprofile-sidebarlists-top">
            <li class="nbfcactive">
                <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
            </li>
            <li>
                <i class="fa-solid fa-inbox"></i> Inbox
            </li>
        </ul>

        <ul class="nbfcstudentdashboardprofile-sidebarlists-bottom">
            <li class="nbfclogoutBtn" onClick="sessionLogout()">
                <img src="assets/images/logout-icon.png" alt="Logout Icon" /> Log out
            </li>
            <li>
                <img src="assets/images/support_agent.png" alt="Support Icon" /> Support
            </li>
        </ul>
    </div>

    <div class="nbfc-mobile-overlay"></div>



    <section class="dashboard-main-content">
        <div class="dashboard-sections-container" id="dashboard-container">
            <section class="dashboard-section">
                <div class="dashboard-section-header">
                    <h2 class="dashboard-section-title">Requests</h2>
                    <div class="dashboard-header-controls">
                        <div class="dashboard-sort-button-container">
                            <button class="dashboard-sort-button">
                                Sort
                                <img src="assets/images/filter-icon.png" alt="Filter">
                            </button>

                            <div class="dashboard-sort-options" style="display: none;">
                                <button class="dashboard-sort-option" data-sort="A-Z">A-Z</button>
                                <button class="dashboard-sort-option" data-sort="Z-A">Z-A</button>
                                <button class="dashboard-sort-option" data-sort="Newest">Newest</button>
                                <button class="dashboard-sort-option" data-sort="Oldest">Oldest</button>
                            </div>

                        </div>
                        <div class="dashboard-nbfc-search-container-section"
                            id="dashboard-nbfc-search-container-section-request">
                            <img src="assets/images/search.png" alt="Search" class="dashboard-nbfc-search-icon">
                            <input type="text" class="dashboard-nbfc-search-input-sec" placeholder="Search">
                        </div>

                    </div>
                </div>
                <div class="dashboard-student-list" id="dashboard-request-list">
                    <!-- Dynamically populated list for Requests goes here -->
                </div>
            </section>

            <section class="dashboard-section">
                <div class="dashboard-section-header">
                    <h2 class="dashboard-section-title">Proposals</h2>
                    <div class="dashboard-header-controls">

                        <div class="dashboard-sort-button-container">
                            <button class="dashboard-sort-button">
                                Sort
                                <img src="assets/images/filter-icon.png" alt="Filter">
                            </button>
                            <div class="dashboard-sort-options" style="display: none;">
                                <button class="dashboard-sort-option" data-sort="A-Z">A-Z</button>
                                <button class="dashboard-sort-option" data-sort="Z-A">Z-A</button>
                                <button class="dashboard-sort-option" data-sort="Newest">Newest</button>
                                <button class="dashboard-sort-option" data-sort="Oldest">Oldest</button>
                            </div>
                        </div>
                        <div class="dashboard-nbfc-search-container-section"
                            id="dashboard-nbfc-search-container-section-proposal">
                            <img src="assets/images/search.png" alt="Search" class="dashboard-nbfc-search-icon">
                            <input type="text" class="dashboard-nbfc-search-input-sec" placeholder="Search">
                        </div>


                    </div>
                </div>
                <div class="dashboard-student-list" id="dashboard-proposal-list">
                    <!-- Dynamically populated list for Proposals goes here -->
                </div>
            </section>
        </div>

        <!---view trigger--->

        <div class="nbfc-studentdashboardprofile-profile-section-container"
            id="nbfc-studentdashboardprofile-profile-section-container-id">
            <div class="nbfc-student-dashboard-section-main-contents"
                id="nbfc-student-dashboard-section-main-contents-id">
                <div class="studentdashboardprofile-profilesection" id="nbfc-studentdashboardprofile-profilesection">

                    <img src="{{ asset('assets/images/admin-student-profile.png') }}" class="profileImg"
                        id="profile-photo-id-nbfc" alt="Profile Image">

                 
                    <i class="fa-regular fa-pen-to-square" style="display: block;"></i>

                    <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data">
                    <div class="studentdashboardprofile-personalinfo">
                        <div class="personalinfo-firstrow" id="personalinfo-firstrow-id">
                            <h1>My Profile</h1>
                        </div>

                        <ul class="personalinfo-secondrow" id="personalinfo-secondrow-id">
                            <li style="margin-bottom: 3px; color: rgba(33, 33, 33, 1);">
                                Unique ID : <span class="personal_info_id"
                                    style="margin-left: 6px;">HBNKJI0000001</span>
                            </li>
                            <li class="personal_info_name" id="referenceNameId-nbfc">
                                <img src="assets/images/account_circle.png" alt="">
                                <p>John Doe</p>
                            </li>
                            <li class="personal_info_phone">
                                <img src="assets/images/call.png" alt="">
                                <p>+91 9876543210</p>
                            </li>
                            <li class="personal_info_email" id="referenceEmailId-nbfc">
                                <img src="assets/images/mail.png" alt="">
                                <p>john.doe@example.com</p>
                            </li>
                            <li class="personal_info_state">
                                <img src="assets/images/pin_drop.png" alt="">
                                <p>Karnataka</p>
                            </li>
                        </ul>

                        <ul class="personalinfosecondrow-editsection">
                            <li style="margin-bottom: 3px; color: rgba(33, 33, 33, 1);">
                                Unique ID : <span style="margin-left: 6px;">123456789</span>
                            </li>
                            <li class="personal_info_name">
                                <p>Name</p>
                                <input type="text" value="John Doe">
                            </li>
                            <li class="personal_info_phone">
                                <p>Phone</p>
                                <input type="text" value="+91 9876543210">
                            </li>
                            <li class="personal_info_email">
                                <p>Email</p>
                                <input type="email" value="john.doe@example.com">
                            </li>
                            <li class="personal_info_state">
                                <p>State</p>
                                <input type="text" value="Karnataka">
                            </li>
                        </ul>
                    </div>


                    <div class="studentdashboardprofile-educationeditsection"
                        id="studentdashboardprofile-educationeditsection-id-nbfc">
                        <div class="educationeditsection-firstrow">
                            <h1>Education</h1>
                            <!-- <button>Edit</button> -->
                        </div>
                        <div class="educationeditsection-secondrow" id="educationeditsection-secondrow-id">
                            <p>1. Bachelors</p>
                            <p>2. Consequuntur magni dolores</p>
                            <p>3. Voluptatem accusantium</p>
                        </div>
                    </div>

                    <div class="studentdashboardprofile-testscoreseditsection"
                        id="studentdashboardprofile-testscoreseditsection-id">
                        <div class="testscoreseditsection-firstrow">
                            <h1>Test Scores</h1>
                        </div>
                        <div class="testscoreseditsection-secondrow" id="testscoreseditsection-secondrow-id">
                            <p>1. IELTS <span class="ilets_score">7.5</span></p>
                            <p>2. GRE <span class="gre_score">320</span></p>
                            <p>3. TOEFL <span class="tofel_score">110</span></p>
                            <p>4. GMAT <span>650</span></p>
                        </div>

                        <div class="testscoreseditsection-secondrow-editsection" id="testscoreseditsection-secondrow-editsection-id">
                            <p>IELTS</p>
                            <input type="text" class="ilets_score" value="7.5">
                            <p>GRE</p>
                            <input type="text" class="gre_score" value="320">
                            <p>TOEFL</p>
                            <input type="text" class="tofel_score" value="110">
                        </div>
                    </div>
                </div>

                <div class="studentdashboardprofile-myapplication" id="studentdashboardprofile-myapplication-id">
                    <div class="myapplication-firstcolumn">
                        <h1>Application Details</h1>
                        <!-- <button>Edit</button> -->
                
                <div class="personalinfo-firstrow" id="personalinfo-firstrow-id">
                    <button onClick="triggerEditButton()">Edit</button>
                    <button class="saved-msg">Saved</button>
                </div>



                    </div>
                    <div class="myapplication-secondcolumn" id="myapplication-secondcolumn-id">
                        <p>1. Where are you planning to study</p>
                        <input type="text" id="plan-to-study-edit" disabled>
                        <div class="checkbox-group-edit" id="selected-study-location-edit">
                            <label>
                                <input type="checkbox" name="study-location-edit" value="USA" disabled> USA
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="UK" disabled> UK
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Ireland" disabled> Ireland
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="New Zealand" disabled> New
                                Zealand
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Germany" disabled> Germany
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="France" disabled> France
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Sweden" disabled> Sweden
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Other" id="other-checkbox-edit"
                                    disabled> Other
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Italy" disabled> Italy
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Canada" disabled> Canada
                            </label>
                            <label>
                                <input type="checkbox" name="study-location-edit" value="Australia" disabled> Australia
                            </label>
                            <label>
                                <div class="add-country-box-edit">
                                    <input type="text" id="country-edit" class="custom-country-edit"
                                        placeholder="Add Country">
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="myapplication-thirdcolumn" id="myapplication-thirdcolumn-id">
                        <h6>2. Type of Degree?</h6>
                        <div class="degreetypescheckboxes">
                            <!-- First radio button for Bachelors -->
                            <label class="custom-radio">
                                <input type="radio" name="education-level" value="Bachelors" checked
                                    onclick="toggleOtherDegreeInput(event)" disabled>
                                <span class="radio-button"></span>
                                <p>Bachelors (only secured loan)</p>
                            </label>

                            <br>

                            <!-- Second radio button for Masters -->
                            <label class="custom-radio">
                                <input type="radio" name="education-level" value="Masters" checked
                                    onclick="toggleOtherDegreeInput(event)" disabled>
                                <span class="radio-button"></span>
                                <p>Masters</p>
                            </label>

                            <br>

                            <!-- Third radio button for Others -->
                            <label class="custom-radio">
                                <input type="radio" name="education-level" value="Others" checked
                                    onclick="toggleOtherDegreeInput(event)" disabled>
                                <span class="radio-button"></span>
                                <p>Others</p>
                            </label>

                        </div>

                        <input type="text" placeholder="Enter degree type" value="Degree" id="otherDegreeInput"
                            disabled>

                    </div>

                    <div class="myapplication-fourthcolumn-additional" id="myapplication-fourthcolumn-additional-id">
                        <p>3. What is the duration of the course?</p>
                        <input type="text" placeholder="2 years" value="2 years" disabled>
                    </div>

                    <div class="myapplication-fourthcolumn" id="myapplication-fourthcolumn-id">
                        <p>4. What is the Loan amount required?</p>
                        <input type="number" placeholder="10" value="10" disabled>
                    </div>

                    <div class="myapplication-fifthcolumn" id="myapplication-fifthcolumn-id">
                        <p>Referral Code</p>
                        <input type="text" placeholder="ABC123" value="ABC123" disabled>
                    </div>

                    <div class="myapplication-sixthcolumn" id="myapplication-sixthcolumn-id">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>


                     <div class="myapplication-seventhcolumn" id="myapplication-seventhcolumn-id">
                        <h1>Attached Documents</h1>
                        <div class="seventhcolum-firstsection" id="seventhcolum-firstsection-id">
                            <div class="seventhcolumn-header">
                                <p>Student KYC Document</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>

                            <div class="kycdocumentscolumn" id="kycdocumentscolumn-id">
                                <div class="individualkycdocuments" id="individualkycdocuments-pan">
                                    <p class="document-name">Pan Card</p>
                                    <div class="inputfilecontainer">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="uploaded-pan-name">pan_card.jpg</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="vieindividualkycdocuments-panw-pan-card" />
                                    </div>

                                    <!-- PDF Preview Modal (hidden by default) -->
                                    <div id="pdf-preview-modal"
                                        style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background-color:rgba(0, 0, 0, 0.7); z-index:1000;">
                                        <div
                                            style="position:relative; margin: auto; width: 80%; height: 80%; background-color: white; overflow: auto;">
                                            <span id="close-modal"
                                                style="position:absolute; top:10px; right:10px; cursor:pointer; color: red; font-size: 24px;">&times;</span>
                                            <canvas id="pdf-preview-canvas" style="width: 100%;"></canvas>
                                        </div>
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-pancard" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individualkycdocuments" id="individualkycdocuments-aadhar">
                                    <p class="document-name">Aadhar Card</p>
                                    <div class="inputfilecontainer">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="uploaded-aadhar-name"> aadhar_card.jpg</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-aadhar-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-aadhar" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individualkycdocuments" id="individualkycdocuments-passport">
                                    <p class="document-name">Passport</p>
                                    <div class="inputfilecontainer">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="passport-name-selector"> Passport.pdf</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-passport-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-passposrt" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="seventhcolumn-additional" id="seventhcolumn-additional-id">
                        <div class="seventhcolumn-additional-firstcolumn" id="seventhcolumn-additional-firstcolumn-id">
                            <div class="seventhcolumnadditional-header">
                                <p>Academic Marksheets</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>

                            <div class="marksheetdocumentscolumn" id="marksheetdocumentscolumn-id">
                                <div class="individualmarksheetdocuments" id="individualmarksheetdocuments-10th-grade">
                                    <p class="document-name">10th grade marksheet</p>
                                    <div class="inputfilecontainer-marksheet">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="sslc-marksheet"> 10th grade marksheet</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-sslc-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-10th-marksheet" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individualmarksheetdocuments" id="individualmarksheetdocuments-12th-grade">
                                    <p class="document-name">12th grade marksheet</p>
                                    <div class="inputfilecontainer-marksheet">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="hsc-marksheet"> 12th grade marksheet</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-hsc-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-12th-marksheet" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individualmarksheetdocuments" id="individualmarksheetdocuments-graduation">
                                    <p class="document-name">Graduation marksheet</p>
                                    <div class="inputfilecontainer-marksheet">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="graduation-marksheet"> Graduation Marksheet</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-graduation-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-graduation-marksheet" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="myapplication-eightcolumn" id="myapplication-eightcolumn-id">
                        <div class="eightcolumn-firstsection" id="eightcolumn-firstsection-id">
                            <div class="eightcolumn-header">
                                <p>Secured Admissions</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="secured-admissioncolumn" id="secured-admissioncolumn-id">
                                <div class="individual-secured-admission-documents"
                                    id="individual-secured-admission-documents-10th-grade">
                                    <p class="document-name">10th Grade
                                    </p>
                                    <div class="inputfilecontainer-secured-admission">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="sslc-grade">SSLC Grade</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-sslc-grade"></>
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet">
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-secured-admission-documents"
                                    id="individual-secured-admission-documents-12th-grade">
                                    <p class="document-name">12th Grade
                                    </p>
                                    <div class="inputfilecontainer-secured-admission">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="hsc-grade">HSC Grade</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-hsc-grade"></>

                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet"
                                        id="inputfilecontainer-real-marksheet-id">
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-secured-admission-documents"
                                    id="individual-secured-admission-documents-graduation">
                                    <p class="document-name">Graduation</p>
                                    <div class="inputfilecontainer-secured-admission">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="graduation-grade">Graduation</p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-graduation-grade">
                                        </>
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet">
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="myapplication-ninthcolumn" id="myapplication-ninthcolumn-id">
                        <div class="ninthcolumn-firstsection">
                            <div class="ninthcolumn-header">

                                <p>Work Experience</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="work-experiencecolumn" id="work-experiencecolumn-id">
                                <div class="individual-work-experiencecolumn-documents" id="individual-work-experiencecolumn-documents-exp-letter">
                                    <p class="document-name">Experience Letter
                                    </p>
                                    <div class="inputfilecontainer-work-experiencecolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="experience-letter">Experience Letter</p>

                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-experience-letter">
                                        </>

                                    </div>
                                    <input type="file" id="inputfilecontainer-work-experience">

                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-work-experiencecolumn-documents" id="individual-work-experiencecolumn-documents-3-month-salary-slip">
                                    <p class="document-name">3 month Salary Slip
                                    </p>
                                    <div class="inputfilecontainer-work-experiencecolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="salary-slip">3 month salary slip</p>

                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-salary-slip"></>

                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet">

                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-work-experiencecolumn-documents" id="individual-work-experiencecolumn-documents-office-ids">
                                    <p class="document-name">Office ID
                                    </p>
                                    <div class="inputfilecontainer-work-experiencecolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="office-id">Office ID</p>

                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-office-id"></>

                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet">

                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individual-work-experiencecolumn-documents" id="individual-work-experiencecolumn-documents-employment-join-id">
                                    <p class="document-name">Employment Joining Letter
                                    </p>
                                    <div class="inputfilecontainer-work-experiencecolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="joining-letter">Joining Letter</p>

                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-joining-letter"></>

                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet">

                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="myapplication-tenthcolumn" id="myapplication-tenthcolumn-id">
                        <div class="tenthcolumn-firstsection" id="tenthcolumn-firstsection-id">
                            <div class="tenthcolumn-header">
                                <p>Co-borrower Documents</p>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="coborrower-kyccolumn" id="coborrower-kyccolumn-id">
                                <div class="individual-coborrower-kyc-documents" id="individual-coborrower-kyc-documents-pan_card-kyc-id">
                                    <p class="document-name">Pan Card
                                    </p>
                                    <div class="inputfilecontainer-coborrower-kyccolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="coborrower-pan-card">Pan Card</p>

                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-coborrower-pan"></>
                                    </div>
                                    <input type="file" id="inputfilecontainer-kyccoborrwer">
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-coborrower-kyc-documents" id="individual-coborrower-kyc-documents-aadhar-card-kyc-id">
                                    <p class="document-name">Aadhar Card
                                    </p>
                                    <div class="inputfilecontainer-coborrower-kyccolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="coborrower-aadharcard">Aadhar Card </p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-coborrower-aadhar">
                                        </>
                                    </div>
                                    <input type="file" id="inputfilecontainer-kyccoborrwer">
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-coborrower-kyc-documents" id="individual-coborrower-kyc-documents-address-proof-kyc-id">
                                    <p class="document-name">Address Proof
                                    </p>
                                    <div class="inputfilecontainer-coborrower-kyccolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="coborrower-addressproof">Address Proof </p>
                                        <img class="fa-eye" src="{{asset($viewIconPath)}}"
                                            id="view-coborrower-addressproof"></>
                                    </div>
                                    <input type="file" id="inputfilecontainer-kyccoborrwer">
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="myapplication-eleventhcolumn" id="myapplication-eleventhcolumn-id">

                        <button class="nbfc-send-proposal-button" id="openModalBtn">Send Proposal</button>

                        <div class="myapplication-eleventhcolumn-buttons">
                            <button class="nbfc-message-button" id="send-proposal-message-id">Message</button>
                            <button class="nbfc-reject-button" id="send-proposal-button-id">Reject</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="nbfc-send-proposal-modal-container" id="modelContainer-send-proposal">
            <div class="nbfc-send-proposal-modal-content">
                <div class="nbfc-send-proposal-modal-header">
                    <h3>Send Proposal</h3>
                    <button class="nbfc-send-proposal-close-button">&times;</button>
                </div>

                <textarea class="nbfc-send-proposal-remarks-textarea" placeholder="Add Remarks"></textarea>

                <div class="nbfc-send-proposal-attachment-section">
                    <label class="nbfc-send-proposal-attachment-label">Attachment</label>
                    <input type="file" id="fileInput" class="nbfc-send-proposal-attachment-input">
                    <button class="nbfc-send-proposal-attachment-button" id="attachmentBtn">+ Add Attachment</button>

                    <div class="nbfc-send-proposal-attachment-preview" id="attachmentPreview">
                        <div class="nbfc-send-proposal-file-info">
                            <span class="nbfc-send-proposal-file-name">No file selected</span>
                            <span class="nbfc-send-proposal-file-size"></span>
                        </div>
                        <button class="nbfc-send-proposal-close-button" id="removeAttachment">&times;</button>
                    </div>
                </div>

                <div class="nbfc-send-proposal-button-container">
                    <button class="nbfc-send-proposal-cancel-button">Cancel</button>
                    <button class="nbfc-send-proposal-send-button">Send</button>
                </div>
            </div>
        </div>







        <div class="modal-container" id="model-container-reject-container" style="display: none;">
            <div class="reject-application-modal" id="reject-application-id">
                <div class="reject-application-modal-header">
                    <h3>Reject Application</h3>
                    <button class="close-button" id="close-button-id">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="reject-application-modal-content" id="reject-application-modal-content-id">
                    <textarea class="remarks-textarea" placeholder="Add Remarks"></textarea>
                    <div class="actions">
                        <button class="cancel-button" id="cancel-button-id">Cancel</button>
                        <button class="reject-button" id="reject-button-id">Reject</button>
                    </div>
                </div>
            </div>
        </div>



        <section class="index-section" id="index-section-id-nbfc">
            <div class="inbox-container" style="display: none;">
                <div class="inbox-header">
                    <h2 class="dashboard-section-title">Inbox</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container">
                            <img src="assets/images/search.png" alt="Search" class="index-search-icon">
                            <input type="text" class="index-search-input" placeholder="Search">
                        </div>
                        <div class="inbox-filters" id="index-nbfc-sort-id">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="sort-dropdown-nbfc" id="sort-options-index-nbfc">
                                <li data-sort="az">A-Z</li>
                                <li data-sort="za">Z-A</li>
                                <li data-sort="newest">Newest</li>
                                <li data-sort="oldest">Oldest</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="message-thread">
                    <div class="message-item">
                        <div class="message-header">

                            <h2 class="student-name">Student Name</h2>
                            <div class="message-actions">
                                <button class="inbox-btn-view">View</button>
                                <button class="inbox-btn-close">Close</button>
                            </div>
                        </div>
                        <p class="message-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>

                    <div class="message-response">
                        <div class="message-response-container">
                            <p class="message-content-container">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
                                Lorem ipsum dolor sit amet.
                            </p>
                            <ol class="message-list">
                                <li>consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</li>
                                <li>eiusmod tempor incididunt ut.</li>
                            </ol>
                        </div>

                        <div class="nbfc-individual-bankmessage-input">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>

                    </div>

                </div>



                <div class="index-student-details-container">

                    <!-- Student Message Card 1 -->
                    <div class="index-student-message-container">
                        <div class="index-student-card">
                            <div class="index-student-info">
                                <h3 class="student-name">Student Name</h3>
                                <p class="index-student-description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut elit, sed do eiusmod tempor incididunt ut.
                                </p>
                            </div>
                            <div class="index-student-button-group">
                                <button class="index-student-message-btn">Message</button>
                                <button class="index-student-view-btn">View</button>
                            </div>
                            <div class="index-student-send-btn-mobile">
                                <img src="assets/images/send-index-btn.png" alt="the send image">
                            </div>
                        </div>
                        <div class="nbfc-individual-bankmessage-input-message">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
                    </div>

                    <!-- Student Message Card 2 -->
                    <div class="index-student-message-container">
                        <div class="index-student-card">
                            <div class="index-student-info">
                                <h3 class="student-name">Student Name</h3>
                                <p class="index-student-description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut elit, sed do eiusmod tempor incididunt ut.
                                </p>
                            </div>
                            <div class="index-student-button-group">
                                <button class="index-student-message-btn">Message</button>
                                <button class="index-student-view-btn">View</button>
                            </div>
                            <div class="index-student-send-btn-mobile">
                                <img src="assets/images/send-index-btn.png" alt="the send image">
                            </div>
                        </div>
                        <div class="nbfc-individual-bankmessage-input-message">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
                    </div>

                    <!-- Student Message Card 3 -->
                    <div class="index-student-message-container">
                        <div class="index-student-card">
                            <div class="index-student-info">
                                <h3 class="student-name">Student Name</h3>
                                <p class="index-student-description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut elit, sed do eiusmod tempor incididunt ut.
                                </p>

                            </div>
                            <div class="index-student-button-group">
                                <button class="index-student-message-btn">Message</button>
                                <button class="index-student-view-btn">View</button>
                            </div>
                            <div class="index-student-send-btn-mobile">
                                <img src="assets/images/send-index-btn.png" alt="the send image">
                            </div>
                        </div>
                        <div class="nbfc-individual-bankmessage-input-message">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
                    </div>

                    <!-- Student Message Card 4 -->
                    <div class="index-student-message-container">
                        <div class="index-student-card">
                            <div class="index-student-info">
                                <h3 class="student-name">Student Name</h3>
                                <p class="index-student-description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut elit, sed do eiusmod tempor incididunt ut.
                                </p>
                            </div>
                            <div class="index-student-button-group">
                                <button class="index-student-message-btn">Message</button>
                                <button class="index-student-view-btn">View</button>
                            </div>
                            <div class="index-student-send-btn-mobile">
                                <img src="assets/images/send-index-btn.png" alt="the send image">
                            </div>
                        </div>
                        <div class="nbfc-individual-bankmessage-input-message">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
                    </div>

                </div>


        </section>

        </div>


        <script>

            document.addEventListener('DOMContentLoaded', function () {


                // Reference elements
                const mobileMenuBtn = document.getElementById('nbfcMobileMenuBtn');
                const mobileSidebar = document.querySelector('.nbfc-mobile-sidebar');
                const mobileOverlay = document.querySelector('.nbfc-mobile-overlay');
                const nbfcNavRight = document.querySelector('.nbfc-nav-right'); // Select nav-right


                // Select elements for menu items
                const dashboardBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(1)'); // Dashboard
                const inboxBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(2)'); // Inbox
                const dashboardContainer = document.querySelector('.dashboard-sections-container');
                const inboxContainer = document.querySelector('.inbox-container');
                const requestsData = [

                ];

                const proposalsData = [

                ];

                //toggle function
                // Select the Dashboard and Inbox menu items
                const dashboardMenuItem = document.querySelector(".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(1)");
                const inboxMenuItem = document.querySelector(".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(2)");

                // Select the containers
                const dashboardSectionsContainer = document.querySelector(".dashboard-sections-container");

                const profileContainer = document.querySelector(".nbfc-studentdashboardprofile-profile-section-container"); // Profile container




                function checkWindowSize() {
                    if (window.innerWidth > 768) { // Hide mobile menu and sidebar for screens greater than 768px
                        mobileSidebar.classList.remove('active');
                        mobileOverlay.classList.remove('active');
                        mobileMenuBtn.style.display = 'none'; // Hide mobile menu button
                    } else {
                        mobileMenuBtn.style.display = 'block'; // Show mobile menu button for 768px and below
                    }
                }

                // Run function on page load and window resize
                checkWindowSize();
                window.addEventListener('resize', checkWindowSize);


                // Function to toggle the mobile sidebar and hide/show nav-right
                function toggleMobileSidebar() {
                    // Only toggle sidebar on mobile
                    if (window.innerWidth <= 768) {
                        mobileSidebar.classList.toggle('active');
                        mobileOverlay.classList.toggle('active');

                        // Hide nbfc-nav-right only on mobile
                        nbfcNavRight.classList.toggle('hidden');

                        const icon = mobileMenuBtn.querySelector('i');

                        if (icon.classList.contains('fa-bars')) {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        } else {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    }
                }

                // Event listener for the mobile menu button
                mobileMenuBtn.addEventListener('click', toggleMobileSidebar);

                // Close sidebar when clicking the overlay
                mobileOverlay.addEventListener('click', () => {
                    mobileSidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');

                    if (window.innerWidth <= 768) { // Show nav-right again only on mobile
                        nbfcNavRight.classList.remove('hidden');
                    }

                    const icon = mobileMenuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });

                // Function to remove 'active' class from both tabs and add to the clicked one
                function setActiveTab(selectedTab) {
                    // Remove the 'active' class from both menu items
                    dashboardBtn.classList.remove('active');
                    inboxBtn.classList.remove('active');

                    // Add the 'active' class to the selected tab
                    selectedTab.classList.add('active');
                }

                // Function to show the dashboard and hide the inbox
                dashboardBtn.addEventListener('click', () => {
                    // Hide sidebar when a menu item is clicked
                    mobileSidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');

                    // Show dashboard container and hide inbox container
                    dashboardContainer.style.display = 'block';
                    inboxContainer.style.display = 'none';

                    // Show nav-right again on mobile
                    nbfcNavRight.classList.remove('hidden');

                    // Change the mobile menu icon to 'bars' when sidebar is closed
                    const icon = mobileMenuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');

                    // Set the active tab
                    setActiveTab(dashboardBtn);
                });

                // Function to show the inbox and hide the dashboard
                inboxBtn.addEventListener('click', () => {
                    // Hide sidebar when a menu item is clicked
                    mobileSidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');

                    // Show inbox container and hide dashboard container
                    inboxContainer.style.display = 'block';
                    dashboardContainer.style.display = 'none';

                    // Show nav-right again on mobile
                    nbfcNavRight.classList.remove('hidden');

                    // Change the mobile menu icon to 'bars' when sidebar is closed
                    const icon = mobileMenuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');

                    // Set the active tab
                    setActiveTab(inboxBtn);
                });

                // Set default state (optional: show dashboard by default)
                dashboardContainer.style.display = 'block'; // Show the dashboard container initially
                inboxContainer.style.display = 'none'; // Hide the inbox container initially

                // Add 'active' class to dashboard by default
                setActiveTab(dashboardBtn);

                // Check window size on load and resize to handle sidebar visibility
                checkWindowSize();
                window.addEventListener('resize', checkWindowSize);



                function sortList(listId, sortType) {
                    const list = document.getElementById(listId);
                    const items = Array.from(list.children);

                    let sortedItems;

                    if (sortType === 'A-Z') {
                        sortedItems = items.sort((a, b) => {
                            const aName = a.querySelector('.dashboard-student-name').textContent.toLowerCase();
                            const bName = b.querySelector('.dashboard-student-name').textContent.toLowerCase();
                            return aName.localeCompare(bName);
                        });
                    } else if (sortType === 'Z-A') {
                        sortedItems = items.sort((a, b) => {
                            const aName = a.querySelector('.dashboard-student-name').textContent.toLowerCase();
                            const bName = b.querySelector('.dashboard-student-name').textContent.toLowerCase();
                            return bName.localeCompare(aName);
                        });
                    } else if (sortType === 'Newest') {
                        sortedItems = items.sort((a, b) => {
                            const aId = parseInt(a.getAttribute('data-id'));
                            const bId = parseInt(b.getAttribute('data-id'));
                            return bId - aId; // Higher ID means newer
                        });
                    } else if (sortType === 'Oldest') {
                        sortedItems = items.sort((a, b) => {
                            const aId = parseInt(a.getAttribute('data-id'));
                            const bId = parseInt(b.getAttribute('data-id'));
                            return aId - bId; // Lower ID means older
                        });
                    }

                    // Re-append sorted items to the list
                    sortedItems.forEach(item => list.appendChild(item));
                }


                // Function to show/hide sort options
                function toggleSortOptions(button) {
                    const sortOptions = button.nextElementSibling;
                    const isVisible = sortOptions.style.display === 'block';
                    sortOptions.style.display = isVisible ? 'none' : 'block';
                }

                // Add event listeners for sorting buttons
                document.querySelectorAll('.dashboard-sort-button').forEach(button => {
                    button.addEventListener('click', function () {
                        toggleSortOptions(button);
                    });
                });

                // Add event listeners for individual sort options
                document.querySelectorAll('.dashboard-sort-option').forEach(option => {
                    option.addEventListener('click', function () {
                        const sortType = this.getAttribute('data-sort');
                        const section = this.closest('.dashboard-section');
                        const listId = section.querySelector('.dashboard-student-list').id;

                        // Sort the list based on the selected option
                        sortList(listId, sortType);

                        // Close the dropdown after sorting
                        const sortOptions = section.querySelector('.dashboard-sort-options');
                        sortOptions.style.display = 'none';
                    });
                });



                // Function to update active state
                function setActiveMenuItem(activeItem) {
                    // Remove nbfcactive class from all menu items
                    document.querySelectorAll(".nbfcstudentdashboardprofile-sidebarlists-top li").forEach(item => {
                        item.classList.remove('nbfcactive');
                    });
                    // Add nbfcactive class to clicked item
                    activeItem.classList.add('nbfcactive');
                }

                // Add event listener to Dashboard menu item
                dashboardMenuItem.addEventListener("click", function () {
                    // Hide inbox, show dashboard sections
                    inboxContainer.style.display = "none";
                    dashboardSectionsContainer.style.display = "grid";
                    // Ensure profile container stays hidden until view button is clicked
                    profileContainer.style.display = "none";
                    // Set active state for dashboard
                    setActiveMenuItem(dashboardMenuItem);
                });


                // Add event listener to Inbox menu item
                inboxMenuItem.addEventListener("click", function () {
                    // Hide dashboard sections completely, show inbox
                    dashboardSectionsContainer.style.display = "none";
                    inboxContainer.style.display = "block";
                    // Hide profile container when inbox is clicked
                    profileContainer.style.display = "none";
                    // Set active state for inbox
                    setActiveMenuItem(inboxMenuItem);
                });


                // Set initial states
                dashboardSectionsContainer.style.display = "grid";
                inboxContainer.style.display = "none";
                profileContainer.style.display = "none"; // Ensure profile starts hidden
                // Set initial active state to dashboard
                setActiveMenuItem(dashboardMenuItem);

                // Add CSS to ensure the hiding works
                document.head.insertAdjacentHTML('beforeend', `
    <style>
    .dashboard-sections-container[style*="display: none"] {
        display: none !important;
    }
    </style>
`);


                // Select all message buttons
                const messageButtons = document.querySelectorAll(".index-student-message-btn");

                messageButtons.forEach(button => {
                    button.addEventListener("click", function () {
                        // Find the closest parent container (index-student-message-container)
                        const parentContainer = this.closest(".index-student-message-container");

                        // Find the corresponding message input box inside the same container
                        const messageInputBox = parentContainer.querySelector(".nbfc-individual-bankmessage-input-message");

                        // Toggle visibility
                        if (messageInputBox.style.display === "none" || messageInputBox.style.display === "") {
                            messageInputBox.style.display = "flex";
                        } else {
                            messageInputBox.style.display = "none";
                        }
                    });
                });





                function filterData(data, searchTerm) {
                    return data.filter(item =>
                        item.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                        item.studentId.toLowerCase().includes(searchTerm.toLowerCase())
                    );
                }

                // Add event listener to the search input
                const searchInput = document.querySelector(".nbfc-search-input");

                searchInput.addEventListener("input", () => {
                    const searchTerm = searchInput.value;

                    // Get the current active section to determine which list to filter
                    const requestListContainer = document.getElementById("dashboard-request-list");
                    const proposalListContainer = document.getElementById("dashboard-proposal-list");

                    // Filter and update both lists
                    const filteredRequests = filterData(requestsData, searchTerm);
                    const filteredProposals = filterData(proposalsData, searchTerm);

                    populateStudentList("dashboard-request-list", filteredRequests);
                    populateStudentList("dashboard-proposal-list", filteredProposals);
                });


                // Function to handle search for Requests
                function handleRequestsSearch() {
                    const searchInput = document.querySelector("#dashboard-nbfc-search-container-section-request .dashboard-nbfc-search-input-sec");
                    const requestListContainer = document.getElementById("dashboard-request-list");

                    searchInput.addEventListener("input", () => {
                        const searchTerm = searchInput.value;
                        const filteredRequests = filterData(requestsData, searchTerm);
                        populateStudentList("dashboard-request-list", filteredRequests);
                    });
                }

                // Assuming `requestsData` contains the list of requests
                handleRequestsSearch();


                function handleProposalsSearch() {
                    const searchInput = document.querySelector("#dashboard-nbfc-search-container-section-proposal .dashboard-nbfc-search-input-sec");
                    const proposalListContainer = document.getElementById("dashboard-proposal-list");

                    searchInput.addEventListener("input", () => {
                        const searchTerm = searchInput.value;
                        const filteredProposals = filterData(proposalsData, searchTerm);
                        populateStudentList("dashboard-proposal-list", filteredProposals);
                    });
                }

                // Call the function to initialize search functionality
                handleProposalsSearch();

                // Modal Container and Buttons
                const modalContainer = document.querySelector(".modal-container");
                const closeButton = document.querySelector(".close-button");
                const cancelButton = document.querySelector(".cancel-button");



                const rejectButtons = document.querySelectorAll(".reject-button");

                rejectButtons.forEach((rejectButton, index) => {
                    rejectButton.addEventListener("click", function () {
                         
                    });
                });

                if (closeButton) {
                    closeButton.addEventListener("click", function () {
                        modalContainer.style.display = "none"; // Hide the modal
                    });
                }

                if (cancelButton) {
                    cancelButton.addEventListener("click", function () {
                        modalContainer.style.display = "none"; // Hide the modal
                    });
                }




                // Sample Data for Requests and Proposals

                const initializeTraceViewNBFC = (requestsData, proposalsData) => {

                    var user = @json(session('user'));
                    

                    if (user && user.nbfc_id) {
                        const nbfcId = user.nbfc_id;

                        // Make a POST request to /trace-process
                        fetch('/trace-process', {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ nbfcId }) // Sending the NBFC ID
                        })
                            .then((response) => {
                                // Check if response is OK
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json(); // Parse response to JSON
                            })
                            .then((data) => {
                                // Clear existing data
                                requestsData.length = 0;
                                proposalsData.length = 0;

                                // Check if data and returnValues are available
                                if (data && data.returnValues && Array.isArray(data.returnValues)) {
                                    // Iterate over returnValues
                                    for (const [index, item] of data.returnValues.entries()) {
                                        if (item.type === 'request') {
                                            // Push into requestsData
                                            requestsData.push({
                                                id: index + 1,
                                                name: item.name,
                                                studentId: item.unique_id
                                            });
                                            console.log(requestsData);
                                            populateStudentList("dashboard-request-list", requestsData);

                                        } else if (item.type === 'proposal') {
                                            // Push into proposalsData
                                            proposalsData.push({
                                                id: index + 1,
                                                name: item.name,
                                                studentId: item.unique_id
                                            });
                                            console.log(proposalsData);
                                            populateStudentList("dashboard-proposal-list", proposalsData);


                                        }
                                    }


                                } else {
                                    console.error("Invalid data structure or returnValues not found.");
                                }
                            })
                            .catch((error) => {
                                // Handle any errors during the fetch process
                                console.error("Error fetching data:", error);
                            });
                    } else {
                        console.error('NBFC ID not found or user session is invalid.');
                    }
                };

                                                initializeTraceViewNBFC(requestsData, proposalsData);




                function populateStudentList(sectionId, data) {
                    const studentListContainer = document.getElementById(sectionId);

                    studentListContainer.innerHTML = ""; // Clear existing list items

                    data.forEach((student) => {
                         const studentListItem = createStudentListItem(student);
                        studentListContainer.appendChild(studentListItem);
                    });
                }



                function createStudentListItem(student) {
                    const listItem = document.createElement("div");
                    listItem.classList.add("dashboard-student-item");
                    listItem.setAttribute("data-id", student.id);

                    const studentInfo = document.createElement("div");
                    studentInfo.classList.add("dashboard-student-info");

                    const studentName = document.createElement("div");
                    studentName.classList.add("dashboard-student-name");
                    studentName.textContent = student.name;

                    const studentId = document.createElement("div");
                    studentId.classList.add("dashboard-student-id");
                    studentId.textContent = student.studentId;

                    studentInfo.appendChild(studentName);
                    studentInfo.appendChild(studentId);

                    const actionButtons = document.createElement("div");
                    actionButtons.classList.add("dashboard-action-buttons");

                    const viewButton = document.createElement("button");
                    viewButton.classList.add("dashboard-view-button");
                    viewButton.innerHTML = '<i class="fa-solid fa-eye eye-icon"></i>';

                    viewButton.addEventListener("click", function () {
                        // Get all relevant containers
                        const dashboardContainer = document.querySelector('.dashboard-sections-container');
                        const profileContainer = document.querySelector('.nbfc-studentdashboardprofile-profile-section-container');
                        const myApplicationContainer = document.querySelector('.studentdashboardprofile-myapplication');

                        // Hide dashboard container
                        dashboardContainer.style.display = 'none';

                        // Show profile container
                        profileContainer.style.display = 'block';

                        // Show my application container and set its display to flex
                        if (myApplicationContainer) {
                            myApplicationContainer.style.display = 'flex';

                        }
                    });

                    const rejectButton = document.createElement("button");
                    rejectButton.classList.add("dashboard-reject-button");
                    rejectButton.textContent = "Reject";
                    rejectButton.addEventListener("click", function () {
                         
                        showRejectModal(student);
                    });

                    actionButtons.appendChild(viewButton);
                    actionButtons.appendChild(rejectButton);

                    listItem.appendChild(studentInfo);
                    listItem.appendChild(actionButtons);

                    return listItem;
                }


                // Function to populate student list for a given section

                // Function to show the reject modal
                function showRejectModal(student) {
                    const modal = document.querySelector('.modal-container');
                    modal.style.display = 'flex';  
                    alert(student);
                     
                }

                // Populate both the "Requests" and "Proposals" lists

                //chat functionality
                // Select elements
                const messageInput = document.querySelector(".nbfc-message-input");
                const sendButton = document.querySelector(".nbfc-send-img");
                const inputContainer = document.querySelector(".nbfc-individual-bankmessage-input");
                const viewButton = document.querySelector(".view");
                const smileIcon = document.querySelector(".nbfc-face-smile");
                const paperclipIcon = document.querySelector(".nbfc-paperclip");

                let isNBFC = true;

                // Create messages wrapper if it doesn't exist
                let messagesWrapper = document.querySelector(".messages-wrapper");
                if (!messagesWrapper) {
                    messagesWrapper = document.createElement("div");
                    messagesWrapper.classList.add("messages-wrapper");
                    messagesWrapper.style.cssText = `
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 20px;
            padding: 20px 0;
        `;
                    inputContainer.parentNode.insertBefore(messagesWrapper, inputContainer);
                }

                // Load messages from localStorage if any
                function loadMessages() {
                    const savedMessages = JSON.parse(localStorage.getItem('messages'));
                    if (savedMessages && Array.isArray(savedMessages)) {
                        savedMessages.forEach(content => {
                            createMessage(content);
                        });
                    }
                }

                // Create message in the chat
                function createMessage(content) {
                    // Create the outer container for right alignment
                    const alignmentContainer = document.createElement("div");
                    alignmentContainer.style.cssText = `
            display: flex;
            justify-content: flex-end;
            width: 100%;
        `;

                    // Create the message container with proper width and styling
                    const messageContainer = document.createElement("div");
                    messageContainer.style.cssText = `
            width: 100%;
            padding: 5px;
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            margin-left: auto;
        `;

                    // Create the message content
                    const messageContent = document.createElement("div");
                    messageContent.style.cssText = `
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 14px;
            color: #909090;
            line-height: 1.5;
            padding: 4px 5px;
        `;

                    // Handle content formatting
                    if (content.startsWith('📎')) {
                        messageContent.textContent = content;
                    } else if (content.includes("\n")) {
                        content.split("\n").forEach((line, index) => {
                            if (line.trim()) {
                                if (index > 0) {
                                    messageContent.appendChild(document.createElement("br"));
                                }
                                messageContent.appendChild(document.createTextNode(line.trim()));
                            }
                        });
                    } else {
                        messageContent.textContent = content;
                    }

                    // Assemble the message structure
                    messageContainer.appendChild(messageContent);
                    alignmentContainer.appendChild(messageContainer);
                    messagesWrapper.appendChild(alignmentContainer);

                    // Scroll only the chat container to the latest message
                    messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                }

                // Function to send message
                function sendMessage() {
                    if (!messageInput) return;
                    const content = messageInput.value.trim();
                    if (content) {
                        createMessage(content);

                        // Save the message to localStorage
                        let savedMessages = JSON.parse(localStorage.getItem('messages')) || [];
                        savedMessages.push(content);
                        localStorage.setItem('messages', JSON.stringify(savedMessages));

                        messageInput.value = "";
                    }
                }

                // Add event listeners
                if (sendButton) sendButton.addEventListener("click", sendMessage);
                if (messageInput) {
                    messageInput.addEventListener("keypress", function (e) {
                        if (e.key === "Enter") {
                            e.preventDefault();
                            sendMessage();
                        }
                    });
                }

                // Emoji Picker functionality
                if (smileIcon) {
                    smileIcon.addEventListener("click", function (e) {
                        e.stopPropagation();
                        const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];

                        const existingPicker = document.querySelector(".emoji-picker");
                        if (existingPicker) {
                            existingPicker.remove();
                            return;
                        }

                        const picker = document.createElement("div");
                        picker.classList.add("emoji-picker");
                        picker.style.cssText = `
                position: absolute;
                bottom: 100%;
                right: 0;
                background: white;
                border: 1px solid #e2e2e2;
                border-radius: 5px;
                padding: 5px;
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                z-index: 1000;
            `;

                        emojis.forEach(emoji => {
                            const button = document.createElement("button");
                            button.textContent = emoji;
                            button.style.cssText = `
                    border: none;
                    background: none;
                    font-size: 20px;
                    cursor: pointer;
                    padding: 5px;
                `;
                            button.onclick = (e) => {
                                e.stopPropagation();
                                if (messageInput) {
                                    messageInput.value += emoji;
                                    picker.remove();
                                    messageInput.focus();
                                }
                            };
                            picker.appendChild(button);
                        });

                        smileIcon.parentElement.appendChild(picker);

                        document.addEventListener("click", function closePicker(e) {
                            if (!picker.contains(e.target) && e.target !== smileIcon) {
                                picker.remove();
                                document.removeEventListener("click", closePicker);
                            }
                        });
                    });
                }

                // File attachment functionality
                // File attachment functionality
                if (paperclipIcon) {
                    paperclipIcon.addEventListener("click", function () {
                        const fileInput = document.createElement("input");
                        fileInput.type = "file";
                        fileInput.accept = ".pdf,.doc,.docx,.txt";
                        fileInput.style.display = "none";

                        fileInput.onchange = (e) => {
                            const file = e.target.files[0];
                            if (file) {
                                // Get the file name and size
                                const fileName = file.name;
                                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB

                                // Create the message container
                                const alignmentContainer = document.createElement("div");
                                alignmentContainer.style.cssText = `
                    display: flex;
                    justify-content: flex-end;
                    width: 100%;
                `;

                                const messageContainer = document.createElement("div");
                                messageContainer.style.cssText = ` 
                    width: 665px;
                    padding: 10px;
                    border: 1px solid #e2e2e2;
                    border-radius: 4px;
                    margin-left: auto;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                `;

                                // Create message content
                                const messageText = document.createElement("div");
                                messageText.style.cssText = `
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                    font-size: 14px;
                    color: #909090;
                    line-height: 1.5;
                    padding: 4px 5px;
                    flex: 1;
                `;
                                messageText.textContent = `${fileName} (${fileSize} MB)`;

                                // Create remove icon (using SVG)
                                const removeIcon = document.createElement("button");
                                removeIcon.style.cssText = `
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 18px;
                    padding: 0;
                    margin-left: 10px;
                    display: flex;
                    justify-content: flex-end;
                `;
                                removeIcon.innerHTML = `
                    <svg width="16" height="16" fill="black" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.146 3.854a.5.5 0 0 0-.708 0L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.146-3.146a.5.5 0 0 0 0-.708z"/>
                    </svg>
                `;
                                removeIcon.onclick = () => {
                                    // Remove the message and reset the file input
                                    messagesWrapper.removeChild(alignmentContainer);

                                    // Remove file data from localStorage
                                    let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                                    savedFiles = savedFiles.filter(f => f.fileName !== fileName);
                                    localStorage.setItem('files', JSON.stringify(savedFiles));
                                };

                                // Append remove icon to the message
                                messageContainer.appendChild(messageText);
                                messageContainer.appendChild(removeIcon);

                                // Assemble the message structure
                                alignmentContainer.appendChild(messageContainer);
                                messagesWrapper.appendChild(alignmentContainer);

                                // Scroll to the bottom of the chat
                                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

                                // Save file data to localStorage
                                let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                                savedFiles.push({ fileName, fileSize });
                                localStorage.setItem('files', JSON.stringify(savedFiles));
                            }
                        };

                        // Trigger the file input dialog
                        document.body.appendChild(fileInput);
                        fileInput.click();
                        document.body.removeChild(fileInput);
                    });
                }

                // Load files from localStorage when the page loads
                function loadFiles() {
                    const savedFiles = JSON.parse(localStorage.getItem('files'));
                    if (savedFiles && Array.isArray(savedFiles)) {
                        savedFiles.forEach(file => {
                            const alignmentContainer = document.createElement("div");
                            alignmentContainer.style.cssText = `
                display: flex;
                justify-content: flex-end;
                width: 100%;
            `;

                            const messageContainer = document.createElement("div");
                            messageContainer.style.cssText = ` 
                width: 665px;
                padding: 10px;
                border: 1px solid #e2e2e2;
                border-radius: 4px;
                margin-left: auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            `;

                            // Create message content
                            const messageText = document.createElement("div");
                            messageText.style.cssText = `
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
                font-size: 14px;
                color: #909090;
                line-height: 1.5;
                padding: 4px 5px;
                flex: 1;
            `;
                            messageText.textContent = `${file.fileName} (${file.fileSize} MB)`;

                            // Create remove icon (using SVG)
                            const removeIcon = document.createElement("button");
                            removeIcon.style.cssText = `
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
                padding: 0;
                margin-left: 10px;
                display: flex;
                justify-content: flex-end;
            `;
                            removeIcon.innerHTML = `
                <svg width="16" height="16" fill="black" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.146 3.854a.5.5 0 0 0-.708 0L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.146-3.146a.5.5 0 0 0 0-.708z"/>
                </svg>
            `;
                            removeIcon.onclick = () => {
                                // Remove the message and reset the file input
                                messagesWrapper.removeChild(alignmentContainer);

                                // Remove file data from localStorage
                                let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                                savedFiles = savedFiles.filter(f => f.fileName !== file.fileName);
                                localStorage.setItem('files', JSON.stringify(savedFiles));
                            };

                            // Append remove icon to the message
                            messageContainer.appendChild(messageText);
                            messageContainer.appendChild(removeIcon);

                            // Assemble the message structure
                            alignmentContainer.appendChild(messageContainer);
                            messagesWrapper.appendChild(alignmentContainer);

                            // Scroll to the bottom of the chat
                            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                        });
                    }
                }

                // Load files when the page is refreshed
                loadFiles();


                // View/Close functionality
                if (viewButton && closeButton) {
                    viewButton.addEventListener("click", function () {
                        messagesWrapper.style.display = "block";
                        inputContainer.style.display = "flex";
                        viewButton.style.display = "none";
                        closeButton.style.display = "inline-block";
                    });

                    closeButton.addEventListener("click", function () {
                        messagesWrapper.style.display = "none";
                        inputContainer.style.display = "none";
                        closeButton.style.display = "none";
                        viewButton.style.display = "inline-block";
                    });
                }

                // Initially hide chat if view button exists
                if (viewButton) {
                    messagesWrapper.style.display = "none";
                    inputContainer.style.display = "none";
                    closeButton.style.display = "none";
                }

                // Load previous messages when the page is refreshed
                loadMessages();


                // Select buttons and message response container
                const viewButtonIndex = document.querySelector(".inbox-btn-view");
                const closeButtonIndex = document.querySelector(".inbox-btn-close");
                const messageResponse = document.querySelector(".message-response");

                // Initially hide the message response container
                messageResponse.style.display = "none";

                // Function to handle "View" button click
                if (viewButtonIndex) {
                    viewButtonIndex.addEventListener("click", function () {
                        // Show the message response container
                        messageResponse.style.display = "block";
                    });
                }

                // Function to handle "Close" button click
                if (closeButtonIndex) {
                    closeButtonIndex.addEventListener("click", function () {
                        // Hide the message response container
                        messageResponse.style.display = "none";
                    });
                }


            });

            //nbfc-student
            const modalContainer = document.getElementById('modelContainer-send-proposal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeButtons = document.querySelectorAll('.nbfc-send-proposal-close-button');
            const fileInput = document.getElementById('fileInput');
            const attachmentBtn = document.getElementById('attachmentBtn');
            const attachmentPreview = document.getElementById('attachmentPreview');
            const removeAttachment = document.getElementById('removeAttachment');
            const fileName = document.querySelector('.nbfc-send-proposal-file-name');
            const fileSize = document.querySelector('.nbfc-send-proposal-file-size');
            const cancelButton = document.querySelector('.nbfc-send-proposal-cancel-button');
            const sendButton = document.querySelector('.nbfc-send-proposal-send-button');

            function openModal() {
                modalContainer.style.display = 'flex';
            }

            function closeModal() {
                modalContainer.style.display = 'none';
                clearFileInput();
            }

            function clearFileInput() {
                fileInput.value = '';
                attachmentPreview.style.display = 'none';
                fileName.textContent = 'No file selected';
                fileSize.textContent = '';
            }

            attachmentBtn.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
                    attachmentPreview.style.display = 'flex';
                }
            });

            removeAttachment.addEventListener('click', clearFileInput);
            openModalBtn.addEventListener('click', openModal);
            closeButtons.forEach(button => button.addEventListener('click', closeModal));
            cancelButton.addEventListener('click', closeModal);
            sendButton.addEventListener('click', closeModal);

            //nbfc reject button

            document.addEventListener("DOMContentLoaded", function () {
                // Select modal elements
                const modalContainer = document.getElementById("model-container-reject-container");
                const closeButton = document.getElementById("close-button-id");
                const cancelButton = document.getElementById("cancel-button-id");
                const sendProposalRejectButton = document.getElementById("send-proposal-button-id");

                // Function to show the modal
                function showRejectModal() {
                    if (modalContainer) {
                        modalContainer.style.display = "flex"; // Show modal
                    }
                }

                // Function to hide the modal
                function hideRejectModal() {
                    if (modalContainer) {
                        modalContainer.style.display = "none"; // Hide modal
                    }
                }

                // Show modal when clicking the ".nbfc-reject-button"
                if (sendProposalRejectButton) {
                    sendProposalRejectButton.addEventListener("click", showRejectModal);
                }

                // Close modal when clicking "X" or "Cancel"
                if (closeButton) {
                    closeButton.addEventListener("click", hideRejectModal);
                }

                if (cancelButton) {
                    cancelButton.addEventListener("click", hideRejectModal);
                }

                // const rejectButtons = document.querySelectorAll(".reject-button");
                // rejectButtons.forEach((rejectButton) => {
                //     rejectButton.addEventListener("click", function () {
                //         alert("Application Rejected");

                //     });
                // });

                // Close modal when clicking outside the modal
                if (modalContainer) {
                    modalContainer.addEventListener("click", function (event) {
                        if (event.target === modalContainer) {
                            hideRejectModal();
                        }
                    });
                }
            });

           
            const initialiseSeventhcolumn = () => {
                const section = document.querySelector('.seventhcolum-firstsection');

                section.addEventListener('click', function () {
                    if (section.style.height === '') {
                        section.style.height = 'fit-content';
                    } else {
                        section.style.height = '';
                    }
                });
            };

            const initialiseSeventhAdditionalColumn = () => {
                const section = document.querySelector('.seventhcolumn-additional-firstcolumn');

                section.addEventListener('click', function () {
                    if (section.style.height === '') {
                        section.style.height = 'fit-content';
                    } else {
                        section.style.height = '';
                    }
                });
            };

            // Initialize the columns
            initialiseSeventhcolumn();
            initialiseSeventhAdditionalColumn();

         

// Function to initialize the eighth column
const initialiseEightcolumn = () => {
    const section = document.querySelector('.eightcolumn-firstsection');
    
    section.addEventListener('click', function() {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });
}

// Function to initialize the ninth column
const initialiseNinthcolumn = () => {
    const section = document.querySelector('.ninthcolumn-firstsection');
    
    section.addEventListener('click', function() {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });
}

// Function to initialize the tenth column
const initialiseTenthcolumn = () => {
    const section = document.querySelector('.tenthcolumn-firstsection');
    
    section.addEventListener('click', function() {
        if (section.style.height === '') {
            section.style.height = 'fit-content';
        } else {
            section.style.height = '';
        }
    });
}

// Function to initialize all columns at once
const initialiseAllColumns = () => {
    initialiseEightcolumn();
    initialiseNinthcolumn();
    initialiseTenthcolumn();
}

// Call this when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', initialiseAllColumns);



//Student KYC Document
const initializeKycDocumentUpload = () => {
    // Get the main container
    const kycDocumentsColumn = document.getElementById('kycdocumentscolumn-id');
    
    // Check if the element exists
    if (!kycDocumentsColumn) {
        console.error("KYC documents column not found!");
        return;
    }
    
    // Get all individual KYC document containers
    const individualKycDocumentsUpload = kycDocumentsColumn.querySelectorAll(".individualkycdocuments");

    // Helper function to truncate long filenames
    const truncateFileName = (fileName) => {
        if (fileName.length > 20) {
            const extension = fileName.slice(fileName.lastIndexOf('.'));
            return fileName.slice(0, 17) + '...' + extension;
        }
        return fileName;
    };

    // Process each KYC document container
    individualKycDocumentsUpload.forEach((card) => {
        let uploadedFile = null;
        const documentId = card.id; // Get the ID of the current document container
        
        // Get specific elements for this card based on its type
        let fileInput, fileNameDisplay;
        
        if (documentId === 'individualkycdocuments-pan') {
            fileInput = document.getElementById('inputfilecontainer-real-pancard');
            fileNameDisplay = card.querySelector('.uploaded-pan-name');
        } else if (documentId === 'individualkycdocuments-aadhar') {
            fileInput = document.getElementById('inputfilecontainer-real-aadhar');
            fileNameDisplay = card.querySelector('.uploaded-aadhar-name');
        } else if (documentId === 'individualkycdocuments-passport') {
            fileInput = document.getElementById('inputfilecontainer-real-passposrt');
            fileNameDisplay = card.querySelector('.passport-name-selector');
        } else {
            console.error(`Unknown document type: ${documentId}`);
            return;
        }
        
        const statusDisplay = card.querySelector('.document-status');
        const previewIcon = card.querySelector('.fa-eye');
        
        // Verify that required elements exist
        if (!fileInput || !fileNameDisplay || !statusDisplay) {
            console.error(`Missing required elements for ${documentId}`);
            return;
        }
        
        console.log(`Initializing ${documentId} with file input: ${fileInput.id}`);
        
        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer').addEventListener('click', function(event) {
            // Prevent triggering if the eye icon was clicked
            if (event.target !== previewIcon && !event.target.closest('.fa-eye')) {
                console.log(`Clicking container for ${documentId}`);
                fileInput.click();
            }
        });

        // Handle file selection and validation
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            // Ensure file is selected
            if (!file) return;

            console.log(`Selected file for ${documentId}:`, file);

            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input
                fileNameDisplay.textContent = 'No file chosen';
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input
                fileNameDisplay.textContent = 'No file chosen';
                return;
            }

            // Store the file and update UI
            uploadedFile = file;
            const truncatedFileName = truncateFileName(file.name);
            fileNameDisplay.textContent = truncatedFileName;

            // Update file size display
            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            statusDisplay.textContent = `${fileSize} uploaded`;

            console.log(`File uploaded for ${documentId}:`, uploadedFile);
        });

        // Handle preview functionality
        if (previewIcon) {
            previewIcon.addEventListener('click', function(event) {
                event.stopPropagation();
                
                if (previewIcon.classList.contains('preview-active')) {
                    // Close preview if it's already active
                    const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                    if (previewWrapper) previewWrapper.remove();
                    const overlay = document.querySelector('.pdf-preview-overlay');
                    if (overlay) overlay.remove();
                    previewIcon.classList.remove('preview-active');
                } else {
                    // Open preview if a valid file exists
                    if (uploadedFile && uploadedFile.type === 'application/pdf') {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            // Create wrapper for the preview
                            const previewWrapper = document.createElement('div');
                            previewWrapper.className = 'pdf-preview-wrapper';
                            previewWrapper.style.cssText = `
                                position: fixed;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                width: 90%;
                                height: 90vh;
                                background-color: white;
                                display: flex;
                                flex-direction: column;
                                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                                z-index: 1000;
                            `;

                            // Add overlay
                            const overlay = document.createElement('div');
                            overlay.className = 'pdf-preview-overlay';
                            overlay.style.cssText = `
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.5);
                                z-index: 999;
                            `;

                            // Create header
                            const header = document.createElement('div');
                            header.style.cssText = `
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                padding: 8px 16px;
                                background-color: #1a1a1a;
                                color: white;
                                height: 40px;
                            `;

                            // Left section with filename
                            const fileNameSection = document.createElement('div');
                            fileNameSection.style.cssText = `
                                display: flex;
                                align-items: center;
                                gap: 8px;
                            `;

                            const fileName = document.createElement('span');
                            fileName.textContent = uploadedFile.name;
                            fileName.style.cssText = `
                                color: white;
                                font-size: 14px;
                            `;
                            fileNameSection.appendChild(fileName);

                            // Middle section with zoom controls
                            const zoomControls = document.createElement('div');
                            zoomControls.style.cssText = `
                                display: flex;
                                align-items: center;
                                gap: 12px;
                                position: absolute;
                                left: 50%;
                                transform: translateX(-50%);
                            `;

                            const zoomOut = document.createElement('button');
                            zoomOut.innerHTML = '&#8722;';
                            const zoomIn = document.createElement('button');
                            zoomIn.innerHTML = '&#43;';

                            [zoomOut, zoomIn].forEach(btn => {
                                btn.style.cssText = `
                                    background: none;
                                    border: none;
                                    color: white;
                                    font-size: 18px;
                                    cursor: pointer;
                                    padding: 4px 8px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                `;
                            });

                            zoomControls.appendChild(zoomOut);
                            zoomControls.appendChild(zoomIn);

                            // Close button
                            const closeButton = document.createElement('button');
                            closeButton.innerHTML = '&#10005;';
                            closeButton.style.cssText = `
                                background: none;
                                border: none;
                                color: white;
                                font-size: 18px;
                                cursor: pointer;
                                padding: 4px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            `;

                            const closePreview = () => {
                                previewWrapper.remove();
                                overlay.remove();
                                previewIcon.classList.remove('preview-active');
                            };

                            closeButton.addEventListener('click', closePreview);
                            overlay.addEventListener('click', closePreview);

                            // Assemble header
                            header.appendChild(fileNameSection);
                            header.appendChild(zoomControls);
                            header.appendChild(closeButton);

                            // Create iframe for PDF content
                            const iframe = document.createElement('iframe');
                            iframe.src = event.target.result;
                            iframe.style.cssText = `
                                width: 100%;
                                height: calc(100% - 40px);
                                border: none;
                                background-color: white;
                            `;

                            // Assemble the preview
                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(iframe);

                            // Add to document body
                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            // Add zoom functionality
                            let currentZoom = 100;
                            zoomIn.addEventListener('click', () => {
                                currentZoom += 10;
                                iframe.style.transform = `scale(${currentZoom / 100})`;
                                iframe.style.transformOrigin = 'top center';
                            });

                            zoomOut.addEventListener('click', () => {
                                currentZoom = Math.max(currentZoom - 10, 50);
                                iframe.style.transform = `scale(${currentZoom / 100})`;
                                iframe.style.transformOrigin = 'top center';
                            });

                            // Add keyboard shortcut for closing
                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Escape') {
                                    closePreview();
                                }
                            });
                        };
                        reader.readAsDataURL(uploadedFile);
                        previewIcon.classList.add('preview-active');
                    } else if (uploadedFile && (uploadedFile.type.includes('image'))) {
                        // Create image preview for image files
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            // Create overlay and wrapper similar to PDF preview
                            const previewWrapper = document.createElement('div');
                            previewWrapper.className = 'image-preview-wrapper';
                            previewWrapper.style.cssText = `
                                position: fixed;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                width: 90%;
                                max-width: 800px;
                                max-height: 90vh;
                                background-color: white;
                                display: flex;
                                flex-direction: column;
                                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                                z-index: 1000;
                            `;

                            const overlay = document.createElement('div');
                            overlay.className = 'image-preview-overlay';
                            overlay.style.cssText = `
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.5);
                                z-index: 999;
                            `;

                            // Create header with filename and close button
                            const header = document.createElement('div');
                            header.style.cssText = `
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                padding: 8px 16px;
                                background-color: #1a1a1a;
                                color: white;
                                height: 40px;
                            `;

                            const fileName = document.createElement('span');
                            fileName.textContent = uploadedFile.name;
                            fileName.style.cssText = `
                                color: white;
                                font-size: 14px;
                            `;

                            const closeButton = document.createElement('button');
                            closeButton.innerHTML = '&#10005;';
                            closeButton.style.cssText = `
                                background: none;
                                border: none;
                                color: white;
                                font-size: 18px;
                                cursor: pointer;
                                padding: 4px;
                            `;

                            const closePreview = () => {
                                previewWrapper.remove();
                                overlay.remove();
                                previewIcon.classList.remove('preview-active');
                            };

                            closeButton.addEventListener('click', closePreview);
                            overlay.addEventListener('click', closePreview);

                            header.appendChild(fileName);
                            header.appendChild(closeButton);

                            // Create image container
                            const imageContainer = document.createElement('div');
                            imageContainer.style.cssText = `
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                padding: 20px;
                                overflow: auto;
                                height: calc(100% - 40px);
                                background-color: #f5f5f5;
                            `;

                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.style.cssText = `
                                max-width: 100%;
                                max-height: 100%;
                                object-fit: contain;
                            `;

                            imageContainer.appendChild(img);
                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(imageContainer);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            // Add keyboard shortcut for closing
                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Escape') {
                                    closePreview();
                                }
                            });
                        };
                        reader.readAsDataURL(uploadedFile);
                        previewIcon.classList.add('preview-active');
                    } else {
                        alert('Please upload a valid PDF or image file to preview.');
                    }
                }
            });
        }
    });

   
};

// Initialize when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeKycDocumentUpload();
});


//Academic Marksheets

const initializeMarksheetDocumentUpload = () => {
    const marksheetDocuments = document.querySelectorAll(".individualmarksheetdocuments");

    marksheetDocuments.forEach((card) => {
        let uploadedFile = null;
        const inputId = card.querySelector('input[type="file"]').id;
        const documentTypeText = card.querySelector('.document-name').textContent.trim();
        
        // Get the specific preview icon
        const previewIconId = card.querySelector('.fa-eye').id;

        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer-marksheet').addEventListener('click', function (event) {
            // Prevent triggering if clicking on the eye icon
            if (!event.target.classList.contains('fa-eye') && !event.target.id.startsWith('view-')) {
                card.querySelector(`#${inputId}`).click();
            }
        });

        // Handle file selection and validation
        card.querySelector(`#${inputId}`).addEventListener('change', function (event) {
            const file = event.target.files[0];

            // Ensure file is selected
            if (!file) return;

            console.log(`Selected file for ${documentTypeText}:`, file);  // Debug log

            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input
                
                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }
                
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input
                
                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }
                
                return;
            }

            // Store the file and update UI
            uploadedFile = file;
            
            // Update the text in the specific document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = truncateFileName(file.name);
            }

            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

            console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
        });

        // Helper function to get the correct document type element
        function getDocumentTypeElement(card) {
            if (card.querySelector('.sslc-marksheet')) return card.querySelector('.sslc-marksheet');
            if (card.querySelector('.hsc-marksheet')) return card.querySelector('.hsc-marksheet');
            if (card.querySelector('.graduation-marksheet')) return card.querySelector('.graduation-marksheet');
            return null;
        }
        
        // Helper function to get original text
        function getOriginalText(element) {
            if (element.classList.contains('sslc-marksheet')) return '10th grade marksheet';
            if (element.classList.contains('hsc-marksheet')) return '12th grade marksheet';
            if (element.classList.contains('graduation-marksheet')) return 'Graduation Marksheet';
            return 'No file chosen';
        }

        // Handle preview functionality
        card.querySelector(`#${previewIconId}`).addEventListener('click', function (event) {
            event.stopPropagation();
            
            // Reference to preview icon
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = document.querySelector('.pdf-preview-wrapper, .image-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                const overlay = document.querySelector('.pdf-preview-overlay, .image-preview-overlay');
                if (overlay) overlay.remove();
                eyeIcon.classList.remove('preview-active');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 98%;
                            height: 90%;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'pdf-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create a simple header with just filename and close button
                        const header = document.createElement('div');
                        header.className = 'pdf-preview-header';
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 0 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                            width: 100%;
                            margin-top:50px;
                        `;

                        // File name on left
                        const fileNameElement = document.createElement('div');
                        fileNameElement.className = 'pdf-filename';
                        fileNameElement.textContent = uploadedFile.name;
                        fileNameElement.style.cssText = `
                            color: white;
                            font-size: 14px;
                            font-weight: normal;
                            max-width: 80%;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                            padding: 8px 0;
                        `;

                        // Close button on right
                        const closeBtn = document.createElement('button');
                        closeBtn.className = 'pdf-close-button';
                        closeBtn.innerHTML = '✕'; // X symbol
                        closeBtn.style.cssText = `
                            background: none;
                            border: none;
                            color: white;
                            font-size: 20px;
                            font-weight: bold;
                            cursor: pointer;
                            padding: 0 8px;
                            line-height: 1;
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeBtn.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Add elements to header
                        header.appendChild(fileNameElement);
                        header.appendChild(closeBtn);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            border: none;
                            background-color: white;
                        `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else if (uploadedFile && (uploadedFile.type.startsWith('image/'))) {
                    // Image preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'image-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            max-width: 800px;
                            max-height: 90vh;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'image-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create a simple header with just filename and close button
                        const header = document.createElement('div');
                        header.className = 'image-preview-header';
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 0 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                            width: 100%;
                            margin-top:50px;
                        `;

                        // File name on left
                        const fileNameElement = document.createElement('div');
                        fileNameElement.className = 'image-filename';
                        fileNameElement.textContent = uploadedFile.name;
                        fileNameElement.style.cssText = `
                            color: white;
                            font-size: 14px;
                            font-weight: normal;
                            max-width: 80%;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                            padding: 8px 0;
                        `;

                        // Close button on right
                        const closeBtn = document.createElement('button');
                        closeBtn.className = 'image-close-button';
                        closeBtn.innerHTML = '✕'; // X symbol
                        closeBtn.style.cssText = `
                            background: none;
                            border: none;
                            color: white;
                            font-size: 20px;
                            font-weight: bold;
                            cursor: pointer;
                            padding: 0 8px;
                            line-height: 1;
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeBtn.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Add elements to header
                        header.appendChild(fileNameElement);
                        header.appendChild(closeBtn);

                        // Create image element
                        const imageContainer = document.createElement('div');
                        imageContainer.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: auto;
                            padding: 20px;
                            background-color: #f0f0f0;
                        `;

                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.cssText = `
                            max-width: 100%;
                            max-height: 80vh;
                            object-fit: contain;
                        `;

                        imageContainer.appendChild(img);

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(imageContainer);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else {
                    alert('Please upload a valid PDF or image file to preview.');
                }
            }
        });
    });
};

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;
    
    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));
    
    return name.slice(0, 16) + '...' + extension;
}

// Initialize the marksheet document uploads when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeMarksheetDocumentUpload();
    
   
});



//secure admission

const initializeSecuredAdmissionDocumentUpload = () => {
    const securedAdmissionDocuments = document.querySelectorAll(".individual-secured-admission-documents");

    securedAdmissionDocuments.forEach((card) => {
        let uploadedFile = null;
        const inputId = card.querySelector('input[type="file"]').id;
        const documentTypeText = card.querySelector('.document-name').textContent.trim();
        
        // Get the specific preview icon
        const previewIconId = card.querySelector('.fa-eye').id;

        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer-secured-admission').addEventListener('click', function (event) {
            // Prevent triggering if clicking on the eye icon
            if (!event.target.classList.contains('fa-eye') && !event.target.id.startsWith('view-')) {
                card.querySelector(`#${inputId}`).click();
            }
        });

        // Handle file selection and validation
        card.querySelector(`#${inputId}`).addEventListener('change', function (event) {
            const file = event.target.files[0];

            // Ensure file is selected
            if (!file) return;

            console.log(`Selected file for ${documentTypeText}:`, file);  // Debug log

            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input
                
                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }
                
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input
                
                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }
                
                return;
            }

            // Store the file and update UI
            uploadedFile = file;
            
            // Update the text in the specific document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = truncateFileName(file.name);
            }

            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

            console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
        });

        // Helper function to get the correct document type element
        function getDocumentTypeElement(card) {
            if (card.querySelector('.sslc-grade')) return card.querySelector('.sslc-grade');
            if (card.querySelector('.hsc-grade')) return card.querySelector('.hsc-grade');
            if (card.querySelector('.graduation-grade')) return card.querySelector('.graduation-grade');
            return null;
        }
        
        // Helper function to get original text
        function getOriginalText(element) {
            if (element.classList.contains('sslc-grade')) return 'SSLC Grade';
            if (element.classList.contains('hsc-grade')) return 'HSC Grade';
            if (element.classList.contains('graduation-grade')) return 'Graduation';
            return 'No file chosen';
        }

        // Handle preview functionality
        card.querySelector(`#${previewIconId}`).addEventListener('click', function (event) {
            event.stopPropagation();
            
            // Reference to preview icon
            const eyeIcon = this;

            if (eyeIcon.classList.contains('preview-active')) {
                const previewWrapper = document.querySelector('.pdf-preview-wrapper, .image-preview-wrapper');
                if (previewWrapper) previewWrapper.remove();
                const overlay = document.querySelector('.pdf-preview-overlay, .image-preview-overlay');
                if (overlay) overlay.remove();
                eyeIcon.classList.remove('preview-active');
            } else {
                if (uploadedFile && uploadedFile.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'pdf-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 98%;
                            height: 90%;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'pdf-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // SIMPLIFIED HEADER APPROACH
                        // Create a simple header with just filename and close button
                        const header = document.createElement('div');
                        header.className = 'pdf-preview-header';
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 0 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                            width: 100%;
                            margin-top:50px;
                        `;

                        // File name on left
                        const fileNameElement = document.createElement('div');
                        fileNameElement.className = 'pdf-filename';
                        fileNameElement.textContent = uploadedFile.name;
                        fileNameElement.style.cssText = `
                            color: white;
                            font-size: 14px;
                            font-weight: normal;
                            max-width: 80%;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                            padding: 8px 0;
                        `;

                        // Close button on right
                        const closeBtn = document.createElement('button');
                        closeBtn.className = 'pdf-close-button';
                        closeBtn.innerHTML = '✕'; // X symbol
                        closeBtn.style.cssText = `
                            background: none;
                            border: none;
                            color: white;
                            font-size: 20px;
                            font-weight: bold;
                            cursor: pointer;
                            padding: 0 8px;
                            line-height: 1;
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeBtn.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Add elements to header
                        header.appendChild(fileNameElement);
                        header.appendChild(closeBtn);

                        // Create iframe for PDF content
                        const iframe = document.createElement('iframe');
                        iframe.src = event.target.result;
                        iframe.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            border: none;
                            background-color: white;
                        `;

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else if (uploadedFile && (uploadedFile.type.startsWith('image/'))) {
                    // Image preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create wrapper for the preview
                        const previewWrapper = document.createElement('div');
                        previewWrapper.className = 'image-preview-wrapper';
                        previewWrapper.style.cssText = `
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            max-width: 800px;
                            max-height: 90vh;
                            background-color: white;
                            display: flex;
                            flex-direction: column;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            z-index: 1000;
                        `;

                        // Add overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'image-preview-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                        `;

                        // Create a simple header with just filename and close button
                        const header = document.createElement('div');
                        header.className = 'image-preview-header';
                        header.style.cssText = `
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 0 16px;
                            background-color: #1a1a1a;
                            color: white;
                            height: 40px;
                            width: 100%;
                        `;

                        // File name on left
                        const fileNameElement = document.createElement('div');
                        fileNameElement.className = 'image-filename';
                        fileNameElement.textContent = uploadedFile.name;
                        fileNameElement.style.cssText = `
                            color: white;
                            font-size: 14px;
                            font-weight: normal;
                            max-width: 80%;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                            padding: 8px 0;
                        `;

                        // Close button on right
                        const closeBtn = document.createElement('button');
                        closeBtn.className = 'image-close-button';
                        closeBtn.innerHTML = '✕'; // X symbol
                        closeBtn.style.cssText = `
                            background: none;
                            border: none;
                            color: white;
                            font-size: 20px;
                            font-weight: bold;
                            cursor: pointer;
                            padding: 0 8px;
                            line-height: 1;
                        `;

                        const closePreview = () => {
                            previewWrapper.remove();
                            overlay.remove();
                            eyeIcon.classList.remove('preview-active');
                        };

                        closeBtn.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Add elements to header
                        header.appendChild(fileNameElement);
                        header.appendChild(closeBtn);

                        // Create image element
                        const imageContainer = document.createElement('div');
                        imageContainer.style.cssText = `
                            width: 100%;
                            height: calc(100% - 40px);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: auto;
                            padding: 20px;
                            background-color: #f0f0f0;
                        `;

                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.style.cssText = `
                            max-width: 100%;
                            max-height: 80vh;
                            object-fit: contain;
                        `;

                        imageContainer.appendChild(img);

                        // Assemble the preview
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(imageContainer);

                        // Add to document body
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);

                        // Add keyboard shortcut for closing
                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closePreview();
                            }
                        });
                    };
                    reader.readAsDataURL(uploadedFile);
                    eyeIcon.classList.add('preview-active');
                } else {
                    alert('Please upload a valid PDF or image file to preview.');
                }
            }
        });
    });
};

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;
    
    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));
    
    return name.slice(0, 16) + '...' + extension;
}

// Initialize the document uploads when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeSecuredAdmissionDocumentUpload();
});




//work experience

const initializeWorkExperienceDocumentById = (documentId) => {
    const card = document.getElementById(documentId);
    
    if (!card) {
        console.error(`Element with ID '${documentId}' not found.`);
        return;
    }
    
    let uploadedFile = null;
    const inputElement = card.querySelector('input[type="file"]');
    const documentTypeText = card.querySelector('.document-name').textContent.trim();
    const previewIcon = card.querySelector('.fa-eye');
    
    if (!inputElement || !previewIcon) {
        console.error(`Required elements not found in '${documentId}'.`);
        return;
    }
    
    const inputId = inputElement.id;
    const previewIconId = previewIcon.id;

    // Trigger file input when the container is clicked
    card.querySelector('.inputfilecontainer-work-experiencecolumn').addEventListener('click', function (event) {
        // Prevent triggering if clicking on the eye icon
        if (!event.target.classList.contains('fa-eye') && !event.target.id.startsWith('view-')) {
            card.querySelector(`#${inputId}`).click();
        }
    });

    // Handle file selection and validation
    card.querySelector(`#${inputId}`).addEventListener('change', function (event) {
        const file = event.target.files[0];

        // Ensure file is selected
        if (!file) return;

        console.log(`Selected file for ${documentTypeText}:`, file);  // Debug log

        // Allowed file types
        const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
        const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

        // Validate file type
        if (!allowedExtensions.includes(fileExtension)) {
            alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
            event.target.value = ''; // Clear the file input
            
            // Reset the text inside the respective document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = getOriginalText(documentTypeElement);
            }
            
            return;
        }

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert("Error: File size exceeds 5MB limit.");
            event.target.value = ''; // Clear the file input
            
            // Reset the text inside the respective document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = getOriginalText(documentTypeElement);
            }
            
            return;
        }

        // Store the file and update UI
        uploadedFile = file;
        
        // Update the text in the specific document type element
        const documentTypeElement = getDocumentTypeElement(card);
        if (documentTypeElement) {
            documentTypeElement.textContent = truncateFileName(file.name);
        }

        const fileSize = file.size < 1024 * 1024
            ? (file.size / 1024).toFixed(2) + ' KB'
            : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
        card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

        console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
    });

    // Helper function to get the correct document type element
    function getDocumentTypeElement(card) {
        if (card.querySelector('.experience-letter')) return card.querySelector('.experience-letter');
        if (card.querySelector('.salary-slip')) return card.querySelector('.salary-slip');
        if (card.querySelector('.office-id')) return card.querySelector('.office-id');
        if (card.querySelector('.joining-letter')) return card.querySelector('.joining-letter');
        return null;
    }
    
    // Helper function to get original text
    function getOriginalText(element) {
        if (element.classList.contains('experience-letter')) return 'Experience Letter';
        if (element.classList.contains('salary-slip')) return '3 month salary slip';
        if (element.classList.contains('office-id')) return 'Office ID';
        if (element.classList.contains('joining-letter')) return 'Joining Letter';
        return 'No file chosen';
    }

    // Handle preview functionality
    card.querySelector(`#${previewIconId}`).addEventListener('click', function (event) {
        event.stopPropagation();
        
        // Reference to preview icon
        const eyeIcon = this;

        if (eyeIcon.classList.contains('preview-active')) {
            const previewWrapper = document.querySelector('.pdf-preview-wrapper, .image-preview-wrapper');
            if (previewWrapper) previewWrapper.remove();
            const overlay = document.querySelector('.pdf-preview-overlay, .image-preview-overlay');
            if (overlay) overlay.remove();
            eyeIcon.classList.remove('preview-active');
        } else {
            if (uploadedFile && uploadedFile.type === 'application/pdf') {
                createPDFPreview(uploadedFile, eyeIcon);
            } else if (uploadedFile && (uploadedFile.type.startsWith('image/'))) {
                createImagePreview(uploadedFile, eyeIcon);
            } else {
                alert('Please upload a valid PDF or image file to preview.');
            }
        }
    });

    // Create PDF preview
    function createPDFPreview(file, eyeIcon) {
        const reader = new FileReader();
        reader.onload = function (event) {
            // Create wrapper for the preview
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'pdf-preview-wrapper';
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 98%;
                height: 90%;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            `;

            // Add overlay
            const overlay = document.createElement('div');
            overlay.className = 'pdf-preview-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;

            // Create header
            const header = document.createElement('div');
            header.className = 'pdf-preview-header';
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
                width: 100%;
                margin-top:50px;
            `;

            // File name on left
            const fileNameElement = document.createElement('div');
            fileNameElement.className = 'pdf-filename';
            fileNameElement.textContent = file.name;
            fileNameElement.style.cssText = `
                color: white;
                font-size: 14px;
                font-weight: normal;
                max-width: 80%;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                padding: 8px 0;
            `;

            // Close button on right
            const closeBtn = document.createElement('button');
            closeBtn.className = 'pdf-close-button';
            closeBtn.innerHTML = '✕'; // X symbol
            closeBtn.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;
                padding: 0 8px;
                line-height: 1;
            `;

            const closePreview = () => {
                previewWrapper.remove();
                overlay.remove();
                eyeIcon.classList.remove('preview-active');
            };

            closeBtn.addEventListener('click', closePreview);
            overlay.addEventListener('click', closePreview);

            // Add elements to header
            header.appendChild(fileNameElement);
            header.appendChild(closeBtn);

            // Create iframe for PDF content
            const iframe = document.createElement('iframe');
            iframe.src = event.target.result;
            iframe.style.cssText = `
                width: 100%;
                height: calc(100% - 40px);
                border: none;
                background-color: white;
            `;

            // Assemble the preview
            previewWrapper.appendChild(header);
            previewWrapper.appendChild(iframe);

            // Add to document body
            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);

            // Add keyboard shortcut for closing
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closePreview();
                }
            });
        };
        reader.readAsDataURL(file);
        eyeIcon.classList.add('preview-active');
    }

    // Create image preview
    function createImagePreview(file, eyeIcon) {
        const reader = new FileReader();
        reader.onload = function (event) {
            // Create wrapper for the preview
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'image-preview-wrapper';
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 800px;
                max-height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            `;

            // Add overlay
            const overlay = document.createElement('div');
            overlay.className = 'image-preview-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;

            // Create header
            const header = document.createElement('div');
            header.className = 'image-preview-header';
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
                width: 100%;
            `;

            // File name on left
            const fileNameElement = document.createElement('div');
            fileNameElement.className = 'image-filename';
            fileNameElement.textContent = file.name;
            fileNameElement.style.cssText = `
                color: white;
                font-size: 14px;
                font-weight: normal;
                max-width: 80%;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                padding: 8px 0;
            `;

            // Close button on right
            const closeBtn = document.createElement('button');
            closeBtn.className = 'image-close-button';
            closeBtn.innerHTML = '✕'; // X symbol
            closeBtn.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;
                padding: 0 8px;
                line-height: 1;
            `;

            const closePreview = () => {
                previewWrapper.remove();
                overlay.remove();
                eyeIcon.classList.remove('preview-active');
            };

            closeBtn.addEventListener('click', closePreview);
            overlay.addEventListener('click', closePreview);

            // Add elements to header
            header.appendChild(fileNameElement);
            header.appendChild(closeBtn);

            // Create image element
            const imageContainer = document.createElement('div');
            imageContainer.style.cssText = `
                width: 100%;
                height: calc(100% - 40px);
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: auto;
                padding: 20px;
                background-color: #f0f0f0;
            `;

            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.cssText = `
                max-width: 100%;
                max-height: 80vh;
                object-fit: contain;
            `;

            imageContainer.appendChild(img);

            // Assemble the preview
            previewWrapper.appendChild(header);
            previewWrapper.appendChild(imageContainer);

            // Add to document body
            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);

            // Add keyboard shortcut for closing
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closePreview();
                }
            });
        };
        reader.readAsDataURL(file);
        eyeIcon.classList.add('preview-active');
    }
};

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;
    
    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));
    
    return name.slice(0, 16) + '...' + extension;
}

// Example usage:
// Initialize specific work experience document by ID
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all work experience documents
    // initializeWorkExperienceDocumentById('individual-work-experiencecolumn-documents-exp-letter');
    // initializeWorkExperienceDocumentById('individual-work-experiencecolumn-documents-3-month-salary-slip');
    // initializeWorkExperienceDocumentById('individual-work-experiencecolumn-documents-office-ids');
    // initializeWorkExperienceDocumentById('individual-work-experiencecolumn-documents-employment-join-id');
    
    // Or initialize all work experience documents at once
    const workExperienceIds = [
        'individual-work-experiencecolumn-documents-exp-letter',
        'individual-work-experiencecolumn-documents-3-month-salary-slip',
        'individual-work-experiencecolumn-documents-office-ids',
        'individual-work-experiencecolumn-documents-employment-join-id'
    ];
    
    workExperienceIds.forEach(id => initializeWorkExperienceDocumentById(id));
});


//co borrower section

// Main initialization function
const initializeCoBorrowerDocumentUpload = () => {
    // Select all co-borrower document cards
    const coBorrowerDocuments = document.querySelectorAll(".individual-coborrower-kyc-documents");
    
    coBorrowerDocuments.forEach((card) => {
        // Store uploaded file for this card
        let uploadedFile = null;
        
        // Get the input element and document type
        const inputElement = card.querySelector('input[type="file"]');
        const documentTypeText = card.querySelector('.document-name').textContent.trim();
        
        // Get the specific preview icon
        const previewIcon = card.querySelector('.fa-eye');
        
        // Trigger file input when the container is clicked
        card.querySelector('.inputfilecontainer-coborrower-kyccolumn').addEventListener('click', function(event) {
            // Prevent triggering if clicking on the eye icon
            if (!event.target.classList.contains('fa-eye') && event.target.tagName !== 'IMG') {
                inputElement.click();
            }
        });
        
        // Handle file selection and validation
        inputElement.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            // Ensure file is selected
            if (!file) return;
            
            console.log(`Selected file for ${documentTypeText}:`, file);  // Debug log
            
            // Allowed file types
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();
            
            // Validate file type
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                event.target.value = ''; // Clear the file input
                
                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }
                
                return;
            }
            
            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert("Error: File size exceeds 5MB limit.");
                event.target.value = ''; // Clear the file input
                
                // Reset the text inside the respective document type element
                const documentTypeElement = getDocumentTypeElement(card);
                if (documentTypeElement) {
                    documentTypeElement.textContent = getOriginalText(documentTypeElement);
                }
                
                return;
            }
            
            // Store the file and update UI
            uploadedFile = file;
            
            // Update the text in the specific document type element
            const documentTypeElement = getDocumentTypeElement(card);
            if (documentTypeElement) {
                documentTypeElement.textContent = truncateFileName(file.name);
            }
            
            // Update file size display
            const fileSize = file.size < 1024 * 1024
                ? (file.size / 1024).toFixed(2) + ' KB'
                : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            
            card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;
            
            console.log(`File uploaded for ${documentTypeText}:`, uploadedFile);  // Debug log
        });
        
        // Handle preview functionality
        if (previewIcon) {
            previewIcon.addEventListener('click', function(event) {
                event.stopPropagation();
                
                if (this.classList.contains('preview-active')) {
                    // Close preview if already open
                    const previewWrapper = document.querySelector('.pdf-preview-wrapper, .image-preview-wrapper');
                    if (previewWrapper) previewWrapper.remove();
                    const overlay = document.querySelector('.pdf-preview-overlay, .image-preview-overlay');
                    if (overlay) overlay.remove();
                    this.classList.remove('preview-active');
                } else {
                    // Show preview if file is uploaded
                    if (uploadedFile && uploadedFile.type === 'application/pdf') {
                        showPDFPreview(uploadedFile, this);
                    } else if (uploadedFile && uploadedFile.type.startsWith('image/')) {
                        showImagePreview(uploadedFile, this);
                    } else {
                        alert('Please upload a valid PDF or image file to preview.');
                    }
                }
            });
        }
    });
    
    // Helper function to get the correct document type element
    function getDocumentTypeElement(card) {
        if (card.querySelector('.coborrower-pancard')) return card.querySelector('.coborrower-pancard');
        if (card.querySelector('.coborrower-aadharcard')) return card.querySelector('.coborrower-aadharcard');
        if (card.querySelector('.coborrower-addressproof')) return card.querySelector('.coborrower-addressproof');
        return null;
    }
    
    // Helper function to get original text
    function getOriginalText(element) {
        if (element.classList.contains('coborrower-pancard')) return 'Pan Card';
        if (element.classList.contains('coborrower-aadharcard')) return 'Aadhar Card';
        if (element.classList.contains('coborrower-addressproof')) return 'Address Proof';
        return 'No file chosen';
    }
    
    // Function to show PDF preview
    function showPDFPreview(file, eyeIcon) {
        const reader = new FileReader();
        reader.onload = function(event) {
            // Create wrapper for the preview
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'pdf-preview-wrapper';
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            `;
            
            // Add overlay
            const overlay = document.createElement('div');
            overlay.className = 'pdf-preview-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;
            
            // Create header
            const header = document.createElement('div');
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
            `;
            
            // Left section with filename
            const fileNameSection = document.createElement('div');
            fileNameSection.style.cssText = `
                display: flex;
                align-items: center;
                gap: 8px;
            `;
            
            const fileName = document.createElement('span');
            fileName.textContent = file.name;
            fileName.style.cssText = `
                color: white;
                font-size: 14px;
            `;
            fileNameSection.appendChild(fileName);
            
            // Middle section with zoom controls
            const zoomControls = document.createElement('div');
            zoomControls.style.cssText = `
                display: flex;
                align-items: center;
                gap: 12px;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            `;
            
            const zoomOut = document.createElement('button');
            zoomOut.innerHTML = '&#8722;';
            const zoomIn = document.createElement('button');
            zoomIn.innerHTML = '&#43;';
            
            [zoomOut, zoomIn].forEach(btn => {
                btn.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px 8px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                `;
            });
            
            zoomControls.appendChild(zoomOut);
            zoomControls.appendChild(zoomIn);
            
            // Close button
            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&#10005;';
            closeButton.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                padding: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
            `;
            
            const closePreview = () => {
                previewWrapper.remove();
                overlay.remove();
                eyeIcon.classList.remove('preview-active');
            };
            
            closeButton.addEventListener('click', closePreview);
            overlay.addEventListener('click', closePreview);
            
            // Assemble header
            header.appendChild(fileNameSection);
            header.appendChild(zoomControls);
            header.appendChild(closeButton);
            
            // Create iframe for PDF content
            const iframe = document.createElement('iframe');
            iframe.src = event.target.result;
            iframe.style.cssText = `
                width: 100%;
                height: calc(100% - 40px);
                border: none;
                background-color: white;
            `;
            
            // Assemble the preview
            previewWrapper.appendChild(header);
            previewWrapper.appendChild(iframe);
            
            // Add to document body
            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);
            
            // Add zoom functionality
            let currentZoom = 100;
            zoomIn.addEventListener('click', () => {
                currentZoom += 10;
                iframe.style.transform = `scale(${currentZoom / 100})`;
                iframe.style.transformOrigin = 'top center';
            });
            
            zoomOut.addEventListener('click', () => {
                currentZoom = Math.max(currentZoom - 10, 50);
                iframe.style.transform = `scale(${currentZoom / 100})`;
                iframe.style.transformOrigin = 'top center';
            });
            
            // Add keyboard shortcut for closing
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closePreview();
                }
            });
        };
        reader.readAsDataURL(file);
        eyeIcon.classList.add('preview-active');
    }
    
    // Function to show image preview
    function showImagePreview(file, eyeIcon) {
        const reader = new FileReader();
        reader.onload = function(event) {
            // Create wrapper for the preview
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'image-preview-wrapper';
            previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 800px;
                max-height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            `;
            
            // Add overlay
            const overlay = document.createElement('div');
            overlay.className = 'image-preview-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;
            
            // Create header
            const header = document.createElement('div');
            header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
            `;
            
            // Left section with filename
            const fileNameSection = document.createElement('div');
            fileNameSection.style.cssText = `
                display: flex;
                align-items: center;
                gap: 8px;
            `;
            
            const fileName = document.createElement('span');
            fileName.textContent = file.name;
            fileName.style.cssText = `
                color: white;
                font-size: 14px;
            `;
            fileNameSection.appendChild(fileName);
            
            // Close button
            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&#10005;';
            closeButton.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                padding: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
            `;
            
            const closePreview = () => {
                previewWrapper.remove();
                overlay.remove();
                eyeIcon.classList.remove('preview-active');
            };
            
            closeButton.addEventListener('click', closePreview);
            overlay.addEventListener('click', closePreview);
            
            // Assemble header
            header.appendChild(fileNameSection);
            header.appendChild(closeButton);
            
            // Create image element
            const imageContainer = document.createElement('div');
            imageContainer.style.cssText = `
                width: 100%;
                height: calc(100% - 40px);
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: auto;
                padding: 20px;
                background-color: #f0f0f0;
            `;
            
            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.cssText = `
                max-width: 100%;
                max-height: 80vh;
                object-fit: contain;
            `;
            
            imageContainer.appendChild(img);
            
            // Assemble the preview
            previewWrapper.appendChild(header);
            previewWrapper.appendChild(imageContainer);
            
            // Add to document body
            document.body.appendChild(overlay);
            document.body.appendChild(previewWrapper);
            
            // Add keyboard shortcut for closing
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closePreview();
                }
            });
        };
        reader.readAsDataURL(file);
        eyeIcon.classList.add('preview-active');
    }
};

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;
    
    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));
    
    return name.slice(0, 16) + '...' + extension;
}

// Initialize document uploads
initializeCoBorrowerDocumentUpload();



            //index
            // Example student names (Replace this with actual data from API or database)
            const studentNames = ["John Doe", "Jane Smith", "Alice Johnson", "Bob Brown", "Henry SKy"];

            // Select all elements with class 'student-name'
            const studentNameElements = document.querySelectorAll(".student-name");

            // Assign names dynamically
            studentNameElements.forEach((element, index) => {
                if (studentNames[index]) {
                    element.textContent = studentNames[index];
                }
            });

            const searchInput = document.querySelector(".index-search-input");

            const studentCards = document.querySelectorAll(".index-student-message-container");
            const messageThreads = document.querySelectorAll(".message-thread");

            searchInput.addEventListener("input", function () {
                const searchText = searchInput.value.toLowerCase().trim();

                // Filter Student Cards
                studentCards.forEach(card => {
                    const studentNameElement = card.querySelector(".student-name");
                    if (studentNameElement) {
                        const studentName = studentNameElement.textContent.toLowerCase();
                        card.style.display = studentName.includes(searchText) ? "block" : "none";
                    }
                });

                // Filter Message Threads
                messageThreads.forEach(thread => {
                    const studentNameElement = thread.querySelector(".student-name");
                    if (studentNameElement) {
                        const studentName = studentNameElement.textContent.toLowerCase();
                        thread.style.display = studentName.includes(searchText) ? "flex" : "none";
                    }
                });
            });

            document.getElementById("nbfc-search-input-id").addEventListener("input", function () {
                const searchTerm = this.value.toLowerCase();
                const studentCards = document.querySelectorAll(".index-student-message-container");

                studentCards.forEach(card => {
                    const studentName = card.querySelector(".student-name").textContent.toLowerCase();
                    const studentDescription = card.querySelector(".index-student-description").textContent.toLowerCase();

                    if (studentName.includes(searchTerm) || studentDescription.includes(searchTerm)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });

            //sort functionality

            const studentContainers = document.querySelectorAll(".index-student-message-container");
            const sortDropdown = document.getElementById("sort-options-index-nbfc");
            const sortTrigger = document.getElementById("index-nbfc-sort-id");

            // Assign student names dynamically
            studentContainers.forEach((container, index) => {
                if (studentNames[index]) {
                    container.querySelector(".student-name").textContent = studentNames[index];
                    container.setAttribute("data-name", studentNames[index].toLowerCase()); // Store lowercase name for sorting
                    messageThreads[index]?.setAttribute("data-name", studentNames[index].toLowerCase()); // Sync message-thread
                }
            });

            // Toggle dropdown visibility
            sortTrigger.addEventListener("click", function (event) {
                event.stopPropagation();
                sortDropdown.classList.toggle("visible");
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function (event) {
                if (!sortTrigger.contains(event.target) && !sortDropdown.contains(event.target)) {
                    sortDropdown.classList.remove("visible");
                }
            });

            // Sorting logic
            document.querySelectorAll(".sort-dropdown-nbfc li").forEach((item) => {
                item.addEventListener("click", function () {
                    let sortType = this.getAttribute("data-sort");
                    let sortedArray = [...studentContainers];

                    if (sortType === "az") {
                        sortedArray.sort((a, b) => a.getAttribute("data-name").localeCompare(b.getAttribute("data-name")));
                    } else if (sortType === "za") {
                        sortedArray.sort((a, b) => b.getAttribute("data-name").localeCompare(a.getAttribute("data-name")));
                    } else if (sortType === "newest") {
                        sortedArray.sort((a, b) => studentNames.indexOf(b.querySelector(".student-name").textContent) - studentNames.indexOf(a.querySelector(".student-name").textContent));
                    } else if (sortType === "oldest") {
                        sortedArray.sort((a, b) => studentNames.indexOf(a.querySelector(".student-name").textContent) - studentNames.indexOf(b.querySelector(".student-name").textContent));
                    }

                    // Append sorted items back to the container
                    let parent = document.querySelector(".index-student-details-container");
                    parent.innerHTML = ""; // Clear existing
                    sortedArray.forEach((item) => {
                        parent.appendChild(item);
                        // Sync message-thread order
                        let studentName = item.getAttribute("data-name");
                        let correspondingThread = [...messageThreads].find(thread => thread.getAttribute("data-name") === studentName);
                        if (correspondingThread) parent.appendChild(correspondingThread);
                    });

                    // Hide dropdown after selection
                    sortDropdown.classList.remove("visible");

                    // Simulate clicking the dropdown button to close it
                    sortTrigger.click();
                });
            });





            // Multi instance chat function of the NBFC
            // Initialize chat functionality for all message input containers
            function initializeChats() {
                // Select all chat containers
                const chatContainers = document.querySelectorAll('.nbfc-individual-bankmessage-input-message');

                chatContainers.forEach((container, index) => {
                    // Create unique identifier for this chat instance
                    const chatId = `chat-${index}`;
                    container.setAttribute('data-chat-id', chatId);

                    // Find the parent container and view button
                    const parentContainer = container.closest('.index-student-message-container');
                    const viewButton = parentContainer.querySelector('.index-student-view-btn');

                    // Create messages wrapper for this chat instance
                    const messagesWrapper = document.createElement("div");
                    messagesWrapper.classList.add("messages-wrapper");
                    messagesWrapper.setAttribute('data-chat-id', chatId);
                    messagesWrapper.style.cssText = `
            display: none;
            flex-direction: column;
            width: 100%;  
           font-size: 14px;
            color: #666;
           line-height: 1.5; 
            overflow-y: auto;
            background: #fff;
            font-family: 'Poppins', sans-serif;
        `;
                    container.parentNode.insertBefore(messagesWrapper, container);

                    // Get elements within this container
                    const messageInput = container.querySelector(".nbfc-message-input");
                    const sendButton = container.querySelector(".nbfc-send-img");
                    const smileIcon = container.querySelector(".nbfc-face-smile");
                    const paperclipIcon = container.querySelector(".nbfc-paperclip");

                    // Function to show chat and update button
                    function showChat() {
                        messagesWrapper.style.display = 'flex';
                        container.style.display = 'flex';
                        if (viewButton) viewButton.textContent = 'Close';
                    }

                    // Function to hide chat and update button
                    function hideChat() {
                        messagesWrapper.style.display = 'none';
                        container.style.display = 'none';
                        if (viewButton) viewButton.textContent = 'View';
                    }

                    // Send message function for this chat instance
                    function sendMessage() {
                        if (!messageInput) return;

                        const content = messageInput.value.trim();
                        if (content) {
                            showChat(); // Show chat when sending message

                            // Create message element
                            const messageElement = document.createElement("div");
                            messageElement.style.cssText = `
                    display: flex;
                    justify-content: flex-end;
                    width: 100%;
                    margin-bottom: 10px;
                `;

                            const messageContent = document.createElement("div");
                            messageContent.style.cssText = `
                    max-width: 80%;
                    padding: 8px 12px;
                    border-radius: 8px;
                    word-wrap: break-word;
                    font-family: 'Poppins', sans-serif;
                `;
                            messageContent.textContent = content;

                            messageElement.appendChild(messageContent);
                            messagesWrapper.appendChild(messageElement);

                            // Clear input and scroll to bottom
                            messageInput.value = "";
                            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

                            // Save message
                            saveMessage(content, chatId);
                        }
                    }

                    // Add click event to view/close button
                    if (viewButton) {
                        viewButton.addEventListener('click', function () {
                            if (messagesWrapper.style.display === 'none') {
                                showChat();
                            } else {
                                hideChat();
                            }
                        });
                    }

                    // Show chat when typing
                    if (messageInput) {
                        messageInput.addEventListener('input', function () {
                            if (messagesWrapper.style.display === 'none') {
                                showChat();
                            }
                        });

                        messageInput.addEventListener('keypress', function (e) {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                sendMessage();
                            }
                        });
                    }

                    // Add click event to send button
                    if (sendButton) {
                        sendButton.addEventListener('click', function (e) {
                            e.preventDefault();
                            sendMessage();
                        });
                    }

                    // Initialize emoji picker
                    if (smileIcon) {
                        smileIcon.addEventListener('click', function (e) {
                            e.stopPropagation();
                            const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];

                            const existingPicker = document.querySelector(".emoji-picker");
                            if (existingPicker) {
                                existingPicker.remove();
                                return;
                            }

                            const picker = document.createElement("div");
                            picker.classList.add("emoji-picker");
                            picker.style.cssText = `
                    position: absolute;
                    bottom: 100%;
                    right: 0;
                    background: white;
                    border-radius: 5px;
                    padding: 5px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 5px;
                    z-index: 1000;
                `;

                            emojis.forEach(emoji => {
                                const button = document.createElement("button");
                                button.textContent = emoji;
                                button.style.cssText = `
                        border: none;
                        background: none;
                        font-size: 20px;
                        cursor: pointer;
                        padding: 5px;
                    `;
                                button.onclick = (e) => {
                                    e.stopPropagation();
                                    messageInput.value += emoji;
                                    picker.remove();
                                    messageInput.focus();
                                };
                                picker.appendChild(button);
                            });

                            container.appendChild(picker);

                            document.addEventListener("click", function closePicker(e) {
                                if (!picker.contains(e.target) && e.target !== smileIcon) {
                                    picker.remove();
                                    document.removeEventListener("click", closePicker);
                                }
                            });
                        });
                    }

                    // Initialize file attachment
                    if (paperclipIcon) {
                        paperclipIcon.addEventListener('click', function () {
                            const fileInput = document.createElement("input");
                            fileInput.type = "file";
                            fileInput.accept = ".pdf,.jpeg.,.png,.jpg";
                            fileInput.style.display = "none";

                            fileInput.onchange = (e) => {
                                const file = e.target.files[0];
                                if (file) {
                                    showChat();
                                    const fileName = file.name;
                                    const fileSize = (file.size / 1024 / 1024).toFixed(2);

                                    const messageElement = document.createElement("div");
                                    messageElement.style.cssText = `
                            display: flex;
                            justify-content: flex-end;
                            width: 100%;
                            margin-bottom: 10px;
                        `;

                                    const fileContent = document.createElement("div");
                                    fileContent.style.cssText = `
                            max-width: 80%;
                            padding: 8px 12px;
                            border-radius: 8px;
                            display: flex;
                            align-items: center;
                            gap: 8px;
                        `;
                                    fileContent.innerHTML = `
                          
                            <span>${fileName} (${fileSize} MB)</span>
                        `;

                                    messageElement.appendChild(fileContent);
                                    messagesWrapper.appendChild(messageElement);
                                    messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                                }
                            };

                            document.body.appendChild(fileInput);
                            fileInput.click();
                            document.body.removeChild(fileInput);
                        });
                    }

                    // Initialize message button
                    const messageBtn = parentContainer.querySelector('.index-student-message-btn');
                    if (messageBtn) {
                        messageBtn.addEventListener('click', function () {
                            showChat();
                        });
                    }

                    // Load saved messages
                    const savedMessages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');
                    savedMessages.forEach(content => {
                        const messageElement = document.createElement("div");
                        messageElement.style.cssText = `
                display: flex;
                justify-content: flex-end;
                width: 100%;
                margin-bottom: 10px;
            `;

                        const messageContent = document.createElement("div");
                        messageContent.style.cssText = `
                max-width: 80%;
                padding: 8px 12px;
                border-radius: 8px;
                word-wrap: break-word;
            `;
                        messageContent.textContent = content;

                        messageElement.appendChild(messageContent);
                        messagesWrapper.appendChild(messageElement);
                    });
                });
            }

            // Storage functions
            function saveMessage(content, chatId) {
                const messages = JSON.parse(localStorage.getItem(`messages-${chatId}`) || '[]');
                messages.push(content);
                localStorage.setItem(`messages-${chatId}`, JSON.stringify(messages));
            }

            // Initialize when DOM is loaded
            document.addEventListener('DOMContentLoaded', initializeChats);




        </script>



</body>

</html>