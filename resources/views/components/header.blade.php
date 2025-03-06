<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Remitout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Header Navigation */
        .header-nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
             background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.25),
                rgba(111, 37, 206, 0.15)
            );
             box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);  
              font-family: 'Poppins', sans-serif;
           
        }

        /* Container */
        .header-container {
            height: 85px;
            padding: 20px 88px;
            display: flex;
             margin:0 auto;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
           
        }

        .fullopacity {
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Logo */
        .header-logo-link .logo {
            width: 138px;
            height: auto;
            margin-left: 45px;
            cursor: pointer;
        }

        /* Navigation Buttons */
        .header-buttons {
            display: flex;
            gap: 16px;
            align-items: center;
            margin-left:50px;
        }

        .header-login-btn,
        .header-signup-btn {
            min-width: 100px;
            height: 42px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            padding: 0 20px;
              font-family: 'Poppins', sans-serif;
        }

        .header-login-btn {
            background: white;
            color: black;
        }

        .header-signup-btn {
            background: #6F25CE;
            color: white;
            width: 119px;
        }

        .header-login-btn:hover {
            background: #f5f5f5;
        }

        .header-signup-btn:hover {
            background: #8B3EEB;
        }

        /* Navigation Links */
        .header-links {
            display: flex;
            gap: 48px;
            align-items: center;
        }
        

        .header-links a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 400;
            transition: color 0.3s ease;
            letter-spacing: 1px;
        }

        .header-links a:hover {
            color: #e0e0e0;
        }

        .fullopacitylinks {
            color: #333 !important;
        }

        /* Mobile Links */
        .header-mobile-link {
            display: none;
        }

        /* Menu Icon */
        .header-menu-icon {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .header-menu-icon .bar {
            width: 30px;
            height: 4px;
            background-color: white;
            border-radius: 2px;
        }

@media (min-width: 1513px) { 
    .header-container {
        height: 85px;
        width: 1470px;
        padding: 20px 88px;
        display: flex;
        margin: 0 auto;
        justify-content: space-between;
        align-items: center;
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
    }


          }

        @media (max-width: 1024px){
             .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                position: relative;
            }

            .header-logo-link .logo {
                margin-left: 0;
            }

            .header-links {
                display: none;
                flex-direction: column;
                gap: 0;
                position: absolute;
                top: 85px;
                 height: calc(100vh - 85px);
                left: 0;
                width: 100%;
                background-color: #FFFFFF;
                padding: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 999;
                overflow-y: auto;
            }

            .header-links a {
                font-size: 20px;
                color: #333;
                display: block;
                padding: 20px;
                width: 100%;
                padding-left: 40px;
                padding-right: 20px;
                text-align: left;
                border-bottom: 1px solid #DEDEE0;
            }

            .header-links a:last-of-type {
                border-bottom: none;
            }

            .header-mobile-link {
                display: block;
            }

            .header-buttons {
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 20px;
                padding-bottom: 20px;
                width: 100%;
                margin: 0 auto;
                font-size: 20px;
                font-weight:500;
                padding-top: 80px;
                height: auto;
            }

            .header-signup-btn {
                width: 100%;
                max-width: 480px;
                height: 54px;
                font-size: 20px;
                line-height: 54px;
                text-align: center;
                border-radius: 5px;
                cursor: pointer;
                box-sizing: border-box;
                padding-left: 0;
                background-color: #260254;
                color: #FFFFFF;
                border: none;
            }

            .header-login-btn {
                width: 100%;
                max-width: 480px;
                height: 54px;
                font-size: 20px;
                line-height: 54px;
                text-align: center;
                border-radius: 5px;
                cursor: pointer;
                box-sizing: border-box;
                padding-left: 0;
                border: 1px solid #260254;
                background-color: #FFFFFF;
                color: #260254;
            }

            .header-menu-icon {
                display: flex;
                white-space: nowrap;
            }

            .header-menu-icon .bar {
                width: 30px;
                height: 4px;
                background-color: white;
                border-radius: 2px;
                transition: all 0.3s ease;
            }

            .header-links a:hover {
                color: #525252;
            }

            .header-menu-icon.open .bar:nth-child(1) {
                transform: translateY(9px) rotate(45deg);
            }

            .header-menu-icon.open .bar:nth-child(2) {
                opacity: 0;
            }

            .header-menu-icon.open .bar:nth-child(3) {
                transform: translateY(-9px) rotate(-45deg);
            }

            .header-links.show {
                display: block;
            }
            
        }

        /* Mobile Device */
        @media (max-width: 768px) {
            .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                position: relative;
            }

            .header-logo-link .logo {
                margin-left: 0;
            }

            .header-links {
                display: none;
                flex-direction: column;
                gap: 0;
                position: absolute;
                top: 85px;
                 height: calc(100vh - 85px);
                left: 0;
                width: 100%;
                background-color: #FFFFFF;
                padding: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 999;
                overflow-y: auto;
            }

            .header-links a {
                font-size: 20px;
                color: #333;
                display: block;
                padding: 20px;
                width: 100%;
                padding-left: 40px;
                padding-right: 20px;
                text-align: left;
                border-bottom: 1px solid #DEDEE0;
            }

            .header-links a:last-of-type {
                border-bottom: none;
            }

            .header-mobile-link {
                display: block;
            }

            .header-buttons {
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 20px;
                padding-bottom: 20px;
                width: 100%;
                margin: 0 auto;
                font-size: 20px;
                padding-top: 80px;
                height: auto;
                margin-left:40px;
            }

            .header-signup-btn {
                width: 100%;
                max-width: 480px;
                height: 54px;
                font-size: 20px;
                line-height: 54px;
                text-align: center;
                border-radius: 5px;
                cursor: pointer;
                box-sizing: border-box;
                padding-left: 0;
                background-color: #260254;
                color: #FFFFFF;
                border: none;
            }

            .header-login-btn {
                width: 100%;
                max-width: 480px;
                height: 54px;
                font-size: 20px;
                line-height: 54px;
                text-align: center;
                border-radius: 5px;
                cursor: pointer;
                box-sizing: border-box;
                padding-left: 0;
                border: 1px solid #260254;
                background-color: #FFFFFF;
                color: #260254;
            }

            .header-menu-icon {
                display: flex;
                white-space: nowrap;
            }

            .header-menu-icon .bar {
                width: 30px;
                height: 4px;
                background-color: white;
                border-radius: 2px;
                transition: all 0.3s ease;
            }

            .header-links a:hover {
                color: #525252;
            }

            .header-menu-icon.open .bar:nth-child(1) {
                transform: translateY(9px) rotate(45deg);
            }

            .header-menu-icon.open .bar:nth-child(2) {
                opacity: 0;
            }

            .header-menu-icon.open .bar:nth-child(3) {
                transform: translateY(-9px) rotate(-45deg);
            }

            .header-links.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <nav class="header-nav" 
        style="@if (request()->is('/')) position: absolute; top: 0; left: 0; width: 100%; z-index: 10; @else position: relative; @endif">
        <div class="{{ Request::is('/') ? 'header-container' : 'header-container fullopacity' }}">
            @php
                $navImgPath = "assets/images/Remitoutcolored.png";
                $navImgPathWhite = "assets/images/RemitoutLogoWhite.png";
            @endphp

            <a href="{{ url('/') }}" class="header-logo-link">
                <img src="{{ asset(Request::is('/') ? $navImgPathWhite : $navImgPath) }}" alt="Remitout Logo" class="logo">
            </a>

            <div class="header-links">
            
                <a class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}" href="{{url('/')}}">Home</a>
                <a href="#resources" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Resources</a>
                <a href="#deals" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Special Deals</a>
                <a href="#services" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Our Service</a>
                <a href="#schedule" class="{{ Request::is('/') ? '' : 'fullopacitylinks' }}">Schedule Call</a>
                <a href="#support" class="header-mobile-link {{ Request::is('/') ? '' : 'fullopacitylinks' }}">Support</a>
                <a href="#help" class="header-mobile-link {{ Request::is('/') ? '' : 'fullopacitylinks' }}">Help</a>
             
             <div class="header-buttons">
                    <button class="header-login-btn" onclick="window.location.href='{{ route('login') }}'">Log In</button>
                    <button class="header-signup-btn" onclick="window.location.href='{{ route('signup') }}'">Sign Up</button>
                </div>
                
            </div>
            

            <div class="header-menu-icon" id="menu-icon">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuIcon = document.getElementById('menu-icon'); 
            const navLinks = document.querySelector('.header-links'); 

            menuIcon.addEventListener('click', () => {
                navLinks.classList.toggle('show');
                menuIcon.classList.toggle('open');
            });
        });
    </script>
</body>
</html>