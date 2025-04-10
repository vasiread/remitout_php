<!-- FAQ Section -->




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="faq-section">
        <div class="faq-background">

            <div class="container">
                <div class="header">
                     <h1 class="header-desktop-faq">Frequently asked questions</h1>
                     <h1 class="header-mobile-faq">FAQs</h1>
                    <div class="search-container">
                        <div class="search-box">
                            <input type="text" class="search-input" placeholder="Type keywords to find related queries">
                        </div>
                        <div style="position: relative;">
                            <button class="sort-button" id="sortButton">
                                Sort by
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="sort-dropdown" id="sortDropdown">
                                <div class="sort-option" data-sort="az">A-Z</div>
                                <div class="sort-option" data-sort="za">Z-A</div>
                                <div class="sort-option" data-sort="newest">Newest</div>
                                <div class="sort-option" data-sort="oldest">Oldest</div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="faq-container">
                    <div class="faq-list">
                        <!-- FAQ items will be dynamically inserted here -->
                    </div>
                </div>


                <div class="navigation">
                    <button class="nav-button prev">
                        <span class="arrow"></span>
                    </button>
                    <div class="nav-dots">
                        <div class="dot active"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                    <button class="nav-button next">
                        <span class="arrow"></span>
                    </button>
                </div>
            </div>

        </div>
    </section>

<script>

// FAQ Data

const faqData = [
    {
        question: "How can I apply for a loan with Remitout?",
        answer: "You can easily apply online by visiting our [application page] and filling out a short form with your basic information. Once submitted, our team will review your application and reach out with the next steps.",
        date: new Date('2024-01-01')
    },
    {
        question: "What are the eligibility criteria for a loan?",
        answer: "Our eligibility criteria includes age requirements, income verification, and credit history assessment. Please contact our support team for detailed information specific to your situation.",
        date: new Date('2024-01-15')
    },
    {
        question: "How long does the loan approval process take?",
        answer: "The loan approval process typically takes 2-3 business days, depending on the completeness of your application and required documentation.",
        date: new Date('2024-02-01')
    },
    {
        question: "What documents are required to apply for a loan?",
        answer: "Required documents typically include government-issued ID, proof of income, bank statements, and proof of address. Specific requirements may vary based on the loan type.",
        date: new Date('2024-02-15')
    },
    {
        question: "Can I apply for a loan if I have bad credit?",
        answer: "While bad credit may impact your eligibility, we assess applications on a case-by-case basis. Reach out to our support team to discuss potential options for your situation.",
        date: new Date('2024-03-01')
    },
    {
        question: "How do I track my loan application status?",
        answer: "You can track the status of your loan application by logging into your account on our website. Additionally, our team will notify you of any updates via email or phone.",
        date: new Date('2024-03-10')
    },
    {
        question: "Can I use my loan for any purpose?",
        answer: "Our loans are designed primarily for educational expenses. While most loans can be used for tuition, living costs, and study-related expenses, check the loan terms for any specific restrictions.",
        date: new Date('2024-03-20')
    },
    {
        question: "What is the repayment schedule for my loan?",
        answer: "Repayment terms are customized based on your loan amount, tenure, and educational institution. You'll be informed about your repayment schedule at the time of loan approval.",
        date: new Date('2024-04-01')
    },
    {
        question: "How do I choose the best loan offer for me?",
        answer: "Once your profile is assessed, we provide personalized loan offers. You can compare these offers based on your eligibility, interest rates, and repayment options to select the one that best suits your needs.",
        date: new Date('2024-04-10')
    },
    {
        question: "Can I pay off my loan early?",
        answer: "Yes, you can pay off your loan early without any prepayment penalties. Early repayment may also help you save on interest charges.",
        date: new Date('2024-04-20')
    },
    {
        question: "What happens if I miss a loan payment?",
        answer: "If you miss a loan payment, please contact us immediately. We may offer alternative arrangements or extend your payment period. It's important to keep us informed to avoid negative impacts on your credit score.",
        date: new Date('2024-05-01')
    },
    {
        question: "How fast can I receive my loan disbursement?",
        answer: "Once approved, your loan will be disbursed directly to your educational institution in a timely manner, ensuring there are no delays in securing your admission.",
        date: new Date('2024-05-10')
    }
];

const ITEMS_PER_PAGE = 4;
let currentPage = 0;
let currentSort = 'az';
let filteredData = [...faqData]; // Track filtered data separately

