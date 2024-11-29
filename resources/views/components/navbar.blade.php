<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<nav class="nav"
    style="@if (request()->is('/')) position: absolute; top: 0; left: 0; width: 100%; z-index: 10; @else position: relative; @endif">
        <div class="nav-container">
            @php
$navImgPath = "assets/images/Remitoutcolored.png"
            @endphp
            <img src="{{asset($navImgPath)}}" alt="Remitout Logo" class="logo">

            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#resources">Resources</a>
                <a href="#deals">Special Deals</a>
                <a href="#services">Our Service</a>
                <a href="#schedule">Schedule Call</a>
            </div>

            <div class="nav-buttons">
                <button class="login-btn" onclick="window.location.href='{{ route(name: 'login') }}'">Log In</button>
                <button class="signup-btn" onclick="window.location.href='{{ route('signup') }}'">Sign Up</button>
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
            // Menu toggle logic
            const menuIcon = document.getElementById('menu-icon');
            const navContainer = document.querySelector('.nav-container');
            const navLinks = document.querySelectorAll('.nav-links a');

            menuIcon.addEventListener('click', function () {
                menuIcon.classList.toggle('active');
                navContainer.classList.toggle('active');
                // Prevent body scrolling when menu is open
                document.body.style.overflow = navContainer.classList.contains('active') ? 'hidden' : '';
            });

            // Scroll effect for navbar
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
    </script>

</body>

</html>