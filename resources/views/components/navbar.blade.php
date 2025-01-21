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
                src="{{ asset(Request::is('/') ? $navImgPathWhite : $navImgPath) }}" alt="Logo" class="logo">

            <div class="nav-links">
                <a class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}" href="{{url('/')}}">Home</a>

                <a href="#resources" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Resources</a>
                <a href="#deals" class="{{ Request::is(patterns: '/') ? '' : 'fullopacitylinks' }}">Special Deals</a>
                <a href="#services" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Our Service</a>
                <a href="#schedule" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Schedule Call</a>
            </div>

            <div class="nav-buttons">
                <button class="login-btn" onclick="window.location.href='{{ route(name: 'login') }}'">Log In</button>
                <button class="signup-btn" onclick="window.location.href='{{ route('signup') }}'">Sign Up</button>
            </div>
            <div class="nav-searchnotificationbars">
                <div class="input-container">
                    <input type="text" placeholder="Search">
                    <img src="assets/images/search.png" class="search-icon" alt="Search Icon">
                </div> <img src={{$NotificationBell}} style="width:24px;height:24px" class="unread-notify" alt="">

                <div class="nav-profilecontainer">
                    <img src="" id="nav-profile-photo-id" class="nav-profileimg" alt="">
                    @if(session()->has('user'))
                        <h3>{{ session('user')->name }}</h3>
                        <i class="fa-solid fa-chevron-down"></i>

                    @else




                    @endif
                </div>


            </div>
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
            const menuIcon = document.getElementById('menu-icon');
            const navContainer = document.querySelector('.nav-container');
            const navLinks = document.querySelectorAll('.nav-links a');
            const navLinksContainer = document.querySelector('.nav-links');
            const searchnotificationbars = document.querySelector(".nav-searchnotificationbars");
            const navigationLoginSignupButtons = document.querySelector(".nav-buttons");
            const mobTabProfile = document.querySelector(".profile-photo-mobtab img");





            window.onload = function () {
                var currentRoute = window.location.pathname;
                retrieveProfilePictureNav();

                if (currentRoute === "/student-dashboard") {
                    if (window.innerWidth <= 420) {
                        searchnotificationbars.style.display = "none";
                        mobTabProfile.style.display = "block";
                    } else {
                        searchnotificationbars.style.display = "flex";
                        mobTabProfile.style.display = "none";
                    }
                    navLinksContainer.style.display = "none";
                    navigationLoginSignupButtons.style.display = "none";
                }
                else {
                    searchnotificationbars.style.display = "none";
                    navLinksContainer.style.display = "flex";
                    navigationLoginSignupButtons.style.display = "flex";


                }
            }

            menuIcon.addEventListener('click', function () {
                menuIcon.classList.toggle('active');
                navContainer.classList.toggle('active');
                document.body.style.overflow = navContainer.classList.contains('active') ? 'hidden' : '';
            });

            const navbar = document.querySelector('.nav');
            function handleScroll() {
                if (window.scrollY > 0) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
            window.addEventListener('scroll', handleScroll);

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    menuIcon.classList.remove('active');
                    navContainer.classList.remove('active');
                    document.body.style.overflow = '';
                });
            });

            document.addEventListener('click', function (event) {
                if (!navContainer.contains(event.target) && !menuIcon.contains(event.target)) {
                    menuIcon.classList.remove('active');
                    navContainer.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        })

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







    </script>

</body>

</html>