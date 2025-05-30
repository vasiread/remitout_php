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
  <!-- Add CryptoJS CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


  <script src="{{ asset('js/studentforms.js') }}"></script>

  <style>
    select {
      width: 100%;
      height: 40px;
      padding: 8px 12px;
      font-size: 16px;
      font-family: inherit;
      color: #333;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 6px;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;

      /* Orange arrow icon (fill=#f47b20) */
      background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg fill='gray' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 16px 16px;

      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    select:focus {
      outline: none;
      border-color: #5b9bd5;
      box-shadow: 0 0 0 3px rgba(91, 155, 213, 0.2);
    }
    .radio-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-bottom: 15px;
}

.radio-label {
  font-weight: 600;
  margin-bottom: 5px;
}

.radio-option {
  display: flex;
  align-items: center;
  font-size: 15px;
  cursor: pointer;
  position: relative;
  padding-left: 30px;
  user-select: none;
}

.radio-option input[type="radio"] {
  opacity: 0;
  position: absolute;
  left: 0;
}

.radio-option .custom-radio {
  position: absolute;
  left: 0;
  height: 18px;
  width: 18px;
  border: 2px solid #666;
  border-radius: 50%;
  background: white;
  transition: 0.2s;
}

.radio-option input[type="radio"]:checked ~ .custom-radio {
  background-color: #007bff;
  border-color: #007bff;
}

.radio-option .custom-radio::after {
  content: "";
  position: absolute;
  display: none;
}

.radio-option input[type="radio"]:checked ~ .custom-radio::after {
  display: block;
  top: 4px;
  left: 4px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}

  </style>
</head>

