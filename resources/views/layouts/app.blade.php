<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Remitout')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="assets/css/navbar.css">


    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/loginsignup.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/studentdashboard.css">


    <link rel="stylesheet" href="assets/css/footer.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aileron:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    @if(Route::currentRouteName() !== 'login' && Route::currentRouteName() !== 'signup')
        <x-navbar></x-navbar>
    @endif

    @if(Route::currentRouteName() === 'login')
        @yield('logincontent')  
    @elseif(Route::currentRouteName() === 'signup')
        @yield('signupcontent')  
    @elseif(Route::currentRouteName() === 'student-dashboard')
        @yield("studentdashboard")
    @else
        @yield('homecontent') 
    @endif

    @if(Route::currentRouteName() !== 'login' && Route::currentRouteName() !== 'signup')
        <x-footer></x-footer>
    @endif


        <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>