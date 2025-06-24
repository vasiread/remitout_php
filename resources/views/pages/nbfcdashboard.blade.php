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


    <link rel="stylesheet" href={{ asset('assets/css/nbfc.css') }}>

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
            $profileIconPath = 'assets/images/account_circle.png';
            $phoneIconPath = 'assets/images/call.png';
            $mailIconPath = 'assets/images/mail.png';
            $pindropIconPath = 'assets/images/pin_drop.png';
            $discordIconPath = 'assets/images/icons/discordicon.png';
            $viewIconPath = 'assets/images/visibility.png';
        @endphp

        <nav class="nbfc-navbar">
            <div class="nbfc-logo">
                <img src="/assets/images/nbfc-logo.png" alt="Remitout Logo">
            </div>

            <div class="nbfc-nav-right">
                <div class="nbfc-search-container" id="nbfc-search-container-id-index" style="display:none">
                    <img src="assets/images/search.png" alt="Search" class="nbfc-search-icon">
                    <input type="text" class="nbfc-search-input" id="nbfc-search-input-id" placeholder="Search">
                </div>

                <button class="nbfc-dark-mode">
                    <img src="/assets/images/notifications_unread.png" alt="the notification icon"
                        class="notification-icon">
                </button>
                @if (session()->has('nbfcuser'))
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



        <section class="dashboard-main-content" style="display:flex">


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

            <div class="wholeapplicationprofile">
                <div class="nbfcdashboard-studentlistscontainer">
                    <div class="studentdashboardprofile-profilesection" id="nbfc-list-of-student-profilesections">
                        <img src="{{ asset($profileImgPath) }}" class="profileImg" id="profile-photo-id" alt="">

                        <i class="fa-regular fa-pen-to-square"></i>
                        <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data">
                        <div class="studentdashboardprofile-personalinfo">
                            <div class="personalinfo-firstrow">
                                <h1>Student Profile</h1>
                            </div>
                            <ul class="personalinfo-secondrow">
                                <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                                        class="personal_info_id" style="margin-left: 6px;"> </span> </li>
                                <div class="myapplication-nbfcapprovalcolumn" id="profilesection-nbfcapprovalcolumn">
                                    <button id="sendproposaltrigger-mob">Send Proposal</button>
                                    <div class="nbfcapprovalcolumnrightaligned">
                                        <button id="mobmessage-nbfc">Message</button>
                                        <button id="mobreject-nbfc">Reject</button>
                                    </div>


                                </div>
                                <li class="personal_info_name" id="referenceNameId"><img src={{ $profileIconPath }}
                                        alt="">
                                    <p></p>
                                </li>
                                <li class="personal_info_phone"><img src={{ $phoneIconPath }} alt="">
                                    <p></p>
                                </li>
                                <li class="personal_info_email" id="referenceEmailId">
                                    <img src={{ $mailIconPath }} alt="">
                                    <p> </p>
                                </li>
                                <li class="personal_info_state"><img src={{ $pindropIconPath }} alt="">
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

                <div class="studentdashboardprofile-myapplication" id="nbfc-student-profile-details">
                    <div class="myapplication-firstcolumn">
                        <h1>Application Details</h1>
                        <div class="personalinfo-firstrow" style="display:none">
                            <button onClick="triggerEditButton()">Edit</button>
                            <button class="saved-msg">Saved</button>
                        </div>
                    </div>

                    <div class="myapplication-secondcolumn">
                        <p>1. Country of preference</p>
                        <input type="text" id="plan-to-study-edit"
                            value="{{ $courseDetails[0]->{'plan-to-study'} ?? '' }}">
                    </div>

                    <div class="myapplication-thirdcolumn">
                        <h6>2. Type of Degree</h6>
                        <div class="degreetypescheckboxes">
                            <label class="custom-radio" id="bachelors-label">
                                <input type="radio" name="education-level" value="Bachelors" style="display:none"
                                    @if (isset($courseDetails[0]->{'degree-type'}) && $courseDetails[0]->{'degree-type'} == 'Bachelors') checked @endif
                                    onclick="toggleOtherDegreeInput(event)" disabled>
                                <span class="radio-button"></span>
                                <p>Bachelors (only secured loan)</p>
                            </label>
                            <br>

                            <label class="custom-radio" id="masters-label">
                                <input type="radio" name="education-level" value="Masters" style="display:none"
                                    @if (isset($courseDetails[0]->{'degree-type'}) && $courseDetails[0]->{'degree-type'} == 'Masters') checked @endif
                                    onclick="toggleOtherDegreeInput(event)" disabled>
                                <span class="radio-button"></span>
                                <p>Masters</p>
                            </label>
                            <br>

                            <label class="custom-radio" id="others-label">
                                <input type="radio" name="education-level" value="Others" style="display:none"
                                    @if (isset($courseDetails[0]->{'degree-type'}) &&
                                            $courseDetails[0]->{'degree-type'} !== 'Bachelors' &&
                                            $courseDetails[0]->{'degree-type'} !== 'Masters') checked @endif
                                    onclick="toggleOtherDegreeInput(event)" disabled>
                                <span class="radio-button"></span>
                                <p>Others</p>
                            </label>
                        </div>

                        <input type="text" placeholder="Enter degree type"
                            value="{{ $courseDetails[0]->{'degree-type'} ?? '' }}" id="otherDegreeInputNBFC"
                            @if (
                                !isset($courseDetails[0]->{'degree-type'}) ||
                                    in_array($courseDetails[0]->{'degree-type'}, ['Bachelors', 'Masters'])) disabled @endif style="display: none;">
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
                            <button id="downloaddocuments">Download All</button>
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
                                        <p class="uploaded-pan-name truncate-filename" title="pan_card.jpg">pan_card.jpg
                                        </p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-pan-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individualkycdocuments">
                                    <p class="document-name">Aadhar Card</p>
                                    <div class="inputfilecontainer">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="uploaded-aadhar-name truncate-filename" title="aadhar_card.jpg">
                                            aadhar_card.jpg</p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-aadhar-card" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>

                                <div class="individualkycdocuments">
                                    <p class="document-name">Passport</p>
                                    <div class="inputfilecontainer">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="passport-name-selector truncate-filename" title="Passport.pdf">
                                            Passport.pdf</p>
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
                                    <p class="document-name ">10th grade marksheet</p>
                                    <div class="inputfilecontainer-marksheet">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="sslc-marksheet truncate-filename">
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
                                        <p class="hsc-marksheet truncate-filename">
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
                                        <p class="graduation-marksheet truncate-filename">
                                            {{ $academicDocuments[0]->graduation_marksheet ?? 'Graduation Marksheet' }}
                                        </p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}"
                                            id="view-graduation-card" />
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
                                        <p class="sslc-grade truncate-filename">
                                            {{ $securedAdmissions[0]->sslc_grade ?? 'SSLC Grade' }}</p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-sslc-grade" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-secured-admission-documents">
                                    <p class="document-name">12th Grade</p>
                                    <div class="inputfilecontainer-secured-admission">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="hsc-grade truncate-filename">
                                            {{ $securedAdmissions[0]->hsc_grade ?? 'HSC Grade' }}</p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-hsc-grade" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-secured-admission-documents">
                                    <p class="document-name">Graduation</p>
                                    <div class="inputfilecontainer-secured-admission">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="graduation-grade truncate-filename">
                                            {{ $securedAdmissions[0]->graduation_grade ?? 'Graduation' }}
                                        </p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}"
                                            id="view-graduation-grade" />
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
                                        <p class="experience-letter truncate-filename">
                                            {{ $workExperience[0]->experience_letter ?? 'Experience Letter' }}
                                        </p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}"
                                            id="view-experience-letter" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-work-experience" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-work-experiencecolumn-documents">
                                    <p class="document-name">3 month Salary Slip</p>
                                    <div class="inputfilecontainer-work-experiencecolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="salary-slip truncate-filename">
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
                                        <p class="office-id truncate-filename">
                                            {{ $workExperience[0]->office_id ?? 'Office ID' }}</p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-office-id" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-real-marksheet" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-work-experiencecolumn-documents">
                                    <p class="document-name">Employment Joining Letter</p>
                                    <div class="inputfilecontainer-work-experiencecolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="joining-letter truncate-filename">
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
                                        <p class="coborrower-pancard truncate-filename">
                                            {{ $coBorrowerDocuments[0]->pan_card ?? 'Pan Card' }}
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
                                        <p class="coborrower-aadharcard truncate-filename">
                                            {{ $coBorrowerDocuments[0]->aadhar_card ?? 'Aadhar Card' }}
                                        </p>
                                        <img class="fa-eye" src="{{ asset($viewIconPath) }}"
                                            id="view-coborrower-aadhar" />
                                    </div>
                                    <input type="file" id="inputfilecontainer-kyccoborrwer" />
                                    <span class="document-status">420 MB uploaded</span>
                                </div>
                                <div class="individual-coborrower-kyc-documents">
                                    <p class="document-name">Address Proof</p>
                                    <div class="inputfilecontainer-coborrower-kyccolumn">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="coborrower-addressproof truncate-filename">
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
                            <button id="index-student-message-btn-footer">Message</button>
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
                <div class="inbox-container">
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
                    <div class="adminmessage-inboxnbfc" style="border-bottom:1px solid #e5e7eb;">


                    </div>

                    <div class="index-student-details-container">

                    </div>
                    <div class="viewmore-messagenbfc">
                        <p>view more</p> <img src="{{ asset('assets/images/Icons/stat_minus_1.png') }}"
                            style="margin-top: 9px;
                        margin-left: 8px;
                        width: 12px;
                        height: 7px;"
                            alt="">
                    </div>
            </section>


            <div class="overlay-password-change-nbfc"></div>
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
            document.addEventListener('DOMContentLoaded', function() {
                // Define globally

                const mobileMenuBtn = document.getElementById('nbfcMobileMenuBtn');
                const mobileSidebar = document.querySelector('.nbfc-mobile-sidebar');
                const mobileOverlay = document.querySelector('.nbfc-mobile-overlay');
                const nbfcNavRight = document.querySelector('.nbfc-nav-right');

                // Select elements for menu items
                const dashboardBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(1)'); // Dashboard
                const inboxBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(2)'); // Inbox
                const dashboardContainer = document.querySelector('.dashboard-sections-container');
                const inboxContainer = document.querySelector('#index-section-id-nbfc');
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
                // downloadDocuments();

                //toggle function
                // Select the Dashboard and Inbox menu items
                const dashboardMenuItem = document.querySelector(
                    ".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(1)");
                const inboxMenuItem = document.querySelector(
                    ".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(2)");

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

                const viewContainerApplication = document.getElementById("nbfc-student-profile-details");



                // Function to show the dashboard and hide the inbox
                dashboardBtn.addEventListener('click', () => {


                    mobileSidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');

                    // Show dashboard container and hide inbox container
                    dashboardContainer.style.display = 'block';

                    inboxContainer.style.display = 'none';
                    parentContainerNBFC.style.display = 'none';
                    viewContainerApplication.style.display = "none";


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

                    // Show inbox container and hide others
                    inboxContainer.style.display = 'block';
                    dashboardContainer.style.display = 'none';
                    parentContainerNBFC.style.display = 'none';

                    // Show nav-right again on mobile
                    nbfcNavRight.classList.remove('hidden');

                    // Change the mobile menu icon to 'bars'
                    const icon = mobileMenuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');

                    // Set active tab
                    setActiveTab(inboxBtn);

                    // Hide wholeContainer only if inboxBtn is the active tab
                    if (inboxBtn.classList.contains('active')) {
                        const wholeContainer = document.querySelector(".wholeapplicationprofile");
                        wholeContainer.style.display = "none";
                    }
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
                    button.addEventListener('click', function() {
                        toggleSortOptions(button);
                    });
                });

                // Add event listeners for individual sort options
                document.querySelectorAll('.dashboard-sort-option').forEach(option => {
                    option.addEventListener('click', function() {
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
                dashboardMenuItem.addEventListener("click", function() {
                    const viewContainerApplication = document.getElementById("nbfc-student-profile-details");


                    if (viewContainerApplication) {
                        viewContainerApplication.style.display = "none";

                    }
                    inboxContainer.style.display = "none";
                    parentContainerNBFC.style.display = 'none';
                    dashboardSectionsContainer.style.display = "grid";

                    setActiveMenuItem(dashboardMenuItem);
                });


                // Add event listener to Inbox menu item
                inboxMenuItem.addEventListener("click", function() {

                    const viewContainerApplication = document.getElementById("nbfc-student-profile-details");
                    viewContainerApplication.style.display = "none";
                    const nbfcListUsers = document.querySelector(".dashboard-sections-container");
                    dashboardSectionsContainer.style.display = "none";
                    inboxContainer.style.display = "flex";
                    parentContainerNBFC.style.display = 'none';
                    if (nbfcListUsers) {
                        nbfcListUsers.style.display = 'none';
                    }

                    setActiveMenuItem(inboxMenuItem);
                    document.querySelector(".wholeapplicationprofile").style.display = "none";
                });

                const messageButtonNbfc = document.querySelector("#index-student-message-btn-footer");
                const messageMob = document.getElementById("mobmessage-nbfc");

                if (messageButtonNbfc) {
                    messageButtonNbfc.addEventListener("click", function() {
                        const viewContainerApplication = document.getElementById(
                            "nbfc-student-profile-details");
                        viewContainerApplication.style.display = "none";
                        const nbfcListUsers = document.querySelector(".dashboard-sections-container");
                        nbfcListUsers.style.display = "none";
                        inboxContainer.style.display = "flex";
                        parentContainerNBFC.style.display = "none";
                        document.querySelector(".wholeapplicationprofile").style.display = "none";
                        setActiveMenuItem(inboxMenuItem);
                    });
                }

                if (messageMob) {
                    messageMob.addEventListener("click", function() {
                        const viewContainerApplication = document.getElementById(
                            "nbfc-student-profile-details");
                        viewContainerApplication.style.display = "none";
                        const nbfcListUsers = document.querySelector(".dashboard-sections-container");
                        nbfcListUsers.style.display = "none";
                        inboxContainer.style.display = "flex";
                        parentContainerNBFC.style.display = "none";
                        document.querySelector(".wholeapplicationprofile").style.display = "none";
                        setActiveMenuItem(inboxMenuItem);
                    });
                }



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
                    const searchInput = document.querySelector(
                        "#dashboard-nbfc-search-container-section-request .dashboard-nbfc-search-input-sec");
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
                    const searchInput = document.querySelector(
                        "#dashboard-nbfc-search-container-section-proposal .dashboard-nbfc-search-input-sec");
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
                    closeButton.addEventListener("click", function() {
                        modalContainer.style.display = "none"; // Hide the modal
                    });
                }

                if (cancelButton) {
                    cancelButton.addEventListener("click", function() {
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
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    nbfcId
                                }) // Sending the NBFC ID
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

                function resetStudentProfileView() {
                    // Reset image

                    // Reset personal info


                    // ✅ Add this to reset all dynamic container file names
                    const previewContainers = document.querySelectorAll(
                        '.inputfilecontainer, .inputfilecontainer-marksheet, .inputfilecontainer-work-experiencecolumn, .inputfilecontainer-coborrower-kyccolumn, .inputfilecontainer-secured-admission'
                    );

                    previewContainers.forEach(container => {
                        const nameTag = container.querySelector('p');
                        if (nameTag) nameTag.textContent = "No file selected";
                    });

                    // Optional: reset file sizes, too
                    const fileSizes = document.querySelectorAll('.document-status');
                    fileSizes.forEach(size => size.textContent = "");
                }




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


                    let isProfileLoading = false;
                    let isProfileVisible = false;

                    viewButton.addEventListener("click", async () => {
                        if (isProfileLoading || isProfileVisible) return;

                        const wholeContainer = document.querySelector(".wholeapplicationprofile");
                        const requestSendContainer = document.querySelector(
                            ".dashboard-sections-container");

                        Loader.show();
                        isProfileLoading = true;
                        resetStudentProfileView();


                        requestSendContainer.style.display = "none";
                        wholeContainer.style.display = "flex";

                        // Trigger layout reflow before adding class
                        setTimeout(() => {
                            wholeContainer.offsetHeight;
                            wholeContainer.classList.add("layout-ready");
                        }, 50);

                        try {
                            await Promise.all([
                                viewProfileOfUsers(viewButton, studentId, loader),
                                studentApplicationInsideRejection(student),
                                handleSendProposalProcess(studentId)
                            ]);
                            isProfileVisible = true;
                        } catch (err) {
                            console.error("Error loading profile:", err);
                        } finally {
                            Loader.hide();
                            isProfileLoading = false;
                        }
                    });

                    listItem.addEventListener("click", async (e) => {
                        if (window.innerWidth <= 750 && !e.target.closest('.dashboard-action-buttons')) {
                            if (isProfileLoading || isProfileVisible) return;

                            Loader.show();
                            isProfileLoading = true;

                            try {
                                await Promise.all([
                                    viewProfileOfUsers(viewButton, studentId, loader),
                                    studentApplicationInsideRejection(student),
                                    handleSendProposalProcess(studentId)
                                ]);
                                isProfileVisible = true;
                            } catch (err) {
                                console.error("Error loading profile (mobile):", err);
                            } finally {
                                Loader.hide();
                                isProfileLoading = false;
                            }
                        }
                    });


                    const loader = document.createElement('div');
                    loader.classList.add('loader');
                    loader.textContent = 'Loading.....';
                    loader.style.display = 'none';
                    listItem.appendChild(loader);



                    const rejectButton = document.createElement("button");
                    rejectButton.classList.add("dashboard-reject-button");
                    rejectButton.textContent = "Reject";

                    rejectButton.addEventListener("click", async function() {
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
                // const sendButtons = document.querySelectorAll('.nbfc-send-proposal-send-button, .nbfc-send-img');

                // Add event listener to each send button
                // sendButtons.forEach(sendButton => {
                //     sendButton.addEventListener('click', function(e) {
                //         e.preventDefault();
                //         sendMessage();
                //         closeModal(); // If closeModal is a defined function
                //     });
                // });


                const studentApplicationInsideRejection = (student) => {
                    const rejectButtonInside = document.querySelector(".dashboard-inside-reject-button");
                    const rejectMob = document.getElementById("mobreject-nbfc");



                    if (rejectButtonInside) {
                        rejectButtonInside.addEventListener("click", function() {
                            handleRejectionProcess(student);
                        });
                    }
                    if (rejectMob) {
                        rejectMob.addEventListener("click", function() {
                            handleRejectionProcess(student);
                        })
                    }
                };

                const handleSendProposalProcess = (studentId) => {
                    const sendProposalTrigger = document.querySelector(
                        ".myapplication-nbfcapprovalcolumn #sendproposal-trigger");
                    const sendProposalTriggerMob = document.getElementById(
                        "sendproposaltrigger-mob");

                    if (sendProposalTrigger) {
                        const newTrigger = sendProposalTrigger.cloneNode(true);
                        sendProposalTrigger.parentNode.replaceChild(newTrigger, sendProposalTrigger);

                        newTrigger.addEventListener("click", () => {
                            console.log("Clicked");
                            console.log(studentId);
                            openModal(studentId);
                        });
                    }
                    if (sendProposalTriggerMob) {
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

                            const finalCallReject = document.querySelector(
                                ".reject-application-modal-content .actions .reject-button");

                            if (finalCallReject) {
                                const newRejectButton = finalCallReject.cloneNode(true);
                                finalCallReject.replaceWith(newRejectButton);

                                newRejectButton.addEventListener('click', async function() {
                                    var user = @json(session('nbfcuser'));
                                    const nbfcId = user.nbfc_id;
                                    const userId = student.studentId;
                                    const remarks = textArea.value;

                                    if (nbfcId && userId && remarks) {
                                        const data = {
                                            userId,
                                            nbfcId,
                                            remarks
                                        };

                                        try {
                                            const response = await fetch('/del-user-id-request', {
                                                method: "POST",
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector(
                                                            'meta[name="csrf-token"]')
                                                        .getAttribute('content')
                                                },
                                                body: JSON.stringify(data)
                                            });

                                            const result = await response.json();

                                            if (result.success) {
                                                console.log(result);
                                                alert("Remarks submitted for student ID: " +
                                                    userId);
                                                await initializeTraceViewNBFC(requestsData,
                                                    proposalsData);

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
                // const paperclipIcon = document.querySelector(".nbfc-paperclip");

                let isNBFC = true;

                let messagesWrapper = parentContainer ? parentContainer.querySelector(
                    `.messages-wrapper[data-chat-id="${chatId}"]`) : null;


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
                    smileIcon.addEventListener("click", function(e) {
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
                // if (paperclipIcon) {
                //     paperclipIcon.addEventListener("click", function () {
                //         const fileInput = document.createElement("input");
                //         fileInput.type = "file";
                //         fileInput.accept = ".pdf,.doc,.docx,.txt";
                //         fileInput.style.display = "none";

                //         fileInput.onchange = (e) => {
                //             const file = e.target.files[0];
                //             if (file) {
                //                 // Get the file name and size
                //                 const fileName = file.name;
                //                 const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB

                //                 // Create the message container
                //                 const alignmentContainer = document.createElement("div");
                //                 alignmentContainer.style.cssText = `
        //         display: flex;
        //         justify-content: flex-end;
        //         width: 100%;
        //     `;

                //                 const messageContainer = document.createElement("div");
                //                 messageContainer.style.cssText = ` 
        //         width: 665px;
        //         padding: 10px;
        //         border: 1px solid #e2e2e2;
        //         border-radius: 4px;
        //         margin-left: auto;
        //         display: flex;
        //         justify-content: space-between;
        //         align-items: center;
        //     `;

                //                 // Create message content
                //                 const messageText = document.createElement("div");
                //                 messageText.style.cssText = `
        //         font-family: 'Poppins', sans-serif;
        //         font-weight: 500;
        //         font-size: 14px;
        //         color: #909090;
        //         line-height: 1.5;
        //         padding: 4px 5px;
        //         flex: 1;
        //     `;
                //                 messageText.textContent = `${fileName} (${fileSize} MB)`;

                //                 // Create remove icon (using SVG)
                //                 const removeIcon = document.createElement("button");
                //                 removeIcon.style.cssText = `
        //         background: none;
        //         border: none;
        //         cursor: pointer;
        //         font-size: 18px;
        //         padding: 0;
        //         margin-left: 10px;
        //         display: flex;
        //         justify-content: flex-end;
        //     `;
                //                 removeIcon.innerHTML = `
        //         <svg width="16" height="16" fill="black" xmlns="http://www.w3.org/2000/svg">
        //             <path d="M12.146 3.854a.5.5 0 0 0-.708 0L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.146-3.146a.5.5 0 0 0 0-.708z"/>
        //         </svg>
        //     `;
                //                 removeIcon.onclick = () => {
                //                     // Remove the message and reset the file input
                //                     messagesWrapper.removeChild(alignmentContainer);

                //                     // Remove file data from localStorage
                //                     let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                //                     savedFiles = savedFiles.filter(f => f.fileName !== fileName);
                //                     localStorage.setItem('files', JSON.stringify(savedFiles));
                //                 };

                //                 // Append remove icon to the message
                //                 messageContainer.appendChild(messageText);
                //                 messageContainer.appendChild(removeIcon);

                //                 // Assemble the message structure
                //                 alignmentContainer.appendChild(messageContainer);
                //                 messagesWrapper.appendChild(alignmentContainer);

                //                 // Scroll to the bottom of the chat

                //                 // Save file data to localStorage
                //                 let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                //                 savedFiles.push({ fileName, fileSize });
                //                 localStorage.setItem('files', JSON.stringify(savedFiles));
                //             }
                //         };

                //         // Trigger the file input dialog
                //         document.body.appendChild(fileInput);
                //         fileInput.click();
                //         document.body.removeChild(fileInput);
                //     });
                // }

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
                    viewButton.addEventListener("click", function() {
                        messagesWrapper.style.display = "block";
                        inputContainer.style.display = "flex";
                        viewButton.style.display = "none";
                        closeButton.style.display = "inline-block";
                    });

                    closeButton.addEventListener("click", function() {
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
                    viewButtonIndex.addEventListener("click", function() {
                        // Show the message response container
                        messageResponse.style.display = "block";
                    });
                }

                if (closeButtonIndex) {
                    closeButtonIndex.addEventListener("click", function() {
                        messageResponse.style.display = "none";
                    });
                }


            });

            const modalContainer = document.getElementById('modelContainer-send-proposal');
            const closeButtons = document.querySelectorAll('.nbfc-send-proposal-close-button');
            const fileInput = document.getElementById('fileInput');
            const attachmentBtn = document.querySelector('.nbfc-send-proposal-attachment-button');
            const attachmentPreview = document.getElementById('attachmentPreview');
            const removeAttachment = document.getElementById('removeAttachment');
            const fileName = document.querySelector('.nbfc-send-proposal-file-name');
            const fileSize = document.querySelector('.nbfc-send-proposal-file-size');
            const cancelButton = document.querySelector('.nbfc-send-proposal-cancel-button');
            const sendButton = document.querySelector('.nbfc-send-proposal-send-button');




            // Declare this globally
            let selectedFile = null;
            let selectedStudentId = null;

            // Attach file input click trigger once
            attachmentBtn.addEventListener('click', () => {
                fileInput.click();
            });

            // When file is selected
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
                    attachmentPreview.style.display = 'flex';

                    // Hide the attachment button and file input
                    attachmentBtn.style.display = 'none';
                    fileInput.style.display = 'none';
                }
            });
            // Attach send button click once
            const sendProposalTrigger = document.querySelector(".nbfc-send-proposal-send-button");
            if (sendProposalTrigger) {
                const user = @json(session('nbfcuser'));
                const nbfcId = user.nbfc_id;

                sendProposalTrigger.addEventListener('click', () => {
                    const placeHolder = document.querySelector(".nbfc-send-proposal-remarks-textarea");
                    if (selectedFile && selectedStudentId && nbfcId && placeHolder) {
                        sendProposalByNbfc(selectedFile, selectedStudentId, nbfcId, placeHolder);
                    }
                });
            }

            // Open modal function
            function openModal(studentIdElement) {
                const placeHolder = document.querySelector(".nbfc-send-proposal-remarks-textarea");

                if (modalContainer) {
                    modalContainer.style.display = 'flex';

                    if (placeHolder) {
                        placeHolder.value = '';

                        if (studentIdElement && studentIdElement.textContent) {
                            selectedStudentId = studentIdElement.textContent;
                            placeHolder.placeholder = `Remarks ${selectedStudentId}`;
                        }
                    }

                    selectedFile = null;
                    fileName.textContent = '';
                    fileSize.textContent = '';
                    attachmentPreview.style.display = 'none';
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
                                throw new Error(
                                    `${response.status}: ${errorData.message || 'Network response was not ok'}`
                                );
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




            removeAttachment.addEventListener('click', () => {
                // Reset file input
                fileInput.value = '';

                // Reset preview
                fileName.textContent = 'No file selected';
                fileSize.textContent = '';

                // Hide preview
                attachmentPreview.style.display = 'none';

                // Show the button and file input again
                attachmentBtn.style.display = 'flex';
            });
            closeButtons.forEach(button => button.addEventListener('click', closeModal));
            cancelButton.addEventListener('click', closeModal);
            sendButton.addEventListener('click', closeModal);


            document.addEventListener("DOMContentLoaded", function() {
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
                                const fileName = selectedFile.name;
                                const isPDF = fileName.toLowerCase().endsWith('.pdf');

                                if (isPDF) {
                                    // Add PDF icon before filename (you can change the icon source)
                                    fileNameSpan.innerHTML =
                                        `<img src="{{ asset('assets/images/pdf') }}" alt="PDF" style="width:16px;height:16px;margin-right:6px;vertical-align:middle;"> ${fileName}`;
                                } else {
                                    // Fallback for other file types
                                    fileNameSpan.textContent = fileName;
                                }

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
                            fileNameSpan.style.display = "flex";
                            fileNameSpan.style.justifyContent = "flex-start";
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
                    modalContainer.addEventListener("click", function(event) {
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
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                nbfcId
                            }) // Sending the NBFC ID
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
                initAdminChat();
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
                            container.setAttribute("data-name", studentNames[index]
                                .toLowerCase()); // Store lowercase name for sorting
                            messageThreads[index]?.setAttribute("data-name", studentNames[index]
                                .toLowerCase()); // Sync message-thread
                        }
                    });

                    console.log("Student names: ", studentNames);

                    // Sorting logic
                    document.querySelectorAll(".sort-dropdown-nbfc li").forEach((item) => {
                        item.addEventListener("click", function() {
                            let sortType = this.getAttribute("data-sort");
                            let sortedArray = [...studentContainers]; // Copy of student containers

                            if (sortType === "az") {
                                sortedArray.sort((a, b) => a.getAttribute("data-name").localeCompare(b
                                    .getAttribute("data-name")));
                            } else if (sortType === "za") {
                                sortedArray.sort((a, b) => b.getAttribute("data-name").localeCompare(a
                                    .getAttribute("data-name")));
                            } else if (sortType === "newest") {
                                sortedArray.sort((a, b) => studentNames.indexOf(b.querySelector(
                                    ".student-name").textContent) - studentNames.indexOf(a
                                    .querySelector(".student-name").textContent));
                            } else if (sortType === "oldest") {
                                sortedArray.sort((a, b) => studentNames.indexOf(a.querySelector(
                                    ".student-name").textContent) - studentNames.indexOf(b
                                    .querySelector(".student-name").textContent));
                            }


                            // Append sorted items back to the container
                            let parent = document.querySelector(".index-student-details-container");
                            parent.innerHTML = ""; // Clear existing items
                            sortedArray.forEach((item) => {
                                parent.appendChild(item);

                                // Sync message-thread order
                                let studentName = item.getAttribute("data-name");
                                let correspondingThread = [...messageThreads].find(thread =>
                                    thread.getAttribute("data-name") === studentName);
                                if (correspondingThread) parent.appendChild(
                                    correspondingThread);
                            });

                            sortDropdown.classList.remove("visible");

                            sortTrigger.click();
                        });
                    });

                    searchInput.addEventListener("input", function() {
                        const searchText = searchInput.value.toLowerCase().trim();

                        // Filter Student Cards
                        studentCards.forEach(card => {
                            const studentNameElement = card.querySelector(".student-name");
                            if (studentNameElement) {
                                const studentName = studentNameElement.textContent.toLowerCase();
                                card.style.display = studentName.includes(searchText) ? "block" :
                                    "none";
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




            document.getElementById("nbfc-search-input-id").addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const studentCards = document.querySelectorAll(".index-student-message-container");

                studentCards.forEach(card => {
                    const studentName = card.querySelector(".student-name").textContent.toLowerCase();
                    const studentDescription = card.querySelector(".index-student-description").textContent
                        .toLowerCase();

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


            sortTrigger.addEventListener("click", function(event) {
                event.stopPropagation();
                sortDropdown.classList.toggle("visible");
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function(event) {
                if (!sortTrigger.contains(event.target) && !sortDropdown.contains(event.target)) {
                    sortDropdown.classList.remove("visible");
                }
            });






            function initializeChats() {
                const messagesMap = {}; // Tracks studentId => messagesWrapper
                let activeStudentId = null;

                const chatContainers = document.querySelectorAll('.nbfc-individual-bankmessage-input-message');

                chatContainers.forEach((container, index) => {
                    const chatId = `chat-${index}`;
                    container.setAttribute('data-chat-id', chatId);


                    const parentContainer = container.closest('.index-student-message-container');
                    const viewButton = parentContainer?.querySelector('.index-student-view-btn');
                    const messageBtn = parentContainer?.querySelector('.index-student-message-btn');
                    const messageMobBtn = parentContainer?.querySelector('.index-student-send-btn-mobile');
                    const messageUserIdElem = parentContainer?.querySelector('.student-ids');
                    const messageUserId = messageUserIdElem?.textContent.trim();

                    const sendButton = container.querySelector('.nbfc-send-img');
                    const messageInput = container.querySelector('.nbfc-message-input');
                    const smileIcons = container.querySelectorAll('.nbfc-face-smile');
                    const paperclipIcon = container.querySelector('.nbfc-paperclip');

                    // Create and insert chat message wrapper
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
                    messagesMap[messageUserId] = messagesWrapper;

                    // Utility: Scroll the current chat
                    function scrollToBottom(userId) {
                        const wrapper = messagesMap[userId];
                        if (wrapper) wrapper.scrollTop = wrapper.scrollHeight;
                    }

                    // Utility: Show/hide
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

                    // Append message to the correct chat
                    function appendMessageToChat(messageText, userId) {
                        const chatContainer = messagesMap[userId];
                        if (!chatContainer) return;

                        const messageElement = document.createElement("div");
                        messageElement.style.cssText = `
        display: flex;
        justify-content: flex-end;
        width: 100%;
        margin-bottom: 10px;
        padding-top: 10px;
    `;

                        const messageContent = document.createElement("div");
                        messageContent.style.cssText = `
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 8px;
        background-color: #DCF8C6;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
    `;

                        // Check if it's a file link
                        if (messageText.match(/\.(pdf|docx?|txt)$/i)) {
                            const downloadLink = document.createElement('a');
                            downloadLink.href = messageText;
                            downloadLink.target = '_blank';
                            downloadLink.style.cssText = `
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
            text-decoration: none;
        `;
                            const fileName = messageText.split('/').pop();
                            downloadLink.innerHTML = `
            <i class="fa-solid fa-file"></i>
            <span>${fileName}</span>
        `;
                            messageContent.appendChild(downloadLink);
                        } else {
                            messageContent.textContent = messageText;
                        }

                        messageElement.appendChild(messageContent);
                        chatContainer.appendChild(messageElement);
                    }

                    // View existing messages
                    async function viewChat(nbfc_id, studentId) {
                        activeStudentId = studentId;
                        const chatContainer = messagesMap[studentId];
                        if (!chatContainer) return;

                        chatContainer.innerHTML = '';

                        try {
                            const response = await fetch(`/get-messages/${nbfc_id}/${studentId}`);
                            const data = await response.json();

                            if (data.messages?.length) {
                                data.messages.sort((a, b) => a.id - b.id);
                                data.messages.forEach(msg => {
                                    const isNbfcSender = msg.sender_id === nbfc_id;

                                    const wrapper = document.createElement("div");
                                    wrapper.style.cssText = `
                    display: flex;
                    justify-content: ${isNbfcSender ? 'flex-end' : 'flex-start'};
                    width: 100%;
                    margin-bottom: 10px;
                    padding-top: 10px;
                `;

                                    const bubble = document.createElement("div");
                                    bubble.style.cssText = `
                    max-width: 80%;
                    padding: 8px 12px;
                    border-radius: 8px;
                    background-color: ${isNbfcSender ? '#DCF8C6' : '#FFF'};
                    font-family: 'Poppins', sans-serif;
                    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                    word-wrap: break-word;
                `;

                                    // Detect file message by extension
                                    if (msg.message.match(/\.(pdf|docx?|txt)$/i)) {
                                        const downloadLink = document.createElement('a');
                                        downloadLink.href = msg.message;
                                        downloadLink.target = '_blank';
                                        downloadLink.style.cssText = `
                        display: flex;
                        align-items: center;
                        gap: 5px;
                        color: #666;
                        text-decoration: none;
                    `;
                                        const fileName = msg.message.split('/').pop();
                                        downloadLink.innerHTML = `
                        <i class="fa-solid fa-file"></i>
                        <span>${fileName}</span>
                    `;
                                        bubble.appendChild(downloadLink);
                                    } else {
                                        bubble.textContent = msg.message;
                                    }

                                    wrapper.appendChild(bubble);
                                    chatContainer.appendChild(wrapper);
                                });
                            } else {
                                const empty = document.createElement("div");
                                empty.textContent = "No messages yet";
                                empty.style.cssText = `
                text-align: center;
                padding: 20px;
                color: #999;
            `;
                                chatContainer.appendChild(empty);
                            }
                        } catch (error) {
                            console.error('Error fetching messages:', error);
                        }

                        showChat();
                        scrollToBottom(studentId);
                    }


                    // Send message
                    async function sendMessageToBackend(content, userId) {
                        const user = @json(session('nbfcuser'));
                        const nbfc_id = user?.nbfc_id;
                        if (!nbfc_id) return;

                        const payload = {
                            nbfc_id,
                            student_id: userId,
                            sender_id: nbfc_id,
                            receiver_id: userId,
                            message: content,
                            is_read: false
                        };

                        try {
                            const response = await fetch('/send-message', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify(payload)
                            });

                            const data = await response.json();
                            if (response.ok) {
                                appendMessageToChat(content, userId);
                                scrollToBottom(userId);
                            } else {
                                console.error('Send failed:', data.error || 'Unknown error');
                            }
                        } catch (error) {
                            console.error('Send error:', error);
                        }
                    }

                    // Event listeners
                    if (sendButton && messageInput && messageUserId) {
                        sendButton.addEventListener('click', e => {
                            e.preventDefault();
                            const content = messageInput.value.trim();
                            if (content) {
                                messageInput.value = '';
                                sendMessageToBackend(content, messageUserId);
                            }
                        });

                        messageInput.addEventListener('keypress', e => {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                const content = messageInput.value.trim();
                                if (content) {
                                    messageInput.value = '';
                                    sendMessageToBackend(content, messageUserId);
                                }
                            }
                        });
                    }

                    if (viewButton) {
                        viewButton.addEventListener('click', () => {
                            const user = @json(session('nbfcuser'));
                            const nbfc_id = user?.nbfc_id;

                            if (messagesWrapper.style.display === 'none') {
                                viewChat(nbfc_id, messageUserId);
                            } else {
                                hideChat();
                            }
                        });
                    }

                    if (messageBtn || messageMobBtn) {
                        const btn = messageBtn || messageMobBtn;

                        btn.addEventListener('click', () => {
                            const user = @json(session('nbfcuser'));
                            const nbfc_id = user.nbfc_id;
                            viewChat(nbfc_id, messageUserId);
                        });

                        if (messageMobBtn) {
                            messageMobBtn.addEventListener('click', () => {
                                const user = @json(session('nbfcuser'));
                                const nbfc_id = user.nbfc_id;

                                if (messagesWrapper.style.display === 'none' || messagesWrapper.style
                                    .display === '') {
                                    viewChat(nbfc_id, messageUserId);
                                } else {
                                    hideChat();
                                }
                            });
                        }
                    }


                    // Emoji support
                    if (smileIcons) {
                        smileIcons.forEach(smileIcon => {
                            smileIcon.addEventListener('click', function(e) {
                                e.stopPropagation();
                                const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];
                                const existingPicker = container.querySelector(".emoji-picker");
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
                                    const btn = document.createElement("button");
                                    btn.textContent = emoji;
                                    btn.style.cssText = `
                            border: none;
                            background: none;
                            font-size: 20px;
                            cursor: pointer;
                            padding: 5px;
                        `;
                                    btn.onclick = () => {
                                        messageInput.value += emoji;
                                        picker.remove();
                                        messageInput.focus();
                                    };
                                    picker.appendChild(btn);
                                });

                                container.appendChild(picker);

                                document.addEventListener("click", function closePicker(e) {
                                    if (!picker.contains(e.target) && e.target !== smileIcon) {
                                        picker.remove();
                                        document.removeEventListener("click", closePicker);
                                    }
                                });
                            });
                        });
                    }

                    // File attachments
                    if (paperclipIcon) {
                        paperclipIcon.addEventListener("click", function() {
                            const fileInput = document.createElement("input");
                            fileInput.type = "file";
                            fileInput.accept = ".pdf,.doc,.docx,.txt";
                            fileInput.style.display = "none";

                            fileInput.onchange = async (e) => {
                                const file = e.target.files[0];
                                if (file) {
                                    const formData = new FormData();
                                    formData.append('file', file);
                                    formData.append('chatId', chatId);

                                    try {
                                        const response = await fetch('/upload-documents-chat', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').getAttribute(
                                                    'content')
                                            },
                                            body: formData
                                        });

                                        const data = await response.json();
                                        if (data.success && data.fileUrl) {
                                            sendMessageToBackend(data.fileUrl, messageUserId);
                                        } else {
                                            alert("File upload failed.");
                                        }
                                    } catch (err) {
                                        console.error("Upload error:", err);
                                        alert("Upload failed.");
                                    }
                                }
                            };

                            document.body.appendChild(fileInput);
                            fileInput.click();
                            document.body.removeChild(fileInput);
                        });
                    }

                }); // end of forEach
            }


            let loadedChats = new Set();
            async function initAdminChat() {
                const container = document.querySelector('.adminmessage-inboxnbfc');
                if (!container) return;

                const user = @json(session('nbfcuser'));
                const nbfc_id = user?.nbfc_id;
                const admin_id = 'admin001';

                if (document.querySelector('.admin-msg-container')) return;

                const adminMsgContainer = document.createElement('div');
                adminMsgContainer.classList.add('admin-msg-container');
                adminMsgContainer.style.cssText = `
        border-radius: 10px;
        margin: 20px 0;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
    `;

                // Header
                const header = document.createElement('div');
                header.style.cssText = `
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: transparent;
        padding: 12px 16px;
    `;

                const title = document.createElement('div');
                title.innerHTML = `<h3>Admin</h3><br><p>Support & Communication Desk</p>`;
                title.style.cssText = `font-family: "Poppins", sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #5d5c5c;`;

                const btnGroup = document.createElement('div');
                btnGroup.classList.add('admin-btn-group');

                const messageBtn = document.createElement('button');
                messageBtn.textContent = 'Message';
                messageBtn.style.cssText = `
        background-color: #6f25ce;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        transition: background-color 0.3s ease;
        margin-right:3px;
    `;

                const closeBtn = document.createElement('button');
                closeBtn.textContent = 'View';
                closeBtn.style.cssText = `
        background-color: transparent;
        border: 1px solid #6f25ce;
        color: #6f25ce;
        padding: 8px 16px;
        border-radius: 4px;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        width: 80px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left:3px;
    `;

                btnGroup.append(messageBtn, closeBtn);
                header.append(title, btnGroup);

                // Chat wrapper
                const chatWrapper = document.createElement('div');
                chatWrapper.classList.add('admin-chat-wrapper');
                chatWrapper.style.cssText = `
        display: none;
        flex-direction: column;
        padding: 15px;
        max-height: 300px;
        overflow-y: auto;
        background: white;
    `;

                // Input container
                const inputContainer = document.createElement('div');
                inputContainer.style.cssText = `
        display: none;
        align-items: center;
        padding: 10px;
        background: #fafafa;
        border-top: 1px solid #eee;
        position: relative;
    `;

                const input = document.createElement('input');
                input.type = 'text';
                input.placeholder = 'Send message';
                input.classList.add('nbfc-message-input');
                input.style.cssText = `
        flex: 1;
        padding: 8px 12px;
        border-radius: 20px;
        border: 1px solid #ccc;
        margin-right: 10px;
    `;

                const emoji = document.createElement('i');
                emoji.classList.add('fa-regular', 'fa-face-smile');
                emoji.style.cssText = `font-size: 18px; margin-right: 8px; color: #888; cursor: pointer;`;

                const paperclip = document.createElement('i');
                paperclip.classList.add('fa-solid', 'fa-paperclip');
                paperclip.style.cssText = `font-size: 18px; margin-right: 8px; color: #888; cursor: pointer;`;

                const sendIcon = document.createElement('img');
                sendIcon.src = 'assets/images/send-nbfc.png';
                sendIcon.alt = 'send icon';
                sendIcon.style.cssText = `width: 22px; height: 22px; cursor: pointer;`;

                // Emoji Picker
                const emojiPicker = document.createElement('div');
                emojiPicker.style.cssText = `
        position: absolute;
        bottom: 45px;
        left: 10px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        display: none;
        max-width: 200px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        z-index: 1000;
        font-size: 20px;
    `;

                const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];
                emojis.forEach(char => {
                    const span = document.createElement('span');
                    span.textContent = char;
                    span.style.cssText = `cursor: pointer; padding: 5px; display: inline-block;`;
                    span.onclick = () => {
                        input.value += char;
                        emojiPicker.style.display = 'none';
                        input.focus();
                    };
                    emojiPicker.appendChild(span);
                });

                // File Upload
                paperclip.addEventListener("click", () => {
                    const fileInput = document.createElement("input");
                    fileInput.type = "file";
                    fileInput.accept = ".pdf,.doc,.docx,.txt";
                    fileInput.style.display = "none";

                    fileInput.onchange = async (e) => {
                        const file = e.target.files[0];
                        if (!file) return;

                        const formData = new FormData();
                        formData.append('file', file);
                        formData.append('chatId', `${nbfc_id}_${admin_id}`);

                        try {
                            const response = await fetch('/upload-documents-chat', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: formData
                            });
                            const data = await response.json();
                            if (data.success && data.fileUrl) {
                                await sendMessageNbfcAdmin(data.fileUrl, nbfc_id);
                            } else {
                                alert("File upload failed.");
                            }
                        } catch (err) {
                            console.error("Upload error:", err);
                            alert("Upload failed.");
                        }
                    };

                    document.body.appendChild(fileInput);
                    fileInput.click();
                });

                inputContainer.append(input, emoji, paperclip, sendIcon, emojiPicker);

                // Append all
                adminMsgContainer.append(header, chatWrapper, inputContainer);
                container.appendChild(adminMsgContainer);

                // Load Messages
                async function loadMessages() {
                    chatWrapper.innerHTML = '';
                    try {
                        const res = await fetch(`/get-messages-adminnbfc/${nbfc_id}/${admin_id}`);
                        const data = await res.json();

                        if (data.messages?.length) {
                            data.messages.sort((a, b) => a.id - b.id);
                            data.messages.forEach(msg => {
                                const isNbfcSender = msg.sender_id === nbfc_id;
                                const msgWrapper = document.createElement('div');
                                msgWrapper.style.cssText = `
                        display: flex;
                        justify-content: ${isNbfcSender ? 'flex-end' : 'flex-start'};
                        margin-bottom: 10px;
                    `;

                                const msgBubble = document.createElement('div');
                                msgBubble.style.cssText = `
                        max-width: 80%;
                        padding: 8px 12px;
                        border-radius: 8px;
                        background-color: ${isNbfcSender ? '#DCF8C6' : '#F1F0F0'};
                        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                        word-wrap: break-word;
                    `;

                                if (msg.message.match(/\.(pdf|docx?|txt)$/i)) {
                                    const link = document.createElement('a');
                                    link.href = msg.message;
                                    link.target = '_blank';
                                    link.textContent = msg.message.split('/').pop();
                                    link.style.color = '#333';
                                    link.style.textDecoration = 'none';
                                    link.style.color = 'gray';
                                    msgBubble.appendChild(link);
                                } else {
                                    msgBubble.textContent = msg.message;
                                }

                                msgWrapper.appendChild(msgBubble);
                                chatWrapper.appendChild(msgWrapper);
                                input.value = '';

                                chatWrapper.scrollTop = chatWrapper.scrollHeight;

                            });
                        } else {
                            const emptyMsg = document.createElement('div');
                            emptyMsg.textContent = 'No messages yet';
                            emptyMsg.style.cssText = 'text-align: center; padding: 20px; color: #999';
                            chatWrapper.appendChild(emptyMsg);
                        }
                    } catch (err) {
                        console.error("Error fetching admin messages:", err);
                    }
                }

                // Send message
                async function sendMessageNbfcAdmin(content, userId) {
                    const msg = typeof content === 'string' ? content : input.value.trim();
                    if (!msg) return;

                    try {
                        const res = await fetch('/send-message-from-adminnbfc', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id: nbfc_id,
                                admin_id,
                                sender_id: nbfc_id,
                                receiver_id: admin_id,
                                message: msg,
                                is_read: false
                            })
                        });

                        if (res.ok) {
                            input.value = '';

                            const msgWrapper = document.createElement('div');
                            msgWrapper.style.cssText = `
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    `;

                            const msgBubble = document.createElement('div');
                            msgBubble.style.cssText = `
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 8px;
        background-color: #DCF8C6;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
    `;

                            if (msg.match(/\.(pdf|docx?|txt)$/i)) {
                                const link = document.createElement('a');
                                link.href = msg;
                                link.target = '_blank';
                                link.textContent = msg.split('/').pop();
                                link.style.color = 'gray';
                                link.style.textDecoration = 'none';
                                msgBubble.appendChild(link);
                            } else {
                                msgBubble.textContent = msg;
                            }

                            msgWrapper.appendChild(msgBubble);
                            chatWrapper.appendChild(msgWrapper);

                            chatWrapper.scrollTop = chatWrapper.scrollHeight;
                        }

                    } catch (e) {
                        console.error("Message send failed:", e);
                    }
                }

                sendIcon.addEventListener('click', () => sendMessageNbfcAdmin());
                input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        sendMessageNbfcAdmin();
                    }
                });

                let isChatOpen = false;


                messageBtn.addEventListener('click', async () => {
                    if (!isChatOpen) {
                        chatWrapper.style.display = 'flex';
                        inputContainer.style.display = 'flex';
                        closeBtn.textContent = 'Close';
                        isChatOpen = true;
                        await loadMessages();
                    }
                });

                closeBtn.addEventListener('click', () => {
                    if (isChatOpen) {
                        chatWrapper.style.display = 'none';
                        inputContainer.style.display = 'none';
                        closeBtn.textContent = 'View';
                        emojiPicker.style.display = 'none';
                        isChatOpen = false;
                    }
                });

                emoji.addEventListener('click', (e) => {
                    e.stopPropagation();
                    emojiPicker.style.display = emojiPicker.style.display === 'none' ? 'block' : 'none';
                });

                document.addEventListener('click', (e) => {
                    if (!inputContainer.contains(e.target)) {
                        emojiPicker.style.display = 'none';
                    }
                });
            }






            // Initialize when DOM is loaded
            document.addEventListener('DOMContentLoaded', initializeChats);
            const passwordModelTriggerNbfc = () => {
                const passwordTrigger = document.getElementById("change-password-trigger-nbfc");
                const passwordChangeContainer = document.querySelector(".password-change-container-nbfc");
                const passwordContainerExit = document.querySelector(
                    ".password-change-triggered-view-headersection-nbfc img");
                const popupPasswordShow = document.querySelector(".popup-notify-list-nbfc");
                const arrowUp = document.querySelector(".nbfc-profile .nbfc-dropdown-icon");
                const overlay = document.querySelector(".overlay-password-change-nbfc");

                if (passwordTrigger) {
                    passwordTrigger.addEventListener("click", () => {
                        if (passwordChangeContainer && overlay) {
                            passwordChangeContainer.style.display = "flex";
                            overlay.style.display = "block";
                            document.body.style.overflow = "hidden"; // Prevent background scrolling
                            if (popupPasswordShow) {
                                popupPasswordShow.style.display = "none";
                            }
                            if (arrowUp) {
                                arrowUp.style.transform = "rotate(0deg)";
                            }
                        }
                    });
                }

                if (passwordContainerExit) {
                    passwordContainerExit.addEventListener("click", () => {
                        if (passwordChangeContainer && overlay) {
                            passwordChangeContainer.style.display = "none";
                            overlay.style.display = "none";
                            document.body.style.overflow = "auto"; // Restore scrolling
                        }
                    });
                }

                // Close modal when clicking the overlay
                if (overlay) {
                    overlay.addEventListener("click", () => {
                        if (passwordChangeContainer && overlay) {
                            passwordChangeContainer.style.display = "none";
                            overlay.style.display = "none";
                            document.body.style.overflow = "auto"; // Restore scrolling
                        }
                    });
                }
            };
            const userPopopuOpenNbfc = () => {
                const userPopupTrigger = document.querySelector(".nbfc-profile");
                const userPopupList = document.querySelector(".popup-notify-list-nbfc");

                if (userPopupTrigger && userPopupList) {
                    // Toggle dropdown on nbfc-profile click
                    userPopupTrigger.addEventListener('click', (event) => {
                        event.stopPropagation(); // Prevent click from bubbling to document
                        if (userPopupList.style.display === "none" || userPopupList.style.display === "") {
                            userPopupTrigger.querySelector(".nbfc-dropdown-icon").style.transform =
                                'rotate(180deg)';
                            userPopupList.style.display = "flex";
                        } else {
                            userPopupTrigger.querySelector(".nbfc-dropdown-icon").style.transform = 'rotate(0deg)';
                            userPopupList.style.display = "none";
                        }
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', (event) => {
                        const isClickInsideTrigger = userPopupTrigger.contains(event.target);
                        const isClickInsidePopup = userPopupList.contains(event.target);

                        if (!isClickInsideTrigger && !isClickInsidePopup && userPopupList.style.display ===
                            "flex") {
                            userPopupTrigger.querySelector(".nbfc-dropdown-icon").style.transform = 'rotate(0deg)';
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
                document.getElementById('password-change-save-nbfc').addEventListener('click', function() {
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
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                    'content') || ""
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
                // resetAllUserState();
                const userId = studentId.textContent;
                console.log("Fetching profile for user:", userId);
                const inboxContainer = document.getElementById("index-section-id-nbfc");
                inboxContainer.style.display = "none";

                // Show loader and disable further interactions
                loaderElement.style.display = 'block'; // Show loader
                viewButton.disabled = true; // Disable the button to prevent multiple click

                try {
                    // Wait for each function to complete
                    await retreiveUserDetails(userId);
                    await initialiseAllViews(userId);
                    await initialiseProfileView(userId);
                    await downloadDocuments(userId);
                    


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
                    const eyeIcon = card.querySelector(".fa-eye");
                    if (!eyeIcon) {
                        console.error("Eye icon not found in card:", card);
                        return;
                    }

                    eyeIcon.addEventListener("click", function(event) {
                        event.stopPropagation();

                        let fileTypeKey = null;
                        if (card.querySelector(".coborrower-pancard")) {
                            fileTypeKey = "co-pan-card-name";
                        } else if (card.querySelector(".coborrower-aadharcard")) {
                            fileTypeKey = "co-aadhar-card-name";
                        } else if (card.querySelector(".coborrower-addressproof")) {
                            fileTypeKey = "co-addressproof";
                        }

                        const fileUrl = documentUrls[fileTypeKey];
                        const fileNameElement = card.querySelector(
                            `.${fileTypeKey?.replace("-name", "-grade")}`);
                        const rawFileName = fileNameElement ? fileNameElement.textContent.trim() :
                            "Document";
                        const fileName = typeof truncateFileName === "function" ? truncateFileName(
                            rawFileName) : rawFileName;

                        const closePreview = () => {
                            document.querySelector(".pdf-preview-wrapper")?.remove();
                            document.querySelector(".image-preview-wrapper")?.remove();
                            document.querySelector(".pdf-preview-overlay")?.remove();
                            document.querySelector(".image-preview-overlay")?.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            document.removeEventListener("keydown", keydownHandler);
                        };

                        const keydownHandler = (e) => {
                            if (e.key === "Escape") closePreview();
                        };

                        if (eyeIcon.classList.contains("preview-active")) {
                            closePreview();
                            return;
                        }

                        if (!fileUrl) {
                            alert("No document found to preview.");
                            return;
                        }

                        const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
                        const isImage = [".jpg", ".jpeg", ".png"].some(ext => fileUrl.toLowerCase()
                            .endsWith(ext));

                        const overlay = document.createElement("div");
                        overlay.className = isPDF ? "pdf-preview-overlay" : "image-preview-overlay";
                        overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            `;

                        const previewWrapper = document.createElement("div");
                        previewWrapper.className = isPDF ? "pdf-preview-wrapper" : "image-preview-wrapper";
                        previewWrapper.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: ${isPDF ? "60%" : "90%"};
                max-width: 800px;
                height: ${isPDF ? "80vh" : "auto"};
                max-height: 90vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
                border-radius: 8px;
                overflow: hidden;
            `;

                        const header = document.createElement("div");
                        header.style.cssText = `
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 16px;
                background-color: #1a1a1a;
                color: white;
                height: 40px;
                font-family: 'Poppins', sans-serif;
            `;

                        const fileNameSpan = document.createElement("span");
                        fileNameSpan.textContent = fileName;
                        fileNameSpan.style.cssText = `
                font-size: 14px;
                color: white;
            `;

                        const closeButton = document.createElement("button");
                        closeButton.innerHTML = "✕";
                        closeButton.style.cssText = `
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
            `;

                        closeButton.addEventListener("click", closePreview);
                        overlay.addEventListener("click", closePreview);
                        header.appendChild(fileNameSpan);

                        if (isPDF) {
                            const zoomControls = document.createElement("div");
                            zoomControls.style.cssText = `
                    display: flex;
                    gap: 12px;
                    align-items: center;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                            const zoomOut = document.createElement("button");
                            const zoomIn = document.createElement("button");
                            zoomOut.textContent = "−";
                            zoomIn.textContent = "+";

                            [zoomOut, zoomIn].forEach(btn => {
                                btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        padding: 2px 8px;
                        cursor: pointer;
                        font-family: 'Poppins', sans-serif;
                    `;
                                zoomControls.appendChild(btn);
                            });

                            header.insertBefore(zoomControls, closeButton);
                        }

                        header.appendChild(closeButton);
                        previewWrapper.appendChild(header);

                        if (isPDF) {
                            const iframe = document.createElement("iframe");
                            iframe.src = fileUrl;
                            iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                `;

                            previewWrapper.appendChild(iframe);

                            let currentZoom = 1;
                            header.querySelectorAll("button")[1]?.addEventListener("click", () => {
                                currentZoom += 0.1;
                                iframe.style.transform = `scale(${currentZoom})`;
                                iframe.style.transformOrigin = "top center";
                            });

                            header.querySelectorAll("button")[0]?.addEventListener("click", () => {
                                currentZoom = Math.max(currentZoom - 0.1, 0.5);
                                iframe.style.transform = `scale(${currentZoom})`;
                                iframe.style.transformOrigin = "top center";
                            });

                        } else if (isImage) {
                            const imgContainer = document.createElement("div");
                            imgContainer.style.cssText = `
                    padding: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #f0f0f0;
                `;

                            const img = document.createElement("img");
                            img.src = fileUrl;
                            img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;

                            imgContainer.appendChild(img);
                            previewWrapper.appendChild(imgContainer);
                        } else {
                            alert(
                                "Unsupported file type. Only PDFs and images (JPG, PNG, JPEG) are supported."
                            );
                            return;
                        }

                        document.body.appendChild(overlay);
                        document.body.appendChild(previewWrapper);
                        document.addEventListener("keydown", keydownHandler);

                        eyeIcon.classList.add("preview-active");
                        eyeIcon.src = "/assets/images/close.png";
                    });
                });
            };
            const initializeKycDocumentUpload = () => {
                const individualKycDocumentsUpload = document.querySelectorAll(".individualkycdocuments");

                individualKycDocumentsUpload.forEach((card) => {
                    const eyeIcon = card.querySelector(".fa-eye");


                    if (!eyeIcon) {
                        console.error("Eye icon not found in card:", card);
                        return;
                    }

                    eyeIcon.addEventListener("click", function(event) {
                        event.stopPropagation();

                        const documentType = eyeIcon.id.replace("view-", "").replace("-card", "");
                        const fileTypeKey = `${documentType}-card-name`;
                        const fileUrl = documentUrls[fileTypeKey];

                        // ✅ Stop here if no document
                        if (!fileUrl) {
                            alert("No document found to preview.");
                            return;
                        }


                        const fileNameElement = card.querySelector(`.uploaded-${documentType}-name`);
                        const rawFileName = fileNameElement ? fileNameElement.textContent.trim() :
                            "Document.pdf";
                        const fileName = rawFileName.length > 40 ? rawFileName.slice(0, 37) + "..." :
                            rawFileName;

                        if (eyeIcon.classList.contains("preview-active")) {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper");
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay");
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            return;
                        }

                        if (!fileUrl) {
                            alert("No document found to preview.");
                            return;
                        }

                        const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
                        const isImage = [".jpg", ".jpeg", ".png"].some((ext) => fileUrl.toLowerCase()
                            .endsWith(ext));

                        const closePreview = () => {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper");
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay");
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            document.removeEventListener("keydown", keydownHandler);
                        };

                        const keydownHandler = (e) => {
                            if (e.key === "Escape") {
                                closePreview();
                            }
                        };

                        if (isPDF) {
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "pdf-preview-wrapper";
                            previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 60%;
                    height: 80vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                            const overlay = document.createElement("div");
                            overlay.className = "pdf-preview-overlay";
                            overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                            const header = document.createElement("div");
                            header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                    position: relative;
                `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `display: flex; align-items: center; gap: 8px;`;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                            fileNameSection.appendChild(fileNameSpan);

                            const zoomControls = document.createElement("div");
                            zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                            const zoomOut = document.createElement("button");
                            zoomOut.innerHTML = "−";
                            const zoomIn = document.createElement("button");
                            zoomIn.innerHTML = "+";

                            [zoomOut, zoomIn].forEach((btn) => {
                                btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        cursor: pointer;
                        padding: 2px 8px;
                        font-family: 'Poppins', sans-serif;
                    `;
                            });

                            zoomControls.appendChild(zoomOut);
                            zoomControls.appendChild(zoomIn);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
                            closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    font-family: 'Poppins', sans-serif;
                `;

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(zoomControls);
                            header.appendChild(closeButton);

                            const iframe = document.createElement("iframe");
                            iframe.src = fileUrl;
                            iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                    transform-origin: top center;
                `;

                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(iframe);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            let currentZoom = 1;
                            zoomIn.addEventListener("click", () => {
                                currentZoom += 0.1;
                                iframe.style.transform = `scale(${currentZoom})`;
                            });

                            zoomOut.addEventListener("click", () => {
                                currentZoom = Math.max(currentZoom - 0.1, 0.5);
                                iframe.style.transform = `scale(${currentZoom})`;
                            });

                            document.addEventListener("keydown", keydownHandler);
                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else if (isImage) {
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "image-preview-wrapper";
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
                    border-radius: 8px;
                `;

                            const overlay = document.createElement("div");
                            overlay.className = "image-preview-overlay";
                            overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                            const header = document.createElement("div");
                            header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `display: flex; align-items: center; gap: 8px;`;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                            fileNameSection.appendChild(fileNameSpan);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
                            closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    font-family: 'Poppins', sans-serif;
                `;

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(closeButton);

                            const imageContainer = document.createElement("div");
                            imageContainer.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: auto;
                    padding: 20px;
                    background-color: #f0f0f0;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                            const image = document.createElement("img");
                            image.src = fileUrl;
                            image.style.maxWidth = "100%";
                            image.style.maxHeight = "100%";
                            image.style.borderRadius = "4px";

                            imageContainer.appendChild(image);
                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(imageContainer);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            document.addEventListener("keydown", keydownHandler);
                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else {
                            alert("Unsupported file type.");
                        }
                    });
                });
            };




            const initializeMarksheetUpload = () => {
                const individualMarksheetDocumentsUpload = document.querySelectorAll(".individualmarksheetdocuments");

                individualMarksheetDocumentsUpload.forEach((card) => {
                    const eyeIcon = card.querySelector(".fa-eye");

                    if (!eyeIcon) {
                        console.error("Eye icon not found in card:", card);
                        return;
                    }

                    eyeIcon.addEventListener("click", function(event) {
                        event.stopPropagation();

                        // Determine document type
                        let fileTypeKey;
                        if (card.querySelector(".sslc-marksheet")) {
                            fileTypeKey = "tenth-grade-name";
                        } else if (card.querySelector(".hsc-marksheet")) {
                            fileTypeKey = "twelfth-grade-name";
                        } else if (card.querySelector(".graduation-marksheet")) {
                            fileTypeKey = "graduation-grade-name";
                        }

                        const fileUrl = documentUrls[fileTypeKey];
                        const fileNameElement = card.querySelector(
                            `.${fileTypeKey.replace("-name", "-grade")}`);
                        const rawFileName = fileNameElement ? fileNameElement.textContent.trim() :
                            "Document.pdf";
                        const fileName = truncateFileName(rawFileName);

                        console.log(`Previewing marksheet (${fileTypeKey}):`, fileUrl);

                        if (eyeIcon.classList.contains("preview-active")) {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper");
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay");
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            return;
                        }

                        if (!fileUrl) {
                            alert("No document found to preview.");
                            return;
                        }

                        const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
                        const isImage = [".jpg", ".jpeg", ".png"].some((ext) => fileUrl.toLowerCase()
                            .endsWith(ext));

                        const closePreview = () => {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper");
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay");
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            document.removeEventListener("keydown", keydownHandler);
                        };

                        const keydownHandler = (e) => {
                            if (e.key === "Escape") {
                                closePreview();
                            }
                        };

                        if (isPDF) {
                            // PDF PREVIEW
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "pdf-preview-wrapper";
                            previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 60%;
                    height: 80vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                            const overlay = document.createElement("div");
                            overlay.className = "pdf-preview-overlay";
                            overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                            const header = document.createElement("div");
                            header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                    position: relative;
                `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `display: flex; align-items: center; gap: 8px;`;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                            fileNameSection.appendChild(fileNameSpan);

                            const zoomControls = document.createElement("div");
                            zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                            const zoomOut = document.createElement("button");
                            zoomOut.innerHTML = "−";
                            const zoomIn = document.createElement("button");
                            zoomIn.innerHTML = "+";

                            [zoomOut, zoomIn].forEach((btn) => {
                                btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        cursor: pointer;
                        padding: 2px 8px;
                        font-family: 'Poppins', sans-serif;
                    `;
                            });

                            zoomControls.appendChild(zoomOut);
                            zoomControls.appendChild(zoomIn);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
                            closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    font-family: 'Poppins', sans-serif;
                `;

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(zoomControls);
                            header.appendChild(closeButton);

                            const iframe = document.createElement("iframe");
                            iframe.src = fileUrl;
                            iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                    transform-origin: top center;
                `;

                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(iframe);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            let currentZoom = 1;
                            zoomIn.addEventListener("click", () => {
                                currentZoom += 0.1;
                                iframe.style.transform = `scale(${currentZoom})`;
                            });

                            zoomOut.addEventListener("click", () => {
                                currentZoom = Math.max(currentZoom - 0.1, 0.5);
                                iframe.style.transform = `scale(${currentZoom})`;
                            });

                            document.addEventListener("keydown", keydownHandler);
                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else if (isImage) {
                            // IMAGE PREVIEW
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "image-preview-wrapper";
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
                    border-radius: 8px;
                `;

                            const overlay = document.createElement("div");
                            overlay.className = "image-preview-overlay";
                            overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                            const header = document.createElement("div");
                            header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `display: flex; align-items: center; gap: 8px;`;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                            fileNameSection.appendChild(fileNameSpan);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
                            closeButton.style.cssText = `
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    padding: 4px;
                    font-family: 'Poppins', sans-serif;
                `;

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(closeButton);

                            const imageContainer = document.createElement("div");
                            imageContainer.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: auto;
                    padding: 20px;
                    background-color: #f0f0f0;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                            const image = document.createElement("img");
                            image.src = fileUrl;
                            image.style.maxWidth = "100%";
                            image.style.maxHeight = "100%";
                            image.style.borderRadius = "4px";

                            imageContainer.appendChild(image);
                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(imageContainer);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            document.addEventListener("keydown", keydownHandler);
                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else {
                            alert("Unsupported file type.");
                        }
                    });
                });
            };


            const initializeSecuredAdmissionDocumentUpload = () => {
                const securedAdmissionDocuments = document.querySelectorAll(
                    ".individual-secured-admission-documents"
                );

                securedAdmissionDocuments.forEach((card) => {
                    const eyeIcon = card.querySelector(".fa-eye");

                    if (!eyeIcon) {
                        console.error("Eye icon not found in card:", card);
                        return;
                    }

                    eyeIcon.addEventListener("click", function(event) {
                        event.stopPropagation();

                        // Determine document type based on which element exists
                        let fileTypeKey;
                        if (card.querySelector(".sslc-grade")) {
                            fileTypeKey = "secured-tenth-name";
                        } else if (card.querySelector(".hsc-grade")) {
                            fileTypeKey = "secured-twelfth-name";
                        } else if (card.querySelector(".graduation-grade")) {
                            fileTypeKey = "secured-graduation-name";
                        }

                        const fileUrl = documentUrls[fileTypeKey];
                        const fileNameElement = card.querySelector(
                            `.${fileTypeKey.replace("-name", "-grade")}`
                        );
                        const rawFileName = fileNameElement ?
                            fileNameElement.textContent.trim() :
                            "Document.pdf";

                        // Use truncated file name in UI
                        const fileName = truncateFileName(rawFileName);

                        console.log(`Previewing secured admission (${fileTypeKey}):`, fileUrl);

                        if (eyeIcon.classList.contains("preview-active")) {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper"
                            );
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay"
                            );
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            return;
                        }

                        if (!fileUrl) {
                            alert("No document found to preview.");
                            return;
                        }

                        const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
                        const isImage = [".jpg", ".jpeg", ".png"].some((ext) =>
                            fileUrl.toLowerCase().endsWith(ext)
                        );

                        // Close preview helper
                        const closePreview = () => {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper"
                            );
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay"
                            );
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            document.removeEventListener("keydown", keydownHandler);
                        };

                        // Keyboard handler
                        const keydownHandler = (e) => {
                            if (e.key === "Escape") {
                                closePreview();
                            }
                        };

                        if (isPDF) {
                            // PDF Preview
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "pdf-preview-wrapper";
                            previewWrapper.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            height: 80vh;
            background-color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            border-radius: 8px;
            `;

                            const overlay = document.createElement("div");
                            overlay.className = "pdf-preview-overlay";
                            overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            `;

                            const header = document.createElement("div");
                            header.style.cssText = `
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 16px;
            background-color: #1a1a1a;
            color: white;
            height: 40px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            position: relative;
            `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `
            display: flex;
            align-items: center;
            gap: 8px;
            `;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
            color: white;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            `;
                            fileNameSection.appendChild(fileNameSpan);

                            // Zoom controls container
                            const zoomControls = document.createElement("div");
                            zoomControls.style.cssText = `
            display: flex;
            align-items: center;
            gap: 12px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 50%;
            translateY(-50%);
            `;

                            const zoomOut = document.createElement("button");
                            zoomOut.innerHTML = "−";
                            const zoomIn = document.createElement("button");
                            zoomIn.innerHTML = "+";

                            [zoomOut, zoomIn].forEach((btn) => {
                                btn.style.cssText = `
                background: none;
                border: 1px solid #fff;
                border-radius: 4px;
                color: white;
                font-size: 16px;
                cursor: pointer;
                padding: 2px 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Poppins', sans-serif;
            `;
                            });

                            zoomControls.appendChild(zoomOut);
                            zoomControls.appendChild(zoomIn);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
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
            font-family: 'Poppins', sans-serif;
            `;

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(zoomControls);
                            header.appendChild(closeButton);

                            const iframe = document.createElement("iframe");
                            iframe.src = fileUrl;
                            iframe.style.cssText = `
            width: 100%;
            height: calc(100% - 40px);
            border: none;
            background-color: white;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            transform-origin: top center;
            `;

                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(iframe);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            let currentZoom = 1;
                            zoomIn.addEventListener("click", () => {
                                currentZoom += 0.1;
                                iframe.style.transform = `scale(${currentZoom})`;
                            });

                            zoomOut.addEventListener("click", () => {
                                currentZoom = Math.max(currentZoom - 0.1, 0.5);
                                iframe.style.transform = `scale(${currentZoom})`;
                            });

                            document.addEventListener("keydown", keydownHandler);

                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else if (isImage) {
                            // Image Preview
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "image-preview-wrapper";
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
            border-radius: 8px;
            `;

                            const overlay = document.createElement("div");
                            overlay.className = "image-preview-overlay";
                            overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            `;

                            const header = document.createElement("div");
                            header.style.cssText = `
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 16px;
            background-color: #1a1a1a;
            color: white;
            height: 40px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `
            display: flex;
            align-items: center;
            gap: 8px;
            `;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
            color: white;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            `;
                            fileNameSection.appendChild(fileNameSpan);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
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
            font-family: 'Poppins', sans-serif;
            `;

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(closeButton);

                            const imageContainer = document.createElement("div");
                            imageContainer.style.cssText = `
            width: 100%;
            height: calc(100% - 40px);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
            padding: 20px;
            background-color: #f0f0f0;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            `;

                            const img = document.createElement("img");
                            img.src = fileUrl;
                            img.style.cssText = `
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            `;

                            imageContainer.appendChild(img);
                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(imageContainer);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            document.addEventListener("keydown", keydownHandler);

                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else {
                            alert(
                                "Unsupported file type. Only PDF and images (JPG, PNG, JPEG) are supported."
                            );
                        }
                    });
                });
            };

            // Truncates long file names for display
            function truncateFileName(fileName) {
                if (fileName.length <= 20) return fileName;

                const extension = fileName.slice(fileName.lastIndexOf("."));
                const name = fileName.slice(0, fileName.lastIndexOf("."));

                const truncatedName = name.length > 15 ? name.slice(0, 15) + "..." : name;
                return truncatedName + extension;
            }


            // Run on page load or after DOM is ready



            const initialiseEightcolumn = () => {
                const section = document.querySelector('.eightcolumn-firstsection');

                section.addEventListener('click', function(event) {
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

                section.addEventListener('click', function() {
                    if (section.style.height === '') {
                        section.style.height = 'fit-content';
                    } else {
                        section.style.height = '';
                    }
                });

            }
            const initialiseSeventhAdditionalColumn = () => {
                const section = document.querySelector('.seventhcolumn-additional-firstcolumn');

                section.addEventListener('click', function() {
                    if (section.style.height === '') {
                        section.style.height = 'fit-content';
                    } else {
                        section.style.height = '';
                    }
                });

            }
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
            const initialiseTenthcolumn = () => {
                const section = document.querySelector(".tenthcolumn-firstsection");
                section.addEventListener('click', function() {
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
                const workExperienceDocuments = document.querySelectorAll(
                    ".individual-work-experiencecolumn-documents"
                );

                workExperienceDocuments.forEach((card) => {
                    const eyeIcon = card.querySelector(".fa-eye");

                    if (!eyeIcon) {
                        console.error("Eye icon not found in card:", card);
                        return;
                    }

                    eyeIcon.addEventListener("click", function(event) {
                        event.stopPropagation();

                        // Determine document type based on which element exists
                        let fileTypeKey;
                        if (card.querySelector(".experience-letter")) {
                            fileTypeKey = "work-experience-experience-letter";
                        } else if (card.querySelector(".salary-slip")) {
                            fileTypeKey = "work-experience-monthly-slip";
                        } else if (card.querySelector(".office-id")) {
                            fileTypeKey = "work-experience-office-id";
                        } else if (card.querySelector(".joining-letter")) {
                            fileTypeKey = "work-experience-joining-letter";
                        }

                        // Get the URL from documentUrls
                        const fileUrl = documentUrls[fileTypeKey];
                        const fileNameElement = card.querySelector(
                            `.${fileTypeKey.split("-").slice(2).join("-")}`
                        );
                        const fileName = fileNameElement ?
                            fileNameElement.textContent :
                            "Document.pdf";

                        console.log(
                            `Previewing work experience (${fileTypeKey}):`,
                            fileUrl
                        );

                        if (eyeIcon.classList.contains("preview-active")) {
                            const previewWrapper = document.querySelector(
                                ".pdf-preview-wrapper, .image-preview-wrapper"
                            );
                            const overlay = document.querySelector(
                                ".pdf-preview-overlay, .image-preview-overlay"
                            );
                            if (previewWrapper) previewWrapper.remove();
                            if (overlay) overlay.remove();
                            eyeIcon.classList.remove("preview-active");
                            eyeIcon.src = "/assets/images/visibility.png";
                            return;
                        }

                        if (!fileUrl) {
                            alert("No document found to preview.");
                            return;
                        }

                        // Check if it's a PDF or image based on file extension
                        const isPDF = fileUrl.toLowerCase().endsWith(".pdf");
                        const isImage = [".jpg", ".jpeg", ".png"].some((ext) =>
                            fileUrl.toLowerCase().endsWith(ext)
                        );

                        if (isPDF) {
                            // PDF Preview
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "pdf-preview-wrapper";
                            previewWrapper.style.cssText = `
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 60%;
                    height: 80vh;
                    background-color: white;
                    display: flex;
                    flex-direction: column;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    border-radius: 8px;
                `;

                            const overlay = document.createElement("div");
                            overlay.className = "pdf-preview-overlay";
                            overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                            const header = document.createElement("div");
                            header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                            fileNameSection.appendChild(fileNameSpan);

                            const zoomControls = document.createElement("div");
                            zoomControls.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                `;

                            const zoomOut = document.createElement("button");
                            zoomOut.innerHTML = "−";
                            const zoomIn = document.createElement("button");
                            zoomIn.innerHTML = "+";

                            [zoomOut, zoomIn].forEach((btn) => {
                                btn.style.cssText = `
                        background: none;
                        border: 1px solid #fff;
                        border-radius: 4px;
                        color: white;
                        font-size: 16px;
                        cursor: pointer;
                        padding: 2px 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-family: 'Poppins', sans-serif;
                    `;
                            });

                            zoomControls.appendChild(zoomOut);
                            zoomControls.appendChild(zoomIn);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
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
                    font-family: 'Poppins', sans-serif;
                `;

                            const closePreview = () => {
                                previewWrapper.remove();
                                overlay.remove();
                                eyeIcon.classList.remove("preview-active");
                                eyeIcon.src = "/assets/images/visibility.png";
                            };

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(zoomControls);
                            header.appendChild(closeButton);

                            const iframe = document.createElement("iframe");
                            iframe.src = fileUrl;
                            iframe.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    border: none;
                    background-color: white;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(iframe);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            let currentZoom = 1;
                            zoomIn.addEventListener("click", () => {
                                currentZoom += 0.1;
                                iframe.style.transform = `scale(${currentZoom})`;
                                iframe.style.transformOrigin = "top center";
                            });

                            zoomOut.addEventListener("click", () => {
                                currentZoom = Math.max(currentZoom - 0.1, 0.5);
                                iframe.style.transform = `scale(${currentZoom})`;
                                iframe.style.transformOrigin = "top center";
                            });

                            document.addEventListener("keydown", function(e) {
                                if (e.key === "Escape") {
                                    closePreview();
                                }
                            });

                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else if (isImage) {
                            // Image Preview
                            const previewWrapper = document.createElement("div");
                            previewWrapper.className = "image-preview-wrapper";
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
                    border-radius: 8px;
                `;

                            const overlay = document.createElement("div");
                            overlay.className = "image-preview-overlay";
                            overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                `;

                            const header = document.createElement("div");
                            header.style.cssText = `
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 8px 16px;
                    background-color: #1a1a1a;
                    color: white;
                    height: 40px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                `;

                            const fileNameSection = document.createElement("div");
                            fileNameSection.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;

                            const fileNameSpan = document.createElement("span");
                            fileNameSpan.textContent = fileName;
                            fileNameSpan.style.cssText = `
                    color: white;
                    font-size: 14px;
                    font-family: 'Poppins', sans-serif;
                `;
                            fileNameSection.appendChild(fileNameSpan);

                            const closeButton = document.createElement("button");
                            closeButton.innerHTML = "✕";
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
                    font-family: 'Poppins', sans-serif;
                `;

                            const closePreview = () => {
                                previewWrapper.remove();
                                overlay.remove();
                                eyeIcon.classList.remove("preview-active");
                                eyeIcon.src = "/assets/images/visibility.png";
                            };

                            closeButton.addEventListener("click", closePreview);
                            overlay.addEventListener("click", closePreview);

                            header.appendChild(fileNameSection);
                            header.appendChild(closeButton);

                            const imageContainer = document.createElement("div");
                            imageContainer.style.cssText = `
                    width: 100%;
                    height: calc(100% - 40px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: auto;
                    padding: 20px;
                    background-color: #f0f0f0;
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                `;

                            const img = document.createElement("img");
                            img.src = fileUrl;
                            img.style.cssText = `
                    max-width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                `;

                            imageContainer.appendChild(img);
                            previewWrapper.appendChild(header);
                            previewWrapper.appendChild(imageContainer);

                            document.body.appendChild(overlay);
                            document.body.appendChild(previewWrapper);

                            document.addEventListener("keydown", function(e) {
                                if (e.key === "Escape") {
                                    closePreview();
                                }
                            });

                            eyeIcon.classList.add("preview-active");
                            eyeIcon.src = "/assets/images/close.png";
                        } else {
                            alert(
                                "Unsupported file type. Only PDF and images (JPG, PNG, JPEG) are supported."
                            );
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            userId: userId
                        })
                    });

                    const data = await response.json();

                    // Cache the user data
                    userDataCache[userId] = data;
                    viewContainerApplication.style.display = "flex"

                    await updateProfileView(profileViewContainerNbfc, profileContainerSection, data);


                    nbfcListUsers.style.display = "none";
                    parentContainerNBFC.style.display = "flex";
                } catch (error) {
                    console.error('Error fetching user details:', error);
                }
            };
            const updateProfileView = (container, usersListcontainer, data) => {

                const courseInput = container.querySelector("#plan-to-study-edit");
                const courseDuration = container.querySelector(".myapplication-fourthcolumn-additional input");
                const loanAmount = container.querySelector(".myapplication-fourthcolumn input");
                const scReferral = container.querySelector(".myapplication-fifthcolumn input");


                const degreeRadioBachelors = container.querySelector('input[name="education-level"][value="Bachelors"]');
                const degreeRadioMasters = container.querySelector('input[name="education-level"][value="Masters"]');
                const degreeRadioOthers = container.querySelector('input[name="education-level"][value="Others"]');

                const bachelorsLabel = container.querySelector("#bachelors-label");
                const mastersLabel = container.querySelector("#masters-label");
                const othersLabel = container.querySelector("#others-label");
                const otherDegreeInputNBFC = container.querySelector("#otherDegreeInputNBFC");

                const userIdinside = usersListcontainer.querySelector(".personal_info_id");
                const userName = usersListcontainer.querySelector(".personal_info_name p");
                const userPhone = usersListcontainer.querySelector(".personal_info_phone p");
                const userMail = usersListcontainer.querySelector(".personal_info_email p");
                const userState = usersListcontainer.querySelector(".personal_info_state p");


                const educationContainer = usersListcontainer.querySelector(
                    "#nbfc-list-of-student-profilesections .studentdashboardprofile-educationeditsection .educationeditsection-secondrow"
                );

                const academic = data.academicDetails?.[0] ?? {};
                const personal = data.personalDetails?.[0] ?? {};
                const user = data.userDetails?.[0] ?? {};
                const course = data.courseDetails?.[0] ?? {};


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
                if (userIdinside) userIdinside.textContent = user.unique_id;

                if (courseDuration) courseDuration.value = course['course-duration'] ?? '';
                if (loanAmount) loanAmount.value = course.loan_amount_in_lakhs ?? '';
                if (scReferral) scReferral.value = user.referral_code ?? '';


                const degreeType = course['degree-type'];
                if (bachelorsLabel) bachelorsLabel.style.display = 'none';
                if (mastersLabel) mastersLabel.style.display = 'none';
                if (othersLabel) othersLabel.style.display = 'none';
                if (otherDegreeInputNBFC) {
                    otherDegreeInputNBFC.style.display = 'none';
                    otherDegreeInputNBFC.disabled = true;
                    otherDegreeInputNBFC.value = ''; // clear value unless set below
                }


                if (degreeType === 'Bachelors') {
                    if (bachelorsLabel) bachelorsLabel.style.display = 'flex';
                    if (degreeRadioBachelors) degreeRadioBachelors.checked = true;
                } else if (degreeType === 'Masters') {
                    if (mastersLabel) mastersLabel.style.display = 'flex';
                    if (degreeRadioMasters) degreeRadioMasters.checked = true;
                } else if (degreeType && degreeType !== 'Bachelors' && degreeType !== 'Masters') {
                    if (othersLabel) othersLabel.style.display = 'flex';
                    if (degreeRadioOthers) degreeRadioOthers.checked = true;
                    if (otherDegreeInputNBFC) {
                        otherDegreeInputNBFC.style.display = 'flex';
                        otherDegreeInputNBFC.disabled = false;
                        otherDegreeInputNBFC.value = degreeType;
                    }
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

                    if (academic.ILETS) scores.push({
                        label: "IELTS",
                        score: academic.ILETS
                    });
                    if (academic.GRE) scores.push({
                        label: "GRE",
                        score: academic.GRE
                    });
                    if (academic.TOFEL) scores.push({
                        label: "TOEFL",
                        score: academic.TOFEL
                    });

                    // Parse Others JSON
                    try {
                        const others = typeof academic.Others === 'string' ? JSON.parse(academic.Others) : academic.Others;
                        if (others?.otherExamName && others?.otherExamScore) {
                            scores.push({
                                label: others.otherExamName.toUpperCase(),
                                score: others.otherExamScore
                            });
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





            /* ----- ENDPOINTS CONFIG ----- */
            const endpoints = [{
                    url: "/retrieve-file",
                    selector: ".uploaded-aadhar-name",
                    fileType: "aadhar-card-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".uploaded-pan-name",
                    fileType: "pan-card-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".passport-name-selector",
                    fileType: "passport-card-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".sslc-marksheet",
                    fileType: "tenth-grade-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".hsc-marksheet",
                    fileType: "twelfth-grade-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".graduation-marksheet",
                    fileType: "graduation-grade-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".sslc-grade",
                    fileType: "secured-tenth-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".hsc-grade",
                    fileType: "secured-twelfth-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".graduation-grade",
                    fileType: "secured-graduation-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".experience-letter",
                    fileType: "work-experience-experience-letter"
                },
                {
                    url: "/retrieve-file",
                    selector: ".salary-slip",
                    fileType: "work-experience-monthly-slip"
                },
                {
                    url: "/retrieve-file",
                    selector: ".office-id",
                    fileType: "work-experience-office-id"
                },
                {
                    url: "/retrieve-file",
                    selector: ".joining-letter",
                    fileType: "work-experience-joining-letter"
                },
                {
                    url: "/retrieve-file",
                    selector: ".coborrower-pancard",
                    fileType: "co-pan-card-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".coborrower-aadharcard",
                    fileType: "co-aadhar-card-name"
                },
                {
                    url: "/retrieve-file",
                    selector: ".coborrower-addressproof",
                    fileType: "co-addressproof"
                }
            ];

            /* cache of already-retrieved URLs */
            const documentUrls = {};

            const initialiseAllViews = (userId) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken || !userId) {
                    console.error("CSRF token or User ID is missing");
                    return Promise.reject("Missing CSRF/User ID");
                }
                   resetAllDocumentFields(); 



                const fileTypes = endpoints.map(ep => ep.fileType);

                return fetch("/retrieve-file", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            userId,
                            fileTypes
                        }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        const allFiles = data.staticFiles || data;

                        Object.entries(allFiles).forEach(([fileType, fileUrl]) => {
                            if (fileUrl) {
                                documentUrls[fileType] = fileUrl;
                                const fileName = decodeURIComponent(fileUrl.split("/").pop());

                                const endpoint = endpoints.find(ep => ep.fileType === fileType);
                                if (endpoint) {
                                    const element = document.querySelector(endpoint.selector);
                                    if (element) {
                                        element.textContent = fileName;
                                    } else {
                                        console.warn(`Selector missing: ${endpoint.selector}`);
                                    }
                                }

                                console.log(`✅ ${fileType}: ${fileUrl}`);
                            } else {
                                console.log(`⚠️ No file for ${fileType}`);
                            }
                        });

                        return documentUrls;
                    })
                    .catch(error => {
                        console.error("❌ Error fetching files:", error);
                        return {};
                    });
            };
            function resetAllDocumentFields() {
            endpoints.forEach(endpoint => {
                const element = document.querySelector(endpoint.selector);
                if (element) {
                    element.textContent = 'No file selected'; // Reset filename
                }

                const eyeIcon = document.getElementById(endpoint.eyeIconId);
                if (eyeIcon) {
                    eyeIcon.style.display = 'none'; 
                }
    });

     Object.keys(documentUrls).forEach(key => delete documentUrls[key]);
}


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
                        body: JSON.stringify({
                            userId: userId
                        })
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
                    studentInfoDesc.textContent =
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua";

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


            // Run on window resize
            window.addEventListener("resize", limitVisibleItemsOnMobile);

            const viewMoreBtn = document.querySelector('.viewmore-messagenbfc');
            const viewMoreBtnrequest = document.querySelector('.viewmore-request');
            const viewMoreBtnproposal = document.querySelector('.viewmore-proposal');
            if (viewMoreBtn) {
                viewMoreBtn.addEventListener('click', () => {
                    viewMoreClicked = true;
                    document.querySelectorAll('.profile-list-item').forEach(item => {
                        item.style.display = "block";
                    });
                    viewMoreBtn.style.display = 'none';
                });
            }

            // const insideMessageTrigger = () => {
            //     if (messageBtnInside) {
            //         messageBtnInside.addEventListener('click', () => {
            //             if (messageBtns.length > 0) {
            //                 messageBtns[index].addEventListener('click', function () {
            //                     showChat();
            //                     var user = @json(session('nbfcuser'));
            //                     const nbfc_id = user.nbfc_id;
            //                     console.log(nbfc_id);

            //                     console.log(messageUserIds[index].textContent);
            //                     const messageInputStudentids = messageUserIds[index].textContent;
            //                     console.log(messageInputStudentids);

            //                     viewChat(nbfc_id, messageInputStudentids);
            //                 });
            //             }
            //         })
            //     }

            // }
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
                                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                },
                                body: JSON.stringify({
                                    email: email
                                })
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

            function downloadDocuments(userId) {
                console.log("Downloading documents for user:", userId);

                if (!userId) {
                    console.error("User ID is required to download documents.");
                    return;
                }

                const downloadTrigger = document.querySelector(".myapplication-seventhcolumn-headernbfc #downloaddocuments");

                if (!downloadTrigger) {
                    console.error("Download button not found.");
                    return;
                }

                // Avoid multiple event bindings
                downloadTrigger.addEventListener('click', function handleDownloadClick(e) {
                    e.preventDefault();

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (!csrfToken) {
                        console.error("CSRF token not found.");
                        return;
                    }

                    // ✅ Show loader before starting request
                    Loader.show();

                    fetch('/downloadzip', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                userId: userId
                            }),
                        })
                        .then(response => {
                            if (!response.ok) {
                                if (response.status === 404) {
                                    throw new Error("NO_FILES");
                                } else {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                            }
                            return response.blob();
                        })
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = `user_files_${userId}.zip`;
                            document.body.appendChild(a);
                            a.click();
                            a.remove();
                            window.URL.revokeObjectURL(url);
                        })
                        .catch(error => {
                            console.error("Error downloading documents:", error);

                            if (error.message === "NO_FILES") {
                                alert("No documents uploaded for this user yet.");
                            } else {
                                alert("Download failed. Please try again.");
                            }
                        })
                        .finally(() => {
                            Loader.hide();
                        });

                });
            }




            const reviwedUsers = (userId) => {
                const user = @json(session('nbfcuser'));

                if (user && user.nbfc_id) {
                    const nbfcId = user.nbfc_id;

                    fetch('/update-review-status', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                user_id: userId,
                                nbfc_id: nbfcId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Marked as reviewed!');
                            } else {
                                console.log('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            alert('Network or server error. Check console.');
                            console.error('Fetch Error:', error);
                        });
                } else {
                    alert('NBFC user not found in session.');
                }
            };


            setTimeout(() => {
                const viewMoreBtn = document.querySelector('.viewmore-messagenbfc');
                if (viewMoreBtn) {
                    viewMoreBtn.addEventListener('click', () => {
                        document.querySelectorAll('.profile-list-item').forEach(item => {
                            item.style.display = "block";
                        });
                        viewMoreBtn.style.display = 'none';
                    });
                }
            }, 0);

            function resetAllUserState() {
                // Reset global document data
                documentUrls = {};

                // Remove all eye icon click listeners and hide them
                const allEyeIcons = document.querySelectorAll(".fa-eye");
                allEyeIcons.forEach(icon => {
                    const clone = icon.cloneNode(true);
                    icon.parentNode.replaceChild(clone, icon);
                });

                // Clear all document file names
                const docNameFields = document.querySelectorAll(
                    "[class^='uploaded-'], [class$='-marksheet'], [class$='-grade']");
                docNameFields.forEach(el => el.textContent = "");

                // Close any open previews
                document.querySelectorAll(
                    ".pdf-preview-wrapper, .image-preview-wrapper, .pdf-preview-overlay, .image-preview-overlay").forEach(
                    el => el.remove());

                // Collapse all document sections
                document.querySelectorAll(
                    ".kycdocumentscolumn, .marksheetdocumentscolumn, .secured-admissioncolumn, .work-experiencecolumn, .coborrower-kyccolumn"
                ).forEach(section => {
                    section.style.display = "none";
                });

                // Optionally remove "layout-ready" class to restart animations/layouts
                const profileContainer = document.querySelector(".wholeapplicationprofile");
                if (profileContainer) profileContainer.classList.remove("layout-ready");
            }
        </script>


    </body>

    </html>
