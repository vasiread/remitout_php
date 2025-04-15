<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Course Details</title>

  
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
                            <div class="admin-student-question-title-course">1. Where are you planning to study? Select all that applies</div>
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

                            <div class="option-grid course-degree" id="optionsContainer">
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


        <!-- Additional questions can be added here -->
    </div>

    <div class="admin-student-form-section-co-borrower-info">
      <div class="admin-student-section-header-co-borrower">
        <div class="admin-student-section-title-co-borrower">
          Co-borrower Info
        </div>
        <span class="admin-student-question-count-co-borrower"
          >3 Questions</span
        >
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

      <div
        class="options-section"
        id="co-borrower-options"
        style="display: none"
      >
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
          <div class="monthly-liability-option">
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
                  >Please enter a valid EMI amount (numeric values only).</span
                >
              </div>
              <div class="add-option" id="add-liability-btn">
                <span class="add-option-text">Add</span>
                <span class="add-option-icon">+</span>
              </div>
            </div>
          </div>

          <!-- Container for additional liability fields - vertically aligned under the EMI content -->
          <div
            id="additional-liability-fields"
            class="additional-liability-fields"
          >
            <!-- Additional fields will be added here dynamically -->
          </div>
        </div>
      </div>
    </div>
                      <!-- Document Upload Section -->
                    <div class="admin-student-form-section-document-upload">
                        <div class="admin-student-section-header-document-upload">
                            <div class="admin-student-section-title-document-upload">Document Upload</div>
                            <span class="admin-student-question-count-document-upload">4 Questions</span>
                            <div class="admin-student-arrow-icon-document-upload">
                                <img src="assets/images/admin-drop.png" alt="Arrow Icon"
                                    class="admin-student-arrow-down-document-upload" />
                            </div>
                        </div>
                    </div>


    

      

                   



                    </div>
                </div>
            </div>
        </div> <!-- End of admin-student-form-container -->
    </div> <!-- End of nbfc-studentdashboardprofile-profile-section-container -->
</div> 
   

<script>

  document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    SectionToggler.init();
    InputFieldManager.init();
    FormValidator.init();
    CityAutocomplete.init();
    SocialOptionsManager.init();
    CourseLocationManager.init();
    CourseOptionsManager.init();
    CourseDurationManager.init();
    CourseDetailsManager.init();
});

/**
 * Handles section toggling functionality
 */
const SectionToggler = {
    init: function() {
        this.setupMainSectionToggle();
        this.setupPersonInfoToggle();
        this.setupAboutUsToggle();
    },

    setupMainSectionToggle: function() {
        const sectionHeader = document.querySelector('.admin-student-section-header');
        const sectionContent = document.querySelector('.admin-student-section-content');
        const arrowIcon = document.querySelector('.admin-student-arrow-icon img');

        // By default section is expanded (content visible, arrow up)
        sectionContent.style.display = 'block';
        arrowIcon.classList.add('admin-student-arrow-up');
        arrowIcon.classList.remove('admin-student-arrow-down');

        sectionHeader.addEventListener('click', function() {
            const isContentVisible = sectionContent.style.display === 'block';

            // Toggle content visibility
            sectionContent.style.display = isContentVisible ? 'none' : 'block';

            // Toggle arrow direction
            if (isContentVisible) {
                // Content is being hidden, arrow points down
                arrowIcon.classList.add('admin-student-arrow-down');
                arrowIcon.classList.remove('admin-student-arrow-up');
            } else {
                // Content is being shown, arrow points up
                arrowIcon.classList.add('admin-student-arrow-up');
                arrowIcon.classList.remove('admin-student-arrow-down');
            }
        });
    },

    setupPersonInfoToggle: function() {
        this.setupSectionToggle('admin-student-person-info', 'person-info-section');
    },

    setupAboutUsToggle: function() {
        this.setupSectionToggle('admin-student-about-us', 'about-us-section');
    },

    setupSectionToggle: function(questionRowId, sectionId) {
        const questionRow = document.getElementById(questionRowId);
        const section = document.getElementById(sectionId);

        if (questionRow && section) {
            questionRow.addEventListener('click', function() {
                if (section.style.display === "none" || section.style.display === "") {
                    section.style.display = "block";
                } else {
                    section.style.display = "none";
                }
            });
        }
    }
};

/**
 * Manages input fields (add, remove, reorganize)
 */
