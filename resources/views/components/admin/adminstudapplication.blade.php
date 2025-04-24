<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="assets/css/adminstudapplication.css">
</head>
<body>
    @extends('layouts.app')

<div class="admin-studnet-application-main-container">
    <div class="nbfc-studentdashboardprofile-profile-section-container" id="admin-student-form-edit-container">
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
                        <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down" />
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
                        
                        <div class="admin-student-options-section" id="person-info-section" style="display: none;">
                            <div class="admin-student-options-label">Options:</div>

                            <!-- Input Row 1 -->
                            <div class="input-row" id="input-row-1">
                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/person-icon.png" alt="Person Icon" class="icon" />
                                        <input type="text" placeholder="Full Name" name="full_name" id="fullName" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="fullName-error"></div>
                                </div>

                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
                                        <input type="tel" placeholder="Phone Number" name="phone_number" id="phone" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="phone-error"></div>
                                </div>

                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
                                        <input type="text" placeholder="Referral Code" name="referral_code" id="referralCode" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="referralCode-error"></div>
                                </div>
                            </div>

                            <!-- Input Row 2 -->
                            <div class="input-row" id="input-row-2">
                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/mail.png" alt="Mail Icon" class="icon" />
                                        <input type="email" placeholder="Email ID" name="email" id="email" required />
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="email-error"></div>
                                </div>

                                <div class="input-group">
                                    <div class="input-content">
                                        <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon">
                                        <input type="text" placeholder="City" name="city" required id="city-input" />
                                        <div id="suggestions" class="suggestions-container"></div>
                                    </div>
                                    <span class="remove-option">×</span>
                                    <div class="validation-message" id="city-error"></div>
                                </div>

                                <div class="add-field" id="add-input-field">
                                    <span class="add-text">Add</span>
                                    <span class="add-icon">+</span>
                                </div>
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
                                    <div class="social-option">
                                        <span class="social-name">Youtube</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                    <div class="social-option">
                                        <span class="social-name">LinkedIn</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                    <div class="social-option">
                                        <span class="social-name">Social Media</span>
                                        <span class="social-remove">×</span>
                                    </div>
                                    <div class="social-option">
                                        <span class="social-name">Institution</span>
                                        <span class="social-remove">×</span>
                                    </div>
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
                        <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down-course" />
                    </div>
                </div>

                <div class="admin-student-section-content-course">
                    <div class="admin-student-form-question-course">
                        <div class="admin-student-question-row-course" id="admin-student-course">
                            <div class="admin-student-question-title-course">1. Where are you planning to study?</div>
                            <div class="admin-student-dropdown-field-course">
                                <span class="admin-student-field-text-course">Check Box</span>
                                <span class="admin-student-dropdown-icon-course"></span>
                            </div>
                        </div>

                        <div class="admin-student-options-section-course" id="person-info-section-course">
                            <div class="admin-student-options-label-about">Options:</div>
                            <div class="checkbox-group" id="selected-study-location">
                                <label>
                                    <input type="checkbox" name="study-location" value="USA"> USA
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="UK"> UK
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Ireland"> Ireland
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="New Zealand"> New Zealand
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Germany"> Germany
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="France"> France
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Sweden"> Sweden
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Italy"> Italy
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Canada"> Canada
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Australia"> Australia
                                </label>
                                <label>
                                    <input type="checkbox" name="study-location" value="Others"> Others
                                </label>

                                <!-- Add Checkbox Container -->
                                <div class="add-checkbox-container">
                                    <span class="add-checkbox-input">Add</span>
                                    <span class="add-checkbox-btn" id="add-course-checkbox-id">+</span>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!--course details 2-->
                    <div class="admin-student-form-question-course-degree" id="admin-student-form-question-course-degree">   
                        <div class="admin-student-question-row-course-degree" id="admin-student-course-second">
                            <div class="admin-student-question-title-course-degree">2. Select the type of degree you want to pursue:</div>
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
                                    <input type="checkbox" class="option-checkbox">
                                    <div class="option-name">Bachelors (only secured loan)</div>
                                </div>
                            
                                <div class="option-item">
                                    <input type="checkbox" class="option-checkbox">
                                    <div class="option-name">Masters</div>
                                </div>
                                        
                                <div class="option-item">
                                    <input type="checkbox" class="option-checkbox">
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
                            <div class="admin-student-question-title">3. What is the duration of the course?</div>
                            <div class="admin-student-dropdown-field" id="course-dropdown-month-id">
                                <span class="admin-student-field-text">Drop Down List</span>
                                <span class="admin-student-dropdown-icon" id="admin-student-dropdown-icon-id"></span>
                            </div>
                        </div>

                        <div class="admin-student-options-section" id="course-duration-section-month">
                            <div class="admin-student-options-label">Options:</div>
                            <div class="admin-course-option-main-container">
                                <div class="course-options">
                                    <div class="course-option">
                                        <span class="course-name">12 Months</span>
                                        <span class="course-remove">×</span>
                                    </div>

                                    <div class="course-option">
                                        <span class="course-name">24 Months</span>
                                        <span class="course-remove">×</span>
                                    </div>

                                    <div class="course-option">
                                        <span class="course-name">36 Months</span>
                                        <span class="course-remove">×</span>
                                    </div>
                                </div>

                                <div class="add-course">
                                    <span class="add-text">Add</span>
                                    <span class="add-icon">+</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admin-student-form-question" id="course-details-container">
                        <div class="admin-student-question-row" id="course-details-row">
                            <div class="admin-student-question-title">4. Course Details</div>
                            <div class="admin-student-dropdown-field" id="course-details-dropdown">
                                <span class="admin-student-field-text">Check Box</span>
                                <span class="admin-student-dropdown-icon"></span>
                            </div>
                        </div>

                        <div class="options-section" id="course-details-options" style="display: none;">
                            <div class="options-label">Options:</div>
                            <div class="checkbox-coures-main-container">
                                <div class="checkbox-options-container">
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="with-expenses" name="course-options">
                                        <label for="with-expenses">With living expenses</label>
                                    </div>
                                    <div class="checkbox-option">
                                        <input type="checkbox" id="without-expenses" name="course-options">
                                        <label for="without-expenses">Without living expenses</label>
                                    </div>
                                </div>
                                <div class="add-option" id="add-option-btn">
                                    <span class="add-option-text">Add</span>
                                    <span class="add-option-icon">+</span>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-student-form-section-academic-details" id="academic-details-section">
                <div class="admin-student-section-header-academic">
                    <div class="admin-student-section-title-academic">Academic details</div>
                    <span class="admin-student-question-count-academic">04 Questions</span>
                    <div class="admin-student-arrow-icon-academic rotated">
                        <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down-academic">
                    </div>
                </div>
            </div>

            <!-- Academic container -->
            <div class="admin-student-section-content-academic expanded" id="academic-details-content">
                <!-- Education Container (styled like the academic gap) -->
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
                                <input type="text" placeholder="University/School">
                                <button type="button" class="remove-field-btn">✕</button>
                            </div>
                            <div class="education-field">
                                <input type="text" placeholder="Course Name">
                                <button type="button" class="remove-field-btn">✕</button>
                            </div>
                        </div>

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
                                    <input
                                        type="radio"
                                        id="academic-yes"
                                        name="academics-gap"
                                        value="yes"
                                    />
                                    <label for="academic-yes">Yes</label>
                                </div>
                                <div class="academic-option">
                                    <input
                                        type="radio"
                                        id="academic-no"
                                        name="academics-gap"
                                        value="no"
                                    />
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

            <div class="admin-student-form-section-co-borrower-info">
                <div class="admin-student-section-header-co-borrower">
                    <div class="admin-student-section-title-co-borrower">
                        Co-borrower Info
                    </div>
                    <span class="admin-student-question-count-co-borrower">3 Questions</span>
                    <div class="admin-student-arrow-icon-co-borrower">
                        <img
                            src="assets/images/admin-drop.png"
                            alt="Arrow Icon"
                            class="admin-student-arrow-down-co-borrow"
                        />
                    </div>
                </div>
            </div>

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

                <div class="options-section" id="co-borrower-options" style="display: none">
                    <div class="checkbox-options-container">
                        <div class="checkbox-option">
                            <input
                                type="checkbox"
                                id="co-borrower-parent"
                                name="co-borrower-options"
                            />
                            <label for="co-borrower-parent">Parent</label>
                        </div>
                        <div class="checkbox-option">
                            <input
                                type="checkbox"
                                id="co-borrower-spouse"
                                name="co-borrower-options"
                            />
                            <label for="co-borrower-spouse">Spouse</label>
                        </div>
                        <div class="checkbox-option">
                            <input
                                type="checkbox"
                                id="co-borrower-blood-relative"
                                name="co-borrower-options"
                            />
                            <label for="co-borrower-blood-relative">Blood relative</label>
                        </div>
                        <div class="add-option" id="add-option-btn">
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

                <div class="options-section" id="income-options" style="display: none">
                    <div class="fields-row-container">
                        <div class="field-container">
                            <input
                                type="text"
                                class="text-input"
                                placeholder=" ₹ Rupees in thousands"
                            />
                            <button class="delete-field">✕</button>
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

                <div class="options-section" id="liability-options" style="display: none">
                    <div class="liability-content-container">
                        <!-- Monthly liability option with horizontal layout -->
                        <div class="monthly-liability-option-container">
                            <!-- Radio buttons on the left -->
                            <div class="monthly-liability-radio-buttons">
                                <label>
                                    <input
                                        type="radio"
                                        name="co-borrower-liability"
                                        id="yes-liability"
                                        value="Yes"
                                    />
                                    Yes
                                </label>
                                <label>
                                    <input
                                        type="radio"
                                        name="co-borrower-liability"
                                        id="no-liability"
                                        value="No"
                                    />
                                    No
                                </label>
                            </div>

                            <!-- EMI field and add button on the right, in the same row -->
                            <div class="emi-row">
                                <div class="emi-content">
                                    <p class="amount-thousand-mobile">
                                        Enter the amount in thousands
                                    </p>
                                    <input
                                        type="text"
                                        id="emi-amount"
                                        class="emi-content-container"
                                        placeholder="Enter EMI amount"
                                    />
                                    <span
                                        id="emi-error-message"
                                        class="error-message"
                                        style="display: none; color: red"
                                    >Please enter a valid EMI amount (numeric values only).</span>
                                </div>
                                <div class="add-option" id="add-liability-btn">
                                    <span class="add-option-text">Add</span>
                                    <span class="add-option-icon">+</span>
                                </div>
                            </div>
                        </div>

                        <!-- Container for additional liability fields - vertically aligned under the EMI content -->
                        <div id="additional-liability-fields" class="additional-liability-fields">
                            <!-- Additional fields will be added here dynamically -->
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
        <span class="admin-student-question-count-document-upload"
          >6 Questions</span
        >
        <div class="admin-student-arrow-icon-document-upload">
          <img
            src="assets/images/admin-drop.png"
            alt="Arrow Icon"
            class="admin-student-arrow-down-document-upload"
          />
        </div>
      </div>
      <div class="admin-student-section-content-document-upload">
        <!-- 1. Student KYC Document -->
        <div class="admin-student-form-question">
          <div class="admin-student-question-row" id="student-kyc-row">
            <div class="admin-student-question-title">Student KYC Document</div>
            <div class="admin-student-dropdown-field">
              <span class="admin-student-field-text">Text Field</span>
              <span class="admin-student-dropdown-icon"></span>
            </div>
          </div>
          <div class="admin-student-options-section-dashboard" id="student-kyc-section">
            <div class="document-container-admin">
              <div class="document-row" id="document-row-1">
                <!-- PAN Card -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="pan-card-document-name"
                    style="display: none"
                  >
                    PAN Card
                  </div>
                  <div class="upload-field">
                    <span id="kyc-pan-name" data-original="PAN Card"
                      >PAN Card</span
                    >
                    <span
                      id="kyc-pan-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('kyc-pan', 'kyc-pan-name', 'kyc-pan-upload-icon', 'kyc-pan-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="kyc-pan"
                        class="upload-icon"
                        id="kyc-pan-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="kyc-pan"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'kyc-pan-name', 'kyc-pan-upload-icon', 'kyc-pan-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="kyc-pan-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container kyc-pan-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload a .jpg, .png, or .pdf file with a size
                        less than 5MB.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Aadhar Card -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="aadhar-card-document-name"
                    style="display: none"
                  >
                    Aadhar Card
                  </div>
                  <div class="upload-field">
                    <span id="aadhar-card-name" data-original="Aadhar Card"
                      >Aadhar Card</span
                    >
                    <span
                      id="aadhar-card-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('aadhar-card', 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="aadhar-card"
                        class="upload-icon"
                        id="aadhar-card-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="aadhar-card"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="aadhar-card-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container aadhar-card-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload a .jpg, .png, or .pdf file with a size
                        less than 5MB.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Passport -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="passport-document-name"
                    style="display: none"
                  >
                    Passport
                  </div>
                  <div class="upload-field">
                    <span id="passport-card-name" data-original="Passport"
                      >Passport</span
                    >
                    <span
                      id="passport-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('passport', 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="passport"
                        class="upload-icon"
                        id="passport-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="passport"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="passport-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container passport-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload a .jpg, .png, or .pdf file with a size
                        less than 5MB.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Document fields container -->
              <div class="document-row" id="document-fields-container">
                <div class="add-document" id="add-document-btn">
                  <span class="add-text">Add</span>
                  <span class="add-icon">+</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 2. Academic Mark Sheets -->
        <div class="admin-student-form-question">
          <div class="admin-student-question-row" id="academic-marks-row">
            <div class="admin-student-question-title">Academic Mark Sheets</div>
            <div class="admin-student-dropdown-field">
              <span class="admin-student-field-text">Text Field</span>
              <span class="admin-student-dropdown-icon"></span>
            </div>
          </div>
          <div
            class="admin-student-options-section"
            id="academic-marks-section"
          >
            <div class="document-container-admin">
              <div class="document-row" id="academic-row-1">
                <!-- 10th Grade Mark Sheet -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="10th-mark-sheet-id"
                    style="display: none"
                  >
                    10th Mark Sheet
                  </div>
                  <div class="upload-field">
                    <span
                      id="tenth-grade-name"
                      data-original="10th Grade Mark Sheet"
                      >10th Grade Mark Sheet</span
                    >
                    <span
                      id="tenth-grade-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('tenth-grade', 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="tenth-grade"
                        class="upload-icon"
                        id="tenth-grade-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="tenth-grade"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="tenth-grade-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container tenth-grade-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload a .jpg, .png, or .pdf file with a size
                        less than 5MB.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- 12th Grade Mark Sheet -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="12th-mark-sheet-id"
                    style="display: none"
                  >
                    12th Mark Sheet
                  </div>
                  <div class="upload-field">
                    <span
                      id="twelfth-grade-name"
                      data-original="12th Grade Mark Sheet"
                      >12th Grade Mark Sheet</span
                    >
                    <span
                      id="twelfth-grade-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('twelfth-grade', 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="twelfth-grade"
                        class="upload-icon"
                        id="twelfth-grade-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="twelfth-grade"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="twelfth-grade-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container twelfth-grade-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload a .jpg, .png, or .pdf file with a size
                        less than 5MB.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Graduation Mark Sheet -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="graduation-mark-sheet-id"
                    style="display: none"
                  >
                    Graduation Mark Sheet
                  </div>
                  <div class="upload-field">
                    <span
                      id="graduation-grade-name"
                      data-original="Graduation Mark Sheet"
                      >Graduation Mark Sheet</span
                    >
                    <span
                      id="graduation-grade-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('graduation-grade', 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="graduation-grade"
                        class="upload-icon"
                        id="graduation-grade-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="graduation-grade"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="graduation-grade-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container graduation-grade-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload a .jpg, .png, or .pdf file with a size
                        less than 5MB.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Academic document fields container -->
              <div class="document-row" id="academic-fields-container">
                <div class="add-document" id="add-academic-btn">
                  <span class="add-text">Add</span>
                  <span class="add-icon">+</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 3. Secured Marks -->
        <div class="admin-student-form-question">
          <div class="admin-student-question-row" id="secured-marks-row">
            <div class="admin-student-question-title">Secured Marks</div>
            <div class="admin-student-dropdown-field">
              <span class="admin-student-field-text">Text Field</span>
              <span class="admin-student-dropdown-icon"></span>
            </div>
          </div>
          <div class="admin-student-options-section" id="secured-marks-section">
            <div class="document-container-admin">
              <div class="document-row" id="secured-row-1">
                <!-- 10th Grade -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="10th-grades-id"
                    style="display: none"
                  >
                    10th Grade
                  </div>
                  <div class="upload-field">
                    <span id="secured-tenth-name" data-original="10th Grade"
                      >10th Grade</span
                    >
                    <span
                      id="secured-tenth-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('secured-tenth', 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="secured-tenth"
                        class="upload-icon"
                        id="secured-tenth-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="secured-tenth"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="secured-tenth-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container secured-tenth-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your 10th grade mark sheet in jpg, png, or
                        pdf format.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- 12th Grade -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="12th-grade-id"
                    style="display: none"
                  >
                    12th Grade
                  </div>
                  <div class="upload-field">
                    <span id="secured-twelfth-name" data-original="12th Grade"
                      >12th Grade</span
                    >
                    <span
                      id="secured-twelfth-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('secured-twelfth', 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="secured-twelfth"
                        class="upload-icon"
                        id="secured-twelfth-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="secured-twelfth"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="secured-twelfth-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container secured-twelfth-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your 12th grade mark sheet in jpg, png, or
                        pdf format.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Graduation -->
                <div class="document-box">
                  <div
                    class="document-name"
                    id="graduation-id"
                    style="display: none"
                  >
                    Graduation
                  </div>
                  <div class="upload-field">
                    <span
                      id="secured-graduation-name"
                      data-original="Graduation"
                      >Graduation</span
                    >
                    <span
                      id="secured-graduation-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('secured-graduation', 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="secured-graduation"
                        class="upload-icon"
                        id="secured-graduation-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="secured-graduation"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="secured-graduation-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container secured-graduation-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your graduation mark sheet in jpg, png, or
                        pdf format.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Secured marks document fields container -->
              <div class="document-row" id="secured-fields-container">
                <div class="add-document" id="add-secured-btn">
                  <span class="add-text">Add</span>
                  <span class="add-icon">+</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 4. Work Experience -->
        <div class="admin-student-form-question">
          <div class="admin-student-question-row" id="work-experience-row">
            <div class="admin-student-question-title">Work Experience</div>
            <div class="admin-student-dropdown-field">
              <span class="admin-student-field-text">Text Field</span>
              <span class="admin-student-dropdown-icon"></span>
            </div>
          </div>
          <div
            class="admin-student-options-section"
            id="work-experience-section"
          >
            <div class="work-experience-container">
              <div class="work-experience-row" id="work-experience-row-1">
                <!-- Experience Letter -->
                <div class="work-experience-box">
                  <div
                    class="document-name"
                    id="experience-letter-id"
                    style="display: none"
                  >
                    Experience Letter
                  </div>
                  <div class="upload-field">
                    <span
                      id="work-experience-experience-letter"
                      data-original="Experience Letter"
                      >Experience Letter</span
                    >
                    <span
                      id="work-experience-tenth-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('work-experience-tenth', 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="work-experience-tenth"
                        class="upload-icon"
                        id="work-experience-tenth-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="work-experience-tenth"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="work-experience-tenth-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container work-experience-tenth-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your experience letter in jpg, png, or pdf
                        format.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- 3 Months Salary Slip -->
                <div class="work-experience-box">
                  <div
                    class="document-name"
                    id="3-months-salary-slip-id"
                    style="display: none"
                  >
                    3 Months Salary Slip
                  </div>
                  <div class="upload-field">
                    <span
                      id="work-experience-monthly-slip"
                      data-original="3 Months Salary Slip"
                      >3 Months Salary Slip</span
                    >
                    <span
                      id="work-experience-twelfth-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('work-experience-twelfth', 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="work-experience-twelfth"
                        class="upload-icon"
                        id="work-experience-twelfth-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="work-experience-twelfth"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="work-experience-twelfth-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container work-experience-twelfth-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your 3 months salary slip in jpg, png, or
                        pdf format.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Office ID -->
                <div class="work-experience-box">
                  <div
                    class="document-name"
                    id="office-IDs-id"
                    style="display: none"
                  >
                    Office ID
                  </div>
                  <div class="upload-field">
                    <span
                      id="work-experience-office-id"
                      data-original="Office ID"
                      >Office ID</span
                    >
                    <span
                      id="work-experience-graduation-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('work-experience-graduation', 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="work-experience-graduation"
                        class="upload-icon"
                        id="work-experience-graduation-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="work-experience-graduation"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="work-experience-graduation-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container work-experience-graduation-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your office ID in jpg, png, or pdf format.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Second row of work experience documents -->
              <div class="work-experience-row" id="work-experience-row-2">
                <!-- Joining Letter -->
                <div class="work-experience-box">
                  <div
                    class="document-name"
                    id="joining-letter-id"
                    style="display: none"
                  >
                    Joining Letter
                  </div>
                  <div class="upload-field">
                    <span
                      id="work-experience-joining-letter"
                      data-original="Joining Letter"
                      >Joining Letter</span
                    >
                    <span
                      id="work-experience-fourth-remove-icon"
                      class="remove-icon"
                      onclick="removeFile('work-experience-fourth', 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')"
                      ><span class="thin-x"></span
                    ></span>
                    <div class="file-actions">
                      <label
                        for="work-experience-fourth"
                        class="upload-icon"
                        id="work-experience-fourth-upload-icon"
                      >
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input
                        type="file"
                        id="work-experience-fourth"
                        accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')"
                      />
                    </div>
                  </div>
                  <div class="info">
                    <span
                      class="help-trigger"
                      data-target="work-experience-fourth-help"
                      >ⓘ Help</span
                    >
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div
                    class="help-container work-experience-fourth-help"
                    style="display: none"
                  >
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>
                        Please upload your joining letter in jpg, png, or pdf
                        format.
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Add button for work experience documents -->
                <div class="add-document" id="add-work-experience-btn">
                  <span class="add-text">Add</span>
                  <span class="add-icon">+</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 5. Co-borrower KYC Documents -->
        <div class="admin-student-form-question">
          <div class="admin-student-question-row" id="co-borrower-kyc-row">
            <div class="admin-student-question-title">
              Co-borrower KYC Documents
            </div>
            <div class="admin-student-dropdown-field">
              <span class="admin-student-field-text">Text Field</span>
              <span class="admin-student-dropdown-icon"></span>
            </div>
          </div>
          <div
            class="admin-student-options-section"
            id="co-borrower-kyc-section"
          >
            <div class="kyc-container-admin">
              <div class="document-container-admin">
                <div class="document-row" id="co-borrower-row-1">
                  <!-- PAN Card -->
                  <div class="document-box">
                    <div
                      class="document-name"
                      id="pan-card-ids"
                      style="display: none"
                    >
                      PAN Card
                    </div>
                    <div class="upload-field">
                      <span id="co-pan-card-name" data-original="PAN Card"
                        >PAN Card</span
                      >
                      <span
                        id="co-remove-icon"
                        class="remove-icon"
                        onclick="removeFile('co-pan-card', 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')"
                        ><span class="thin-x"></span
                      ></span>
                      <div class="file-actions">
                        <label
                          for="co-pan-card"
                          class="upload-icon"
                          id="co-upload-icon"
                        >
                          <img
                            src="assets/images/upload.png"
                            alt="Upload Icon"
                          />
                        </label>
                        <input
                          type="file"
                          id="co-pan-card"
                          accept=".jpg, .png, .pdf"
                          onchange="handleFileUpload(event, 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')"
                        />
                      </div>
                    </div>
                    <div class="info">
                      <span class="help-trigger" data-target="co-pan-card-help"
                        >ⓘ Help</span
                      >
                      <span>*jpg, png, pdf formats</span>
                    </div>
                    <div
                      class="help-container co-pan-card-help"
                      style="display: none"
                    >
                      <h3 class="help-title">Help</h3>
                      <div class="help-content">
                        <p>
                          Please upload a .jpg, .png, or .pdf file with a size
                          less than 5MB.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- Aadhar Card -->
                  <div class="document-box">
                    <div
                      class="document-name"
                      id="aadhar-card-id"
                      style="display: none"
                    >
                      Aadhar Card
                    </div>
                    <div class="upload-field">
                      <span id="co-aadhar-card-name" data-original="Aadhar Card"
                        >Aadhar Card</span
                      >
                      <span
                        id="co-aadhar-remove-icon"
                        class="remove-icon"
                        onclick="removeFile('co-aadhar-card', 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')"
                        ><span class="thin-x"></span
                      ></span>
                      <div class="file-actions">
                        <label
                          for="co-aadhar-card"
                          class="upload-icon"
                          id="co-aadhar-upload-icon"
                        >
                          <img
                            src="assets/images/upload.png"
                            alt="Upload Icon"
                          />
                        </label>
                        <input
                          type="file"
                          id="co-aadhar-card"
                          accept=".jpg, .png, .pdf"
                          onchange="handleFileUpload(event, 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')"
                        />
                      </div>
                    </div>
                    <div class="info">
                      <span
                        class="help-trigger"
                        data-target="co-aadhar-card-help"
                        >ⓘ Help</span
                      >
                      <span>*jpg, png, pdf formats</span>
                    </div>
                    <div
                      class="help-container co-aadhar-card-help"
                      style="display: none"
                    >
                      <h3 class="help-title">Help</h3>
                      <div class="help-content">
                        <p>
                          Please upload a .jpg, .png, or .pdf file with a size
                          less than 5MB.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- Address Proof -->
                  <div class="document-box">
                    <div
                      class="document-name"
                      id="address-proof-id"
                      style="display: none"
                    >
                      Address Proof
                    </div>
                    <div class="upload-field">
                      <span id="co-addressproof" data-original="Address Proof"
                        >Address Proof</span
                      >
                      <span
                        id="co-passport-remove-icon"
                        class="remove-icon"
                        onclick="removeFile('co-passport', 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')"
                        ><span class="thin-x"></span
                      ></span>
                      <div class="file-actions">
                        <label
                          for="co-passport"
                          class="upload-icon"
                          id="co-passport-upload-icon"
                        >
                          <img
                            src="assets/images/upload.png"
                            alt="Upload Icon"
                          />
                        </label>
                        <input
                          type="file"
                          id="co-passport"
                          accept=".jpg, .png, .pdf"
                          onchange="handleFileUpload(event, 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')"
                        />
                      </div>
                    </div>
                    <div class="info">
                      <span class="help-trigger" data-target="co-passport-help"
                        >ⓘ Help</span
                      >
                      <span>*jpg, png, pdf formats</span>
                    </div>
                    <div
                      class="help-container co-passport-help"
                      style="display: none"
                    >
                      <h3 class="help-title">Help</h3>
                      <div class="help-content">
                        <p>
                          Please upload a .jpg, .png, or .pdf file with a size
                          less than 5MB.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Co-borrower fields container -->
                <div class="document-row" id="co-borrower-fields-container">
                  <div class="add-document" id="add-co-borrower-btn">
                    <span class="add-text">Add</span>
                    <span class="add-icon">+</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 6. Salaried and Business Documents -->
        <div class="admin-student-form-question">
          <div class="admin-student-question-row" id="salaried-business-row">
            <div class="admin-student-question-title">Salaried and Business Documents</div>
            <div class="admin-student-dropdown-field">
              <span class="admin-student-field-text">Text Field</span>
              <span class="admin-student-dropdown-icon"></span>
            </div>
          </div>
          <div class="admin-student-options-section" id="salaried-business-section">
            <div class="document-container-admin">
              <!-- Salaried Documents Section -->
              <div class="salary-sub-admin">
                <p>If salaried:</p>
              </div>
              <div class="document-row salary-upload-row" id="salaried-row-1">
                <!-- 3 Months Salary Slip -->
                <div class="document-box salary-upload-box">
                  <div class="document-name" id="salary-slip-id" style="display: none;">3 months salary slip</div>
                  <div class="upload-field">
                    <span id="salary-slip-name" data-original="3 months salary slip">3 months salary slip</span>
                    <span id="salary-slip-remove-icon" class="remove-icon" style="display: none;"
                      onclick="removeFile('salary-slip', 'salary-slip-name', 'salary-slip-upload-icon', 'salary-slip-remove-icon')"><span class="thin-x"></span></span>
                    <div class="file-actions">
                      <label for="salary-slip" class="upload-icon" id="salary-slip-upload-icon">
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input type="file" id="salary-slip" accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'salary-slip-name', 'salary-slip-upload-icon', 'salary-slip-remove-icon')" />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="salary-slip-help">ⓘ Help</span>
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div class="help-container salary-slip-help" style="display: none;">
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>Please upload your 3 months salary slip in jpg, png, or pdf format.</p>
                    </div>
                  </div>
                </div>
                <!-- 6 Months Bank Statement -->
                <div class="document-box salary-upload-box">
                  <div class="document-name" id="bank-statement-id" style="display: none;">6 months bank statement</div>
                  <div class="upload-field">
                    <span id="bank-statement-name" data-original="6 months bank statement">6 months bank statement</span>
                    <span id="bank-statement-remove-icon" class="remove-icon" style="display: none;"
                      onclick="removeFile('bank-statement', 'bank-statement-name', 'bank-statement-upload-icon', 'bank-statement-remove-icon')"><span class="thin-x"></span></span>
                    <div class="file-actions">
                      <label for="bank-statement" class="upload-icon" id="bank-statement-upload-icon">
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input type="file" id="bank-statement" accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'bank-statement-name', 'bank-statement-upload-icon', 'bank-statement-remove-icon')" />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="bank-statement-help">ⓘ Help</span>
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div class="help-container bank-statement-help" style="display: none;">
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>Please upload your 6 months bank statement in jpg, png, or pdf format.</p>
                    </div>
                  </div>
                </div>
                <!-- Address Proof -->
                <div class="document-box salary-upload-box">
                  <div class="document-name" id="address-proof-salary-id" style="display: none;">Address Proof</div>
                  <div class="upload-field">
                    <span id="address-proof-salary-name" data-original="Address Proof">Address Proof</span>
                    <span id="address-proof-salary-remove-icon" class="remove-icon" style="display: none;"
                      onclick="removeFile('address-proof-salary', 'address-proof-salary-name', 'address-proof-salary-upload-icon', 'address-proof-salary-remove-icon')"><span class="thin-x"></span></span>
                    <div class="file-actions">
                      <label for="address-proof-salary" class="upload-icon" id="address-proof-salary-upload-icon">
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input type="file" id="address-proof-salary" accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'address-proof-salary-name', 'address-proof-salary-upload-icon', 'address-proof-salary-remove-icon')" />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="address-proof-salary-help">ⓘ Help</span>
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div class="help-container address-proof-salary-help" style="display: none;">
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>Please upload your address proof in jpg, png, or pdf format.</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Business Documents Section -->
              <div class="salary-sub-admin">
                <p>If in Business:</p>
              </div>
              <div class="document-row salary-upload-row" id="business-row-1">
                <!-- 2 Years of ITR -->
                <div class="document-box salary-upload-box">
                  <div class="document-name" id="itr-id" style="display: none;">2 years of ITR</div>
                  <div class="upload-field">
                    <span id="itr-name" data-original="2 years of ITR">2 years of ITR</span>
                    <span id="itr-remove-icon" class="remove-icon" style="display: none;"
                      onclick="removeFile('itr', 'itr-name', 'itr-upload-icon', 'itr-remove-icon')"><span class="thin-x"></span></span>
                    <div class="file-actions">
                      <label for="itr" class="upload-icon" id="itr-upload-icon">
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input type="file" id="itr" accept=".jpg, .png, .pdf"
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
                      <p>Please upload your 2 years of ITR in jpg, png, or pdf format.</p>
                    </div>
                  </div>
                </div>
                <!-- 6 Months Bank Statement -->
                <div class="document-box salary-upload-box">
                  <div class="document-name" id="business-bank-statement-id" style="display: none;">6 months bank statement</div>
                  <div class="upload-field">
                    <span id="business-bank-statement-name" data-original="6 months bank statement">6 months bank statement</span>
                    <span id="business-bank-statement-remove-icon" class="remove-icon" style="display: none;"
                      onclick="removeFile('business-bank-statement', 'business-bank-statement-name', 'business-bank-statement-upload-icon', 'business-bank-statement-remove-icon')"><span class="thin-x"></span></span>
                    <div class="file-actions">
                      <label for="business-bank-statement" class="upload-icon" id="business-bank-statement-upload-icon">
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input type="file" id="business-bank-statement" accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'business-bank-statement-name', 'business-bank-statement-upload-icon', 'business-bank-statement-remove-icon')" />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="business-bank-statement-help">ⓘ Help</span>
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div class="help-container business-bank-statement-help" style="display: none;">
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>Please upload your 6 months bank statement in jpg, png, or pdf format.</p>
                    </div>
                  </div>
                </div>
                <!-- Office/Shop Photographs -->
                <div class="document-box salary-upload-box">
                  <div class="document-name" id="office-shop-photos-id" style="display: none;">Office/Shop photographs</div>
                  <div class="upload-field">
                    <span id="office-shop-photos-name" data-original="Office/Shop photographs">Office/Shop photographs</span>
                    <span id="office-shop-photos-remove-icon" class="remove-icon" style="display: none;"
                      onclick="removeFile('office-shop-photos', 'office-shop-photos-name', 'office-shop-photos-upload-icon', 'office-shop-photos-remove-icon')"><span class="thin-x"></span></span>
                    <div class="file-actions">
                      <label for="office-shop-photos" class="upload-icon" id="office-shop-photos-upload-icon">
                        <img src="assets/images/upload.png" alt="Upload Icon" />
                      </label>
                      <input type="file" id="office-shop-photos" accept=".jpg, .png, .pdf"
                        onchange="handleFileUpload(event, 'office-shop-photos-name', 'office-shop-photos-upload-icon', 'office-shop-photos-remove-icon')" />
                    </div>
                  </div>
                  <div class="info">
                    <span class="help-trigger" data-target="office-shop-photos-help">ⓘ Help</span>
                    <span>*jpg, png, pdf formats</span>
                  </div>
                  <div class="help-container office-shop-photos-help" style="display: none;">
                    <h3 class="help-title">Help</h3>
                    <div class="help-content">
                      <p>Please upload your office/shop photographs in jpg, png, or pdf format.</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Salaried and Business fields container -->
              <div class="document-row" id="salaried-business-fields-container">
                <div class="add-document" id="add-salaried-business-btn">
                  <span class="add-text">Add</span>
                  <span class="add-icon">+</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all managers
    const managers = [
        SectionToggler,
        InputFieldManager,
        FormValidator,
        CityAutocomplete,
        SocialOptionsManager,
        CourseLocationManager,
        CourseOptionsManager,
        CourseDurationManager,
        CourseDetailsManager,
        AcademicDetailsManager,
        CoBorrowerManager,
        SectionManager,
        DocumentFieldManager
    ];
    managers.forEach(manager => manager.init());
});

