<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up</title>
    <!-- Font Awesome for eye/eye-slash icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Import Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    @extends('layouts.app')

    @section('title', 'Sign Up')

    @section('signupcontent')
    <?php
    $loginSignupImage = "assets/images/Sign-up.png";
    $loginSignupvectorOne = "assets/images/downsideloginimg.png";
    $profileCardVectorWhite = "assets/images/profileCardVector-white.png";
    $signupmainimgupside = "assets/images/signupmainimgupside.png";
    ?>

    <div class="loginsignupcontainer">
        <div class="loginsingupcontainer-leftpanel">
            <img class="loginsingupmainimg" src="<?php echo $loginSignupImage; ?>" alt="">
            <img class="profileCardVector-white" src="assets/images/profileCardVector-white.png" alt="">
            <h1 class="loginsingupimagecontainer-header">Lorem ipsum dolor sit amet, <br>consectur adipiscing elit</h1>
        </div>

            <div class="loginsingupcontainer-rightpanel" style="display:flex;">
                <img src="assets/images/loginsinguprightsideimg.png" class="rightsidevector-img" alt="">
                <h1>Get Started Now</h1>
                <form class="loginsingupcontainer-rightpanel-inside" id="signupForm" onsubmit="submitForm(event)">
                    <div class="rightpanel-namecontainer">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name" placeholder="Name (as per Aadhar)" required>
                        <div id="name-error" class="sign-up error-message">Please enter a valid name</div>
                    </div>
                    <div class="rightpanel-phonecontainer">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="Phone" required>
                        <div id="phone-error" class="sign-up error-message">Please enter a valid 10-digit phone number</div>
                    </div>
                    <div class="rightpanel-emailcontainer">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" required>
                        <div id="email-error" class="sign-up error-message">Please enter a valid email address</div>
                    </div>
                    <div class="rightpanel-passwordcontainer">
                        <label for="passwordinputID">Password</label>
                        <input type="password" id="passwordinputID" name="password" class="passwordOpen" placeholder="Password" maxlength="20" required>
                        <i class="fa-regular fa-eye-slash passwordClose"></i>
                        <div id="password-error" class="sign-up error-message">Password must be valid (6-20 characters).</div>
                        <a href="#" class="forgot-password" onclick="showForgotPasswordPopup()">Forgot Password?</a>
                    </div>
                  <div class="rightpanel-signupbuttoncontainer">
                        <div class="rightpanel-checkboxcontainer">
                            <input type="checkbox" name="confirmpolicy" id="confirmpolicy" style="margin:0;padding:0px" required>
                            <p style="text-decoration: none;">
                                I agree to the 
                                <a href="{{ route('terms') }}" target="_blank" style="text-decoration: underline; color: inherit;">
                                    terms & policy
                                </a>
                                </p>
                        </div>
                        <button type="submit">Sign up</button>
                    </div>
                </form>
                <div class="logincontainer-anotherresources">
                    <p class="or-divider">or</p>
                    <div class="googlesigninbuttoncontainer">
                        <button class="googlesigninbutton" onclick="window.location.href='{{ route('google.login') }}'">
                            <img src="{{ asset('assets/images/googleicon.png') }}"> Sign in with Google
                        </button>
                    </div>
                    <!-- New User Sign Up Option -->
                    <div class="logincontainer-signinoption">
                        <p>Have an account? </p>
                        <span onclick="window.location.href='{{ route('login') }}'">Sign In</span>
                    </div>
                </div>
            </div>

        <!-- OTP Section -->
        <div class="loginsignupcontainer-otppanel" style="display:none">
            <div class="loginsignupcontainer-otppanel-inside">
                <img src="assets/images/loginsinguprightsideimg.png" class="rightsidevector-img-otp" alt="">
                <h1>Enter the OTP</h1>
                <div class="otppanel-mainsection">
                    <p>Do not share your OTP!</p>
                    <div class="otpinputcontainer">
                        <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this); moveFocus(this, 'otp2')" id="otp1">
                        <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this); moveFocus(this, 'otp3')" id="otp2">
                        <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this); moveFocus(this, 'otp4')" id="otp3">
                        <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this); moveFocus(this, 'otp5')" id="otp4">
                        <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this); moveFocus(this, 'otp6')" id="otp5">
                        <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this)" id="otp6">
                    </div>
                    <button onclick="checkOTP()">Verify</button>
                </div>
            </div>
        </div>

        <!-- Forgot Password Popup -->
        <div class="forgot-password-popup-overlay" id="forgotPasswordPopup">
            <div class="forgot-password-popup-container">
                <span class="forgot-password-popup-close" onclick="hideForgotPasswordPopup()">×</span>
                <h2>Reset your password</h2>
                <p>Enter your email to receive a password reset link</p>
                <form id="forgotPasswordForm" onsubmit="sendResetLink(event)">
                    <label for="forgot-email">Email</label>
                    <input type="email" id="forgot-email" name="email" placeholder="name@example.com" required>
                    <div id="forgot-email-error" class="forgot-password-popup-error" style="display: none;"></div>
                    <button type="submit">Send reset link</button>
                    <div id="forgot-password-status" class="forgot-password-popup-status" style="display: none;"></div>
                </form>
                <div class="forgot-password-popup-footer">
                    Remember your password? <a href="http://127.0.0.1:8000/login" onclick="hideForgotPasswordPopup()">Log in</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the email from the URL query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');

            // Pre-fill the email input if the parameter exists and is valid
            if (email) {
                const emailInput = document.getElementById('email');
                if (emailInput) {
                    emailInput.value = decodeURIComponent(email);
                }
            }
        });

        let generatedOTP = '';
        let registerFormData = {};

        // Show the forgot password popup
        function showForgotPasswordPopup() {
            document.getElementById('forgotPasswordPopup').style.display = 'flex';
        }

        // Hide the forgot password popup
        function hideForgotPasswordPopup() {
            document.getElementById('forgotPasswordPopup').style.display = 'none';
            document.getElementById('forgot-email-error').style.display = 'none';
            document.getElementById('forgot-password-status').style.display = 'none';
            document.getElementById('forgot-email').value = '';
        }

        // Send reset link
        function sendResetLink(event) {
            event.preventDefault();
            const email = document.getElementById('forgot-email').value;
            const errorElement = document.getElementById('forgot-email-error');
            const statusElement = document.getElementById('forgot-password-status');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Validate email
            if (!emailRegex.test(email)) {
                errorElement.textContent = 'Please enter a valid email address';
                errorElement.style.display = 'block';
                statusElement.style.display = 'none';
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/forgot-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'We have emailed your password reset link!') {
                        statusElement.textContent = data.status;
                        statusElement.style.display = 'block';
                        errorElement.style.display = 'none';
                    } else {
                        errorElement.textContent = data.email || 'An error occurred. Please try again.';
                        errorElement.style.display = 'block';
                        statusElement.style.display = 'none';
                    }
                })
                .catch(error => {
                    errorElement.textContent = 'An error occurred. Please try again.';
                    errorElement.style.display = 'block';
                    statusElement.style.display = 'none';
                });
        }

        // Validation functions
        function validateName(name) {
            return name.trim().length > 0;
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePhone(phone) {
            const phoneRegex = /^\d{10}$/;
            return phoneRegex.test(phone);
        }

        function validatePassword(password) {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,20}$/;
            return passwordRegex.test(password);
        }

        // Function to show/hide error messages
        function showError(inputId, errorId, show) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);
            error.style.display = show ? 'block' : 'none';
            if (show) {
                input.classList.add('invalid-input');
            } else {
                input.classList.remove('invalid-input');
            }
        }

        // Function to toggle label visibility based on input content
        function toggleLabelVisibility(input) {
            const label = input.previousElementSibling;
            if (input.value.length > 0) {
                label.classList.add('show-label');
            } else {
                label.classList.remove('show-label');
            }
        }

        // Add input event listeners for real-time validation
        document.getElementById('name').addEventListener('input', function() {
            toggleLabelVisibility(this);
            showError('name', 'name-error', !validateName(this.value));
        });

        document.getElementById('email').addEventListener('input', function() {
            toggleLabelVisibility(this);
            showError('email', 'email-error', !validateEmail(this.value));
        });

        document.getElementById('phone').addEventListener('input', function() {
            toggleLabelVisibility(this);
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
            showError('phone', 'phone-error', !validatePhone(this.value));
        });

        document.getElementById('passwordinputID').addEventListener('input', function() {
            toggleLabelVisibility(this);
            if (this.value.length > 20) {
                this.value = this.value.slice(0, 20);
            }
            showError('passwordinputID', 'password-error', !validatePassword(this.value));
        });

        function restrictToNumbers(input) {
            let value = input.value;
            value = value.replace(/[^0-9]/g, '');
            if (value.length > 1) {
                value = value.slice(0, 1);
            }
            input.value = value;
        }

        const firstInput = document.getElementById('otp1');
        firstInput.focus();

        function moveFocus(currentInput, nextInputId) {
            if (currentInput.value.length === currentInput.maxLength) {
                const nextInput = document.getElementById(nextInputId);
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        const passwordInput = document.getElementById('passwordinputID');
        const passwordIcon = document.querySelector('.passwordClose');
        const forgotPasswordLink = document.querySelector('.forgot-password');
        let passwordView = false;

        passwordIcon.addEventListener('click', function() {
            passwordView = !passwordView;
            if (passwordView) {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        });

        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length > 0) {
                forgotPasswordLink.style.display = 'block';
            } else {
                forgotPasswordLink.style.display = 'none';
            }
        });

        passwordInput.addEventListener('focus', function() {
            forgotPasswordLink.style.display = 'block';
        });

        passwordInput.addEventListener('blur', function() {
            if (passwordInput.value.length === 0) {
                forgotPasswordLink.style.display = 'none';
            }
        });

        window.onload = function() {
            document.getElementById('otp1').focus();
        }

        function triggerOtpSection() {
            const nameInput = document.querySelector('.rightpanel-namecontainer input');
            const phoneInput = document.querySelector('.rightpanel-phonecontainer input');
            const emailInput = document.querySelector('.rightpanel-emailcontainer input');
            const passwordInput = document.querySelector('.rightpanel-passwordcontainer input');
            const checkbox = document.getElementById('confirmpolicy');

            if (!validateName(nameInput.value)) {
                showError('name', 'name-error', true);
                alert("Name is required");
                return;
            }
            if (!validatePhone(phoneInput.value)) {
                showError('phone', 'phone-error', true);
                alert("Please enter a valid 10-digit phone number");
                return;
            }
            if (!validateEmail(emailInput.value)) {
                showError('email', 'email-error', true);
                alert("Please enter a valid email address");
                return;
            }
            if (!validatePassword(passwordInput.value)) {
                showError('passwordinputID', 'password-error', true);
                alert("Password must be 6-20 characters, include uppercase, lowercase, number, and special character");
                return;
            }
            if (!checkbox.checked) {
                alert("You must agree to the terms & policy");
                return;
            }

                const otpPanelView = document.querySelector('.loginsignupcontainer-otppanel');
                const rightLoginsingupContainer = document.querySelector('.loginsingupcontainer-rightpanel');
                if (otpPanelView && rightLoginsingupContainer) {
                    otpPanelView.style.display = 'flex';
                    rightLoginsingupContainer.style.display = 'none';
                    const firstInput = document.getElementById('otp1');
                    firstInput.focus();
                    generateOTP(phoneInput, nameInput);
                } else {
                    console.error("OTP Panel not found!");
                }
            }
            

        const generateOTP = (phoneInput, nameInput) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const generatedOTP = Math.floor(100000 + Math.random() * 900000);
            const detailsInfo = {
                phone: phoneInput.value,
                name: nameInput.value,
                otp: generatedOTP
            };
            fetch('/send-mobotp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(detailsInfo)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text)
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        console.log('OTP sent successfully: ' + data.message);
                        alert('OTP sent successfully to ' + phoneInput.value);
                    } else {
                        console.error('OTP not received:', data);
                        alert('Error: OTP not sent.');
                    }
                })
                .catch(error => {
                    console.error('Error sending OTP:', error);
                    alert('Error: ' + error.message);
                });
        };

        function checkOTP() {
            const otp1 = document.getElementById('otp1').value;
            const otp2 = document.getElementById('otp2').value;
            const otp3 = document.getElementById('otp3').value;
            const otp4 = document.getElementById('otp4').value;
            const otp5 = document.getElementById('otp5').value;
            const otp6 = document.getElementById('otp6').value;
            if (!otp1 || !otp2 || !otp3 || !otp4 || !otp5 || !otp6) {
                alert('Please fill all OTP fields');
                return;
            }
            const finalOTP = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;
            const phoneInput = document.getElementById('phone');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log('Phone:', phoneInput.value, 'OTP:', finalOTP);
            const mailOtpdata = {
                phone: phoneInput.value,
                otp: finalOTP
            };
            console.log(JSON.stringify(mailOtpdata));
            fetch('/verify-mobotp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(mailOtpdata)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response data:', data);
                    if (data.message === 'OTP verified successfully') {
                        alert('OTP Verified Successfully');
                        submitVerifiedData();
                    } else {
                        alert('Invalid OTP');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while verifying OTP');
                });
        }

        function submitForm(event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const phoneInput = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('passwordinputID').value;
            const confirmPolicy = document.getElementById('confirmpolicy').checked;

            if (!validateName(name)) {
                showError('name', 'name-error', true);
                alert("Name is required");
                return;
            }
            if (!validatePhone(phoneInput)) {
                showError('phone', 'phone-error', true);
                alert("Please enter a valid 10-digit phone number");
                return;
            }
            if (!validateEmail(email)) {
                showError('email', 'email-error', true);
                alert("Please enter a valid email address");
                return;
            }
            if (!validatePassword(password)) {
                showError('passwordinputID', 'password-error', true);
                alert("Password must be 6-20 characters, include uppercase, lowercase, number, and special character");
                return;
            }
            if (!confirmPolicy) {
                alert("You must agree to the terms & policy");
                return;
            }

            fetch("/emailuniquecheck", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success === false) {
                        showError('email', 'email-error', true);
                        alert(data.message);
                    } else if (data.success === true) {
                        triggerOtpSection();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while checking email');
                });
        }

        function submitVerifiedData() {
            const registerFormData = {
                name: document.getElementById('name').value,
                phoneInput: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                password: document.getElementById('passwordinputID').value,
            };
            console.log(registerFormData);
            fetch('/registerformdata', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(registerFormData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Registration is Successful");
                        window.location.href = '/student-forms';
                    } else {
                        alert(data.error || 'Something went wrong. Please try again.');
                    }
                })
                .catch(() => {
                    alert('An error occurred. Please try again.');
                });
        }
    </script>
    @endsection
</body>

</html>