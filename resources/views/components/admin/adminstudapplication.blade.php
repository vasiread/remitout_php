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

document.addEventListener('DOMContentLoaded', () => {
  // Initialize all modules
  SectionToggleManager.init();
  InputFieldManager.init();
  FormValidator.init();
  CityAutocomplete.init();
  SocialOptionsManager.init();
  CourseLocationManager.init();
  CourseOptionsManager.init();
  CourseDurationManager.init();
  CourseDetailsManager.init();
  AcademicDetailsManager.init();
  CoBorrowerManager.init();
});

// Utility function for class toggling
const toggleClass = (element, className, condition) => {
  element.classList[condition ? 'add' : 'remove'](className);
};

// Utility function to toggle visibility
const toggleVisibility = (element, isVisible) => {
  element.style.display = isVisible ? 'block' : 'none';
};

/**
 * Manages section toggling for all collapsible sections
 */
const SectionToggleManager = {
  sections: [
    {
      header: '.admin-student-section-header',
      content: '.admin-student-section-content',
      arrow: '.admin-student-arrow-icon img',
      arrowUpClass: 'admin-student-arrow-up',
      arrowDownClass: 'admin-student-arrow-down',
    },
    {
      header: '.admin-student-section-header-course',
      content: '.admin-student-section-content-course',
      arrow: '.admin-student-arrow-icon-course img',
      arrowUpClass: 'admin-student-arrow-up-course',
      arrowDownClass: 'admin-student-arrow-down-course',
    },
    {
      header: '.admin-student-section-header-academic',
      content: '.admin-student-section-content-academic',
      arrow: '.admin-student-arrow-icon-academic img',
      arrowUpClass: 'rotated',
      arrowDownClass: '',
    },
    {
      header: '.admin-student-section-header-co-borrower',
      content: '.admin-student-form-question',
      arrow: '.admin-student-arrow-icon-co-borrower',
      arrowUpClass: '',
      arrowDownClass: '',
      multipleContents: true,
    },
  ],

  init() {
    this.sections.forEach(section => this.setupSectionToggle(section));
  },

  setupSectionToggle({ header, content, arrow, arrowUpClass, arrowDownClass, multipleContents }) {
    const headerEl = document.querySelector(header);
    if (!headerEl) return;

    const contentEls = multipleContents
      ? document.querySelectorAll(content)
      : [document.querySelector(content)];
    const arrowEl = document.querySelector(arrow);

    if (!contentEls.length || !contentEls[0]) return;

    // Set initial state: visible
    contentEls.forEach(el => toggleVisibility(el, true));
    if (arrowEl && arrowUpClass) {
      toggleClass(arrowEl, arrowUpClass, true);
      toggleClass(arrowEl, arrowDownClass, false);
    }
    if (header === '.admin-student-section-header-co-borrower') {
      arrowEl.style.transform = 'rotate(180deg)';
      contentEls.forEach(el => toggleVisibility(el, false));
    }

    headerEl.addEventListener('click', () => {
      const isVisible = contentEls[0].style.display !== 'none';
      contentEls.forEach(el => toggleVisibility(el, !isVisible));

      if (arrowEl && arrowUpClass) {
        toggleClass(arrowEl, arrowUpClass, !isVisible);
        toggleClass(arrowEl, arrowDownClass, isVisible);
      }

      if (header === '.admin-student-section-header-co-borrower') {
        arrowEl.style.transform = !isVisible ? 'rotate(180deg)' : 'rotate(0deg)';
      }
    });
  },
};

/**
 * Manages dynamic input fields
 */
const InputFieldManager = {
  iconMap: {
    name: './assets/images/person-icon.png',
    phone: './assets/images/call-icon.png',
    email: './assets/images/mail.png',
    city: './assets/images/pin_drop.png',
    country: './assets/images/pin_drop.png',
    pincode: './assets/images/pin_drop.png',
    referral: './assets/images/school.png',
  },

  init() {
    const container = document.querySelector('.admin-student-form-section');
    if (!container) return;

    container.addEventListener('click', event => {
      if (event.target.classList.contains('remove-option')) {
        event.target.closest('.input-group').remove();
        this.reorganizeInputs();
      }
      if (event.target.closest('#add-input-field')) {
        this.showInputPrompt();
      }
    });
  },

  showInputPrompt() {
    const fieldType = prompt('Enter field type (e.g., Country, Pincode):')?.trim();
    if (fieldType) this.addNewInputField(fieldType);
  },

  addNewInputField(fieldType) {
    const fieldTypeLower = fieldType.toLowerCase();
    const iconSrc = Object.keys(this.iconMap).reduce((src, key) => {
      return fieldTypeLower.includes(key) ? this.iconMap[key] : src;
    }, './assets/images/pin_drop.png');

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

    const row3 = document.getElementById('input-row-3');
    if (row3) row3.remove();

    let currentRow = row1;
    let inputCount = 0;

    allInputs.forEach(input => {
      if (inputCount >= 3) {
        currentRow = row2;
      }
      if (inputCount >= 6) {
        currentRow = document.createElement('div');
        currentRow.className = 'input-row';
        currentRow.id = 'input-row-3';
        row2.parentNode.appendChild(currentRow);
      }
      currentRow.appendChild(input);
      inputCount++;
    });

    const lastRow = inputCount > 3 ? (inputCount > 6 ? currentRow : row2) : row1;
    if (lastRow.querySelectorAll('.input-group').length < 3) {
      lastRow.appendChild(addField);
    } else {
      const newRow = document.createElement('div');
      newRow.className = 'input-row';
      newRow.id = `input-row-${inputCount > 6 ? 4 : 3}`;
      newRow.appendChild(addField);
      lastRow.parentNode.appendChild(newRow);
    }
  },
};

