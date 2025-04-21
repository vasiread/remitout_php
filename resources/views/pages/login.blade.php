<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset("assets/css/login.css") }}" />
</head>

<body>
    @extends('layouts.app')
    @section('title', 'Login')

    @section('logincontent')
        <div class="logincontainer">

            <img class="loginvector" src="{{asset("assets/images/loginvector.png")}}" alt="">
            <img class="loginvectorsecond" src="{{asset("assets/images/loginvectorsecond.png")}}" alt="">
            <div class="logincontainer-inside">
                <div class="logincontainer-leftinside">
                    <img src="assets/images/Pexels Photo by Buro Millennial.png" alt="">
                </div>
                <div class="logincontainer-rightinside">
                    <h1>Welcome back!</h1>
                    <form class="logincontainer-loginresources" id="loginForm" onsubmit="loginSubmitForm(event)">
                        <img src="assets/images/loginsinguprightsideimg.png" class="loginrightsidevector-img" alt="">



                        <!-- Username and Password Fields -->
                        <div class="logincontainer-namecontainer">
                            <input type="text" placeholder="Unique ID" name="name" id="loginname">
                        </div>
                        <div class="logincontainer-passwordcontainer">
                            <input type="password" placeholder="Password" id="loginpasswordID" name="password">
                            <i class="fa-regular fa-eye-slash passwordClose" id="loginpasswordeyecloseicon"
                                style="cursor: pointer;"></i>
                        </div>
                        <!-- User Type Selection -->
                        <div class="logincontainer-usertypecontainer">
                            <h3>Select Login Type:</h3>
                            <div class="logincontainer-radiooptions">
                                <div class="radiooptions-users">
                                    <input type="radio" id="user" name="loginType" value="User" required>
                                    <label for="user">User</label>
                                </div>
                                <div class="radiooptions-users">
                                    <input type="radio" id="student-counsellor" name="loginType" value="Student Counsellor"
                                        required>
                                    <label for="student-counsellor">SC user</label><br>

                                </div>

                                <div class="radiooptions-users">
                                    <input type="radio" id="nbfc" name="loginType" value="NBFC" required>
                                    <label for="nbfc">NBFC</label>
                                </div>


                                <div class="radiooptions-users">
                                    <input type="radio" id="admin" name="loginType" value="Admin" required>
                                    <label for="admin">Admin</label>
                                </div>


                            </div>
                        </div>

                        <!-- Agree to Terms and Sign-In Button -->
                        <div class="logincontainer-signupbuttoncontainer">
                            <div class="logincontainer-checkboxcontainer">
                                <input type="checkbox" id="confirmpolicy" style="margin:0;padding:0px" required>
                                <p>I agree to the <span>terms & policy</span></p>
                            </div>
                            <button type="submit">Sign In</button>
                        </div>

                        <?php $googleIcon = "assets/images/googleicon.png" ?>
                        <?php $appleIcon = "assets/images/appleicon.png" ?>
                    </form>

                    <!-- Sign In with Google/Apple -->
                    <div class="logincontainer-anotherresources">
                        <p>Or</p>
                        <div class="googlesigninbuttoncontainer">
                            <button class="googlesigninbutton" onclick="window.location.href='{{ route('google-auth') }}'">
                                <img src="{{ asset('assets/images/googleicon.png') }}"> Sign in with Google
                            </button>
                            <button class="iossigninbutton">
                                <img src="{{ asset('assets/images/appleicon.png') }}"> Sign in with Apple
                            </button>
                        </div>

                        <!-- New User Sign Up Option -->
                        <div class="logincontainer-signinoption">
                            <p>New here? </p>
                            <span onclick="window.location.href='{{ route('signup') }}'">Sign Up</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if (session('session_expired'))
                    alert("{{ session('session_expired') }}");
                    logoutSession();
                @endif
                                                        });

            const passwordInput = document.getElementById('loginpasswordID');
            const passwordIcon = document.querySelector('.passwordClose');
            let passwordView = false;

            passwordIcon?.addEventListener('click', function () {
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

            // Function to handle logout session
            function logoutSession() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]');

                if (csrfToken) {
                    fetch('/session-logout', {
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
                const loginType = document.querySelector('input[name="loginType"]:checked').value;


                if (!confirmPolicy.checked) {
                    alert("You must agree to the terms & policy");
                    return;
                }

                const loginFormData = {
                    loginName: loginName,
                    loginPassword: loginPassword,
                    loginType: loginType,

                };

                const csrfToken = document.querySelector('meta[name="csrf-token"]');

                if (csrfToken) {
                    fetch('/loginformdata', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                        },
                        body: JSON.stringify(loginFormData)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.href = data.redirect




                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("An error occurred during login.");
                        });
                } else {
                    console.error('CSRF token not found');
                }
            }

            // Example of logout button event (to trigger manually)
            const logoutButton = document.getElementById('logoutButton');  // Add your actual logout button ID here
            logoutButton?.addEventListener('click', function () {
                logoutSession();
            });
        </script>


    @endsection
</body>

</html>