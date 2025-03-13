<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/studentformquestionair.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="assets/css/studentformquestionair.css">


</head>

<body>
    <nav class="nav"
        style="@if (request()->is('/')) position: absolute; top: 0; left: 0; width: 100%; z-index: 10; @else position: relative; @endif">
        <div class="{{ Request::is('/') ? 'nav-container' : 'nav-container fullopacity' }}">
            @php
$navImgPath = "assets/images/Remitoutcolored.png";
$navImgPathWhite = "assets/images/RemitoutLogoWhite.png";
$NotificationBell = "assets/images/notifications_unread.png";
            @endphp

            <img onclick="window.location.href='{{ url(' ') }}'"
                src="{{ asset(Request::is('/') ? $navImgPathWhite : $navImgPath) }}" alt="Logo" class="logo"
                id="profile-logo">


            <div class="nav-links">
                <a class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}" href="{{url('/')}}">Home</a>
                <a href="#resources" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Resources</a>
                <a href="#deals" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Special Deals</a>
                <a href="#services" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Our Service</a>
                <a href="#schedule" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Schedule Call</a>
            </div>

            @if(session()->has('user'))
                <div class="nav-searchnotificationbars">
                    <div class="input-container">
                        <input type="text" placeholder="Search">
                        <img src="assets/images/search.png" class="search-icon" alt="Search Icon">
                    </div>
                    <img src="{{ $NotificationBell }}" style="width:24px;height:24px" class="unread-notify" alt="">

                    <div class="nav-profilecontainer" id="notification-userprofile-section">
                        <img src="{{ asset('assets/images/Icons/account_circle.png') }}" id="nav-profile-photo-id"
                            class="nav-profileimg" alt="Profile Image">
                        <h3>{{ session('user')->name }}</h3>
                        <i class="fa-solid fa-chevron-down" style="cursor:pointer;"></i>
                        <div class="popup-notify-list" style="display:none">
                            <p id="change-password-trigger">Change Password</p>
                            <p>Logout</p>
                        </div>
                    </div>

                    <div class=" menubarcontainer-profile" id="user-dashboard-menu">
                        <img src="{{ asset('assets/images/Icons/menu.png') }}" alt="">
                    </div>
                </div>
            @elseif(session()->has('scuser'))
                <div class="nav-searchnotificationbars">
                    <div class="input-container">
                        <input type="text" placeholder="Search">
                        <img src="assets/images/search.png" class="search-icon" alt="Search Icon">
                    </div>
                    <img src="{{ $NotificationBell }}" style="width:24px;height:24px" class="unread-notify" alt="">

                    <div class="nav-profilecontainer">
                        <img src="{{ asset('assets/images/Icons/account_circle.png') }}" id="nav-profile-photo-id"
                            class="nav-profileimg" alt="Profile Image">
                        <h3 style='width:100%'>{{ session('scuser')->full_name }}</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                        <div class="popup-notify-list" style="display:none">
                            <p id="change-password-trigger">Change Password</p>
                            <p>Logout</p>
                        </div>
                    </div>

                    <div class="menubarcontainer-profile" id="scuser-dashboard-menu">
                        <img src="{{ asset('assets/images/Icons/menu.png') }}" onclick="menuopenclose()" alt="">
                    </div>
                </div>

            @else
                <div class="nav-buttons">
                    <button class="login-btn" onclick="window.location.href='{{ route('login') }}'">Log In</button>
                    <button class="signup-btn" onclick="window.location.href='{{ route('signup') }}'">Sign Up</button>
                </div>
            @endif


            <div class="profile-photo-mobtab" style="display:none">
                <img src="" id="nav-profile-photo-id" class="nav-profileimg" alt="">
            </div>

            <div class="menu-icon" id="menu-icon">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <div class="password-change-container">
        <div class="password-change-triggered-view-headersection">
            <h3>Password Change Request</h3>
            <img src="{{ asset('assets/images/Icons/close_small.png') }}" style="cursor:pointer" alt="">
        </div>
        <input type="password" placeholder="Current Password" id="current-password">
        <span id="current-password-error" class="error-message"></span>

        <input type="password" placeholder="New Password" id="new-password">
        <span id="new-password-error" class="error-message"></span>

        <input type="password" placeholder="Confirm New Password" id="confirm-new-password">
        <span id="confirm-password-error" class="error-message"></span>

        <div class="footer-passwordchange">
            <a href="">Forgot Password</a>

            <button id="password-change-save">Save</button>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            dynamicChangeNavMob();
            userPopopuOpen();
            passwordChangeCheck();
            passwordModelTrigger();





            const navButtons = document.querySelector(".nav-buttons");
            var currentRoute = window.location.pathname;
            console.log('Current Route:', currentRoute);
            @if(session('scuser'))
                retrieveProfilePictureNavSc();
            @elseif(session('user'))
                retrieveProfilePictureNav();
            @endif


            console.log('Route after retrieveProfilePictureNav:', currentRoute);

            if (currentRoute.includes("/student-dashboard") || currentRoute.includes("/student-forms") || currentRoute.includes("/sc-dashboard")) {
                console.log('Dashboard or Forms detected');
                if (window.innerWidth <= 420) {
                    document.querySelector('.nav-searchnotificationbars').style.display = "none";
                    document.querySelector('.profile-photo-mobtab').style.display = "block";
                } else {
                    document.querySelector('.nav-searchnotificationbars').style.display = "flex";
                    document.querySelector('.profile-photo-mobtab').style.display = "none";
                }
                document.querySelector('.nav-links').style.display = "none";
                if (navButtons) {
                    navButtons.style.display = "none";


                }
            } else {
                console.log('Other route detected');
                document.querySelector('.nav-searchnotificationbars').style.display = "none";
                document.querySelector('.nav-links').style.display = "flex";
                if (navButtons) {
                    navButtons.style.display = "flex";


                }
            }
        });

        function menuopenclose() {
            const triggeredSideBar = document.querySelector(".commonsidebar-togglesidebar");
            const img = document.querySelector("#scuser-dashboard-menu img");
            if (img.src.includes("menu.png")) {
                img.src = '{{ asset('assets/images/Icons/close_icon.png') }}';
                triggeredSideBar.style.display = 'flex';
            } else if (img.src.includes("close_icon.png")) {
                img.src = '{{ asset('assets/images/Icons/menu.png') }}';
                triggeredSideBar.style.display = 'none';
            }

        }

        const retrieveProfilePictureNav = async () => {
            const userSession = @json(session('user'));
            const userId = userSession.unique_id;
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            try {
                const response = await fetch('/retrieve-profile-picture', {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ userId: userId })
                });

                const data = await response.json();

                if (data.fileUrl) {
                    console.log("Profile Picture URL:", data.fileUrl);
                    profileImgUpdate.src = data.fileUrl;
                    mobTabProfile.src = data.fileUrl;
                } else {
                    console.error("Error: No URL returned from the server", data);
                }
            } catch (error) {
                console.error("Error retrieving profile picture", error);
            }
        };

        const retrieveProfilePictureNavSc = async () => {
            const userSession = @json(session('scuser'));
            const scuserrefid = userSession.referral_code;
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            try {
                const response = await fetch('/view-scuserprofile-photo', {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ scuserrefid: scuserrefid })
                });

                const data = await response.json();

                if (data.fileUrl) {
                    console.log("Profile Picture URL:", data.fileUrl);
                    profileImgUpdate.src = data.fileUrl;
                    mobTabProfile.src = data.fileUrl;
                } else {
                    console.error("Error: No URL returned from the server", data);
                }
            } catch (error) {
                console.error("Error retrieving profile picture", error);
            }
        }

        const dynamicChangeNavMob = () => {
            const searchTextBoxProfile = document.querySelector(".nav-searchnotificationbars .input-container");
            const unreadNofifyProfile = document.querySelector(".nav-searchnotificationbars .unread-notify");
            const nameFromProfile = document.querySelector(".nav-searchnotificationbars .nav-profilecontainer h3");
            const iconFromProfile = document.querySelector(".nav-searchnotificationbars .nav-profilecontainer i");
            const menuBarFromProfile = document.querySelector(".menubarcontainer-profile img")

            if (window.innerWidth <= 640) {
                searchTextBoxProfile.style.display = "none";
                unreadNofifyProfile.style.display = "none";
                nameFromProfile.style.display = "none";
                iconFromProfile.style.display = "none";
                menuBarFromProfile.style.display = "block";
            } else {
                searchTextBoxProfile.style.display = "block";
                unreadNofifyProfile.style.display = "block";
                nameFromProfile.style.display = "block";
                iconFromProfile.style.display = "block";
                menuBarFromProfile.style.display = "none";
            }
        };

        window.addEventListener("resize", () => {
            dynamicChangeNavMob();
        });




        const userPopopuOpen = () => {
            const userPopupTrigger = document.querySelector(".nav-profilecontainer i");
            const userPopupList = document.querySelector(".popup-notify-list");

            if (userPopupTrigger) {
                userPopupTrigger.addEventListener('click', () => {
                    if (userPopupTrigger.classList.contains("fa-chevron-down")) {
                        userPopupTrigger.classList.remove("fa-chevron-down");
                        userPopupTrigger.classList.add("fa-chevron-up");
                        userPopupList.style.display = "flex";
                    } else {
                        userPopupTrigger.classList.remove("fa-chevron-up");
                        userPopupTrigger.classList.add("fa-chevron-down");
                        userPopupList.style.display = "none";

                    }
                });


            }
        }
        function getCookie(name) {
            let value = "; " + document.cookie;
            let parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }

        const passwordChangeCheck = () => {
            document.getElementById('password-change-save').addEventListener('click', function () {
                let currentPassword = document.getElementById('current-password').value.trim();
                let newPassword = document.getElementById('new-password').value.trim();
                let confirmNewPassword = document.getElementById('confirm-new-password').value.trim();
                const passwordChangeContainer = document.querySelector(".password-change-container");



                clearErrorMessages();
                let valid = true;

                if (!currentPassword) {
                    displayError('current-password-error', 'Current password cannot be empty.');
                    valid = false;
                }

                if (!newPassword) {
                    displayError('new-password-error', 'New password cannot be empty.');
                    valid = false;
                } else if (newPassword.length < 8) {
                    displayError('new-password-error', 'New password must be at least 8 characters long.');
                    valid = false;
                }

                if (newPassword !== confirmNewPassword) {
                    displayError('confirm-password-error', 'Passwords do not match.');
                    valid = false;
                }

                if (!valid) return;

                console.log('Password change request is valid.');
                const hasScUserSession = {{ session()->has('scuser') ? 'true' : 'false' }};
                const hasUserSession = {{ session()->has('user') ? 'true' : 'false' }};

                let userId = '';
                if (hasScUserSession === true) {

                    const User = JSON.parse(`{!! json_encode(session('scuser')) !!}`);

                     userId = User.referral_code;

                } else if (hasUserSession === true) {

                    const User = JSON.parse(`{!! json_encode(session('user')) !!}`);

                     userId = User.unique_id;

                } else {
                    console.log("No user session found.");
                }





                const passwordChangeVariables = {
                    userId,
                    currentPassword,
                    newPassword
                };


                fetch("/passwordchange", {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
                    },
                    body: JSON.stringify(passwordChangeVariables)
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            console.log("Password changed successfully");
                            alert("Password updated successfully.");

                            if (passwordChangeContainer) {
                                passwordChangeContainer.style.display = "none";
                                document.getElementById('current-password').value = '';
                                document.getElementById('new-password').value = '';
                                document.getElementById('confirm-new-password').value = '';
                            }
                        } else {
                            console.error("Error:", data.message);
                            alert(data.message);
                        }
                    })
                    .catch((error) => {
                        console.error("Fetch error:", error);
                        alert("An unexpected error occurred.");
                    });
            });
        };

        function displayError(elementId, message) {
            var errorElement = document.getElementById(elementId);
            errorElement.innerText = message;
            errorElement.style.display = 'block';
        }

        function clearErrorMessages() {
            var errorElements = document.getElementsByClassName('error-message');
            for (var i = 0; i < errorElements.length; i++) {
                errorElements[i].innerText = '';
                errorElements[i].style.display = 'none';
            }
        }

        const passwordModelTrigger = () => {
            const passwordTrigger = document.getElementById("change-password-trigger");
            const passwordChangeContainer = document.querySelector(".password-change-container");
            const passwordContainerExit = document.querySelector(".password-change-container .password-change-triggered-view-headersection img");
            const popupPasswordShow = document.querySelector(".popup-notify-list");
            const arrowUp = document.querySelector(".nav-profilecontainer i");

            if (passwordTrigger) {
                passwordTrigger.addEventListener("click", () => {
                    if (passwordChangeContainer) {
                        passwordChangeContainer.style.display = "flex";
                    }
                    if (popupPasswordShow) {
                        popupPasswordShow.style.display = "none";

                    }
                    if (arrowUp.classList.contains('fa-chevron-up')) {
                        arrowUp.classList.remove("fa-chevron-up");
                        arrowUp.classList.add("fa-chevron-down");
                        arrowUp.style.display = "flex";
                    }


                })
            }
            if (passwordContainerExit) {
                passwordContainerExit.addEventListener("click", () => {
                    if (passwordChangeContainer) {
                        passwordChangeContainer.style.display = "none";
                        document.getElementById('current-password').value = '';
                        document.getElementById('new-password').value = '';
                        document.getElementById('confirm-new-password').value = '';
                        clearErrorMessages();

                    }
                })
            }

        }


    </script>

</body>

</html>