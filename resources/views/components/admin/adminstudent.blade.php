<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="{{ asset('js/adminsidebar.js') }}"></script>
    <script src="{{ asset('js/studentforms.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/studentformquestionair.css') }}">
</head>

<body>
    @extends('layouts.app');

    @php
$profileIconPath = "assets/images/Icons/account_circle.png";
$phoneIconPath = "assets/images/call.png";
$mailIconPath = "assets/images/mail.png";
$pindropIconPath = "assets/images/pin_drop.png";
     @endphp

    <div class="student-listcontainer" id="student-admin-section-id">
        <div class="globallistcontainer-header" id="studentlistcontainer-headersection">
            <h2>Student List</h2>
            <h3 id="student-list-count">{{ count($userDetails) }}</h3>

            <div class="headersection-rightsidecontent">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container">
                    <input type="text" id="search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="student-list-dropdown-filters" id="student-list-dropdown-filters">
                    <button class="student-list-dropdown-button">
                        <img src="{{ asset('assets/images/Icons/filter_icon.png') }}" alt="">
                        All
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="student-list-dropdown-content" style="display: none;">
                        <a href="#" data-filter="all">All</a>
                        <a href="#" data-filter="pending">Pending</a>
                        <a href="#" data-filter="approved">Approved</a>
                    </div>
                </div>
                <button class="studentlist-add-button">Add</button>
            </div>
        </div>

        <div class="scdashboard-studentapplication" id="studentapplicationfromadminstudent">
            @foreach ($userDetails as $users)
                <div class="studentapplication-lists" data-status="{{ $users->status ?? 'Pending' }}">
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>{{ $users->name }}</h1>
                            <p id="hidden-id-elementforaccess" style="display:none">{{ $users->unique_id }}</p>
                            <div class="application-buttoncontainer">
                                <button id="view-student-profile-trigger">View</button>
                                <button id="edit-student-profile-trigger">Edit</button>
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
                            <span>{{ $users->status ?? 'Pending' }}</span>
                        </li>
                        <li class="scdashboard-missingdocumentsstatus">
                            <p>Missing Documents:</p>
                            <span class="missing-document-count">03</span>
                        </li>
                    </ul>
                    <div class="studentapplication-lists-remainingdocuments" style="display:none">
                        <div class="document-container">
                            <!-- PAN Card -->
                            <div class="document-box" id="pan-card-admin-view-{{ $users->user_id }}" style="display:none">
                                <div class="document-name" id="pan-card-document-name-{{ $users->user_id }}"
                                    style="display: none;">PAN Card</div>
                                <div class="upload-field">
                                    <span id="pan-card-name-{{ $users->user_id }}">PAN Card</span>
                                    <label for="pan-card-{{ $users->user_id }}" class="upload-icon"
                                        id="pan-card-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="pan-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'pan-card-name-{{ $users->user_id }}', 'pan-card-upload-icon-{{ $users->user_id }}', 'pan-card-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="pan-card-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display: none;"
                                        onclick="removeFile('pan-card-{{ $users->user_id }}', 'pan-card-name-{{ $users->user_id }}', 'pan-card-upload-icon-{{ $users->user_id }}', 'pan-card-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="pan-help-{{ $users->user_id }}">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container pan-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Aadhar Card -->
                            <div class="document-box" id="aadhar-card-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="aadhar-card-document-name-{{ $users->user_id }}"
                                    style="display: none;">Aadhar Card</div>
                                <div class="upload-field">
                                    <span id="aadhar-card-name-{{ $users->user_id }}">Aadhar Card</span>
                                    <label for="aadhar-card-{{ $users->user_id }}" class="upload-icon"
                                        id="aadhar-card-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="aadhar-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'aadhar-card-name-{{ $users->user_id }}', 'aadhar-card-upload-icon-{{ $users->user_id }}', 'aadhar-card-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="aadhar-card-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display: none;"
                                        onclick="removeFile('aadhar-card-{{ $users->user_id }}', 'aadhar-card-name-{{ $users->user_id }}', 'aadhar-card-upload-icon-{{ $users->user_id }}', 'aadhar-card-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="aadhar-help-{{ $users->user_id }}">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container aadhar-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Passport -->
                            <div class="document-box" id="passport-admin-view-{{ $users->user_id }}" style="display:none">
                                <div class="document-name" id="passport-document-name-{{ $users->user_id }}"
                                    style="display: none;">Passport</div>
                                <div class="upload-field">
                                    <span id="passport-name-{{ $users->user_id }}">Passport</span>
                                    <label for="passport-{{ $users->user_id }}" class="upload-icon"
                                        id="passport-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="passport-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'passport-name-{{ $users->user_id }}', 'passport-upload-icon-{{ $users->user_id }}', 'passport-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="passport-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display: none;"
                                        onclick="removeFile('passport-{{ $users->user_id }}', 'passport-name-{{ $users->user_id }}', 'passport-upload-icon-{{ $users->user_id }}', 'passport-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="passport-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container passport-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="document-container">
                            <!-- 10th Grade Mark Sheet -->
                            <div class="document-box" id="sslc-grade-marksheet-adminview-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="10th-mark-sheet-id" style="display: none;">10th Mark Sheet
                                </div>
                                <div class="upload-field">
                                    <span id="tenth-grade-name-{{ $users->user_id }}">10th Grade Mark Sheet</span>
                                    <label for="tenth-grade-{{ $users->user_id }}" class="upload-icon"
                                        id="tenth-grade-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="tenth-grade-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'tenth-grade-name-{{ $users->user_id }}', 'tenth-grade-upload-icon-{{ $users->user_id }}', 'tenth-grade-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="tenth-grade-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('tenth-grade-{{ $users->user_id }}', 'tenth-grade-name-{{ $users->user_id }}', 'tenth-grade-upload-icon-{{ $users->user_id }}', 'tenth-grade-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-marksheet-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-marksheet-help-{{ $users->user_id }}"
                                    style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- 12th Grade Mark Sheet -->
                            <div class="document-box" id="hsc-grade-marksheet-adminview-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="12th-mark-sheet-id" style="display: none;">12th Mark Sheet
                                </div>
                                <div class="upload-field">
                                    <span id="twelfth-grade-name-{{ $users->user_id }}">12th Grade Mark Sheet</span>
                                    <label for="twelfth-grade-{{ $users->user_id }}" class="upload-icon"
                                        id="twelfth-grade-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="twelfth-grade-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'twelfth-grade-name-{{ $users->user_id }}', 'twelfth-grade-upload-icon-{{ $users->user_id }}', 'twelfth-grade-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="twelfth-grade-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('twelfth-grade-{{ $users->user_id }}', 'twelfth-grade-name-{{ $users->user_id }}', 'twelfth-grade-upload-icon-{{ $users->user_id }}', 'twelfth-grade-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="twelfth-marksheet-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container twelfth-marksheet-help-{{ $users->user_id }}"
                                    id="twelfth-grade-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Graduation Mark Sheet -->
                            <div class="document-box" id="degree-grade-marksheet-adminview-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="graduation-mark-sheet-id" style="display: none;">Graduation
                                    Mark Sheet</div>
                                <div class="upload-field">
                                    <span id="graduation-grade-name-{{ $users->user_id }}">Graduation Mark Sheet</span>
                                    <label for="graduation-grade-{{ $users->user_id }}" class="upload-icon"
                                        id="graduation-grade-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="graduation-grade-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'graduation-grade-name-{{ $users->user_id }}', 'graduation-grade-upload-icon-{{ $users->user_id }}', 'graduation-grade-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="graduation-grade-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('graduation-grade-{{ $users->user_id }}', 'graduation-grade-name-{{ $users->user_id }}', 'graduation-grade-upload-icon-{{ $users->user_id }}', 'graduation-grade-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger"
                                        data-target="graduation-marksheet-help-{{ $users->user_id }}">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container graduation-marksheet-help-{{ $users->user_id }}"
                                    id="graduation-grade-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="document-container">
                            <!-- 10th Grade -->
                            <div class="document-box" id="sslc-grade-adminview-{{ $users->user_id }}" style="display:none">
                                <div class="document-name" id="10th-grades-id-{{ $users->user_id }}" style="display: none;">
                                    10th Grade</div>
                                <div class="upload-field">
                                    <span id="secured-tenth-name-{{ $users->user_id }}">10th Grade</span>
                                    <label for="secured-tenth-{{ $users->user_id }}" class="upload-icon"
                                        id="secured-tenth-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-tenth-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-tenth-name-{{ $users->user_id }}', 'secured-tenth-upload-icon-{{ $users->user_id }}', 'secured-tenth-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="secured-tenth-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('secured-tenth-{{ $users->user_id }}', 'secured-tenth-name-{{ $users->user_id }}', 'secured-tenth-upload-icon-{{ $users->user_id }}', 'secured-tenth-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="tenth-grade-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-grade-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- 12th Grade -->
                            <div class="document-box" id="hsc-grade-adminview-{{ $users->user_id }}" style="display:none">
                                <div class="document-name" id="12th-grade-id-{{ $users->user_id }}" style="display: none;">
                                    12th Grade</div>
                                <div class="upload-field">
                                    <span id="secured-twelfth-name-{{ $users->user_id }}">12th Grade</span>
                                    <label for="secured-twelfth-{{ $users->user_id }}" class="upload-icon"
                                        id="secured-twelfth-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-twelfth-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-twelfth-name-{{ $users->user_id }}', 'secured-twelfth-upload-icon-{{ $users->user_id }}', 'secured-twelfth-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="secured-twelfth-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('secured-twelfth-{{ $users->user_id }}', 'secured-twelfth-name-{{ $users->user_id }}', 'secured-twelfth-upload-icon-{{ $users->user_id }}', 'secured-twelfth-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="twelfth-grade-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container twelfth-grade-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Graduation -->
                            <div class="document-box" id="graduation-grade-adminview-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="graduation-id-{{ $users->user_id }}" style="display: none;">
                                    Graduation</div>
                                <div class="upload-field">
                                    <span id="secured-graduation-name-{{ $users->user_id }}">Graduation</span>
                                    <label for="secured-graduation-{{ $users->user_id }}" class="upload-icon"
                                        id="secured-graduation-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-graduation-{{ $users->user_id }}"
                                        accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-graduation-name-{{ $users->user_id }}', 'secured-graduation-upload-icon-{{ $users->user_id }}', 'secured-graduation-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="secured-graduation-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('secured-graduation-{{ $users->user_id }}', 'secured-graduation-name-{{ $users->user_id }}', 'secured-graduation-upload-icon-{{ $users->user_id }}', 'secured-graduation-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="graduation-grade-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container graduation-grade-help-{{ $users->user_id }}"
                                    style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="document-container">
                            <!-- PAN Card -->
                            <div class="document-box" id="co-borrower-pan-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="pan-card-id-{{ $users->user_id }}" style="display: none;">PAN
                                    Card</div>
                                <div class="upload-field">
                                    <span id="co-pan-card-name-{{ $users->user_id }}">Coborrower PAN Card</span>
                                    <label for="co-pan-card-{{ $users->user_id }}" class="upload-icon"
                                        id="co-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-pan-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-pan-card-name-{{ $users->user_id }}', 'co-upload-icon-{{ $users->user_id }}', 'co-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="co-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('co-pan-card-{{ $users->user_id }}', 'co-pan-card-name-{{ $users->user_id }}', 'co-upload-icon-{{ $users->user_id }}', 'co-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="co-pan-help-{{ $users->user_id }}">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container co-pan-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Aadhar Card -->
                            <div class="document-box" id="co-borrower-aadhar-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="aadhar-card-id-{{ $users->user_id }}" style="display: none;">
                                    Aadhar Card</div>
                                <div class="upload-field">
                                    <span id="co-aadhar-card-name-{{ $users->user_id }}">Coborrower Aadhar Card</span>
                                    <label for="co-aadhar-card-{{ $users->user_id }}" class="upload-icon"
                                        id="co-aadhar-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-aadhar-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-aadhar-card-name-{{ $users->user_id }}', 'co-aadhar-upload-icon-{{ $users->user_id }}', 'co-aadhar-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="co-aadhar-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('co-aadhar-card-{{ $users->user_id }}', 'co-aadhar-card-name-{{ $users->user_id }}', 'co-aadhar-upload-icon-{{ $users->user_id }}', 'co-aadhar-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="co-aadhar-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container co-aadhar-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Passport (Address Proof) -->
                            <div class="document-box" id="co-borrower-address-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="address-proof-id-{{ $users->user_id }}"
                                    style="display: none;">Address Proof</div>
                                <div class="upload-field">
                                    <span id="co-addressproof-{{ $users->user_id }}">Coborrower Address Proof</span>
                                    <label for="co-passport-{{ $users->user_id }}" class="upload-icon"
                                        id="co-passport-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-passport-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-addressproof-{{ $users->user_id }}', 'co-passport-upload-icon-{{ $users->user_id }}', 'co-passport-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">
                                    <span id="co-passport-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('co-passport-{{ $users->user_id }}', 'co-addressproof-{{ $users->user_id }}', 'co-passport-upload-icon-{{ $users->user_id }}', 'co-passport-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="co-address-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container co-address-help-{{ $users->user_id }}" style="display: none;">
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


    <div id="studentprofile-section-adminsideview">
        <div class="studentdashboardprofile-profilesection">
            <img src="path/to/profile.jpg" class="profileImg" id="profile-photo-id" alt="">
            <i class="fa-regular fa-pen-to-square"></i>
            <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data">

            <div class="studentdashboardprofile-personalinfo">
                <div class="personalinfo-firstrow">
                    <h1>Student Profile</h1>
                </div>

                <ul class="personalinfo-secondrow">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span class="personal_info_id"
                            style="margin-left: 6px;">ABC123456</span></li>
                    <li class="personal_info_name" id="referenceNameId">
                        <img src="{{$profileIconPath}}" alt="">
                        <p>John Doe</p>
                    </li>
                    <li class="personal_info_phone">
                        <img src="{{$phoneIconPath}}" alt="">
                        <p>+91 9876543210</p>
                    </li>
                    <li class="personal_info_email" id="referenceEmailId">
                        <img src="{{$mailIconPath}}" alt="">
                        <p title="john@example.com">john@example.com</p>
                    </li>
                    <li class="personal_info_state">
                        <img src="{{$pindropIconPath}}" alt="">
                        <p id="personal_state_id">Maharashtra</p>
                    </li>
                </ul>

                <ul class="personalinfosecondrow-editsection">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                            style="margin-left: 6px;">ABC123456</span></li>
                    <li class="personal_info_name">
                        <p>Name</p>
                        <input type="text" value="">
                    </li>
                    <li class="personal_info_phone">
                        <p>Phone</p>
                        <input type="text" value="" disabled>
                    </li>
                    <li class="personal_info_email">
                        <p>Email</p>
                        <input type="email" value="" disabled>
                    </li>
                    <li class="personal_info_state">
                        <p>State</p>
                        <input type="text" value="">
                    </li>
                </ul>
            </div>

            <div class="studentdashboardprofile-educationeditsection">
                <div class="educationeditsection-firstrow">
                    <h1>Education</h1>
                </div>

                <!-- Display section -->
                <div class="educationeditsection-secondrow" style="display:flex">
                    <p>1. Bachelor's Degree in Computer Science</p>
                    <p>2. Master's Degree in AI</p>
                </div>

                <!-- Edit inputs -->
                <div class="educationeditsection-secondrow-edit">
                    <input type="text" class="inputs-adminsidestudentprofile"
                        value="Bachelor's Degree in Computer Science" />
                    <input type="text" class="inputs-adminsidestudentprofile" value="Master's Degree in AI" />
                </div>
            </div>


            <div class="studentdashboardprofile-testscoreseditsection">
                <div class="testscoreseditsection-firstrow">
                    <h1>Test Scores</h1>
                </div>
                <div class="testscoreseditsection-secondrow">
                    <p>1. IELTS <span class="ilets_score">7.5</span></p>
                    <p>2. GRE <span class="gre_score">320</span></p>
                    <p>3. TOEFL <span class="tofel_score">110</span></p>
                    <div id="other-exams-container" class="other-exams-section">
                        <!-- Dynamically filled by JS -->
                    </div>
                </div>

                <div class="testscoreseditsection-secondrow-editsection">
                    <p>ILETS</p>
                    <input type="text" class="ilets_score" value="">
                    <p>GRE</p>
                    <input type="text" class="gre_score" value="">
                    <p>TOFEL</p>
                    <input type="text" class="tofel_score" value="">
                </div>
            </div>
        </div>

        <div class="studentdashboardprofile-myapplication" id="course-details-container" data-course-details=''
            data-personal-details=''>
            <div class="myapplication-firstcolumn">
                <h1>Course Details</h1>
                <div class="personalinfo-firstrow">
                    <button onClick="triggerEditButton()">Edit</button>
                    <button class="saved-msg">Saved</button>
                </div>
            </div>

            <div class="myapplication-secondcolumn">
                <p>1. Where are you planning to study</p>
                <input type="text" id="plan-to-study-edit" disabled>
                <div class="checkbox-group-edit" id="selected-study-location-edit">
                    <label><input type="checkbox" name="study-location-edit" value="USA" disabled> USA</label>
                    <label><input type="checkbox" name="study-location-edit" value="UK" disabled> UK</label>
                    <label><input type="checkbox" name="study-location-edit" value="Ireland" disabled> Ireland</label>
                    <label><input type="checkbox" name="study-location-edit" value="New Zealand" disabled> New
                        Zealand</label>
                    <label><input type="checkbox" name="study-location-edit" value="Germany" disabled> Germany</label>
                    <label><input type="checkbox" name="study-location-edit" value="France" disabled> France</label>
                    <label><input type="checkbox" name="study-location-edit" value="Sweden" disabled> Sweden</label>
                    <label><input type="checkbox" name="study-location-edit" value="Other" id="other-checkbox-edit"
                            disabled> Other</label>
                    <label>
                        <div class="add-country-box-edit">
                            <input type="text" id="country-edit" class="custom-country-edit" placeholder="Add Country">
                        </div>
                    </label>
                    <label><input type="checkbox" name="study-location-edit" value="Italy" disabled> Italy</label>
                    <label><input type="checkbox" name="study-location-edit" value="Canada" disabled> Canada</label>
                    <label><input type="checkbox" name="study-location-edit" value="Australia" disabled>
                        Australia</label>
                </div>
            </div>

            <div class="myapplication-thirdcolumn">
                <h6>2. Type of Degree?</h6>
                <div class="degreetypescheckboxes">
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Bachelors"
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Bachelors (only secured loan)</p>
                    </label>
                    <br>
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Masters"
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Masters</p>
                    </label>
                    <br>
                    <label class="custom-radio">
                        <input type="radio" name="education-level" value="Others"
                            onclick="toggleOtherDegreeInput(event)" disabled>
                        <span class="radio-button"></span>
                        <p>Others</p>
                    </label>
                </div>

                <input type="text" placeholder="Enter degree type" value="" id="otherDegreeInput" disabled>
            </div>

            <div class="myapplication-fourthcolumn-additional">
                <p>3. What is the duration of the course?</p>
                <input type="text" placeholder="Course Duration" value="" disabled>
            </div>

            <div class="myapplication-fourthcolumn">
                <p>4. What is the Loan amount required?</p>
                <input type="number" placeholder="Loan Amount" value="" disabled>
            </div>

            <div class="myapplication-fifthcolumn">
                <p>Referral Code</p>
                <input type="text" placeholder="Referral Code" value="" disabled>
            </div>

            <div class="myapplication-sixthcolumn">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <div class="savecancelbuttoncontainer">
                <button id="save-student-details-adminside"> Save </button>
                <button id="cancel-student-details-adminside"> Cancel</button>

            </div>


        </div>

    </div>









    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // initialisedocumentsCount();
            expandingStudentDetails();
            initializeSearchAndFilter();

            viewStudentProfile();
            viewStudentEditProfile();
        });

        const applicationStatusElements = document.querySelectorAll(".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
        const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

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
            const expandButton = document.querySelectorAll(".individualapplication-list .application-buttoncontainer .expand-arrow");
            const documentsStatusBar = document.querySelectorAll(".studentapplication-lists-remainingdocuments");
            const studentId = document.querySelectorAll(".studentapplication-lists .firstsection-lists #hidden-id-elementforaccess");

            let previousUserId = null;

            for (let [index, item] of expandButton.entries()) {
                item.addEventListener('click', async () => {
                    if (listContainer[index] && documentsStatusBar[index] && studentId[index]) {
                        const isExpanded = listContainer[index].style.height === "fit-content";

                        // Toggle height and visibility
                        listContainer[index].style.height = isExpanded ? "140px" : "fit-content";
                        documentsStatusBar[index].style.display = isExpanded ? "none" : "block";

                        // Toggle rotation
                        item.style.transform = isExpanded ? "rotate(0deg)" : "rotate(180deg)";
                        item.style.transition = "transform 0.2s ease";

                        const userId = studentId[index].textContent.trim();
                        console.log(`Clicked student ${index}, userId: ${userId}`);

                        if (!isExpanded && userId && userId !== previousUserId) {
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

            const documentIds = {
                "pan-card-name/": `pan-card-admin-view-${userId}`,
                "aadhar-card-name/": `aadhar-card-admin-view-${userId}`,
                "passport-name/": `passport-admin-view-${userId}`,
                "secured-tenth-name/": `sslc-grade-adminview-${userId}`,
                "secured-twelfth-name/": `hsc-grade-adminview-${userId}`,
                "secured-graduation-name/": `graduation-grade-adminview-${userId}`,
                "tenth-grade-name/": `sslc-grade-marksheet-adminview-${userId}`,
                "twelfth-grade-name/": `hsc-grade-marksheet-adminview-${userId}`,
                "graduation-grade-name/": `degree-grade-marksheet-adminview-${userId}`,
                "co-pan-card-name/": `co-borrower-pan-admin-view-${userId}`,
                "co-aadhar-card-name/": `co-borrower-aadhar-admin-view-${userId}`,
                "co-addressproof/": `co-borrower-address-admin-view-${userId}`
            };

            console.log(`Fetching remaining documents for userId: ${userId}`);

            try {
                const response = await fetch("/remaining-documents", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ userId })
                });

                const data = await response.json();

                if (response.ok && data.message === "Documents count retrieved successfully") {
                    const missingDocuments = data.missingDocuments;
                    console.log("Missing Documents:", missingDocuments);

                    missingDocuments.forEach((missingDocument) => {
                        const elementId = documentIds[missingDocument];
                        if (elementId) {
                            console.log(`Displaying missing document: ${missingDocument}`);
                            const documentElement = document.getElementById(elementId);
                            if (documentElement) {
                                alert(documentElement)
                                documentElement.style.display = "flex";
                            } else {
                                console.warn(`Element not found: ${elementId}`);
                            }
                        } else {
                            console.warn(`Unknown document type: ${missingDocument}`);
                        }
                    });
                } else {
                    console.error("Error retrieving missing documents");
                }
            } catch (error) {
                console.error("Fetch Error: ", error);
            }
        };

        const initializeSearchAndFilter = () => {
            const searchInput = document.getElementById('search-student-list');
            const filterButton = document.querySelector('.student-list-dropdown-button');
            const filterContent = document.querySelector('.student-list-dropdown-content');
            const filterLinks = document.querySelectorAll('.student-list-dropdown-content a');
            const studentListItems = document.querySelectorAll('.studentapplication-lists');
            const studentCountElement = document.getElementById('student-list-count');

            // Toggle dropdown visibility on button click
            filterButton.addEventListener('click', () => {
                filterContent.style.display = filterContent.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (e) => {
                if (!filterButton.contains(e.target) && !filterContent.contains(e.target)) {
                    filterContent.style.display = 'none';
                }
            });

            // Search functionality (unchanged)
            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleCount = 0;

                studentListItems.forEach(item => {
                    const studentName = item.querySelector('.firstsection-lists h1').textContent.toLowerCase();
                    const matchesSearch = studentName.includes(searchTerm);
                    const currentFilter = document.querySelector('.student-list-dropdown-content a.active')?.dataset.filter || 'all';

                    const matchesFilter = currentFilter === 'all' ||
                        (currentFilter === 'pending' && item.dataset.status.toLowerCase() === 'pending') ||
                        (currentFilter === 'approved' && item.dataset.status.toLowerCase() === 'approved');

                    if (matchesSearch && matchesFilter) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                studentCountElement.textContent = visibleCount;
                studentCountElement.style.padding = "0px 10px 0px 10px";
                studentCountElement.style.borderRadius = "50%";
                studentCountElement.style.backgroundColor = "#E6EDFF";
                studentCountElement.style.color = "#0A49F3";
            });

            // Filter functionality
            filterLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    filterLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');

                    // Update button text to show selected filter
                    filterButton.childNodes.forEach(node => {
                        if (node.nodeType === Node.TEXT_NODE && node.textContent.trim()) {
                            node.textContent = link.textContent + ' ';
                        }
                    });

                    const filter = link.dataset.filter;
                    const searchTerm = searchInput.value.toLowerCase();
                    let visibleCount = 0;

                    studentListItems.forEach(item => {
                        const studentName = item.querySelector('.firstsection-lists h1').textContent.toLowerCase();
                        const matchesSearch = studentName.includes(searchTerm);
                        const matchesFilter = filter === 'all' ||
                            (filter === 'pending' && item.dataset.status.toLowerCase() === 'pending') ||
                            (filter === 'approved' && item.dataset.status.toLowerCase() === 'approved');

                        if (matchesSearch && matchesFilter) {
                            item.style.display = 'block';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    studentCountElement.textContent = visibleCount;
                    studentCountElement.style.padding = "0px 10px 0px 10px";
                    studentCountElement.style.borderRadius = "50%";
                    studentCountElement.style.backgroundColor = "#E6EDFF";
                    studentCountElement.style.color = "#0A49F3";
                    filterContent.style.display = 'none';
                });
            });

            document.querySelector('.student-list-dropdown-content a[data-filter="all"]').classList.add('active');
        };


        function viewStudentProfile() {
            const studentProfileContainerAdminSide = document.getElementById("studentprofile-section-adminsideview");
            const studentProfileTriggerAdminSide = document.querySelectorAll("#view-student-profile-trigger");
            const studentListContainer = document.getElementById("student-admin-section-id");
            const userIdElements = document.querySelectorAll("#hidden-id-elementforaccess");


            if (studentProfileTriggerAdminSide.length) {
                studentProfileTriggerAdminSide.forEach((item, index) => {
                    item.addEventListener('click', () => {
                        const uniqueId = userIdElements[index].textContent.trim();

                        fetch(`/getUserProfileAdminSide?unique_id=${uniqueId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.status) {
                                    const userProfile = data.data;

                                    document.getElementById("profile-photo-id").src = `path/to/profile_images/${userProfile.name}.jpg`;
                                    document.getElementById("referenceNameId").querySelector('p').textContent = userProfile.name || '';
                                    document.getElementById("referenceEmailId").querySelector('p').textContent = userProfile.email || '';
                                    document.querySelector('.personal_info_phone p').textContent = userProfile.phone || '';
                                    document.getElementById("personal_state_id").textContent = userProfile.state || '';
                                    document.querySelector('.personalinfosecondrow-editsection input[type="text"]').value = userProfile.name || '';
                                    document.querySelector('.personalinfosecondrow-editsection input[type="email"]').value = userProfile.email || '';
                                    document.querySelectorAll('.personalinfosecondrow-editsection input[type="text"]')[2].value = userProfile.state || '';
                                    document.querySelectorAll('.personalinfosecondrow-editsection input[type="text"]')[1].value = userProfile.phone || '';
                                    document.querySelector(".myapplication-fourthcolumn-additional input").value = userProfile.course_duration || '';
                                    document.querySelector(".myapplication-fourthcolumn input").value = userProfile.loan_amount || '';
                                    document.querySelector(".myapplication-fifthcolumn input").value = userProfile.referral_code || '';
                                    document.querySelectorAll(".educationeditsection-secondrow p")[0].textContent = userProfile.course_name || '';
                                    document.querySelectorAll(".educationeditsection-secondrow p")[1].textContent = userProfile.university_school_name || '';

                                    console.log(userProfile)


                                    let planToStudy = userProfile.plan_to_study;
                                    if (typeof planToStudy === 'string') {
                                        try {
                                            planToStudy = JSON.parse(planToStudy);
                                        } catch (err) {
                                            console.warn('Invalid JSON in plan_to_study:', planToStudy);
                                            planToStudy = [planToStudy];
                                        }
                                    }
                                    const planToStudyArray = Array.isArray(planToStudy) ? planToStudy : [planToStudy];
                                    document.getElementById("plan-to-study-edit").value = planToStudyArray.join(', ');


                                    const checkboxes = document.querySelectorAll('input[name="study-location-edit"]');
                                    checkboxes.forEach(cb => {
                                        cb.checked = planToStudyArray.includes(cb.value);
                                    });


                                    const degreeType = (userProfile.degree_type || '').toLowerCase();
                                    const radios = document.querySelectorAll('input[name="education-level"]');
                                    radios.forEach(rb => {
                                        rb.checked = rb.value.toLowerCase() === degreeType;
                                    });


                                    const testScores = userProfile.test_scores || {};
                                    document.querySelector('input.ilets_score').value = testScores.ILETS || '';
                                    document.querySelector('input.gre_score').value = testScores.GRE || '';
                                    document.querySelector('input.tofel_score').value = testScores.TOFEL || '';

                                    document.querySelector('span.ilets_score').textContent = testScores.ILETS || 'N/A';
                                    document.querySelector('span.gre_score').textContent = testScores.GRE || 'N/A';
                                    document.querySelector('span.tofel_score').textContent = testScores.TOFEL || 'N/A';

                                    const otherExamsContainer = document.getElementById('other-exams-container');
                                    if (userProfile.test_scores.Others && Array.isArray(userProfile.test_scores.Others)) {
                                        userProfile.test_scores.Others.forEach(exam => {
                                            const examDiv = document.createElement('div');
                                            examDiv.classList.add('other-exam-entry');
                                            examDiv.innerHTML = `
                                                <p class="exam-name">${exam.otherExamName || 'N/A'}</p>
                                                <p class="exam-score">${exam.otherExamScore || 'N/A'}</p>
                                            `;
                                            otherExamsContainer.appendChild(examDiv);
                                        });
                                    }


                                    document.getElementById("course-details-container").setAttribute('data-course-details', JSON.stringify({
                                        planToStudy: planToStudyArray,
                                        degreeType: userProfile.degree_type,
                                        courseDuration: userProfile.course_duration,
                                        loanAmount: userProfile.loan_amount
                                    }));

                                    if (studentProfileContainerAdminSide && studentListContainer) {
                                        studentProfileContainerAdminSide.style.display = "flex";
                                        studentListContainer.style.display = "none";
                                    }

                                } else {
                                    console.error('Failed to fetch user profile:', data.message);
                                }
                            })
                            .catch(err => {
                                console.error('Error fetching profile data:', err);
                            });
                    });
                });
            }
        }


        function viewStudentEditProfile() {
            const studentProfileContainerAdminSide = document.getElementById("studentprofile-section-adminsideview");
            const studentProfileEditTriggerAdminSide = document.querySelectorAll("#edit-student-profile-trigger");
            const editProfileView = document.querySelector(".personalinfosecondrow-editsection");
            const studentListContainer = document.getElementById("student-admin-section-id");
            const userIdElements = document.querySelectorAll("#hidden-id-elementforaccess");


            if (studentProfileEditTriggerAdminSide) {
                studentProfileEditTriggerAdminSide.forEach((item, index) => {
                    item.addEventListener('click', () => {
                        if (studentListContainer && studentProfileContainerAdminSide && editProfileView) {
                            studentListContainer.style.display = "none";
                            studentProfileContainerAdminSide.style.display = "flex";
                            editProfileView.style.display = "flex"


                            const saveDetailsTrigger = document.getElementById("save-student-details-adminside");
                            if (saveDetailsTrigger) {
                                saveDetailsTrigger.addEventListener('click', () => {
                                    saveStudentDetails(userIdElements[index].textContent);

                                })
                            }


                        }
                    });
                });
            }


            function saveStudentDetails(userId) {
                 const name = document.querySelector('.personalinfosecondrow-editsection input[type="text"]').value;
                const email = document.querySelector('.personalinfosecondrow-editsection input[type="email"]').value;
                const state = document.querySelectorAll('.personalinfosecondrow-editsection input[type="text"]')[2].value;
                const phone = document.querySelectorAll('.personalinfosecondrow-editsection input[type="text"]')[1].value;

                fetch('/update-personal-info-adminside', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        name,
                        email,
                        state,
                        phone
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        alert("User Details Changes Saved")
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }













        } </script>
</body>

</html>