const InputFieldManager = {
    init: function() {
        this.setupRemoveOption();
        this.setupAddField();
    },

    setupRemoveOption: function() {
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-option')) {
                e.target.closest('.input-group').remove();
                InputFieldManager.reorganizeInputs();
            }
        });
    },

    setupAddField: function() {
        const addInputField = document.getElementById('add-input-field');
        if (addInputField) {
            addInputField.addEventListener('click', function() {
                InputFieldManager.showInputPrompt();
            });
        }
    },

    showInputPrompt: function() {
        const fieldType = prompt("Enter field type (e.g., Country, Pincode):");
        if (fieldType && fieldType.trim() !== "") {
            this.addNewInputField(fieldType);
        }
    },

    addNewInputField: function(fieldType) {
        // Icon mapping based on field type (case insensitive)
        const iconMap = {
            'name': './assets/images/person-icon.png',
            'full name': './assets/images/person-icon.png',
            'first name': './assets/images/person-icon.png',
            'last name': './assets/images/person-icon.png',
            'phone': './assets/images/call-icon.png',
            'phone number': './assets/images/call-icon.png',
            'mobile': './assets/images/call-icon.png',
            'email': './assets/images/mail.png',
            'email id': './assets/images/mail.png',
            'city': './assets/images/pin_drop.png',
            'address': './assets/images/pin_drop.png',
            'location': './assets/images/pin_drop.png',
            'country': './assets/images/pin_drop.png',
            'state': './assets/images/pin_drop.png',
            'pincode': './assets/images/pin_drop.png',
            'zip code': './assets/images/pin_drop.png',
            'postal code': './assets/images/pin_drop.png',
            'referral': './assets/images/school.png',
            'referral code': './assets/images/school.png',
            'code': './assets/images/school.png',
        };

        // Check for icon match (case insensitive)
        const fieldTypeLower = fieldType.toLowerCase();
        let iconSrc = './assets/images/pin_drop.png'; // default icon

        // Find matching icon
        for (const [key, value] of Object.entries(iconMap)) {
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

        // Find the current parent of the add button
        const addButton = document.getElementById('add-input-field');
        const addButtonParent = addButton.parentNode;

        // Add the new input field before the add button
        addButtonParent.insertBefore(newInput, addButton);

        // Reorganize inputs to maintain exactly 3 per row
        this.reorganizeInputs();
    },

    reorganizeInputs: function() {
        // Get all input groups and the add field
        const allInputs = document.querySelectorAll('.input-group');
        const addField = document.getElementById('add-input-field');

        // Get or create rows as needed
        let row1 = document.getElementById('input-row-1');
        let row2 = document.getElementById('input-row-2');

        if (!row1 || !row2) return;

        // Clear all rows
        row1.innerHTML = '';
        row2.innerHTML = '';

        // Remove any existing row3
        const existingRow3 = document.getElementById('input-row-3');
        if (existingRow3) {
            existingRow3.remove();
        }

        // Create row3 if needed
        let row3 = null;
        if (allInputs.length > 6) {
            row3 = document.createElement('div');
            row3.className = 'input-row';
            row3.id = 'input-row-3';
            row2.parentNode.insertBefore(row3, row2.nextSibling);
        }

        // Distribute inputs, exactly 3 per row
        for (let i = 0; i < allInputs.length; i++) {
            if (i < 3) {
                row1.appendChild(allInputs[i]);
            } else if (i < 6) {
                row2.appendChild(allInputs[i]);
            } else if (row3) {
                row3.appendChild(allInputs[i]);
            }
        }

        // Determine where to place the add button
        const lastRow = row3 || (allInputs.length > 3 ? row2 : row1);
        const inputsInLastRow = lastRow.querySelectorAll('.input-group').length;

        // Only add the add button if there's room (less than 3 inputs)
        if (inputsInLastRow < 3) {
            lastRow.appendChild(addField);
        } else {
            // Create a new row for the add button
            const newRow = document.createElement('div');
            newRow.className = 'input-row';
            newRow.id = 'input-row-' + (row3 ? '4' : (row2.children.length > 0 ? '3' : '2'));
            newRow.appendChild(addField);
            lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
        }
    }
};

/**
 * Handles form validation
 */
const FormValidator = {
    init: function() {
        this.setupFieldValidation();
    },

    setupFieldValidation: function() {
        const inputs = document.querySelectorAll('input[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                FormValidator.validateField(this);
            });
        });
    },

    validateField: function(field) {
        // Find the error element associated with this field
        const errorId = field.id + "-error";
        const errorElement = document.getElementById(errorId);

        if (!errorElement) return; // Skip if no error element exists

        const inputGroup = field.closest('.input-group');

        // Reset previous error styling
        inputGroup.style.borderColor = '';

        // Check for errors
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
            // Clear error message
            errorElement.textContent = '';
            errorElement.style.display = 'none';
        }
    },

    isValidEmail: function(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },

    isValidPhone: function(phone) {
        const phoneRegex = /^\d{10}$/;
        return phoneRegex.test(phone);
    }
};

