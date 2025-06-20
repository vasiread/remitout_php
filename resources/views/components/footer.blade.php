<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Section</title>
    <link href="https://fonts.googleapis.com/css2?family=Glacial+Indifference:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Reset default margins and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .footer-section {
            width: 100%;
            background-image: url("assets/images/image.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 30px 0px;
            position: relative;
            min-height: auto;
            margin-top: auto;
        }

        .footer-container {
            max-width: 100vw;
            margin: 0 auto;
            padding: 0 90px;
        }

        .signup-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-top: 60px;
            max-width: auto;
            width: 100%;
            height: 240px;
            padding: 40px;

        }

        .signup-content {
            width: 50%;
            padding-right: 32px;
        }

        .signup-text h5 {
            font-family: 'Glacial Indifference', sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 20px !important;
            line-height: 120%;
            color: #E6E5E6;
            margin-left: 10px;
        }


        .signup-text p {
            color: #E6E6E8;
            margin: 10px;
            font-family: 'Glacial Indifference', sans-serif;
            font-weight: 300;
            font-size: 16px;
            line-height: 160%;
        }

        .signup-form {
            display: flex;
            max-width: 460px;
        }

        .input-container {
            position: relative;
            flex: 1;
        }

        .email-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
        }

        .signup-form input {
            flex: 1;
            padding: 12px 16px 12px 48px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(124, 58, 237, 0.1);
            color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            width: 358px;
            height: 56px;
            outline: none;
            transition: all 0.3s ease;
            font-family: 'Glacial Indifference', sans-serif;
        }

        .signup-form input:focus {
            border-color: transparent;
            background: rgba(124, 58, 237, 0.2);
        }

        .signup-form input::placeholder {
            color: rgba(255, 255, 255, 0.75);
            transition: opacity 0.3s ease;
        }

        .signup-form input:focus::placeholder {
            opacity: 0;
        }

        .signup-form .footer-button {
            background: #6F25CE;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 20px;
            width: 170px;
            height: 56px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-family: 'Glacial Indifference', sans-serif;

        }

        .signup-form .footer-button span {
            white-space: nowrap;
        }

        /* Footer Navigation */
        .footer-nav-section {
            width: 100%;
            max-width: 100vw;
            margin: 60px auto 20px;
            display: flex;
            justify-content: space-between;
            padding: 20px 0px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Left Column - Company Info */
        .company-info {
            width: 403px;
            margin: 0;
        }

        .company-info-container {
            display: flex;
            flex-direction: column;

        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-top: -10px;
        }

        .logo-img {
            width: 142px;
            height: 45px;
            margin-right: 12px;
            margin-bottom: 20px;
        }

        .footer-logo strong {
            color: white;
        }

        .address-container {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            width: 403px;
            padding: 10px;
        }

        .phone-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            padding: 10px;

        }

        .icon {
            width: 40px;
            height: 40px;
            padding: 6px;
        }

        .address-info {
            color: #E9E8EA;
            line-height: 160%;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            color: rgba(233, 232, 234, 0.8);
            font-weight: 400;

        }

        .company-info p {
            color: #e9d5ff;
            margin-bottom: 18px;
            font-family: 'Poppins', sans-serif;
            color: rgba(233, 232, 234, 0.8);
            line-height: 196%;
        }

        .social-links {
            display: flex;
            gap: 16px;
        }

        .social-links {
            display: flex;
            gap: 16px;
        }

        .social-link {
            display: flex;
            align-items: center;
            background-color: transparent;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            padding: 16px;
            height: 40px;
            text-decoration: none;
            color: #FFFFFF;
        }

        .social-icon {
            width: 15px;
            height: 13px;
            margin-right: 12px;
        }

        .social-link span {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 11px;
            line-height: 120%;
            color: #EEEEEE;
        }

        /* Right Column - Navigation Links */
        .footer-links {
            width: 608px;
            height: 213px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 51px;
        }

        .footer-column {
            height: auto;
        }

        .footer-column h3 {
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 24px;
            color: #E6E5E6;
            font-family: 'Glacial Indifference', sans-serif;
        }

        .footer-column a {
            text-decoration: none;
            margin-bottom: 16px;
            display: block;
            color: #D8D8D8CC;
            text-decoration: none;
            margin-bottom: 16px;
            line-height: 160%;
            font-family: 'Poppins', sans-serif;
            font-family-16px;
            font-weight: 400;
            white-space: nowrap;
            height: auto;
        }

        .copyright {
            text-align: center;
            color: #D6D3D9;
            padding: 0;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }


        /* Tablet Styles */
        @media screen and (max-width: 1024px) and (min-width: 767px) {
            .footer-logo {
                width: 100px;
                align-items: center;
                margin-top: -10px;
            }

            .footer-container {
                padding: 0px 40px;

            }

            .signup-image img {
                display: none;
            }

            .signup-content {
                width: 100%;
                padding-right: 32px;
            }

            .company-info {
                width: 200px;
                margin: 0;
            }

            .company-info-container {
                display: flex;
                flex-direction: column;
                margin-top: 200px;
            }

            .address-info {
                width: 265px;
            }

            .company-info p {
                white-space: nowrap;
            }

            .footer-links {
                width: 600px;
                height: 213px;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 0px;
            }

            .footer-column {
                height: auto;
                width: 150px;
            }

            .footer-nav-section {
                gap: 0px;
            }
        }



        @media screen and (max-width: 767px) {
            .footer-section {
                padding: 20px 0;
                text-align: center;
            }

            .footer-container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .signup-wrapper {
                padding: 20px;
                margin-top: 40px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .signup-text {
                text-align: center;
            }

            .signup-text h5 {
                font-size: 18px;
                margin-left: 0;
            }

            .signup-text p {
                font-size: 16px;
                margin: 10px auto;
            }

            .signup-content {
                width: 100%;
                padding-right: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .signup-form {
                flex-direction: column;
                width: 100%;
                max-width: 300px;
                gap: 20px;

            }

            .signup-form input {
                height: 50px;
                width: 100%;
                margin-bottom: 0px;
            }

            .signup-form .footer-button {
                height: 50px;
                margin-left: 0;
                width: 100%;
            }

            .footer-nav-section {
                margin: 40px auto 20px;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .company-info {
                width: 100%;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .company-info-container {
                align-items: center;
            }

            .footer-logo {
                justify-content: center;
                margin-bottom: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .address-container,
            .phone-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                width: 100%;
                justify-content: center;
                gap: 10px;
            }

            .address-info {
                width: 100%;
                text-align: center;
            }

            .social-links {
                flex-direction: row;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                gap: 10px;
                width: 100%;
            }

            .social-link {
                margin: 5px;
            }

            .footer-links {
                width: 100%;
                height: auto;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 30px;
                margin-top: 30px;
            }

            .footer-column {
                height: auto;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer-column h3 {
                margin-bottom: 15px;
            }

            .signup-image {
                display: none;
            }
        }

        /* Small Mobile Styles */
        @media screen and (max-width: 480px) {
            .signup-wrapper {
                height: auto;
                padding: 25px 15px;
            }

            .signup-text h5 {
                font-size: 20px;
            }

            .signup-text p {
                font-size: 14px;
            }

            .signup-form {
                max-width: 100%;
            }

            .signup-form input {
                height: 45px;
            }

            .signup-form .footer-button {
                height: 45px;
                font-size: 14px;
            }

            .footer-nav-section {
                margin: 30px auto 10px;
                padding: 10px 0;
            }

            .footer-logo {
                margin-bottom: 15px;
            }

            .logo-img {
                width: 120px;
                height: auto;
                margin-bottom: 0px;
            }

            .icon {
                width: auto;
                height: auto;
            }

            .social-link {

                height: 35px;
            }

            .footer-column {
                margin-bottom: 20px;
            }

            .footer-column h3 {
                font-size: 16px;
                margin-bottom: 12px;
            }

            .footer-column a {
                margin-bottom: 10px;
                font-size: 14px;
            }

            .copyright {
                font-size: 14px;
                padding: 10px 0;
            }

        }
    </style>
</head>

<body>

    @php

        $addressRaw = trim($landingpageContents[78]->content ?? '');
        $address =
            $addressRaw ?:
            "B/415DAMJI SHAMJI CORPORATE\nSQUARE BEHIND EVEREST GARDEN GM\nLINK RD GTK, Mumbai, Maharashtra,\nIndia, 400075";
        $addressLines = explode("\n", strip_tags($address));
    @endphp

    <footer class="footer-section">
        <div class="footer-container">
            <!-- Signup Container -->
            <div class="signup-wrapper">
                <div class="signup-content">
                    <div class="signup-text">

                        <h5>{{ trim($landingpageContents[82]->content ?? '') ?: 'Sign Up with us Today!' }} </h5>


                        <p>Prepare yourself and let's explore this world.</p>
                    </div>

                    <form class="signup-form" id="signupForm" onsubmit="handleFooterSignup(event)">
                        <div class="input-container">
                            <img src="assets/images/message-icon.png" class="email-icon" alt="email icon">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <button type="submit"
                            class="footer-button"><span>{{ trim($landingpageContents[84]->content ?? '') ?: 'Register Now!' }}
                            </span></button>
                    </form>

                </div>
                <div class="signup-image">
                    <!-- Image content here if needed -->
                    <img src="assets/images/Globe.WebP" class="footer-globe" alt="Globe image">
                </div>
            </div>

            <!-- Footer Navigation Section -->
            <div class="footer-nav-section">
                <!-- Company Info -->
                <div class="company-info">

                    <div class="footer-logo">
                        <img src="assets/images/footer-logo.png" alt="Remitout" class="logo-img">
                    </div>
                    <div class="company-info-container">
                        <div class="address-container">
                            <img src="assets/images/addres-icon.png " alt="Address" class="icon">
                            <div class="address-info">
                                @foreach ($addressLines as $line)
                                    {{ trim($line) }}<br>
                                @endforeach
                            </div>
                        </div>
                        <div class="phone-container">
                            <img src="assets/images/phone-icon.png" alt="Phone" class="icon">
                            <span style="color: rgba(233, 232, 234, 0.8);">
                              {{ trim($landingpageContents[79]->content ?? '') ?: '+91 75784 75788' }}
                              
                            </span>
                        </div>
                        <p>Reach us through other platforms!</p>
                        <div class="social-links">
                            <a href="https://x.com/RemitoutL" class="social-link">
                                <img src="assets/images/Twitter.png" alt="Twitter" class="social-icon"
                                    style="width: 15px; height: 13px;">
                                <span
                                    style="font-family: 'Poppins', sans-serif; font-weight: normal; font-size: 11px;">Twitter</span>
                            </a>
                            <a href="https://www.instagram.com/remitout_india/" class="social-link">
                                <img src="assets/images/Instagram.png" alt="Instagram" class="social-icon"
                                    style="width: 15px; height: 13px;">
                                <span
                                    style="font-family: 'Poppins', sans-serif; font-weight: normal; font-size: 11px;">Instagram</span>
                            </a>
                            <a href="https://www.facebook.com/RemitoutIN/" class="social-link">
                                <img src="assets/images/Facebook.png" alt="Facebook" class="social-icon"
                                    style="width: 15px; height: 13px;">
                                <span
                                    style="font-family: 'Poppins', sans-serif; font-weight: normal; font-size: 11px;">Facebook</span>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="footer-links">
                    <div class="footer-column">
                        <h3>Company</h3>
                        <a href="#">About</a>
                        <a href="#">Alliance</a>
                        <a href="#">Blogs</a>
                        <a href="#">Privacy Policy</a>
                    </div>
                    <div class="footer-column">
                        <h3>Contact</h3>
                        <a href="#">Contact us</a>
                        <a href="#">Partner with us</a>
                        <a href="#">FAQ's</a>
                    </div>
                    <div class="footer-column">
                        <h3>Our Services</h3>
                        <a href="#">Student accommodation</a>
                        <a href="#">Exchange Currency</a>
                        <a href="#">Forex Card</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
         
            {{ trim($landingpageContents[87]->content ?? '') ?: 'All Rights reserved' }}
        </div>
    </footer>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            console.log('Email submitted:', email);
        });
    </script>

</body>

</html>
