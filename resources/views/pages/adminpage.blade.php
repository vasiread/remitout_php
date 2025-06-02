<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Hamburger Menu Styles */
        .admin-nav-hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .admin-nav-hamburger svg {
            width: 24px;
            height: 24px;
        }

        /* Mobile Menu Styles */
        .admin-mobile-menu {
            display: none;
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            height: calc(100vh - 60px);
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }

        .admin-mobile-menu.active {
            display: block;
            transform: translateX(0);
        }

        .admin-mobile-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-mobile-menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
            font-size: 16px;
            color: #333;
            position: relative;
        }

        .admin-mobile-menu-item.active {
            background-color: #F5A623;
            color: #ffffff;
        }

        .admin-mobile-menu-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        /* Dropdown Icon for Parent Items */
        .admin-mobile-menu-item.has-dropdown::after {
            content: '';
            display: inline-block;
            width: 14px;
            height: 14px;
            margin-left: auto;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>') no-repeat center;
            transition: transform 0.3s ease;
        }

        .admin-mobile-menu-item.has-dropdown.expanded::after {
            transform: rotate(180deg);
        }

        /* Child Items (Initially Hidden) */
        .admin-mobile-menu-item[data-parent] {
            display: none;
            padding-left: 50px; /* Indent to visually distinguish child items */
        }

        .admin-mobile-menu-item[data-parent].visible {
            display: flex;
        }

        /* Mobile-Specific Navbar Styles */
        @media (max-width: 768px) {
            .admin-nav {
                background-color: #ffffff;
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            }

            .admin-nav-left {
                gap: 0;
            }

            .admin-nav-hamburger {
                display: block;
            }

            .admin-parentcontainer .admin-sidebar {
                display: none;
            }

            .admin-nav-left .back-button {
                display: none;
            }

            .admin-nav-right {
                gap: 15px;
            }

            .admin-nav-search {
                background: none;
                border: none;
                cursor: pointer;
                padding: 8px;
            }

            .admin-nav-search svg {
                width: 24px;
                height: 24px;
            }

            .admin-nav-name {
                display: none;
            }

            .admin-nav-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
            }

            .notification-icon {
                width: 24px;
                height: 24px;
            }
        }

        /* Ensure mobile menu is hidden on desktop */
        @media (min-width: 769px) {
            .admin-mobile-menu {
                display: none !important;
            }

            .admin-nav-hamburger {
                display: none;
            }

            .admin-nav-search {
                display: none;
            }

            .admin-parentcontainer .admin-sidebar {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <div class="admin-nav-left">
            <div class="admin-nav-logo">
                <img src="assets/images/admin-logo.png" alt="Remitout Logo" class="admin-nav-logo-img">
            </div>
            <div class="back-button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                    echo "</li>";
                }
                ?>
            </ul>
        </div>

        <div class="admin-nav-right">
            <!-- Search Icon (Mobile Only) -->
            <button class="admin-nav-search">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 19C15.4183 19 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <button class="admin-nav-notification">
                <img src="/assets/images/notifications_unread.png" alt="the notification icon" class="notification-icon">
            </button>

            <div class="admin-nav-dropdown">
                <img src="assets/images/admin-profile.png" alt="Admin avatar" class="admin-nav-avatar">
                <span class="admin-nav-name">Admin</span>
                <svg class="admin-nav-dropdown-icon" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <div class="admin-nav-dropdown-menu">
                    <div class="admin-nav-dropdown-item">Password Change</div>
                    <div class="admin-nav-dropdown-item">Logout</div>
                </div>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <button class="admin-nav-hamburger" aria-label="Toggle mobile menu">
                <svg class="hamburger-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6H21M3 12H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <svg class="close-icon" style="display: none;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </nav>

    <div class="admin-parentcontainer">
        <x-admin.adminsidebar :sidebarItems="$sidebarItems" />
        <div class="admin-detailedviewcontainer">
            <x-admin.admindashboard />
            <x-admin.adminstudent :userDetails="$userDetails"/>
            <x-admin.adminstudentcounsellor/>
            <x-admin.adminnbfc/>
            <x-admin.adminindex/>
            <x-admin.admineditcontent/>
            <x-admin.adminticketraised/>
            <x-admin.adminmanagestudent/>
            <x-admin.adminrolemanagement/>
            <x-admin.adminpromotionalemail/>
            <x-admin.adminstudapplication/>
        </div>
    </div>

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

            // Hamburger Menu Toggle - Fixed Version
            const hamburgerButton = document.querySelector('.admin-nav-hamburger');
            const mobileMenu = document.querySelector('.admin-mobile-menu');
            const hamburgerIcon = document.querySelector('.admin-nav-hamburger .hamburger-icon');
            const closeIcon = document.querySelector('.admin-nav-hamburger .close-icon');
            const adminSidebar = document.querySelector('.admin-parentcontainer .admin-sidebar');

            if (hamburgerButton && mobileMenu && hamburgerIcon && closeIcon) {
                hamburgerButton.addEventListener('click', () => {
                    console.log('Hamburger menu clicked at:', new Date().toLocaleString()); // Debugging log
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
            const adminSidebarItems = document.querySelectorAll("#commonsidebar-admin .commonsidebar-sidebarlists-top li");
            const triggeredSideBar = document.getElementById("commonsidebar-admin");
            const img = document.querySelector("#commonsidebar-admin img");
            const adminPropertyOne = document.querySelector(".admindashboard-container");
            const sidebarChevronUpDown = document.querySelector("#expand-icon-Student");
            const sidebarStudentCounsellorChevronUpDown = document.querySelector("#expand-icon-StudentCounsellor");
            const manageStudentSwitch = document.getElementById("manage-student-admindashboard");
            const expandedStudentFromAdmin = document.getElementById("expanded-student-admin-side");
            const expandedStudentCounsellorFromAdmin = document.getElementById("expanded-studentcounsellor-admin-side");
            const studentFirstListChild = document.querySelector("#expanded-student-admin-side li:first-child");
            const studentCounsellorFirstListChild = document.querySelector("#expanded-studentcounsellor-admin-side li:first-child");
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
            const studentProfileContainerAdminSide = document.querySelector("#studentprofile-section-adminsideview");
            const addCounsellorModelTrigger = document.getElementById("switch-addcounsellor");
            const adminsideScDashboard = document.querySelector("#scdashboard-profile-adminside");

            // Mobile-specific elements
            const mobileMenuItems = document.querySelectorAll('.admin-mobile-menu-item');

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
                console.log(`Item clicked: index=${index}, isMobile=${isMobile}, isDropdownToggle=${isDropdownToggle}, name=${item.querySelector('span')?.textContent || 'Unknown'}`);

                // Update the current index if not just toggling the dropdown
                if (!isDropdownToggle) {
                    currentIndex = index;
                }

                // Handle mobile menu visibility
                if (isMobile && !isDropdownToggle) {
                    mobileMenu.classList.remove('active');
                    hamburgerIcon.style.display = 'block';
                    closeIcon.style.display = 'none';
                }

                // Handle sidebar visibility in mobile view
                if (window.innerWidth <= 768 && triggeredSideBar && !isMobile) {
                    triggeredSideBar.style.display = "none";
                    if (img && img.src.includes("close_icon.png")) {
                        img.src = "assets/images/Icons/menu.png";
                    }
                }

                // Remove active class from all items (including parents) if not toggling dropdown
                if (!isDropdownToggle) {
                    adminSidebarItems.forEach(i => i.classList.remove("active"));
                    mobileMenuItems.forEach(i => i.classList.remove("active"));
                    if (studentFirstListChild) studentFirstListChild.classList.remove("active");
                    if (studentCounsellorFirstListChild) studentCounsellorFirstListChild.classList.remove("active");
                }

                // Set active class only on the clicked item
                if (!isDropdownToggle) {
                    item.classList.add("active");
                    // Also set the corresponding item in the other view
                    const correspondingItem = isMobile ? adminSidebarItems[index] : mobileMenuItems[index];
                    if (correspondingItem) correspondingItem.classList.add("active");
                }

                // Handle dropdown toggle in mobile view
                if (isMobile && isDropdownToggle) {
                    const parentName = item.querySelector('span').textContent;
                    expandedParents[parentName] = !expandedParents[parentName];
                    item.classList.toggle('expanded', expandedParents[parentName]);

                    // Toggle visibility of child items
                    mobileMenuItems.forEach(menuItem => {
                        if (menuItem.getAttribute('data-parent') === parentName) {
                            menuItem.classList.toggle('visible', expandedParents[parentName]);
                        }
                    });

                    // If collapsing, ensure no child items are active
                    if (!expandedParents[parentName]) {
                        mobileMenuItems.forEach(menuItem => {
                            if (menuItem.getAttribute('data-parent') === parentName) {
                                menuItem.classList.remove('active');
                            }
                        });
                    }
                    return; // Exit early since we're only toggling the dropdown
                }

                // Hide all containers
                hideAllContainers();

                // Handle container visibility
                if (index === 0) {
                    if (adminPropertyOne) adminPropertyOne.style.display = "flex";
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                } else if (index === 1) {
                    if (studentIndexAdmin) studentIndexAdmin.style.display = "flex";
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                } else if (index === 2 || index === 3) { // Student and Student List
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (sidebarChevronUpDown) {
                        sidebarChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                    if (studentListContainer) studentListContainer.style.display = "flex";
                    if (studentApplication) studentApplication.style.display = "none";
                } else if (index === 4) { // Application
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (sidebarChevronUpDown) {
                        sidebarChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarStudentCounsellorChevronUpDown) sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-down");
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "flex";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                    if (studentApplication) studentApplication.style.display = "flex";
                    if (studentListContainer) studentListContainer.style.display = "none";
                } else if (index === 5 || index === 6) { // Student Counsellor and Counsellor List
                    if (sidebarStudentCounsellorChevronUpDown) {
                        sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (studentCounsellorList) studentCounsellorList.style.display = "flex";
                    if (studentTicketRaised) studentTicketRaised.style.display = "none";
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                } else if (index === 7) { // Ticket Raised
                    if (sidebarStudentCounsellorChevronUpDown) {
                        sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (studentTicketRaised) studentTicketRaised.style.display = "flex";
                    if (studentCounsellorList) studentCounsellorList.style.display = "none";
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "none";
                } else if (index === 8) { // Add Counsellor
                    if (sidebarStudentCounsellorChevronUpDown) {
                        sidebarStudentCounsellorChevronUpDown.classList.remove("fa-chevron-down");
                        sidebarStudentCounsellorChevronUpDown.classList.add("fa-chevron-up");
                    }
                    if (sidebarChevronUpDown) sidebarChevronUpDown.classList.add("fa-chevron-down");
                    if (adminPropertyOne) adminPropertyOne.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (adminCounsellorAdd) adminCounsellorAdd.style.display = "flex";
                    if (studentCounsellorList) studentCounsellorList.style.display = "none";
                    if (studentTicketRaised) studentTicketRaised.style.display = "none";
                } else if (index === 9) { // NBFC
                    if (studentNBFCList) studentNBFCList.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin)_.

                    expandedStudentCounsellorFromAdmin.style.display = "none";
                } else if (index === 10) { // Manage Student
                    if (adminManageStudent) adminManageStudent.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                } else if (index === 11) { // Role Management
                    if (adminRoleManagement) adminRoleManagement.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                } else if (index === 12) { // Edit Content
                    if (editContainerAdmin) editContainerAdmin.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                } else if (index === 13) { // Promotional Email
                    if (adminPromotionalEmail) adminPromotionalEmail.style.display = "flex";
                    if (expandedStudentFromAdmin) expandedStudentFromAdmin.style.display = "none";
                    if (expandedStudentCounsellorFromAdmin) expandedStudentCounsellorFromAdmin.style.display = "none";
                }

                // Hide all other containers not explicitly shown
                if (index !== 0 && adminPropertyOne) adminPropertyOne.style.display = "none";
                if (index !== 1 && studentIndexAdmin) studentIndexAdmin.style.display = "none";
                if (index !== 2 && index !== 3 && studentListContainer) studentListContainer.style.display = "none";
                if (index !== 4 && studentApplication) studentApplication.style.display = "none";
                if (index !== 5 && index !== 6 && studentCounsellorList) studentCounsellorList.style.display = "none";
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

            // Desktop Sidebar Handlers
            function initializeAdminSidebar() {
                adminSidebarItems.forEach((item, index) => {
                    item.addEventListener("click", () => {
                        handleItemClick(item, index, false);
                    });
                });

                // Handle Manage Student Switch
                if (manageStudentSwitch) {
                    manageStudentSwitch.addEventListener('click', () => {
                        console.log('Manage Student switch clicked');
                        handleItemClick(manageStudentSwitch, 10, false);
                    });
                }

                // Handle Add Counsellor Trigger
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
                            // Toggle dropdown visibility
                            handleItemClick(item, index, true, true);
                        } else {
                            // Navigate to the item's page
                            handleItemClick(item, index, true);
                        }
                    });
                });
            }

            // Dropdown Menu Toggle
            document.querySelector('.admin-nav-dropdown').addEventListener('click', () => {
                document.querySelector('.admin-nav-dropdown-menu').classList.toggle('active');
                document.querySelector('.admin-nav-dropdown-icon').classList.toggle('active');
            });

            // Back Button and CMS Logic
            const backButton = document.querySelector('.back-button');
            const editContentContainer = document.querySelector('.edit-content-container');
            const cmsContainer = document.querySelector('.edit-contents-cms-container');
            const searchInput = document.querySelector('#searchInput');

            function updateBackButtonVisibility() {
                const isCMSVisible = cmsContainer && (cmsContainer.style.display === 'block' || editContentContainer?.dataset.inCmsMode === 'true');
                backButton.style.display = isCMSVisible ? 'flex' : 'none';
            }

            backButton.style.display = 'none';

            function setupEditButtonHandlers() {
                document.querySelectorAll('.edit-content-button').forEach(button => {
                    button.addEventListener('click', () => {
                        document.querySelector('.edit-content-list').style.display = 'none';
                        document.querySelector('.edit-content-header').style.display = 'none';
                        if (cmsContainer) cmsContainer.style.display = 'block';
                        if (editContentContainer) editContentContainer.dataset.inCmsMode = 'true';
                        updateBackButtonVisibility();
                    });
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', updateBackButtonVisibility);
            }

            backButton.addEventListener('click', () => {
                if (cmsContainer) cmsContainer.style.display = 'none';
                document.querySelector('.edit-content-list').style.display = '';
                document.querySelector('.edit-content-header').style.display = '';
                if (editContentContainer) editContentContainer.dataset.inCmsMode = 'false';
                updateBackButtonVisibility();
            });

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

                    // Sync active state to desktop sidebar
                    adminSidebarItems.forEach(i => i.classList.remove("active"));
                    mobileMenuItems.forEach(i => i.classList.remove("active"));
                    if (studentFirstListChild) studentFirstListChild.classList.remove("active");
                    if (studentCounsellorFirstListChild) studentCounsellorFirstListChild.classList.remove("active");

                    if (adminSidebarItems[currentIndex]) adminSidebarItems[currentIndex].classList.add("active");
                } else {
                    if (adminSidebar) adminSidebar.style.display = 'none';

                    // Sync active state to mobile menu
                    adminSidebarItems.forEach(i => i.classList.remove("active"));
                    mobileMenuItems.forEach(i => i.classList.remove("active"));
                    if (studentFirstListChild) studentFirstListChild.classList.remove("active");
                    if (studentCounsellorFirstListChild) studentCounsellorFirstListChild.classList.remove("active");

                    if (mobileMenuItems[currentIndex]) mobileMenuItems[currentIndex].classList.add("active");

                    // Sync expanded state
                    mobileMenuItems.forEach(item => {
                        const parentName = item.querySelector('span')?.textContent;
                        if (parentName in expandedParents) {
                            item.classList.toggle('expanded', expandedParents[parentName]);
                            mobileMenuItems.forEach(menuItem => {
                                if (menuItem.getAttribute('data-parent') === parentName) {
                                    menuItem.classList.toggle('visible', expandedParents[parentName]);
                                }
                            });
                        }
                    });
                }
            }

            // Initialize
            initializeAdminSidebar();
            initializeMobileMenu();
            setupEditButtonHandlers();
            updateBackButtonVisibility();
            handleResponsive();
            window.addEventListener('resize', handleResponsive);

            // Set default state
            hideAllContainers();
            handleItemClick(adminSidebarItems[0], 0, false);
        });
    </script>
</body>
</html>