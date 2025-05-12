<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Dashboard</title>
    <!-- Include Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    <style>
        /* Navbar container */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .nav-container {
            padding: 20px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: none;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        .nav-container.fullopacity {
            background-color: #fff;
            color: rgba(38, 2, 84, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .logo {
            width: 138px;
            height: auto;
            margin-left: 50px;
            cursor: pointer;
        }

        .nav-searchnotificationbars {
            display: flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            padding: 0 1rem;
            gap: 15px;
        }

        .nav-searchnotificationbars .input-container {
            position: relative;
        }

        .nav-searchnotificationbars input {
            width: 242px;
            height: 37px;
            border-radius: 4px;
            border: 1px solid rgba(222, 222, 222, 0.7);
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 19.2px;
            padding: 0.56rem 0 0.56rem 2.85rem;
            text-align: left;
        }

        .nav-searchnotificationbars input::placeholder {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 19.2px;
            text-align: left;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            margin-right: 1rem;
        }

        .unread-notify-container {
            position: relative;
        }

        .nav-searchnotificationbars .unread-notify {
            width: 24px;
            height: 24px;
            margin: 0 1.18rem;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .nav-searchnotificationbars .unread-notify::after {
            content: '';
            background-color: red;
            position: absolute;
            top: -4px;
            right: -4px;
            width: 10px;
            height: 10px;
            z-index: 5;
            border-radius: 50%;
        }

        .unread-notify-container p {
            background-color: #FF7A00;
            position: absolute;
            top: -1px;
            right: 18px;
            display: none;
            align-items: center;
            justify-content: center;
            width: 15px;
            height: 15px;
            z-index: 5;
            font-size: 9px;
            border-radius: 50%;
            color: #fff;
        }

        .nav-profilecontainer {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            gap: 10px;
        }

        .nav-searchnotificationbars .nav-profileimg {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .nav-searchnotificationbars .nav-profileimg:hover {
            transform: scale(1.1);
        }

        .nav-searchnotificationbars h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 19.2px;
            text-align: left;
            color: rgba(38, 2, 84, 1);
            max-width: 100%;
            width: 100%;
            height: 19px;
            margin: 0 1.18rem;
        }

        .nav-searchnotificationbars i {
            color: rgba(0, 0, 0, 1);
            width: 15px;
            height: 7.4px;
            margin-bottom: 0.5rem;
            padding-right: 0.3rem;
            cursor: pointer;
        }

        .popup-notify-list {
            position: absolute;
            flex-direction: column;
            top: 100%;
            left: 12%;
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            border-radius: 5px;
            width: 116px;
            display: none;
        }

        .popup-notify-list p {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            padding: 0.3rem;
            border-radius: 4px;
            margin: 0 3px;
            color: rgba(38, 2, 84, 1);
            height: 35px;
            display: flex;
            align-items: center;
        }

        .popup-notify-list p:hover {
            background: #f9f9f9;
            cursor: pointer;
        }

        .menubarcontainer-profile {
            display: none;
            cursor: pointer;
        }

        .menubarcontainer-profile img {
            display: none;
        }

        .profile-photo-mobtab {
            display: none;
        }

        .profile-photo-mobtab img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .menu-icon {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1001;
        }

        .menu-icon .bar {
            width: 100%;
            height: 3px;
            background: #333;
            margin: 2px 0;
            transition: all 0.3s ease;
        }

        .menu-icon.menu-open .bar {
            display: none;
        }

        .menu-icon.menu-open::before {
            content: '\f00d';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 24px;
            color: #333;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Mobile sidebar */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 250px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transform: translateX(100%);
            transition: transform 0.3s ease, opacity 0.3s ease;
            z-index: 1001;
            opacity: 0;
        }

        .mobile-sidebar.active {
            transform: translateX(0);
            opacity: 1;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .sidebar-header .logo {
            width: 120px;
            margin-left: 0;
        }

        .sidebar-header .close-icon {
            cursor: pointer;
            font-size: 24px;
            color: #333;
        }

        .sidebar-menu {
            padding: 20px;
        }

        .sidebar-menu .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            color: #333;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar-menu .menu-item i {
            margin-right: 10px;
        }

        .sidebar-menu .menu-item.active {
            color: #FF7A00;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 20px;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Password change container */
        .password-change-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1002;
            width: 90%;
            max-width: 400px;
        }

        .password-change-triggered-view-headersection {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .password-change-triggered-view-headersection h3 {
            margin: 0;
        }

        .password-change-triggered-view-headersection img {
            width: 24px;
            cursor: pointer;
        }

        .password-change-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error-message {
            color: red;
            font-size: 12px;
            display: none;
            margin-bottom: 10px;
        }

        .footer-passwordchange {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .footer-passwordchange p {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            text-decoration: underline;
            padding-left: 6px;
            cursor: pointer;
            color: #0056b3;
            margin: 0;
        }

        .footer-passwordchange button {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Mobile-specific styles */
        @media (max-width: 768px) {
            .nav-container {
                padding: 20px 30px;
            }

            .nav-searchnotificationbars {
                display: none;
            }

            .profile-photo-mobtab {
                display: block;
            }

            .menu-icon {
                display: flex;
            }

            .logo {
                margin-left: 20px;
            }
        }

        @media (min-width: 769px) {
            .nav-searchnotificationbars {
                display: flex !important;
            }

            .profile-photo-mobtab {
                display: none;
            }

            .menu-icon {
                display: none;
            }

            .mobile-sidebar,
            .sidebar-overlay {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="nav-container fullopacity">
            <img onclick="window.location.href='{{ url('/') }}'" src="{{ asset('assets/images/Remitoutcolored.png') }}" alt="Logo" class="logo" id="profile-logo">

            @if(session()->has('user') || session()->has('scuser'))
                <div class="nav-searchnotificationbars">
                    <div class="input-container">
                        <input type="text" placeholder="Search">
                        <img src="{{ asset('assets/images/search.png') }}" class="search-icon" alt="Search Icon">
                    </div>
                    <div class="unread-notify-container">
                        <img src="{{ asset('assets/images/notifications_unread.png') }}" class="unread-notify" id="userNotification" alt="">
                    </div>
                    <div class="nav-profilecontainer" id="notification-userprofile-section">
                        <img src="{{ asset('assets/images/Icons/account_circle.png') }}" id="nav-profile-photo-id" class="nav-profileimg" alt="Profile Image">
                        <h3>{{ session()->has('user') ? session('user')->name : session('scuser')->full_name }}</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                        <div class="popup-notify-list" style="display:none">
                            <p id="change-password-trigger">Change Password</p>
                            <p class="logoutBtn">Logout</p>
                        </div>
                    </div>
                    <div class="menubarcontainer-profile" id="user-dashboard-menu">
                        <img src="{{ asset('assets/images/Icons/menu.png') }}" alt="">
                    </div>
                </div>
            @endif

            <div class="profile-photo-mobtab" style="display:none">
                <img src="{{ asset('assets/images/Icons/account_circle.png') }}" id="nav-profile-photo-id" class="nav-profileimg" alt="">
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
            <p href="">Forgot Password</p>
            <button id="password-change-save">Save</button>
        </div>
    </div>

    <script>
        // Define session data globally
        window.App = {
            user: @json(session('user')),
            scuser: @json(session('scuser')),
            hasScUserSession: {{ session()->has('scuser') ? 'true' : 'false' }},
            hasUserSession: {{ session()->has('user') ? 'true' : 'false' }}
        };

        // Logout function
        function sessionLogoutInitial(logoutUrl, loginUrl) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found');
                alert('Logout failed: CSRF token missing');
                return;
            }

            if (!logoutUrl || !loginUrl) {
                console.error('Missing logout or login URL');
                alert('Logout failed: Invalid URLs');
                return;
            }

            fetch(logoutUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
                .then(response => {
                    if (response.ok) {
                        window.location.href = loginUrl;
                    } else {
                        console.error('Logout failed:', response.status, response.statusText);
                        alert('Logout failed: Server error');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Logout API response data:', data);
                })
                .catch(error => {
                    console.error('Fetch error during logout:', error);
                    alert('Logout failed: Network error');
                });
        }

        // Dynamic navbar visibility for mobile
        const dynamicChangeNavMob = () => {
            const navSearchNotificationBars = document.querySelector('.nav-searchnotificationbars');
            const profilePhotoMobTab = document.querySelector('.profile-photo-mobtab');
            const menuIcon = document.getElementById('menu-icon');
            const navContainer = document.querySelector('.nav-container');

            if (window.innerWidth <= 768) {
                if (navSearchNotificationBars) navSearchNotificationBars.style.display = 'none';
                if (profilePhotoMobTab) profilePhotoMobTab.style.display = 'block';
                if (menuIcon) menuIcon.style.display = 'flex';
                if (navContainer) navContainer.style.display = 'flex';
            } else {
                if (navSearchNotificationBars) navSearchNotificationBars.style.display = 'flex';
                if (profilePhotoMobTab) profilePhotoMobTab.style.display = 'none';
                if (menuIcon) menuIcon.style.display = 'none';
                if (navContainer) navContainer.style.display = 'flex';
            }
        };

        // Function to close the sidebar
        function closeSidebar(mobileSidebar, overlay, menuIcon) {
            if (mobileSidebar && overlay && menuIcon) {
                // Immediately set opacity to 0 to prevent flickering
                mobileSidebar.style.opacity = '0';
                overlay.style.opacity = '0';

                // Remove active class to trigger transform
                mobileSidebar.classList.remove('active');
                overlay.classList.remove('active');

                // Reset body overflow
                document.body.style.overflow = '';

                // Reset menu icon
                menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                menuIcon.classList.remove('menu-open');

                // Ensure the sidebar and overlay are fully hidden after transition
                setTimeout(() => {
                    overlay.style.display = 'none';
                    mobileSidebar.style.display = 'none';
                }, 300); // Match the transition duration
            }
        }

        // Create mobile sidebar
        function createMobileSidebar() {
            let overlay = document.getElementById('sidebar-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'sidebar-overlay';
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);
            }

            let mobileSidebar = document.getElementById('mobile-sidebar');
            if (!mobileSidebar) {
                mobileSidebar = document.createElement('div');
                mobileSidebar.id = 'mobile-sidebar';
                mobileSidebar.className = 'mobile-sidebar';

                const isScUser = window.App.hasScUserSession;
                let sidebarMenuHtml = '';

                if (isScUser) {
                    sidebarMenuHtml = `
                        <div class="sidebar-header">
                            <img src="{{ asset('assets/images/Remitoutcolored.png') }}" alt="Logo" class="logo">
                            <i class="fa-solid fa-xmark close-icon"></i>
                        </div>
                        <div class="sidebar-menu">
                            <a href="/sc-dashboard" class="menu-item active">
                                <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                            </a>
                            <a href="/sc-inbox" class="menu-item">
                                <i class="fa-solid fa-inbox"></i> Inbox
                            </a>
                            <a href="/sc-applications" class="menu-item">
                                <i class="fa-regular fa-clipboard"></i> Applications
                            </a>
                        </div>
                    `;
                } else {
                    sidebarMenuHtml = `
                        <div class="sidebar-header">
                            <img src="{{ asset('assets/images/Remitoutcolored.png') }}" alt="Logo" class="logo">
                            <i class="fa-solid fa-xmark close-icon"></i>
                        </div>
                        <div class="sidebar-menu">
                            <a href="/student-dashboard" class="menu-item active">
                                <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                            </a>
                            <a href="/student-inbox" class="menu-item">
                                <i class="fa-solid fa-inbox"></i> Inbox
                            </a>
                            <a href="/student-applications" class="menu-item">
                                <i class="fa-regular fa-clipboard"></i> My Applications
                            </a>
                        </div>
                    `;
                }

                mobileSidebar.innerHTML = `
                    ${sidebarMenuHtml}
                    <div class="sidebar-footer">
                        <a href="javascript:void(0)" class="menu-item logoutBtn" onclick="sessionLogoutInitial('{{ route('logout') }}', '{{ route('login') }}')">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                        </a>
                        <a href="/support" class="menu-item">
                            <img src="{{ asset('assets/images/Icons/support_agent.png') }}" alt=""> Support
                        </a>
                    </div>
                `;

                document.body.appendChild(mobileSidebar);

                const menuIcon = document.getElementById('menu-icon');

                // Add close functionality to the X icon
                const closeIcon = mobileSidebar.querySelector('.close-icon');
                if (closeIcon) {
                    closeIcon.addEventListener('click', function () {
                        closeSidebar(mobileSidebar, overlay, menuIcon);
                        const navContainer = document.querySelector('.nav-container');
                        if (navContainer) {
                            navContainer.style.display = 'flex';
                        }
                    });
                }

                // Overlay click to close
                overlay.addEventListener('click', function () {
                    closeSidebar(mobileSidebar, overlay, menuIcon);
                    const navContainer = document.querySelector('.nav-container');
                    if (navContainer) {
                        navContainer.style.display = 'flex';
                    }
                });
            }
        }

        // Display error messages
        function displayError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.innerText = message;
                errorElement.style.display = 'block';
            }
        }

        // Clear error messages
        function clearErrorMessages() {
            const errorElements = document.getElementsByClassName('error-message');
            for (let i = 0; i < errorElements.length; i++) {
                errorElements[i].innerText = '';
                errorElements[i].style.display = 'none';
            }
        }

        // Retrieve profile picture for user
        const retrieveProfilePictureNav = async () => {
            const userSession = window.App.user;
            if (!userSession || !userSession.unique_id) {
                return;
            }
            const userId = userSession.unique_id;
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) {
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
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                if (data.fileUrl) {
                    if (profileImgUpdate) profileImgUpdate.src = data.fileUrl;
                    if (mobTabProfile) mobTabProfile.src = data.fileUrl;
                } else {
                    const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                    if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                    if (mobTabProfile) mobTabProfile.src = fallbackImage;
                }
            } catch (error) {
                const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                if (mobTabProfile) mobTabProfile.src = fallbackImage;
            }
        };

        // Retrieve profile picture for scuser
        const retrieveProfilePictureNavSc = async () => {
            const userSession = window.App.scuser;
            if (!userSession || !userSession.referral_code) {
                return;
            }
            const scuserrefid = userSession.referral_code;
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) {
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
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                if (data.fileUrl) {
                    if (profileImgUpdate) profileImgUpdate.src = data.fileUrl;
                    if (mobTabProfile) mobTabProfile.src = data.fileUrl;
                } else {
                    const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                    if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                    if (mobTabProfile) mobTabProfile.src = fallbackImage;
                }
            } catch (error) {
                const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                if (mobTabProfile) mobTabProfile.src = fallbackImage;
            }
        };

        // User popup toggle
        const userPopopuOpen = () => {
            const userPopupTrigger = document.querySelector(".nav-profilecontainer i");
            const userPopupList = document.querySelector(".popup-notify-list");

            if (userPopupTrigger && userPopupList) {
                userPopupTrigger.addEventListener('click', (event) => {
                    event.stopPropagation();
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

                document.addEventListener('click', (event) => {
                    const isClickInsideTrigger = userPopupTrigger.contains(event.target);
                    const isClickInsidePopup = userPopupList.contains(event.target);

                    if (!isClickInsideTrigger && !isClickInsidePopup && userPopupList.style.display === "flex") {
                        userPopupTrigger.classList.remove("fa-chevron-up");
                        userPopupTrigger.classList.add("fa-chevron-down");
                        userPopupList.style.display = "none";
                    }
                });
            }
        };

        // Password change validation
        const passwordChangeCheck = () => {
            const saveButton = document.getElementById('password-change-save');
            if (saveButton) {
                saveButton.addEventListener('click', function () {
                    const currentPassword = document.getElementById('current-password').value.trim();
                    const newPassword = document.getElementById('new-password').value.trim();
                    const confirmNewPassword = document.getElementById('confirm-new-password').value.trim();
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

                    let userId = '';
                    if (window.App.hasScUserSession) {
                        const scUserSession = window.App.scuser;
                        if (scUserSession && scUserSession.referral_code) {
                            userId = scUserSession.referral_code;
                        } else {
                            console.error("No valid scuser session data.");
                            alert("Session data is invalid.");
                            return;
                        }
                    } else if (window.App.hasUserSession) {
                        const userSession = window.App.user;
                        if (userSession && userSession.unique_id) {
                            userId = userSession.unique_id;
                        } else {
                            console.error("No valid user session data.");
                            alert("Session data is invalid.");
                            return;
                        }
                    } else {
                        console.error("No user session found.");
                        alert("No user session found.");
                        return;
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
            }
        };

        // Password modal trigger
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
                    if (arrowUp && arrowUp.classList.contains('fa-chevron-up')) {
                        arrowUp.classList.remove("fa-chevron-up");
                        arrowUp.classList.add("fa-chevron-down");
                        arrowUp.style.display = "flex";
                    }
                });
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
                });
            }
        };

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function () {
            dynamicChangeNavMob();
            userPopopuOpen();
            passwordChangeCheck();
            passwordModelTrigger();

            // Logout event listener
            const logoutBtn = document.querySelector('.popup-notify-list .logoutBtn');
            const userPopupTrigger = document.querySelector('.nav-profilecontainer i');
            const userPopupList = document.querySelector('.popup-notify-list');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', (event) => {
                    event.stopPropagation();
                    if (userPopupTrigger && userPopupList) {
                        userPopupTrigger.classList.remove('fa-chevron-up');
                        userPopupTrigger.classList.add('fa-chevron-down');
                        userPopupList.style.display = 'none';
                    }
                    sessionLogoutInitial('{{ route('logout') }}', '{{ route('login') }}');
                });
            }

            // Profile picture retrieval
            if (window.App.hasScUserSession) {
                retrieveProfilePictureNavSc();
            } else if (window.App.hasUserSession) {
                retrieveProfilePictureNav();
            }

            // Menu icon click handler
            const menuIcon = document.getElementById('menu-icon');
            if (menuIcon && !menuIcon.hasAttribute('data-initialized')) {
                menuIcon.setAttribute('data-initialized', 'true');
                menuIcon.addEventListener('click', function () {
                    const mobileSidebar = document.getElementById('mobile-sidebar');
                    const overlay = document.getElementById('sidebar-overlay');
                    const navContainer = document.querySelector('.nav-container');

                    if (mobileSidebar && overlay) {
                        if (mobileSidebar.classList.contains('active')) {
                            closeSidebar(mobileSidebar, overlay, this);
                            if (navContainer) {
                                navContainer.style.display = 'flex';
                            }
                        } else {
                            mobileSidebar.classList.add('active');
                            overlay.classList.add('active');
                            mobileSidebar.style.display = 'block';
                            mobileSidebar.style.opacity = '1';
                            overlay.style.display = 'block';
                            overlay.style.opacity = '1';
                            document.body.style.overflow = 'hidden';
                            this.classList.add('menu-open');
                            if (navContainer) {
                                navContainer.style.display = 'flex';
                            }
                        }
                    } else {
                        createMobileSidebar();
                        const newMobileSidebar = document.getElementById('mobile-sidebar');
                        const newOverlay = document.getElementById('sidebar-overlay');
                        if (newMobileSidebar && newOverlay) {
                            newMobileSidebar.classList.add('active');
                            newOverlay.classList.add('active');
                            newMobileSidebar.style.display = 'block';
                            newMobileSidebar.style.opacity = '1';
                            newOverlay.style.display = 'block';
                            newOverlay.style.opacity = '1';
                            document.body.style.overflow = 'hidden';
                            this.classList.add('menu-open');
                            if (navContainer) {
                                navContainer.style.display = 'flex';
                            }
                        }
                    }
                });
            }
        });

        // Update navbar on resize
        window.addEventListener('resize', dynamicChangeNavMob);
    </script>
</body>
</html>