<body>


  <nav class="student-form-nav">
    <div class="student-form-nav-container">
      <img src="assets/images/orange-logo.png" alt="Remitout Logo" class="student-form-logo">
      <div class="student-form-nav-links" id="student-form-nav-links">
        <a href="#home">Home</a>
        <a href="#resources">Resources</a>
        <a href="#deals">Special Deals</a>
        <a href="#services">Our Service</a>
        <a href="#schedule">Schedule Call</a>
        <a href="#support" class="student-form-nav-mobile">Support</a>
        <a href="#help" class="student-form-nav-mobile">Help</a>

        <div class="student-form-nav-buttons">
          <button class="student-form-login-btn" onclick="window.location.href='/login'">Log
            In</button>
          <button class="student-form-signup-btn" onclick="window.location.href='/signup'">Sign
            Up</button>
        </div>
      </div>

      <div class="student-form-menu-left">
        <a href="#" class="student-form-nav-mobile">Login</a>
        <div class="student-form-menu-icon-container" id="student-form-menu-icon-container">

          <div class="student-form-menu-icon" id="student-form-menu-icon">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </div>

        </div>
      </div>

    </div>
  </nav>


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
                value="{{ session('user')->name }}" required disabled />
              <div class="validation-message" id="personal-info-name-error"></div>
            </div>
          </div>




          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/call-icon.png" alt="Phone Icon" class="icon" />
              <input type="tel" placeholder="Phone Number" name="phone_number" id="personal-info-phone"
                value="{{ session('user')->phone }}" required disabled />
              <div class="validation-message" id="personal-info-phone-error"></div>
            </div>
          </div>

          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/school.png" alt="Referral Code Icon" class="icon" />
              <input type="text" placeholder="Referral Code" name="referral_code"
                value="{{ session('user')->referral_code }}" id="personal-info-referral" required />
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
                value="{{ session('user')->email }}" required disabled />
              <div class="validation-message" id="personal-info-email-error"></div>
            </div>
          </div>

          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/calendar_month.png" alt="Calendar Icon" class="icon" />
              <input type="date" placeholder="Date of Birth (DD/MM/YYYY)" name="date_of_birth" id="personal-info-dob"
                required />
              <div class="validation-message" id="dob-error"></div>
            </div>
          </div>

          <div class="input-group">
            <div class="input-content">
              <div class="dropdown-gender-wrapper">
                <div class="dropdown-gender">
                  <div class="dropdown-gender-header">
                    <div class="dropdown-label-gender">Select Gender</div>
                    <div class="dropdown-icon-gender">
                      <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" />
                      </svg>
                    </div>
                  </div>
                  <div class="dropdown-options-gender">
                    <div class="dropdown-option-gender" data-value="Male">
                      <span>Male</span>
                    </div>
                    <div class="dropdown-option-gender" data-value="Female">
                      <span>Female</span>
                    </div>
                    <div class="dropdown-option-gender" data-value="Other">
                      <span>Other</span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="gender" id="gender-personal-info" value="" />
                <div class="validation-message" id="gender-error"></div>
              </div>
            </div>
          </div>

        </div>



        <div class="input-row">
          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
              <input type="text" placeholder="State" name="state" id="personal-info-state" required />
              <div id="suggestions-state" class="suggestions-container"></div>
              <div class="validation-message" id="state-error"></div>
            </div>
          </div>

          <div class="input-group">
            <div class="input-content">
              <img src="./assets/images/pin_drop.png" alt="Location Icon" class="icon" />
              <input type="text" placeholder="City" name="city" id="personal-info-city" required />
              <div id="suggestions-city" class="suggestions-container"></div>
              <div class="validation-message" id="city-error"></div>
            </div>
          </div>
        </div>
        <!-- Dynamic Inputs -->
        <div class="input-row">
    @foreach($additionalFields as $field)
        @if($field->section === 'general') {{-- ✅ Only allow general section --}}
            @php
    // Dynamic inline style based on field type
    $inputGroupStyle = '';
    if (in_array($field->type, ['checkbox', 'radio'])) {
      $inputGroupStyle = 'padding-bottom: 10px; padding-top: 6px; height: fit-content; display: flex; flex-direction: column; align-items: flex-start;color:#75747c;';
    } elseif ($field->type === 'select') {
      $inputGroupStyle = 'padding-bottom: 8px;display: flex;flex-direction: column;align-items: flex-start;color:#75747c;height:fit-content';
    } elseif ($field->type === 'date') {
      $inputGroupStyle = 'display: flex; flex-direction: column; align-items: flex-start;color:#75747c;height:fit-content';
    }
            @endphp

          <div class="input-group" style="{{ $inputGroupStyle }}">
    {{-- Only show label for types other than text/url/date/file --}}
    @if(!in_array($field->type, ['text', 'url']))
        <label for="{{ $field->name }}">{{ $field->label }}</label>
    @endif

    {{-- Input Types --}}
    @if(in_array($field->type, ['text', 'date', 'url', 'file']))
        <input type="{{ $field->type }}" 
               name="dynamic_fields[{{ $field->id }}]" 
               id="{{ $field->name }}"
               value="{{ $userFieldValues[$field->id] ?? '' }}" 
               placeholder="{{ $field->label }}" 
               @if($field->required) required @endif
               @if(isset($field->editable) && !$field->editable) disabled @endif />
    
    @elseif($field->type === 'select')
        <select name="dynamic_fields[{{ $field->id }}]" 
                id="{{ $field->name }}" 
                @if($field->required) required @endif
                @if(isset($field->editable) && !$field->editable) disabled @endif>
            <option value="">Select {{ $field->label }}</option>
            @foreach($field->options ?? [] as $option)
                <option value="{{ $option }}" @if(($userFieldValues[$field->id] ?? '') == $option) selected @endif>
                    {{ ucfirst($option) }}
                </option>
            @endforeach
        </select>

    @elseif($field->type === 'checkbox')
        <div style="margin-top: 6px;">
            @foreach($field->options ?? [] as $option)
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;color:#75747c;">
                    <input type="checkbox" 
                           name="dynamic_fields[{{ $field->id }}][]" 
                           value="{{ $option }}"
                           @if(in_array($option, $userFieldValues[$field->id] ?? [])) checked @endif
                           @if(isset($field->editable) && !$field->editable) disabled @endif />
                    {{ ucfirst($option) }}
                </label>
            @endforeach
        </div>

    @elseif($field->type === 'radio')
        <div style="margin-top: 6px;">
            @foreach($field->options ?? [] as $option)
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;color:#75747c">
                    <input type="radio" 
                           name="dynamic_fields[{{ $field->id }}]" 
                           value="{{ $option }}"
                           @if(($userFieldValues[$field->id] ?? '') == $option) checked @endif
                           @if(isset($field->editable) && !$field->editable) disabled @endif />
                    {{ ucfirst($option) }}
                </label>
            @endforeach
        </div>
    @endif
