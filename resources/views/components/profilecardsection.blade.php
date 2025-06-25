 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>

 <body>
     @php
         $headingText = $landingpageContents[6]->content ?? null;
         $headingText = $headingText ?: 'Hear What They Say';
         $parts = explode(' ', $headingText, 3);
     @endphp

     <div class="profilecardsection">
         <div class="background-vector"></div>

         <div class="profilecardsection-inside">
             <img src="{{ asset('assets/images/rightclosevector.png') }}" alt="Left Bracket"
                 class="closedvectorimage left-bracket">

             <div class="profilecard-additionalsideheader">
                 <h2> {{ $parts[0] ?? '' }} {{ $parts[1] ?? '' }} <span>{{ $parts[2] ?? '' }}</span></h2>
             </div>
             <div class="card-container">
                 <div class="profilecard-container">
                     <div class="testimonial-slider">
                       @foreach ($combinedTestimonials as $index => $item)
    <a href="https://www.google.com/search?sxsrf=AE3TifP2rtltX0ICDfPDuUPz8ydnfyETxw:1750744407619&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-Exvv8xGhbNVFx4jzbIjNDUiAsbEED1ge2OOJApj_OZH2XotTIFB7R_rTRSoAYFOxLUMcM5d5m3ctxoF8ZvEZ79JyZiLG9_VQlTcdjznkPioSiEYygg%3D%3D&q=Remitout+Service+Pvt+Ltd+Reviews#topic=mid:/m/0414vq"
       target="_blank"
       rel="noopener noreferrer"
       style="text-decoration: none; color: inherit;">
        
        <div class="profilecardsection-individual" data-index="{{ $index }}" style="cursor: pointer;">
            <img src="{{ asset('assets/images/profileCardVector.png') }}" alt="Quote" class="quote-icon">
            
            <div class="profilecard-firstrow">
                <div class="profilecard-firstrowleft">
                    <img src="{{ asset($item['image']) }}" alt="Profile">
                </div>
                <div class="profilecard-firstrowright">
                    <h1>{{ $item['name'] }}</h1>
                    <p>{{ $item['designation'] }}</p>
                    <div class="profilecard-ratingcontainer">
                        @for ($i = 0; $i < $item['rating']; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="profilecard-secondrow">
                <p>{{ $item['description'] }}</p>
            </div>
        </div>

    </a>
@endforeach



                     </div>


                 </div>
             </div>
             <img src="{{ asset('assets/images/rightclosevector.png') }}" alt="Right Bracket"
                 class="closedvectorimage right-bracket">

             <div class="pagenavigationcontainer">
                 <button class="nav-arrow left" aria-label="Previous">
                     <i class="fa-solid fa-arrow-left"></i>
                 </button>
                 <div class="dot-container">
                     <span class="dot"></span>
                     <span class="dot"></span>
                     <span class="dot"></span>
                     <span class="dot"></span>
                 </div>
                 <button class="nav-arrow right" aria-label="Next">
                     <i class="fa-solid fa-arrow-right"></i>
                 </button>
             </div>
         </div>


         <div class="outer-container">
             <div class="inner-container">
                 <div class="logo-container">
                     @foreach ($combinedLogos as $logo)
                         <div class="logo-item">
                             <img src="{{ asset($logo['url']) }}" alt="{{ $logo['title'] ?? 'Logo' }}">
                         </div>
                     @endforeach
                 </div>



             </div>
         </div>

     </div>



     <script>
         document.addEventListener('DOMContentLoaded', function() {


             const menuIcon = document.getElementById('menu-icon');
             const navLinks = document.querySelector('.header-links');

             menuIcon.addEventListener('click', () => {

                 navLinks.classList.toggle('show');

                 menuIcon.classList.toggle('open');
             });
             const testimonialSlider = document.querySelector('.testimonial-slider');
             const prevButton = document.querySelector('.nav-arrow.left');
             const nextButton = document.querySelector('.nav-arrow.right');
             const slides = document.querySelectorAll('.profilecardsection-individual');
             const dotContainer = document.querySelector('.dot-container');
             let currentIndex = 0;

             // Clear existing dots and create new ones
             function createDots() {
                 // Clear existing dots
                 dotContainer.innerHTML = '';

                 // Create one dot for each profile card
                 for (let i = 0; i < slides.length; i++) {
                     const dot = document.createElement('span');
                     dot.classList.add('dot');

                     // Add click event to each dot
                     dot.addEventListener('click', () => {
                         currentIndex = i;
                         updateSlider();
                     });

                     dotContainer.appendChild(dot);
                 }
             }

             // Function to calculate slide width dynamically
             function getSlideWidth() {
                 const style = window.getComputedStyle(slides[0]);
                 const margin = parseFloat(style.marginRight) + parseFloat(style.marginLeft);
                 return slides[0].offsetWidth + margin;
             }

             let slideWidth = getSlideWidth();

             // Update active dot
             function updateActiveDot() {
                 // Remove active class from all dots
                 const dots = dotContainer.querySelectorAll('.dot');
                 dots.forEach(dot => dot.classList.remove('active'));

                 // Add active class to current dot
                 if (dots[currentIndex]) {
                     dots[currentIndex].classList.add('active');
                 }
             }

             // Function to update slider position
             function updateSlider() {
                 const translateX = -(currentIndex * slideWidth);
                 testimonialSlider.style.transform = `translateX(${translateX}px)`;
                 updateActiveDot();
                 toggleButtonState();
             }

             // Function to disable/enable navigation buttons
             function toggleButtonState() {
                 // Disable 'prevButton' if at the first position
                 if (currentIndex === 0) {
                     prevButton.disabled = true;
                     prevButton.classList.add('disabled');
                 } else {
                     prevButton.disabled = false;
                     prevButton.classList.remove('disabled');
                 }

                 // Disable 'nextButton' if at the last position
                 if (currentIndex >= slides.length - 1) {
                     nextButton.disabled = true;
                     nextButton.classList.add('disabled');
                 } else {
                     nextButton.disabled = false;
                     nextButton.classList.remove('disabled');
                 }
             }

             // Event listener for the 'prev' button
             prevButton.addEventListener('click', () => {
                 if (currentIndex > 0) {
                     currentIndex -= 1;
                     updateSlider();
                 }
             });

             // Event listener for the 'next' button
             nextButton.addEventListener('click', () => {
                 if (currentIndex < slides.length - 1) {
                     currentIndex += 1;
                     updateSlider();
                 }
             });

             // Recalculate everything on window resize
             window.addEventListener('resize', () => {
                 // Recalculate slide width
                 slideWidth = getSlideWidth();

                 // Update the slider
                 updateSlider();
             });

             // Initialize slider
             createDots();
             updateActiveDot();
             toggleButtonState();
             updateSlider();



             // Logo scrolling effect
             const logoContainer = document.querySelector('.logo-container');

             function autoScroll() {
                 logoContainer.style.animation = 'scroll 30s linear infinite';
             }
             autoScroll();
         });

         //smart-lending-section
     </script>
 </body>

 </html>
