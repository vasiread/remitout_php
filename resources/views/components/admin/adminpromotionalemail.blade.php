<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Composer</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/adminpromotional.css">
</head>

<body>
    @extends('layouts.app')

    @php
    @endphp

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
                        <!-- First Row - Toolbar Dropdowns and Buttons -->
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
                        <!-- Text Formatting Buttons -->
                        <button class="promotional-toolbar-button" title="Bold"><i class="fas fa-bold"></i></button>
                        <button class="promotional-toolbar-button" title="Italic"><i class="fas fa-italic"></i></button>
                        <button class="promotional-toolbar-button" title="Underline"><i
                                class="fas fa-underline"></i></button>
                        <button class="promotional-toolbar-button" title="Strikethrough"><i
                                class="fas fa-strikethrough"></i></button>
                        <button class="promotional-toolbar-button" title="Superscript"><i
                                class="fas fa-superscript"></i></button>
                        <button class="promotional-toolbar-button" title="Subscript"><i
                                class="fas fa-subscript"></i></button>
                        <!-- Alignment Buttons -->
                        <button class="promotional-toolbar-button" title="Align Left"><i
                                class="fas fa-align-left"></i></button>
                        <button class="promotional-toolbar-button" title="Align Center"><i
                                class="fas fa-align-center"></i></button>
                        <button class="promotional-toolbar-button" title="Align Right"><i
                                class="fas fa-align-right"></i></button>
                        <button class="promotional-toolbar-button" title="Justify"><i
                                class="fas fa-align-justify"></i></button>
                        <!-- Indent Buttons -->
                        <button class="promotional-toolbar-button" title="Decrease Indent"><i
                                class="fas fa-outdent"></i></button>
                        <button class="promotional-toolbar-button" title="Increase Indent"><i
                                class="fas fa-indent"></i></button>
                        <!-- List Buttons -->
                        <button class="promotional-toolbar-button" title="Bulleted List"><i
                                class="fas fa-list-ul"></i></button>
                        <button class="promotional-toolbar-button" title="Numbered List"><i
                                class="fas fa-list-ol"></i></button>
                        <!-- Undo/Redo Buttons -->
                        <button class="promotional-toolbar-button" title="Undo"><i class="fas fa-undo"></i></button>
                        <button class="promotional-toolbar-button" title="Redo"><i class="fas fa-redo"></i></button>
                    </div>
                    <div class="promotional-toolbar-row">
                        <!-- Second Row - Additional Toolbar Buttons -->
                        <button class="promotional-toolbar-button" title="Cut"><i class="fas fa-cut"></i></button>
                        <button class="promotional-toolbar-button" title="Copy"><i class="fas fa-copy"></i></button>
                        <button class="promotional-toolbar-button" title="Paste"><i class="fas fa-paste"></i></button>
                        <button class="promotional-toolbar-button" title="Select All"><i
                                class="fas fa-check-double"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Image"><i
                                class="fas fa-image"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Link"><i
                                class="fas fa-link"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Table"><i
                                class="fas fa-table"></i></button>
                        <button class="promotional-toolbar-button" title="Text Color"><i
                                class="fas fa-palette"></i></button>
                        <button class="promotional-toolbar-button" title="Background Color"><i
                                class="fas fa-fill-drip"></i></button>
                        <button class="promotional-toolbar-button" title="Special Characters"><i
                                class="fas fa-omega"></i></button>
                        <button class="promotional-toolbar-button" title="Horizontal Rule"><i
                                class="fas fa-minus"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Formula"><i
                                class="fas fa-square-root-alt"></i></button>
                        <button class="promotional-toolbar-button" title="Code Block"><i
                                class="fas fa-code"></i></button>
                        <button class="promotional-toolbar-button" title="Full Screen"><i
                                class="fas fa-expand"></i></button>
                        <button class="promotional-toolbar-button" title="Print"><i class="fas fa-print"></i></button>
                        <button class="promotional-toolbar-button" title="View HTML"><i
                                class="fas fa-file-code"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Header"><i
                                class="fas fa-heading"></i></button>
                        <button class="promotional-toolbar-button" title="Insert Footer"><i
                                class="fas fa-shoe-prints"></i></button>
                        <button class="promotional-toolbar-button" title="Page Break"><i
                                class="fas fa-page-break"></i></button>
                    </div>
                </div>

                <div class="promotional-content-area" contenteditable="true">
                    <div class="image-container">
                        <img src="/api/placeholder/800/400" alt="Modern Office Space">
                    </div>
                    <h1 class="promotional-heading">Header 01</h1>
                    <p class="promotional-sub">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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

                <div class="promotional-attachment-section">
                    <div class="attachment-buttons-promotional">
                        <button class="btn-promo btn-draft"><i class="fas fa-paperclip"></i> Attach files</button>
                        <button class="btn-promo btn-insert" id="insertLinkBtn"><i class="fas fa-link"></i> Insert
                            Link</button>
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
                            <select>
                                <option>State</option>
                                <option>Tamil Nadu</option>
                                <option>Kerala</option>
                                <option>Karnataka</option>
                            </select>
                            <select>
                                <option>City</option>
                                <option>Chennai</option>
                                <option>Bangalore</option>
                                <option>Mumbai</option>
                            </select>
                            <div style="position: relative;">
                                <input type="text" placeholder="Search" id="promotional-search-input">
                            </div>
                        </div>
                    </div>

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
                        <tbody id="recipientTableBody">
                        </tbody>
                    </table>

                    <div class="promotional-pagination">
                        <button id="prevPage">←</button>
                        <span id="paginationInfo">1-10 / 30</span>
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
            const entriesPerPageSelect = document.getElementById('entriesPerPage');
            const prevPageButton = document.getElementById('prevPage');
            const nextPageButton = document.getElementById('nextPage');
            const paginationInfo = document.getElementById('paginationInfo');
            const searchInput = document.getElementById('promotional-search-input');
            const selectAllCheckbox = document.getElementById('selectAll');


            setUpEmailFunctionality();
            initializeEditor();
            updateWordCount();
            initializeRecipientTable();
            initializePagination();
            loadSavedDraft();
            renderRecipients();

            let currentPage = 1;
            let entriesPerPage = parseInt(entriesPerPageSelect.value);
            let filteredRecipients = [];

            function renderRecipients() {
                fetch("/getrecipients")
                    .then(response => response.json())
                    .then(result => {
                        if (result.success && Array.isArray(result.data)) {
                            const tableBody = document.getElementById("recipientTableBody");
                            tableBody.innerHTML = ""; // Clear existing rows

                            result.data.forEach(recipient => {
                                const row = document.createElement("tr");
                                row.innerHTML = `
                        <td><input type="checkbox" class="rowCheckbox"></td>
                        <td>${recipient.name}</td>
                        <td>${recipient.unique_id}</td>
                        <td>${recipient.email}</td>
                        <td>${recipient.phone}</td>
                    `;
                                tableBody.appendChild(row);
                                console.log("s")
                            });
                        } else {
                            console.error("Invalid API response format");
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching recipients:", error);
                    });
            });


            

        // Your existing renderPage function here
        function renderPage(data, page, entriesPerPage) {
            const startIndex = (page - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;
            const paginatedData = data.slice(startIndex, endIndex);

            // Example: log paginatedData or render it in UI
            console.log("Rendering page data:", paginatedData);
        }



        // Attach event listeners
        if (saveButton) saveButton.addEventListener('click', saveDraft);
        if (sendButton) sendButton.addEventListener('click', sendEmail);
        if (attachButton) attachButton.addEventListener('click', handleAttachment);
        if (entriesPerPageSelect) entriesPerPageSelect.addEventListener('change', function () {
            entriesPerPage = parseInt(this.value);
            currentPage = 1;
            renderRecipientTable();
            updatePagination();
        });
        if (searchInput) searchInput.addEventListener('input', handleSearch);
        initializeLinkContainer();

        // Set up "know more" functionality
        const knowMoreBtn = document.querySelector('.know-more');
        if (knowMoreBtn) {
            knowMoreBtn.addEventListener('click', function () {
                alert('Additional information will be displayed here!');
            });
        }


        function initializeEditor() {
            if (!contentArea) return;

            // Font family dropdown
            const fontSelect = document.getElementById('font');
            if (fontSelect) {
                fontSelect.addEventListener('change', function () {
                    if (this.value !== 'Font') {
                        document.execCommand('fontName', false, this.value);
                    }
                });
            }

            // Font size dropdown
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

            // Heading styles
            const styleSelect = document.getElementById('styles');
            if (styleSelect) {
                const headingSizes = {
                    "Heading 1": "h1",
                    "Heading 2": "h2",
                    "Heading 3": "h3",
                    "Heading 4": "h4",
                    "Heading 5": "h5",
                    "Heading 6": "h6",
                    "Normal": "p"
                };
                styleSelect.addEventListener('change', function () {
                    const selectedStyle = this.value;
                    if (headingSizes[selectedStyle]) {
                        document.execCommand('formatBlock', false, headingSizes[selectedStyle]);
                    }
                    this.selectedIndex = 0;
                });
            }

            // Format dropdown
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
                const defaultOptionText = "Font";
                if (fontSelect.options && fontSelect.options.length > 0) {
                    fontSelect.options[0].textContent = defaultOptionText;
                    fontSelect.options[0].value = "";
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
                        const parentElement = range.commonAncestorContainer.parentElement;
                        if (parentElement) {
                            let appliedFont = window.getComputedStyle(parentElement).fontFamily;
                            appliedFont = appliedFont.split(",")[0].replace(/['"]/g, "").trim();
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
                case 'bold': document.execCommand('bold', false, null); break;
                case 'italic': document.execCommand('italic', false, null); break;
                case 'underline': document.execCommand('underline', false, null); break;
                case 'strikethrough': document.execCommand('strikeThrough', false, null); break;
                case 'superscript': document.execCommand('superscript', false, null); break;
                case 'subscript': document.execCommand('subscript', false, null); break;
                case 'align left': document.execCommand('justifyLeft', false, null); break;
                case 'align center': document.execCommand('justifyCenter', false, null); break;
                case 'align right': document.execCommand('justifyRight', false, null); break;
                case 'justify': document.execCommand('justifyFull', false, null); break;
                case 'decrease indent': document.execCommand('outdent', false, null); break;
                case 'increase indent': document.execCommand('indent', false, null); break;
                case 'bulleted list': document.execCommand('insertUnorderedList', false, null); break;
                case 'numbered list': document.execCommand('insertOrderedList', false, null); break;
                case 'undo': document.execCommand('undo', false, null); break;
                case 'redo': document.execCommand('redo', false, null); break;
                case 'cut': document.execCommand('cut', false, null); break;
                case 'copy': document.execCommand('copy', false, null); break;
                case 'paste':
                    try {
                        document.execCommand('paste', false, null);
                    } catch (err) {
                        alert('Paste operation is not directly supported in this browser. Please use keyboard shortcut Ctrl+V or Command+V.');
                    }
                    break;
                case 'select all': document.execCommand('selectAll', false, null); break;
                case 'insert image': handleImageInsertion(); break;
                case 'insert link': handleLinkInsertion(); break;
                case 'insert table': handleTableInsertion(); break;
                case 'text color': handleTextColor(); break;
                case 'background color': handleBackgroundColor(); break;
                case 'horizontal rule': document.execCommand('insertHorizontalRule', false, null); break;
                case 'special characters': alert('Special characters panel would open here'); break;
                case 'full screen': toggleFullScreen(); break;
                case 'view html': toggleCodeView(); break;
                case 'print': window.print(); break;
                case 'code block': insertCodeBlock(); break;
                case 'insert formula': alert('Formula insertion would be implemented here'); break;
                case 'insert header': alert('Header insertion would be implemented here'); break;
                case 'insert footer': alert('Footer insertion would be implemented here'); break;
                case 'page break': insertPageBreak(); break;
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
            if (rows && cols) {
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
            try {
                if (!document.fullscreenElement) {
                    elem.requestFullscreen().catch(err => {
                        console.error(`Error attempting to enable full-screen mode: ${err.message}`);
                    });
                } else {
                    document.exitFullscreen();
                }
            } catch (error) {
                console.error("Fullscreen API error:", error);
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
            const codeBlock = '<pre style="background-color: #f5f5f5; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace;"><code>// Your code here</code></pre>';
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

        function initializeRecipientTable() {
            if (!recipientTableBody || !selectAllCheckbox) return;

            // Render initial table
            renderRecipientTable();

            // Select All Checkbox functionality
            selectAllCheckbox.addEventListener('change', function () {
                const rowCheckboxes = recipientTableBody.querySelectorAll('input[type="checkbox"]');
                rowCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            });

            // Individual checkbox functionality
            recipientTableBody.addEventListener('change', function (e) {
                if (e.target.type === 'checkbox') {
                    const rowCheckboxes = recipientTableBody.querySelectorAll('input[type="checkbox"]');
                    const allChecked = Array.from(rowCheckboxes).every(box => box.checked);
                    const anyChecked = Array.from(rowCheckboxes).some(box => box.checked);
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = anyChecked && !allChecked;
                }
            });
        }
        function renderRecipientTable() {
            if (!recipientTableBody) return;
            recipientTableBody.innerHTML = '';

            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;
            const paginatedRecipients = filteredRecipients.slice(start, end);

            paginatedRecipients.forEach(recipient => {
                const row = document.createElement('tr');
                row.innerHTML = `
                        <td><input type="checkbox"></td>
                        <td>${recipient.name}</td>
                        <td>${recipient.id}</td>
                        <td>${recipient.email}</td>
                        <td>${recipient.mobile}</td>
                    `;
                recipientTableBody.appendChild(row);
            });
        }
        function handleSearch() {
            const searchText = searchInput.value.toLowerCase();
            filteredRecipients = recipients.filter(recipient =>
                recipient.name.toLowerCase().includes(searchText) ||
                recipient.id.toLowerCase().includes(searchText) ||
                recipient.email.toLowerCase().includes(searchText) ||
                recipient.mobile.includes(searchText)
            );
            currentPage = 1;
            renderRecipientTable();
            updatePagination();
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

            updatePagination();
        }

        function updatePagination() {
            const totalEntries = filteredRecipients.length;
            const totalPages = Math.ceil(totalEntries / entriesPerPage);
            const start = ((currentPage - 1) * entriesPerPage) + 1;
            const end = Math.min(currentPage * entriesPerPage, totalEntries);
            paginationInfo.textContent = `${start}-${end} / ${totalEntries}`;
            prevPageButton.disabled = currentPage === 1;
            nextPageButton.disabled = currentPage === totalPages;
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

                    const fileElement = document.createElement('div');
                    fileElement.className = 'attachment-file-promotional';
                    const iconClass = file.type.includes('pdf') ? 'fa-file-pdf' : 'fa-file-word';
                    const fileSize = file.size < 1024 ? file.size + ' B' :
                        file.size < 1024 * 1024 ? Math.round(file.size / 1024) + ' KB' :
                            Math.round(file.size / (1024 * 1024) * 10) / 10 + ' MB';

                    fileElement.innerHTML = `
                            <i class="fas ${iconClass} file-icon"></i>
                            <span>${file.name}</span>
                            <span>(${fileSize})</span>
                            <i class="fas fa-times remove-file"></i>
                        `;
                    attachmentSection.appendChild(fileElement);

                    fileElement.querySelector('.remove-file').addEventListener('click', function () {
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

        // Send email functionality
        function sendEmail() {
            if (!contentArea) return;

            const content = contentArea.innerHTML;
            const selectedRecipients = Array.from(document.querySelectorAll('.recipients-table tbody input[type="checkbox"]:checked'))
                .map(checkbox => {
                    const row = checkbox.closest('tr');
                    return {
                        name: row.cells[1].textContent,
                        email: row.cells[3].textContent
                    };
                });

            if (selectedRecipients.length === 0) {
                alert('Please select at least one recipient.');
                return;
            }

            // Construct email data
            const emailData = {
                content: content,
                recipients: selectedRecipients,
                attachments: Array.from(document.querySelectorAll('.attachment-file-promotional'))
                    .map(file => file.querySelector('span').textContent)
            };

            // In a real application, this would be sent to a server
            console.log('Sending email:', emailData);
            alert('Email sent successfully to ' + selectedRecipients.length + ' recipients!');

            // Clear the draft after sending
            localStorage.removeItem('emailDraft');
        }

        // Load saved draft if exists
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

        // Add existing attachment remove functionality
        const existingRemoveButtons = document.querySelectorAll('.attachment-file-promotional .remove-file');
        existingRemoveButtons.forEach(button => {
            button.addEventListener('click', function () {
                this.closest('.attachment-file-promotional').remove();
            });
        });
        });
        let uploadedImageUrl = null;

        function sendImageToBackend(file) {
            const formData = new FormData();
            formData.append('image', file);

            // Send the file using fetch
            fetch('/promotional-image-attach', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF protection
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Image uploaded successfully!");
                        uploadedImageUrl = data.fileUrl; // Store the uploaded image URL here
                        console.log(uploadedImageUrl); // For debugging
                    } else {
                        console.error("Error uploading image.");
                    }
                })
                .catch(error => {
                    console.error("Error: ", error);
                });
        }

        // Handle the email functionality (this sends the email with content and image URL)
        function setUpEmailFunctionality() {
            const triggerEmail = document.getElementById("send-promotional_email");

            if (triggerEmail) {
                triggerEmail.addEventListener('click', () => {
                    let content = document.querySelector('.promotional-content-area').innerHTML;

                    if (!content.trim()) {
                        console.error("Error: Content is empty.");
                        return; // Prevent sending empty content
                    }

                    // Add the uploaded image URL (if it exists) to the content
                    if (uploadedImageUrl) {
                        content += `<img src="${uploadedImageUrl}" style="height:500px;width:600px" alt="Promotional Image" />`; // Append the image URL to the content
                    }

                    console.log(content); // For debugging, remove it in production

                    // Send the content to the backend
                    fetch('/promotional-email', {  // Ensure this matches the correct route
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // For CSRF protection
                        },
                        body: JSON.stringify({
                            content: content
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log("Email sent successfully!");
                                alert("Email Sent Successfully To all Users");
                            } else {
                                console.error("Error sending email.");
                            }
                        })
                        .catch(error => {
                            console.error("Error: ", error);
                        });
                });
            }
        }
    </script>
</body>
</html>