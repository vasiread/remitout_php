<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
$firstLayerRectangle = "assets/images/footerlayers/Rectangle 643.png";
$footerlogo = "assets/images/Remitoutcolored.png";
    ?>
    <div class="footersection-layers">
        <!-- <img src="<?php echo $firstLayerRectangle; ?>" class="firstlayer" alt=""> -->
    </div>
    <div class="footersection">
        <div class="footersection-reachoutsection">
            <div class="footersection-reachoutinside">
                <div class="footersection-reachoutleft">
                    <h1>Sign Up with us Today!</h1>
                    <p>Prepare yourself and let’s explore this world</p>
                    <div class="footersection-reachoutinput">
                        <div class="reachoutinputemail">
                            <input type="text" name="" placeholder="Your Email">
                            <i class="fa-solid fa-envelope"></i>


                        </div>
                        <button>Register Now!</button>
                    </div>


                </div>
                <?php $globeImage = "assets/images/globe.png";?>

                <div class="footersection-reachoutright">
                    <img src="<?php echo $globeImage ?>" alt="">
                </div>

            </div>

        </div>
        <hr class="footer-firsthorizontalline" />
        <div class="footersection-container">
            <div class="footersection-insidecontainer">
                <div class="footersection-leftinsidecontainer">
                    <img src="<?php echo $footerlogo; ?>" alt="">
                    <div class="footersection-addressinfo">
                        <i class="fa-solid fa-location-dot" style="color:rgba(233, 232, 234, 0.8);"></i>
                        <p>B/415DAMJI SHAMJI CORPORATE SQUARE BEHIND, EVEREST GARDEN GM LINK RD GTK, Mumbai,
                            Maharashtra, India, 400075</p>
                    </div>
                    <div class="footersection-contactinfo">
                        <i class="fa-solid fa-phone" style="color:rgba(233, 232, 234, 0.8)"></i>
                        <p>+91 75784 75788</p>
                    </div>
                    <p class="footer-smallinfo">Reach us through other platforms!</p>
                    <div class="footersection-socialmediabuttons">
                        <button>
                            <i class="fa-brands fa-twitter"></i>
                            <p>Twitter</p>
                        </button>
                        <button>
                            <i class="fa-brands fa-instagram"></i>
                            <p>Instagram</p>
                        </button>
                        <button>
                            <i class="fa-brands fa-facebook-f"></i>
                            <p>Facebook</p>
                        </button>
                    </div>
                </div>

                <div class="footersection-rightinsidecontainer">
                    <ul class="footersection-companyinfolists">
                        <p>Company</p>
                        <li>About</li>
                        <li>Alliance</li>
                        <li>Blogs</li>
                        <li>Privacy Policy</li>
                    </ul>
                    <ul class="footersection-contactinfolists">
                        <p>Contact</p>
                        <li>Contact us</li>
                        <li>Partner with Us</li>
                        <li>FAQ's</li>
                    </ul>
                    <ul class="footersection-ourserviceslists">
                        <p>Our Services</p>
                        <li>Student accommodation</li>
                        <li>Exchange Currency</li>
                        <li>Forex Card</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="footer-secondhorizontalline" />
        <p class="footer-rights">All Rights reserved</p>
    </div>
</body>

</html>