// Utility function for toggling visibility
const toggleVisibility = (element, isVisible, icon, rotateClass = 'rotated') => {
    element.style.display = isVisible ? 'none' : 'block';
    if (icon) icon.classList.toggle(rotateClass, !isVisible);
};

// Section Toggler
const SectionToggler = {
    init() {
        this.setupToggles([
            {
                header: '.admin-student-section-header',
                content: '.admin-student-section-content',
                arrow: '.admin-student-arrow-icon img',
                arrowClasses: ['admin-student-arrow-up', 'admin-student-arrow-down']
            },
            {
                id: 'admin-student-person-info',
                sectionId: 'person-info-section'
            },
            {
                id: 'admin-student-about-us',
                sectionId: 'about-us-section'
            },
            {
                header: '.admin-student-section-header-course',
                content: '.admin-student-section-content-course',
                arrow: '.admin-student-arrow-icon-course',
                rotate: true
            }
        ]);
    },

    setupToggles(configs) {
        configs.forEach(config => {
            if (config.header) {
                const header = document.querySelector(config.header);
                const content = document.querySelector(config.content);
                const arrow = document.querySelector(config.arrow);
                content.style.display = 'block';
                if (config.arrowClasses) {
                    arrow.classList.add(config.arrowClasses[0]);
                    arrow.classList.remove(config.arrowClasses[1]);
                } else if (config.rotate) {
                    arrow.style.transform = 'rotate(180deg)';
                }

                header.addEventListener('click', () => {
                    const isVisible = content.style.display === 'block';
                    content.style.display = isVisible ? 'none' : 'block';
                    if (config.arrowClasses) {
                        arrow.classList.toggle(config.arrowClasses[0], !isVisible);
                        arrow.classList.toggle(config.arrowClasses[1], isVisible);
                    } else if (config.rotate) {
                        arrow.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
                    }
                });
            } else if (config.id) {
                const row = document.getElementById(config.id);
                const section = document.getElementById(config.sectionId);
                if (row && section) {
                    row.addEventListener('click', () => {
                        section.style.display = section.style.display === 'none' ? 'block' : 'none';
                    });
                }
            }
        });
    }
};

