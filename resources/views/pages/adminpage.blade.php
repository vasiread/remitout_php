<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/adminpage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="superadmin-email" content="{{ env('SUPERADMIN_EMAIL') }}">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .notification-badge {
            display: none;
            position: absolute;
            top: -7px;
            right: -7px;
            background-color: #fd9c41;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
            /* line-height: 1; */
            height: 20px;
            min-width: 16px;
            text-align: center
        }
    </style>
</head>

<body>
    @php
        $admin = session('admin'); // returns null if not set
    @endphp
    <nav class="admin-nav">
        <div class="admin-nav-left">
            <div class="admin-nav-logo" onclick="window.location='/'" style="cursor: pointer;">
                <img src="assets/images/admin-logo.png" alt="Remitout Logo" class="admin-nav-logo-img">
            </div>

            <div class="back-button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span>Back</span>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="admin-mobile-menu">
            <ul class="admin-mobile-menu-list">
                <?php
                $sidebarController = new \App\Http\Controllers\SidebarHandlingController();
                $sidebarItems = $sidebarController->admindashboardItems();
                $index = 0;
                $adjustedItems = [];
                foreach ($sidebarItems as $item) {
                    if ($item['name'] === 'Student') {
                        $adjustedItems[] = [
                            'name' => 'Student',
                            'icon' => $item['icon'],
                            'active' => $item['active'],
                            'has_dropdown' => true,
                            'index' => $index++,
                        ];
                        $adjustedItems[] = [
                            'name' => 'Student List',
                            'icon' => $item['icon'], // Reuse Student icon or specify a new one
                            'active' => false,
                            'parent' => 'Student',
                            'has_dropdown' => false,
                            'index' => $index++,
                        ];
                        $adjustedItems[] = [
                            'name' => 'Application',
                            'icon' => $item['icon'], // Reuse Student icon or specify a new one
                            'active' => false,
                            'parent' => 'Student',
                            'has_dropdown' => false,
                            'index' => $index++,
                        ];
                    } elseif ($item['name'] === 'Student Counsellor') {
                        $adjustedItems[] = [
                            'name' => 'Student Counsellor',
                            'icon' => $item['icon'],
                            'active' => $item['active'],
                            'has_dropdown' => true,
                            'index' => $index++,
                        ];
                        $adjustedItems[] = [
                            'name' => 'Counsellor List',
                            'icon' => $item['icon'], // Reuse Student Counsellor icon or specify a new one
                            'active' => false,
                            'parent' => 'Student Counsellor',
                            'has_dropdown' => false,
                            'index' => $index++,
                        ];
                        $adjustedItems[] = [
                            'name' => 'Ticket Raised',
                            'icon' => $item['icon'], // Reuse Student Counsellor icon or specify a new one
                            'active' => false,
                            'parent' => 'Student Counsellor',
                            'has_dropdown' => false,
                            'index' => $index++,
                        ];
                        $adjustedItems[] = [
                            'name' => 'Add Counsellor',
                            'icon' => $item['icon'], // Reuse Student Counsellor icon or specify a new one
                            'active' => false,
                            'parent' => 'Student Counsellor',
                            'has_dropdown' => false,
                            'index' => $index++,
                        ];
                    } else {
                        $adjustedItems[] = [
                            'name' => $item['name'],
                            'icon' => $item['icon'],
                            'active' => $item['active'],
                            'has_dropdown' => false,
                            'index' => $index++,
                        ];
                    }
                }
                
                foreach ($adjustedItems as $item) {
                    $activeClass = $item['active'] ? 'active' : '';
                    $dropdownClass = $item['has_dropdown'] ? 'has-dropdown' : '';
                    $parentAttr = isset($item['parent']) ? "data-parent='{$item['parent']}'" : '';
                    echo "<li class='admin-mobile-menu-item $activeClass $dropdownClass' data-index='{$item['index']}' $parentAttr>";
                    echo "<img src='{$item['icon']}' alt='{$item['name']} icon' class='admin-mobile-menu-icon'>";
                    echo "<span>{$item['name']}</span>";
                    echo '</li>';
                }
                ?>
            </ul>
            <!-- Bottom Menu Items -->
            <ul class="admin-mobile-menu-bottom">
                <li class="logoutBtn" onclick="sessionLogout()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                </li>
                <li class="supportBtn">
                    <img src="{{ asset('assets/images/Icons/support_agent.png') }}" alt="Support icon"> Support
                </li>
            </ul>
        </div>

        <div class="admin-nav-right">
            <button class="admin-nav-search" aria-label="Search">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 19C15.4183 19 19 11 19 6.58172C19 3 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>


            <button class="admin-nav-notification">
                <span class="notification-badge"></span>

                <img src="/assets/images/notifications_unread.png" alt="the notification icon"
                    class="notification-icon">
            </button>

            <div class="admin-nav-dropdown">
                <img src="assets/images/admin-profile.png" alt="Admin avatar" class="admin-nav-avatar">
                <span class="admin-nav-name">Admin</span>
                <svg class="admin-nav-dropdown-icon" width="14" height="14" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <div class="admin-nav-dropdown-menu">
                    @if (!empty($admin) && $admin['email'] !== env('SUPERADMIN_EMAIL'))
                        <div class="admin-nav-dropdown-item" id="password-change-admin-side">
                            Password Change
                        </div>
                    @endif

                    <div class="admin-nav-dropdown-item" id="logout-admin-side">Logout</div>
                </div>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <button class="admin-nav-hamburger" aria-label="Toggle mobile menu">
                <svg class="hamburger-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6H21M3 12H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                <svg class="close-icon" style="display: none;" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </nav>

    <div class="admin-parentcontainer">
        <x-admin.adminsidebar :sidebarItems="$sidebarItems" />
        <div class="admin-detailedviewcontainer">
            <x-admin.admindashboard />
            <x-admin.adminstudent :userDetails="$userDetails" />

            <x-admin.adminstudentcounsellor />
            <x-admin.adminnbfc />
            <x-admin.adminindex />
            <x-admin.admineditcontent />
            <x-admin.adminticketraised />
            <x-admin.adminmanagestudent />
            <x-admin.adminrolemanagement />
            <x-admin.adminstudapplication />
            <x-admin.adminpromotionalemail />

        </div>
    </div>

    <!-- Password Change Overlay and Container -->
    <div class="password-change-overlay" id="adminside-password-change-overlay" style="display: none;"></div>

    <div class="password-change-container" id="adminside-password-change-container">
        <div class="password-change-triggered-view-headersection"
            id="adminside-password-change-triggered-view-headersection">
            <h3>Password Change Request</h3>
            <img src="{{ asset('assets/images/Icons/close_small.png') }}" style="cursor:pointer" alt="">
        </div>

        <!-- Current Password -->
        <div class="password-input-wrapper">
            <input type="password" placeholder="Current Password" id="adminside-current-password">
            <i class="fa-regular fa-eye-slash password-toggle" data-target="adminside-current-password"></i>
        </div>
        <span id="adminside-current-password-error" class="error-message"></span>

        <!-- New Password -->
        <div class="password-input-wrapper">
            <input type="password" placeholder="New Password" id="adminside-new-password">
            <i class="fa-regular fa-eye-slash password-toggle" data-target="adminside-new-password"></i>
        </div>
        <span id="adminside-new-password-error" class="error-message"></span>

        <!-- Confirm Password -->
        <div class="password-input-wrapper">
            <input type="password" placeholder="Confirm New Password" id="adminside-confirm-new-password">
            <i class="fa-regular fa-eye-slash password-toggle" data-target="adminside-confirm-new-password"></i>
        </div>
        <span id="adminside-confirm-new-password-error" class="error-message"></span>

        <div class="footer-passwordchange">
            <p>Forgot Password</p>
            <button id="adminside-password-change-save">Save</button>
        </div>
    </div>
    @if (session()->has('admin'))
        <script>
            var admin = @json(session('admin'));
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Unified container mapping
            const containers = {
                0: document.querySelector('.admindashboard-container'), // Dashboard
                1: document.querySelector('#index-section-admin-id'), // Index
                2: document.querySelector('.student-listcontainer'), // Student
                3: document.querySelector('.student-listcontainer'), // Student List
                4: document.querySelector('#admin-student-form-edit-container'), // Application
                5: document.querySelector('.studentcounsellorlist-adminside'), // Student Counsellor
                6: document.querySelector('.studentcounsellorlist-adminside'), // Counsellor List
                7: document.querySelector('#ticket-raised-container-admin-id'), // Ticket Raised
                8: document.querySelector('.add-studentcounsellor-adminside'), // Add Counsellor
                9: document.querySelector('.nbfclist-adminside'), // NBFC
                10: document.querySelector('#manage-student-main-admin-report-container-id'), // Manage Student
                11: document.querySelector('#role-management-container-admin-id'), // Role Management
                12: document.querySelector('#edit-content-main-section'), // Edit Content
                13: document.querySelector('#promotional-composer-main-section-id'), // Promotional Email
                'scdashboard': document.querySelector('#scdashboard-profile-adminside'),
                'studentprofile': document.querySelector('#studentprofile-section-adminsideview')
            };

            // Hamburger Menu Toggle
            const hamburgerButton = document.querySelector('.admin-nav-hamburger');
            const mobileMenu = document.querySelector('.admin-mobile-menu');
            const hamburgerIcon = document.querySelector('.admin-nav-hamburger .hamburger-icon');
            const closeIcon = document.querySelector('.admin-nav-hamburger .close-icon');
            const adminSidebar = document.querySelector('.admin-parentcontainer .admin-sidebar');

            if (hamburgerButton && mobileMenu && hamburgerIcon && closeIcon) {
                hamburgerButton.addEventListener('click', () => {
                    console.log('Hamburger menu clicked at:', new Date().toLocaleString());
                    mobileMenu.classList.toggle('active');
                    const isMenuOpen = mobileMenu.classList.contains('active');
                    hamburgerIcon.style.display = isMenuOpen ? 'none' : 'block';
                    closeIcon.style.display = isMenuOpen ? 'block' : 'none';
                    if (adminSidebar && window.innerWidth <= 768) {
                        adminSidebar.style.display = 'none';
                    }
                });
            } else {
                console.error('Hamburger menu elements not found:', {
                    hamburgerButton: !!hamburgerButton,
                    mobileMenu: !!mobileMenu,
                    hamburgerIcon: !!hamburgerIcon,
                    closeIcon: !!closeIcon
                });
            }

            // Function to hide all containers
            function hideAllContainers() {
                Object.values(containers).forEach(container => {
                    if (container) {
                        container.style.display = 'none';
                    } else {
                        console.warn('Container not found:', container);
                    }
                });
            }

            // Elements for both desktop and mobile
            const adminSidebarItems = document.querySelectorAll(
                "#commonsidebar-admin .commonsidebar-sidebarlists-top li");
            const triggeredSideBar = document.getElementById("commonsidebar-admin");
            const img = document.querySelector("#commonsidebar-admin img");
            const adminPropertyOne = document.querySelector(".admindashboard-container");
            const sidebarChevronUpDown = document.querySelector("#expand-icon-Student");
            const sidebarStudentCounsellorChevronUpDown = document.querySelector("#expand-icon-StudentCounsellor");
            const manageStudentSwitch = document.getElementById("manage-student-admindashboard");
            const expandedStudentFromAdmin = document.getElementById("expanded-student-admin-side");
            const expandedStudentCounsellorFromAdmin = document.getElementById(
                "expanded-studentcounsellor-admin-side");
            const studentFirstListChild = document.querySelector("#expanded-student-admin-side li:first-child");
            const studentCounsellorFirstListChild = document.querySelector(
                "#expanded-studentcounsellor-admin-side li:first-child");
            const adminCounsellorAdd = document.querySelector(".add-studentcounsellor-adminside");
            const studentListContainer = document.querySelector(".student-listcontainer");
            const studentApplication = document.querySelector("#admin-student-form-edit-container");
            const editContainerAdmin = document.querySelector("#edit-content-main-section");
            const studentCounsellorList = document.querySelector(".studentcounsellorlist-adminside");
            const studentNBFCList = document.querySelector(".nbfclist-adminside");
            const studentIndexAdmin = document.querySelector("#index-section-admin-id");
            const studentEditIndex = document.querySelector("#edit-content-container-id");
            const studentTicketRaised = document.querySelector("#ticket-raised-container-admin-id");
            const adminManageStudent = document.querySelector("#manage-student-main-admin-report-container-id");
            const adminRoleManagement = document.querySelector("#role-management-container-admin-id");
            const adminPromotionalEmail = document.querySelector("#promotional-composer-main-section-id");
            const nbfcAdminsideAddAuthority = document.querySelector(".add-nbfc-datasection");
            const studentProfileContainerAdminSide = document.querySelector(
                "#studentprofile-section-adminsideview");
            const addCounsellorModelTrigger = document.getElementById("switch-addcounsellor");
            const adminsideScDashboard = document.querySelector("#scdashboard-profile-adminside");

            // Mobile-specific elements
            const mobileMenuItems = document.querySelectorAll('.admin-mobile-menu-item');
            const mobileMenuBottomItems = document.querySelectorAll('.admin-mobile-menu-bottom li');

            // Track the currently selected index globally
            let currentIndex = 0; // Default to Dashboard

            // Track expanded state for mobile menu
            let expandedParents = {
                'Student': false,
                'Student Counsellor': false
            };

            // Initialize visibility
            if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
            if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";

            // Unified click handler for both desktop and mobile
            function handleItemClick(item, index, isMobile = false, isDropdownToggle = false) {
                console.log(
                    `Item clicked: index=${index}, isMobile=${isMobile}, isDropdownToggle=${isDropdownToggle}, name=${item.querySelector('span')?.textContent || 'Unknown'}`
                );

                if (!isDropdownToggle) {
                    currentIndex = index;
                }

                if (isMobile && !isDropdownToggle) {
                    mobileMenu.classList.remove('active');
                    hamburgerIcon.style.display = 'block';
                    closeIcon.style.display = 'none';
                }

                if (window.innerWidth <= 768 && triggeredSideBar && !isMobile) {
                    triggeredSideBar.style.display = "none";
                    if (img && img.src.includes("close_icon.png")) {
                        img.src = "assets/images/Icons/menu.png";
                    }
                }

                if (!isDropdownToggle) {
                    adminSidebarItems.forEach(i => i.classList.remove("active"));
                    mobileMenuItems.forEach(i => i.classList.remove("active"));
                    if (studentFirstListChild) studentFirstListChild.classList.remove("active");
                    if (studentCounsellorFirstListChild) studentCounsellorFirstListChild.classList.remove("active");
                }

                if (!isDropdownToggle) {
                    item.classList.add("active");
                    const correspondingItem = isMobile ? adminSidebarItems[index] : mobileMenuItems[index];
                    if (correspondingItem) correspondingItem.classList.add("active");
                }

                if (isMobile && isDropdownToggle) {
                    const parentName = item.querySelector('span').textContent;
                    expandedParents[parentName] = !expandedParents[parentName];
                    item.classList.toggle('expanded', expandedParents[parentName]);
                    mobileMenuItems.forEach(menuItem => {
                        if (menuItem.getAttribute('data-parent') === parentName) {
                            menuItem.classList.toggle('visible', expandedParents[parentName]);
                        }
                    });
                    if (!expandedParents[parentName]) {
                        mobileMenuItems.forEach(menuItem => {
                            if (menuItem.getAttribute('data-parent') === parentName) {
                                menuItem.classList.remove('active');
                            }
                        });
                    }
                    return;
                }

                hideAllContainers();
                getNotificationCount();
                  setInterval(getNotificationCount, 3000);


                if (index === 0) {
                    if (adminPropertyOne) adminPropertyOne.style.display = "flex";
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add(
                        "fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                } else if (index === 1) {
                    if (studentIndexAdmin) studentIndexAdmin.style.display = "flex";
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add(
                        "fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                } else if (index === 2 || index === 3) {
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (sidebarChevronUpDown) {
                        sidebarChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add(
                        "fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                    if (studentListContainer) studentListContainer.style.display = "flex";
                    if (studentApplication) studentApplication.style.display = "none";
                } else if (index === 4) {
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (sidebarChevronUpDown) {
                        sidebarChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add(
                        "fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                    if (studentApplication) studentApplication.style.display = "flex";
                    if (studentListContainer) studentListContainer.style.display = "none";
                } else if (index === 5 || index === 6) {
                    if (sidebarStudentCounsellorChevronUpDown) {
                        sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (studentCounsellorList) studentCounsellorList.style.display = "flex";
                    if (studentTicketRaised) studentTicketRaised.style.display = "none";
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                } else if (index === 7) {
                    if (sidebarStudentCounsellorChevronUpDown) {
                        sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (studentTicketRaised) studentTicketRaised.style.display = "flex";
                    if (studentCounsellorList) studentCounsellorList.style.display = "none";
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                } else if (index === 8) {
                    if (sidebarStudentCounsellorChevronUpDown) {
                        sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "flex";
                    if (studentCounsellorList) studentCounsellorList.style.display = "none";
                    if (studentTicketRaised) studentTicketRaised.style.display = "none";
                } else if (index === 9) {
                    if (studentNBFCList) studentNBFCList.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                } else if (index === 10) {
                    if (adminManageStudent) adminManageStudent.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                } else if (index === 11) {
                    if (adminRoleManagement) adminRoleManagement.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                } else if (index === 12) {
                    if (editContainerAdmin) editContainerAdmin.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                } else if (index === 13) {
                    if (adminPromotionalEmail) adminPromotionalEmail.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display =
                        "none";
                }

                if (index !== 0 && adminPropertyOne) adminPropertyOne.style.display = "none";
                if (index !== 1 && studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (index !== 2 && index !== 3 && studentListContainer) studentListContainer.style.display = "none";
                if (index !== 4 && studentApplication) studentApplication.style.display = "none";
                if (index !== 5 && index !== 6 && studentCounsellorList) studentCounsellorList.style.display =
                    "none";
                if (index !== 7 && studentTicketRaised) studentTicketRaised.style.display = "none";
                if (index !== 8 && adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                if (index !== 9 && studentNBFCList) studentNBFCList.style.display = "none";
                if (index !== 10 && adminManageStudent) adminManageStudent.style.display = "none";
                if (index !== 11 && adminRoleManagement) adminRoleManagement.style.display = "none";
                if (index !== 12 && editContainerAdmin) editContainerAdmin.style.display = "none";
                if (index !== 13 && adminPromotionalEmail) adminPromotionalEmail.style.display = "none";
                if (nbfcAdminsideAddAuthority) nbfcAdminsideAddAuthority.style.display = "none";
                if (adminsideScDashboard) adminsideScDashboard.style.display = "none";
                if (studentProfileContainerAdminSide) studentProfileContainerAdminSide.style.display = "none";
            }

            passwordForgotAdmin();
            // Desktop Sidebar Handlers
            function initializeAdminSidebar() {
                adminSidebarItems.forEach((item, index) => {
                    item.addEventListener("click", () => {
                        handleItemClick(item, index, false);
                    });
                });

                if (manageStudentSwitch) {
                    manageStudentSwitch.addEventListener('click', () => {
                        console.log('Manage Student switch clicked');
                        handleItemClick(manageStudentSwitch, 10, false);
                    });
                }

                if (addCounsellorModelTrigger && !addCounsellorModelTrigger.dataset.listenerAdded) {
                    addCounsellorModelTrigger.addEventListener('click', () => {
                        console.log('Add Counsellor trigger clicked');
                        handleItemClick(addCounsellorModelTrigger, 8, false);
                    });
                    addCounsellorModelTrigger.dataset.listenerAdded = "true";
                }
            }

            // Mobile Menu Handlers
            function initializeMobileMenu() {
                mobileMenuItems.forEach((item, index) => {
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const isDropdown = item.classList.contains('has-dropdown');
                        if (isDropdown) {
                            handleItemClick(item, index, true, true);
                        } else {
                            handleItemClick(item, index, true);
                        }
                    });
                });

                // Bottom Menu Handlers
                mobileMenuBottomItems.forEach((item) => {
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        mobileMenu.classList.remove('active');
                        hamburgerIcon.style.display = 'block';
                        closeIcon.style.display = 'none';

                        if (item.classList.contains('logoutBtn')) {
                            console.log('Mobile Log out clicked');
                            sessionLogout();
                        } else if (item.classList.contains('supportBtn')) {
                            console.log('Mobile Support clicked');
                            // Example: window.location.href = '/support';
                        }
                    });
                });
            }

            // Dropdown Menu Toggle
            const adminNavDropdown = document.querySelector('.admin-nav-dropdown');
            if (adminNavDropdown) {
                adminNavDropdown.addEventListener('click', (e) => {
                    const dropdownMenu = adminNavDropdown.querySelector('.admin-nav-dropdown-menu');
                    const dropdownIcon = adminNavDropdown.querySelector('.admin-nav-dropdown-icon');
                    if (dropdownMenu && dropdownIcon) {
                        dropdownMenu.classList.toggle('active');
                        dropdownIcon.classList.toggle('active');
                    }
                });
            }

            // Password Change Functionality
            const passwordChangeItem = document.querySelector('.admin-nav-dropdown-item:first-child');
            const passwordOverlay = document.getElementById('adminside-password-change-overlay');
            const passwordContainer = document.getElementById('adminside-password-change-container');
            const closeButton = passwordContainer?.querySelector('img[alt=""]');
            const passwordToggles = document.querySelectorAll('.password-toggle');
            const passwordInputs = [
                document.getElementById('adminside-current-password'),
                document.getElementById('adminside-new-password'),
                document.getElementById('adminside-confirm-new-password')
            ];

            if (passwordChangeItem && passwordOverlay && passwordContainer) {
                passwordChangeItem.addEventListener('click', (e) => {
                    e.stopPropagation();
                    passwordOverlay.style.display = 'block';
                    passwordContainer.style.display = 'block';
                    // Icons are already visible by default, no need to toggle visibility
                });
            }

            if (closeButton && passwordOverlay && passwordContainer) {
                closeButton.addEventListener('click', () => {
                    passwordOverlay.style.display = 'none';
                    passwordContainer.style.display = 'none';
                    passwordInputs.forEach(input => {
                        if (input) {
                            input.value = '';
                            input.type = 'password'; // Reset to hidden
                        }
                    });
                    const currentError = document.getElementById('adminside-current-password-error');
                    const newError = document.getElementById('adminside-new-password-error');
                    const confirmError = document.getElementById('adminside-confirm-new-password-error');
                    if (currentError) currentError.textContent = '';
                    if (newError) newError.textContent = '';
                    if (confirmError) confirmError.textContent = '';
                    passwordToggles.forEach(toggle => {
                        toggle.classList.remove('fa-eye');
                        toggle.classList.add('fa-eye-slash');
                        // Removed toggle.style.display = 'none'; since icons should always be visible
                    });
                });
            }

            // Toggle password visibility for each input
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const targetInput = document.getElementById(toggle.dataset.target);
                    if (targetInput) {
                        const isHidden = toggle.classList.contains('fa-eye-slash');
                        targetInput.type = isHidden ? 'text' : 'password';
                        toggle.classList.toggle('fa-eye-slash', !isHidden);
                        toggle.classList.toggle('fa-eye', isHidden);
                    }
                });
            });

            // Removed the input event listener that controlled icon visibility
            // Icons are now always visible by default

            const saveButton = document.getElementById('adminside-password-change-save');
            if (saveButton) {
                saveButton.addEventListener('click', () => {
                    const currentPassword = document.getElementById('adminside-current-password')?.value;
                    const newPassword = document.getElementById('adminside-new-password')?.value;
                    const confirmPassword = document.getElementById('adminside-confirm-new-password')
                        ?.value;

                    const currentError = document.getElementById('adminside-current-password-error');
                    const newError = document.getElementById('adminside-new-password-error');
                    const confirmError = document.getElementById('adminside-confirm-new-password-error');
                    if (currentError) currentError.textContent = '';
                    if (newError) newError.textContent = '';
                    if (confirmError) confirmError.textContent = '';

                    let isValid = true;

                    if (!currentPassword) {
                        if (currentError) currentError.textContent = 'Current password is required';
                        isValid = false;
                    }
                    if (!newPassword) {
                        if (newError) newError.textContent = 'New password is required';
                        isValid = false;
                    }
                    if (newPassword !== confirmPassword) {
                        if (confirmError) confirmError.textContent = 'Passwords do not match';
                        isValid = false;
                    }
                    if (newPassword && newPassword.length < 8) {
                        if (newError) newError.textContent = 'New password must be at least 8 characters';
                        isValid = false;
                    }

                    if (isValid) {
                        console.log('Password change submitted');
                    }
                });
            }

            // Back Button and CMS Logic
            const backButton = document.querySelector('.back-button');
            const editContentContainer = document.querySelector('.edit-content-container');
            const cmsContainer = document.querySelector('.edit-contents-cms-container');
            const searchInput = document.querySelector('#searchInput');

            function updateBackButtonVisibility() {
                const isCMSVisible = cmsContainer && (cmsContainer.style.display === 'block' || editContentContainer
                    ?.dataset.inCmsMode === 'true');
                if (backButton) backButton.style.display = isCMSVisible ? 'flex' : 'none';
            }

            if (backButton) backButton.style.display = 'none';

            function setupEditButtonHandlers() {
                document.querySelectorAll('.edit-content-button').forEach(button => {
                    button.addEventListener('click', () => {
                        const editList = document.querySelector('.edit-content-list');
                        const editHeader = document.querySelector('.edit-content-header');
                        if (editList) editList.style.display = 'none';
                        if (editHeader) editHeader.style.display = 'none';
                        if (cmsContainer) cmsContainer.style.display = 'block';
                        if (editContentContainer) editContentContainer.dataset.inCmsMode = 'true';
                        updateBackButtonVisibility();
                    });
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', updateBackButtonVisibility);
            }

            if (backButton) {
                backButton.addEventListener('click', () => {
                    if (cmsContainer) cmsContainer.style.display = 'none';
                    const editList = document.querySelector('.edit-content-list');
                    const editHeader = document.querySelector('.edit-content-header');
                    if (editList) editList.style.display = '';
                    if (editHeader) editHeader.style.display = '';
                    if (editContentContainer) editContentContainer.dataset.inCmsMode = 'false';
                    updateBackButtonVisibility();
                });
            }


            const originalRenderContent = window.renderContent || function() {};
            window.renderContent = function(data) {
                originalRenderContent(data);
                setupEditButtonHandlers();
            };

            // Responsive Handling with Active State Sync
            function handleResponsive() {
                if (window.innerWidth > 768) {
                    if (adminSidebar) adminSidebar.style.display = 'block';
                    mobileMenu.classList.remove('active');
                    hamburgerIcon.style.display = 'block';
                    closeIcon.style.display = 'none';

                    adminSidebarItems.forEach(i => i.classList.remove("active"));
                    mobileMenuItems.forEach(i => i.classList.remove("active"));
                    if (studentFirstListChild) studentFirstListChild.classList.remove("active");
                    if (studentCounsellorFirstListChild) studentCounsellorFirstListChild.classList.remove("active");

                    if (adminSidebarItems[currentIndex]) adminSidebarItems[currentIndex].classList.add("active");
                } else {
                    if (adminSidebar) adminSidebar.style.display = 'none';

                    adminSidebarItems.forEach(i => i.classList.remove("active"));
                    mobileMenuItems.forEach(i => i.classList.remove("active"));
                    if (studentFirstListChild) studentFirstListChild.classList.remove("active");
                    if (studentCounsellorFirstListChild) studentCounsellorFirstListChild.classList.remove("active");

                    if (mobileMenuItems[currentIndex]) mobileMenuItems[currentIndex].classList.add("active");

                    mobileMenuItems.forEach(item => {
                        const parentName = item.querySelector('span')?.textContent;
                        if (item.classList.contains('has-dropdown') && expandedParents[parentName]) {
                            item.classList.add('expanded');
                            mobileMenuItems.forEach(menuItem => {
                                if (menuItem.getAttribute('data-parent') === parentName) {
                                    menuItem.classList.add('visible');
                                }
                            });
                        }
                    });
                }
            }

            const passwordModelTriggerNbfc = () => {
                const passwordTrigger = document.getElementById("password-change-admin-side");
                const passwordChangeContainer = document.getElementById("#password-change-container-admin ");
                const passwordContainerExit = document.querySelector("#passowrd-changetriggered-adminside img");
                const popupPasswordShow = document.querySelector(".popup-notify-list-nbfc");
                const arrowUp = document.querySelector(".nbfc-profile .nbfc-dropdown-icon");
                const overlay = document.querySelector(".overlay-password-change-nbfc");

                if (passwordTrigger) {
                    passwordTrigger.addEventListener("click", () => {
                        if (passwordChangeContainer && overlay) {
                            passwordChangeContainer.style.display = "flex";
                            overlay.style.display = "block";
                            document.body.style.overflow = "hidden"; // Prevent background scrolling
                            if (popupPasswordShow) {
                                popupPasswordShow.style.display = "none";
                            }
                            if (arrowUp) {
                                arrowUp.style.transform = "rotate(0deg)";
                            }
                        }
                    });
                }

                if (passwordContainerExit) {
                    passwordContainerExit.addEventListener("click", () => {
                        if (passwordChangeContainer && overlay) {
                            passwordChangeContainer.style.display = "none";
                            overlay.style.display = "none";
                            document.body.style.overflow = "auto"; // Restore scrolling
                        }
                    });
                }

                // Close modal when clicking the overlay
                if (overlay) {
                    overlay.addEventListener("click", () => {
                        if (passwordChangeContainer && overlay) {
                            passwordChangeContainer.style.display = "none";
                            overlay.style.display = "none";
                            document.body.style.overflow = "auto"; // Restore scrolling
                        }
                    });
                }
            };






            const initialiseEightcolumn = () => {
                const section = document.querySelector(".eightcolumn-firstsection");

                section.addEventListener("click", function() {
                    if (section.style.height === "") {
                        section.style.height = "fit-content";
                    } else {
                        section.style.height = "";
                    }
                });
            };
            const initialiseSeventhcolumn = () => {
                const section = document.querySelector(".seventhcolum-firstsection");

                section.addEventListener("click", function() {
                    if (section.style.height === "") {
                        section.style.height = "fit-content";
                    } else {
                        section.style.height = "";
                    }
                });
            };
            const initialiseSeventhAdditionalColumn = () => {
                const section = document.querySelector(
                    ".seventhcolumn-additional-firstcolumn"
                );

                section.addEventListener("click", function() {
                    if (section.style.height === "") {
                        section.style.height = "fit-content";
                    } else {
                        section.style.height = "";
                    }
                });
            };
            const initialiseNinthcolumn = () => {

                const section = document.querySelector('.ninthcolumn-firstsection');
                section.addEventListener('click', function() {
                    if (section.style.height === '') {
                        section.style.height = 'fit-content';
                    } else {
                        section.style.height = "";
                    }
                });

            }

            function logoutadmin() {
                const logoutButton = document.getElementById('logout-admin-side');
                if (logoutButton) {
                    logoutButton.addEventListener('click', () => {
                        fetch('/api/logout', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Content-Type': 'application/json'
                                },
                                credentials: 'include'
                            })
                            .then(response => {
                                if (response.ok) {
                                    window.location.href = '/login';
                                } else {
                                    alert('Logout failed.');
                                }
                            })
                            .catch(error => {
                                console.error('Logout error:', error);
                                alert('An error occurred during logout.');
                            });
                    });
                }
            }



            const initialiseTenthcolumn = () => {
                const section = document.querySelector(".tenthcolumn-firstsection");
                section.addEventListener("click", function() {
                    if (section.style.height === "") {
                        section.style.height = "fit-content";
                    } else {
                        section.style.height = "";
                    }
                });

            }




            initializeAdminSidebar();
            initializeMobileMenu();
            setupEditButtonHandlers();
            updateBackButtonVisibility();
            handleResponsive();
            logoutadmin();

            window.addEventListener('resize', handleResponsive);
            // initialiseSeventhcolumn();
            // initialiseSeventhAdditionalColumn();
            // initialiseEightcolumn();
            // initialiseNinthcolumn();
            // initialiseTenthcolumn();

            // Set default state
            hideAllContainers();
            if (adminSidebarItems[0]) handleItemClick(adminSidebarItems[0], 0, false);

            adminPasswordChangeCheck();


        });

        const adminPasswordChangeCheck = () => {
            const saveButton = document.getElementById('adminside-password-change-save');
            if (!saveButton) return;

            saveButton.addEventListener('click', function() {
                const currentPassword = document.getElementById('adminside-current-password').value.trim();
                const newPassword = document.getElementById('adminside-new-password').value.trim();
                const confirmNewPassword = document.getElementById('adminside-confirm-new-password').value
                    .trim();
                const passwordChangeContainer = document.getElementById('adminside-password-change-container');

                clearErrorMessages();

                let valid = true;

                if (!currentPassword) {
                    displayError('adminside-current-password-error', 'Current password cannot be empty.');
                    valid = false;
                }

                if (!newPassword) {
                    displayError('adminside-new-password-error', 'New password cannot be empty.');
                    valid = false;
                } else if (newPassword.length < 8) {
                    displayError('adminside-new-password-error', 'Password must be at least 8 characters.');
                    valid = false;
                }

                if (newPassword !== confirmNewPassword) {
                    displayError('adminside-confirm-new-password-error', 'Passwords do not match.');
                    valid = false;
                }

                if (!valid) return;

                if (typeof admin === 'undefined' || !admin || !admin.email) {
                    alert("Admin session not found.");
                    return;
                }

                const superAdminEmail = document.querySelector('meta[name="superadmin-email"]')?.getAttribute(
                    'content');
                if (admin.email === superAdminEmail) {
                    alert("This is a super admin account. You cannot change the password.");
                    return;
                }

                const payload = {
                    email: admin.email,
                    currentPassword,
                    newPassword,
                };

                Loader.show();

                fetch("/api/admin/passwordchange", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content') || ''
                        },
                        body: JSON.stringify(payload),
                    })
                    .then(async res => {
                        const contentType = res.headers.get("content-type");

                        if (!res.ok) {
                            if (contentType && contentType.includes("application/json")) {
                                const errorData = await res.json();
                                alert(errorData.message || "Request failed.");
                            } else {
                                const text = await res.text();
                                alert("Server error: " + text.substring(0, 100));
                            }
                            return;
                        }

                        const data = await res.json();
                        alert(data.message || "Password updated successfully.");

                        if (passwordChangeContainer) passwordChangeContainer.style.display = 'none';

                        document.getElementById('adminside-current-password').value = '';
                        document.getElementById('adminside-new-password').value = '';
                        document.getElementById('adminside-confirm-new-password').value = '';
                    })
                    .catch(error => {
                        console.error("Fetch error:", error);
                        alert("An error occurred while changing password.");
                    })
                    .finally(() => {
                        Loader.hide();
                    });
            });
        };

        function displayError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.innerText = message;
                errorElement.style.display = 'block';
            }
        }

        function clearErrorMessages() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(el => {
                if (el.innerText !== '') {
                    el.innerText = '';
                    el.style.display = 'none';
                }
            });
        }

        function passwordForgotAdmin() {
            const forgotMailTrigger = document.querySelector(
                "#adminside-password-change-container .footer-passwordchange p");

            if (forgotMailTrigger) {
                forgotMailTrigger.addEventListener('click', () => {
                    alert("passwordchangeTriggereed")

                    if (!admin || !admin.email) {
                        alert("Admin session not found.");
                        return;
                    }

                    alert(admin.email)





                    fetch("/api/forgot-passwordmailsentsc", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                email: email
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.message) {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("There was an error while sending the email.");
                        });
                });
            }
        }

        function getNotificationCount() {
            fetch('/api/admin/messages/count')
                .then(response => response.json())
                .then(data => {
                    const totalMessages = data.total_messages;
                    const badge = document.querySelector('.notification-badge');

                    if (totalMessages > 0) {
                        badge.style.display = 'block';
                        badge.textContent = totalMessages; // optional: show the number
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching message count:', error);
                });
        }
    </script>
</body>

<script></script>

</html>
