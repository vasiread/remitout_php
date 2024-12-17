@php
    $profileCards = [
        [
            "name" => "Mark Debrovski",
            "role" => "Designation",
            "starrating" => 5,
            "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.",
            "image" => asset('assets/images/Person.png')
        ],
        [
            "name" => "Debrovski",
            "role" => "Designation",
            "starrating" => 4,
            "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.",
            "image" => asset('assets/images/person5.avif')
        ],
        [
            "name" => "Mark Debrovski",
            "role" => "Designation",
            "starrating" => 5,
            "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.",
            "image" => asset('assets/images/person3.avif')
        ],
        [
            "name" => "Mark Debrovski",
            "role" => "Designation",
            "starrating" => 5,
            "description" => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.",
            "image" => asset('assets/images/Person.png')
        ],
    ];
@endphp

<div class="profilecardsection">
    <div class="background-vector"></div>

    <div class="profilecardsection-inside">
        <img src="{{ asset('assets/images/rightclosevector.png') }}" alt="Left Bracket"
            class="closedvectorimage left-bracket">

        <div class="profilecard-additionalsideheader">
            <h2>Hear What <span>They</span> Say</h2>
        </div>

        <div class="profilecard-container">
            <div class="testimonial-slider">
                @foreach ($profileCards as $index => $items)
                    <div class="profilecardsection-individual" data-index="{{ $index }}">
                        <img src="{{ asset('assets/images/profileCardVector.png') }}" alt="Quote" class="quote-icon">
                        <div class="profilecard-firstrow">
                            <div class="profilecard-firstrowleft">
                                <img src="{{ $items['image'] }}" alt="Profile">
                            </div>
                            <div class="profilecard-firstrowright">
                                <h1>{{ $items['name'] }}</h1>
                                <p>{{ $items['role'] }}</p>
                                <div class="profilecard-ratingcontainer">
                                    @for ($i = 0; $i < $items['starrating']; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="profilecard-secondrow">
                            <p>{{ $items['description'] }}</p>
                        </div>
                    </div>
                @endforeach
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
                <span class="middle-dot active"></span>
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
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo 1">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo 2">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="Logo 3">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo4.png') }}" alt="Logo 4">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo5.png') }}" alt="Logo 5">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo 1">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo 2">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="Logo 3">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo4.png') }}" alt="Logo 4">
            </div>
            <div class="logo-item">
                <img src="{{ asset('assets/images/logo5.png') }}" alt="Logo 5">
            </div>
        </div>
    </div>
 </div>

</div> 






<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>




    <script>

        document.addEventListener('DOMContentLoaded', function () {



            const testimonialSlider = document.querySelector('.testimonial-slider');
            const prevButton = document.querySelector('.nav-arrow.left');
            const nextButton = document.querySelector('.nav-arrow.right');
            const dots = document.querySelectorAll('.dot');
            const slides = document.querySelectorAll('.profilecardsection-individual');
            let currentIndex = 0;
            const cardsPerView = 2; // Number of cards visible at a time

            function getSlideWidth() {
                return slides[0].offsetWidth + 20; // Includes margin
            }

            let slideWidth = getSlideWidth();
            const totalSlides = Math.ceil(slides.length / cardsPerView);

            // Update slider position
            function updateSlider() {
                const translateX = -(currentIndex * slideWidth * cardsPerView);
                testimonialSlider.style.transform = `translateX(${translateX}px)`;
                updateDots();
            }

            // Update active dot
            function updateDots() {
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }

            // Arrow button navigation
            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; // Circular navigation
                updateSlider();
            });

            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides; // Circular navigation
                updateSlider();
            });

            // Initialize slider
            updateSlider();

            // Recalculate the slider width and update on window resize
            window.addEventListener('resize', () => {
                slideWidth = getSlideWidth(); // Recalculate slide width
                updateSlider(); // Reapply the correct transformation
            });

            // Logo scrolling effect
            const logoContainer = document.querySelector('.logo-container');
            function autoScroll() {
                logoContainer.style.animation = 'scroll 30s linear infinite';
            }
            autoScroll();
        });

        //smart-lending-section
        document.getElementById('loanButton').addEventListener('click', function () {
            console.log('Loan button clicked');
        });



    </script>
</body>

</html>