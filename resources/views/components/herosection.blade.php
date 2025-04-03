<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">



</head>

<body>
     <section class="hero-section">
            <div class="content-container">
                <div class="left-container">
                    <h1 class="hero-title">
                        <span class="line-1">Secure Fast,</span>
                        <span class="line-2">
                            <span class="bold">Simple </span><span class="thin-italic">Loans for</span>
                        </span>
                        <span class="line-3">a Brighter Future.</span>
                    </h1>
                </div>

                <!-- Right Container -->
                <div class="right-content">
                    <div class="icon-title">
                        <img src="assets/images/journey icon.png" alt="Journey Icon" class="journey-icon">
                        <h2 class="journey-title">Fuel Your Global Journey</h2>
                    </div>
                    <p class="journey-text">
                        Trusted by 15,000+ students across India, Remitout is your partner in securing the financial support you need to succeed in your studies.
                    </p>
                    <div class="cta-buttons">
                        <button onclick="window.location.href='{{route('student-forms')}}'" class="secure-loan">Secure your loan now!</button>
                        <button class="watch-demo">
                            <img src="assets/images/play-icon.png" alt="Video Icon" class="play-icon">
                            Watch Demo
                        </button>
                    </div>
                </div>
            </div>   



<div class="contact-form-main-container" id="contactFormPopup">
        <div class="contact-container">
            <div class="contact-close-btn">×</div>
            <h2 class="contact-title">Let's get in touch!</h2>
            <p class="contact-subtitle">Write to us, our team will get back to you soon!</p>

            <form id="contact-form">
                <div class="contact-input-group">
                    <img src="assets/images/full-name.png" alt="User icon" class="contact-icon">
                    <input type="text" placeholder="Full Name" required class="contact-input">
                </div>

                <div class="contact-input-group">
                    <img src="assets/images/mail-contact.png" alt="Email icon" class="contact-icon">
                    <input type="email" placeholder="Email ID" required class="contact-input">
                </div>

                <div class="contact-input-group">
                    <img src="assets/images/call-contact.png" alt="Phone icon" class="contact-icon">
                    <input type="tel" placeholder="Phone Number" class="contact-input">
                </div>

                <div class="contact-input-group">
                  
                    <textarea placeholder="Leave a message" class="contact-textarea"></textarea>
                </div>

                <button type="submit" class="contact-submit-btn">Submit</button>
            </form>
        </div>
    </div>


        </section>
    </div>


   

</body>

<script>
   document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const scheduleCallLink = document.getElementById('scheduleCallLink');
            const contactFormPopup = document.getElementById('contactFormPopup');
            const contactForm = document.getElementById('contact-form');
            const contactCloseBtn = document.querySelector('.contact-close-btn');

            // Schedule Call link functionality
            if (scheduleCallLink) {
                scheduleCallLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    openContactForm();
                });
            }

            // Function to open contact form
            function openContactForm() {
                contactFormPopup.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }

            // Close popup when close button is clicked
            if (contactCloseBtn) {
                contactCloseBtn.addEventListener('click', function() {
                    closeContactForm();
                });
            }

            // Close popup when clicking outside the form
            contactFormPopup.addEventListener('click', function(event) {
                if (event.target === contactFormPopup) {
                    closeContactForm();
                }
            });

            // Function to close contact form
            function closeContactForm() {
                contactFormPopup.style.display = 'none';
                document.body.style.overflow = 'auto'; // Re-enable scrolling
            }

            // Form submission
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Form submitted successfully!');
                closeContactForm();
            });
        });


        
</script>

</html>