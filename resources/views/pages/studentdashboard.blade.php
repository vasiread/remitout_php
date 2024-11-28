<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Student Dashboard</title>
</head>

<body>
    @extends('layouts.app')
    @section(section: 'studentdashboard') 

    @php
        $profileImgPath = 'assets/images/profileimg.png';
        $profileIconPath = "assets/images/icons/account_circle.png";
        $phoneIconPath = "assets/images/icons/phone.png";
        $mailIconPath = "assets/images/icons/mail.png";
        $pindropIconPath = "assets/images/icons/pindrop.png";
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
                <li> <i class="fa-solid fa-arrow-right-from-bracket"></i>Log out</li>
                <li> <img src="assets/images/Icons/support_agent.png" alt=""> Support</li>

            </ul>



        </div>
        <div class="studentdashboardprofile-trackprogress">
            <h1 class="trackprogress-header" style="margin:0">Track Progress</h1>
            <div class="studentdashboardprofile-firstrowtrackprogress">
                <div class="trackprogress-leftsection">
                    <p style="font-weight:600;font-size:18px;color:rgba(0, 0, 0, 1); padding:15px 0px 0px 24px">Loan
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
                    <p style="  
font-size: 18px;
font-weight: 600;
line-height: 27px;
color:rgba(0, 0, 0, 1); 
padding:15px 0px 0px 24px">
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
                                <i class="fa-regular fa-paper-plane"></i>
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

            <div class="studentdashboardprofile-personalinfo">
                <div class="personalinfo-firstrow">
                    <h1>My Profile</h1>
                    <button>Edit</button>
                </div>
                <ul class="personalinfo-secondrow">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                            style="margin-left: 6px;">HYU67994003</span> </li>
                    <li><i class="fa-regular fa-user"></i>
                        Harish M Kanol</li>
                    <li><i class="fa-solid fa-phone"></i>+91 76374 86793</li>
                    <li>
                        <i class="fa-regular fa-envelope"></i>kanolm@gmail.com
                    </li>
                    <li><i class="fa-solid fa-location-dot"></i>234, Sweet Life Apt., Cross Rd, Indranagar,
                        Bengaluru,
                        Karnataka 560982</li>


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
                        <p>Profile Complete</p>

                    </div>
                    <div class="profilestatus-graph-secondsection">
                        <div class="profilestatus-noofdocuments-section">
                            <p>07</p>
                            <span>/13</span>
                        </div>
                        <p class="secondsection-inside">Document Uploaded</p>




                    </div>
                </div>



            </div>
            <div class="studentdashboardprofile-communityjoinsection">
                <img src={{asset($discordIconPath)}}>
                <p> Join Community</p>
            </div>

        </div>
        <div class="studentdashboardprofile-myapplication">
            <div class="myapplication-firstcolumn">
                <h1>Course Details</h1>
                <button>Edit</button>

            </div>
            <div class="myapplication-secondcolumn">
                <p>1. Where are you planning to study</p>
                <input type="text" placeholder="Lorem ipsum dolor sit amet, ">
            </div>
            <div class="myapplication-thirdcolumn">
                <h6>2. Type of Degree?</h6>
                <div class="degreetypescheckboxes">
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="bachelors">
                        <span class="radio-button"></span>
                        <p> Bachelors (only secured loan)</p>
                    </label>
                    <br>
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="masters">
                        <span class="radio-button"></span>
                        <p> Masters</p>
                    </label>
                    <br>
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="others">
                        <span class="radio-button"></span>
                        <p>Others</p>
                    </label>
                </div>
                <input type="text" placeholder="Lorem ipsum dolor sit amet, ">
            </div>
            <div class="myapplication-fourthcolumn">
                <p>3. What is the Loan amount required?</p>
                <input type="text" placeholder="Lorem ipsum dolor sit amet, ">

            </div>
            <div class="myapplication-fifthcolumn">
                <p>Referral Code</p>
                <input type="text" placeholder="BHGSYF7684">

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
        @endsection




        <script>
            document.addEventListener('DOMContentLoaded', function () {
                initializeSideBarTabs(); // Handles sidebar tab switching
                initializeIndividualCards(); // Handles individual card message button logic
                initializeKycDocumentUpload();   // Handles KYC document upload logic
                initializeMarksheetUpload(); // Handles marksheet document upload logic
                initializeProgressRing();// Handles progress ring logic
            });

            const initializeSideBarTabs = () => {
                const sideBarTopItems = document.querySelectorAll('.studentdashboardprofile-sidebarlists-top li');
                const lastTabHiddenDiv = document.querySelector(".studentdashboardprofile-trackprogress");
                const lastTabVisibleDiv = document.querySelector(".studentdashboardprofile-myapplication");
                const dynamicHeader = document.getElementById('loanproposals-header');
                const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');

                sideBarTopItems.forEach((item, index) => {
                    item.addEventListener('click', () => {
                        sideBarTopItems.forEach(i => i.classList.remove('active'));
                        item.classList.add('active');

                        if (index === 1) {
                            lastTabHiddenDiv.style.display = "flex";
                            lastTabVisibleDiv.style.display = "none";
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
                        }
                    });
                });
            };

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
                    card.querySelector('.inputfilecontainer').addEventListener('click', function () {
                        card.querySelector('#inputfilecontainer-real').click();
                    });
                });

                individualKycDocumentsUpload.forEach((card) => {
                    card.querySelector('#inputfilecontainer-real').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        if (file) {
                            card.querySelector('.inputfilecontainer p').textContent = file.name;
                            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                            const filesizeviewer = card.querySelector('.document-status');
                            filesizeviewer.textContent = `${fileSizeMB} MB Uploaded`;
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

        </script>

</body>

</html>