// Input Field Manager
const InputFieldManager = {
    iconMap: {
        name: './assets/images/person-icon.png',
        phone: './assets/images/call-icon.png',
        email: './assets/images/mail.png',
        city: './assets/images/pin_drop.png',
        country: './assets/images/pin_drop.png',
        pincode: './assets/images/pin_drop.png',
        referral: './assets/images/school.png'
    },

    init() {
        this.setupEvents();
    },

    setupEvents() {
        document.addEventListener('click', e => {
            if (e.target.classList.contains('remove-option')) {
                e.target.closest('.input-group').remove();
                this.reorganizeInputs();
            }
        });

        const addInputField = document.getElementById('add-input-field');
        if (addInputField) {
            addInputField.addEventListener('click', () => {
                const fieldType = prompt("Enter field type (e.g., Country, Pincode):")?.trim();
                if (fieldType) this.addNewInputField(fieldType);
            });
        }
    },

    addNewInputField(fieldType) {
        const fieldTypeLower = fieldType.toLowerCase();
        let iconSrc = './assets/images/pin_drop.png';
        for (const [key, value] of Object.entries(this.iconMap)) {
            if (fieldTypeLower.includes(key) || key.includes(fieldTypeLower)) {
                iconSrc = value;
                break;
            }
        }

        const newInput = document.createElement('div');
        newInput.className = 'input-group';
        newInput.innerHTML = `
            <div class="input-content">
                <img src="${iconSrc}" alt="${fieldType} Icon" class="icon" />
                <input type="text" placeholder="${fieldType}" name="${fieldTypeLower.replace(/\s+/g, '_')}" required />
            </div>
            <span class="remove-option">×</span>
            <div class="validation-message" id="${fieldTypeLower.replace(/\s+/g, '_')}-error"></div>
        `;

        const addButton = document.getElementById('add-input-field');
        addButton.parentNode.insertBefore(newInput, addButton);
        this.reorganizeInputs();
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
    }
};

