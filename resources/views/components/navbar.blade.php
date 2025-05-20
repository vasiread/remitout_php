<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Dashboard</title>
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
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
                        <img src="{{ asset('assets/images/Iicons/menu.png') }}" alt="">
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
            <i class="fa-solid fa-xmark close-icon" id="close-icon" style="display:none;"></i>
        </div>
    </nav>

     <div class="password-change-overlay" style="display: none;"></div>

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
         window.App = {
            user: @json(session('user')),
            scuser: @json(session('scuser')),
            hasScUserSession: {{ session()->has('scuser') ? 'true' : 'false' }},
            hasUserSession: {{ session()->has('user') ? 'true' : 'false' }}
        };

        function handleIndividualCards(mode = 'index1') {
            const checkInterval = setInterval(() => {
                const individualCards = document.querySelectorAll('.indivudalloanstatus-cards');
                if (individualCards.length > 0) {
                    clearInterval(checkInterval);
                    individualCards.forEach((card) => {
                        const triggeredMessageButton = card.querySelector('.individual-bankmessages .triggeredbutton');
                        const groupButtonContainer = card.querySelector('.individual-bankmessages-buttoncontainer');
                        const individualBankMessageInput = card.querySelector('.individual-bankmessage-input');
                        if (mode === 'index1') {
                            if (triggeredMessageButton && groupButtonContainer) {
                                triggeredMessageButton.style.display = "flex";
                                groupButtonContainer.style.display = "none";
                            }
                        } else if (mode === 'index0') {
                            card.style.height = "fit-content";
                            if (individualBankMessageInput) {
                                individualBankMessageInput.style.display = "none";
                            }
                            if (triggeredMessageButton && groupButtonContainer) {
                                triggeredMessageButton.style.display = "none";
                                groupButtonContainer.style.display = "flex";
                            }
                        }
                    });
                } else {
                    console.log(`Waiting for individual cards for ${mode}...`);
                }
            }, 50);
        }

        function toggleSection(sectionId, index) {
            if (window.innerWidth > 640) return;
            const trackProgressDiv = document.querySelector('.studentdashboardprofile-trackprogress');
            const myApplicationDiv = document.querySelector('.studentdashboardprofile-myapplication');
            const dynamicHeader = document.getElementById('loanproposals-header');
            const communityJoinCard = document.querySelector('.studentdashboardprofile-communityjoinsection');
            const profileStatusCard = document.querySelector('.personalinfo-profilestatus');
            const profileImgEditIcon = document.querySelector('.studentdashboardprofile-profilesection .fa-pen-to-square');
            const educationEditSection = document.querySelector('.studentdashboardprofile-educationeditsection');
            const testScoresEditSection = document.querySelector('.studentdashboardprofile-testscoreseditsection');
            const menuItems = document.querySelectorAll('.sidebar-menu .menu-item, .studentdashboardprofile-togglesidebar li');
            menuItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('data-section') === sectionId) {
                    item.classList.add('active');
                }
            });
            if (sectionId === 'studentdashboardprofile-trackprogress' && index === 0) {
                if (trackProgressDiv) trackProgressDiv.style.display = 'flex';
                if (myApplicationDiv) myApplicationDiv.style.display = 'none';
                if (communityJoinCard) communityJoinCard.style.display = 'flex';
                if (profileStatusCard) profileStatusCard.style.display = 'block';
                if (profileImgEditIcon) profileImgEditIcon.style.display = 'none';
                if (educationEditSection) educationEditSection.style.display = 'none';
                if (testScoresEditSection) testScoresEditSection.style.display = 'none';
                if (dynamicHeader) dynamicHeader.textContent = 'Loan Proposals';
                handleIndividualCards('index0');
            } else if (sectionId === 'studentdashboardprofile-trackprogress' && index === 1) {
                if (trackProgressDiv) trackProgressDiv.style.display = 'flex';
                if (myApplicationDiv) myApplicationDiv.style.display = 'none';
                if (communityJoinCard) communityJoinCard.style.display = 'flex';
                if (profileStatusCard) profileStatusCard.style.display = 'block';
                if (profileImgEditIcon) profileImgEditIcon.style.display = 'none';
                if (educationEditSection) educationEditSection.style.display = 'none';
                if (testScoresEditSection) testScoresEditSection.style.display = 'none';
                if (dynamicHeader) dynamicHeader.textContent = 'Inbox';
                handleIndividualCards('index1');
            } else if (sectionId === 'studentdashboardprofile-myapplication') {
                if (trackProgressDiv) trackProgressDiv.style.display = 'none';
                if (myApplicationDiv) myApplicationDiv.style.display = 'flex';
                if (communityJoinCard) communityJoinCard.style.display = 'none';
                if (profileStatusCard) profileStatusCard.style.display = 'none';
                if (profileImgEditIcon) profileImgEditIcon.style.display = 'block';
                if (educationEditSection) educationEditSection.style.display = 'flex';
                if (testScoresEditSection) testScoresEditSection.style.display = 'flex';
                if (dynamicHeader) dynamicHeader.textContent = 'Loan Proposals';
            }
            const mobileSidebar = window.App.hasScUserSession ? document.getElementById('sc-mobile-sidebar') : document.getElementById('student-mobile-sidebar');
            const overlay = window.App.hasScUserSession ? document.getElementById('sc-sidebar-overlay') : document.getElementById('student-sidebar-overlay');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            if (mobileSidebar && overlay && menuIcon && closeIcon) {
                closeSidebar(mobileSidebar, overlay, menuIcon, closeIcon);
            }
        }

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

        const dynamicChangeNavMob = () => {
            const navSearchNotificationBars = document.querySelector('.nav-searchnotificationbars');
            const profilePhotoMobTab = document.querySelector('.profile-photo-mobtab');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            const navContainer = document.querySelector('.nav-container');
            const mobileSidebar = window.App.hasScUserSession ? document.getElementById('sc-mobile-sidebar') : document.getElementById('student-mobile-sidebar');
            const overlay = window.App.hasScUserSession ? document.getElementById('sc-sidebar-overlay') : document.getElementById('student-sidebar-overlay');
            const navLinks = document.querySelector('.nav-links');
            const navButtons = document.querySelector('.nav-buttons');

            console.log('Window innerWidth:', window.innerWidth);

            if (window.innerWidth <= 640) {
                console.log('Switching to mobile navbar');
                if (navSearchNotificationBars) {
                    navSearchNotificationBars.style.display = 'none';
                    console.log('Hiding nav-searchnotificationbars');
                }
                if (profilePhotoMobTab) {
                    profilePhotoMobTab.style.display = 'block';
                    console.log('Showing profile-photo-mobtab');
                }
                if (menuIcon) {
                    menuIcon.style.display = 'flex';
                    console.log('Showing menu-icon');
                }
                if (navContainer) navContainer.style.display = 'flex';
                if (closeIcon && !mobileSidebar?.classList.contains('active')) {
                    closeIcon.style.display = 'none';
                    console.log('Hiding close-icon');
                }
                if (navLinks) {
                    navLinks.style.display = 'none';
                    console.log('Hiding nav-links');
                }
                if (navButtons) {
                    navButtons.style.display = 'none';
                    console.log('Hiding nav-buttons');
                }
            } else {
                console.log('Switching to desktop navbar');
                if (navSearchNotificationBars) {
                    navSearchNotificationBars.style.display = 'flex';
                    console.log('Showing nav-searchnotificationbars');
                }
                if (profilePhotoMobTab) {
                    profilePhotoMobTab.style.display = 'none';
                    console.log('Hiding profile-photo-mobtab');
                }
                if (menuIcon) {
                    menuIcon.style.display = 'none';
                    console.log('Hiding menu-icon');
                }
                if (closeIcon) {
                    closeIcon.style.display = 'none';
                    console.log('Hiding close-icon');
                }
                if (navContainer) navContainer.style.display = 'flex';
                if (navLinks) {
                    navLinks.style.display = 'flex';
                    console.log('Showing nav-links');
                }
                if (navButtons) {
                    navButtons.style.display = 'flex';
                    console.log('Showing nav-buttons');
                }
                if (mobileSidebar && overlay) {
                    mobileSidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    mobileSidebar.style.transform = 'translateX(-100%)';
                    overlay.style.opacity = '0';
                    overlay.style.visibility = 'hidden';
                    document.body.style.overflow = 'auto';
                    profilePhotoMobTab.classList.remove('sidebar-active');
                }
            }
        };

        function closeSidebar(mobileSidebar, overlay, menuIcon, closeIcon) {
            if (mobileSidebar && overlay && menuIcon && closeIcon) {
                mobileSidebar.classList.remove('active');
                overlay.classList.remove('active');
                mobileSidebar.style.transform = 'translateX(-100%)';
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
                document.body.style.overflow = 'auto';
                menuIcon.style.display = 'flex';
                closeIcon.style.display = 'none';
                const profilePhotoMobTab = document.querySelector('.profile-photo-mobtab');
                if (profilePhotoMobTab) profilePhotoMobTab.classList.remove('sidebar-active');
            }
        }

        function createStudentSidebar() {
            let overlay = document.getElementById('student-sidebar-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'student-sidebar-overlay';
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);
            }

            let mobileSidebar = document.getElementById('student-mobile-sidebar');
            if (!mobileSidebar) {
                mobileSidebar = document.createElement('div');
                mobileSidebar.id = 'student-mobile-sidebar';
                mobileSidebar.className = 'mobile-sidebar';
                mobileSidebar.innerHTML = `
                    <div class="sidebar-menu">
                        <a class="menu-item active" data-section="studentdashboardprofile-trackprogress" onclick="toggleSection('studentdashboardprofile-trackprogress', 0)">
                            <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                        </a>
                        <a class="menu-item" data-section="studentdashboardprofile-trackprogress" onclick="toggleSection('studentdashboardprofile-trackprogress', 1)">
                            <i class="fa-solid fa-inbox"></i> Inbox
                        </a>
                        <a class="menu-item" data-section="studentdashboardprofile-myapplication" onclick="toggleSection('studentdashboardprofile-myapplication', 2)">
                            <i class="fa-regular fa-clipboard"></i> My Applications
                        </a>
                    </div>
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

                overlay.addEventListener('click', function () {
                    const menuIcon = document.getElementById('menu-icon');
                    const closeIcon = document.getElementById('close-icon');
                    closeSidebar(mobileSidebar, overlay, menuIcon, closeIcon);
                });
            }
        }

        function createScSidebar() {
            let overlay = document.getElementById('sc-sidebar-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'sc-sidebar-overlay';
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);
            }

            let mobileSidebar = document.getElementById('sc-mobile-sidebar');
            if (!mobileSidebar) {
                mobileSidebar = document.createElement('div');
                mobileSidebar.id = 'sc-mobile-sidebar';
                mobileSidebar.className = 'mobile-sidebar';
                mobileSidebar.innerHTML = `
                    <div class="sidebar-header">
                        <img src="{{ asset('assets/images/Remitoutcolored.png') }}" alt="Logo" class="logo">
                        <i class="fa-solid fa-xmark close-sidebar"></i>
                    </div>
                    <div class="sidebar-menu">
                        <a href="/sc-dashboard" class="menu-item active">
                            <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                        </a>
                        <a href="/sc-inbox" class="menu-item">
                            <i class="fa-solid fa-inbox"></i> Profile
                        </a>
                        <a href="/sc-applications" class="menu-item">
                            <i class="fa-regular fa-clipboard"></i> Applications Status
                        </a>
                    </div>
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
                const closeIcon = mobileSidebar.querySelector('.close-sidebar');
                if (closeIcon) {
                    closeIcon.addEventListener('click', function () {
                        const overlay = document.getElementById('sc-sidebar-overlay');
                        closeSidebar(mobileSidebar, overlay, menuIcon, document.getElementById('close-icon'));
                    });
                }

                overlay.addEventListener('click', function () {
                    closeSidebar(mobileSidebar, overlay, menuIcon, document.getElementById('close-icon'));
                });
            }
        }

        function displayError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.innerText = message;
                errorElement.style.display = 'block';
            }
        }

        function clearErrorMessages() {
            const errorElements = document.getElementsByClassName('error-message');
            for (let i = 0; i < errorElements.length; i++) {
                errorElements[i].innerText = '';
                errorElements[i].style.display = 'none';
            }
        }

        const retrieveProfilePictureNav = async () => {
            const userSession = window.App.user;
            if (!userSession || !userSession.unique_id) return;
            const userId = userSession.unique_id;
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) return;
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
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
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

        const retrieveProfilePictureNavSc = async () => {
            const userSession = window.App.scuser;
            if (!userSession || !userSession.referral_code) return;
            const scuserrefid = userSession.referral_code;
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) return;
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
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
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

        const passwordChangeCheck = () => {
            const saveButton = document.getElementById('password-change-save');
            if (saveButton) {
                saveButton.addEventListener('click', function () {
                    const currentPassword = document.getElementById('current-password').value.trim();
                    const newPassword = document.getElementById('new-password').value.trim();
                    const confirmNewPassword = document.getElementById('confirm-new-password').value.trim();
                    const passwordChangeContainer = document.querySelector(".password-change-container");
                    const passwordChangeOverlay = document.querySelector(".password-change-overlay");
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
                                if (passwordChangeOverlay) passwordChangeOverlay.style.display = "none";
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

        function clearErrorMessages() {
            const errorElements = document.getElementsByClassName('error-message');
            for (let i = 0; i < errorElements.length; i++) {
                errorElements[i].innerText = '';
                errorElements[i].style.display = 'none';
            }
        }

        const passwordModelTrigger = () => {
            const passwordTrigger = document.getElementById("change-password-trigger");
            const passwordChangeContainer = document.querySelector(".password-change-container");
            const passwordChangeOverlay = document.querySelector(".password-change-overlay");
            const passwordContainerExit = document.querySelector(".password-change-container .password-change-triggered-view-headersection img");
            const popupPasswordShow = document.querySelector(".popup-notify-list");
            const arrowUp = document.querySelector(".nav-profilecontainer i");
            if (passwordTrigger) {
                passwordTrigger.addEventListener("click", () => {
                    if (passwordChangeContainer) passwordChangeContainer.style.display = "flex";
                    if (passwordChangeOverlay) passwordChangeOverlay.style.display = "block";
                    if (popupPasswordShow) popupPasswordShow.style.display = "none";
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
                    if (passwordChangeOverlay) passwordChangeOverlay.style.display = "none";
                });
            }
        };

        const initializeDesktopSidebar = () => {
            const sidebarItems = document.querySelectorAll('.studentdashboardprofile-togglesidebar li');
            sidebarItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    let sectionId;
                    if (index === 0) sectionId = 'studentdashboardprofile-trackprogress';
                    else if (index === 1) sectionId = 'studentdashboardprofile-trackprogress';
                    else if (index === 2) sectionId = 'studentdashboardprofile-myapplication';
                    else if (item.classList.contains('logoutBtn')) {
                        sessionLogoutInitial('{{ route('logout') }}', '{{ route('login') }}');
                        return;
                    } else if (item.textContent.includes('Support')) {
                        window.location.href = '/support';
                        return;
                    }
                    if (sectionId) {
                        const event = new CustomEvent('desktopSidebarClick', { detail: { sectionId, index } });
                        document.dispatchEvent(event);
                    }
                });
            });
        };

        document.addEventListener('DOMContentLoaded', function () {
            dynamicChangeNavMob();
            userPopopuOpen();
            passwordChangeCheck();
            passwordModelTrigger();
            initializeDesktopSidebar();

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

            if (window.App.hasScUserSession) {
                createScSidebar();
                retrieveProfilePictureNavSc();
            } else if (window.App.hasUserSession) {
                createStudentSidebar();
                retrieveProfilePictureNav();
                if (window.innerWidth <= 640) {
                    toggleSection('studentdashboardprofile-trackprogress', 0);
                }
            }

            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            if (menuIcon && closeIcon && !menuIcon.hasAttribute('data-initialized')) {
                menuIcon.setAttribute('data-initialized', 'true');
                menuIcon.addEventListener('click', function () {
                    if (window.innerWidth > 640) return;
                    let mobileSidebar, overlay;
                    if (window.App.hasScUserSession) {
                        createScSidebar();
                        mobileSidebar = document.getElementById('sc-mobile-sidebar');
                        overlay = document.getElementById('sc-sidebar-overlay');
                    } else {
                        createStudentSidebar();
                        mobileSidebar = document.getElementById('student-mobile-sidebar');
                        overlay = document.getElementById('student-sidebar-overlay');
                    }
                    if (mobileSidebar && overlay) {
                        if (mobileSidebar.classList.contains('active')) {
                            closeSidebar(mobileSidebar, overlay, this, closeIcon);
                        } else {
                            const otherSidebar = window.App.hasScUserSession ? document.getElementById('student-mobile-sidebar') : document.getElementById('sc-mobile-sidebar');
                            const otherOverlay = window.App.hasScUserSession ? document.getElementById('student-sidebar-overlay') : document.getElementById('sc-sidebar-overlay');
                            if (otherSidebar && otherOverlay && otherSidebar.classList.contains('active')) {
                                closeSidebar(otherSidebar, otherOverlay, this, closeIcon);
                            }
                            mobileSidebar.classList.add('active');
                            overlay.classList.add('active');
                            mobileSidebar.style.transform = 'translateX(0)';
                            overlay.style.opacity = '1';
                            overlay.style.visibility = 'visible';
                            document.body.style.overflow = 'hidden';
                            this.style.display = 'none';
                            closeIcon.style.display = 'block';
                            const profilePhotoMobTab = document.querySelector('.profile-photo-mobtab');
                            if (profilePhotoMobTab) profilePhotoMobTab.classList.add('sidebar-active');
                        }
                    }
                });

                closeIcon.addEventListener('click', function () {
                    if (window.innerWidth > 640) return;
                    let mobileSidebar, overlay;
                    if (window.App.hasScUserSession) {
                        mobileSidebar = document.getElementById('sc-mobile-sidebar');
                        overlay = document.getElementById('sc-sidebar-overlay');
                    } else {
                        mobileSidebar = document.getElementById('student-mobile-sidebar');
                        overlay = document.getElementById('student-sidebar-overlay');
                    }
                    if (mobileSidebar && overlay) {
                        closeSidebar(mobileSidebar, overlay, menuIcon, this);
                    }
                });
            }
        });

        window.addEventListener('resize', dynamicChangeNavMob);
    </script>
</body>
</html>