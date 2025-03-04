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
                <button class="btn-promo btn-send">Send Email</button>
            </div>

        </div>

        <div class="promotional-composer-container">


            <div class="promotional-toolbar">
                <div class="promotional-toolbar-row">
                    <!-- First Row - 20 options as per Image 1 -->
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
                            <option> </option>

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
                    <!-- Second Row - 19 options as per Images 2 and 3 -->
                    <!-- Edit Operations -->
                    <button class="promotional-toolbar-button" title="Cut"><i class="fas fa-cut"></i></button>
                    <button class="promotional-toolbar-button" title="Copy"><i class="fas fa-copy"></i></button>
                    <button class="promotional-toolbar-button" title="Paste"><i class="fas fa-paste"></i></button>
                    <button class="promotional-toolbar-button" title="Select All"><i
                            class="fas fa-check-double"></i></button>

                    <!-- Insert Media -->
                    <button class="promotional-toolbar-button" title="Insert Image"><i
                            class="fas fa-image"></i></button>
                    <button class="promotional-toolbar-button" title="Insert Link"><i class="fas fa-link"></i></button>
                    <button class="promotional-toolbar-button" title="Insert Table"><i
                            class="fas fa-table"></i></button>

                    <!-- Advanced Formatting -->
                    <button class="promotional-toolbar-button" title="Text Color"><i
                            class="fas fa-palette"></i></button>
                    <button class="promotional-toolbar-button" title="Background Color"><i
                            class="fas fa-fill-drip"></i></button>
                    <button class="promotional-toolbar-button" title="Special Characters"><i
                            class="fas fa-omega"></i></button>
                    <button class="promotional-toolbar-button" title="Horizontal Rule"><i
                            class="fas fa-minus"></i></button>

                    <!-- Equation/Formula -->
                    <button class="promotional-toolbar-button" title="Insert Formula"><i
                            class="fas fa-square-root-alt"></i></button>

                    <!-- Code Functions -->
                    <button class="promotional-toolbar-button" title="Code Block"><i class="fas fa-code"></i></button>

                    <!-- View Options -->
                    <button class="promotional-toolbar-button" title="Full Screen"><i
                            class="fas fa-expand"></i></button>
                    <button class="promotional-toolbar-button" title="Print"><i class="fas fa-print"></i></button>
                    <button class="promotional-toolbar-button" title="View HTML"><i
                            class="fas fa-file-code"></i></button>

                    <!-- Document Structure -->
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

                 <p class="promotional-sub">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat.</p>

                <p class="know-more">Click here to know more!</p>

                <div class="promotional-link-container">
                    <span>Link:</span>
                    <input type="text" class="promotional-link-input" value="https://www.google.com/">

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
                    <button class="btn-promo btn-insert"><i class="fas fa-link"></i> Insert Link</button>
                </div>
                <div class="attachment-file-promotional">
                    <i class="fas fa-file-pdf file-icon"></i>
                    <span>Promotion.pdf</span>
                    <span>(378 KB)</span>
                    <i class="fas fa-times remove-file"></i>
                </div>
                <div class="attachment-file-promotional" id="linkContainer" style="display: none;">
                    <i class="fas fa-link file-icon"></i>
                    <a id="insertedLink" href="#" target="_blank">Inserted Link</a>
                    <i class="fas fa-times remove-file" id="removeLink"></i>
                </div>
            </div>

            <div class="promotional-recipients-section">
                <div class="promotional-recipients-header">
                    <h3 class="promotional-recipients-title">Add recipients</h3>
                    <div class="promotional-recipients-filters">
                        <select>
                            <option>10 entries</option>
                            <option>25 entries</option>
                            <option>50 entries</option>
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
                            <input type="text" placeholder="Search">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                    </div>
                </div>

                <table class="promotional-recipients-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;"><input type="checkbox"></th>
                            <th>User Name</th>
                            <th>Unique ID</th>
                            <th>User Email</th>
                            <th>Mobile No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Mechupatti korukular teddy</td>
                            <td>HLMLHU765857</td>
                            <td>korukular2017@gmail.com</td>
                            <td>8375635778</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Mechupatti korukular teddy</td>
                            <td>HLMLHU765857</td>
                            <td>korukular2017@gmail.com</td>
                            <td>8375635778</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Mechupatti korukular teddy</td>
                            <td>HLMLHU765857</td>
                            <td>korukular2017@gmail.com</td>
                            <td>8375635778</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Mechupatti korukular teddy</td>
                            <td>HLMLHU765857</td>
                            <td>korukular2017@gmail.com</td>
                            <td>8375635778</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Mechupatti korukular teddy</td>
                            <td>HLMLHU765857</td>
                            <td>korukular2017@gmail.com</td>
                            <td>8375635778</td>
                        </tr>
                    </tbody>
                </table>

                <div class="promotional-pagination">
                    <button>←</button>
                    <span>1-10 / 30</span>
                    <button>→</button>
                </div>
            </div>
        </div>

    </div>
