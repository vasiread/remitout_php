<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <?php $navigationLogo ="assets/images/Remitoutcolored.png"?>
    <nav>
        <div class="container">
             <img src="<?php echo $navigationLogo; ?>"> 
            <ul class="nav-list">
                <li><a href="/">Home</a></li>
                <li><a href="/resource">Resource</a></li>
                <li><a href="/specialdeals">Special Deals</a></li>
                <li><a href="/service">Our Service</a></li>
                <li><a href="/schedulecalls">Schedule Call</a></li>
            </ul>
            <div class="signuplogincontainer">
                <button class="loginbutton" onclick="window.location.href='{{route('login')}}'">Login</button>
                <button class="signupbutton" onclick="window.location.href='{{ route('signup') }}'">Signup </button>

            </div>
        </div>
    </nav>
</body>

</html>