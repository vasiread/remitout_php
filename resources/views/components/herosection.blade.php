<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">



</head>


<body>

  @php
    function CmsContent($contents)
    {
        $map = [];
        foreach ($contents as $item) {
            $map[$item->section][$item->title] = $item->content;
        }
        return $map;
    }

    $cms = CmsContent($landingpageContents);

    $default = [
        'line1' => 'Secure Fast,',
        'bold' => 'Simple',
        'thin' => 'Loans for',
        'line3' => 'a Brighter Future.',
    ];

    $rawHeading = trim($cms['hero']['Special Heading'] ?? '');

    $words = str_word_count($rawHeading, 1);

    if (count($words) >= 6) {
        $line1 = "{$words[0]} {$words[1]},";
        $bold = $words[2];
        $thin = "{$words[3]} {$words[4]}";
        $line3 = implode(' ', array_slice($words, 5)) . '.';
    } else {
        $line1 = $default['line1'];
        $bold = $default['bold'];
        $thin = $default['thin'];
        $line3 = $default['line3'];
    }

    $backgroundImage = trim($cms['hero']['Background: Media'] ?? '');

    // Use default if background is empty
    $backgroundImage = $backgroundImage !== '' 
        ? $backgroundImage 
        : asset('assets/images/Banner_Remitout 1.webp');
@endphp



    <section class="hero-section">
         
       <img 
    src="{{ $backgroundImage }}" 
    alt="Hero Background" 
    class="hero-background-image">



        <div class="content-container">
            <div class="left-container">
                <h1 class="hero-title">
                    <span class="line-1">{{ $line1 }}</span>
                    <span class="line-2">
                        <span class="bold">{{ $bold }}</span>
                        <span class="thin-italic">{{ $thin }}</span>
                    </span>
                    <span class="line-3">{{ $line3 }}</span>
                </h1>



            </div>

            <!-- Right Container -->
            <div class="right-content">
                <div class="icon-title">
                    <img src="assets/images/journey icon.png" alt="Journey Icon" class="journey-icon">
                    <h2 class="journey-title">
                        {{ trim($cms['hero']['By Line'] ?? '') ?: 'Fuel Your Global Journey' }}
                    </h2>
                </div>
                <p class="journey-text">
                    {{ trim($cms['hero']['Description'] ?? '') ?: 'Trusted by 15,000+ students across India, Remitout is your partner in securing the financial support you need to succeed in your studies.' }}
                </p>

                <div class="cta-buttons">
                    <button onclick="handleLoanRedirect()" class="secure-loan">
                        {{ trim($cms['hero']['Buttonsecure'] ?? '') ?: 'Secure your loan now!' }}
                    </button>

                    <button class="watch-demo" id="watch-demo-video-trigger">
                        <img src="assets/images/play-icon.png" alt="Video Icon" class="play-icon">
                        {{ trim($cms['hero']['Button'] ?? '') ?: 'Watch Demo' }}
                    </button>

                    <video id="s3Video" width="720" height="480" controls
                        style="display: none;    
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 200vh;">
                        <source id="videoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>




        <!-- Contact Form Popup -->
        <div class="contact-form-main-container" id="contactFormPopup">
            <div class="contact-container">
                <div class="contact-close-btn">×</div>
                <h2 class="contact-title">Let's get in touch!</h2>
                <p class="contact-subtitle">
                    Write to us, our team will get back to you soon!
                </p>

                <form id="contact-form">
                    <div class="contact-input-group" id="nameGroup">
                        <img src="assets/images/full-name.png" alt="User icon" class="contact-icon" />
                        <input type="text" id="fullName" placeholder="Full Name" required class="contact-input" />
                    </div>
                    <span class="error-message" id="nameError"></span>

                    <div class="contact-input-group" id="emailGroup">
                        <img src="assets/images/mail.png" alt="Email icon" class="contact-icon" />
                        <input type="email" id="email" placeholder="Email ID" required class="contact-input" />
                    </div>
                    <span class="error-message" id="emailError"></span>

                    <div class="contact-input-group" id="phoneGroup">
                        <img src="assets/images/call.png" alt="Phone icon" class="contact-icon" />
                        <input type="tel" id="phone" placeholder="Phone Number" required
                            class="contact-input" />
                    </div>
                    <span class="error-message" id="phoneError"></span>

                    <div class="contact-input-group" id="messageGroup">
                        <textarea id="message" placeholder="Leave a message" required class="contact-textarea"></textarea>
                    </div>
                    <span class="error-message" id="messageError"></span>

                    <button type="button" id="submitButton" class="contact-submit-btn">
                        Submit
                    </button>
                </form>
            </div>
        </div>


    </section>
    </div>




