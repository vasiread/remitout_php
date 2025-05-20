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
                        <input type="text" placeholder="Full Name" name="let-us-know-more-about-you[full_name]"
                          id="fullName" required />
                      </div>
                      <span class="remove-option">×</span>
                      <div class="validation-message" id="fullName-error"></div>
                    </div>

                    <div class="input-group">
                      <div class="input-content">
                        <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
                        <input type="tel" placeholder="Phone Number" name="let-us-know-more-about-you[phone_number]"
                          id="phone" required />
                      </div>
                      <span class="remove-option">×</span>
                      <div class="validation-message" id="phone-error"></div>
                    </div>

                    <div class="input-group">
                      <div class="input-content">
                        <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
                        <input type="text" placeholder="Referral Code" name="let-us-know-more-about-you[referral_code]"
                          id="referralCode" />
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
                        <input type="email" placeholder="Email ID" name="let-us-know-more-about-you[email]" id="email"
                          required />
                      </div>
                      <span class="remove-option">×</span>
                      <div class="validation-message" id="email-error"></div>
                    </div>

                    <div class="input-group">
                      <div class="input-content">
                        <img src="./assets/images/calendar_month.png" alt="Calendar Icon" class="icon" />
                        <input type="date" placeholder="Date of Birth (DD/MM/YYYY)" name="date_of_birth"
                          id="personal-info-dob" required />
                        <div class="validation-message" id="dob-error"></div>
                      </div>
                    </div>

                    <div class="input-group">
                      <div class="input-content">
                        <div class="dropdown-gender-wrapper" id="admin-side-dropdown-gender-wrapper">
                          <div class="dropdown-gender" id="admin-side-dropdown-gender">
                            <div class="dropdown-gender-header">
                              <div class="dropdown-label-gender">Select Gender</div>
                              <div class="dropdown-icon-gender">
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
                                  <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" />
                                </svg>
                              </div>
                            </div>
                            <div class="dropdown-options-gender" id="admin-side-dropdown-options-gender">
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

                    <div class="input-row" id="input-row-3">
                      <div class="input-group">
                        <div class="input-content">
                          <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
                          <input type="text" placeholder="State" name="state" id="personal-info-state" required />
                          <div id="suggestions-state-admin-side-id" class="suggestions-container"></div>
                          <div class="validation-message" id="state-error"></div>
                        </div>
                      </div>

                      <div class="input-group">
                        <div class="input-content">
                          <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
                          <input type="text" placeholder="City" name="city" id="personal-info-city" required />
                          <div id="suggestions-city-admin-side-id" class="suggestions-container"></div>
                          <div class="validation-message" id="city-error"></div>
                        </div>
                      </div>
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
                  <div class="checkbox-group" id="selected-study-location-admin">

                    <label class="others-checkbox">
                      <input type="checkbox" name="where-are-you-planning-to-study[locations][]" value="Others"> Others
                    </label>


                    <div class="add-checkbox-container" id="plantostudycountryadd">
                      <span class="add-checkbox-input">Add</span>
                      <span class="add-checkbox-btn" id="add-course-checkbox-id">+</span>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Course Details 2 -->
              <div class="admin-student-form-question-course-degree" id="admin-student-form-question-course-degree">
                <div class="admin-student-question-row-course-degree" id="admin-student-course-second">
                  <div class="admin-student-question-title-course-degree">2. Select the type of degree you want to
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
                      <input type="checkbox" name="select-the-type-of-degree-you-want-to-pursue[degrees][]"
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
                    <div class="checkbox-options-container" id="checkbox-options-container-expenses">
                      <div class="checkbox-option">
                        <input type="checkbox" id="with-expenses" name="course-details[options][]"
                          value="With living expenses">
                        <label for="with-expenses">With living expenses</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="without-expenses" name="course-details[options][]"
                          value="Without living expenses">
                        <label for="without-expenses">Without living expenses</label>
                      </div>
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
                  <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down-academic">
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
                      <button type="button" class="remove-field-btn">✕</button>
                    </div>
                    <div class="education-field">
                      <input type="text" placeholder="Course Name" name="academic-details[education][0][course]">
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
                        <input type="radio" id="academic-yes" name="do-you-have-any-gap-in-your-academics[gap]"
                          value="Yes" required />
                        <label for="academic-yes">Yes</label>
                      </div>
                      <div class="academic-option">
                        <input type="radio" id="academic-no" name="do-you-have-any-gap-in-your-academics[gap]"
                          value="No" required />
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
              <div class="admin-student-section-header-co-borrower" id="admin-student-section-header-co-borrower-id">
                <div class="admin-student-section-title-co-borrower">
                  Co-borrower Info
                </div>
                <span class="admin-student-question-count-co-borrower">3 Questions</span>
                <div class="admin-student-arrow-icon-co-borrower">
                  <img src="assets/images/admin-drop.png" alt="Arrow Icon" class="admin-student-arrow-down-co-borrow" />
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
                    <div class="checkbox-options-container" id="checkbox-options-container-relation">
                      <div class="checkbox-option">
                        <input type="checkbox" id="co-borrower-parent" name="how-is-the-co-borrower-related-to-you[relationship][]" value="Parent" />
                        <label for="co-borrower-parent">Parent</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="co-borrower-spouse" name="how-is-the-co-borrower-related-to-you[relationship][]" value="Spouse" />
                        <label for="co-borrower-spouse">Spouse</label>
                      </div>
                      <div class="checkbox-option">
                        <input type="checkbox" id="co-borrower-blood-relative" name="how-is-the-co-borrower-related-to-you[relationship][]" value="Blood relative" />
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
                        <input type="text" class="text-input" placeholder="₹ Rupees in thousands" name="what-is-the-gross-monthly-income-of-co-borrower[income]" required />
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
                            <input type="radio" name="is-there-any-existing-co-borrower-monthly-liability[liability]" id="yes-liability" value="Yes" required />
                            Yes
                          </label>
                          <label>
                            <input type="radio" name="is-there-any-existing-co-borrower-monthly-liability[liability]" id="no-liability" value="No" required />
                            No
                          </label>
                        </div>

                        <!-- EMI field and add button on the right, in the same row -->
                        <div class="emi-row">
                          <div class="emi-content">
                            <p class="amount-thousand-mobile">
                              Enter the amount in thousands
                            </p>
                            <input type="text" id="emi-amount" class="emi-content-container" placeholder="Enter EMI amount" name="is-there-any-existing-co-borrower-monthly-liability[emi_amount]" />
                            <span id="emi-error-message" class="error-message" style="display: none; color: red;">
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
                          <div class="document-name" id="pan-card-document-name" style="display: none">
                            PAN Card
                          </div>
                          <div class="upload-field">
                            <span id="kyc-pan-name" data-original="PAN Card">PAN Card</span>
                            <span id="kyc-pan-remove-icon" class="remove-icon"
                              onclick="removeFile('kyc-pan', 'kyc-pan-name', 'kyc-pan-upload-icon', 'kyc-pan-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="kyc-pan" class="upload-icon" id="kyc-pan-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="kyc-pan" name="documents[student_kyc][pan_card]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'kyc-pan-name', 'kyc-pan-upload-icon', 'kyc-pan-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="kyc-pan-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container kyc-pan-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                            </div>
                          </div>
                        </div>
                        <!-- Aadhar Card -->
                        <div class="document-box">
                          <div class="document-name" id="aadhar-card-document-name" style="display: none">
                            Aadhar Card
                          </div>
                          <div class="upload-field">
                            <span id="aadhar-card-name" data-original="Aadhar Card">Aadhar Card</span>
                            <span id="aadhar-card-remove-icon" class="remove-icon"
                              onclick="removeFile('aadhar-card', 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="aadhar-card" class="upload-icon" id="aadhar-card-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="aadhar-card" name="documents[student_kyc][aadhar_card]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="aadhar-card-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container aadhar-card-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                            </div>
                          </div>
                        </div>
                        <!-- Passport -->
                        <div class="document-box">
                          <div class="document-name" id="passport-document-name" style="display: none">
                            Passport
                          </div>
                          <div class="upload-field">
                            <span id="passport-card-name" data-original="Passport">Passport</span>
                            <span id="passport-remove-icon" class="remove-icon"
                              onclick="removeFile('passport', 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="passport" class="upload-icon" id="passport-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="passport" name="documents[student_kyc][passport]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="passport-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container passport-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
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
                  <div class="admin-student-options-section" id="academic-marks-section">
                    <div class="document-container-admin">
                      <div class="document-row" id="academic-row-1">
                        <!-- 10th Grade Mark Sheet -->
                        <div class="document-box">
                          <div class="document-name" id="10th-mark-sheet-id" style="display: none">
                            10th Mark Sheet
                          </div>
                          <div class="upload-field">
                            <span id="tenth-grade-name" data-original="10th Grade Mark Sheet">10th Grade Mark
                              Sheet</span>
                            <span id="tenth-grade-remove-icon" class="remove-icon"
                              onclick="removeFile('tenth-grade', 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="tenth-grade" class="upload-icon" id="tenth-grade-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="tenth-grade" name="documents[academic_marks][tenth_grade]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container tenth-grade-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                            </div>
                          </div>
                        </div>
                        <!-- 12th Grade Mark Sheet -->
                        <div class="document-box">
                          <div class="document-name" id="12th-mark-sheet-id" style="display: none">
                            12th Mark Sheet
                          </div>
                          <div class="upload-field">
                            <span id="twelfth-grade-name" data-original="12th Grade Mark Sheet">12th Grade Mark
                              Sheet</span>
                            <span id="twelfth-grade-remove-icon" class="remove-icon"
                              onclick="removeFile('twelfth-grade', 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="twelfth-grade" class="upload-icon" id="twelfth-grade-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="twelfth-grade" name="documents[academic_marks][twelfth_grade]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="twelfth-grade-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container twelfth-grade-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                            </div>
                          </div>
                        </div>
                        <!-- Graduation Mark Sheet -->
                        <div class="document-box">
                          <div class="document-name" id="graduation-mark-sheet-id" style="display: none">
                            Graduation Mark Sheet
                          </div>
                          <div class="upload-field">
                            <span id="graduation-grade-name" data-original="Graduation Mark Sheet">Graduation Mark
                              Sheet</span>
                            <span id="graduation-grade-remove-icon" class="remove-icon"
                              onclick="removeFile('graduation-grade', 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="graduation-grade" class="upload-icon" id="graduation-grade-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="graduation-grade" name="documents[academic_marks][graduation]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="graduation-grade-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container graduation-grade-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
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
                          <div class="document-name" id="10th-grades-id" style="display: none">
                            10th Grade
                          </div>
                          <div class="upload-field">
                            <span id="secured-tenth-name" data-original="10th Grade">10th Grade</span>
                            <span id="secured-tenth-remove-icon" class="remove-icon"
                              onclick="removeFile('secured-tenth', 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="secured-tenth" class="upload-icon" id="secured-tenth-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="secured-tenth" name="documents[secured_marks][tenth_grade]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="secured-tenth-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container secured-tenth-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your 10th grade mark sheet in jpg, png, or pdf format.</p>
                            </div>
                          </div>
                        </div>
                        <!-- 12th Grade -->
                        <div class="document-box">
                          <div class="document-name" id="12th-grade-id" style="display: none">
                            12th Grade
                          </div>
                          <div class="upload-field">
                            <span id="secured-twelfth-name" data-original="12th Grade">12th Grade</span>
                            <span id="secured-twelfth-remove-icon" class="remove-icon"
                              onclick="removeFile('secured-twelfth', 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="secured-twelfth" class="upload-icon" id="secured-twelfth-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="secured-twelfth" name="documents[secured_marks][twelfth_grade]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="secured-twelfth-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container secured-twelfth-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your 12th grade mark sheet in jpg, png, or pdf format.</p>
                            </div>
                          </div>
                        </div>
                        <!-- Graduation -->
                        <div class="document-box">
                          <div class="document-name" id="graduation-id" style="display: none">
                            Graduation
                          </div>
                          <div class="upload-field">
                            <span id="secured-graduation-name" data-original="Graduation">Graduation</span>
                            <span id="secured-graduation-remove-icon" class="remove-icon"
                              onclick="removeFile('secured-graduation', 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="secured-graduation" class="upload-icon" id="secured-graduation-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="secured-graduation" name="documents[secured_marks][graduation]"
                                accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="secured-graduation-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container secured-graduation-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your graduation mark sheet in jpg, png, or pdf format.</p>
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
                  <div class="admin-student-options-section" id="work-experience-section">
                    <div class="work-experience-container">
                      <div class="work-experience-row" id="work-experience-row-1">
                        <!-- Experience Letter -->
                        <div class="work-experience-box">
                          <div class="document-name" id="experience-letter-id" style="display: none">
                            Experience Letter
                          </div>
                          <div class="upload-field">
                            <span id="work-experience-experience-letter" data-original="Experience Letter">Experience
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
                                name="documents[work_experience][experience_letter]" accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="work-experience-tenth-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container work-experience-tenth-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your experience letter in jpg, png, or pdf format.</p>
                            </div>
                          </div>
                        </div>
                        <!-- 3 Months Salary Slip -->
                        <div class="work-experience-box">
                          <div class="document-name" id="3-months-salary-slip-id" style="display: none">
                            3 Months Salary Slip
                          </div>
                          <div class="upload-field">
                            <span id="work-experience-monthly-slip" data-original="3 Months Salary Slip">3 Months Salary
                              Slip</span>
                            <span id="work-experience-twelfth-remove-icon" class="remove-icon"
                              onclick="removeFile('work-experience-twelfth', 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="work-experience-twelfth" class="upload-icon"
                                id="work-experience-twelfth-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="work-experience-twelfth"
                                name="documents[work_experience][salary_slip]" accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="work-experience-twelfth-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container work-experience-twelfth-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your 3 months salary slip in jpg, png, or pdf format.</p>
                            </div>
                          </div>
                        </div>
                        <!-- Office ID -->
                        <div class="work-experience-box">
                          <div class="document-name" id="office-IDs-id" style="display: none">
                            Office ID
                          </div>
                          <div class="upload-field">
                            <span id="work-experience-office-id" data-original="Office ID">Office ID</span>
                            <span id="work-experience-graduation-remove-icon" class="remove-icon"
                              onclick="removeFile('work-experience-graduation', 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="work-experience-graduation" class="upload-icon"
                                id="work-experience-graduation-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="work-experience-graduation"
                                name="documents[work_experience][office_id]" accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="work-experience-graduation-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container work-experience-graduation-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your office ID in jpg, png, or pdf format.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Second row of work experience documents -->
                      <div class="work-experience-row" id="work-experience-row-2">
                        <!-- Joining Letter -->
                        <div class="work-experience-box">
                          <div class="document-name" id="joining-letter-id" style="display: none">
                            Joining Letter
                          </div>
                          <div class="upload-field">
                            <span id="work-experience-joining-letter" data-original="Joining Letter">Joining
                              Letter</span>
                            <span id="work-experience-fourth-remove-icon" class="remove-icon"
                              onclick="removeFile('work-experience-fourth', 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="work-experience-fourth" class="upload-icon"
                                id="work-experience-fourth-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="work-experience-fourth"
                                name="documents[work_experience][joining_letter]" accept=".jpg, .png, .pdf"
                                onchange="handleFileUpload(event, 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')" />
                            </div>
                          </div>
                          <div class="info">
                            <span class="help-trigger" data-target="work-experience-fourth-help">ⓘ Help</span>
                            <span>*jpg, png, pdf formats</span>
                          </div>
                          <div class="help-container work-experience-fourth-help" style="display: none">
                            <h3 class="help-title">Help</h3>
                            <div class="help-content">
                              <p>Please upload your joining letter in jpg, png, or pdf format.</p>
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
                  <div class="admin-student-options-section" id="co-borrower-kyc-section">
                    <div class="kyc-container-admin">
                      <div class="document-container-admin">
                        <div class="document-row" id="co-borrower-row-1">
                          <!-- PAN Card -->
                          <div class="document-box">
                            <div class="document-name" id="pan-card-ids" style="display: none">
                              PAN Card
                            </div>
                            <div class="upload-field">
                              <span id="co-pan-card-name" data-original="PAN Card">PAN Card</span>
                              <span id="co-remove-icon" class="remove-icon"
                                onclick="removeFile('co-pan-card', 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')"><span
                                  class="thin-x"></span></span>
                              <div class="file-actions">
                                <label for="co-pan-card" class="upload-icon" id="co-upload-icon">
                                  <img src="assets/images/upload.png" alt="Upload Icon" />
                                </label>
                                <input type="file" id="co-pan-card" name="documents[co_borrower_kyc][pan_card]"
                                  accept=".jpg, .png, .pdf"
                                  onchange="handleFileUpload(event, 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')" />
                              </div>
                            </div>
                            <div class="info">
                              <span class="help-trigger" data-target="co-pan-card-help">ⓘ Help</span>
                              <span>*jpg, png, pdf formats</span>
                            </div>
                            <div class="help-container co-pan-card-help" style="display: none">
                              <h3 class="help-title">Help</h3>
                              <div class="help-content">
                                <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                              </div>
                            </div>
                          </div>
                          <!-- Aadhar Card -->
                          <div class="document-box">
                            <div class="document-name" id="aadhar-card-id" style="display: none">
                              Aadhar Card
                            </div>
                            <div class="upload-field">
                              <span id="co-aadhar-card-name" data-original="Aadhar Card">Aadhar Card</span>
                              <span id="co-aadhar-remove-icon" class="remove-icon"
                                onclick="removeFile('co-aadhar-card', 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')"><span
                                  class="thin-x"></span></span>
                              <div class="file-actions">
                                <label for="co-aadhar-card" class="upload-icon" id="co-aadhar-upload-icon">
                                  <img src="assets/images/upload.png" alt="Upload Icon" />
                                </label>
                                <input type="file" id="co-aadhar-card" name="documents[co_borrower_kyc][aadhar_card]"
                                  accept=".jpg, .png, .pdf"
                                  onchange="handleFileUpload(event, 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')" />
                              </div>
                            </div>
                            <div class="info">
                              <span class="help-trigger" data-target="co-aadhar-card-help">ⓘ Help</span>
                              <span>*jpg, png, pdf formats</span>
                            </div>
                            <div class="help-container co-aadhar-card-help" style="display: none">
                              <h3 class="help-title">Help</h3>
                              <div class="help-content">
                                <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
                              </div>
                            </div>
                          </div>
                          <!-- Address Proof -->
                          <div class="document-box">
                            <div class="document-name" id="address-proof-id" style="display: none">
                              Address Proof
                            </div>
                            <div class="upload-field">
                              <span id="co-addressproof" data-original="Address Proof">Address Proof</span>
                              <span id="co-passport-remove-icon" class="remove-icon"
                                onclick="removeFile('co-passport', 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')"><span
                                  class="thin-x"></span></span>
                              <div class="file-actions">
                                <label for="co-passport" class="upload-icon" id="co-passport-upload-icon">
                                  <img src="assets/images/upload.png" alt="Upload Icon" />
                                </label>
                                <input type="file" id="co-passport" name="documents[co_borrower_kyc][address_proof]"
                                  accept=".jpg, .png, .pdf"
                                  onchange="handleFileUpload(event, 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')" />
                              </div>
                            </div>
                            <div class="info">
                              <span class="help-trigger" data-target="co-passport-help">ⓘ Help</span>
                              <span>*jpg, png, pdf formats</span>
                            </div>
                            <div class="help-container co-passport-help" style="display: none">
                              <h3 class="help-title">Help</h3>
                              <div class="help-content">
                                <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
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
                          <div class="document-name" id="salary-slip-id" style="display: none;">3 months salary slip
                          </div>
                          <div class="upload-field">
                            <span id="salary-slip-name" data-original="3 months salary slip">3 months salary slip</span>
                            <span id="salary-slip-remove-icon" class="remove-icon" style="display: none;"
                              onclick="removeFile('salary-slip', 'salary-slip-name', 'salary-slip-upload-icon', 'salary-slip-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="salary-slip" class="upload-icon" id="salary-slip-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="salary-slip"
                                name="documents[salaried_business][salaried][salary_slip]" accept=".jpg, .png, .pdf"
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
                          <div class="document-name" id="bank-statement-id" style="display: none;">6 months bank
                            statement
                          </div>
                          <div class="upload-field">
                            <span id="bank-statement-name" data-original="6 months bank statement">6 months bank
                              statement</span>
                            <span id="bank-statement-remove-icon" class="remove-icon" style="display: none;"
                              onclick="removeFile('bank-statement', 'bank-statement-name', 'bank-statement-upload-icon', 'bank-statement-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="bank-statement" class="upload-icon" id="bank-statement-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="bank-statement"
                                name="documents[salaried_business][salaried][bank_statement]" accept=".jpg, .png, .pdf"
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
                          <div class="document-name" id="address-proof-salary-id" style="display: none;">Address Proof
                          </div>
                          <div class="upload-field">
                            <span id="address-proof-salary-name" data-original="Address Proof">Address Proof</span>
                            <span id="address-proof-salary-remove-icon" class="remove-icon" style="display: none;"
                              onclick="removeFile('address-proof-salary', 'address-proof-salary-name', 'address-proof-salary-upload-icon', 'address-proof-salary-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="address-proof-salary" class="upload-icon"
                                id="address-proof-salary-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="address-proof-salary"
                                name="documents[salaried_business][salaried][address_proof]" accept=".jpg, .png, .pdf"
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
                              onclick="removeFile('itr', 'itr-name', 'itr-upload-icon', 'itr-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="itr" class="upload-icon" id="itr-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="itr" name="documents[salaried_business][business][itr]"
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
                              <p>Please upload your 2 years of ITR in jpg, png, or pdf format.</p>
                            </div>
                          </div>
                        </div>
                        <!-- 6 Months Bank Statement -->
                        <div class="document-box salary-upload-box">
                          <div class="document-name" id="business-bank-statement-id" style="display: none;">6 months
                            bank
                            statement</div>
                          <div class="upload-field">
                            <span id="business-bank-statement-name" data-original="6 months bank statement">6 months
                              bank
                              statement</span>
                            <span id="business-bank-statement-remove-icon" class="remove-icon" style="display: none;"
                              onclick="removeFile('business-bank-statement', 'business-bank-statement-name', 'business-bank-statement-upload-icon', 'business-bank-statement-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="business-bank-statement" class="upload-icon"
                                id="business-bank-statement-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="business-bank-statement"
                                name="documents[salaried_business][business][bank_statement]" accept=".jpg, .png, .pdf"
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
                          <div class="document-name" id="office-shop-photos-id" style="display: none;">Office/Shop
                            photographs</div>
                          <div class="upload-field">
                            <span id="office-shop-photos-name" data-original="Office/Shop photographs">Office/Shop
                              photographs</span>
                            <span id="office-shop-photos-remove-icon" class="remove-icon" style="display: none;"
                              onclick="removeFile('office-shop-photos', 'office-shop-photos-name', 'office-shop-photos-upload-icon', 'office-shop-photos-remove-icon')"><span
                                class="thin-x"></span></span>
                            <div class="file-actions">
                              <label for="office-shop-photos" class="upload-icon" id="office-shop-photos-upload-icon">
                                <img src="assets/images/upload.png" alt="Upload Icon" />
                              </label>
                              <input type="file" id="office-shop-photos"
                                name="documents[salaried_business][business][office_photos]" accept=".jpg, .png, .pdf"
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
          <button type="button" id="admin-student-form-save-btn-id" class="admin-student-form-save-btn">Save
            Changes</button>
      </form>
    </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', () => {

      fetchAndAppendSocialNames();
      fetchAndRenderStudyLocations();
      fetchAndRenderDegrees();
      fetchAndRenderCourseDurations();
      kycInitialization();
      fetchAdditionalPersonalFields();

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
          this.setupToggles([
            {
              header: '.admin-student-section-header',
              content: '.admin-student-section-content',
              arrow: '.admin-student-arrow-icon img',
              arrowClasses: ['admin-student-arrow-up', 'admin-student-arrow-down'],
              defaultExpanded: true
            },
            {
              header: '#admin-student-person-info',
              content: '#person-info-section',
              defaultExpanded: false
            },
            {
              header: '#admin-student-about-us',
              content: '#about-us-section',
              defaultExpanded: false
            },
            {
              header: '.admin-student-section-header-course',
              content: '.admin-student-section-content-course',
              arrow: '.admin-student-arrow-icon-course img',
              rotate: true,
              defaultExpanded: true
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
              defaultExpanded: false
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
              defaultExpanded: false
            },
            {
              header: '#academic-marks-row',
              content: '#academic-marks-section',
              defaultExpanded: false
            },
            {
              header: '#secured-marks-row',
              content: '#secured-marks-section',
              defaultExpanded: false
            },
            {
              header: '#work-experience-row',
              content: '#work-experience-section',
              defaultExpanded: false
            },
            {
              header: '#co-borrower-kyc-row',
              content: '#co-borrower-kyc-section',
              defaultExpanded: false
            },
            {
              header: '#salaried-business-row',
              content: '#salaried-business-section',
              defaultExpanded: false
            }
          ]);
        },

        setupToggles(configs) {
          configs.forEach(config => {
            if (!config.header || !config.content) {
              console.warn(`Invalid config: header (${config.header}) or content (${config.content}) missing`);
              return;
            }

            const header = document.querySelector(config.header);
            const content = document.querySelector(config.content);
            const arrow = config.arrow ? document.querySelector(config.arrow) : null;

            if (!header) console.warn(`Header not found: ${config.header}`);
            if (!content) console.warn(`Content not found: ${config.content}`);
            if (config.arrow && !arrow) console.warn(`Arrow not found: ${config.arrow}`);
            if (!header || !content) return;

            content.style.display = config.defaultExpanded === false ? 'none' : 'block';
            if (arrow && config.rotate) {
              arrow.style.transition = 'transform 0.3s ease';
              arrow.style.transform = config.defaultExpanded === false ? 'rotate(0deg)' : 'rotate(180deg)';
            }

            header.addEventListener('click', () => {
              const isVisible = content.style.display === 'block';
              console.log(`Toggling ${config.content}: isVisible=${isVisible}`);
              content.style.display = isVisible ? 'none' : 'block';
              if (arrow && config.rotate) {
                arrow.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
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
            const fieldType = prompt("Enter field type (e.g., Country, Pincode):")?.trim();
            if (fieldType) {
              this.addNewInputField(fieldType);
              // this.modified = true;
              // FormSubmissionManager.setModifiedSection(this.section);
            }
          });
        }
      },

      addNewInputField(fieldType) {
        fetch('/addadditionalpersonalinfodata', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
          },
          body: JSON.stringify({ fieldType })
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
              fetch('/storesocialoption', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                },
                body: JSON.stringify({ name: userInput })
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
        const options = Array.from(document.querySelectorAll('.social-option .social-name')).map(span => span.textContent);
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
        this.setupQuestionRow();
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

      setupQuestionRow() {
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
        if (!optionsContainer || !dropdownTrigger) return;

        optionsContainer.style.display = 'none';
        dropdownTrigger.addEventListener('click', e => {
          e.stopPropagation();
          toggleVisibility(optionsContainer, optionsContainer.style.display === 'block');
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
          toggleVisibility(optionsSection, !isHidden, document.querySelector('#admin-student-dropdown-icon-id'));
          document.querySelector('.admin-student-form-question-month').classList.toggle('active', isHidden);
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
          // Send to backend using fetch
          fetch('/storecourseduration', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              duration_in_months: userInput
            })
          })
            .then(response => response.json())
            .then(data => {
              if (data.message) {
                alert(data.message)
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
        const options = Array.from(document.querySelectorAll('.course-option .course-name')).map(span => span.textContent);
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
        console.log('Initial optionsContainer:', optionsContainer);
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
          console.log('Attaching event listener to add-course-option-btn');
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
          const optionsSection = document.querySelector('#course-details-options');
          const optionsContainer = optionsSection.querySelector('.checkbox-options-container');
          const addOptionBtn = document.getElementById('add-course-option-btn');
          console.log('optionsContainer:', optionsContainer);
          console.log('addOptionBtn:', addOptionBtn);
          if (!optionsContainer || !addOptionBtn) {
            console.error('Required elements not found:', { optionsContainer, addOptionBtn });
            return;
          }

          optionsSection.style.display = 'block';

          const checkboxId = `course-option-${Date.now()}`;
          const newOption = document.createElement('div');
          newOption.className = 'checkbox-option';
          newOption.innerHTML = `
        <input type="checkbox" id="${checkboxId}" value="${userInput}" disabled>
        <label for="${checkboxId}">${userInput}</label>
      `;

          console.log('Before insertion, optionsContainer children:', Array.from(optionsContainer.children));
          optionsContainer.insertBefore(newOption, addOptionBtn);
          console.log('New checkbox added before Add button:', newOption);
          console.log('After insertion, optionsContainer children:', Array.from(optionsContainer.children));
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
      educationRowCount: 0, // Start at 0, increment when creating rows
      gapOptionCount: 2,

      init() {
        console.log('AcademicDetailsManager.init called');
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
          console.error('setupSectionToggle: Missing elements', { section, content, arrow });
        }
      },

      setupEducationSection() {
        console.log('setupEducationSection called');
        const container = document.getElementById('education-container');
        const headerRow = document.getElementById('education-header-row');
        const dropdownIcon = container?.querySelector('.admin-student-dropdown-icon');
        const section = document.getElementById('education-section');
        if (!container || !headerRow || !dropdownIcon || !section) {
          console.error('setupEducationSection: Missing elements', { container, headerRow, dropdownIcon, section });
          return;
        }

        section.style.display = 'none';
        headerRow.addEventListener('click', e => {
          e.stopPropagation();
          const isVisible = section.style.display === 'block';
          if (typeof toggleVisibility === 'function') {
            toggleVisibility(section, isVisible, dropdownIcon);
          } else {
            console.error('toggleVisibility is not defined');
            section.style.display = isVisible ? 'none' : 'block';
          }
          container.classList.toggle('active', !isVisible);
        });

        const addButton = document.getElementById('add-education-field-btn');
        if (addButton) {
          console.log('Attaching event listener to add-education-field-btn');
          // Remove existing event listeners to prevent duplicates
          addButton.removeEventListener('click', this.handleAddEducationField);
          this.handleAddEducationField = e => {
            e.stopPropagation();
            console.log('Add button clicked');
            this.addEducationField();
            this.modified = true;
            try {
              FormSubmissionManager.setModifiedSection(this.section);
            } catch (error) {
              console.error('Error in FormSubmissionManager.setModifiedSection:', error);
            }
          };
          addButton.addEventListener('click', this.handleAddEducationField);
        } else {
          console.error('add-education-field-btn not found');
        }

        this.setupRemoveButtons();
      },

      setupRemoveButtons() {
        console.log('setupRemoveButtons called');
        document.querySelectorAll('.remove-field-btn').forEach(btn => {
          btn.addEventListener('click', e => {
            e.stopPropagation();
            console.log('Remove button clicked');
            const field = btn.parentNode;
            const row = field.parentNode;
            const addButton = document.getElementById('add-education-field-btn');
            const educationSection = document.getElementById('education-section');

            field.remove();
            console.log('Field removed, remaining children in row:', row.children.length);

            if (row.children.length === 0) {
              // Row is empty; remove it
              row.remove();
              console.log('Removed empty education row');
              // Move Add button to previous row or education-section
              const previousRow = document.querySelector('.education-row:last-of-type');
              if (previousRow && addButton) {
                previousRow.appendChild(addButton);
                console.log('Moved Add button to previous education row');
              } else if (addButton && educationSection) {
                educationSection.appendChild(addButton);
                console.log('Moved Add button to education-section');
              }
            } else if (addButton && !row.contains(addButton)) {
              // Ensure Add button is at the end of the row if it has fields
              row.appendChild(addButton);
              console.log('Moved Add button to end of current education row');
            }

            // Check if the last row is empty and contains the Add button
            const lastRow = document.querySelector('.education-row:last-of-type');
            if (lastRow && lastRow.children.length === 1 && lastRow.contains(addButton)) {
              // Remove empty last row with only Add button
              lastRow.remove();
              console.log('Removed empty last row with Add button');
              const newLastRow = document.querySelector('.education-row:last-of-type');
              if (newLastRow && addButton) {
                newLastRow.appendChild(addButton);
                console.log('Moved Add button to new last education row');
              } else if (addButton && educationSection) {
                educationSection.appendChild(addButton);
                console.log('Moved Add button to education-section');
              }
            }

            this.modified = true;
            try {
              FormSubmissionManager.setModifiedSection(this.section);
            } catch (error) {
              console.error('Error in FormSubmissionManager.setModifiedSection:', error);
            }
          });
        });
      },

      addEducationField() {
        console.log('addEducationField called');
        const fieldName = prompt("Enter new field name (e.g., Graduation Year):", "")?.trim();
        if (fieldName) {
          console.log(`Adding field with name: ${fieldName}`);
          // Find the last education row with fewer than 2 fields
          let educationRow = Array.from(document.querySelectorAll('.education-row')).find(
            row => row.querySelectorAll('.education-field').length < 2
          );
          const addButton = document.getElementById('add-education-field-btn');
          const educationSection = document.getElementById('education-section');

          if (!educationSection) {
            console.error('education-section not found');
            return;
          }

          if (!addButton) {
            console.error('add-education-field-btn not found in addEducationField');
            return;
          }

          // If no suitable row exists, create a new one
          if (!educationRow) {
            this.educationRowCount++;
            console.log('Creating new education row:', `education-row-${this.educationRowCount}`);
            educationRow = document.createElement('div');
            educationRow.className = 'education-row';
            educationRow.id = `education-row-${this.educationRowCount}`;
            educationSection.appendChild(educationRow);
          }

          // Create new field
          const newField = document.createElement('div');
          newField.className = 'education-field';
          newField.innerHTML = `
        <input type="text" placeholder="${fieldName}" name="academic-details[education][${this.educationRowCount}][${fieldName.toLowerCase().replace(/ /g, '_')}]" disabled>
        <button type="button" class="remove-field-btn">✕</button>
      `;

          // Insert the new field before the Add button if it's in the row, or append
          try {
            if (educationRow.contains(addButton)) {
              educationRow.insertBefore(newField, addButton);
            } else {
              educationRow.appendChild(newField);
            }
            console.log('Inserted new field into row');
          } catch (error) {
            console.error('Error inserting new field:', error);
            educationRow.appendChild(newField);
          }

          // Check if the row now has 2 fields; if so, create a new empty row for the Add button
          if (educationRow.querySelectorAll('.education-field').length === 2) {
            this.educationRowCount++;
            console.log('Creating new empty row for Add button:', `education-row-${this.educationRowCount}`);
            const newEmptyRow = document.createElement('div');
            newEmptyRow.className = 'education-row';
            newEmptyRow.id = `education-row-${this.educationRowCount}`;
            educationSection.appendChild(newEmptyRow);
            newEmptyRow.appendChild(addButton);
            console.log('Moved Add button to new empty row');
          } else if (!educationRow.contains(addButton)) {
            // Ensure Add button is in the current row if it has fewer than 2 fields
            educationRow.appendChild(addButton);
            console.log('Moved Add button to current education row');
          }

          // Add event listener for the remove button
          newField.querySelector('.remove-field-btn').addEventListener('click', e => {
            e.stopPropagation();
            console.log('Remove button clicked for field:', fieldName);
            newField.remove();
            console.log('Field removed, remaining children in row:', educationRow.children.length);

            if (educationRow.children.length === 0) {
              // Row is empty; remove it
              educationRow.remove();
              console.log('Removed empty education row');
              // Move Add button to previous row or education-section
              const previousRow = document.querySelector('.education-row:last-of-type');
              if (previousRow && addButton) {
                previousRow.appendChild(addButton);
                console.log('Moved Add button to previous education row');
              } else if (addButton && educationSection) {
                educationSection.appendChild(addButton);
                console.log('Moved Add button to education-section');
              }
            } else if (addButton && !educationRow.contains(addButton)) {
              // Ensure Add button is at the end of the row if it has fields
              educationRow.appendChild(addButton);
              console.log('Moved Add button to end of current education row');
            }

            // Check if the last row is empty and contains the Add button
            const lastRow = document.querySelector('.education-row:last-of-type');
            if (lastRow && lastRow.children.length === 1 && lastRow.contains(addButton)) {
              // Remove empty last row with only Add button
              lastRow.remove();
              console.log('Removed empty last row with Add button');
              const newLastRow = document.querySelector('.education-row:last-of-type');
              if (newLastRow && addButton) {
                newLastRow.appendChild(addButton);
                console.log('Moved Add button to new last education row');
              } else if (addButton && educationSection) {
                educationSection.appendChild(addButton);
                console.log('Moved Add button to education-section');
              }
            }

            this.modified = true;
            try {
              FormSubmissionManager.setModifiedSection(this.section);
            } catch (error) {
              console.error('Error in FormSubmissionManager.setModifiedSection:', error);
            }
          });
        } else {
          console.log('No field name provided or prompt cancelled');
        }
      },

      getDynamicFields() {
        console.log('getDynamicFields called');
        const inputs = document.querySelectorAll('.education-row input[disabled]');
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

      setupAcademicGapSection() {
        console.log('setupAcademicGapSection called');
        const container = document.getElementById('academic-gap-container');
        const row = container?.querySelector('#academic-gap-row');
        const dropdownIcon = container?.querySelector('.admin-student-dropdown-icon');
        const optionsSection = container?.querySelector('#academic-gap-options');
        if (!container || !row || !dropdownIcon || !optionsSection) {
          console.error('setupAcademicGapSection: Missing elements', { container, row, dropdownIcon, optionsSection });
          return;
        }

        optionsSection.style.display = 'none';
        row.addEventListener('click', e => {
          e.stopPropagation();
          const isVisible = optionsSection.style.display === 'block';
          if (typeof toggleVisibility === 'function') {
            toggleVisibility(optionsSection, isVisible, dropdownIcon);
          } else {
            console.error('toggleVisibility is not defined');
            optionsSection.style.display = isVisible ? 'none' : 'block';
          }
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
      this.setupDropdowns([
        {
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
      dropdowns.forEach(({ containerId, rowId, optionsId }) => {
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
            const optionsContainer = document.querySelector('#co-borrower-options .checkbox-options-container');
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
            fieldContainer.querySelector('.delete-liability-field').addEventListener('click', e => {
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

    // Document Field Manager
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
          id: 'add-document-btn',
          type: 'document',
          containerId: 'document-fields-container'
        },
        {
          id: 'add-academic-btn',
          type: 'academic',
          containerId: 'academic-fields-container'
        },
        {
          id: 'add-secured-btn',
          type: 'secured',
          containerId: 'secured-fields-container'
        },
        {
          id: 'add-work-experience-btn',
          type: 'workExperience',
          containerId: 'work-experience-row-2'
        },
        {
          id: 'add-co-borrower-btn',
          type: 'coBorrower',
          containerId: 'co-borrower-fields-container'
        },
        {
          id: 'add-salaried-business-btn',
          type: 'salariedBusiness',
          containerId: 'salaried-business-fields-container'
        }
        ];

        buttons.forEach(({
          id,
          type,
          containerId
        }) => {
          const button = document.getElementById(id);
          if (button) {
            button.addEventListener('click', e => {
              e.stopPropagation();
              const fieldType = prompt(`Enter ${type} document type:`)?.trim();
              if (fieldType) {
                this.addNewDocumentField(fieldType, type, containerId);
                this.modified = true;
                FormSubmissionManager.setModifiedSection(this.section);
              }
            });
          }
        });
      },

      addNewDocumentField(fieldType, type, containerId) {


        fetch('/kycdynamicpost', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ name: fieldType })
        })
          .then(response => {
            if (response.ok) return response.json();
            else throw new Error("Document type may already exist.");
          })
          .then(data => {
            console.log("Added Document Type:", data);
            kycInitialization();
          })
          .catch(error => {
            alert(error.message);
          });
      },


      getDynamicFields() {
        const fields = [];
        const containers = {
          document: document.getElementById('document-fields-container'),
          academic: document.getElementById('academic-fields-container'),
          secured: document.getElementById('secured-fields-container'),
          workExperience: document.getElementById('work-experience-row-2'),
          coBorrower: document.getElementById('co-borrower-fields-container'),
          salariedBusiness: document.getElementById('salaried-business-fields-container')
        };
        for (const [type, container] of Object.entries(containers)) {
          if (container) {
            const fieldNames = Array.from(container.querySelectorAll('.document-name')).map(name => name.textContent);
            fieldNames.forEach(name => fields.push({
              name: name,
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
            fields: CoBorrowerManager.getDynamicFields().filter(f => f.name !== 'Relation' && f.name !== 'Liability'),
            manager: CoBorrowerManager
          },
          {
            title: 'Is there any existing co-borrower monthly liability?',
            fields: CoBorrowerManager.getDynamicFields().filter(f => f.name === 'Liability'),
            manager: CoBorrowerManager
          }
          ]
        },
        {
          sectionName: 'Document Upload',
          questions: [{
            title: 'Student KYC Document',
            fields: DocumentFieldManager.getDynamicFields().filter(f => ['document', 'coBorrower'].includes(f.name.split('-')[0])),
            manager: DocumentFieldManager
          },
          {
            title: 'Academic Mark Sheets',
            fields: DocumentFieldManager.getDynamicFields().filter(f => ['academic', 'secured'].includes(f.name.split('-')[0])),
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
        fetch('/student-application-form', {
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
              alert(`Error saving changes for "${this.modifiedSection}": ${data.message || 'Unknown error'}`);
            }
          })
          .catch(error => {
            console.error(`Error saving "${this.modifiedSection}":`, error);
            alert(`An error occurred while saving changes for "${this.modifiedSection}".`);
          });
      }
    };





    function fetchAndAppendSocialNames() {
      fetch('/getInfoForAdminSocial')
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
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
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
      fetch('/getplantocountries')
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
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
                fetch('/storeplantostudycountry', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                  },
                  body: JSON.stringify({ country_name: userInput })
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
      fetch('/showstudentcourse')
        .then(res => res.json())
        .then(data => {
          const container = document.getElementById('optionsContainer');

          const othersOption = container.querySelector('.option-item input[value="Others"]')?.closest('.option-item');
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
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
                fetch('/storedegree', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                  },
                  body: JSON.stringify({ degree_type: userInput })
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
      fetch('/showstudentcourseduration')
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
              if (confirm(`Are you sure you want to delete "${item.duration_in_months} Months"?`)) {
                fetch(`/deletecourseduration/${item.id}`, {
                  method: 'DELETE',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
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
        fetch('/storecourseduration', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
          },
          body: JSON.stringify({ duration_in_months: userInput })
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


    function kycInitialization() {
      const container = document.getElementById("document-row-1");
      container.innerHTML = ""; // Clear existing content

       const staticDocs = [
        { key: "pan-card", name: "PAN Card" },
        { key: "aadhar-card", name: "Aadhar Card" },
        { key: "passport", name: "Passport" }
      ];

      // Render static docs (no remove icon)
      staticDocs.forEach(doc => {
        container.appendChild(createDocumentBox(doc, false));
      });

      // --- Dynamic Documents from API ---
      fetch("/getdocumenttypesadminform")
        .then(res => res.json())
        .then(data => {
          const staticKeys = staticDocs.map(d => d.key);
          data.documentTypes.forEach(doc => {
            container.appendChild(createDocumentBox(doc, true));
          });

          deleteInitialization();
        })
        .catch(err => console.error("Error fetching dynamic documents:", err));

      // --- Document Box Template ---
      function createDocumentBox(doc, isDynamic) {
        const key = doc.key;
        const displayName = doc.name;

        const uploadIconHTML = isDynamic
          ? `<p class="kyc-delete-dynamic-content" data-id="${doc.id}" data-target="${key}" style="cursor: pointer; color: grey; font-size: 14px; margin: 0;">x</p>`
          : "";


        const div = document.createElement("div");
        div.className = "document-box";
        div.id = `document-box-${key}`;
        div.innerHTML = `
      <div class="document-name" id="${key}-document-name" style="display: none">${displayName}</div>
      <div class="upload-field">
        <span id="${key}-name" data-original="${displayName}" title="${displayName}">${displayName}</span>
        <div class="file-actions">
          <label for="${key}" style="display: flex; align-items: center; justify-content: flex-start; margin-right: 10px;" class="upload-icon" id="${key}-upload-icon">
            ${uploadIconHTML}
          </label>
          <input type="file" id="${key}" name="documents[student_kyc][${key}]"
            accept=".jpg, .png, .pdf"
            onchange="handleFileUpload(event, '${key}-name', '${key}-upload-icon', '${key}-remove-icon}')" />
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
      }

      function deleteInitialization() {
        const deleteButtons = document.querySelectorAll(".kyc-delete-dynamic-content");

        deleteButtons.forEach(button => {
          button.addEventListener("click", () => {
            const key = button.getAttribute("data-target");
            const id = button.getAttribute("data-id");
            const box = document.getElementById(`document-box-${key}`);
            if (box) box.remove();

            fetch(`/deletekycdocument/${id}`, {
              method: "DELETE",
              headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
              }
            })
              .then(res => {
                if (!res.ok) throw new Error("Delete failed");
                alert(`Deleted: ${key}`);
                kycInitialization();

              })
              .catch(err => console.error(err));
          });
        });
      }


    }

    function fetchAdditionalPersonalFields() {
      fetch('/additionalpersonalinfodata')
        .then(response => response.json())
        .then(data => {
          if (data && data.additionalFields) {
            const container = document.querySelector('#input-row-3');

            const allDynamicGroups = container.parentNode.querySelectorAll('.input-group.dynamic');
            allDynamicGroups.forEach(el => el.remove());

            data.additionalFields.forEach(field => {
              const inputGroup = document.createElement('div');
              inputGroup.className = 'input-group dynamic';
              inputGroup.style.display = "flex";
              inputGroup.style.justifyContent = "space-between";

              inputGroup.dataset.fieldId = field.id;

              const p = document.createElement('p');
              p.textContent = field.label;
              p.style.display = 'inline-block';
              p.style.marginRight = '10px';

              const deleteBtn = document.createElement('button');
              deleteBtn.textContent = 'x';
              deleteBtn.style.marginLeft = '5px';
              deleteBtn.style.cursor = 'pointer';
              deleteBtn.style.background = 'transparent';
              deleteBtn.style.border = 'none';
              deleteBtn.style.color = 'gray';
              deleteBtn.title = 'Remove';

              deleteBtn.addEventListener('click', () => {
                const fieldId = inputGroup.dataset.fieldId; // Now this will work
                console.log("Deleting field with ID:", fieldId);

                if (confirm('Are you sure you want to delete this field?')) {
                  fetch(`/additionalfields/${fieldId}`, {
                    method: 'DELETE',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                  })
                    .then(res => res.json())
                    .then(response => {
                      if (response.success) {
                        inputGroup.remove(); // Remove from DOM
                      } else {
                        alert('Failed to delete field.');
                      }
                    })
                    .catch(err => {
                      console.error('Delete failed:', err);
                      alert('An error occurred while deleting.');
                    });
                }
              });

              inputGroup.appendChild(p);
              inputGroup.appendChild(deleteBtn);

              // Insert before the #add-input-field element
              container.parentNode.insertBefore(inputGroup, document.querySelector('#add-input-field'));
            });
          }
        })
        .catch(error => {
          console.error('Error fetching additional fields:', error);
        });
    }


  </script>
</body>

</html>