// Form Validator
const FormValidator = {
    init() {
        document.querySelectorAll('input[required]').forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
        });
    },

    validateField(field) {
        const errorElement = document.getElementById(`${field.id}-error`);
        if (!errorElement) return;

        const inputGroup = field.closest('.input-group');
        inputGroup.style.borderColor = '';

        if (!field.value.trim()) {
            errorElement.textContent = `Please enter a valid ${field.placeholder.toLowerCase()}`;
            errorElement.style.display = 'block';
            inputGroup.style.borderColor = 'red';
        } else if (field.type === 'email' && !this.isValidEmail(field.value)) {
            errorElement.textContent = 'Please enter a valid email address';
            errorElement.style.display = 'block';
            inputGroup.style.borderColor = 'red';
        } else if (field.id === 'phone' && !this.isValidPhone(field.value)) {
            errorElement.textContent = 'Please enter a valid 10-digit phone number.';
            errorElement.style.display = 'block';
            inputGroup.style.borderColor = 'red';
        } else {
            errorElement.textContent = '';
            errorElement.style.display = 'none';
        }
    },

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    },

    isValidPhone(phone) {
        return /^\d{10}$/.test(phone);
    }
};

// City Autocomplete
const CityAutocomplete = {
    cities: ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'],

    init() {
        const cityInput = document.getElementById('city-input');
        const suggestionsContainer = document.getElementById('suggestions');
        if (cityInput && suggestionsContainer) {
            this.setupAutocomplete(cityInput, suggestionsContainer);
        }
    },

    setupAutocomplete(cityInput, suggestionsContainer) {
        cityInput.addEventListener('input', function() {
            const inputValue = this.value.toLowerCase();
            suggestionsContainer.innerHTML = '';

            if (inputValue.length > 0) {
                const matchedCities = CityAutocomplete.cities.filter(city => 
                    city.toLowerCase().startsWith(inputValue)
                );

                if (matchedCities.length > 0) {
                    suggestionsContainer.style.display = 'block';
                    matchedCities.forEach(city => {
                        const div = document.createElement('div');
                        div.textContent = city;
                        div.style.padding = '8px 10px';
                        div.style.cursor = 'pointer';
                        div.addEventListener('click', () => {
                            cityInput.value = city;
                            suggestionsContainer.style.display = 'none';
                            FormValidator.validateField(cityInput);
                        });
                        div.addEventListener('mouseover', () => div.style.backgroundColor = '#f0f0f0');
                        div.addEventListener('mouseout', () => div.style.backgroundColor = 'transparent');
                        suggestionsContainer.appendChild(div);
                    });
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            } else {
                suggestionsContainer.style.display = 'none';
            }
        });

        document.addEventListener('click', e => {
            if (e.target !== cityInput && e.target !== suggestionsContainer) {
                suggestionsContainer.style.display = 'none';
            }
        });
    }
};

// Social Options Manager
const SocialOptionsManager = {
    init() {
        document.querySelectorAll('.social-remove').forEach(btn => {
            btn.addEventListener('click', () => btn.parentElement.remove());
        });

        const addSocialButton = document.querySelector('.add-social');
        if (addSocialButton) {
            addSocialButton.addEventListener('click', () => {
                const userInput = prompt("Enter dropdown option", "")?.trim();
                if (userInput) {
                    const newOption = document.createElement('div');
                    newOption.className = 'social-option';
                    newOption.innerHTML = `
                        <span class="social-name">${userInput}</span>
                        <span class="social-remove">×</span>
                    `;
                    newOption.querySelector('.social-remove').addEventListener('click', () => newOption.remove());
                    document.querySelector('.second-question-options')?.appendChild(newOption);
                }
            });
        }
    }
};

// Course Location Manager
const CourseLocationManager = {
    init() {
        const checkboxContainer = document.getElementById('selected-study-location');
        const addCheckboxContainer = document.querySelector('.add-checkbox-container');
        if (checkboxContainer && addCheckboxContainer) {
            addCheckboxContainer.addEventListener('click', e => {
                e.preventDefault();
                this.addNewCheckbox(checkboxContainer, addCheckboxContainer);
            });
        }

        const questionRow = document.querySelector('.admin-student-question-row-course');
        const optionsSection = document.querySelector('.admin-student-options-section-course');
        if (questionRow && optionsSection) {
            optionsSection.style.display = 'none';
            questionRow.addEventListener('click', () => {
                toggleVisibility(optionsSection, optionsSection.style.display === 'block');
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
            newLabel.innerHTML = `<input type="checkbox" name="study-location" value="${newCountry}" checked> ${newCountry}`;
            checkboxContainer.insertBefore(newLabel, addCheckboxContainer);
        }
    }
};

// Course Options Manager
const CourseOptionsManager = {
    init() {
        const optionsContainer = document.getElementById('option-section-degree-container');
        const dropdownTrigger = document.getElementById('admin-student-course-second');
        if (!optionsContainer || !dropdownTrigger) return;

        optionsContainer.style.display = 'none';
        dropdownTrigger.addEventListener('click', e => {
            e.stopPropagation();
            toggleVisibility(optionsContainer, optionsContainer.style.display === 'block');
        });

        const addSection = document.getElementById('addSection');
        const optionsGrid = document.getElementById('optionsContainer');
        if (addSection && optionsGrid) {
            addSection.addEventListener('click', e => {
                e.stopPropagation();
                const newOptionName = prompt('Enter new option:')?.trim();
                if (newOptionName) {
                    optionsGrid.removeChild(addSection);
                    const newOptionItem = document.createElement('div');
                    newOptionItem.className = 'option-item';
                    newOptionItem.innerHTML = `
                        <input type="checkbox" class="option-checkbox">
                        <div class="option-name">${newOptionName}</div>
                    `;
                    optionsGrid.appendChild(newOptionItem);
                    optionsGrid.appendChild(addSection);
                }
            });
        }
    }
};

// Course Duration Manager
const CourseDurationManager = {
    init() {
        const rowElement = document.getElementById('course-row-month-id');
        const dropdownElement = document.getElementById('course-dropdown-month-id');
        const optionsSection = document.getElementById('course-duration-section-month');
        if (!rowElement || !dropdownElement || !optionsSection) return;

        optionsSection.style.display = 'none';
        const toggleOptions = () => {
            const isHidden = optionsSection.style.display === 'none';
            toggleVisibility(optionsSection, !isHidden, document.querySelector('.admin-student-dropdown-icon'));
            document.querySelector('.admin-student-form-question-month').classList.toggle('active', isHidden);
        };

        rowElement.addEventListener('click', toggleOptions);
        dropdownElement.addEventListener('click', e => {
            e.stopPropagation();
            toggleOptions();
        });

        document.querySelectorAll('.course-remove').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                btn.parentElement.remove();
            });
        });

        document.querySelector('.add-course')?.addEventListener('click', e => {
            e.stopPropagation();
            this.addNewDurationOption();
        });
    },

    addNewDurationOption() {
        const userInput = prompt("Enter course duration option", "")?.trim();
        if (userInput) {
            const newOption = document.createElement('div');
            newOption.className = 'course-option';
            newOption.innerHTML = `
                <span class="course-name">${userInput}</span>
                <span class="course-remove">×</span>
            `;
            newOption.querySelector('.course-remove').addEventListener('click', e => {
                e.stopPropagation();
                newOption.remove();
            });
            document.querySelector('.course-options')?.appendChild(newOption);
        }
    }
};

