<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')
    @section('title', 'Login')

    @section('logincontent')
    <div class="logincontainer">
        <div class="logincontainer-inside">
            <div class="logincontainer-leftinside">
                <img src="assets/images/Pexels Photo by Buro Millennial.png" alt="">
            </div>
            <div class="logincontainer-rightinside">
                <h1>Welcome back!</h1>
                <form class="logincontainer-loginresources" id="loginForm" onsubmit="loginSubmitForm(event)">
                    <img src="assets/images/loginsinguprightsideimg.png" class="loginrightsidevector-img" alt="">
                    <div class="logincontainer-namecontainer">
                        <input type="text" placeholder="Name" name="name" id="loginname">
                    </div>
                    <div class="logincontainer-passwordcontainer">
                        <input type="password" placeholder="Password" id="loginpasswordID" name="password">
                        <i class="fa-regular fa-eye-slash passwordClose" id="loginpasswordeyecloseicon"
                            style="cursor: pointer;"></i>
                    </div>
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
                <div class="logincontainer-anotherresources">
                    <p>Or</p>
                    <div class="googlesigninbuttoncontainer">
                        <button class="googlesigninbutton">
                            <img src="{{ asset('assets/images/googleicon.png') }}"> Sign in with Google
                        </button>
                        <button class="iossigninbutton">
                            <img src="{{ asset('assets/images/appleicon.png') }}"> Sign in with Apple
                        </button>
                    </div>
                    <div class="logincontainer-signinoption">
                        <p>New here? </p>
                        <span onclick="window.location.href='{{ route('signup') }}'">Sign Up</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if (session('session_expired'))
            alert("{{ session('session_expired') }}");
        @endif
        const passwordInput = document.getElementById('loginpasswordID');
        const passwordIcon = document.querySelector('.passwordClose');
        let passwordView = false;

        passwordIcon.addEventListener('click', function () {
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

        function loginSubmitForm(event) {
            event.preventDefault();

            const loginName = document.getElementById("loginname").value;
            const loginPassword = document.getElementById("loginpasswordID").value;
            const confirmPolicy = document.getElementById("confirmpolicy");



            if (!confirmPolicy.checked) {
                alert("You must agree to the terms & policy");
                return;
            }

            const loginFormData = {
                loginName: loginName,
                loginPassword: loginPassword,
            };

           fetch("{{ route('loginformdata') }}", {
                 method: 'POST',
                 headers: {
                'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(loginFormData)
            });

                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '/student-dashboard';

                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred");
                });
        };
    </script>
    @endsection
</body>

</html>