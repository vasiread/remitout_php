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
                        <span class="admin-index-count" id="student-index-count">06</span>
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
                            <input type="text" class="index-search-input" id="admin-student-search-input"
                                placeholder="Search">
                        </div>
                        <div class="admin-inbox-filters" id="admin-student-sort">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="admin-sort-dropdown" id="admin-student-sort-options">
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
                            <input type="text" class="index-search-input" id="admin-nbfc-search-input"
                                placeholder="Search">
                        </div>
                        <div class="inbox-filters" id="admin-nbfc-sort">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                            <ul class="sort-dropdown-nbfc" id="admin-nbfc-sort-options">
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




            fetchStudentData();
            // Sample NBFC data with timestamps


            fetchNbfcData();

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

            function fetchStudentData() {
                // Send the GET request to fetch student data
                fetch('/student-chat-members', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF protection
                    }
                })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.status === 'success') {
                            console.log("Student data retrieved successfully!");
                            console.log(data);
                            initializeStudentChat(data)
                        } else {
                            console.error("Error retrieving student data.");
                        }
                    })
                    .catch(error => {
                        console.error("Error: ", error); // Catch any errors
                    });
            }
            function fetchNbfcData() {
                fetch('/nbfc-chat-members', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF protection
                    }
                })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.status === 'success') {
                            console.log("NBFC data retrieved successfully!");
                            console.log(data);
                            initializeNbfcChat(data)
                        } else {
                            console.error("Error retrieving student data.");
                        }
                    })
                    .catch(error => {
                        console.error("Error: ", error); // Catch any errors
                    });
            }



            function initializeStudentChat(fetchedData) {
                console.log(fetchedData);
                const container = document.querySelector('#admin-student-details-container');
                if (!container) return;

                container.innerHTML = '';

                fetchedData.data.forEach(student => {
                    // Generate a chat ID using the student's unique_id
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
            <div style="display: none; justify-content: flex-end; width: 100%; margin-bottom: 10px;" id="admin-student-clear-container-${chatId}">
                <button style="background-color: rgb(240, 240, 240); border: none; border-radius: 4px; padding: 6px 20px; font-size: 12px; color: rgb(102, 102, 102); cursor: pointer; font-family: Poppins, sans-serif;" id="admin-student-clear-button-${chatId}">Clear Chat</button>
            </div>
            <div class="messages-wrapper" data-chat-id="${chatId}" id="admin-student-messages-${chatId}" style="display: none;"></div>
            <div class="individual-bankmessage-input" data-chat-id="${chatId}" id="admin-student-input-${chatId}" style="display: none;">
                <input placeholder="Send message" type="text" id="admin-student-input-field-${chatId}">
                <img class="send-img" src="assets/images/send.png" alt="Send" id="admin-student-send-${chatId}">
                <i class="fa-solid fa-paperclip" id="admin-student-paperclip-${chatId}"></i>
                <i class="fa-regular fa-face-smile" id="admin-student-smile-${chatId}"></i>
            </div>
        `;
                    container.appendChild(card);

                    const messageInput = card.querySelector(`#admin-student-input-field-${chatId}`);
                    messageInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            sendMessage(chatId, messageInput.value, card, 'student', student.unique_id);
                        }
                    });

                    const messagesWrapper = card.querySelector(`#admin-student-messages-${chatId}`);
                    const messageButton = card.querySelector(`#admin-student-button-${chatId}`);

                    messageButton.addEventListener('click', () => {
                        console.log("Message button clicked for student"); // Add this log

                        const inputSection = card.querySelector(`#admin-student-input-${chatId}`);
                        const clearContainer = card.querySelector(`#admin-student-clear-container-${chatId}`);

                        if (messagesWrapper.style.display === 'block') {
                            // Currently open, so close it
                            messagesWrapper.style.display = 'none';
                            inputSection.style.display = 'none';
                            clearContainer.style.display = 'none';
                            messageButton.textContent = 'Message';
                        } else {
                            // Currently closed, so open it
                            messagesWrapper.style.display = 'block';
                            inputSection.style.display = 'flex';
                            clearContainer.style.display = 'flex';
                            messageButton.textContent = 'Close';

                            displayMessages(chatId, messagesWrapper, student.unique_id);
                        }
                    });

                });
            }



            function initializeNbfcChat(fetchedData) {
                console.log(fetchedData); // Log fetched data for debugging
                const container = document.querySelector('#admin-nbfc-details-container');
                if (!container) return;

                container.innerHTML = '';

                fetchedData.data.forEach(nbfc => {
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
                <div class="index-student-button-group">
                    <button class="index-student-message-btn triggeredbutton" id="admin-nbfc-button-${chatId}" data-button-id="admin-nbfc-button-${chatId}">Message</button>
                </div>
                <div class="index-student-send-btn-mobile">
                    <img src="assets/images/send-index-btn.png" alt="Send Button">
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

                    // Add event listener for sending messages when "Enter" is pressed
                    const messageInput = card.querySelector(`#admin-nbfc-input-field-${chatId}`);
                    messageInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            sendMessage(chatId, messageInput.value, card, 'nbfc', nbfc.nbfc_id);
                        }
                    });

                    const messagesWrapper = card.querySelector(`#admin-nbfc-messages-${chatId}`);
                    const messageButton = card.querySelector(`#admin-nbfc-button-${chatId}`);

                    messageButton.addEventListener('click', () => {
                        // Show the messages wrapper and input field if needed
                        messagesWrapper.style.display = 'block';
                        card.querySelector(`#admin-nbfc-input-${chatId}`).style.display = 'flex';
                        card.querySelector(`#admin-nbfc-clear-container-${chatId}`).style.display = 'flex';

                        displayMessages(chatId, messagesWrapper, nbfc.nbfc_id);
                    });

                });
            }


            function sendMessage(chatId, content, parentContainer, type, id) {
                if (!content.trim()) return;

                const messageId = `msg-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;


                // Save the messages to localStorage
                saveMessagesToStorage();

                // Clear the input field
                const messageInput = parentContainer.querySelector(`#admin-${type}-input-field-${chatId}`);
                messageInput.value = '';

                // Get the DOM elements related to the chat
                const messagesWrapper = parentContainer.querySelector(`#admin-${type}-messages-${chatId}`);
                const chatContainer = parentContainer.querySelector(`#admin-${type}-input-${chatId}`);
                const clearButtonContainer = parentContainer.querySelector(`#admin-${type}-clear-container-${chatId}`);
                const messageButton = parentContainer.querySelector(`#admin-${type}-button-${chatId}`);

                // Show the chat components
                messagesWrapper.style.display = 'flex';
                chatContainer.style.display = 'flex';
                clearButtonContainer.style.display = 'flex';
                parentContainer.style.height = 'auto';

                // Change button text
                messageButton.textContent = 'Close';

                 const admin_id = 'admin001';

                console.log(content)
                const body = {
                    id: id,
                    admin_id: admin_id,
                    sender_id: admin_id, 
                    receiver_id: id,  
                    message: content, 
                    is_read: false  
                };

                 let apiurl = '';
                if (id.includes("NBFC")) {
                    apiurl = '/send-message-from-adminnbfc';
                } else {
                    apiurl = '/send-message-from-adminstudent';
                }


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
                        console.log('Message sent successfully:', data);
                        alert("message sent")
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                    });

                displayMessages(chatId, messagesWrapper, id);
                scrollToBottom(messagesWrapper);
            }



            function displayMessages(chatId, messagesWrapper, id) {
                console.log(messagesWrapper)
                console.log(chatId)
                console.log(id)
                const admin_id = 'admin001'
                messagesWrapper.innerHTML = '';

                let apiUrl = '';

                if (id.includes("NBFC")) {
                    apiUrl = `/get-messages-adminnbfc/${id}/${admin_id}`;


                }
                else {
                    apiUrl = `/get-messages-adminstudent/${id}/${admin_id}`;


                }

                fetch(apiUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('API response:', data);

                        messagesWrapper.innerHTML = ''; // Clear previous messages

                        if (data.messages && Array.isArray(data.messages)) {
                            data.messages.forEach(msg => {
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
                `;
                                messageContent.textContent = msg.message;
                                messageElement.appendChild(messageContent);
                                messagesWrapper.appendChild(messageElement);
                            });

                            messagesWrapper.style.display = 'block';
                            document.getElementById(`admin-nbfc-input-${chatId}`).style.display = 'flex';
                            document.getElementById(`admin-nbfc-clear-container-${chatId}`).style.display = 'flex';

                        } else {
                            messagesWrapper.innerHTML = '<div style="text-align:center; color:gray;">No conversation found.</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching messages:', error);
                        messagesWrapper.innerHTML = '<div style="text-align:center; color:red;">Error loading conversation.</div>';
                    });











                // if (adminChatMessages[chatId]) {
                //     adminChatMessages[chatId].forEach(message => {
                //         const messageElement = document.createElement('div');
                //         console.log("--------")
                //         console.log(message)
                //         messageElement.setAttribute('data-message-id', message.id);
                //         messageElement.style.cssText = `
                //         display: flex;
                //         justify-content: ${message.sender_id === 'ADMIN' ? 'flex-end' : 'flex-start'};
                //         width: 100%;
                //         margin-bottom: 10px;
                //     `;
                //         const messageContent = document.createElement('div');
                //         messageContent.style.cssText = `
                //         max-width: 80%;
                //         padding: 8px 12px;
                //         border-radius: 8px;
                //         background-color: ${message.sender_id === 'ADMIN' ? '#DCF8C6' : '#FFF'};
                //         word-wrap: break-word;
                //         font-family: 'Poppins', sans-serif;
                //         box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                //     `;
                //         messageContent.textContent = message.message;
                //         messageElement.appendChild(messageContent);
                //         messagesWrapper.appendChild(messageElement);
                //     });
                // }



            }

            function clearChat(chatId, parentContainer, type) {


                const messagesWrapper = parentContainer.querySelector(`#admin-${type}-messages-${chatId}`);
                messagesWrapper.innerHTML = '';
                adminChatMessages[chatId] = [];
                delete adminFileStorage[chatId];
                // Update localStorage
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

            function handleFileUpload(chatId, parentContainer, type) {
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = '.pdf,.doc,.docx,.txt';
                fileInput.style.display = 'none';
                fileInput.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
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
                            const url = URL.createObjectURL(adminFileStorage[chatId][fileId]);
                            const tempLink = document.createElement('a');
                            tempLink.href = url;
                            tempLink.download = fileName;
                            document.body.appendChild(tempLink);
                            tempLink.click();
                            document.body.removeChild(tempLink);
                            URL.revokeObjectURL(url);
                        });
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
                    }
                };
                document.body.appendChild(fileInput);
                fileInput.click();
                document.body.removeChild(fileInput);
            }

            function scrollToBottom(messagesWrapper) {
                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
            }

            // Search Functionality for Students
            const studentSearchInput = document.getElementById('admin-student-search-input');
            if (studentSearchInput) {
                studentSearchInput.addEventListener('input', function () {
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

            // Search Functionality for NBFCs
            const nbfcSearchInput = document.getElementById('admin-nbfc-search-input');
            if (nbfcSearchInput) {
                nbfcSearchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase().trim();
                    const nbfcCards = document.querySelectorAll('.index-student-message-container');
                    nbfcCards.forEach(card => {
                        const nbfcName = card.querySelector('.student-name').textContent.toLowerCase();
                        const nbfcId = card.querySelector('.student-ids').textContent.toLowerCase();
                        const description = card.querySelector('.index-student-description').textContent.toLowerCase();
                        if (nbfcName.includes(searchTerm) || nbfcId.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Sort Functionality for Students
            const studentSortTrigger = document.querySelector('#admin-student-sort');
            const studentSortDropdown = studentSortTrigger.querySelector('.admin-sort-dropdown');
            const studentSortOptions = studentSortDropdown.querySelectorAll('li');
            const studentDetailsContainer = document.getElementById('admin-student-details-container');

            if (studentSortTrigger && studentSortDropdown) {
                studentSortTrigger.addEventListener('click', function (event) {
                    event.stopPropagation();
                    studentSortDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function () {
                    studentSortDropdown.classList.remove('active');
                });

                studentSortDropdown.addEventListener('click', function (event) {
                    event.stopPropagation();
                });

                studentSortOptions.forEach(option => {
                    option.addEventListener('click', function () {
                        const sortType = this.getAttribute('data-sort');
                        const sortedStudents = [...students].sort((a, b) => {
                            const nameA = a.name.toLowerCase();
                            const nameB = b.name.toLowerCase();
                            const timestampA = new Date(a.timestamp || '2023-01-01').getTime();
                            const timestampB = new Date(b.timestamp || '2023-01-01').getTime();
                            switch (sortType) {
                                case 'az':
                                    return nameA.localeCompare(nameB);
                                case 'za':
                                    return nameB.localeCompare(nameA);
                                case 'newest':
                                    return timestampB - timestampA;
                                case 'oldest':
                                    return timestampA - timestampB;
                                default:
                                    return 0;
                            }
                        });

                        students.length = 0;
                        students.push(...sortedStudents);
                        initializeStudentChat();
                        studentSortDropdown.classList.remove('active');
                    });
                });
            }

            // Sort Functionality for NBFCs
            const nbfcSortTrigger = document.querySelector('#admin-nbfc-sort');
            const nbfcSortDropdown = document.querySelector('#admin-nbfc-sort-options');
            const nbfcSortOptions = nbfcSortDropdown.querySelectorAll('li');
            const nbfcDetailsContainer = document.getElementById('admin-nbfc-details-container');

            if (nbfcSortTrigger && nbfcSortDropdown) {
                nbfcSortTrigger.addEventListener('click', function (event) {
                    event.stopPropagation();
                    nbfcSortDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function (event) {
                    if (!nbfcSortTrigger.contains(event.target)) {
                        nbfcSortDropdown.classList.remove('active');
                    }
                });

                nbfcSortDropdown.addEventListener('click', function (event) {
                    event.stopPropagation();
                });

                nbfcSortOptions.forEach(option => {
                    option.addEventListener('click', function () {
                        const sortType = this.getAttribute('data-sort');
                        const sortedNbfcs = [...nbfcs].sort((a, b) => {
                            const nameA = a.name.toLowerCase();
                            const nameB = b.name.toLowerCase();
                            const timestampA = new Date(a.timestamp || '2023-01-01').getTime();
                            const timestampB = new Date(b.timestamp || '2023-01-01').getTime();
                            switch (sortType) {
                                case 'az':
                                    return nameA.localeCompare(nameB);
                                case 'za':
                                    return nameB.localeCompare(nameA);
                                case 'newest':
                                    return timestampB - timestampA;
                                case 'oldest':
                                    return timestampA - timestampB;
                                default:
                                    return 0;
                            }
                        });

                        nbfcs.length = 0;
                        nbfcs.push(...sortedNbfcs);
                        initializeNBFCChat();
                        nbfcSortDropdown.classList.remove('active');
                    });
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

                if (target.classList.contains('triggeredbutton')) {
                    const messagesWrapper = parentContainer.querySelector(`#admin-${type}-messages-${chatId}`);
                    const chatContainer = parentContainer.querySelector(`#admin-${type}-input-${chatId}`);
                    const clearButtonContainer = parentContainer.querySelector(`#admin-${type}-clear-container-${chatId}`);
                    if (messagesWrapper.style.display === 'none') {
                        messagesWrapper.style.display = 'flex';
                        chatContainer.style.display = 'flex';
                        clearButtonContainer.style.display = 'flex';
                        parentContainer.style.height = 'auto';
                        target.textContent = 'Close';
                        // displayMessages(chatId, messagesWrapper);
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
                    sendMessage(chatId, messageInput.value, parentContainer, type);
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
                    handleFileUpload(chatId, parentContainer, type);
                }
            });

            // Initialize student chat on page load
            initializeStudentChat();
            initializeAdminChat();
        });
    </script>
</body>

</html>