/**
 * City autocomplete functionality
 */
const CityAutocomplete = {
    cities: ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'],
    
    init: function() {
        const cityInput = document.getElementById('city-input');
        const suggestionsContainer = document.getElementById('suggestions');
        
        if (!cityInput || !suggestionsContainer) return;
        
        this.setupCityAutocomplete(cityInput, suggestionsContainer);
    },
    
    setupCityAutocomplete: function(cityInput, suggestionsContainer) {
        cityInput.addEventListener('input', function() {
            const inputValue = this.value.toLowerCase();

            // Clear previous suggestions
            suggestionsContainer.innerHTML = '';

            if (inputValue.length > 0) {
                // Filter cities that match input
                const matchedCities = CityAutocomplete.cities.filter(city =>
                    city.toLowerCase().startsWith(inputValue)
                );

                if (matchedCities.length > 0) {
                    suggestionsContainer.style.display = 'block';

                    // Create suggestion elements
                    matchedCities.forEach(city => {
                        const div = document.createElement('div');
                        div.textContent = city;
                        div.style.padding = '8px 10px';
                        div.style.cursor = 'pointer';

                        div.addEventListener('click', function() {
                            cityInput.value = city;
                            suggestionsContainer.style.display = 'none';
                            FormValidator.validateField(cityInput);
                        });

                        div.addEventListener('mouseover', function() {
                            this.style.backgroundColor = '#f0f0f0';
                        });

                        div.addEventListener('mouseout', function() {
                            this.style.backgroundColor = 'transparent';
                        });

                        suggestionsContainer.appendChild(div);
                    });
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            } else {
                suggestionsContainer.style.display = 'none';
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target !== cityInput && e.target !== suggestionsContainer) {
                suggestionsContainer.style.display = 'none';
            }
        });
    }
};

/**
 * Social options manager
 */
const SocialOptionsManager = {
    init: function() {
        this.setupSocialButtons();
    },
    
    setupSocialButtons: function() {
        // Setup existing remove buttons
        document.querySelectorAll('.social-remove').forEach(function(removeButton) {
            removeButton.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
        
        // Setup add button
        const addSocialButton = document.querySelector('.add-social');
        if (addSocialButton) {
            addSocialButton.addEventListener('click', function() {
                // Prompt user for input
                const userInput = prompt("Enter dropdown option", "");

                // Only proceed if the user entered something
                if (userInput && userInput.trim() !== "") {
                    // Create new option
                    const newOption = document.createElement('div');
                    newOption.className = 'social-option';

                    // Create the name span with the user's input
                    const nameSpan = document.createElement('span');
                    nameSpan.className = 'social-name';
                    nameSpan.textContent = userInput.trim();

                    // Create the remove button
                    const removeSpan = document.createElement('span');
                    removeSpan.className = 'social-remove';
                    removeSpan.textContent = '×';

                    // Add event listener to the remove button
                    removeSpan.addEventListener('click', function() {
                        newOption.remove();
                    });

                    // Append the spans to the new option
                    newOption.appendChild(nameSpan);
                    newOption.appendChild(removeSpan);

                    // Get the parent container
                    const optionsContainer = document.querySelector('.second-question-options');

                    // Append the new option to the container
                    if (optionsContainer) {
                        optionsContainer.appendChild(newOption);
                    }
                }
            });
        }
    }
};

/**
 * Course location manager
 */
const CourseLocationManager = {
    init: function() {
        this.setupLocationControls();
    },
    
    setupLocationControls: function() {
        const checkboxContainer = document.getElementById('selected-study-location');
        const addCheckboxContainer = document.querySelector('.add-checkbox-container');
        
        if (!checkboxContainer || !addCheckboxContainer) {
            console.error('Course location containers not found');
            return;
        }
        
        addCheckboxContainer.addEventListener('click', function(event) {
            event.preventDefault();
            CourseLocationManager.addNewCheckbox(checkboxContainer, addCheckboxContainer);
        });
        
        // Setup toggle for course options section
        const questionRow = document.querySelector('.admin-student-question-row-course');
        const optionsSection = document.querySelector('.admin-student-options-section-course');

        if (questionRow && optionsSection) {
            // Hide the options section by default
            optionsSection.style.display = 'none';
            
            questionRow.addEventListener('click', function() {
                // Toggle the visibility of the options section
                optionsSection.style.display = optionsSection.style.display === 'none' ? 'block' : 'none';
            });
        }
    },
    
    addNewCheckbox: function(checkboxContainer, addCheckboxContainer) {
        // Prompt user for input
        const newCountry = prompt("Enter country name", "");
        
        // Only proceed if the user entered something
        if (newCountry && newCountry.trim() !== "") {
            // Check if country already exists
            const existingCountries = Array.from(checkboxContainer.querySelectorAll('input[type="checkbox"]'))
                .map(checkbox => checkbox.value.toLowerCase());
            
            if (existingCountries.includes(newCountry.toLowerCase())) {
                alert('This country is already in the list');
                return;
            }
            
            // Create new checkbox element
            const newLabel = document.createElement('label');
            const newCheckbox = document.createElement('input');
            
            // Configure checkbox
            newCheckbox.type = 'checkbox';
            newCheckbox.name = 'study-location';
            newCheckbox.value = newCountry;
            newCheckbox.checked = true;
            
            // Create label with checkbox and text
            newLabel.appendChild(newCheckbox);
            newLabel.appendChild(document.createTextNode(' ' + newCountry));
            
            // Insert new checkbox before the add container
            checkboxContainer.insertBefore(newLabel, addCheckboxContainer);
        }
    }
};

/**
 * Course options manager
 */
const CourseOptionsManager = {
    init: function() {
        this.setupDegreeOptions();
    },
    
    setupDegreeOptions: function() {
        const optionsContainer = document.getElementById('option-section-degree-container');
        const dropdownTrigger = document.getElementById('admin-student-course-second');
        
        if (!optionsContainer || !dropdownTrigger) {
            console.error('Degree options elements not found');
            return;
        }
        
        // Hide options container by default
        optionsContainer.style.display = 'none';
        
        // Toggle visibility on click
        dropdownTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            optionsContainer.style.display = optionsContainer.style.display === 'none' ? 'block' : 'none';
        });
        
        // Handle add new option
        const addSection = document.getElementById('addSection');
        const optionsGrid = document.getElementById('optionsContainer');
        
        if (addSection && optionsGrid) {
            addSection.onclick = function(e) {
                e.stopPropagation();
                const newOptionName = prompt('Enter new option:');
                if (newOptionName && newOptionName.trim() !== '') {
                    // Remove the add section
                    optionsGrid.removeChild(addSection);
                    
                    // Create the new option item
                    const newOptionItem = document.createElement('div');
                    newOptionItem.className = 'option-item';
                    newOptionItem.innerHTML = `
                        <input type="checkbox" class="option-checkbox">
                        <div class="option-name">${newOptionName.trim()}</div>
                    `;
                    
                    // Add the new option to the grid
                    optionsGrid.appendChild(newOptionItem);
                    
                    // Add back the add section
                    optionsGrid.appendChild(addSection);
                }
            };
        }
    }
};

/**
 * Course duration manager
 */
const CourseDurationManager = {
    init: function() {
        this.setupCourseDuration();
    },
    
    setupCourseDuration: function() {
        const rowElement = document.getElementById('course-row-month-id');
        const dropdownElement = document.getElementById('course-dropdown-month-id');
        const optionsSection = document.getElementById('course-duration-section-month');
        
        if (!rowElement || !dropdownElement || !optionsSection) {
            console.error('Course duration elements not found');
            return;
        }
        
        // Hide options by default
        optionsSection.style.display = 'none';
        
        // Setup click handlers
        rowElement.addEventListener('click', function() {
            CourseDurationManager.toggleOptionsDisplay(optionsSection);
        });
        
        dropdownElement.addEventListener('click', function(event) {
            event.stopPropagation();
            CourseDurationManager.toggleOptionsDisplay(optionsSection);
        });
        
        // Setup existing remove buttons
        document.querySelectorAll('.course-remove').forEach(function(removeButton) {
            removeButton.addEventListener('click', function(event) {
                event.stopPropagation();
                this.parentElement.remove();
            });
        });
        
        // Setup add button
        const addButton = document.querySelector('.add-course');
        if (addButton) {
            addButton.addEventListener('click', function(event) {
                event.stopPropagation();
                CourseDurationManager.addNewDurationOption();
            });
        }
    },
    
    toggleOptionsDisplay: function(optionsSection) {
        const isCurrentlyHidden = optionsSection.style.display === 'none' || !optionsSection.style.display;
        const dropdownIcon = document.querySelector('.admin-student-dropdown-icon');

        optionsSection.style.display = isCurrentlyHidden ? 'block' : 'none';

        if (dropdownIcon) {
            dropdownIcon.classList.toggle('rotated', isCurrentlyHidden);
        }

        document.querySelector('.admin-student-form-question-month').classList.toggle('active', isCurrentlyHidden);
    },
    
    addNewDurationOption: function() {
        const userInput = prompt("Enter course duration option", "");

        if (userInput && userInput.trim() !== "") {
            const newOption = document.createElement('div');
            newOption.className = 'course-option';

            const nameSpan = document.createElement('span');
            nameSpan.className = 'course-name';
            nameSpan.textContent = userInput.trim();

            const removeSpan = document.createElement('span');
            removeSpan.className = 'course-remove';
            removeSpan.textContent = '×';

            removeSpan.addEventListener('click', function(event) {
                event.stopPropagation();
                newOption.remove();
            });

            newOption.appendChild(nameSpan);
            newOption.appendChild(removeSpan);

            const optionsContainer = document.querySelector('.course-options');
            if (optionsContainer) {
                optionsContainer.appendChild(newOption);
            }
        }
    }
};

/**
 * Course details manager
 */
const CourseDetailsManager = {
    init: function() {
        this.setupCourseDetails();
    },
    
    setupCourseDetails: function() {
        const courseDetailsContainer = document.getElementById('course-details-container');
        if (!courseDetailsContainer) {
            console.error('Course details container not found');
            return;
        }
        
        const courseDetailsRow = courseDetailsContainer.querySelector('#course-details-row');
        const dropdownIcon = courseDetailsContainer.querySelector('.admin-student-dropdown-icon');
        const optionsSection = courseDetailsContainer.querySelector('#course-details-options');
        
        if (!courseDetailsRow || !dropdownIcon || !optionsSection) {
            console.error('Course details elements not found');
            return;
        }
        
        // Hide options by default
        optionsSection.style.display = 'none';
        
        // Toggle on row click
        courseDetailsRow.addEventListener('click', function() {
            const isVisible = optionsSection.style.display !== 'none';

            // Toggle visibility
            optionsSection.style.display = isVisible ? 'none' : 'block';

            // Toggle active class on container
            courseDetailsContainer.classList.toggle('active', !isVisible);

            // Rotate the dropdown icon
            dropdownIcon.classList.toggle('rotated', !isVisible);
        });
        
        // Add option button
        const addOptionBtn = courseDetailsContainer.querySelector('#add-option-btn');
        if (addOptionBtn) {
            addOptionBtn.addEventListener('click', function(event) {
                event.stopPropagation();
                CourseDetailsManager.addNewCourseOption(courseDetailsContainer);
            });
        }
        
        // Prevent clicks on checkboxes from toggling the dropdown
        const checkboxContainer = courseDetailsContainer.querySelector('.checkbox-options-container');
        if (checkboxContainer) {
            checkboxContainer.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        }
    },
    
    addNewCourseOption: function(courseDetailsContainer) {
        const userInput = prompt("Enter new option", "");

        if (userInput && userInput.trim() !== "") {
            const optionsContainer = courseDetailsContainer.querySelector('.checkbox-options-container');
            if (!optionsContainer) return;

            const newOption = document.createElement('div');
            newOption.className = 'checkbox-option';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.id = 'option-' + Date.now();
            checkbox.name = 'course-options';

            const label = document.createElement('label');
            label.htmlFor = checkbox.id;
            label.textContent = userInput.trim();

            newOption.appendChild(checkbox);
            newOption.appendChild(label);
            optionsContainer.appendChild(newOption);
        }
    }
};

//academic details
  
       const academicDetailsSection = document.getElementById(
        "academic-details-section"
      );
      const academicDetailsContent = document.getElementById(
        "academic-details-content"
      );
      const arrowIcon = document.querySelector(
        ".admin-student-arrow-icon-academic"
      );

      academicDetailsSection.addEventListener("click", function () {
        academicDetailsContent.classList.toggle("expanded");
        arrowIcon.classList.toggle("rotated");
      });

      const educationContainer = document.getElementById("education-container");
      const educationHeaderRow = document.getElementById(
        "education-header-row"
      );
      const educationDropdownIcon = educationContainer.querySelector(
        ".admin-student-dropdown-icon"
      );
      const educationSection = document.getElementById("education-section");

      educationHeaderRow.addEventListener("click", function (event) {
        event.stopPropagation();

        const isVisible = educationSection.style.display === "block";
        educationSection.style.display = isVisible ? "none" : "block";
        educationContainer.classList.toggle("active", !isVisible);

        educationDropdownIcon.classList.toggle("rotated", !isVisible);
      });

      // Initialize field counter
      let fieldCount = 2;
      let rowCount = 1;

      // Function to create remove button functionality
      function setupRemoveButtons() {
        const removeButtons = document.querySelectorAll(".remove-field-btn");
        removeButtons.forEach((button) => {
          button.addEventListener("click", function (event) {
            event.stopPropagation();
            const fieldElement = this.parentNode;
            const rowElement = fieldElement.parentNode;

            // Remove the field
            fieldElement.remove();

            // If row is empty, remove the row
            if (rowElement.children.length === 0) {
              rowElement.remove();
            }

            // Decrement field count
            fieldCount--;
          });
        });
      }

      // Setup initial remove buttons
      setupRemoveButtons();

      const addEducationFieldBtn = document.getElementById(
        "add-education-field-btn"
      );

      const educationFields = document.querySelectorAll(".education-field");
      educationFields.forEach((field) => {
        field.addEventListener("click", function (event) {
          event.stopPropagation();
        });
      });

      addEducationFieldBtn.addEventListener("click", function (event) {
        event.stopPropagation();
        const fieldName = prompt(
          "Enter new field name (e.g., Graduation Year):",
          ""
        );

        if (fieldName && fieldName.trim() !== "") {
          // Create new field with input and remove button
          const newField = document.createElement("div");
          newField.className = "education-field";

          const newInput = document.createElement("input");
          newInput.type = "text";
          newInput.placeholder = fieldName.trim();
          newInput.name = fieldName.toLowerCase().replace(/\s+/g, "-");

          const removeBtn = document.createElement("button");
          removeBtn.type = "button";
          removeBtn.className = "remove-field-btn";
          removeBtn.textContent = "✕";
          removeBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            newField.remove();
            fieldCount--;

            // If row becomes empty, remove it
            const parentRow = this.parentNode.parentNode;
            if (parentRow.children.length === 0) {
              parentRow.remove();
            }
          });

          newField.appendChild(newInput);
          newField.appendChild(removeBtn);

          // Ensure maximum 2 fields per row
          let currentRow;

          // Check if we need a new row
          if (fieldCount % 2 === 0) {
            // Create new row
            rowCount++;
            currentRow = document.createElement("div");
            currentRow.className = "education-row";
            currentRow.id = "education-row-" + rowCount;
            educationSection.insertBefore(currentRow, addEducationFieldBtn);
          } else {
            // Use last row
            currentRow = document.getElementById("education-row-" + rowCount);

            // If somehow the row doesn't exist, create it
            if (!currentRow) {
              currentRow = document.createElement("div");
              currentRow.className = "education-row";
              currentRow.id = "education-row-" + rowCount;
              educationSection.insertBefore(currentRow, addEducationFieldBtn);
            }
          }

          // Add field to row
          currentRow.appendChild(newField);
          fieldCount++;
        }
      });

      const academicGapContainer = document.getElementById(
        "academic-gap-container"
      );
      const academicGapRow =
        academicGapContainer.querySelector("#academic-gap-row");
      const dropdownIcon = academicGapContainer.querySelector(
        ".admin-student-dropdown-icon"
      );
      const optionsSection = academicGapContainer.querySelector(
        "#academic-gap-options"
      );

      academicGapRow.addEventListener("click", function (event) {
        event.stopPropagation();

        const isVisible = optionsSection.style.display === "block";
        optionsSection.style.display = isVisible ? "none" : "block";
        academicGapContainer.classList.toggle("active", !isVisible);
        dropdownIcon.classList.toggle("rotated", !isVisible);
      });

      const academicOptions =
        academicGapContainer.querySelector(".academic-options");
      academicOptions.addEventListener("click", function (event) {
        event.stopPropagation();
      });

      const addBtn = academicGapContainer.querySelector(
        "#add-academic-option-btn"
      );
      addBtn.addEventListener("click", function (event) {
        event.stopPropagation();
        const userInput = prompt("Enter new option", "");

        if (userInput && userInput.trim() !== "") {
          const optionsContainer =
            academicGapContainer.querySelector(".academic-options");

          const newOption = document.createElement("div");
          newOption.className = "academic-option";

          const radio = document.createElement("input");
          radio.type = "radio";
          radio.id = "academic-option-" + Date.now();
          radio.name = "academics-gap";
          radio.value = userInput.toLowerCase().replace(/\s+/g, "-");

          const label = document.createElement("label");
          label.htmlFor = radio.id;
          label.textContent = userInput.trim();

          newOption.appendChild(radio);
          newOption.appendChild(label);
          optionsContainer.appendChild(newOption);
        }
      });

      const academicYesRadio = document.getElementById("academic-yes");
      const academicNoRadio = document.getElementById("academic-no");

      academicYesRadio.addEventListener("change", function () {
        let reasonSection =
          academicGapContainer.querySelector(".academic-reason");

        if (!reasonSection) {
          reasonSection = document.createElement("div");
          reasonSection.className = "academic-reason";

          const reasonLabel = document.createElement("label");
          reasonLabel.textContent = "Please state the reason for the gap:";

          const reasonTextarea = document.createElement("textarea");
          reasonTextarea.placeholder = "Enter your reason here...";

          reasonSection.appendChild(reasonLabel);
          reasonSection.appendChild(reasonTextarea);

          // Insert after the academic-options-container
          const optionsContainer = academicGapContainer.querySelector(
            ".academic-options-container"
          );
          optionsContainer.parentNode.insertBefore(
            reasonSection,
            optionsContainer.nextSibling
          );
        }

        setTimeout(() => {
          reasonSection.classList.add("visible");
        }, 10);
      });

      academicNoRadio.addEventListener("change", function () {
        const reasonSection =
          academicGapContainer.querySelector(".academic-reason");
        if (reasonSection) {
          reasonSection.classList.remove("visible");
        }
      });

     //co borrower section
      function setupDropdown(containerId, rowId, optionsId) {
        const container = document.getElementById(containerId);
        const row = document.getElementById(rowId);
        const options = document.getElementById(optionsId);
        const dropdownIcon = row.querySelector(".admin-student-dropdown-icon");

        row.addEventListener("click", function () {
          const isVisible = options.style.display !== "none";

          // Toggle visibility
          options.style.display = isVisible ? "none" : "block";

          // Toggle active class on container
          container.classList.toggle("active", !isVisible);

          // Rotate the dropdown icon
          dropdownIcon.classList.toggle("rotated", !isVisible);
        });
      }

      // Set up dropdowns for all containers
      setupDropdown(
        "co-borrower-container",
        "co-borrower-row",
        "co-borrower-options"
      );
      setupDropdown("income-container", "income-row", "income-options");
      setupDropdown(
        "liability-container",
        "liability-row",
        "liability-options"
      );

      // First container - add option button
      const addOptionBtn = document.getElementById("add-option-btn");
      addOptionBtn.addEventListener("click", function (event) {
        event.stopPropagation();

        const userInput = prompt("Enter new option", "");

        if (userInput && userInput.trim() !== "") {
          const optionsContainer = document.querySelector(
            ".checkbox-options-container"
          );

          // Create checkbox option
          const newOption = document.createElement("div");
          newOption.className = "checkbox-option";

          const checkbox = document.createElement("input");
          checkbox.type = "checkbox";
          checkbox.id =
            "co-borrower-" +
            userInput.trim().toLowerCase().replace(/\s+/g, "-");
          checkbox.name = "co-borrower-options";

          const label = document.createElement("label");
          label.htmlFor = checkbox.id;
          label.textContent = userInput.trim();

          newOption.appendChild(checkbox);
          newOption.appendChild(label);

          // Insert the new option before the add button
          optionsContainer.insertBefore(newOption, addOptionBtn);

          // Make the new checkbox work as radio button
          checkbox.addEventListener("change", function () {
            if (this.checked) {
              document
                .querySelectorAll('input[name="co-borrower-options"]')
                .forEach((cb) => {
                  if (cb !== this) cb.checked = false;
                });
            }
          });
        }
      });

      // Function to create delete button functionality
      function setupDeleteButton(deleteButton) {
        deleteButton.addEventListener("click", function (event) {
          event.stopPropagation();
          // Get the parent container of the button
          const fieldContainer =
            this.closest(".field-container") ||
            this.closest(".liability-input-container");
          // Remove the field container from the DOM
          fieldContainer.remove();
        });
      }

      // Setup delete buttons for existing fields
      document.querySelectorAll(".delete-field").forEach((button) => {
        setupDeleteButton(button);
      });

      // Second container - add income field button
      const addIncomeFieldBtn = document.getElementById("add-income-field-btn");
      addIncomeFieldBtn.addEventListener("click", function (event) {
        event.stopPropagation();

        // Get user input through prompt
        const userInput = prompt("Enter field name", "");

        if (userInput && userInput.trim() !== "") {
          // Get the container for fields
          const fieldsRowContainer = document.querySelector(
            ".fields-row-container"
          );

          // Create a new field container
          const fieldContainer = document.createElement("div");
          fieldContainer.className = "field-container";

          // Create new income input field
          const newIncomeField = document.createElement("input");
          newIncomeField.type = "text";
          newIncomeField.className = "text-input";
          newIncomeField.value = userInput.trim(); // Set the value to what the user entered

          // Create delete button
          const deleteButton = document.createElement("button");
          deleteButton.className = "delete-field";
          deleteButton.textContent = "✕";

          // Append elements to field container
          fieldContainer.appendChild(newIncomeField);
          fieldContainer.appendChild(deleteButton);

          // Insert the new field before the add button
          fieldsRowContainer.insertBefore(fieldContainer, addIncomeFieldBtn);

          // Set up delete button functionality
          setupDeleteButton(deleteButton);

          // Add validation event listener
          newIncomeField.addEventListener("input", validateNumericField);
        }
      });

      // Third container - Radio button functionality and add button
      // Handle Yes/No radio button functionality
      document
        .querySelectorAll('input[name="co-borrower-liability"]')
        .forEach((radio) => {
          radio.addEventListener("change", function () {
            const emiInput = document.getElementById("emi-amount");
            const additionalFields = document.getElementById(
              "additional-liability-fields"
            );
            const addLiabilityBtn =
              document.getElementById("add-liability-btn");

            if (this.id === "yes-liability" && this.checked) {
              // Enable input field and show add button when Yes is selected
              emiInput.disabled = false;
              additionalFields.style.display = "flex";
              addLiabilityBtn.style.display = "flex";
            } else if (this.id === "no-liability" && this.checked) {
              // Disable input field and hide add button when No is selected
              emiInput.disabled = true;
              emiInput.value = "";
              additionalFields.style.display = "none";
              addLiabilityBtn.style.display = "none";

              // Clear all additional liability fields
              while (additionalFields.firstChild) {
                additionalFields.removeChild(additionalFields.firstChild);
              }
            }
          });
        });

      // Third container - add liability field button
      const addLiabilityBtn = document.getElementById("add-liability-btn");
      addLiabilityBtn.addEventListener("click", function (event) {
        event.stopPropagation();

        // Get user input through prompt
        const userInput = prompt("Enter field name for liability", "");

        if (userInput && userInput.trim() !== "") {
          // Get the container for additional liability fields
          const additionalFieldsContainer = document.getElementById(
            "additional-liability-fields"
          );

          const fieldContainer = document.createElement("div");
          fieldContainer.className = "liability-input-container";

       
          const newField = document.createElement("input");
          newField.type = "text";
          newField.className = "liability-input";
          newField.placeholder = userInput.trim();

         
          const deleteButton = document.createElement("button");
          deleteButton.className = "delete-liability-field";
          deleteButton.textContent = "✕";
          deleteButton.setAttribute("aria-label", "Delete field");

    
          deleteButton.addEventListener("click", function (e) {
            e.stopPropagation();
            fieldContainer.remove();
          });

          // Add validation to the new field
          newField.addEventListener("input", function () {
            const value = this.value.replace(/[^0-9]/g, "");
            if (value === "" || isNaN(value)) {
              this.style.borderColor = "red";
            } else {
              this.style.borderColor = "#ccc";
            }
          });

       
          fieldContainer.appendChild(newField);
          fieldContainer.appendChild(deleteButton);
          additionalFieldsContainer.appendChild(fieldContainer);
        }
      });

      function validateNumericField() {
        const value = this.value.replace(/[^0-9]/g, "");
        // Find the closest error message
        const errorMessage =
          this.closest(".field-container")?.querySelector(".error-message") ||
          document.getElementById("emi-error-message");

        if (errorMessage) {
          if (value === "" || isNaN(value)) {
            errorMessage.style.display = "block";
            this.style.borderColor = "red";
          } else {
            errorMessage.style.display = "none";
            this.style.borderColor = "#ccc";
          }
        }
      }


      document.querySelectorAll(".text-input").forEach((input) => {
        input.addEventListener("input", validateNumericField);
      });

  
      const emiAmount = document.getElementById("emi-amount");
      emiAmount.addEventListener("input", validateNumericField);

      // Prevent field clicks from toggling the dropdown
      document.querySelectorAll(".options-section").forEach((section) => {
        section.addEventListener("click", function (event) {
          event.stopPropagation();
        });
      });

      // Make checkboxes in first container work as radio buttons
      document
        .querySelectorAll('input[name="co-borrower-options"]')
        .forEach((checkbox) => {
          checkbox.addEventListener("change", function () {
            if (this.checked) {
              document
                .querySelectorAll('input[name="co-borrower-options"]')
                .forEach((cb) => {
                  if (cb !== this) cb.checked = false;
                });
            }
          });
        });

      // Co-borrower info section toggle
      const coborrowerHeader = document.querySelector(
        ".admin-student-section-header-co-borrower"
      );
      const coborrowerArrow = document.querySelector(
        ".admin-student-arrow-icon-co-borrower"
      );
      const formQuestions = document.querySelectorAll(
        ".admin-student-form-question"
      );

      // Set initial state - containers are hidden by default
      let containersVisible = false;

      coborrowerHeader.addEventListener("click", function () {
        // Toggle visibility of the form questions
        containersVisible = !containersVisible;

        formQuestions.forEach((question) => {
          question.style.display = containersVisible ? "block" : "none";
        });

        // Rotate arrow - proper direction based on state
        coborrowerArrow.style.transform = containersVisible
          ? "rotate(180deg)"
          : "rotate(0deg)";
      });

    </script>

</body>

</html>