</div>

        @endif
    @endforeach
</div>






      </div>
  </div>


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
            @foreach($socialOptions as $option)
        <div class="dropdown-option-about-us" data-value="{{ strtolower($option->name) }}">
          {{ $option->name }}
        </div>
      @endforeach
          </div>



        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="next-btn" id="personal-info-submit">Next</button>
    </div>
  </div>
  </form>
  </div>



  <div class="course-section" id="step-course">


    <!-- Step 1: Study Location -->
    <div class="course-details" id="step-1">
      <div class="step-header">
        <div class="step-number">01</div>
        <h2>Where are you planning to study? Select all that applies</h2>
      </div>

      <div class="checkbox-group" id="selected-study-location">
        @foreach ($countries as $country)
      <label>
        <input type="checkbox" name="study-location" value="{{ $country->country_name }}">
        {{ $country->country_name }}
      </label>
    @endforeach

        {{-- Static "Other" checkbox --}}
        <label>
          <input type="checkbox" name="study-location" value="Other" id="other-checkbox"> Other
        </label>

        {{-- Textbox for adding custom country --}}
        <label>
          <div class="add-country-box">
            <input type="text" id="country" class="custom-country-input" placeholder="Add Country">
          </div>
        </label>
      </div>



    </div>

    <!-- Step 2: Degree Type -->
    <div class="course-degree" id="step-2" style="display: none;">
      <div class="step-header">
        <div class="step-number">02</div>
        <h2>Select the type of degree you want to pursue:</h2>
      </div>
      <form id="course-info-degreetype">
        <div class="degrees">
          @foreach ($degrees as $degree)
          @php
  $id = strtolower(str_replace(' ', '-', $degree->name));
      @endphp
          <div class="degree">
          <input type="radio" id="{{ $id }}" name="degree_type" value="{{ $degree->name }}">
          <label for="{{ $id }}">{{ $degree->name }}</label>
          </div>
      @endforeach

          <div class="degree">
            <input type="radio" id="others" name="degree_type" value="others">
            <label for="others">Others</label>
          </div>

          <div class="degree other-degree-input-container" style="display: none;" id="other-degree-container">
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
            @foreach($courseDuration as $course)
        <div class="dropdown-option" data-value="{{ $course->duration_in_months }}">
          {{ $course->duration_in_months }} Months
        </div>
      @endforeach
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
        @foreach ($courseExpenseOptions as $option)
      <div class="form-group academic-option">
        <label for="expense-option-{{ $option->id }}">
        <input type="radio" id="expense-option-{{ $option->id }}" name="expense-type"
          value="{{ Str::slug($option->label, '-') }}">
        {{ $option->label }}
        </label>
      </div>
    @endforeach

        </div>
      
        <div class="right-section">
          <div class="loan-amount-container">
            <label for="loan-amount" class="loan-label">Enter desired loan amount</label>
            <input type="number" id="loan-amount" class="loan-input" placeholder="₹ Rupees in Lakhs" />
            <span id="loan-error-message" class="error-message" style="display:none; color:red;">
              Please enter a valid loan amount (numeric values only).
            </span>
          </div>
      
          {{-- Dynamically injected fields for section = "course" --}}
          @foreach($additionalFields as $field)
          @if($field->section === 'course')
          <div class="form-group" style="margin-top: 15px;">
          @if(!in_array($field->type, ['text', 'url']))
        <label for="{{ $field->name }}">{{ $field->label }}</label>
        @endifpersonal-info-submit

          @if(in_array($field->type, ['text', 'url', 'date']))
          <input type="{{ $field->type }}" name="dynamic_fields[{{ $field->id }}]" id="{{ $field->name }}"
          value="{{ $userFieldValues[$field->id] ?? '' }}" placeholder="{{ $field->label }}" @if($field->required)
        required @endif />

        @elseif($field->type === 'select')
          <select name="dynamic_fields[{{ $field->id }}]" id="{{ $field->name }}" @if($field->required) required @endif>
          <option value="">Select {{ $field->label }}</option>
          @foreach($field->options ?? [] as $option)
          <option value="{{ $option }}" @if(($userFieldValues[$field->id] ?? '') == $option) selected @endif>
          {{ ucfirst($option) }}
          </option>
        @endforeach
          </select>
        @endif
          </div>
        @endif
      @endforeach
        </div>
      
        <button type="submit" id="course-info-submit" class="next-btn-course">Next</button>
      </div>

      </div>


    </div>

  </div>




  <div class="academic-section" id="step-academic">

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
      
        {{-- Dynamically add fields for "social" section --}}
        @foreach($additionalFields as $field)
        @if($field->section === 'academic')
        <div class="input-field">
        @if(in_array($field->type, ['text', 'url', 'date']))
        <input type="{{ $field->type }}" name="dynamic_fields[{{ $field->id }}]" id="{{ $field->name }}"
          value="{{ $userFieldValues[$field->id] ?? '' }}" placeholder="{{ $field->label }}" @if($field->required) required
        @endif>
        @elseif($field->type === 'select')
        <label for="{{ $field->name }}">{{ $field->label }}</label>
        <select name="dynamic_fields[{{ $field->id }}]" id="{{ $field->name }}">
          <option value="">Select {{ $field->label }}</option>
          @foreach($field->options ?? [] as $option)
        <option value="{{ $option }}" @if(($userFieldValues[$field->id] ?? '') == $option) selected @endif>
        {{ ucfirst($option) }}
        </option>
        @endforeach
        </select>
        @elseif($field->type === 'radio')
        <label>{{ $field->label }}</label>
        @foreach($field->options ?? [] as $option)
        <label>
        <input type="radio" name="dynamic_fields[{{ $field->id }}]" value="{{ $option }}" @if(($userFieldValues[$field->id] ?? '') == $option) checked @endif>
        {{ ucfirst($option) }}
        </label>
        @endforeach
        @endif

        </div>
        @endif
    @endforeach
      </div>

      </div>
    </div>


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
          <p>Have you got any admit?</p>
          <div class="admit-exam-field">
            <label for="admit-ielts">IELTS</label>
            <div class="admit-input-container">
              <input type="text" id="admit-ielts" placeholder="Add score">
              <span class="admit-input-right">*minimum score 6.5</span>
            </div>
          </div>
          <div class="validation-message" id="ielts-error"></div>

          <div class="admit-exam-field">
            <label for="admit-gre">GRE</label>
            <div class="admit-input-container">
              <input type="text" id="admit-gre" placeholder="Add score">
              <span class="admit-input-right">*minimum score 280</span>
            </div>
          </div>
          <div class="validation-message" id="gre-error"></div>

          <div class="admit-exam-field">
            <label for="admit-toefl">TOEFL</label>
            <div class="admit-input-container">
              <input type="text" id="admit-toefl" placeholder="Add score">
              <span class="admit-input-right">*minimum score 90</span>
            </div>
          </div>
          <div class="validation-message" id="toefl-error"></div>

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


  <div class="income-co-borrower" style="display: none;">
    <div class="step-header">
      <div class="step-number">02</div>
      <h2>What is the gross monthly income of co-borrower?</h2>
    </div>
    <input type="text" id="income-co-borrower" placeholder=" ₹ Rupees in thousands" />
    <p class="minimum-amount">*minimum amount of 30k after liabilities for eligibility</p>
    <span id="income-error-message" class="error-message" style="display:none; color:red;">Please enter a valid numeric
      income value.</span>
  </div>



  <div class="monthly-container">
    <div class="monthly-liability">
      <div class="monthly-liability-container" style="display: none;">
        <div class="step-header">
          <div class="step-number">03</div>
          <h2>Is there any existing co-borrower monthly liability?</h2>
          <p class="amount-thousand">Enter the amount in thousands</p>
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
            <p class="amount-thousand-mobile">Enter the amount in thousands</p>
            <input type="text" id="emi-amount" class="emi-content-container" placeholder="Enter EMI amount" disabled />
            <span id="emi-error-message" class="error-message" style="display:none; color:red;">Please enter a valid EMI
              amount (numeric values only).</span>
          </div>
        </div>

        <button type="submit" id="coborrower-info-submit" class="next-btn-borrow">Next</button>
      </div>

    </div>
  </div>





  <section class="kyc-section-document" id="kyc-section-id" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">01</div>
        <h2>Student KYC Document</h2>
      </div>

      <div class="document-container">

        <div class="document-box">
          <div class="document-name" id="pan-card-document-name">PAN Card</div>
          <div class="upload-field">

            <span id="pan-card-name">No file chosen</span>
            <label for="pan-card" class="upload-icon" id="pan-card-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" style="display:none">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="pan-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'pan-card-name', 'pan-card-upload-icon', 'pan-card-remove-icon','static')">
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
          <div class="document-name" id="aadhar-card-document-name">Aadhar Card</div>
          <div class="upload-field">
            <span id="aadhar-card-name">No file chosen</span>
            <label for="aadhar-card" class="upload-icon" id="aadhar-card-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="aadhar-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'aadhar-card-name', 'aadhar-card-upload-icon', 'aadhar-card-remove-icon','static')">
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
          <div class="document-name" id="passport-document-name">Passport</div>
          <div class="upload-field">
            <span id="passport-card-name">No file chosen</span>
            <label for="passport" class="upload-icon" id="passport-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="passport" accept=".jpg, .png, .pdf"
