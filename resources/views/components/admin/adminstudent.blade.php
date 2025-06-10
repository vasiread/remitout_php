<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Dashboard</title>

    <script src="{{ asset('js/adminsidebar.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/css/studentformquestionair.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/scdashboard.css') }}">
</head>

<body>
    @extends('layouts.app');
    @php
$profileImgPath = '';
$uploadPanName = '';
$profileIconPath = "assets/images/account_circle.png";
$phoneIconPath = "assets/images/call.png";
$mailIconPath = "assets/images/mail.png";
$pindropIconPath = "assets/images/pin_drop.png";
$discordIconPath = "assets/images/icons/discordicon.png";
$viewIconPath = "assets/images/visibility.png";


$nbfcdata = [];

      @endphp

    <div class="student-listcontainer" id="student-admin-section-id">
        <div class="globallistcontainer-header" id="studentlistcontainer-headersection">
            <div class="insideshort-headerstudentlist">
                <h2>Student List</h2>
                <h3 id="student-list-count">{{ count($userDetails) }}</h3>
            </div>

            <div class="headersection-rightsidecontent" id="admin-studentlist-headercontent">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container">
                    <input type="text" id="search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>
                <div class="student-list-dropdown-filters" id="student-list-dropdown-filters">
                    <button class="student-list-dropdown-button">
                        <img src="{{ asset('assets/images/Icons/filter_icon.png') }}" alt="">
                        Filters
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="student-list-dropdown-content" style="display: none;">
                        <a href="#" data-filter="all">All</a>
                        <a href="#" data-filter="pending">Pending</a>
                        <a href="#" data-filter="approved">Approved</a>
                    </div>
                </div>
                <button class="studentlist-add">Add</button>
            </div>
        </div>

        <div class="scdashboard-studentapplication" id="studentapplicationfromadminstudent">
            @foreach ($userDetails as $users)
                @php
    $status = 'pending';
    if ($users->reviewed == 0) {
        $status = 'not-reviewed';
    } elseif ($users->type == 'proposal') {
        $status = 'approved';
    }
                @endphp
                <div class="studentapplication-lists" data-status="{{ $status }}">
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>{{ $users->user->name }}</h1>
                            <p id="hidden-id-elementforaccess-{{ $users->user_id }}" style="display:none">
                                {{ $users->user_id }}
                            </p>
                            <div class="application-buttoncontainer">
                                <button class="view-student-profile-trigger"
                                    data-user-id="{{ $users->user_id }}">View</button>
                                <button class="edit-student-profile-trigger"
                                    data-user-id="{{ $users->user_id }}">Edit</button>
                                <button class="expand-arrow">
                                    <img src="{{ asset('assets/images/stat_minus_1.png') }}" alt="">
                                </button>
                            </div>
                            <button class="studenteacheditbutton">Edit</button>
                        </div>
                    </div>
                    <ul class="individualstudentapplication-status">
                        <li class="scdashboard-nbfcnamecontainer">
                            <p>NBFC:</p>
                            <p>{{ optional($users->nbfc)->nbfc_name ?? 'N/A' }}</p>
                        </li>

                        <li class="scdashboard-nbfcstatus-pending">
                            <p>Status:</p>
                            <span>
                                @if($users->reviewed == 0)
                                    Not yet reviewed
                                @else
                                    @if($users->type == 'request')
                                        Pending
                                    @elseif($users->type == 'proposal')
                                        Accepted
                                    @else
                                        Unknown
                                    @endif
                                @endif
                            </span>
                        </li>

                        <li class="scdashboard-missingdocumentsstatus">
                            <p>Missing Documents:</p>
                            <span class="missing-document-count">03</span>
                        </li>
                    </ul>
                    <div class="studentapplication-lists-remainingdocuments" style="display:none">
                        <div class="document-container">
                            <!-- PAN Card -->
                            <div class="document-box" id="pan-card-admin-view-{{ $users->user_id }}"
                                style="display:none;flex-direction:column;">
                                <div class="document-name" id="pan-card-document-name-{{ $users->user_id }}">PAN Card</div>
                                <div class="upload-field">
                                    <span id="pan-card-name-{{ $users->user_id }}">No File Chosen</span>

                                    <!-- Wrap the icon with a label pointing to the input ID -->
                                    <label for="pan-card-{{ $users->user_id }}"
                                        id="pan-card-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>

                                    <!-- Hidden file input -->
                                    <input type="file" id="pan-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        style="display: none;"
                                        onchange="handleFileUpload(event, 'pan-card-name-{{ $users->user_id }}', 'pan-card-upload-icon-{{ $users->user_id }}', 'pan-card-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">

                                    <!-- Remove icon -->
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
                                <div class="document-name" id="aadhar-card-document-name-{{ $users->user_id }}">Aadhar Card
                                </div>
                                <div class="upload-field">
                                    <span id="aadhar-card-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="aadhar-card-{{ $users->user_id }}"
                                        id="aadhar-card-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" style="display: none;" id="aadhar-card-{{ $users->user_id }}"
                                        accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'aadhar-card-name-{{ $users->user_id }}', 'aadhar-card-upload-icon-{{ $users->user_id }}', 'aadhar-card-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">
                                    <span id="aadhar-card-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display: none;"
                                        onclick="removeFile('aadhar-card-{{ $users->user_id }}', 'aadhar-card-name-{{ $users->user_id }}', 'aadhar-card-upload-icon-{{ $users->user_id }}', 'aadhar-card-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="aadhar-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
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
                            <div class="document-box" id="passport-view-{{ $users->user_id }}" style="display:none">
                                <div class="document-name" id="passport-document-name-{{ $users->user_id }}">Passport</div>
                                <div class="upload-field">
                                    <span id="passport-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="passport-{{ $users->user_id }}"
                                        id="passport-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="passport-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'passport-name-{{ $users->user_id }}', 'passport-upload-icon-{{ $users->user_id }}', 'passport-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">
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
                                <div class="document-name" id="10th-mark-sheet-id">10th Mark Sheet
                                </div>
                                <div class="upload-field">
                                    <span id="tenth-grade-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="tenth-grade-{{ $users->user_id }}"
                                        id="tenth-grade-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="tenth-grade-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'tenth-grade-name-{{ $users->user_id }}', 'tenth-grade-upload-icon-{{ $users->user_id }}', 'tenth-grade-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">
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
                                <div class="document-name" id="12th-mark-sheet-id">12th Mark Sheet
                                </div>
                                <div class="upload-field">
                                    <span id="twelfth-grade-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="twelfth-grade-{{ $users->user_id }}"
                                        id="twelfth-grade-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="twelfth-grade-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'twelfth-grade-name-{{ $users->user_id }}', 'twelfth-grade-upload-icon-{{ $users->user_id }}', 'twelfth-grade-remove-icon-{{ $users->user_id }}',  '', 'static','{{ $users->user_id }}')">
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
                                <div class="document-name" id="graduation-mark-sheet-id">Graduation
                                    Mark Sheet</div>
                                <div class="upload-field">
                                    <span id="graduation-grade-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="graduation-grade-{{ $users->user_id }}"
                                        id="graduation-grade-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="graduation-grade-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'graduation-grade-name-{{ $users->user_id }}', 'graduation-grade-upload-icon-{{ $users->user_id }}', 'graduation-grade-remove-icon-{{ $users->user_id }}',  '', 'static','{{ $users->user_id }}')">
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
                                <div class="document-name" id="10th-grades-id-{{ $users->user_id }}">
                                    10th Grade</div>
                                <div class="upload-field">
                                    <span id="secured-tenth-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="secured-tenth-{{ $users->user_id }}"
                                        id="secured-tenth-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-tenth-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-tenth-name-{{ $users->user_id }}', 'secured-tenth-upload-icon-{{ $users->user_id }}', 'secured-tenth-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">
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
                                <div class="document-name" id="12th-grade-id-{{ $users->user_id }}">
                                    12th Grade</div>
                                <div class="upload-field">
                                    <span id="secured-twelfth-name-{{ $users->user_id }}">
                                        <p>No File Chosen</p>
                                    </span>
                                    <label for="secured-twelfth-{{ $users->user_id }}"
                                        id="secured-twelfth-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-twelfth-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-twelfth-name-{{ $users->user_id }}', 'secured-twelfth-upload-icon-{{ $users->user_id }}', 'secured-twelfth-remove-icon-{{ $users->user_id }}',  '', 'static','{{ $users->user_id }}')">
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
                                <div class="document-name" id="graduation-id-{{ $users->user_id }}">
                                    Graduation</div>
                                <div class="upload-field">
                                    <span id="secured-graduation-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="secured-graduation-{{ $users->user_id }}"
                                        id="secured-graduation-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="secured-graduation-{{ $users->user_id }}"
                                        accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'secured-graduation-name-{{ $users->user_id }}', 'secured-graduation-upload-icon-{{ $users->user_id }}', 'secured-graduation-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">
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
                            <!-- Co-borrower PAN Card -->
                            <div class="document-box" id="co-borrower-pan-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="pan-card-id-{{ $users->user_id }}">
                                    CoBorrower PAN Card</div>
                                <div class="upload-field">
                                    <span id="co-pan-card-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="co-pan-card-{{ $users->user_id }}"
                                        id="co-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-pan-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-pan-card-name-{{ $users->user_id }}', 'co-upload-icon-{{ $users->user_id }}', 'co-remove-icon-{{ $users->user_id }}',  '', 'static','{{ $users->user_id }}')">
                                    <span id="co-remove-icon-{{ $users->user_id }}" class="remove-icon"
                                        style="display:none;"
                                        onclick="removeFile('co-pan-card-{{ $users->user_id }}', 'co-pan-card-name-{{ $users->user_id }}', 'co-upload-icon-{{ $users->user_id }}', 'co-remove-icon-{{ $users->user_id }}', '{{ $users->user_id }}')">✖</span>
                                </div>
                                <div class="info" style="display:none">
                                    <span class="help-trigger" data-target="co-pan-help-{{ $users->user_id }}">ⓘ
                                        Help</span>
                                    <span>*jpg, png, pdf formats</span>
                                </div>
                                <div class="help-container co-pan-help-{{ $users->user_id }}" style="display: none;">
                                    <h3 class="help-title">Help</h3>
                                    <div class="help-content">
                                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Co-borrower Aadhar Card -->
                            <div class="document-box" id="co-borrower-aadhar-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="aadhar-card-id-{{ $users->user_id }}">
                                    CoBorrower Aadhar Card</div>
                                <div class="upload-field">
                                    <span id="co-aadhar-card-name-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="co-aadhar-card-{{ $users->user_id }}"
                                        id="co-aadhar-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-aadhar-card-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-aadhar-card-name-{{ $users->user_id }}', 'co-aadhar-upload-icon-{{ $users->user_id }}', 'co-aadhar-remove-icon-{{ $users->user_id }}', '', 'static', '{{ $users->user_id }}')">
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
                            <!-- Co-borrower Address Proof -->
                            <div class="document-box" id="co-borrower-address-admin-view-{{ $users->user_id }}"
                                style="display:none">
                                <div class="document-name" id="address-proof-id-{{ $users->user_id }}">CoBorrower Address
                                    Proof</div>
                                <div class="upload-field">
                                    <span id="co-addressproof-{{ $users->user_id }}">No File Chosen</span>
                                    <label for="co-passport-{{ $users->user_id }}"
                                        id="co-passport-upload-icon-{{ $users->user_id }}">
                                        <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                                    </label>
                                    <input type="file" id="co-passport-{{ $users->user_id }}" accept=".jpg, .png, .pdf"
                                        onchange="handleFileUpload(event, 'co-addressproof-{{ $users->user_id }}', 'co-passport-upload-icon-{{ $users->user_id }}', 'co-passport-remove-icon-{{ $users->user_id }}',  '', 'static','{{ $users->user_id }}')">
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

    <div id="studentprofile-section-adminsideview" style="display: none;">
        <div class="studentdashboardprofile-profilesection">
            <img src="path/to/profile.jpg" class="profileImg" id="profile-photo-id" alt="">
            <i class="fa-regular fa-pen-to-square"></i>
            <input type="file" class="profile-upload" accept="image/*" enctype="multipart/form-data" disabled>

            <div class="studentdashboardprofile-personalinfo" id="studentdashboardprofile-personalinfo-id">
                <div class="personalinfo-firstrow">
                    <h1>Student Profile</h1>
                </div>

                <ul class="personalinfo-secondrow" id="personalinfo-secondrow-id">
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

                <ul class="personalinfosecondrow-editsection" style="display: none;"
                    id="personalinfosecondrow-editsection-admin-id">
                    <li style="margin-bottom: 3px;color:rgba(33, 33, 33, 1);">Unique ID : <span
                            style="margin-left: 6px;">ABC123456</span></li>
                    <li class="personal_info_name">
                        <p>Name</p>
                        <input type="text" id="edit-name" disabled>
                    </li>
                    <li class="personal_info_phone">
                        <p>Phone</p>
                        <input type="text" id="edit-phone" disabled>
                    </li>
                    <li class="personal_info_email">
                        <p>Email</p>
                        <input type="email" id="edit-email" disabled>
                    </li>
                    <li class="personal_info_state">
                        <p>State</p>
                        <input type="text" id="edit-state" disabled>
                    </li>
                </ul>
            </div>

            <div class="studentdashboardprofile-educationeditsection"
                id="studentdashboardprofile-educationeditsection-admin-id">
                <div class="educationeditsection-firstrow">
                    <h1>Education</h1>
                </div>
                <div class="educationeditsection-secondrow" style="display:flex">
                    <p id="education-course">Bachelor's Degree in Computer Science</p>
                    <p id="education-university">Master's Degree in AI</p>
                </div>
                <div class="educationeditsection-secondrow-edit" style="display: none;">
                    <input type="text" id="edit-course" class="inputs-adminsidestudentprofile" disabled />
                    <input type="text" id="edit-university" class="inputs-adminsidestudentprofile" disabled />
                </div>
            </div>

            <div class="studentdashboardprofile-testscoreseditsection" id="testscoreseditsection-secondrow-admin-id">
                <div class="testscoreseditsection-firstrow">
                    <h1>Test Scores</h1>
                </div>
                <div class="testscoreseditsection-secondrow" id="testscoreseditsection-secondrow-adminside">
                    <p>1. IELTS <span class="ilets_score">7.5</span></p>
                    <p>2. GRE <span class="gre_score">320</span></p>
                    <p>3. TOEFL <span class="tofel_score">110</span></p>
                    <div id="other-exams-container" class="other-exams-section"></div>
                </div>
                <div class="testscoreseditsection-secondrow-editsection" style="display: none;">
                    <p>IELTS</p>
                    <input type="text" id="edit-ilets" class="ilets_score" disabled>
                    <p>GRE</p>
                    <input type="text" id="edit-gre" class="gre_score" disabled>
                    <p>TOEFL</p>
                    <input type="text" id="edit-tofel" class="tofel_score" disabled>
                </div>
            </div>
        </div>

        <div class="studentdashboardprofile-myapplication" id="course-details-container" data-course-details=''
            data-personal-details=''>
            <div class="myapplication-firstcolumn">
                <h1>Course Details</h1>
                <div class="personalinfo-firstrow" id="admin-side-edit-button">
                    <button id="edit-profile-btn">Edit</button>
                    <button id="save-profile-btn" class="saved-msg" style="display: none;">Save</button>
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
                            <input type="text" id="country-edit" class="custom-country-edit" placeholder="Add Country"
                                disabled>
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
                <input type="text" placeholder="Enter degree type" id="otherDegreeInput" disabled
                    style="display: none;">
            </div>

            <div class="myapplication-fourthcolumn-additional">
                <p>3. What is the duration of the course?</p>
                <input type="text" id="course-duration" placeholder="Course Duration" disabled>
            </div>

            <div class="myapplication-fourthcolumn">
                <p>4. What is the Loan amount required?</p>
                <input type="number" id="loan-amount" placeholder="Loan Amount" disabled>
            </div>

            <div class="myapplication-fifthcolumn">
                <p>Referral Code</p>
                <input type="text" id="referral-code" placeholder="Referral Code" disabled>
            </div>

            <div class="myapplication-sixthcolumn">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
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

            <div class="savecancelbuttoncontainer" style="display: none;">
                <button id="save-student-details-adminside">Save</button>
                <button id="cancel-student-details-adminside">Cancel</button>
            </div>
        </div>
    </div>



    <div class="studentAddBySCuserPopup">
        <div class="studentAddByScuserPopup-headerpart">
            <h3>Register Students</h3>
            <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="">
        </div>
        <div class="studentAddByScuserPopup-content-container">
            <div class="studentAddByScuserPopup-contentpart">
                <input type="text" placeholder="Name of the Student">
                <input type="text" placeholder="bankemail@gmail.com">
                <input type="text" placeholder="phone">
                <input type="password" placeholder="password">
                <button id="delete-student-row" style="cursor:pointer">Delete</button>
            </div>
        </div>
        <button id="dynamic-add-student-button" style="cursor:pointer">Add Student</button>
        <form id="excel-form" enctype="multipart/form-data">
            @csrf
            <div class="studentAddByScuserPopup-footerpart">
                <!-- Excel Upload Button -->
                <button id="excel-upload-trigger" type="button" style="cursor:pointer">
                    Upload xlsx <img src="{{ asset('assets/images/Icons/upload.png') }}" />
                </button>
                <button type="button" class="add-student-btn" style="cursor:pointer">Add Student</button>
                <button type="button" id="save-multiple-students-bysc" style="cursor:pointer">Save Student
                    details</button>
            </div>

            <input type="file" id="excel-sheet-student-update" name="excel_file" accept=".xls,.xlsx"
                style="display:none">

            <div id="file-upload-info" style="display:none">
                <!-- Display the Selected File Name with Remove Button -->
                <div id="file-container" style="display: flex; align-items: center; gap: 10px; position:relative;">
                    <input id="selected-file-name" readonly style="border: 1px solid #ccc; padding: 5px;" />
                    <button id="remove-excel-btn" type="button" style="cursor:pointer;">X</button>
                </div>
                <!-- Save Excel File Button -->
                <button id="save-excelfile-btn" type="button" style="cursor:pointer;">
                    Save Excel File
                </button>
            </div>
        </form>
    </div>


    <script>

        document.addEventListener('DOMContentLoaded', () => {
            // Run all top-level setup functions
            expandingStudentDetails();
            initializeSearchAndFilter();
            setupProfileTriggers();
            setupEditSaveCancel();
            initializeSortByFunctionQueries();
            initializePopuAddingstudents();
            triggerExcelRegistration();
            addDynamicInputFields();
            triggeredButtons();

            // Directly initialize column/document-related functions
            initialiseEightcolumn();
            initialiseSeventhcolumn();
            initialiseSeventhAdditionalColumn();
            initialiseNinthcolumn();
            initialiseTenthcolumn();
            initializeKycDocumentUpload();
            initializeMarksheetUpload();
            initializeSecuredAdmissionDocumentUpload();
            initializeWorkExperienceDocumentUpload();
            initializeCoBorrowerDocumentUpload();
        });




        const applicationStatusElements = document.querySelectorAll(".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
        const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

        applicationStatusElements.forEach((items, index) => {
            if (items.textContent.includes("Accepted")) {
                items.style.color = "#3FA27E";
                items.style.backgroundColor = "#D2FFEE";
                if (missingDocumentsCount[index]) {
                    missingDocumentsCount[index].style.display = "none";
                }
            }
            if (items.textContent.includes("Not yet reviewed")) {
                items.style.color = "#909090";
                items.style.backgroundColor = "#F0F0F0";
            }
            else {
                if (missingDocumentsCount[index]) {
                    missingDocumentsCount[index].style.display = "flex";
                }
            }
        });

        const expandingStudentDetails = async () => {
             const listContainer = document.querySelectorAll(".studentapplication-lists");
            const expandButton = document.querySelectorAll(".individualapplication-list .application-buttoncontainer .expand-arrow");
            const documentsStatusBar = document.querySelectorAll(".studentapplication-lists-remainingdocuments");
            const studentId = document.querySelectorAll(".studentapplication-lists .firstsection-lists [id^='hidden-id-elementforaccess-']");

            let previousUserId = null;

            for (let [index, item] of expandButton.entries()) {
                item.addEventListener('click', async () => {
                    if (listContainer[index] && documentsStatusBar[index] && studentId[index]) {
                        const isExpanded = listContainer[index].style.height === "fit-content";

                        listContainer[index].style.height = isExpanded ? "140px" : "fit-content";
                        documentsStatusBar[index].style.display = isExpanded ? "none" : "block";
                        item.style.transform = isExpanded ? "rotate(0deg)" : "rotate(180deg)";
                        item.style.transition = "transform 0.2s ease";

                        const userId = studentId[index].textContent.trim();
                        if (!isExpanded && userId && userId !== previousUserId) {
                            previousUserId = userId;
                            await getRemainingDocuments(userId);
                        }
                    }
                });
            }
        };

        const getRemainingDocuments = async (userId) => {
             const documentIdPrefixMap = {
                "pan-card-name": "pan-card-admin-view-",
                "aadhar-card-name": "aadhar-card-admin-view-",
                "passport-name": "passport-view-",
                "secured-tenth-name": "sslc-grade-adminview-",
                "secured-twelfth-name": "hsc-grade-adminview-",
                "secured-graduation-name": "graduation-grade-adminview-",
                "tenth-grade-name": "sslc-grade-marksheet-adminview-",
                "twelfth-grade-name": "hsc-grade-marksheet-adminview-",
                "graduation-grade-name": "degree-grade-marksheet-adminview-",
                "co-pan-card-name": "co-borrower-pan-admin-view-",
                "co-aadhar-card-name": "co-borrower-aadhar-admin-view-",
                "co-addressproof": "co-borrower-address-admin-view-",
                "salary-upload-address-proof-name": "salary-addressproof-admin-view-",
                "salary-upload-salary-slip-name": "salary-slip-admin-view-",
                "work-experience-experience-letter": "work-experience-letter-admin-view-",
                "work-experience-joining-letter": "work-experience-joining-admin-view-",
                "work-experience-monthly-slip": "work-experience-slip-admin-view-",
                "work-experience-office-id": "work-experience-id-admin-view-"
            };

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

                if (response.ok && data) {
                    console.log("Raw response:", data);

                    const missingDocuments = data.missingDocuments;
                    console.log("Missing documents for user", userId, missingDocuments);

                    missingDocuments.forEach((missingDocument) => {
                        const cleanKey = missingDocument.trim().replace(/\/+$/, '');

                        const idPrefix = documentIdPrefixMap[cleanKey];
                        if (!idPrefix) {
                            console.warn("❌ No prefix mapping for:", cleanKey);
                            return;
                        }

                        const elementId = `${idPrefix}${userId}`;
                        const documentElement = document.getElementById(elementId);

                        console.log("Looking for element ID:", elementId);

                        if (documentElement) {
                            console.log("✅ Found element:", elementId);
                            documentElement.style.display = "flex"; // Use "block" if needed
                        } else {
                            console.warn("❌ Element not found in DOM:", elementId);
                        }
                    });
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

            filterButton.addEventListener('click', () => {
                filterContent.style.display = filterContent.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (e) => {
                if (!filterButton.contains(e.target) && !filterContent.contains(e.target)) {
                    filterContent.style.display = 'none';
                }
            });

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

            filterLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    filterLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');

                    // Update dropdown text
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

                    // Update count
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

        function setupProfileTriggers() {
             const studentProfileContainer = document.getElementById("studentprofile-section-adminsideview");
            const studentListContainer = document.getElementById("student-admin-section-id");
            const viewTriggers = document.querySelectorAll(".view-student-profile-trigger");
            const editTriggers = document.querySelectorAll(".edit-student-profile-trigger");

           viewTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const uniqueId = document.getElementById(`hidden-id-elementforaccess-${trigger.dataset.userId}`).textContent.trim();

                     Loader.show();

                    // Call both functions in parallel and wait for both
                    Promise.all([
                        fetchProfile(uniqueId, false, studentProfileContainer, studentListContainer),
                        initialiseAllViews(uniqueId)
                    ])
                        .then(() => {
                            Loader.hide(); // ✅ Hide when both complete
                        })
                        .catch(error => {
                            console.error("Failed to load profile or files:", error);
                            Loader.hide(); // ✅ Hide even on failure
                        });
                });
            });


            editTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const uniqueId = document.getElementById(`hidden-id-elementforaccess-${trigger.dataset.userId}`).textContent.trim();

                    Loader.show(); // ✅ Show loader before starting fetch

                    Promise.resolve(
                        fetchProfile(uniqueId, true, studentProfileContainer, studentListContainer)
                    )
                        .then(() => {
                            Loader.hide(); // ✅ Hide loader after fetch completes
                        })
                        .catch(error => {
                            console.error("Failed to load editable profile:", error);
                            Loader.hide(); // ✅ Hide loader even if an error happens
                        });
                });
            });

        }

        async function fetchProfile(uniqueId, editMode, profileContainer, listContainer) {
            try {
                const response = await fetch(`/getUserProfileAdminSide?unique_id=${uniqueId}`);
                const data = await response.json();
                if (data.status) {
                    updateProfileView(data.data);
                    profileContainer.style.display = "flex";
                    listContainer.style.display = "none";
                    if (editMode) {
                        enterEditMode();
                    } else {
                        exitEditMode();
                        // Hide buttons in view mode
                        document.getElementById('edit-profile-btn').style.display = 'none';
                        document.getElementById('save-profile-btn').style.display = 'none';
                        document.querySelector('.savecancelbuttoncontainer').style.display = 'none';
                    }
                } else {
                    console.error('Failed to fetch user profile:', data.message);
                }
            } catch (err) {
                console.error('Error fetching profile data:', err);
            }
        }

        function updateProfileView(userProfile) {
            // Personal Info
            // document.getElementById("profile-photo-id").src = `path/to/profile_images/${userProfile.name}.jpg` || 'path/to/profile.jpg';
            document.getElementById("referenceNameId").querySelector('p').textContent = userProfile.name;
            document.getElementById("referenceEmailId").querySelector('p').textContent = userProfile.email;
            document.querySelector('.personal_info_phone p').textContent = userProfile.phone;
            document.getElementById("personal_state_id").textContent = userProfile.state;
            document.querySelector('#personalinfo-secondrow-id  .personal_info_id').textContent = userProfile.user_id;
            console.log(userProfile)


            // Personal Info Edit Inputs
            document.getElementById("edit-name").value = userProfile.name || '';
            document.getElementById("edit-phone").value = userProfile.phone || '';
            document.getElementById("edit-email").value = userProfile.email || '';
            document.getElementById("edit-state").value = userProfile.state || '';

            // Education
            document.getElementById("education-course").textContent = userProfile.course_name || "Bachelor's Degree in Computer Science";
            document.getElementById("education-university").textContent = userProfile.university_school_name || "Master's Degree in AI";
            document.getElementById("edit-course").value = userProfile.course_name || '';
            document.getElementById("edit-university").value = userProfile.university_school_name || '';

            // Test Scores
            const testScores = userProfile.test_scores || {};
            document.querySelector('span.ilets_score').textContent = testScores.ILETS || 'N/A';
            document.querySelector('span.gre_score').textContent = testScores.GRE || 'N/A';
            document.querySelector('span.tofel_score').textContent = testScores.TOFEL || 'N/A';
            document.getElementById("edit-ilets").value = testScores.ILETS || '';
            document.getElementById("edit-gre").value = testScores.GRE || '';
            document.getElementById("edit-tofel").value = testScores.TOFEL || '';

            // Other Exams
            const otherExamsContainer = document.getElementById('other-exams-container');
            otherExamsContainer.innerHTML = '';
            if (userProfile.test_scores?.Others && Array.isArray(userProfile.test_scores.Others)) {
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

            // Course Details
            let planToStudy = userProfile.plan_to_study;
            if (typeof planToStudy === 'string') {
                try {
                    planToStudy = JSON.parse(planToStudy);
                } catch (err) {
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

            document.getElementById("otherDegreeInput").value = degreeType === 'others' ? userProfile.degree_type : '';
            document.getElementById("otherDegreeInput").style.display = degreeType === 'others' ? 'block' : 'none';

            document.getElementById("course-duration").value = userProfile.course_duration || '';
            document.getElementById("loan-amount").value = userProfile.loan_amount || '';
            document.getElementById("referral-code").value = userProfile.referral_code || '';

            document.getElementById("course-details-container").setAttribute('data-course-details', JSON.stringify({
                planToStudy: planToStudyArray,
                degreeType: userProfile.degree_type,
                courseDuration: userProfile.course_duration,
                loanAmount: userProfile.loan_amount,
                referralCode: userProfile.referral_code
            }));


        }


        function enterEditMode() {
            document.getElementById('personalinfo-secondrow-id').style.display = 'none';
            document.querySelector('.personalinfosecondrow-editsection').style.display = 'flex';
            document.querySelector('.educationeditsection-secondrow').style.display = 'none';
            document.querySelector('.educationeditsection-secondrow-edit').style.display = 'flex';
            document.querySelector('.testscoreseditsection-secondrow').style.display = 'none';
            document.querySelector('.testscoreseditsection-secondrow-editsection').style.display = 'block';
            document.querySelector('.savecancelbuttoncontainer').style.display = 'flex';

            document.getElementById('edit-profile-btn').style.display = 'none';
            document.getElementById('save-profile-btn').style.display = 'block'; // <-- show save

            const inputs = [
                'edit-name', 'edit-phone', 'edit-email', 'edit-state',
                'edit-course', 'edit-university',
                'edit-ilets', 'edit-gre', 'edit-tofel',
                'plan-to-study-edit', 'country-edit', 'otherDegreeInput',
                'course-duration', 'loan-amount', 'referral-code'
            ];
            inputs.forEach(id => {
                const input = document.getElementById(id);
                if (input) input.disabled = false;
            });

            document.querySelectorAll('input[name="study-location-edit"]').forEach(cb => cb.disabled = false);
            document.querySelectorAll('input[name="education-level"]').forEach(rb => rb.disabled = false);
            document.querySelector('.profile-upload').disabled = false;
        }

        function exitEditMode() {
            // Show display sections
            document.getElementById('personalinfo-secondrow-id').style.display = 'flex';
            document.querySelector('.personalinfosecondrow-editsection').style.display = 'none';
            document.querySelector('.educationeditsection-secondrow').style.display = 'flex';
            document.querySelector('.educationeditsection-secondrow-edit').style.display = 'none';
            document.querySelector('.testscoreseditsection-secondrow').style.display = 'block';
            document.querySelector('.testscoreseditsection-secondrow-editsection').style.display = 'none';
            document.querySelector('.savecancelbuttoncontainer').style.display = 'none';
            document.getElementById('edit-profile-btn').style.display = 'block';
            document.getElementById('save-profile-btn').style.display = 'none';

            // Disable inputs
            const inputs = [
                'edit-name', 'edit-phone', 'edit-email', 'edit-state',
                'edit-course', 'edit-university',
                'edit-ilets', 'edit-gre', 'edit-tofel',
                'plan-to-study-edit', 'country-edit', 'otherDegreeInput',
                'course-duration', 'loan-amount', 'referral-code'
            ];
            inputs.forEach(id => {
                const input = document.getElementById(id);
                if (input) input.disabled = true;
            });

            document.querySelectorAll('input[name="study-location-edit"]').forEach(cb => cb.disabled = true);
            document.querySelectorAll('input[name="education-level"]').forEach(rb => rb.disabled = true);
            document.querySelector('.profile-upload').disabled = true;
        }

        function toggleOtherDegreeInput(event) {
            const otherDegreeInput = document.getElementById('otherDegreeInput');
            if (event.target.value === 'Others') {
                otherDegreeInput.style.display = 'block';
                otherDegreeInput.disabled = false;
            } else {
                otherDegreeInput.style.display = 'none';
                otherDegreeInput.disabled = true;
            }
        }

        function setupEditSaveCancel() {
            const editButton = document.getElementById('edit-profile-btn');
            const saveButton = document.getElementById('save-student-details-adminside');
            const cancelButton = document.getElementById('cancel-student-details-adminside');

            editButton.addEventListener('click', enterEditMode);

            saveButton.addEventListener('click', async () => {
                await saveAllDetails();
                exitEditMode();
            });

            cancelButton.addEventListener('click', () => {
                exitEditMode();
                refreshProfileView();
            });
        }

        async function saveAllDetails() {

            const uniqueId = document.querySelector('.personal_info_id').textContent.trim();




            const personalInfo = {
                name: document.getElementById('edit-name').value,
                phone: document.getElementById('edit-phone').value,
                email: document.getElementById('edit-email').value,
                state: document.getElementById('edit-state').value
            };

            const education = {
                course_name: document.getElementById('edit-course').value,
                university_school_name: document.getElementById('edit-university').value
            };

            const testScores = {
                ILETS: document.getElementById('edit-ilets').value,
                GRE: document.getElementById('edit-gre').value,
                TOFEL: document.getElementById('edit-tofel').value
            };

            const courseDetails = {
                plan_to_study: Array.from(document.querySelectorAll('input[name="study-location-edit"]:checked')).map(cb => cb.value),
                degree_type: document.querySelector('input[name="education-level"]:checked')?.value || '',
                course_duration: document.getElementById('course-duration').value,
                loan_amount: document.getElementById('loan-amount').value,
                referral_code: document.getElementById('referral-code').value
            };

            if (courseDetails.degree_type === 'Others') {
                courseDetails.degree_type = document.getElementById('otherDegreeInput').value;
            }

            try {
                const fullData = {
                    unique_id: uniqueId,
                    ...personalInfo,
                    ...education,
                    ...testScores,
                    ...courseDetails
                };
                console.log("fullData", fullData)

                const response = await fetch('/update-personal-info-adminside', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(fullData)
                });

                const data = await response.json();

                if (!data.success) {
                    alert('Failed to save details: ' + data.message);
                    return;
                }

                alert('Details saved successfully!');
                refreshProfileView(uniqueId);

            } catch (error) {
                console.error('Error saving details:', error);
                alert('An unexpected error occurred while saving details.');
            }
        }

        const endpoints = [
            { url: "/retrieve-file", selector: ".uploaded-aadhar-name", fileType: "aadhar-card-name" },
            { url: "/retrieve-file", selector: ".uploaded-pan-name", fileType: "pan-card-name" },
            { url: "/retrieve-file", selector: ".passport-name-selector", fileType: "passport-card-name" },
            { url: "/retrieve-file", selector: ".sslc-marksheet", fileType: "tenth-grade-name" },
            { url: "/retrieve-file", selector: ".hsc-marksheet", fileType: "twelfth-grade-name" },
            { url: "/retrieve-file", selector: ".graduation-marksheet", fileType: "graduation-grade-name" },
            { url: "/retrieve-file", selector: ".sslc-grade", fileType: "secured-tenth-name" },
            { url: "/retrieve-file", selector: ".hsc-grade", fileType: "secured-twelfth-name" },
            { url: "/retrieve-file", selector: ".graduation-grade", fileType: "secured-graduation-name" },
            { url: "/retrieve-file", selector: ".experience-letter", fileType: "work-experience-experience-letter" },
            { url: "/retrieve-file", selector: ".salary-slip", fileType: "work-experience-monthly-slip" },
            { url: "/retrieve-file", selector: ".office-id", fileType: "work-experience-office-id" },
            { url: "/retrieve-file", selector: ".joining-letter", fileType: "work-experience-joining-letter" },
            { url: "/retrieve-file", selector: ".coborrower-pancard", fileType: "co-pan-card-name" },
            { url: "/retrieve-file", selector: ".coborrower-aadharcard", fileType: "co-aadhar-card-name" },
            { url: "/retrieve-file", selector: ".coborrower-addressproof", fileType: "co-addressproof" },
        ];

        const documentUrls = {};

        const initialiseAllViews = (uniqueId) => {
           
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
            const userId = uniqueId;

            if (!csrfToken || !userId) {
                console.error("CSRF token or User ID is missing");
                return Promise.reject("CSRF token or User ID is missing");
            }

            // Extract fileTypes from endpoints, but backend may return more keys
            const fileTypes = endpoints.map(ep => ep.fileType);

            return fetch("/retrieve-file", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ userId, fileTypes }),
            })
                .then(res => res.json())
                .then(data => {
                    const allFiles = data.staticFiles || data;
                    alert(data)
                    console.log(data)

                    // Loop through all keys returned by backend (all files)
                    Object.entries(allFiles).forEach(([fileType, fileUrl]) => {
                        if (fileUrl) {
                            documentUrls[fileType] = fileUrl;
                            const fileName = fileUrl.split("/").pop();

                            // Find matching selector from endpoints (if any)
                            const endpoint = endpoints.find(ep => ep.fileType === fileType);
                            if (endpoint) {
                                const element = document.querySelector(endpoint.selector);
                                if (element) {
                                    element.textContent = fileName;
                                } else {
                                    console.warn(`Element not found for selector: ${endpoint.selector}`);
                                }
                            }

                            console.log(`FileType: ${fileType}, URL: ${fileUrl}`);
                        } else {
                            console.log(`No file found for ${fileType}`);
                        }
                    });
                })
                .catch(error => {
                    console.error("Error fetching files:", error);
                });
        };


        function refreshProfileView(uniqueId) {
            fetch(`/getUserProfileAdminSide?unique_id=${uniqueId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        updateProfileView(data.data);
                        exitEditMode();
                    } else {
                        console.error('Failed to refresh profile:', data.message);
                    }
                })
                .catch(err => {
                    console.error('Error refreshing profile:', err);
                });
        }



        const initializeSortByFunctionQueries = () => {
            const sortBy = document.querySelector(".queryraisedcontainer-rightcontent #sort-by");
            const sortByContents = document.querySelector(".queryraisedcontainer-rightcontent .sort-by-contents");

            const querysContainer = document.querySelector(".groupofraisedquestion-scdashboard");
            const sortedLinkCateg = document.querySelectorAll(".queryraisedcontainer-rightcontent .sort-by-contents a");

            if (sortByContents) {
                sortByContents.style.width = "100%";
            }

            sortedLinkCateg.forEach((item) => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortContentsType = e.target.getAttribute('data-sort');
                    const raisedQuestions = Array.from(querysContainer.querySelectorAll('.individual-raisedquestions'));

                    if (sortContentsType === 'newest') {
                        raisedQuestions.sort((a, b) => new Date(b.dataset.added) - new Date(a.dataset.added));
                    } else if (sortContentsType === 'oldest') {
                        raisedQuestions.sort((a, b) => new Date(a.dataset.added) - new Date(b.dataset.added));
                    } else if (sortContentsType === 'alphabet') {
                        raisedQuestions.sort((a, b) => a.querySelector('#queries-row').textContent.trim().localeCompare(b.querySelector('#queries-row').textContent.trim()));
                    } else if (sortContentsType === 'alphabet-reverse') {
                        raisedQuestions.sort((a, b) => b.querySelector('#queries-row').textContent.trim().localeCompare(a.querySelector('#queries-row').textContent.trim()));
                    }

                    raisedQuestions.forEach((question) => {
                        querysContainer.appendChild(question);
                    });
                });
            });

            sortBy.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sortByContents) {
                    sortByContents.style.display = sortByContents.style.display === "none" ? "flex" : "none";
                }
            });

            document.addEventListener('click', (e) => {
                if (sortByContents && sortByContents.style.display === "flex" && !sortBy.contains(e.target)) {
                    sortByContents.style.display = "none";
                }
            });
        };



        const initializeKycDocumentUpload = () => {
            console.log("the console");

            const individualKycDocumentsUpload = document.querySelectorAll(
                ".individualkycdocuments"
            );

            individualKycDocumentsUpload.forEach((card) => {
                const eyeIcon = card.querySelector(".fa-eye");

                if (!eyeIcon) {
                    console.error("Eye icon not found in card:", card);
                    return;
                }

                eyeIcon.addEventListener("click", function (event) {
                    event.stopPropagation();

                    const documentType = eyeIcon.id
                        .replace("view-", "")
                        .replace("-card", ""); // e.g., "aadhar-card"
                    const fileTypeKey = `${documentType}-card-name`;
                    const fileUrl = documentUrls[fileTypeKey];
                    const fileNameElement = card.querySelector(
                        `.uploaded-${documentType}-name`
                    );
                    const fileName = fileNameElement
                        ? fileNameElement.textContent
                        : "Document.pdf";

                    console.log(`Previewing ${documentType}: ${fileUrl}`);

                    // Check if a preview is already active
                    if (eyeIcon.classList.contains('preview-active')) {
                        const previewWrapper = document.querySelector('.pdf-preview-wrapper');
                        if (previewWrapper) previewWrapper.remove();
                        const overlay = document.querySelector('.pdf-preview-overlay');
                        if (overlay) overlay.remove();
                        eyeIcon.classList.remove('preview-active');
                        eyeIcon.src = "/assets/images/visibility.png";
                        return;
                    }

                    // If no file URL, show an alert
                    if (!fileUrl) {
                        alert("No document found to preview.");
                        return;
                    }

                    // Create the preview modal
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

                    document.addEventListener("keydown", function (e) {
                        if (e.key === "Escape") {
                            closePreview();
                        }
                    });

                    eyeIcon.classList.add("preview-active");
                    eyeIcon.src = "/assets/images/close.png"; // Update with your actual path
                });
            });
        };


        const initializeMarksheetUpload = () => {
            console.log("console")
            const individualMarksheetDocumentsUpload = document.querySelectorAll(
                ".individualmarksheetdocuments"
            );

            individualMarksheetDocumentsUpload.forEach((card) => {
                const eyeIcon = card.querySelector(".fa-eye");

                if (!eyeIcon) {
                    console.error("Eye icon not found in card:", card);
                    return;
                }

                eyeIcon.addEventListener("click", function (event) {
                    event.stopPropagation();

                    // Get the document type from the eye icon's ID
                    const documentType = eyeIcon.id.replace('view-', '').replace('-card', '');

                    // Construct the fileType key used in documentUrls based on the class name
                    let fileTypeKey;
                    if (card.querySelector(".sslc-marksheet")) {
                        fileTypeKey = "tenth-grade-name";
                    } else if (card.querySelector(".hsc-marksheet")) {
                        fileTypeKey = "twelfth-grade-name";
                    } else if (card.querySelector(".graduation-marksheet")) {
                        fileTypeKey = "graduation-grade-name";
                    }

                    // Get the URL from documentUrls
                    const fileUrl = documentUrls[fileTypeKey];
                    const fileNameElement = card.querySelector(
                        `.${fileTypeKey.replace("-name", "-marksheet")}`
                    );
                    const fileName = fileNameElement
                        ? fileNameElement.textContent
                        : "Document.pdf";

                    console.log(`Previewing marksheet (${fileTypeKey}):`, fileUrl);

                    if (eyeIcon.classList.contains("preview-active")) {
                        const previewWrapper = document.querySelector(
                            ".pdf-preview-wrapper"
                        );
                        const overlay = document.querySelector(".pdf-preview-overlay");
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

                    // Create the preview modal
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

                    document.addEventListener("keydown", function (e) {
                        if (e.key === "Escape") {
                            closePreview();
                        }
                    });

                    eyeIcon.classList.add("preview-active");
                    eyeIcon.src = "/assets/images/close.png";
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

                eyeIcon.addEventListener("click", function (event) {
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

                    // Get the URL from documentUrls
                    const fileUrl = documentUrls[fileTypeKey];
                    const fileNameElement = card.querySelector(
                        `.${fileTypeKey.replace("-name", "-grade")}`
                    );
                    const fileName = fileNameElement
                        ? fileNameElement.textContent
                        : "Document.pdf";

                    console.log(
                        `Previewing secured admission (${fileTypeKey}):`,
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

                        document.addEventListener("keydown", function (e) {
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

                        document.addEventListener("keydown", function (e) {
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

        function truncateFileName(fileName) {
            if (fileName.length <= 20) return fileName;

            const extension = fileName.slice(fileName.lastIndexOf("."));
            const name = fileName.slice(0, fileName.lastIndexOf("."));

            return name.slice(0, 16) + "..." + extension;
        }

        //  document.addEventListener('DOMContentLoaded', function () {
        //     initializeSecuredAdmissionDocumentUpload();
        // });



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

                eyeIcon.addEventListener("click", function (event) {
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
                    const fileName = fileNameElement
                        ? fileNameElement.textContent
                        : "Document.pdf";

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

                        document.addEventListener("keydown", function (e) {
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

                        document.addEventListener("keydown", function (e) {
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
        const initializePopuAddingstudents = () => {
            const studentAddingPopuBar = document.querySelector(".studentAddBySCuserPopup");
            const popuAddingStudentTriggers = document.querySelectorAll(".studentlist-add");
            const closePopuTrigger = document.querySelector(".studentAddByScuserPopup-headerpart img");

            if (!studentAddingPopuBar || !popuAddingStudentTriggers.length || !closePopuTrigger) {
                console.error("Missing required DOM elements");
                alert("something")
                return;
            }

            const showPopup = () => {
                studentAddingPopuBar.style.display = "flex";
                overlay.style.display = "block";
            };

            const hidePopup = () => {
                studentAddingPopuBar.style.display = "none";
                overlay.style.display = "none";
            };

            popuAddingStudentTriggers.forEach(trigger => {
                trigger.addEventListener("click", showPopup);
            });

            closePopuTrigger.addEventListener("click", hidePopup);
        };
        const addDynamicInputFields = () => {
            const addStudentButtons = document.querySelectorAll(".studentAddBySCuserPopup-footerpart button:nth-child(2), #dynamic-add-student-button"); // Fixed class name
            const studentFormContainer = document.querySelector(".studentAddBySCuserPopup-contentpart");

            if (!studentFormContainer) {
                console.error("Student form container not found.");
                return;
            }

            const addNewStudentForm = () => {
                const newForm = document.createElement("div");
                newForm.classList.add("student-entry-form");
                newForm.style.display = "flex";
                newForm.style.gap = "0.8rem";
                newForm.style.flexDirection = "column";


                newForm.innerHTML = `
            <input type="text" placeholder="Name of the Student">
            <input type="email" placeholder="bankemail@gmail.com">
            <input type="text" placeholder="Phone">
            <input type="password" placeholder="Password">
            <button class="delete-student-popup">Delete</button>
        `;

                studentFormContainer.appendChild(newForm);

                const deleteButton = newForm.querySelector(".delete-student-popup");
                deleteButton.addEventListener("click", () => {
                    newForm.remove();
                });
            };

            // Attach event listener to all "Add Student" buttons
            addStudentButtons.forEach(button => {
                button.addEventListener("click", addNewStudentForm);
            });
        };
        const triggerExcelRegistration = () => {
            const excelUpload = document.getElementById("excel-upload-trigger");
            const excelUploadEvent = document.getElementById("excel-sheet-student-update");
            const fileNameDisplay = document.getElementById("selected-file-name");
            const fileUploadInfo = document.getElementById("file-upload-info");
            const removeFileBtn = document.getElementById("remove-excel-btn");
            const saveExcelFileBtn = document.getElementById("save-excelfile-btn");

            if (excelUpload) {
                excelUpload.addEventListener('click', () => {
                    if (excelUploadEvent) {
                        excelUploadEvent.click();
                    }
                });
            }

            if (excelUploadEvent) {
                excelUploadEvent.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        fileNameDisplay.value = `${file.name}`;
                        fileUploadInfo.style.display = "flex";
                    } else {
                        fileNameDisplay.value = "";
                        fileUploadInfo.style.display = "none";
                    }
                });
            }

            if (removeFileBtn) {
                removeFileBtn.addEventListener('click', () => {
                    fileNameDisplay.value = "";
                    excelUploadEvent.value = "";
                    fileUploadInfo.style.display = "none";
                });
            }

            if (saveExcelFileBtn) {
                saveExcelFileBtn.addEventListener('click', () => {
                    const formData = new FormData();
                    const file = excelUploadEvent.files[0];

                    if (!file) {
                        alert("Please select an Excel file to upload.");
                        return;
                    }

                    formData.append('excel_file', file);

                    fetch('{{ route("students.import") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                            fileNameDisplay.value = "";
                            excelUploadEvent.value = "";
                            fileUploadInfo.style.display = "none";
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while uploading the file.');
                        });
                });
            }
        };


        const collectStudentData = async () => {
            const studentForms = document.querySelectorAll(".studentAddByScuserPopup-contentpart");
            const students = [];
            let hasInvalidEmail = false;
            let hasInvalidPhone = false;

            // Simple email format check
            const isValidEmail = (email) => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            };

            // Simple phone validation: 10 digits, numbers only
            const isValidPhone = (phone) => {
                return /^\d{10}$/.test(phone);
            };

            studentForms.forEach((form, index) => {
                const inputs = form.querySelectorAll("input");
                const student = {
                    name: inputs[0].value.trim(),
                    email: inputs[1].value.trim(),
                    phone: inputs[2].value.trim(),
                    password: inputs[3].value.trim()
                };

                // Email check
                if (student.email && !isValidEmail(student.email)) {
                    console.error(`Invalid email for student ${index + 1} (${student.name || 'unnamed'}): "${student.email}"`);
                    hasInvalidEmail = true;
                }

                // Phone check
                if (student.phone && !isValidPhone(student.phone)) {
                    console.error(`Invalid phone number for student ${index + 1} (${student.name || 'unnamed'}): "${student.phone}"`);
                    hasInvalidPhone = true;
                }

                if (student.name || student.email || student.phone || student.password) {
                    if (!student.name || !student.email || !student.phone || !student.password) {
                        console.error(`Missing field(s) for student ${index + 1}:`, student);
                    }

                    students.push(student);
                }
            });

            console.log("Student Data:", students);

            if (hasInvalidEmail) {
                console.warn("Some email addresses are invalid. Please fix them.");
                alert("Some email addresses are invalid. Please fix them.");
                return;
            }

            if (hasInvalidPhone) {
                console.warn("Some phone numbers are invalid. Please enter 10-digit numeric values.");
                alert("Some phone numbers are invalid. Please enter 10-digit numeric values.");
                return;
            }

            if (students.length === 0) {
                alert("No student data to save.");
                return;
            }

            try {
                const response = await fetch('/multipleregisterbyscuser', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ students })
                });

                const result = await response.json();

                if (response.ok) {
                    console.log("Success:", result.message);
                    alert("Students saved successfully!");
                    document.querySelectorAll(".studentAddByScuserPopup-contentpart").forEach(form => {
                        form.querySelectorAll("input").forEach(input => {
                            input.value = "";
                        });
                    });
                } else {
                    console.error("Error:", result.errors || result.message);

                    if (result.errors) {
                        let message = "Please correct the following errors:\n";

                        Object.entries(result.errors).forEach(([field, messages]) => {
                            const match = field.match(/^students\.(\d+)\.(\w+)$/);
                            if (match) {
                                const index = parseInt(match[1], 10) + 1;
                                const fieldName = match[2].charAt(0).toUpperCase() + match[2].slice(1);
                                message += `- Student ${index} - ${fieldName}: ${messages[0]}\n`;
                            } else {
                                message += `- ${messages[0]}\n`;
                            }
                        });

                        alert(message);
                    } else {
                        alert("Failed to save students: " + result.message);
                    }
                }

            } catch (error) {
                console.error("Network error:", error);
                alert("An error occurred while saving students.");
            }
        };

        function triggeredButtons() {
            const saveStudentDetailsButton = document.querySelector("#save-multiple-students-bysc");
            saveStudentDetailsButton.addEventListener('click', () => {
                const studentData = collectStudentData();
            });


            const backgroundContainer = document.querySelector('.scdashboard-parentcontainer');

        }




        const initialiseEightcolumn = () => {
            const section = document.querySelector(".eightcolumn-firstsection");

            section.addEventListener("click", function () {
                if (section.style.height === "") {
                    section.style.height = "fit-content";
                } else {
                    section.style.height = "";
                }
            });
        };
        const initialiseSeventhcolumn = () => {
            const section = document.querySelector(".seventhcolum-firstsection");

            section.addEventListener("click", function () {
                if (section.style.height === "") {
                    section.style.height = "fit-content";
                } else {
                    section.style.height = "";
                }
            });
        };
        const initialiseSeventhAdditionalColumn = () => {
            const section = document.querySelector(
                ".seventhcolumn-additional-firstcolumn"
            );

            section.addEventListener("click", function () {
                if (section.style.height === "") {
                    section.style.height = "fit-content";
                } else {
                    section.style.height = "";
                }
            });
        };
        const initialiseNinthcolumn = () => {

            const section = document.querySelector('.ninthcolumn-firstsection');
            section.addEventListener('click', function () {
                if (section.style.height === '') {
                    section.style.height = 'fit-content';
                } else {
                    section.style.height = "";
                }
            });

        }





        const initialiseTenthcolumn = () => {
            const section = document.querySelector(".tenthcolumn-firstsection");
            section.addEventListener("click", function () {
                if (section.style.height === "") {
                    section.style.height = "fit-content";
                } else {
                    section.style.height = "";
                }
            });

        }


        const helpTriggers = document.querySelectorAll(".help-trigger");

        function toggleHelpContainer(event, targetClass) {
            const helpContainer = document.querySelector(`.${targetClass}`);
            if (helpContainer) {
                if (
                    helpContainer.style.display === "none" ||
                    !helpContainer.style.display
                ) {
                    helpContainer.style.display = "block";
                } else {
                    helpContainer.style.display = "none";
                }
            }
        }

        helpTriggers.forEach((trigger) => {
            trigger.addEventListener("click", (event) => {
                event.stopPropagation();
                const targetClass = trigger.getAttribute("data-target");
                toggleHelpContainer(event, targetClass);
            });
        });

        document.addEventListener("click", (event) => {
            const helpContainers = document.querySelectorAll(".help-container");
            helpContainers.forEach((container) => {
                if (
                    container.style.display === "block" &&
                    !container.contains(event.target)
                ) {
                    container.style.display = "none";
                }
            });
        });

        function truncateFileName(fileName, maxLength = 25) {
            if (fileName.length <= maxLength) {
                return fileName;
            } else {
                const extension = fileName.slice(fileName.lastIndexOf("."));
                const truncatedName =
                    fileName.slice(0, maxLength - extension.length - 3) + "...";
                return truncatedName + extension;
            }
        }

        async function handleFileUpload(
            event,
            fileNameId,
            uploadIconId,
            removeIconId,
            clearName = null,
            sourceType = 'static',  // default value
            studentId = null
        ) {
            alert(sourceType);
            const fileInput = event.target;
            const fileNameElement = document.getElementById(fileNameId);
            const uploadIcon = document.getElementById(uploadIconId);
            const removeIcon = document.getElementById(removeIconId);
            const file = fileInput.files[0];
            const helpTrigger =
                fileNameElement.parentElement.nextElementSibling.querySelector(
                    ".help-trigger",
                );
            const formatInfo =
                fileNameElement.parentElement.nextElementSibling.querySelector(
                    "span:last-child",
                );
            if (!file) {
                fileNameElement.textContent = "No file chosen";
                uploadIcon.style.display = "inline";
                removeIcon.style.display = "none";
                if (helpTrigger) helpTrigger.style.display = "inline";
                if (formatInfo) formatInfo.style.display = "inline";
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                showToast("File size exceeds 5MB limit.");
                fileInput.value = "";
                fileNameElement.textContent = "No file chosen";
                uploadIcon.style.display = "inline";
                removeIcon.style.display = "none";
                if (helpTrigger) helpTrigger.style.display = "inline";
                if (formatInfo) formatInfo.style.display = "inline";
                return;
            }
            const allowedExtensions = [".jpg", ".jpeg", ".png", ".pdf"];
            const fileExtension = file.name
                .slice(file.name.lastIndexOf("."))
                .toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                showToast("Only .jpg, .jpeg, .png, and .pdf files are allowed.");
                fileInput.value = "";
                fileNameElement.textContent = "No file chosen";
                uploadIcon.style.display = "inline";
                removeIcon.style.display = "none";
                if (helpTrigger) helpTrigger.style.display = "inline";
                if (formatInfo) formatInfo.style.display = "inline";
                return;
            }
            const fileSizeInKB = (file.size / 1024).toFixed(2);
            const fileSizeDisplay =
                fileSizeInKB > 1024
                    ? `${(fileSizeInKB / 1024).toFixed(2)} MB`
                    : `${fileSizeInKB} KB`;
            const truncatedFileName = truncateFileName(file.name);
            fileNameElement.textContent = truncatedFileName;
            uploadIcon.style.display = "none";
            removeIcon.style.display = "inline";
            if (helpTrigger) helpTrigger.style.display = "none";
            if (formatInfo) formatInfo.textContent = `${fileSizeDisplay} uploaded`;
            const fileIcon = document.createElement("img");
            fileIcon.style.width = "20px";
            fileIcon.style.height = "20px";
            fileIcon.style.marginRight = "10px";
            if (
                fileExtension === ".jpg" ||
                fileExtension === ".jpeg" ||
                fileExtension === ".png"
            ) {
                fileIcon.src = "assets/images/image-upload.png";
            } else if (fileExtension === ".pdf") {
                fileIcon.src = "assets/images/image-pdf.png";
            }
            const existingIcon = fileNameElement.querySelector("img");
            if (existingIcon) {
                existingIcon.remove();
            }
            fileNameElement.insertBefore(fileIcon, fileNameElement.firstChild);
            document
                .querySelectorAll(".document-name")
                .forEach((documentElement) => {
                    documentElement.style.display = "block";
                });
            alert(studentId)
            if (studentId === null) {
                const userId = document.getElementById(
                    "personal-info-userid",
                ).value;
                alert(userId)
                await uploadFileToServer(file, userId, fileNameId, clearName, sourceType);
            } else if (studentId !== null) {
                const userId = studentId;
                await uploadFileToServer(file, userId, fileNameId, clearName, sourceType);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            window.handleFileUpload = handleFileUpload;
        });

        function uploadFileToServer(file, userId, fileNameId, clearName, sourceType) {
            fileNameId = fileNameId.replace(`-${userId}`, "");
            const formDetailsData = new FormData();
            formDetailsData.append("file", file);
            formDetailsData.append("userId", userId);
            formDetailsData.append("fileNameId", fileNameId);
            formDetailsData.append("clearName", clearName);  // send clearName here
            formDetailsData.append("sourceType", sourceType);  // send clearName here

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
            if (!csrfToken) {
                console.error("CSRF token not found");
                return;
            }
            fetch("/upload-each-documents", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: formDetailsData,
            })
                .then((response) => {
                    if (!response.ok) {
                        return response.json().then((errorData) => {
                            throw new Error(
                                errorData.error || "Network response was not ok",
                            );
                        });
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data) {
                        console.log("File uploaded successfully", data);
                    } else {
                        console.error(
                            "Error: No URL returned from the server",
                            data,
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error uploading file:", error);
                });
        }

        async function removeFile(
            fileInputId,
            fileNameId,
            uploadIconId,
            removeIconId,
            studentId = null,
        ) {
            const fileInput = document.getElementById(fileInputId);
            const fileNameElement = document.getElementById(fileNameId);
            const uploadIcon = document.getElementById(uploadIconId);
            const removeIcon = document.getElementById(removeIconId);
            const helpTrigger =
                fileNameElement.parentElement.nextElementSibling.querySelector(
                    ".help-trigger",
                );
            const formatInfo =
                fileNameElement.parentElement.nextElementSibling.querySelector(
                    "span:last-child",
                );
            fileInput.value = "";
            fileNameElement.textContent = "No file chosen";
            uploadIcon.style.display = "inline";
            removeIcon.style.display = "none";
            if (helpTrigger) helpTrigger.style.display = "inline";
            if (formatInfo) formatInfo.textContent = "*jpg, png, pdf formats";
            const fileIcon = fileNameElement.querySelector("img");
            if (fileIcon) {
                fileIcon.remove();
            }
            if (studentId === null) {
                const userId = document.getElementById(
                    "personal-info-userid",
                ).value;
                await deleteFileToServer(userId, fileNameId);
            } else if (studentId !== null) {
                const userId = studentId;
                await deleteFileToServer(userId, fileNameId);
            }
        }

        function deleteFileToServer(userId, fileNameId) {
            fileNameId = fileNameId.replace(`-${userId}`, "");
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
            if (!csrfToken) {
                console.error("CSRF token not found");
                return;
            }
            const data = {
                userId: userId,
                fileNameId: fileNameId,
            };
            fetch("/remove-each-documents", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => {
                    if (!response.ok) {
                        return response.json().then((errorData) => {
                            throw new Error(
                                errorData.message || "Network response was not ok",
                            );
                        });
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data) {
                        console.log("Files deleted successfully", data);
                    } else {
                        console.error(
                            "Error: No data returned from the server",
                            data,
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error deleting file:", error);
                });
        }


    </script>
    <script src="{{ asset('js/studentforms.js') }}"></script>

</body>

</html>