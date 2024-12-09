<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <form action="your-action-url" method="POST">
            <!-- Registration Form -->
            <div class="registration-form">
                <!-- Step Header -->
                <div class="step-header">
                    <div class="step-number">01</div>
                    <h2>Let us know more about you</h2>
                </div>

                <!-- Input Row 1 -->
                <div class="input-row">
                    <div class="input-group">
                        <img src="./assets/images/person-icon.png" alt="Person Icon" class="icon" />
                        <input type="text" placeholder="Full Name" name="full_name" required />
                    </div>
                    <div class="input-group">
                        <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
                        <input type="tel" placeholder="Phone Number" name="phone_number" required />
                    </div>
                    <div class="input-group">
                        <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
                        <input type="text" placeholder="Referral Code" name="referral_code" />
                    </div>
                </div>

                <!-- Input Row 2 -->
                <div class="input-row">
                    <div class="input-group">
                        <img src="./assets/images/mail.png" alt="Mail Icon" class="icon" />
                        <input type="email" placeholder="Email ID" name="email" required />
                    </div>
                    <div class="input-group">
                        <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
                        <input type="text" placeholder="City" name="city" required />
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

                    <!-- Next Button (Placed Below Section 02) -->
                    <button type="submit" class="next-btn">Next</button>
                </div> <!-- End of section-02 -->
            </div> <!-- End of section-02-container -->

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

            <div class="checkbox-group">
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

            <form>
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

            <div class="dropdown">
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

            <!-- Automatically navigate to next step -->
            <script>
                setTimeout(function () {
                    navigateToStep('step-4');
                }, 2000); // Auto navigate after 2 seconds
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
            <button type="submit" class="next-btn-course">Next</button>
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

            <button type="submit" class="next-btn-academic">Next</button>
        </div>

    </div>


    <!----breadcrumb 4 tab---->
    <!---co-borrower section-->
    <div class="co-borrow-section" id="step-co-borrower">
        <div class="borrow-container-section" style="display: none;">
            <div class="step-header">
                <div class="step-number">01</div>
                <h2>Do you have any gap in your academics?</h2>
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
                    <label class="borrow-label" id="borrow-blood-label" for="borrow-blood-relative">Blood
                        relative</label>
                    <span class="borrow-option-icon"></span>
                    <div class="borrow-dropdown">
                        <div class="borrow-dropdown-item">Paternal Auntie</div>
                        <div class="borrow-dropdown-item">Paternal Uncle</div>
                        <div class="borrow-dropdown-item">Maternal Auntie</div>
                        <div class="borrow-dropdown-item">Maternal Uncle</div>
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
            <input type="text" placeholder=" ₹ Rupees in thousands" />
            <p class="minimum-amount">*minimum amount of 5% after deductions for eligibility</p>
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
                                <input type="radio" name="co-borrower-liability" />
                                Yes
                            </label>
                            <label>
                                <input type="radio" name="co-borrower-liability" />
                                No
                            </label>
                        </div>
                        <input type="text" placeholder="Enter EMI amount" />
                    </div>

                    <!-- Button placed inside the last container -->
                    <button type="submit" class="next-btn-borrow">Next</button>
                </div>

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
                    <div class="upload-field">
                        <span id="pan-card-name">PAN Card</span>
                        <label for="pan-card" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="pan-card" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'pan-card-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="pan-card-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container pan-card-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>
                <!-- Aadhar Card -->
                <div class="document-box">
                    <div class="upload-field">
                        <span id="aadhar-card-name">Aadhar Card</span>
                        <label for="aadhar-card" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="aadhar-card" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'aadhar-card-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="aadhar-card-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container aadhar-card-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>
                <!-- Passport -->
                <div class="document-box">
                    <div class="upload-field">
                        <span id="passport-name">Passport</span>
                        <label for="passport" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="passport" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'passport-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="passport-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container passport-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
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
                        <label for="tenth-grade" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="tenth-grade" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'tenth-grade-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="tenth-grade-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container tenth-grade-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>

                <!-- 12th Grade Mark Sheet -->
                <div class="document-box">
                    <div class="upload-field">
                        <span id="twelfth-grade-name">12th Grade Mark Sheet</span>
                        <label for="twelfth-grade" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="twelfth-grade" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'twelfth-grade-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="twelfth-grade-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container twelfth-grade-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>

                <!-- Graduation Mark Sheet -->
                <div class="document-box">
                    <div class="upload-field">
                        <span id="graduation-grade-name">Graduation Mark Sheet</span>
                        <label for="graduation-grade" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="graduation-grade" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'graduation-grade-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="graduation-grade-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container graduation-grade-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
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
                        <label for="secured-tenth" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="secured-tenth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'secured-tenth-name')">
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
                        <label for="secured-twelfth" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="secured-twelfth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'secured-twelfth-name')">
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
                        <label for="secured-graduation" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="secured-graduation" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'secured-graduation-name')">
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
                        <span id="work-experience-tenth-name">10th Grade</span>
                        <label for="work-experience-tenth" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-tenth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-tenth-name')" />
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
                        <span id="work-experience-twelfth-name">12th Grade</span>
                        <label for="work-experience-twelfth" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-twelfth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-twelfth-name')" />
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
                        <span id="work-experience-graduation-name">Graduation</span>
                        <label for="work-experience-graduation" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-graduation" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-graduation-name')" />
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
                        <span id="work-experience-fourth-name">Fourth Document</span>
                        <label for="work-experience-fourth" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="work-experience-fourth" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'work-experience-fourth-name')" />
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
                    <div class="upload-field">
                        <span id="pan-card-name">PAN Card</span>
                        <label for="pan-card" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="pan-card" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'pan-card-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="pan-card-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container pan-card-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>
                <!-- Aadhar Card -->
                <div class="document-box">
                    <div class="upload-field">
                        <span id="aadhar-card-name">Aadhar Card</span>
                        <label for="aadhar-card" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="aadhar-card" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'aadhar-card-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="aadhar-card-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container aadhar-card-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>
                <!-- Passport -->
                <div class="document-box">
                    <div class="upload-field">
                        <span id="passport-name">Address Proof</span>
                        <label for="passport" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24">
                        </label>
                        <input type="file" id="passport" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'passport-name')">
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="passport-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container passport-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---document upload step 6--->
    <section class="salary-upload" style="display: none;">
        <div class="salary-upload-container">
            <div class="step-header">
                <div class="step-number">06</div>
                <h2>Document Upload</h2>
            </div>
            <div class="salary-upload-row">
                <div class="salary-upload-box">
                    <div class="upload-field">
                        <span id="salary-upload-salary-slip-name">3 months salary slip</span>
                        <label for="salary-upload-salary-slip" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="salary-upload-salary-slip" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'salary-upload-salary-slip-name')" />
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
                <div class="salary-upload-box">
                    <div class="upload-field">
                        <span id="salary-upload-salary-statement-name">6 months bank statement</span>
                        <label for="salary-upload-salary-statement" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="salary-upload-salary-statement" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'salary-upload-salary-statement-name')" />
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
                <div class="salary-upload-box">
                    <div class="upload-field">
                        <span id="salary-upload-address-proof-name">Address Proof</span>
                        <label for="salary-upload-address-proof" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="salary-upload-address-proof" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'salary-upload-address-proof-name')" />
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
            <div class="salary-upload-row">
                <div class="salary-upload-box">
                    <div class="upload-field">
                        <span id="salary-upload-office-shop-photos-name">2 years of ITR</span>
                        <label for="salary-upload-office-shop-photos" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="salary-upload-office-shop-photos" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'salary-upload-office-shop-photos-name')" />
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="salary-upload-office-shop-photos-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container salary-upload-office-shop-photos-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Please upload your office/shop photographs in jpg, png, or pdf format.</p>
                        </div>
                    </div>
                </div>
                <div class="salary-upload-box">
                    <div class="upload-field">
                        <span id="salary-upload-fourth-document-name">6 months bank statement</span>
                        <label for="salary-upload-fourth-document" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="salary-upload-fourth-document" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'salary-upload-fourth-document-name')" />
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="salary-upload-fourth-document-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container salary-upload-fourth-document-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Please upload your fourth document in jpg, png, or pdf format.</p>
                        </div>
                    </div>
                </div>
                <div class="salary-upload-box">
                    <div class="upload-field">
                        <span id="salary-upload-fifth-document-name">Office/Shop photographs</span>
                        <label for="salary-upload-fifth-document" class="upload-icon">
                            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
                        </label>
                        <input type="file" id="salary-upload-fifth-document" accept=".jpg, .png, .pdf"
                            onchange="handleFileUpload(event, 'salary-upload-fifth-document-name')" />
                    </div>
                    <div class="info">
                        <span class="help-trigger" data-target="salary-upload-fifth-document-help">ⓘ Help</span>
                        <span>*jpg, png, pdf formats</span>
                    </div>
                    <div class="help-container salary-upload-fifth-document-help" style="display: none;">
                        <h3 class="help-title">Help</h3>
                        <div class="help-content">
                            <p>Please upload your fifth document in jpg, png, or pdf format.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <button type="submit" class="next-btn-kyc">Save and Submit</button>
    </section>




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




    <script>
        document.addEventListener('DOMContentLoaded', () => {
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