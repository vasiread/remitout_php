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
                    <h1>Frequently asked questions</h1>
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
                                <div class="sort-option" data-sort="az">Alphabetical (A-Z)</div>
                                <div class="sort-option" data-sort="za">Alphabetical (Z-A)</div>
                                <div class="sort-option" data-sort="newest">Newest First</div>
                                <div class="sort-option" data-sort="oldest">Oldest First</div>
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

    <script>function displayFAQs(data = faqData) {
            const startIndex = currentPage * ITEMS_PER_PAGE;
            const endIndex = startIndex + ITEMS_PER_PAGE;
            const pageData = data.slice(startIndex, endIndex);

            const faqList = document.querySelector('.faq-list');
            faqList.innerHTML = '';

            pageData.forEach((item) => {
                const faqItem = document.createElement('div');
                faqItem.className = 'faq-item';
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

            updatePagination();
        }


        //FAQ Section


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
            return sortedData;
        }

        function updatePagination() {
            const totalPages = Math.ceil(faqData.length / ITEMS_PER_PAGE);
            const dots = document.querySelectorAll('.dot');

            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentPage);
            });

            const prevButton = document.querySelector('.nav-button.prev');
            const nextButton = document.querySelector('.nav-button.next');

            prevButton.disabled = currentPage === 0;
            nextButton.disabled = currentPage === totalPages - 1;
        }



        // Initialize navigation
        document.querySelector('.nav-button.prev').addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                displayFAQs(sortFAQs(currentSort));
            }
        });

        document.querySelector('.nav-button.next').addEventListener('click', () => {
            const totalPages = Math.ceil(faqData.length / ITEMS_PER_PAGE);
            if (currentPage < totalPages - 1) {
                currentPage++;
                displayFAQs(sortFAQs(currentSort));
            }
        });

        // Initialize search
        function initSearch() {
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const filteredData = faqData.filter(item =>
                    item.question.toLowerCase().includes(searchTerm)
                );
                currentPage = 0;
                displayFAQs(filteredData);
            });
        }

        // Sort functionality
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
                const sortedData = sortFAQs(sortType);
                displayFAQs(sortedData);
                sortDropdown.classList.remove('active');
            });
        });

        // FAQ item click handler
        document.addEventListener('click', (e) => {
            if (e.target.closest('.faq-question')) {
                const faqItem = e.target.closest('.faq-item');
                const wasActive = faqItem.classList.contains('active');

                // Close all FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });

                // Toggle clicked item
                if (!wasActive) {
                    faqItem.classList.add('active');
                }
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            displayFAQs();
            initSearch();
        });









    </script>
</body>

</html>