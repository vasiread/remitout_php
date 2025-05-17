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
    <meta name="csrf-token" content="{{ csrf_token() }}">




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
            @if(session()->has('nbfcuser'))
                @php $nbfcuser = session('nbfcuser'); @endphp
                <div class="nbfc-profile">
                    <div class="nbfc-avatar"></div>
                    <span class="nbfc-profile-text">{{ $nbfcuser->nbfc_name }}</span>
                    <div class="nbfc-dropdown-icon"></div>
                </div>

            @endif


            <div class="popup-notify-list-nbfc">
                <p id="change-password-trigger-nbfc">Change Password</p>
                <p class='nbfclogoutBtn'>Logout</p>
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
            <li class="nbfclogoutBtn">
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

        <div class="nbfcdashboard-studentlistscontainer" style="gap:1.2%">
            <div class="studentdashboardprofile-profilesection" id="nbfc-list-of-student-profilesections">
                <img src="{{asset($profileImgPath)}}" class="profileImg" id="profile-photo-id" alt="">
                <div class="myapplication-nbfcapprovalcolumn" id="profilesection-nbfcapprovalcolumn">
                    <button>Send Proposal</button>
                    <div class="nbfcapprovalcolumnrightaligned">
                        <button>Message</button>
                        <button>Reject</button>
                    </div>


                </div>
                <i class="fa-regular fa-pen-to-square"></i>
                <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data">
                <div class="studentdashboardprofile-personalinfo">
                    <div class="personalinfo-firstrow">
                        <h1>Student Profile</h1>
                    </div>
                    <ul class="personalinfo-secondrow">
                        <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                                class="personal_info_id" style="margin-left: 6px;"> </span> </li>
                        <li class="personal_info_name" id="referenceNameId"><img src={{$profileIconPath}} alt="">
                            <p></p>
                        </li>
                        <li class="personal_info_phone"><img src={{$phoneIconPath}} alt="">
                            <p></p>
                        </li>
                        <li class="personal_info_email" id="referenceEmailId">
                            <img src={{$mailIconPath}} alt="">
                            <p> </p>
                        </li>
                        <li class="personal_info_state"><img src={{$pindropIconPath}} alt="">
                            <p id="personal_state_id"></p>
                        </li>
                    </ul>

                </div>
                <div class="studentdashboardprofile-educationeditsection">
                    <div class="educationeditsection-firstrow">
                        <h1>Education</h1>
                        <!-- <button>Edit</button> -->
                    </div>
                    <div class="educationeditsection-secondrow">
                        
                    </div>
                </div>

                <div class="studentdashboardprofile-testscoreseditsection">
                    <div class="testscoreseditsection-firstrow">
                        <h1>Test Scores</h1>
                    </div>
                    <div class="testscoreseditsection-secondrow">
                        @php
