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
    dynamicChangeNavMob();

    const navButtons = document.querySelector(".nav-buttons");
    var currentRoute = window.location.pathname;
    console.log('Current Route:', currentRoute);

    @if(session('scuser'))
        retrieveProfilePictureNavSc();
    @elseif(session('user'))
        retrieveProfilePictureNav();
    @endif

    if (currentRoute.includes("/student-dashboard") || currentRoute.includes("/student-forms") || currentRoute.includes("/sc-dashboard")) {
        if (window.innerWidth <= 768) {
            document.querySelector('.nav-searchnotificationbars').style.display = "none";
            document.querySelector('.profile-photo-mobtab').style.display = "block";
        } else {
            document.querySelector('.nav-searchnotificationbars').style.display = "flex";
            document.querySelector('.profile-photo-mobtab').style.display = "none";
        }
        document.querySelector('.nav-links').style.display = "none";
        if (navButtons) navButtons.style.display = "none";
    } else {
        document.querySelector('.nav-searchnotificationbars').style.display = "none";
        if (window.innerWidth <= 768) {
            document.querySelector('.nav-links').style.display = "none";
            if (navButtons) navButtons.style.display = "none";
            document.getElementById('menu-icon').style.display = "flex";
        } else {
            document.querySelector('.nav-links').style.display = "flex";
            if (navButtons) navButtons.style.display = "flex";
            document.getElementById('menu-icon').style.display = "none";
        }
    }

    const menuIcon = document.getElementById('menu-icon');
    if (menuIcon && !menuIcon.hasAttribute('data-initialized')) {
        menuIcon.setAttribute('data-initialized', 'true');
        menuIcon.addEventListener('click', function() {
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (mobileSidebar && overlay) {
                if (mobileSidebar.classList.contains('active')) {
                    mobileSidebar.classList.remove('active');
                    overlay.style.display = 'none';
                    document.body.style.overflow = '';
                    this.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                    this.classList.remove('menu-open');
                } else {
                    mobileSidebar.classList.add('active');
                    overlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                    this.innerHTML = '<i class="fas fa-times"></i>';
                    this.classList.add('menu-open');
                }
            } else {
                createMobileSidebar();
                const newMobileSidebar = document.getElementById('mobile-sidebar');
                const newOverlay = document.getElementById('sidebar-overlay');
                if (newMobileSidebar && newOverlay) {
                    newMobileSidebar.classList.add('active');
                    newOverlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                    this.innerHTML = '<i class="fas fa-times"></i>';
                    this.classList.add('menu-open');
                }
            }
        });
    }
});

