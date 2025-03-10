<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
     <link rel="stylesheet" href="assets/css/adminedit.css">
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
        
        // Update the edit button click handler
        row.querySelector('.edit-content-button').addEventListener('click', () => {
            // Hide the content list
            contentList.style.display = 'none';
            // Hide the search input and header
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

document.querySelector('.edit-content-search-input').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    const filteredData = contentData.filter(item => item.name.toLowerCase().includes(searchTerm));
    renderContent(filteredData);
});

class CMSEditor {
    constructor() {
        // Try to load data from localStorage first
        const savedData = localStorage.getItem('cmsEditorData');

        if (savedData) {
            this.data = JSON.parse(savedData);
            
            // Ensure maxLength properties are maintained when loading from localStorage
            this.data.forEach(item => {
                if (item.section === 'Landing Page') {
                    if (item.title === 'Special Heading' && !item.maxLength) item.maxLength = 46;
                    if (item.title === 'By Line' && !item.maxLength) item.maxLength = 30;
                    if (item.title === 'Description' && !item.maxLength) item.maxLength = 140;
                    if (item.title === 'Call to Action' && !item.maxLength) item.maxLength = 22;
                    if (item.title === 'Watch Demo' && !item.maxLength) item.maxLength = 10;
                    
                    if (item.title === 'Background: Media' && !item.mediaConstraints) {
                        item.mediaConstraints = {
                            formats: ['png', 'jpg', 'jpeg']
                        };
                    }
                }
            });
        } else {
            // Use default data if nothing is saved
            this.data = [
                {
                    id: 1,
                    section: 'Landing Page',
                    title: 'Special Heading',
                    content: 'Secure Fast Simple Loans For a Brighter Future',
                    status: 'Active',
                    maxLength: 46
                },
                {
                    id: 2,
                    section: 'Landing Page',
                    title: 'By Line',
                    content: 'Fuel your Global Journey',
                    status: 'Active',
                    maxLength: 30
                },
                {
                    id: 3,
                    section: 'Landing Page',
                    title: 'Description',
                    content: 'Trusted by 15,000+ students across India, Remitout is your partner in securing the financial support you need to succeed in your studies.',
                    status: 'Active',
                    maxLength: 140
                },
                {
                    id: 4,
                    section: 'Landing Page',
                    title: 'Background: Media',
                    content: '/api/placeholder/400/320',
                    status: 'Active',
                    isMedia: true,
                    mediaConstraints: {
                        formats: ['png', 'jpg', 'jpeg']
                    }
                },
                {
                    id: 5,
                    section: 'Landing Page',
                    title: 'Call to Action',
                    content: 'Secure your Loan now!',
                    status: 'Active',
                    maxLength: 22
                },
                {
                    id: 6,
                    section: 'Landing Page',
                    title: 'Video content',
                    content: 'Watch Demo',
                    status: 'Active',
                    maxLength: 10
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

    // Helper method to place caret at the end of contentEditable
    placeCaretAtEnd(element) {
        const range = document.createRange();
        const selection = window.getSelection();
        range.selectNodeContents(element);
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);
        element.focus();
    }

    // Save to localStorage method with error handling
    saveToLocalStorage() {
        try {
            localStorage.setItem('cmsEditorData', JSON.stringify(this.data));
            return true;
        } catch (error) {
            console.error('Error saving to localStorage:', error);
            this.showToast('Failed to save changes: ' + error.message, true);
            return false;
        }
    }

    // Helper method to resize images
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

    // Search functionality
    handleSearch(searchTerm) {
        searchTerm = searchTerm.toLowerCase();
        if (!searchTerm) {
            this.renderTable();
            return;
        }

        const filteredData = this.data.filter(item => 
            item.section.toLowerCase().includes(searchTerm) ||
            item.title.toLowerCase().includes(searchTerm) ||
            item.content.toString().toLowerCase().includes(searchTerm)
        );

        this.renderTable(filteredData);
    }

    // Page filter functionality
    handlePageChange(pageName) {
        if (!pageName || pageName === 'all') {
            this.renderTable();
            return;
        }

        // Convert to proper case if it's a string value
        if (typeof pageName === 'string' && pageName !== pageName.toLowerCase()) {
            pageName = pageName;
        } else if (typeof pageName === 'string') {
            pageName = pageName.charAt(0).toUpperCase() + pageName.slice(1);
        }

        const filteredData = this.data.filter(item => 
            item.section.toLowerCase() === pageName.toLowerCase()
        );

        this.renderTable(filteredData);
    }

    // Section filter functionality
    handleSectionChange(section) {
        if (!section || section === 'all') {
            this.renderTable();
            return;
        }

        const filteredData = this.data.filter(item => {
            const itemSection = item.title.toLowerCase();
            const selectedSection = section.toLowerCase();
            
            if (selectedSection === 'hero' && (itemSection.includes('heading') || itemSection.includes('by line'))) {
                return true;
            } else if (selectedSection === 'features' && (itemSection.includes('feature') || itemSection.includes('benefit'))) {
                return true;
            } else if (selectedSection === 'footer' && (itemSection.includes('footer') || itemSection.includes('contact'))) {
                return true;
            }
            
            return false;
        });

        this.renderTable(filteredData);
    }

    // Render table method
    renderTable(filteredData = null) {
        const tbody = document.getElementById('cmsTableBody');
        const dataToRender = filteredData || this.data;

        tbody.innerHTML = '';

        dataToRender.forEach((item, index) => {
            const row = document.createElement('tr');
            row.dataset.id = item.id;

            if (item.isMedia) {
                // Media item rendering
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

                // Media event listeners
                const fileInput = row.querySelector('.file-input');
                const uploadTrigger = row.querySelector('.upload-trigger');
                const closeBtn = row.querySelector('.close-btn');

                uploadTrigger.addEventListener('click', () => {
                    fileInput.click();
                });

                fileInput.addEventListener('change', (e) => {
                    // File handling code
                    const file = e.target.files[0];
                    if (file) {
                        if (file.size > 5 * 1024 * 1024) { // 5MB limit
                            this.showToast('File size should be less than 5MB', true);
                            return;
                        }

                        // Check file extension if constraints exist
                        if (item.mediaConstraints && item.mediaConstraints.formats) {
                            const fileExt = file.name.split('.').pop().toLowerCase();
                            if (!item.mediaConstraints.formats.includes(fileExt)) {
                                this.showToast(`Only ${item.mediaConstraints.formats.join(', ')} files are allowed`, true);
                                return;
                            }
                        }

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = row.querySelector('.media-preview img');
                            img.src = e.target.result;
                            
                            // Check image dimensions if constraints exist
                            if (item.mediaConstraints && item.mediaConstraints.width && item.mediaConstraints.height) {
                                const tempImg = new Image();
                                tempImg.onload = () => {
                                    if (tempImg.width !== item.mediaConstraints.width || tempImg.height !== item.mediaConstraints.height) {
                                        this.showToast(`Image must be ${item.mediaConstraints.width}×${item.mediaConstraints.height}px. Your image is ${tempImg.width}×${tempImg.height}px.`, true);
                                        // Automatically resize the image to required dimensions
                                        this.resizeImage(e.target.result, item.mediaConstraints.width, item.mediaConstraints.height, (resizedImg) => {
                                            img.src = resizedImg;
                                            item.content = resizedImg;
                                            this.showToast('Image resized to required dimensions');
                                            this.saveToLocalStorage();
                                        });
                                    } else {
                                        item.content = e.target.result;
                                        this.showToast('Image updated successfully');
                                        this.saveToLocalStorage();
                                    }
                                };
                                tempImg.src = e.target.result;
                            } else {
                                item.content = e.target.result;
                                this.showToast('Image updated successfully');
                                this.saveToLocalStorage();
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });

                closeBtn.addEventListener('click', () => {
                    const img = row.querySelector('.media-preview img');
                    img.src = '/api/placeholder/400/320';
                    item.content = '/api/placeholder/400/320';
                    this.showToast('Image removed');
                    this.saveToLocalStorage();
                });
            } else {
                // For text content, create the character count indicator but initially hide it
                let maxLengthIndicator = '';
                if (item.maxLength) {
                    const currentLength = item.content.length;
                    const remainingChars = item.maxLength - currentLength;
                    const charCountClass = remainingChars < 0 ? 'char-count-exceeded' : 'char-count';
                    // Add a "hidden" class to initially hide the counter
                    maxLengthIndicator = `<div class="${charCountClass} hidden" data-max="${item.maxLength}">${currentLength}/${item.maxLength}</div>`;
                }

                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.section}</td>
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
    }

    // Add edit event listeners
    addEditListeners() {
        // Edit button event listeners
        document.querySelectorAll('.edit-contents-cms-edit').forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                row.classList.toggle('edit-mode');
                
                // Show character count when entering edit mode
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

                    // Hide character count when exiting edit mode
                    const charCount = row.querySelector('.char-count, .char-count-exceeded');
                    if (charCount) {
                        charCount.classList.add('hidden');
                    }

                    this.showToast('Content updated successfully');
                    this.saveToLocalStorage();
                    this.renderTable();
                }
            });
        });

        // Character limit functionality
        document.querySelectorAll('.editable-content[data-max-length]').forEach(content => {
            const maxLength = parseInt(content.getAttribute('data-max-length'));
            const charCount = content.nextElementSibling;
            
            content.addEventListener('input', () => {
                const currentLength = content.textContent.length;
                
                charCount.textContent = `${currentLength}/${maxLength}`;
                
                if (currentLength > maxLength) {
                    charCount.classList.remove('char-count');
                    charCount.classList.add('char-count-exceeded');
                    
                    // Truncate the text if it exceeds the max length
                    content.textContent = content.textContent.substring(0, maxLength);
                    // Update the character count
                    charCount.textContent = `${maxLength}/${maxLength}`;
                    // Place cursor at the end
                    this.placeCaretAtEnd(content);
                } else {
                    charCount.classList.remove('char-count-exceeded');
                    charCount.classList.add('char-count');
                }
            });
        });

        // Make content editable on double click and save changes
        document.querySelectorAll('.editable-content').forEach(content => {
            content.addEventListener('dblclick', () => {
                const row = content.closest('tr');
                row.classList.add('edit-mode');
                
                // Show character count when entering edit mode
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
                    // Check which field was edited
                    const isTitle = content.parentElement.cellIndex === 2;
                    const isContent = content.parentElement.cellIndex === 3;

                    if (isTitle) {
                        item.title = content.textContent;
                    } else if (isContent) {
                        // Check if the content exceeds max length before saving
                        if (item.maxLength && content.textContent.length > item.maxLength) {
                            content.textContent = content.textContent.substring(0, item.maxLength);
                        }
                        item.content = content.textContent;
                        
                        // Update character count if it exists
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

                    // Save to localStorage on every edit
                    this.saveToLocalStorage();
                }

                // Only hide character count if not in edit mode anymore
                if (!row.classList.contains('edit-mode')) {
                    const charCount = row.querySelector('.char-count, .char-count-exceeded');
                    if (charCount) {
                        charCount.classList.add('hidden');
                    }
                }
                
                row.classList.remove('edit-mode');
            });

            // Prevent line breaks in title fields
            content.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    content.blur();
                }
                
                // Check if this is a content field with max length
                const maxLength = content.getAttribute('data-max-length');
                if (maxLength && content.textContent.length >= parseInt(maxLength) && 
                    e.key !== 'Backspace' && e.key !== 'Delete' && 
                    !e.ctrlKey && !e.metaKey) {
                    
                    // Allow selection keys
                    if (e.key === 'ArrowLeft' || e.key === 'ArrowRight' || 
                        e.key === 'ArrowUp' || e.key === 'ArrowDown' || 
                        e.key === 'Home' || e.key === 'End') {
                        return;
                    }
                    
                    // If text is selected, allow typing (it will replace the selection)
                    const selection = window.getSelection();
                    if (selection.toString().length === 0) {
                        e.preventDefault();
                    }
                }
            });
        });
    }

    // Fixed handle save method
    async handleSave() {
        try {
            this.showLoading();

            // Validate all fields before saving
            let hasErrors = false;
            
            // Check character limits
            this.data.forEach(item => {
                if (item.maxLength && item.content.length > item.maxLength) {
                    console.log(`Validation error: "${item.title}" content length ${item.content.length}, max ${item.maxLength}`);
                    this.showToast(`"${item.title}" exceeds maximum length of ${item.maxLength} characters`, true);
                    hasErrors = true;
                }
            });
            
            if (hasErrors) {
                this.hideLoading();
                return;
            }

            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 1000));

            // Save to localStorage
            const saveResult = this.saveToLocalStorage();
            
            if (!saveResult) {
                throw new Error('Failed to save to localStorage');
            }

            // Update originalData with current data
            this.originalData = JSON.parse(JSON.stringify(this.data));

            // Hide all character counters after saving
            document.querySelectorAll('.char-count, .char-count-exceeded').forEach(counter => {
                counter.classList.add('hidden');
            });

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

// Add a CSS class for hidden elements
const style = document.createElement('style');
style.textContent = `
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
`;
document.head.appendChild(style);

// Initialize the CMS editor when the page loads
document.addEventListener('DOMContentLoaded', () => {
    renderContent(contentData);
    
    // Warn about unsaved changes when leaving the page
    window.addEventListener('beforeunload', (e) => {
        if (window.cmsEditor && window.cmsEditor.hasUnsavedChanges()) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
});



    </script>

    </body>
    </html>