$counter = 1; 
                        @endphp


                        <p>{{ $counter++ }}. IELTS <span class="ilets_score"></span></p>


                        <p>{{ $counter++ }}. GRE <span class="gre_score"></span></p>

                        <p>{{ $counter++ }}. TOEFL <span class="tofel_score"></span></p>




                    </div>



                </div>
            </div>


        </div>

        <div class="studentdashboardprofile-myapplication" id=nbfc-student-profile-details>
            <div class="myapplication-firstcolumn">
                <h1>Application Details</h1>
                <div class="personalinfo-firstrow" style="display:none">
                    <button onClick="triggerEditButton()">Edit</button>
                    <button class="saved-msg">Saved</button>
                </div>
            </div>

            <div class="myapplication-secondcolumn">
                <p>1. Country of preference</p>
                <input type="text" id="plan-to-study-edit" value="{{ $courseDetails[0]->{'plan-to-study'} ?? '' }}"
                    disabled>
            </div>

            <div class="myapplication-thirdcolumn">
                <h6>2. Type of Degree</h6>
                <div class="degreetypescheckboxes">
                    <label class="custom-radio" id="bachelors-label">
                        <input type="radio" name="education-level" value="Bachelors"
                            @if(isset($courseDetails[0]->{'degree-type'}) && $courseDetails[0]->{'degree-type'} == 'Bachelors') checked @endif
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Bachelors (only secured loan)</p>
                    </label>
                    <br>

                    <label class="custom-radio" id="masters-label">
                        <input type="radio" name="education-level" value="Masters"
                            @if(isset($courseDetails[0]->{'degree-type'}) && $courseDetails[0]->{'degree-type'} == 'Masters') checked @endif
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Masters</p>
                    </label>
                    <br>

                    <label class="custom-radio" id="others-label">
                        <input type="radio" name="education-level" value="Others"
                            @if(isset($courseDetails[0]->{'degree-type'}) && $courseDetails[0]->{'degree-type'} !== 'Bachelors' && $courseDetails[0]->{'degree-type'} !== 'Masters') checked @endif
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Others</p>
                    </label>
                </div>

                <input type="text" placeholder="Enter degree type"
                    value="{{ $courseDetails[0]->{'degree-type'} ?? '' }}" id="otherDegreeInputNBFC"
                    @if(!isset($courseDetails[0]->{'degree-type'}) || $courseDetails[0]->{'degree-type'} != 'Others')
                    disabled @endif>
            </div>


            <div class="myapplication-fourthcolumn-additional">
                <p>3. Duration of the course</p>
                <input type="text" placeholder="" value="" disabled>
            </div>

            <div class="myapplication-fourthcolumn">
                <p>4. Loan amount required</p>
                <input type="number" placeholder="" value="" disabled>
            </div>

            <div class="myapplication-fifthcolumn">
                <p>5. Referral Code</p>
                <input type="text" placeholder="" value="" disabled>
            </div>

            <div class="myapplication-sixthcolumn">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <div class="myapplication-seventhcolumn">
                <div class="myapplication-seventhcolumn-headernbfc">
                    <h1>Attached Documents</h1>
                    <button>Download All</button>
                </div>
                <div class="seventhcolum-firstsection">
                    <div class="seventhcolumn-header">
                        <p>Student KYC Document</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="kycdocumentscolumn">
                        <div class="individualkycdocuments">
                            <p class="document-name">Pan Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="uploaded-pan-name">{{ $kycDocuments[0]->pan_card ?? 'pan_card.jpg' }}</p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-pan-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualkycdocuments">
                            <p class="document-name">Aadhar Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="uploaded-aadhar-name">
                                    {{ $kycDocuments[0]->aadhar_card ?? 'aadhar_card.jpg' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-aadhar-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualkycdocuments">
                            <p class="document-name">Passport</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="passport-name-selector">{{ $kycDocuments[0]->passport ?? 'Passport.pdf' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-passport-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="seventhcolumn-additional">
                <div class="seventhcolumn-additional-firstcolumn">
                    <div class="seventhcolumnadditional-header">
                        <p>Academic Marksheets</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="marksheetdocumentscolumn">
                        <div class="individualmarksheetdocuments">
                            <p class="document-name">10th grade marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p class="sslc-marksheet">
                                    {{ $academicDocuments[0]->sslc_marksheet ?? '10th grade marksheet' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-sslc-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualmarksheetdocuments">
                            <p class="document-name">12th grade marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p class="hsc-marksheet">
                                    {{ $academicDocuments[0]->hsc_marksheet ?? '12th grade marksheet' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-hsc-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualmarksheetdocuments">
                            <p class="document-name">Graduation marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p class="graduation-marksheet">
                                    {{ $academicDocuments[0]->graduation_marksheet ?? 'Graduation Marksheet' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-graduation-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="myapplication-eightcolumn">
                <div class="eightcolumn-firstsection">
                    <div class="eightcolumn-header">
                        <p>Secured Admissions</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="secured-admissioncolumn">
                        <div class="individual-secured-admission-documents">
                            <p class="document-name">10th Grade</p>
                            <div class="inputfilecontainer-secured-admission">
                                <i class="fa-solid fa-image"></i>
                                <p class="sslc-grade">{{ $securedAdmissions[0]->sslc_grade ?? 'SSLC Grade' }}</p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-sslc-grade" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-secured-admission-documents">
                            <p class="document-name">12th Grade</p>
                            <div class="inputfilecontainer-secured-admission">
                                <i class="fa-solid fa-image"></i>
                                <p class="hsc-grade">{{ $securedAdmissions[0]->hsc_grade ?? 'HSC Grade' }}</p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-hsc-grade" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-secured-admission-documents">
                            <p class="document-name">Graduation</p>
                            <div class="inputfilecontainer-secured-admission">
                                <i class="fa-solid fa-image"></i>
                                <p class="graduation-grade">
                                    {{ $securedAdmissions[0]->graduation_grade ?? 'Graduation' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-graduation-grade" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="myapplication-ninthcolumn">
                <div class="ninthcolumn-firstsection">
                    <div class="ninthcolumn-header">
                        <p>Work Experience</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="work-experiencecolumn">
                        <div class="individual-work-experiencecolumn-documents">
                            <p class="document-name">Experience Letter</p>
                            <div class="inputfilecontainer-work-experiencecolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="experience-letter">
                                    {{ $workExperience[0]->experience_letter ?? 'Experience Letter' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-experience-letter" />
                            </div>
                            <input type="file" id="inputfilecontainer-work-experience" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-work-experiencecolumn-documents">
                            <p class="document-name">3 month Salary Slip</p>
                            <div class="inputfilecontainer-work-experiencecolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="salary-slip">
                                    {{ $workExperience[0]->salary_slip ?? '3 month salary slip' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-salary-slip" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-work-experiencecolumn-documents">
                            <p class="document-name">Office ID</p>
                            <div class="inputfilecontainer-work-experiencecolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="office-id">{{ $workExperience[0]->office_id ?? 'Office ID' }}</p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-office-id" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-work-experiencecolumn-documents">
                            <p class="document-name">Employment Joining Letter</p>
                            <div class="inputfilecontainer-work-experiencecolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="joining-letter">
                                    {{ $workExperience[0]->joining_letter ?? 'Joining Letter' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-joining-letter" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="myapplication-tenthcolumn">
                <div class="tenthcolumn-firstsection">
                    <div class="tenthcolumn-header">
                        <p>Co-borrower Documents</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="coborrower-kyccolumn">
                        <div class="individual-coborrower-kyc-documents">
                            <p class="document-name">Pan Card</p>
                            <div class="inputfilecontainer-coborrower-kyccolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="coborrower-pancard">{{ $coBorrowerDocuments[0]->pan_card ?? 'Pan Card' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-coborrower-pan" />
                            </div>
                            <input type="file" id="inputfilecontainer-kyccoborrwer" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-coborrower-kyc-documents">
                            <p class="document-name">Aadhar Card</p>
                            <div class="inputfilecontainer-coborrower-kyccolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="coborrower-aadharcard">
                                    {{ $coBorrowerDocuments[0]->aadhar_card ?? 'Aadhar Card' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-coborrower-aadhar" />
                            </div>
                            <input type="file" id="inputfilecontainer-kyccoborrwer" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-coborrower-kyc-documents">
                            <p class="document-name">Address Proof</p>
                            <div class="inputfilecontainer-coborrower-kyccolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="coborrower-addressproof">
                                    {{ $coBorrowerDocuments[0]->address_proof ?? 'Address Proof' }}
                                </p>
                                <img class="fa-eye" src="{{ asset($viewIconPath) }}"
                                    id="view-coborrower-addressproof" />
                            </div>
                            <input type="file" id="inputfilecontainer-kyccoborrwer" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="myapplication-nbfcapprovalcolumn">
                <button id="sendproposal-trigger">Send Proposal</button>
                <div class="nbfcapprovalcolumnrightaligned">
                    <button id="index-student-message-btn">Message</button>
                    <button class='dashboard-inside-reject-button'>Reject</button>
                </div>


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
                    <div class="reject-attachment-container">
                        <label class="reject-attachment-label">Attachment</label>
                        <div class="reject-attachment-input">
                            <div class="reject-attachment-wrapper">
                                <button class="reject-attachment-add-btn" id="addAttachmentBtn">
                                    <span class="reject-attachment-icon"><i class="fas fa-file-pdf"></i></span>
                                    <span class="reject-attachment-name" id="fileName">+ Add Attachment</span>
                                </button>
                                <button class="reject-attachment-remove" id="removeAttachmentBtn"
                                    style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <input type="file" id="fileInput" style="display: none;" />
                        </div>
                    </div>
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

                <div class="index-student-details-container">
                </div>


        </section>



        <div class="password-change-container-nbfc">
            <div class="password-change-triggered-view-headersection-nbfc">
                <h3>Password Change Request</h3>
                <img src="{{ asset('assets/images/Icons/close_small.png') }}" style="cursor:pointer" alt="">
            </div>
            <input type="password" placeholder="Current Password" id="current-password-nbfc">
            <span id="current-password-error-nbfc" class="error-message"></span>

            <input type="password" placeholder="New Password" id="new-password-nbfc">
            <span id="new-password-error-nbfc" class="error-message"></span>

            <input type="password" placeholder="Confirm New Password" id="confirm-new-password-nbfc">
            <span id="confirm-password-error-nbfc" class="error-message"></span>

            <div class="footer-passwordchange-nbfc">
                <p>Forgot Password</p>

                <button id="password-change-save-nbfc">Save</button>

            </div>
        </div>
    </section>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const mobileMenuBtn = document.getElementById('nbfcMobileMenuBtn');
            const mobileSidebar = document.querySelector('.nbfc-mobile-sidebar');
            const mobileOverlay = document.querySelector('.nbfc-mobile-overlay');
            const nbfcNavRight = document.querySelector('.nbfc-nav-right');

            // Select elements for menu items
            const dashboardBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(1)'); // Dashboard
            const inboxBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(2)'); // Inbox
            const dashboardContainer = document.querySelector('.dashboard-sections-container');
            const inboxContainer = document.querySelector('.inbox-container');
            const requestsData = [

            ];

            const proposalsData = [

            ];


            passwordModelTriggerNbfc();
            passwordForgotNbfc();
            userPopopuOpenNbfc();
            passwordChangeCheckNbfc();
            initialiseEightcolumn();
            initialiseSeventhcolumn();
            initialiseSeventhAdditionalColumn();
            initialiseNinthcolumn();
            initialiseTenthcolumn();
            initializeCoBorrowerDocumentUpload();
            initializeKycDocumentUpload();
            initializeMarksheetUpload();
            initializeSecuredAdmissionDocumentUpload();
            initializeWorkExperienceDocumentUpload();








            //toggle function
            // Select the Dashboard and Inbox menu items
            const dashboardMenuItem = document.querySelector(".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(1)");
            const inboxMenuItem = document.querySelector(".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(2)");

            // Select the containers
            const dashboardSectionsContainer = document.querySelector(".dashboard-sections-container");





            function checkWindowSize() {
                if (window.innerWidth > 768) { // Hide mobile menu and sidebar for screens greater than 768px
                    mobileSidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');
                    mobileMenuBtn.style.display = 'none'; // Hide mobile menu button
                } else {
                    mobileMenuBtn.style.display = 'block'; // Show mobile menu button for 768px and below
                }
            }


            checkWindowSize();
            window.addEventListener('resize', checkWindowSize);


            function toggleMobileSidebar() {

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

            const parentContainerNBFC = document.querySelector(".nbfcdashboard-studentlistscontainer");


            // Function to show the dashboard and hide the inbox
            dashboardBtn.addEventListener('click', () => {
                // Hide sidebar when a menu item is clicked
                mobileSidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');

                // Show dashboard container and hide inbox container
                dashboardContainer.style.display = 'block';
                inboxContainer.style.display = 'none';
                parentContainerNBFC.style.display = 'none';


                // Show nav-right again on mobile
                nbfcNavRight.classList.remove('hidden#nbfc-student-profile-details');

                // Change the mobile menu icon to 'bars' when sidebar is closed
                const icon = mobileMenuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');

                // Set the active tab
                setActiveTab(dashboardBtn);
            });

            // Function to show the inbox and hide the dashboard
            inboxBtn.addEventListener('click', () => {
                mobileSidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');

                // Show inbox container and hide dashboard container
                inboxContainer.style.display = 'block';
                dashboardContainer.style.display = 'none';
                parentContainerNBFC.style.display = 'none';


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
            parentContainerNBFC.style.display = 'none';
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
                const viewContainerApplication = document.getElementById("nbfc-student-profile-details");

                viewContainerApplication.style.display = "none";
                inboxContainer.style.display = "none";
                parentContainerNBFC.style.display = 'none';
                dashboardSectionsContainer.style.display = "grid";

                setActiveMenuItem(dashboardMenuItem);
            });


            // Add event listener to Inbox menu item
            inboxMenuItem.addEventListener("click", function () {

                const viewContainerApplication = document.getElementById("nbfc-student-profile-details");
                viewContainerApplication.style.display = "none";
                const nbfcListUsers = document.querySelector(".dashboard-sections-container");
                dashboardSectionsContainer.style.display = "none";
                inboxContainer.style.display = "block";
                parentContainerNBFC.style.display = 'none';
                if (nbfcListUsers) {
                    nbfcListUsers.style.display = 'none';
                }

                setActiveMenuItem(inboxMenuItem);
            });


            // Set initial states
            dashboardSectionsContainer.style.display = "grid";
            inboxContainer.style.display = "none";
            parentContainerNBFC.style.display = 'none';
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





            const initializeTraceViewNBFC = (requestsData, proposalsData) => {

                var user = @json(session('nbfcuser'));

                if (user && user.nbfc_id) {
                    const nbfcId = user.nbfc_id;


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
                                    } else if (item.type === 'proposal') {
                                        // Push into proposalsData
                                        proposalsData.push({
                                            id: index + 1,
                                            name: item.name,
                                            studentId: item.unique_id
                                        });
                                    }
                                }

                                // Populate the lists
                                populateStudentList("dashboard-request-list", requestsData);
                                populateStudentList("dashboard-proposal-list", proposalsData);

                                // Check if both lists are empty and handle empty state
                                if (requestsData.length === 0 && proposalsData.length === 0) {

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

                studentListContainer.innerHTML = "";

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


                viewButton.addEventListener("click", () => {
                    viewProfileOfUsers(viewButton, studentId, loader);
                    studentApplicationInsideRejection(student);
                    handleSendProposalProcess(studentId);
                    // handleMessageTrigger(studentId);

                });
                const loader = document.createElement('div');
                loader.classList.add('loader');
                loader.textContent = 'Loading.....';
                loader.style.display = 'none';
                listItem.appendChild(loader);



                const rejectButton = document.createElement("button");
                rejectButton.classList.add("dashboard-reject-button");
                rejectButton.textContent = "Reject";

                rejectButton.addEventListener("click", async function () {
                    handleRejectionProcess(student);
                });

                actionButtons.appendChild(viewButton);
                actionButtons.appendChild(rejectButton);

                listItem.appendChild(studentInfo);
                listItem.appendChild(actionButtons);

                const sessionLogout = document.querySelectorAll(".nbfclogoutBtn");
                sessionLogout.forEach(button => {
                    button.addEventListener('click', () => {
                        sessionLogoutInitial();
                    });
                });

                return listItem;
            }
            // Select all send buttons using querySelectorAll
            const sendButtons = document.querySelectorAll('.nbfc-send-proposal-send-button, .nbfc-send-img');

            // Add event listener to each send button
            sendButtons.forEach(sendButton => {
                sendButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    sendMessage();
                    closeModal(); // If closeModal is a defined function
                });
            });


            const studentApplicationInsideRejection = (student) => {
                const rejectButtonInside = document.querySelector(".dashboard-inside-reject-button");

                if (rejectButtonInside) {
                    rejectButtonInside.addEventListener("click", function () {
                        handleRejectionProcess(student);
                    });
                }
            };

            const handleSendProposalProcess = (studentId) => {
                const sendProposalTrigger = document.querySelector(".myapplication-nbfcapprovalcolumn #sendproposal-trigger");

                if (sendProposalTrigger) {
                    const newTrigger = sendProposalTrigger.cloneNode(true);
                    sendProposalTrigger.parentNode.replaceChild(newTrigger, sendProposalTrigger);

                    newTrigger.addEventListener("click", () => {
                        console.log("Clicked");
                        console.log(studentId);
                        openModal(studentId);
                    });
                }
            };




            const handleRejectionProcess = async (student) => {
                const modal = document.querySelector(".modal-container");
                if (modal) {
                    modal.style.display = 'flex';
                    const textArea = document.querySelector(".remarks-textarea");
                    if (textArea) {
                        textArea.value = '';
                        textArea.placeholder = "Enter Remarks for " + student.name;

                        const finalCallReject = document.querySelector(".reject-application-modal-content .actions .reject-button");

                        if (finalCallReject) {
                            const newRejectButton = finalCallReject.cloneNode(true);
                            finalCallReject.replaceWith(newRejectButton);

                            newRejectButton.addEventListener('click', async function () {
                                var user = @json(session('nbfcuser'));
                                const nbfcId = user.nbfc_id;
                                const userId = student.studentId;
                                const remarks = textArea.value;

                                if (nbfcId && userId && remarks) {
                                    const data = { userId, nbfcId, remarks };

                                    try {
                                        const response = await fetch('/del-user-id-request', {
                                            method: "POST",
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                            },
                                            body: JSON.stringify(data)
                                        });

                                        const result = await response.json();

                                        if (result.success) {
                                            console.log(result);
                                            alert("Remarks submitted for student ID: " + userId);
                                            await initializeTraceViewNBFC(requestsData, proposalsData);

                                            textArea.value = '';
                                        } else if (result.error) {
                                            console.error(result.error);
                                        }
                                    } catch (error) {
                                        console.error("Error del data", error);
                                    }
                                }

                                modal.style.display = 'none';
                            });
                        }
                    } else {
                        console.log("Textarea not yet filled!");
                    }
                } else {
                    console.log("Modal not found!");
                }
            };





            const messageInputs = document.querySelector(".nbfc-message-input");
            const sendButton = document.querySelector(".nbfc-send-img");
            const inputContainer = document.querySelector(".nbfc-individual-bankmessage-input");
            const viewButton = document.querySelector(".view");
            const smileIcon = document.querySelector(".nbfc-face-smile");
            const paperclipIcon = document.querySelector(".nbfc-paperclip");

            let isNBFC = true;

            let messagesWrapper = parentContainer ? parentContainer.querySelector(`.messages-wrapper[data-chat-id="${chatId}"]`) : null;


            if (!messagesWrapper) {
                messagesWrapper = document.createElement("div");
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
        max-height: 300px;
        background: #fff;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 10px;
    `;
                inputContainer.parentNode.insertBefore(messagesWrapper, inputContainer);
            }

            // function loadMessages() {
            //     if (savedMessages && Array.isArray(savedMessages)) {
            //         savedMessages.forEach(content => {
            //             createMessage(content);
            //         });
            //     }
            // }

            // Create message in the chat
            function createMessage(content) {
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
                if (content.startsWith(' 📎')) {
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

            if (closeButtonIndex) {
                closeButtonIndex.addEventListener("click", function () {
                    messageResponse.style.display = "none";
                });
            }


        });

        const modalContainer = document.getElementById('modelContainer-send-proposal');
        const closeButtons = document.querySelectorAll('.nbfc-send-proposal-close-button');
        const fileInput = document.getElementById('fileInput');
        const attachmentBtn = document.getElementById('attachmentBtn');
        const attachmentPreview = document.getElementById('attachmentPreview');
        const removeAttachment = document.getElementById('removeAttachment');
        const fileName = document.querySelector('.nbfc-send-proposal-file-name');
        const fileSize = document.querySelector('.nbfc-send-proposal-file-size');
        const cancelButton = document.querySelector('.nbfc-send-proposal-cancel-button');
        const sendButton = document.querySelector('.nbfc-send-proposal-send-button');

        function openModal(studentId) {
            console.log(studentId)
            const placeHolder = document.querySelector(".nbfc-send-proposal-remarks-textarea");


            if (modalContainer) {
                modalContainer.style.display = 'flex';



                if (placeHolder) {
                    placeHolder.value = '';

                    if (studentId) {
                        studentId = studentId.textContent;
                        placeHolder.placeholder = `Remarks ${studentId}`;
                        attachmentBtn.addEventListener('click', () => fileInput.click());
                        fileInput.addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            if (file) {
                                fileName.textContent = file.name;
                                fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
                                attachmentPreview.style.display = 'flex';

                                const sendProposalTrigger = document.querySelector(".nbfc-send-proposal-send-button");
                                if (sendProposalTrigger) {

                                    sendProposalTrigger.addEventListener('click', () => {
                                        var user = @json(session('nbfcuser'));
                                        const nbfcId = user.nbfc_id;
                                        if (nbfcId) {
                                            sendProposalByNbfc(file, studentId, nbfcId, placeHolder)

                                        }

                                    })

                                }




                            }
                        });

                    }
                }
            }
        }

        function closeModal() {


            modalContainer.style.display = 'none';
            clearFileInput();
        }



        function clearFileInput() {
            const placeHolder = document.querySelector(".nbfc-send-proposal-remarks-textarea");
            placeHolder.placeholder = '';
            fileInput.value = '';
            attachmentPreview.style.display = 'none';
            fileName.textContent = 'No file selected';
            fileSize.textContent = '';
        }
        const sendProposalByNbfc = (file, studentId, nbfcId, placeHolder) => {


            const remarks = placeHolder.value;

            const sendProposalDetails = new FormData();

            sendProposalDetails.append('file', file);
            sendProposalDetails.append('userId', studentId);
            sendProposalDetails.append('nbfcId', nbfcId)
            sendProposalDetails.append('remarks', remarks);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            // Check if the file is present
            if (!file) {
                console.error('No file provided');
                return;
            }

            // Sending the request
            fetch('/send-proposals-with-file', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: sendProposalDetails,
            })
                .then(response => {
                    // Handle errors in response
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(`${response.status}: ${errorData.message || 'Network response was not ok'}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data) {
                        alert(data.message);

                    } else {
                        console.error("Error: No file URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error uploading file", error);
                    // Optional: Display a friendly error message to the user, like a notification
                });
        };


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
        closeButtons.forEach(button => button.addEventListener('click', closeModal));
        cancelButton.addEventListener('click', closeModal);
        sendButton.addEventListener('click', closeModal);


        document.addEventListener("DOMContentLoaded", function () {
            const modalContainer = document.getElementById("model-container-reject-container");
            const closeButton = document.getElementById("close-button-id");
            const cancelButton = document.getElementById("cancel-button-id");
            const sendProposalRejectButton = document.getElementById("reject-button-id");
            const addAttachmentBtn = document.getElementById("addAttachmentBtn");
            const fileInput = document.getElementById("fileInput");
            const fileNameSpan = document.getElementById("fileName");
            const removeAttachmentBtn = document.getElementById("removeAttachmentBtn");
            let selectedFile = null;

            function hideRejectModal() {
                if (modalContainer) {
                    modalContainer.style.display = "none";
                    if (fileInput) {
                        fileInput.value = "";
                    }
                    if (fileNameSpan && removeAttachmentBtn) {
                        fileNameSpan.textContent = "+ Add Attachment";
                        removeAttachmentBtn.style.display = "none";
                    }
                    selectedFile = null;
                }
            }

            if (addAttachmentBtn && fileInput) {
                addAttachmentBtn.addEventListener("click", () => {
                    fileInput.click();
                });

                fileInput.addEventListener("change", (event) => {
                    if (event.target.files && event.target.files[0]) {
                        selectedFile = event.target.files[0];
                        if (fileNameSpan && removeAttachmentBtn) {
                            fileNameSpan.textContent = selectedFile.name;
                            removeAttachmentBtn.style.display = "inline-flex";
                        }
                    }
                });
            }

            if (removeAttachmentBtn) {
                removeAttachmentBtn.addEventListener("click", () => {
                    if (fileInput && fileNameSpan) {
                        fileInput.value = "";
                        fileNameSpan.textContent = "+ Add Attachment";
                        removeAttachmentBtn.style.display = "none";
                        selectedFile = null;
                    }
                });
            }

            if (closeButton) {
                closeButton.addEventListener("click", hideRejectModal);
            }

            if (cancelButton) {
                cancelButton.addEventListener("click", hideRejectModal);
            }

            if (modalContainer) {
                modalContainer.addEventListener("click", function (event) {
                    if (event.target === modalContainer) {
                        hideRejectModal();
                    }
                });
            }

            if (sendProposalRejectButton) {
                sendProposalRejectButton.addEventListener("click", () => {
                    const remarks = document.querySelector(".remarks-textarea").value;
                    const formData = new FormData();
                    formData.append("remarks", remarks);
                    if (selectedFile) {
                        formData.append("attachment", selectedFile);
                    }
                    console.log("Remarks:", remarks);
                    console.log("File:", selectedFile);
                    hideRejectModal();
                });
            }
        });


        // const handleMessageTrigger = (studentId) => {



        // }





        const getStudents = () => {
            var user = @json(session('nbfcuser'));

            if (user && user.nbfc_id) {
                const nbfcId = user.nbfc_id;

                return fetch('/trace-process', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ nbfcId }) // Sending the NBFC ID
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json(); // Parse response to JSON
                    })
                    .then((data) => {
                        if (data && data.returnValues && Array.isArray(data.returnValues)) {
                            createContainerList(data.returnValues);
                            return data.returnValues;
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


        getStudents().then(studentData => {
            if (studentData) {
                const studentNames = studentData.map(student => student.name);
                const studentIds = studentData.map(student => student.unique_id)
                const studentNameElements = document.querySelectorAll(".student-name");
                const studentNameElementIds = document.querySelectorAll(".student-ids");
                const studentContainers = document.querySelectorAll(".index-student-message-container");
                const messageThreads = document.querySelectorAll(".nbfc-individual-bankmessage-input-message");
                const searchInput = document.querySelector(".index-search-input");

                const studentCards = document.querySelectorAll(".index-student-message-container");

                // Populate student names in the UI
                studentNameElementIds.forEach((element, index) => {
                    if (studentIds[index]) {
                        element.textContent = studentIds[index];

                    }
                })
                studentNameElements.forEach((element, index) => {
                    if (studentNames[index]) {
                        element.textContent = studentNames[index];

                    }
                });

                // Add data attributes for sorting and sync message threads
                studentContainers.forEach((container, index) => {
                    if (studentNames[index]) {
                        container.querySelector(".student-name").textContent = studentNames[index];
                        container.setAttribute("data-name", studentNames[index].toLowerCase()); // Store lowercase name for sorting
                        messageThreads[index]?.setAttribute("data-name", studentNames[index].toLowerCase()); // Sync message-thread
                    }
                });

                console.log("Student names: ", studentNames);

                // Sorting logic
                document.querySelectorAll(".sort-dropdown-nbfc li").forEach((item) => {
                    item.addEventListener("click", function () {
                        let sortType = this.getAttribute("data-sort");
                        let sortedArray = [...studentContainers]; // Copy of student containers

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
                        parent.innerHTML = ""; // Clear existing items
                        sortedArray.forEach((item) => {
                            parent.appendChild(item);

                            // Sync message-thread order
                            let studentName = item.getAttribute("data-name");
                            let correspondingThread = [...messageThreads].find(thread => thread.getAttribute("data-name") === studentName);
                            if (correspondingThread) parent.appendChild(correspondingThread);
                        });

                        sortDropdown.classList.remove("visible");

                        sortTrigger.click();
                    });
                });

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

                });

            }
        });



        const messageThreads = document.querySelectorAll(".message-thread");
        messageThreads.forEach(thread => {
            const studentNameElement = thread.querySelector(".student-name");
            if (studentNameElement) {
                const studentName = studentNameElement.textContent.toLowerCase();
                thread.style.display = studentName.includes(searchText) ? "flex" : "none";
            }
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



        const studentContainers = document.querySelectorAll(".index-student-message-container");
        const sortDropdown = document.getElementById("sort-options-index-nbfc");
        const sortTrigger = document.getElementById("index-nbfc-sort-id");


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






        function initializeChats() {
            const chatContainer = document.querySelectorAll('.nbfc-individual-bankmessage-input-message');

            chatContainer.forEach((container, index) => {
                const chatId = `chat-${index}`;
                container.setAttribute('data-chat-id', chatId);

                const parentContainer = container.closest('.index-student-message-container');
                const viewButton = parentContainer.querySelector('.index-student-view-btn');

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
        max-height: 300px;
        background: #fff;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 10px;
        padding-top:10px;
        `;


                container.parentNode.insertBefore(messagesWrapper, container);
                console.log(container)
                // Get elements within this container
                const messageInput = container.querySelectorAll(".nbfc-message-input");
                const sendButton = container.querySelector(".nbfc-send-img");
                const smileIcon = container.querySelector(".nbfc-face-smile");
                const paperclipIcon = container.querySelector(".nbfc-paperclip");

                function showChat() {

                    messagesWrapper.style.display = 'flex';
                    container.style.display = 'flex';
                    if (viewButton) viewButton.textContent = 'Close';
                }

                function hideChat() {
                    messagesWrapper.style.display = 'none';
                    container.style.display = 'none';
                    if (viewButton) viewButton.textContent = 'View';
                }

                function sendMessage(messageInput, messageUserId) {
                    console.log(messageInput, messageUserId)
                    if (!messageInput) return;

                    const content = messageInput.value.trim();
                    if (content) {
                        showChat();




                        // const messageElement = document.createElement("div");
                        // messageElement.style.cssText = `
                        //     display: flex;
                        //     justify-content: flex-end;
                        //     width: 100%;
                        //     margin-bottom: 10px;
                        // `;

                        // const messageContent = document.createElement("div");
                        // messageContent.style.cssText = `
                        //         max-width: 80%;
                        //         padding: 8px 12px;
                        //         border-radius: 8px;
                        //         word-wrap: break-word;
                        //         font-family: 'Poppins', sans-serif;
                        //     `;
                        // messageContent.textContent = content;

                        // messageElement.appendChild(messageContent);
                        // messagesWrapper.appendChild(messageElement);

                        messageInput.value = "";

                        sendMessageToBackend(content, messageUserId);
                    }
                }
                async function sendMessageToBackend(content, messageUserId) {
                    const studentId = messageUserId;
                    const receiverId = studentId;


                    var user = @json(session('nbfcuser'));
                    console.log(studentId + "----");

                    if (!user || !user.nbfc_id) {
                        console.error('User not found or invalid nbfc_id');
                        return;
                    }

                    const nbfc_id = user.nbfc_id; // Current user nbfc_id
                    const senderId = nbfc_id;

                    try {
                        const payload = {
                            nbfc_id: nbfc_id,
                            student_id: studentId,
                            sender_id: senderId,
                            receiver_id: receiverId,
                            message: content,
                            is_read: false,
                        };

                        const response = await fetch('/send-message', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""

                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await response.json();

                        if (response.ok) {
                            console.log('Message sent successfully:', data.message);

                            //                     const messageElement = document.createElement("div");
                            //                     messageElement.style.cssText = `
                            //     display: flex;
                            //     justify-content: flex-end;
                            //     width: 100%;
                            //     margin-bottom: 10px;
                            // `;
                            //                     const messageContent = document.createElement("div");
                            //                     messageContent.style.cssText = `
                            //     max-width: 80%;
                            //     padding: 8px 12px;
                            //     border-radius: 8px;
                            //     background-color: #DCF8C6;
                            //     word-wrap: break-word;
                            //     font-family: 'Poppins', sans-serif;
                            //     box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                            // `;
                            //                     messageContent.textContent = content;

                            //                     messagesWrapper.appendChild(messageElement);

                            scrollToBottom();

                            await viewChat(nbfc_id, messageInputStudentids);
                        } else {
                            console.error('Failed to send message:', data.error || 'Unknown error');
                        }
                    } catch (error) {
                        console.error('Error sending message:', error);
                    }
                }

                if (viewButton) {
                    viewButton.addEventListener('click', function () {
                        if (messagesWrapper.style.display === 'none') {
                            showChat();



                        } else {
                            hideChat();
                        }
                    });
                }

                messageInput.forEach((messageInput, index) => {
                    if (messageInput) {
                        messageInput.addEventListener('input', function () {
                            if (messagesWrapper.style.display === 'none') {
                                showChat();
                            }
                        });

                        messageInput.addEventListener('keypress', function (e) {
                            if (e.key === 'Enter') {
                                e.preventDefault();

                                const messageUserId = messageUserIds[index].textContent;
                                console.log(`${messageUserId}here}`)

                                // if (messagesWrapper.style.display === 'none') {
                                //     showChat();
                                // }

                                sendMessage(messageInput, messageUserId); // This should only run when the Enter key is pressed
                            }
                        });

                    }
                })


                const messageUserIds = document.querySelectorAll(".index-student-info .student-ids");
                const sendButtons = document.querySelectorAll(".nbfc-individual-bankmessage-input-message .nbfc-send-img");
                const inputs = document.querySelectorAll(".nbfc-message-input");


                sendButtons.forEach((sendButton, index) => {
                    if (sendButton) {
                        sendButton.addEventListener('click', function (e) {
                            e.preventDefault();
                            const messageUserId = messageUserIds[index].textContent;
                            const messageInput = inputs[index];

                            sendMessage(messageInput, messageUserId);
                        });
                    }
                })
                function viewChat(nbfc_id, messageInputStudentids) {
                    const student_id = messageInputStudentids;
                    nbfc_id = nbfc_id.trim();
                    const chatId = `chat-${index}`;

                    messagesWrapper.innerHTML = '';

                    if (chatId) {
                        const apiUrl = `/get-messages/${nbfc_id}/${student_id}`;

                        fetch(apiUrl)
                            .then(response => response.json())
                            .then(data => {
                                console.log('API response:', data);
                                if (data && data.messages && data.messages.length > 0) {
                                    // Sort messages by ID to ensure chronological order
                                    data.messages.sort((a, b) => a.id - b.id);

                                    data.messages.forEach(message => {
                                        const messageElement = document.createElement("div");
                                        messageElement.setAttribute('data-chat-id', chatId);

                                        // Determine if the sender is the NBFC (right side) or student (left side)
                                        const isNbfcSender = message.sender_id === nbfc_id;

                                        messageElement.style.cssText = `
                            display: flex;
                            justify-content: ${isNbfcSender ? 'flex-end' : 'flex-start'};
                            width: 100%;
                            margin-bottom: 10px;
                            padding-top: 10px;
                        `;

                                        const messageContent = document.createElement("div");
                                        messageContent.style.cssText = `
                            max-width: 80%;
                            padding: 8px 12px;
                            border-radius: 8px;
                            background-color: ${isNbfcSender ? '#DCF8C6' : '#FFF'};
                            overflow-wrap: break-word;
                            font-family: 'Poppins', sans-serif;
                            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                        `;

                                        messageContent.textContent = message.message;
                                        messageElement.appendChild(messageContent);
                                        messagesWrapper.appendChild(messageElement);
                                    });

                                    // Scroll to the bottom after loading messages
                                    scrollToBottom();
                                } else {
                                    console.log('No messages found');
                                    // Optionally display a "No messages" placeholder
                                    const noMessages = document.createElement("div");
                                    noMessages.textContent = "No messages yet";
                                    noMessages.style.textAlign = "center";
                                    noMessages.style.padding = "20px";
                                    noMessages.style.color = "#999";
                                    messagesWrapper.appendChild(noMessages);
                                }

                                // Add the chat ID to the set of loaded chats
                                loadedChats.add(chatId);
                            })
                            .catch(error => {
                                console.error('Error fetching messages:', error);
                                // Optionally display an error message
                                const errorElement = document.createElement("div");
                                errorElement.textContent = "Error loading messages";
                                errorElement.style.color = "red";
                                errorElement.style.padding = "20px";
                                errorElement.style.textAlign = "center";
                                messagesWrapper.appendChild(errorElement);
                            });
                    }

                    messagesWrapper.style.display = 'flex';
                    container.style.display = 'flex';

                    if (parentContainer) {
                        parentContainer.style.height = "auto";
                    }
                }





                function scrollToBottom() {


                    messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                }
                var messageBtns = document.querySelectorAll('.index-student-message-btn');

                if (messageBtns.length > 0) {
                    messageBtns[index].addEventListener('click', function () {
                        showChat();
                        var user = @json(session('nbfcuser'));
                        const nbfc_id = user.nbfc_id;
                        console.log(nbfc_id);

                        console.log(messageUserIds[index].textContent);
                        const messageInputStudentids = messageUserIds[index].textContent;
                        console.log(messageInputStudentids);

                        viewChat(nbfc_id, messageInputStudentids);
                    });
                }


                const messageTriggerImplement = document.querySelector('#index-student-message-btn');

                if (messageTriggerImplement) {
                    // const newTrigger = messageTriggerImplement.cloneNode(true);
                    // messageTriggerImplement.parentNode.replaceChild(newTrigger, messageTriggerImplement);

                    messageTriggerImplement.addEventListener('click', () => {
                        const messageInputStudentids = messageUserIds[index].textContent;
                        console.log(messageInputStudentids);
                        const userId = messageInputStudentids;
                        var user = @json(session('nbfcuser'));
                        const nbfc_id = user.nbfc_id;
                        messagesWrapper.style.display = 'flex';
                        container.style.display = 'flex';

                    })


                }
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
                                messageInput[index].value += emoji;
                                picker.remove();
                                messageInput[index].focus();
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
                            }
                        };

                        document.body.appendChild(fileInput);
                        fileInput.click();
                        document.body.removeChild(fileInput);
                    });
                }

                // Initialize message button




                // Load saved messages
                //         savedMessages.forEach(content => {
                //             const messageElement = document.createElement("div");
                //             messageElement.style.cssText = `
                //     display: flex;
                //     justify-content: flex-end;
                //     width: 100%;
                //     margin-bottom: 10px;
                // `;

                //             const messageContent = document.createElement("div");
                //             messageContent.style.cssText = `
                //     max-width: 80%;
                //     padding: 8px 12px;
                //     border-radius: 8px;
                //     word-wrap: break-word;
                // `;
                //             messageContent.textContent = content;

                //             messageElement.appendChild(messageContent);
                //             messagesWrapper.appendChild(messageElement);
                //         });
            });
        }

        let loadedChats = new Set();




        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeChats);
        const passwordModelTriggerNbfc = () => {
            const passwordTrigger = document.getElementById("change-password-trigger-nbfc");

            const passwordChangeContainer = document.querySelector(".password-change-container-nbfc");
            const passwordContainerExit = document.querySelector(".password-change-container-nbfc .password-change-triggered-view-headersection-nbfc img");
            const popupPasswordShow = document.querySelector(".popup-notify-list-nbfc");
            const arrowUp = document.querySelector(".nbfc-profile .nbfc-dropdown-icon");

            if (passwordTrigger) {
                passwordTrigger.addEventListener("click", () => {
                    if (passwordChangeContainer) {
                        passwordChangeContainer.style.display = "flex";
                        if (popupPasswordShow) {
                            popupPasswordShow.style.display = "none";

                        }
                        if (arrowUp) {
                            arrowUp.style.transform = 'rotate(0deg)';

                        }
                    }



                })
            }
            if (passwordContainerExit) {
                passwordContainerExit.addEventListener("click", () => {
                    if (passwordChangeContainer) {
                        passwordChangeContainer.style.display = "none";
                    }
                })
            }

        }

        const userPopopuOpenNbfc = () => {
            const userPopupTrigger = document.querySelector(".nbfc-profile .nbfc-dropdown-icon");
            const userPopupList = document.querySelector(".popup-notify-list-nbfc");

            if (userPopupTrigger && userPopupList) {
                // Toggle dropdown on trigger click
                userPopupTrigger.addEventListener('click', (event) => {
                    event.stopPropagation(); // Prevent click from bubbling to document
                    if (userPopupList.style.display === "none" || userPopupList.style.display === "") {
                        userPopupTrigger.style.transform = 'rotate(180deg)';
                        userPopupList.style.display = "flex";
                    } else {
                        userPopupTrigger.style.transform = 'rotate(0deg)';
                        userPopupList.style.display = "none";
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (event) => {
                    const isClickInsideTrigger = userPopupTrigger.contains(event.target);
                    const isClickInsidePopup = userPopupList.contains(event.target);

                    if (!isClickInsideTrigger && !isClickInsidePopup && userPopupList.style.display === "flex") {
                        userPopupTrigger.style.transform = 'rotate(0deg)';
                        userPopupList.style.display = "none";
                    }
                });
            }
        }


        function displayError(elementId, message) {
            var errorElement = document.getElementById(elementId);
            errorElement.innerText = message;
            errorElement.style.display = 'block';
        }

        function clearErrorMessages() {
            var errorElements = document.getElementsByClassName('error-message');
            for (var i = 0; i < errorElements.length; i++) {
                errorElements[i].innerText = '';
                errorElements[i].style.display = 'none';
            }
        }


        const passwordChangeCheckNbfc = () => {
            document.getElementById('password-change-save-nbfc').addEventListener('click', function () {
                let currentPassword = document.getElementById('current-password-nbfc').value.trim();
                let newPassword = document.getElementById('new-password-nbfc').value.trim();
                let confirmNewPassword = document.getElementById('confirm-new-password-nbfc').value.trim();
                const passwordChangeContainer = document.querySelector(".password-change-container-nbfc");


                clearErrorMessages();
                let valid = true;

                if (!currentPassword) {
                    displayError('current-password-error-nbfc', 'Current password cannot be empty.');
                    valid = false;
                }

                if (!newPassword) {
                    displayError('new-password-error-nbfc', 'New password cannot be empty.');
                    valid = false;
                } else if (newPassword.length < 8) {
                    displayError('new-password-error-nbfc', 'New password must be at least 8 characters long.');
                    valid = false;
                }

                if (newPassword !== confirmNewPassword) {
                    displayError('confirm-password-error-nbfc', 'Passwords do not match.');
                    valid = false;
                }

                if (!valid) return;

                console.log('Password change request is valid.');

                const userId = nbfcuser ? nbfcuser.nbfc_id : '';
                console.log(userId)




                const passwordChangeVariables = {
                    userId,
                    currentPassword,
                    newPassword
                };


                fetch("/passwordchange", {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
                    },
                    body: JSON.stringify(passwordChangeVariables)
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("Password changed successfully");
                            alert("Password updated successfully.");

                            if (passwordChangeContainer) {
                                passwordChangeContainer.style.display = "none";
                                document.getElementById('current-password-nbfc').value = '';
                                document.getElementById('new-password-nbfc').value = '';
                                document.getElementById('confirm-new-password-nbfc').value = '';
                            }
                        } else {
                            console.error("Error:", data.message);
                            alert(data.message);
                        }
                    })
                    .catch((error) => {
                        console.error("Fetch error:", error);
                        alert("An unexpected error occurred.");
                    });
            });
        };

        const viewProfileOfUsers = async (viewButton, studentId, loaderElement) => {
            // Get userId from the studentId element
            const userId = studentId.textContent;
            console.log("Fetching profile for user:", userId);
            const inboxContainer = document.getElementById("index-section-id-nbfc");
            inboxContainer.style.display = "block";

            // Show loader and disable further interactions
            loaderElement.style.display = 'block'; // Show loader
            viewButton.disabled = true; // Disable the button to prevent multiple clicks

            try {
                // Wait for each function to complete
                await retreiveUserDetails(userId);
                await initialiseAllViews(userId);
                await initialiseProfileView(userId);


                console.log("Profile loaded for user:", userId);
            } catch (error) {
                console.error("Error retrieving or initializing user details:", error);
            } finally {
                // Hide loader and re-enable interactions after all functions have completed
                loaderElement.style.display = 'none'; // Hide loader
                viewButton.disabled = false; // Re-enable the button
            }
        };
        const initializeCoBorrowerDocumentUpload = () => {
            const coBorrowerDocuments = document.querySelectorAll(".individual-coborrower-kyc-documents");

            coBorrowerDocuments.forEach((card) => {
                let uploadedFile = null;
                const inputId = card.querySelector('input[type="file"]').id;
                const documentTypeText = card.querySelector('.document-name').textContent.trim();

                // Get the specific preview icon
                const previewIconId = card.querySelector('.fa-eye').id;

                // Trigger file input when the container is clicked
                card.querySelector('.inputfilecontainer-coborrower-kyccolumn').addEventListener('click', function (event) {
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

        const initializeKycDocumentUpload = () => {
            const individualKycDocumentsUpload = document.querySelectorAll(".individualkycdocuments");

            individualKycDocumentsUpload.forEach((card) => {
                let uploadedFile = null;

                card.querySelector('.inputfilecontainer').addEventListener('click', function () {
                    card.querySelector('#inputfilecontainer-real').click();
                });

                card.querySelector('#inputfilecontainer-real').addEventListener('change', function (event) {
                    const file = event.target.files[0];

                    if (!file) return;

                    console.log("Selected file: ", file);

                    // Allowed file types based on MIME type
                    const allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
                    const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

                    // Validate file type (extension and MIME)
                    if (!allowedExtensions.includes(fileExtension) || !allowedMimeTypes.includes(file.type)) {
                        alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                        event.target.value = ''; // Clear the file input
                        card.querySelector('.inputfilecontainer p').textContent = 'No file chosen';
                        return;
                    }

                    // Validate file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        alert("Error: File size exceeds 5MB limit.");
                        event.target.value = ''; // Clear the file input
                        card.querySelector('.inputfilecontainer p').textContent = 'No file chosen';
                        return;
                    }

                    // Store the file and update UI
                    uploadedFile = file;
                    const truncatedFileName = truncateFileName(file.name);
                    card.querySelector('.inputfilecontainer p').textContent = truncatedFileName;

                    const fileSize = file.size < 1024 * 1024
                        ? (file.size / 1024).toFixed(2) + ' KB'
                        : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    card.querySelector('.document-status').textContent = `${fileSize} Uploaded`;

                    console.log("File uploaded:", uploadedFile);
                });

                card.querySelector('.fa-eye').addEventListener('click', function (event) {
                    event.stopPropagation();
                    const eyeIcon = this;

                    if (eyeIcon.classList.contains('preview-active')) {
                        closePreview();
                    } else {
                        if (uploadedFile && uploadedFile.type === 'application/pdf') {
                            const reader = new FileReader();
                            reader.onload = function (event) {
                                openPdfPreview(event.target.result, uploadedFile.name);
                            };
                            reader.readAsDataURL(uploadedFile);
                            eyeIcon.classList.add('preview-active');
                            eyeIcon.classList.replace('fa-eye', 'fa-times');
                        } else {
                            alert('Please upload a valid PDF file to preview.');
                        }
                    }

                    function closePreview() {
                        const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                        if (previewWrapper) previewWrapper.remove();
                        const overlay = document.querySelector('.pdf-preview-overlay');
                        if (overlay) overlay.remove();
                        eyeIcon.classList.remove('preview-active');
                        eyeIcon.classList.replace('fa-times', 'fa-eye');
                    }

                    function openPdfPreview(pdfDataUrl, fileName) {
                        // Create overlay and preview wrapper
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

                        const fileNameSection = document.createElement('span');
                        fileNameSection.textContent = fileName;
                        fileNameSection.style.cssText = 'color: white; font-size: 14px;';

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
                `;

                        closeButton.addEventListener('click', closePreview);
                        overlay.addEventListener('click', closePreview);

                        // Create iframe for PDF preview
                        const iframe = document.createElement('iframe');
                        iframe.src = pdfDataUrl;
                        iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                `;

                        // Assemble the preview
                        header.appendChild(fileNameSection);
                        header.appendChild(closeButton);
                        previewWrapper.appendChild(header);
                        previewWrapper.appendChild(iframe);
                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);
                    }
                });
            });
        };
        const initializeMarksheetUpload = () => {
            const individualMarksheetDocumentsUpload = document.querySelectorAll(".individualmarksheetdocuments");

            individualMarksheetDocumentsUpload.forEach((card) => {
                let uploadedFile = null;

                card.querySelector('.inputfilecontainer-marksheet').addEventListener('click', function () {
                    card.querySelector('#inputfilecontainer-real-marksheet').click();
                });

                card.querySelector('#inputfilecontainer-real-marksheet').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        uploadedFile = file;
                        card.querySelector('.inputfilecontainer-marksheet p').textContent = file.name;
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        const filesizeviewer = card.querySelector('.document-status');
                        filesizeviewer.textContent = `${fileSizeMB} MB Uploaded`;
                    }
                });

                card.querySelector('.fa-eye').addEventListener('click', function (event) {
                    event.stopPropagation();
                    const previewContainer = card.querySelector('.inputfilecontainer-marksheet');
                    const eyeIcon = this;

                    if (eyeIcon.classList.contains('preview-active')) {
                        const previewWrapper = previewContainer.querySelector('.pdf-preview-wrapper');
                        if (previewWrapper) previewWrapper.remove();
                        eyeIcon.classList.remove('preview-active');
                        eyeIcon.classList.replace('fa-times', 'fa-eye');
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
                                    eyeIcon.classList.remove('preview-active');
                                    eyeIcon.classList.replace('fa-times', 'fa-eye');
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
                                document.addEventListener('keydown', function (e) {
                                    if (e.key === 'Escape') {
                                        closePreview();
                                    }
                                });
                            };
                            reader.readAsDataURL(uploadedFile);
                            eyeIcon.classList.add('preview-active');
                            eyeIcon.classList.replace('fa-eye', 'fa-times');
                        } else {
                            alert('Please upload a valid PDF file to preview.');
                        }
                    }
                });


            });
        };

        const initializeSecuredAdmissionDocumentUpload = () => {
            const securedAdmissionDocuments = document.querySelectorAll(".individual-secured-admission-documents");

            securedAdmissionDocuments.forEach((card, index) => {
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
                        const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                        if (previewWrapper) previewWrapper.remove();
                        const overlay = document.querySelector('.pdf-preview-overlay');
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


        const initialiseEightcolumn = () => {
            const section = document.querySelector('.eightcolumn-firstsection');

            section.addEventListener('click', function (event) {
                event.stopPropagation();

                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });
        }
        const initialiseSeventhcolumn = () => {
            const section = document.querySelector('.seventhcolum-firstsection');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
        const initialiseSeventhAdditionalColumn = () => {
            const section = document.querySelector('.seventhcolumn-additional-firstcolumn');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
        const initialiseNinthcolumn = () => {
            const section = document.querySelector('.ninthcolumn-firstsection');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
        const initialiseTenthcolumn = () => {
            const section = document.querySelector(".tenthcolumn-firstsection");
            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
        const forgotPassword = () => {


        }
        const initializeWorkExperienceDocumentUpload = () => {
            const workExperienceDocuments = document.querySelectorAll(".individual-work-experiencecolumn-documents");

            workExperienceDocuments.forEach((card) => {
                let uploadedFile = null;
                const inputId = card.querySelector('input[type="file"]').id;
                const documentTypeText = card.querySelector('.document-name').textContent.trim();

                // Get the specific preview icon
                const previewIconId = card.querySelector('.fa-eye').id;

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
                        const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                        if (previewWrapper) previewWrapper.remove();
                        const overlay = document.querySelector('.pdf-preview-overlay');
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
                                    eyeIcon.classList.remove('preview-active');
                                };

                                closeButton.addEventListener('click', closePreview);
                                overlay.addEventListener('click', closePreview);

                                header.appendChild(fileNameSection);
                                header.appendChild(zoomControls);
                                header.appendChild(closeButton);

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
        let userDataCache = {};

        const retreiveUserDetails = async (userId) => {
            const profileViewContainerNbfc = document.getElementById("nbfc-student-profile-details");

            const nbfcListUsers = document.querySelector(".dashboard-sections-container");
            const profileContainerSection = document.querySelector("#nbfc-list-of-student-profilesections");
            const parentContainerNBFC = document.querySelector(".nbfcdashboard-studentlistscontainer");
            const viewContainerApplication = document.getElementById("nbfc-student-profile-details");

            // Check if the user data is already cached
            if (userDataCache[userId]) {
                console.log("Loading cached data for user:", userId);

                // Await the async function to update the profile view
                await updateProfileView(profileViewContainerNbfc, profileContainerSection, userDataCache[userId]);
                nbfcListUsers.style.display = "none";
                parentContainerNBFC.style.display = "flex";
                viewContainerApplication.style.display = "flex"

                // Return a resolved promise since the data was cached
                return Promise.resolve();
            }

            // If not cached, fetch the data
            try {
                const response = await fetch('/getUserFromNbfc', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ userId: userId })
                });

                const data = await response.json();

                // Cache the user data
                userDataCache[userId] = data;
                viewContainerApplication.style.display = "flex"

                // Update the view with the fetched data (await the async function)
                await updateProfileView(profileViewContainerNbfc, profileContainerSection, data);

                // Hide the list and show the profile
                nbfcListUsers.style.display = "none";
                parentContainerNBFC.style.display = "flex";
            } catch (error) {
                console.error('Error fetching user details:', error);
            }
        };
      const updateProfileView = (container, usersListcontainer, data) => {
            // Input Fields
            const courseInput = container.querySelector("#plan-to-study-edit");
            const courseDuration = container.querySelector(".myapplication-fourthcolumn-additional input");
            const loanAmount = container.querySelector(".myapplication-fourthcolumn input");
            const scReferral = container.querySelector(".myapplication-fifthcolumn input");

            // Degree Radio Buttons & Labels
            const degreeRadioBachelors = container.querySelector('input[name="education-level"][value="Bachelors"]');
            const degreeRadioMasters = container.querySelector('input[name="education-level"][value="Masters"]');
            const degreeRadioOthers = container.querySelector('input[name="education-level"][value="Others"]');

            const bachelorsLabel = container.querySelector("#bachelors-label");
            const mastersLabel = container.querySelector("#masters-label");
            const othersLabel = container.querySelector("#others-label");
            const otherDegreeInputNBFC = container.querySelector("#otherDegreeInputNBFC");

            // Personal Info
            const userName = usersListcontainer.querySelector(".personal_info_name p");
            const userPhone = usersListcontainer.querySelector(".personal_info_phone p");
            const userMail = usersListcontainer.querySelector(".personal_info_email p");
            const userState = usersListcontainer.querySelector(".personal_info_state p");

            // Education Info container
            const educationContainer = usersListcontainer.querySelector(
                "#nbfc-list-of-student-profilesections .studentdashboardprofile-educationeditsection .educationeditsection-secondrow"
            );

            const academic = data.academicDetails?.[0] ?? {};
            const personal = data.personalDetails?.[0] ?? {};
            const user = data.userDetails?.[0] ?? {};
            const course = data.courseDetails?.[0] ?? {};

            // Update Education Paragraphs with label and value spans for styling
            if (educationContainer) {
                educationContainer.innerHTML = `
            <p><span class="label">1. Course</span><span class="value">${academic.course_name ?? ''}</span></p>
            <p><span class="label">2. University</span><span class="value">${academic.university_school_name ?? ''}</span></p>
        `;
            }

            // Personal Info Update
            if (userName) userName.textContent = personal.full_name ?? '';
            if (userPhone) userPhone.textContent = user.phone ?? '';
            if (userMail) {
                userMail.textContent = user.email ?? '';
                userMail.title = user.email ?? '';
            }
            if (userState) userState.textContent = personal.state ?? '';

            // Course Inputs
            if (courseDuration) courseDuration.value = course['course-duration'] ?? '';
            if (loanAmount) loanAmount.value = course.loan_amount_in_lakhs ?? '';
            if (scReferral) scReferral.value = personal.referral_code ?? '';

            // Degree Type
            const degreeType = course['degree-type'];
            bachelorsLabel.style.display = 'none';
            mastersLabel.style.display = 'none';
            othersLabel.style.display = 'none';
            otherDegreeInputNBFC.style.display = 'none';

            if (degreeType === 'Bachelors') {
                bachelorsLabel.style.display = 'flex';
                degreeRadioBachelors.checked = true;
            } else if (degreeType === 'Masters') {
                mastersLabel.style.display = 'flex';
                degreeRadioMasters.checked = true;
            } else if (degreeType) {
                othersLabel.style.display = 'flex';
                degreeRadioOthers.checked = true;
                otherDegreeInputNBFC.style.display = 'flex';
                otherDegreeInputNBFC.disabled = false;
                otherDegreeInputNBFC.value = degreeType;
            }

            // Plan to Study
            let planToStudy = course['plan-to-study'];
            try {
                planToStudy = typeof planToStudy === 'string' ? JSON.parse(planToStudy) : planToStudy;
            } catch (e) {
                console.error("Invalid JSON in 'plan-to-study':", e);
            }
            if (courseInput) {
                courseInput.value = Array.isArray(planToStudy) ? planToStudy.join(', ') : (planToStudy ?? '');
            }

            // Test Scores Section
            const testScoresSection = usersListcontainer.querySelector(".testscoreseditsection-secondrow");
            if (testScoresSection) {
                testScoresSection.innerHTML = '';

                const scores = [];

                if (academic.ILETS) scores.push({ label: "IELTS", score: academic.ILETS });
                if (academic.GRE) scores.push({ label: "GRE", score: academic.GRE });
                if (academic.TOFEL) scores.push({ label: "TOEFL", score: academic.TOFEL });

                // Parse Others JSON
                try {
                    const others = typeof academic.Others === 'string' ? JSON.parse(academic.Others) : academic.Others;
                    if (others?.otherExamName && others?.otherExamScore) {
                        scores.push({ label: others.otherExamName.toUpperCase(), score: others.otherExamScore });
                    }
                } catch (e) {
                    console.error('Invalid JSON in "Others":', academic.Others);
                }

                // Render scores with dynamic serial number
                scores.forEach((item, index) => {
                    const p = document.createElement("p");

                    const labelSpan = document.createElement("span");
                    labelSpan.textContent = `${index + 1}. ${item.label}`;
                    labelSpan.style.display = "inline-block";
                    labelSpan.style.width = "150px";
                    labelSpan.style.fontWeight = "500";

                    const valueSpan = document.createElement("span");
                    valueSpan.textContent = item.score;
                    valueSpan.style.fontWeight = "500";

                    p.appendChild(labelSpan);
                    p.appendChild(valueSpan);
                    testScoresSection.appendChild(p);
                });
            }
        };

        const endpoints = [
            { url: '/retrieve-file', selector: ".uploaded-aadhar-name", fileType: "aadhar-card-name" },
            { url: '/retrieve-file', selector: ".uploaded-pan-name", fileType: "pan-card-name" },
            { url: '/retrieve-file', selector: ".passport-name-selector", fileType: "passport-name" },
            { url: '/retrieve-file', selector: ".sslc-marksheet", fileType: "tenth-grade-name" },
            { url: '/retrieve-file', selector: ".hsc-marksheet", fileType: "twelfth-grade-name" },
            { url: '/retrieve-file', selector: ".graduation-marksheet", fileType: "graduation-grade-name" },
            { url: '/retrieve-file', selector: ".sslc-grade", fileType: "secured-tenth-name" },
            { url: '/retrieve-file', selector: ".hsc-grade", fileType: "secured-twelfth-name" },
            { url: '/retrieve-file', selector: ".graduation-grade", fileType: "secured-graduation-name" },
            { url: '/retrieve-file', selector: ".experience-letter", fileType: "work-experience-experience-letter" },
            { url: '/retrieve-file', selector: ".salary-slip", fileType: "work-experience-monthly-slip" },
            { url: '/retrieve-file', selector: ".office-id", fileType: "work-experience-office-id" },
            { url: '/retrieve-file', selector: ".joining-letter", fileType: "work-experience-joining-letter" },
            { url: '/retrieve-file', selector: ".coborrower-pancard", fileType: "co-pan-card-name" },
            { url: '/retrieve-file', selector: ".coborrower-aadharcard", fileType: "co-aadhar-card-name" },
            { url: '/retrieve-file', selector: ".coborrower-addressproof", fileType: "co-addressproof" },


        ];


        const initialiseAllViews = (userId) => {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken || !userId) {
                console.error("CSRF token or User ID is missing");
                return Promise.reject("CSRF token or User ID is missing");
            }


            const fetchWithUrl = ({ url, selector, fileType }) => {
                return fetch(url, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId: userId,
                        fileType: fileType,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.fileUrl) {
                            const fileName = data.fileUrl.split('/').pop();
                            const element = document.querySelector(selector);
                            if (element) {
                                element.textContent = fileName; // Update the element with the file name
                                console.log(`Fetched ${fileType}:`, data.fileUrl);

                            } else {
                                console.log(`Element not found for selector: ${selector}`);
                            }
                        } else {
                            console.log(`No fileUrl returned for ${fileType}`, data);
                        }
                    })
                    .catch(error => {
                        console.error(`Error fetching ${fileType}:`, error);
                    });
            };

            return Promise.all(endpoints.map(fetchWithUrl));
        };

        const initialiseProfileView = (userId) => {


            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            fetch('/retrieve-profile-picture', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ userId: userId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.fileUrl) {
                        console.log("Profile Picture URL:", data.fileUrl);
                        const imgElement = document.getElementById("profile-photo-id");
                        imgElement.src = data.fileUrl;
                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving profile picture", error);
                });
        }

        const sessionLogoutInitial = () => {
            fetch("{{ route('logout') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }
        const createContainerList = (data) => {
            console.log(data);

            const parentContainer = document.querySelector(".index-student-details-container");

            data.forEach((item) => {
                const msgContainer = document.createElement("div");
                msgContainer.classList.add("index-student-message-container");

                const studentCard = document.createElement("div");
                studentCard.classList.add("index-student-card");

                const studentInfo = document.createElement("div");
                studentInfo.classList.add("index-student-info");

                const studentInfoHeader = document.createElement("h3");
                studentInfoHeader.classList.add("student-name");
                studentInfoHeader.textContent = item.name;

                const studentIds = document.createElement("p");
                studentIds.classList.add("student-ids");
                studentIds.textContent = item.unique_id;

                const studentInfoDesc = document.createElement("p");
                studentInfoDesc.classList.add("index-student-description");
                studentInfoDesc.textContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua";

                const buttonGroup = document.createElement("div");
                buttonGroup.classList.add("index-student-button-group");

                const messageButton = document.createElement("button");
                messageButton.classList.add("index-student-message-btn");
                messageButton.textContent = "Message";

                const viewButton = document.createElement("button");
                viewButton.classList.add("index-student-view-btn");
                viewButton.textContent = "View";

                buttonGroup.append(messageButton, viewButton);

                const sendBtnMobile = document.createElement("div");
                sendBtnMobile.classList.add("index-student-send-btn-mobile");

                const sendImg = document.createElement("img");
                sendImg.src = "assets/images/send-index-btn.png";
                sendImg.alt = "the send image";

                sendBtnMobile.appendChild(sendImg);

                const messageInputContainer = document.createElement("div");
                messageInputContainer.classList.add("nbfc-individual-bankmessage-input-message");

                const messageInput = document.createElement("input");
                messageInput.type = "text";
                messageInput.placeholder = "Send message";
                messageInput.classList.add("nbfc-message-input");

                const sendIcon = document.createElement("img");
                sendIcon.src = "assets/images/send-nbfc.png";
                sendIcon.alt = "send icon";
                sendIcon.classList.add("nbfc-send-img");

                const paperClipIcon = document.createElement("i");
                paperClipIcon.classList.add("fa-solid", "fa-paperclip", "nbfc-paperclip");

                const smileIcon = document.createElement("i");
                smileIcon.classList.add("fa-regular", "fa-face-smile", "nbfc-face-smile");

                messageInputContainer.append(messageInput, sendIcon, paperClipIcon, smileIcon);

                studentInfo.append(studentInfoHeader, studentIds, studentInfoDesc); // Append studentInfoDesc
                studentCard.append(studentInfo, buttonGroup, sendBtnMobile);
                msgContainer.append(studentCard, messageInputContainer);

                parentContainer.appendChild(msgContainer);
            });
        };


        const insideMessageTrigger = () => {
            // if (messageBtnInside) {
            //     messageBtnInside.addEventListener('click', () => {
            //         if (messageBtns.length > 0) {
            //             messageBtns[index].addEventListener('click', function () {
            //                 showChat();
            //                 var user = @json(session('nbfcuser'));
            //                 const nbfc_id = user.nbfc_id;
            //                 console.log(nbfc_id);

            //                 console.log(messageUserIds[index].textContent);
            //                 const messageInputStudentids = messageUserIds[index].textContent;
            //                 console.log(messageInputStudentids);

            //                 viewChat(nbfc_id, messageInputStudentids);
            //             });
            //         }
            //     })
            // }
            console.log("insidetrigger")

        }
        function passwordForgotNbfc() {
            const forgotMailTrigger = document.querySelector(".footer-passwordchange-nbfc p");

            if (forgotMailTrigger) {
                forgotMailTrigger.addEventListener('click', () => {

                    var user = @json(session('nbfcuser'));
                    const email = user.nbfc_email;
                    alert(email);





                    fetch("/forgot-passwordmailsentnbfc", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ email: email })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.message) {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("There was an error while sending the email.");
                        });
                });
            }
        }
    </script>

    <div id="document-preview-modal" class="modal">
        <div class="modal-content">
            <span id="close-modal" class="close">×</span>
            <div id="document-preview-content"></div>
        </div>
    </div>


</body>

</html>