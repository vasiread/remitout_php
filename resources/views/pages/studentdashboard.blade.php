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
                            <p>On Hold

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
                        <p class="secondsection-inside" style="color:rgba(144, 144, 144, 1)" >Document Uploaded</p>




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
            </div>

            <div class="myapplication-thirdcolumn">
                <h6>2. Type of Degree?</h6>
                <div class="degreetypescheckboxes">
                    <!-- First radio button for Bachelors -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Bachelors"
                            @if($courseDetails[0]->{'degree-type'} == 'Bachelors') checked @endif
                            onclick="toggleOtherDegreeInput(event)">
                        <span class="radio-button"></span>
                        <p>Bachelors (only secured loan)</p>
                    </label>
                    <br>

                    <!-- Second radio button for Masters -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Masters"
                            @if($courseDetails[0]->{'degree-type'} == 'Masters') checked @endif
                            onclick="toggleOtherDegreeInput(event)">
                        <span class="radio-button"></span>
                        <p>Masters</p>
                    </label>
                    <br>

                    <!-- Third radio button for Others -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Others" @if($courseDetails[0]->{'degree-type'} !== 'Bachelors' && $courseDetails[0]->{'degree-type'} !== 'Masters') checked @endif
                            onclick="toggleOtherDegreeInput(event)">
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
              
              
                <div class="kycdocumentscolumn"  >

               
                        <div class="individualkycdocuments">
                            <p class="document-name">Pan Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="uploaded-pan-name"> pan_card.jpg</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-pan-card"></>
                            </div>

                            <input type="file" id="inputfilecontainer-real">

                            <span class="document-status">420 MB uploaded</span>







                        </div>
                        <div class="individualkycdocuments">
                            <p class="document-name">Aadhar Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="uploaded-aadhar-name"> aadhar_card.jpg</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-aadhar-card"></>

                            </div>
                            <input type="file" id="inputfilecontainer-real">

                            <span class="document-status">420 MB uploaded</span>







                        </div>
                        <div class="individualkycdocuments">
                            <p class="document-name">Passport</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p class="passport-name"> Passport.pdf</p>
                                <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-passport-card"></>

                            </div>
                            <input type="file" id="inputfilecontainer-real">

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
                                                         <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-sslc-card"></>
                        
                                                    </div>
                                                    <input type="file" id="inputfilecontainer-real-marksheet">
                        
                                                    <span class="document-status">420 MB uploaded</span>
                        
                        
                        
                        
                        
                        
                        
                                                </div>
                                                <div class="individualmarksheetdocuments">
                                                    <p class="document-name">12th grade marksheet</p>
                                                    <div class="inputfilecontainer-marksheet">
                                                        <i class="fa-solid fa-image"></i>
                                                        <p class="hsc-marksheet"> 12th grade marksheet</p>
                                                        <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-hsc-card"></>
                        
                                                    </div>
                                                    <input type="file" id="inputfilecontainer-real-marksheet">
                        
                                                    <span class="document-status">420 MB uploaded</span>
                        
                        
                        
                        
                        
                        
                        
                                                </div>
                                                <div class="individualmarksheetdocuments">
                                                    <p class="document-name">Graduation marksheet</p>
                                                    <div class="inputfilecontainer-marksheet">
                                                        <i class="fa-solid fa-image"></i>
                                                        <p class="graduation-marksheet"> Graduation Marksheet</p>
                                                    <img class="fa-eye" src="{{asset($viewIconPath)}}" id="view-graduation-card">
                        
                                                    </div>
                                                    <input type="file" id="inputfilecontainer-real-marksheet">
                        
                                                    <span class="document-status">420 MB uploaded</span>
                        
                        
                        
                        
                        
                        
                        
                                                </div>
                        
                        
                                            </div>


                </div>

            </div>
            <div class="myapplication-eightcolumn">
                <div class="eightcolumn-firstsection">
                                        <div class="eightcolumn-header">

                    <p>Secured Admissions</p>
                    <i class="fa-solid fa-angle-down"></i> </div>
                </div>

            </div>
            <div class="myapplication-ninthcolumn">
                <div class="ninthcolumn-firstsection" >
                                                            <div class="ninthcolumn-header">

                    <p>Work Experience</p>
                    <i class="fa-solid fa-angle-down"></i></div>
                </div>

            </div>
            <div class="myapplication-tenthcolumn">
                <div class="tenthcolumn-firstsection">
                <div class="tenthcolumn-header">

                
                    <p>Co-borrower Documents</p>
                    <i class="fa-solid fa-angle-down"></i></div>
                </div>

            </div>
            <div class="myapplication-eleventhcolumn">
                <button class="mailnbfcbutton">Send Email to NBFCs</button>

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
            initialisePanCardView();
            initialiseAadharView();
            initialisePassportView();
            initialisesslcView();
            initialisehscView();
            initialisegraduationView();
            initialiseSeventhcolumn();
            initialiseSeventhAdditionalColumn();
            initialiseEightcolumn();
            initialiseNinthcolumn();
            initialiseTenthcolumn();


            const courseDetails = {!! $courseDetailsJson !!};
            const planToStudy = courseDetails[0]['plan-to-study'].replace(/[\[\]"]/g, '');;

            document.getElementById("plan-to-study-edit").value = planToStudy;
            document.querySelector('.mailnbfcbutton').addEventListener('click', (event) => {
                sendDocumenttoEmail(event);
            })



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
            event.preventDefault();

            // Get user ID
            const uniqueIdElement = document.querySelector('.personal_info_id');
            const userId = uniqueIdElement ? uniqueIdElement.textContent || uniqueIdElement.innerHTML : null;

            // Get email
            const emailElement = document.querySelector("#referenceEmailId p");
            const email = emailElement ? emailElement.textContent || emailElement.innerHTML : null;

            // Get user name
            const userNameElement = document.querySelector("#referenceNameId p");
            const name = userNameElement ? userNameElement.textContent || userNameElement.innerHTML : null;

            // Check if all required details are present
            if (userId && email && name) {
                console.log("Unique ID:", userId, "Email:", email, "Name:", name);
            } else {
                console.error("Error: Could not retrieve unique ID, email, or name.");
                return; // Exit the function if any value is missing
            }

            // Prepare data to send in the POST request
            const sendDocumentsRequiredDetails = {
                userId: userId,
                email: email,
                name: name
            };

            // Make the fetch request
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
                        alert(data.message)
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });

            console.log("Sending Data:", sendDocumentsRequiredDetails);
        }

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

                    // Optional: Validate file type before uploading
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!allowedTypes.includes(fileType)) {
                        console.error('Invalid file type. Only jpg, png, and gif are allowed.');
                        return;
                    }

                    const formDetailsData = new FormData();
                    formDetailsData.append('file', file);
                    formDetailsData.append('userId', userId);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Handle case where CSRF token is not found
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


        const initialiseEightcolumn=()=>{
            const section = document.querySelector('.eightcolumn-firstsection');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content'; 
                } else {
                    section.style.height = '';
                }
            });
        }
        const initialiseSeventhcolumn =()=>{
            const section = document.querySelector('.seventhcolum-firstsection');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
        const initialiseSeventhAdditionalColumn =()=>{
            const section = document.querySelector('.seventhcolumn-additional-firstcolumn');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
         const initialiseNinthcolumn=()=>{
            const section = document.querySelector('.ninthcolumn-firstsection');

            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
   
        const initialiseTenthcolumn=()=>{
            const section = document.querySelector(".tenthcolumn-firstsection");
             section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = '';
                }
            });

        }
   
        const initialisePanCardView = () => {
            


            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

            fetch('/retrieve-pan-card', {
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
                        console.log("Pan Card URL:", data);
                        const PancardName = (data.fileUrl).split('/').pop();
                        document.querySelector(".uploaded-pan-name").textContent = PancardName;



                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving profile picture", error);
                });
         }

        const initialisePassportView = () => {


            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

            fetch('/retrieve-passport', {
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
                        console.log("Passport URL:", data);
                        const passPortName = (data.fileUrl).split('/').pop();
                        document.querySelector(".passport-name").textContent = passPortName;


                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving passport url", error);
                });
        }

        const initialisesslcView = () => {


            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

            fetch('/retrieve-sslcmarksheet', {
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
                        console.log("sslc-marksheet URL:", data);
                        const sslcMarksheetName = (data.fileUrl).split('/').pop();
                        document.querySelector(".sslc-marksheet").textContent = sslcMarksheetName;


                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving sslcmarksheet url", error);
                });
        }

        const initialisehscView = () => {


            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

            fetch('/retrieve-hscmarksheet', {
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
                        console.log("hsc-marksheet URL:", data);
                        const hscMarksheetName = (data.fileUrl).split('/').pop();
                        document.querySelector(".hsc-marksheet").textContent = hscMarksheetName;


                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving hsc marksheet url", error);
                });
        }

        const initialisegraduationView = () => {


            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

            fetch('/retrieve-graduationmarksheet', {
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
                        console.log("graduation-marksheet URL:", data);
                        const graduationMarksheetName = (data.fileUrl).split('/').pop();
                        document.querySelector(".graduation-marksheet").textContent = graduationMarksheetName;


                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving graduation marksheet url", error);
                });
        }






        const initialiseAadharView = () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");
            const userId = userIdElement ? userIdElement.textContent : '';

            fetch('/retrieve-aadhar-card', {
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
                        console.log("Aadhar Card URL:", data);
                        const aadharName = (data.fileUrl).split('/').pop();
                        document.querySelector(".uploaded-aadhar-name").textContent = aadharName;


                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving profile picture", error);
                });

        }
        const initialiseProfileView = () => {
            var profileImgPath = '<?php echo $profileImgPath; ?>';

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

                card.querySelector('.inputfilecontainer').addEventListener('click', function () {
                    card.querySelector('#inputfilecontainer-real').click();
                });

                card.querySelector('#inputfilecontainer-real').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        uploadedFile = file;  
                        card.querySelector('.inputfilecontainer p').textContent = file.name;
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        const filesizeviewer = card.querySelector('.document-status');
                        filesizeviewer.textContent = `${fileSizeMB} MB Uploaded`;
                    }
                });

                card.querySelector('.fa-eye').addEventListener('click', function (event) {
                    event.stopPropagation();

                    
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
                        uploadedFile = file;  // Store the file for later preview
                        card.querySelector('.inputfilecontainer-marksheet p').textContent = file.name;
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        const filesizeviewer = card.querySelector('.document-status');
                        filesizeviewer.textContent = `${fileSizeMB} MB Uploaded`;
                    }
                });

                card.querySelector('.fa-eye').addEventListener('click', function () {
                    event.stopPropagation();
                    
                });
            });
        };


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
                        if (data.documentscount < 10 && documentCountText && data && data.documentscount !== undefined) {
                            documentCountText.textContent = "0" + data.documentscount;
                        } else if (data.documentscount >= 10 && documentCountText && data && data.documentscount !== undefined) {
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
                    // Toggle the editing state
                    isEditing = !isEditing;

                    if (isEditing) {
                        saveChangesButton.textContent = 'Save';
                        saveChangesButton.style.backgroundColor = "rgba(111, 37, 206, 1)";
                        saveChangesButton.style.color = "#fff";

                        personalDivContainerEdit.style.display = "flex";
                        personalDivContainer.style.display = "none";
                        academicsMarksDivEdit.style.display = "flex";
                        academicsMarksDiv.style.display = "none";
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
                button.addEventListener('change', toggleSaveState);
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