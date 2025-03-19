<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
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

                    <div class="nav-profilecontainer">
                        <img src="{{ asset('assets/images/Icons/account_circle.png') }}" id="nav-profile-photo-id" class="nav-profileimg"
                            alt="Profile Image">
                        <h3>{{ session('user')->name }}</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="menubarcontainer-profile" id="user-dashboard-menu">
                     
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
                    </div>

                    <div class="menubarcontainer-profile" id="scuser-dashboard-menu">
                      
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

    
    <script>

    
    document.addEventListener('DOMContentLoaded', function () {
    // Original functions
    dynamicChangeNavMob();

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
        if (window.innerWidth <= 768) {
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
        
        if (window.innerWidth <= 768) {
            document.querySelector('.nav-links').style.display = "none";
            if (navButtons) {
                navButtons.style.display = "none";
            }
            document.getElementById('menu-icon').style.display = "flex";
        } else {
            document.querySelector('.nav-links').style.display = "flex";
            if (navButtons) {
                navButtons.style.display = "flex";
            }
            document.getElementById('menu-icon').style.display = "none";
        }
    }

    // Set up mobile menu click handler
    const menuIcon = document.getElementById('menu-icon');
    if (menuIcon && !menuIcon.hasAttribute('data-initialized')) {
        menuIcon.setAttribute('data-initialized', 'true');
        menuIcon.addEventListener('click', function() {
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (mobileSidebar && overlay) {
                // Toggle sidebar visibility
                if (mobileSidebar.classList.contains('active')) {
                    // Close the sidebar
                    mobileSidebar.classList.remove('active');
                    overlay.style.display = 'none';
                    document.body.style.overflow = '';
                    
                    // Change back to hamburger icon
                    this.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                    this.classList.remove('menu-open');
                } else {
                    // Open the sidebar
                    mobileSidebar.classList.add('active');
                    overlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                    
                    // Change to close icon
                    this.innerHTML = '<i class="fas fa-times"></i>';
                    this.classList.add('menu-open');
                }
            } else {
                // Create the sidebar and overlay if they don't exist
                createMobileSidebar();
                
                // Now that they exist, show them
                const newMobileSidebar = document.getElementById('mobile-sidebar');
                const newOverlay = document.getElementById('sidebar-overlay');
                
                if (newMobileSidebar && newOverlay) {
                    newMobileSidebar.classList.add('active');
                    newOverlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                    
                    // Change to close icon
                    this.innerHTML = '<i class="fas fa-times"></i>';
                    this.classList.add('menu-open');
                }
            }
        });
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
    const menuBarFromProfile = document.querySelector(".menubarcontainer-profile img");
    const mobileNavLinks = document.querySelector(".nav-links");
    const navButtons = document.querySelector(".nav-buttons");
    const menuIcon = document.getElementById('menu-icon');

    if (window.innerWidth <= 768) {
        if (searchTextBoxProfile) searchTextBoxProfile.style.display = "none";
        if (unreadNofifyProfile) unreadNofifyProfile.style.display = "none";
        if (nameFromProfile) nameFromProfile.style.display = "none";
        if (iconFromProfile) iconFromProfile.style.display = "none";
        if (menuBarFromProfile) menuBarFromProfile.style.display = "block";
        
        // Hide desktop navigation on mobile
        if (mobileNavLinks) mobileNavLinks.style.display = "none";
        
        // Show menu icon on mobile
        if (menuIcon) menuIcon.style.display = "flex";
    } else {
        if (searchTextBoxProfile) searchTextBoxProfile.style.display = "block";
        if (unreadNofifyProfile) unreadNofifyProfile.style.display = "block";
        if (nameFromProfile) nameFromProfile.style.display = "block";
        if (iconFromProfile) iconFromProfile.style.display = "block";
        if (menuBarFromProfile) menuBarFromProfile.style.display = "none";
        
        // Show desktop navigation on tablet/desktop
        if (mobileNavLinks) mobileNavLinks.style.display = "flex";
        
        // Hide menu icon on desktop
        if (menuIcon) menuIcon.style.display = "none";
        
        // Check current route to determine nav display
        var currentRoute = window.location.pathname;
        if (currentRoute.includes("/student-dashboard") || currentRoute.includes("/student-forms") || currentRoute.includes("/sc-dashboard")) {
            if (mobileNavLinks) mobileNavLinks.style.display = "none";
            if (navButtons) navButtons.style.display = "none";
        } else {
            if (mobileNavLinks) mobileNavLinks.style.display = "flex";
            if (navButtons) navButtons.style.display = "flex";
        }
    }
};

function createMobileSidebar() {
    // Create overlay if it doesn't exist
    let overlay = document.getElementById('sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'sidebar-overlay';
        overlay.className = 'overlay';
        document.body.appendChild(overlay);
    }
    
    // Create sidebar if it doesn't exist
    let mobileSidebar = document.getElementById('mobile-sidebar');
    if (!mobileSidebar) {
        mobileSidebar = document.createElement('div');
        mobileSidebar.id = 'mobile-sidebar';
        mobileSidebar.className = 'mobile-sidebar';
        
        // Sidebar HTML with close icon and updated content - using data attributes instead of hrefs
        mobileSidebar.innerHTML = `
            
           <div class="sidebar-menu">
    <a href="javascript:void(0)" class="menu-item active" data-container="studentdashboardprofile-trackprogress">
        <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
    </a>
    <a href="javascript:void(0)" class="menu-item" data-container="studentdashboardprofile-inbox">
        <i class="fa-solid fa-inbox"></i> Inbox
    </a>
    <a href="javascript:void(0)" class="menu-item" data-container="studentdashboardprofile-myapplication">
        <i class="fa-regular fa-clipboard"></i> My Applications
    </a>
</div>

            <div class="sidebar-footer">
                <a href="javascript:void(0)" class="menu-item logoutBtn" onclick="sessionLogout()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                </a>
                <a href="javascript:void(0)" class="menu-item" data-container="studentdashboardprofile-support">
                    <img src="assets/images/Icons/support_agent.png" alt=""> Support
                </a>
            </div>
        `;
        
        document.body.appendChild(mobileSidebar);
        
        // Event listener for the overlay - to close menu
        overlay.addEventListener('click', function() {
            mobileSidebar.classList.remove('active');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
            
            // Change close icon back to hamburger icon
            const menuIcon = document.getElementById('menu-icon');
            if (menuIcon) {
                menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                menuIcon.classList.remove('menu-open');
            }
        });
        
        // Add event listener for close button
        const closeBtn = document.getElementById('close-sidebar');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                mobileSidebar.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
                
                // Change close icon back to hamburger icon
                const menuIcon = document.getElementById('menu-icon');
                if (menuIcon) {
                    menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                    menuIcon.classList.remove('menu-open');
                }
            });
        }
        
        // Add event listeners for menu items to show containers
        const menuItems = mobileSidebar.querySelectorAll('.menu-item[data-container]');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                const containerId = this.getAttribute('data-container');
                showContainer(containerId);
                
                // Close the sidebar after clicking
                mobileSidebar.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
                
                // Change close icon back to hamburger icon
                const menuIcon = document.getElementById('menu-icon');
                if (menuIcon) {
                    menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                    menuIcon.classList.remove('menu-open');
                }
                
                // Update active class
                menuItems.forEach(mi => mi.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
    
    return { mobileSidebar, overlay };
}

// Function to show the selected container and hide others
function showContainer(containerId) {
    // Hide all containers first
    const containers = [
        'studentdashboardprofile-trackprogress',
        'studentdashboardprofile-inbox',
        'studentdashboardprofile-myapplication',
        'studentdashboardprofile-support'
    ];
    
    containers.forEach(id => {
        const container = document.getElementById(id);
        if (container) {
            container.style.display = 'none';
        }
    });
    
    // Show the selected container
    const selectedContainer = document.getElementById(containerId);
    if (selectedContainer) {
        selectedContainer.style.display = 'block';
    } else {
        console.error(`Container with ID '${containerId}' not found`);
    }
}

// Call this function on window load and resize
window.addEventListener("load", function() {
    dynamicChangeNavMob();
    
    // Show default container (dashboard) on page load
    const defaultContainer = document.getElementById('studentdashboardprofile-trackprogress');
    if (defaultContainer) {
        defaultContainer.style.display = 'block';
    }
});
window.addEventListener("resize", dynamicChangeNavMob);

const menuItems = document.querySelectorAll(".sidebar-menu .menu-item");

// Ensure the first menu item is active if no other active item is set
if (!document.querySelector(".menu-item.active") && menuItems.length > 0) {
    menuItems[0].classList.add("active");
}

menuItems.forEach((item) => {
    item.addEventListener("click", function () {
        // Remove 'active' class from all menu items
        menuItems.forEach((menu) => menu.classList.remove("active"));

        // Add 'active' class to the clicked menu item
        this.classList.add("active");
    });
});

// Add this function to handle screen resizing
function handleScreenResize() {
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const menuIcon = document.getElementById('menu-icon');
    
    if (window.innerWidth > 768) {
        // Completely hide the mobile sidebar when in desktop view
        if (mobileSidebar) {
            mobileSidebar.classList.remove('active');
            mobileSidebar.style.display = 'none'; // Hide it completely
        }
        
        if (overlay) overlay.style.display = 'none';
        document.body.style.overflow = '';
        
        // Reset menu icon
        if (menuIcon) {
            menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
            menuIcon.classList.remove('menu-open');
            menuIcon.style.display = 'none'; // Hide menu icon in desktop view
        }
    } else {
        // In mobile view, make sure the sidebar container is displayable (but still hidden until clicked)
        if (mobileSidebar) {
            mobileSidebar.style.display = ''; // Reset to default display mode
        }
        
        // Show menu icon in mobile view
        if (menuIcon) {
            menuIcon.style.display = 'flex';
        }
    }
    
    // Continue with your existing dynamicChangeNavMob function
    dynamicChangeNavMob();
}

// Modify your existing resize event listener
window.addEventListener("resize", handleScreenResize);

</script>
</body>
</html>