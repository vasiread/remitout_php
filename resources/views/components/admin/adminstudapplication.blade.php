<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/adminstudapplication.css') }}">

</head>

<body>
    @extends('layouts.app')



    <div class="admin-studnet-application-main-container">

        <div class="nbfc-studentdashboardprofile-profile-section-container" id="admin-student-form-edit-container">
            <form id="student-application-form" enctype="multipart/form-data">
                <div class="admin-student-form-container">
                    <!-- Form Header -->
                    <div class="admin-student-form-header">
                        <h1>Edit Registration Form</h1>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="admin-student-form-section">
                        <div class="admin-student-section-header">
                            <div class="admin-student-section-title">Personal Information</div>
                            <span class="admin-student-question-count">02 Questions</span>
                            <div class="admin-student-arrow-icon">
                                <img src="assets/images/admin-drop.png" alt="Arrow Icon"
                                    class="admin-student-arrow-down" />
                            </div>
                        </div>

                        <div class="admin-student-section-content">
                            <!-- First Question: Personal Info -->
                            <div class="admin-student-form-question">
                                <div class="admin-student-question-row" id="admin-student-person-info">
                                    <div class="admin-student-question-title">1. Let us know more about you</div>
                                    <div class="admin-student-dropdown-field">
                                        <span class="admin-student-field-text">Text field</span>
                                        <span class="admin-student-dropdown-icon"></span>
                                    </div>
                                </div>

                                <div class="admin-student-options-section" id="person-info-section"
                                    style="display: none;">
                                    <div class="admin-student-options-label">Options:</div>

                                    <!-- Input Row 1 -->
                                    <div class="input-row" id="input-row-1">
                                        <div class="input-group">
                                            <div class="input-content">
                                                <img src="./assets/images/person-icon.png" alt="Person Icon"
                                                    class="icon" />
                                                <input type="text" placeholder="Full Name"
                                                    name="let-us-know-more-about-you[full_name]" id="fullName"
                                                    required />
                                            </div>
                                            <div class="validation-message" id="fullName-error"></div>
                                        </div>

                                        <div class="input-group">
                                            <div class="input-content">
                                                <img src="./assets/images/call-icon.png" alt="Phone Icon"
                                                    class="icon" />
                                                <input type="tel" placeholder="Phone Number"
                                                    name="let-us-know-more-about-you[phone_number]" id="phone"
                                                    required />
                                            </div>
                                            <div class="validation-message" id="phone-error"></div>
                                        </div>

                                        <div class="input-group">
                                            <div class="input-content">
                                                <img src="./assets/images/school.png" alt="Referral Code Icon"
                                                    class="icon" />
                                                <input type="text" placeholder="Referral Code"
                                                    name="let-us-know-more-about-you[referral_code]"
                                                    id="referralCode" />
                                            </div>
                                            <div class="validation-message" id="referralCode-error"></div>
                                        </div>

                                         <div class="input-group">
                                            <div class="input-content">
                                                <img src="./assets/images/mail.png" alt="Mail Icon" class="icon" />
                                                <input type="email" placeholder="Email ID"
                                                    name="let-us-know-more-about-you[email]" id="email" required />
                                            </div>
                                            <div class="validation-message" id="email-error"></div>
                                        </div>

                                           <div class="input-group">
                                            <div class="input-content">
                                                <img src="./assets/images/calendar_month.png" alt="Calendar Icon"
                                                    class="icon" />
                                                <input type="date" placeholder="Date of Birth (DD/MM/YYYY)"
                                                    name="date_of_birth" id="personal-info-dob" required />
                                                <div class="validation-message" id="dob-error"></div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-content">
                                                <div class="dropdown-gender-wrapper"
                                                    id="admin-side-dropdown-gender-wrapper">
                                                    <div class="dropdown-gender" id="admin-side-dropdown-gender">
                                                        <div class="dropdown-gender-header">
                                                            <div class="dropdown-label-gender">Select Gender</div>
                                                            <div class="dropdown-icon-gender">
                                                                <svg width="12" height="8" viewBox="0 0 12 8"
                                                                    fill="none">
                                                                    <path d="M1 1L6 6L11 1" stroke="currentColor"
                                                                        stroke-width="2" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-options-gender"
                                                            id="admin-side-dropdown-options-gender">
                                                            <div class="dropdown-option-gender" data-value="male">
                                                                <span>Male</span>
                                                            </div>
                                                            <div class="dropdown-option-gender" data-value="female">
                                                                <span>Female</span>
                                                            </div>
                                                            <div class="dropdown-option-gender" data-value="other">
                                                                <span>Other</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="gender" value="" />
                                                    <div class="validation-message" id="gender-error"></div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="input-group">
                                                <div class="input-content">
                                                    <img src="./assets/images/pin_drop.png" alt="Location Icon"
                                                        class="icon" />
                                                    <input type="text" placeholder="State" name="state"
                                                        id="personal-info-state" required />
                                                    <div id="suggestions-state-admin-side-id"
                                                        class="suggestions-container"></div>
                                                    <div class="validation-message" id="state-error"></div>
                                                </div>
                                         </div>

                                          <div class="input-group">
                                                <div class="input-content">
                                                    <img src="./assets/images/pin_drop.png" alt="Location Icon"
                                                        class="icon" />
                                                    <input type="text" placeholder="City" name="city"
                                                        id="personal-info-city" required />
                                                    <div id="suggestions-city-admin-side-id"
                                                        class="suggestions-container"></div>
                                                    <div class="validation-message" id="city-error"></div>
                                                </div>
                                            </div>

                                            <div class="add-field" id="add-input-field">
                                            <span class="add-text">Add</span>
                                            <span class="add-icon">+</span>
                                        </div>

                                    </div><!-----close the row---->   
                                     <div id="personal-fields-container"></div> 
                                    </div>
                                   

                                </div>

                            </div>

                            <!-- Second Question: How did you find about us -->
                            <div class="admin-student-form-question">
                                <div class="admin-student-question-row" id="admin-student-about-us">
                                    <div class="admin-student-question-title">2. How did you find about us?</div>
                                    <div class="admin-student-dropdown-field">
                                        <span class="admin-student-field-text">Drop Down List</span>
                                        <span class="admin-student-dropdown-icon"></span>
                                    </div>
                                </div>

                                <div class="admin-student-options-section" id="about-us-section" style="display: none;">
                                    <div class="admin-student-options-label">Options:</div>
                                    <div class="second-main-section-container">
                                        <div class="second-question-options">

                                        </div>

                                        <div class="add-social">
                                            <span class="add-text">Add</span>
                                            <span class="add-icon">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Details Section -->
                    <div class="admin-student-form-section-course-details">
                        <div class="admin-student-section-header-course">
                            <div class="admin-student-section-title-course">Course Details</div>
                            <span class="admin-student-question-count-course">4 Questions</span>
                            <div class="admin-student-arrow-icon-course">
                                <img src="assets/images/admin-drop.png" alt="Arrow Icon"
                                    class="admin-student-arrow-down-course" />
                            </div>
                        </div>

                        <div class="admin-student-section-content-course">
                            <div class="admin-student-form-question-course">
                                <div class="admin-student-question-row-course" id="admin-student-course">
                                    <div class="admin-student-question-title-course">1. Where are you planning to study?
                                    </div>
                                    <div class="admin-student-dropdown-field-course">
                                        <span class="admin-student-field-text-course">Check Box</span>
                                        <span class="admin-student-dropdown-icon-course"></span>
                                    </div>
                                </div>

                                <div class="admin-student-options-section-course" id="person-info-section-course">
                                    <div class="admin-student-options-label-about">Options:</div>
                                    <div class="checkbox-group" id="selected-study-location-admin">

                                        <label class="others-checkbox">
                                            <input type="checkbox" name="where-are-you-planning-to-study[locations][]"
                                                value="Others"> Others
                                        </label>


                                        <div class="add-checkbox-container" id="plantostudycountryadd">
                                            <span class="add-checkbox-input">Add</span>
                                            <span class="add-checkbox-btn" id="add-course-checkbox-id">+</span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Course Details 2 -->
                            <div class="admin-student-form-question-course-degree"
                                id="admin-student-form-question-course-degree">
                                <div class="admin-student-question-row-course-degree" id="admin-student-course-second">
                                    <div class="admin-student-question-title-course-degree">2. Select the type of degree
                                        you want to
                                        pursue:</div>
                                    <div class="admin-student-dropdown-field-course-degree">
                                        <span class="admin-student-field-text-course">Check Box</span>
                                        <span class="admin-student-dropdown-icon-course"></span>
                                    </div>
                                </div>

                                <div class="options-section" id="option-section-degree-container">
                                    <div class="options-header">
                                        <div class="admin-student-options-label">Options:</div>
                                    </div>

                                    <div class="option-grid course-degree-admin" id="optionsContainer">

                                        <div class="option-item">
                                            <input type="checkbox"
                                                name="select-the-type-of-degree-you-want-to-pursue[degrees][]"
                                                class="option-checkbox" value="Others">
                                            <div class="option-name">Others</div>
                                        </div>

                                        <div class="add-checkbox-container-degree" id="addSection">
                                            <div class="add-text">Add</div>
                                            <div class="add-icon">+</div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="admin-student-form-question-month">
                                <div class="admin-student-question-row-month" id="course-row-month-id">
                                    <div class="admin-student-question-title">3. What is the duration of the course?
                                    </div>
                                    <div class="admin-student-dropdown-field" id="course-dropdown-month-id">
                                        <span class="admin-student-field-text">Drop Down List</span>
                                        <span class="admin-student-dropdown-icon"
                                            id="admin-student-dropdown-icon-id"></span>
                                    </div>
                                </div>

                                <div class="admin-student-options-section" id="course-duration-section-month">
                                    <div class="admin-student-options-label">Options:</div>
                                    <div class="admin-course-option-main-container">
                                        <div class="course-options">

                                        </div>

                                        <div class="add-course">
                                            <span class="add-text">Add</span>
                                            <span class="add-icon">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="admin-student-form-question" id="course-details-container">
                                <div class="admin-student-question-row" id="course-details-row-id">
                                    <div class="admin-student-question-title">4. Course Details</div>
                                    <div class="admin-student-dropdown-field" id="course-details-dropdown">
                                        <span class="admin-student-field-text">Check Box</span>
                                        <span class="admin-student-dropdown-icon"></span>
                                    </div>
                                </div>

                                <div class="options-section" id="course-details-options">
                                    <div class="options-label">Options:</div>
                                    <div class="checkbox-coures-main-container">
                                        <div class="checkbox-options-container"
                                            id="checkbox-options-container-expenses">
                                            <div class="add-option" id="add-course-option-btn">
                                                <!-- Moved inside checkbox-options-container -->
                                                <span class="add-option-text">Add</span>
                                                <span class="add-option-icon">+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Details Section -->
                        <div class="admin-student-form-section-academic-details" id="academic-details-section">
                            <div class="admin-student-section-header-academic">
                                <div class="admin-student-section-title-academic">Academic details</div>
                                <span class="admin-student-question-count-academic">04 Questions</span>
                                <div class="admin-student-arrow-icon-academic rotated">
                                    <img src="assets/images/admin-drop.png" alt="Arrow Icon"
                                        class="admin-student-arrow-down-academic">
                                </div>
                            </div>
                        </div>

                        <!-- Academic container -->
                        <div class="admin-student-section-content-academic expanded" id="academic-details-content">
                            <!-- Education Container -->
                            <div class="education-container" id="education-container">
                                <div class="education-header-row" id="education-header-row">
                                    <div class="education-title">1. Academic details </div>
                                    <div class="education-dropdown-field" id="education-dropdown">
                                        <span class="admin-student-field-text">Textfield</span>
                                        <span class="admin-student-dropdown-icon"></span>
                                    </div>
                                </div>

                                <div class="education-section" id="education-section">
                                    <div class="education-label">Education</div>
                                    <div class="education-row" id="education-row-1">
                                        <div class="education-field">
                                            <input type="text" placeholder="University/School"
                                                name="academic-details[education][0][university]">
                                        </div>
                                        <div class="education-field">
                                            <input type="text" placeholder="Course Name"
                                                name="academic-details[education][0][course]">
                                        </div>
                                    </div>
                                    <div id="education-rows-container"></div>
                                    <button type="button" class="add-education-field-btn" id="add-education-field-btn">
                                        <span>Add</span>
                                        <span class="add-education-icon">+</span>
                                    </button>
                                </div>
                            </div>




                            <!-- Academic Gap Question -->
                            <div class="admin-student-form-question" id="academic-gap-container">
                                <div class="admin-student-question-row" id="academic-gap-row">
                                    <div class="admin-student-question-title">
                                        2. Do you have any gap in your academics?
                                    </div>
                                    <div class="admin-student-dropdown-field" id="academic-gap-dropdown">
                                        <span class="admin-student-field-text">Check Box</span>
                                        <span class="admin-student-dropdown-icon"></span>
                                    </div>
                                </div>

                                <div class="options-section" id="academic-gap-options">
                                    <div class="options-label">Options:</div>
                                    <div class="academic-options-container">
                                        <div class="academic-options">
                                            <div class="academic-option">
                                                <input type="radio" id="academic-yes"
                                                    name="do-you-have-any-gap-in-your-academics[gap]" value="Yes"
                                                    required />
                                                <label for="academic-yes">Yes</label>
                                            </div>
                                            <div class="academic-option">
                                                <input type="radio" id="academic-no"
                                                    name="do-you-have-any-gap-in-your-academics[gap]" value="No"
                                                    required />
                                                <label for="academic-no">No (only secured loan)</label>
                                            </div>
                                        </div>
                                        <div class="add-option" id="add-academic-option-btn">
                                            <span class="add-option-text">Add</span>
                                            <span class="add-option-icon">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Co-borrower Info Section -->
                        <div class="admin-student-form-section-co-borrower-info">
                            <div class="admin-student-section-header-co-borrower"
                                id="admin-student-section-header-co-borrower-id">
                                <div class="admin-student-section-title-co-borrower">
                                    Co-borrower Info
                                </div>
                                <span class="admin-student-question-count-co-borrower">3 Questions</span>
                                <div class="admin-student-arrow-icon-co-borrower">
                                    <img src="assets/images/admin-drop.png" alt="Arrow Icon"
                                        class="admin-student-arrow-down-co-borrow" />
                                </div>
                            </div>

                            <div class="admin-student-form-section-co-borrower">
                                <!-- First Container: How is the co-borrower related to you? -->
                                <div class="admin-student-form-question" id="co-borrower-container">
                                    <div class="admin-student-question-row" id="co-borrower-row">
                                        <div class="admin-student-question-title">
                                            How is the co-borrower related to you?
                                        </div>
                                        <div class="admin-student-dropdown-field" id="co-borrower-dropdown">
                                            <span class="admin-student-field-text">Check Box</span>
                                            <span class="admin-student-dropdown-icon"></span>
                                        </div>
                                    </div>

                                    <div class="options-section" id="co-borrower-options" style="display: none;">
                                        <div class="checkbox-options-container"
                                            id="checkbox-options-container-relation">
                                            <div class="checkbox-option">
                                                <input type="checkbox" id="co-borrower-parent"
                                                    name="how-is-the-co-borrower-related-to-you[relationship][]"
                                                    value="Parent" />
                                                <label for="co-borrower-parent">Parent</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input type="checkbox" id="co-borrower-spouse"
                                                    name="how-is-the-co-borrower-related-to-you[relationship][]"
                                                    value="Spouse" />
                                                <label for="co-borrower-spouse">Spouse</label>
                                            </div>
                                            <div class="checkbox-option">
                                                <input type="checkbox" id="co-borrower-blood-relative"
                                                    name="how-is-the-co-borrower-related-to-you[relationship][]"
                                                    value="Blood relative" />
                                                <label for="co-borrower-blood-relative">Blood relative</label>
                                            </div>
                                            <div class="add-option" id="add-coborrower-option-btn">
                                                <span class="add-option-text">Add</span>
                                                <span class="add-option-icon">+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Container: What is the gross monthly income of co-borrower? -->
                                <div class="admin-student-form-question" id="income-container">
                                    <div class="admin-student-question-row" id="income-row">
                                        <div class="admin-student-question-title">
                                            What is the gross monthly income of co-borrower?
                                        </div>
                                        <div class="admin-student-dropdown-field" id="income-dropdown">
                                            <span class="admin-student-field-text">Text Field</span>
                                            <span class="admin-student-dropdown-icon"></span>
                                        </div>
                                    </div>

                                    <div class="options-section" id="income-options" style="display: none;">
                                        <div class="fields-row-container">
                                            <div class="field-container">
                                                <input type="text" class="text-input"
                                                    placeholder="₹ Rupees in thousands"
                                                    name="what-is-the-gross-monthly-income-of-co-borrower[income]"
                                                    required />
                                                <button class="delete-field" type="button">✕</button>
                                                <p class="minimum-amount">
                                                    *minimum amount of 5% after deductions for eligibility
                                                </p>
                                            </div>
                                            <div class="add-option" id="add-income-field-btn">
                                                <span class="add-option-text">Add</span>
                                                <span class="add-option-icon">+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Third Container: Is there any existing co-borrower monthly liability? -->
                                <div class="admin-student-form-question" id="liability-container">
                                    <div class="admin-student-question-row" id="liability-row">
                                        <div class="admin-student-question-title">
                                            Is there any existing co-borrower monthly liability?
                                        </div>
                                        <div class="admin-student-dropdown-field" id="liability-dropdown">
                                            <span class="admin-student-field-text">Check Box</span>
                                            <span class="admin-student-dropdown-icon"></span>
                                        </div>
                                    </div>

                                    <div class="options-section" id="liability-options" style="display: none;">
                                        <div class="liability-content-container">
                                            <!-- Monthly liability option with horizontal layout -->
                                            <div class="monthly-liability-option-container">
                                                <!-- Radio buttons on the left -->
                                                <div class="monthly-liability-radio-buttons">
                                                    <label>
                                                        <input type="radio"
                                                            name="is-there-any-existing-co-borrower-monthly-liability[liability]"
                                                            id="yes-liability" value="Yes" required />
                                                        Yes
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                            name="is-there-any-existing-co-borrower-monthly-liability[liability]"
                                                            id="no-liability" value="No" required />
                                                        No
                                                    </label>
                                                </div>

                                                <!-- EMI field and add button on the right, in the same row -->
                                                <div class="emi-row">
                                                    <div class="emi-content">
                                                        <p class="amount-thousand-mobile">
                                                            Enter the amount in thousands
                                                        </p>
                                                        <input type="text" id="emi-amount" class="emi-content-container"
                                                            placeholder="Enter EMI amount"
                                                            name="is-there-any-existing-co-borrower-monthly-liability[emi_amount]" />
                                                        <span id="emi-error-message" class="error-message"
                                                            style="display: none; color: red;">
                                                            Please enter a valid EMI amount (numeric values only).
                                                        </span>
                                                    </div>
                                                    <div class="add-option" id="add-liability-btn">
                                                        <span class="add-option-text">Add</span>
                                                        <span class="add-option-icon">+</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Container for additional liability fields -->
                                            <div id="additional-liability-fields" class="additional-liability-fields">
                                                <!-- Additional fields will be added here dynamically -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Upload Section -->
                        <div class="admin-student-form-section-document-upload">
                            <div class="admin-student-section-header-document-upload">
                                <div class="admin-student-section-title-document-upload">
                                    Document Upload
                                </div>
                                <span class="admin-student-question-count-document-upload">6 Questions</span>
                                <div class="admin-student-arrow-icon-document-upload">
                                    <img src="assets/images/admin-drop.png" alt="Arrow Icon"
                                        class="admin-student-arrow-down-document-upload" />
                                </div>
                            </div>

                            <div class="admin-student-section-content-document-upload"
                                id="adminside-student-section-content-document-upload">
                                <!-- 1. Student KYC Document -->
                                <div class="admin-student-form-question" id="adminside-student-form-question-kyc">
                                    <div class="admin-student-question-row" id="student-kyc-row">
                                        <div class="admin-student-question-title">Student KYC Document</div>
                                        <div class="admin-student-dropdown-field"
                                            id="adminside-student-dropdown-field-kyc">
                                            <span class="admin-student-field-text"
                                                id="adminside-student-field-text-kyc">Text Field</span>
                                            <span class="admin-student-dropdown-icon"
                                                id="adminside-student-dropdown-icon-kyc"></span>
                                        </div>
                                    </div>
                                    <div class="admin-student-options-section-dashboard" id="student-kyc-section">
                                        <div class="document-container-admin" id="adminside-document-container-kyc">
                                            <div class="document-row" id="document-row-1">
                                                <!-- PAN Card -->
                                                <div class="document-box">
                                                    <div class="document-name" id="pan-card-document-name">
                                                        PAN Card
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="kyc-pan-name" data-original="PAN Card">PAN Card</span>
                                                        <span id="kyc-pan-remove-icon" class="remove-icon"
                                                            onclick="removeFile('kyc-pan', 'kyc-pan-name', 'kyc-pan-upload-icon', 'kyc-pan-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="kyc-pan" class="upload-icon"
                                                                id="kyc-pan-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="kyc-pan"
                                                                name="documents[student_kyc][pan_card]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'kyc-pan-name', 'kyc-pan-upload-icon', 'kyc-pan-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="kyc-pan-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                        <div class="help-container kyc-pan-help"
                                                            id="help-container-kyc-id" style="position: relative;">
                                                            <h3 class="help-title">Help</h3>
                                                            <div class="help-content">
                                                                <p>Please upload a .jpg, .png, or .pdf file with a size
                                                                    less than 5MB.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Aadhar Card -->
                                                <div class="document-box">
                                                    <div class="document-name" id="aadhar-card-document-name">
                                                        Aadhar Card
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="aadhar-card-name" data-original="Aadhar Card">Aadhar
                                                            Card</span>
                                                        <span id="aadhar-card-remove-icon" class="remove-icon"
                                                            onclick="removeFile('aadhar-card', 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="aadhar-card" class="upload-icon"
                                                                id="aadhar-card-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="aadhar-card"
                                                                name="documents[student_kyc][aadhar_card]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="aadhar-card-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container aadhar-card-help"
                                                        id="help-container-aadhar-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload a .jpg, .png, or .pdf file with a size less
                                                                than 5MB.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Passport -->
                                                <div class="document-box">
                                                    <div class="document-name" id="passport-document-name">
                                                        Passport
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="passport-card-name"
                                                            data-original="Passport">Passport</span>
                                                        <span id="passport-remove-icon" class="remove-icon"
                                                            onclick="removeFile('passport', 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="passport" class="upload-icon"
                                                                id="passport-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="passport"
                                                                name="documents[student_kyc][passport]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="passport-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container passport-help"
                                                        id="help-container-password-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload a .jpg, .png, or .pdf file with a size less
                                                                than 5MB.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="document-fields-container-kyc-id">
                                                    <div class="add-document" id="add-document-btn-kyc-id">
                                                        <span class="add-text">Add</span>
                                                        <span class="add-icon">+</span>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Academic Mark Sheets -->
                                <div class="admin-student-form-question" id="adminside-student-form-question-academic">
                                    <div class="admin-student-question-row" id="academic-marks-row">
                                        <div class="admin-student-question-title">Academic Mark Sheets</div>
                                        <div class="admin-student-dropdown-field"
                                            id="adminside-student-dropdown-field-academic">
                                            <span class="admin-student-field-text"
                                                id="adminside-student-field-text-academic">Text
                                                Field</span>
                                            <span class="admin-student-dropdown-icon"
                                                id="adminside-student-dropdown-icon-academic"></span>
                                        </div>
                                    </div>
                                    <div class="admin-student-options-section" id="academic-marks-section">
                                        <div class="document-container-admin"
                                            id="adminside-document-container-academic">
                                            <div class="document-row" id="academic-row-1">
                                                <!-- 10th Grade Mark Sheet -->
                                                <div class="document-box">
                                                    <div class="document-name" id="10th-mark-sheet-id">
                                                        10th Mark Sheet
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="tenth-grade-name"
                                                            data-original="10th Grade Mark Sheet">10th Grade Mark
                                                            Sheet</span>
                                                        <span id="tenth-grade-remove-icon" class="remove-icon"
                                                            onclick="removeFile('tenth-grade', 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="tenth-grade" class="upload-icon"
                                                                id="tenth-grade-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="tenth-grade"
                                                                name="documents[academic_marks][tenth_grade]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="tenth-grade-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container tenth-grade-help"
                                                        id="help-container-grade-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload a .jpg, .png, or .pdf file with a size less
                                                                than 5MB.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 12th Grade Mark Sheet -->
                                                <div class="document-box">
                                                    <div class="document-name" id="12th-mark-sheet-id"
                                                        style="display: none">
                                                        12th Mark Sheet
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="twelfth-grade-name"
                                                            data-original="12th Grade Mark Sheet">12th Grade Mark
                                                            Sheet</span>
                                                        <span id="twelfth-grade-remove-icon" class="remove-icon"
                                                            onclick="removeFile('twelfth-grade', 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="twelfth-grade" class="upload-icon"
                                                                id="twelfth-grade-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="twelfth-grade"
                                                                name="documents[academic_marks][twelfth_grade]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="twelfth-grade-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container twelfth-grade-help"
                                                        id="help-container-twelfth-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload a .jpg, .png, or .pdf file with a size less
                                                                than 5MB.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Graduation Mark Sheet -->
                                                <div class="document-box">
                                                    <div class="document-name" id="graduation-mark-sheet-id"
                                                        style="display: none">
                                                        Graduation Mark Sheet
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="graduation-grade-name"
                                                            data-original="Graduation Mark Sheet">Graduation Mark
                                                            Sheet</span>
                                                        <span id="graduation-grade-remove-icon" class="remove-icon"
                                                            onclick="removeFile('graduation-grade', 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="graduation-grade" class="upload-icon"
                                                                id="graduation-grade-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="graduation-grade"
                                                                name="documents[academic_marks][graduation]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="graduation-grade-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container graduation-grade-help"
                                                        id="help-container-graduation-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload a .jpg, .png, or .pdf file with a size less
                                                                than 5MB.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="academic-fields-container-id">
                                                    <div class="add-document" id="add-academic-btn-id">
                                                        <span class="add-text">Add</span>
                                                        <span class="add-icon">+</span>
                                                    </div>
                                                </div>
                                            </div>               
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Secured Marks -->
                                <div class="admin-student-form-question" id="adminside-student-form-question-secured">
                                    <div class="admin-student-question-row" id="secured-marks-row">
                                        <div class="admin-student-question-title">Secured Marks</div>
                                        <div class="admin-student-dropdown-field"
                                            id="adminside-student-dropdown-field-secured">
                                            <span class="admin-student-field-text"
                                                id="adminside-student-field-text-secured">Text Field</span>
                                            <span class="admin-student-dropdown-icon"
                                                id="adminside-student-dropdown-icon-secured"></span>
                                        </div>
                                    </div>
                                    <div class="admin-student-options-section" id="secured-marks-section">
                                        <div class="document-container-admin" id="adminside-document-container-secured">
                                            <div class="document-row" id="secured-row-1">
                                                <!-- 10th Grade -->
                                                <div class="document-box">
                                                    <div class="document-name" id="10th-grades-id"
                                                        style="display: none">
                                                        10th Grade
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="secured-tenth-name" data-original="10th Grade">10th
                                                            Grade</span>
                                                        <span id="secured-tenth-remove-icon" class="remove-icon"
                                                            onclick="removeFile('secured-tenth', 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="secured-tenth" class="upload-icon"
                                                                id="secured-tenth-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="secured-tenth"
                                                                name="documents[secured_marks][tenth_grade]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="secured-tenth-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container secured-tenth-help"
                                                        id="help-container-tenth-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 10th grade mark sheet in jpg, png, or
                                                                pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 12th Grade -->
                                                <div class="document-box">
                                                    <div class="document-name" id="12th-grade-id" style="display: none">
                                                        12th Grade
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="secured-twelfth-name" data-original="12th Grade">12th
                                                            Grade</span>
                                                        <span id="secured-twelfth-remove-icon" class="remove-icon"
                                                            onclick="removeFile('secured-twelfth', 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="secured-twelfth" class="upload-icon"
                                                                id="secured-twelfth-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="secured-twelfth"
                                                                name="documents[secured_marks][twelfth_grade]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="secured-twelfth-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container secured-twelfth-help"
                                                        id="help-container-secure-twelfth-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 12th grade mark sheet in jpg, png, or
                                                                pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Graduation -->
                                                <div class="document-box">
                                                    <div class="document-name" id="graduation-id" style="display: none">
                                                        Graduation
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="secured-graduation-name"
                                                            data-original="Graduation">Graduation</span>
                                                        <span id="secured-graduation-remove-icon" class="remove-icon"
                                                            onclick="removeFile('secured-graduation', 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="secured-graduation" class="upload-icon"
                                                                id="secured-graduation-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="secured-graduation"
                                                                name="documents[secured_marks][graduation]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="secured-graduation-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container secured-graduation-help"
                                                        id="help-container-secure-graduation-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your graduation mark sheet in jpg, png, or
                                                                pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                  <div id="secured-fields-container-id">
                                                    <div class="add-document" id="add-secured-btn-id">
                                                        <span class="add-text">Add</span>
                                                        <span class="add-icon">+</span>
                                                    </div>
                                                 </div>
                                            </div>
                                            <!-- Secured marks document fields container -->
                                          
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Work Experience -->
                                <div class="admin-student-form-question"
                                    id="adminside-student-form-question-work-experience">
                                    <div class="admin-student-question-row" id="work-experience-row">
                                        <div class="admin-student-question-title">Work Experience</div>
                                        <div class="admin-student-dropdown-field"
                                            id="adminside-student-dropdown-field-work-experience">
                                            <span class="admin-student-field-text"
                                                id="adminside-student-field-text-work-experience">Text
                                                Field</span>
                                            <span class="admin-student-dropdown-icon"
                                                id="adminside-student-dropdown-icon-work-experience"></span>
                                        </div>
                                    </div>
                                    <div class="admin-student-options-section" id="work-experience-section">
                                        <div class="work-experience-container" id="adminside-work-experience-container">
                                            <div class="work-experience-row" id="work-experience-row-1">
                                                <!-- Experience Letter -->
                                                <div class="work-experience-box">
                                                    <div class="document-name" id="experience-letter-id"
                                                        style="display: none">
                                                        Experience Letter
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="work-experience-experience-letter"
                                                            data-original="Experience Letter">Experience
                                                            Letter</span>
                                                        <span id="work-experience-tenth-remove-icon" class="remove-icon"
                                                            onclick="removeFile('work-experience-tenth', 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="work-experience-tenth" class="upload-icon"
                                                                id="work-experience-tenth-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="work-experience-tenth"
                                                                name="documents[work_experience][experience_letter]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="work-experience-tenth-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container work-experience-tenth-help"
                                                        id="help-container-work-experience-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your experience letter in jpg, png, or pdf
                                                                format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 3 Months Salary Slip -->
                                                <div class="work-experience-box">
                                                    <div class="document-name" id="3-months-salary-slip-id"
                                                        style="display: none">
                                                        3 Months Salary Slip
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="work-experience-monthly-slip"
                                                            data-original="3 Months Salary Slip">3 Months Salary
                                                            Slip</span>
                                                        <span id="work-experience-twelfth-remove-icon"
                                                            class="remove-icon"
                                                            onclick="removeFile('work-experience-twelfth', 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="work-experience-twelfth" class="upload-icon"
                                                                id="work-experience-twelfth-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="work-experience-twelfth"
                                                                name="documents[work_experience][salary_slip]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="work-experience-twelfth-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container work-experience-twelfth-help"
                                                        id="help-container-work-experience-twelfth-id"
                                                        style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 3 months salary slip in jpg, png, or
                                                                pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Office ID -->
                                                <div class="work-experience-box">
                                                    <div class="document-name" id="office-IDs-id" style="display: none">
                                                        Office ID
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="work-experience-office-id"
                                                            data-original="Office ID">Office ID</span>
                                                        <span id="work-experience-graduation-remove-icon"
                                                            class="remove-icon"
                                                            onclick="removeFile('work-experience-graduation', 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="work-experience-graduation" class="upload-icon"
                                                                id="work-experience-graduation-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="work-experience-graduation"
                                                                name="documents[work_experience][office_id]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="work-experience-graduation-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container work-experience-graduation-help"
                                                        id="help-container-work-graduation-id" style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your office ID in jpg, png, or pdf format.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="work-experience-box">
                                                    <div class="document-name" id="joining-letter-id"
                                                        style="display: none">
                                                        Joining Letter
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="work-experience-joining-letter"
                                                            data-original="Joining Letter">Joining
                                                            Letter</span>
                                                        <span id="work-experience-fourth-remove-icon"
                                                            class="remove-icon"
                                                            onclick="removeFile('work-experience-fourth', 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="work-experience-fourth" class="upload-icon"
                                                                id="work-experience-fourth-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="work-experience-fourth"
                                                                name="documents[work_experience][joining_letter]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="work-experience-fourth-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container work-experience-fourth-help"
                                                        id="help-container-work-experience-fourth-id"
                                                        style="display: none">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your joining letter in jpg, png, or pdf
                                                                format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="document-row" id="work-experience-container-id">
                                                    <div class="add-document" id="add-work-experience-btn-id">
                                                        <span class="add-text">Add</span>
                                                        <span class="add-icon">+</span>
                                                    </div>
                                                </div>


                                            </div><!-----close the row-->
  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5. Co-borrower KYC Documents -->
                                <div class="admin-student-form-question"
                                    id="adminside-student-form-question-co-borrower">
                                    <div class="admin-student-question-row" id="co-borrower-kyc-row">
                                        <div class="admin-student-question-title">
                                            Co-borrower KYC Documents
                                        </div>
                                        <div class="admin-student-dropdown-field"
                                            id="adminside-student-dropdown-field-co-borrower">
                                            <span class="admin-student-field-text"
                                                id="adminside-student-field-text-co-borrower">Text
                                                Field</span>
                                            <span class="admin-student-dropdown-icon"
                                                id="adminside-student-dropdown-icon-co-borrower"></span>
                                        </div>
                                    </div>

                                    <div class="admin-student-options-section" id="co-borrower-kyc-section">
                                        <div class="kyc-container-admin" id="adminside-kyc-container-co-borrower">
                                            <div class="document-container-admin"
                                                id="adminside-document-container-co-borrower">
                                                <div class="document-row" id="co-borrower-row-1">
                                                    <!-- PAN Card -->
                                                    <div class="document-box">
                                                        <div class="document-name" id="pan-card-ids"
                                                            style="display: none">
                                                            PAN Card
                                                        </div>
                                                        <div class="upload-field">
                                                            <span id="co-pan-card-name" data-original="PAN Card">PAN
                                                                Card</span>
                                                            <span id="co-remove-icon" class="remove-icon"
                                                                onclick="removeFile('co-pan-card', 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')"><span
                                                                    class="thin-x"></span></span>
                                                            <div class="file-actions">
                                                                <label for="co-pan-card" class="upload-icon"
                                                                    id="co-upload-icon">
                                                                    <img src="assets/images/upload.png"
                                                                        alt="Upload Icon" />
                                                                </label>
                                                                <input type="file" id="co-pan-card"
                                                                    name="documents[co_borrower_kyc][pan_card]"
                                                                    accept=".jpg, .png, .pdf"
                                                                    onchange="handleFileUpload(event, 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')" />
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <span class="help-trigger" data-target="co-pan-card-help">ⓘ
                                                                Help</span>
                                                            <span>*jpg, png, pdf formats</span>
                                                        </div>
                                                        <div class="help-container co-pan-card-help"
                                                            style="display: none">
                                                            <h3 class="help-title">Help</h3>
                                                            <div class="help-content">
                                                                <p>Please upload a .jpg, .png, or .pdf file with a size
                                                                    less than 5MB.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Aadhar Card -->
                                                    <div class="document-box">
                                                        <div class="document-name" id="aadhar-card-id"
                                                            style="display: none">
                                                            Aadhar Card
                                                        </div>
                                                        <div class="upload-field">
                                                            <span id="co-aadhar-card-name"
                                                                data-original="Aadhar Card">Aadhar Card</span>
                                                            <span id="co-aadhar-remove-icon" class="remove-icon"
                                                                onclick="removeFile('co-aadhar-card', 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')"><span
                                                                    class="thin-x"></span></span>
                                                            <div class="file-actions">
                                                                <label for="co-aadhar-card" class="upload-icon"
                                                                    id="co-aadhar-upload-icon">
                                                                    <img src="assets/images/upload.png"
                                                                        alt="Upload Icon" />
                                                                </label>
                                                                <input type="file" id="co-aadhar-card"
                                                                    name="documents[co_borrower_kyc][aadhar_card]"
                                                                    accept=".jpg, .png, .pdf"
                                                                    onchange="handleFileUpload(event, 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')" />
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <span class="help-trigger"
                                                                data-target="co-aadhar-card-help">ⓘ Help</span>
                                                            <span>*jpg, png, pdf formats</span>
                                                        </div>
                                                        <div class="help-container co-aadhar-card-help"
                                                            style="display: none">
                                                            <h3 class="help-title">Help</h3>
                                                            <div class="help-content">
                                                                <p>Please upload a .jpg, .png, or .pdf file with a size
                                                                    less than 5MB.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Address Proof -->
                                                    <div class="document-box">
                                                        <div class="document-name" id="address-proof-id"
                                                            style="display: none">
                                                            Address Proof
                                                        </div>
                                                        <div class="upload-field">
                                                            <span id="co-addressproof"
                                                                data-original="Address Proof">Address Proof</span>
                                                            <span id="co-passport-remove-icon" class="remove-icon"
                                                                onclick="removeFile('co-passport', 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')"><span
                                                                    class="thin-x"></span></span>
                                                            <div class="file-actions">
                                                                <label for="co-passport" class="upload-icon"
                                                                    id="co-passport-upload-icon">
                                                                    <img src="assets/images/upload.png"
                                                                        alt="Upload Icon" />
                                                                </label>
                                                                <input type="file" id="co-passport"
                                                                    name="documents[co_borrower_kyc][address_proof]"
                                                                    accept=".jpg, .png, .pdf"
                                                                    onchange="handleFileUpload(event, 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')" />
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <span class="help-trigger" data-target="co-passport-help">ⓘ
                                                                Help</span>
                                                            <span>*jpg, png, pdf formats</span>
                                                        </div>
                                                        <div class="help-container co-passport-help"
                                                            style="display: none">
                                                            <h3 class="help-title">Help</h3>
                                                            <div class="help-content">
                                                                <p>Please upload a .jpg, .png, or .pdf file with a size
                                                                    less than 5MB.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                      <div id="co-borrower-fields-container">
                                                            <div class="add-document" id="add-co-borrower-btn-id">
                                                                <span class="add-text">Add</span>
                                                                <span class="add-icon">+</span>
                                                            </div>
                                                      </div>
                                                </div>
                                                
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6. Salaried and Business Documents -->
                                <div class="admin-student-form-question"
                                    id="adminside-student-form-question-salaried-business">
                                    <div class="admin-student-question-row" id="salaried-business-row">
                                        <div class="admin-student-question-title">Salaried and Business Documents</div>
                                        <div class="admin-student-dropdown-field"
                                            id="adminside-student-dropdown-field-salaried-business">
                                            <span class="admin-student-field-text"
                                                id="adminside-student-field-text-salaried-business">Text
                                                Field</span>
                                            <span class="admin-student-dropdown-icon"
                                                id="adminside-student-dropdown-icon-salaried-business"></span>
                                        </div>
                                    </div>
                                    <div class="admin-student-options-section" id="salaried-business-section">
                                        <div class="document-container-admin-salary"
                                            id="adminside-document-container-salaried-business">
                                            <!-- Salaried Documents Section -->
                                            <div class="salary-sub-admin" id="adminside-salary-sub-salaried">
                                                <p>If salaried:</p>
                                            </div>

                                            <div class="document-row salary-upload-row" id="salaried-row-1">
                                                <!-- 3 Months Salary Slip -->
                                                <div class="document-box salary-upload-box">
                                                    <div class="document-name" id="salary-slip-id"
                                                        style="display: none;">3 months salary slip
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="salary-slip-name"
                                                            data-original="3 months salary slip">3 months salary
                                                            slip</span>
                                                        <span id="salary-slip-remove-icon" class="remove-icon"
                                                            style="display: none;"
                                                            onclick="removeFile('salary-slip', 'salary-slip-name', 'salary-slip-upload-icon', 'salary-slip-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="salary-slip" class="upload-icon"
                                                                id="salary-slip-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="salary-slip"
                                                                name="documents[salaried_business][salaried][salary_slip]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'salary-slip-name', 'salary-slip-upload-icon', 'salary-slip-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="salary-slip-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container salary-slip-help" style="display: none;">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 3 months salary slip in jpg, png, or
                                                                pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 6 Months Bank Statement -->
                                                <div class="document-box salary-upload-box">
                                                    <div class="document-name" id="bank-statement-id"
                                                        style="display: none;">6 months bank
                                                        statement</div>
                                                    <div class="upload-field">
                                                        <span id="bank-statement-name"
                                                            data-original="6 months bank statement">6 months bank
                                                            statement</span>
                                                        <span id="bank-statement-remove-icon" class="remove-icon"
                                                            style="display: none;"
                                                            onclick="removeFile('bank-statement', 'bank-statement-name', 'bank-statement-upload-icon', 'bank-statement-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="bank-statement" class="upload-icon"
                                                                id="bank-statement-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="bank-statement"
                                                                name="documents[salaried_business][salaried][bank_statement]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'bank-statement-name', 'bank-statement-upload-icon', 'bank-statement-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="bank-statement-help">ⓘ
                                                            Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container bank-statement-help"
                                                        style="display: none;">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 6 months bank statement in jpg, png,
                                                                or pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Address Proof -->
                                                <div class="document-box salary-upload-box">
                                                    <div class="document-name" id="address-proof-salary-id"
                                                        style="display: none;">Address Proof
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="address-proof-salary-name"
                                                            data-original="Address Proof">Address Proof</span>
                                                        <span id="address-proof-salary-remove-icon" class="remove-icon"
                                                            style="display: none;"
                                                            onclick="removeFile('address-proof-salary', 'address-proof-salary-name', 'address-proof-salary-upload-icon', 'address-proof-salary-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="address-proof-salary" class="upload-icon"
                                                                id="address-proof-salary-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="address-proof-salary"
                                                                name="documents[salaried_business][salaried][address_proof]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'address-proof-salary-name', 'address-proof-salary-upload-icon', 'address-proof-salary-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="address-proof-salary-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container address-proof-salary-help"
                                                        style="display: none;">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your address proof in jpg, png, or pdf
                                                                format.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Business Documents Section -->
                                            <div class="salary-sub-admin" id="adminside-salary-sub-business">
                                                <p>If in Business:</p>
                                            </div>
                                            <div class="document-row salary-upload-row" id="business-row-1">
                                                <!-- 2 Years of ITR -->
                                                <div class="document-box salary-upload-box">
                                                    <div class="document-name" id="itr-id" style="display: none;">2
                                                        years of ITR</div>
                                                    <div class="upload-field">
                                                        <span id="itr-name" data-original="2 years of ITR">2 years of
                                                            ITR</span>
                                                        <span id="itr-remove-icon" class="remove-icon"
                                                            style="display: none;"
                                                            onclick="removeFile('itr', 'itr-name', 'itr-upload-icon', 'itr-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="itr" class="upload-icon" id="itr-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="itr"
                                                                name="documents[salaried_business][business][itr]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'itr-name', 'itr-upload-icon', 'itr-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger" data-target="itr-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container itr-help" style="display: none;">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 2 years of ITR in jpg, png, or pdf
                                                                format.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 6 Months Bank Statement -->
                                                <div class="document-box salary-upload-box">
                                                    <div class="document-name" id="business-bank-statement-id"
                                                        style="display: none;">6 months
                                                        bank statement
                                                    </div>
                                                    <div class="upload-field">
                                                        <span id="business-bank-statement-name"
                                                            data-original="6 months bank statement">6 months
                                                            bank statement
                                                        </span>
                                                        <span id="business-bank-statement-remove-icon"
                                                            class="remove-icon" style="display: none;"
                                                            onclick="removeFile('business-bank-statement', 'business-bank-statement-name', 'business-bank-statement-upload-icon', 'business-bank-statement-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="business-bank-statement" class="upload-icon"
                                                                id="business-bank-statement-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="business-bank-statement"
                                                                name="documents[salaried_business][business][bank_statement]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'business-bank-statement-name', 'business-bank-statement-upload-icon', 'business-bank-statement-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="business-bank-statement-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container business-bank-statement-help"
                                                        style="display: none;">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your 6 months bank statement in jpg, png,
                                                                or pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Office/Shop Photographs -->
                                                <div class="document-box salary-upload-box">
                                                    <div class="document-name" id="office-shop-photos-id"
                                                        style="display: none;">Office/Shop
                                                        photographs</div>
                                                    <div class="upload-field">
                                                        <span id="office-shop-photos-name"
                                                            data-original="Office/Shop photographs">Office/Shop
                                                            photographs</span>
                                                        <span id="office-shop-photos-remove-icon" class="remove-icon"
                                                            style="display: none;"
                                                            onclick="removeFile('office-shop-photos', 'office-shop-photos-name', 'office-shop-photos-upload-icon', 'office-shop-photos-remove-icon')"><span
                                                                class="thin-x"></span></span>
                                                        <div class="file-actions">
                                                            <label for="office-shop-photos" class="upload-icon"
                                                                id="office-shop-photos-upload-icon">
                                                                <img src="assets/images/upload.png" alt="Upload Icon" />
                                                            </label>
                                                            <input type="file" id="office-shop-photos"
                                                                name="documents[salaried_business][business][office_photos]"
                                                                accept=".jpg, .png, .pdf"
                                                                onchange="handleFileUpload(event, 'office-shop-photos-name', 'office-shop-photos-upload-icon', 'office-shop-photos-remove-icon')" />
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <span class="help-trigger"
                                                            data-target="office-shop-photos-help">ⓘ Help</span>
                                                        <span>*jpg, png, pdf formats</span>
                                                    </div>
                                                    <div class="help-container office-shop-photos-help"
                                                        style="display: none;">
                                                        <h3 class="help-title">Help</h3>
                                                        <div class="help-content">
                                                            <p>Please upload your office/shop photographs in jpg, png,
                                                                or pdf format.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Salaried and Business fields container -->
                                            <div class="document-row" id="salaried-business-fields-container">
                                                <div class="add-document" id="add-salaried-business-btn-id">
                                                    <span class="add-text">Add</span>
                                                    <span class="add-icon">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="admin-student-form-save-btn-id" class="admin-student-form-save-btn">Save
                        Changes</button>
                    </div>
                    
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            fetchAndAppendSocialNames();
            fetchAndRenderStudyLocations();
            fetchAndRenderDegrees();
            fetchAndRenderCourseDurations();


            // kycInitialization();



            fetchAdditionalPersonalFields();
            fetchAcademics();
            fetchCourseDetailOptions();

            const managers = [
                SectionToggler,
                InputFieldManager,
                SocialOptionsManager,
                CourseLocationManager,
                CourseOptionsManager,
                CourseDurationManager,
                CourseDetailsManager,
                AcademicDetailsManager,
                CoBorrowerManager,
                DocumentFieldManager,
                FormSubmissionManager
            ];
            managers.forEach(manager => manager.init());
        });

        // Utility function for toggling visibility
        const toggleVisibility = (element, isVisible, icon, rotateClass = 'rotated') => {
            element.style.display = isVisible ? 'none' : 'block';
            if (icon) icon.classList.toggle(rotateClass, !isVisible);
        };

        const SectionToggler = {
            init() {
                this.setupToggles([{
                    header: '.admin-student-section-header',
                    content: '.admin-student-section-content',
                    arrow: '.admin-student-arrow-icon img',
                    arrowClasses: ['admin-student-arrow-up', 'admin-student-arrow-down'],
                    defaultExpanded: true
                },
                {
                    header: '#admin-student-person-info',
                    content: '#person-info-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#admin-student-about-us',
                    content: '#about-us-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '.admin-student-section-header-course',
                    content: '.admin-student-section-content-course',
                    arrow: '.admin-student-arrow-icon-course img',
                    rotate: true,
                    defaultExpanded: true
                },
                {
                    header: '#admin-student-course',
                    content: '#person-info-section-course',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question-course'
                },
                {
                    header: '.admin-student-section-header-academic',
                    content: '.admin-student-section-content-academic',
                    arrow: '.admin-student-arrow-icon-academic img',
                    rotate: true,
                    defaultExpanded: true
                },
                {
                    header: '#course-details-row-id',
                    content: '#course-details-options',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#admin-student-section-header-co-borrower-id',
                    content: '.admin-student-section-content-co-borrower',
                    arrow: '.admin-student-arrow-icon-co-borrower img',
                    rotate: true,
                    defaultExpanded: true
                },
                {
                    header: '.admin-student-section-header-document-upload',
                    content: '.admin-student-section-content-document-upload',
                    defaultExpanded: true
                },
                {
                    header: '#student-kyc-row',
                    content: '#student-kyc-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#academic-marks-row',
                    content: '#academic-marks-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#secured-marks-row',
                    content: '#secured-marks-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#work-experience-row',
                    content: '#work-experience-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#co-borrower-kyc-row',
                    content: '#co-borrower-kyc-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                },
                {
                    header: '#salaried-business-row',
                    content: '#salaried-business-section',
                    defaultExpanded: false,
                    parentContainer: '.admin-student-form-question'
                }
                ]);
            },

            setupToggles(configs) {
                configs.forEach(config => {
                    if (!config.header || !config.content) {
                        console.warn(
                            `Invalid config: header (${config.header}) or content (${config.content}) missing`
                        );
                        return;
                    }

                    const header = document.querySelector(config.header);
                    const content = document.querySelector(config.content);
                    const arrow = config.arrow ? document.querySelector(config.arrow) : null;
                    const parentContainer = config.parentContainer ? header.closest(config.parentContainer) :
                        null;

                    if (!header) console.warn(`Header not found: ${config.header}`);
                    if (!content) console.warn(`Content not found: ${config.content}`);
                    if (config.arrow && !arrow) console.warn(`Arrow not found: ${config.arrow}`);
                    if (!header || !content) return;

                    // Set initial state
                    content.style.display = config.defaultExpanded === false ? 'none' : 'block';
                    if (parentContainer) {
                        parentContainer.classList.toggle('active', config.defaultExpanded !== false);
                    }
                    if (arrow && config.rotate) {
                        arrow.style.transition = 'transform 0.3s ease';
                        arrow.style.transform = config.defaultExpanded === false ? 'rotate(0deg)' :
                            'rotate(180deg)';
                    }

                    // Add click event listener
                    header.addEventListener('click', () => {
                        const isVisible = content.style.display === 'block';
                        console.log(`Toggling ${config.content}: isVisible=${isVisible}`);
                        content.style.display = isVisible ? 'none' : 'block';
                        if (arrow && config.rotate) {
                            arrow.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
                        }
                        if (parentContainer) {
                            parentContainer.classList.toggle('active', !isVisible);
                        }
                    });
                });
            }
        };

        const InputFieldManager = {
            section: 'Personal Information',
            modified: false,

            init() {
                this.setupEvents();
            },

            setupEvents() {
                document.addEventListener('click', e => {
                    if (e.target.classList.contains('remove-option')) {
                        e.target.closest('.input-group').remove();
                        this.reorganizeInputs();
                        this.modified = true;
                    }
                });

                const addInputField = document.getElementById('add-input-field');
                if (addInputField) {
                    addInputField.addEventListener('click', () => {
                        const label = prompt("Enter field label (e.g., Country, Favorite Color):")?.trim();
                        if (!label) return;

                        const name = prompt("Enter a unique field name (e.g., country, favorite_color):")
                            ?.trim();
                        if (!name) return;

                        const fieldType = prompt("Enter field type (text, select, checkbox, radio, date):")
                            ?.trim();
                        if (!fieldType) return;
                        const sectionSeperate = "general";
                        this.addNewInputField({
                            label,
                            name,
                            type: fieldType,
                            sectionSeperate
                        });
                    });
                }
            },

            addNewInputField({
                label,
                name,
                type,
                sectionSeperate
            }) {
                let options = [];

                if (['select', 'checkbox', 'radio'].includes(type)) {
                    const optionString = prompt("Enter options separated by commas (e.g., Red,Green,Blue):");
                    if (optionString) {
                        options = optionString.split(',').map(opt => opt.trim()).filter(Boolean);
                    }
                }

                fetch('/api/addadditionalpersonalinfodata', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        label,
                        name,
                        type,
                        required: true,
                        options,
                        sectionSeperate
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.field) {
                            console.log('Field added:', data.field);
                            fetchAdditionalPersonalFields();
                        } else {
                            console.error('Failed to add field:', data);
                        }
                    })
                    .catch(err => console.error('API Error:', err));
            },

            reorganizeInputs() {
                const allInputs = document.querySelectorAll('.input-group');
                const addField = document.getElementById('add-input-field');
                let row1 = document.getElementById('input-row-1');
                let row2 = document.getElementById('input-row-2');
                if (!row1 || !row2) return;

                row1.innerHTML = '';
                row2.innerHTML = '';
                const existingRow3 = document.getElementById('input-row-3');
                if (existingRow3) existingRow3.remove();

                let row3 = allInputs.length > 6 ? document.createElement('div') : null;
                if (row3) {
                    row3.className = 'input-row';
                    row3.id = 'input-row-3';
                    row2.parentNode.insertBefore(row3, row2.nextSibling);
                }

                allInputs.forEach((input, i) => {
                    if (i < 3) row1.appendChild(input);
                    else if (i < 6) row2.appendChild(input);
                    else if (row3) row3.appendChild(input);
                });

                const lastRow = row3 || (allInputs.length > 3 ? row2 : row1);
                const inputsInLastRow = lastRow.querySelectorAll('.input-group').length;
                if (inputsInLastRow < 3) {
                    lastRow.appendChild(addField);
                } else {
                    const newRow = document.createElement('div');
                    newRow.className = 'input-row';
                    newRow.id = `input-row-${row3 ? '4' : (row2.children.length > 0 ? '3' : '2')}`;
                    newRow.appendChild(addField);
                    lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
                }
            },

            getDynamicFields() {
                const inputs = document.querySelectorAll('.input-group input[disabled]');
                const fields = [];
                inputs.forEach(input => {
                    const fieldName = input.placeholder;
                    fields.push({
                        name: fieldName,
                        type: 'text'
                    });
                });
                return fields;
            },

            isModified() {
                return this.modified;
            }
        };

        const SocialOptionsManager = {
            section: 'Personal Information',
            modified: false,

            init() {
                this.setupRemoveButtons();
                this.setupAddButton();
            },

            setupRemoveButtons() {
                document.querySelectorAll('.social-remove').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const socialOption = btn.parentElement;
                        socialOption.remove();
                        this.modified = true;
                        FormSubmissionManager.setModifiedSection(this.section);
                    });
                });
            },

            setupAddButton() {
                const addSocialButton = document.querySelector('.add-social');
                if (addSocialButton) {
                    addSocialButton.addEventListener('click', () => {
                        const userInput = prompt("Enter dropdown option", "")?.trim();
                        if (userInput) {
                            fetch('/api/storesocialoption', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        ?.content
                                },
                                body: JSON.stringify({
                                    name: userInput
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.error) {
                                        alert(`Error: ${data.error}`);
                                        return;
                                    }

                                    fetchAndAppendSocialNames();






                                })
                                .catch(error => {
                                    console.error('Fetch error:', error);
                                    alert('An error occurred while saving the option.');
                                });
                        }
                    });
                }
            },

            getDynamicFields() {
                const options = Array.from(document.querySelectorAll('.social-option .social-name')).map(span => span
                    .textContent);
                return options.length > 0 ? [{
                    name: 'Source',
                    type: 'dropdown',
                    options: options
                }] : [];
            },

            isModified() {
                return this.modified;
            }
        };

        // Course Location Manager
        const CourseLocationManager = {
            section: 'Course Information',
            modified: false,

            init() {
                this.setupCheckboxContainer();
                // setupQuestionRow removed; handled by SectionToggler
            },

            setupCheckboxContainer() {
                const checkboxContainer = document.getElementById('selected-study-location');
                const addCheckboxContainer = document.querySelector('.add-checkbox-container');
                if (checkboxContainer && addCheckboxContainer) {
                    addCheckboxContainer.addEventListener('click', e => {
                        e.preventDefault();
                        this.addNewCheckbox(checkboxContainer, addCheckboxContainer);
                        this.modified = true;
                        FormSubmissionManager.setModifiedSection(this.section);
                    });
                }
            },

            addNewCheckbox(checkboxContainer, addCheckboxContainer) {
                const newCountry = prompt("Enter country name", "")?.trim();
                if (newCountry) {
                    const existingCountries = Array.from(checkboxContainer.querySelectorAll('input[type="checkbox"]'))
                        .map(cb => cb.value.toLowerCase());
                    if (existingCountries.includes(newCountry.toLowerCase())) {
                        alert('This country is already in the list');
                        return;
                    }

                    const newLabel = document.createElement('label');
                    newLabel.innerHTML = `
              <input type="checkbox" value="${newCountry}" disabled> ${newCountry}
            `;
                    checkboxContainer.insertBefore(newLabel, addCheckboxContainer);
                }
            },

            getDynamicFields() {
                const checkboxes = document.querySelectorAll('#selected-study-location input[type="checkbox"]');
                const options = Array.from(checkboxes).map(cb => cb.value);
                return options.length > 0 ? [{
                    name: 'Location',
                    type: 'checkbox',
                    options: options
                }] : [];
            },

            isModified() {
                return this.modified;
            }
        };

        // Course Options Manager
        const CourseOptionsManager = {
            section: 'Course Information',
            modified: false,

            init() {
                this.setupDropdown();
                this.setupAddOption();
            },

            setupDropdown() {
                const optionsContainer = document.getElementById('option-section-degree-container');
                const dropdownTrigger = document.getElementById('admin-student-course-second');
                const parentContainer = dropdownTrigger?.closest('.admin-student-form-question-course-degree');
                if (!optionsContainer || !dropdownTrigger || !parentContainer) {
                    console.error('setupDropdown: Missing elements', {
                        optionsContainer,
                        dropdownTrigger,
                        parentContainer
                    });
                    return;
                }

                optionsContainer.style.display = 'none';
                dropdownTrigger.addEventListener('click', e => {
                    e.stopPropagation();
                    const isVisible = optionsContainer.style.display === 'block';
                    toggleVisibility(optionsContainer, isVisible);
                    parentContainer.classList.toggle('active', !isVisible);
                });
            },

            setupAddOption() {
                const addSection = document.getElementById('addSection');
                const optionsGrid = document.getElementById('optionsContainer');
                if (addSection && optionsGrid) {
                    addSection.addEventListener('click', e => {
                        e.stopPropagation();
                        const newOptionName = prompt('Enter new degree type:')?.trim();
                        if (newOptionName) {
                            const newOptionItem = document.createElement('div');
                            newOptionItem.className = 'option-item';
                            newOptionItem.innerHTML = `
                  <input type="checkbox" value="${newOptionName}" disabled>
                  <div class="option-name">${newOptionName}</div>
                `;
                            optionsGrid.insertBefore(newOptionItem, addSection);
                            this.modified = true;
                            FormSubmissionManager.setModifiedSection(this.section);
                        }
                    });
                }
            },

            getDynamicFields() {
                const checkboxes = document.querySelectorAll('#optionsContainer input[type="checkbox"]');
                const options = Array.from(checkboxes).map(cb => cb.value);
                return options.length > 0 ? [{
                    name: 'Degree',
                    type: 'checkbox',
                    options: options
                }] : [];
            },

            isModified() {
                return this.modified;
            }
        };
        // Course Duration Manager
        const CourseDurationManager = {
            section: 'Course Information',
            modified: false,

            init() {
                this.setupDropdown();
                this.setupRemoveButtons();
                this.setupAddButton();
            },

            setupDropdown() {
                const rowElement = document.getElementById('course-row-month-id');
                const dropdownElement = document.getElementById('course-dropdown-month-id');
                const optionsSection = document.getElementById('course-duration-section-month');
                if (!rowElement || !dropdownElement || !optionsSection) return;

                optionsSection.style.display = 'none';
                const toggleOptions = () => {
                    const isHidden = optionsSection.style.display === 'none';


                    toggleVisibility(optionsSection, !isHidden, document.querySelector(
                        '#admin-student-dropdown-icon-id'));
                    document.querySelector('.admin-student-form-question-month').classList.toggle('active',
                        isHidden);
                };

                rowElement.addEventListener('click', toggleOptions);
                dropdownElement.addEventListener('click', e => {
                    e.stopPropagation();
                    toggleOptions();
                });
            },

            setupRemoveButtons() {
                document.querySelectorAll('.course-remove').forEach(btn => {
                    btn.addEventListener('click', e => {
                        e.stopPropagation();
                        btn.parentElement.remove();
                        this.modified = true;
                        FormSubmissionManager.setModifiedSection(this.section);
                    });
                });
            },

            setupAddButton() {
                document.querySelector('.add-course')?.addEventListener('click', e => {
                    e.stopPropagation();
                    this.addNewDurationOption();
                    this.modified = true;
                    FormSubmissionManager.setModifiedSection(this.section);
                });
            },

            addNewDurationOption() {
                const userInput = prompt("Enter course duration option (in months)", "")?.trim();

                if (userInput && !isNaN(userInput)) {
                    fetch('/api/storecourseduration', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            duration_in_months: userInput
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                alert(data.message);
                                fetchAndRenderCourseDurations();
                            } else {
                                alert('Failed to save duration. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error occurred. Check console for details.');
                        });
                }
            },

            getDynamicFields() {
                const options = Array.from(document.querySelectorAll('.course-option .course-name')).map(span => span
                    .textContent);
                return options.length > 0 ? [{
                    name: 'Duration',
                    type: 'dropdown',
                    options: options
                }] : [];
            },

            isModified() {
                return this.modified;
            }
        };

        const CourseDetailsManager = {
            section: 'Course Information',
            modified: false,

            init() {
                const optionsContainer = document.querySelector('#course-details-options .checkbox-options-container');
                // console.log('Initial optionsContainer:', optionsContainer);
                this.setupDropdown();
                this.setupAddOption();
            },

            setupDropdown() {
                const container = document.getElementById('course-details-container');
                if (!container) return;

                const row = container.querySelector('#course-details-row');
                const dropdownIcon = container.querySelector('.admin-student-dropdown-icon');
                const optionsSection = container.querySelector('#course-details-options');
                if (!row || !dropdownIcon || !optionsSection) return;

                optionsSection.style.display = 'none';
                row.addEventListener('click', () => {
                    const isVisible = optionsSection.style.display !== 'none';
                    toggleVisibility(optionsSection, isVisible, dropdownIcon);
                    container.classList.toggle('active', !isVisible);
                });
            },

            setupAddOption() {
                const addOptionBtn = document.getElementById('add-course-option-btn');
                if (addOptionBtn) {
                    // console.log('Attaching event listener to add-course-option-btn');
                    addOptionBtn.addEventListener('click', e => {
                        e.stopPropagation();
                        this.addNewCourseOption();
                        this.modified = true;
                        FormSubmissionManager.setModifiedSection(this.section);
                    });
                } else {
                    console.error('add-course-option-btn not found');
                }
            },

            addNewCourseOption() {
                const userInput = prompt("Enter new course option", "")?.trim();
                if (userInput) {
                    // Send the input to Laravel backend
                    fetch('/api/course-options', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            label: userInput
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            alert(`Course option added: ${data.label}`);
                            fetchCourseDetailOptions();

                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to add course option');
                        });
                }
            },

            getDynamicFields() {
                const checkboxes = document.querySelectorAll('#course-details-options input[type="checkbox"]');
                const options = Array.from(checkboxes).map(cb => cb.value);
                return options.length > 0 ? [{
                    name: 'Course Option',
                    type: 'checkbox',
                    options: options
                }] : [];
            },

            isModified() {
                return this.modified;
            }
        };


        //Academic details

        const AcademicDetailsManager = {
            section: 'Academic Details',
            modified: false,
            educationRowCount: 0,
            gapOptionCount: 2,

            init() {
                // console.log('AcademicDetailsManager.init called');
                this.setupSectionToggle();
                this.setupEducationSection();
                this.setupAcademicGapSection();
            },

            setupSectionToggle() {
                const section = document.getElementById('academic-details-section');
                const content = document.getElementById('academic-details-content');
                const arrow = document.querySelector('.admin-student-arrow-icon-academic');
                if (section && content && arrow) {
                    section.addEventListener('click', () => {
                        content.classList.toggle('expanded');
                        arrow.classList.toggle('rotated');
                    });
                } else {
                    console.error('setupSectionToggle: Missing elements', {
                        section,
                        content,
                        arrow
                    });
                }
            },

            setupEducationSection() {
                // console.log('setupEducationSection called');
                const container = document.getElementById('education-container');
                const headerRow = document.getElementById('education-header-row');
                const dropdownIcon = container?.querySelector('.admin-student-dropdown-icon');
                const section = document.getElementById('education-section');
                if (!container || !headerRow || !dropdownIcon || !section) {
                    console.error('setupEducationSection: Missing elements', {
                        container,
                        headerRow,
                        dropdownIcon,
                        section
                    });
                    return;
                }

                section.style.display = 'none';
                headerRow.addEventListener('click', e => {
                    e.stopPropagation();
                    const isVisible = section.style.display === 'block';
                    toggleVisibility(section, isVisible, dropdownIcon);
                    container.classList.toggle('active', !isVisible);
                });

                const addButtonEducation = document.getElementById('add-education-field-btn');
                if (addButtonEducation) {
                    addButtonEducation.addEventListener('click', () => {
                        const label = prompt("Enter field label (e.g., Country, Favorite Color):")?.trim();
                        if (!label) return;

                        const name = prompt("Enter a unique field name (e.g., country, favorite_color):")
                            ?.trim();
                        if (!name) return;

                        const fieldType = prompt("Enter field type (text, select, checkbox, radio, date):")
                            ?.trim();
                        if (!fieldType) return;

                        const academicSection = 'academic';
                        this.addEducationInputField({
                            label,
                            name,
                            type: fieldType,
                            sectionSeperate: academicSection
                        });
                    });
                }
            },

            addEducationInputField({
                label,
                name,
                type,
                sectionSeperate
            }) {
                let options = [];

                if (['select', 'checkbox', 'radio'].includes(type)) {
                    const optionString = prompt("Enter options separated by commas (e.g., Red,Green,Blue):");
                    if (optionString) {
                        options = optionString.split(',').map(opt => opt.trim()).filter(Boolean);
                    }
                }

                fetch('/api/addadditionalpersonalinfodata', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        label,
                        name,
                        type,
                        required: true,
                        options,
                        sectionSeperate
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.field) {
                            console.log('Field added:', data.field);
                            fetchAcademics();
                        } else {
                            console.error('Failed to add field:', data);
                        }
                    })
                    .catch(err => console.error('API Error:', err));
            },

            setupAcademicGapSection() {
                // console.log('setupAcademicGapSection called');
                const container = document.getElementById('academic-gap-container');
                const row = container?.querySelector('#academic-gap-row');
                const dropdownIcon = container?.querySelector('.admin-student-dropdown-icon');
                const optionsSection = container?.querySelector('#academic-gap-options');
                if (!container || !row || !dropdownIcon || !optionsSection) {
                    console.error('setupAcademicGapSection: Missing elements', {
                        container,
                        row,
                        dropdownIcon,
                        optionsSection
                    });
                    return;
                }

                optionsSection.style.display = 'none';
                row.addEventListener('click', e => {
                    e.stopPropagation();
                    const isVisible = optionsSection.style.display === 'block';
                    toggleVisibility(optionsSection, isVisible, dropdownIcon);
                    container.classList.toggle('active', !isVisible);
                });

                const addOptionButton = container.querySelector('#add-academic-option-btn');
                if (addOptionButton) {
                    addOptionButton.addEventListener('click', e => {
                        e.stopPropagation();
                        this.addAcademicGapOption();
                        this.modified = true;
                        try {
                            FormSubmissionManager.setModifiedSection(this.section);
                        } catch (error) {
                            console.error('Error in FormSubmissionManager.setModifiedSection:', error);
                        }
                    });
                } else {
                    console.error('add-academic-option-btn not found');
                }
            },

            addAcademicGapOption() {
                console.log('addAcademicGapOption called');
                const userInput = prompt("Enter new option", "")?.trim();
                if (userInput) {
                    const optionsContainer = document.querySelector('.academic-options');
                    if (optionsContainer) {
                        const newOption = document.createElement('div');
                        newOption.className = 'academic-option';
                        const radioId = `academic-option-${this.gapOptionCount++}`;
                        newOption.innerHTML = `
          <input type="radio" id="${radioId}" value="${userInput}" disabled>
          <label for="${radioId}">${userInput}</label>
        `;
                        optionsContainer.appendChild(newOption);
                        console.log('Added new academic gap option:', userInput);
                    } else {
                        console.error('.academic-options container not found');
                    }
                } else {
                    console.log('No option provided or prompt cancelled');
                }
            },

            getDynamicFieldsForGap() {
                console.log('getDynamicFieldsForGap called');
                const radios = document.querySelectorAll('#academic-gap-options input[type="radio"]');
                const options = Array.from(radios).map(radio => radio.value);
                return options.length > 0 ? [{
                    name: 'Gap',
                    type: 'checkbox',
                    options: options
                }] : [];
            },

            isModified() {
                return this.modified;
            }
        };

        const CoBorrowerManager = {
            section: 'Co-Borrower Information',
            modified: false,

            init() {
                this.setupDropdowns([{
                    containerId: 'co-borrower-container',
                    rowId: 'co-borrower-row',
                    optionsId: 'co-borrower-options'
                },
                {
                    containerId: 'income-container',
                    rowId: 'income-row',
                    optionsId: 'income-options'
                },
                {
                    containerId: 'liability-container',
                    rowId: 'liability-row',
                    optionsId: 'liability-options'
                }
                ]);
                this.setupCoBorrowerOptions();
                this.setupIncomeFields();
                this.setupLiabilityFields();
                this.setupCoBorrowerSectionToggle();
            },

            setupDropdowns(dropdowns) {
                dropdowns.forEach(({
                    containerId,
                    rowId,
                    optionsId
                }) => {
                    const container = document.getElementById(containerId);
                    const row = document.getElementById(rowId);
                    const options = document.getElementById(optionsId);
                    const dropdownIcon = row?.querySelector('.admin-student-dropdown-icon');
                    if (container && row && options && dropdownIcon) {
                        options.style.display = 'none';
                        row.addEventListener('click', () => {
                            const isVisible = options.style.display !== 'none';
                            toggleVisibility(options, isVisible, dropdownIcon);
                            container.classList.toggle('active', !isVisible);
                        });
                    }
                });
            },

            setupCoBorrowerOptions() {
                const addOptionBtn = document.getElementById('add-coborrower-option-btn');
                if (addOptionBtn) {
                    addOptionBtn.addEventListener('click', e => {
                        e.stopPropagation();
                        const userInput = prompt("Enter new relationship option", "")?.trim();
                        if (userInput) {
                            const optionsContainer = document.querySelector(
                                '#co-borrower-options .checkbox-options-container');
                            const newOption = document.createElement('div');
                            newOption.className = 'checkbox-option';
                            newOption.innerHTML = `
              <input type="checkbox" value="${userInput}" disabled>
              <label>${userInput}</label>
            `;
                            optionsContainer.insertBefore(newOption, addOptionBtn);
                            this.modified = true;
                            FormSubmissionManager.setModifiedSection(this.section);
                        }
                    });
                }
            },

            setupIncomeFields() {
                document.querySelectorAll('.delete-field').forEach(btn => {
                    btn.addEventListener('click', e => {
                        e.stopPropagation();
                        btn.closest('.field-container').remove();
                        this.modified = true;
                        FormSubmissionManager.setModifiedSection(this.section);
                    });
                });

                const addIncomeFieldBtn = document.getElementById('add-income-field-btn');
                if (addIncomeFieldBtn) {
                    addIncomeFieldBtn.addEventListener('click', e => {
                        e.stopPropagation();
                        const userInput = prompt("Enter field name", "")?.trim();
                        if (userInput) {
                            const fieldsRowContainer = document.querySelector('.fields-row-container');
                            const fieldContainer = document.createElement('div');
                            fieldContainer.className = 'field-container';
                            fieldContainer.innerHTML = `
              <input type="text" class="text-input" placeholder="${userInput}" disabled>
              <button class="delete-field">✕</button>
            `;
                            fieldsRowContainer.insertBefore(fieldContainer, addIncomeFieldBtn);
                            fieldContainer.querySelector('.delete-field').addEventListener('click', e => {
                                e.stopPropagation();
                                fieldContainer.remove();
                                this.modified = true;
                                FormSubmissionManager.setModifiedSection(this.section);
                            });
                            this.modified = true;
                            FormSubmissionManager.setModifiedSection(this.section);
                        }
                    });
                }
            },

            setupLiabilityFields() {
                const addLiabilityBtn = document.getElementById('add-liability-btn');
                if (addLiabilityBtn) {
                    addLiabilityBtn.addEventListener('click', e => {
                        e.stopPropagation();
                        const userInput = prompt("Enter field name for liability", "")?.trim();
                        if (userInput) {
                            const additionalFields = document.getElementById('additional-liability-fields');
                            const fieldContainer = document.createElement('div');
                            fieldContainer.className = 'liability-input-container';
                            fieldContainer.innerHTML = `
              <input type="text" class="text-input" placeholder="${userInput}" disabled>
              <button class="delete-liability-field">✕</button>
            `;
                            additionalFields.appendChild(fieldContainer);
                            fieldContainer.querySelector('.delete-liability-field').addEventListener('click',
                                e => {
                                    e.stopPropagation();
                                    fieldContainer.remove();
                                    this.modified = true;
                                    FormSubmissionManager.setModifiedSection(this.section);
                                });
                            this.modified = true;
                            FormSubmissionManager.setModifiedSection(this.section);
                        }
                    });
                }
            },

            setupCoBorrowerSectionToggle() {
                const header = document.querySelector('.admin-student-section-header-co-borrower');
                const content = document.querySelector('.admin-student-form-section-co-borrower');
                const arrow = document.querySelector('.admin-student-arrow-icon-co-borrower');
                if (header && content && arrow) {
                    content.classList.add('visible'); // Ensure section is visible by default
                    header.addEventListener('click', () => {
                        const isVisible = content.classList.contains('visible');
                        content.classList.toggle('visible', !isVisible);
                        content.classList.toggle('hidden', isVisible);
                        arrow.classList.toggle('rotated', !isVisible);
                    });
                }
            },

            getDynamicFields() {
                const fields = [];
                const relationCheckboxes = document.querySelectorAll('#co-borrower-options input[type="checkbox"]');
                if (relationCheckboxes.length > 0) {
                    const options = Array.from(relationCheckboxes).map(cb => cb.value);
                    fields.push({
                        name: 'Relation',
                        type: 'checkbox',
                        options: options
                    });
                }
                const incomeFields = document.querySelectorAll('.fields-row-container input[disabled]');
                incomeFields.forEach(input => {
                    fields.push({
                        name: input.placeholder,
                        type: 'text'
                    });
                });
                const liabilityFields = document.querySelectorAll('#additional-liability-fields input[disabled]');
                liabilityFields.forEach(input => {
                    fields.push({
                        name: input.placeholder,
                        type: 'text'
                    });
                });
                return fields;
            },

            isModified() {
                return this.modified;
            }
        };

        const DocumentFieldManager = {
            section: 'Document Upload',
            modified: false,
            counts: {
                document: 0,
                academic: 0,
                secured: 0,
                workExperience: 0,
                coBorrower: 0,
                salariedBusiness: 0
            },

            init() {
                const buttons = [{
                    id: 'add-document-btn-kyc-id',
                    type: 'document',
                    containerId: 'document-fields-container-kyc-id',
                    rowId: 'document-row-1',
                    apiEndpoint: '/getdocumenttypesadminform',
                    namePrefix: 'student_kyc',
                    slug: 'kyc'
                },
                {
                    id: 'add-academic-btn-id',
                    type: 'academic',
                    containerId: 'academic-fields-container-id',
                    rowId: 'academic-row-1',
                    apiEndpoint: '/getdocumenttypesadminform',
                    namePrefix: 'academic_marks',
                    slug: 'academic'
                },
                {
                    id: 'add-secured-btn-id',
                    type: 'secured',
                    containerId: 'secured-fields-container-id',
                    rowId: 'secured-row-1',
                    apiEndpoint: '/getdocumenttypesadminform',
                    namePrefix: 'secured_marks',
                    slug: 'secured'
                },
                {
                    id: 'add-work-experience-btn-id',
                    type: 'workExperience',
                    containerId: 'work-experience-container-id',
                    rowId: 'work-experience-row-1',
                    apiEndpoint: '/getdocumenttypesadminform',
                    namePrefix: 'work_experience',
                    slug: 'experience'
                },
                {
                    id: 'add-co-borrower-btn-id',
                    type: 'coBorrower',
                    containerId: 'co-borrower-fields-container',
                    rowId: 'co-borrower-row-1',
                    apiEndpoint: '/getdocumenttypesadminform',
                    namePrefix: 'co_borrower_kyc',
                    slug: 'co-borrower'
                },
                {
                    id: 'add-salaried-business-btn-id',
                    type: 'salariedBusiness',
                    containerId: 'salaried-business-fields-container',
                    rowId: 'salaried-row-1',
                    apiEndpoint: '/getdocumenttypesadminform',
                    namePrefix: 'salaried_business',
                    subSections: ['salaried', 'business'],
                    slug: 'business-document'
                }
                ];


                buttons.forEach(({
                    id,
                    type,
                    containerId,
                    rowId,
                    apiEndpoint,
                    namePrefix,
                    subSections,
                    slug
                }) => {
                    const button = document.getElementById(id);
                    if (button) {
                        button.addEventListener('click', (e) => {
                            e.stopPropagation();
                            let fieldType = prompt(`Enter ${type} document type:`)?.trim();
                            let subSection = '';
                            if (type === 'salariedBusiness' && fieldType) {
                                subSection = prompt('Enter sub-section (salaried or business):')
                                    ?.trim();
                                if (!['salaried', 'business'].includes(subSection)) {
                                    alert(
                                        'Invalid sub-section. Please enter "salaried" or "business".'
                                    );
                                    return;
                                }
                            }
                            if (fieldType) {
                                this.addNewDocumentField(fieldType, type, containerId, rowId,
                                    apiEndpoint, namePrefix, subSection, slug);
                                this.modified = true;
                                // Assuming FormSubmissionManager exists
                                if (typeof FormSubmissionManager !== 'undefined') {
                                    FormSubmissionManager.setModifiedSection(this.section);
                                }
                            }
                        });
                    }
                    this.initializeSection(containerId, rowId, apiEndpoint, namePrefix, type, subSections,
                        slug);
                });

                this.setupHelpTriggerListener();
            },

            setupHelpTriggerListener() {
                document.removeEventListener('click', this.handleHelpTriggerClick);
                this.handleHelpTriggerClick = (e) => {
                    if (e.target.classList.contains('help-trigger')) {
                        e.stopPropagation(); // Prevent interference with other click events
                        const targetId = e.target.getAttribute('data-target');
                        const helpContainer = document.querySelector(`.${targetId}`);
                        if (helpContainer) {
                            helpContainer.style.display = helpContainer.style.display === 'none' ? 'block' : 'none';
                        } else {
                            console.warn(`Help container with class .${targetId} not found`);
                        }
                    }
                };
                document.addEventListener('click', this.handleHelpTriggerClick);
            },

            initializeSection(containerId, rowId, apiEndpoint, namePrefix, type, subSections, slug) {
                const container = document.getElementById(rowId);
                if (!container) return;

                container.innerHTML = '';

                const staticDocs = {
                    document: [{
                        key: 'pan-card',
                        name: 'PAN Card'
                    },
                    {
                        key: 'aadhar-card',
                        name: 'Aadhar Card'
                    },
                    {
                        key: 'passport',
                        name: 'Passport'
                    }
                    ],
                    academic: [{
                        key: 'tenth-grade',
                        name: '10th Grade Mark Sheet'
                    },
                    {
                        key: 'twelfth-grade',
                        name: '12th Grade Mark Sheet'
                    },
                    {
                        key: 'graduation-grade',
                        name: 'Graduation Mark Sheet'
                    }
                    ],
                    secured: [{
                        key: 'secured-tenth',
                        name: '10th Grade'
                    },
                    {
                        key: 'secured-twelfth',
                        name: '12th Grade'
                    },
                    {
                        key: 'secured-graduation',
                        name: 'Graduation'
                    }
                    ],
                    workExperience: [{
                        key: 'work-experience-letter',
                        name: 'Experience Letter'
                    },
                    {
                        key: 'work-salary-slip',
                        name: '3 Months Salary Slip'
                    },
                    {
                        key: 'work-office-id',
                        name: 'Office ID'
                    },
                    {
                        key: 'work-joining-letter',
                        name: 'Joining Letter'
                    }
                    ],
                    coBorrower: [{
                        key: 'co-pan-card',
                        name: 'PAN Card'
                    },
                    {
                        key: 'co-aadhar-card',
                        name: 'Aadhar Card'
                    },
                    {
                        key: 'co-address-proof',
                        name: 'Address Proof'
                    }
                    ],
                    salariedBusiness: [{
                        key: 'salary-slip',
                        name: '3 months salary slip',
                        subSection: 'salaried'
                    },
                    {
                        key: 'bank-statement',
                        name: '6 months bank statement',
                        subSection: 'salaried'
                    },
                    {
                        key: 'address-proof-salary',
                        name: 'Address Proof',
                        subSection: 'salaried'
                    },
                    {
                        key: 'itr',
                        name: '2 years of ITR',
                        subSection: 'business'
                    },
                    {
                        key: 'business-bank-statement',
                        name: '6 months bank statement',
                        subSection: 'business'
                    },
                    {
                        key: 'office-shop-photos',
                        name: 'Office/Shop photographs',
                        subSection: 'business'
                    }
                    ]
                };

                if (type === 'salariedBusiness') {
                    const salariedContainer = document.getElementById('salaried-row-1');
                    const businessContainer = document.getElementById('business-row-1');
                    if (salariedContainer && businessContainer) {
                        salariedContainer.innerHTML = '';
                        businessContainer.innerHTML = '';
                        staticDocs[type].forEach(doc => {
                            const targetContainer = doc.subSection === 'salaried' ? salariedContainer :
                                businessContainer;
                            targetContainer.appendChild(this.createDocumentBox(doc, false, namePrefix, type));
                        });
                    }
                } else {
                    staticDocs[type].forEach(doc => {
                        container.appendChild(this.createDocumentBox(doc, false, namePrefix, type));
                    });
                }

                fetch(`/api${apiEndpoint}/${slug}`)


                    .then(res => res.json())
                    .then(data => {
                        const dynamicDocs = data.documentTypes || [];
                        if (type === 'salariedBusiness') {
                            const salariedContainer = document.getElementById('salaried-row-1');
                            const businessContainer = document.getElementById('business-row-1');
                            if (salariedContainer && businessContainer) {
                                dynamicDocs.forEach(doc => {
                                    const targetContainer = doc.subSection === 'salaried' ?
                                        salariedContainer : businessContainer;
                                    targetContainer.appendChild(this.createDocumentBox(doc, true,
                                        namePrefix, type));
                                });
                            }
                        } else {
                            dynamicDocs.forEach(doc => {
                                container.appendChild(this.createDocumentBox(doc, true, namePrefix, type));
                            });
                        }
                        this.deleteInitialization(containerId, apiEndpoint, namePrefix, type);
                        this.setupHelpTriggerListener();
                    })
                    .catch(err => console.error(`Error fetching dynamic documents for ${type}:`, err));
            },

            addNewDocumentField(fieldType, type, containerId, rowId, apiEndpoint, namePrefix, subSection = '', slug) {
                fetch('/api/kycdynamicpost', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        name: fieldType,
                        type,
                        subSection
                    })
                })
                    .then(response => {
                        if (response.ok) return response.json();
                        else throw new Error("Document type may already exist.");
                    })
                    .then(data => {
                        console.log("Added Document Type:", data);

                        // ✅ Call the fetch to refresh document types for the slug
                        return fetch(`/getdocumenttypesadminform/${slug}`, {
                            headers: {
                                'Accept': 'application/json' // or 'text/html' depending on your server
                            }
                        });
                    })
                    .then(response => {
                        if (!response.ok) throw new Error("Failed to refresh document form.");

                        // ✅ Optional: You might not need to do anything if the page auto-updates
                        // But if needed: parse and trigger your update logic
                        return response.text(); // or .json() if it's JSON
                    })
                    .then(data => {
                        // Optional: handle response if needed
                        console.log(`Refreshed form for ${slug}`, data);
                    })
                    .catch(error => {
                        alert(error.message);
                    });
            },



            createDocumentBox(doc, isDynamic, namePrefix, type) {
                const key = (doc.key || doc.name.toLowerCase().replace(/[^a-z0-9-_]/g, '-')).trim();
                const displayName = doc.name;
                const subSection = doc.subSection || '';

                const uploadIconHTML = isDynamic ?
                    `<p class="kyc-delete-dynamic-content" data-id="${doc.id}" data-target="${key}" style="cursor: pointer; color: gray; font-size: 14px; margin: 0;">x</p>` :
                    '';

                const div = document.createElement('div');
                div.className =
                    `document-box ${subSection ? 'salary-upload-box' : type === 'workExperience' ? 'work-experience-box' : ''}`;
                div.id = `document-box-${key}`;
                div.innerHTML = `
            <div class="document-name" id="${key}-document-name" style="display: none">${displayName}</div>
            <div class="upload-field">
                <span id="${key}-name" data-original="${displayName}" title="${displayName}">${displayName}</span>
                <span id="${key}-remove-icon" class="remove-icon" style="display: none;"
                onclick="DocumentFieldManager.removeFile('${key}', '${key}-name', '${key}-upload-icon', '${key}-remove-icon')"><span class="thin-x">×</span></span>
                ${uploadIconHTML} <!-- Add the delete icon here -->
                <div class="file-actions">
                <label for="${key}" class="upload-icon" id="${key}-upload-icon" onclick="console.log('Upload icon clicked for ${key}')">
                </label>
                <input type="file" id="${key}" name="documents[${namePrefix}${subSection ? `[${subSection}]` : ''}][${key}]"
                    accept=".jpg, .png, .pdf"
                    style="display: none;"
                    onchange="DocumentFieldManager.handleFileUpload(event, '${key}-name', '${key}-upload-icon', '${key}-remove-icon, 'dynamic')" />
                    </div>
                    </div>
                    <div class="info">
                    <span class="help-trigger" data-target="${key}-help">ⓘ Help</span>
                    <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container ${key}-help" style="display: none">
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                        <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                    </div>
                    </div>
                `;

                return div;
            },

            deleteInitialization(containerId, apiEndpoint, namePrefix, type) {
                const container = document.getElementById(containerId)?.parentElement;
                if (!container) return;

                const deleteButtons = container.querySelectorAll('.kyc-delete-dynamic-content');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', (e) => {
                        e.preventDefault(); // Prevent any default behavior
                        e.stopPropagation(); // Prevent the click from bubbling to the label
                        const key = button.getAttribute('data-target');
                        const id = button.getAttribute('data-id');
                        const box = document.getElementById(`document-box-${key}`);
                        if (box && confirm(`Are you sure you want to delete "${key}"?`)) {
                            box.remove();
                            fetch(`/deletekycdocument/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')?.getAttribute('content')
                                }
                            })
                                .then(res => {
                                    if (!res.ok) throw new Error('Delete failed');
                                    alert(`Deleted: ${key}`);
                                    const rowIdElement = document.getElementById(containerId)
                                        .parentElement.querySelector(
                                            '.document-row:not(:last-child)');
                                    const rowId = rowIdElement ? rowIdElement.id : document
                                        .getElementById(containerId).parentElement.querySelector(
                                            '.document-row').id;
                                    this.initializeSection(containerId, rowId, apiEndpoint,
                                        namePrefix, type, ['salaried', 'business']);
                                })
                                .catch(err => console.error(err));
                        }
                    });
                });
            },

            handleFileUpload(event, nameId, uploadIconId, removeIconId) {
                const fileInput = event.target;
                const fileNameSpan = document.getElementById(nameId);
                const uploadIcon = document.getElementById(uploadIconId);
                const removeIcon = document.getElementById(removeIconId);

                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    if (file.size > 5 * 1024 * 1024) {
                        alert('File size must be less than 5MB.');
                        fileInput.value = '';
                        return;
                    }
                    fileNameSpan.textContent = file.name;
                    uploadIcon.style.display = 'none';
                    removeIcon.style.display = 'inline-block';
                }
            },

            removeFile(inputId, nameId, uploadIconId, removeIconId) {
                const fileInput = document.getElementById(inputId);
                const fileNameSpan = document.getElementById(nameId);
                const uploadIcon = document.getElementById(uploadIconId);
                const removeIcon = document.getElementById(removeIconId);

                fileInput.value = '';
                fileNameSpan.textContent = fileNameSpan.dataset.original;
                uploadIcon.style.display = 'inline-flex'; // Use inline-flex to match .upload-icon CSS
                removeIcon.style.display = 'none';
            },

            getDynamicFields() {
                const fields = [];
                const containers = {
                    document: document.getElementById('document-fields-container-kyc-id'),
                    academic: document.getElementById('academic-fields-container-id'),
                    secured: document.getElementById('secured-fields-container-id'),
                    workExperience: document.getElementById('work-experience-container-id'),
                    coBorrower: document.getElementById('co-borrower-fields-container'),
                    salariedBusiness: document.getElementById('salaried-business-fields-container')
                };
                for (const [type, container] of Object.entries(containers)) {
                    if (container) {
                        const fieldNames = Array.from(container.parentElement.querySelectorAll('.document-name')).map(
                            name => name.textContent);
                        fieldNames.forEach(name => fields.push({
                            name: `${type}-${name.toLowerCase().replace(/\s+/g, '-')}`,
                            type: 'file'
                        }));
                    }
                }
                return fields;
            },

            isModified() {
                return this.modified;
            }
        };


        // Form Submission Manager
        const FormSubmissionManager = {
            modifiedSection: null,

            init() {
                const saveButton = document.getElementById('admin-student-form-save-btn-id');
                if (saveButton) {
                    saveButton.addEventListener('click', () => this.submitForm());
                }
            },

            setModifiedSection(section) {
                this.modifiedSection = section;
            },

            submitForm() {
                if (!this.modifiedSection) {
                    alert('No changes have been made to any section.');
                    return;
                }

                const sections = [{
                    sectionName: 'Personal Information',
                    questions: [{
                        title: 'Let us know more about you',
                        fields: InputFieldManager.getDynamicFields(),
                        manager: InputFieldManager
                    },
                    {
                        title: 'How did you find about us?',
                        fields: SocialOptionsManager.getDynamicFields(),
                        manager: SocialOptionsManager
                    }
                    ]
                },
                {
                    sectionName: 'Course Information',
                    questions: [{
                        title: 'Where are you planning to study?',
                        fields: CourseLocationManager.getDynamicFields(),
                        manager: CourseLocationManager
                    },
                    {
                        title: 'Select the type of degree you want to pursue',
                        fields: CourseOptionsManager.getDynamicFields(),
                        manager: CourseOptionsManager
                    },
                    {
                        title: 'What is the duration of the course?',
                        fields: CourseDurationManager.getDynamicFields(),
                        manager: CourseDurationManager
                    },
                    {
                        title: 'Course Details',
                        fields: CourseDetailsManager.getDynamicFields(),
                        manager: CourseDetailsManager
                    }
                    ]
                },
                {
                    sectionName: 'Academic Details',
                    questions: [{
                        title: 'Academic details',
                        fields: AcademicDetailsManager.getDynamicFields(),
                        manager: AcademicDetailsManager
                    },
                    {
                        title: 'Do you have any gap in your academics?',
                        fields: AcademicDetailsManager.getDynamicFieldsForGap(),
                        manager: AcademicDetailsManager
                    }
                    ]
                },
                {
                    sectionName: 'Co-Borrower Information',
                    questions: [{
                        title: 'How is the co-borrower related to you?',
                        fields: CoBorrowerManager.getDynamicFields().filter(f => f.name === 'Relation'),
                        manager: CoBorrowerManager
                    },
                    {
                        title: 'What is the gross monthly income of co-borrower?',
                        fields: CoBorrowerManager.getDynamicFields().filter(f => f.name !==
                            'Relation' && f.name !== 'Liability'),
                        manager: CoBorrowerManager
                    },
                    {
                        title: 'Is there any existing co-borrower monthly liability?',
                        fields: CoBorrowerManager.getDynamicFields().filter(f => f.name ===
                            'Liability'),
                        manager: CoBorrowerManager
                    }
                    ]
                },
                {
                    sectionName: 'Document Upload',
                    questions: [{
                        title: 'Student KYC Document',
                        fields: DocumentFieldManager.getDynamicFields().filter(f => ['document',
                            'coBorrower'
                        ].includes(f.name.split('-')[0])),
                        manager: DocumentFieldManager
                    },
                    {
                        title: 'Academic Mark Sheets',
                        fields: DocumentFieldManager.getDynamicFields().filter(f => ['academic',
                            'secured'
                        ].includes(f.name.split('-')[0])),
                        manager: DocumentFieldManager
                    }
                    ]
                }
                ];

                // Find the modified section
                const modifiedSectionData = sections.find(section => section.sectionName === this.modifiedSection);
                if (!modifiedSectionData) {
                    alert('Modified section not found.');
                    return;
                }

                // Check if the section has any modified managers
                const hasModifiedManagers = modifiedSectionData.questions.some(q => q.manager.isModified());
                if (!hasModifiedManagers) {
                    alert(`No changes have been made to "${this.modifiedSection}".`);
                    return;
                }

                // Filter questions to include only those with fields
                const questions = modifiedSectionData.questions.filter(q => q.fields.length > 0);
                if (questions.length === 0) {
                    alert(`No fields have been added to "${this.modifiedSection}".`);
                    return;
                }

                const payload = {
                    section_name: this.modifiedSection,
                    data: {
                        questions: questions
                    }
                };

                // Send POST request to /student-application-form
                fetch('/api/student-application-form', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify(payload)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(`Changes for "${this.modifiedSection}" saved successfully!`);
                            modifiedSectionData.questions.forEach(q => {
                                q.manager.modified = false;
                            });
                            this.modifiedSection = null;
                        } else {
                            alert(
                                `Error saving changes for "${this.modifiedSection}": ${data.message || 'Unknown error'}`
                            );
                        }
                    })
                    .catch(error => {
                        console.error(`Error saving "${this.modifiedSection}":`, error);
                        alert(`An error occurred while saving changes for "${this.modifiedSection}".`);
                    });
            }
        };





        function fetchAndAppendSocialNames() {
            fetch('/api/getInfoForAdminSocial')
                .then(res => res.json())
                .then(data => {
                    const container = document.querySelector('.second-question-options');

                    // Clear existing options
                    container.innerHTML = '';

                    data.socialOptions.forEach(item => {
                        const socialOption = document.createElement('div');
                        socialOption.className = 'social-option';

                        const nameSpan = document.createElement('span');
                        nameSpan.className = 'social-name';
                        nameSpan.textContent = item.name;

                        const removeSpan = document.createElement('span');
                        removeSpan.className = 'social-remove';
                        removeSpan.textContent = '×';

                        // Add click listener to removeSpan
                        removeSpan.addEventListener('click', () => {
                            fetch(`/deleteInfoForAdminSocial/${item.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')?.content
                                },

                            })
                                .then(response => {
                                    if (response.ok) {
                                        socialOption.remove();
                                        alert(`selected dropdown deleted ${item.name}`)
                                    } else {
                                        console.error('Failed to delete:', item.id);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error deleting data:', error);
                                });
                        });

                        socialOption.appendChild(nameSpan);
                        socialOption.appendChild(removeSpan);
                        container.appendChild(socialOption);
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }


        function fetchAndRenderStudyLocations() {
            fetch('/api/getplantocountries')
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('selected-study-location-admin');

                    const othersCheckbox = container.querySelector('.others-checkbox');
                    const addContainer = container.querySelector('#plantostudycountryadd');

                    container.innerHTML = '';

                    data.countries.forEach(country => {
                        const label = document.createElement('label');
                        label.style.display = 'flex';
                        label.style.alignItems = 'center';
                        label.style.gap = '8px';

                        const input = document.createElement('input');
                        input.type = 'checkbox';
                        input.name = 'where-are-you-planning-to-study[locations][]';
                        input.value = country.country_name;

                        const textNode = document.createTextNode(' ' + country.country_name);

                        const removeBtn = document.createElement('span');
                        removeBtn.style.color = '#888';
                        removeBtn.textContent = 'x';
                        removeBtn.style.cursor = 'pointer';
                        removeBtn.addEventListener('click', () => {
                            if (confirm(`Are you sure you want to delete "${country.country_name}"?`)) {
                                fetch(`/deleteplantostudycountry/${country.id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')?.content
                                    },

                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.message) {
                                            fetchAndRenderStudyLocations();
                                            alert(data.message)
                                        } else {
                                            alert('Failed to delete.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Delete error:', error);
                                        alert('Error while deleting.');
                                    });
                            }
                        });

                        label.appendChild(input);
                        label.appendChild(textNode);
                        label.appendChild(removeBtn);
                        container.appendChild(label);
                    });

                    // Re-append Others and Add buttons
                    if (othersCheckbox) container.appendChild(othersCheckbox);
                    if (addContainer) container.appendChild(addContainer);

                    if (addContainer) {
                        addContainer.addEventListener('click', () => {
                            const userInput = prompt("Enter dropdown option", "")?.trim();
                            if (userInput) {
                                fetch('/api/storeplantostudycountry', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')?.content
                                    },
                                    body: JSON.stringify({
                                        country_name: userInput
                                    })
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.error) {
                                            alert(`Error: ${data.error}`);
                                            return;
                                        }

                                        fetchAndRenderStudyLocations();
                                        alert(`${userInput} added`);
                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                        alert('An error occurred while saving the option.');
                                    });
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching countries:', error);
                });
        }


        function fetchAndRenderDegrees() {
            fetch('/api/showstudentcourse')
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('optionsContainer');

                    const othersOption = container.querySelector('.option-item input[value="Others"]')?.closest(
                        '.option-item');
                    const addContainer = document.getElementById('addSection');

                    container.innerHTML = '';

                    data.degree.forEach(degree => {
                        if (degree.name === 'Others') return;

                        const optionItem = document.createElement('div');
                        optionItem.className = 'option-item';
                        optionItem.style.display = 'flex';
                        optionItem.style.alignItems = 'center';
                        optionItem.style.justifyContent = 'space-between';
                        optionItem.style.gap = '10px';

                        const left = document.createElement('div');
                        left.style.display = 'flex';
                        left.style.alignItems = 'center';
                        left.style.gap = '8px';

                        const input = document.createElement('input');
                        input.type = 'checkbox';
                        input.name = 'select-the-type-of-degree-you-want-to-pursue[degrees][]';
                        input.className = 'option-checkbox';
                        input.value = degree.name;

                        const label = document.createElement('div');
                        label.className = 'option-name';
                        label.textContent = degree.name;

                        left.appendChild(input);
                        left.appendChild(label);

                        const removeBtn = document.createElement('span');
                        removeBtn.textContent = 'x';
                        removeBtn.style.cursor = 'pointer';
                        removeBtn.style.color = '#888';
                        removeBtn.addEventListener('click', () => {
                            if (confirm(`Are you sure you want to delete "${degree.name}"?`)) {
                                fetch(`/deletedegree/${degree.id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')?.content
                                    }
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.message) {
                                            alert(data.message);
                                            fetchAndRenderDegrees();
                                        } else {
                                            alert('Failed to delete.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Delete error:', error);
                                        alert('Error while deleting.');
                                    });
                            }
                        });

                        optionItem.appendChild(left);
                        optionItem.appendChild(removeBtn);
                        container.appendChild(optionItem);
                    });

                    if (othersOption) container.appendChild(othersOption);
                    if (addContainer) container.appendChild(addContainer);

                    if (addContainer) {
                        document.getElementById('addSection')?.addEventListener('click', () => {
                            const userInput = prompt("Enter new degree option", "")?.trim();
                            if (userInput) {
                                fetch('/api/storedegree', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')?.content
                                    },
                                    body: JSON.stringify({
                                        degree_type: userInput
                                    })
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.error) {
                                            alert(`Error: ${data.error}`);
                                            return;
                                        }

                                        alert(`${userInput} added`);
                                        fetchAndRenderDegrees();
                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                        alert('An error occurred while saving the option.');
                                    });
                            }
                        });

                    }
                })
                .catch(error => {
                    console.error('Error fetching degrees:', error);
                });
        }

        function fetchAndRenderCourseDurations() {
            fetch('/api/showstudentcourseduration')
                .then(res => res.json())
                .then(data => {
                    const container = document.querySelector('.course-options');
                    if (!container) return;

                    container.innerHTML = '';

                    data.duration.forEach(item => {
                        const courseOption = document.createElement('div');
                        courseOption.className = 'course-option';

                        const courseName = document.createElement('span');
                        courseName.className = 'course-name';
                        courseName.textContent = `${item.duration_in_months} Months`;

                        const removeBtn = document.createElement('span');
                        removeBtn.className = 'course-remove';
                        removeBtn.textContent = '×';

                        removeBtn.addEventListener('click', () => {
                            if (confirm(
                                `Are you sure you want to delete "${item.duration_in_months} Months"?`
                            )) {
                                fetch(`/deletecourseduration/${item.id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')?.content
                                    }
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.message) {
                                            alert(data.message);
                                            fetchAndRenderCourseDurations();
                                        } else {
                                            alert('Failed to delete.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Delete error:', error);
                                        alert('Error while deleting.');
                                    });
                            }
                        });

                        courseOption.appendChild(courseName);
                        courseOption.appendChild(removeBtn);
                        container.appendChild(courseOption);
                    });
                })
                .catch(error => {
                    console.error('Error fetching course durations:', error);
                });
        }

        document.getElementById('addCourseDurationBtn')?.addEventListener('click', () => {
            const userInput = prompt("Enter new course duration in months (e.g., 12)", "").trim();

            if (userInput && !isNaN(userInput) && Number(userInput) > 0) {
                fetch('/api/storecourseduration', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        duration_in_months: userInput
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(`Error: ${data.error}`);
                        } else {
                            alert(`${userInput} Months added`);
                            fetchAndRenderCourseDurations();
                        }
                    })
                    .catch(error => {
                        console.error('Add error:', error);
                        alert('Error while adding course duration.');
                    });
            } else {
                alert("Please enter a valid number greater than 0.");
            }
        });



        function fetchAdditionalPersonalFields() {
            const existingStyle = document.getElementById("personal-inline-style");
            if (!existingStyle) {
                const style = document.createElement("style");
                style.id = "personal-inline-style";
                style.innerHTML = `
      #personal-fields-container {
        padding: 20px;
        border-top: 1px solid #e0e0e0;
        margin-top: 20px;
        background-color: #fdfdfd;
        border-radius: 8px;
      }
      #personal-fields-container .personal-field {
        margin-bottom: 20px;
        padding: 10px 15px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        position: relative;
      }
      #personal-fields-container label {
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
        display: block;
      }
      #personal-fields-container input[type="text"],
      #personal-fields-container select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        margin-bottom: 10px;
        box-sizing: border-box;
      }
      #personal-fields-container .remove-field-btn {
        position: absolute;
        top: 1rem;
        right: 10px;
        color: #000;
        border: none;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        font-size: 16px;
        cursor: pointer;
        line-height: 26px;
        text-align: center;
      }
      #personal-fields-container input[type="radio"],
      #personal-fields-container input[type="checkbox"] {
        margin-right: 6px;
        transform: scale(1.1);
        cursor: pointer;
      }
    `;
                document.head.appendChild(style);
            }

            fetch('/api/additionalpersonalinfodata')
                .then(response => response.json())
                .then(data => {
                    if (data && data.additionalFields) {
                        const container = document.getElementById("personal-fields-container");
                        container.innerHTML = "";

                        data.additionalFields.forEach((field, index) => {
                            const fieldWrapper = document.createElement("div");
                            fieldWrapper.className = "personal-field";
                            fieldWrapper.dataset.id = field.id;

                            const labelElement = document.createElement("label");
                            labelElement.textContent = field.label || "Field";
                            fieldWrapper.appendChild(labelElement);

                            let inputHTML = "";
                            const fieldName = `personal-info[extra][${index}][${field.name}]`;

                            if (field.type === "text") {
                                inputHTML =
                                    `<input type="text" name="${fieldName}" placeholder="${field.label}">`;
                            } else if (field.type === "select" && Array.isArray(field.options)) {
                                const options = field.options.map(opt =>
                                    `<option value="${opt}">${opt}</option>`).join("");
                                inputHTML = `<select name="${fieldName}">${options}</select>`;
                            } else if (field.type === "radio" && Array.isArray(field.options)) {
                                inputHTML = field.options.map(opt => `
              <label style="margin-right:10px">
                <input type="radio" name="${fieldName}" value="${opt}"> ${opt}
              </label>
            `).join("");
                            } else if (field.type === "checkbox" && Array.isArray(field.options)) {
                                inputHTML = field.options.map(opt => `
              <label style="margin-right:10px">
                <input type="checkbox" name="${fieldName}[]" value="${opt}"> ${opt}
              </label>
            `).join("");
                            }

                            fieldWrapper.innerHTML += inputHTML;

                            const deleteBtn = document.createElement("button");
                            deleteBtn.type = "button";
                            deleteBtn.className = "remove-field-btn";
                            deleteBtn.textContent = "✕";
                            deleteBtn.title = "Delete this field";

                            deleteBtn.addEventListener("click", () => {
                                const id = fieldWrapper.dataset.id;
                                if (id && confirm("Are you sure you want to delete this field?")) {
                                    fetch(`/additionalfields/${id}`, {
                                        method: "DELETE",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                    "content")
                                        }
                                    })
                                        .then(res => res.json())
                                        .then(response => {
                                            if (response.success) {
                                                fieldWrapper.remove();
                                            } else {
                                                alert("Failed to delete the field.");
                                            }
                                        })
                                        .catch(err => {
                                            console.error("Error deleting field:", err);
                                        });
                                }
                            });

                            fieldWrapper.appendChild(deleteBtn);
                            container.appendChild(fieldWrapper);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching personal fields:', error);
                });
        }


        function fetchAcademics() {
            const existingStyle = document.getElementById("education-inline-style");
            if (!existingStyle) {
                const style = document.createElement("style");
                style.id = "education-inline-style"; // prevent duplicates
                style.innerHTML = `
      #education-rows-container {
        padding: 20px;
        border-top: 1px solid #e0e0e0;
        margin-top: 20px;
        background-color: #fafafa;
        border-radius: 8px;
      }
      #education-rows-container .education-field {
        margin-bottom: 20px;
        padding: 10px 15px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        position: relative;
      }
      #education-rows-container label {
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
        display: block;
      }
      #education-rows-container input[type="text"],
      #education-rows-container select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        margin-bottom: 10px;
        box-sizing: border-box;
      }
      #education-rows-container .remove-field-btn {
        position: absolute;
        top: 1rem;
        right: 10px;
        color: #000;
        border: none;
         border-radius: 50%;
        width: 26px;
        height: 26px;
        font-size: 16px;
        cursor: pointer;
        line-height: 26px;
        text-align: center;
       }
      #education-rows-container input[type="radio"],
      #education-rows-container input[type="checkbox"] {
        margin-right: 6px;
        transform: scale(1.1);
        cursor: pointer;
      }
      #education-rows-container label[style*="margin-right"] {
        display: inline-block;
        margin-right: 15px;
        font-weight: 500;
        font-size: 14px;
        color: #555;
      }
    `;
                document.head.appendChild(style);
            }

            fetch("/api/academics-adminshow")
                .then((res) => res.json())
                .then((data) => {
                    const academicFields = data.data;
                    const rowsContainer = document.getElementById("education-rows-container");

                    rowsContainer.innerHTML = ""; // Clear previous data

                    academicFields.forEach((field, index) => {
                        const fieldWrapper = document.createElement("div");
                        fieldWrapper.className = "education-field";
                        fieldWrapper.dataset.id = field.id;


                        // Create label
                        const labelElement = document.createElement("label");
                        labelElement.textContent = field.label || "Field";
                        labelElement.style.display = "block";
                        labelElement.style.marginBottom = "5px";
                        fieldWrapper.appendChild(labelElement);

                        // Field input based on type
                        if (field.type === "text") {
                            fieldWrapper.innerHTML += `
            <input type="text" placeholder="${field.label}" name="academic-details[extra][${index}][${field.name}]">
            <button type="button" class="remove-field-btn">✕</button>
          `;
                        } else if (field.type === "select" && Array.isArray(field.options)) {
                            const options = field.options.map(opt => `<option value="${opt}">${opt}</option>`)
                                .join("");
                            fieldWrapper.innerHTML += `
            <select name="academic-details[extra][${index}][${field.name}]">
              ${options}
            </select>
            <button type="button" class="remove-field-btn">✕</button>
          `;
                        } else if (field.type === "radio" && Array.isArray(field.options)) {
                            const radios = field.options.map(opt => `
            <label style="margin-right:10px">
              <input type="radio" name="academic-details[extra][${index}][${field.name}]" value="${opt}">
              ${opt}
            </label>`).join("");
                            fieldWrapper.innerHTML += radios + `
            <button type="button" class="remove-field-btn">✕</button>
          `;
                        } else if (field.type === "checkbox" && Array.isArray(field.options)) {
                            const checkboxes = field.options.map(opt => `
            <label style="margin-right:10px">
              <input type="checkbox" name="academic-details[extra][${index}][${field.name}][]" value="${opt}">
              ${opt}
            </label>`).join("");
                            fieldWrapper.innerHTML += checkboxes + `
            <button type="button" class="remove-field-btn">✕</button>
          `;
                        }

                        rowsContainer.appendChild(fieldWrapper);
                    });

                    // Attach remove event listeners
                    // Attach remove event listeners
                    const removeButtons = document.querySelectorAll(".remove-field-btn");
                    removeButtons.forEach((btn, i) => {
                        btn.addEventListener("click", function () {
                            const fieldDiv = btn.closest(".education-field");

                            // Get the field ID from backend
                            const id = fieldDiv?.dataset?.id;

                            alert(id)

                            if (id) {
                                if (confirm("Are you sure you want to delete this field?")) {
                                    fetch(`/academics-adminshow/${id}`, {
                                        method: "DELETE",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                    "content") // For Laravel CSRF
                                        }
                                    })
                                        .then(res => res.json())
                                        .then(response => {
                                            if (response.success) {
                                                fieldDiv.remove();
                                            } else {
                                                alert("Error deleting field.");
                                            }
                                        })
                                        .catch(err => {
                                            console.error("Error deleting field:", err);
                                        });
                                }
                            } else {
                                console.warn("No backend ID found.");
                            }
                        });
                    });

                })
                .catch((err) => console.error("Error fetching academic fields:", err));
        }

        async function fetchCourseDetailOptions() {
            try {
                const response = await fetch('/api/course-detail-options');
                const result = await response.json();

                if (result.success && Array.isArray(result.data)) {
                    const container = document.getElementById('checkbox-options-container-expenses');

                    // Remove existing checkbox-option elements before inserting new ones
                    container.querySelectorAll('.checkbox-option').forEach(el => el.remove());

                    result.data.forEach(option => {
                        const optionDiv = document.createElement('div');
                        optionDiv.className = 'checkbox-option';

                        // Checkbox input
                        const input = document.createElement('input');
                        input.type = 'checkbox';
                        input.id = `option-${option.id}`;
                        input.name = 'course-details[options][]';
                        input.value = option.label;

                        // Label for checkbox
                        const label = document.createElement('label');
                        label.htmlFor = input.id;
                        label.textContent = option.label;

                        // P tag with only delete 'x'
                        const p = document.createElement('p');
                        p.style.display = 'inline-block';
                        p.style.marginLeft = '10px';
                        p.style.cursor = 'pointer';
                        p.title = 'Delete this option';

                        // Delete 'x' button
                        const deleteBtn = document.createElement('span');
                        deleteBtn.textContent = 'x';
                        deleteBtn.style.cursor = 'pointer';

                        deleteBtn.addEventListener('click', () => {
                            if (confirm(`Are you sure you want to delete "${option.label}"?`)) {
                                deleteCourseOption(option.id, optionDiv);
                            }
                        });

                        p.appendChild(deleteBtn);

                        // Append checkbox, label, and delete button
                        optionDiv.appendChild(input);
                        optionDiv.appendChild(label);
                        optionDiv.appendChild(p);

                        const addButton = document.getElementById('add-course-option-btn');
                        container.insertBefore(optionDiv, addButton);
                    });

                }
            } catch (error) {
                console.error('Error fetching course detail options:', error);
            }
        }
        async function deleteCourseOption(optionId, optionDiv) {
            try {
                const response = await fetch(`/course-options/${optionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json',
                    }
                });
                if (response.ok) {
                    optionDiv.remove(); // Remove from DOM on success
                    alert('Option deleted successfully.');
                    fetchCourseDetailOptions();
                } else {
                    alert('Failed to delete option.');
                }
            } catch (error) {
                console.error('Delete error:', error);
                alert('An error occurred while deleting the option.');
            }
        }
    </script>
</body>

</html>