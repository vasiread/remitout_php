<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Document</title>
    <!-- Font Awesome for eye/eye-slash icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Import Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

</head>

<body>
    @extends('layouts.app')
    @section('title', 'Login')

    @section('logincontent')
        <div class="logincontainer">
            <img class="loginvector" src="{{ asset('assets/images/loginvector.png') }}" alt="Login vector illustration">
            <img class="loginvectorsecond" src="{{ asset('assets/images/loginvectorsecond.png') }}"
                alt="Secondary login vector">
            <div class="logincontainer-inside">
                <div class="logincontainer-leftinside">
                    <img src="assets/images/Pexels Photo by Buro Millennial.png" alt="Person working at desk">
                </div>
                <div class="logincontainer-rightinside">
                    <h1>Welcome back!</h1>
                    <form class="logincontainer-loginresources" id="loginForm" onsubmit="loginSubmitForm(event)">
                        @csrf
                        <img src="assets/images/loginsinguprightsideimg.png" class="loginrightsidevector-img"
                            alt="Right side decorative vector">

                        <!-- Username and Password Fields -->
                        <div class="logincontainer-namecontainer">
                            <label for="loginname">Unique ID</label>
                            <input type="text" placeholder="Unique ID" name="name" id="loginname">
                        </div>
                        <div class="logincontainer-passwordcontainer">
                            <label for="loginpasswordID">Password</label>
                            <input type="password" placeholder="Password" id="loginpasswordID" name="password">
                            <i class="fa-regular fa-eye-slash passwordClose" id="loginpasswordeyecloseicon"></i>
                            <a href="#" class="forgot-password-login" onclick="showForgotPasswordPopup()">Forgot
                                Password?</a>
                        </div>

                        <!-- Agree to Terms and Sign-In Button -->
                        <div class="logincontainer-signupbuttoncontainer">
                            <div class="logincontainer-checkboxcontainer">
                                <input type="checkbox" id="confirmpolicy" style="margin:0;padding:0" required>
                                <p style="text-decoration: none;">
                                    I agree to the
                                    <a href="{{ route('terms') }}" target="_blank"
                                        style="text-decoration: underline; color: inherit;">
                                        terms & policy
                                    </a>
                                </p>
                            </div>
                            <button type="submit" id="loginSubmitBtn">
                                <span class="btn-text">Sign In</span>
                                <span class="btn-loader" style="display: none;"></span>
                            </button>
                        </div>

                        <?php $googleIcon = 'assets/images/googleicon.png'; ?>
                        <?php $appleIcon = 'assets/images/appleicon.png'; ?>
                    </form>

                    <!-- Sign In with Google/Apple -->
                    <div class="logincontainer-anotherresources">
                        <p class="or-divider">or</p>
                        <div class="googlesigninbuttoncontainer">
                            <button class="googlesigninbutton" onclick="window.location.href='/auth/google'">
                                <img src="{{ asset('assets/images/googleicon.png') }}" alt="Google logo"> Sign in with
                                Google

                            </button>

                            <!-- <button class="iossigninbutton">
                                                            <img src="http://localhost:8000/assets/images/appleicon.png" alt="Apple logo"> Sign in with Apple
                                                        </button> -->
                        </div>

                        <!-- New User Sign Up Option -->
                        <div class="logincontainer-signinoption">
                            <p>New here? </p>
                            <span onclick="window.location.href='/signup'">Sign Up</span>
                        </div>
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
                        <div id="forgot-email-error" class="forgot-password-popup-error" style="display: none; color: red;">
                        </div>
                        <button type="submit">Send reset link</button>
                        <div id="forgot-password-status" class="forgot-password-popup-status" style="display: none;"></div>
                    </form>
                    <div class="forgot-password-popup-footer">
                        Remember your password? <a href="/login" onclick="hideForgotPasswordPopup()">Login</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('session_expired'))
                    alert("{{ session('session_expired') }}");
                    logoutSession();
                @endif
            });

            const passwordInput = document.getElementById('loginpasswordID');
            const passwordIcon = document.querySelector('.passwordClose');
            const forgotPasswordLink = document.querySelector('.forgot-password-login');
            let passwordView = false;

            passwordIcon?.addEventListener('click', function() {
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

            // Function to toggle label visibility based on input content
            function toggleLabelVisibility(input) {
                const label = input.previousElementSibling;
                const className = input.id === 'loginname' ? 'login-name-label' : 'login-password-label';
                if (input.value.length > 0) {
                    label.classList.add(className);
                } else {
                    label.classList.remove(className);
                }
            }

            // Add input event listeners for real-time label visibility
            document.getElementById('loginname').addEventListener('input', function() {
                toggleLabelVisibility(this);
            });



            // Function to handle logout session
            function logoutSession() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]');

                if (csrfToken) {
                    fetch('/api/session-logout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                window.location.href = '/login';
                            } else {
                                throw new Error('Logout failed');
                            }
                        })
                        .catch(error => {
                            console.error('Logout failed:', error);
                            alert('An error occurred during logout.');
                        });
                } else {
                    console.error('CSRF token not found');
                }
            }

            // Login form submit handler
            function loginSubmitForm(event) {
                event.preventDefault();

                const loginName = document.getElementById("loginname").value;
                const loginPassword = document.getElementById("loginpasswordID").value;
                const confirmPolicy = document.getElementById("confirmpolicy");
                const submitBtn = document.getElementById("loginSubmitBtn");
                const btnText = submitBtn.querySelector(".btn-text");
                const btnLoader = submitBtn.querySelector(".btn-loader");

                if (!confirmPolicy.checked) {
                    alert("You must agree to the terms & policy");
                    return;
                }

                const loginFormData = {
                    loginName: loginName,
                    loginPassword: loginPassword,
                };

                const csrfToken = document.querySelector('meta[name="csrf-token"]'); // ✅ Now declared
                if (csrfToken) {
                    submitBtn.disabled = true;
                    btnLoader.style.display = "inline-block";
                    btnText.style.opacity = 0.5;

                    fetch('/api/loginformdata', {
                            method: 'POST',
                            credentials: 'same-origin', // ✅ Ensures cookies are sent
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                            },
                            body: JSON.stringify(loginFormData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                alert(data.message);
                                switch (data.role) {
                                    case 'superadmin':
                                    case 'admin':
                                        window.location.href = '/admin-page';
                                        break;
                                    case 'scuser':
                                        window.location.href = '/sc-dashboard';
                                        break;
                                    case 'user':
                                        window.location.href = '/student-dashboard';
                                        break;
                                    case 'nbfc':
                                        window.location.href = '/nbfc-dashboard';
                                        break;
                                    default:
                                        alert("Unknown role. Please contact support.");
                                }
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("An error occurred during login.");
                        })
                        .finally(() => {
                            submitBtn.disabled = false;
                            btnLoader.style.display = "none";
                            btnText.style.opacity = 1;
                        });

                } else {
                    console.error('CSRF token not found');
                }
            }


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
                event.preventDefault(); // Prevent default form submission

                const emailInput = document.getElementById("forgot-email");
                const emailError = document.getElementById("forgot-email-error");
                const statusMessage = document.getElementById("forgot-password-status");
                const loginName = emailInput.value.trim();

                // Simple email format validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(loginName)) {
                    emailError.textContent = "Please enter a valid email address.";
                    emailError.style.display = "block";
                    statusMessage.style.display = "none";
                } else {
                    emailError.style.display = "none";

                    fetch('/api/send-reset-link', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                loginName
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Email is working and reset link sent!");
                                statusMessage.textContent = "Reset link sent successfully!";
                                statusMessage.style.color = "green";
                            } else {
                                statusMessage.textContent = data.message || "User not found.";
                                statusMessage.style.color = "red";
                            }
                            statusMessage.style.display = "block";
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            statusMessage.textContent = "Something went wrong. Please try again later.";
                            statusMessage.style.color = "red";
                            statusMessage.style.display = "block";
                        });
                }
            }

            // Example of logout button event (to trigger manually)
            const logoutButton = document.getElementById('logoutButton'); // Add your actual logout button ID here
            logoutButton?.addEventListener('click', function() {
                logoutSession();
            });
        </script>

    @endsection
</body>

</html>
