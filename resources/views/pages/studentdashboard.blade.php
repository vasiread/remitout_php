<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Student Dashboard</title>

    <script src="{{ asset('js/studentdashboard.js') }}" defer></script>
</head>

<body>
    @extends('layouts.app')
    @section('title', 'studentdashboard')

    @section('studentdashboard')

        @php
            $profileImgPath = '';
            $uploadPanName = '';
            $profileIconPath = 'assets/images/account_circle.png';
            $phoneIconPath = 'assets/images/call.png';
            $mailIconPath = 'assets/images/mail.png';
            $pindropIconPath = 'assets/images/pin_drop.png';
            $discordIconPath = 'assets/images/icons/discordicon.png';
            $viewIconPath = 'assets/images/visibility.png';

            $courseDetailsJson = json_encode($courseDetails);
            $nbfcdata = [];

            $studyLocationsRaw = $courseDetails[0]->{'plan-to-study'} ?? [];
$studyLocations = is_array($studyLocationsRaw) ? $studyLocationsRaw : [$studyLocationsRaw];
$studyLocationsString = implode(', ', $studyLocations);


        @endphp
        <div class="studentdashboardprofile-togglesidebar">
            <ul class="studentdashboardprofile-sidebarlists-top">
                <li class="active" data-section="studentdashboardprofile-trackprogress" data-index="0">
                    <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                </li>
                <li data-section="studentdashboardprofile-trackprogress" data-index="1">
                    <i class="fa-solid fa-inbox"></i> Inbox
                </li>
                <li data-section="studentdashboardprofile-myapplication" data-index="2">
                    <i class="fa-regular fa-clipboard"></i> My Applications
                </li>
            </ul>
            <ul class="studentdashboardprofile-sidebarlists-bottom">
                <li class="logoutBtn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                </li>
                <li>
                    <img src="assets/images/Icons/support_agent.png" alt=""> Support
                </li>
            </ul>
        </div>
        <div class="studentdashboardprofile">

            <div class="studentdashboardprofile-trackprogress" id="studentdashboardprofile-trackprogress-id">
                <div class="studentdashboardprofile-firstrowtrackprogress">
                    <div class="trackprogress-headercontainer">
                        <h1 class="trackprogress-header" style="margin:0">Track Progress</h1>


                    </div>
                    <div class="trackprogress-contentcontainer">
                        <div class="trackprogress-leftsection">
                            <p
                                style="font-weight:600;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    font-size:18px;
                                                                                                                                                                                                                                                                                                                                                                                                                       color:rgba(0, 0, 0, 1); 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    padding:15px 0px 0px 24px">
                                Loan
                                Status</p>

                            <div class="leftsection-detailsinfo">
                                <div class="loan-receivedsection">
                                    <h1 style="color:rgba(255, 154, 63, 1);">--</h1>
                                    <p>Received</p>
                                </div>
                                <div class="loan-onholdsection">
                                    <h1>--</h1>
                                    <p>On Hold </p>
                                </div>
                                <div class="loan-rejectedsection">
                                    <h1>--</h1>
                                    <p>Rejected</p>
                                </div>
                            </div>
                        </div>
                        <div class="trackprogress-rightsection">
                            <p
                                style="font-size: 18px;font-weight: 600; line-height: 27px; color:rgba(0, 0, 0, 1);padding:15px 0px 0px 24px">
                                Document Status
                            </p>
                            <div class="rightsection-uploadsection">
                                <div class="uploadsectionsandglass">
                                    <i class="fa-solid fa-hourglass"></i>
                                    <p class="upload-status-hourglass">
                                        Status : Pending
                                    </p>
                                </div>
                                <button onclick="window.location.href='{{ asset('student-forms') }}'">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="studentdashboardprofile-loanproposals" id="studentdashboardprofile-loanproposals-id">
                    <div class="loanproposal-headerstudentside">
                        <h1 class="loanproposals-header" id="loanproposals-header">Loan Proposals</h1>
                        <p> </p>



                    </div>

                    <div class="loanproposals-loanstatuscards">
                        <!-- existing messages here -->
                    </div>


                    <div class="adminmessage-inboxnbfc">

                    </div>

                </div>
            </div>

            <div class="studentdashboardprofile-profilesection" id="intergratestudentdashboardprofile">
                <img src="{{ asset($profileImgPath) }}" class="profileImg" id="profile-photo-id" alt="">
                <i class="fa-regular fa-pen-to-square"></i>
                <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data">
                <div class="studentdashboardprofile-personalinfo">
                    <div class="personalinfo-firstrow">
                        <h1>My Profile</h1>
                    </div>
                    <ul class="personalinfo-secondrow">
                        <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span class="personal_info_id"
                                style="margin-left: 6px;"> {{ $user->unique_id }}</span> </li>
                        <li class="personal_info_name" id="referenceNameId"><img src={{ $profileIconPath }} alt="">
                            <p> {{ $userDetails[0]->name ?? 'Name not available' }}</p>
                        </li>
                        <li class="personal_info_phone"><img src={{ $phoneIconPath }} alt="">

                            <p>+91 {{ $userDetails[0]->phone }}</p>
                        </li>
                        <li class="personal_info_email" id="referenceEmailId">
                            <img src="{{ $mailIconPath }}" alt="">
                            <p title="{{ $userDetails[0]->email }}">{{ $userDetails[0]->email }}</p>

                        </li>
                        <li class="personal_info_state"><img src={{ $pindropIconPath }} alt="">
                            <p id="personal_state_id"> {{ $personalDetails[0]->state }}</p>
                        </li>
                    </ul>
                    <ul class="personalinfosecondrow-editsection">
                        <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                                style="margin-left: 6px;"> {{ $userDetails[0]->unique_id }}</span> </li>
                        <li class="personal_info_name">
                            <p>Name</p>
                            <input type="text" value="{{ $userDetails[0]->name }}">
                        </li>
                        <li class="personal_info_phone">
                            <p>Phone</p>
                            <input type="text" value="{{ $userDetails[0]->phone }}" disabled>
                        </li>
                        <li class="personal_info_email">
                            <p>Email</p>
                            <input type="email" value="{{ $userDetails[0]->email }}" disabled>
                        </li>
                        <li class="personal_info_state">
                            <p>State</p>
                            <input type="text" value="{{ $personalDetails[0]->state }}">
                        </li>
                    </ul>
                </div>
                <div class="personalinfo-profilestatus">
                    <h1>Profile Status</h1>
                    <div class="personalinfo-graphsectioncontainer">
                        <div class="profilestatus-graph-section">
                            <svg class="progress-ring" width="75" height="75" viewBox="0 0 120 120">
                                <circle class="progress-ring-circle" stroke="rgba(213, 213, 213, 0.41)" stroke-width="18"
                                    fill="transparent" r="52" cx="60" cy="60" />

                                <circle class="progress-ring-fill" stroke="rgba(255, 154, 63, 1)" stroke-width="18"
                                    fill="transparent" r="52" cx="60" cy="60" />
                                <text x="50%" y="50%" text-anchor="middle" fill="rgba(255, 154, 63, 1)" font-weight="600"
                                    font-family="Poppins" font-size="14" width="31px" height="21px"
                                    class="progress-ring-text"></text>
                            </svg>
                            <p style="color:rgba(144, 144, 144, 1)">Profile Complete</p>
                        </div>
                        <div class="profilestatus-graph-secondsection">
                            <div class="profilestatus-noofdocuments-section">
                                <p>00</p>
                                <span>/22</span>
                            </div>
                            <p class="secondsection-inside" style="color:rgba(144, 144, 144, 1)">Document Uploaded</p>
                        </div>
                    </div>
                </div>
                <div class="studentdashboardprofile-communityjoinsection"
                    onclick="window.open('https://discord.gg/9WfXzR9P', '_blank')" style="cursor: pointer;">
                    <img src="{{ asset($discordIconPath) }}">
                    <p>Join Community</p>
                </div>

                <div class="studentdashboardprofile-educationeditsection">
                    <div class="educationeditsection-firstrow">
                        <h1>Education</h1>
                        <!-- Edit/Save button is handled globally -->
                    </div>

                    <!-- View Mode -->
                    <div class="educationeditsection-secondrow">
                        <p>Course: {{ $academicDetails[0]->{'course_name'} }}</p>
                        <p>University: {{ $academicDetails[0]->{'university_school_name'} }}</p>
                    </div>

                    <!-- Edit Mode (Initially hidden) -->
                    <div class="educationeditsection-secondrow-edit" style="display: none;">
                        <input type="text" class="course_name_input" placeholder="Enter course name">
                        <input type="text" class="university_name_input" placeholder="Enter university/school name">
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

                        @if (is_numeric($academicDetails[0]->ILETS) && !empty($academicDetails[0]->ILETS))
                            <p>{{ $counter++ }}. IELTS <span
                                    class="ilets_score">{{ $academicDetails[0]->ILETS }}</span></p>
                        @endif

                        @if (is_numeric($academicDetails[0]->GRE) && !empty($academicDetails[0]->GRE))
                            <p>{{ $counter++ }}. GRE <span class="gre_score">{{ $academicDetails[0]->GRE }}</span></p>
                        @endif

                        @if (is_numeric($academicDetails[0]->TOFEL) && !empty($academicDetails[0]->TOFEL))
                            <p>{{ $counter++ }}. TOEFL <span
                                    class="tofel_score">{{ $academicDetails[0]->TOFEL }}</span></p>
                        @endif

                        @php
                            $others = json_decode($academicDetails[0]->Others, true);
                        @endphp

                        @if (isset($others['otherExamName']) &&
                                isset($others['otherExamScore']) &&
                                is_numeric($others['otherExamScore']) &&
                                !empty($others['otherExamScore']))
                            <p>{{ $counter++ }}. {{ $others['otherExamName'] }}
                                <span>{{ $others['otherExamScore'] }}</span>
                            </p>
                        @endif
                    </div>


                    <div class="testscoreseditsection-secondrow-editsection">
                        <p>ILETS</p>
                        <input type="text" class="ilets_score" value="{{ $academicDetails[0]->ILETS }}">

                        <p>GRE</p>
                        <input type="text" class="gre_score" value="{{ $academicDetails[0]->GRE }}">

                        <p>TOFEL</p>
                        <input type="text" class="tofel_score" value="{{ $academicDetails[0]->TOFEL }}">

                        @php $others = json_decode($academicDetails[0]->Others, true); @endphp

                        @if (isset($others['otherExamName']) || isset($others['otherExamScore']))
                            <p>Other Exam Name</p>
                            <input type="text" class="other_exam_name_input"
                                value="{{ $others['otherExamName'] ?? '' }}">

                            <p>Other Exam Score</p>
                            <input type="number" class="other_exam_score_input"
                                value="{{ $others['otherExamScore'] ?? '' }}">
                        @else
                            <p>Other Exam Name</p>
                            <input type="text" class="other_exam_name_input" placeholder="Enter exam name" />

                            <p>Other Exam Score</p>
                            <input type="number" class="other_exam_score_input" placeholder="Enter exam score" />
                        @endif
                    </div>


                </div>
            </div>



            <div class="studentdashboardprofile-myapplication" id="course-details-container"
                data-course-details='{{ json_encode($courseDetails) }}'
                data-personal-details='{{ json_encode($personalDetails) }}'>
                <div class="myapplication-firstcolumn">
                    <h1>Course Details</h1>
                    <!-- <button >Edit</button> -->
                    <div class="personalinfo-firstrow">
                        <button onClick="triggerEditButton()">Edit</button>
                        <button class="saved-msg">Saved</button>
                    </div>
                </div>

                <div class="myapplication-secondcolumn">
                    <p>1. Where are you planning to study</p>
                    <input type="text" id="plan-to-study-edit" value="{{ $studyLocationsString }}" disabled>



                    <div class="checkbox-group-edit" id="selected-study-location-edit">
    @php
        $rawStudyLocations = $courseDetails[0]->{'plan-to-study'} ?? [];
        $studyLocations = is_array($rawStudyLocations) ? $rawStudyLocations : explode(',', $rawStudyLocations);
        $studyLocations = array_map('trim', $studyLocations); // remove extra spaces
    @endphp

    @foreach (['USA', 'UK', 'Ireland', 'New Zealand', 'Germany', 'France', 'Sweden', 'Italy', 'Canada', 'Australia'] as $country)
        <label>
            <input type="checkbox" name="study-location-edit" value="{{ $country }}"
                @if (in_array($country, $studyLocations)) checked @endif disabled> {{ $country }}
        </label>
    @endforeach

    <label>
        <div class="add-country-box-edit">
            <input type="text" id="country-edit" class="custom-country-edit"
                placeholder="Add Country" disabled>
        </div>
    </label>