</body>

<script>
    // Get elements
    const scheduleCallLink = document.getElementById("scheduleCallLink");
    const contactFormPopup = document.getElementById("contactFormPopup");
    const contactForm = document.getElementById("contact-form");
    const contactCloseBtn = document.querySelector(".contact-close-btn");
    const submitButton = document.getElementById("submitButton");

    // Form fields
    const fullNameInput = document.getElementById("fullName");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    const messageInput = document.getElementById("message");

    // Input groups
    const nameGroup = document.getElementById("nameGroup");
    const emailGroup = document.getElementById("emailGroup");
    const phoneGroup = document.getElementById("phoneGroup");
    const messageGroup = document.getElementById("messageGroup");

    // Error message elements
    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const phoneError = document.getElementById("phoneError");
    const messageError = document.getElementById("messageError");

    // Schedule Call link functionality
    if (scheduleCallLink) {
        scheduleCallLink.addEventListener("click", function(e) {
            e.preventDefault();
            openContactForm();
        });
    }

    // Function to open contact form
    function openContactForm() {
        contactFormPopup.style.display = "flex";
        document.body.style.overflow = "hidden"; // Prevent scrolling
    }

    // Close popup ONLY when close button is clicked
    if (contactCloseBtn) {
        contactCloseBtn.addEventListener("click", function() {
            closeContactForm();
        });
    }

    // Function to close contact form
    function closeContactForm() {
        contactFormPopup.style.display = "none";
        document.body.style.overflow = "auto"; // Re-enable scrolling
        resetForm();
    }

    // Reset form fields and error messages
    function resetForm() {
        contactForm.reset();
        clearErrors();
        removeErrorStyles();
    }

    // Clear all error messages
    function clearErrors() {
        nameError.textContent = "";
        emailError.textContent = "";
        phoneError.textContent = "";
        messageError.textContent = "";
    }

    // Remove error styles
    function removeErrorStyles() {
        nameGroup.classList.remove("input-error");
        emailGroup.classList.remove("input-error");
        phoneGroup.classList.remove("input-error");
        messageGroup.classList.remove("input-error");
    }

    // Validation functions with proper regex patterns
    function validateName(name) {
        // Only letters and spaces allowed, minimum 2 characters
        return /^[A-Za-z\s]{2,50}$/.test(name);
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function validatePhone(phone) {
        // Exactly 10 digits required
        return /^\d{10}$/.test(phone);
    }

    function validateMessage(message) {
        return message.trim().length > 0;
    }

    // Manual form validation and submission
    submitButton.addEventListener("click", function() {
        clearErrors();
        removeErrorStyles();

        // Get input values
        const name = fullNameInput.value.trim();
        const email = emailInput.value.trim();
        const phone = phoneInput.value.trim();
        const message = messageInput.value.trim();

        let isValid = true;

        // Validate name - only letters and spaces allowed
        if (!validateName(name)) {
            nameError.textContent =
                "Please enter a valid name (letters and spaces only)";
            nameGroup.classList.add("input-error");
            isValid = false;
        }

        // Validate email
        if (!validateEmail(email)) {
            emailError.textContent = "Please enter a valid email address";
            emailGroup.classList.add("input-error");
            isValid = false;
        }

        // Validate phone - must be exactly 10 digits
        if (!validatePhone(phone)) {
            phoneError.textContent =
                "Please enter exactly 10 digits for phone number";
            phoneGroup.classList.add("input-error");
            isValid = false;
        }

        // Validate message
        if (!validateMessage(message)) {
            messageError.textContent = "Please enter a message";
            messageGroup.classList.add("input-error");
            isValid = false;
        }

        // Only proceed if all validation passes
        if (isValid) {
            // Form is valid, you can submit the data here
            alert("Form submitted successfully!");
            closeContactForm();
        } else {
            console.log("Form validation failed. Please fix the errors.");
        }
    });

    // Real-time validation on input fields
    fullNameInput.addEventListener("input", function() {
        const name = fullNameInput.value.trim();
        if (name !== "") {
            if (!validateName(name)) {
                nameError.textContent =
                    "Please enter a valid name (letters and spaces only)";
                nameGroup.classList.add("input-error");
            } else {
                nameError.textContent = "";
                nameGroup.classList.remove("input-error");
            }
        } else {
            nameError.textContent = "";
            nameGroup.classList.remove("input-error");
        }
    });

    emailInput.addEventListener("input", function() {
        const email = emailInput.value.trim();
        if (email !== "") {
            if (!validateEmail(email)) {
                emailError.textContent = "Please enter a valid email address";
                emailGroup.classList.add("input-error");
            } else {
                emailError.textContent = "";
                emailGroup.classList.remove("input-error");
            }
        } else {
            emailError.textContent = "";
            emailGroup.classList.remove("input-error");
        }
    });

    phoneInput.addEventListener("input", function() {
        const phone = phoneInput.value.trim();

        // Restrict input to numbers only and limit to 10 digits
        phoneInput.value = phoneInput.value
            .replace(/\D/g, "")
            .substring(0, 10);

        if (phone !== "") {
            if (!validatePhone(phone)) {
                phoneError.textContent =
                    "Please enter exactly 10 digits for phone number";
                phoneGroup.classList.add("input-error");
            } else {
                phoneError.textContent = "";
                phoneGroup.classList.remove("input-error");
            }
        } else {
            phoneError.textContent = "";
            phoneGroup.classList.remove("input-error");
        }
    });

    messageInput.addEventListener("input", function() {
        const message = messageInput.value.trim();
        if (message === "") {
            messageError.textContent = "Please enter a message";
            messageGroup.classList.add("input-error");
        } else {
            messageError.textContent = "";
            messageGroup.classList.remove("input-error");
        }
    });


    function handleLoanRedirect() {
        @if (session()->has('user'))
            window.location.href = "{{ route('student-forms') }}";
        @else
            window.location.href = "/signup";
            alert("Please register your account to continue ")
        @endif
    }


    function videoInitializeFromCloud() {
        const triggerVideo = document.getElementById("watch-demo-video-trigger");

        if (triggerVideo) {
            triggerVideo.addEventListener('click', async () => {
                try {
                    const response = await fetch('/api/video-url');
                    const data = await response.json();

                    if (data.videoUrl) {
                        const video = document.getElementById('s3Video');
                        const source = document.getElementById('videoSource');
                        source.src = data.videoUrl;
                        video.load();
                        video.style.display = 'block';

                        // Wait until video is ready, then play and go fullscreen
                        video.oncanplay = () => {
                            video.play();

                            // Fullscreen handling
                            if (video.requestFullscreen) {
                                video.requestFullscreen();
                            } else if (video.webkitRequestFullscreen) {
                                video.webkitRequestFullscreen(); // Safari
                            } else if (video.msRequestFullscreen) {
                                video.msRequestFullscreen(); // IE11
                            }
                        };

                    } else {
                        alert('No video available.');
                    }
                } catch (error) {
                    console.error('Error fetching video:', error);
                    alert('Failed to load video.');
                }
            });
        }
    }


    document.addEventListener('DOMContentLoaded', () => {
        videoInitializeFromCloud();
    })
    document.addEventListener('fullscreenchange', () => {
        const video = document.getElementById('s3Video');
        if (!document.fullscreenElement) {
            video.pause();
            video.style.display = 'none';
        }
    });
</script>

</html>