// Main function to refresh the display
function displayFAQs(data) {
    // Use filtered data or default to full FAQ data
    const dataToDisplay = data || filteredData;
    
    // Calculate start and end for current page
    const startIndex = currentPage * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;
    const pageData = dataToDisplay.slice(startIndex, endIndex);

    const faqList = document.querySelector('.faq-list');
    faqList.innerHTML = '';

    // If no items are displayed after filtering, show a message
    if (pageData.length === 0) {
        const noResults = document.createElement('div');
        noResults.className = 'no-results';
        noResults.textContent = 'No matching FAQs found. Please try different keywords.';
        faqList.appendChild(noResults);
    } else {
        // Create FAQ items with first one active
        pageData.forEach((item, index) => {
            const faqItem = document.createElement('div');
            faqItem.className = index === 0 ? 'faq-item active' : 'faq-item';
            faqItem.innerHTML = `
                <button class="faq-question">
                    ${item.question}
                    <svg class="toggle-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="faq-answer">
                    ${item.answer}
                </div>
            `;
            faqList.appendChild(faqItem);
        });
        
        // Force the first item to be active after DOM update
        setTimeout(() => {
            const firstItem = faqList.querySelector('.faq-item');
            if (firstItem) {
                firstItem.classList.add('active');
            }
        }, 0);
    }

    updatePagination(dataToDisplay.length);
}

function sortFAQs(sortType) {
    const sortedData = [...faqData];
    switch (sortType) {
        case 'az':
            sortedData.sort((a, b) => a.question.localeCompare(b.question));
            break;
        case 'za':
            sortedData.sort((a, b) => b.question.localeCompare(a.question));
            break;
        case 'newest':
            sortedData.sort((a, b) => b.date - a.date);
            break;
        case 'oldest':
            sortedData.sort((a, b) => a.date - b.date);
            break;
    }
    filteredData = sortedData;
    return sortedData;
}

function updatePagination(totalItems) {
    const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);
    const navDotsContainer = document.querySelector('.nav-dots');
    
    // Clear existing dots
    navDotsContainer.innerHTML = '';

    // Create dots dynamically based on total pages
    for (let i = 0; i < totalPages; i++) {
        const dot = document.createElement('div');
        dot.className = 'dot';
        if (i === currentPage) {
            dot.classList.add('active'); // Highlight current active dot
        }
        
        // Add click event to dots - explicitly update page and redisplay
        dot.addEventListener('click', () => {
            currentPage = i;
            displayFAQs();
        });
        navDotsContainer.appendChild(dot);
    }

    // Update navigation button states
    const prevButton = document.querySelector('.nav-button.prev');
    const nextButton = document.querySelector('.nav-button.next');

    prevButton.disabled = currentPage === 0;
    nextButton.disabled = currentPage === totalPages - 1;
}

function initSearch() {
    const searchInput = document.querySelector('.search-input');
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        
        if (searchTerm.trim() === '') {
            // If search is cleared, reset to sorted data
            filteredData = sortFAQs(currentSort);
        } else {
            // Filter the data
            filteredData = faqData.filter(item =>
                item.question.toLowerCase().includes(searchTerm) || 
                item.answer.toLowerCase().includes(searchTerm)
            );
        }
        
        // Reset to first page and display
        currentPage = 0;
        displayFAQs();
    });
}

// Set up navigation buttons
function setupNavigation() {
    // Previous button
    document.querySelector('.nav-button.prev').addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            displayFAQs();
        }
    });

    // Next button
    document.querySelector('.nav-button.next').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / ITEMS_PER_PAGE);
        if (currentPage < totalPages - 1) {
            currentPage++;
            displayFAQs();
        }
    });
}

// Sort functionality
function setupSorting() {
    const sortButton = document.getElementById('sortButton');
    const sortDropdown = document.getElementById('sortDropdown');

    sortButton.addEventListener('click', () => {
        sortDropdown.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!sortButton.contains(e.target) && !sortDropdown.contains(e.target)) {
            sortDropdown.classList.remove('active');
        }
    });

    document.querySelectorAll('.sort-option').forEach(option => {
        option.addEventListener('click', () => {
            const sortType = option.dataset.sort;
            currentSort = sortType;
            currentPage = 0;
            
            // Sort and update filtered data
            filteredData = sortFAQs(sortType);
            displayFAQs();
            
            sortDropdown.classList.remove('active');
        });
    });
}

// FAQ item click handler
function setupFAQClickHandlers() {
    document.addEventListener('click', (e) => {
        if (e.target.closest('.faq-question')) {
            const faqItem = e.target.closest('.faq-item');
            const wasActive = faqItem.classList.contains('active');

            // Close all FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            // Toggle clicked item - if it wasn't active, make it active
            if (!wasActive) {
                faqItem.classList.add('active');
            }
        }
    });
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Sort data initially
    filteredData = sortFAQs(currentSort);
    
    // Set up all event handlers
    setupNavigation();
    setupSorting();
    setupFAQClickHandlers();
    initSearch();
    
    // Display initial FAQ items
    displayFAQs();
});

    </script>
</body>

</html>