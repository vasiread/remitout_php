<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Student Dashboard</title>
</head>

<body>
    @extends('layouts.app')
    @section('title', 'studentdashboard')

    @section('studentdashboard')

            @php
$profileImgPath = '';
$uploadPanName = '';
$profileIconPath = "assets/images/account_circle.png";
$phoneIconPath = "assets/images/call.png";
$mailIconPath = "assets/images/mail.png";
$pindropIconPath = "assets/images/pin_drop.png";
$discordIconPath = "assets/images/icons/discordicon.png";
$viewIconPath = "assets/images/visibility.png";


$courseDetailsJson = json_encode($courseDetails);


$bankName = 'bankName';
$bankMessage = 'bankMessage';
$loanStatusInfo = [
    [
        $bankName => "Bank Name",
        $bankMessage => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut"
    ],
    [
        $bankName => "Bank Name",
        $bankMessage => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut"
    ],
    [
        $bankName => "Bank Name",
        $bankMessage => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut"
    ],

];

            @endphp

            <div class="studentdashboardprofile">
                <div class="studentdashboardprofile-togglesidebar">
                    <ul class="studentdashboardprofile-sidebarlists-top">
                        <li class="active"> <i class="fa-solid fa-square-poll-vertical"></i> Dashboard</li>
                        <li> <i class="fa-solid fa-inbox"></i> Inbox</li>
                        <li> <i class="fa-regular fa-clipboard"></i> My Applications</li>
                    </ul>
                    <ul class="studentdashboardprofile-sidebarlists-bottom">
                        <li class="logoutBtn" onClick="sessionLogout()"> <i class="fa-solid fa-arrow-right-from-bracket"></i>Log
                            out</li>
                        <li> <img src="assets/images/Icons/support_agent.png" alt=""> Support</li>
                    </ul>
                </div>
                <div class="studentdashboardprofile-trackprogress">
                    <h1 class="trackprogress-header" style="margin:0">Track Progress</h1>
                    <div class="studentdashboardprofile-firstrowtrackprogress">
                        <div class="trackprogress-leftsection">
                            <p style="font-weight:600;
                                font-size:18px;
                                color:rgba(0, 0, 0, 1); 
                                padding:15px 0px 0px 24px">Loan
                                Status</p>
                            
                            <div class="leftsection-detailsinfo">
                               <div class="loan-receivedsection">
                                    <h1 style="color:rgba(255, 154, 63, 1);">02</h1>
                                    <p>Received</p>
                                </div>
                                <div class="loan-onholdsection">
                                    <h1>01</h1>
                                    <p>On Hold </p>
                                </div>
                                <div class="loan-rejectedsection">
                                    <h1>00</h1>
                                    <p>Rejected</p>
                                </div>
                            </div>
                        </div>
                        <div class="trackprogress-rightsection">
                            <p
                                style="  font-size: 18px;font-weight: 600; line-height: 27px; color:rgba(0, 0, 0, 1);padding:15px 0px 0px 24px">
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

                    <div class="studentdashboardprofile-loanproposals">
                        <h1 class="loanproposals-header" id="loanproposals-header">Loan Proposals</h1>
                        <div class="loanproposals-loanstatuscards">
                            @foreach ($loanStatusInfo as $loanDetails)
                                <div class="indivudalloanstatus-cards">
                                    <div class="individual-bankname">
                                        <h1>{{ $loanDetails[$bankName] }}</h1>
                                    </div>
                                    <div class="individual-bankmessages">
                                        <p>{{ $loanDetails[$bankMessage] }}</p>
                                        <div class="individual-bankmessages-buttoncontainer">
                                            <button>View</button><button>Accept</button><button
                                                class="bankmessage-buttoncontainer-reject">Reject</button>
                                        </div>
                                        <button class="triggeredbutton">
                                            Message
                                        </button>
                                    </div>
                                    <div class="individual-bankmessage-input">
                                        <input type="text" placeholder="Send message">
                                        <img class="send-img" src="assets/images/send.png" alt="">
                                        <i class="fa-solid fa-paperclip"></i>
                                        <i class="fa-regular fa-face-smile"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

        <div class="studentdashboardprofile-profilesection">
            <img src="{{asset($profileImgPath)}}" class="profileImg" id="profile-photo-id" alt="">
            <i class="fa-regular fa-pen-to-square"></i>
            <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data">
            <div class="studentdashboardprofile-personalinfo">
                <div class="personalinfo-firstrow">
                    <h1>My Profile</h1>
                </div>
                <ul class="personalinfo-secondrow">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span class="personal_info_id"
                            style="margin-left: 6px;"> {{$user->unique_id}}</span> </li>
                    <li class="personal_info_name" id="referenceNameId"><img src={{$profileIconPath}} alt="">
                        <p> {{$userDetails[0]->name ?? 'Name not available'}}</p>
                    </li>
                    <li class="personal_info_phone"><img src={{$phoneIconPath}} alt="">
                        <p>+91 {{$personalDetails[0]->phone}}</p>
                    </li>
                    <li class="personal_info_email" id="referenceEmailId">
                        <img src={{$mailIconPath}} alt="">
                        <p> {{$userDetails[0]->email}}</p>
                    </li>
                    <li class="personal_info_state"><img src={{$pindropIconPath}} alt="">
                        <p> {{ $personalDetails[0]->state }}</p>
                    </li>
                </ul>
                <ul class="personalinfosecondrow-editsection">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                            style="margin-left: 6px;"> {{$userDetails[0]->unique_id}}</span> </li>
                    <li class="personal_info_name">
                        <p>Name</p>
                        <input type="text" value="{{$userDetails[0]->name}}">
                    </li>
                    <li class="personal_info_phone">
                        <p>Phone</p>
                        <input type="text" value="{{$personalDetails[0]->phone}}">
                    </li>
                    <li class="personal_info_email">
                        <p>Email</p>
                        <input type="email" value="{{$userDetails[0]->email}}">
                    </li>
                    <li class="personal_info_state">
                        <p>State</p>
                        <input type="text" value="{{$personalDetails[0]->state}}">
                    </li>
                </ul>
            </div>
            <div class="personalinfo-profilestatus">
                <h1>Profile Status</h1>
                <div class="personalinfo-graphsectioncontainer">
                    <div class="profilestatus-graph-section">
                        <svg class="progress-ring" width="75" height="75" viewBox="0 0 120 120">
                            <!-- Background Circle (100%) -->
                            <circle class="progress-ring-circle" stroke="rgba(213, 213, 213, 0.41)" stroke-width="18"
                                fill="transparent" r="52" cx="60" cy="60" />

                            <!-- Progress Circle (animated) -->
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
            <div class="studentdashboardprofile-communityjoinsection">
                <img src={{asset($discordIconPath)}}>
                <p> Join Community</p>
            </div>
            <div class="studentdashboardprofile-educationeditsection">
                <div class="educationeditsection-firstrow">
                    <h1>Education</h1>
                    <!-- <button>Edit</button> -->
                </div>
                <div class="educationeditsection-secondrow">
                    <p>1. {{ $courseDetails[0]->{'degree-type'} }}</p>
                    <p>2. Consequuntur magni dolores</p>
                    <p>3. Voluptatem accusantium</p>
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
                        <p>{{ $counter++ }}. IELTS <span class="ilets_score">{{ $academicDetails[0]->ILETS }}</span></p>
                    @endif

                    @if (is_numeric($academicDetails[0]->GRE) && !empty($academicDetails[0]->GRE))
                        <p>{{ $counter++ }}. GRE <span class="gre_score">{{ $academicDetails[0]->GRE }}</span></p>
                    @endif

                    @if (is_numeric($academicDetails[0]->TOFEL) && !empty($academicDetails[0]->TOFEL))
                        <p>{{ $counter++ }}. TOEFL <span class="tofel_score">{{ $academicDetails[0]->TOFEL }}</span></p>
                    @endif

                    @php
                        $others = json_decode($academicDetails[0]->Others, true);
                    @endphp

                    @if (isset($others['otherExamName']) && isset($others['otherExamScore']) && is_numeric($others['otherExamScore']) && !empty($others['otherExamScore']))
                        <p>{{ $counter++ }}. {{$others['otherExamName']}} <span>{{$others['otherExamScore']}}</span></p>
                    @endif
                </div>


                <div class="testscoreseditsection-secondrow-editsection">
                    <p>ILETS</p>
                    <input type="text" class="ilets_score" value={{$academicDetails[0]->ILETS}}>
                    <p>GRE</p>
                    <input type="text" class="gre_score" value={{$academicDetails[0]->GRE}}>
                    <p>TOFEL</p> <input type="text" class="tofel_score" value="{{$academicDetails[0]->TOFEL}}">

                </div>
            </div>
        </div>
              


      <div class="studentdashboardprofile-myapplication">
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
                        <input type="checkbox" name="study-location-edit" value="New Zealand" disabled> New Zealand
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
                            <input type="text" id="country-edit" class="custom-country-edit" placeholder="Add Country">
                        </div>
                    </label>
                </div>
            </div>

            <div class="myapplication-thirdcolumn">
                <h6>2. Type of Degree?</h6>
                <div class="degreetypescheckboxes">
                    <!-- First radio button for Bachelors -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Bachelors"
                            @if($courseDetails[0]->{'degree-type'} == 'Bachelors') checked @endif
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Bachelors (only secured loan)</p>
                    </label>
                    <br>

                    <!-- Second radio button for Masters -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Masters"
                            @if($courseDetails[0]->{'degree-type'} == 'Masters') checked @endif
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Masters</p>
                    </label>
                    <br>

                    <!-- Third radio button for Others -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Others" @if($courseDetails[0]->{'degree-type'} !== 'Bachelors' && $courseDetails[0]->{'degree-type'} !== 'Masters') checked @endif
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Others</p>
                    </label>
                </div>

                <input type="text" placeholder="Enter degree type" value="{{ $courseDetails[0]->{'degree-type'} }}"
                    id="otherDegreeInput" @if($courseDetails[0]->{'degree-type'} != 'Others') disabled @endif>
            </div>

            <div class="myapplication-fourthcolumn-additional">
                <p>3. What is the duration of the course?</p>
                <input type="text" placeholder="{{ $courseDetails[0]->{'course-duration'} ?? '' }}"
                    value="{{ $courseDetails[0]->{'course-duration'} ?? '' }} " disabled>

            </div>
            <div class="myapplication-fourthcolumn">
                <p>4. What is the Loan amount required?</p>
                <input type="number" placeholder={{$courseDetails[0]->loan_amount_in_lakhs}}
                    value={{$courseDetails[0]->loan_amount_in_lakhs}} disabled>

            </div>
            <div class="myapplication-fifthcolumn">
                <p>Referral Code</p>
                <input type="text" placeholder="{{$personalDetails[0]->referral_code}}"
                    value="{{$personalDetails[0]->referral_code}}" disabled>
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
                                <p class="uploaded-pan-name"> pan_card.jpg</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-pan-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualkycdocuments">
                            <p class="document-name">Aadhar Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="uploaded-aadhar-name"> aadhar_card.jpg</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-aadhar-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualkycdocuments">
                            <p class="document-name">Passport</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="passport-name-selector"> Passport.pdf</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-passport-card" />
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
                                <p class="sslc-marksheet"> 10th grade marksheet</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-sslc-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualmarksheetdocuments">
                            <p class="document-name">12th grade marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p class="hsc-marksheet"> 12th grade marksheet</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-hsc-card" />
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet" />
                            <span class="document-status">420 MB uploaded</span>
                        </div>

                        <div class="individualmarksheetdocuments">
                            <p class="document-name">Graduation marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p class="graduation-marksheet"> Graduation Marksheet</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-graduation-card" />
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
                                <p class="sslc-grade">SSLC Grade</p>

                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-sslc-grade"></>

                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet">

                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-secured-admission-documents">
                            <p class="document-name">12th Grade
                            </p>
                            <div class="inputfilecontainer-secured-admission">
                                <i class="fa-solid fa-image"></i>
                                <p class="hsc-grade">HSC Grade</p>

                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-hsc-grade"></>

                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet">

                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-secured-admission-documents">
                            <p class="document-name">Graduation
                            </p>
                            <div class="inputfilecontainer-secured-admission">
                                <i class="fa-solid fa-image"></i>
                                <p class="graduation-grade">Graduation</p>

                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-graduation-grade"></>

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
                                <p class="experience-letter">Experience Letter</p>

                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-experience-letter"></>

                            </div>
                            <input type="file" id="inputfilecontainer-work-experience">

                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-work-experiencecolumn-documents">
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
                        <div class="individual-work-experiencecolumn-documents">
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
                        <div class="individual-work-experiencecolumn-documents">
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
                                <p class="coborrower-pancard">Pan Card </p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-coborrower-pan"></>
                            </div>
                            <input type="file" id="inputfilecontainer-kyccoborrwer">
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-coborrower-kyc-documents">
                            <p class="document-name">Aadhar Card
                            </p>
                            <div class="inputfilecontainer-coborrower-kyccolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="coborrower-aadharcard">Aadhar Card </p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-coborrower-aadhar"></>
                            </div>
                            <input type="file" id="inputfilecontainer-kyccoborrwer">
                            <span class="document-status">420 MB uploaded</span>
                        </div>
                        <div class="individual-coborrower-kyc-documents">
                            <p class="document-name">Address Proof
                            </p>
                            <div class="inputfilecontainer-coborrower-kyccolumn">
                                <i class="fa-solid fa-image"></i>
                                <p class="coborrower-addressproof">Address Proof </p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-coborrower-addressproof"></>
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

            </div>
    @endsection




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeSideBarTabs();
            initializeIndividualCards();
            initializeKycDocumentUpload();
            initializeMarksheetUpload();
            initializeProgressRing();
            saveChangesFunctionality();
            initialisedocumentsCount();
            initialiseProfileUpload();
            initialiseProfileView();
            initialiseAllViews()
                .then(() => {
                    console.log("All URLs fetched successfully!");
                })
                .catch((error) => {
                    console.error("Error during initialization:", error);
                });
            initialiseSeventhcolumn();
            initialiseSeventhAdditionalColumn();
            initialiseEightcolumn();
            initialiseNinthcolumn();
            initialiseTenthcolumn();


            const courseDetails = {!! $courseDetailsJson !!};

            let planToStudy = courseDetails[0]['plan-to-study'].replace(/[\[\]"]/g, '');

            let selectedCountries = planToStudy.split(/\s*,\s*/);

            document.getElementById("plan-to-study-edit").value = planToStudy;

            document.querySelectorAll('input[name="study-location-edit"]').forEach(checkbox => {
                if (selectedCountries.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });

            const otherCheckbox = document.querySelector('#other-checkbox-edit');
            const addCountryBox = document.querySelector('.add-country-box-edit');
            const customCountryInput = document.querySelector('#country-edit');

            if (selectedCountries.includes("Other")) {
                otherCheckbox.checked = true;
                addCountryBox.style.display = 'block';
            } else {
                addCountryBox.style.display = 'none';
            }

            otherCheckbox.addEventListener('change', () => {
                if (otherCheckbox.checked) {
                    addCountryBox.style.display = 'block';
                } else {
                    addCountryBox.style.display = 'none';
                    customCountryInput.value = '';
                }
            });
            document.querySelector('.mailnbfcbutton').addEventListener('click', () => {
                sendDocumenttoEmail();
            });




        });




        const initializeSideBarTabs = () => {
            const sideBarTopItems = document.querySelectorAll('.studentdashboardprofile-sidebarlists-top li');
            const lastTabHiddenDiv = document.querySelector(".studentdashboardprofile-trackprogress");
            const lastTabVisibleDiv = document.querySelector(".studentdashboardprofile-myapplication");
            const dynamicHeader = document.getElementById('loanproposals-header');
            const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');
            const communityJoinCard = document.querySelector('.studentdashboardprofile-communityjoinsection');
            const profileStatusCard = document.querySelector(".personalinfo-profilestatus");
            const profileImgEditIcon = document.querySelector(".studentdashboardprofile-profilesection .fa-pen-to-square");
            const educationEditSection = document.querySelector(".studentdashboardprofile-educationeditsection");
            const testScoresEditSection = document.querySelector(".studentdashboardprofile-testscoreseditsection");


            sideBarTopItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    sideBarTopItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');

                    if (index === 1) {
                        lastTabHiddenDiv.style.display = "flex";
                        lastTabVisibleDiv.style.display = "none";
                        communityJoinCard.style.display = "flex";
                        profileStatusCard.style.display = "block";
                        profileImgEditIcon.style.display = "none";
                        educationEditSection.style.display = "none";
                        testScoresEditSection.style.display = "none";

                        individualCards.forEach((card) => {
                            const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                            const groupButtonContainer = card.querySelector('.individual-bankmessages-buttoncontainer');

                            if (triggeredMessageButton && groupButtonContainer) {
                                triggeredMessageButton.style.display = "flex";
                                groupButtonContainer.style.display = "none";
                            }
                        });
                        dynamicHeader.textContent = "Inbox";
                    } else if (index === 0) {
                        lastTabHiddenDiv.style.display = "flex";
                        lastTabVisibleDiv.style.display = "none";
                        communityJoinCard.style.display = "flex";
                        profileStatusCard.style.display = "block";
                        profileImgEditIcon.style.display = "none";
                        educationEditSection.style.display = "none";
                        testScoresEditSection.style.display = "none";

                        individualCards.forEach((card) => {
                            const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                            const groupButtonContainer = card.querySelector('.individual-bankmessages-buttoncontainer');
                            const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');

                            card.style.height = "95px";
                            if (individualBankMessageInput) {
                                individualBankMessageInput.style.display = "none";
                            }
                            if (triggeredMessageButton && groupButtonContainer) {
                                triggeredMessageButton.style.display = "none";
                                groupButtonContainer.style.display = "flex";
                            }
                        });
                        dynamicHeader.textContent = "Loan Proposals";
                    } else if (index === 2) {
                        lastTabHiddenDiv.style.display = "none";
                        lastTabVisibleDiv.style.display = "flex";
                        communityJoinCard.style.display = "none";
                        profileStatusCard.style.display = "none";
                        profileImgEditIcon.style.display = "block";
                        educationEditSection.style.display = "flex";
                        testScoresEditSection.style.display = "flex";
                    }
                });
            });
        };

        function sendDocumenttoEmail(event) {
            console.log(event);

            const uniqueIdElement = document.querySelector('.personal_info_id');
            const userId = uniqueIdElement ? uniqueIdElement.textContent || uniqueIdElement.innerHTML : null;

            const emailElement = document.querySelector("#referenceEmailId p");
            const email = emailElement ? emailElement.textContent || emailElement.innerHTML : null;

            const userNameElement = document.querySelector("#referenceNameId p");
            const name = userNameElement ? userNameElement.textContent || userNameElement.innerHTML : null;

            if (userId && email && name) {
                console.log("Unique ID:", userId, "Email:", email, "Name:", name);
            } else {
                console.error("Error: Could not retrieve unique ID, email, or name.");
                return;
            }

            const sendDocumentsRequiredDetails = {
                userId: userId,
                email: email,
                name: name
            };

            fetch('/send-documents', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(sendDocumentsRequiredDetails)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.errors) {
                        console.error('Validation errors:', data.errors);
                    } else {
                        console.log("Success:", data.message);
                        alert(data.message);


                        addUserToRequest(userId);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });

            console.log("Sending Data:", sendDocumentsRequiredDetails);
        }

    function addUserToRequest(userId) {
            console.log(userId);

            // Fetch request to send userId to the server
            fetch("/push-user-id-request", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify( {userId:userId.trim()} )
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("Success:", data);
                    } else if (data.error) {
                        console.log("Error:", data.error);
                    }
                })
                .catch((e) => {
                    console.error("Request failed:", e);
                });
        }

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

        const initialiseAllViews = () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent.trim() : '';

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

        const triggerEditButton = () => {
            const disabledInputs = document.querySelectorAll('.studentdashboardprofile-myapplication input[disabled]');
            disabledInputs.forEach(inputItems => {
                inputItems.removeAttribute('disabled');
            });

            // Enable custom radio buttons (if disabled)
            const disabledRadios = document.querySelectorAll('.studentdashboardprofile-myapplication input[type="radio"][disabled]');
            disabledRadios.forEach(radio => {
                radio.removeAttribute('disabled');
            });

            const otherDegreeInput = document.getElementById("otherDegreeInput");
            if (otherDegreeInput && otherDegreeInput.disabled) {
                otherDegreeInput.removeAttribute('disabled');
            }
        };
        const initialiseProfileUpload = () => {
            const editIcon = document.querySelector('.studentdashboardprofile-profilesection .fa-pen-to-square');
            const profileImageInput = document.querySelector('.studentdashboardprofile-profilesection .profile-upload');

            if (editIcon && profileImageInput) {
                editIcon.addEventListener('click', function () {
                    profileImageInput.click();
                });

                profileImageInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];

                    if (!file) {
                        console.error('No file selected');
                        return;
                    }
                    const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");

                    const userId = userIdElement ? userIdElement.textContent : '';

                    const fileName = file.name;
                    const fileType = file.type;
                    console.log(fileType + "." + fileName);

                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!allowedTypes.includes(fileType)) {
                        console.error('Invalid file type. Only jpg, png, and gif are allowed.');
                        return;
                    }

                    const formDetailsData = new FormData();
                    formDetailsData.append('file', file);
                    formDetailsData.append('userId', userId);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    if (!csrfToken) {
                        console.error('CSRF token not found');
                        return;
                    }

                    fetch('/upload-profile-picture', {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formDetailsData,
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw new Error(errorData.error || 'Network response was not ok');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data) {
                                console.log("File uploaded successfully", data);
                                const imgElement = document.querySelector("#profile-photo-id");
                                imgElement.src = data.file_path;
                                const navImageElement = document.querySelector("#nav-profile-photo-id");
                                navImageElement.src = data.file_path;
                                console.log(data)
                            } else {
                                console.error("Error: No URL returned from the server", data);
                            }
                        })
                        .catch(error => {
                            console.error("Error uploading file", error);
                        });

                });
            }
        };
        const initialiseEightcolumn = () => {
            const section = document.querySelector('.eightcolumn-firstsection');

            section.addEventListener('click', function () {
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

        const initialiseProfileView = () => {

            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

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
                        const imgElement = document.querySelector("#profile-photo-id");
                        imgElement.src = data.fileUrl;
                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving profile picture", error);
                });
        }


        const initializeIndividualCards = () => {
            const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');

            individualCards.forEach((card) => {
                const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');

                if (triggeredMessageButton) {
                    triggeredMessageButton.addEventListener('click', () => {
                        const isExpanded = card.style.height === "190px";

                        individualCards.forEach((otherCard) => {
                            otherCard.style.height = "95px";
                            const otherMessageInput = otherCard.querySelector('.individual-bankmessage-input');
                            if (otherMessageInput) {
                                otherMessageInput.style.display = "none";
                            }
                        });

                        if (isExpanded) {
                            card.style.height = "95px";
                            individualBankMessageInput.style.display = "none";
                        } else {
                            card.style.height = "190px";
                            individualBankMessageInput.style.display = "flex";
                        }
                    });
                }
            });
        };

        const initializeKycDocumentUpload = () => {
            const individualKycDocumentsUpload = document.querySelectorAll(".individualkycdocuments");

            individualKycDocumentsUpload.forEach((card) => {
                let uploadedFile = null;

                // Trigger file input when the container is clicked
                card.querySelector('.inputfilecontainer').addEventListener('click', function () {
                    card.querySelector('#inputfilecontainer-real').click();
                });

                // Handle file selection and validation
                card.querySelector('#inputfilecontainer-real').addEventListener('change', function (event) {
                    const file = event.target.files[0];

                    // Ensure file is selected
                    if (!file) return;

                    console.log("Selected file: ", file);  // Debug log

                    // Allowed file types
                    const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
                    const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();

                    // Validate file type
                    if (!allowedExtensions.includes(fileExtension)) {
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

                    console.log("File uploaded:", uploadedFile);  // Debug log
                });



                card.querySelector('.fa-eye').addEventListener('click', function (event) {
                    event.stopPropagation();
                    const previewContainer = card.querySelector('.inputfilecontainer');
                    const eyeIcon = this;

                    if (eyeIcon.classList.contains('preview-active')) {
                        const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                        if (previewWrapper) previewWrapper.remove();
                        const overlay = document.querySelector('.pdf-preview-overlay');
                        if (overlay) overlay.remove();
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

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;
    
    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));
    
    return name.slice(0, 16) + '...' + extension;
}

// Initialize the document uploads when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeWorkExperienceDocumentUpload();
});



//co-borrower document
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

// Helper function to truncate file names
function truncateFileName(fileName) {
    if (fileName.length <= 20) return fileName;
    
    const extension = fileName.slice(fileName.lastIndexOf('.'));
    const name = fileName.slice(0, fileName.lastIndexOf('.'));
    
    return name.slice(0, 16) + '...' + extension;
}

// Initialize the document uploads when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeCoBorrowerDocumentUpload();
});

        function toggleOtherDegreeInput(event) {
            const otherDegreeInput = document.getElementById('otherDegreeInput');

            if (event && event.target && event.target.value) {
                if (event.target.value === 'Others') {
                    otherDegreeInput.disabled = false;
                    otherDegreeInput.placeholder = 'Enter here';
                    otherDegreeInput.value = '';
                } else {
                    otherDegreeInput.disabled = true;
                    otherDegreeInput.value = event.target.value; // Set the value to Bachelors or Masters
                    otherDegreeInput.placeholder = 'Enter degree type'; // Reset placeholder if needed
                }

                // Trigger the "Save" state on degree type change
                toggleSaveState();
            } else {
                console.error("Error: Event or target value is undefined.");
            }
        }
        const initializeProgressRing = () => {
            const radius = 52;
            const circumference = 2 * Math.PI * radius;
            const percentage = 0.01;
            const offset = circumference * (1 - percentage);
            const progressRingFill = document.querySelector('.progress-ring-fill');
            const progressText = document.querySelector('.progress-ring-text');

            progressRingFill.style.strokeDasharray = `${circumference} ${circumference}`;
            progressRingFill.style.strokeDashoffset = offset;
            progressText.textContent = `${Math.round(percentage * 100)}%`;
        };

        const initialisedocumentsCount = () => {
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");

            const userId = userIdElement ? userIdElement.textContent : '';

            fetch("/count-documents", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ userId })
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data) {
                        console.log(data.documentscount);
                        const documentCountText = document.querySelector(".profilestatus-graph-secondsection .profilestatus-noofdocuments-section p");
                        // if(data.documentscount<10){
                        if (data.documentscount < 10 && data.documentscound>=0 && documentCountText && data && data.documentscount !== undefined) {
                            documentCountText.textContent = "0" + data.documentscount;
                        }
                        else if(data.documentscount<0){
                            documentCountText.textContent="00";


                        }
                         else if (data.documentscount >= 10 && documentCountText && data && data.documentscount !== undefined) {
                            documentCountText.textContent = data.documentscount;

                        } else {
                            console.error('Element not found or data is invalid');


                        }

                        // }
                        // else{
                        // documentCountText.textContent = "0" + data.documentscount;

                        // }

                    } else if (data.error) {
                        console.error(data.error);
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        };



        const triggerSave = (event) => {
            console.log(event);

        }
        document.querySelectorAll('input[name="education-level"]').forEach(radio => {
            radio.addEventListener('change', function () {
                var otherInput = document.getElementById('otherDegreeInput');
                if (this.value === 'Others' && this.checked) {
                    otherInput.disabled = false;
                } else {
                    otherInput.disabled = true;
                }
            });
        });






        const saveChangesFunctionality = () => {
            let isEditing = false;
            const saveChangesButton = document.querySelector(".personalinfo-firstrow button");
            const savedMsg = document.querySelector(".studentdashboardprofile-myapplication .myapplication-firstcolumn .personalinfo-firstrow .saved-msg");
            const personalDivContainer = document.querySelector(".personalinfo-secondrow");
            const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
            const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
            const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");

            const planToStudy = document.getElementById("plan-to-study-edit");

            const toggleSaveState = () => {
                isEditing = true;

                saveChangesButton.textContent = 'Save';
                saveChangesButton.style.backgroundColor = "rgba(111, 37, 206, 1)";
                saveChangesButton.style.color = "#fff";

                personalDivContainerEdit.style.display = "flex";
                personalDivContainer.style.display = "none";
                academicsMarksDivEdit.style.display = "flex";
                academicsMarksDiv.style.display = "none";
            };

            if (saveChangesButton) {
                saveChangesButton.textContent = 'Edit';
                saveChangesButton.style.backgroundColor = "transparent";
                saveChangesButton.style.color = "#260254";

                saveChangesButton.addEventListener('click', (event) => {

                    isEditing = !isEditing;

                    if (isEditing) {
                        toggleSaveState(); // Call toggleSaveState function when entering edit mode
                    } else {
                        saveChangesButton.textContent = 'Edit';
                        saveChangesButton.style.backgroundColor = "transparent";
                        saveChangesButton.style.color = "#260254";
                        personalDivContainer.style.display = "flex";
                        personalDivContainerEdit.style.display = "none";
                        academicsMarksDivEdit.style.display = "none";
                        academicsMarksDiv.style.display = "flex";

                        const editedName = document.querySelector(".personalinfosecondrow-editsection .personal_info_name input").value;
                        const editedPhone = document.querySelector(".personalinfosecondrow-editsection .personal_info_phone input").value;
                        const editedEmail = document.querySelector(".personalinfosecondrow-editsection .personal_info_email input").value;
                        const editedState = document.querySelector(".personalinfosecondrow-editsection .personal_info_state input").value;
                        const iletsScore = document.querySelector(".testscoreseditsection-secondrow-editsection .ilets_score").value;
                        const greScore = document.querySelector(".testscoreseditsection-secondrow-editsection .gre_score").value;
                        const tofelScore = document.querySelector(".testscoreseditsection-secondrow-editsection .tofel_score").value;

                        const planToStudy = document.getElementById("plan-to-study-edit").value;
                        const courseDuration = document.querySelector(".myapplication-fourthcolumn-additional input").value;
                        const loanAmount = document.querySelector(".myapplication-fourthcolumn input").value;
                        const referralCode = document.querySelector(".myapplication-fifthcolumn input").value;

                        const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
                        const userId = userIdElement ? userIdElement.textContent : '';

                        console.log(editedName, editedPhone, editedEmail, editedState, userId);

                        const selectedDegree = document.querySelector('input[name="education-level"]:checked').value;
                        const otherDegreeInput = document.getElementById('otherDegreeInput').value;

                        const updatedDegreeType = selectedDegree === 'Others' ? otherDegreeInput : selectedDegree;

                        const updatedData = {
                            degreeType: updatedDegreeType
                        };

                        const updatedInfos = {
                            editedName: editedName,
                            editedPhone: editedPhone,
                            editedEmail: editedEmail,
                            editedState: editedState,
                            iletsScore: iletsScore,
                            greScore: greScore,
                            tofelScore: tofelScore,
                            planToStudy: planToStudy,
                            courseDuration: courseDuration,
                            loanAmount: loanAmount,
                            referralCode: referralCode,
                            degreeType: updatedData.degreeType,
                            userId: userId
                        };

                        fetch('/from-profileupdate', {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(updatedInfos)
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.errors) {
                                    console.error('Validation errors:', data.errors);
                                } else {
                                    saveChangesButton.style.display = "none";
                                    savedMsg.style.display = "flex";
                                    console.log("data");

                                    setTimeout(() => {
                                        const disabledInputs = document.querySelectorAll('.studentdashboardprofile-myapplication input[disabled]');
                                        disabledInputs.forEach(inputItems => {
                                            inputItems.removeAttribute('disabled');
                                        });
                                    }, 1200);

                                    setTimeout(() => {
                                        saveChangesButton.style.display = "flex";
                                        savedMsg.style.display = 'none';
                                    }, 1200);
                                    console.log("Success", data);
                                }
                            })
                            .catch(error => {
                                console.error("Error", error);
                            });
                    }
                });
            }

            const degreeRadioButtons = document.querySelectorAll('input[name="education-level"]');
            degreeRadioButtons.forEach(button => {
                button.addEventListener('change', toggleSaveState); // toggleSaveState is now defined
            });
        };

        const sessionLogout = () => {
            fetch('{{ route('session.logout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("User logged out:", data.message);
                    window.location.href = "{{ route('login') }}"; // Redirect to the login page
                })
                .catch(error => console.error('Error during logout:', error));
        };



    </script>

</body>

</html>