</div>


    <script>
    // Wait for the DOM to be fully loaded



document.addEventListener('DOMContentLoaded', function () {
    // Store references to frequently accessed elements
    const contentArea = document.querySelector('.promotional-content-area');
    const wordCountElement = document.getElementById('wordCount');
    const saveButton = document.querySelector('.btn-draft');
    const sendButton = document.querySelector('.btn-send');
    const attachButton = document.querySelector('.promotional-attachment-section .btn-draft:first-child');

    // Initialize editor functionality
    initializeEditor();

    // Initialize word count
    updateWordCount();

    // Initialize recipient table functionality
    initializeRecipientTable();

    // Initialize pagination
    initializePagination();

    // Load saved draft if exists
    loadSavedDraft();

    // Attach event listeners to buttons
    if (saveButton) saveButton.addEventListener('click', saveDraft);
    if (sendButton) sendButton.addEventListener('click', sendEmail);
    if (attachButton) attachButton.addEventListener('click', handleAttachment);

    // Set up link container buttons
    initializeLinkContainer();

    // Set up "know more" functionality
    const knowMoreBtn = document.querySelector('.know-more');
    if (knowMoreBtn) {
        knowMoreBtn.addEventListener('click', function () {
            alert('Additional information will be displayed here!');
        });
    }

    // === Function Definitions ===

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
                    // Map dropdown values to actual size values
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

            styleSelect.addEventListener('change', function() {
                const selectedStyle = this.value;
                
                if (headingSizes[selectedStyle]) {
                    document.execCommand('formatBlock', false, headingSizes[selectedStyle]);
                }

                this.selectedIndex = 0; // Reset to default option
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
                this.selectedIndex = 0; // Reset to default option
            });
        }

        // Font selection functionality
        if (fontSelect && contentArea) {
            // Store the original first option text
            const defaultOptionText = "Font";

            // Set initial first option
            if (fontSelect.options && fontSelect.options.length > 0) {
                fontSelect.options[0].textContent = defaultOptionText;
                fontSelect.options[0].value = "";
            }

            // Handle font selection
            fontSelect.addEventListener('change', function() {
                const selectedFont = this.value;

                if (selectedFont) {
                    const selection = window.getSelection();
                    const range = selection.rangeCount > 0 ? selection.getRangeAt(0) : null;

                    if (range && !range.collapsed) {
                        // Wrap selected text in a span with the selected font
                        const span = document.createElement('span');
                        span.style.fontFamily = selectedFont;
                        span.appendChild(range.extractContents());
                        range.insertNode(span);
                    } else {
                        // Set font for future typing
                        contentArea.style.fontFamily = selectedFont;
                    }

                    // Update the first option to show the selected font
                    if (fontSelect.options && fontSelect.options.length > 0) {
                        fontSelect.options[0].textContent = selectedFont;
                        fontSelect.options[0].value = selectedFont;
                    }

                    // Ensure the dropdown doesn't show the selected font twice
                    if (fontSelect.value === fontSelect.options[0].value) {
                        fontSelect.selectedIndex = 0;
                    }
                }
            });

            // Update dropdown when selecting text
            contentArea.addEventListener('mouseup', function() {
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    const parentElement = range.commonAncestorContainer.parentElement;

                    if (parentElement) {
                        let appliedFont = window.getComputedStyle(parentElement).fontFamily;
                        appliedFont = appliedFont.split(",")[0].replace(/['"]/g, "").trim(); // Normalize font name

                        // Update the first option with applied font
                        if (fontSelect.options && fontSelect.options.length > 0) {
                            fontSelect.options[0].textContent = appliedFont;
                            fontSelect.options[0].value = appliedFont;
                        }

                        // Avoid duplicate selection
                        if (fontSelect.value === fontSelect.options[0].value) {
                            fontSelect.selectedIndex = 0;
                        }
                    }
                }
            });
        }

        // Initialize toolbar
        initializeToolbar();
    }

    function initializeToolbar() {
        // Toolbar buttons
        const toolbarButtons = document.querySelectorAll('.promotional-toolbar-button');

        // Setup toolbar button actions
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
        // Ensure contenteditable area is in focus
        if (!contentArea) return;
        contentArea.focus();

        // Map command titles to execCommand actions
        switch (command) {
            // Text formatting
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

            // Alignment
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

            // Indentation
            case 'decrease indent':
                document.execCommand('outdent', false, null);
                break;
            case 'increase indent':
                document.execCommand('indent', false, null);
                break;

            // Lists
            case 'bulleted list':
                document.execCommand('insertUnorderedList', false, null);
                break;
            case 'numbered list':
                document.execCommand('insertOrderedList', false, null);
                break;

            // History
            case 'undo':
                document.execCommand('undo', false, null);
                break;
            case 'redo':
                document.execCommand('redo', false, null);
                break;

            // Clipboard
            case 'cut':
                document.execCommand('cut', false, null);
                break;
            case 'copy':
                document.execCommand('copy', false, null);
                break;
            case 'paste':
                // Paste function has limitations in modern browsers
                try {
                    document.execCommand('paste', false, null);
                } catch (err) {
                    alert('Paste operation is not directly supported in this browser. Please use keyboard shortcut Ctrl+V or Command+V.');
                }
                break;
            case 'select all':
                document.execCommand('selectAll', false, null);
                break;

            // Insert media
            case 'insert image':
                handleImageInsertion();
                break;
            case 'insert link':
                handleLinkInsertion();
                break;
            case 'insert table':
                handleTableInsertion();
                break;

            // Colors
            case 'text color':
                handleTextColor();
                break;
            case 'background color':
                handleBackgroundColor();
                break;

            // Special items
            case 'horizontal rule':
                document.execCommand('insertHorizontalRule', false, null);
                break;
            case 'special characters':
                alert('Special characters panel would open here');
                break;

            // View options
            case 'full screen':
                toggleFullScreen();
                break;
            case 'view html':
                toggleCodeView();
                break;
            case 'print':
                window.print();
                break;

            // Code and formulas
            case 'code block':
                insertCodeBlock();
                break;
            case 'insert formula':
                alert('Formula insertion would be implemented here');
                break;

            // Document structure
            case 'insert header':
                alert('Header insertion would be implemented here');
                break;
            case 'insert footer':
                alert('Footer insertion would be implemented here');
                break;
            case 'page break':
                insertPageBreak();
                break;
        }
    }

    // Helper functions for complex commands

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
                    // Find the existing image container
                    const imageContainer = document.querySelector('.image-container');

                    if (imageContainer) {
                        // Clear existing content and add new image
                        imageContainer.innerHTML = '';
                        const newImg = document.createElement('img');
                        newImg.src = event.target.result;
                        newImg.alt = file.name || 'Uploaded Image';
                        newImg.style.maxWidth = '100%';
                        imageContainer.appendChild(newImg);
                    } else {
                        // If no image container exists, create one
                        const newImg = document.createElement('img');
                        newImg.src = event.target.result;
                        newImg.alt = file.name || 'Uploaded Image';
                        newImg.style.maxWidth = '100%';

                        const newImageContainer = document.createElement('div');
                        newImageContainer.className = 'image-container';
                        newImageContainer.appendChild(newImg);

                        // Insert at cursor position
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
            // Find the link input field
            const linkInput = document.querySelector('.promotional-link-input');
            if (linkInput) {
                // Update the link input value
                linkInput.value = url;
                
                // Make link container visible if exists
                const linkContainer = document.querySelector('.promotional-link-container');
                if (linkContainer) {
                    linkContainer.style.display = 'flex';
                }
            } else {
                // Fallback to the default behavior if the link input field doesn't exist
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
                    table += '<td style="padding: 8px; border: 1px solid #ddd;">&nbsp;</td>';
                }
                table += '</tr>';
            }
            table += '</table>';
            document.execCommand('insertHTML', false, table);
        }
    }

    function handleTextColor() {
        if (!contentArea) return;
        
        // Save the current selection
        const selection = window.getSelection();
        if (selection.rangeCount === 0) return;
        
        const range = selection.getRangeAt(0);
        
        const colorPicker = document.createElement('input');
        colorPicker.type = 'color';
        colorPicker.addEventListener('change', function () {
            // First focus the content area
            contentArea.focus();
            
            // Restore the selection
            selection.removeAllRanges();
            selection.addRange(range);
            
            // Then apply the color
            document.execCommand('foreColor', false, this.value);
        });
        colorPicker.click();
    }

    function handleBackgroundColor() {
        if (!contentArea) return;
        
        // Save the current selection
        const selection = window.getSelection();
        if (selection.rangeCount === 0) return;
        
        const range = selection.getRangeAt(0);
        
        const bgColorPicker = document.createElement('input');
        bgColorPicker.type = 'color';
        bgColorPicker.addEventListener('change', function () {
            // First focus the content area
            contentArea.focus();
            
            // Restore the selection
            selection.removeAllRanges();
            selection.addRange(range);
            
            // Apply the color
            document.execCommand('hiliteColor', false, this.value);
        });
        bgColorPicker.click();
    }

    function toggleFullScreen() {
        // Make sure to use a valid selector that exists in your document
        const elem = document.querySelector('.editor-container') || document.documentElement;
        
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
            // Switch to code view
            const htmlContent = contentArea.innerHTML;
            contentArea.textContent = htmlContent;
            contentArea.setAttribute('data-mode', 'code');
            contentArea.style.fontFamily = 'monospace';
            contentArea.style.whiteSpace = 'pre-wrap';
        } else {
            // Switch back to HTML view
            const codeContent = contentArea.textContent;
            contentArea.innerHTML = codeContent;
            contentArea.removeAttribute('data-mode');
            contentArea.style.fontFamily = '';
            contentArea.style.whiteSpace = '';
        }
    }

    function insertCodeBlock() {
        if (!contentArea) return;
        
        // Focus the content area first
        contentArea.focus();
        
        const codeBlock = '<pre style="background-color: #f5f5f5; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace;">' +
            '<code>// Your code here</code></pre>';
        document.execCommand('insertHTML', false, codeBlock);
    }

    function insertPageBreak() {
        if (!contentArea) return;
        
        // Focus the content area first
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

    // Add event listeners to detect changes in the content area
    if (contentArea) {
        contentArea.addEventListener('input', updateWordCount);
        contentArea.addEventListener('paste', function() {
            // Use setTimeout to ensure the pasted content is processed
            setTimeout(updateWordCount, 0);
        });
        contentArea.addEventListener('keyup', updateWordCount);
    }

    function initializeRecipientTable() {
        // Select all checkbox functionality
        const selectAllCheckbox = document.querySelector('.recipients-table thead input[type="checkbox"]');
        const rowCheckboxes = document.querySelectorAll('.recipients-table tbody input[type="checkbox"]');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                rowCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        }

        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (!selectAllCheckbox) return;

                const allChecked = Array.from(rowCheckboxes).every(box => box.checked);
                const anyChecked = Array.from(rowCheckboxes).some(box => box.checked);

                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = anyChecked && !allChecked;
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.promotional-recipients-filters input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const searchText = this.value.toLowerCase();
                const rows = document.querySelectorAll('.recipients-table tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchText) ? '' : 'none';
                });
            });
        }
    }

    function initializePagination() {
        const prevButton = document.querySelector('.pagination button:first-child');
        const nextButton = document.querySelector('.pagination button:last-child');
        if (!prevButton || !nextButton) return;

        let currentPage = 1;
        const totalPages = 3; // Assuming 30 entries with 10 per page

        function updatePagination() {
            const paginationText = document.querySelector('.pagination span');
            if (!paginationText) return;

            const start = ((currentPage - 1) * 10) + 1;
            const end = Math.min(currentPage * 10, 30);
            paginationText.textContent = `${start}-${end} / 30`;

            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages;
        }

        prevButton.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
            }
        });

        nextButton.addEventListener('click', function () {
            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
            }
        });

        updatePagination(); // Initialize pagination
    }

    function initializeLinkContainer() {
        const changeButton = document.querySelector('.promotional-link-container .promotional-link-button:first-child');
        const removeButton = document.querySelector('.promotional-link-container .promotional-link-button:last-child');
        const linkInput = document.querySelector('.promotional-link-input');

        if (changeButton && removeButton && linkInput) {
            changeButton.addEventListener('click', function () {
                const newLink = prompt('Update link:', linkInput.value);
                if (newLink) {
                    linkInput.value = newLink;
                }
            });

            removeButton.addEventListener('click', function () {
                if (confirm('Remove this link?')) {
                    const linkContainer = document.querySelector('.promotional-link-container');
                    if (linkContainer) {
                        linkContainer.style.display = 'none';
                    }
                }
            });
        }
        
        // Also initialize any standalone link buttons
        let insertLinkBtn = document.getElementById("insertLinkBtn");
        let removeLinkBtn = document.getElementById("removeLink");
        let insertedLink = document.getElementById("insertedLink");
        let linkContainer = document.getElementById("linkContainer");

        if (insertLinkBtn && insertedLink && linkContainer) {
            // Handle link insertion
            insertLinkBtn.addEventListener("click", function () {
                let link = prompt("Enter the link:");

                if (link) {
                    // Ensure the link has "http://" or "https://"
                    if (!link.startsWith("http://") && !link.startsWith("https://")) {
                        link = "https://" + link;
                    }

                    insertedLink.href = link;
                    insertedLink.textContent = link;
                    linkContainer.style.display = "flex"; // Show the inserted link
                }
            });
        }

        if (removeLinkBtn && linkContainer) {
            // Handle link removal
            removeLinkBtn.addEventListener("click", function () {
                linkContainer.style.display = "none"; // Hide link container
                insertedLink.textContent = "Inserted Link"; // Reset text
                insertedLink.removeAttribute("href"); // Remove href
            });
        }
    }

 function handleLinkInsertion() {
    const url = prompt('Enter URL:', 'https://');
    if (url) {
        const linkInput = document.querySelector('.link-input');
        if (linkInput) {
            linkInput.value = url;
            const linkContainer = document.querySelector('.promotional-link-container');
            if (linkContainer) {
                linkContainer.style.display = 'flex';
            }
        } else {
            document.execCommand('createLink', false, url);
        }
    }
}

