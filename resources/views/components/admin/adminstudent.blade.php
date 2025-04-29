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
                                    <span class="help-trigger" data-target="passport-help-{{ $users->user_id }}">ⓘ Help</span>
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
                                    <span class="help-trigger" data-target="tenth-marksheet-help-{{ $users->user_id }}">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container tenth-marksheet-help-{{ $users->user_id }}" style="display: none;">
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
                                    <span class="help-trigger" data-target="twelfth-marksheet-help-{{ $users->user_id }}">ⓘ Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container twelfth-marksheet-help-{{ $users->user_id }}" id="twelfth-grade-help-{{ $users->user_id }}"
                                    style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Graduation Mark Sheet -->
                            <div class="document-box" id="degree-grade-marksheet-adminview-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="graduation-mark-sheet-id" style="display: none;">Graduation Mark Sheet</div>
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
                                    <span class="help-trigger" data-target="graduation-marksheet-help-{{ $users->user_id }}">ⓘ Help</span>
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
                                <div class="document-name" id="10th-grades-id-{{ $users->user_id }}" style="display: none;">10th Grade</div>
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
                                    <span class="help-trigger" data-target="tenth-grade-help-{{ $users->user_id }}">ⓘ Help</span>
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
                                <div class="document-name" id="12th-grade-id-{{ $users->user_id }}" style="display: none;">12th Grade</div>
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
                                    <span class="help-trigger" data-target="twelfth-grade-help-{{ $users->user_id }}">ⓘ Help</span>
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
                                <div class="document-name" id="graduation-id-{{ $users->user_id }}" style="display: none;">Graduation</div>
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
                                    <span class="help-trigger" data-target="graduation-grade-help-{{ $users->user_id }}">ⓘ Help</span>
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
                                <div class="document-name" id="pan-card-id-{{ $users->user_id }}" style="display: none;">PAN Card</div>
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
                                <div class="document-name" id="aadhar-card-id-{{ $users->user_id }}" style="display: none;">Aadhar Card</div>
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
                                    <span class="help-trigger" data-target="co-aadhar-help-{{ $users->user_id }}">ⓘ Help</span>
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
                                    <span class="help-trigger" data-target="co-address-help-{{ $users->user_id }}">ⓘ Help</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initialisedocumentsCount();
            expandingStudentDetails();
            initializeSearchAndFilter();
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

            let previousUserId = null;
            for (let [index, item] of viewButton.entries()) {
                item.addEventListener('click', async () => {
                    if (listContainer[index] && documentsStatusBar[index] && studentId[index]) {
                        listContainer[index].style.height = listContainer[index].style.height === "fit-content" ? "140px" : "fit-content";
                        documentsStatusBar[index].style.display = documentsStatusBar[index].style.display === "block" ? "none" : "block";

                        const userId = studentId[index].textContent.trim();
                        console.log(`Clicked student ${index}, userId: ${userId}`);

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

            // Close dropdown when clicking outside
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

                    // Close dropdown after selection
                    filterContent.style.display = 'none';
                });
    });

    // Set default filter to 'all'
    document.querySelector('.student-list-dropdown-content a[data-filter="all"]').classList.add('active');
};
    </script>
</body>

</html>