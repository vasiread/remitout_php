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
     <div class="card-container">
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
    const dots = document.querySelectorAll('.dot-container span');
    let currentIndex = 0;
    
    // Responsive cards per view - 1 on mobile, 2 on desktop
    function getCardsPerView() {
        return window.innerWidth <= 768 ? 1 : 2;
    }
    
    let cardsPerView = getCardsPerView();
    
    // Function to calculate slide width dynamically
    function getSlideWidth() {
        const style = window.getComputedStyle(slides[0]);
        const margin = parseFloat(style.marginRight) + parseFloat(style.marginLeft);
        return slides[0].offsetWidth + margin;
    }
    
    let slideWidth = getSlideWidth();
    
    // Function to update slider position
    function updateSlider() {
        const translateX = -(currentIndex * slideWidth);
        testimonialSlider.style.transform = `translateX(${translateX}px)`;
        updateDots();
        toggleButtonState();
    }
    
    // Function to update active dot
    function updateDots() {
        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        // Calculate which dot should be active based on current index
        const totalPositions = Math.ceil(slides.length / cardsPerView);
        
        // Map the currentIndex to a dot index (0, 1, or 2)
        const activeDotIndex = Math.min(
            Math.floor(currentIndex / cardsPerView),
            dots.length - 1
        );
        
        // Add active class to the current dot
        if (activeDotIndex < dots.length) {
            dots[activeDotIndex].classList.add('active');
        }
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
        
        // Calculate max index based on cardsPerView
        const maxIndex = slides.length - cardsPerView;
        
        // Disable 'nextButton' if at the last position
        if (currentIndex >= maxIndex) {
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
        const maxIndex = slides.length - cardsPerView;
        if (currentIndex < maxIndex) {
            currentIndex += 1;
            updateSlider();
        }
    });
    
    // Add click events for the dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const totalPositions = Math.ceil(slides.length / cardsPerView);
            
            // Only navigate to valid positions
            if (index < totalPositions) {
                // Calculate the slide index based on dot index and cardsPerView
                currentIndex = index * cardsPerView;
                
                // Make sure we don't exceed maximum index
                const maxIndex = slides.length - cardsPerView;
                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }
                
                updateSlider();
            }
        });
    });
    
    // Recalculate everything on window resize
    window.addEventListener('resize', () => {
        // Update cardsPerView based on screen size
        cardsPerView = getCardsPerView();
        
        // Recalculate slide width
        slideWidth = getSlideWidth();
        
        // Make sure currentIndex is still valid with new cardsPerView
        const maxIndex = slides.length - cardsPerView;
        if (currentIndex > maxIndex) {
            currentIndex = maxIndex;
        }
        
        // Update the slider
        updateSlider();
    });
    
    // Initialize slider
    updateDots();
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
document.getElementById('loanButton').addEventListener('click', function() {
    console.log('Loan button clicked');
});


    </script>
</body>

</html>