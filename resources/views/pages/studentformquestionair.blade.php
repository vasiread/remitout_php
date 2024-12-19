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

</head>

<body>


    <section class="registration-section">
        <div class="container">
            <div class="registration-content">
                <h1 class="registration-title">Let's Get you Registered</h1>
                <p class="registration-subtitle">Let us know you better to find you the best offers and services!</p>
                <div class="breadcrumb flat">
                    <a href="#" id="breadcrumb-personal" class="active">Personal Information</a>
                    <a href="#" id="breadcrumb-course">Course Details</a>
                    <a href="#" id="breadcrumb-academic">Academic Details</a>
                    <a href="#" id="breadcrumb-co-borrower">Co-borrower Info</a>
                    <a href="#" id="breadcrumb-documents">Document Upload</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Personal Information Tab -->
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
                        <img src="./assets/images/person-icon.png" alt="Person Icon" class="icon" />
                        <input type="text" placeholder="Full Name" name="full_name" id="personal-info-name"
                            value="{{ session('user')->name }}" required />
                    </div>

                    <div class="input-group">
                        <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
                        <input type="tel" placeholder="Phone Number" name="phone_number" id="personal-info-phone"
                            value="{{ optional(session('existing_personal_info'))->phone }}" required />
                    </div>

                    <div class="input-group">
                        <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
                        <input type="text" placeholder="Referral Code" name="referral_code"
                            value="{{ optional(session('existing_personal_info'))->phone }}"
                            id="personal-info-referral" />
                    </div>
                </div>

                <!-- Input Row 2 -->
                <div class="input-row">
                    <div class="input-group">
                        <img src="./assets/images/mail.png" alt="Mail Icon" class="icon" />
                        <input type="email" placeholder="Email ID" name="email" id="personal-info-email"
                            value="{{ session('user')->email }}" required />
                    </div>
                    <div class="input-group">
                        <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
                        <input type="text" placeholder="City" name="city" id="personal-info-city" required />
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

                    <!-- Input Dropdown -->
                    <div class="input-container">
                        <select class="dropdown" name="how_did_you_find_us" required>
                            <option value="" disabled selected>Select</option>
                            <option value="youtube">YouTube</option>
                            <option value="google">Google</option>
                            <option value="friend">Friend</option>
                            <option value="other">Other</option>
                        </select>
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
                    <input type="checkbox" name="study-location" value="USA">
                    USA
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="UK">
                    UK
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Ireland">
                    Ireland
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="New Zealand">
                    New Zealand
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Germany">
                    Germany
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="France">
                    France
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Sweden">
                    Sweden
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Other">
                    Other
                    <div class="add-country" style="display: none;">
                        <input type="text" placeholder="Add Country" class="add-country-input" />
                        <div class="add-country-button">+</div>
                    </div>
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Italy">
                    Italy
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Canada">
                    Canada
                </label>
                <label>
                    <input type="checkbox" name="study-location" value="Australia">
                    Australia
                </label>
            </div>

            <!-- Automatically navigate to next step -->
            <script>
                setTimeout(function () {
                    navigateToStep('step-2');
                }, 2000); // Auto navigate after 2 seconds
            </script>
        </div>

        <!-- Step 2: Degree Type -->
        <div class="course-degree" id="step-2" style="display: none;">
            <div class="step-header">
                <div class="step-number">02</div>
                <h2>Select the type of degree you want to pursue:</h2>
            </div>

            <form id="course-info-degreetype">
                <div>
                    <input type="radio" id="bachelors" name="degree_type" value="bachelors">
                    <label for="bachelors">Bachelors (only secured loan)</label>
                </div>
                <div>
                    <input type="radio" id="others" name="degree_type" value="others">
                    <label for="others">Others</label>
                </div>
                <div>
                    <input type="radio" id="masters" name="degree_type" value="masters">
                    <label for="masters">Masters</label>
                </div>
            </form>

            <!-- Automatically navigate to next step -->
            <script>
                setTimeout(function () {
                    navigateToStep('step-3');
                }, 2000); // Auto navigate after 2 seconds
            </script>
        </div>

        <!-- Step 3: Course Duration -->
        <div class="course-duration-container" id="step-3" style="display: none;">
            <div class="step-header">
                <div class="step-number">03</div>
                <h2>What is the duration of the course?</h2>
            </div>

            <div class="dropdown" id="selected-course-duration">
                <select>
                    <option>No. of Months</option>
                    <option>12 Months</option>
                    <option>24 Months</option>
                    <option>36 Months</option>
                    <option>42 Months</option>
                </select>
                <div class="dropdown-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10H7Z" fill="#718096" />
                    </svg>
                </div>
            </div>

            <script>
                setTimeout(function () {
                    navigateToStep('step-4');
                }, 2000); 
            </script>
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
                            <input type="text" id="loan-amount" class="loan-input" placeholder="₹ Rupees in Lakhs" />
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
                <div class="academic-reason">
                    <label for="reason-textarea">Enter reason</label>
                    <textarea id="reason-textarea"
                        placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore"></textarea>
                </div>
            </div>
        </div>

        <!-- Academic Gap Section -->
        <div class="academic-gap" id="step-academic-gap" style="display: none;">
            <div class="step-header">
                <div class="step-number">02</div>
                <h2>Do you have any gap in your academics?</h2>
            </div>

            <!-- Academic Gap Options -->
            <div class="gap-options">
                <div class="gap-option">
                    <input type="radio" id="gap-yes" name="academic-gap" value="yes">
                    <label for="gap-yes">Yes</label>
                </div>
                <div class="gap-option">
                    <input type="radio" id="gap-no" name="academic-gap" value="no">
                    <label for="gap-no">No (only secured loan)</label>
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
        <input type="text" id="income-co-borrower" placeholder=" ₹ Rupees in thousands" value="" />
        <p class="minimum-amount">*minimum amount of 5% after deductions for eligibility</p>
        <span id="income-error-message" class="error-message" style="display:none; color:red;">Please enter a valid
            numeric
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
                        <input type="text" id="emi-amount" class="emi-content-container" placeholder="Enter EMI amount"
                            value="" />
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



    <section class="kyc-section-document" style="display: none;">
        <div class="kyc-container">
            <div class="step-header">
                <div class="step-number">01</div>
                <h2>Student KYC Document</h2>
            </div>

            <div class="document-container">

                <!-- PAN Card -->
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
                    <div class="upload-field">
                        <span id="work-experience-tenth-name">Experience letter</span>
                        <label for="work-experience-tenth" class="upload-icon" id="work-experience-tenth-upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-tenth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-tenth-name', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')" />
                        <span id="work-experience-tenth-remove-icon" style="display:none;"
                            onclick="removeFile('work-experience-tenth', 'work-experience-tenth-name', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon')">✖</span>
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
                    <div class="upload-field">
                        <span id="work-experience-twelfth-name">3 months salary slip</span>
                        <label for="work-experience-twelfth" class="upload-icon"
                            id="work-experience-twelfth-upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-twelfth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-twelfth-name', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')" />
                        <span id="work-experience-twelfth-remove-icon" style="display:none;"
                            onclick="removeFile('work-experience-twelfth', 'work-experience-twelfth-name', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon')">✖</span>
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
                    <div class="upload-field">
                        <span id="work-experience-graduation-name">office ID</span>
                        <label for="work-experience-graduation" class="upload-icon"
                            id="work-experience-graduation-upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-graduation" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-graduation-name', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')" />
                        <span id="work-experience-graduation-remove-icon" style="display:none;"
                            onclick="removeFile('work-experience-graduation', 'work-experience-graduation-name', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon')">✖</span>
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

                    <div class="upload-field">
                        <span id="work-experience-fourth-name">Joining letter</span>
                        <label for="work-experience-fourth" class="upload-icon" id="work-experience-fourth-upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-fourth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-fourth-name', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')" />
                        <span id="work-experience-fourth-remove-icon" style="display:none;"
                            onclick="removeFile('work-experience-fourth', 'work-experience-fourth-name', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon')">✖</span>
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
                <!-- PAN Card -->
                <div class="document-box">
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
                    <div class="upload-field">
                        <span id="co-passport-name">Address Proof</span>
                        <label for="co-passport" class="upload-icon" id="co-passport-upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="co-passport" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'co-passport-name', 'co-passport-upload-icon', 'co-passport-remove-icon')">
                        <span id="co-passport-remove-icon" class="remove-icon" style="display:none;"
                            onclick="removeFile('co-passport', 'co-passport-name', 'co-passport-upload-icon', 'co-passport-remove-icon')">✖</span>
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
                    <div class="upload-field">
                        <span id="salary-upload-salary-slip-name">3 months salary slip</span>
                        <label for="salary-upload-salary-slip" class="upload-icon"
                            id="salary-upload-salary-slip-upload-icon">
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
                    <div class="upload-field">
                        <span id="salary-upload-address-proof-name">Address Proof</span>
                        <label for="salary-upload-address-proof" class="upload-icon"
                            id="salary-upload-address-proof-upload-icon">
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
                    <div class="upload-field">
                        <span id="salary-upload-fifth-document-name">Office/Shop photographs</span>
                        <label for="salary-upload-fifth-document" class="upload-icon"
                            id="salary-upload-fifth-document-upload-icon">
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

    <div class=" navigation">
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




    <script>
        document.addEventListener('DOMContentLoaded', () => {

            event.preventDefault(); // Prevent form submission for testing
            // Breadcrumb navigation and buttons
            const prevButton = document.querySelector('.nav-button.prev');
            const nextButton = document.querySelector('.nav-button.next');
            const nextBreadcrumbButton = document.querySelector('.next-btn');
            const nextCourseButton = document.querySelector('.next-btn-course');
            const nextAcademicButton = document.querySelector('.next-btn-academic');
            const nextBorrowButton = document.querySelector('.next-btn-borrow');
            const nextKycButton = document.querySelector('.next-btn-ky');
            const breadcrumbLinks = document.querySelectorAll('.breadcrumb a'); // Adjusted to use <a> elements inside .breadcrumb

            const breadcrumbSections = [
                [document.querySelector('.registration-form'), document.querySelector('.section-02-container')],
                [document.querySelector('.course-details'), document.querySelector('.course-degree'), document.querySelector('.course-duration-container'), document.querySelector('.detail-container-section')],
                [document.querySelector('.academic-container'), document.querySelector('.academic-gap'), document.querySelector('.admit-form-container')],
                [document.querySelector('.borrow-container-section'), document.querySelector('.income-co-borrower'), document.querySelector('.monthly-liability-container')],
                [document.querySelector('.kyc-section-document'), document.querySelector('.kyc-section-marksheet'), document.querySelector('.kyc-section-Admission'), document.querySelector('.work-experience'), document.querySelector('.kyc-section-co-borrower'), document.querySelector('.salary-upload')]
            ];

            let currentBreadcrumbIndex = 0;
            let currentContainerIndex = 0;

            function updateNavigationButtons() {
                const isAtFirstContainer = currentBreadcrumbIndex === 0 && currentContainerIndex === 0;
                const isAtLastContainer = currentContainerIndex === breadcrumbSections[currentBreadcrumbIndex].length - 1;

                prevButton.disabled = isAtFirstContainer;
                nextButton.disabled = isAtLastContainer;

                nextBreadcrumbButton.disabled = currentContainerIndex !== breadcrumbSections[currentBreadcrumbIndex].length - 1;
            }



            function updateBreadcrumbNavigation() {
                breadcrumbLinks.forEach((link, index) => {
                    // Remove 'active' class from all breadcrumbs first
                    link.classList.remove('active');
                    link.style.color = ''; // Reset color of the text

                    // If the current breadcrumb index matches, set the active class
                    if (index === currentBreadcrumbIndex) {
                        link.classList.add('active');
                        link.style.color = '#fff';
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
            }



          
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
                    console.log(coborrowerData.personalInfoId);

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
                const personalInfoReferral = document.getElementById("personal-info-referral").value;  // Fixed typo
                const personalInfoFindOut = document.querySelector('select[name="how_did_you_find_us"]').value;

                // Create an object with the personal update data
                const personalUpdateData = {
                    personalInfoId,
                    personalInfoName,
                    personalInfoPhone,
                    personalInfoEmail,
                    personalInfoCity,
                    personalInfoReferral,
                    personalInfoFindOut
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
            }
            function getSelectedExpenseType() {
                const selectedExpense = document.querySelector('input[name="expense-type"]:checked');
                console.log('Selected Expense Type:', selectedExpense ? selectedExpense.value : 'None');
                return selectedExpense ? selectedExpense.value : null; // Return the selected value or null if none selected
            }

            function getLoanAmount() {
                const loanAmount = document.getElementById('loan-amount').value;
                console.log('Loan Amount:', loanAmount.trim());
                return loanAmount.trim();
            }

            function getSelectedCourseDuration() {
                const selectedOption = document.querySelector('#selected-course-duration select').value;
                console.log('Selected Course Duration:', selectedOption); // Log the selected course duration
                return selectedOption;
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
                const courseDuration = getSelectedCourseDuration();
                const studyLocations = getSelectedStudyLocations();







                const courseInfoData = {
                    personalInfoId,
                    selectedDegreeType,
                    expenseType,
                    loanAmount,
                    courseDuration,
                    studyLocations
                }
                console.log(courseInfoData)

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


                const academicDetails = {
                    personalInfoId, selectedAcademicGap, reasonForGap, selectedAdmitOption, selectedWorkOption, ieltsScore, greScore, toeflScore,
                    "others": { otherExamName, otherExamScore }
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









            nextButton.addEventListener('click', () => navigate('next'));
            prevButton.addEventListener('click', () => navigate('prev'));

            nextBreadcrumbButton.addEventListener('click', () => {
                if (currentBreadcrumbIndex < breadcrumbSections.length - 1) {
                    breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
                    currentBreadcrumbIndex++;
                    currentContainerIndex = 0;

                    breadcrumbSections[currentBreadcrumbIndex].forEach((container, index) => {
                        container.style.display = (index === 0) ? 'block' : 'none';
                    });

                    updateBreadcrumbNavigation();
                    updateNavigationButtons();
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
                    }
                });
            }

            if (nextKycButton) {
                nextKycButton.addEventListener('click', () => {
                    if (currentBreadcrumbIndex === 4) {
                        breadcrumbSections[currentBreadcrumbIndex].forEach(container => container.style.display = 'none');
                        currentBreadcrumbIndex = 5;
                        currentContainerIndex = 0;

                        breadcrumbSections[currentBreadcrumbIndex].forEach((container, index) => {
                            container.style.display = (index === 0) ? 'block' : 'none';
                        });

                        updateBreadcrumbNavigation();
                        updateNavigationButtons();
                    }
                });
            }

            breadcrumbSections.forEach((containers, breadcrumbIndex) => {
                containers.forEach((container, containerIndex) => {
                    container.style.display =
                        breadcrumbIndex === 0 && containerIndex === 0 ? 'block' : 'none';
                });
            });

            updateBreadcrumbNavigation();
            updateNavigationButtons();


            // Dropdown for "Borrow Blood Relative"
            const borrowBloodRelativeOption = document.querySelector('.borrow-blood-relative');
            const borrowDropdown = document.querySelector('.borrow-dropdown');
            const borrowBloodLabel = document.getElementById('borrow-blood-label');

            // Ensure dropdown and related elements exist
            if (!borrowBloodRelativeOption || !borrowDropdown || !borrowBloodLabel) {
                console.error('Dropdown elements not found.');
                return;
            }

            // Toggle dropdown on click
            borrowBloodRelativeOption.addEventListener('click', function (e) {
                e.stopPropagation(); // Prevent event bubbling
                const isOpen = borrowBloodRelativeOption.classList.contains('open');
                borrowBloodRelativeOption.classList.toggle('open', !isOpen);
                borrowDropdown.style.display = isOpen ? 'none' : 'flex';
            });

            // Update label on dropdown item selection
            const borrowDropdownItems = document.querySelectorAll('.borrow-dropdown-item');
            borrowDropdownItems.forEach((item) => {
                item.addEventListener('click', function (e) {
                    e.stopPropagation(); // Prevent closing dropdown when selecting an item
                    borrowBloodLabel.textContent = `Blood relative (${this.textContent})`; // Update label
                    borrowDropdown.style.display = 'none';
                    borrowBloodRelativeOption.classList.remove('open');
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function () {
                borrowDropdown.style.display = 'none';
                borrowBloodRelativeOption.classList.remove('open');
            });
        });

        // Help triggers
        const helpTriggers = document.querySelectorAll('.help-trigger');

        helpTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const targetClass = trigger.getAttribute('data-target');
                const helpContainer = document.querySelector(`.${targetClass}`);

                if (helpContainer) {
                    if (helpContainer.style.display === 'none' || !helpContainer.style.display) {
                        helpContainer.style.display = 'block';
                    } else {
                        helpContainer.style.display = 'none';
                    }
                }

            });

        });



    </script>
</body>

</html>