<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="{{ asset('js/adminsidebar.js') }}"></script>
<script src="{{ asset('js/studentforms.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/studentformquestionair.css') }}">

<body>
    @extends('layouts.app');

    <div class="student-listcontainer">
        <div class="globallistcontainer-header" id="studentlistcontainer-headersection">
            <h2>Student List</h2>
            <h3 id="student-list-count">{{ count($userDetails) }}</h3>

            <div class="headersection-rightsidecontent">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container">
                    <input type="text" id="search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="dropdown-filters" id="studentlistcontainer-filters">
                    <button class="dropdown-button-filters">
                        <img src="{{ asset('assets/images/Icons/filter_icon.png') }}" alt="">
                        Filters
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content-filters">
                        <a href="#">Option 1</a>
                        <a href="#">Option 2</a>
                        <a href="#">Option 3</a>
                    </div>
                </div>
                <button class="studentlist-add-button">Add</button>
            </div>
        </div>

        <div class="scdashboard-studentapplication" id="studentapplicationfromadminstudent">
            @foreach ($userDetails as $users)
                <div class="studentapplication-lists">
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>{{ $users->user_name }}</h1>
                            <p id="hidden-id-elementforaccess" style="display:none">{{ $users->user_id }}</p>
                            <div class="application-buttoncontainer">
                                <button>View</button>
                                <button>Edit</button>
                                <button class="expand-arrow"> <img src="{{ asset('assets/images/stat_minus_1.png') }}"
                                        alt=""></button>
                            </div>
                            <button class="studenteacheditbutton">Edit</button>
                        </div>
                    </div>
                    <ul class="individualstudentapplication-status">
                        <li class="scdashboard-nbfcnamecontainer">
                            <p>NBFC:</p>
                            <p>{{ $users->nbfc_name }} </p>
                        </li>
                        <li class="scdashboard-nbfcstatus-pending">
                            <p>Status:</p>
                            <span>Pending</span>
                        </li>
                        <li class="scdashboard-missingdocumentsstatus">
                            <p>Missing Documents:</p>
                            <span class="missing-document-count">03</span>
                        </li>
                    </ul>
                    <div class="studentapplication-lists-remainingdocuments" style="display:none">
                        <div class="document-container">

                            <div class="document-box" id="pan-card-admin-view" style="display:none">
                                <div class="document-name" id="pan-card-document-name" style="display: none;">PAN Card</div>
                                <div class="upload-field">

                                    <span id="pan-card-name">PAN Card</span>
                                    <label for="pan-card" class="upload-icon" id="pan-card-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" style="display:none">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="pan-card" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'pan-card-name', 'pan-card-upload-icon', 'pan-card-remove-icon','<?= $users->user_id ?>')">
                                    <span id="pan-card-remove-icon" class="remove-icon" style="display: none;"
                                        onclick="removeFile('pan-card', 'pan-card-name', 'pan-card-upload-icon', 'pan-card-remove-icon'),'<?= $users->user_id ?>'">✖</span>

                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Aadhar Card -->
                            <div class="document-box" id="aadhar-card-admin-view" style="display:none">
                                <div class="document-name" id="aadhar-card-document-name" style="display: none;">Aadhar Card
                                </div>
                                <div class="upload-field">
                                    <span id="aadhar-card-name">Aadhar Card</span>
                                    <label for="aadhar-card" class="upload-icon" id="aadhar-card-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="aadhar-card" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon','<?= $users->user_id ?>')">
                                    <span id="aadhar-card-remove-icon" class="remove-icon" style="display: none;"
                                        onclick="removeFile('aadhar-card', 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon'),'<?= $users->user_id ?>'">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Passport -->
                            <div class="document-box" id="passport-admin-view" style="display:none">
                                <div class="document-name" id="passport-document-name" style="display: none;">Passport</div>
                                <div class="upload-field">
                                    <span id="passport-name">Passport</span>
                                    <label for="passport" class="upload-icon" id="passport-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="passport" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'passport-name', 'passport-upload-icon', 'passport-remove-icon','<?= $users->user_id ?>')">
                                    <span id="passport-remove-icon" class="remove-icon" style="display: none;"
                                        onclick="removeFile('passport', 'passport-name', 'passport-upload-icon', 'passport-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="document-container">

                            <!-- 10th Grade Mark Sheet -->
                            <div class="document-box" id="sslc-grade-marksheet-adminview" style="display:none">

                                <div class="document-name" id="10th-mark-sheet-id" style="display: none;">10th Mark Sheet
                                </div>
                                <div class="upload-field">
                                    <span id="tenth-grade-name">10th Grade Mark Sheet</span>
                                    <label for="tenth-grade" class="upload-icon" id="tenth-grade-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="tenth-grade" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon','<?= $users->user_id ?>')">
                                    <span id="tenth-grade-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('tenth-grade', 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- 12th Grade Mark Sheet -->
                            <div class="document-box" id="hsc-grade-marksheet-adminview" style="display:none">
                                <div class="document-name" id="12th-mark-sheet-id" style="display: none;">12th Mark Sheet
                                </div>
                                <div class="upload-field">
                                    <span id="twelfth-grade-name">12th Grade Mark Sheet</span>
                                    <label for="twelfth-grade" class="upload-icon" id="twelfth-grade-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="twelfth-grade" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon','<?= $users->user_id ?>')">
                                    <span id="twelfth-grade-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('twelfth-grade', 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <div class="document-box" id="degree-grade-marksheet-adminview" style="display: none;">
                                <div class="document-name" id="graduation-mark-sheet-id" style="display: none;">Graduation
                                    Mark
                                    Sheet</div>
                                <div class="upload-field">
                                    <span id="graduation-grade-name">Graduation Mark Sheet</span>
                                    <label for="graduation-grade" class="upload-icon" id="graduation-grade-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="graduation-grade" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon','<?= $users->user_id ?>')">
                                    <span id="graduation-grade-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('graduation-grade', 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="document-container">
                            <!-- 10th Grade -->
                            <div class="document-box" id="sslc-grade-adminview" style="display:none">
                                <div class="document-name" id="10th-grades-id" style="display: none;">10th Grade</div>
                                <div class="upload-field">
                                    <span id="secured-tenth-name">10th Grade</span>
                                    <label for="secured-tenth" class="upload-icon" id="secured-tenth-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-tenth" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon','<?= $users->user_id ?>')">
                                    <span id="secured-tenth-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('secured-tenth', 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- 12th Grade -->
                            <div class="document-box" id="hsc-grade-adminview" style="display:none">
                                <div class="document-name" id="12th-grade-id" style="display: none;">12th Grade</div>
                                <div class="upload-field">
                                    <span id="secured-twelfth-name">12th Grade</span>
                                    <label for="secured-twelfth" class="upload-icon" id="secured-twelfth-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-twelfth" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon','<?= $users->user_id ?>')">
                                    <span id="secured-twelfth-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('secured-twelfth', 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Graduation -->
                            <div class="document-box" id="graduation-grade-adminview" style="display:none">
                                <div class="document-name" id="Graduation-id" style="display: none;">Graduation</div>
                                <div class="upload-field">
                                    <span id="secured-graduation-name">Graduation</span>
                                    <label for="secured-graduation" class="upload-icon" id="secured-graduation-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-graduation" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon','<?= $users->user_id ?>')">
                                    <span id="secured-graduation-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('secured-graduation', 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="document-container">

                            <!-- PAN Card -->
                            <div class="document-box" id="co-borrower-pan-admin-view" style="display:none">
                                <div class="document-name" id="pan-card-ids" style="display: none;">PAN Card</div>
                                <div class="upload-field">
                                    <span id="co-pan-card-name">Coborrower PAN Card</span>
                                    <label for="co-pan-card" class="upload-icon" id="co-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-pan-card" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon','<?= $users->user_id ?>')">
                                    <span id="co-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('co-pan-card', 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Aadhar Card -->
                            <div class="document-box" id="co-borrower-aadhar-admin-view" style="display:none">
                                <div class="document-name" id="aadhar-card-id" style="display: none;">Aadhar Card</div>
                                <div class="upload-field">
                                    <span id="co-aadhar-card-name">Coborrower Aadhar Card</span>
                                    <label for="co-aadhar-card" class="upload-icon" id="co-aadhar-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-aadhar-card" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon','<?= $users->user_id ?>')">
                                    <span id="co-aadhar-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('co-aadhar-card', 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Passport (Address Proof) -->
                            <div class="document-box" id="co-borrower-address-admin-view" style="display:none">
                                <div class="document-name" id="address-proof-id" style="display: none;">Address Proof</div>
                                <div class="upload-field">
                                    <span id="co-addressproof">Coborrower Address Proof</span>
                                    <label for="co-passport" class="upload-icon" id="co-passport-upload-icon">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-passport" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon','<?= $users->user_id ?>')">
                                    <span id="co-passport-remove-icon" class="remove-icon" style="display:none;"
                                        onclick="removeFile('co-passport', 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon','<?= $users->user_id ?>')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>



            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initialisedocumentsCount();
            expandingStudentDetails();
            getRemainingDocuments();
        });

        const applicationStatusElements = document.querySelectorAll(".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
        const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

        // Update statuses and show/hide missing documents count
        applicationStatusElements.forEach((items, index) => {
            if (items.textContent.includes("Approved")) {
                items.style.color = "#3FA27E";
                items.style.backgroundColor = "#D2FFEE";

                if (missingDocumentsCount[index]) {
                    missingDocumentsCount[index].style.display = "none";
                }
            } else {
                if (missingDocumentsCount[index]) {
                    missingDocumentsCount[index].style.display = "flex";
                }
            }
        });

        const initialisedocumentsCount = () => {
            const userIdElements = document.querySelectorAll(".firstsection-lists #hidden-id-elementforaccess");
            const missingDocumentCountUpdateforeach = document.querySelectorAll(".scdashboard-missingdocumentsstatus .missing-document-count");

            if (userIdElements.length !== missingDocumentCountUpdateforeach.length) {
                console.error("Mismatch between the number of user IDs and missing document count elements.");
                return;
            }

            userIdElements.forEach((userElement, index) => {
                const userId = userElement.value || userElement.textContent;

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
                        console.log("API response for user:", userId, data);

                        let documentsCount = data.documentscount || 0;

                        const missingCountElement = missingDocumentCountUpdateforeach[index];

                        if (missingCountElement) {
                            if (documentsCount > 10) {
                                missingCountElement.textContent = "0" + (22 - documentsCount);
                            } else {
                                missingCountElement.textContent = (22 - documentsCount);
                            }
                        } else {
                            console.error('Missing document count element not found for index:', index);
                        }
                    })
                    .catch((error) => {
                        console.error("Error fetching documents count for user:", userId, error);
                    });
            });
        };

        const expandingStudentDetails = async () => {
            const listContainer = document.querySelectorAll(".studentapplication-lists");
            const viewButton = document.querySelectorAll(".individualapplication-list .application-buttoncontainer button:first-child");
            const documentsStatusBar = document.querySelectorAll(".studentapplication-lists-remainingdocuments");
            const studentId = document.querySelectorAll(".studentapplication-lists .firstsection-lists #hidden-id-elementforaccess");

            let previousUserId = "";
            for (let [index, item] of viewButton.entries()) {
                item.addEventListener('click', async () => {
                    if (listContainer[index] && documentsStatusBar[index] && studentId[index]) {
                        listContainer[index].style.height = listContainer[index].style.height === "fit-content" ? "140px" : "fit-content";
                        documentsStatusBar[index].style.display = documentsStatusBar[index].style.display === "block" ? "none" : "block";

                        const userId = studentId[index].textContent.trim();

                        if (userId && userId !== previousUserId) {
                            previousUserId = userId;
                            await getRemainingDocuments(userId);
                        } else {
                            console.log("Same userId detected or userId is empty, skipping fetch.");
                        }
                    }
                });
            }
        };
        const getRemainingDocuments = async (userId) => {
            const documentIds = [
                "pan-card-admin-view",
                "aadhar-card-admin-view",
                "passport-admin-view",
                "sslc-grade-marksheet-adminview",
                "hsc-grade-marksheet-adminview",
                "degree-grade-marksheet-adminview",
                "sslc-grade-adminview",
                "hsc-grade-adminview",
                "graduation-grade-adminview",
                "co-borrower-pan-admin-view",
                "co-borrower-aadhar-admin-view",
                "co-borrower-address-admin-view"
            ];

            console.log(userId);

            await fetch("/remaining-documents", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ userId })
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.message === "Documents count retrieved successfully") {
                        const missingDocuments = data.missingDocuments;


                        missingDocuments.forEach(missingDocument => {
                            if (missingDocument === "aadhar-card-name/") {
                                console.log("Missing: Aadhar Card");
                                document.getElementById("aadhar-card-admin-view").style.display = "flex";
                            }
                            if (missingDocument === "co-aadhar-card-name/") {
                                console.log("Missing: Co-borrower Aadhar Card");
                                document.getElementById("co-borrower-aadhar-admin-view").style.display = "flex";
                            }
                            if (missingDocument === "co-addressproof/") {
                                console.log("Missing: Co-borrower Address Proof");
                                document.getElementById("co-borrower-address-admin-view").style.display = "flex";
                            }
                            if (missingDocument === "co-pan-card-name/") {
                                console.log("Missing: Co-borrower PAN Card");
                                document.getElementById("co-borrower-pan-admin-view").style.display = "flex";
                            }
                            if (missingDocument === "graduation-grade-name/") {
                                console.log("Missing: Graduation Grade");
                                document.getElementById("graduation-grade-adminview").style.display = "flex";
                            }
                            if (missingDocument === "tenth-grade-name/") {
                                console.log("Missing: SSLC Grade");
                                document.getElementById("sslc-grade-adminview").style.display = "flex";
                            }
                            if (missingDocument === "twelfth-grade-name/") {
                                console.log("Missing: HSC Grade");
                                document.getElementById("hsc-grade-adminview").style.display = "flex";
                            }
                            if (missingDocument === "secured-graduation-name/") {
                                console.log("missing: Graduation secured");
                                document.getElementById("degree-grade-marksheet-adminview").style.display = "flex";
                            }
                            if (missingDocument === "secured-tenth-name/") {
                                console.log("missing: sslc secured");
                                document.getElementById("sslc-grade-marksheet-adminview").style.display = "flex";

                            }
                            if (missingDocument === "secured-twelfth-name/") {
                                console.log("missing: hsc secured")
                                document.getElementById("hsc-grade-marksheet-adminview").style.display = "flex";
                            }
                            if (missingDocument === 'pan-card-name/') {
                                console.log("Missing:Pan card missing")
                                document.getElementById("pan-card-admin-view").style.display = "flex"
                            }
                            if (missingDocument === 'passport-name/') {
                                console.log("missing: passport");
                                document.getElementById("passport-admin-view").style.display = "flex"


                            }
                        });



                    } else {
                        console.error("Error Retrieving Missing Documents");
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        };

    </script>
</body>

</html>