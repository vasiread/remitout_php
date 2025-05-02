<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @section('title', 'Sign Up')

    @section('signupcontent')
            <?php  
                                        $loginSignupImage = "assets/images/loginsignupimg.png";
        $loginSignupvectorOne = "assets/images/downsideloginimg.png";
        $profileCardVectorWhite = "assets/images/profileCardVector-white.png";
        $signupmainimgupside = "assets/images/signupmainimgupside.png";
                                        ?>

            <div class="loginsignupcontainer">
                <div class="loginsingupcontainer-leftpanel">
                    <img class="loginsingupmainimg" src="<?php echo $loginSignupImage; ?>" alt="">
                    <img class="downsideloginimg" src="<?php echo $loginSignupvectorOne; ?>" alt="">
                    <img class="profileCardVector-white" src="<?php echo $profileCardVectorWhite; ?>" alt="">
                    <img class="signupmainimgupside" src="<?php echo $signupmainimgupside; ?>" alt="">
                    <div class="hiddencontainer"></div>
                    <h1 class="loginsingupimagecontainer-header">Lorem ipsum dolor sit amet, consectur adipiscing elit</h1>
                </div>

                <div class="loginsingupcontainer-rightpanel" style="display:flex;">
                    <img src="assets/images/loginsinguprightsideimg.png" class="rightsidevector-img" alt="">
                    <h1>Get Started Now</h1>
                    <form class="loginsingupcontainer-rightpanel-inside" id="signupForm" onsubmit="submitForm(event)">
                        <div class="rightpanel-namecontainer">
                            <input type="text" name="name" id="name" placeholder="Name (as per Aadhar)" required>
                        </div>
                        <div class="rightpanel-phonecontainer">
                            <input type="text" name="phone" id="phone" placeholder="Phone" required>
                        </div>
                        <div class="rightpanel-emailcontainer">
                            <input type="text" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="rightpanel-passwordcontainer">
                            <input type="password" id="passwordinputID" name="password" class="passwordOpen"
                                placeholder="Password" required>
                            <i class="fa-regular fa-eye-slash passwordClose" style="cursor: pointer;"></i>
                        </div>
                        <div class="rightpanel-signupbuttoncontainer">
                            <div class="rightpanel-checkboxcontainer">
                                <input type="checkbox" name="confirmpolicy" id="confirmpolicy" style="margin:0;padding:0px"
                                    required>
                                <p>I agree to the <span>terms & policy</span></p>
                            </div>
                            <button type="submit">Sign up</button>
                        </div>
                        <!-- <div class="googlesigninbuttoncontainer">
                                                            <button class="googlesigninbutton" onclick="window.location.href='{{ route('google-auth') }}'">
                                                                <img src="{{ asset('assets/images/googleicon.png') }}"> Sign in with Google
                                                            </button>
                                                            <button class="iossigninbutton">
                                                                <img src="{{ asset('assets/images/appleicon.png') }}"> Sign in with Apple
                                                            </button>
                                                        </div> -->
                    </form>
                    <div class="logincontainer-anotherresources">
                        <p>Or</p>
                        <div class="googlesigninbuttoncontainer">
                            <button class="googlesigninbutton" onclick="window.location.href='{{ route('google.login') }}'">
                                <img src="{{ asset('assets/images/googleicon.png') }}"> Sign in with Google
                            </button>
                            <!-- <button class="iossigninbutton">
                                                <img src="{{ asset('assets/images/appleicon.png') }}"> Sign in with Apple
                                            </button> -->
                        </div>
                        <div class="logincontainer-signinoption">
                            <p>Have an account? </p>
                            <span onclick="window.location.href='{{ route('login') }}'">Sign In</span>
                        </div>
                    </div>

                </div>


                <!-- OTP Section -->
                <div class="loginsignupcontainer-otppanel" style="display:none">
                    <div class="loginsignupcontainer-otppanel-inside">
                        <h1>Enter the OTP</h1>

                        <div class="otppanel-mainsection">
                            <p>Do not share your OTP!</p>

                            <div class="otpinputcontainer">
                                <input type="text" class="otp-input" maxlength="1"
                                    oninput="restrictToNumbers(this); moveFocus(this, 'otp2')" id="otp1">
                                <input type="text" class="otp-input" maxlength="1"
                                    oninput="restrictToNumbers(this); moveFocus(this, 'otp3')" id="otp2">
                                <input type="text" class="otp-input" maxlength="1"
                                    oninput="restrictToNumbers(this); moveFocus(this, 'otp4')" id="otp3">
                                <input type="text" class="otp-input" maxlength="1"
                                    oninput="restrictToNumbers(this); moveFocus(this, 'otp5')" id="otp4">
                                <input type="text" class="otp-input" maxlength="1"
                                    oninput="restrictToNumbers(this); moveFocus(this, 'otp6')" id="otp5">
                                <input type="text" class="otp-input" maxlength="1" oninput="restrictToNumbers(this)" id="otp6">
                            </div>

                            <button onclick="checkOTP()">Verify</button>
                        </div>

                    </div>

                </div>


            </div>

            <script>
                let generatedOTP = '';
                let registerFormData = {};

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

                window.onload = function () {
                    document.getElementById('otp1').focus();

                }

                function triggerOtpSection() {

                    const nameInput = document.querySelector('.rightpanel-namecontainer input');
                    const phoneInput = document.querySelector('.rightpanel-phonecontainer input');
                    const emailInput = document.querySelector('.rightpanel-emailcontainer input');
                    const passwordInput = document.querySelector('.rightpanel-passwordcontainer input');
                    const checkbox = document.getElementById('confirmpolicy');

                    if (nameInput.value !== '' && phoneInput.value !== '' && emailInput.value !== '' && passwordInput.value !== '' && checkbox.checked) {
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
                    } else {
                        alert("Fields are Required");
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
                                return response.text().then(text => { throw new Error(text) });
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
                    // Get the OTP values from input fields
                    const otp1 = document.getElementById('otp1').value;
                    const otp2 = document.getElementById('otp2').value;
                    const otp3 = document.getElementById('otp3').value;
                    const otp4 = document.getElementById('otp4').value;
                    const otp5 = document.getElementById('otp5').value;
                    const otp6 = document.getElementById('otp6').value;

                    // Ensure all OTP fields are filled
                    if (!otp1 || !otp2 || !otp3 || !otp4 || !otp5 || !otp6) {
                        alert('Please fill all OTP fields');
                        return;
                    }

                    // Combine OTP values
                    const finalOTP = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;

                    // Get the phone number and CSRF token
                    const phoneInput = document.getElementById('phone');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    console.log('Phone:', phoneInput.value, 'OTP:', finalOTP);


                    // Prepare the data to send
                    const mailOtpdata = {
                        phone: phoneInput.value,
                        otp: finalOTP
                    };
                    console.log(JSON.stringify(mailOtpdata));


                    // Send the request to the backend
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
                                // Call the function to handle the next step (like submitting verified data)
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

                    if (!confirmPolicy) {
                        alert("You must agree to the terms & policy");
                        return;
                    }

                    if (password.length < 6) {
                        alert("Password length should be at least 6 characters");
                        return;
                    }

                    fetch("/emailuniquecheck", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ email: email })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Response data:', data);
                            if (data.success === false) {
                                alert(data.message);
                            } else if (data.success === true) {


                                submitVerifiedData();

                                // triggerOtpSection();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }























                function submitVerifiedData() {
                    const registerFormData = {
                        name: document.getElementById('name').value,
                        phoneInput: document.getElementById('phone').value,
                        email: document.getElementById('email').value,
                        password: document.getElementById('passwordinputID').value,
                    };
                    console.log(registerFormData)

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