function createMobileSidebar() {
    let overlay = document.getElementById('sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'sidebar-overlay';
        overlay.className = 'overlay';
        document.body.appendChild(overlay);
    }

    let mobileSidebar = document.getElementById('mobile-sidebar');
    if (!mobileSidebar) {
        mobileSidebar = document.createElement('div');
        mobileSidebar.id = 'mobile-sidebar';
        mobileSidebar.className = 'mobile-sidebar';

        // Updated sidebar content for student counselor dashboard
        mobileSidebar.innerHTML = `
            <div class="sidebar-menu">
                <a href="javascript:void(0)" class="menu-item active" data-container="scdashboard-container">
                    <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
                </a>
                <a href="javascript:void(0)" class="menu-item" data-container="scdashboard-inboxcontent">
                    <i class="fa-solid fa-inbox"></i> Inbox
                </a>
                <a href="javascript:void(0)" class="menu-item" data-container="scdashboard-applicationstatus">
                    <i class="fa-regular fa-clipboard"></i> Applications
                </a>
            </div>
            <div class="sidebar-footer">
                <a href="javascript:void(0)" class="menu-item logoutBtn" onclick="sessionLogout()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                </a>
                <a href="javascript:void(0)" class="menu-item" data-container="scdashboard-support">
                    <img src="assets/images/Icons/support_agent.png" alt=""> Support
                </a>
            </div>
        `;

        document.body.appendChild(mobileSidebar);

        overlay.addEventListener('click', function() {
            mobileSidebar.classList.remove('active');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
            const menuIcon = document.getElementById('menu-icon');
            if (menuIcon) {
                menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                menuIcon.classList.remove('menu-open');
            }
        });

        const menuItems = mobileSidebar.querySelectorAll('.menu-item[data-container]');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                const containerClass = this.getAttribute('data-container');
                showContainer(containerClass);

                mobileSidebar.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
                const menuIcon = document.getElementById('menu-icon');
                if (menuIcon) {
                    menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
                    menuIcon.classList.remove('menu-open');
                }

                menuItems.forEach(mi => mi.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }

    return { mobileSidebar, overlay };
}

function showContainer(containerClass) {
    const containers = [
        'scdashboard-container',
        'scdashboard-inboxcontent',
        'scdashboard-applicationstatus',
        'scdashboard-support' // Note: Support container doesn't exist in scdashboard.blade.php, handle accordingly
    ];

    containers.forEach(className => {
        const container = document.querySelector(`.${className}`);
        if (container) {
            container.style.display = 'none';
        }
    });

    const selectedContainer = document.querySelector(`.${containerClass}`);
    if (selectedContainer) {
        selectedContainer.style.display = 'flex'; // Use 'flex' to match scdashboard.blade.php styling
    } else {
        console.warn(`Container with class '${containerClass}' not found`);
        // Optionally, show a fallback or default container
        const defaultContainer = document.querySelector('.scdashboard-container');
        if (defaultContainer) defaultContainer.style.display = 'flex';
    }
}

function menuopenclose() {
    const triggeredSideBar = document.querySelector(".commonsidebar-togglesidebar");
    const img = document.querySelector("#scuser-dashboard-menu img");
    if (img && triggeredSideBar) {
        if (img.src.includes("menu.png")) {
            img.src = '{{ asset('assets/images/Icons/close_icon.png') }}';
            triggeredSideBar.style.display = 'flex';
        } else if (img.src.includes("close_icon.png")) {
            img.src = '{{ asset('assets/images/Icons/menu.png') }}';
            triggeredSideBar.style.display = 'none';
        }
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
            if (profileImgUpdate) profileImgUpdate.src = data.fileUrl;
            if (mobTabProfile) mobTabProfile.src = data.fileUrl;
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
            if (profileImgUpdate) profileImgUpdate.src = data.fileUrl;
            if (mobTabProfile) mobTabProfile.src = data.fileUrl;
        } else {
            console.error("Error: No URL returned from the server", data);
        }
    } catch (error) {
        console.error("Error retrieving profile picture", error);
    }
};

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
        if (mobileNavLinks) mobileNavLinks.style.display = "none";
        if (menuIcon) menuIcon.style.display = "flex";
    } else {
        if (searchTextBoxProfile) searchTextBoxProfile.style.display = "block";
        if (unreadNofifyProfile) unreadNofifyProfile.style.display = "block";
        if (nameFromProfile) nameFromProfile.style.display = "block";
        if (iconFromProfile) iconFromProfile.style.display = "block";
        if (menuBarFromProfile) menuBarFromProfile.style.display = "none";
        if (mobileNavLinks) mobileNavLinks.style.display = "flex";
        if (menuIcon) menuIcon.style.display = "none";

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

window.addEventListener("load", function() {
    dynamicChangeNavMob();
    const defaultContainer = document.querySelector('.scdashboard-container');
    if (defaultContainer) defaultContainer.style.display = 'flex';
});

window.addEventListener("resize", function() {
    dynamicChangeNavMob();
    handleScreenResize();
});

function handleScreenResize() {
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const menuIcon = document.getElementById('menu-icon');

    if (window.innerWidth > 768) {
        if (mobileSidebar) {
            mobileSidebar.classList.remove('active');
            mobileSidebar.style.display = 'none';
        }
        if (overlay) overlay.style.display = 'none';
        document.body.style.overflow = '';
        if (menuIcon) {
            menuIcon.innerHTML = '<span class="bar"></span><span class="bar"></span><span class="bar"></span>';
            menuIcon.classList.remove('menu-open');
            menuIcon.style.display = 'none';
        }
    } else {
        if (mobileSidebar) mobileSidebar.style.display = '';
        if (menuIcon) menuIcon.style.display = 'flex';
    }
}
</script>
</body>
</html>