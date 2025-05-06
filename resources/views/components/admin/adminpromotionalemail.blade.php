<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Composer</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminpromotional.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .loading-indicator {
            text-align: center;
            padding: 10px;
            color: #555;
        }
        .error-message {
            text-align: center;
            padding: 10px;
            color: #d32f2f;
            background-color: #ffebee;
            border-radius: 4px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    @extends('layouts.app')
    <div class="promotional-email-composer" id="promotional-composer-main-section-id">
        <div class="promotional-composer-main-section">
            <div class="composer-email-container">
                <div class="promotional-header">
                    <h2>Compose Email</h2>
                </div>
                <div class="promotional-header-buttons">
                    <button class="btn-promo btn-draft">Save Draft</button>
                    <button class="btn-promo btn-send" id="send-promotional_email">Send Email</button>
                </div>
            </div>
            <div class="promotional-composer-container">
                <div class="promotional-toolbar">
                    <div class="promotional-toolbar-row">
                        <div class="promotional-toolbar-dropdown">
                            <select id="styles">
                                <option>Styles</option>
                                <option>Normal</option>
                                <option>Heading 1</option>
                                <option>Heading 2</option>
                                <option>Heading 3</option>
                                <option>Heading 4</option>
                                <option>Heading 5</option>
                                <option>Heading 6</option>
                            </select>
                        </div>
                        <div class="promotional-toolbar-dropdown">
                            <select id="format">
                                <option>Format</option>
                                <option>Paragraph</option>
                                <option>Blockquote</option>
                                <option>Pre</option>
                            </select>
                        </div>
                        <div class="promotional-toolbar-dropdown">
                            <select id="font">
                                <option>Font</option>
                                <option>Arial</option>
                                <option>Times New Roman</option>
                                <option>Poppins</option>
                                <option>Helvetica</option>
                                <option>Verdana</option>
                                <option>Georgia</option>
                                <option>Courier New</option>
                                <option>Tahoma</option>
                                <option>Trebuchet MS</option>
                                <option>Garamond</option>
                                <option>Calibri</option>
                                <option>Roboto</option>
                                <option>Open Sans</option>
                                <option>Lato</option>
                                <option>Montserrat</option>
                                <option>Ubuntu</option>
                                <option>Merriweather</option>
                                <option>Noto Sans</option>
                                <option>Playfair Display</option>
                            </select>
                        </div>
                        <div class="promotional-toolbar-dropdown">
                            <select id="size">
                                <option>Size</option>
                                <option>12px</option>
                                <option>14px</option>
                                <option>16px</option>
                                <option>18px</option>
                                <option>20px</option>
                                <option>22px</option>
                                <option>24px</option>
                            </select>
                        </div>
                        <button class="promotional-toolbar-button" title="Bold"><i class="fas fa-bold"></i></button>
                        <button class="promotional-toolbar-button" title="Italic"><i class="fas fa-italic"></i></button>
                        <button class="promotional-toolbar-button" title="Underline"><i class="fas fa-underline"></i></button>
                        <button class="promotional-toolbar-button" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                        <button class="promotional-toolbar-button" title="Superscript"><i class="fas fa-superscript"></i></button>
                        <button class="promotional-toolbar-button" title="Subscript"><i class="fas fa-subscript"></i></button>
                        <button class="promotional-toolbar-button" title="Align Left"><i class="fas fa-align-left"></i></button>
                        <button class="promotional-toolbar-button" title="Align Center"><i class="fas fa-align-center"></i></button>
                        <button class="promotional-toolbar-button" title="Align Right"><i class="fas fa-align-right"></i></button>
                        <button class="promotional-toolbar-button" title="Justify"><i class="fas fa-align-justify"></i></button>
                        <button class="promotional-toolbar-button" title="Decrease Indent"><i class="fas fa-outdent"></i></button>
                        <button class="promotional-toolbar-button" title="Increase Indent"><i class="fas fa-indent"></i></button>
                        <button class="promotional-toolbar-button" title="Bulleted List"><i class="fas fa-list-ul"></i></button>
                        <button class="promotional-toolbar-button" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                        <button class="promotional-toolbar-button" title="Undo"><i class="fas fa-undo"></i></button>
                        <button class="promotional-toolbar-button" title="Redo"><i class="fas fa-redo"></i></button>
                    </div>
                    <div class="promotional-toolbar-row">
                        <button class="promotional-toolbar-button" title="Cut"><i class="fas fa-cut"></i></button>
                        <button class="promotional-toolbar-button" title="Copy"><i class="fas fa-copy"></i></button>
                        <button class="promotional-toolbar-button" title="Paste"><i class="fas fa-paste"></i></button>
                        <button class="promotional-toolbar-button" title="Select All"><i class="fas fa-check-double"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Image"><i class="fas fa-image"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Link"><i class="fas fa-link"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Table"><i class="fas fa-table"></i></button>
                        <button class="promotional-toolbar-button" title="Text Color"><i class="fas fa-palette"></i></button>
                        <button class="promotional-toolbar-button" title="Background Color"><i class="fas fa-fill-drip"></i></button>
                        <button class="promotional-toolbar-button" title="Special Characters"><i class="fas fa-omega"></i></button>
                        <button class="promotional-toolbar-button" title="Horizontal Rule"><i class="fas fa-minus"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Formula"><i class="fas fa-square-root-alt"></i></button>
                        <button class="promotional-toolbar-button" title="Code Block"><i class="fas fa-code"></i></button>
                        <button class="promotional-toolbar-button" title="Full Screen"><i class="fas fa-expand"></i></button>
                        <button class="promotional-toolbar-button" title="Print"><i class="fas fa-print"></i></button>
                        <button class="promotional-toolbar-button" title="View HTML"><i class="fas fa-file-code"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Header"><i class="fas fa-heading"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Footer"><i class="fas fa-shoe-prints"></i></button>
                        <button class="promotional-toolbar-button" title="Page Break"><i class="fas fa-page-break"></i></button>
                    </div>
                </div>
                <div class="promotional-content-area" contenteditable="true">
                    <div class="image-container">
                        <img src="/api/placeholder/800/400" alt="Modern Office Space">
                    </div>
                    <h1 class="promotional-heading">Header 01</h1>
                    <p class="promotional-sub">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p class="know-more">Click here to know more!</p>
                    <div class="promotional-link-container" style="display: none;">
                        <span>Link:</span>
                        <input type="text" class="promotional-link-input" value="">
                        <div class="promotional-link-actions">
                            <button class="promotional-link-button">Change</button>
                            <span>|</span>
                            <button class="promotional-link-button">×</button>
                        </div>
                    </div>
                </div>
                <div class="promotional-footer">
                    <div>
                        Visit us: <a href="#" style="color: #f86d21; text-decoration: none;">Remitout.com</a>
                        <span style="margin-left: 20px;">Follow us:
                            <a href="#" style="color: #333; margin-left: 5px;"><i class="fab fa-twitter"></i></a>
                            <a href="#" style="color: #333; margin-left: 5px;"><i class="fab fa-facebook"></i></a>
                        </span>
                    </div>
                    <div>©frontend 2023. All rights reserved</div>
                </div>
                <div class="promotional-word-count">No. of words: <span id="wordCount">0</span></div>
                <div class="promotional-attachment-section" id="attachmentSection">
                    <div class="attachment-buttons-promotional">
                        <button class="btn-promo btn-draft"><i class="fas fa-paperclip"></i> Attach files</button>
                        <button class="btn-promo btn-insert" id="insertLinkBtn"><i class="fas fa-link"></i> Insert Link</button>
                    </div>
                    <div class="attachment-file-promotional" id="linkContainer" style="display: none;">
                        <i class="fas fa-link file-icon"></i>
                        <a id="insertedLink" href="#" target="_blank">Inserted Link</a>
                        <i class="fas fa-times remove-file" id="removeLink"></i>
                    </div>
                </div>
                <div class="promotional-recipients-section">
                    <div class="promotional-recipients-header">
                        <div class="promotional_email_composer-icon">
                            <h3 class="promotional-recipients-title">Add recipients</h3>
                            <button id="addRecipientBtn" style="margin-left: 10px; background: none; border: none; cursor: pointer;" title="Add New Recipient">
                                <i class="fas fa-plus" style="font-size: 18px; color: #f86d21;"></i>
                            </button>
                        </div>
                        <div class="promotional-recipients-filters">
                            <select id="entriesPerPage">
                                <option value="10">10 entries</option>
                                <option value="25">25 entries</option>
                                <option value="50">50 entries</option>
                            </select>
                            <select id="stateFilter">
                                <option value="">State</option>
                                <option>Tamil Nadu</option>
                                <option>Kerala</option>
                                <option>Karnataka</option>
                            </select>
                            <select id="cityFilter">
                                <option value="">City</option>
                                <option>Chennai</option>
                                <option>Bangalore</option>
                                <option>Mumbai</option>
                            </select>
                            <div style="position: relative;">
                                <input type="text" placeholder="Search" id="promotional-search-input">
                            </div>
                        </div>
                    </div>
                    <div id="recipientTableStatus"></div>
                    <table class="promotional-recipients-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;"><input type="checkbox" id="selectAll"></th>
                                <th>User Name</th>
                                <th>Unique ID</th>
                                <th>User Email</th>
                                <th>Mobile No.</th>
                            </tr>
                        </thead>
                        <tbody id="recipientTableBody"></tbody>
                    </table>
                    <div class="promotional-pagination">
                        <button id="prevPage">←</button>
                        <span id="paginationInfo">1-10 / 0</span>
                        <button id="nextPage">→</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contentArea = document.querySelector('.promotional-content-area');
            const wordCountElement = document.getElementById('wordCount');
            const saveButton = document.querySelector('.btn-draft');
            const sendButton = document.querySelector('.btn-send');
            const attachButton = document.querySelector('.promotional-attachment-section .btn-draft');
            const recipientTableBody = document.getElementById('recipientTableBody');
            const recipientTableStatus = document.getElementById('recipientTableStatus');
            const entriesPerPageSelect = document.getElementById('entriesPerPage');
            const prevPageButton = document.getElementById('prevPage');
            const nextPageButton = document.getElementById('nextPage');
            const paginationInfo = document.getElementById('paginationInfo');
            const searchInput = document.getElementById('promotional-search-input');
            const selectAllCheckbox = document.getElementById('selectAll');
            const addRecipientBtn = document.getElementById('addRecipientBtn');
            const stateFilter = document.getElementById('stateFilter');
            const cityFilter = document.getElementById('cityFilter');
            let recipients = [];
            let filteredRecipients = [];
            let currentPage = 1;
            let entriesPerPage = parseInt(entriesPerPageSelect.value);
            let uploadedImageUrl = null;
            let attachedFiles = [];
            const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            initializeEditor();
            updateWordCount();
            initializeRecipientTable();
            initializePagination();
            loadSavedDraft();
            renderRecipients();
            setUpEmailFunctionality();
            function renderRecipients() {
                if (!recipientTableBody || !recipientTableStatus) {
                    console.error('Table body or status element not found');
                    return;
                }
                recipientTableStatus.innerHTML = '<div class="loading-indicator">Loading recipients...</div>';
                const dummyData = [
                    {
                        id: 1,
                        unique_id: 'USR001',
                        personal_info: {
                            full_name: 'Vasi Raja',
                            email: 'vasiraja950@gmail.com',
                            phone: '1234567890'
                        }
                    },
                    {
                        id: 2,
                        unique_id: 'USR002',
                        personal_info: {
                            full_name: 'John Doe',
                            email: 'john.doe@example.com',
                            phone: '9876543210'
                        }
                    }
                ];
                fetch('/getrecipients', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    }
                })
                    .then(async response => {
                        if (!response.ok) {
                            const text = await response.text();
                            throw new Error(`HTTP error! Status: ${response.status}, Response: ${text}`);
                        }
                        return response.json();
                    })
                    .then(result => {
                        console.log('API Response:', result);
                        let data = [];
                        if (Array.isArray(result)) {
                            data = result;
                        } else if (result.data && Array.isArray(result.data)) {
                            data = result.data;
                        } else if (result.recipients && Array.isArray(result.recipients)) {
                            data = result.recipients;
                        } else {
                            console.warn('Unexpected API response structure, using dummy data');
                            data = dummyData;
                        }
                        if (data.length === 0) {
                            recipientTableStatus.innerHTML = '<div class="error-message">No recipients available</div>';
                            recipientTableBody.innerHTML = '<tr><td colspan="5">No recipients found</td></tr>';
                            return;
                        }
                        recipients = data.map(recipient => ({
                            name: recipient.personal_info?.full_name || recipient.name || recipient.full_name || 'Unknown',
                            unique_id: recipient.unique_id || recipient.id || '',
                            email: recipient.personal_info?.email || recipient.email || '',
                            phone: recipient.personal_info?.phone || recipient.phone || 'N/A'
                        }));
                        filteredRecipients = [...recipients];
                        recipientTableStatus.innerHTML = '';
                        renderRecipientTable();
                        updatePagination();
                    })
                    .catch(error => {
                        console.error('Error fetching recipients:', error);
                        recipientTableStatus.innerHTML = `<div class="error-message">Failed to load recipients: ${error.message}</div>`;
                        recipientTableBody.innerHTML = '<tr><td colspan="5">Error loading recipients</td></tr>';
                        recipients = dummyData.map(recipient => ({
                            name: recipient.personal_info?.full_name || 'Unknown',
                            unique_id: recipient.unique_id || '',
                            email: recipient.personal_info?.email || '',
                            phone: recipient.personal_info?.phone || 'N/A'
                        }));
                        filteredRecipients = [...recipients];
                        renderRecipientTable();
                        updatePagination();
                    });
            }
            function renderRecipientTable() {
                if (!recipientTableBody) return;
                recipientTableBody.innerHTML = '';
                const start = (currentPage - 1) * entriesPerPage;
                const end = start + entriesPerPage;
                const paginatedRecipients = filteredRecipients.slice(start, end);
                if (paginatedRecipients.length === 0) {
                    recipientTableBody.innerHTML = '<tr><td colspan="5">No recipients found</td></tr>';
                    return;
                }
                paginatedRecipients.forEach(recipient => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><input type="checkbox" class="rowCheckbox"></td>
                        <td>${recipient.name || 'N/A'}</td>
                        <td>${recipient.unique_id || 'N/A'}</td>
                        <td>${recipient.email || 'N/A'}</td>
                        <td>${recipient.phone || 'N/A'}</td>
                    `;
                    recipientTableBody.appendChild(row);
                });
                updateSelectAllCheckbox();
            }
            function handleSearchAndFilter() {
                const searchText = searchInput.value.toLowerCase();
                const state = stateFilter.value.toLowerCase();
                const city = cityFilter.value.toLowerCase();
                filteredRecipients = recipients.filter(recipient => {
                    const matchesSearch =
                        (recipient.name?.toLowerCase().includes(searchText) || '') ||
                        (recipient.unique_id?.toLowerCase().includes(searchText) || '') ||
                        (recipient.email?.toLowerCase().includes(searchText) || '') ||
                        (recipient.phone?.toLowerCase().includes(searchText) || '');
                    const matchesState = !state || (recipient.state?.toLowerCase() === state);
                    const matchesCity = !city || (recipient.city?.toLowerCase() === city);
                    return matchesSearch && matchesState && matchesCity;
                });
                currentPage = 1;
                renderRecipientTable();
                updatePagination();
            }
            function initializeRecipientTable() {
                if (!recipientTableBody || !selectAllCheckbox) return;
                selectAllCheckbox.addEventListener('change', function () {
                    const rowCheckboxes = recipientTableBody.querySelectorAll('.rowCheckbox');
                    rowCheckboxes.forEach(checkbox => (checkbox.checked = this.checked));
                    selectAllCheckbox.indeterminate = false;
                });
                recipientTableBody.addEventListener('change', function (e) {
                    if (e.target.classList.contains('rowCheckbox')) {
                        updateSelectAllCheckbox();
                    }
                });
                if (addRecipientBtn) {
                    addRecipientBtn.addEventListener('click', function () {
                        alert('Add new recipient functionality to be implemented');
                    });
                }
                if (searchInput) {
                    searchInput.addEventListener('input', handleSearchAndFilter);
                }
                if (stateFilter) {
                    stateFilter.addEventListener('change', handleSearchAndFilter);
                }
                if (cityFilter) {
                    cityFilter.addEventListener('change', handleSearchAndFilter);
                }
            }
            function updateSelectAllCheckbox() {
                const rowCheckboxes = recipientTableBody.querySelectorAll('.rowCheckbox');
                const allChecked = Array.from(rowCheckboxes).every(box => box.checked);
                const anyChecked = Array.from(rowCheckboxes).some(box => box.checked);
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = anyChecked && !allChecked;
            }
            function initializePagination() {
                if (!prevPageButton || !nextPageButton || !paginationInfo) return;
                prevPageButton.addEventListener('click', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        renderRecipientTable();
                        updatePagination();
                    }
                });
                nextPageButton.addEventListener('click', function () {
                    const totalPages = Math.ceil(filteredRecipients.length / entriesPerPage);
                    if (currentPage < totalPages) {
                        currentPage++;
                        renderRecipientTable();
                        updatePagination();
                    }
                });
                entriesPerPageSelect.addEventListener('change', function () {
                    entriesPerPage = parseInt(this.value);
                    currentPage = 1;
                    renderRecipientTable();
                    updatePagination();
                });
                updatePagination();
            }
            function updatePagination() {
                const totalEntries = filteredRecipients.length;
                const totalPages = Math.ceil(totalEntries / entriesPerPage);
                const start = totalEntries === 0 ? 0 : (currentPage - 1) * entriesPerPage + 1;
                const end = Math.min(currentPage * entriesPerPage, totalEntries);
                paginationInfo.textContent = `${start}-${end} / ${totalEntries}`;
                prevPageButton.disabled = currentPage === 1;
                nextPageButton.disabled = currentPage === totalPages || totalEntries === 0;
            }
            function initializeEditor() {
                if (!contentArea) return;
                const fontSelect = document.getElementById('font');
                if (fontSelect) {
                    fontSelect.addEventListener('change', function () {
                        if (this.value !== 'Font') {
                            document.execCommand('fontName', false, this.value);
                        }
                    });
                }
                const sizeSelect = document.getElementById('size');
                if (sizeSelect) {
                    sizeSelect.addEventListener('change', function () {
                        if (this.value !== 'Size') {
                            const sizeMap = {
                                '12px': 2,
                                '14px': 3,
                                '16px': 4,
                                '18px': 5,
                                '20px': 6,
                                '22px': 7,
                                '24px': 8
                            };
                            document.execCommand('fontSize', false, sizeMap[this.value] || 3);
                        }
                    });
                }
                const styleSelect = document.getElementById('styles');
                if (styleSelect) {
                    const headingSizes = {
                        'Heading 1': 'h1',
                        'Heading 2': 'h2',
                        'Heading 3': 'h3',
                        'Heading 4': 'h4',
                        'Heading 5': 'h5',
                        'Heading 6': 'h6',
                        'Normal': 'p'
                    };
                    styleSelect.addEventListener('change', function () {
                        const selectedStyle = this.value;
                        if (headingSizes[selectedStyle]) {
                            document.execCommand('formatBlock', false, headingSizes[selectedStyle]);
                        }
                        this.selectedIndex = 0;
                    });
                }
                const formatSelect = document.getElementById('format');
                if (formatSelect) {
                    formatSelect.addEventListener('change', function () {
                        if (this.value === 'Paragraph') {
                            document.execCommand('formatBlock', false, 'p');
                        } else if (this.value === 'Blockquote') {
                            document.execCommand('formatBlock', false, 'blockquote');
                        } else if (this.value === 'Pre') {
                            document.execCommand('formatBlock', false, 'pre');
                        }
                        this.selectedIndex = 0;
                    });
                }
                if (fontSelect && contentArea) {
                    const defaultOptionText = 'Font';
                    if (fontSelect.options && fontSelect.options.length > 0) {
                        fontSelect.options[0].textContent = defaultOptionText;
                        fontSelect.options[0].value = '';
                    }
                    fontSelect.addEventListener('change', function () {
                        const selectedFont = this.value;
                        if (selectedFont) {
                            const selection = window.getSelection();
                            const range = selection.rangeCount > 0 ? selection.getRangeAt(0) : null;
                            if (range && !range.collapsed) {
                                const span = document.createElement('span');
                                span.style.fontFamily = selectedFont;
                                span.appendChild(range.extractContents());
                                range.insertNode(span);
                            } else {
                                contentArea.style.fontFamily = selectedFont;
                            }
                            if (fontSelect.options && fontSelect.options.length > 0) {
                                fontSelect.options[0].textContent = selectedFont;
                                fontSelect.options[0].value = selectedFont;
                            }
                            if (fontSelect.value === fontSelect.options[0].value) {
                                fontSelect.selectedIndex = 0;
                            }
                        }
                    });
                    contentArea.addEventListener('mouseup', function () {
                        const selection = window.getSelection();
                        if (selection.rangeCount > 0) {
                            const range = selection.getRangeAt(0);
                            const parentElement =
                                range.commonAncestorContainer.nodeType === 1
                                    ? range.commonAncestorContainer
                                    : range.commonAncestorContainer.parentElement;
                            if (parentElement) {
                                let appliedFont = window.getComputedStyle(parentElement).fontFamily;
                                appliedFont = appliedFont.split(',')[0].replace(/['"]/g, '').trim();
                                if (fontSelect.options && fontSelect.options.length > 0) {
                                    fontSelect.options[0].textContent = appliedFont;
                                    fontSelect.options[0].value = appliedFont;
                                }
                                if (fontSelect.value === fontSelect.options[0].value) {
                                    fontSelect.selectedIndex = 0;
                                }
                            }
                        }
                    });
                }
                initializeToolbar();
            }
            function initializeToolbar() {
                const toolbarButtons = document.querySelectorAll('.promotional-toolbar-button');
                toolbarButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const command = this.getAttribute('title');
                        if (command) {
                            executeCommand(command.toLowerCase());
                        }
                    });
                });
            }
            function executeCommand(command) {
                if (!contentArea) return;
                contentArea.focus();
                switch (command) {
                    case 'bold':
                        document.execCommand('bold', false, null);
                        break;
                    case 'italic':
                        document.execCommand('italic', false, null);
                        break;
                    case 'underline':
                        document.execCommand('underline', false, null);
                        break;
                    case 'strikethrough':
                        document.execCommand('strikeThrough', false, null);
                        break;
                    case 'superscript':
                        document.execCommand('superscript', false, null);
                        break;
                    case 'subscript':
                        document.execCommand('subscript', false, null);
                        break;
                    case 'align left':
                        document.execCommand('justifyLeft', false, null);
                        break;
                    case 'align center':
                        document.execCommand('justifyCenter', false, null);
                        break;
                    case 'align right':
                        document.execCommand('justifyRight', false, null);
                        break;
                    case 'justify':
                        document.execCommand('justifyFull', false, null);
                        break;
                    case 'decrease indent':
                        document.execCommand('outdent', false, null);
                        break;
                    case 'increase indent':
                        document.execCommand('indent', false, null);
                        break;
                    case 'bulleted list':
                        document.execCommand('insertUnorderedList', false, null);
                        break;
                    case 'numbered list':
                        document.execCommand('insertOrderedList', false, null);
                        break;
                    case 'undo':
                        document.execCommand('undo', false, null);
                        break;
                    case 'redo':
                        document.execCommand('redo', false, null);
                        break;
                    case 'cut':
                        document.execCommand('cut', false, null);
                        break;
                    case 'copy':
                        document.execCommand('copy', false, null);
                        break;
                    case 'paste':
                        try {
                            document.execCommand('paste', false, null);
                        } catch (err) {
                            alert('Paste operation is not supported in this browser. Use Ctrl+V or Command+V.');
                        }
                        break;
                    case 'select all':
                        document.execCommand('selectAll', false, null);
                        break;
                    case 'insert image':
                        handleImageInsertion();
                        break;
                    case 'insert link':
                        handleLinkInsertion();
                        break;
                    case 'insert table':
                        handleTableInsertion();
                        break;
                    case 'text color':
                        handleTextColor();
                        break;
                    case 'background color':
                        handleBackgroundColor();
                        break;
                    case 'horizontal rule':
                        document.execCommand('insertHorizontalRule', false, null);
                        break;
                    case 'special characters':
                        alert('Special characters panel not implemented');
                        break;
                    case 'full screen':
                        toggleFullScreen();
                        break;
                    case 'view html':
                        toggleCodeView();
                        break;
                    case 'print':
                        window.print();
                        break;
                    case 'code block':
                        insertCodeBlock();
                        break;
                    case 'insert formula':
                        alert('Formula insertion not implemented');
                        break;
                    case 'insert header':
                        alert('Header insertion not implemented');
                        break;
                    case 'insert footer':
                        alert('Footer insertion not implemented');
                        break;
                    case 'page break':
                        insertPageBreak();
                        break;
                }
            }
            function handleImageInsertion() {
                if (!contentArea) return;
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            const imageContainer = document.querySelector('.image-container');
                            if (imageContainer) {
                                imageContainer.innerHTML = '';
                                const newImg = document.createElement('img');
                                newImg.src = event.target.result;
                                newImg.alt = file.name || 'Uploaded Image';
                                newImg.style.maxWidth = '100%';
                                imageContainer.appendChild(newImg);
                            } else {
                                const newImg = document.createElement('img');
                                newImg.src = event.target.result;
                                newImg.alt = file.name || 'Uploaded Image';
                                newImg.style.maxWidth = '100%';
                                const newImageContainer = document.createElement('div');
                                newImageContainer.className = 'image-container';
                                newImageContainer.appendChild(newImg);
                                document.execCommand('insertHTML', false, newImageContainer.outerHTML);
                            }
                            sendImageToBackend(file);
                        };
                        reader.readAsDataURL(file);
                    }
                };
                input.click();
            }
            function handleLinkInsertion() {
                const url = prompt('Enter URL:', 'https://');
                if (url) {
                    const linkInput = document.querySelector('.promotional-link-input');
                    const linkContainer = document.querySelector('.promotional-link-container');
                    if (linkInput && linkContainer) {
                        linkInput.value = url;
                        linkContainer.style.display = 'flex';
                    } else {
                        document.execCommand('createLink', false, url);
                    }
                }
            }
            function handleTableInsertion() {
                if (!contentArea) return;
                const rows = prompt('Enter number of rows:', '3');
                const cols = prompt('Enter number of columns:', '3');
                if (rows && cols && !isNaN(rows) && !isNaN(cols)) {
                    let table = '<table border="1" style="width:100%; border-collapse: collapse;">';
                    for (let i = 0; i < parseInt(rows); i++) {
                        table += '<tr>';
                        for (let j = 0; j < parseInt(cols); j++) {
                            table += '<td style="padding: 8px; border: 1px solid #ddd;"> </td>';
                        }
                        table += '</tr>';
                    }
                    table += '</table>';
                    document.execCommand('insertHTML', false, table);
                }
            }
            function handleTextColor() {
                if (!contentArea) return;
                const selection = window.getSelection();
                if (selection.rangeCount === 0) return;
                const range = selection.getRangeAt(0);
                const colorPicker = document.createElement('input');
                colorPicker.type = 'color';
                colorPicker.addEventListener('change', function () {
                    contentArea.focus();
                    selection.removeAllRanges();
                    selection.addRange(range);
                    document.execCommand('foreColor', false, this.value);
                });
                colorPicker.click();
            }
            function handleBackgroundColor() {
                if (!contentArea) return;
                const selection = window.getSelection();
                if (selection.rangeCount === 0) return;
                const range = selection.getRangeAt(0);
                const bgColorPicker = document.createElement('input');
                bgColorPicker.type = 'color';
                bgColorPicker.addEventListener('change', function () {
                    contentArea.focus();
                    selection.removeAllRanges();
                    selection.addRange(range);
                    document.execCommand('hiliteColor', false, this.value);
                });
                bgColorPicker.click();
            }
            function toggleFullScreen() {
                const elem = document.querySelector('.promotional-composer-main-section') || document.documentElement;
                if (!document.fullscreenElement) {
                    elem.requestFullscreen().catch(() => {});
                } else {
                    document.exitFullscreen();
                }
            }
            function toggleCodeView() {
                if (!contentArea) return;
                if (!contentArea.getAttribute('data-mode') || contentArea.getAttribute('data-mode') !== 'code') {
                    const htmlContent = contentArea.innerHTML;
                    contentArea.textContent = htmlContent;
                    contentArea.setAttribute('data-mode', 'code');
                    contentArea.style.fontFamily = 'monospace';
                    contentArea.style.whiteSpace = 'pre-wrap';
                } else {
                    const codeContent = contentArea.textContent;
                    contentArea.innerHTML = codeContent;
                    contentArea.removeAttribute('data-mode');
                    contentArea.style.fontFamily = '';
                    contentArea.style.whiteSpace = '';
                }
            }
            function insertCodeBlock() {
                if (!contentArea) return;
                contentArea.focus();
                const codeBlock =
                    '<pre style="background-color: #f5f5f5; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace;"><code>// Your code here</code></pre>';
                document.execCommand('insertHTML', false, codeBlock);
            }
            function insertPageBreak() {
                if (!contentArea) return;
                contentArea.focus();
                const pageBreak = '<div style="page-break-after: always; border-top: 1px dashed #ccc; margin: 20px 0;"></div>';
                document.execCommand('insertHTML', false, pageBreak);
            }
            function updateWordCount() {
                if (!contentArea || !wordCountElement) return;
                const text = contentArea.innerText || '';
                const words = text.trim().split(/\s+/);
                const wordCount = text.trim() === '' ? 0 : words.length;
                wordCountElement.textContent = wordCount;
            }
            if (contentArea) {
                contentArea.addEventListener('input', updateWordCount);
                contentArea.addEventListener('paste', function () {
                    setTimeout(updateWordCount, 0);
                });
                contentArea.addEventListener('keyup', updateWordCount);
            }
            function initializeLinkContainer() {
                const changeButton = document.querySelector('.promotional-link-container .promotional-link-button:first-child');
                const removeButton = document.querySelector('.promotional-link-container .promotional-link-button:last-child');
                const linkInput = document.querySelector('.promotional-link-input');
                const linkContainer = document.querySelector('.promotional-link-container');
                const insertLinkBtn = document.getElementById('insertLinkBtn');
                const removeLinkBtn = document.getElementById('removeLink');
                const insertedLink = document.getElementById('insertedLink');
                const insertedLinkContainer = document.getElementById('linkContainer');
                if (changeButton && removeButton && linkInput && linkContainer) {
                    changeButton.addEventListener('click', function () {
                        const newLink = prompt('Update link:', linkInput.value);
                        if (newLink) {
                            linkInput.value = newLink;
                            linkContainer.style.display = 'flex';
                        }
                    });
                    removeButton.addEventListener('click', function () {
                        if (confirm('Remove this link?')) {
                            linkInput.value = '';
                            linkContainer.style.display = 'none';
                        }
                    });
                }
                if (insertLinkBtn && insertedLink && insertedLinkContainer) {
                    insertLinkBtn.addEventListener('click', function () {
                        const link = prompt('Enter the link:', 'https://');
                        if (link) {
                            const normalizedLink = link.startsWith('http://') || link.startsWith('https://') ? link : 'https://' + link;
                            insertedLink.href = normalizedLink;
                            insertedLink.textContent = normalizedLink;
                            insertedLinkContainer.style.display = 'flex';
                        }
                    });
                }
                if (removeLinkBtn && insertedLinkContainer) {
                    removeLinkBtn.addEventListener('click', function () {
                        insertedLinkContainer.style.display = 'none';
                        insertedLink.textContent = 'Inserted Link';
                        insertedLink.removeAttribute('href');
                    });
                }
            }
            function handleAttachment() {
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = '.pdf,.doc,.docx';
                input.onchange = function (e) {
                    if (e.target.files.length > 0) {
                        const file = e.target.files[0];
                        const attachmentSection = document.querySelector('.promotional-attachment-section');
                        if (!attachmentSection) return;
                        if (!file.type.includes('pdf') && !file.name.endsWith('.doc') && !file.name.endsWith('.docx')) {
                            alert('Only PDF and DOC files are allowed.');
                            return;
                        }
                        attachedFiles.push(file);
                        const fileElement = document.createElement('div');
                        fileElement.className = 'attachment-file-promotional';
                        fileElement.setAttribute('data-file-name', file.name);
                        const iconClass = file.type.includes('pdf') ? 'fa-file-pdf' : 'fa-file-word';
                        const fileSize =
                            file.size < 1024
                                ? file.size + ' B'
                                : file.size < 1024 * 1024
                                ? Math.round(file.size / 1024) + ' KB'
                                : Math.round((file.size / (1024 * 1024)) * 10) / 10 + ' MB';
                        fileElement.innerHTML = `
                            <i class="fas ${iconClass} file-icon"></i>
                            <span>${file.name}</span>
                            <span>(${fileSize})</span>
                            <i class="fas fa-times remove-file"></i>
                        `;
                        attachmentSection.appendChild(fileElement);
                        fileElement.querySelector('.remove-file').addEventListener('click', function () {
                            const fileName = fileElement.getAttribute('data-file-name');
                            attachedFiles = attachedFiles.filter(f => f.name !== fileName);
                            fileElement.remove();
                        });
                    }
                };
                input.click();
            }
            function saveDraft() {
                if (!contentArea) return;
                const content = contentArea.innerHTML;
                localStorage.setItem('emailDraft', content);
                alert('Email draft saved successfully!');
            }
            function loadSavedDraft() {
                if (!contentArea) return;
                const savedDraft = localStorage.getItem('emailDraft');
                if (savedDraft) {
                    if (confirm('You have a saved draft. Would you like to load it?')) {
                        contentArea.innerHTML = savedDraft;
                        updateWordCount();
                    } else {
                        localStorage.removeItem('emailDraft');
                    }
                }
            }
            function sendEmail() {
                if (!contentArea) return;
                let content = contentArea.innerHTML;
                if (!content.trim()) {
                    alert('Please enter email content.');
                    return;
                }
                if (uploadedImageUrl) {
                    content += `<img src="${uploadedImageUrl}" style="height:500px;width:600px" alt="Promotional Image" />`;
                }
                const selectedRecipients = Array.from(
                    document.querySelectorAll('.promotional-recipients-table tbody input[type="checkbox"]:checked')
                ).map(checkbox => {
                    const row = checkbox.closest('tr');
                    return {
                        name: row.cells[1].textContent,
                        email: row.cells[3].textContent
                    };
                });
                console.log('Selected Recipients:', selectedRecipients);
                if (selectedRecipients.length === 0) {
                    alert('Please select at least one recipient.');
                    return;
                }
                const formData = new FormData();
                formData.append('content', content);
                formData.append('recipients', JSON.stringify(selectedRecipients));
                attachedFiles.forEach((file, index) => {
                    formData.append(`attachments[${index}]`, file);
                });
                fetch('/api/promotional-email', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(async response => {
                        if (!response.ok) {
                            const text = await response.text();
                            console.error('Raw response:', text);
                            throw new Error(`HTTP error! Status: ${response.status}, Response: ${text}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            let message = data.message || `Email sent successfully to ${selectedRecipients.length} recipient${selectedRecipients.length > 1 ? 's' : ''}!`;
                            if (data.partial_errors && data.partial_errors.length > 0) {
                                message += '\nErrors:\n' + data.partial_errors.join('\n');
                            }
                            alert(message);
                            localStorage.removeItem('emailDraft');
                            attachedFiles = [];
                            const attachmentSection = document.getElementById('attachmentSection');
                            const fileElements = attachmentSection.querySelectorAll('.attachment-file-promotional:not(#linkContainer)');
                            fileElements.forEach(element => element.remove());
                        } else {
                            alert('Failed to send email: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('Error sending email: ' + error.message);
                    });
            }
            function sendImageToBackend(file) {
                const formData = new FormData();
                formData.append('image', file);
                fetch('/promotional-image-attach', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            uploadedImageUrl = data.fileUrl;
                        } else {
                            alert('Error uploading image: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Image upload error:', error);
                        alert('Error uploading image: ' + error.message);
                    });
            }
            function setUpEmailFunctionality() {
                if (saveButton) {
                    saveButton.addEventListener('click', saveDraft);
                }
                if (attachButton) {
                    attachButton.addEventListener('click', handleAttachment);
                }
                initializeLinkContainer();
                const triggerEmail = document.getElementById('send-promotional_email');
                if (triggerEmail) {
                    triggerEmail.removeEventListener('click', sendEmail);
                    triggerEmail.addEventListener('click', sendEmail);
                }
            }
        });
    </script>
</body>
</html>