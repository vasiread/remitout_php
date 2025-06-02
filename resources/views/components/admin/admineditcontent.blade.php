<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/adminedit.css">
    <style>
        .hidden {
            display: none !important;
        }
        .char-count {
            color: #666;
            font-size: 12px;
            margin-top: 4px;
        }
        .char-count-exceeded {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #ff6b2b;
            color: #fff;
            border-radius: 5px;
            z-index: 1000;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            role: alert;
        }
        .toast.error {
            background-color: #d32f2f;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .pagination button {
            margin: 0 5px;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
            border-radius: 4px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pagination button:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
        .pagination .page-number {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        .pagination .page-number.active {
            background-color: #ff6b2b;
            color: #fff;
            border-color: #ff6b2b;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @php
    @endphp

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
                            <option value="loan-transfer">Loan Transfer</option>
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
            { name: "Landing Page", sections: 7, tags: ["Text", "Img", "Video"] },
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
                        maxLength: 22,
                    },
                    {
                        id: 6,
                        page: 'Landing Page',
                        sectionType: 'hero',
                        title: 'Button',
                        content: 'Watch Demo',
                        status: 'Active',
                        maxLength: 10,
                        isMedia: true,
                        mediaConstraints: {
                            formats: ['mp4', 'webm', 'png', 'jpg', 'jpeg']
                        }
                    },
                    // Testimonial Section
                    {
                        id: 7,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial 1',
                        content: 'Remitout helped me secure my study loan quickly!',
                        status: 'Active',
                        maxLength: 100
                    },
                    {
                        id: 8,
                        page: 'Landing Page',
                        sectionType: 'testimonial',
                        title: 'Testimonial 2',
                        content: 'Amazing service and support for students.',
                        status: 'Active',
                        maxLength: 100
                    },
                    // Logo Section
                    {
                        id: 9,
                        page: 'Landing Page',
                        sectionType: 'logo',
                        title: 'Partner Logo',
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
                        id: 10,
                        page: 'Landing Page',
                        sectionType: 'study-loan',
                        title: 'Graph Title',
                        content: 'Study Loan Growth Statistics',
                        status: 'Active',
                        maxLength: 50
                    },
                    // Secure Loan Section
                    {
                        id: 11,
                        page: 'Landing Page',
                        sectionType: 'secure-loan',
                        title: 'Secure Loan Heading',
                        content: 'Get your loan securely with Remitout',
                        status: 'Active',
                        maxLength: 50
                    },
                    // Loan Transfer Section
                    {
                        id: 12,
                        page: 'Landing Page',
                        sectionType: 'loan-transfer',
                        title: 'Loan Transfer Info',
                        content: 'Transfer your loan easily with our services',
                        status: 'Active',
                        maxLength: 50
                    },
                    // Footer Section
                    {
                        id: 13,
                        page: 'Landing Page',
                        sectionType: 'footer',
                        title: 'Footer Text',
                        content: 'Contact us at support@remitout.com',
                        status: 'Active',
                        maxLength: 50
                    },
                    // Other Pages (e.g., About Us, Services)
                    {
                        id: 14,
                        page: 'About Us',
                        sectionType: 'hero',
                        title: 'About Us Heading',
                        content: 'Learn about our mission and values',
                        status: 'Active',
                        maxLength: 50
                    },
                    {
                        id: 15,
                        page: 'Services',
                        sectionType: 'hero',
                        title: 'Services Heading',
                        content: 'Explore our wide range of services',
                        status: 'Active',
                        maxLength: 50
                    }
                ];
                this.originalData = JSON.parse(JSON.stringify(this.data));
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
                    this.currentPage = 1; // Reset to first page on page change
                    this.handlePageChange(e.target.value);
                });
                document.getElementById('sectionSelect').addEventListener('change', (e) => {
                    this.currentPage = 1; // Reset to first page on section change
                    this.handleSectionChange(e.target.value);
                });
                document.getElementById('entriesSelect').addEventListener('change', (e) => {
                    this.rowsPerPage = parseInt(e.target.value);
                    this.currentPage = 1; // Reset to first page on rows per page change
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
                if (this.isToastActive || this.toastQueue.length === 0) return;

                this.isToastActive = true;
                const { message, isError } = this.toastQueue.shift();
                const toast = document.querySelector('.toast');
                toast.textContent = message;
                toast.className = 'toast' + (isError ? ' error' : '');
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.opacity = '1';
                }, 10);
                console.log('Showing toast:', message);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.style.display = 'none';
                        this.isToastActive = false;
                        this.processToastQueue();
                    }, 300);
                    console.log('Hiding toast:', message);
                }, 5000);
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
                    callback(canvas.toDataURL('image/jpeg', 0.85));
                };
                img.src = dataUrl;
            }

            handleSearch(searchTerm) {
                searchTerm = searchTerm.toLowerCase();
                if (!searchTerm) {
                    this.currentPage = 1;
                    this.renderTable();
                    return;
                }
                const filteredData = this.data.filter(item =>
                    item.page.toLowerCase().includes(searchTerm) ||
                    item.title.toLowerCase().includes(searchTerm) ||
                    item.content.toString().toLowerCase().includes(searchTerm)
                );
                this.currentPage = 1;
                this.renderTable(filteredData);
            }

            handlePageChange(pageName) {
                if (!pageName || pageName === 'all') {
                    this.renderTable();
                    return;
                }
                if (typeof pageName === 'string' && pageName !== pageName.toLowerCase()) {
                    pageName = pageName;
                } else if (typeof pageName === 'string') {
                    pageName = pageName.charAt(0).toUpperCase() + pageName.slice(1);
                }
                const filteredData = this.data.filter(item =>
                    item.page.toLowerCase() === pageName.toLowerCase()
                );
                // Update section dropdown based on selected page
                const sectionSelect = document.getElementById('sectionSelect');
                if (pageName.toLowerCase() === 'landing page') {
                    sectionSelect.innerHTML = `
                        <option value="all">All Sections</option>
                        <option value="hero">Hero Section</option>
                        <option value="testimonial">Testimonial</option>
                        <option value="logo">Logo Section</option>
                        <option value="study-loan">Study Loan Graph</option>
                        <option value="secure-loan">Secure Loan</option>
                        <option value="loan-transfer">Loan Transfer</option>
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
                this.renderTable(filteredData);
            }

            handleSectionChange(section) {
                if (!section || section === 'all') {
                    const pageSelect = document.getElementById('pageSelect');
                    this.handlePageChange(pageSelect.value);
                    return;
                }
                const pageSelect = document.getElementById('pageSelect');
                const pageName = pageSelect.value.charAt(0).toUpperCase() + pageSelect.value.slice(1);
                const filteredData = this.data.filter(item =>
                    item.page.toLowerCase() === pageName.toLowerCase() &&
                    item.sectionType.toLowerCase() === section.toLowerCase()
                );
                this.renderTable(filteredData);
            }

            renderTable(filteredData = null) {
                const tbody = document.getElementById('cmsTableBody');
                const dataToRender = filteredData || this.data;
                tbody.innerHTML = '';

                // Pagination logic
                const startIndex = (this.currentPage - 1) * this.rowsPerPage;
                const endIndex = startIndex + this.rowsPerPage;
                const paginatedData = dataToRender.slice(startIndex, endIndex);

                paginatedData.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.dataset.id = item.id;

                    // Check if the row has both text and media (like the 5th and 6th rows)
                    const hasTextAndMedia = item.maxLength && item.isMedia;

                    if (hasTextAndMedia) {
                        // Render both text and media fields
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
                                <button class="edit-contents-cms-edit">✏️</button>
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
                    } else if (item.isMedia) {
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
                this.renderPagination(dataToRender.length);
            }

            renderPagination(totalItems) {
                const totalPages = Math.ceil(totalItems / this.rowsPerPage);
                const paginationControls = document.getElementById('paginationControls');
                paginationControls.innerHTML = '';

                // Previous Button with Icon
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
                paginationControls.appendChild(prevButton);

                // Page Numbers
                const maxVisiblePages = 5; // Maximum number of page buttons to show at once
                let startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                // Adjust startPage if endPage is at the maximum
                if (endPage === totalPages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.classList.add('page-number');
                    pageButton.textContent = i;
                    if (i === this.currentPage) {
                        pageButton.classList.add('active');
                    }
                    pageButton.addEventListener('click', () => {
                        this.currentPage = i;
                        this.renderTable();
                    });
                    paginationControls.appendChild(pageButton);
                }

                // Next Button with Icon
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
                paginationControls.appendChild(nextButton);
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
                            const charCount = row.querySelector('.char-count, .char-count-exceeded');
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
                let toastMessage = '';
                let isError = false;
                try {
                    this.showLoading();
                    const updatedValues = this.data
                        .filter(item => {
                            const originalItem = this.originalData.find(orig => orig.id === item.id);
                            return originalItem && (item.content !== originalItem.content || item.title !== originalItem.title);
                        })
                        .map(item => ({
                            title: item.title,
                            content: item.content
                        }));
                    if (updatedValues.length > 0) {
                        console.log('Updated Content Values:', updatedValues);
                        const alertMessage = 'CMS Content updated successfully:\n' +
                            updatedValues.map(item => `${item.title}: ${item.content}`).join('\n');
                        alert(alertMessage);
                        toastMessage = 'All changes saved successfully';
                    } else {
                        console.log('No content changes detected.');
                        alert('CMS Content: No changes detected.');
                        toastMessage = 'No changes to save';
                    }
                    this.originalData = JSON.parse(JSON.stringify(this.data));
                } catch (error) {
                    toastMessage = 'Error saving changes: ' + error.message;
                    isError = true;
                    console.error('Save error:', error);
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