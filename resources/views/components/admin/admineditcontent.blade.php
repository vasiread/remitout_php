<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/adminedit.css">
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
        const contentData = [
            { name: "Landing Page", sections: 116, tags: ["Text", "Img", "Video"] },
            { name: "Contact Page", sections: 2, tags: ["Text", "Img", "Video"] },
            { name: "About Us", sections: 3, tags: ["Text"] },
            { name: "Services", sections: 5, tags: ["Text", "Images", "Video"] },
            { name: "Contact Page", sections: 2, tags: ["Text", "Img", "Video"] }
        ];

        const contentList = document.querySelector('.edit-content-list');

        function renderContent(data) {
            contentList.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('div');
                row.classList.add('edit-content-row');
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
                    if (!Array.from(pageSelect.options).some(opt => opt.value === item.name.toLowerCase())) {
                        pageSelect.innerHTML = `<option value="${item.name.toLowerCase()}">${item.name}</option>` + pageSelect.innerHTML;
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

        document.querySelector('.edit-content-search-input').addEventListener('input', function () {
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
                        maxLength: 30
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
                            height: 320
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
                        maxLength: 50
                    },
                    {
                        id: 8,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 1 Name',
                        content: 'Mark Debrovski',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 9,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 1 Designation',
                        content: 'Designation',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 10,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 1 Rating',
                        content: '5',
                        status: 'Active',
                        maxLength: 1
                    },
                    {
                        id: 11,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 1 Description',
                        content: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 12,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 1 Image',
                        content: '/api/placeholder/100/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 100,
                            height: 100
                        }
                    },
                    {
                        id: 13,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 2 Name',
                        content: 'Debrovski',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 14,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 2 Designation',
                        content: 'Designation',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 15,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 2 Rating',
                        content: '4',
                        status: 'Active',
                        maxLength: 1
                    },
                    {
                        id: 16,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 2 Description',
                        content: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 17,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 2 Image',
                        content: '/api/placeholder/100/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 100,
                            height: 100
                        }
                    },
                    {
                        id: 18,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 3 Name',
                        content: 'Mark Debrovski',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 19,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 3 Designation',
                        content: 'Designation',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 20,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 3 Rating',
                        content: '5',
                        status: 'Active',
                        maxLength: 1
                    },
                    {
                        id: 21,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 3 Description',
                        content: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 22,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 3 Image',
                        content: '/api/placeholder/100/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 100,
                            height: 100
                        }
                    },
                    {
                        id: 23,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 4 Name',
                        content: 'Mark Debrovski',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 24,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 4 Designation',
                        content: 'Designation',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 25,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 4 Rating',
                        content: '5',
                        status: 'Active',
                        maxLength: 1
                    },
                    {
                        id: 26,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 4 Description',
                        content: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 27,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial Card 4 Image',
                        content: '/api/placeholder/100/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 100,
                            height: 100
                        }
                    },
                    // Logo Section
                    {
                        id: 28,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo 1',
                        content: '/api/placeholder/200/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 200,
                            height: 100
                        }
                    },
                    {
                        id: 29,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo 2',
                        content: '/api/placeholder/200/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 200,
                            height: 100
                        }
                    },
                    {
                        id: 30,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo 3',
                        content: '/api/placeholder/200/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 200,
                            height: 100
                        }
                    },
                    {
                        id: 31,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo 4',
                        content: '/api/placeholder/200/100',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 200,
                            height: 100
                        }
                    },
                    {
                        id: 32,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo 5',
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
                        id: 33,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Graph Heading',
                        content: 'Your Smart Route to Study Loans',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 34,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Graph Subheading',
                        content: 'Bespoke Loan Options from Trusted NBFCs for Your International Education.',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 35,
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
                        id: 36,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 1 Header: Profile Assessment',
                        content: 'Profile Assessment',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 37,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 1 Content: Profile Assessment',
                        content: 'Our experts assess your academic and financial profile to determine the best loan options for your overseas education.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 38,
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
                        id: 39,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Profile Assessment',
                        content: 'Profile Assessment',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 40,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 2 Header: Get Matched with Top NBFCs',
                        content: 'Get Matched with Top NBFCs',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 41,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 2 Content: Get Matched with Top NBFCs',
                        content: 'We connect you with multiple non-banking financial companies (NBFCs) offering competitive study loans.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 42,
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
                        id: 43,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Perfect Match',
                        content: 'Perfect Match',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 44,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 3 Header: Choose Your Loan Offers',
                        content: 'Choose Your Loan Offers',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 45,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 3 Content: Choose Your Loan Offers',
                        content: 'Browse and compare personalized loan offers based on your eligibility and repayment preferences.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 46,
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
                        id: 47,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Loan Choices',
                        content: 'Loan Choices',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 48,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 4 Header: Submit Documents With Ease',
                        content: 'Submit Documents With Ease',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 49,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 4 Content: Submit Documents With Ease',
                        content: 'Upload your required documents securely through our platform for a seamless process.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 50,
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
                        id: 51,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Easy Process',
                        content: 'Easy Process',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 52,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 5 Header: Fast-Track Approval',
                        content: 'Fast-Track Approval',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 53,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 5 Content: Fast-Track Approval',
                        content: 'Experience quick approvals with minimal delays, ensuring you stay on track for your educational goals.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 54,
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
                        id: 55,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Fast-Track Approval',
                        content: 'Fast-Track Approval',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 56,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 6 Header: Guaranteed Disbursement',
                        content: 'Guaranteed Disbursement',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 57,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Step 6 Content: Guaranteed Disbursement',
                        content: 'Once approved, your loan is disbursed directly to your institution on time, securing your admission.',
                        status: 'Active',
                        maxLength: 150
                    },
                    {
                        id: 58,
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
                        id: 59,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Diagonal Label: Guaranteed Disbursement',
                        content: 'Guaranteed Disbursement',
                        status: 'Active',
                        maxLength: 50
                    },
                    // Secure Loan Section
                    {
                        id: 60,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Main Heading',
                        content: 'Where your safety meets<br>smart lending',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 61,
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
                        id: 62,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 1 Title',
                        content: 'Integrated Support, Anytime, Anywhere',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 63,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 1 Description',
                        content: 'Instant support builds trust and enhances experience!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 64,
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
                        id: 65,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 2 Title',
                        content: 'Rapid Processing',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 66,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 2 Description',
                        content: 'Easy student remittance in just a few steps!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 67,
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
                        id: 68,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 3 Title',
                        content: 'Best Price Commitment',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 69,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 3 Description',
                        content: 'Transparent, competitive exchange rates guaranteed!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 70,
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
                        id: 71,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 4 Title',
                        content: 'Absolutely Protected',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 72,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Feature 4 Description',
                        content: 'Instant transfers, no fees, 24/7 support!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 73,
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
                        id: 74,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'CTA Button Text',
                        content: 'Secure your loan now!',
                        status: 'Active',
                        maxLength: 30
                    },
                    {
                        id: 75,
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
                        id: 76,
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
                        id: 77,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        content: 'Radcliffe Image',
                        status: 'assets/images/image-1.png',
                        status: 'Active',
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['png', 'jpg', 'jpeg'],
                            width: 300,
                            height: 200
                        }
                    },
                    {
                        id: 78,
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
                        id: 79,
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
                        id: 80,
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
                        id: 81,
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
                        id: 82,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Heading',
                        content: 'Effortless and affordable <br>global transfers!',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 83,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Description',
                        content: 'Support loved ones abroad by sending money from India for education and expenses. Transfer to 40+ countries with real exchange rates, no hidden fees. Sign up easily online with your PAN and address.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 84,
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
                        id: 85,
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
                        id: 86,
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
                        id: 87,
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
                        id: 88,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Students Stat Value',
                        content: '500+',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 89,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Students Stat Label',
                        content: 'Students',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 90,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'NBFCs Stat Value',
                        content: '100',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 91,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'NBFCs Stat Label',
                        content: 'editable',
                        maxLength: 20
                    },
                    {
                        id: 92,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Countries Stat Value',
                        content: '40+',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 93,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Countries Stat Label',
                        content: 'Countries',
                        status: 'Active',
                        maxLength: 20
                    },
                    {
                        id: 94,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Customers Stat Value',
                        content: '2k+',
                        status: 'Active',
                        maxLength: 10
                    },
                    {
                        id: 95,
                        page: 'Landing Page',
                        sectionType: 'global-transfer',
                        title: 'Customers Stat Label',
                        content: 'Customers',
                        status: 'Active',
                        maxLength: 20
                    },
                    // FAQ Section
                    {
                        id: 96,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Header Desktop',
                        content: 'Frequently asked questions',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 97,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 1',
                        content: 'How can I apply for a loan with Remitout?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 98,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 1',
                        content: 'You can easily apply online by visiting our application page and filling out a short form with your basic information. Once submitted, our team will reach out with the next steps.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 99,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 2',
                        content: 'What are the eligibility criteria for a loan?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 100,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 2',
                        content: 'Our eligibility criteria includes age requirements, income verification, and credit history assessment. Please contact our support team for detailed information specific to your situation.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 101,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 3',
                        content: 'How long does the loan approval process take?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 102,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 3',
                        content: 'The loan approval process typically takes 2-3 business days, depending on the completeness of your application and required documentation.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 103,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 4',
                        content: 'What documents are required to apply for a loan?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 104,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 4',
                        content: 'Required documents typically include government-issued ID, proof of income, bank statements, and proof of address. Specific requirements may vary based on the loan type.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 105,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 5',
                        content: 'Can I apply for a loan if I have bad credit?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 106,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 5',
                        content: 'While bad credit may impact your eligibility, we assess applications on a case-by-case basis. Reach out to our support team to discuss potential options for your situation.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 107,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 6',
                        content: 'How do I track my loan application status?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 108,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 6',
                        content: 'You can track the status of your loan application by logging into your account on our website. Additionally, our team will notify you of any updates via email or phone.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 109,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 7',
                        content: 'Can I use my loan for any purpose?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 110,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 7',
                        content: 'Our loans are designed primarily for educational expenses. While most loans can be used for tuition, living costs, and study-related expenses, check the loan terms for any specific restrictions.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 111,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 8',
                        content: 'What is the repayment schedule for my loan?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 112,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 8',
                        content: 'Repayment terms are customized based on your loan amount, tenure, and educational institution. You’ll be informed about your repayment schedule at the time of loan approval.',
                        maxLength: 200
                    },
                    {
                        id: 113,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 9',
                        content: 'How do I choose the best loan offer for me?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 114,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 9',
                        content: 'Once your profile is assessed, we provide personalized loan offers. You can compare these offers based on your eligibility, interest rates, and repayment options to select the one that best suits your needs.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 115,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 10',
                        content: 'Can I pay off my loan early?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 116,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 10',
                        content: 'Yes, you can pay off your loan early without any prepayment penalties. Early repayment may also help you save on interest charges.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 117,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 11',
                        content: 'What happens if I miss a loan payment?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 118,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 11',
                        content: 'If you miss a loan payment, please contact us immediately. We may offer alternative arrangements or extend your payment period. It’s important to keep us informed to avoid negative impacts on your credit score.',
                        status: 'Active',
                        maxLength: 200
                    },
                    {
                        id: 119,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Question 12',
                        content: 'How fast can I receive my loan disbursement?',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 120,
                        page: 'Landing Page',
                        sectionType: 'faq-section',
                        title: 'FAQ Answer 12',
                        content: 'Once approved, your loan will be disbursed directly to your educational institution in a timely manner, ensuring there are no delays in securing your admission.',
                        status: 'Active',
                        maxLength: 200
                    },
                    // Footer Section
                   {
                    id: 121,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Company Description',
                    content: 'B/415DAMJI SHAMJI CORPORATE SQUARE BEHIND EVEREST GARDEN GM LINK RD GTK, Mumbai, Maharashtra, India, 400075',
                    status: 'Active',
                    maxLength: 150
                },
                {
                    id: 122,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Contact Number',
                    content: '+91 75784 75788',
                    status: 'Active',
                    maxLength: 20
                },
                {
                    id: 123,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Quick Links',
                    content: 'Home | About Us | Services | Contact | FAQs',
                    status: 'Active',
                    maxLength: 100
                },
                {
                    id: 124,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Social Media Links',
                    content: 'Twitter: https://x.com/RemitoutL | Instagram: https://www.instagram.com/remitout_india/ | Facebook: https://www.facebook.com/RemitoutIN/',
                    status: 'Active',
                    maxLength: 200
                },
                {
                    id: 125,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Signup Heading',
                    content: 'Sign Up with us Today!',
                    status: 'Active',
                    maxLength: 50
                },
                {
                    id: 126,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Signup Description',
                    content: 'Prepare yourself and let\'s explore this world.',
                    status: 'Active',
                    maxLength: 100
                },
                {
                    id: 127,
                    page: 'Landing Page',
                    sectionType: 'footer',
                    title: 'Register Button Text',
                    content: 'Register Now!',
                    status: 'Active',
                    maxLength: 20
                },
                {
                    id: 128,
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
                    id: 129,
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
                    id: 130,
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
                this.toastQueue.push({ message, isError });
                this.processToastQueue();
            }

            processToastQueue() {
                if (this.isToastActive || this.currentPage === 0) return;

                this.isToastActive = true;
                const { message, isError } = this.currentPageQueue.shift();
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
                        this.currentPageToastQueue();
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
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    canvas.width = targetWidth;
                    canvas.height = targetHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, targetWidth, targetHeight);
                    callback(canvas.toDataURL('image/jpeg', true));
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
                    item.content.toString().toLowerCase().includes(searchTerm)
                );
                this.renderTable();
            }

            handlePageChange(page) {
                if (!page || page === 'all') {
                    this.currentPage = this.data;
                    this.renderTable = 1;
                    return;
                }
                const pageName = page.charAt(0).toUpperCase() + page.slice(1).toLowerCase();
                this.filteredData = this.data.filter(item => 
                    item.page.toLowerCase() === pageName.toLowerCase()
                );
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
                this.currentPage = 1;
                this.renderTable();
            }

            renderTable() {
                const tbody = document.getElementById('cmsTableBody');
                tbody.innerHTML = '';

                const startIndex = (this.currentPage - 1) * this.rowsPerPage;
                const endIndex = Math.min(startIndex + this.rowsPerPage, this.filteredData.length);
                const paginatedData = this.filteredData.slice(startIndex, endIndex);

                paginatedData.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.dataset.id = item.id;

                    if (item.isMedia) {
                        row.innerHTML = `
                            <td>${startIndex + index + 1}</td>
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
                                            Replace Media
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="edit-contents-cms-status">${item.status}</span></td>
                            <td>
                                <button class="edit-contents-cms-update">Update</button>
                            </td>
                        `;
                        const fileInput = row.querySelector('.file-input');
                        const uploadTrigger = row.querySelector('.upload-trigger');
                        const closeBtn = row.querySelector('.close-btn');

                        uploadTrigger.addEventListener('click', () => {
                            fileInput.click();
                        });

                        fileInput.addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            if (file) {
                                if (file.size > 5 * 1024 * 1024) {
                                    this.showToast('File size should be less than 5MB', true);
                                    return;
                                }
                                if (item.mediaConstraints && item.mediaConstraints.formats) {
                                    const fileExt = file.name.split('.').pop().toLowerCase();
                                    if (!item.mediaConstraints.formats.includes(fileExt)) {
                                        this.showToast(`Only ${item.mediaConstraints.formats.join(', ')} files are allowed`, true);
                                        return;
                                    }
                                }
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    const mediaElement = row.querySelector('.media-preview video, .media-preview img');
                                    mediaElement.src = e.target.result;
                                    if (item.mediaConstraints && item.mediaConstraints.width && item.mediaConstraints.height) {
                                        const tempMedia = item.mediaConstraints.formats.includes('mp4') || item.mediaConstraints.formats.includes('webm') ? new Video() : new Image();
                                        tempMedia.onload = () => {
                                            if (tempMedia.width !== item.mediaConstraints.width || tempMedia.height !== item.mediaConstraints.height) {
                                                this.showToast(`Media must be ${item.mediaConstraints.width}×${item.mediaConstraints.height}px. Your media is ${tempMedia.width}×${tempMedia.height}px.`, true);
                                                this.resizeImage(e.target.result, item.mediaConstraints.width, item.mediaConstraints.height, (resizedMedia) => {
                                                    mediaElement.src = resizedMedia;
                                                    item.content = resizedMedia;
                                                    this.showToast('Media resized to required dimensions');
                                                });
                                            } else {
                                                item.content = e.target.result;
                                                this.showToast('Media updated successfully');
                                            }
                                        };
                                        tempMedia.src = e.target.result;
                                    } else {
                                        item.content = e.target.result;
                                        this.showToast('Media updated successfully');
                                    }
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        closeBtn.addEventListener('click', () => {
                            const mediaElement = row.querySelector('.media-preview video, .media-preview img');
                            mediaElement.src = '/api/placeholder/400/320';
                            item.content = '/api/placeholder/400/320';
                            this.showToast('Media removed');
                        });
                    } else {
                        let maxLengthIndicator = '';
                        if (item.maxLength) {
                            const currentLength = item.content.length;
                            const remainingChars = item.maxLength - currentLength;
                            const charCountClass = remainingChars < 0 ? 'char-count-exceeded' : 'char-count';
                            maxLengthIndicator = `<div class="${charCountClass} hidden" data-max="${item.maxLength}">${currentLength}/${item.maxLength}</div>`;
                        }
                        row.innerHTML = `
                            <td>${startIndex + index + 1}</td>
                            <td>${item.page}</td>
                            <td class="editable-cell">
                                <div class="editable-content" contenteditable="true">${item.title}</div>
                            </td>
                            <td class="editable-cell content-cell">
                                <div class="editable-content" contenteditable="true" ${item.maxLength ? `data-max-length="${item.maxLength}"` : ''}>${item.content}</div>
                                ${maxLengthIndicator}
                            </td>
                            <td><span class="edit-contents-cms-status">${item.status}</span></td>
                            <td>
                                <button class="edit-contents-cms-edit">✏️</button>
                            </td>
                        `;
                    }
                    tbody.appendChild(row);
                });

                this.addEditListeners();
                this.renderPagination(this.filteredData.length);
            }

            renderPagination(totalItems) {
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
                paginationText.style.margin = '0 10px';
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

            addEditListeners() {
                document.querySelectorAll('.edit-contents-cms-edit').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const row = e.target.closest('tr');
                        row.classList.toggle('edit-mode');
                        const charCount = row.querySelector('.char-count, .char-count-exceeded');
                        if (charCount) {
                            charCount.classList.remove('hidden');
                        }
                        const editableContents = row.querySelectorAll('.editable-content');
                        editableContents.forEach(content => {
                            content.focus();
                        });
                    });
                });

                document.querySelectorAll('.edit-contents-cms-update').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const row = e.target.closest('tr');
                        const id = parseInt(row.dataset.id);
                        const item = this.data.find(item => item.id === id);
                        if (item) {
                            const editableContents = row.querySelectorAll('.editable-content');
                            editableContents.forEach((content, index) => {
                                if (index === 0) item.title = content.textContent;
                            });
                            const charCount = row.querySelector('.char-count-exceeded');
                            if (charCount) {
                                charCount.classList.add('hidden');
                            }
                            this.showToast('Content updated successfully');
                            this.renderTable();
                        }
                    });
                });

                document.querySelectorAll('.editable-content[data-max-length]').forEach(content => {
                    const maxLength = parseInt(content.getAttribute('data-max-length'));
                    const charCount = content.nextElementSibling;
                    content.addEventListener('input', () => {
                        const currentLength = content.textContent.length;
                        charCount.textContent = `${currentLength}/${maxLength}`;
                        if (currentLength > maxLength) {
                            charCount.classList.remove('char-count');
                            charCount.classList.add('char-count-exceeded');
                            content.textContent = content.textContent.substring(0, maxLength);
                            charCount.textContent = `${maxLength}/${maxLength}`;
                            this.placeCaretAtEnd(content);
                        } else {
                            charCount.classList.remove('char-count-exceeded');
                            charCount.classList.add('char-count');
                        }
                    });
                });

                document.querySelectorAll('.editable-content').forEach(content => {
                    content.addEventListener('dblclick', () => {
                        const row = content.closest('tr');
                        row.classList.add('edit-mode');
                        const charCount = row.querySelector('.char-count, .char-count-exceeded');
                        if (charCount) {
                            charCount.classList.remove('hidden');
                        }
                        content.focus();
                    });

                    content.addEventListener('blur', () => {
                        const row = content.closest('tr');
                        const id = parseInt(row.dataset.id);
                        const item = this.data.find(item => item.id === id);
                        if (item) {
                            const isTitle = content.parentElement.cellIndex === 2;
                            const isContent = content.parentElement.cellIndex === 3;
                            if (isTitle) {
                                item.title = content.textContent;
                            } else if (isContent) {
                                if (item.maxLength && content.textContent.length > item.maxLength) {
                                    content.textContent = content.textContent.substring(0, item.maxLength);
                                }
                                item.content = content.textContent;
                                const charCount = content.nextElementSibling;
                                if (charCount && (charCount.classList.contains('char-count') || charCount.classList.contains('char-count-exceeded'))) {
                                    charCount.textContent = `${content.textContent.length}/${item.maxLength}`;
                                    if (content.textContent.length > item.maxLength) {
                                        charCount.classList.remove('char-count');
                                        charCount.classList.add('char-count-exceeded');
                                    } else {
                                        charCount.classList.remove('char-count-exceeded');
                                        charCount.classList.add('char-count');
                                    }
                                }
                            }
                        }
                        if (!row.classList.contains('edit-mode')) {
                            const charCount = row.querySelector('.char-count, .char-count-exceeded');
                            if (charCount) {
                                charCount.classList.add('hidden');
                            }
                        }
                        row.classList.remove('edit-mode');
                    });

                    content.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            content.blur();
                        }
                        const maxLength = content.getAttribute('data-max-length');
                        if (maxLength && content.textContent.length >= parseInt(maxLength) &&
                            e.key !== 'Backspace' && e.key !== 'Delete' &&
                            !e.ctrlKey && !e.metaKey) {
                            if (e.key === 'ArrowLeft' || e.key === 'ArrowRight' ||
                                e.key === 'ArrowUp' || e.key === 'ArrowDown' ||
                                e.key === 'Home' || e.key === 'End') {
                                return;
                            }
                            const selection = window.getSelection();
                            if (selection.toString().length === 0) {    
                                e.preventDefault();
                            }
                        }
                    });
                });
            }

           async handleSave() {
    let isError = false;
    let toastMessage = '';
    try {
        this.showLoading();

        const payload = {
            banner_header: this.data[0].content,
            banner_little_quote: this.data[1].content,
            banner_little_description: this.data[2].content,
            button_textcontent: this.data[4].content,
            video_trigger_button: this.data[5].content
        };

        const response = await fetch('/api/cms/landing/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (!response.ok) throw new Error('Failed to save');

        toastMessage = 'Landing Page fields updated';
        this.originalData = JSON.parse(JSON.stringify(this.data));
    } catch (error) {
        console.error(error);
        toastMessage = 'Error saving changes: ' + error.message;
        isError = true;
    } finally {
        this.hideLoading();
        this.showToast(toastMessage, isError);
    }
}

            hasUnsavedChanges() {
                return JSON.stringify(this.data) !== JSON.stringify(this.originalData);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderContent(contentData);
            window.addEventListener('beforeunload', (e) => {
                if (window.cmsEditor && window.cmsEditor.hasUnsavedChanges()) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const dropdownToggle = document.querySelector('.admin-edit-dropdown-toggle');
            const dropdownMenu = document.querySelector('.admin-edit-dropdown-menu');
            const dropdownItems = document.querySelectorAll('.admin-edit-dropdown-item');

            function extractContentData() {
                const contentRows = document.querySelectorAll('.edit-content-row');
                const contentData = [];
                contentRows.forEach(row => {
                    const name = row.querySelector('div:first-child').textContent;
                    const sections = parseInt(row.querySelector('div:nth-child(2)').textContent);
                    const tags = [];
                    row.querySelectorAll('.edit-content-tag').forEach(tag => {
                        tags.push(tag.textContent);
                    });
                    contentData.push({
                        name,
                        sections,
                        tags,
                        element: row
                    });
                });
                return contentData;
            }

            dropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            dropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const sortValue = item.getAttribute('data-value');
                    const data = extractContentData();
                    let sortedContent = [...data];
                    switch (sortValue) {
                        case 'name':
                            sortedContent.sort((a, b) => a.name.localeCompare(b.name));
                            break;
                        case 'role':
                            sortedContent.sort((a, b) => b.name.localeCompare(b.name));
                            break;
                        case 'email-new':
                            sortedContent.sort((a, b) => b.sections - a.sections);
                            break;
                        case 'email-old':
                            sortedContent.sort((a, b) => a.sections - b.sections);
                            break;
                    }
                    renderContentRows(sortedContent);
                    dropdownMenu.style.display = 'none';
                });
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.admin-edit-dropdown')) {
                    dropdownMenu.style.display = 'none';
                }
            });

            function renderContentRows(sortedData) {
                const contentContainer = document.querySelector('.edit-content-list');
                if (!contentContainer) {
                    console.error("Content container not found!");
                    return;
                }
                while (contentContainer.firstChild) {
                    contentContainer.removeChild(contentContainer.firstChild);
                }
                sortedData.forEach(item => {
                    contentContainer.appendChild(item.element);
                });
            }

            document.querySelector('.edit-content-search-input')?.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const data = extractContentData();
                const filteredContent = data.filter(item =>
                    item.name.toLowerCase().includes(searchTerm) ||
                    item.tags.some(tag => tag.toLowerCase().includes(searchTerm))
                );
                renderContentRows(filteredContent);
            });
        });
    </script>
</body>
</html>