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
        $profileImgPath = 'assets/images/profileimg.png';
        $profileIconPath = "assets/images/account_circle.png";
        $phoneIconPath = "assets/images/call.png";
        $mailIconPath = "assets/images/mail.png";
        $pindropIconPath = "assets/images/pin_drop.png";
        $discordIconPath = "assets/images/icons/discordicon.png";




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
                <li onclick="window.location.href='{{route('login')}}'"> <i
                        class="fa-solid fa-arrow-right-from-bracket"></i>Log out</li>
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
                            <p>Received

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
                        <button>
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

            <img src="{{asset($profileImgPath)}}" class="profileImg" alt="">
            <i class="fa-regular fa-pen-to-square"></i>

            <div class="studentdashboardprofile-personalinfo">
                <div class="personalinfo-firstrow">
                    <h1>My Profile</h1>
                    <button>Edit</button>
                    <button class="saved-msg">Saved</button>
                </div>
                <ul class="personalinfo-secondrow">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span class="personal_info_id"
                            style="margin-left: 6px;"> {{$user->unique_id}}</span> </li>
                    <li class="personal_info_name"><img src={{$profileIconPath}} alt="">
                        <p> {{$userDetails[0]->name ?? 'Name not available'}}</p>
                    </li>
                    <li class="personal_info_phone"><img src={{$phoneIconPath}} alt="">
                        <p>+91 {{$personalDetails[0]->phone}}</p>
                    </li>
                    <li class="personal_info_email">
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
                        <input type="text" value="{{$userDetails[0]->email}}">
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
                            <p>07</p>
                            <span>/13</span>
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
                    <p>1. Lorem ipsum dolor sit amet</p>
                    <p>2. Consequuntur magni dolores</p>
                    <p>3. Voluptatem accusantium</p>
                </div>
            </div>
            <div class="studentdashboardprofile-testscoreseditsection">
                <div class="testscoreseditsection-firstrow">
                    <h1>Test Scores</h1>


                </div>
                <div class="testscoreseditsection-secondrow">
                    <p>1. IELTS <span class="ilets_score">{{ $academicDetails[0]->ILETS }}</span></p>
                    <p>2. GRE <span class="gre_score">{{ $academicDetails[0]->GRE }}</span></p>
                    <p>3. TOEFL <span class="tofel_score">{{ $academicDetails[0]->TOFEL }}</span></p>

                    <!-- @if (!empty($academicDetails[0]->Others))
                                @php
                                    $otherTests = json_decode($academicDetails[0]->Others, true); 
                                @endphp

                                <p>4. Others</p>
                                @foreach ($otherTests as $testName => $score)
                                    <p>{{ $testName }} <span>{{ $score }}</span></p>
                                @endforeach
                @else
                    <p>4. Others <span>No additional tests</span></p>
                @endif -->
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
                <button onClick="triggerEditButton()">Edit</button>

            </div>
            <div class="myapplication-secondcolumn">
                <p>1. Where are you planning to study</p>
                @foreach($courseDetails as $index => $course)

                    <input type="text" placeholder="{{ $course->{'plan-to-study'} }}"
                        value="{{ $course->{'plan-to-study'} }}" disabled>

                @endforeach
            </div>

            <div class="myapplication-thirdcolumn">
                <h6>2. Type of Degree?</h6>
                <div class="degreetypescheckboxes">
                    <!-- First radio button for Bachelors -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Bachelors"
                            @if($courseDetails[0]->{'degree-type'} == 'Bachelors') checked @endif>
                        <span class="radio-button"></span>
                        <p>Bachelors (only secured loan)</p>
                    </label>
                    <br>

                    <!-- Second radio button for Masters -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Masters"
                            @if($courseDetails[0]->{'degree-type'} == 'Masters') checked @endif>
                        <span class="radio-button"></span>
                        <p>Masters</p>
                    </label>
                    <br>

                    <!-- Third radio button for Others -->
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Others"
                            @if($courseDetails[0]->{'degree-type'} == 'Others') checked @endif>
                        <span class="radio-button"></span>
                        <p>Others</p>
                    </label>
                </div>

                <!-- Input field for 'Others' with conditional enabling -->
                <input type="text" placeholder="Enter your degree type" value="{{ $courseDetails[0]->{'degree-type'} }}"
                    id="otherDegreeInput" @if($courseDetails[0]->{'degree-type'} != 'Others') disabled @endif>
            </div>
            <div class="myapplication-fourthcolumn-additional">
                <p>3. What is the duration of the course?</p>
                <input type="text" placeholder="{{ $courseDetails[0]->{'course-details'} ?? '' }}"
                    value="{{ $courseDetails[0]->{'course-details'} ?? '' }}" disabled>
            </div>
            <div class="myapplication-fourthcolumn">
                <p>4. What is the Loan amount required?</p>
                <input type="text" placeholder={{$courseDetails[0]->loan_amount_in_lakhs}}
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
                <div class="myapplication-seventhcolum-documentscolumn">
                    <h4>Student KYC Document</h4>
                    <div class="kycdocumentscolumn">
                        <div class="individualkycdocuments">
                            <p class="document-name">Pan Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p> pan_card.jpg</p>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <input type="file" id="inputfilecontainer-real">

                            <span class="document-status">420 MB uploaded</span>







                        </div>
                        <div class="individualkycdocuments">
                            <p class="document-name">Aadhar Card</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p> aadhar_card.jpg</p>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <input type="file" id="inputfilecontainer-real">

                            <span class="document-status">420 MB uploaded</span>







                        </div>
                        <div class="individualkycdocuments">
                            <p class="document-name">Passport</p>
                            <div class="inputfilecontainer">
                                <i class="fa-solid fa-image"></i>
                                <p> Passport.pdf</p>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <input type="file" id="inputfilecontainer-real">

                            <span class="document-status">420 MB uploaded</span>







                        </div>


                    </div>
                    <h4>Academic Marksheets</h4>

                    <div class="marksheetdocumentscolumn">
                        <div class="individualmarksheetdocuments">
                            <p class="document-name">10th grade marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p> 10th grade marksheet</p>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet">

                            <span class="document-status">420 MB uploaded</span>







                        </div>
                        <div class="individualmarksheetdocuments">
                            <p class="document-name">12th grade marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p> 12th grade marksheet</p>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet">

                            <span class="document-status">420 MB uploaded</span>







                        </div>
                        <div class="individualmarksheetdocuments">
                            <p class="document-name">Graduation marksheet</p>
                            <div class="inputfilecontainer-marksheet">
                                <i class="fa-solid fa-image"></i>
                                <p> Graduation Marksheet</p>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <input type="file" id="inputfilecontainer-real-marksheet">

                            <span class="document-status">420 MB uploaded</span>







                        </div>


                    </div>
                </div>


            </div>
            <div class="myapplication-eightcolumn">
                <div class="eightcolumn-firstsection">
                    <p>Secured Admissions</p>
                    <i class="fa-solid fa-angle-down"></i>
                </div>

            </div>
            <div class="myapplication-ninthcolumn">
                <div class="ninthcolumn-firstsection">
                    <p>Work Experience</p>
                    <i class="fa-solid fa-angle-down"></i>
                </div>

            </div>
            <div class="myapplication-tenthcolumn">
                <div class="tenthcolumn-firstsection">
                    <p>Co-borrower Documents</p>
                    <i class="fa-solid fa-angle-down"></i>
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

        // Define the triggerEditButton function
        const triggerEditButton = () => {
            // Enable all disabled inputs in the profile
            const disabledInputs = document.querySelectorAll('.studentdashboardprofile-myapplication input[disabled]');
            disabledInputs.forEach(inputItems => {
                inputItems.removeAttribute('disabled');
            });

            // Enable custom radio buttons (if disabled)
            const disabledRadios = document.querySelectorAll('.studentdashboardprofile-myapplication input[type="radio"][disabled]');
            disabledRadios.forEach(radio => {
                radio.removeAttribute('disabled');
            });

            // Enable the input for 'Others' degree type if it was disabled
            const otherDegreeInput = document.getElementById("otherDegreeInput");
            if (otherDegreeInput && otherDegreeInput.disabled) {
                otherDegreeInput.removeAttribute('disabled');
            }
        };

        // Assign the event listener outside of the function to avoid recursion
        // document.querySelector(".studentdashboardprofile-myapplication .myapplication-firstcolumn button").addEventListener("click", triggerEditButton);


        // Attach event listener to the edit button

        const initializeIndividualCards = () => {
            const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');

            individualCards.forEach((card) => {
                const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');

                if (triggeredMessageButton) {
                    triggeredMessageButton.addEventListener('click', () => {
                        const isExpanded = card.style.height === "190px";

                        individualCards.forEach((otherCard) => {
                            otherCard.style.height = "95px"; // Collapse all other cards
                            const otherMessageInput = otherCard.querySelector('.individual-bankmessage-input');
                            if (otherMessageInput) {
                                otherMessageInput.style.display = "none";
                            }
                        });

                        if (isExpanded) {
                            card.style.height = "95px"; // Collapse this card
                            individualBankMessageInput.style.display = "none";
                        } else {
                            card.style.height = "190px"; // Expand this card
                            individualBankMessageInput.style.display = "flex";
                        }
                    });
                }
            });
        };

        const initializeKycDocumentUpload = () => {
            const individualKycDocumentsUpload = document.querySelectorAll(".individualkycdocuments");

            individualKycDocumentsUpload.forEach((card) => {
                let uploadedFile = null; // Store the uploaded file here

                // Trigger file selection when clicking the file container
                card.querySelector('.inputfilecontainer').addEventListener('click', function () {
                    card.querySelector('#inputfilecontainer-real').click();
                });

                // Handle file selection
                card.querySelector('#inputfilecontainer-real').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        uploadedFile = file;  // Store the file for later preview
                        card.querySelector('.inputfilecontainer p').textContent = file.name;
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        const filesizeviewer = card.querySelector('.document-status');
                        filesizeviewer.textContent = `${fileSizeMB} MB Uploaded`;
                    }
                });

                // Handle eye icon click for preview
                card.querySelector('.fa-eye').addEventListener('click', function (event) {
                    event.stopPropagation(); // Prevent the click from triggering the file input

                    if (uploadedFile && uploadedFile.type === 'application/pdf') {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            const iframe = document.createElement('iframe');
                            iframe.src = event.target.result;
                            iframe.style.width = '100%';
                            iframe.style.height = "500px";
                            const previewContainer = card.querySelector('.inputfilecontainer');
                            previewContainer.innerHTML = ''; // Clear previous content
                            previewContainer.appendChild(iframe);
                        };
                        reader.readAsDataURL(uploadedFile); // Trigger file reading
                    } else {
                        alert('Please upload a valid PDF file to preview.');
                    }
                });
            });
        };

        const initializeMarksheetUpload = () => {
            const individualMarksheetDocumentsUpload = document.querySelectorAll(".individualmarksheetdocuments");

            individualMarksheetDocumentsUpload.forEach((card) => {
                let uploadedFile = null;

                // Trigger file selection when clicking the file container
                card.querySelector('.inputfilecontainer-marksheet').addEventListener('click', function () {
                    card.querySelector('#inputfilecontainer-real-marksheet').click();
                });

                // Handle file selection
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

                // Handle eye icon click for preview
                card.querySelector('.fa-eye').addEventListener('click', function () {
                    event.stopPropagation();
                    if (uploadedFile && uploadedFile.type === 'application/pdf') {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            const iframe = document.createElement('iframe');
                            iframe.src = event.target.result;
                            iframe.style.width = '100%';
                            iframe.style.height = "500px";
                            const previewContainer = card.querySelector('.inputfilecontainer-marksheet');
                            previewContainer.innerHTML = ''; // Clear previous content
                            previewContainer.appendChild(iframe);
                        };
                        reader.readAsDataURL(uploadedFile); // Trigger file reading
                    } else {
                        alert('Please upload a valid PDF file to preview.');
                    }
                });
            });
        };

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


        const triggerSave = (event) => {
            console.log(event);

        }
        document.querySelectorAll('input[name="education-level"]').forEach(radio => {
            radio.addEventListener('change', function () {
                var otherInput = document.getElementById('otherDegreeInput');
                if (this.value === 'Others' && this.checked) {
                    otherInput.disabled = false; // Enable input field if 'Others' is selected
                } else {
                    otherInput.disabled = true; // Disable input field for other options
                }
            });
        });


        const saveChangesFunctionality = () => {
            // Assuming we start in "view" mode (not editing)
            let isEditing = false;
            const saveChangesButton = document.querySelector(".personalinfo-firstrow button");
            const savedMsg = document.querySelector(".studentdashboardprofile-personalinfo .personalinfo-firstrow .saved-msg");  // Corrected class selector
            const personalDivContainer = document.querySelector(".personalinfo-secondrow");
            const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
            const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
            const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");

            if (saveChangesButton) {
                // Initially set the button text to "Edit"
                saveChangesButton.textContent = 'Edit';  // 'Save' initially set here doesn't seem logical

                saveChangesButton.addEventListener('click', (event) => {
                    // Toggle the editing state
                    isEditing = !isEditing;

                    if (isEditing) {

                        saveChangesButton.textContent = 'Save';
                        personalDivContainerEdit.style.display = "flex";
                        personalDivContainer.style.display = "none";
                        academicsMarksDivEdit.style.display = "flex";
                        academicsMarksDiv.style.display = "none";
                    } else {

                        saveChangesButton.textContent = 'Edit';
                        personalDivContainer.style.display = "flex";
                        personalDivContainerEdit.style.display = "none";
                        academicsMarksDivEdit.style.display = "none";
                        academicsMarksDiv.style.display = "flex";



                        const editedName = document.querySelector(".personalinfosecondrow-editsection .personal_info_name input").value;
                        const editedPhone = document.querySelector(".personalinfosecondrow-editsection .personal_info_phone input").value;
                        const editedEmail = document.querySelector(".personalinfosecondrow-editsection .personal_info_email input").value;
                        const editedState = document.querySelector(".personalinfosecondrow-editsection .personal_info_state input").value;
                        const iletsScore = document.querySelector(".testscoreseditsection-secondrow-editsection .ilets_score input").value;
                        const greScore = document.querySelector(".testscoreseditsection-secondrow-editsection .gre_score input").value;
                        const tofelScore = document.querySelector(".testscoreseditsection-secondrow-editsection .tofel_score input").value;


                        const userIdElement = document.querySelector(".personalinfo-secondrow .personal_info_id");

                        const userId = userIdElement ? userIdElement.textContent : '';

                        console.log(editedName, editedPhone, editedEmail, editedState, userId);

                        const updatedInfos = {
                            editedName: editedName,
                            editedPhone: editedPhone,
                            editedEmail: editedEmail,
                            editedState: editedState,
                            iletsScore: iletsScore,
                            greScore: greScore,
                            tofelScore: tofelScore,
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

                                    document.querySelector(".personalinfo-secondrow .personal_info_name p").textContent = data.user.name;
                                    document.querySelector(".personalinfo-secondrow .personal_info_email p").textContent = data.user.email;
                                    document.querySelector(".personalinfo-secondrow .personal_info_phone p").textContent = data.personalInfo.phone;
                                    document.querySelector(".personalinfo-secondrow .personal_info_state p").textContent = data.personalInfo.state;
                                    document.querySelector(".testscoreseditsection-secondrow p .ilets_score").textContent = data.academicsScores.iletsScore;
                                    document.querySelector(".testscoreseditsection-secondrow p .gre_score").textContent = data.academicsScores.greScore;
                                    document.querySelector(".testscoreseditsection-secondrow p .tofel_score").textContent = data.academicsScores.tofelScore;

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
        };




    </script>

</body>

</html>