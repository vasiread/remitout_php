<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Course Details</title>

    <link rel="stylesheet" href="assets/css/nbfc.css">
       <link rel="stylesheet" href="assets/css/adminstudapplication.css">
  
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


<div class="admin-studnet-application-main-container">

     <div class="nbfc-studentdashboardprofile-profile-section-container" id="nbfc-studentdashboardprofile-profile-section-container-id">
            <div class="nbfc-student-dashboard-section-main-contents" id="nbfc-student-dashboard-section-main-contents-id">
                <div class="studentdashboardprofile-profilesection" id="admin-studentdashboardprofile-profilesection">

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

                <div class="studentdashboardprofile-myapplication" id="admin-studentdashboardprofile-myapplication-id">
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

</div>    
   



</body>

</html>