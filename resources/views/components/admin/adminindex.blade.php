<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/nbfc.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Inter:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Container Visibility */
        .inbox-container {
            display: none;
        }
        .inbox-container.active {
            display: block !important;
        }
        .message-thread {
            display: none;
        }
        .message-thread.active {
            display: block !important;
        }

        /* Loan Proposals Styles */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .studentdashboardprofile-loanproposals {
            margin: 25px 0;
            box-shadow: 0px 8px 20px 0px rgba(26, 2, 57, 0.03);
            background-color: #fff;
            padding-bottom: 1.5rem;
        }
        .studentdashboardprofile-loanproposals .loanproposals-header {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #E98635;
            padding: 1rem 1.8rem;
        }
        .loanproposals-loanstatuscards {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 0 1.8rem;
        }
        .indivudalloanstatus-cards {
            padding: 1rem 1.8rem;
            border-top: 1px solid #E5E5E5;
        }
        .individual-bankname h1 {
            font-size: 14px;
            font-weight: 600;
            color: #5D5C5C;
            margin: 0;
        }
        .messageinputnbfcids {
            font-size: 14px;
            font-weight: 500;
            color: #909090;
        }
        .individual-bankmessages {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-width: 100%; /* Ensure full width for layout */
        }
        .individual-bankmessages p {
            font-size: 14px;
            font-weight: 500;
            color: #909090;
            max-width: 370px;
        }
        .triggeredbutton {
            display: block !important; /* Ensure Message button is visible */
            width: 109px;
            height: 35px;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            color: #FFF;
            background-color: #6F25CE;
            border: none;
            cursor: pointer;
        }
        .messages-wrapper {
            display: none;
            flex-direction: column;
            width: 100%;
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            overflow-y: auto;
            max-height: 300px;
            background: #FFF;
            margin-bottom: 10px;
        }
        .messages-wrapper div[data-message-id] {
            display: flex;
            margin-bottom: 10px;
        }
        .messages-wrapper div[data-message-id] div {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 8px;
            background-color: #FFF;
            word-wrap: break-word;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .messages-wrapper div[data-message-id][style*="flex-end"] div {
            background-color: #DCF8C6;
        }
        .individual-bankmessage-input {
            display: none;
            height: 35px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .input-wrapper {
            position: relative;
            flex: 1;
        }
        .individual-bankmessage-input input {
            width: 100%;
            height: 100%;
            padding: 8px 40px 8px 12px;
            border-radius: 4px;
            border: 1px solid #E2E2E2;
            font-family: 'Poppins', sans-serif;
            color: #909090;
            box-sizing: border-box;
        }
        .individual-bankmessage-input input::placeholder {
            font-size: 14px;
            font-weight: 500;
            color: #6F25CE;
        }
        .individual-bankmessage-input .send-img {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            cursor: pointer;
        }
        .individual-bankmessage-input i {
            font-size: 1.2rem;
            color: #BBBBBB;
            cursor: pointer;
        }
        .clear-chat-container {
            display: none;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .clear-chat-container button {
            background-color: #F0F0F0;
            border: none;
            border-radius: 4px;
            padding: 6px 20px;
            font-size: 12px;
            color: #666;
            cursor: pointer;
        }
        .emoji-picker {
            position: absolute;
            bottom: 45px;
            right: 0;
            background: #FFF;
            border: 1px solid #DDD;
            border-radius: 5px;
            padding: 5px;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .emoji-picker button {
            border: none;
            background: none;
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @php
    @endphp

    <div class="admin-index-section-main-container" id="index-section-admin-id">
        <section class="index-section" id="index-section-id">
            <div class="admin-index-main-sub-container">
                <div class="admin-index-heading-index">
                    <h1>Index</h1>
                </div>
                <div class="admin-index-main-container">
                    <div class="admin-index-item active" data-target="inbox-container">
                        <img src="assets/images/student-logo.png" alt="" class="admin-index-icon">
                        <span>Students</span>
                        <span class="admin-index-count" id="student-index-count">06</span>
                    </div>
                    <div class="admin-index-item" data-target="nbfc-container">
                        <img src="assets/images/nbfc-icon.png" alt="" class="admin-index-icon">
                        <span>NBFCs</span>
                        <span class="admin-index-count admin-index-count-gray" id="nbfc-index-count">00</span>
                    </div>
                </div>

                <div class="mobile-inbox-container">
                    <span class="mobile-inbox-item active" data-target="inbox-container">Students</span>
                    <span class="mobile-inbox-item" data-target="nbfc-container">NBFCs</span>
                </div>
            </div>

            <!-- Students Container -->
            <div class="inbox-container active" id="inbox-container">
                <div class="inbox-header">
                    <h2 class="dashboard-section-index">Student</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="admin-search-container-id">
                            <svg class="admin-nav-search-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" class="index-search-input" id="admin-search-input-id" placeholder="Search">
                        </div>
                        <div class="admin-inbox-filters" id="admin-index-sort-id">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="admin-sort-dropdown">
                                <li data-sort="az">A-Z</li>
                                <li data-sort="za">Z-A</li>
                                <li data-sort="newest">Newest</li>
                                <li data-sort="oldest">Oldest</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Loan Proposals -->
                <div class="studentdashboardprofile-loanproposals" id="admin-loanproposals">
                    <h1 class="loanproposals-header" id="admin-loanproposalsheader">Loan Proposals</h1>
                    <div class="loanproposals-loanstatuscards" id="admin-loanstatuscards">
                        <!-- Cards will be inserted here -->
                    </div>
                </div>
            </div>

            <!-- NBFCs Container -->
            <div class="inbox-container" id="nbfc-container">
                <div class="inbox-header">
                    <h2 class="dashboard-section-index">NBFCs</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="admin-search-container-nbfc-id">
                            <svg class="admin-nav-search-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" class="index-search-input" id="admin-search-input-nbfc-id" placeholder="Search">
                        </div>
                        <div class="admin-inbox-filters" id="admin-index-sort-nbfc-id">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="admin-sort-dropdown">
                                <li data-sort="az">A-Z</li>
                                <li data-sort="za">Z-A</li>
                                <li data-sort="newest">Newest</li>
                                <li data-sort="oldest">Oldest</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="message-thread" id="message-thread-nbfc-id">
                    <div class="message-item">
                        <div class="message-header">
                            <h2 class="index-bank-name">NBFC Name</h2>
                            <div class="message-actions">
                                <button class="admin-inbox-btn-view">View</button>
                                <button class="admin-inbox-btn-close">Close</button>
                            </div>
                        </div>
                        <p class="message-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.
                        </p>
                    </div>
                    <div class="message-response">
                        <div class="message-response-container">
                            <p class="message-content-container">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                            <ol class="message-list">
                                <li>consectetur adipiscing elit.</li>
                                <li>eiusmod tempor incididunt ut.</li>
                            </ol>
                        </div>
                        <div class="admin-individual-bankmessage-input">
                            <input type="text" placeholder="Send message" class="admin-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
                    </div>
                </div>

                <div class="index-student-details-container" id="index-nbfc-details-container-admin-id">
                    <div class="index-student-message-container" id="index-nbfc-message-container-id">
                        <div class="index-student-card" id="index-nbfc-card-id">
                            <div class="index-student-info" id="index-nbfc-info-id">
                                <h3 class="index-bank-name">NBFC Name</h3>
                                <p class="index-student-description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                                </p>
                            </div>
                            <div class="index-student-button-group">
                                <button class="index-student-message-btn">Message</button>
                                <button class="index-student-view-btn">View</button>
                            </div>
                            <div class="index-student-send-btn-mobile">
                                <img src="assets/images/send-index-btn.png" alt="the send image">
                            </div>
                        </div>
                        <div class="nbfc-individual-bankmessage-input-message" id="nbfc-individual-nbfc-message-input-message-id">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');

            // NBFC Names Array
            const nbfcNames = [
                'Bajaj Finance', 'Mahindra Finance', 'Tata Capital',
                'HDB Financial', 'Shriram Finance', 'Aditya Birla Finance'
            ];

            // Randomization Function
            function getRandomName(namesArray) {
                return namesArray[Math.floor(Math.random() * namesArray.length)];
            }

            // Randomize Names for NBFC Container
            function randomizeNames(containerId, namesArray, nameClass) {
                const containers = document.querySelectorAll(`#${containerId} .${nameClass}`);
                // console.log(`Randomizing names for ${containerId}: Found ${containers.length} elements`); // Debug
                const usedNames = new Set();
                containers.forEach(element => {
                    let name;
                    do {
                        name = getRandomName(namesArray);
                    } while (usedNames.has(name));
                    usedNames.add(name);
                    element.textContent = name;
                });
            }

            // Initialize Names for NBFCs
            randomizeNames('nbfc-container', nbfcNames, 'index-bank-name');

            // Generate Loan Proposal Cards for Students Section
            const bankListedThroughNBFC = () => {
                const nbfcContainer = document.querySelector("#admin-loanstatuscards");
                if (!nbfcContainer) {
                    console.error("Error: Loan proposals container (#admin-loanstatuscards) not found");
                    return;
                }

                const mockData = [
                    { nbfc_id: "NBFC60763601", nbfc_name: "Systech", status: "Accepted" },
                    { nbfc_id: "NBFC99691738", nbfc_name: "Gaino", status: "Accepted" },
                    { nbfc_id: "NBFC24832503", nbfc_name: "Subway", status: "Rejected" }
                ];

                nbfcContainer.innerHTML = '';
                mockData.forEach((item, index) => {
                    const card = document.createElement('div');
                    card.className = 'indivudalloanstatus-cards';
                    card.id = `admin-card-${index}`;
                    card.dataset.nbfcId = item.nbfc_id;
                    card.innerHTML = `
                        <div class="individual-bankname" id="admin-bankname-${index}">
                            <h1 class="index-bank-name">${item.nbfc_name}</h1>
                            <p class="messageinputnbfcids" id="admin-nbfcid-${index}">${item.nbfc_id}</p>
                        </div>
                        <div class="individual-bankmessages" id="admin-bankmessages-${index}">
                            <p class="index-student-description">Lorem ipsum dolor sit amet...</p>
                            <button class="triggeredbutton index-student-message-btn" id="admin-messagebutton-${index}">Message</button>
                        </div>
                        <div class="clear-chat-container" id="admin-clearchat-${index}">
                            <button id="admin-clearchatbutton-${index}">Clear Chat</button>
                        </div>
                        <div class="messages-wrapper" id="admin-messageswrapper-${index}" data-chat-id="loan-chat-${index}"></div>
                        <div class="individual-bankmessage-input" id="admin-messageinput-${index}" data-chat-id="loan-chat-${index}">
                            <div class="input-wrapper" id="admin-inputwrapper-${index}">
                                <input type="text" id="admin-inputfield-${index}" placeholder="Send message">
                                <img class="send-img" id="admin-sendicon-${index}" src="assets/images/send-nbfc.png" alt="Send">
                            </div>
                            <i class="fa-solid fa-paperclip" id="admin-attachicon-${index}"></i>
                            <i class="fa-regular fa-face-smile" id="admin-emojiicon-${index}"></i>
                        </div>
                    `;
                    nbfcContainer.appendChild(card);
                });

                initializeChatFunctionality();
            };

            // Initialize Chat Functionality for Loan Proposals
            function initializeChatFunctionality() {
                const studentId = 'STUDENT123';
                const cards = document.querySelectorAll('[id^="admin-card-"]');

                if (!cards.length) {
                    console.error("Error: No loan proposal cards found");
                    return;
                }

                cards.forEach((card, index) => {
                    const nbfcId = document.querySelector(`#admin-nbfcid-${index}`)?.textContent;
                    const chatId = `loan-chat-${index}`;
                    const messagesWrapper = document.querySelector(`#admin-messageswrapper-${index}`);
                    const chatInputContainer = document.querySelector(`#admin-messageinput-${index}`);
                    const messageInput = document.querySelector(`#admin-inputfield-${index}`);
                    const sendButton = document.querySelector(`#admin-sendicon-${index}`);
                    const emojiButton = document.querySelector(`#admin-emojiicon-${index}`);
                    const attachButton = document.querySelector(`#admin-attachicon-${index}`);
                    const triggerButton = document.querySelector(`#admin-messagebutton-${index}`);
                    const clearButton = document.querySelector(`#admin-clearchatbutton-${index}`);
                    const bankMessagesContainer = document.querySelector(`#admin-bankmessages-${index}`);

                    if (!nbfcId || !messagesWrapper || !chatInputContainer || !messageInput || !sendButton || !bankMessagesContainer || !triggerButton || !clearButton) {
                        console.error(`Error: Missing elements in card ${index}`);
                        return;
                    }

                    // Initial state
                    bankMessagesContainer.style.display = 'flex';
                    chatInputContainer.style.display = 'none';
                    messagesWrapper.style.display = 'none';
                    document.querySelector(`#admin-clearchat-${index}`).style.display = 'none';
                    triggerButton.style.display = 'block'; // Ensure Message button is visible

                    // Toggle chat
                    triggerButton.addEventListener('click', () => {
                        console.log(`Toggling chat for ${nbfcId} (chat ID: ${chatId})`);
                        const isHidden = messagesWrapper.style.display === 'none' || !messagesWrapper.style.display;
                        if (isHidden) {
                            messagesWrapper.style.display = 'flex';
                            chatInputContainer.style.display = 'flex';
                            document.querySelector(`#admin-clearchat-${index}`).style.display = 'flex';
                            triggerButton.textContent = 'Close';
                        } else {
                            messagesWrapper.style.display = 'none';
                            chatInputContainer.style.display = 'none';
                            document.querySelector(`#admin-clearchat-${index}`).style.display = 'none';
                            triggerButton.textContent = 'Message';
                        }
                        bankMessagesContainer.style.display = 'flex';
                    });

                    // Send message
                    const sendMessage = () => {
                        const message = messageInput.value.trim();
                        if (!message) return;

                        console.log("Sending message:", { studentId, nbfcId, message });

                        const messageElement = document.createElement('div');
                        const messageId = `admin-message-${Date.now()}`;
                        messageElement.id = messageId;
                        messageElement.dataset.messageId = messageId;
                        messageElement.style.cssText = 'display: flex; justify-content: flex-end; margin-bottom: 10px;';
                        messageElement.innerHTML = `
                            <div style="max-width: 80%; padding: 8px 12px; border-radius: 8px; background-color: #DCF8C6; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
                                ${message}
                            </div>
                        `;
                        messagesWrapper.appendChild(messageElement);
                        messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                        messageInput.value = '';
                    };

                    messageInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') sendMessage();
                    });

                    sendButton.addEventListener('click', sendMessage);

                    // Emoji picker
                    emojiButton.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const existingPicker = document.querySelector(`#admin-emojipicker-${index}`);
                        if (existingPicker) {
                            existingPicker.remove();
                            return;
                        }

                        const picker = document.createElement('div');
                        picker.className = 'emoji-picker';
                        picker.id = `admin-emojipicker-${index}`;
                        const emojis = ['😊', '👍', '😀', '🙂', '👋', '❤️', '👌', '✨'];
                        emojis.forEach((emoji, emojiIndex) => {
                            const btn = document.createElement('button');
                            btn.id = `admin-emoji-${index}-${emojiIndex}`;
                            btn.textContent = emoji;
                            btn.addEventListener('click', () => {
                                messageInput.value += emoji;
                                picker.remove();
                                messageInput.focus();
                            });
                            picker.appendChild(btn);
                        });

                        chatInputContainer.appendChild(picker);
                        document.addEventListener('click', () => picker.remove(), { once: true });
                    });

                    // File attachment
                    attachButton.addEventListener('click', () => {
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.accept = '.pdf,.jpeg,.png,.jpg';
                        fileInput.style.display = 'none';

                        fileInput.addEventListener('change', () => {
                            const file = fileInput.files[0];
                            if (file) {
                                const fileName = file.name;
                                const messageElement = document.createElement('div');
                                const messageId = `admin-message-${Date.now()}`;
                                messageElement.id = messageId;
                                messageElement.dataset.messageId = messageId;
                                messageElement.style.cssText = 'display: flex; justify-content: flex-end; margin-bottom: 10px;';
                                messageElement.innerHTML = `
                                    <div style="max-width: 80%; padding: 8px 12px; border-radius: 8px; background-color: #DCF8C6; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
                                        <a href="#" style="color: #666; text-decoration: none;"><i class="fa-solid fa-file"></i> ${fileName}</a>
                                    </div>
                                `;
                                messagesWrapper.appendChild(messageElement);
                                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                            }
                        });

                        document.body.appendChild(fileInput);
                        fileInput.click();
                        document.body.removeChild(fileInput);
                    });

                    // Clear chat
                    clearButton.addEventListener('click', () => {
                        messagesWrapper.innerHTML = '<div style="text-align: center; color: #666; font-style: italic;">Chat cleared</div>';
                        setTimeout(() => {
                            messagesWrapper.innerHTML = '';
                        }, 2000);
                    });
                });
            }

            // Toggle Containers
            const indexItems = document.querySelectorAll('.admin-index-item');
            const mobileItems = document.querySelectorAll('.mobile-inbox-item');
            const containers = document.querySelectorAll('.inbox-container');

            function toggleContainer(targetId) {
                containers.forEach(container => {
                    container.classList.remove('active');
                    container.style.display = 'none';
                });

                const targetContainer = document.getElementById(targetId);
                if (targetContainer) {
                    targetContainer.classList.add('active');
                    targetContainer.style.display = 'block';
                    // console.log(`Showing container: ${targetId}`); // Debug
                } else {
                    console.error(`Container with ID ${targetId} not found`); // Debug
                }

                indexItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-target') === targetId);
                });

                mobileItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-target') === targetId);
                });
            }

            toggleContainer('inbox-container');

            indexItems.forEach(item => {
                item.addEventListener('click', function() {
                    toggleContainer(this.getAttribute('data-target'));
                });
            });

            mobileItems.forEach(item => {
                item.addEventListener('click', function() {
                    toggleContainer(this.getAttribute('data-target'));
                });
            });

            // View and Close Button Functionality for NBFCs
            function setupViewCloseButtons(containerId, messageThreadId) {
                const messageThread = document.getElementById(messageThreadId);
                const viewButton = messageThread.querySelector('.admin-inbox-btn-view');
                const closeButton = messageThread.querySelector('.admin-inbox-btn-close');

                if (viewButton) {
                    viewButton.addEventListener('click', function() {
                        messageThread.classList.add('active');
                        messageThread.style.display = 'block';
                    });
                }

                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        messageThread.classList.remove('active');
                        messageThread.style.display = 'none';
                    });
                }
            }

            setupViewCloseButtons('nbfc-container', 'message-thread-nbfc-id');

            // Search Functionality
            function setupSearch(containerId, searchInputId, cardContainerId, messageThreadId) {
                const searchInput = document.getElementById(searchInputId);
                let studentCards, messageThread;

                if (containerId === 'inbox-container') {
                    studentCards = document.querySelectorAll(`#${cardContainerId} .indivudalloanstatus-cards`);
                } else {
                    studentCards = document.querySelectorAll(`#${cardContainerId} .index-student-message-container`);
                    messageThread = document.getElementById(messageThreadId);
                }

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value.toLowerCase().trim();

                        studentCards.forEach(card => {
                            const name = card.querySelector('.index-bank-name').textContent.toLowerCase();
                            const description = card.querySelector('.index-student-description').textContent.toLowerCase();

                            if (name.includes(searchTerm) || description.includes(searchTerm)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });

                        if (messageThread) {
                            const nameInThread = messageThread.querySelector('.index-bank-name');
                            const messageContent = messageThread.querySelector('.message-content');
                            const messageResponseContent = messageThread.querySelector('.message-content-container');
                            const messageList = messageThread.querySelector('.message-list');

                            let isVisible = false;
                            if (nameInThread && messageContent && messageResponseContent && messageList) {
                                const nameText = nameInThread.textContent.toLowerCase();
                                const messageText = messageContent.textContent.toLowerCase();
                                const responseText = messageResponseContent.textContent.toLowerCase();
                                const listItems = Array.from(messageList.querySelectorAll('li'))
                                    .map(li => li.textContent.toLowerCase());

                                if (
                                    nameText.includes(searchTerm) ||
                                    messageText.includes(searchTerm) ||
                                    responseText.includes(searchTerm) ||
                                    listItems.some(item => item.includes(searchTerm))
                                ) {
                                    messageThread.classList.add('active');
                                    messageThread.style.display = 'block';
                                    isVisible = true;
                                } else {
                                    messageThread.classList.remove('active');
                                    messageThread.style.display = 'none';
                                }
                            }
                        }
                    });
                }
            }

            setupSearch(
                'inbox-container',
                'admin-search-input-id',
                'admin-loanstatuscards',
                null
            );
            setupSearch(
                'nbfc-container',
                'admin-search-input-nbfc-id',
                'index-nbfc-details-container-admin-id',
                'message-thread-nbfc-id'
            );

            // Sort Functionality
            function setupSort(containerId, sortTriggerId, detailsContainerId, messageThreadId) {
                const sortTrigger = document.querySelector(`#${sortTriggerId}`);
                if (!sortTrigger) return;

                const sortDropdown = sortTrigger.querySelector('.admin-sort-dropdown');
                const sortOptions = sortDropdown.querySelectorAll('li');
                const studentDetailsContainer = document.getElementById(detailsContainerId);

                sortTrigger.addEventListener('click', function(event) {
                    event.stopPropagation();
                    sortDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function() {
                    sortDropdown.classList.remove('active');
                });

                sortDropdown.addEventListener('click', function(event) {
                    event.stopPropagation();
                });

                sortOptions.forEach(option => {
                    option.addEventListener('click', function() {
                        const sortType = this.getAttribute('data-sort');
                        let cards;
                        if (containerId === 'inbox-container') {
                            cards = Array.from(studentDetailsContainer.querySelectorAll('.indivudalloanstatus-cards'));
                        } else {
                            cards = Array.from(studentDetailsContainer.querySelectorAll('.index-student-message-container'));
                        }

                        const sortedCards = cards.sort((a, b) => {
                            const nameA = a.querySelector('.index-bank-name').textContent;
                            const nameB = b.querySelector('.index-bank-name').textContent;
                            const descriptionA = a.querySelector('.index-student-description').textContent;
                            const descriptionB = a.querySelector('.index-student-description').textContent;

                            switch(sortType) {
                                case 'az':
                                    return nameA.localeCompare(nameB);
                                case 'za':
                                    return nameB.localeCompare(nameA);
                                case 'newest':
                                    return descriptionA.length - descriptionB.length;
                                case 'oldest':
                                    return descriptionB.length - descriptionA.length;
                                default:
                                    return 0;
                            }
                        });

                        studentDetailsContainer.innerHTML = '';
                        sortedCards.forEach(card => studentDetailsContainer.appendChild(card));

                        const messageThread = document.getElementById(messageThreadId);
                        if (messageThread && sortedCards[0]) {
                            const messageName = messageThread.querySelector('.index-bank-name');
                            if (messageName) {
                                messageName.textContent = sortedCards[0].querySelector('.index-bank-name').textContent;
                            }
                        }

                        sortDropdown.classList.remove('active');
                    });
                });
            }

            setupSort(
                'inbox-container',
                'admin-index-sort-id',
                'admin-loanstatuscards',
                null
            );
            setupSort(
                'nbfc-container',
                'admin-index-sort-nbfc-id',
                'index-nbfc-details-container-admin-id',
                'message-thread-nbfc-id'
            );

            // Message Button Functionality
            function setupMessageButtons(containerId) {
                const messageButtons = document.querySelectorAll(`#${containerId} .index-student-message-btn`);
                messageButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        console.log(`Message button clicked in ${containerId}`);
                        const messageContainer = this.closest('.index-student-message-container') || this.closest('.indivudalloanstatus-cards');
                        const messageInput = messageContainer.querySelector('.nbfc-individual-bankmessage-input-message') || messageContainer.querySelector('.individual-bankmessage-input');
                        if (messageInput) {
                            document.querySelectorAll(`#${containerId} .nbfc-individual-bankmessage-input-message, #${containerId} .individual-bankmessage-input`).forEach(input => {
                                input.style.display = 'none';
                            });
                            messageInput.style.display = messageInput.style.display === 'flex' ? 'none' : 'flex';
                        }
                    });
                });
            }

            setupMessageButtons('inbox-container');
            setupMessageButtons('nbfc-container');

            // Card View Button Functionality for NBFCs only
            function setupCardViewButtons(containerId, messageThreadId) {
                if (containerId === 'inbox-container') return; // Skip Students section
                const viewButtons = document.querySelectorAll(`#${containerId} .index-student-view-btn`);
                const messageThread = document.getElementById(messageThreadId);

                viewButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        console.log(`Card view button clicked in ${containerId}`);
                        if (messageThread) {
                            messageThread.classList.add('active');
                            messageThread.style.display = 'block';
                            const card = this.closest('.index-student-card');
                            const bankName = card.querySelector('.index-bank-name').textContent;
                            messageThread.querySelector('.index-bank-name').textContent = bankName;
                        }
                    });
                });
            }

            setupCardViewButtons('nbfc-container', 'message-thread-nbfc-id');

            // Initialize Loan Proposals
            bankListedThroughNBFC();
        });
    </script>
</body>
</html>