const changeButton = document.querySelector('.link-button:first-child');
const removeButton = document.querySelector('.link-button:last-child');
const linkInput = document.querySelector('.link-input');
const linkContainer = document.querySelector('.promotional-link-container');

if (changeButton) {
    changeButton.addEventListener('click', handleLinkInsertion);
}

if (removeButton) {
    removeButton.addEventListener('click', function () {
        if (linkInput) {
            linkInput.value = '';
        }
        if (linkContainer) {
            linkContainer.style.display = 'none';
        }
    });
}

function handleAttachment() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = '.pdf,.doc,.docx'; // Restrict file types to PDF and DOC only
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

            // Determine icon based on file type
            let iconClass = file.type.includes('pdf') ? 'fa-file-pdf' : 'fa-file-word';

            // Format file size
            let fileSize = file.size < 1024 ? file.size + ' B' : file.size < 1024 * 1024 ? Math.round(file.size / 1024) + ' KB' : Math.round(file.size / (1024 * 1024) * 10) / 10 + ' MB';

            fileElement.innerHTML = `
                <i class="fas ${iconClass} file-icon"></i>
                <span>${file.name}</span>
                <span>(${fileSize})</span>
                <i class="fas fa-times remove-file"></i>
            `;

            attachmentSection.appendChild(fileElement);

            // Add event listener to remove button
            fileElement.querySelector('.remove-file').addEventListener('click', function () {
                fileElement.remove();
            });
        }
    };
    input.click();
}

    // Save draft functionality
    function saveDraft() {
        if (!contentArea) return;
        
        const content = contentArea.innerHTML;

        // In a real application, this would save to a database or localStorage
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


</script>


           



  

    </body>
    </html>