<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>

    @extends('layouts.app')

    @php


     @endphp

<div class="edit-content-container" id="edit-content-container-id">
    <div class="admin-edit-container-sections">
        <!-- Edit Content Section -->
        <div class="edit-content-sub-container" id="edit-content-sub-container-id">
            <div class="edit-content-header">
                <h1 class="edit-content-header-title">Edit Content</h1>
                <input type="text" placeholder="Search" class="edit-content-search-input">
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
            <option value="hero">Hero Section</option>
            <option value="features">Features</option>
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
        const contentData = [
            { name: "Landing Page", sections: 4, tags: ["Text", "Img"] },
            { name: "Contact Page", sections: 2, tags: ["Text", "Img", "Video"] },
            { name: "About Us", sections: 3, tags: ["Text"] },
            { name: "Services", sections: 5, tags: ["Text", "Images","Video"] },
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
                row.querySelector('.edit-content-button').addEventListener('click', () => alert(`Editing ${item.name}`));
                contentList.appendChild(row);
            });
        }

        document.querySelector('.edit-content-search-input').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const filteredData = contentData.filter(item => item.name.toLowerCase().includes(searchTerm));
            renderContent(filteredData);
        });

        renderContent(contentData);


//cms

 class CMSEditor {
            constructor() {
                // Try to load data from localStorage first
                const savedData = localStorage.getItem('cmsEditorData');

                if (savedData) {
                    this.data = JSON.parse(savedData);
                } else {
                    // Use default data if nothing is saved
                    this.data = [
                        {
                            id: 1,
                            section: 'Landing Page',
                            title: 'Special Heading',
                            content: 'Secure Fast Simple Loans For a Brighter Future',
                            status: 'Active'
                        },
                        {
                            id: 2,
                            section: 'Landing Page',
                            title: 'By Line',
                            content: 'Fuel your Global Journey',
                            status: 'Active'
                        },
                        {
                            id: 3,
                            section: 'Landing Page',
                            title: 'Description',
                            content: 'Trusted by 15,000+ students across India, Remitout is your partner in securing the financial support you need to succeed in your studies.',
                            status: 'Active'
                        },
                        {
                            id: 4,
                            section: 'Landing Page',
                            title: 'Background: Media',
                            content: '/api/placeholder/400/320',
                            status: 'Active',
                            isMedia: true
                        },
                        {
                            id: 5,
                            section: 'Landing Page',
                            title: 'Call to Action',
                            content: 'Secure your Loan now!',
                            status: 'Active'
                        },
                        {
                            id: 6,
                            section: 'Landing Page',
                            title: 'Watch Demo',
                            content: 'Video content here',
                            status: 'Active'
                        }
                    ];
                }

                this.originalData = JSON.parse(JSON.stringify(this.data));
                this.initializeEventListeners();
                this.renderTable();
             }

            initializeEventListeners() {
                document.getElementById('searchInput').addEventListener('input', (e) => {
                    this.handleSearch(e.target.value);
                });

                document.getElementById('pageSelect').addEventListener('change', (e) => {
                    this.handlePageChange(e.target.value);
                });

                document.getElementById('sectionSelect').addEventListener('change', (e) => {
                    this.handleSectionChange(e.target.value);
                });

                document.querySelector('.edit-contents-cms-save').addEventListener('click', () => {
                     this.handleSave();
                });
            }

            showLoading() {
                document.querySelector('.loading').style.display = 'flex';
            }

            hideLoading() {
                document.querySelector('.loading').style.display = 'none';
            }

            showToast(message, isError = false) {
                const toast = document.querySelector('.toast');
                toast.textContent = message;
                toast.className = 'toast' + (isError ? ' error' : '');
                toast.style.display = 'block';

                setTimeout(() => {
                    toast.style.display = 'none';
                }, 3000);
            }

            renderTable(filteredData = null) {
                const tbody = document.getElementById('cmsTableBody');
                const dataToRender = filteredData || this.data;

                tbody.innerHTML = '';

                dataToRender.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.dataset.id = item.id;

                    if (item.isMedia) {
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${item.section}</td>
                            <td class="editable-cell">
                                <div class="editable-content" contenteditable="true">${item.title}</div>
                            </td>
                            <td>
                                <div class="media-container">
                                    <div class="media-preview">
                                        <img src="${item.content}" alt="Media preview">
                                        <span class="close-btn">×</span>
                                    </div>
                                    <div class="media-actions">
                                        <input type="file" class="file-input hidden-input" accept="image/*">
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
                                if (file.size > 5 * 1024 * 1024) { // 5MB limit
                                    this.showToast('File size should be less than 5MB', true);
                                    return;
                                }

                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    const img = row.querySelector('.media-preview img');
                                    img.src = e.target.result;
                                    item.content = e.target.result;
                                    this.showToast('Image updated successfully');
                                    // Save changes to localStorage
                                    this.saveToLocalStorage();
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        closeBtn.addEventListener('click', () => {
                            const img = row.querySelector('.media-preview img');
                            img.src = '/api/placeholder/400/320';
                            item.content = '/api/placeholder/400/320';
                            this.showToast('Image removed');
                            // Save changes to localStorage
                            this.saveToLocalStorage();
                        });
                    } else {
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${item.section}</td>
                            <td class="editable-cell">
                                <div class="editable-content" contenteditable="true">${item.title}</div>
                            </td>
                            <td class="editable-cell content-cell">
                                <div class="editable-content" contenteditable="true">${item.content}</div>
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
            }

            addEditListeners() {
                document.querySelectorAll('.edit-contents-cms-edit').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const row = e.target.closest('tr');
                        row.classList.toggle('edit-mode');

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

                            this.showToast('Content updated successfully');
                            this.saveToLocalStorage();
                            this.renderTable();
                        }
                    });
                });

                // Make content editable on double click and save changes
                document.querySelectorAll('.editable-content').forEach(content => {
                    content.addEventListener('dblclick', () => {
                        const row = content.closest('tr');
                        row.classList.add('edit-mode');
                        content.focus();
                    });

                    content.addEventListener('blur', () => {
                        const row = content.closest('tr');
                        const id = parseInt(row.dataset.id);
                        const item = this.data.find(item => item.id === id);

                        if (item) {
                            // Check which field was edited
                            const isTitle = content.parentElement.cellIndex === 2;
                            const isContent = content.parentElement.cellIndex === 3;

                            if (isTitle) {
                                item.title = content.textContent;
                            } else if (isContent) {
                                item.content = content.textContent;
                            }

                            // Save to localStorage on every edit
                            this.saveToLocalStorage();
                        }

                        row.classList.remove('edit-mode');
                    });

                    // Prevent line breaks in title fields
                    content.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            content.blur();
                        }
                    });
                });
            }

            // Save data to localStorage
            saveToLocalStorage() {
                localStorage.setItem('cmsEditorData', JSON.stringify(this.data));
            }

            handleSearch(searchTerm) {
                const filteredData = this.data.filter(item =>
                    item.section.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    item.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    (!item.isMedia && item.content.toLowerCase().includes(searchTerm.toLowerCase()))
                );
                this.renderTable(filteredData);
            }

            handlePageChange(page) {
                const filteredData = this.data.filter(item =>
                    item.section.toLowerCase().includes(page.toLowerCase())
                );
                this.renderTable(filteredData);
            }

            handleSectionChange(section) {
                // Filter by section if needed
                this.renderTable(this.data);
            }

            async handleSave() {
                try {
                    this.showLoading();
 
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 1000));

                    // Save to localStorage
                    this.saveToLocalStorage();

                    // Update originalData with current data
                    this.originalData = JSON.parse(JSON.stringify(this.data));
                    
                    this.showToast('All changes saved successfully');
                } catch (error) {
                    this.showToast('Error saving changes. Please try again.', true);
                    console.error('Save error:', error);
                } finally {
                    this.hideLoading();
                }
            }

            // Utility method to check if content has changed
            hasUnsavedChanges() {
                return JSON.stringify(this.data) !== JSON.stringify(this.originalData);
            }

            // Add method to clear saved data (useful for testing or resetting)
            clearSavedData() {
                localStorage.removeItem('cmsEditorData');
                location.reload();
            }
        }

        // Initialize the CMS editor when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            const cmsEditor = new CMSEditor();

            // Warn about unsaved changes when leaving the page
            window.addEventListener('beforeunload', (e) => {
                if (cmsEditor.hasUnsavedChanges()) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        });


        // Update the renderContent function to handle the edit button click correctly
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
        
        // Update the edit button click handler
        row.querySelector('.edit-content-button').addEventListener('click', () => {
             // Hide the content list
            contentList.style.display = 'none';
             document.querySelector('.edit-content-header').style.display = 'none';
            // Show the CMS container
            document.querySelector('.edit-contents-cms-container').style.display = 'block';
            
            // Set the page select dropdown to match the clicked item
            const pageSelect = document.getElementById('pageSelect');
            // Update options if they don't exist
            if (!Array.from(pageSelect.options).some(opt => opt.value === item.name.toLowerCase())) {
                pageSelect.innerHTML = `<option value="${item.name.toLowerCase()}">${item.name}</option>` + pageSelect.innerHTML;
            }
            pageSelect.value = item.name.toLowerCase();
            
            // Initialize CMS editor if not already initialized
            if (!window.cmsEditor) {
                window.cmsEditor = new CMSEditor();
            }
            
            // Filter content for the selected page
            window.cmsEditor.handlePageChange(item.name);
        });
        
        contentList.appendChild(row);
    });
}







    </script>

    </body>
    </html>