/**
 * Handles form validation
 */
const FormValidator = {
  init() {
    const inputs = document.querySelectorAll('input[required]');
    inputs.forEach(input => {
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
      errorElement.textContent = 'Please enter a valid 10-digit phone number';
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
  },
};

/**
 * City autocomplete functionality
 */
const CityAutocomplete = {
  cities: ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'],

  init() {
    const cityInput = document.getElementById('city-input');
    const suggestionsContainer = document.getElementById('suggestions');
    if (!cityInput || !suggestionsContainer) return;

    cityInput.addEventListener('input', () => {
      const inputValue = cityInput.value.toLowerCase();
      suggestionsContainer.innerHTML = '';

      if (inputValue.length === 0) {
        suggestionsContainer.style.display = 'none';
        return;
      }

      const matchedCities = this.cities.filter(city => city.toLowerCase().startsWith(inputValue));
      if (matchedCities.length === 0) {
        suggestionsContainer.style.display = 'none';
        return;
      }

      suggestionsContainer.style.display = 'block';
      matchedCities.forEach(city => {
        const div = document.createElement('div');
        div.textContent = city;
        div.style.cssText = 'padding: 8px 10px; cursor: pointer;';
        div.addEventListener('click', () => {
          cityInput.value = city;
          suggestionsContainer.style.display = 'none';
          FormValidator.validateField(cityInput);
        });
        div.addEventListener('mouseover', () => div.style.backgroundColor = '#f0f0f0');
        div.addEventListener('mouseout', () => div.style.backgroundColor = 'transparent');
        suggestionsContainer.appendChild(div);
      });
    });

    document.addEventListener('click', e => {
      if (e.target !== cityInput && e.target !== suggestionsContainer) {
        suggestionsContainer.style.display = 'none';
      }
    });
  },
};

/**
 * Social options manager
 */
const SocialOptionsManager = {
  init() {
    const container = document.querySelector('.second-main-section-container');
    if (!container) return;

    container.addEventListener('click', event => {
      if (event.target.classList.contains('social-remove')) {
        event.target.closest('.social-option').remove();
      }
      if (event.target.closest('.add-social')) {
        const userInput = prompt('Enter dropdown option:')?.trim();
        if (userInput) this.addSocialOption(userInput);
      }
    });

    this.setupSectionToggle('admin-student-about-us', 'about-us-section');
  },

  addSocialOption(userInput) {
    const newOption = document.createElement('div');
    newOption.className = 'social-option';
    newOption.innerHTML = `
      <span class="social-name">${userInput}</span>
      <span class="social-remove">×</span>
    `;
    document.querySelector('.second-question-options').appendChild(newOption);
  },

  setupSectionToggle(rowId, sectionId) {
    const row = document.getElementById(rowId);
    const section = document.getElementById(sectionId);
    if (!row || !section) return;

    row.addEventListener('click', () => {
      toggleVisibility(section, section.style.display === 'none');
    });
  },
};

/**
 * Course location manager
 */
const CourseLocationManager = {
  init() {
    const container = document.getElementById('selected-study-location');
    if (!container) return;

    container.addEventListener('click', event => {
      if (event.target.closest('.add-checkbox-container')) {
        event.preventDefault();
        this.addNewCheckbox(container);
      }
    });

    this.setupSectionToggle('admin-student-course', 'person-info-section-course');
  },

  addNewCheckbox(container) {
    const newCountry = prompt('Enter country name:')?.trim();
    if (!newCountry) return;

    const existingCountries = Array.from(container.querySelectorAll('input[type="checkbox"]'))
      .map(cb => cb.value.toLowerCase());
    if (existingCountries.includes(newCountry.toLowerCase())) {
      alert('This country is already in the list');
      return;
    }

    const newLabel = document.createElement('label');
    newLabel.innerHTML = `<input type="checkbox" name="study-location" value="${newCountry}" checked> ${newCountry}`;
    container.insertBefore(newLabel, container.querySelector('.add-checkbox-container'));
  },

  setupSectionToggle(rowId, sectionId) {
    const row = document.getElementById(rowId);
    const section = document.getElementById(sectionId);
    if (!row || !section) return;

    section.style.display = 'none';
    row.addEventListener('click', () => {
      toggleVisibility(section, section.style.display === 'none');
    });
  },
};

/**
 * Course options manager
 */
const CourseOptionsManager = {
  init() {
    const container = document.getElementById('admin-student-form-question-course-degree');
    if (!container) return;

    container.addEventListener('click', event => {
      if (event.target.closest('#addSection')) {
        event.stopPropagation();
        this.addNewOption();
      }
    });

    this.setupSectionToggle('admin-student-course-second', 'option-section-degree-container');
  },

  addNewOption() {
    const newOptionName = prompt('Enter new option:')?.trim();
    if (!newOptionName) return;

    const optionsGrid = document.getElementById('optionsContainer');
    const addSection = document.getElementById('addSection');

    optionsGrid.removeChild(addSection);
    const newOptionItem = document.createElement('div');
    newOptionItem.className = 'option-item';
    newOptionItem.innerHTML = `
      <input type="checkbox" class="option-checkbox">
      <div class="option-name">${newOptionName}</div>
    `;
    optionsGrid.appendChild(newOptionItem);
    optionsGrid.appendChild(addSection);
  },

  setupSectionToggle(rowId, sectionId) {
    const row = document.getElementById(rowId);
    const section = document.getElementById(sectionId);
    if (!row || !section) return;

    section.style.display = 'none';
    row.addEventListener('click', () => {
      toggleVisibility(section, section.style.display === 'none');
    });
  },
};

/**
 * Course duration manager
 */
const CourseDurationManager = {
  init() {
    const container = document.getElementById('course-duration-section-month');
    if (!container) return;

    container.style.display = 'none';
    container.addEventListener('click', event => {
      if (event.target.classList.contains('course-remove')) {
        event.stopPropagation();
        event.target.closest('.course-option').remove();
      }
      if (event.target.closest('.add-course')) {
        event.stopPropagation();
        this.addNewDurationOption();
      }
    });

    const row = document.getElementById('course-row-month-id');
    const dropdown = document.getElementById('course-dropdown-month-id');
    if (row && dropdown) {
      row.addEventListener('click', () => this.toggleOptionsDisplay(container));
      dropdown.addEventListener('click', event => {
        event.stopPropagation();
        this.toggleOptionsDisplay(container);
      });
    }
  },

  toggleOptionsDisplay(section) {
    const isVisible = section.style.display !== 'none';
    toggleVisibility(section, !isVisible);
    const dropdownIcon = document.querySelector('#admin-student-dropdown-icon-id');
    if (dropdownIcon) toggleClass(dropdownIcon, 'rotated', !isVisible);
    document.querySelector('.admin-student-form-question-month').classList.toggle('active', !isVisible);
  },

  addNewDurationOption() {
    const userInput = prompt('Enter course duration option:')?.trim();
    if (!userInput) return;

    const newOption = document.createElement('div');
    newOption.className = 'course-option';
    newOption.innerHTML = `
      <span class="course-name">${userInput}</span>
      <span class="course-remove">×</span>
    `;
    document.querySelector('.course-options').appendChild(newOption);
  },
};

/**
 * Course details manager
 */
const CourseDetailsManager = {
  init() {
    const container = document.getElementById('course-details-container');
    if (!container) return;

    const optionsSection = container.querySelector('#course-details-options');
    optionsSection.style.display = 'none';

    container.addEventListener('click', event => {
      if (event.target.closest('#course-details-row')) {
        const isVisible = optionsSection.style.display !== 'none';
        toggleVisibility(optionsSection, !isVisible);
        container.classList.toggle('active', !isVisible);
        const dropdownIcon = container.querySelector('.admin-student-dropdown-icon');
        if (dropdownIcon) toggleClass(dropdownIcon, 'rotated', !isVisible);
      }
      if (event.target.closest('#add-option-btn')) {
        event.stopPropagation();
        this.addNewCourseOption(container);
      }
      if (event.target.closest('.checkbox-options-container')) {
        event.stopPropagation();
      }
    });
  },

  addNewCourseOption(container) {
    const userInput = prompt('Enter new option:')?.trim();
    if (!userInput) return;

    const optionsContainer = container.querySelector('.checkbox-options-container');
    const newOption = document.createElement('div');
    newOption.className = 'checkbox-option';
    const checkboxId = `option-${Date.now()}`;
    newOption.innerHTML = `
      <input type="checkbox" id="${checkboxId}" name="course-options">
      <label for="${checkboxId}">${userInput}</label>
    `;
    optionsContainer.appendChild(newOption);
  },
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