// Course Details Manager
const CourseDetailsManager = {
    init() {
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

        const addOptionBtn = container.querySelector('#add-option-btn');
        if (addOptionBtn) {
            addOptionBtn.addEventListener('click', e => {
                e.stopPropagation();
                this.addNewCourseOption(container);
            });
        }

        container.querySelector('.checkbox-options-container')?.addEventListener('click', e => e.stopPropagation());
    },

    addNewCourseOption(container) {
        const userInput = prompt("Enter new option", "")?.trim();
        if (userInput) {
            const optionsContainer = container.querySelector('.checkbox-options-container');
            if (!optionsContainer) return;

            const newOption = document.createElement('div');
            newOption.className = 'checkbox-option';
            const checkboxId = `option-${Date.now()}`;
            newOption.innerHTML = `
                <input type="checkbox" id="${checkboxId}" name="course-options">
                <label for="${checkboxId}">${userInput}</label>
            `;
            optionsContainer.appendChild(newOption);
        }
    }
};

// Academic Details Manager
const AcademicDetailsManager = {
    fieldCount: 2,
    rowCount: 1,

    init() {
        const section = document.getElementById('academic-details-section');
        const content = document.getElementById('academic-details-content');
        const arrow = document.querySelector('.admin-student-arrow-icon-academic');
        section.addEventListener('click', () => {
            content.classList.toggle('expanded');
            arrow.classList.toggle('rotated');
        });

        this.setupEducationSection();
        this.setupAcademicGapSection();
    },

    setupEducationSection() {
        const container = document.getElementById('education-container');
        const headerRow = document.getElementById('education-header-row');
        const dropdownIcon = container.querySelector('.admin-student-dropdown-icon');
        const section = document.getElementById('education-section');
        headerRow.addEventListener('click', e => {
            e.stopPropagation();
            const isVisible = section.style.display === 'block';
            toggleVisibility(section, isVisible, dropdownIcon);
            container.classList.toggle('active', !isVisible);
        });

        document.querySelectorAll('.education-field').forEach(field => {
            field.addEventListener('click', e => e.stopPropagation());
        });

        document.getElementById('add-education-field-btn').addEventListener('click', e => {
            e.stopPropagation();
            this.addEducationField();
        });

        this.setupRemoveButtons();
    },

    setupRemoveButtons() {
        document.querySelectorAll('.remove-field-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                const field = btn.parentNode;
                const row = field.parentNode;
                field.remove();
                if (row.children.length === 0) row.remove();
                this.fieldCount--;
            });
        });
    },

    addEducationField() {
        const fieldName = prompt("Enter new field name (e.g., Graduation Year):", "")?.trim();
        if (fieldName) {
            const newField = document.createElement('div');
            newField.className = 'education-field';
            newField.innerHTML = `
                <input type="text" placeholder="${fieldName}" name="${fieldName.toLowerCase().replace(/\s+/g, '-')}" />
                <button type="button" class="remove-field-btn">✕</button>
            `;
            newField.querySelector('.remove-field-btn').addEventListener('click', e => {
                e.stopPropagation();
                newField.remove();
                this.fieldCount--;
                const parentRow = newField.parentNode;
                if (parentRow.children.length === 0) parentRow.remove();
            });

            let currentRow;
            if (this.fieldCount % 2 === 0) {
                this.rowCount++;
                currentRow = document.createElement('div');
                currentRow.className = 'education-row';
                currentRow.id = `education-row-${this.rowCount}`;
                document.getElementById('education-section').insertBefore(currentRow, document.getElementById('add-education-field-btn'));
            } else {
                currentRow = document.getElementById(`education-row-${this.rowCount}`) || document.createElement('div');
                if (!currentRow.id) {
                    currentRow.className = 'education-row';
                    currentRow.id = `education-row-${this.rowCount}`;
                    document.getElementById('education-section').insertBefore(currentRow, document.getElementById('add-education-field-btn'));
                }
            }

            currentRow.appendChild(newField);
            this.fieldCount++;
        }
    },

    setupAcademicGapSection() {
        const container = document.getElementById('academic-gap-container');
        const row = container.querySelector('#academic-gap-row');
        const dropdownIcon = container.querySelector('.admin-student-dropdown-icon');
        const optionsSection = container.querySelector('#academic-gap-options');
        row.addEventListener('click', e => {
            e.stopPropagation();
            const isVisible = optionsSection.style.display === 'block';
            toggleVisibility(optionsSection, isVisible, dropdownIcon);
            container.classList.toggle('active', !isVisible);
        });

        container.querySelector('.academic-options').addEventListener('click', e => e.stopPropagation());

        container.querySelector('#add-academic-option-btn').addEventListener('click', e => {
            e.stopPropagation();
            const userInput = prompt("Enter new option", "")?.trim();
            if (userInput) {
                const optionsContainer = container.querySelector('.academic-options');
                const newOption = document.createElement('div');
                newOption.className = 'academic-option';
                const radioId = `academic-option-${Date.now()}`;
                newOption.innerHTML = `
                    <input type="radio" id="${radioId}" name="academics-gap" value="${userInput.toLowerCase().replace(/\s+/g, '-')}" />
                    <label for="${radioId}">${userInput}</label>
                `;
                optionsContainer.appendChild(newOption);
            }
        });

        const yesRadio = document.getElementById('academic-yes');
        const noRadio = document.getElementById('academic-no');
        yesRadio.addEventListener('change', () => {
            let reasonSection = container.querySelector('.academic-reason');
            if (!reasonSection) {
                reasonSection = document.createElement('div');
                reasonSection.className = 'academic-reason';
                reasonSection.innerHTML = `
                    <label>Please state the reason for the gap:</label>
                    <textarea placeholder="Enter your reason here..."></textarea>
                `;
                const optionsContainer = container.querySelector('.academic-options-container');
                optionsContainer.parentNode.insertBefore(reasonSection, optionsContainer.nextSibling);
            }
            setTimeout(() => reasonSection.classList.add('visible'), 10);
        });

        noRadio.addEventListener('change', () => {
            const reasonSection = container.querySelector('.academic-reason');
            if (reasonSection) reasonSection.classList.remove('visible');
        });
    }
};

