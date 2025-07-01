<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/adminedit.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div class="edit-content-container" id="edit-content-main-section">
        <div class="admin-edit-container-sections">
            <!-- Edit Content Section -->
            <div class="edit-content-sub-container" id="edit-content-sub-container-id">
                <div class="edit-content-header">
                    <h1 class="edit-content-header-title">Edit Content</h1>
                    <div class="edit-container-search-sort-container">
                        <input type="text" placeholder="Search" class="edit-content-search-input">
                        <div class="admin-edit-dropdown">
                            <div class="admin-edit-dropdown-toggle">
                                Sort
                                <img src="assets/images/filter-icon.png" alt="Filter">
                            </div>
                            <div class="admin-edit-dropdown-menu">
                                <div class="admin-edit-dropdown-item" data-value="name">A-Z</div>
                                <div class="admin-edit-dropdown-item" data-value="role">Z-A</div>
                                <div class="admin-edit-dropdown-item" data-value="email-new">Newest</div>
                                <div class="admin-edit-dropdown-item" data-value="email-old">Oldest</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="edit-content-list"></div>
            </div>

            <!-- CMS Edit Section -->
            <div class="edit-contents-cms-container">
                <div class="edit-contents-cms-header">
                    <h1 class="edit-contents-cms-title">Edit Content</h1>
                    <button class="edit-contents-cms-save">Save Changes</button>
                </div>
                <div class="edit-contents-cms-controls">
                    <select class="edit-contents-cms-select" id="entriesSelect">
                        <option value="10">10 entries</option>
                        <option value="25">25 entries</option>
                        <option value="50">50 entries</option>
                    </select>
                    <div class="controls-group">
                        <select class="edit-contents-cms-select" id="pageSelect">
                            <option value="landing">Landing Page</option>
                            <option value="about">About Us</option>
                            <option value="services">Services</option>
                        </select>
                        <select class="edit-contents-cms-select" id="sectionSelect">
                            <option value="all">All Sections</option>
                            <option value="hero">Hero Section</option>
                            <option value="testimonial">Testimonial</option>
                            <option value="logo">Logo Section</option>
                            <option value="study-loan">Study Loan Graph</option>
                            <option value="secure-loan">Secure Loan</option>
                            <option value="global-transfer">Global Transfer and Services</option>
                            <option value="faq-section">FAQ</option>
                            <option value="footer">Footer</option>
                        </select>
                        <input type="text" class="edit-contents-cms-search" placeholder="Search" id="searchInput">
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="edit-contents-cms-table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>CMS Section</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cmsTableBody">
                            <!-- Content will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
                <div class="pagination" id="paginationControls">
                    <!-- Pagination controls will be dynamically inserted here -->
                </div>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading" style="display: none;">
            <div class="loading-spinner"></div>
        </div>

        <!-- Toast Notification -->
        <div class="toast"></div>
    </div>

    <script>
        // Define contentData globally
        const contentData = [{
                name: "Landing Page",
                sections: 88,
                tags: ["Text", "Img", "Video"]
            },
            {
                name: "Contact Page",
                sections: 2,
                tags: ["Text", "Img", "Video"]
            },
            {
                name: "About Us",
                sections: 3,
                tags: ["Text"]
            },
            {
                name: "Services",
                sections: 5,
                tags: ["Text", "Images", "Video"]
            },
            {
                name: "Contact Page",
                sections: 2,
                tags: ["Text", "Img", "Video"]
            }
        ];
        window.selectedFilePerTitle = {};
        window.selectedFilePerTitle = {};

        const contentList = document.querySelector('.edit-content-list');

        function renderContent(data) {
            contentList.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('div');
                row.classList.add('edit-content-row');
                row.setAttribute('data-id', item.id);
                row.innerHTML = `
                    <div>${item.name}</div>
                    <div>${item.sections} Sections</div>
                    <div class="edit-content-tag-container">
                        ${item.tags.map(tag => `<span class="edit-content-tag">${tag}</span>`).join('')}
                    </div>
                    <button class="edit-content-button">Edit</button>
                `;
                row.querySelector('.edit-content-button').addEventListener('click', () => {
                    contentList.style.display = 'none';
                    document.querySelector('.edit-content-header').style.display = 'none';
                    document.querySelector('.edit-contents-cms-container').style.display = 'block';
                    const pageSelect = document.getElementById('pageSelect');
                    if (!Array.from(pageSelect.options).some(opt => opt.value === item.name
                            .toLowerCase())) {
                        pageSelect.innerHTML =
                            `<option value="${item.name.toLowerCase()}">${item.name}</option>` + pageSelect
                            .innerHTML;
                    }
                    pageSelect.value = item.name.toLowerCase();
                    if (!window.cmsEditor) {
                        window.cmsEditor = new CMSEditor();
                    }
                    window.cmsEditor.handlePageChange(item.name);
                });
                contentList.appendChild(row);
            });
        }

        document.querySelector('.edit-content-search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const filteredData = contentData.filter(item => item.name.toLowerCase().includes(searchTerm));
            renderContent(filteredData);
        });

        class CMSEditor {
            constructor() {
                this.data = [
                    // Hero Section
                    {
                        id: 1,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'Special Heading',
                        content: 'Secure Fast Simple Loans For a Brighter Future',
                        status: 'Active',
                        maxLength: 46
                    },
                    {
                        id: 2,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'By Line',
                        content: 'Fuel your Global Journey',
                        status: 'Active',
                        maxLength: 25
                    },
                    {
                        id: 3,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'Description',
                        content: 'Trusted by 15,000+ students across India, Remitout is your partner in securing the financial support you need to succeed in your studies.',
                        status: 'Active',
                        maxLength: 140
                    },
                    {
                        id: 4,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'Background: Media',
                        content: '/api/placeholder/400/320',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 400,
                            height: 527
                        }
                    },
                    {
                        id: 5,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'Button',
                        content: 'Secure your Loan now!',
                        status: 'Active',
                        maxLength: 22
                    },
                    {
                        id: 6,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'Button',
                        content: 'Watch Demo',
                        status: 'Active',
                        maxLength: 10
                    },
                    // Testimonial Section
                    {
                        id: 7,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Heading',
                        content: 'Hear What They Say',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 8,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonials',
                        status: 'Active',

                        content: JSON.stringify([{
                            name: 'Mark Debrovski',
                            designation: 'Designation',
                            rating: 5,
                            description: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.',
                            image: '/api/placeholder/100/100',
                            mediaConstraints: {
                                formats: ['png', 'jpg', 'jpeg'],
                                width: 100,
                                height: 100
                            }
                        }, ])
                    },



                    // Logo Section
                    {
                        id: 9,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo initial',
                        content: '/api/placeholder/200/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 200,
                            height: 100
                        }
                    },


                    // Study Loan Graph Section
                    {
                        id: 14,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Graph Heading',
                        content: 'Your Smart Route to Study Loans',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 15,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Graph Subheading',
                        content: 'Bespoke Loan Options from Trusted NBFCs for Your International Education.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 16,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Globe Image',
                        content: '/api/placeholder/300/300',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 300,
                            height: 300
                        }
                    },
                    {
                        id: 17,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 1 Header: Profile Assessment',
                        content: 'Profile Assessment',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 18,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 1 Content: Profile Assessment',
                        content: 'Our experts assess your academic and financial profile to determine the best loan options for your overseas education.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 19,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 1 Image: Profile Assessment Vector',
                        content: '/api/placeholder/50/50',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 20,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Profile Assessment',
                        content: 'Profile Assessment',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 21,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 2 Header: Get Matched with Top NBFCs',
                        content: 'Get Matched with Top NBFCs',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 22,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 2 Content: Get Matched with Top NBFCs',
                        content: 'We connect you with multiple non-banking financial companies (NBFCs) offering competitive study loans.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 23,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 2 Image: Handshake',
                        content: '/api/placeholder/50/50',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 24,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Perfect Match',
                        content: 'Perfect Match',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 25,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 3 Header: Choose Your Loan Offers',
                        content: 'Choose Your Loan Offers',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 26,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 3 Content: Choose Your Loan Offers',
                        content: 'Browse and compare personalized loan offers based on your eligibility and repayment preferences.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 27,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 3 Image: Loan Choices Vector',
                        content: '/api/placeholder/50/50',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 28,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Loan Choices',
                        content: 'Loan Choices',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 29,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 4 Header: Submit Documents With Ease',
                        content: 'Submit Documents With Ease',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 30,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 4 Content: Submit Documents With Ease',
                        content: 'Upload your required documents securely through our platform for a seamless process.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 31,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 4 Image: Easy Process Vector',
                        content: '/api/placeholder/50/50',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 32,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Easy Process',
                        content: 'Easy Process',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 33,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 5 Header: Fast-Track Approval',
                        content: 'Fast-Track Approval',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 34,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 5 Content: Fast-Track Approval',
                        content: 'Experience quick approvals with minimal delays, ensuring you stay on track for your educational goals.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 35,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 5 Image: Clock Hand',
                        content: '/api/placeholder/50/50',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 36,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Fast-Track Approval',
                        content: 'Fast-Track Approval',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 37,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 6 Header: Guaranteed Disbursement',
                        content: 'Guaranteed Disbursement',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 38,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 6 Content: Guaranteed Disbursement',
                        content: 'Once approved, your loan is disbursed directly to your institution on time, securing your admission.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 39,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 6 Image: Guarantee Vector',
                        content: '/api/placeholder/50/50',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 40,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Guaranteed Disbursement',
                        content: 'Guaranteed Disbursement',
                        status: 'Active',
                        maxLength: 50
                    },
                    // Secure Loan Section
                    {
                        id: 41,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Main Heading',
                        content: 'Where your safety meets<br>smart lending',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 42,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Mobile Image',
                        content: 'assets/images/tablet-group-image.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 300,
                            height: 200
                        }
                    },
                    {
                        id: 43,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 1 Title',
                        content: 'Integrated Support, Anytime, Anywhere',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 44,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 1 Description',
                        content: 'Instant support builds trust and enhances experience!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 45,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 1 Icon',
                        content: 'assets/images/icon-1.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 46,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 2 Title',
                        content: 'Rapid Processing',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 47,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 2 Description',
                        content: 'Easy student remittance in just a few steps!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 48,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 2 Icon',
                        content: 'assets/images/icon-2.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 49,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 3 Title',
                        content: 'Best Price Commitment',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 50,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 3 Description',
                        content: 'Transparent, competitive exchange rates guaranteed!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 51,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 3 Icon',
                        content: 'assets/images/icon-3.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 52,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 4 Title',
                        content: 'Absolutely Protected',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 53,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 4 Description',
                        content: 'Instant transfers, no fees, 24/7 support!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 54,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 4 Icon',
                        content: 'assets/images/icon-4.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 55,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'CTA Button Text',
                        content: 'Secure your loan now!',
                        status: 'Active',
                        maxLength: 30
                    },
                    {
                        id: 56,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Loading Animation',
                        content: 'assets/images/Circle.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 100,
                            height: 100
                        }
                    },
                    {
                        id: 57,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Radcliffe Icon',
                        content: 'assets/images/over-icon.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 58,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Radcliffe Image',
                        content: 'assets/images/image-1.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 300,
                            height: 200
                        }
                    },
                    {
                        id: 59,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Students Image',
                        content: 'assets/images/image-2.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 300,
                            height: 200
                        }
                    },
                    {
                        id: 60,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Graduation Image',
                        content: 'assets/images/image-3.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 300,
                            height: 200
                        }
                    },
                    // Global Transfer and Services Section
                    {
                        id: 61,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Background Image',
                        content: 'assets/images/effort-banner.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 1200,
                            height: 600
                        }
                    },
                    {
                        id: 62,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Main Image',
                        content: 'assets/images/girl-image-with-banner.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 400,
                            height: 400
                        }
                    },
                    {
                        id: 63,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Heading',
                        content: 'Effortless and affordable <br>global transfers!',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 64,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Description',
                        content: 'Support loved ones abroad by sending money from India for education and expenses. Transfer to 40+ countries with real exchange rates, no hidden fees. Sign up easily online with your PAN and address.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 65,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Students Icon',
                        content: 'assets/images/account_circle-grid.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 66,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'NBFCs Icon',
                        content: 'assets/images/account_balance.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 67,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Countries Icon',
                        content: 'assets/images/flag.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 68,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Customers Icon',
                        content: 'assets/images/sentiment_very_satisfied.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png'],
                            width: 50,
                            height: 50
                        }
                    },
                    {
                        id: 69,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Students Stat Value',
                        content: '500+',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 70,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Students Stat Label',
                        content: 'Students',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 71,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'NBFCs Stat Value',
                        content: '100',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 72,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'NBFCs Stat Label',
                        content: 'editable',
                        maxLength: 20
                    },
                    {
                        id: 73,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Countries Stat Value',
                        content: '40+',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 74,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Countries Stat Label',
                        content: 'Countries',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 75,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Customers Stat Value',
                        content: '2k+',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 76,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Customers Stat Label',
                        content: 'Customers',
                        status: 'Active',
                        maxLength: 20
                    },
                    // FAQ Section
                    {
                        id: 77,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Header Desktop',
                        content: 'Frequently asked questions',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 78,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQs',
                        status: 'Active',
                        content: [{
                            question: 'How can I apply for a loan with Remitout?',
                            answer: 'You can easily apply online by visiting our application page and filling out a short form with your basic information. Once submitted, our team will reach out with the next steps.'
                        }]
                    },


                    // Footer Section
                    {
                        id: 79,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Company Description',
                        content: 'B/415DAMJI SHAMJI CORPORATE SQUARE BEHIND EVEREST GARDEN GM LINK RD GTK, Mumbai, Maharashtra, India, 400075',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 80,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Contact Number',
                        content: '+91 75784 75788',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 81,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Quick Links',
                        content: 'Home | About Us | Services | Contact | FAQs',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 82,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Social Media Links',
                        content: 'Twitter: https://x.com/RemitoutL | Instagram: https://www.instagram.com/remitout_india/ | Facebook: https://www.facebook.com/RemitoutIN/',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 83,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Signup Heading',
                        content: 'Sign Up with us Today!',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 84,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Signup Description',
                        content: 'Prepare yourself and let\'s explore this world.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 85,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Register Button Text',
                        content: 'Register Now!',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 86,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Footer Logo Image',
                        content: 'assets/images/footer-logo.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 100,
                            height: 50
                        }
                    },
                    {
                        id: 87,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Signup Background Image',
                        content: 'assets/images/Globe.WebP',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['webp', 'png', 'jpg', 'jpeg'],
                            width: 400,
                            height: 320
                        }
                    },
                    {
                        id: 88,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Copyright Text',
                        content: 'All Rights reserved',
                        status: 'Active',
                        maxLength: 50
                    }
                ];
                this.originalData = JSON.parse(JSON.stringify(this.data));
                this.filteredData = this.data;
                this.toastQueue = [];
                this.isToastActive = false;
                this.currentPage = 1;
                this.rowsPerPage = 10;
                this.initializeEventListeners();
                this.injectDynamicHeroContent();
                this.renderTable();
            }





            initializeEventListeners() {
                const saveButton = document.querySelector('.edit-contents-cms-save');
                saveButton.removeEventListener('click', this.handleSave);
                saveButton.addEventListener('click', () => this.handleSave());
                document.getElementById('searchInput').addEventListener('input', (e) => {
                    this.handleSearch(e.target.value);
                });
                document.getElementById('pageSelect').addEventListener('change', (e) => {
                    this.currentPage = 1;
                    this.handlePageChange(e.target.value);
                });
                document.getElementById('sectionSelect').addEventListener('change', (e) => {
                    this.currentPage = 1;
                    this.handleSectionChange(e.target.value);
                });
                document.getElementById('entriesSelect').addEventListener('change', (e) => {
                    this.rowsPerPage = parseInt(e.target.value);
                    this.currentPage = 1;
                    this.renderTable();
                });
            }

            showLoading() {
                document.querySelector('.loading').style.display = 'flex';
            }

            hideLoading() {
                document.querySelector('.loading').style.display = 'none';
            }

            showToast(message, isError = false) {
                this.toastQueue.push({
                    message,
                    isError
                });
                this.processToastQueue();
            }

            processToastQueue() {
                if (this.isToastActive || this.toastQueue.length === 0) return;

                this.isToastActive = true;
                const {
                    message,
                    isError
                } = this.toastQueue.shift();
                const toast = document.querySelector('.toast');
                toast.textContent = message;
                toast.className = 'toast' + (isError ? ' error' : '');
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.opacity = '1';
                }, 10);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.style.display = 'none';
                        this.isToastActive = false;
                        this.processToastQueue();
                    }, 300);
                }, 3000);
            }

            placeCaretAtEnd(element) {
                const range = document.createRange();
                const selection = window.getSelection();
                range.selectNodeContents(element);
                range.collapse(false);
                selection.removeAllRanges();
                selection.addRange(range);
                element.focus();
            }

            resizeImage(dataUrl, targetWidth, targetHeight, callback) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = targetWidth;
                    canvas.height = targetHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, targetWidth, targetHeight);
                    callback(canvas.toDataURL('image/jpeg', 0.8));
                };
                img.src = dataUrl;
            }

            handleSearch(searchTerm) {
                searchTerm = searchTerm.toLowerCase();
                this.currentPage = 1;
                if (!searchTerm) {
                    this.handlePageChange(document.getElementById('pageSelect').value);
                    return;
                }
                this.filteredData = this.data.filter(item =>
                    item.page.toLowerCase().includes(searchTerm) ||
                    item.title.toLowerCase().includes(searchTerm) ||
                    (item.isTestimonialArray ? JSON.parse(item.content).some(testimonial =>
                        testimonial.name.toLowerCase().includes(searchTerm) ||
                        testimonial.designation.toLowerCase().includes(searchTerm) ||
                        testimonial.description.toLowerCase().includes(searchTerm)
                    ) : item.isFAQArray ? JSON.parse(item.content).some(faq =>
                        faq.question.toLowerCase().includes(searchTerm) ||
                        faq.answer.toLowerCase().includes(searchTerm)
                    ) : item.content.toString().toLowerCase().includes(searchTerm))
                );
                this.renderTable();
            }

            handlePageChange(page) {
                console.log('handlePageChange called with page:', page);
                if (!page || page === 'all') {
                    this.filteredData = this.data;
                    this.currentPage = 1;
                    this.renderTable();
                    return;
                }
                const pageName = page.charAt(0).toUpperCase() + page.slice(1).toLowerCase();
                console.log('Filtering for page:', pageName);
                this.filteredData = this.data.filter(item =>
                    item.page.toLowerCase() === pageName.toLowerCase()
                );
                console.log('Filtered data:', this.filteredData);
                const sectionSelect = document.getElementById('sectionSelect');
                if (pageName.toLowerCase() === 'landing page') {
                    sectionSelect.innerHTML = `
                        <option value="all">All Sections</option>
                        <option value="hero">Hero Section</option>
                        <option value="testimonial">Testimonial</option>
                        <option value="logo">Logo Section</option>
                        <option value="study-loan">Study Loan Graph</option>
                        <option value="secure-loan">Secure Loan</option>
                        <option value="global-transfer">Global Transfer and Services</option>
                        <option value="faq-section">FAQ</option>
                        <option value="footer">Footer</option>
                    `;
                } else {
                    sectionSelect.innerHTML = `
                        <option value="all">All Sections</option>
                        <option value="hero">Hero Section</option>
                        <option value="features">Features</option>
                        <option value="footer">Footer</option>
                    `;
                }
                sectionSelect.value = 'all';
                this.currentPage = 1;
                this.handleSectionChange('all');
            }

            handleSectionChange(section) {
                const pageSelect = document.getElementById('pageSelect');
                const pageName = pageSelect.value.charAt(0).toUpperCase() + pageSelect.value.slice(1).toLowerCase();
                console.log('handleSectionChange called with section:', section, 'and page:', pageName);
                if (!section || section === 'all') {
                    this.filteredData = this.data.filter(item =>
                        item.page.toLowerCase() === pageName.toLowerCase()
                    );
                } else {
                    this.filteredData = this.data.filter(item =>
                        item.page.toLowerCase() === pageName.toLowerCase() &&
                        item.sectionType.toLowerCase() === section.toLowerCase()
                    );
                }
                console.log('Filtered data after section change:', this.filteredData);
                this.currentPage = 1;
                this.renderTable();
            }

            async addNewTestimonial(item) {
                const testimonials = JSON.parse(item.content);

                const newTestimonial = {
                    name: 'New Testimonial',
                    designation: 'Designation',
                    rating: 5,
                    description: 'Enter description here.',
                    mediaConstraints: {
                        formats: ['png', 'jpg', 'jpeg'],
                        width: 100,
                        height: 100
                    }
                };

                try {
                    const res = await fetch('/api/testimonial/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            name: newTestimonial.name,
                            designation: newTestimonial.designation,
                            rating: newTestimonial.rating,
                            review: newTestimonial.description
                        })
                    });

                    const result = await res.json();

                    if (result.status && result.data?.id) {
                        newTestimonial.id = result.data.id;
                        testimonials.push(newTestimonial);
                        item.content = JSON.stringify(testimonials);
                        this.renderTable();
                        this.showToast('✅ Testimonial added and saved');
                    } else {
                        this.showToast('❌ Failed to add testimonial', true);
                    }
                } catch (err) {
                    console.error(err);
                    this.showToast('⚠️ Error saving testimonial', true);
                }
            }


            async removeTestimonial(item, index) {
                const testimonials = JSON.parse(item.content);
                const testimonial = testimonials[index];

                if (testimonial?.isProtected) {
                    this.showToast('🚫 This is a default testimonial and cannot be deleted.', true);
                    return;
                }

                // Not yet saved to DB — just remove locally
                if (!testimonial.id) {
                    testimonials.splice(index, 1);
                    item.content = JSON.stringify(testimonials);
                    this.renderTable();
                    this.showToast('🗑️ Unsaved testimonial removed');
                    return;
                }

                try {
                    const res = await fetch(`/testimonial/delete/${testimonial.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    });

                    const result = await res.json();

                    if (result.status) {
                        testimonials.splice(index, 1);
                        item.content = JSON.stringify(testimonials);
                        this.renderTable();
                        this.showToast('🗑️ Testimonial deleted');
                    } else {
                        this.showToast('❌ Failed to delete testimonial', true);
                    }
                } catch (err) {
                    console.error(err);
                    this.showToast('⚠️ Error deleting testimonial', true);
                }
            }


            async addNewFAQ(item) {
                const faqs = JSON.parse(item.content);

                const newFaq = {
                    question: 'New FAQ Question',
                    answer: 'Enter answer here.'
                };

                try {
                    const res = await fetch('/api/faq/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify(newFaq)
                    });

                    const result = await res.json();

                    if (result.status && result.data?.id) {
                        newFaq.id = result.data.id;
                        faqs.push(newFaq);
                        item.content = JSON.stringify(faqs);
                        this.renderTable();
                        this.showToast('✅ FAQ added and saved');
                    } else {
                        this.showToast('❌ Failed to add FAQ', true);
                    }
                } catch (err) {
                    console.error(err);
                    this.showToast('⚠️ Error saving FAQ', true);
                }
            }
            async updateFAQ(item, index) {
                const faqs = JSON.parse(item.content);
                const faq = faqs[index];

                if (faq?.isProtected) {
                    this.showToast('🚫 This FAQ is protected and cannot be updated.', true);
                    return;
                }

                if (!faq.id) {
                    this.showToast('❌ Cannot update unsaved FAQ. Please save it first.', true);
                    return;
                }

                try {
                    const res = await fetch(`/faq/update/${faq.id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            question: faq.question,
                            answer: faq.answer
                        })
                    });

                    const result = await res.json();

                    if (result.status) {
                        this.showToast('✅ FAQ updated successfully');
                    } else {
                        this.showToast(`❌ Failed to update FAQ: ${result.message}`, true);
                    }
                } catch (err) {
                    console.error(err);
                    this.showToast('⚠️ Error updating FAQ', true);
                }
            }


            async removeFAQ(item, index) {
                const faqs = JSON.parse(item.content);
                const faq = faqs[index];

                if (faq?.isProtected) {
                    this.showToast('🚫 This is a default FAQ and cannot be deleted.', true);
                    return;
                }

                if (!faq.id) {
                    faqs.splice(index, 1);
                    item.content = JSON.stringify(faqs);
                    this.renderTable();
                    this.showToast('🗑️ Unsaved FAQ removed');
                    return;
                }

                try {
                    const res = await fetch(`/faq/delete/${faq.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    });

                    const result = await res.json();

                    if (result.status) {
                        faqs.splice(index, 1);
                        item.content = JSON.stringify(faqs);
                        this.renderTable();
                        this.showToast('🗑️ FAQ deleted');
                    } else {
                        this.showToast('❌ Failed to delete FAQ', true);
                    }
                } catch (err) {
                    console.error(err);
                    this.showToast('⚠️ Error deleting FAQ', true);
                }
            }


            async addNewLogo(item) {
                const response = await fetch(`/logo/store`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        url: '/api/placeholder/200/100'
                    })
                });

                const data = await response.json();

                if (data.success) {
                    const newId = data.logo.id;
                    const newTitle = `Partner Logo ${newId}`;

                    // Update title
                    await fetch(`/logo/update-title/${newId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        },
                        body: JSON.stringify({
                            title: newTitle
                        })
                    });

                    // Add to front-end data
                    this.data.push({
                        id: newId,
                        page: item.page,
                        sectionType: 'logo',
                        title: newTitle,
                        content: data.logo.content,
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 200,
                            height: 100
                        }
                    });
                    this.renderTable();

                    const currentSection = document.getElementById('sectionSelect').value;
                    this.handlePageChange(item.page, currentSection);
                    this.showToast('✅ New logo added');
                } else {
                    this.showToast('❌ Failed to add logo');
                    console.error(data);
                }
            }




            async removeLogo(id) {
                try {
                    const response = await fetch(`/logo/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        }
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        this.showToast(`❌ ${result.error || 'Delete failed'}`, true);
                        return;
                    }

                    // Remove from local data
                    this.data = this.data.filter(item => item.id !== id);

                    // Refresh table
                    const currentSection = document.getElementById('sectionSelect').value;
                    const item = this.data.find(item => item.sectionType === 'logo');
                    this.handlePageChange(item?.page || 'L  anding Page', currentSection);

                    this.showToast('✅ Logo removed');
                } catch (error) {
                    console.error('Error deleting logo:', error);
                    this.showToast('❌ Server error', true);
                }
            }





            handlePageChange(page, section = 'all') {
                console.log('handlePageChange called with page:', page, 'and section:', section);
                if (!page || page === 'all') {
                    this.filteredData = this.data;
                    this.currentPage = 1;
                    this.renderTable();
                    return;
                }
                const pageName = page.charAt(0).toUpperCase() + page.slice(1).toLowerCase();
                console.log('Filtering for page:', pageName);
                this.filteredData = this.data.filter(item =>
                    item.page.toLowerCase() === pageName.toLowerCase()
                );
                console.log('Filtered data:', this.filteredData);
                const sectionSelect = document.getElementById('sectionSelect');
                if (pageName.toLowerCase() === 'landing page') {
                    sectionSelect.innerHTML = `
                        <option value="all">All Sections</option>
                        <option value="hero">Hero Section</option>
                        <option value="testimonial">Testimonial</option>
                        <option value="logo">Logo Section</option>
                        <option value="study-loan">Study Loan Graph</option>
                        <option value="secure-loan">Secure Loan</option>
                        <option value="global-transfer">Global Transfer and Services</option>
                        <option value="faq-section">FAQ</option>
                        <option value="footer">Footer</option>
                    `;
                } else {
                    sectionSelect.innerHTML = `
                        <option value="all">All Sections</option>
                        <option value="hero">Hero Section</option>
                        <option value="features">Features</option>
                        <option value="footer">Footer</option>
                    `;
                }
                sectionSelect.value = section;
                this.currentPage = 1;
                this.handleSectionChange(section);
            }
            async injectDynamicHeroContent() {
                try {
                    const res = await fetch('/api/landingpage');
                    if (!res.ok) throw new Error(`CMS fetch failed: ${res.status}`);
                    const cmsData = await res.json();

                    for (let i = 0; i < this.data.length; i++) {
                        const item = this.data[i];

                        const match = cmsData.find(serverItem =>
                            serverItem.section === item.sectionType && serverItem.title === item.title
                        );
                        if (match) {
                            item.content = match.content;
                        }

                        // Testimonials
                        if (item.sectionType === 'testimonial' && item.title === 'Testimonials' && !item._injected) {
                            try {
                                const parsed = JSON.parse(item.content);
                                if (Array.isArray(parsed)) {
                                    item.isTestimonialArray = true;
                                    item.maxLengthConstraints = {
                                        name: 20,
                                        designation: 20,
                                        description: 160
                                    };

                                    const testimonialRes = await fetch('/api/gettestimonials');
                                    if (!testimonialRes.ok) throw new Error(
                                        `Testimonial fetch failed: ${testimonialRes.status}`);
                                    const testimonialData = await testimonialRes.json();

                                    if (testimonialData.status && Array.isArray(testimonialData.data)) {
                                        parsed.splice(1, 0, ...testimonialData.data.map(t => ({
                                            id: t.id,
                                            name: t.name,
                                            designation: t.designation,
                                            description: t.review,
                                            image: t.image,
                                            rating: t.rating,
                                            mediaConstraints: {
                                                formats: ['png', 'jpg', 'jpeg'],
                                                width: 100,
                                                height: 100
                                            }
                                        })));
                                        parsed[0].isProtected = true;
                                        item.content = JSON.stringify(parsed);
                                        item._injected = true;
                                    }
                                }
                            } catch (e) {
                                console.warn(`Invalid JSON for testimonials`, e);
                            }
                        }

                        // FAQs
                        if (item.sectionType === 'faq-section' && item.title === 'FAQs' && !item._injected) {
                            try {
                                const parsed = JSON.parse(item.content);
                                if (Array.isArray(parsed)) {
                                    item.isFaqArray = true;
                                    item.maxLengthConstraints = {
                                        question: 100,
                                        answer: 400
                                    };

                                    const faqRes = await fetch('/api/getfaqs');
                                    if (!faqRes.ok) throw new Error(`FAQ fetch failed: ${faqRes.status}`);
                                    const faqData = await faqRes.json();
                                    alert(item)
                                    console.log(item)

                                    if (faqData.status && Array.isArray(faqData.data)) {
                                        parsed.splice(1, 0, ...faqData.data.map(f => ({
                                            id: f.id,
                                            question: f.question,
                                            answer: f.answer
                                        })));
                                        parsed[0].isProtected = true;
                                        item.content = JSON.stringify(parsed);
                                        item._injected = true;
                                    }
                                }
                            } catch (e) {
                                console.warn('Invalid JSON for FAQs', e);
                            }
                        }

                        // Partner Logos
                        if (
                            item.sectionType === 'logo' &&
                            item.title?.toLowerCase().includes('partner logo') &&
                            !item._logosInjected
                        ) {
                            try {
                                item.isLogoArray = true;
                                item.maxLengthConstraints = null;
                                item.mediaConstraints = {
                                    formats: ['png', 'jpg', 'jpeg', 'svg'],
                                    width: 200,
                                    height: 100
                                };
                                item.isProtected = true;

                                const logoRes = await fetch('/api/getlogospartner');
                                if (!logoRes.ok) throw new Error(`Partner logo fetch failed: ${logoRes.status}`);
                                const logoData = await logoRes.json();
                                console.log("logodata", logoData);

                                if (logoData.status && Array.isArray(logoData.data)) {
                                    const additionalSections = logoData.data.map(logo => ({
                                        sectionType: 'logo',
                                        page: item.page,
                                        title: logo.title,
                                        content: logo.content,
                                        id: logo.id,
                                        status: item.status,
                                        isLogoArray: false,
                                        isProtected: false,
                                        maxLengthConstraints: null,
                                        mediaConstraints: {
                                            formats: ['png', 'jpg', 'jpeg', 'svg'],
                                            width: 200,
                                            height: 100
                                        }
                                    }));


                                    // Insert new logos just after the seed
                                    this.data.splice(i + 1, 0, ...additionalSections);
                                    item._logosInjected = true;
                                    i += additionalSections.length; // Skip over inserted items
                                }
                            } catch (e) {
                                console.warn('❌ Error processing logos', e);
                            }
                        }
                    }

                    this.originalData = JSON.parse(JSON.stringify(this.data));
                    this.filteredData = this.data;
                    this.renderTable();
                } catch (err) {
                    console.error('❌ injectDynamicHeroContent failed:', err);
                    this.renderTable();
                    this.showToast('⚠️ Failed to load CMS content', true);
                }
            }



            async updateTestimonial(item, index) {
                const testimonials = JSON.parse(item.content);
                const testimonial = testimonials[index];

                // 🚫 Prevent updating the protected testimonial
                if (testimonial?.isProtected) {
                    this.showToast('🚫 This is a default testimonial and cannot be updated.', true);
                    return;
                }

                if (!testimonial.id) {
                    this.showToast('❌ Cannot update unsaved testimonial. Please save it first.', true);
                    return;
                }

                const payload = {
                    name: testimonial.name,
                    designation: testimonial.designation,
                    rating: testimonial.rating,
                    review: testimonial.description
                };

                try {
                    const res = await fetch(`/testimonial/update/${testimonial.id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute(
                                    'content')
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await res.json();

                    if (result.status) {
                        this.showToast('✅ Testimonial updated successfully');
                    } else {
                        this.showToast(`❌ Failed to update testimonial: ${result.message}`, true);
                    }
                } catch (err) {
                    console.error(err);
                    this.showToast('⚠️ Error updating testimonial', true);
                }
            }










            async updateHeroContentToAPI(item) {
                alert(item)
                const payload = {
                    key_name: 'field_' + item.id,
                    content: item.content
                };

                // Get CSRF token from meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    console.log('Sending payload:', payload);

                    const res = await fetch('/api/landingpageupdate', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken // 🔐 Include CSRF token
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!res.ok) {
                        const error = await res.json();
                        console.error('❌ Server responded with error:', error);
                        throw new Error(error.message || 'Unknown server error');
                    }

                    this.showToast('✅ Content updated successfully');
                } catch (err) {
                    console.error('❌ Update API failed:', err);
                    this.showToast('⚠️ Failed to update content: ' + err.message, true);
                }
            }


            renderTable() {
                const tbody = document.getElementById('cmsTableBody');
                tbody.innerHTML = '';

                const logos = this.filteredData.filter(d => d.sectionType === 'logo');

                const startIndex = (this.currentPage - 1) * this.rowsPerPage;
                const endIndex = Math.min(startIndex + this.rowsPerPage, this.filteredData.length);
                const paginatedData = this.filteredData.slice(startIndex, endIndex);

                let rowCounter = startIndex + 1;

                paginatedData.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.dataset.id = item.id;
                    row.dataset.originalSno = rowCounter;
                    row.setAttribute('data-id', item.id);

                    if (item.isMedia || item.sectionType === 'logo') {
                        const logos = this.filteredData.filter(d => d.sectionType === 'logo');
                        const isLastLogo = logos.length && logos[logos.length - 1] === item;

                        row.innerHTML = `
                                    <td>${rowCounter++}</td>
                                    <td>${item.page}</td>
                                    <td class="editable-cell">
                                        <div class="editable-content" contenteditable="true">${item.title}</div>
                                    </td>
                                    <td>
                                        <div class="media-container">
                                            <div class="media-preview">
                                                ${item.mediaConstraints.formats.includes('mp4') || item.mediaConstraints.formats.includes('webm') ?
                                                    `<video src="${item.content}" controls width="200"></video>` :
                                                    `<img src="${item.content}" alt="Media preview">`}
                                                <span class="close-btn">×</span>
                                            </div>
                                            <div class="media-actions">
                                                <input type="file" class="file-input hidden-input" accept="${item.mediaConstraints?.formats.map(format => `.${format}`).join(',') || 'image/*'}">
                                                <div class="upload-trigger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                        <polyline points="17 8 12 3 7 8"/>
                                                        <line x1="12" y1="3" x2="12" y2="15"/>
                                                    </svg>
                                                    Replace ${item.sectionType === 'logo' ? 'Logo' : 'Media'}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="edit-contents-cms-status">${item.status}</span></td>
                                    <td>
                                        <button class="edit-contents-cms-update">Update</button>
                                        ${item.sectionType === 'logo' ? `
                                                    <button class="remove-logo" title="Remove Logo"
    style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; padding: 6px 10px; margin-right: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
    </svg>
 </button>

                                                    ${isLastLogo ? `
                                           <button class="add-logo" title="Add Logo"
    style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; padding: 6px 10px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
     
</button>
                                            ` : ''}
                                                ` : ''}
                                    </td>
                                `;

                        tbody.appendChild(row);

                        // Setup editable content
                        const editableContents = row.querySelectorAll('.editable-cell .editable-content');
                        editableContents.forEach((editableContent) => {
                            editableContent.addEventListener('input', () => {
                                const charCount = editableContent.parentElement.querySelector(
                                    '.char-count');
                                if (charCount) {
                                    const maxLength = parseInt(charCount.getAttribute(
                                        'data-max'));
                                    charCount.textContent =
                                        `${editableContent.textContent.length}/${maxLength}`;
                                    charCount.classList.toggle('hidden', editableContent
                                        .textContent.length <= maxLength);
                                    charCount.classList.toggle('error', editableContent
                                        .textContent.length > maxLength);
                                }
                            });
                            editableContent.addEventListener('focus', () => {
                                const charCount = editableContent.parentElement.querySelector(
                                    '.char-count');
                                if (charCount) {
                                    const maxLength = parseInt(charCount.getAttribute(
                                        'data-max'));
                                    charCount.textContent =
                                        `${editableContent.textContent.length}/${maxLength}`;
                                    charCount.classList.remove('hidden');
                                }
                            });
                            editableContent.addEventListener('blur', () => {
                                const charCount = editableContent.parentElement.querySelector(
                                    '.char-count');
                                if (charCount) {
                                    charCount.classList.add('hidden');
                                }
                            });
                        });

                        // Setup update button
                        const updateButton = row.querySelector('.edit-contents-cms-update');
                        updateButton.addEventListener('click', async () => {
                            const titleElement = row.querySelector(
                                '.editable-cell:nth-child(3) .editable-content');
                            const title = titleElement.textContent.trim();
                            const file = window.selectedFilePerTitle[title];
                            if (file) {
                                      const uploadedUrl = await updateCmsContent(title, file);

                                if (uploadedUrl) {
                                    item.content = uploadedUrl;
                                    delete window.selectedFilePerTitle[title];
                                    this.renderTable();
                                    this.showToast('✅ Image updated');
                                }
                            }
                        });
                    } else if (item.sectionType === 'logo') {
                        const row = document.createElement('tr');
                        row.classList.add('logo-row');
                        row.setAttribute('data-id', item.id);

                        // If this is a seed item that has multiple logos
                        const isMultiLogoArray = Array.isArray(item.content);
                        const logo = isMultiLogoArray ? item.content[0] : {
                            id: item.id,
                            image: item.content,
                            title: item.title,
                            mediaConstraints: item.mediaConstraints || {
                                formats: ['png'],
                                width: 200,
                                height: 100
                            },
                            isProtected: item.isProtected || false
                        };

                        row.innerHTML = `
                                        <td>${rowCounter++}</td>
                                        <td>${item.page || '-'}</td>
                                        <td class="editable-cell">
                                            <div class="editable-content" contenteditable="true">${logo.title}</div>
                                        </td>
                                        <td>
                                            <div class="media-container">
                                                <div class="media-preview">
                                                    <img src="${logo.image}" alt="${logo.title}" title="${logo.title}" />
                                                    ${!logo.isProtected ? `<span class="close-btn" data-id="${logo.id}">×</span>` : ''}
                                                </div>
                                                <div class="media-actions">
                                                    <input type="file" class="file-input hidden-input" accept="${logo.mediaConstraints.formats.map(f => `.${f}`).join(',')}">
                                                    <div class="upload-trigger">Replace Logo</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="edit-contents-cms-status">${item.status || '-'}</span></td>
                                        <td>
                                            <button class="edit-contents-cms-update">Update</button>
                                        </td>
                                    `;

                        tbody.appendChild(row);
                    } else if (item.isTestimonialArray) {
                        const testimonials = JSON.parse(item.content);
                        testimonials.forEach((testimonial, idx) => {
                            const testimonialRow = document.createElement('tr');
                            testimonialRow.dataset.id = `${item.id}-${idx}`;
                            testimonialRow.dataset.originalSno = rowCounter; 
                            testimonialRow.dataset.testimonialId = testimonial.id; 
                            testimonialRow.classList.add('testimonial-row');
                            const testimonialTitle = `Testimonial ${idx + 1}`;
                            testimonialRow.innerHTML = `
                                    <td>${rowCounter++}</td>
                                    <td>${item.page}</td>
                                    <td class="editable-cell no-border">
                                        <div class="editable-content" contenteditable="true">${testimonialTitle}</div>
                                    </td>
                                    <td class="editable-cell content-cell">
                                        <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.name || 20}">${testimonial.name}</div>
                                        <div class="char-count hidden" data-max="${item.maxLengthConstraints?.name || 20}">${testimonial.name.length}/${item.maxLengthConstraints?.name || 20}</div>
                                    </td>
                                    <td><span class="edit-contents-cms-status">${item.status}</span></td>
                                    <td>
                                        <button class="edit-contents-cms-edit">✏️</button>
                                    </td>
                                `;
                            tbody.appendChild(testimonialRow);

                            const editButton = testimonialRow.querySelector('.edit-contents-cms-edit');
                            editButton.addEventListener('click', () => {
                                testimonialRow.classList.toggle('edit-mode');
                                if (testimonialRow.classList.contains('edit-mode')) {
                                    const originalSno = testimonialRow.dataset
                                        .originalSno; // Use stored S.No
                                    const maxLengthIndicatorName =
                                        `<div class="char-count hidden" data-max="${item.maxLengthConstraints?.name || 20}">${testimonial.name.length}/${item.maxLengthConstraints?.name || 20}</div>`;
                                    const maxLengthIndicatorDesignation =
                                        `<div class="char-count hidden" data-max="${item.maxLengthConstraints?.designation || 20}">${testimonial.designation.length}/${item.maxLengthConstraints?.designation || 20}</div>`;
                                    const maxLengthIndicatorDescription =
                                        `<div class="char-count hidden" data-max="${item.maxLengthConstraints?.description || 160}">${testimonial.description.length}/${item.maxLengthConstraints?.description || 160}</div>`;

                                    testimonialRow.innerHTML = `
                                            <td>${originalSno}</td>
                                            <td>${item.page}</td>
                                            <td class="editable-cell no-border">
                                                <div class="editable-content" contenteditable="true">${testimonialTitle}</div>
                                            </td>
                                            <td class="editable-cell content-cell">
                                                <div class="testimonial-details">
                                                    <div class="testimonial-field">
                                                        <label>Name:</label>
                                                        <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.name || 20}">${testimonial.name}</div>
                                                        ${maxLengthIndicatorName}
                                                    </div>
                                                    <div class="testimonial-field">
                                                        <label>Designation:</label>
                                                        <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.designation || 20}">${testimonial.designation}</div>
                                                        ${maxLengthIndicatorDesignation}
                                                    </div>
                                                    <div class="testimonial-field">
                                                        <label>Rating (1-5):</label>
                                                        <input type="number" class="testimonial-rating" value="${testimonial.rating}" min="1" max="5">
                                                    </div>
                                                    <div class="testimonial-field">
                                                        <label>Description:</label>
                                                        <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.description || 160}">${testimonial.description}</div>
                                                        ${maxLengthIndicatorDescription}
                                                    </div>
                                                    <div class="testimonial-field media-field">
                                                        <label>Image:</label>
                                                        <div class="media-preview">
                                                            <img src="${testimonial.image}" alt="Testimonial image">
                                                            <span class="close-btn">×</span>
                                                        </div>
                                                        <input type="file" class="file-input hidden-input" accept="${testimonial.mediaConstraints.formats.map(format => `.${format}`).join(',')}">
                                                        <div class="upload-trigger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                                <polyline points="17 8 12 3 7 8"/>
                                                                <line x1="12" y1="3" x2="12" y2="15"/>
                                                            </svg>
                                                            Replace Image
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="edit-contents-cms-status">${item.status}</span></td>
                                            <td>
                                                <button class="edit-contents-cms-update">Update</button>
                                                <button class="edit-contents-cms-edit">✏️</button>
                                              <button class="remove-testimonial" title="Remove Testimonial"
    style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; padding: 6px 10px; margin-right: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
        <path d="M9 3V4H4V6H5V19C5 20.11 5.9 21 7 21H17C18.11 21 19 20.11 19 19V6H20V4H15V3H9M7 6H17V19H7V6Z" />
    </svg>
   
</button>

                                                ${idx === testimonials.length - 1 ? `
                                                                                                                   <button class="add-testimonial" title="Add Testimonial"
    style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; padding: 6px 10px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
    
</button>

                                                                                                                ` : ''}
                                            </td>
                                        `;

                                    const editableContents = testimonialRow.querySelectorAll(
                                        '.editable-content');
                                    editableContents.forEach((editableContent) => {
                                        if (testimonial.isProtected) {
                                            editableContent.contentEditable = "false";
                                            editableContent.classList.add(
                                                "disabled-edit");
                                            return;
                                        }
                                        editableContent.addEventListener('input',
                                            () => {
                                                const maxLength = parseInt(
                                                    editableContent
                                                    .getAttribute(
                                                        'data-max-length'));
                                                const charCount = editableContent
                                                    .parentElement.querySelector(
                                                        '.char-count');
                                                if (charCount) {
                                                    charCount.textContent =
                                                        `${editableContent.textContent.length}/${maxLength}`;
                                                    charCount.classList.toggle(
                                                        'hidden',
                                                        editableContent
                                                        .textContent.length <=
                                                        maxLength);
                                                    charCount.classList.toggle(
                                                        'error', editableContent
                                                        .textContent.length >
                                                        maxLength);
                                                }
                                            });
                                        editableContent.addEventListener('focus',
                                            () => {
                                                const maxLength = parseInt(
                                                    editableContent
                                                    .getAttribute(
                                                        'data-max-length'));
                                                const charCount = editableContent
                                                    .parentElement.querySelector(
                                                        '.char-count');
                                                if (charCount) {
                                                    charCount.textContent =
                                                        `${editableContent.textContent.length}/${maxLength}`;
                                                    charCount.classList.remove(
                                                        'hidden');
                                                }
                                            });
                                        editableContent.addEventListener('blur', () => {
                                            const charCount = editableContent
                                                .parentElement.querySelector(
                                                    '.char-count');
                                            if (charCount) {
                                                charCount.classList.add(
                                                    'hidden');
                                            }
                                        });
                                    });

                                    const fileInput = testimonialRow.querySelector(
                                        '.file-input');
                                    const uploadTrigger = testimonialRow.querySelector(
                                        '.upload-trigger');
                                    uploadTrigger.addEventListener('click', () => fileInput
                                        .click());
                                    fileInput.addEventListener('change', async (e) => {
                                        const file = e.target.files[0];
                                        if (file) {
                                            const formData = new FormData();
                                            formData.append('file', file);

                                            // Get CSRF token from meta tag
                                            const csrfToken = document
                                                .querySelector(
                                                    'meta[name="csrf-token"]')
                                                .getAttribute('content');

                                            const testimonialId = testimonialRow
                                                .dataset.testimonialId;
                                               

                                            try {
                                                const response = await fetch(
                                                    `/testimonial/upload-image/${testimonialId}`, {
                                                        method: 'POST',
                                                        headers: {
                                                            'X-CSRF-TOKEN': csrfToken,
                                                        },
                                                        body: formData
                                                    });

                                                const result = await response
                                                    .json();

                                                if (response.ok && result.url) {
                                                    testimonial.image = result.url;
                                                    item.content = JSON.stringify(
                                                        testimonials);
                                                    this.renderTable();
                                                    this.showToast(
                                                        '✅ Image uploaded successfully'
                                                    );
                                                } else {
                                                    this.showToast(
                                                        '❌ Failed to upload image',
                                                        true);
                                                }
                                            } catch (error) {
                                                console.error('Image upload error:',
                                                    error);
                                                this.showToast(
                                                    '⚠️ An error occurred while uploading the image',
                                                    true);
                                            }
                                        }
                                    });



                                    const updateButton = testimonialRow.querySelector(
                                        '.edit-contents-cms-update');
                                    updateButton.addEventListener('click', () => {
                                        const nameElement = testimonialRow
                                            .querySelector(
                                                '.testimonial-field:nth-child(1) .editable-content'
                                            );
                                        const designationElement = testimonialRow
                                            .querySelector(
                                                '.testimonial-field:nth-child(2) .editable-content'
                                            );
                                        const ratingElement = testimonialRow
                                            .querySelector('.testimonial-rating');
                                        const descriptionElement = testimonialRow
                                            .querySelector(
                                                '.testimonial-field:nth-child(4) .editable-content'
                                            );

                                        const maxLengthName = parseInt(nameElement
                                            .getAttribute('data-max-length'));
                                        const maxLengthDesignation = parseInt(
                                            designationElement.getAttribute(
                                                'data-max-length'));
                                        const maxLengthDescription = parseInt(
                                            descriptionElement.getAttribute(
                                                'data-max-length'));

                                        if (nameElement.textContent.length >
                                            maxLengthName) {
                                            this.showToast(
                                                `Name exceeds maximum length of ${maxLengthName} characters`,
                                                true);
                                            return;
                                        }
                                        if (designationElement.textContent.length >
                                            maxLengthDesignation) {
                                            this.showToast(
                                                `Designation exceeds maximum length of ${maxLengthDesignation} characters`,
                                                true);
                                            return;
                                        }
                                        if (descriptionElement.textContent.length >
                                            maxLengthDescription) {
                                            this.showToast(
                                                `Description exceeds maximum length of ${maxLengthDescription} characters`,
                                                true);
                                            return;
                                        }

                                        testimonial.name = nameElement.textContent;
                                        testimonial.designation = designationElement
                                            .textContent;
                                        testimonial.rating = parseInt(ratingElement
                                            .value);
                                        testimonial.description = descriptionElement
                                            .textContent;
                                        item.content = JSON.stringify(testimonials);
                                        testimonialRow.classList.remove('edit-mode');
                                        this.updateTestimonial(item, idx);
                                        this.renderTable();
                                    });

                                    if (testimonial.isProtected) {
                                        updateButton.disabled = true;
                                        updateButton.title =
                                            "This testimonial is protected and cannot be updated.";
                                        updateButton.classList.add("disabled-update");
                                    }

                                    const removeButton = testimonialRow.querySelector(
                                        '.remove-testimonial');
                                    removeButton.addEventListener('click', () => {
                                        this.removeTestimonial(item, idx);
                                    });

                                    if (idx === testimonials.length - 1) {
                                        const addButton = testimonialRow.querySelector(
                                            '.add-testimonial');
                                        addButton.addEventListener('click', () => {
                                            this.addNewTestimonial(item);
                                        });
                                    }
                                } else {
                                    this.renderTable();
                                }
                            });
                        });
                    } else if (item.isFaqArray) {
                        const faqs = JSON.parse(item.content);
                        faqs.forEach((faq, idx) => {
                            const faqRow = document.createElement('tr');
                            faqRow.dataset.id = `${item.id}-${idx}`;
                            faqRow.dataset.originalSno = rowCounter;
                            faqRow.classList.add('faq-row');
                            const faqTitle = `FAQ ${idx + 1}`;
                            faqRow.innerHTML = `
                                    <td>${rowCounter++}</td>
                                    <td>${item.page}</td>
                                    <td class="editable-cell no-border">
                                        <div class="editable-content" contenteditable="true">${faqTitle}</div>
                                    </td>
                                    <td class="editable-cell content-cell">
                                        <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.question || 100}">${faq.question}</div>
                                        <div class="char-count hidden" data-max="${item.maxLengthConstraints?.question || 100}">${faq.question.length}/${item.maxLengthConstraints?.question || 100}</div>
                                    </td>
                                    <td><span class="edit-contents-cms-status">${item.status}</span></td>
                                    <td>
                                        <button class="edit-contents-cms-edit">✏️</button>
                                    </td>
                                `;
                            tbody.appendChild(faqRow);

                            const editButton = faqRow.querySelector(
                                '.edit-contents-cms-edit');
                            editButton.addEventListener('click', () => {
                                faqRow.classList.toggle('edit-mode');
                                if (faqRow.classList.contains('edit-mode')) {
                                    const originalSno = faqRow.dataset
                                        .originalSno; // Use stored S.No
                                    let maxLengthIndicatorQuestion =
                                        `<div class="char-count hidden" data-max="${item.maxLengthConstraints?.question || 100}">${faq.question.length}/${item.maxLengthConstraints?.question || 100}</div>`;
                                    let maxLengthIndicatorAnswer =
                                        `<div class="char-count hidden" data-max="${item.maxLengthConstraints?.answer || 200}">${faq.answer.length}/${item.maxLengthConstraints?.answer || 200}</div>`;

                                    faqRow.innerHTML = `
                                                <td>${rowCounter - 1}</td>
                                                <td>${item.page}</td>
                                                <td class="editable-cell no-border">
                                                    <div class="editable-content" contenteditable="true">${faqTitle}</div>
                                                </td>
                                                <td class="editable-cell content-cell">
                                                    <div class="faq-details">
                                                        <div class="faq-field">
                                                            <label>Question:</label>
                                                            <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.question || 100}">${faq.question}</div>
                                                            ${maxLengthIndicatorQuestion}
                                                        </div>
                                                        <div class="faq-field">
                                                            <label>Answer:</label>
                                                            <div class="editable-content" contenteditable="true" data-max-length="${item.maxLengthConstraints?.answer || 200}">${faq.answer}</div>
                                                            ${maxLengthIndicatorAnswer}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="edit-contents-cms-status">${item.status}</span></td>
                                                <td>
                                                    <button class="edit-contents-cms-update">Update</button>
                                                    <button class="edit-contents-cms-edit">✏️</button>
                                                    <button class="remove-faq" title="Remove FAQ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    ${idx === faqs.length - 1 ? `
                                                                                                                                                                                                                                                                                                                                                                                    <button class="add-faq" title="Add FAQ">
                                                                                                                                                                                                                                                                                                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                                                                                                                                                                                                                                                                                                                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                                                                                                                                                                                                                                                                                                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                                                                                                                                                                                                                                                                                                                                        </svg>
                                                                                                                                                                                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                                                                                                                                                                                ` : ''}
                                                </td>
                                            `;

                                    const editableContents = faqRow
                                        .querySelectorAll(
                                            '.editable-content');
                                    editableContents.forEach((editableContent) => {
                                        editableContent.addEventListener(
                                            'input',
                                            () => {
                                                const maxLength =
                                                    parseInt(
                                                        editableContent
                                                        .getAttribute(
                                                            'data-max-length'
                                                        ));
                                                const charCount =
                                                    editableContent
                                                    .parentElement
                                                    .querySelector(
                                                        '.char-count');
                                                if (charCount) {
                                                    charCount
                                                        .textContent =
                                                        `${editableContent.textContent.length}/${maxLength}`;
                                                    charCount.classList
                                                        .toggle(
                                                            'hidden',
                                                            editableContent
                                                            .textContent
                                                            .length <=
                                                            maxLength);
                                                    charCount.classList
                                                        .toggle(
                                                            'error',
                                                            editableContent
                                                            .textContent
                                                            .length >
                                                            maxLength);
                                                }
                                            });
                                        editableContent.addEventListener(
                                            'focus',
                                            () => {
                                                const maxLength =
                                                    parseInt(
                                                        editableContent
                                                        .getAttribute(
                                                            'data-max-length'
                                                        ));
                                                const charCount =
                                                    editableContent
                                                    .parentElement
                                                    .querySelector(
                                                        '.char-count');
                                                if (charCount) {
                                                    charCount
                                                        .textContent =
                                                        `${editableContent.textContent.length}/${maxLength}`;
                                                    charCount.classList
                                                        .remove(
                                                            'hidden');
                                                }
                                            });
                                        editableContent.addEventListener(
                                            'blur', () => {
                                                const charCount =
                                                    editableContent
                                                    .parentElement
                                                    .querySelector(
                                                        '.char-count');
                                                if (charCount) {
                                                    charCount.classList
                                                        .add(
                                                            'hidden');
                                                }
                                            });
                                    });

                                    const updateButton = faqRow.querySelector(
                                        '.edit-contents-cms-update');
                                    updateButton.addEventListener('click', () => {
                                        const questionElement = faqRow
                                            .querySelector(
                                                '.faq-field:nth-child(1) .editable-content'
                                            );
                                        const answerElement = faqRow
                                            .querySelector(
                                                '.faq-field:nth-child(2) .editable-content'
                                            );

                                        const maxLengthQuestion = parseInt(
                                            questionElement
                                            .getAttribute(
                                                'data-max-length'));
                                        const maxLengthAnswer = parseInt(
                                            answerElement
                                            .getAttribute(
                                                'data-max-length'));

                                        if (questionElement.textContent
                                            .length >
                                            maxLengthQuestion) {
                                            this.showToast(
                                                `Question exceeds maximum length of ${maxLengthQuestion} characters`,
                                                true);
                                            return;
                                        }
                                        if (answerElement.textContent
                                            .length >
                                            maxLengthAnswer) {
                                            this.showToast(
                                                `Answer exceeds maximum length of ${maxLengthAnswer} characters`,
                                                true);
                                            return;
                                        }

                                        faq.question = questionElement
                                            .textContent;
                                        faq.answer = answerElement
                                            .textContent;
                                        item.content = JSON.stringify(faqs);
                                        this.updateFAQ(item, idx);
                                        faqRow.classList.remove(
                                            'edit-mode');

                                        this.renderTable();
                                        this.showToast('FAQ updated');
                                    });

                                    const removeButton = faqRow.querySelector(
                                        '.remove-faq');
                                    removeButton.addEventListener('click', () => {
                                        this.removeFAQ(item, idx);
                                    });

                                    if (idx === faqs.length - 1) {
                                        const addButton = faqRow.querySelector(
                                            '.add-faq');
                                        addButton.addEventListener('click', () => {
                                            this.addNewFAQ(item);
                                        });
                                    }
                                } else {
                                    this.renderTable();
                                }
                            });
                        });
                    } else {
                        row.innerHTML = `
            <td>${rowCounter++}</td>
            <td>${item.page}</td>
            <td class="editable-cell">
                <div class="editable-content" contenteditable="true">${item.title}</div>
            </td>
            <td class="editable-cell content-cell">
                <div class="editable-content" contenteditable="true" data-max-length="${item.maxLength || 100}">${item.content}</div>
                <div class="char-count hidden" data-max="${item.maxLength || 100}">${item.content.length}/${item.maxLength || 100}</div>
            </td>
            <td><span class="edit-contents-cms-status">${item.status}</span></td>
            <td>
                <button class="edit-contents-cms-edit">✏️</button>
            </td>
        `;
                        tbody.appendChild(row);

                        const editableContents = row.querySelectorAll('.editable-content');
                        editableContents.forEach((editableContent) => {
                            editableContent.addEventListener('input', () => {
                                const maxLength = parseInt(editableContent.getAttribute(
                                    'data-max-length'));
                                const charCount = editableContent.parentElement.querySelector(
                                    '.char-count');
                                if (charCount) {
                                    charCount.textContent =
                                        `${editableContent.textContent.length}/${maxLength}`;
                                    charCount.classList.toggle('hidden', editableContent
                                        .textContent.length <= maxLength);
                                    charCount.classList.toggle('error', editableContent
                                        .textContent.length > maxLength);
                                }
                            });
                            editableContent.addEventListener('focus', () => {
                                const maxLength = parseInt(editableContent.getAttribute(
                                    'data-max-length'));
                                const charCount = editableContent.parentElement.querySelector(
                                    '.char-count');
                                if (charCount) {
                                    charCount.textContent =
                                        `${editableContent.textContent.length}/${maxLength}`;
                                    charCount.classList.remove('hidden');
                                }
                            });
                            editableContent.addEventListener('blur', () => {
                                const charCount = editableContent.parentElement.querySelector(
                                    '.char-count');
                                if (charCount) {
                                    charCount.classList.add('hidden');
                                }
                            });
                        });

                        const editButton = row.querySelector('.edit-contents-cms-edit');
                        editButton.addEventListener('click', () => {
                            row.classList.toggle('edit-mode');
                            if (row.classList.contains('edit-mode')) {
                                const originalSno = row.querySelector('td').textContent;
                                const maxLength = item.maxLength || 100;
                                const maxLengthIndicator = `
                    <div class="char-count hidden" data-max="${maxLength}">
                        ${item.content.length}/${maxLength}
                    </div>`;

                                row.innerHTML = `
                    <td>${originalSno}</td>
                    <td>${item.page}</td>
                    <td class="editable-cell">
                        <div class="editable-content" contenteditable="true">${item.title}</div>
                    </td>
                    <td class="editable-cell content-cell">
                        <div class="editable-content" contenteditable="true" data-max-length="${maxLength}">${item.content}</div>
                        ${maxLengthIndicator}
                    </td>
                    <td><span class="edit-contents-cms-status">${item.status}</span></td>
                    <td>
                        <button class="edit-contents-cms-update">Update</button>
                        <button class="edit-contents-cms-edit">✏️</button>
                    </td>
                `;

                                const newEditableContents = row.querySelectorAll('.editable-content');
                                newEditableContents.forEach((editableContent) => {
                                    editableContent.addEventListener('input', () => {
                                        const maxLength = parseInt(editableContent
                                            .getAttribute('data-max-length'));
                                        const charCount = editableContent.parentElement
                                            .querySelector('.char-count');
                                        if (charCount) {
                                            charCount.textContent =
                                                `${editableContent.textContent.length}/${maxLength}`;
                                            charCount.classList.toggle('hidden',
                                                editableContent.textContent
                                                .length <= maxLength);
                                            charCount.classList.toggle('error',
                                                editableContent.textContent.length >
                                                maxLength);
                                        }
                                    });
                                    editableContent.addEventListener('focus', () => {
                                        const maxLength = parseInt(editableContent
                                            .getAttribute('data-max-length'));
                                        const charCount = editableContent.parentElement
                                            .querySelector('.char-count');
                                        if (charCount) {
                                            charCount.textContent =
                                                `${editableContent.textContent.length}/${maxLength}`;
                                            charCount.classList.remove('hidden');
                                        }
                                    });
                                    editableContent.addEventListener('blur', () => {
                                        const charCount = editableContent.parentElement
                                            .querySelector('.char-count');
                                        if (charCount) {
                                            charCount.classList.add('hidden');
                                        }
                                    });
                                });

                                const updateButton = row.querySelector('.edit-contents-cms-update');
                                updateButton.addEventListener('click', () => {
                                    const titleElement = row.querySelector(
                                        '.editable-cell:nth-child(3) .editable-content');
                                    const contentElement = row.querySelector(
                                        '.editable-cell:nth-child(4) .editable-content');
                                    const maxLength = parseInt(contentElement.getAttribute(
                                        'data-max-length'));

                                    if (contentElement.textContent.length > maxLength) {
                                        this.showToast(
                                            `Content exceeds maximum length of ${maxLength} characters`,
                                            true);
                                        return;
                                    }

                                    item.title = titleElement.textContent;
                                    item.content = contentElement.textContent;
                                    this.updateHeroContentToAPI(item);
                                    row.classList.remove('edit-mode');
                                    this.renderTable();
                                    this.showToast('Content updated');
                                });
                            }
                        });
                    }




                    const fileInputs = row.querySelectorAll('.file-input');
                    fileInputs.forEach((fileInput, idx) => {
                        const uploadTrigger = fileInput.parentElement.querySelector(
                            '.upload-trigger');
                        uploadTrigger.addEventListener('click', () => {
                            fileInput.click();
                        });
                        fileInput.addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (event) => {
                                    const img = new Image();
                                    img.onload = () => {
                                        const constraints = item
                                            .mediaConstraints || (
                                                item.isTestimonialArray ?
                                                JSON.parse(
                                                    item.content)[idx]
                                                ?.mediaConstraints : null);
                                        if (img.width === constraints
                                            ?.width && img
                                            .height === constraints?.height
                                        ) {
                                            if (item.isTestimonialArray) {
                                                const testimonials = JSON
                                                    .parse(item
                                                        .content);
                                                testimonials[idx].image =
                                                    event.target
                                                    .result;
                                                item.content = JSON
                                                    .stringify(
                                                        testimonials);
                                            } else {
                                                item.content = event.target
                                                    .result;
                                            }
                                            this.renderTable();
                                        } else {
                                            this.resizeImage(event.target
                                                .result,
                                                constraints?.width,
                                                constraints
                                                ?.height, (
                                                    resizedImage) => {
                                                    if (item
                                                        .isTestimonialArray
                                                    ) {
                                                        const
                                                            testimonials =
                                                            JSON
                                                            .parse(item
                                                                .content
                                                            );
                                                        testimonials[
                                                                idx]
                                                            .image =
                                                            resizedImage;
                                                        item.content =
                                                            JSON
                                                            .stringify(
                                                                testimonials
                                                            );
                                                    } else {
                                                        item.content =
                                                            resizedImage;
                                                    }
                                                    this.renderTable();
                                                });
                                        }
                                    };
                                    img.src = event.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    });

                    row.querySelectorAll('.remove-logo').forEach((button) => {
                        button.addEventListener('click', () => {
                            const rowId = parseInt(button.closest('tr').getAttribute(
                                'data-id'));
                            this.removeLogo(rowId); // call with actual logo ID
                        });
                    });

                    // Add Logo Button
                    row.querySelectorAll('.add-logo').forEach((button) => {
                        button.addEventListener('click', () => {
                            const rowId = parseInt(button.closest('tr').getAttribute(
                                'data-id'));
                            const logoItem = this.filteredData.find(i => i.id === rowId);
                            if (logoItem) {
                                this.addNewLogo(logoItem);
                            }
                        });
                    });



                    initializeFileInputs();
                    initializeUpdateButtons();
                });

                this.renderPagination();
            }




            renderPagination() {
                const totalItems = this.filteredData.length;
                const totalPages = Math.ceil(totalItems / this.rowsPerPage);
                const paginationControls = document.getElementById('paginationControls');
                paginationControls.innerHTML = '';

                if (totalItems === 0) {
                    paginationControls.innerHTML = '<span>No data available</span>';
                    return;
                }

                const paginationContainer = document.createElement('div');
                paginationContainer.classList.add('pagination-container');

                const prevButton = document.createElement('button');
                prevButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        `;
                prevButton.disabled = this.currentPage === 1;
                prevButton.addEventListener('click', () => {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.renderTable();
                    }
                });
                paginationContainer.appendChild(prevButton);

                const startIndex = (this.currentPage - 1) * this.rowsPerPage + 1;
                const endIndex = Math.min(this.currentPage * this.rowsPerPage, totalItems);
                const paginationText = document.createElement('span');
                paginationText.textContent = `${startIndex}-${endIndex} of ${totalItems}`;
                paginationContainer.appendChild(paginationText);

                const nextButton = document.createElement('button');
                nextButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        `;
                nextButton.disabled = this.currentPage === totalPages;
                nextButton.addEventListener('click', () => {
                    if (this.currentPage < totalPages) {
                        this.currentPage++;
                        this.renderTable();
                    }
                });
                paginationContainer.appendChild(nextButton);

                paginationControls.appendChild(paginationContainer);
            }

            handleSave() {
                this.showLoading();
                setTimeout(() => {
                    this.originalData = JSON.parse(JSON.stringify(this.data));
                    this.hideLoading();
                    this.showToast('Changes saved successfully');
                }, 1000);
            }
        }




        document.addEventListener('DOMContentLoaded', () => {
            renderContent(contentData);

            const dropdownToggle = document.querySelector('.admin-edit-dropdown-toggle');
            const dropdownMenu = document.querySelector('.admin-edit-dropdown-menu');
            const dropdownItems = document.querySelectorAll('.admin-edit-dropdown-item');

            dropdownToggle.addEventListener('click', () => {
                dropdownMenu.classList.toggle('show');
            });

            dropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const sortValue = item.getAttribute('data-value');
                    let sortedData = [...contentData];
                    if (sortValue === 'name') {
                        sortedData.sort((a, b) => a.name.localeCompare(b.name));
                    } else if (sortValue === 'role') {
                        sortedData.sort((a, b) => b.name.localeCompare(a.name));
                    } else if (sortValue === 'email-new') {
                        sortedData.sort((a, b) => b.sections - a.sections);
                    } else if (sortValue === 'email-old') {
                        sortedData.sort((a, b) => a.sections - b.sections);
                    }
                    renderContent(sortedData);
                    dropdownMenu.classList.remove('show');
                });
            });

            document.addEventListener('click', (e) => {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });

        function initializeFileInputs() {
            document.querySelectorAll('.file-input').forEach(input => {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (!file || !file.type.startsWith('image/')) {
                        alert('Only image files allowed');
                        return;
                    }

                    const title = this.closest('tr')?.querySelector('.editable-content')
                        ?.innerText
                        ?.trim(); // if input is in row
                    if (!title) {
                        alert('Missing title to associate with file');
                        return;
                    }

                    window.selectedFilePerTitle[title] = file;
                    console.log('✅ Stored file for title:', title, file);
                });
            });
        }




   // ✅ Declare globally or in your module scope
async function updateCmsContent(title, file) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('title', title);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch('/api/update-cms-imageupload', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    });

    const result = await response.json();
    if (!response.ok) throw new Error(result.message || 'Upload failed');

    return result.file_url;
}


   // ...






        function initializeUpdateButtons() {
            document.querySelectorAll('.edit-contents-cms-update').forEach(button => {
                if (button.dataset.listenerAttached === 'true') return;

                button.addEventListener('click', async function() {
                    const row = this.closest('tr');
                    const title = row.querySelector('.editable-content')?.innerText?.trim();

                    const file = window.selectedFilePerTitle[title];

                    if (!file) {
                        alert('Please select an image file first');
                        return;
                    }

                    const uploadedUrl = await updateCmsContent(title, file);
                    if (uploadedUrl) {
                        delete window.selectedFilePerTitle[title];

                        const preview = row.querySelector('.media-preview');
                        if (preview) {
                            preview.innerHTML = `<img src="${uploadedUrl}" width="200">`;
                        }
                        window.cmsEditor.showToast('✅ Image uploaded!');
                    }
                });

                button.dataset.listenerAttached = 'true';
            });
        }
    </script>
</body>

</html>
