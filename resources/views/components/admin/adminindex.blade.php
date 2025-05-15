<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Index</title>
    <link rel="stylesheet" href="assets/css/nbfc.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="admin-index-section-main-container" id="index-section-admin-id">
        <section class="index-section" id="index-section-id">
            <div class="admin-index-main-sub-container">
                <div class="admin-index-heading-index">
                    <h1>Inbox</h1>
                </div>
                <div class="admin-index-main-container">
                    <div class="admin-index-item active" data-tab="students">
                        <img src="assets/images/student-logo.png" alt="" class="admin-index-icon">
                        <span>Students</span>
                        <span class="admin-index-count" id="student-index-count">00</span>
                    </div>
                    <div class="admin-index-item" data-tab="nbfcs">
                        <img src="assets/images/nbfc-icon.png" alt="" class="admin-index-icon">
                        <span>NBFCs</span>
                        <span class="admin-index-count admin-index-count-gray" id="nbfc-index-count">00</span>
                    </div>
                </div>
                <div class="mobile-inbox-container">
                    <span class="mobile-inbox-item active" data-tab="students">Students</span>
                    <span class="mobile-inbox-item" data-tab="nbfcs">NBFCs</span>
                </div>
            </div>

            <div id="admin-student-inbox-container" style="display: block;">
                <div class="inbox-header" id="admin-student-header">
                    <h2 class="dashboard-section-index">Student</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="admin-student-search-container">
                            <img src="assets/images/search.png" alt="Search" class="index-search-icon">
                            <input type="text" class="index-search-input" id="admin-side-student-search-input"
                                placeholder="Search">
                        </div>
                        <div class="admin-inbox-filters" id="admin-side-student-sort">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="admin-sort-dropdown" id="admin-side-student-sort-options">
                                <li data-sort="az">A-Z</li>
                                <li data-sort="za">Z-A</li>
                                <li data-sort="newest">Newest</li>
                                <li data-sort="oldest">Oldest</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="studentdashboardprofile-loanproposals" id="admin-student-loanproposals">
                    <div class="loanproposals-loanstatuscards" id="admin-student-details-container">
                        <!-- Dynamic student cards will be inserted here via JavaScript -->
                    </div>
                </div>
            </div>

            <div id="admin-nbfc-inbox-container" style="display: none;">
                <div class="inbox-header" id="admin-nbfc-header">
                    <h2 class="dashboard-section-title">NBFC</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="admin-nbfc-search-container">
                            <img src="assets/images/search.png" alt="Search" class="index-search-icon">
                            <input type="text" class="index-search-input" id="admin-side-nbfc-search-input"
                                placeholder="Search">
                        </div>
                        <div class="inbox-filters" id="admin-side-nbfc-sort">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="sort-dropdown-nbfc" id="admin-side-nbfc-sort-options">
                                <li data-sort="az">A-Z</li>
                                <li data-sort="za">Z-A</li>
                                <li data-sort="newest">Newest</li>
                                <li data-sort="oldest">Oldest</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="index-student-details-container" id="admin-nbfc-details-container">
                    <!-- Dynamic NBFC cards will be inserted here via JavaScript -->
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Global arrays to store fetched data
            let students = [];
            let nbfcs = [];
            let adminChatMessages = JSON.parse(localStorage.getItem('adminChatMessages')) || {};
            const adminFileStorage = {};

            // Function to save messages to localStorage
            function saveMessagesToStorage() {
                localStorage.setItem('adminChatMessages', JSON.stringify(adminChatMessages));
            }

            // Function to generate unique chat ID
            function generateAdminChatId(type, id, secondaryId) {
                return `admin-${type}-chat-${id}-${secondaryId}`;
            }

            // Update count displays
            function updateStudentCount() {
                const countElement = document.getElementById('student-index-count');
                if (countElement) {
                    countElement.textContent = students.length.toString().padStart(2, '0');
                }
            }

            function updateNbfcCount() {
                const countElement = document.getElementById('nbfc-index-count');
                if (countElement) {
                    countElement.textContent = nbfcs.length.toString().padStart(2, '0');
                }
            }

            // Fetch student data
            function fetchStudentData() {
                fetch('/student-chat-members', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log("Student data retrieved successfully!", data);
                            students = data.data.map(student => ({
                                ...student,
                                created_at: student.created_at ? new Date(student.created_at).toISOString() : new Date().toISOString()
                            }));
                            console.log("Student created_at values:", students.map(s => s.created_at));
                            initializeStudentChat(students);
                            updateStudentCount();
                        } else {
                            console.error("Error retrieving student data:", data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Fetch student error:", error);
                    });
            }

            // Fetch NBFC data
            function fetchNbfcData() {
                fetch('/nbfc-chat-members', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log("NBFC data retrieved successfully!", data);
                            nbfcs = data.data.map(nbfc => ({
                                ...nbfc,
                                created_at: nbfc.created_at ? new Date(nbfc.created_at).toISOString() : new Date().toISOString()
                            }));
                            console.log("NBFC created_at values:", nbfcs.map(n => n.created_at));
                            initializeNbfcChat(nbfcs);
                            updateNbfcCount();
                        } else {
                            console.error("Error retrieving NBFC data:", data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Fetch NBFC error:", error);
                    });
            }


            function initializeStudentChat(data) {
                const container = document.querySelector('#admin-student-details-container');
                if (!container) {
                    console.error('Student details container not found');
                    return;
                }

                container.innerHTML = ''; // Clear the existing content

                data.forEach(student => {
                    const chatId = generateAdminChatId('student', student.unique_id, student.unique_id);
                    const card = document.createElement('div');
                    card.classList.add('indivudalloanstatus-cards');
                    card.setAttribute('data-card-id', `admin-student-card-${student.unique_id}`);
                    card.innerHTML = `
            <div class="individual-bankname">
                <h1>${student.name}</h1>
                <p class="messageinputnbfcids">${student.unique_id}</p>
            </div>
            <div class="individual-bankmessages">
                <p>Student Description</p>
                <button class="triggeredbutton" id="admin-student-button-${chatId}" data-button-id="admin-student-button-${chatId}">Message</button>
            </div>
            <div class="messages-wrapper hidden" data-chat-id="${chatId}" id="admin-student-messages-${chatId}">
                <!-- Messages will be appended here -->
            </div>
            <div class="individual-bankmessage-input hidden" data-chat-id="${chatId}" id="admin-student-input-${chatId}">
                <input placeholder="Send message" type="text" id="admin-student-input-field-${chatId}">
                <img class="send-img" src="assets/images/send.png" alt="Send" id="admin-student-send-${chatId}">
                <i class="fa-solid fa-paperclip" id="admin-student-paperclip-${chatId}"></i>
                <i class="fa-regular fa-face-smile" id="admin-student-smile-${chatId}"></i>
            </div>
            <div style="display: none; justify-content: flex-end; width: 100%; margin-bottom: 10px;" id="admin-student-clear-container-${chatId}">
                <button style="background-color: rgb(240, 240, 240); border: none; border-radius: 4px; padding: 6px 20px; font-size: 12px; color: rgb(102, 102, 102); cursor: pointer; font-family: Poppins, sans-serif;" id="admin-student-clear-button-${chatId}">Clear Chat</button>
            </div>
        `;
                    container.appendChild(card);

                    // Add event listener for message input (sending messages on Enter key)
                    const messageInput = card.querySelector(`#admin-student-input-field-${chatId}`);
                    messageInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            sendMessage(chatId, messageInput.value, card, 'student', student.unique_id);
                        }
                    });

                    const messagesWrapper = card.querySelector(`#admin-student-messages-${chatId}`);
                    const messageButton = card.querySelector(`#admin-student-button-${chatId}`);
                    const inputSection = card.querySelector(`#admin-student-input-${chatId}`);
                    const clearContainer = card.querySelector(`#admin-student-clear-container-${chatId}`);

                    // Button click to toggle message visibility
                    if (messageButton) {
                        messageButton.addEventListener('click', (e) => {
                            e.preventDefault();

                            // 🔒 Close all other open input sections
                            document.querySelectorAll(".individual-bankmessage-input.active").forEach(input => {
                                input.classList.remove("active");
                                input.classList.add("hidden");
                            });

                            // 🔒 Hide all other message wrappers
                            document.querySelectorAll(".messages-wrapper").forEach(wrapper => {
                                wrapper.classList.add("hidden");
                            });

                            // 🔒 Hide all other clear buttons
                            document.querySelectorAll(".clear-button").forEach(btn => {
                                btn.classList.add("hidden");
                            });

                            // ✅ Toggle visibility of this chat’s input, message area, and clear button
                            inputSection.classList.toggle('hidden');
                            inputSection.classList.toggle('active');
                            messagesWrapper.classList.toggle('hidden');
                            clearContainer.classList.toggle('hidden');

                            // 🔄 Change button text based on visibility
                            messageButton.textContent = messagesWrapper.classList.contains('hidden') ? 'Message' : 'Close';

                            // 💬 Load messages into the chat box
                            displayMessages(chatId, messagesWrapper, student.unique_id);
                        });


                    }

                    // Clear chat button functionality
                    const clearButton = card.querySelector(`#admin-student-clear-button-${chatId}`);
                    if (clearButton) {
                        clearButton.addEventListener('click', (e) => {
                            e.preventDefault();
                            clearChat(chatId, messagesWrapper, student.unique_id);
                        });
                    }
                });
            }



            function initializeNbfcChat(data) {
                const container = document.querySelector('#admin-nbfc-details-container');
                if (!container) {
                    console.error('NBFC details container not found');
                    return;
                }

                container.innerHTML = '';

                let currentlyOpenChatId = null; // Track the open chat

                data.forEach(nbfc => {
                    const chatId = generateAdminChatId('nbfc', nbfc.nbfc_id, nbfc.nbfc_id);
                    const card = document.createElement('div');
                    card.classList.add('index-student-message-container');
                    card.setAttribute('data-card-id', `admin-nbfc-card-${nbfc.nbfc_id}`);

                    card.innerHTML = `
                    <div class="index-student-card">
                        <div class="index-student-info">
                            <h3 class="student-name">${nbfc.nbfc_name}</h3>
                            <p class="student-ids">${nbfc.nbfc_id}</p>
                        </div>
                        <div class="index-student-button-group-admin">
                            <button class="index-student-message-btn triggeredbutton" id="admin-nbfc-button-${chatId}" data-button-id="admin-nbfc-button-${chatId}">Message</button>
                        </div>
                    
                    </div>
                    <div style="display: none; justify-content: flex-end; width: 100%; margin-bottom: 10px;" id="admin-nbfc-clear-container-${chatId}">
                        <button style="background-color: rgb(240, 240, 240); border: none; border-radius: 4px; padding: 6px 20px; font-size: 12px; color: rgb(102, 102, 102); cursor: pointer; font-family: Poppins, sans-serif;" id="admin-nbfc-clear-button-${chatId}">Clear Chat</button>
                    </div>
                    <div class="messages-wrapper" data-chat-id="${chatId}" id="admin-nbfc-messages-${chatId}" style="display: none;"></div>
                    <div class="nbfc-individual-bankmessage-input-message" data-chat-id="${chatId}" id="admin-nbfc-input-${chatId}" style="display: none;">
                        <input placeholder="Send message" type="text" id="admin-nbfc-input-field-${chatId}" class="nbfc-message-input">
                        <img class="send-img nbfc-send-img" src="assets/images/send-nbfc.png" alt="Send" id="admin-nbfc-send-${chatId}">
                        <i class="fa-solid fa-paperclip nbfc-paperclip" id="admin-nbfc-paperclip-${chatId}"></i>
                        <i class="fa-regular fa-face-smile nbfc-face-smile" id="admin-nbfc-smile-${chatId}"></i>
                    </div>
                `;

                    container.appendChild(card);

                    const messageInput = card.querySelector(`#admin-nbfc-input-field-${chatId}`);
                    messageInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            sendMessage(chatId, messageInput.value, card, 'nbfc', nbfc.nbfc_id);
                        }
                    });

                    const messagesWrapper = card.querySelector(`#admin-nbfc-messages-${chatId}`);
                    const messageButton = card.querySelector(`#admin-nbfc-button-${chatId}`);
                    const inputSection = card.querySelector(`#admin-nbfc-input-${chatId}`);
                    const clearContainer = card.querySelector(`#admin-nbfc-clear-container-${chatId}`);

                    messageButton.addEventListener('click', () => {
                        const isAlreadyOpen = currentlyOpenChatId === chatId;

                        if (isAlreadyOpen) {
                            // Close the currently open chat only
                            messagesWrapper.classList.add('hidden');
                            inputSection.classList.add('hidden');
                            clearContainer.classList.add('hidden');
                            messageButton.textContent = 'Message';
                            currentlyOpenChatId = null;
                        } else {

                            const allMessages = container.querySelectorAll('.messages-wrapper');
                            const allInputs = container.querySelectorAll('.nbfc-individual-bankmessage-input-message');
                            const allClears = container.querySelectorAll('[id^="admin-nbfc-clear-container-"]');
                            const allButtons = container.querySelectorAll('.index-student-message-btn');

                            allMessages.forEach(m => m.classList.add('hidden'));
                            allInputs.forEach(i => i.classList.add('hidden'));
                            allClears.forEach(c => c.classList.add('hidden'));
                            allButtons.forEach(b => b.textContent = 'Message');

                            // Open the current chat
                            messagesWrapper.classList.remove('hidden');
                            inputSection.classList.remove('hidden');
                            clearContainer.classList.remove('hidden');
                            displayMessages(chatId, messagesWrapper, nbfc.nbfc_id);
                            currentlyOpenChatId = chatId;
                        }
                    });
                });
            }

            function sendMessage(chatId, content, parentContainer, type, id) {
                if (!content.trim()) return;

                const messageId = `msg-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
                const admin_id = 'admin001';
                const body = {
                    id: id,
                    admin_id: admin_id,
                    sender_id: admin_id,
                    receiver_id: id,
                    message: content, // This will now include the file URL as part of the message
                    is_read: false
                };

                const apiurl = id.includes("NBFC") ? '/send-message-from-adminnbfc' : '/send-message-from-adminstudent';

                // Select the correct messagesWrapper based on type
                const messagesWrapper = document.querySelector(
                    type === 'nbfc' ? `#admin-nbfc-messages-${chatId}` : `#admin-student-messages-${chatId}`
                );

                // Send the API request
                fetch(apiurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(body)
                })
                    .then(response => response.json())
                    .then(data => {
                        // Clear input field
                        const inputField = document.querySelector(
                            type === 'nbfc' ? `#admin-nbfc-input-field-${chatId}` : `#admin-student-input-field-${chatId}`
                        );
                        inputField.value = '';

                        // Optionally update messages UI
                        displayMessages(chatId, messagesWrapper, id);
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                    });
            }


            function displayMessages(chatId, messagesWrapper, id) {
                console.log(messagesWrapper);
                const admin_id = 'admin001';
                const apiUrl = id.includes("NBFC")
                    ? `/get-messages-adminnbfc/${id}/${admin_id}`
                    : `/get-messages-adminstudent/${id}/${admin_id}`;

                // Helper function inside displayMessages
               function createMessageElement(msg) {
    const messageElement = document.createElement('div');
    messageElement.setAttribute('data-message-id', msg.id);
    messageElement.style.cssText = `
        display: flex;
        justify-content: ${msg.sender_id === 'admin001' ? 'flex-end' : 'flex-start'};
        width: 100%;
        margin-bottom: 10px;
    `;

    const messageContent = document.createElement('div');
    messageContent.style.cssText = `
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 8px;
        background-color: ${msg.sender_id === 'admin001' ? '#DCF8C6' : '#FFF'};
        word-wrap: break-word;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    `;

    // Check if the message is a file URL (e.g., from S3)
    const isFileUrl = msg.message.startsWith("http") && (
        msg.message.endsWith(".pdf") || msg.message.endsWith(".doc") || msg.message.endsWith(".docx") || msg.message.endsWith(".txt")
    );

    if (isFileUrl) {
        const fileName = msg.message.split('/').pop();

        const fileLink = document.createElement('a');
        fileLink.href = msg.message;
        fileLink.target = "_blank";
        fileLink.style.cssText = `
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            gap: 5px;
        `;
        fileLink.innerHTML = `<i class="fa-solid fa-file"></i> <span>${fileName}</span>`;

        const eyeIcon = document.createElement('a');
        eyeIcon.href = msg.message;
        eyeIcon.target = '_blank';
        eyeIcon.style.cssText = `
            margin-left: 10px;
            font-size: 16px;
            color: #007bff;
            cursor: pointer;
        `;
        eyeIcon.innerHTML = `<i class="fa-solid fa-eye"></i>`;

        messageContent.appendChild(fileLink);
        messageContent.appendChild(eyeIcon);
    } else {
        messageContent.textContent = msg.message;
    }

    messageElement.appendChild(messageContent);
    return messageElement;
}


                fetch(apiUrl)
                    .then(response => {
                        if (!response.ok) {
                            if (response.status >= 500) throw new Error('Server error');
                            // If 4xx (like 404), assume no conversation exists yet
                            return { messages: [] };
                        }
                        return response.json();
                    })
                    .then(data => {
                        messagesWrapper.innerHTML = '';

                        if (Array.isArray(data.messages) && data.messages.length > 0) {
                            data.messages.forEach(msg => {
                                const messageElement = createMessageElement(msg);
                                messagesWrapper.appendChild(messageElement);
                            });
                            messagesWrapper.style.display = 'block';

                            const type = id.includes("NBFC") ? 'nbfc' : 'student';
                            document.getElementById(`admin-${type}-input-${chatId}`).style.display = 'flex';
                            document.getElementById(`admin-${type}-clear-container-${chatId}`).style.display = 'flex';
                        } else {
                            // No messages yet, not an error
                            messagesWrapper.innerHTML = '<div style="text-align:center; color:gray;">No conversation found.</div>';
                        }

                        // Scroll to the bottom of the chat
                        const messageContainer = document.getElementById(`admin-${id.includes("NBFC") ? 'nbfc' : 'student'}-messages-${chatId}`);
                        scrollToBottom(chatId, messageContainer);
                    })
                    .catch(error => {
                        console.error('Error fetching messages:', error);
                        messagesWrapper.innerHTML = '<div style="text-align:center; color:red;">Error loading conversation.</div>';
                    });
            }

            // Helper function to handle scrolling to the bottom of the message container
            function scrollToBottom(chatId, messageContainer) {
                if (messageContainer) {
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                }
            }


            function clearChat(chatId, parentContainer, type) {
                const messagesWrapper = parentContainer.querySelector(`#admin-${type}-messages-${chatId}`);
                messagesWrapper.innerHTML = '';
                adminChatMessages[chatId] = [];
                delete adminFileStorage[chatId];
                saveMessagesToStorage();
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

            // Toggle emoji picker
            function toggleEmojiPicker(chatId, chatContainer, messageInput, type) {
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
                    if (!picker.contains(e.target) && !e.target.id.includes(`admin-${type}-smile-${chatId}`)) {
                        picker.remove();
                        document.removeEventListener('click', closePicker);
                    }
                });
            }

            // Handle file upload
            function handleFileUpload(chatId, parentContainer, type,id) {
                console.log(id)
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = '.pdf,.doc,.docx,.txt';
                fileInput.style.display = 'none';

                fileInput.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const formData = new FormData();
                        formData.append('file', file);
                        formData.append('chatId', chatId); // send chatId for context

                        // Retrieve CSRF token from the meta tag
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // Send to backend for AWS S3 upload
                        fetch('/upload-documents-chat', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },

                            body: formData

                        })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success && data.fileUrl) {
                                    const messagesWrapper = parentContainer.querySelector(`#admin-${type}-messages-${chatId}`);
                                    const chatContainer = parentContainer.querySelector(`#admin-${type}-input-${chatId}`);
                                    const clearButtonContainer = parentContainer.querySelector(`#admin-${type}-clear-container-${chatId}`);
                                    const messageButton = parentContainer.querySelector(`#admin-${type}-button-${chatId}`);

                                    messagesWrapper.style.display = 'flex';
                                    chatContainer.style.display = 'flex';
                                    clearButtonContainer.style.display = 'flex';
                                    parentContainer.style.height = 'auto';
                                    messageButton.textContent = 'Close';

                                    const fileName = file.name;
                                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                                    const fileId = `file-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
                                    if (!adminFileStorage[chatId]) adminFileStorage[chatId] = {};
                                    adminFileStorage[chatId][fileId] = file;

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
                                    downloadLink.href = data.fileUrl; // from backend
                                    downloadLink.target = '_blank';
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

                                    const removeButton = document.createElement('button');
                                    removeButton.style.cssText = `
                        background: none;
                        border: none;
                        cursor: pointer;
                        font-size: 18px;
                        padding: 0;
                        margin-left: 10px;
                        display: flex;
                        justify-content: flex-end;
                    `;
                                    removeButton.innerHTML = `
                        <svg width="16" height="16" fill="black" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.146 3.854a.5.5 0 0 0-.708 0L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.146-3.146a.5.5 0 0 0 0-.708z"/>
                        </svg>
                    `;
                                    removeButton.setAttribute('id', `admin-${type}-remove-file-${fileId}`);
                                    removeButton.addEventListener('click', (e) => {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        if (messageElement && messagesWrapper.contains(messageElement)) {
                                            messagesWrapper.removeChild(messageElement);
                                            delete adminFileStorage[chatId][fileId];
                                        }
                                    });

                                    fileContent.appendChild(downloadLink);
                                    fileContent.appendChild(removeButton);
                                    messageElement.appendChild(fileContent);
                                    messagesWrapper.appendChild(messageElement);
                                    scrollToBottom(messagesWrapper);

                                    // Now, send the file URL as a message to the chat
                                    const messageContent = `${data.fileUrl}`;
                                    sendMessage(chatId, messageContent, parentContainer, type, chatId);
                                    alert(id)
                                    displayMessages(chatId, messagesWrapper, id);

                                } else {
                                    alert('File upload failed.');
                                }
                            })
                            .catch(err => {
                                console.error('Upload failed:', err);
                                alert('Something went wrong while uploading the file.');
                            });
                    }
                };

                document.body.appendChild(fileInput);
                fileInput.click();
                document.body.removeChild(fileInput);
            }



            // Search functionality for Students
            function initializeStudentSearch() {
                const studentSearchInput = document.getElementById('admin-side-student-search-input');
                if (!studentSearchInput) {
                    console.error('Student search input not found');
                    return;
                }
                studentSearchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase().trim();
                    const studentCards = document.querySelectorAll('.indivudalloanstatus-cards');
                    studentCards.forEach(card => {
                        const studentName = card.querySelector('.individual-bankname h1')?.textContent.toLowerCase() || '';
                        const uniqueId = card.querySelector('.messageinputnbfcids')?.textContent.toLowerCase() || '';
                        const description = card.querySelector('.individual-bankmessages p')?.textContent.toLowerCase() || '';
                        card.style.display = (studentName.includes(searchTerm) || uniqueId.includes(searchTerm) || description.includes(searchTerm)) ? 'block' : 'none';
                    });
                });
            }

            // Search functionality for NBFCs
            function initializeNbfcSearch() {
                const nbfcSearchInput = document.getElementById('admin-side-nbfc-search-input');
                if (!nbfcSearchInput) {
                    console.error('NBFC search input not found');
                    return;
                }
                nbfcSearchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase().trim();
                    const nbfcCards = document.querySelectorAll('.index-student-message-container');
                    nbfcCards.forEach(card => {
                        const nbfcName = card.querySelector('.student-name')?.textContent.toLowerCase() || '';
                        const nbfcId = card.querySelector('.student-ids')?.textContent.toLowerCase() || '';
                        card.style.display = (nbfcName.includes(searchTerm) || nbfcId.includes(searchTerm)) ? 'block' : 'none';
                    });
                });
            }

            // Sort functionality for Students
            function initializeStudentSort() {
                const studentSortTrigger = document.getElementById('admin-side-student-sort');
                const studentSortDropdown = document.getElementById('admin-side-student-sort-options');
                if (!studentSortTrigger || !studentSortDropdown) {
                    console.error('Student sort elements not found');
                    return;
                }

                studentSortTrigger.addEventListener('click', function (event) {
                    event.stopPropagation();
                    studentSortDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function () {
                    studentSortDropdown.classList.remove('active');
                });

                studentSortDropdown.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const option = event.target.closest('li');
                    if (!option) return;
                    const sortType = option.getAttribute('data-sort');
                    console.log(`Sorting students by: ${sortType}`);
                    const sortedStudents = [...students].sort((a, b) => {
                        const nameA = a.name.toLowerCase();
                        const nameB = b.name.toLowerCase();
                        const dateA = a.created_at ? new Date(a.created_at).getTime() : new Date().getTime();
                        const dateB = b.created_at ? new Date(b.created_at).getTime() : new Date().getTime();
                        switch (sortType) {
                            case 'az':
                                return nameA.localeCompare(nameB);
                            case 'za':
                                return nameB.localeCompare(nameA);
                            case 'newest':
                                console.log(`Comparing dates: ${a.created_at} (${dateA}) vs ${b.created_at} (${dateB})`);
                                return dateB - dateA; // Newest first
                            case 'oldest':
                                console.log(`Comparing dates: ${a.created_at} (${dateA}) vs ${b.created_at} (${dateB})`);
                                return dateA - dateB; // Oldest first
                            default:
                                return 0;
                        }
                    });
                    console.log("Sorted students:", sortedStudents.map(s => ({ name: s.name, created_at: s.created_at })));
                    students = sortedStudents;
                    initializeStudentChat(students);
                    studentSortDropdown.classList.remove('active');
                });
            }

            // Sort functionality for NBFCs
            function initializeNbfcSort() {
                const nbfcSortTrigger = document.getElementById('admin-side-nbfc-sort');
                const nbfcSortDropdown = document.getElementById('admin-side-nbfc-sort-options');
                if (!nbfcSortTrigger || !nbfcSortDropdown) {
                    console.error('NBFC sort elements not found');
                    return;
                }

                nbfcSortTrigger.addEventListener('click', function (event) {
                    event.stopPropagation();
                    nbfcSortDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function () {
                    nbfcSortDropdown.classList.remove('active');
                });

                nbfcSortDropdown.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const option = event.target.closest('li');
                    if (!option) return;
                    const sortType = option.getAttribute('data-sort');
                    console.log(`Sorting NBFCs by: ${sortType}`);
                    const sortedNbfcs = [...nbfcs].sort((a, b) => {
                        const nameA = a.nbfc_name.toLowerCase();
                        const nameB = b.nbfc_name.toLowerCase();
                        const dateA = a.created_at ? new Date(a.created_at).getTime() : new Date().getTime();
                        const dateB = b.created_at ? new Date(b.created_at).getTime() : new Date().getTime();
                        switch (sortType) {
                            case 'az':
                                return nameA.localeCompare(nameB);
                            case 'za':
                                return nameB.localeCompare(nameA);
                            case 'newest':
                                console.log(`Comparing dates: ${a.created_at} (${dateA}) vs ${b.created_at} (${dateB})`);
                                return dateB - dateA; // Newest first
                            case 'oldest':
                                console.log(`Comparing dates: ${a.created_at} (${dateA}) vs ${b.created_at} (${dateB})`);
                                return dateA - dateB; // Oldest first
                            default:
                                return 0;
                        }
                    });
                    console.log("Sorted NBFCs:", sortedNbfcs.map(n => ({ nbfc_name: n.nbfc_name, created_at: n.created_at })));
                    nbfcs = sortedNbfcs;
                    initializeNbfcChat(nbfcs);
                    nbfcSortDropdown.classList.remove('active');
                });
            }

            // Tab switching
            document.querySelectorAll('.admin-index-item, .mobile-inbox-item').forEach(tab => {
                tab.addEventListener('click', function () {
                    const tabType = this.getAttribute('data-tab');
                    document.querySelectorAll('.admin-index-item, .mobile-inbox-item').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll(`[data-tab="${tabType}"]`).forEach(t => t.classList.add('active'));
                    const studentContainer = document.getElementById('admin-student-inbox-container');
                    const nbfcContainer = document.getElementById('admin-nbfc-inbox-container');
                    if (tabType === 'students') {
                        studentContainer.style.display = 'block';
                        nbfcContainer.style.display = 'none';
                        fetchStudentData();
                    } else {
                        studentContainer.style.display = 'none';
                        nbfcContainer.style.display = 'block';
                        fetchNbfcData();
                    }
                });
            });

            // Event delegation for dynamic buttons
            document.addEventListener('click', (e) => {
                const target = e.target;
                const parentContainer = target.closest('.indivudalloanstatus-cards, .index-student-message-container');
                if (!parentContainer) return;

                const isStudent = parentContainer.classList.contains('indivudalloanstatus-cards');
                const type = isStudent ? 'student' : 'nbfc';
                const chatId = parentContainer.querySelector(`.${isStudent ? 'individual-bankmessage-input' : 'nbfc-individual-bankmessage-input-message'}`).getAttribute('data-chat-id');
                const id = parentContainer.querySelector(`.${isStudent ? 'messageinputnbfcids' : 'student-ids'}`).textContent;

                if (target.classList.contains('triggeredbutton')) {
                    const messagesWrapper = parentContainer.querySelector(`#admin-${type}-messages-${chatId}`);
                    const chatContainer = parentContainer.querySelector(`#admin-${type}-input-${chatId}`);
                    const clearButtonContainer = parentContainer.querySelector(`#admin-${type}-clear-container-${chatId}`);
                    if (messagesWrapper.style.display === 'none') {
                        messagesWrapper.style.display = 'block';
                        chatContainer.style.display = 'flex';
                        clearButtonContainer.style.display = 'flex';
                        parentContainer.style.height = 'auto';
                        target.textContent = 'Close';

                        scrollToBottom(messagesWrapper);
                    } else {
                        messagesWrapper.style.display = 'none';
                        chatContainer.style.display = 'none';
                        clearButtonContainer.style.display = 'none';
                        parentContainer.style.height = 'fit-content';
                        target.textContent = 'Message';
                    }
                }

                if (target.id === `admin-${type}-send-${chatId}`) {
                    const messageInput = parentContainer.querySelector(`#admin-${type}-input-field-${chatId}`);
                    sendMessage(chatId, messageInput.value, parentContainer, type, id);
                }

                if (target.id === `admin-${type}-clear-button-${chatId}`) {
                    clearChat(chatId, parentContainer, type);
                }

                if (target.id === `admin-${type}-smile-${chatId}`) {
                    const chatContainer = parentContainer.querySelector(`#admin-${type}-input-${chatId}`);
                    const messageInput = parentContainer.querySelector(`#admin-${type}-input-field-${chatId}`);
                    toggleEmojiPicker(chatId, chatContainer, messageInput, type);
                }

                if (target.id === `admin-${type}-paperclip-${chatId}`) {
                    handleFileUpload(chatId, parentContainer, type,id);
                }
            });

            // Initialize functionalities
            fetchStudentData();
            fetchNbfcData();
            initializeStudentSearch();
            initializeNbfcSearch();
            initializeStudentSort();
            initializeNbfcSort();
        });
    </script>
</body>

</html>