// Co-Borrower Manager
const CoBorrowerManager = {
    init() {
        this.setupDropdowns([
            { containerId: 'co-borrower-container', rowId: 'co-borrower-row', optionsId: 'co-borrower-options' },
            { containerId: 'income-container', rowId: 'income-row', optionsId: 'income-options' },
            { containerId: 'liability-container', rowId: 'liability-row', optionsId: 'liability-options' }
        ]);

        this.setupCoBorrowerOptions();
        this.setupIncomeFields();
        this.setupLiabilityFields();
        this.setupCoBorrowerSectionToggle();
        this.setupFieldValidation();
    },

    setupDropdowns(dropdowns) {
        dropdowns.forEach(({ containerId, rowId, optionsId }) => {
            const container = document.getElementById(containerId);
            const row = document.getElementById(rowId);
            const options = document.getElementById(optionsId);
            const dropdownIcon = row.querySelector('.admin-student-dropdown-icon');
            row.addEventListener('click', () => {
                const isVisible = options.style.display !== 'none';
                toggleVisibility(options, isVisible, dropdownIcon);
                container.classList.toggle('active', !isVisible);
            });
        });
    },

    setupCoBorrowerOptions() {
        const addOptionBtn = document.getElementById('add-option-btn');
        addOptionBtn.addEventListener('click', e => {
            e.stopPropagation();
            const userInput = prompt("Enter new option", "")?.trim();
            if (userInput) {
                const optionsContainer = document.querySelector('.checkbox-options-container');
                const newOption = document.createElement('div');
                newOption.className = 'checkbox-option';
                const checkboxId = `co-borrower-${userInput.toLowerCase().replace(/\s+/g, '-')}`;
                newOption.innerHTML = `
                    <input type="checkbox" id="${checkboxId}" name="co-borrower-options" />
                    <label for="${checkboxId}">${userInput}</label>
                `;
                optionsContainer.insertBefore(newOption, addOptionBtn);
                newOption.querySelector('input').addEventListener('change', function() {
                    if (this.checked) {
                        document.querySelectorAll('input[name="co-borrower-options"]').forEach(cb => {
                            if (cb !== this) cb.checked = false;
                        });
                    }
                });
            }
        });

        document.querySelectorAll('input[name="co-borrower-options"]').forEach(cb => {
            cb.addEventListener('change', function() {
                if (this.checked) {
                    document.querySelectorAll('input[name="co-borrower-options"]').forEach(otherCb => {
                        if (otherCb !== this) otherCb.checked = false;
                    });
                }
            });
        });
    },

    setupIncomeFields() {
        document.querySelectorAll('.delete-field').forEach(btn => this.setupDeleteButton(btn));
        const addIncomeFieldBtn = document.getElementById('add-income-field-btn');
        addIncomeFieldBtn.addEventListener('click', e => {
            e.stopPropagation();
            const userInput = prompt("Enter field name", "")?.trim();
            if (userInput) {
                const fieldsRowContainer = document.querySelector('.fields-row-container');
                const fieldContainer = document.createElement('div');
                fieldContainer.className = 'field-container';
                fieldContainer.innerHTML = `
                    <input type="text" class="text-input" value="${userInput}" />
                    <button class="delete-field">✕</button>
                `;
                fieldsRowContainer.insertBefore(fieldContainer, addIncomeFieldBtn);
                const deleteButton = fieldContainer.querySelector('.delete-field');
                this.setupDeleteButton(deleteButton);
                fieldContainer.querySelector('.text-input').addEventListener('input', this.validateNumericField);
            }
        });
    },

    setupLiabilityFields() {
        document.querySelectorAll('input[name="co-borrower-liability"]').forEach(radio => {
            radio.addEventListener('change', () => {
                const emiInput = document.getElementById('emi-amount');
                const additionalFields = document.getElementById('additional-liability-fields');
                const addLiabilityBtn = document.getElementById('add-liability-btn');
                if (radio.id === 'yes-liability' && radio.checked) {
                    emiInput.disabled = false;
                    additionalFields.style.display = 'flex';
                    addLiabilityBtn.style.display = 'flex';
                } else {
                    emiInput.disabled = true;
                    emiInput.value = '';
                    additionalFields.style.display = 'none';
                    addLiabilityBtn.style.display = 'none';
                    while (additionalFields.firstChild) additionalFields.removeChild(additionalFields.firstChild);
                }
            });
        });

        const addLiabilityBtn = document.getElementById('add-liability-btn');
        addLiabilityBtn.addEventListener('click', e => {
            e.stopPropagation();
            const userInput = prompt("Enter field name for liability", "")?.trim();
            if (userInput) {
                const additionalFieldsContainer = document.getElementById('additional-liability-fields');
                const fieldContainer = document.createElement('div');
                fieldContainer.className = 'liability-input-container';
                fieldContainer.innerHTML = `
                    <input type="text" class="liability-input" placeholder="${userInput}" />
                    <button class="delete-liability-field" aria-label="Delete field">✕</button>
                `;
                additionalFieldsContainer.appendChild(fieldContainer);
                fieldContainer.querySelector('.delete-liability-field').addEventListener('click', e => {
                    e.stopPropagation();
                    fieldContainer.remove();
                });
                fieldContainer.querySelector('.liability-input').addEventListener('input', function() {
                    const value = this.value.replace(/[^0-9]/g, '');
                    this.style.borderColor = value === '' || isNaN(value) ? 'red' : '#ccc';
                });
            }
        });
    },

    setupCoBorrowerSectionToggle() {
        const header = document.querySelector('.admin-student-section-header-co-borrower');
        const arrow = document.querySelector('.admin-student-arrow-icon-co-borrower');
        const formQuestions = document.querySelectorAll('.admin-student-form-question');
        let containersVisible = false;
        header.addEventListener('click', () => {
            containersVisible = !containersVisible;
            formQuestions.forEach(q => q.style.display = containersVisible ? 'block' : 'none');
            arrow.style.transform = containersVisible ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    },

    setupDeleteButton(button) {
        button.addEventListener('click', e => {
            e.stopPropagation();
            const fieldContainer = button.closest('.field-container') || button.closest('.liability-input-container');
            fieldContainer.remove();
        });
    },

    setupFieldValidation() {
        document.querySelectorAll('.text-input, #emi-amount').forEach(input => {
            input.addEventListener('input', this.validateNumericField);
        });
        document.querySelectorAll('.options-section').forEach(section => {
            section.addEventListener('click', e => e.stopPropagation());
        });
    },

    validateNumericField() {
        const value = this.value.replace(/[^0-9]/g, '');
        const errorMessage = this.closest('.field-container')?.querySelector('.error-message') || document.getElementById('emi-error-message');
        if (errorMessage) {
            errorMessage.style.display = value === '' || isNaN(value) ? 'block' : 'none';
            this.style.borderColor = value === '' || isNaN(value) ? 'red' : '#ccc';
        }
    }
};

// Section Manager
const SectionManager = {
    init() {
        this.cacheElements();
        this.setupInitialStates();
        this.setupEventListeners();
    },

    cacheElements() {
        this.sections = {
            document: {
                header: document.querySelector('.admin-student-section-header-document-upload'),
                content: document.querySelector('.admin-student-section-content-document-upload'),
                arrow: document.querySelector('.admin-student-arrow-icon-document-upload img'),
                subsections: {
                    kyc: { row: document.getElementById('student-kyc-row'), section: document.getElementById('student-kyc-section'), icon: document.querySelector('#student-kyc-row .admin-student-dropdown-icon') },
                    academic: { row: document.getElementById('academic-marks-row'), section: document.getElementById('academic-marks-section'), icon: document.querySelector('#academic-marks-row .admin-student-dropdown-icon') },
                    secured: { row: document.getElementById('secured-marks-row'), section: document.getElementById('secured-marks-section'), icon: document.querySelector('#secured-marks-row .admin-student-dropdown-icon') },
                    workExperience: { row: document.getElementById('work-experience-row'), section: document.getElementById('work-experience-section'), container: document.querySelector('.work-experience-container'), icon: document.querySelector('#work-experience-row .admin-student-dropdown-icon') },
                    coBorrower: { row: document.getElementById('co-borrower-kyc-row'), section: document.getElementById('co-borrower-kyc-section'), icon: document.querySelector('#co-borrower-kyc-row .admin-student-dropdown-icon') },
                    salariedBusiness: { row: document.getElementById('salaried-business-row'), section: document.getElementById('salaried-business-section'), icon: document.querySelector('#salaried-business-row .admin-student-dropdown-icon') }
                }
            }
        };
    },

    setupInitialStates() {
        Object.values(this.sections).forEach(section => {
            if (section.content && section.arrow) {
                section.content.style.display = 'block';
                section.arrow.classList.add('admin-student-arrow-up');
                section.arrow.classList.remove('admin-student-arrow-down');
            }
            Object.values(section.subsections).forEach(subsection => {
                if (subsection.section && subsection.icon) {
                    (subsection.container || subsection.section).style.display = 'none';
                    subsection.icon.classList.remove('rotated');
                }
            });
        });
    },

    setupEventListeners() {
        Object.values(this.sections).forEach(section => {
            if (section.header && section.content && section.arrow) {
                section.header.addEventListener('click', () => {
                    const isVisible = section.content.style.display === 'block';
                    toggleVisibility(section.content, isVisible, section.arrow, 'admin-student-arrow-up');
                    section.arrow.classList.toggle('admin-student-arrow-down', isVisible);
                });
            }
            Object.values(section.subsections).forEach(subsection => {
                if (subsection.row && subsection.section && subsection.icon) {
                    subsection.row.addEventListener('click', e => {
                        e.stopPropagation();
                        const target = subsection.container || subsection.section;
                        const isVisible = target.style.display === 'block';
                        toggleVisibility(target, isVisible, subsection.icon);
                    });
                }
            });
        });

        document.querySelectorAll('.help-trigger').forEach(trigger => {
            trigger.addEventListener('click', e => {
                e.stopPropagation();
                const targetId = trigger.getAttribute('data-target');
                const helpContainer = document.querySelector(`.${targetId}`);
                document.querySelectorAll('.help-container').forEach(container => {
                    container.style.display = container === helpContainer && helpContainer.style.display !== 'block' ? 'block' : 'none';
                });
            });
        });

        document.addEventListener('click', e => {
            if (!e.target.classList.contains('help-trigger') && !e.target.closest('.help-container')) {
                document.querySelectorAll('.help-container').forEach(container => container.style.display = 'none');
            }
        });
    }
};

// Document Field Manager
const DocumentFieldManager = {
    counts: { document: 0, academic: 0, secured: 0, workExperience: 0, coBorrower: 0, salariedBusiness: 0 },

    init() {
        const buttons = [
            { id: 'add-document-btn', type: 'document', containerId: 'document-fields-container' },
            { id: 'add-academic-btn', type: 'academic', containerId: 'academic-fields-container' },
            { id: 'add-secured-btn', type: 'secured', containerId: 'secured-fields-container' },
            { id: 'add-work-experience-btn', type: 'workExperience', containerId: 'work-experience-row-2' },
            { id: 'add-co-borrower-btn', type: 'coBorrower', containerId: 'co-borrower-fields-container' },
            { id: 'add-salaried-business-btn', type: 'salariedBusiness', containerId: 'salaried-business-fields-container' }
        ];

        buttons.forEach(({ id, type, containerId }) => {
            const button = document.getElementById(id);
            if (button) {
                button.addEventListener('click', () => {
                    const fieldType = prompt(`Enter ${type} document type:`)?.trim();
                    if (fieldType) this.addNewDocumentField(fieldType, type, containerId);
                });
            }
        });
    },

    addNewDocumentField(fieldType, type, containerId) {
        const count = ++this.counts[type];
        const docId = `${type}-${count}`;
        const container = document.getElementById(containerId);
        const addButton = document.getElementById(`add-${type}-btn`);
        const boxClass = type === 'workExperience' ? 'work-experience-box' : type === 'salariedBusiness' ? 'document-box salary-upload-box' : 'document-box';

        const newBox = document.createElement('div');
        newBox.className = boxClass;
        newBox.innerHTML = `
            <div class="upload-field clickable" id="${docId}-upload-field">
                <span id="${docId}-name" data-original="${fieldType}">${fieldType}</span>
                <span id="${docId}-remove-btn" class="remove-btn"><span class="thin-x"></span></span>
                <input type="file" id="${docId}" accept=".jpg, .png, .pdf" onchange="handleFileUpload(event, '${docId}-name', null, '${docId}-remove-icon')" />
            </div>
            <span id="${docId}-remove-icon" class="remove-icon" style="display: none;" onclick="removeFile('${docId}', '${docId}-name', null, '${docId}-remove-icon')"><span class="thin-x"></span></span>
            ${['academic', 'secured', 'workExperience', 'coBorrower', 'salariedBusiness'].includes(type) ? `
            <div class="info">
                <span class="help-trigger" data-target="${docId}-help">ⓘ Help</span>
                <span>*jpg, png, pdf formats</span>
            </div>
            <div class="help-container ${docId}-help" style="display: none;">
                <h3 class="help-title">Help</h3>
                <div class="help-content">
                    <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                </div>
            </div>` : ''}
        `;

        container.insertBefore(newBox, addButton);
        newBox.querySelector(`#${docId}-remove-btn`).addEventListener('click', () => newBox.remove());
        const uploadField = newBox.querySelector(`#${docId}-upload-field`);
        const fileInput = newBox.querySelector(`#${docId}`);
        uploadField.addEventListener('click', e => {
            if (!e.target.closest('.remove-btn')) fileInput.click();
        });

        if (['academic', 'secured', 'workExperience', 'coBorrower', 'salariedBusiness'].includes(type)) {
            newBox.querySelector('.help-trigger').addEventListener('click', e => {
                e.stopPropagation();
                const helpContainer = newBox.querySelector(`.${docId}-help`);
                document.querySelectorAll('.help-container').forEach(container => {
                    container.style.display = container === helpContainer && helpContainer.style.display !== 'block' ? 'block' : 'none';
                });
            });
        }
    }
};

window.handleFileUpload = (event, nameId, uploadIconId, removeIconId) => {
    const file = event.target.files[0];
    if (file) {
        document.getElementById(nameId).textContent = file.name;
        if (uploadIconId) document.getElementById(uploadIconId).style.display = 'none';
        document.getElementById(removeIconId).style.display = 'inline-block';
    }
};

window.removeFile = (inputId, nameId, uploadIconId, removeIconId) => {
    const input = document.getElementById(inputId);
    input.value = '';
    const nameSpan = document.getElementById(nameId);
    nameSpan.textContent = nameSpan.getAttribute('data-original') || nameSpan.textContent;
    if (uploadIconId) document.getElementById(uploadIconId).style.display = 'inline';
    document.getElementById(removeIconId).style.display = 'none';
};
         
</script>
</body>
</html>