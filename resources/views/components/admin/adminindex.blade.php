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
                    <div class="admin-index-item" >
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
                <div class="studentdashboardprofile-loanproposals" id="admin-loanproposals-id">
                    <h1 class="loanproposals-header" id="loanproposals-header">Inbox</h1>
                    <div class="loanproposals-loanstatuscards" id="index-student-details-container-admin-id">
                        <!-- Dynamic cards will be inserted here via JavaScript -->
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
           -                 const updatedFileMessages = fileMessages.filter(fm => fm.id !== fileId);
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

         initializeAdminChat();
    });
    </script>
</body>
</html>