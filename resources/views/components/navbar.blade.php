<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SC Dashboard</title>
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
</head>

<body>
    <nav class="nav">
        <div class="nav-container fullopacity">
            <img onclick="window.location.href='{{ url('/') }}'" src="{{ asset('assets/images/Remitoutcolored.png') }}" alt="Logo" class="logo" id="profile-logo">

            @if(session()->has('user') || session()->has('scuser'))
                <div class="nav-searchnotificationbars">
                    <div class="unread-notify-container">
                        <img src="{{ asset('assets/images/notifications_unread.png') }}" class="unread-notify" id="userNotification" alt="">
                        <p></p>
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
                    <div class="menubarcontainer-profile" id="dashboard-menu">
                        <img src="{{ asset('assets/images/Icons/menu.png') }}" alt="">
                    </div>
                </div>
            @endif

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

        <!-- Current Password with Eye Icon -->
        <div class="password-input-wrapper">
            <input type="password" placeholder="Current Password" id="current-password">
            <img src="{{ asset('assets/images/Icons/eye.png') }}" 
                 class="toggle-password" 
                 data-target="current-password"
                 style="cursor:pointer; position:absolute; right:10px; top:50%; transform:translateY(-50%); width:20px;" 
                 alt="Toggle Password">
        </div>
        <span id="current-password-error" class="error-message"></span>

        <!-- New Password -->
        <input type="password" placeholder="New Password" id="new-password">
        <span id="new-password-error" class="error-message"></span>

        <!-- Confirm Password -->
        <input type="password" placeholder="Confirm New Password" id="confirm-new-password">
        <span id="confirm-password-error" class="error"></span>

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
            hasUserSession: {{ session()->has('user') ? 'true' : 'false' }},
            activeSection: null,
            activeIndex: 0
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
                                triggeredMessageButton.style.display = 'flex';
                                groupButtonContainer.style.display = 'none';
                            }
                        } else if (mode === 'index0') {
                            card.style.height = 'fit-content';
                            if (individualBankMessageInput) {
                                individualBankMessageInput.setAttribute('display', 'none');
                            }
                            if (triggeredMessageButton && groupButtonContainer) {
                                triggeredMessageButton.setAttribute('display', 'none');
                                groupButtonContainer.style.display = 'flex';
                            }
                        }
                    });
                } else {
                    console.log(`Waiting for individual cards for ${mode}...`);
                }
            }, 50);
        }

        function toggleSection(sectionId, index) {
            window.App.activeSection = sectionId;
            window.App.activeIndex = index;

            let trackProgressDiv, myApplicationDiv, dynamicHeader, communityJoinCard, profileStatusCard, profileImgEditIcon, educationEditSection, testScoresEditSection;
            let scDashboardContainer, scInboxContainer, scApplicationStatus;

            if (window.App.hasScUserSession) {
                scDashboardContainer = document.querySelector('.scdashboard-container');
                scInboxContainer = document.querySelector('.scdashboard-inboxcontent');
                scApplicationStatus = document.querySelector('.scdashboard-applicationstatus');
            } else {
                trackProgressDiv = document.querySelector('.studentdashboardprofile-trackprogress');
                myApplicationDiv = document.querySelector('.studentdashboardprofile-myapplication');
                dynamicHeader = document.getElementById('loanproposals-header');
                communityJoinCard = document.querySelector('.studentdashboardprofile-communityjoinsection');
                profileStatusCard = document.querySelector('.personalinfo-profilestatus');
                profileImgEditIcon = document.querySelector('.studentdashboardprofile-profilesection .fa-pen-to-square');
                educationEditSection = document.querySelector('.studentdashboardprofile-educationeditsection');
                testScoresEditSection = document.querySelector('.studentdashboardprofile-testscoreseditsection');
            }

            const menuItems = document.querySelectorAll('.sidebar-menu .menu-item, .sidebarlists-top li');
            menuItems.forEach(item => {
                item.classList.remove('active');
                const itemSection = item.getAttribute('data-section');
                const itemIndex = parseInt(item.getAttribute('data-index') || -1);
                if (itemSection === sectionId && itemIndex === index) {
                    item.classList.add('active');
                }
            });

            if (window.App.hasScUserSession) {
                if (sectionId === 'scdashboard-container' && index === 0) {
                    if (scDashboardContainer) scDashboardContainer.style.display = 'flex';
                    if (scInboxContainer) scInboxContainer.style.display = 'none';
                    if (scApplicationStatus) scApplicationStatus.style.display = 'none';
                } else if (sectionId === 'scdashboard-inboxcontent' && index === 1) {
                    if (scDashboardContainer) scDashboardContainer.style.display = 'none';
                    if (scInboxContainer) scInboxContainer.style.display = 'flex';
                    if (scApplicationStatus) scApplicationStatus.style.display = 'none';
                } else if (sectionId === 'scdashboard-applicationstatus' && index === 2) {
                    if (scDashboardContainer) scDashboardContainer.style.display = 'none';
                    if (scInboxContainer) scInboxContainer.style.display = 'none';
                    if (scApplicationStatus) scApplicationStatus.style.display = 'flex';
                }
            } else {
                const personalDivContainer = document.querySelector(".personalinfo-secondrow");
                const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
                const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
                const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");
                const saveChangesButton = document.querySelector(".personalinfo-firstrow button");

                if (sectionId === 'studentdashboardprofile-trackprogress' && index === 0) {
                    if (trackProgressDiv) trackProgressDiv.style.display = 'flex';
                    if (myApplicationDiv) myApplicationDiv.style.display = 'none';
                    if (communityJoinCard) communityJoinCard.style.display = 'flex';
                    if (profileStatusCard) profileStatusCard.style.display = 'block';
                    if (profileImgEditIcon) profileImgEditIcon.style.display = 'none';
                    if (educationEditSection) educationEditSection.style.display = 'none';
                    if (testScoresEditSection) testScoresEditSection.style.display = 'none';
                    if (personalDivContainerEdit) personalDivContainerEdit.style.display = 'none';
                    if (personalDivContainer) personalDivContainer.style.display = 'flex';
                    if (academicsMarksDivEdit) academicsMarksDivEdit.style.display = 'none';
                    if (academicsMarksDiv) academicsMarksDiv.style.display = 'flex';
                    if (dynamicHeader) dynamicHeader.textContent = 'Loan Proposals';
                    if (saveChangesButton) {
                        saveChangesButton.textContent = 'Edit';
                        saveChangesButton.style.backgroundColor = 'transparent';
                        saveChangesButton.style.color = '#260254';
                    }
                    handleIndividualCards('index0');
                } else if (sectionId === 'studentdashboardprofile-trackprogress' && index === 1) {
                    if (trackProgressDiv) trackProgressDiv.style.display = 'flex';
                    if (myApplicationDiv) myApplicationDiv.style.display = 'none';
                    if (communityJoinCard) communityJoinCard.style.display = 'flex';
                    if (profileStatusCard) profileStatusCard.style.display = 'block';
                    if (profileImgEditIcon) profileImgEditIcon.style.display = 'none';
                    if (educationEditSection) educationEditSection.style.display = 'none';
                    if (testScoresEditSection) testScoresEditSection.style.display = 'none';
                    if (personalDivContainerEdit) personalDivContainerEdit.style.display = 'none';
                    if (personalDivContainer) personalDivContainer.style.display = 'flex';
                    if (academicsMarksDivEdit) academicsMarksDivEdit.style.display = 'none';
                    if (academicsMarksDiv) academicsMarksDiv.style.display = 'flex';
                    if (dynamicHeader) dynamicHeader.textContent = 'Inbox';
                    if (saveChangesButton) {
                        saveChangesButton.textContent = 'Edit';
                        saveChangesButton.style.backgroundColor = 'transparent';
                        saveChangesButton.style.color = '#260254';
                    }
                    handleIndividualCards('index1');
                } else if (sectionId === 'studentdashboardprofile-myapplication' && index === 2) {
                    if (trackProgressDiv) trackProgressDiv.style.display = 'none';
                    if (myApplicationDiv) myApplicationDiv.style.display = 'flex';
                    if (communityJoinCard) communityJoinCard.style.display = 'none';
                    if (profileStatusCard) profileStatusCard.style.display = 'none';
                    if (profileImgEditIcon) profileImgEditIcon.style.display = 'block';
                    if (educationEditSection) educationEditSection.style.display = 'flex';
                    if (testScoresEditSection) testScoresEditSection.style.display = 'flex';
                    if (saveChangesButton) {
                        saveChangesButton.textContent = 'Edit';
                        saveChangesButton.style.backgroundColor = 'transparent';
                        saveChangesButton.style.color = '#260254';
                    }
                }
            }

            if (window.innerWidth <= 767) {
                const mobileSidebar = document.getElementById('mobile-sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                const menuIcon = document.getElementById('menu-icon');
                const closeIcon = document.getElementById('close-icon');
                if (mobileSidebar && overlay && menuIcon && closeIcon) {
                    closeSidebar(mobileSidebar, overlay, menuIcon, closeIcon);
                }
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
                    console.log('Logout API response:', data);
                })
                .catch(error => {
                    console.error('Fetch error during logout:', error);
                    alert('Logout failed: Network error');
                });
        }

        function dynamicMobileNav() {
            const navSearchContainer = document.querySelector('.nav-searchnotificationbars');
            const profileName = document.querySelector('.nav-profilecontainer h3');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            const navContainer = document.querySelector('.nav-container');
            const navLinks = document.querySelector('.nav-links');
            const navButtons = document.querySelector('.nav-buttons');

            if (window.innerWidth <= 767) {
                if (navSearchContainer) navSearchContainer.style.display = 'flex';
                if (profileName) profileName.style.display = 'none';
                if (menuIcon) menuIcon.style.display = 'flex';
                if (navContainer) navContainer.style.display = 'flex';
                if (closeIcon) closeIcon.style.display = 'none';
                if (navLinks) navLinks.style.display = 'none';
                if (navButtons) navButtons.style.display = 'none';
            } else {
                if (navSearchContainer) navSearchContainer.style.display = 'flex';
                if (profileName) profileName.style.display = 'block';
                if (menuIcon) menuIcon.style.display = 'none';
                if (closeIcon) closeIcon.style.display = 'none';
                if (navContainer) navContainer.style.display = 'flex';
                if (navLinks) navLinks.style.display = 'flex';
                if (navButtons) navButtons.style.display = 'flex';
                const mobileSidebar = document.getElementById('mobile-sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                if (mobileSidebar && overlay) {
                    mobileSidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    mobileSidebar.style.transform = 'translateX(-100%)';
                    overlay.style.opacity = '0';
                    overlay.style.visibility = 'hidden';
                    document.body.style.overflow = 'auto';
                }
                if (window.App.activeSection && window.App.activeIndex !== null) {
                    toggleSection(window.App.activeSection, window.App.activeIndex);
                }
            }
        }

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
            }
        }

        function createSidebar() {
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
                mobileSidebar.innerHTML = `
                    <div class="sidebar-menu">
                        <a class="menu-item${window.App.activeIndex === 0 ? ' active' : ''}" data-section="${isScUser ? 'scdashboard-container' : 'studentdashboardprofile-trackprogress'}" data-index="0" onclick="toggleSection('${isScUser ? 'scdashboard-container' : 'studentdashboardprofile-trackprogress'}', 0)">
                            <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                        </a>
                        <a class="menu-item${window.App.activeIndex === 1 ? ' active' : ''}" data-section="${isScUser ? 'scdashboard-inboxcontent' : 'studentdashboardprofile-trackprogress'}" data-index="1" onclick="toggleSection('${isScUser ? 'scdashboard-inboxcontent' : 'studentdashboardprofile-trackprogress'}', 1)">
                            <i class="fa-solid fa-inbox"></i> ${isScUser ? 'Profile' : 'Inbox'}
                        </a>
                        <a class="menu-item${window.App.activeIndex === 2 ? ' active' : ''}" data-section="${isScUser ? 'scdashboard-applicationstatus' : 'studentdashboardprofile-myapplication'}" data-index="2" onclick="toggleSection('${isScUser ? 'scdashboard-applicationstatus' : 'studentdashboardprofile-myapplication'}', 2)">
                            <i class="fa-regular fa-clipboard"></i> ${isScUser ? 'Applications Status' : 'My Applications'}
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
            return { mobileSidebar, overlay };
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

        const retrieveProfilePicture = async () => {
            const profileImgUpdate = document.querySelector(".nav-profilecontainer .nav-profileimg");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) return;

            if (window.App.hasScUserSession) {
                const userSession = window.App.scuser;
                if (!userSession || !userSession.referral_code) return;
                const scuserRefid = userSession.referral_code;
                try {
                    const response = await fetch('/view-scuserprofile-photo', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ scuserRefid: scuserRefid }),
                    });
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    const data = await response.json();
                    if (data.fileUrl && profileImgUpdate) {
                        profileImgUpdate.src = data.fileUrl;
                    } else {
                        const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                        if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                    }
                } catch (error) {
                    const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                    if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                }
            } else if (window.App.hasUserSession) {
                const userSession = window.App.user;
                if (!userSession || !userSession.unique_id) return;
                const userId = userSession.unique_id;
                try {
                    const response = await fetch('/retrieve-profile-picture', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ userId: userId })
                    });
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    const data = await response.json();
                    if (data.fileUrl && profileImgUpdate) {
                        profileImgUpdate.src = data.fileUrl;
                    } else {
                        const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                        if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                    }
                } catch (error) {
                    const fallbackImage = '{{ asset('assets/images/Icons/account_circle.png') }}';
                    if (profileImgUpdate) profileImgUpdate.src = fallbackImage;
                }
            }
        };

        const userPopup = () => {
            const userPopupTrigger = document.querySelector(".nav-profilecontainer");
            const userPopupList = document.querySelector(".popup-notify-list");
            const arrowIcon = document.querySelector(".nav-profilecontainer i");

            if (userPopupTrigger && userPopupList && arrowIcon) {
                userPopupTrigger.addEventListener('click', (event) => {
                    event.stopPropagation();
                    if (arrowIcon.classList.contains("fa-chevron-down")) {
                        arrowIcon.classList.remove("fa-chevron-down");
                        arrowIcon.classList.add("fa-chevron-up");
                        userPopupList.style.display = "flex";
                    } else {
                        arrowIcon.classList.remove("fa-chevron-up");
                        arrowIcon.classList.add("fa-chevron-down");
                        userPopupList.style.display = "none";
                    }
                });

                document.addEventListener('click', (event) => {
                    const isClickInsideTrigger = userPopupTrigger.contains(event.target);
                    const isClickInsidePopup = userPopupList.contains(event.target);
                    if (!isClickInsideTrigger && !isClickInsidePopup && userPopupList.style.display === "flex") {
                        arrowIcon.classList.remove("fa-chevron-up");
                        arrowIcon.classList.add("fa-chevron-down");
                        userPopupList.style.display = 'none';
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
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(passwordChangeVariables)
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                console.log("Password changed successfully");
                                alert("Password updated successfully.");
                                if (passwordChangeContainer) {
                                    passwordChangeContainer.style.display = 'none';
                                    document.getElementById('current-password').value = '';
                                    document.getElementById('new-password').value = '';
                                    document.getElementById('confirm-new-password').value = '';
                                }
                                if (passwordChangeOverlay) passwordChangeOverlay.style.display = 'none';
                            } else {
                                console.error("Error:", data.message);
                                alert(data.message || "Failed to update password");
                            }
                        })
                        .catch((error) => {
                            console.error("Fetch error:", error);
                            alert("An error occurred while updating password");
                        });
                });
            }
        };

        const passwordModalTrigger = () => {
            const passwordTrigger = document.getElementById('change-password-trigger');
            const passwordChangeContainer = document.querySelector('.password-change-container');
            const passwordChangeOverlay = document.querySelector('.password-change-overlay');
            const passwordContainerExit = document.querySelector('.password-change-triggered-view-headersection img');
            const popupPassword = document.querySelector('.popup-notify-list');
            const arrowUp = document.querySelector('.nav-profilecontainer i');

            if (passwordTrigger) {
                passwordTrigger.addEventListener('click', () => {
                    if (passwordChangeContainer) {
                        passwordChangeContainer.style.display = 'flex';
                         popupPassword.style.display = 'none';
                    }
                    if (passwordChangeOverlay) {
                        passwordChangeOverlay.style.display = 'block';
                    }
                    // if (popupPassword) {
                       
                    // }
                    if (arrowUp && arrowUp.classList.contains('fa-chevron-up')) {
                        arrowUp.classList.remove('fa-chevron-up');
                        arrowUp.classList.add('fa-chevron-down');
                    }
                });
            }

            if (passwordContainerExit) {
                passwordContainerExit.addEventListener('click', () => {
                    if (passwordChangeContainer) {
                        passwordChangeContainer.style.display = 'none';
                        document.getElementById('current-password').value = '';
                        document.getElementById('new-password').value = '';
                        document.getElementById('confirm-new-password').value = '';
                        clearErrorMessages();
                    }
                    if (passwordChangeOverlay) {
                        passwordChangeOverlay.style.display = 'none';
                    }
                });
            }
        };

        const initializeSidebar = () => {
            const sidebarItems = document.querySelectorAll(".sidebarlists-top li");
            const isScUser = window.App.hasScUserSession;
            const trackprogressContainer = document.querySelector(isScUser ? ".scdashboard-container" : ".studentdashboardprofile-trackprogress");
            const inboxContainer = document.querySelector(isScUser ? ".scdashboard-inboxcontent" : ".studentdashboardprofile-trackprogress");
            const applicationStatus = document.querySelector(isScUser ? ".scdashboard-applicationstatus" : ".studentdashboardprofile-myapplication");
            const dynamicHeader = document.getElementById("loanproposals-header");
            const communityJoinCard = document.querySelector(".studentdashboardprofile-communityjoinsection");
            const profileStatusCard = document.querySelector(".personalinfo-profilestatus");
            const profileImgEditIcon = document.querySelector(".studentdashboardprofile-profilesection .fa-pen-to-square");
            const educationEditSection = document.querySelector(".studentdashboardprofile-educationeditsection");
            const testScoresEditSection = document.querySelector(".studentdashboardprofile-testscoreseditsection");
            const triggeredSidebar = document.querySelector(".togglesidebar");

            sidebarItems.forEach((item, index) => {
                item.addEventListener("click", () => {
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                    const sectionId = index === 0 ? (isScUser ? 'scdashboard-container' : 'studentdashboardprofile-trackprogress') :
                                     index === 1 ? (isScUser ? 'scdashboard-inboxcontent' : 'studentdashboardprofile-trackprogress') :
                                     (isScUser ? 'scdashboard-applicationstatus' : 'studentdashboardprofile-myapplication');
                    window.App.activeSection = sectionId;
                    window.App.activeIndex = index;

                    if (isScUser) {
                        if (index === 0) {
                            if (trackprogressContainer) trackprogressContainer.style.display = 'flex';
                            if (inboxContainer) inboxContainer.style.display = 'none';
                            if (applicationStatus) applicationStatus.style.display = 'none';
                        } else if (index === 1) {
                            if (trackprogressContainer) trackprogressContainer.style.display = 'none';
                            if (inboxContainer) inboxContainer.style.display = 'flex';
                            if (applicationStatus) applicationStatus.style.display = 'none';
                        } else {
                            if (trackprogressContainer) trackprogressContainer.style.display = 'none';
                            if (inboxContainer) inboxContainer.style.display = 'none';
                            if (applicationStatus) applicationStatus.style.display = 'flex';
                        }
                    } else {
                        const personalDivContainer = document.querySelector(".personalinfo-secondrow");
                        const personalDivContainerEdit = document.querySelector(".personalinfosecondrow-editsection");
                        const academicsMarksDivEdit = document.querySelector(".testscoreseditsection-secondrow-editsection");
                        const academicsMarksDiv = document.querySelector(".testscoreseditsection-secondrow");
                        const saveChangesButton = document.querySelector(".personalinfo-firstrow button");

                        if (index === 0) {
                            if (trackprogressContainer) trackprogressContainer.style.display = 'flex';
                            if (applicationStatus) applicationStatus.style.display = 'none';
                            if (communityJoinCard) communityJoinCard.style.display = 'flex';
                            if (profileStatusCard) profileStatusCard.style.display = 'block';
                            if (profileImgEditIcon) profileImgEditIcon.style.display = 'none';
                            if (educationEditSection) educationEditSection.style.display = 'none';
                            if (testScoresEditSection) testScoresEditSection.style.display = 'none';
                            if (personalDivContainerEdit) personalDivContainerEdit.style.display = 'none';
                            if (personalDivContainer) personalDivContainer.style.display = 'flex';
                            if (academicsMarksDivEdit) academicsMarksDivEdit.style.display = 'none';
                            if (academicsMarksDiv) academicsMarksDiv.style.display = 'flex';
                            if (dynamicHeader) dynamicHeader.textContent = 'Loan Proposals';
                            if (saveChangesButton) {
                                saveChangesButton.textContent = 'Edit';
                                saveChangesButton.style.backgroundColor = 'transparent';
                                saveChangesButton.style.color = '#260254';
                            }
                            handleIndividualCards('index0');
                        } else if (index === 1) {
                            if (trackprogressContainer) trackprogressContainer.style.display = 'flex';
                            if (applicationStatus) applicationStatus.style.display = 'none';
                            if (communityJoinCard) communityJoinCard.style.display = 'flex';
                            if (profileStatusCard) profileStatusCard.style.display = 'block';
                            if (profileImgEditIcon) profileImgEditIcon.style.display = 'none';
                            if (educationEditSection) educationEditSection.style.display = 'none';
                            if (testScoresEditSection) testScoresEditSection.style.display = 'none';
                            if (personalDivContainerEdit) personalDivContainerEdit.style.display = 'none';
                            if (personalDivContainer) personalDivContainer.style.display = 'flex';
                            if (academicsMarksDivEdit) academicsMarksDivEdit.style.display = 'none';
                            if (academicsMarksDiv) academicsMarksDiv.style.display = 'flex';
                            if (dynamicHeader) dynamicHeader.textContent = 'Inbox';
                            if (saveChangesButton) {
                                saveChangesButton.textContent = 'Edit';
                                saveChangesButton.style.backgroundColor = 'transparent';
                                saveChangesButton.style.color = '#260254';
                            }
                            handleIndividualCards('index1');
                        } else {
                            if (trackprogressContainer) trackprogressContainer.style.display = 'none';
                            if (applicationStatus) applicationStatus.style.display = 'flex';
                            if (communityJoinCard) communityJoinCard.style.display = 'none';
                            if (profileStatusCard) profileStatusCard.style.display = 'none';
                            if (profileImgEditIcon) profileImgEditIcon.style.display = 'block';
                            if (educationEditSection) educationEditSection.style.display = 'flex';
                            if (testScoresEditSection) testScoresEditSection.style.display = 'flex';
                            if (saveChangesButton) {
                                saveChangesButton.textContent = 'Edit';
                                saveChangesButton.style.backgroundColor = 'transparent';
                                saveChangesButton.style.color = '#260254';
                            }
                        }
                    }

                    if (window.innerWidth <= 768) {
                        if (triggeredSidebar) triggeredSidebar.style.display = 'none';
                        const img = document.querySelector("#dashboard-menu img");
                        if (img && img.src.includes("close_icon.png")) {
                            img.src = '{{ asset('assets/images/Icons/menu.png') }}';
                        }
                    }
                });
            });
        };

        document.addEventListener('DOMContentLoaded', function () {
            dynamicMobileNav();
            userPopup();
            passwordChangeCheck();
            passwordModalTrigger();
            initializeSidebar();
            retrieveProfilePicture();

            document.querySelectorAll('.toggle-password').forEach(icon => {
                icon.addEventListener('click', () => {
                    const targetId = icon.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    if (input) {
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.src = "{{ asset('assets/images/Icons/eye_off.png') }}";
                        } else {
                            input.type = 'password';
                            icon.src = "{{ asset('assets/images/Icons/eye.png') }}";
                        }
                    }
                });
            });

            const logoutBtn = document.querySelector('.popup-notify-list .logoutBtn');
            const userPopupTrigger = document.querySelector('.nav-profilecontainer');
            const userPopupList = document.querySelector('.popup-notify-list');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', (event) => {
                    event.preventDefault();
                    if (userPopupTrigger && userPopupList) {
                        const arrowIcon = userPopupTrigger.querySelector('i');
                        if (arrowIcon.classList.contains('fa-chevron-up')) {
                            arrowIcon.classList.remove('fa-chevron-up');
                            arrowIcon.classList.add('fa-chevron-down');
                        }
                        userPopupList.style.display = 'none';
                    }
                    sessionLogoutInitial('{{ route('logout') }}', '{{ route('login') }}');
                });
            }

            const { mobileSidebar, overlay } = createSidebar();
            toggleSection(window.App.hasScUserSession ? 'scdashboard-container' : 'studentdashboardprofile-trackprogress', 0);

            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            if (menuIcon && closeIcon) {
                menuIcon.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (window.innerWidth > 767) return;
                    if (!mobileSidebar || !overlay) {
                        ({ mobileSidebar, overlay } = createSidebar());
                    }
                    if (mobileSidebar && overlay) {
                        if (mobileSidebar.classList.contains('active')) {
                            closeSidebar(mobileSidebar, overlay, menuIcon, closeIcon);
                        } else {
                            mobileSidebar.classList.add('active');
                            overlay.classList.add('active');
                            mobileSidebar.style.transform = 'translateX(0)';
                            overlay.style.opacity = '1';
                            overlay.style.visibility = 'visible';
                            document.body.style.overflow = 'hidden';
                            menuIcon.style.display = 'none';
                            closeIcon.style.display = 'block';
                        }
                    } else {
                        console.error('Mobile sidebar or overlay not found');
                    }
                });

                closeIcon.addEventListener('click', function () {
                    if (window.innerWidth > 767) return;
                    if (mobileSidebar && overlay) {
                        closeSidebar(mobileSidebar, overlay, menuIcon, closeIcon);
                    } else {
                        console.error('Error: Mobile sidebar or overlay not found');
                    }
                });
            } else {
                console.error('Menu icon or close icon not found');
            }
        });

        window.addEventListener('resize', dynamicMobileNav);
    </script>
</body>
</html>