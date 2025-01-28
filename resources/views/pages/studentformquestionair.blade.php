<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Remitout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/studentformquestionair.css">
  <link rel="stylesheet" href="assets/css/navbar.css">


</head>

<body>



  <x-navbar></x-navbar>
  <section class="registration-section">
    <div class="container">
      <div class="registration-content">
        <h1 class="registration-title">Let's Get you Registered</h1>
        <p class="registration-subtitle">Let us know you better to find you the best offers and services!</p>
        <div class="breadcrumb flat">
          <a href="#" id="breadcrumb-personal" class="active desktop-text">
            <span class="desktop-text">Personal Information</span>
            <span class="breadcrumb-tab-number">1</span>
          </a>
          <a href="#" id="breadcrumb-course" class="desktop-text">
            <span class="desktop-text">Course Details</span>
            <span class="breadcrumb-tab-number">2</span>
          </a>
          <a href="#" id="breadcrumb-academic" class="desktop-text">
            <span class="desktop-text">Academic Details</span>
            <span class="breadcrumb-tab-number">3</span>
          </a>
          <a href="#" id="breadcrumb-co-borrower" class="desktop-text">
            <span class="desktop-text">Co-borrower Info</span>
            <span class="breadcrumb-tab-number">4</span>
          </a>
          <a href="#" id="breadcrumb-documents" class="desktop-text">
            <span class="desktop-text">Document Upload</span>
            <span class="breadcrumb-tab-number">5</span>
          </a>
        </div>
      </div>
    </div>
  </section>


  <!-- Personal Information Tab -->
  <div class="mobile-heading" id="mobileHeading">Personal Information</div>
  <div class="registration-container" id="step-personal">
    <form>
      @csrf
      <div class="registration-form">
        <!-- Step Header -->
        <div class="step-header">
          <div class="step-number">01</div>
          <h2>Let us know more about you</h2>
        </div>

        <!-- Hidden User ID -->
        <input type="hidden" name="user_id" id="personal-info-userid" value="{{ session('user')->unique_id }}">

        <!-- Input Row 1 -->
        <div class="input-row">
          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/person-icon.png" alt="Person Icon" class="icon" />
              <input type="text" placeholder="Full Name" name="full_name" id="personal-info-name"
                value="{{ session('user')->name }}" required />
              <div class="validation-message" id="personal-info-name-error"></div>
            </div>
          </div>




          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
              <input type="tel" placeholder="Phone Number" name="phone_number" id="personal-info-phone" value=""
                required />
              <div class="validation-message" id="personal-info-phone-error"></div>
            </div>
          </div>

          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
              <input type="text" placeholder="Referral Code" name="referral_code" value="" id="personal-info-referral"
                required />
              <div class="validation-message" id="referralCode-error"></div>
            </div>
          </div>
        </div>

        <!-- Input Row 2 -->
        <div class="input-row">
          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/mail.png" alt="Mail Icon" class="icon" />
              <input type="email" placeholder="Email ID" name="email" id="personal-info-email"
                value="{{ session('user')->email }}" required />
              <div class="validation-message" id="personal-info-email-error"></div>
            </div>
          </div>

          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
              <input type="text" placeholder="City" name="city" id="personal-info-city" required />
              <div id="suggestions" class="suggestions-container"></div>
              <div class="validation-message" id="city-error"></div>
            </div>


          </div>
        </div>
      </div>

      <!-- Section 02 (Hidden Initially) -->
      <div class="section-02-container" style="display: none;">
        <div class="section section-02">
          <!-- Step Header -->
          <div class="step-header">
            <div class="step-number">02</div>
            <h2>How did you find out about us?</h2>
          </div>

          <div class="dropdown-container-about" data-required="true">
            <div class="dropdown-about">
              <div class="dropdown-label-about">Select</div>
              <div class="dropdown-icon-about"></div>
              <div class="dropdown-options-about">
                <div class="dropdown-option-about-us" data-value="youtube">YouTube</div>
                <div class="dropdown-option-about-us" data-value="google">Google</div>
                <div class="dropdown-option-about-us" data-value="friend">Friend</div>
                <div class="dropdown-option-about-us" data-value="other">Other</div>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="next-btn" id="personal-info-submit">Next</button>
        </div>
      </div>
    </form>
  </div>



  <!-- breadcrumb 2 tab -->
  <div class="course-section" id="step-course">


    <!-- Step 1: Study Location -->
    <div class="course-details" id="step-1">
      <div class="step-header">
        <div class="step-number">01</div>
        <h2>Where are you planning to study? Select all that applies</h2>
      </div>

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
          <input type="checkbox" name="study-location" value="Other" id="other-checkbox"> Other
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
          <div class="add-country-box">
            <input type="text" id="country" class="custom-country-input" placeholder="Add Country">
          </div>
        </label>
      </div>

      <!-- Automatically navigate to next step -->

    </div>

    <!-- Step 2: Degree Type -->
    <div class="course-degree" id="step-2" style="display: none;">
      <div class="step-header">
        <div class="step-number">02</div>
        <h2>Select the type of degree you want to pursue:</h2>
      </div>
      <form id="course-info-degreetype">
        <div class="degrees">
          <div class="degree">
            <input type="radio" id="bachelors" name="degree_type" value="bachelors">
            <label for="bachelors">Bachelors (only secured loan)</label>
          </div>
          <div class="degree">
            <input type="radio" id="others" name="degree_type" value="others">
            <label for="others">Others</label>
          </div>
          <div class="degree">
            <input type="radio" id="masters" name="degree_type" value="masters">
            <label for="masters">Masters</label>
          </div>
          <div class="degree other-degree-input-container" style="display: none;">
            <input type="text" id="other-degree" class="other-degree-input" placeholder="Add Degree">
          </div>
        </div>
      </form>

    </div>

    <!-- Step 3: Course Duration -->
    <div class="course-duration-container" id="step-3" style="display: none;">
      <div class="step-header">
        <div class="step-number">03</div>
        <h2>What is the duration of the course?</h2>
      </div>

      <div class="dropdown-container">
        <div class="dropdown" id="selected-course-duration">
          <div class="dropdown-label">No. of Months</div>
          <div class="dropdown-icon">
            <!-- Dropdown arrow SVG or icon -->
          </div>
          <div class="dropdown-options">
            <div class="dropdown-option" data-value="12">12 Months</div>
            <div class="dropdown-option" data-value="24">24 Months</div>
            <div class="dropdown-option" data-value="36">36 Months</div>
            <div class="dropdown-option" data-value="42">42 Months</div>
          </div>
        </div>
      </div>
    </div>


    <!-- Step 4: Course Details (Only Step with Button) -->
    <div class="detail-container-section" id="step-4" style="display: none;">
      <div class="course-details-container">
        <div class="step-header">
          <div class="step-number">04</div>
          <h2>Course Details</h2>
        </div>

        <div class="content-wrapper">
          <div class="left-section">
            <div class="form-group academic-option">
              <label for="living-expenses">
                <input type="radio" id="living-expenses" name="expense-type" value="with-living">
                With living expenses
              </label>
            </div>
            <div class="form-group academic-option">
              <label for="no-living-expenses">
                <input type="radio" id="no-living-expenses" name="expense-type" value="without-living">
                Without living expenses
              </label>
            </div>
          </div>

          <div class="right-section">
            <div class="loan-amount-container">
              <label for="loan-amount" class="loan-label">Enter desired loan amount</label>
              <input type="number" id="loan-amount" class="loan-input" placeholder="₹ Rupees in Lakhs" />
              <span id="loan-error-message" class="error-message" style="display:none; color:red;">Please enter a valid
                loan amount (numeric values only).</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Only this step has the button -->
      <button type="submit" id="course-info-submit" class="next-btn-course">Next</button>
    </div>

  </div>



  <!-- Breadcrumbs, academic steps -->
  <div class="academic-section" id="step-academic">

    <!-- Academic Details Section -->
    <div class="academic-container" id="step-academic-details" style="display: none;">
      <div class="step-header">
        <div class="step-number">01</div>
        <h2>Do you have any gap in your academics?</h2>
      </div>

      <div class="academic-content">
        <!-- Academic Options -->
        <div class="academic-options">
          <div class="academic-option">
            <input type="radio" id="academic-yes" name="academics-gap" value="yes">
            <label for="academic-yes">Yes</label>
          </div>
          <div class="academic-option">
            <input type="radio" id="academic-no" name="academics-gap" value="no">
            <label for="academic-no">No (only secured loan)</label>
          </div>
        </div>

        <!-- Academic Reason -->
        <div class="academic-reason" id="reason-container">
          <label for="reason-textarea">Enter reason</label>
          <textarea id="reason-textarea" placeholder="Enter the reason for the academic gap"></textarea>
        </div>
      </div>
    </div>


    <!---academic-details container---->
    <div class="academic-details" id="step-academic-details">
      <div class="academic-details-container">
        <div class="step-header">
          <div class="step-number">02</div>
          <h2>Academic details</h2>
        </div>

        <div class="education-label">Education</div>

        <div class="input-grid">
          <div class="input-field">
            <input type="text" id="universityschoolid" placeholder="University/School">
          </div>
          <div class="input-field">
            <input type="text" id="educationcourseid" placeholder="Course Name">
          </div>
        </div>
      </div>
    </div>


    <!-- Admit Form Section -->
    <div class="admit-form-container" id="step-admit-form" style="display: none;">
      <div class="admit-container">
        <div class="step-header">
          <div class="step-number">03</div>
        </div>

        <div class="admit-left-section">
          <div class="admit-question">
            <p>Do you have any admit?</p>
            <div class="academic-option-left">
              <label>
                <input type="radio" name="admit-option" value="yes"> Yes
              </label>
              <label>
                <input type="radio" name="admit-option" value="no"> No
              </label>
            </div>
          </div>
          <div class="admit-question">
            <p>Do you have any work experience?</p>
            <div class="academic-option-left">
              <label>
                <input type="radio" name="work-option" value="yes"> Yes
              </label>
              <label>
                <input type="radio" name="work-option" value="no"> No
              </label>
            </div>
          </div>
        </div>

        <div class="admit-right-section">
          <p>1.4 Have you got any admit?</p>
          <div class="admit-exam-field">
            <label for="admit-ielts">IELTS</label>
            <div class="admit-input-container">
              <input type="text" id="admit-ielts" placeholder="Add score">
              <span class="admit-input-right">*minimum score 6.5</span>
            </div>
          </div>

          <div class="admit-exam-field">
            <label for="admit-gre">GRE</label>
            <div class="admit-input-container">
              <input type="text" id="admit-gre" placeholder="Add score">
              <span class="admit-input-right">*minimum score 280</span>
            </div>
          </div>

          <div class="admit-exam-field">
            <label for="admit-toefl">TOEFL</label>
            <div class="admit-input-container">
              <input type="text" id="admit-toefl" placeholder="Add score">
              <span class="admit-input-right">*minimum score 90</span>
            </div>
          </div>

          <div class="admit-exam-field">
            <label for="admit-others-name">Others</label>
            <div class="admit-input-container">
              <input type="text" id="admit-others-name" placeholder="Name of the Examination">
            </div>
          </div>

          <div class="admit-exam-field">
            <label for="admit-others-name"></label>
            <div class="admit-input-container">
              <input type="text" id="admit-others-score" placeholder="Add score">
            </div>
          </div>
        </div>
      </div>

      <button type="submit" id="academics-info-submit" class="next-btn-academic">Next</button>
    </div>

  </div>


  <!----breadcrumb 4 tab---->
  <!---co-borrower section-->

  <div class="co-borrow-section" id="step-co-borrower">
    <div class="borrow-container-section" style="display: none;">
      <div class="step-header">
        <div class="step-number">01</div>
        <h2>How is the co-borrower related to you?</h2>
      </div>
      <div class="borrow-options">
        <div class="borrow-option">
          <input type="radio" name="borrow-relation" id="borrow-parent" value="parent">
          <label class="borrow-label" for="borrow-parent">Parent</label>
        </div>
        <div class="borrow-option">
          <input type="radio" name="borrow-relation" id="borrow-spouse" value="spouse">
          <label class="borrow-label" for="borrow-spouse">Spouse</label>
        </div>

        <div class="borrow-option borrow-blood-relative">
          <input type="radio" name="borrow-relation" id="borrow-blood-relative" value="blood-relative">

          <div class="borrow-option borrow-blood">
            <label class="borrow-label" id="borrow-blood-label" for="borrow-blood-relative">Blood
              relative</label>
            <span class="borrow-option-icon"></span>
            <div class="borrow-dropdown" id="borrow-dropdown">
              <div class="borrow-dropdown-item" data-value="paternal-aunt">Paternal Auntie</div>
              <div class="borrow-dropdown-item" data-value="paternal-uncle">Paternal Uncle</div>
              <div class="borrow-dropdown-item" data-value="maternal-aunt">Maternal Auntie</div>
              <div class="borrow-dropdown-item" data-value="maternal-uncle">Maternal Uncle</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Income Co-borrower Section -->
  <div class="income-co-borrower" style="display: none;">
    <div class="step-header">
      <div class="step-number">02</div>
      <h2>What is the gross monthly income of co-borrower?</h2>
    </div>
    <input type="text" id="income-co-borrower" placeholder=" ₹ Rupees in thousands" />
    <p class="minimum-amount">*minimum amount of 5% after deductions for eligibility</p>
    <span id="income-error-message" class="error-message" style="display:none; color:red;">Please enter a valid numeric
      income value.</span>
  </div>


  <!-- Monthly Liability Section (Last section) -->
  <div class="monthly-container">
    <div class="monthly-liability">
      <div class="monthly-liability-container" style="display: none;">
        <div class="step-header">
          <div class="step-number">03</div>
          <h2>Is there any existing co-borrower monthly liability?</h2>
        </div>

        <div class="monthly-liability-option">
          <div class="monthly-liability-radio-buttons">
            <label>
              <input type="radio" name="co-borrower-liability" id="yes-liability" value="Yes" />
              Yes
            </label>
            <label>
              <input type="radio" name="co-borrower-liability" id="no-liability" value="No" />
              No
            </label>
          </div>
          <div class="emi-content">
            <input type="text" id="emi-amount" class="emi-content-container" placeholder="Enter EMI amount" value="" />
            <span id="emi-error-message" class="error-message" style="display:none; color:red;">Please enter
              a
              valid EMI
              amount (numeric values only).</span>
          </div>
        </div>

        <!-- Button placed inside the last container -->
        <button type="submit" id="coborrower-info-submit" class="next-btn-borrow">Next</button>
      </div>

    </div>
  </div>



  <!----breadcrumb 5 tab---->

  <!---document upload step 1--->



  <section class="kyc-section-document" id="kyc-section-id" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">01</div>
        <h2>Student KYC Document</h2>
      </div>

      <div class="document-container">

        <div class="document-box">
          <div class="document-name" id="pan-card-document-name" style="display: none;">PAN Card</div>
          <div class="upload-field">

            <span id="pan-card-name">PAN Card</span>
            <label for="pan-card" class="upload-icon" id="pan-card-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" style="display:none">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="pan-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'pan-card-name', 'pan-card-upload-icon', 'pan-card-remove-icon')">
            <span id="pan-card-remove-icon" class="remove-icon" style="display: none;"
              onclick="removeFile('pan-card', 'pan-card-name', 'pan-card-upload-icon', 'pan-card-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="pan-card-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container pan-card-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

        <!-- Aadhar Card -->
        <div class="document-box">
          <div class="document-name" id="aadhar-card-document-name" style="display: none;">Aadhar Card</div>
          <div class="upload-field">
            <span id="aadhar-card-name">Aadhar Card</span>
            <label for="aadhar-card" class="upload-icon" id="aadhar-card-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="aadhar-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')">
            <span id="aadhar-card-remove-icon" class="remove-icon" style="display: none;"
              onclick="removeFile('aadhar-card', 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="aadhar-card-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container aadhar-card-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

        <!-- Passport -->
        <div class="document-box">
          <div class="document-name" id="passport-document-name" style="display: none;">Passport</div>
          <div class="upload-field">
            <span id="passport-name">Passport</span>
            <label for="passport" class="upload-icon" id="passport-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="passport" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'passport-name', 'passport-upload-icon', 'passport-remove-icon')">
            <span id="passport-remove-icon" class="remove-icon" style="display: none;"
              onclick="removeFile('passport', 'passport-name', 'passport-upload-icon', 'passport-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="passport-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container passport-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!---document upload step 2--->
  <!---mark sheet---->
  <section class="kyc-section-marksheet" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">02</div>
        <h2>Academic Mark Sheets</h2>
      </div>
      <div class="document-container">

        <!-- 10th Grade Mark Sheet -->
        <div class="document-box">

          <div class="document-name" id="10th-mark-sheet-id" style="display: none;">10th Mark Sheet</div>
          <div class="upload-field">
            <span id="tenth-grade-name">10th Grade Mark Sheet</span>
            <label for="tenth-grade" class="upload-icon" id="tenth-grade-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="tenth-grade" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')">
            <span id="tenth-grade-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('tenth-grade', 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon')">✖</span>
          </div>
          <div class="info">
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
        <div class="document-box">
          <div class="document-name" id="12th-mark-sheet-id" style="display: none;">12th Mark Sheet</div>
          <div class="upload-field">
            <span id="twelfth-grade-name">12th Grade Mark Sheet</span>
            <label for="twelfth-grade" class="upload-icon" id="twelfth-grade-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="twelfth-grade" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')">
            <span id="twelfth-grade-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('twelfth-grade', 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="twelfth-grade-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container twelfth-grade-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

        <!-- Graduation Mark Sheet -->
        <div class="document-box">
          <div class="document-name" id="graduation-mark-sheet-id" style="display: none;">Graduation Mark Sheet</div>
          <div class="upload-field">
            <span id="graduation-grade-name">Graduation Mark Sheet</span>
            <label for="graduation-grade" class="upload-icon" id="graduation-grade-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="graduation-grade" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')">
            <span id="graduation-grade-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('graduation-grade', 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="graduation-grade-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container graduation-grade-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!---document upload step 3--->
  <!----secured Admission-->

  <section class="kyc-section-Admission" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">03</div>
        <h2>Secured Admission</h2>
      </div>
      <div class="document-container">
        <!-- 10th Grade -->
        <div class="document-box">
          <div class="document-name" id="10th-grades-id" style="display: none;">10th Grade</div>
          <div class="upload-field">
            <span id="secured-tenth-name">10th Grade</span>
            <label for="secured-tenth" class="upload-icon" id="secured-tenth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="secured-tenth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')">
            <span id="secured-tenth-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('secured-tenth', 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="secured-tenth-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container secured-tenth-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 10th grade mark sheet in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <!-- 12th Grade -->
        <div class="document-box">
          <div class="document-name" id="12th-grade-id" style="display: none;">12th Grade</div>
          <div class="upload-field">
            <span id="secured-twelfth-name">12th Grade</span>
            <label for="secured-twelfth" class="upload-icon" id="secured-twelfth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="secured-twelfth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')">
            <span id="secured-twelfth-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('secured-twelfth', 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="secured-twelfth-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container secured-twelfth-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 12th grade mark sheet in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <!-- Graduation -->
        <div class="document-box">
          <div class="document-name" id="Graduation-id" style="display: none;">Graduation</div>
          <div class="upload-field">
            <span id="secured-graduation-name">Graduation</span>
            <label for="secured-graduation" class="upload-icon" id="secured-graduation-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="secured-graduation" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')">
            <span id="secured-graduation-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('secured-graduation', 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="secured-graduation-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container secured-graduation-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your graduation mark sheet in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!---document upload step 4--->
  <!--work experience--->

  <section class="work-experience" style="display: none;">
    <div class="work-experience-container">
      <div class="step-header">
        <div class="step-number">04</div>
        <h2>Work Experience</h2>
      </div>
      <div class="work-experience-row">
        <div class="work-experience-box">
          <div class="document-name" id="experience-letter-id" style="display: none;">Experience letter</div>
          <div class="upload-field">
            <span id="work-experience-experience-letter">Experience letter</span>
            <label for="work-experience-tenth" class="upload-icon" id="work-experience-tenth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-tenth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')" />
            <span id="work-experience-tenth-remove-icon" style="display:none;"
              onclick="removeFile('work-experience-tenth', 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="work-experience-tenth-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container work-experience-tenth-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 10th grade mark sheet in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <div class="work-experience-box">
          <div class="document-name" id="3-months-salary-slip-id" style="display: none;">3 months salary slip</div>
          <div class="upload-field">
            <span id="work-experience-monthly-slip">3 months salary slip</span>
            <label for="work-experience-twelfth" class="upload-icon" id="work-experience-twelfth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-twelfth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')" />
            <span id="work-experience-twelfth-remove-icon" style="display:none;"
              onclick="removeFile('work-experience-twelfth', 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="work-experience-twelfth-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container work-experience-twelfth-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 12th grade mark sheet in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <div class="work-experience-box">
          <div class="document-name" id="office-IDs-id" style="display: none;">office ID</div>
          <div class="upload-field">
            <span id="work-experience-office-id">office ID</span>
            <label for="work-experience-graduation" class="upload-icon" id="work-experience-graduation-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-graduation" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')" />
            <span id="work-experience-graduation-remove-icon" style="display:none;"
              onclick="removeFile('work-experience-graduation', 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="work-experience-graduation-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container work-experience-graduation-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your graduation mark sheet in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="work-experience-row">
        <div class="work-experience-box">
          <div class="document-name" id="Joining-letter-id" style="display: none;">Joining letter</div>

          <div class="upload-field">
            <span id="work-experience-joining-letter">Joining letter</span>
            <label for="work-experience-fourth" class="upload-icon" id="work-experience-fourth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-fourth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')" />
            <span id="work-experience-fourth-remove-icon" style="display:none;"
              onclick="removeFile('work-experience-fourth', 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')">✖</span>
          </div>

          <div class="info">
            <span class="help-trigger" data-target="work-experience-fourth-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container work-experience-fourth-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your fourth document in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!---document upload step 5--->
  <section class="kyc-section-co-borrower" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">05</div>
        <h2>Co-borrower KYC Documents</h2>
      </div>
      <div class="document-container">

        <!-- PAN Card -->
        <div class="document-box">
          <div class="document-name" id="pan-card-ids" style="display: none;">PAN Card</div>
          <div class="upload-field">
            <span id="co-pan-card-name">PAN Card</span>
            <label for="co-pan-card" class="upload-icon" id="co-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="co-pan-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')">
            <span id="co-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('co-pan-card', 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="co-pan-card-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container co-pan-card-help" style="display:none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

        <!-- Aadhar Card -->
        <div class="document-box">
          <div class="document-name" id="aadhar-card-id" style="display: none;">Aadhar Card</div>
          <div class="upload-field">
            <span id="co-aadhar-card-name">Aadhar Card</span>
            <label for="co-aadhar-card" class="upload-icon" id="co-aadhar-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="co-aadhar-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')">
            <span id="co-aadhar-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('co-aadhar-card', 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="co-aadhar-card-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container co-aadhar-card-help" style="display:none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

        <!-- Passport (Address Proof) -->
        <div class="document-box">
          <div class="document-name" id="address-proof-id" style="display: none;">Address Proof</div>
          <div class="upload-field">
            <span id="co-addressproof">Address Proof</span>
            <label for="co-passport" class="upload-icon" id="co-passport-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="co-passport" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')">
            <span id="co-passport-remove-icon" class="remove-icon" style="display:none;"
              onclick="removeFile('co-passport', 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="co-passport-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container co-passport-help" style="display:none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="salary-upload" style="display: none;">
    <div class="salary-upload-container">
      <!-- Step Header -->
      <div class="step-header">
        <div class="step-number">06</div>
        <h2>Document Upload</h2>
      </div>

      <!-- Salaried Documents Section -->
      <div class="salary-sub">
        <p>If salaried:</p>
      </div>

      <div class="salary-upload-row">
        <!-- Salary Slip -->
        <div class="salary-upload-box">
          <div class="document-name" id="3 months-salary-slip-id" style="display: none;">3 months salary slip</div>
          <div class="upload-field">
            <span id="salary-upload-salary-slip-name">3 months salary slip</span>
            <label for="salary-upload-salary-slip" class="upload-icon" id="salary-upload-salary-slip-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-salary-slip" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-salary-slip-name', 'salary-upload-salary-slip-upload-icon', 'salary-remove-salary-slip-1')" />
            <span id="salary-remove-salary-slip-1" class="remove-icon" style="display: none;"
              onclick="removeFile('salary-upload-salary-slip', 'salary-upload-salary-slip-name', 'salary-upload-salary-slip-upload-icon', 'salary-remove-salary-slip-1')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="salary-upload-salary-slip-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container salary-upload-salary-slip-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 3 months salary slip in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <!-- Bank Statement -->
        <div class="salary-upload-box">
          <div class="document-name" id="6-months-bank-statement-id" style="display: none;">6 months bank statement
          </div>
          <div class="upload-field">
            <span id="salary-upload-salary-statement-name">6 months bank statement</span>
            <label for="salary-upload-salary-statement" class="upload-icon"
              id="salary-upload-salary-statement-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-salary-statement" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-salary-statement-name', 'salary-upload-salary-statement-upload-icon', 'salary-remove-salary-statement-2')" />
            <span id="salary-remove-salary-statement-2" class="remove-icon" style="display: none;"
              onclick="removeFile('salary-upload-salary-statement', 'salary-upload-salary-statement-name', 'salary-upload-salary-statement-upload-icon', 'salary-remove-salary-statement-2')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="salary-upload-salary-statement-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container salary-upload-salary-statement-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 6 months salary statement in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <!-- Address Proof -->
        <div class="salary-upload-box">
          <div class="document-name" id="address-proof-salary-id" style="display: none;">Address Proof</div>
          <div class="upload-field">
            <span id="salary-upload-address-proof-name">Address Proof</span>
            <label for="salary-upload-address-proof" class="upload-icon" id="salary-upload-address-proof-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-address-proof" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-address-proof-name', 'salary-upload-address-proof-upload-icon', 'salary-remove-address-proof-3')" />
            <span id="salary-remove-address-proof-3" class="remove-icon" style="display: none;"
              onclick="removeFile('salary-upload-address-proof', 'salary-upload-address-proof-name', 'salary-upload-address-proof-upload-icon', 'salary-remove-address-proof-3')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="salary-upload-address-proof-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container salary-upload-address-proof-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your address proof in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Business Documents Section -->
      <div class="salary-sub">
        <p>If in Business:</p>
      </div>

      <div class="salary-upload-row">
        <!-- ITR -->
        <div class="salary-upload-box">
          <div class="document-name" id="2 years of ITR-id" style="display: none;">2 years of ITR</div>
          <div class="upload-field">
            <span id="salary-upload-itr-name">2 years of ITR</span>
            <label for="salary-upload-itr" class="upload-icon" id="salary-upload-itr-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-itr" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-itr-name', 'salary-upload-itr-upload-icon', 'salary-remove-itr-4')" />
            <span id="salary-remove-itr-4" class="remove-icon" style="display: none;"
              onclick="removeFile('salary-upload-itr', 'salary-upload-itr-name', 'salary-upload-itr-upload-icon', 'salary-remove-itr-4')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="salary-upload-itr-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container salary-upload-itr-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 2 years of ITR in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>


        <!-- 6 Months Bank Statement -->
        <div class="salary-upload-box">
          <div class="document-name" id="6-months-bank-statements-id" style="display: none;">6 months bank statement
          </div>
          <div class="upload-field">
            <span id="salary-upload-fourth-document-name">6 months bank statement</span>
            <label for="salary-upload-fourth-document" class="upload-icon"
              id="salary-upload-fourth-document-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-fourth-document" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-fourth-document-name', 'salary-upload-fourth-document-upload-icon', 'salary-remove-fourth-document-5')" />
            <span id="salary-remove-fourth-document-5" class="remove-icon" style="display: none;"
              onclick="removeFile('salary-upload-fourth-document', 'salary-upload-fourth-document-name', 'salary-upload-fourth-document-upload-icon', 'salary-remove-fourth-document-5')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="salary-upload-fourth-document-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container salary-upload-fourth-document-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your 6 months bank statement in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>

        <!-- Office/Shop Photographs -->
        <div class="salary-upload-box">
          <div class="document-name" id="Office/Shop-photographs-id" style="display: none;">Office/Shop photographs
          </div>
          <div class="upload-field">
            <span id="salary-upload-fifth-document-name">Office/Shop photographs</span>
            <label for="salary-upload-fifth-document" class="upload-icon" id="salary-upload-fifth-document-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-fifth-document" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-fifth-document-name', 'salary-upload-fifth-document-upload-icon', 'salary-remove-fifth-document-6')" />
            <span id="salary-remove-fifth-document-6" class="remove-icon" style="display: none;"
              onclick="removeFile('salary-upload-fifth-document', 'salary-upload-fifth-document-name', 'salary-upload-fifth-document-upload-icon', 'salary-remove-fifth-document-6')">✖</span>
          </div>
          <div class="info">
            <span class="help-trigger" data-target="salary-upload-fifth-document-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
          </div>
          <div class="help-container salary-upload-fifth-document-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
              <p>Please upload your office/shop photographs in jpg, png, or pdf format.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Submit Button -->


    </div>
    <button type="submit" class="next-btn-kyc" id="saveandsubmit">Save and Submit</button>

  </section>

  </form>



  <!-------Navigation button------>
  <div class="navigation">
    <button class="nav-button prev">
      <span class="arrow"></span>
    </button>
    <div class="nav-dots">
      <div class="dot active"></div>
      <div class="dot"></div>
    </div>
    <button class="nav-button next">
      <span class="arrow"></span>
    </button>
  </div>

  <div class="support-container">
    <button class="support-btn">Support</button>
    <button class="help-btn">Help</button>
  </div>


  <!-- #region -->

  <script>

    document.addEventListener('DOMContentLoaded', () => {

      window.handleFileUpload = handleFileUpload;
      window.removeFile = removeFile;

      event.preventDefault();
      const prevButton = document.querySelector('.nav-button.prev');
      const nextButton = document.querySelector('.nav-button.next');
      const nextBreadcrumbButton = document.querySelector('.next-btn');
      const nextCourseButton = document.querySelector('.next-btn-course');
      const nextAcademicButton = document.querySelector('.next-btn-academic');
      const nextBorrowButton = document.querySelector('.next-btn-borrow');
      const nextKycButton = document.querySelector('.save-btn-kyc');
      const breadcrumbLinks = document.querySelectorAll('.breadcrumb a');

      window.onload = function () {
        if (window.location.hash === '#kyc-section-id') {
          document.getElementById('kyc-section-id').style.display = 'block';
          alert("KYC")
        }
      };

      const breadcrumbSections = [
        [document.querySelector('.registration-form'), document.querySelector('.section-02-container')],
        [document.querySelector('.course-details'), document.querySelector('.course-degree'), document.querySelector('.course-duration-container'), document.querySelector('.detail-container-section')],
        [document.querySelector('.academic-container'), document.querySelector('.academic-details'), document.querySelector('.admit-form-container')],
        [document.querySelector('.borrow-container-section'), document.querySelector('.income-co-borrower'), document.querySelector('.monthly-liability-container')],
        [document.querySelector('.kyc-section-document'), document.querySelector('.kyc-section-marksheet'), document.querySelector('.kyc-section-Admission'), document.querySelector('.work-experience'), document.querySelector('.kyc-section-co-borrower'), document.querySelector('.salary-upload')]
      ];

      function updateMobileHeading(breadcrumbIndex) {
        const mobileHeading = document.getElementById('mobileHeading');
        const headings = {
          0: 'Personal Information',
          1: 'Course Details',
          2: 'Academic Details',
          3: 'Co-borrower Info',
          4: 'Document Upload'
        };

        if (mobileHeading) {
          mobileHeading.textContent = headings[breadcrumbIndex] || '';
        }
      }



      // Make sure navigation function also updates heading
      function navigate(direction) {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];
        currentContainers[currentContainerIndex].style.display = 'none';

        if (direction === 'prev') {
          if (currentContainerIndex > 0) {
            currentContainerIndex--;
          } else if (currentBreadcrumbIndex > 0) {
            currentBreadcrumbIndex--;
            currentContainerIndex = breadcrumbSections[currentBreadcrumbIndex].length - 1;
          }
          updateMobileHeading(currentBreadcrumbIndex);
        } else if (direction === 'next') {
          if (currentContainerIndex < currentContainers.length - 1) {
            currentContainerIndex++;
          } else if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
            currentBreadcrumbIndex++;
            currentContainerIndex = 0;
          }
          updateMobileHeading(currentBreadcrumbIndex);
        }

        const updatedContainers = breadcrumbSections[currentBreadcrumbIndex];
        updatedContainers[currentContainerIndex].style.display = 'block';

        updateBreadcrumbNavigation();
        updateNavigationButtons();
        updateDots();
      }

      const breadcrumbDots = [
        2,
        4,
        2,
        3,
        6
      ];

      let currentBreadcrumbIndex = 0;
      let currentContainerIndex = 0;

      // Dynamically add dots based on breadcrumb index
      function updateDots() {
        const dotContainer = document.querySelector('.nav-dots');
        dotContainer.innerHTML = '';

        const numberOfDots = breadcrumbDots[currentBreadcrumbIndex];

        for (let i = 0; i < numberOfDots; i++) {
          const dot = document.createElement('div');
          dot.classList.add('dot');
          if (i === currentContainerIndex) {
            dot.classList.add('active');
          }
          dotContainer.appendChild(dot);
        }
      }

      // Function to check if all required fields are filled
      function areFieldsFilled() {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];
        const currentContainer = currentContainers[currentContainerIndex];

        const inputs = currentContainer.querySelectorAll('input[required], select[required], textarea[required]');

        for (const input of inputs) {
          if (!input.value.trim()) {
            return false;
          }
        }
        return true;
      }


      function updateNavigationButtons() {
        const isAtFirstContainer = currentContainerIndex === 0;
        const isAtLastContainer = currentContainerIndex === breadcrumbSections[currentBreadcrumbIndex].length - 1;

        prevButton.disabled = isAtFirstContainer;
        nextButton.disabled = isAtLastContainer || !areFieldsFilled();

        nextBreadcrumbButton.disabled = currentContainerIndex !== breadcrumbSections[currentBreadcrumbIndex].length - 1;
      }

      function updateBreadcrumbNavigation() {
        breadcrumbLinks.forEach((link, index) => {
          link.classList.remove('active');
          link.style.color = '';

          if (index === currentBreadcrumbIndex) {
            link.classList.add('active');
            link.style.color = '#E98635';
          } else {
            link.style.color = '';
          }
        });
      }

      function navigate(direction) {
        const currentContainers = breadcrumbSections[currentBreadcrumbIndex];

        currentContainers[currentContainerIndex].style.display = 'none';

        if (direction === 'next') {
          if (currentContainerIndex < currentContainers.length - 1) {
            currentContainerIndex++;
          } else if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
            currentBreadcrumbIndex++;
            currentContainerIndex = 0;
          }
        } else if (direction === 'prev') {
          if (currentContainerIndex > 0) {
            currentContainerIndex--;
          } else if (currentBreadcrumbIndex > 0) {
            currentBreadcrumbIndex--;
            currentContainerIndex = breadcrumbSections[currentBreadcrumbIndex].length - 1;
          }
        }
        const updatedContainers = breadcrumbSections[currentBreadcrumbIndex];
        updatedContainers[currentContainerIndex].style.display = 'block';

        updateBreadcrumbNavigation();
        updateNavigationButtons();
        updateDots();
        updateMobileHeading(currentBreadcrumbIndex);
      }

      // Add event listeners to buttons
      nextButton.addEventListener('click', () => {
        if (areFieldsFilled()) {
          navigate('next');
        }
      });

      function updateUserIds() {
        const personalInfoId = document.getElementById("personal-info-userid").value;

        console.log(personalInfoId)



        fetch('/updatedetailsinfo', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify({ personalInfoId })
        })
          .then(response => response.json())
          .then(data => {
            console.log(data.message);
          })
          .catch(error => {
            console.error('Error:', error);
          });

      }
      updateUserIds();


      function updateCoborrowerInfo(event) {
        event.preventDefault();

        // Modified getSelectedAnswer function to include callback for async handling
        function getSelectedAnswer(callback) {
          const selectedOption = document.querySelector('input[name="borrow-relation"]:checked');

          if (selectedOption && selectedOption.value !== "blood-relative") {
            return callback(selectedOption.value);
          } else if (selectedOption && selectedOption.value === "blood-relative") {
            const dropdownRelative = document.querySelectorAll(".borrow-dropdown .borrow-dropdown-item");

            dropdownRelative.forEach(item => {
              item.addEventListener('click', function () {
                const relativeValue = item.dataset.value;
                console.log('Selected blood relative:', relativeValue);

                // Proceed with the final selection
                callback(relativeValue);
              });
            });

            // Return early since selection is pending
            return;
          } else {
            return callback("none selected here");
          }
        }

        // Call getSelectedAnswer with the callback to handle data submission
        getSelectedAnswer(function (answer) {
          console.log("Final selected answer:", answer);

          const personalInfoId = document.getElementById("personal-info-userid").value;
          var incomeValue = document.getElementById("income-co-borrower").value;
          var selectedLiability = document.querySelector('input[name="co-borrower-liability"]:checked').value;
          var emiAmount = document.querySelector(".emi-content .emi-content-container").value;

          const coborrowerData = {
            personalInfoId, answer, incomeValue, selectedLiability, emiAmount
          };
          console.log(coborrowerData);

          // Proceed with the fetch after answer selection
          fetch('/coborrowerData', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(coborrowerData)
          })
            .then(response => response.json())
            .then(data => {
              console.log(data);

              if (data.success) {
                alert(data.message);
              } else {
                alert(data.message);
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('An error occurred while updating your information.');
            });
        });
      }

      document.getElementById('personal-info-submit').addEventListener('click', (event) => {
        updateUserPersonalInfo(event);

      })

      document.getElementById('course-info-submit').addEventListener('click', (event) => {
        updateUserCourseInfo(event);
      })
      document.getElementById('academics-info-submit').addEventListener('click', (event) => {
        updateAcademicsCourseInfo(event);
      })
      document.getElementById('coborrower-info-submit').addEventListener('click', (event) => {
        updateCoborrowerInfo(event);
      })

      document.getElementById('saveandsubmit').addEventListener('click', (event) => {
        window.location.href = "/student-dashboard"
      })



      function updateUserPersonalInfo(event) {
        event.preventDefault();

        // Getting values from form fields
        const personalInfoId = document.getElementById("personal-info-userid").value;
        const personalInfoName = document.getElementById("personal-info-name").value;
        const personalInfoPhone = document.getElementById("personal-info-phone").value;
        const personalInfoEmail = document.getElementById("personal-info-email").value;
        const personalInfoCity = document.getElementById("personal-info-city").value;
        const personalInfoReferral = document.getElementById("personal-info-referral").value;

        // Use the captured value from the custom dropdown
        const personalInfoFindOut = selectedValue;

        if (personalInfoName !== '' && personalInfoPhone !== '' && personalInfoEmail !== '' && personalInfoCity !== '' && personalInfoReferral !== '' && personalInfoFindOut) {
          const personalUpdateData = {
            personalInfoId,
            personalInfoName,
            personalInfoPhone,
            personalInfoEmail,
            personalInfoCity,
            personalInfoReferral,
            personalInfoFindOut // Use the selected dropdown value here
          };

          console.log(personalUpdateData);

          // Sending the data with fetch
          fetch('/update-personalinfo', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(personalUpdateData)
          })
            .then(response => response.json())
            .then(data => {
              console.log(data);

              if (data.success) {
                alert(data.message);
              } else {
                alert(data.message);
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('An error occurred while updating your information.');
            });
        } else {
          alert("Required fields Not Filled. Do you want to continue with that?");
        }
      }


      function getSelectedExpenseType() {
        const selectedExpense = document.querySelector('input[name="expense-type"]:checked');
        console.log('Selected Expense Type:', selectedExpense ? selectedExpense.value : 'None');
        return selectedExpense ? selectedExpense.value : null;
      }

      function getLoanAmount() {
        const loanAmount = document.getElementById('loan-amount').value;
        console.log('Loan Amount:', loanAmount.trim());
        return loanAmount.trim();
      }


      // Function to get the selected study locations (from the checkboxes)
      function getSelectedStudyLocations() {
        const checkboxes = document.querySelectorAll('#selected-study-location input[type="checkbox"]:checked');
        const selectedLocations = [];
        checkboxes.forEach(checkbox => {
          selectedLocations.push(checkbox.value);
        });
        console.log('Selected Study Locations:', selectedLocations);
        return selectedLocations;
      }


      function updateUserCourseInfo(event) {
        event.preventDefault();
        const personalInfoId = document.getElementById("personal-info-userid").value;

        const selectedDegreeType = document.querySelector('#course-info-degreetype input[name="degree_type"]:checked').value;
        const expenseType = getSelectedExpenseType();
        const loanAmount = getLoanAmount();
        const courseDuration = getSelectedCourseDuration(); // Get the selected course duration
        const studyLocations = getSelectedStudyLocations();

        const courseInfoData = {
          personalInfoId,
          selectedDegreeType,
          expenseType,
          loanAmount,
          courseDuration,
          studyLocations
        }

        console.log(courseInfoData);

        fetch('/update-courseinfo', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify(courseInfoData)
        })
          .then(response => response.json())
          .then(data => {
            console.log(data);

            if (data.success) {
              alert(data.message);
            } else {
              alert(data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating your information.');
          });
      }


      function updateAcademicsCourseInfo(event) {
        const personalInfoId = document.getElementById("personal-info-userid").value;

        const selectedAcademicGap = document.querySelector('input[name="academics-gap"]:checked').value;
        const reasonForGap = document.querySelector('.academic-reason textarea').value;
        const selectedAdmitOption = document.querySelector('input[name="admit-option"]:checked').value;
        const selectedWorkOption = document.querySelector('input[name="work-option"]:checked').value;
        const ieltsScore = document.getElementById('admit-ielts').value;

        const greScore = document.getElementById('admit-gre').value;
        const toeflScore = document.getElementById('admit-toefl').value;
        const otherExamName = document.getElementById('admit-others-name').value;
        const otherExamScore = document.getElementById('admit-others-score').value;
        const universityName = document.getElementById("universityschoolid").value;

        const courseName = document.getElementById("educationcourseid").value;


        const academicDetails = {
          personalInfoId, selectedAcademicGap, reasonForGap, selectedAdmitOption, selectedWorkOption, ieltsScore, greScore, toeflScore,
          "others": { otherExamName, otherExamScore }, universityName, courseName
        }

        console.log(academicDetails)
        fetch('/update-academicsinfo', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(academicDetails) // Sending the data as JSON in the request body
        })
          .then(response => response.json())
          .then(data => {
            console.log(data);

            if (data.success) {
              alert(data.message);  // Show success message
            } else {
              alert(data.message);  // Show error message
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating your information.');
          });
      }








      prevButton.addEventListener('click', () => navigate('prev'));
      nextBreadcrumbButton.addEventListener('click', () => {
        if (currentContainerIndex === breadcrumbSections[currentBreadcrumbIndex].length - 1) {
          if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
            breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
            currentBreadcrumbIndex++;
            currentContainerIndex = 0;

            breadcrumbSections[currentBreadcrumbIndex].forEach((container, index) => {
              container.style.display = (index === 0) ? 'block' : 'none';
            });

            updateBreadcrumbNavigation();
            updateNavigationButtons();
            updateDots();
            updateMobileHeading(currentBreadcrumbIndex);
          }
        }
      });

      if (nextCourseButton) {
        nextCourseButton.addEventListener('click', () => {
          if (currentBreadcrumbIndex === 1) {
            breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
            currentBreadcrumbIndex = 2;
            currentContainerIndex = 0;

            breadcrumbSections[currentBreadcrumbIndex].forEach((container, index) => {
              container.style.display = (index === 0) ? 'block' : 'none';
            });

            updateBreadcrumbNavigation();
            updateNavigationButtons();
            updateDots();
            updateMobileHeading(currentBreadcrumbIndex);
          }
        });
      }

      if (nextAcademicButton) {
        nextAcademicButton.addEventListener('click', () => {
          if (currentBreadcrumbIndex === 2) {
            breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
            currentBreadcrumbIndex = 3;
            currentContainerIndex = 0;

            breadcrumbSections[currentBreadcrumbIndex].forEach((container, index) => {
              container.style.display = (index === 0) ? 'block' : 'none';
            });

            updateBreadcrumbNavigation();
            updateNavigationButtons();
            updateDots();
            updateMobileHeading(currentBreadcrumbIndex);
          }
        });
      }

      if (nextBorrowButton) {
        nextBorrowButton.addEventListener('click', () => {
          if (currentBreadcrumbIndex === 3) {
            breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
            currentBreadcrumbIndex = 4;
            currentContainerIndex = 0;

            breadcrumbSections[currentBreadcrumbIndex].forEach((container, index) => {
              container.style.display = (index === 0) ? 'block' : 'none';
            });

            updateBreadcrumbNavigation();
            updateNavigationButtons();
            updateDots();
            updateMobileHeading(currentBreadcrumbIndex);
          }
        });
      }

      document.getElementById('personal-info-name').addEventListener('input', function () {
        const personalInfoName = document.getElementById('personal-info-name');
        const errorMessage = document.getElementById('personal-info-name-error');
        const namePattern = /^[A-Za-z\s]+$/;

        if (!personalInfoName.value.match(namePattern)) {
          errorMessage.textContent = "Please enter full name.";
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });

      document.getElementById('personal-info-phone').addEventListener('input', function () {
        const phone = document.getElementById('personal-info-phone');
        const errorMessage = document.getElementById('personal-info-phone-error');
        const phonePattern = /^[0-9]{10}$/;

        if (!phone.value.match(phonePattern)) {
          errorMessage.textContent = "Please enter a valid 10-digit phone number.";
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });

      document.getElementById('personal-info-email').addEventListener('input', function () {
        const email = document.getElementById('personal-info-email');
        const errorMessage = document.getElementById('personal-info-email-error');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (!email.value.match(emailPattern)) {
          errorMessage.textContent = "Please enter a valid email address.";
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });

      document.getElementById('personal-info-city').addEventListener('input', function () {
        const city = document.getElementById('personal-info-city');
        const errorMessage = document.getElementById('city-error');

        if (city.value.trim() === "") {
          errorMessage.textContent = "Please enter the city.";
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });

      // Referral Code Validation
      document.getElementById('personal-info-referral').addEventListener('input', function () {
        const referralCode = document.getElementById('personal-info-referral');
        const errorMessage = document.getElementById('referralCode-error');

        if (!referralCode.value) {
          errorMessage.textContent = "Please enter the referral code";
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }

      });



      // Initialize the containers
      breadcrumbSections.forEach((containers, breadcrumbIndex) => {
        containers.forEach((container, containerIndex) => {
          container.style.display =
            breadcrumbIndex === 0 && containerIndex === 0 ? 'block' : 'none';
        });
      });

      // Add click event listeners to breadcrumb links
      breadcrumbLinks.forEach((link, index) => {
        link.addEventListener('click', (e) => {
          e.preventDefault();

          if (index <= currentBreadcrumbIndex) {
            breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
            currentBreadcrumbIndex = index;
            currentContainerIndex = 0;

            breadcrumbSections[currentBreadcrumbIndex].forEach((container, i) => {
              container.style.display = (i === 0) ? 'block' : 'none';
            });

            updateBreadcrumbNavigation();
            updateNavigationButtons();
            updateDots();
          }
        });
      });


      document.addEventListener('input', () => {
        updateNavigationButtons();
      });

      // Initial setup
      updateBreadcrumbNavigation();
      updateNavigationButtons();
      updateDots();
      updateMobileHeading(currentBreadcrumbIndex);

      const helpTriggers = document.querySelectorAll('.help-trigger');

      function toggleHelpContainer(event, targetClass) {
        const helpContainer = document.querySelector(`.${targetClass}`);
        if (helpContainer) {
          if (helpContainer.style.display === 'none' || !helpContainer.style.display) {
            helpContainer.style.display = 'block';
          } else {
            helpContainer.style.display = 'none';
          }
        }
      }


      helpTriggers.forEach(trigger => {
        trigger.addEventListener('click', (event) => {
          event.stopPropagation();
          const targetClass = trigger.getAttribute('data-target');
          toggleHelpContainer(event, targetClass);
        });
      });


      document.addEventListener('click', (event) => {
        const helpContainers = document.querySelectorAll('.help-container');
        helpContainers.forEach(container => {
          if (container.style.display === 'block' && !container.contains(event.target)) {
            container.style.display = 'none';
          }
        });
      });


      function truncateFileName(fileName, maxLength = 25) {
        if (fileName.length <= maxLength) {
          return fileName;
        } else {
          const extension = fileName.slice(fileName.lastIndexOf('.'));
          const truncatedName = fileName.slice(0, maxLength - extension.length - 3) + '...';
          return truncatedName + extension;

        }
      }

      async function handleFileUpload(event, fileNameId, uploadIconId, removeIconId) {
        console.log(event, fileNameId, uploadIconId, removeIconId)
        const fileInput = event.target;
        const fileNameElement = document.getElementById(fileNameId);
        const uploadIcon = document.getElementById(uploadIconId);
        const removeIcon = document.getElementById(removeIconId);
        const file = fileInput.files[0];

        // Help container and format info elements
        const helpTrigger = fileNameElement.parentElement.nextElementSibling.querySelector('.help-trigger');
        const formatInfo = fileNameElement.parentElement.nextElementSibling.querySelector('span:last-child');

        // Check if a file was selected
        if (!file) {
          fileNameElement.textContent = 'No file chosen';
          uploadIcon.style.display = 'inline';
          removeIcon.style.display = 'none';
          if (helpTrigger) helpTrigger.style.display = 'inline';
          if (formatInfo) formatInfo.style.display = 'inline';
          return;
        }

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
          alert("Error: File size exceeds 5MB limit.");
          fileInput.value = ''; // Clear the file input
          fileNameElement.textContent = 'No file chosen';
          uploadIcon.style.display = 'inline';
          removeIcon.style.display = 'none';
          if (helpTrigger) helpTrigger.style.display = 'inline';
          if (formatInfo) formatInfo.style.display = 'inline';
          return;
        }

        // Validate file type
        const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
        const fileExtension = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
          alert("Error: Only .jpg, .jpeg, .png, and .pdf files are allowed.");
          fileInput.value = ''; // Clear the file input
          fileNameElement.textContent = 'No file chosen';
          uploadIcon.style.display = 'inline';
          removeIcon.style.display = 'none';
          if (helpTrigger) helpTrigger.style.display = 'inline';
          if (formatInfo) formatInfo.style.display = 'inline';
          return;
        }

        // Update UI on successful file selection
        const fileSizeInKB = (file.size / 1024).toFixed(2);
        const fileSizeDisplay = fileSizeInKB > 1024
          ? `${(fileSizeInKB / 1024).toFixed(2)} MB`
          : `${fileSizeInKB} KB`;

        const truncatedFileName = truncateFileName(file.name);
        fileNameElement.textContent = truncatedFileName;
        uploadIcon.style.display = 'none';
        removeIcon.style.display = 'inline';

        // Hide help icon and format info, replace with file size
        if (helpTrigger) helpTrigger.style.display = 'none';
        if (formatInfo) formatInfo.textContent = `${fileSizeDisplay} uploaded`;

        // Show appropriate file icon
        const fileIcon = document.createElement('img');
        fileIcon.style.width = '20px';
        fileIcon.style.height = '20px';
        fileIcon.style.marginRight = '10px';

        // Add the icon based on the file type
        if (fileExtension === '.jpg' || fileExtension === '.jpeg' || fileExtension === '.png') {
          fileIcon.src = 'assets/images/image-upload.png';
        } else if (fileExtension === '.pdf') {
          fileIcon.src = 'assets/images/image-pdf.png';
        }

        // Insert the file icon before the file name
        const existingIcon = fileNameElement.querySelector('img');
        if (existingIcon) {
          existingIcon.remove(); // Remove any existing icon if re-uploading a file
        }
        fileNameElement.insertBefore(fileIcon, fileNameElement.firstChild);

        // Make the document names visible for all 3 documents
        document.querySelectorAll('.document-name').forEach((documentElement) => {
          documentElement.style.display = 'block';  // Display all document names
        });

        const userId = document.getElementById("personal-info-userid").value;



        await uploadFileToServer(file, userId, fileNameId);

      }

      function uploadFileToServer(file, userId, fileNameId) {
        const formDetailsData = new FormData();
        formDetailsData.append('file', file);
        formDetailsData.append('userId', userId);
        formDetailsData.append('fileNameId', fileNameId);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Handle case where CSRF token is not found
        if (!csrfToken) {
          console.error('CSRF token not found');
          return;
        }

        fetch('/upload-each-documents', {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
          },
          body: formDetailsData,
        })
          .then(response => {
            if (!response.ok) {
              return response.json().then(errorData => {
                throw new Error(errorData.error || 'Network response was not ok');
              });
            }
            return response.json();
          })
          .then(data => {
            if (data) {
              console.log("File uploaded successfully", data);
            } else {
              console.error("Error: No URL returned from the server", data);
            }
          })
          .catch(error => {
            console.error("Error uploading file", error);
          });

        console.log(file, userId, fileNameId);
      }

      // Function to remove the selected file
      function removeFile(fileInputId, fileNameId, uploadIconId, removeIconId) {
        const fileInput = document.getElementById(fileInputId);
        const fileNameElement = document.getElementById(fileNameId);
        const uploadIcon = document.getElementById(uploadIconId);
        const removeIcon = document.getElementById(removeIconId);

        // Help container and format info elements
        const helpTrigger = fileNameElement.parentElement.nextElementSibling.querySelector('.help-trigger');
        const formatInfo = fileNameElement.parentElement.nextElementSibling.querySelector('span:last-child');

        // Clear the file input
        fileInput.value = '';
        fileNameElement.textContent = 'No file chosen';

        // Reset icons
        uploadIcon.style.display = 'inline';
        removeIcon.style.display = 'none';

        // Show help icon and format info
        if (helpTrigger) helpTrigger.style.display = 'inline';
        if (formatInfo) formatInfo.textContent = '*jpg, png, pdf formats';

        // Remove file icon
        const fileIcon = fileNameElement.querySelector('img');
        if (fileIcon) {
          fileIcon.remove();
        }
      }


      const borrowBloodRelative = document.querySelector('.borrow-blood-relative');
      const borrowOptionIcon = borrowBloodRelative.querySelector('.borrow-option-icon');
      const borrowDropdown = borrowBloodRelative.querySelector('.borrow-dropdown');
      const borrowBloodLabel = document.getElementById('borrow-blood-label');
      const bloodRelativeRadio = document.getElementById('borrow-blood-relative');

      // Toggle dropdown visibility on radio button or icon click
      function toggleDropdown() {
        borrowBloodRelative.classList.toggle('open');
        borrowDropdown.style.display = borrowBloodRelative.classList.contains('open') ? 'flex' : 'none';
      }

      // Toggle dropdown when the radio button or the icon is clicked
      bloodRelativeRadio.addEventListener('click', toggleDropdown);
      borrowOptionIcon.addEventListener('click', toggleDropdown);

      // Handle dropdown item selection
      borrowDropdown.addEventListener('click', function (e) {
        if (e.target.classList.contains('borrow-dropdown-item')) {
          // Update label text without changing color
          borrowBloodLabel.textContent = e.target.textContent;


          document.querySelectorAll('.borrow-dropdown-item').forEach(item => {
            item.classList.remove('selected');
          });

          // Add 'selected' class to clicked item (for styling if needed)
          e.target.classList.add('selected');

          // Close dropdown
          borrowBloodRelative.classList.remove('open');
          borrowDropdown.style.display = 'none';
        }
      });

      // Close dropdown on outside click
      document.addEventListener('click', function (event) {
        if (!borrowBloodRelative.contains(event.target)) {
          borrowBloodRelative.classList.remove('open');
          borrowDropdown.style.display = 'none';
        }
      });

      //change start
      // upadted js Code
      const dropdown = document.querySelector('.dropdown-about');
      const dropdownLabel = dropdown.querySelector('.dropdown-label-about');
      const dropdownOptions = dropdown.querySelector('.dropdown-options-about');
      const options = dropdown.querySelectorAll('.dropdown-option-about-us');
      let selectedValue = ''; // Variable to hold the selected value

      // Toggle the dropdown visibility when clicked
      dropdown.addEventListener('click', function (event) {
        dropdown.classList.toggle('open');
        event.stopPropagation();
      });

      // Handle option selection
      options.forEach(option => {
        option.addEventListener('click', function (event) {
          dropdownLabel.textContent = option.textContent;
          options.forEach(opt => opt.classList.remove('selected'));
          option.classList.add('selected');
          selectedValue = option.getAttribute('data-value'); // Capture the selected value here
          dropdown.classList.remove('open');
          event.stopPropagation();
        });
      });

      // Close the dropdown if clicked outside
      document.addEventListener('click', function (event) {
        if (!dropdown.contains(event.target)) {
          dropdown.classList.remove('open');
        }
      });


      const dropdowns = document.querySelectorAll('#step-3 .dropdown');

      dropdowns.forEach(dropdown => {
        const dropdownLabel = dropdown.querySelector('.dropdown-label');
        const dropdownOptions = dropdown.querySelector('.dropdown-options');
        const options = dropdown.querySelectorAll('.dropdown-option');

        // Toggle the dropdown visibility when clicked
        dropdown.addEventListener('click', function (event) {
          dropdown.classList.toggle('open');
          event.stopPropagation();
        });

        // Handle option selection
        options.forEach(option => {
          option.addEventListener('click', function (event) {
            const selectedValue = option.getAttribute('data-value');
            dropdownLabel.textContent = option.textContent;
            dropdownLabel.setAttribute('data-selected', selectedValue); // Set the data-selected attribute

            options.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            dropdown.classList.remove('open');
            event.stopPropagation();
          });
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', function (event) {
          if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('open');
          }
        });
      });

      // Function to get the selected course duration
      function getSelectedCourseDuration() {
        const selectedOption = document.querySelector('.dropdown-label').getAttribute('data-selected');
        console.log('Selected Course Duration:', selectedOption);
        return selectedOption;
      }

      const yesRadio = document.getElementById('academic-yes');
      const noRadio = document.getElementById('academic-no');
      const reasonContainer = document.getElementById('reason-container');

      // Function to handle radio button change
      function handleRadioChange(shouldShow) {
        if (shouldShow) {
          reasonContainer.classList.add('visible');
        } else {
          reasonContainer.classList.remove('visible');
        }
      }

      // Add event listeners
      yesRadio.addEventListener('change', () => {
        handleRadioChange(yesRadio.checked);
      });

      noRadio.addEventListener('change', () => {
        handleRadioChange(yesRadio.checked);
      });

      const inputField = document.getElementById('personal-info-city');
      const suggestionsContainer = document.getElementById('suggestions');

      inputField.addEventListener('input', handleInputChange);

      document.addEventListener('click', (event) => {
        if (!event.target.closest('.input-group')) {
          suggestionsContainer.style.display = 'none';
        }
      });

      async function handleInputChange() {
        const inputValue = inputField.value.toLowerCase();

        const suggestion = await fetchLocationSuggestion(inputValue);
        displaySuggestion(suggestion);
      }

      async function fetchLocationSuggestion(query) {
        const topCities = [
          'mumbai',
          'delhi',
          'bangalore',
          'hyderabad',
          'chennai',
          'kolkata',
          'pune',
          'surat',
          'jaipur',
          'ahmedabad',
          'vijayawada',
          'indore',
          'visakhapatnam',
          'nagpur',
          'lucknow',
          'kanpur',
          'thane',
          'bhopal',
          'kochi',
          'coimbatore',
        ];

        const matchedCities = topCities.filter(city => city.includes(query));

        if (matchedCities.length > 0) {
          switch (matchedCities[0]) {
            case 'mum':
              return 'Mumbai';
            case 'del':
              return 'Delhi';
            case 'ban':
              return 'Bangalore';
            case 'hyd':
              return 'Hyderabad';
            case 'che':
              return 'Chennai';
            case 'kol':
              return 'Kolkata';
            case 'pun':
              return 'Pune';
            case 'sur':
              return 'Surat';
            case 'jai':
              return 'Jaipur';
            case 'ahm':
              return 'Ahmedabad';
            case 'vij':
              return 'Vijayawada';
            case 'ind':
              return 'Indore';
            case 'vis':
              return 'Visakhapatnam';
            case 'nag':
              return 'Nagpur';
            case 'luc':
              return 'Lucknow';
            case 'kan':
              return 'Kanpur';
            case 'tha':
              return 'Thane';
            case 'bho':
              return 'Bhopal';
            case 'koc':
              return 'Kochi';
            case 'coi':
              return 'Coimbatore';
            default:
              return query.charAt(0).toUpperCase() + query.slice(1);
          }
        } else {
          return '';
        }
      }

      function displaySuggestion(suggestion) {
        suggestionsContainer.innerHTML = '';

        if (suggestion) {
          const suggestionElement = document.createElement('div');
          suggestionElement.classList.add('suggestion');
          suggestionElement.textContent = suggestion;
          suggestionElement.addEventListener('click', () => {
            inputField.value = suggestion;
            suggestionsContainer.style.display = 'none';
          });
          suggestionsContainer.appendChild(suggestionElement);
          suggestionsContainer.style.display = 'block';
        } else {
          suggestionsContainer.style.display = 'none';
        }
      }



      const otherCheckbox = document.querySelector('#other-checkbox');
      const addCountryBox = document.querySelector('.add-country-box');

      otherCheckbox.addEventListener('change', () => {
        if (otherCheckbox.checked) {
          addCountryBox.style.display = 'block';
        } else {
          addCountryBox.style.display = 'none';
        }
      });



      const othersRadio = document.getElementById('others');
      const otherDegreeInputContainer = document.querySelector('.other-degree-input-container');
      const otherDegreeInput = document.getElementById('other-degree');
      const degreeRadios = document.querySelectorAll('input[name="degree_type"]');

      let isOthersSelected = false; // Track the state of the "Others" radio button

      degreeRadios.forEach((radio) => {
        radio.addEventListener('click', () => {
          if (radio === othersRadio) {
            // Toggle the "Others" input field visibility
            isOthersSelected = !isOthersSelected;
            otherDegreeInputContainer.style.display = isOthersSelected ? 'flex' : 'none';

            if (!isOthersSelected) {
              // Reset the "Others" radio button value and clear the text input
              othersRadio.value = 'others';
              otherDegreeInput.value = '';
            }
          } else {
            // Hide the input field and reset state when other radio buttons are clicked
            isOthersSelected = false;
            otherDegreeInputContainer.style.display = 'none';
            othersRadio.value = 'others'; // Reset "Others" value
            otherDegreeInput.value = ''; // Clear the text input
          }
        });
      });

      // Update the "Others" radio value instantly when typing in the text input
      otherDegreeInput.addEventListener('input', () => {
        othersRadio.value = otherDegreeInput.value;
      });



      //validate
      document.getElementById('loan-amount').addEventListener('input', function () {
        const loanAmount = document.getElementById('loan-amount');
        const errorMessage = document.getElementById('loan-error-message');


        if (!loanAmount.value || isNaN(loanAmount.value) || loanAmount.value <= 0) {
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });


      //borrower container
      document.getElementById('income-co-borrower').addEventListener('input', function () {
        const incomeInput = document.getElementById('income-co-borrower');
        const errorMessage = document.getElementById('income-error-message');

        // Check if the input is not a valid number or is empty
        if (isNaN(incomeInput.value) || incomeInput.value.trim() === "") {
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });

      document.getElementById('yes-liability').addEventListener('change', function () {
        const emiInput = document.getElementById('emi-amount');
        emiInput.disabled = false;
      });

      document.getElementById('no-liability').addEventListener('change', function () {
        const emiInput = document.getElementById('emi-amount');
        emiInput.disabled = true;
        emiInput.value = '';
        document.getElementById('emi-error-message').style.display = 'none';
      });

      document.getElementById('emi-amount').addEventListener('input', function () {
        const emiInput = document.getElementById('emi-amount');
        const errorMessage = document.getElementById('emi-error-message');

        // Check if the input is a valid number or not empty
        if (emiInput.value && isNaN(emiInput.value) || emiInput.value.trim() === "") {
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });

      document.getElementById('city-input').addEventListener('input', function () {
        const city = document.getElementById('city-input');
        const errorMessage = document.getElementById('city-error');

        if (city.value.trim() === "") {
          errorMessage.textContent = "Please enter the city.";
          errorMessage.style.display = 'block';
        } else {
          errorMessage.style.display = 'none';
        }
      });





    }); //close addEventListener




  </script>
</body>

</html>