onchange="handleFileUpload(event, 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon', null, 'static')">
            <span id="passport-remove-icon" class="remove-icon" style="display: none;"
              onclick="removeFile('passport', 'passport-card-name', 'passport-upload-icon', 'passport-remove-icon')">✖</span>
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


        @foreach($documentTypes as $doc)
          @php
        $fileUrl = $userDocumentUrls[$doc->id] ?? null;

        // Extract file name if URL is available
        $actualFileName = $fileUrl ? basename($fileUrl) : 'No file chosen';
          @endphp

          <div class="document-box">
            <div class="document-name" id="{{ $doc->key }}-document-name">{{ $doc->key }}</div>
            <div class="upload-field">
            <span id="{{ $doc->key }}-name">{{ $actualFileName }}</span>
            <label for="{{ $doc->key }}" class="upload-icon" id="{{ $doc->key }}-upload-icon">
            <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="{{ $doc->key }}" name="dynamic_documents[{{ $doc->key }}]" accept=".jpg, .png, .pdf"
      onchange="handleFileUpload(event, '{{ $doc->key }}-name', '{{ $doc->key }}-upload-icon', '{{ $doc->key }}-remove-icon', null, 'dynamic')"/>



            <span id="{{ $doc->key }}-remove-icon" class="remove-icon" style="display: none;"
            onclick="removeFile('{{ $doc->key }}', '{{ $doc->key }}-name', '{{ $doc->key }}-upload-icon', '{{ $doc->key }}-remove-icon')">✖</span>
            </div>
            <div class="info">
            <span class="help-trigger" data-target="{{ $doc->key }}-help">ⓘ Help</span>
            <span>*jpg, png, pdf formats</span>
            </div>
            <div class="help-container {{ $doc->key }}-help" style="display: none;">
            <h3 class="help-title">Help</h3>
            <div class="help-content">
            <p>Please upload a .jpg, .png, or .pdf file with a size less than 5MB.</p>
            </div>
            </div>
          </div>
    @endforeach


      </div>
    </div>
  </section>


  <section class="kyc-section-marksheet" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">02</div>
        <h2>Academic Mark Sheets</h2>
      </div>
      <div class="document-container">

        <!-- 10th Grade Mark Sheet -->
        <div class="document-box">

          <div class="document-name" id="10th-mark-sheet-id">10th Mark Sheet</div>
          <div class="upload-field">
            <span id="tenth-grade-name">No file chosen</span>
            <label for="tenth-grade" class="upload-icon" id="tenth-grade-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="tenth-grade" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'tenth-grade-name', 'tenth-grade-upload-icon', 'tenth-grade-remove-icon','static')">
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
          <div class="document-name" id="12th-mark-sheet-id">12th Mark Sheet</div>
          <div class="upload-field">
            <span id="twelfth-grade-name">No file chosen</span>
            <label for="twelfth-grade" class="upload-icon" id="twelfth-grade-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="twelfth-grade" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'twelfth-grade-name', 'twelfth-grade-upload-icon', 'twelfth-grade-remove-icon','static')">
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
          <div class="document-name" id="graduation-mark-sheet-id">Graduation Mark Sheet</div>
          <div class="upload-field">
            <span id="graduation-grade-name">No file chosen</span>
            <label for="graduation-grade" class="upload-icon" id="graduation-grade-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="graduation-grade" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'graduation-grade-name', 'graduation-grade-upload-icon', 'graduation-grade-remove-icon','static')">
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
          <div class="document-name" id="10th-grades-id">10th Grade</div>
          <div class="upload-field">
            <span id="secured-tenth-name">No file chosen</span>
            <label for="secured-tenth" class="upload-icon" id="secured-tenth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="secured-tenth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'secured-tenth-name', 'secured-tenth-upload-icon', 'secured-tenth-remove-icon','static')">
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
          <div class="document-name" id="12th-grade-id">12th Grade</div>
          <div class="upload-field">
            <span id="secured-twelfth-name">No file chosen</span>
            <label for="secured-twelfth" class="upload-icon" id="secured-twelfth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="secured-twelfth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'secured-twelfth-name', 'secured-twelfth-upload-icon', 'secured-twelfth-remove-icon','static')">
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
          <div class="document-name" id="Graduation-id">Graduation</div>
          <div class="upload-field">

            <span id="secured-graduation-name">No file chosen</span>
            <label for="secured-graduation" class="upload-icon" id="secured-graduation-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="secured-graduation" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'secured-graduation-name', 'secured-graduation-upload-icon', 'secured-graduation-remove-icon','static')">
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
          <div class="document-name" id="experience-letter-id">Experience letter</div>
          <div class="upload-field">
            <span id="work-experience-experience-letter">No file chosen</span>
            <label for="work-experience-tenth" class="upload-icon" id="work-experience-tenth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-tenth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-experience-letter', 'work-experience-tenth-upload-icon', 'work-experience-tenth-remove-icon','static')" />
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
              <p>Please upload your Experience Letter in JPG, PNG, or PDF format.</p>
            </div>
          </div>
        </div>

        <div class="work-experience-box">
          <div class="document-name" id="3-months-salary-slip-id">3 months salary slip</div>
          <div class="upload-field">
            <span id="work-experience-monthly-slip">No file chosen</span>
            <label for="work-experience-twelfth" class="upload-icon" id="work-experience-twelfth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-twelfth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-monthly-slip', 'work-experience-twelfth-upload-icon', 'work-experience-twelfth-remove-icon','static')" />
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
              <p>Please upload your last 3 months salary slips in JPG, PNG, or PDF format.</p>
            </div>
          </div>
        </div>

        <div class="work-experience-box">
          <div class="document-name" id="office-IDs-id">office ID</div>
          <div class="upload-field">
            <span id="work-experience-office-id">No file chosen</span>
            <label for="work-experience-graduation" class="upload-icon" id="work-experience-graduation-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-graduation" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-office-id', 'work-experience-graduation-upload-icon', 'work-experience-graduation-remove-icon','static')" />
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
              <p>Please upload your Office ID in JPG, PNG, or PDF format.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="work-experience-row">
        <div class="work-experience-box">
          <div class="document-name" id="Joining-letter-id">Joining letter</div>

          <div class="upload-field">
            <span id="work-experience-joining-letter">No file chosen</span>
            <label for="work-experience-fourth" class="upload-icon" id="work-experience-fourth-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="work-experience-fourth" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'work-experience-joining-letter', 'work-experience-fourth-upload-icon', 'work-experience-fourth-remove-icon','static')" />
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
              <p>Please upload your Joining Letter in JPG, PNG, or PDF format.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="kyc-section-co-borrower" style="display: none;">
    <div class="kyc-container">
      <div class="step-header">
        <div class="step-number">05</div>
        <h2>Co-borrower KYC Documents</h2>
      </div>
      <div class="document-container">

        <!-- PAN Card -->
        <div class="document-box">
          <div class="document-name" id="pan-card-ids">PAN Card</div>
          <div class="upload-field">
            <span id="co-pan-card-name">No file chosen</span>
            <label for="co-pan-card" class="upload-icon" id="co-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="co-pan-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'co-pan-card-name', 'co-upload-icon', 'co-remove-icon','static')">
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

        <div class="document-box">
          <div class="document-name" id="aadhar-card-id">Aadhar Card</div>
          <div class="upload-field">
            <span id="co-aadhar-card-name">No file chosen</span>
            <label for="co-aadhar-card" class="upload-icon" id="co-aadhar-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="co-aadhar-card" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'co-aadhar-card-name', 'co-aadhar-upload-icon', 'co-aadhar-remove-icon','static')">
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

        <div class="document-box">
          <div class="document-name" id="address-proof-id">Address Proof</div>
          <div class="upload-field">
            <span id="co-addressproof">No file chosen</span>
            <label for="co-passport" class="upload-icon" id="co-passport-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24">
            </label>
            <input type="file" id="co-passport" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'co-addressproof', 'co-passport-upload-icon', 'co-passport-remove-icon','static')">
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

      <div class="salary-sub">
        <p>If salaried:</p>
      </div>

      <div class="salary-upload-row">
        <!-- Salary Slip -->
        <div class="salary-upload-box">
          <div class="document-name" id="3 months-salary-slip-id">3 months salary slip</div>
          <div class="upload-field">
            <span id="salary-upload-salary-slip-name">No file chosen</span>
            <label for="salary-upload-salary-slip" class="upload-icon" id="salary-upload-salary-slip-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-salary-slip" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-salary-slip-name', 'salary-upload-salary-slip-upload-icon', 'salary-remove-salary-slip-1','static')" />
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

        <div class="salary-upload-box">
          <div class="document-name" id="6-months-bank-statement-id">6 months bank statement</div>
          <div class="upload-field">
            <span id="salary-upload-salary-statement-name">No file chosen</span>
            <label for="salary-upload-salary-statement" class="upload-icon"
              id="salary-upload-salary-statement-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-salary-statement" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-salary-statement-name', 'salary-upload-salary-statement-upload-icon', 'salary-remove-salary-statement-2','static')" />
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
          <div class="document-name" id="address-proof-salary-id">Address Proof</div>
          <div class="upload-field">
            <span id="salary-upload-address-proof-name">No file chosen</span>
            <label for="salary-upload-address-proof" class="upload-icon" id="salary-upload-address-proof-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-address-proof" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-address-proof-name', 'salary-upload-address-proof-upload-icon', 'salary-remove-address-proof-3','static')" />
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

      <div class="salary-sub">
        <p>If in Business:</p>
      </div>

      <div class="salary-upload-row">
        <div class="salary-upload-box">
          <div class="document-name" id="2 years of ITR-id">2 years of ITR</div>
          <div class="upload-field">
            <span id="salary-upload-itr-name">No file chosen</span>
            <label for="salary-upload-itr" class="upload-icon" id="salary-upload-itr-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-itr" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-itr-name', 'salary-upload-itr-upload-icon', 'salary-remove-itr-4','static')" />
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



        <div class="salary-upload-box">
          <div class="document-name" id="6-months-bank-statements-id">6 months bank statement
          </div>
          <div class="upload-field">
            <span id="salary-upload-fourth-document-name">No file chosen</span>
            <label for="salary-upload-fourth-document" class="upload-icon"
              id="salary-upload-fourth-document-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-fourth-document" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-fourth-document-name', 'salary-upload-fourth-document-upload-icon', 'salary-remove-fourth-document-5','static')" />
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


        <div class="salary-upload-box">
          <div class="document-name" id="Office/Shop-photographs-id">Office/Shop photographs
          </div>
          <div class="upload-field">
            <span id="salary-upload-fifth-document-name">No file chosen</span>
            <label for="salary-upload-fifth-document" class="upload-icon" id="salary-upload-fifth-document-upload-icon">
              <img src="assets/images/upload.png" alt="Upload Icon" width="24" />
            </label>
            <input type="file" id="salary-upload-fifth-document" accept=".jpg, .png, .pdf"
              onchange="handleFileUpload(event, 'salary-upload-fifth-document-name', 'salary-upload-fifth-document-upload-icon', 'salary-remove-fifth-document-6','static')" />
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
          <button type="submit" class="next-btn-kyc" id="saveandsubmit">Save and Submit</button>
        </div>


      </div>

      <!-- Submit Button -->


    </div>


  </section>

  </form>

  <div id="toast-container" class="toast-container"></div>

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




</body>

</html>