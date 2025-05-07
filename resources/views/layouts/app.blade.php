<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session()->has('user'))
    <meta name="user-session" content="true">
    @endif

    <title>@yield('title', 'Remitout')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <!-- Load Vite assets (CSS and JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://use.typekit.net/dhw7ffd.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


    <!-- Preload Google Fonts -->
    <!-- Preload Poppins Font -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">


    <!-- Preload Inter Font -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">


    <!-- Preload Raleway Font -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap">


    <!-- Preload Aileron Font -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap">


    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>

<body>
    @if(request()->is('/'))
    <x-header></x-header>
    @elseif(!in_array(Route::currentRouteName(), ['login', 'signup', 'admin-page', 'nbfc-dashboard', 'terms']))
    <x-navbar></x-navbar>
    @endif


    @if(Route::currentRouteName() === 'login')
    @yield('logincontent')
    @elseif(Route::currentRouteName() === 'signup')
    @yield('signupcontent')
    @elseif(Route::currentRouteName() === 'terms')
    @yield('termscontent')
    @elseif(Route::currentRouteName() === 'student-dashboard')
    @yield('studentdashboard')
    @elseif(Route::currentRouteName() === 'sc-dashboard')
    @yield('scdashboard')
    @elseif(Route::currentRouteName() === 'adminpage')
    @yield('adminpage')
    @elseif(Route::currentRouteName() === 'nbfc-dashboard')
    @yield('nbfcdashboard')

    @else
    @yield('homecontent')
    @endif

    @if(!in_array(Route::currentRouteName(), ['login', 'signup', 'admin-page', 'nbfc-dashboard', 'sc-dashboard', 'student-dashboard']))
    <x-footer></x-footer>
    @endif


    <!-- Add this script to fix mobile navigation issues -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('menu-icon');
            if (mobileMenuBtn) {
                const mobileNav = document.getElementById('mobile-nav-links') || document.querySelector('.header-links');

                mobileMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileNav.classList.toggle('show');
                    mobileMenuBtn.classList.toggle('open');
                });



                if (mobileNav) {
                    const mobileLinks = mobileNav.querySelectorAll('a');
                    mobileLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            if (this.getAttribute('href').startsWith('#')) {
                                mobileNav.classList.remove('show');
                                mobileMenuBtn.classList.remove('open');
                            }
                        });
                    });
                };
            }
        });

        function handleFooterSignup(event) {
            event.preventDefault();
            const form = event.target;
            const emailInput = form.querySelector('input[name="email"]');
            const email = emailInput.value.trim();

            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                alert('Please enter an email address.');
                return;
            }
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }

            // Redirect to signup page with email as query parameter
            window.location.href = `/signup?email=${encodeURIComponent(email)}`;
        }
    </script>
</body>

</html>