</div>

                </div>


                <div class="myapplication-thirdcolumn">
                    <h6>2. Type of Degree?</h6>
                    <div class="degreetypescheckboxes">
                        <!-- First radio button for Bachelors -->
                        <label class="custom-radio">
                            <input type="radio" name="education-level" value="Bachelors" style="display:none"
                                @if ($courseDetails[0]->{'degree-type'} == 'Bachelors') checked @endif onclick="toggleOtherDegreeInput(event)"
                                disabled>
                            <span class="radio-button"></span>
                            <p>Bachelors (only secured loan)</p>
                        </label>
                        <br>

                        <!-- Second radio button for Masters -->
                        <label class="custom-radio">
                            <input type="radio" name="education-level" value="Masters" style="display:none"
                                @if ($courseDetails[0]->{'degree-type'} == 'Masters') checked @endif onclick="toggleOtherDegreeInput(event)"
                                disabled>
                            <span class="radio-button"></span>
                            <p>Masters</p>
                        </label>
                        <br>

                        <!-- Third radio button for Others -->
                        <label class="custom-radio">
                            <input type="radio" name="education-level" value="Others" style="display:none"
                                @if ($courseDetails[0]->{'degree-type'} !== 'Bachelors' && $courseDetails[0]->{'degree-type'} !== 'Masters') checked @endif onclick="toggleOtherDegreeInput(event)"
                                disabled>
                            <span class="radio-button"></span>
                            <p>Others</p>
                        </label>
                    </div>

                    <input type="text" placeholder="Enter degree type"
                        value="{{ $courseDetails[0]->{'degree-type'} }}" id="otherDegreeInput"
                        @if ($courseDetails[0]->{'degree-type'} != 'Others') disabled @endif>
                </div>

                <div class="myapplication-fourthcolumn-additional">
                    <p>3. What is the duration of the course?</p>
                    <input type="text" placeholder="{{ $courseDetails[0]->{'course-duration'} ?? '' }}"
                        value="{{ $courseDetails[0]->{'course-duration'} ?? '' }} " disabled>

                </div>
                <div class="myapplication-fourthcolumn">
                    <p>4. What is the Loan amount required?</p>
                    <input type="number" placeholder={{ $courseDetails[0]->loan_amount_in_lakhs }}
                        value={{ $courseDetails[0]->loan_amount_in_lakhs }} disabled>

                </div>
                <div class="myapplication-fifthcolumn">
                    <p>Referral Code</p>
                    <input type="text" placeholder="{{ $userDetails[0]->referral_code }}"
                        value="{{ $userDetails[0]->referral_code }}" disabled>
                </div>
                <div class="myapplication-sixthcolumn">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="myapplication-seventhcolumn">
                    <h1>Attached Documents</h1>
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
                                    <p class="uploaded-pan-name truncate-filename"> pan_card.jpg</p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-pan-card" />
                                </div>
                                <input type="file" id="inputfilecontainer-real" />
                                <span class="document-status">420 MB uploaded</span>
                            </div>

                            <div class="individualkycdocuments">
                                <p class="document-name">Aadhar Card</p>
                                <div class="inputfilecontainer">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="uploaded-aadhar-name truncate-filename"> aadhar_card.jpg</p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-aadhar-card" />
                                </div>
                                <input type="file" id="inputfilecontainer-real" />
                                <span class="document-status">420 MB uploaded</span>
                            </div>

                            <div class="individualkycdocuments">
                                <p class="document-name">Passport</p>
                                <div class="inputfilecontainer">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="passport-name-selector truncate-filename"> Passport.pdf</p>
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
                                    <p class="sslc-marksheet truncate-filename"> 10th grade marksheet</p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-sslc-card" />
                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet" />
                                <span class="document-status">420 MB uploaded</span>
                            </div>

                            <div class="individualmarksheetdocuments">
                                <p class="document-name">12th grade marksheet</p>
                                <div class="inputfilecontainer-marksheet">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="hsc-marksheet truncate-filename"> 12th grade marksheet</p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-hsc-card" />
                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet" />
                                <span class="document-status">420 MB uploaded</span>
                            </div>

                            <div class="individualmarksheetdocuments">
                                <p class="document-name">Graduation marksheet</p>
                                <div class="inputfilecontainer-marksheet">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="graduation-marksheet truncate-filename"> Graduation Marksheet</p>
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
                                <p class="document-name">10th Grade
                                </p>
                                <div class="inputfilecontainer-secured-admission">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="sslc-grade truncate-filename">SSLC Grade</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-sslc-grade"></>

                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet">

                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-secured-admission-documents">
                                <p class="document-name">12th Grade
                                </p>
                                <div class="inputfilecontainer-secured-admission">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="hsc-grade truncate-filename">HSC Grade</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-hsc-grade"></>

                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet">

                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-secured-admission-documents">
                                <p class="document-name">Graduation
                                </p>
                                <div class="inputfilecontainer-secured-admission">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="graduation-grade truncate-filename">Graduation</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-graduation-grade"></>

                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet">
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
                                <p class="document-name">Experience Letter
                                </p>
                                <div class="inputfilecontainer-work-experiencecolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="experience-letter truncate-filename">Experience Letter</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-experience-letter"></>

                                </div>
                                <input type="file" id="inputfilecontainer-work-experience">

                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-work-experiencecolumn-documents">
                                <p class="document-name">3 month Salary Slip
                                </p>
                                <div class="inputfilecontainer-work-experiencecolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="salary-slip truncate-filename">3 month salary slip</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-salary-slip"></>

                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet">

                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-work-experiencecolumn-documents">
                                <p class="document-name">Office ID
                                </p>
                                <div class="inputfilecontainer-work-experiencecolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="office-id truncate-filename">Office ID</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-office-id"></>

                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet">

                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-work-experiencecolumn-documents">
                                <p class="document-name ">Employment Joining Letter
                                </p>
                                <div class="inputfilecontainer-work-experiencecolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="joining-letter truncate-filename">Joining Letter</p>

                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-joining-letter"></>

                                </div>
                                <input type="file" id="inputfilecontainer-real-marksheet">

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
                                <p class="document-name">Pan Card
                                </p>
                                <div class="inputfilecontainer-coborrower-kyccolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="coborrower-pancard truncate-filename">Pan Card </p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-coborrower-pan"></>
                                </div>
                                <input type="file" id="inputfilecontainer-kyccoborrwer">
                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-coborrower-kyc-documents">
                                <p class="document-name">Aadhar Card
                                </p>
                                <div class="inputfilecontainer-coborrower-kyccolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="coborrower-aadharcard truncate-filename">Aadhar Card </p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}" id="view-coborrower-aadhar"></>
                                </div>
                                <input type="file" id="inputfilecontainer-kyccoborrwer">
                                <span class="document-status">420 MB uploaded</span>
                            </div>
                            <div class="individual-coborrower-kyc-documents">
                                <p class="document-name">Address Proof
                                </p>
                                <div class="inputfilecontainer-coborrower-kyccolumn">
                                    <i class="fa-solid fa-image"></i>
                                    <p class="coborrower-addressproof truncate-filename">Address Proof </p>
                                    <img class="fa-eye" src="{{ asset($viewIconPath) }}"
                                        id="view-coborrower-addressproof"></>
                                </div>
                                <input type="file" id="inputfilecontainer-kyccoborrwer">
                                <span class="document-status">420 MB uploaded</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="myapplication-eleventhcolumn">
                    <button class="mailnbfcbutton">Send Email to NBFCs</button>

                </div>
            </div>


        </div>


    @endsection






</body>

</html>
