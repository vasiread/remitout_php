<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Remitout')</title>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://use.typekit.net/dhw7ffd.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


    <!-- Preload Google Fonts -->
   <!-- Preload Poppins Font -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
</noscript>

<!-- Preload Inter Font -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
</noscript>

<!-- Preload Raleway Font -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap">
    </noscript>
    
    <!-- Preload Aileron Font -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<nos    cript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap">
</no    script>
    
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>

<body>
    @if(request()->is('/'))
        <x-header></x-header>
    @elseif(!in_array(Route::currentRouteName(), ['login', 'signup', 'admin-page', 'nbfc-dashboard']))
        <x-navbar></x-navbar>
    @endif


    @if(Route::currentRouteName() === 'login')
        @yield('logincontent')
    @elseif(Route::currentRouteName() === 'signup')
        @yield('signupcontent')
    @elseif(Route::currentRouteName() === 'student-dashboard')
        @yield('studentdashboard')
    @elseif(Route::currentRouteName() === 'sc-dashboard')
        @yield('scdashboard')
    @elseif(Route::currentRouteName() === 'adminpage')
        @yield('adminpage');
    @elseif(Route::currentRouteName() === 'nbfc-dashboard')
        @yield('nbfcdashboard');
    @else
        @yield('homecontent')
    @endif
    @if(Route::currentRouteName() !== 'login' && Route::currentRouteName() !== 'signup' && Route::currentRouteName() !== 'admin-page' && Route::currentRouteName() !== 'nbfc-dashboard' && Route::currentRouteName() !== 'sc-dashboard' && Route::currentRouteName() !== 'student-dashboard')
        <x-footer></x-footer>
    @endif

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>