<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <img src="{{ session('user')->profile_photo_url }}" id="nav-profile-photo-id" class="nav-profileimg"
                            alt="Profile Image">
                        <h3>{{ session('user')->name }}</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="menubarcontainer-profile" id="user-dashboard-menu">
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
                        <img src="{{ asset('assets/images/image-women.jpeg') }}" id="nav-profile-photo-id"
                            class="nav-profileimg" alt="Profile Image">
                        <h3 style='width:100%'>{{ session('scuser')->full_name }}</h3>
                        <i class="fa-solid fa-chevron-down"></i>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            dynamicChangeNavMob();

            const navButtons = document.querySelector(".nav-buttons");
            var currentRoute = window.location.pathname;
            console.log('Current Route:', currentRoute);

            retrieveProfilePictureNav();
            retrieveProfilePictureNavSc();
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
            const scuserrefid = 'HYU67994003';
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

    </script>

</body>

</html>