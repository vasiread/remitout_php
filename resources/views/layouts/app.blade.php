<!DOCTYPE html>
<html lang="en">

<head> <!-- ✅ Moved this to <head> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session()->has('user'))
        <meta name="user-session" content="true">
    @endif

    <title>@yield('title', 'Remitout')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://use.typekit.net/dhw7ffd.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preloaded Fonts -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">

    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap">

    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap">

    <!-- ✅ Global Loader CSS -->
    <style>
     #global-loader {
    position: fixed;
    top: 0%;
    left: 0%;

    width: 100vw;
    height: 100vh;
    background-color: rgba(255, 255, 255, 0.5);  
    backdrop-filter: blur(5px); 
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader-icon {
    width: 50px;
    height: 50px;
    border: 6px solid rgba(0, 0, 0, 0.1); 
    border-top: 6px solid #333;  
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    background-color: transparent;
    position: relative;
    top: 50%;
    left: 50%;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


    </style>
</head>

<body>

    {{-- Navbar --}}
    @if (request()->is('/'))
        <x-header></x-header>
    @elseif (!in_array(Route::currentRouteName(), ['login', 'signup', 'admin-page', 'nbfc-dashboard', 'terms']))
        <x-navbar></x-navbar>
    @endif

    {{-- Route-based section content --}}
    @yield(Route::currentRouteName() === 'login' ? 'logincontent' : '')
    @yield(Route::currentRouteName() === 'signup' ? 'signupcontent' : '')
    @yield(Route::currentRouteName() === 'terms' ? 'termscontent' : '')
    @yield(Route::currentRouteName() === 'student-dashboard' ? 'studentdashboard' : '')
    @yield(Route::currentRouteName() === 'sc-dashboard' ? 'scdashboard' : '')
    @yield(Route::currentRouteName() === 'adminpage' ? 'adminpage' : '')
    @yield(Route::currentRouteName() === 'nbfc-dashboard' ? 'nbfcdashboard' : '')
    @if (
    !in_array(Route::currentRouteName(), [
        'login',
        'signup',
        'admin-page',
        'nbfcdashboard',
        'sc-dashboard',
        'student-dashboard'
    ])
)
        @yield('homecontent')
    @endif

    {{-- Footer --}}
    @if (
    !in_array(Route::currentRouteName(), [
        'login',
        'signup',
        'admin-page',
        'nbfcdashboard',
        'sc-dashboard',
        'student-dashboard'
    ])
)
        <x-footer></x-footer>
    @endif

    {{-- ✅ Global Loader Element --}}
    <div id="global-loader" style="display: none;">
        <div class="loader-icon"></div>
    </div>

    {{-- ✅ JS scripts --}}
    <script>
        // Global loader
        window.Loader = {
            show() {
                document.getElementById('global-loader').style.display = 'block';
            },
            hide() {
                document.getElementById('global-loader').style.display = 'none';
            }
        };

        // Mobile nav
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuBtn = document.getElementById('menu-icon');
            if (mobileMenuBtn) {
                const mobileNav = document.getElementById('mobile-nav-links') || document.querySelector('.header-links');

                mobileMenuBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    mobileNav.classList.toggle('show');
                    mobileMenuBtn.classList.toggle('open');
                });

                if (mobileNav) {
                    const mobileLinks = mobileNav.querySelectorAll('a');
                    mobileLinks.forEach(link => {
                        link.addEventListener('click', function (e) {
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

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                alert('Please enter an email address.');
                return;
            }
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }

            window.location.href = `/signup?email=${encodeURIComponent(email)}`;
        }
    </script>

</body>

</html>