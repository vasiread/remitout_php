<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Index</title>
    <link rel="stylesheet" href="assets/css/nbfc.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @extends('layouts.app')

    @php
    // Laravel PHP logic can be added here
    @endphp

    <div class="admin-index-section-main-container" id="index-section-admin-id">
        <section class="index-section" id="index-section-id">
            <div class="admin-index-main-sub-container">
                <div class="admin-index-heading-index">
                    <h1>Index</h1>
                </div>
                <div class="admin-index-main-container">
                    <div class="admin-index-item active">
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

                    <span class="mobile-inbox-item active">Students</span>
                    <span class="mobile-inbox-item">NBFCs</span>

                </div>
            </div>

            <div class="inbox-container" id="index-container-id">
                <div class="inbox-header" id="admin-index-header">
                    <h2 class="dashboard-section-index">Student</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="admin-search-container-id">
                            <img src="assets/images/search.png" alt="Search" class="index-search-icon">
                            <input type="text" class="index-search-input" id="admin-search-input-id" placeholder="Search">
                        </div>
                        <div class="admin-inbox-filters" id="admin-index-sort-id">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="admin-sort-dropdown" id="admin-index-sort-id">
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

        </section>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sample student data
        const students = [
            { id: 'STU001', name: 'John Doe', nbfc: 'Bank of Baroda', nbfcId: 'NBFC60763601', description: 'Lorem ipsum dolor sit amet...' },
            { id: 'STU002', name: 'Jane Smith', nbfc: 'HDFC Bank', nbfcId: 'NBFC99691738', description: 'Consectetur adipiscing elit...' },
            { id: 'STU003', name: 'Alice Johnson', nbfc: 'ICICI Bank', nbfcId: 'NBFC24832503', description: 'Sed do eiusmod tempor...' }
        ];

        // Store messages in memory for frontend
        const adminChatMessages = {};

        // Function to generate unique chat ID
        function generateAdminChatId(studentId, nbfcId) {
            return `admin-chat-${studentId}-${nbfcId}`;
        }

        // Function to initialize admin chat
        function initializeAdminChat() {
            const container = document.querySelector('#index-student-details-container-admin-id');
            if (!container) return;

            // Clear existing cards
            container.innerHTML = '';

            // Generate cards dynamically
            students.forEach((student, index) => {
                const chatId = generateAdminChatId(student.id, student.nbfcId);
                const card = document.createElement('div');
                card.classList.add('indivudalloanstatus-cards');
                card.setAttribute('data-card-id', `admin-card-${student.id}`);
                card.innerHTML = `
                    <div class="individual-bankname">
                        <h1>${student.name}</h1>
                        <p class="messageinputnbfcids">${student.nbfcId}</p>
                    </div>
                    <div class="individual-bankmessages">
                        <p>${student.description}</p>
                        <button class="triggeredbutton" data-button-id="admin-button-${chatId}">Message</button>
                    </div>
                    <div style="display: none; justify-content: flex-end; width: 100%; margin-bottom: 10px;" id="admin-clear-container-${chatId}">
                        <button style="background-color: rgb(240, 240, 240); border: none; border-radius: 4px; padding: 6px 20px; font-size: 12px; color: rgb(102, 102, 102); cursor: pointer; font-family: Poppins, sans-serif;" id="admin-clear-button-${chatId}">Clear Chat</button>
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
                    <div class="messages-wrapper" data-chat-id="${chatId}" id="admin-messages-${chatId}" style="display: none;"></div>
                    <div class="individual-bankmessage-input" data-chat-id="${chatId}" id="admin-input-${chatId}" style="display: none;">
                        <input placeholder="Send message" type="text" id="admin-input-field-${chatId}">
                        <img class="send-img" src="assets/images/send.png" alt="Send" id="admin-send-${chatId}">
                        <i class="fa-solid fa-paperclip" id="admin-paperclip-${chatId}"></i>
                        <i class="fa-regular fa-face-smile" id="admin-smile-${chatId}"></i>
                    </div>
                `;
                container.appendChild(card);

                // Add keydown event listener for Enter key
                const messageInput = card.querySelector(`#admin-input-field-${chatId}`);
                messageInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendMessage(chatId, messageInput.value, card);
                    }
                });
            });

            // Use event delegation for dynamic buttons
            document.querySelector('#index-student-details-container-admin-id').addEventListener('click', (e) => {
                if (e.target.classList.contains('triggeredbutton')) {
                    const parentContainer = e.target.closest('.indivudalloanstatus-cards');
                    const chatId = parentContainer.querySelector('.individual-bankmessage-input').getAttribute('data-chat-id');
                    const messagesWrapper = parentContainer.querySelector(`.messages-wrapper[data-chat-id="${chatId}"]`);
                    const chatContainer = parentContainer.querySelector(`.individual-bankmessage-input[data-chat-id="${chatId}"]`);
                    const clearButtonContainer = parentContainer.querySelector(`#admin-clear-container-${chatId}`);

                    if (messagesWrapper.style.display === 'none') {
                        console.log('Showing chat for', chatId);
                        messagesWrapper.style.display = 'flex';
                        chatContainer.style.display = 'flex';
                        clearButtonContainer.style.display = 'flex';
                        parentContainer.style.height = 'auto';
                        e.target.textContent = 'Close';
                        displayMessages(chatId, messagesWrapper);
                        scrollToBottom(messagesWrapper);
                    } else {
                        console.log('Hiding chat for', chatId);
                        messagesWrapper.style.display = 'none';
                        chatContainer.style.display = 'none';
                        clearButtonContainer.style.display = 'none';
                        parentContainer.style.height = 'fit-content';
                        e.target.textContent = 'Message';
                    }
                }

                if (e.target.id === `admin-send-${e.target.id.split('admin-send-')[1]}`) {
                    const chatId = e.target.id.split('admin-send-')[1];
                    const parentContainer = e.target.closest('.indivudalloanstatus-cards');
                    const messageInput = parentContainer.querySelector(`#admin-input-field-${chatId}`);
                    sendMessage(chatId, messageInput.value, parentContainer);
                }

                if (e.target.id === `admin-clear-button-${e.target.id.split('admin-clear-button-')[1]}`) {
                    const chatId = e.target.id.split('admin-clear-button-')[1];
                    const parentContainer = e.target.closest('.indivudalloanstatus-cards');
                    clearChat(chatId, parentContainer);
                }

                if (e.target.id === `admin-smile-${e.target.id.split('admin-smile-')[1]}`) {
                    const chatId = e.target.id.split('admin-smile-')[1];
                    const parentContainer = e.target.closest('.indivudalloanstatus-cards');
                    const chatContainer = parentContainer.querySelector(`#admin-input-${chatId}`);
                    const messageInput = parentContainer.querySelector(`#admin-input-field-${chatId}`);
                    toggleEmojiPicker(chatId, chatContainer, messageInput);
                }

                if (e.target.id === `admin-paperclip-${e.target.id.split('admin-paperclip-')[1]}`) {
                    const chatId = e.target.id.split('admin-paperclip-')[1];
                    const parentContainer = e.target.closest('.indivudalloanstatus-cards');
                    handleFileUpload(chatId, parentContainer);
                }
            });
        }


                indexItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-target') === targetId);
                });

                mobileItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-target') === targetId);

        function sendMessage(chatId, content, parentContainer) {
            if (!content.trim()) return;
            const messageId = `msg-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
            if (!adminChatMessages[chatId]) adminChatMessages[chatId] = [];
            adminChatMessages[chatId].push({
                id: messageId,
                sender_id: 'ADMIN',
                message: content,
                timestamp: new Date().toISOString()
            });
            const messageInput = parentContainer.querySelector(`#admin-input-field-${chatId}`);
            messageInput.value = '';
            const messagesWrapper = parentContainer.querySelector(`#admin-messages-${chatId}`);
            const chatContainer = parentContainer.querySelector(`#admin-input-${chatId}`);
            const clearButtonContainer = parentContainer.querySelector(`#admin-clear-container-${chatId}`);
            const messageButton = parentContainer.querySelector(`[data-button-id="admin-button-${chatId}"]`);
            messagesWrapper.style.display = 'flex';
            chatContainer.style.display = 'flex';
            clearButtonContainer.style.display = 'flex';
            parentContainer.style.height = 'auto';
            messageButton.textContent = 'Close';
            displayMessages(chatId, messagesWrapper);
            scrollToBottom(messagesWrapper);
        }

        function displayMessages(chatId, messagesWrapper) {
            messagesWrapper.innerHTML = '';
            if (adminChatMessages[chatId]) {
                adminChatMessages[chatId].forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.setAttribute('data-message-id', message.id);
                    messageElement.style.cssText = `
                        display: flex;
                        justify-content: ${message.sender_id === 'ADMIN' ? 'flex-end' : 'flex-start'};
                        width: 100%;
                        margin-bottom: 10px;
                    `;
                    const messageContent = document.createElement('div');
                    messageContent.style.cssText = `
                        max-width: 80%;
                        padding: 8px 12px;
                        border-radius: 8px;
                        background-color: ${message.sender_id === 'ADMIN' ? '#DCF8C6' : '#FFF'};
                        word-wrap: break-word;
                        font-family: 'Poppins', sans-serif;
                        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                    `;
                    messageContent.textContent = message.message;
                    messageElement.appendChild(messageContent);
                    messagesWrapper.appendChild(messageElement);
                });
            }
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

        function clearChat(chatId, parentContainer) {
            const messagesWrapper = parentContainer.querySelector(`#admin-messages-${chatId}`);
            messagesWrapper.innerHTML = '';
            adminChatMessages[chatId] = [];
            localStorage.removeItem(`admin-file-messages-${chatId}`);
            const fileStorage = parentContainer.__fileStorage || {};
            Object.keys(fileStorage).forEach(key => delete fileStorage[key]);
            parentContainer.__fileStorage = fileStorage;
            const confirmationMsg = document.createElement('div');
            confirmationMsg.style.cssText = `
                width: 100%;
                text-align: center;
                padding: 10px;
                color: #666;
                font-style: italic;
                font-size: 12px;
            `;
            confirmationMsg.textContent = 'Chat history cleared';
            messagesWrapper.appendChild(confirmationMsg);
            setTimeout(() => {
                if (messagesWrapper.contains(confirmationMsg)) {
                    messagesWrapper.removeChild(confirmationMsg);
                }
            }, 3000);
        }

        function toggleEmojiPicker(chatId, chatContainer, messageInput) {
            const emojis = ['😊', '👍', '😀', '🙂', '👋', '❤️', '👌', '✨'];
            const existingPicker = document.querySelector(`.emoji-picker[data-chat-id="${chatId}"]`);
            if (existingPicker) {
                existingPicker.remove();
                return;
            }
            const picker = document.createElement('div');
            picker.classList.add('emoji-picker');
            picker.setAttribute('data-chat-id', chatId);
            picker.style.cssText = `
                position: absolute;
                bottom: 100%;
                right: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 5px;
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                z-index: 1000;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            `;
            emojis.forEach(emoji => {
                const button = document.createElement('button');
                button.textContent = emoji;
                button.style.cssText = `
                    border: none;
                    background: none;
                    font-size: 20px;
                    cursor: pointer;
                    padding: 5px;
                `;
                button.onclick = (e) => {
                    e.stopPropagation();
                    messageInput.value += emoji;
                    picker.remove();
                    messageInput.focus();
                };
                picker.appendChild(button);
            });
            chatContainer.appendChild(picker);
            document.addEventListener('click', function closePicker(e) {
                if (!picker.contains(e.target) && !e.target.id.includes(`admin-smile-${chatId}`)) {
                    picker.remove();
                    document.removeEventListener('click', closePicker);
                }
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
        function handleFileUpload(chatId, parentContainer) {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = '.pdf,.jpeg,.png,.jpg';
            fileInput.style.display = 'none';
            fileInput.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    const messagesWrapper = parentContainer.querySelector(`#admin-messages-${chatId}`);
                    const chatContainer = parentContainer.querySelector(`#admin-input-${chatId}`);
                    const clearButtonContainer = parentContainer.querySelector(`#admin-clear-container-${chatId}`);
                    const messageButton = parentContainer.querySelector(`[data-button-id="admin-button-${chatId}"]`);
                    messagesWrapper.style.display = 'flex';
                    chatContainer.style.display = 'flex';
                    clearButtonContainer.style.display = 'flex';
                    parentContainer.style.height = 'auto';
                    messageButton.textContent = 'Close';
                    const fileName = file.name;
                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                    const fileId = `file-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
                    const fileStorage = parentContainer.__fileStorage || {};
                    fileStorage[fileId] = file;
                    parentContainer.__fileStorage = fileStorage;
                    const messageElement = document.createElement('div');
                    messageElement.setAttribute('data-file-id', fileId);
                    messageElement.style.cssText = `
                        display: flex;
                        justify-content: flex-end;
                        width: 100%;
                        margin-bottom: 10px;
                    `;
                    const fileContent = document.createElement('div');
                    fileContent.style.cssText = `
                        max-width: 80%;
                        padding: 8px 12px;
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        position: relative;
                    `;
                    const downloadLink = document.createElement('a');
                    downloadLink.href = '#';
                    downloadLink.style.cssText = `
                        display: flex;
                        align-items: center;
                        gap: 5px;
                        color: #666;
                        text-decoration: none;
                    `;
                    downloadLink.innerHTML = `
                        <i class="fa-solid fa-file"></i>
                        <span>${fileName} (${fileSize} MB)</span>
                    `;
                    downloadLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        const url = URL.createObjectURL(fileStorage[fileId]);
                        const tempLink = document.createElement('a');
                        tempLink.href = url;
                        tempLink.download = fileName;
                        document.body.appendChild(tempLink);
                        tempLink.click();
                        document.body.removeChild(tempLink);
                        URL.revokeObjectURL(url);
                    });
                    const removeButton = document.createElement('button');
                    removeButton.innerHTML = `<i class="fa-solid fa-times"></i>`;
                    removeButton.style.cssText = `
                        background: none;
                        border: none;
                        color: #999;
                        font-size: 12px;
                        cursor: pointer;
                        padding: 2px 5px;
                        margin-left: 5px;
                    `;
                    removeButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        if (messageElement && messagesWrapper.contains(messageElement)) {
                            messagesWrapper.removeChild(messageElement);
                            delete fileStorage[fileId];
                            const fileMessages = JSON.parse(localStorage.getItem(`admin-file-messages-${chatId}`) || '[]');
                            const updatedFileMessages = fileMessages.filter(fm => fm.id !== fileId);
                            localStorage.setItem(`admin-file-messages-${chatId}`, JSON.stringify(updatedFileMessages));
                        }
                    });
                    fileContent.appendChild(downloadLink);
                    fileContent.appendChild(removeButton);
                    messageElement.appendChild(fileContent);
                    messagesWrapper.appendChild(messageElement);
                    scrollToBottom(messagesWrapper);
                    const fileMessages = JSON.parse(localStorage.getItem(`admin-file-messages-${chatId}`) || '[]');
                    fileMessages.push({ id: fileId, name: fileName, size: fileSize });
                    localStorage.setItem(`admin-file-messages-${chatId}`, JSON.stringify(fileMessages));
                }
            };
            document.body.appendChild(fileInput);
            fileInput.click();
            document.body.removeChild(fileInput);
        }


        function scrollToBottom(messagesWrapper) {
            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
        }

        // Search Functionality
        const searchInput = document.getElementById('admin-search-input-id');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const studentCards = document.querySelectorAll('.indivudalloanstatus-cards');
                studentCards.forEach(card => {
                    const studentName = card.querySelector('.individual-bankname h1').textContent.toLowerCase();
                    const nbfcId = card.querySelector('.messageinputnbfcids').textContent.toLowerCase();
                    const description = card.querySelector('.individual-bankmessages p').textContent.toLowerCase();
                    if (studentName.includes(searchTerm) || nbfcId.includes(searchTerm) || description.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
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

        // Sort Functionality
        const sortTrigger = document.querySelector('.admin-inbox-filters#admin-index-sort-id');
        const sortDropdown = sortTrigger.querySelector('.admin-sort-dropdown');
        const sortOptions = sortDropdown.querySelectorAll('li');
        const studentDetailsContainer = document.getElementById('index-student-details-container-admin-id');

        if (sortTrigger && sortDropdown) {
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
                    const cards = Array.from(studentDetailsContainer.querySelectorAll('.indivudalloanstatus-cards'));
                    const sortedCards = cards.sort((a, b) => {
                        const nameA = a.querySelector('.individual-bankname h1').textContent;
                        const nameB = b.querySelector('.individual-bankname h1').textContent;
                        const descriptionA = a.querySelector('.individual-bankmessages p').textContent;
                        const descriptionB = b.querySelector('.individual-bankmessages p').textContent;
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
                    sortDropdown.classList.remove('active');
                    initializeAdminChat(); // Re-initialize to reattach event listeners
                });
            });
        }


            setupCardViewButtons('nbfc-container', 'message-thread-nbfc-id');

            // Initialize Loan Proposals
            bankListedThroughNBFC();
        });

        // Initialize chat on page load
        initializeAdminChat();
    });

    </script>
</body>
</html>