<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="assets/css/nbfc.css">
     <link rel="stylesheet" href="assets/css/adminindex.css">
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
        
            <div class="admin-index-item active">
                <img src="assets/images/student-logo.png" alt="" class="admin-index-icon">
                <span>Students</span>
                <span class="admin-index-count">06</span>
            </div>
            <div class="admin-index-item">
                <img src="assets/images/school.png" alt="" class="admin-index-icon">
                <span>Student Councillors</span>
                <span class="admin-index-count admin-index-count-orange">04</span>
            </div>
            <div class="admin-index-item">
                <img src="assets/images/nbfc-icon.png" alt="" class="admin-index-icon">
                <span>NBFCs</span>
                <span class="admin-index-count admin-index-count-gray">00</span>
            </div>

           </div>  

            <div class="mobile-inbox-container">
           <span class="mobile-inbox-item active">Students</span>
          <span class="mobile-inbox-item">Student Counsellors</span>
          <span class="mobile-inbox-item">NBFCs</span>
        </div>

        </div>

       


        <div class="inbox-container" class id="index-container-id">
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
                            <ul class="admin-sort-dropdown" id="admin-index-sort-id">
                                <li data-sort="az">A-Z</li>
                                <li data-sort="za">Z-A</li>
                                <li data-sort="newest">Newest</li>
                                <li data-sort="oldest">Oldest</li>
                            </ul>
                    </div>
                </div>
            </div>

            <div class="message-thread" id="message-thread-id">
                <div class="message-item">
                    <div class="message-header">
                        <h2 class="index-bank-name">Bank Name</h2>
                        <div class="message-actions">
                            <button class="admin-inbox-btn-view">View</button>
                            <button class="admin-inbox-btn-close">Close</button>
                        </div>
                    </div>
                    <p class="message-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit
                    </p>
                </div>

                <div class="message-response">
                    <div class="message-response-container">
                        <p class="message-content-container">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            Lorem ipsum dolor sit amet.
                        </p>
                        <ol class="message-list">
                            <li>consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</li>
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



             <div class="index-student-details-container" id="index-student-details-container-admin-id">

                <!-- Student Message Card 1 -->
                <div class="index-student-message-container" id="index-student-message-container-id">
                    <div class="index-student-card" id="index-student-card-id">
                        <div class="index-student-info" id="index-student-info-id">
                            <h3 class="index-bank-name">Bank Name</h3>
                            <p class="index-student-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
                    <div class="nbfc-individual-bankmessage-input-message" id="nbfc-individual-bankmessage-input-message-id">
                        <input type="text" placeholder="Send message" class="nbfc-message-input">
                        <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                        <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                        <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                    </div>
                </div>

                <!-- Student Message Card 2 -->
                <div class="index-student-message-container" id="index-student-message-container-id">
                    <div class="index-student-card" id="index-student-card-id">
                        <div class="index-student-info" id="index-student-info-id">
                            <h3 class="index-bank-name">Bank Name</h3>
                            <p class="index-student-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
                     <div class="nbfc-individual-bankmessage-input-message" id="nbfc-individual-bankmessage-input-message-id">
                        <input type="text" placeholder="Send message" class="nbfc-message-input">
                        <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                        <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                        <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                    </div>
                </div>

                <!-- Student Message Card 3 -->
                <div class="index-student-message-container" id="index-student-message-container-id">
                    <div class="index-student-card" id="index-student-card-id">
                        <div class="index-student-info" id="index-student-info-id">
                            <h3 class="index-bank-name">Bank Name</h3>
                            <p class="index-student-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
                      <div class="nbfc-individual-bankmessage-input-message" id="nbfc-individual-bankmessage-input-message-id">
                        <input type="text" placeholder="Send message" class="nbfc-message-input">
                        <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                        <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                        <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                    </div>
                </div>

                <!-- Student Message Card 4 -->
                <div class="index-student-message-container" id="index-student-message-container-id">
                    <div class="index-student-card" id="index-student-card-id">
                        <div class="index-student-info" id="index-student-info-id">
                            <h3 class="index-bank-name">Bank Name</h3>
                            <p class="index-student-description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
                      <div class="nbfc-individual-bankmessage-input-message" id="nbfc-individual-bankmessage-input-message-id">
                        <input type="text" placeholder="Send message" class="nbfc-message-input">
                        <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                        <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                        <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                    </div>
                </div>

            </div>


    </section>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Expanded Bank Names Array with more variety
      const bankNames = [
        'Bank of Baroda',
        'State Bank of India (SBI)',
        'HDFC Bank',
        'ICICI Bank',
        'Axis Bank',
        'Canara Bank'
    ];
    // Enhanced Randomization Function
    function getRandomBankName() {
        return bankNames[Math.floor(Math.random() * bankNames.length)];
    }

    // Randomize Bank Names
    function randomizeBankNames() {
        const bankNameElements = document.querySelectorAll('.index-bank-name');
        const usedBanks = new Set(); // Ensure no immediate repetition

        bankNameElements.forEach(element => {
            let bankName;
            do {
                bankName = getRandomBankName();
            } while (usedBanks.has(bankName));
            
            usedBanks.add(bankName);
            element.textContent = bankName;
        });
    }

    // Call randomization on page load
    randomizeBankNames();

   // Search Functionality
const searchInput = document.getElementById('admin-search-input-id');
const studentCards = document.querySelectorAll('#index-student-message-container-id');
const messageThread = document.getElementById('message-thread-id');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();

        // Search in student cards
        studentCards.forEach(card => {
            const bankName = card.querySelector('#index-student-card-id .index-bank-name').textContent.toLowerCase();
            const description = card.querySelector('#index-student-card-id .index-student-description').textContent.toLowerCase();

            if (bankName.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        // Search in message thread
        if (messageThread) {
            const bankNameInThread = messageThread.querySelector('.index-bank-name');
            const messageContent = messageThread.querySelector('.message-content');
            const messageResponseContent = messageThread.querySelector('.message-content-container');
            const messageList = messageThread.querySelector('.message-list');

            let isVisible = false;

            if (bankNameInThread && messageContent && messageResponseContent && messageList) {
                const bankNameText = bankNameInThread.textContent.toLowerCase();
                const messageText = messageContent.textContent.toLowerCase();
                const responseText = messageResponseContent.textContent.toLowerCase();

                // Check list items
                const listItems = Array.from(messageList.querySelectorAll('li'))
                    .map(li => li.textContent.toLowerCase());

                // Check if search term is in any of the areas
                if (
                    bankNameText.includes(searchTerm) || 
                    messageText.includes(searchTerm) || 
                    responseText.includes(searchTerm) ||
                    listItems.some(item => item.includes(searchTerm))
                ) {
                    messageThread.style.display = 'block';
                    isVisible = true;
                } else {
                    messageThread.style.display = 'none';
                }
            }
        }
    });
}

    // Enhanced Sort Functionality
    const sortTrigger = document.querySelector('.admin-inbox-filters#admin-index-sort-id');
    const sortDropdown = sortTrigger.querySelector('.admin-sort-dropdown');
    const sortOptions = sortDropdown.querySelectorAll('li');
    const studentDetailsContainer = document.getElementById('index-student-details-container-admin-id');

    // Toggle sort dropdown visibility
    sortTrigger.addEventListener('click', function(event) {
        event.stopPropagation();
        sortDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        sortDropdown.classList.remove('active');
    });

    // Prevent dropdown from closing when clicking inside
    sortDropdown.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Enhanced Sorting with Multiple Criteria
    sortOptions.forEach(option => {
        option.addEventListener('click', function() {
            const sortType = this.getAttribute('data-sort');
            const cards = Array.from(studentDetailsContainer.querySelectorAll('.index-student-message-container'));

            const sortedCards = cards.sort((a, b) => {
                const bankNameA = a.querySelector('.index-bank-name').textContent;
                const bankNameB = b.querySelector('.index-bank-name').textContent;
                const descriptionA = a.querySelector('.index-student-description').textContent;
                const descriptionB = b.querySelector('.index-student-description').textContent;

                switch(sortType) {
                    case 'az':
                        return bankNameA.localeCompare(bankNameB);
                    case 'za':
                        return bankNameB.localeCompare(bankNameA);
                    case 'newest':
                        // Placeholder for most recent/latest description
                        return descriptionA.length - descriptionB.length;
                    case 'oldest':
                        // Placeholder for oldest/shortest description
                        return descriptionB.length - descriptionA.length;
                    default:
                        return 0;
                }
            });

            // Clear and re-append sorted cards
            studentDetailsContainer.innerHTML = '';
            sortedCards.forEach(card => studentDetailsContainer.appendChild(card));

            // Also sort the message thread based on the same criteria
            if (messageThread) {
                const messageBankName = messageThread.querySelector('.index-bank-name');
                const messageContent = messageThread.querySelector('.message-content');

                if (messageBankName && messageContent) {
                    // Modify message thread's display based on the first sorted card's bank name
                    const firstSortedBankName = sortedCards[0].querySelector('.index-bank-name').textContent;
                    messageBankName.textContent = firstSortedBankName;
                }
            }

            // Close dropdown after selection
            sortDropdown.classList.remove('active');
        });
    });


    // Message Button Functionality (Previous implementation remains the same)
    const messageButtons = document.querySelectorAll('.index-student-message-btn');
    messageButtons.forEach(button => {
        button.addEventListener('click', function() {
            const messageContainer = this.closest('.index-student-message-container');
            const messageInput = messageContainer.querySelector('.admin-individual-bankmessage-input-message');
            
            if (messageInput) {
                // Hide all message inputs first
                document.querySelectorAll('.admin-individual-bankmessage-input-message').forEach(input => {
                    input.style.display = 'none';
                });
                
                // Toggle the clicked message input
                messageInput.style.display = messageInput.style.display === 'flex' ? 'none' : 'flex';
            }
        });
    });

   

    // Ensure sorting and randomization on page load
    randomizeBankNames();
});



// Initialize Admin Chat Functionality
    initializeAdminChat();
    
    function initializeAdminChat() {
        // Target all message inputs in the admin interface
        const adminChatContainers = document.querySelectorAll('.admin-individual-bankmessage-input, .nbfc-individual-bankmessage-input-message');
        
        if (adminChatContainers.length === 0) return;
        
        adminChatContainers.forEach((chatContainer, index) => {
            // Create unique identifier for this chat instance
            const chatId = `admin-chat-${index}`;
            chatContainer.setAttribute('data-chat-id', chatId);
            
            // Find related elements
            const parentCard = chatContainer.closest('.index-student-message-container') || 
                              chatContainer.closest('.message-thread');
            const messageButton = parentCard ? parentCard.querySelector('.index-student-message-btn') : null;
            const bankName = parentCard ? parentCard.querySelector('.index-bank-name')?.textContent : 'Chat';
            
            // Create messages wrapper if it doesn't exist
            let messagesWrapper = document.createElement("div");
            messagesWrapper.classList.add("admin-messages-wrapper");
            messagesWrapper.setAttribute('data-chat-id', chatId);
            messagesWrapper.style.cssText = `
                display: none;
                flex-direction: column;
                width: 100%;  
                font-size: 14px;
                color: #666;
                line-height: 1.5; 
                overflow-y: auto;
                max-height: 200px;
                background: #fff;
                font-family: 'Poppins', sans-serif;
                margin-bottom: 10px;
                padding: 10px;
                border-top: 1px solid #eee;
            `;
            chatContainer.parentNode.insertBefore(messagesWrapper, chatContainer);
            
            // Find chat elements
            const messageInput = chatContainer.querySelector("input[type='text']");
            const sendButton = chatContainer.querySelector(".nbfc-send-img");
            const paperclipIcon = chatContainer.querySelector(".nbfc-paperclip");
            const smileIcon = chatContainer.querySelector(".nbfc-face-smile");
            
            // Add clear chat button
            const clearButtonContainer = document.createElement("div");
            clearButtonContainer.style.cssText = `
                display: none;
                justify-content: flex-end;
                width: 100%;
                margin-bottom: 5px;
            `;
            
            const clearButton = document.createElement("button");
            clearButton.textContent = "Clear Chat";
            clearButton.style.cssText = `
                background-color: #f0f0f0;
                border: none;
                border-radius: 4px;
                padding: 4px 12px;
                font-size: 12px;
                color: #666;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
            `;
            clearButton.addEventListener('click', function() {
                clearChat(chatId);
            });
            
            clearButtonContainer.appendChild(clearButton);
            messagesWrapper.parentNode.insertBefore(clearButtonContainer, messagesWrapper);
            
            // Function to show chat
            function showChat() {
                messagesWrapper.style.display = 'flex';
                chatContainer.style.display = 'flex';
                clearButtonContainer.style.display = 'flex';
            }
            
            // Function to hide chat
            function hideChat() {
                messagesWrapper.style.display = 'none';
                chatContainer.style.display = 'none';
                clearButtonContainer.style.display = 'none';
            }
            
            // Toggle chat visibility
            function toggleChat() {
                if (messagesWrapper.style.display === 'none') {
                    showChat();
                    loadSavedMessages(chatId, messagesWrapper);
                } else {
                    hideChat();
                }
            }
            
            // Handle message button clicks
            if (messageButton) {
                messageButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleChat();
                });
            }
            
            // Send message function
            function sendMessage() {
                if (!messageInput) return;
                
                const content = messageInput.value.trim();
                if (content) {
                    showChat();
                    
                    // Create sent message element
                    const messageElement = createMessageElement(content, 'sent');
                    messagesWrapper.appendChild(messageElement);
                    
                    // Create auto-reply message (simulating response)
                    setTimeout(() => {
                        const responseContent = getAutoResponse(content, bankName);
                        const responseElement = createMessageElement(responseContent, 'received');
                        messagesWrapper.appendChild(responseElement);
                        messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                        
                        // Save the received message
                        saveMessage({
                            content: responseContent,
                            type: 'received',
                            timestamp: new Date().toISOString()
                        }, chatId);
                    }, 1000);
                    
                    // Clear input and scroll to bottom
                    messageInput.value = "";
                    messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                    
                    // Save the sent message
                    saveMessage({
                        content: content,
                        type: 'sent',
                        timestamp: new Date().toISOString()
                    }, chatId);
                }
            }
            
            // Create message element
            function createMessageElement(content, type) {
                const messageElement = document.createElement("div");
                messageElement.style.cssText = `
                    display: flex;
                    justify-content: ${type === 'sent' ? 'flex-end' : 'flex-start'};
                    width: 100%;
                    margin-bottom: 10px;
                `;
                
                const messageContent = document.createElement("div");
                messageContent.style.cssText = `
                    max-width: 80%;
                    padding: 8px 12px;
                    border-radius: 8px;
                    background-color: ${type === 'sent' ? '#e6f7ff' : '#f2f2f2'};
                    color: #333;
                    word-wrap: break-word;
                    font-family: 'Poppins', sans-serif;
                `;
                messageContent.textContent = content;
                
                messageElement.appendChild(messageContent);
                return messageElement;
            }
            
            // Handle send button click
            if (sendButton) {
                sendButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    sendMessage();
                });
            }
            
            // Handle Enter key press
            if (messageInput) {
                messageInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        sendMessage();
                    }
                });
            }
            
            // Handle emoji picker
            if (smileIcon) {
                smileIcon.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    // Remove any existing emoji picker
                    const existingPicker = document.querySelector(".emoji-picker");
                    if (existingPicker) {
                        existingPicker.remove();
                        return;
                    }
                    
                    const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];
                    
                    const picker = document.createElement("div");
                    picker.classList.add("emoji-picker");
                    picker.style.cssText = `
                        position: absolute;
                        bottom: 100%;
                        right: 30px;
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
                        const button = document.createElement("button");
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
                    
                    document.addEventListener("click", function closePicker(e) {
                        if (!picker.contains(e.target) && e.target !== smileIcon) {
                            picker.remove();
                            document.removeEventListener("click", closePicker);
                        }
                    });
                });
            }
            
            // Handle file attachment
            if (paperclipIcon) {
                paperclipIcon.addEventListener('click', function() {
                    const fileInput = document.createElement("input");
                    fileInput.type = "file";
                    fileInput.accept = ".pdf,.jpeg,.png,.jpg";
                    fileInput.style.display = "none";
                    
                    fileInput.onchange = (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            showChat();
                            const fileName = file.name;
                            const fileSize = (file.size / 1024 / 1024).toFixed(2);
                            const fileId = `file-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
                            
                            // Create file message element
                            const messageElement = document.createElement("div");
                            messageElement.style.cssText = `
                                display: flex;
                                justify-content: flex-end;
                                width: 100%;
                                margin-bottom: 10px;
                            `;
                            
                            const fileContent = document.createElement("div");
                            fileContent.style.cssText = `
                                max-width: 80%;
                                padding: 8px 12px;
                                border-radius: 8px;
                                background-color: #e6f7ff;
                                display: flex;
                                align-items: center;
                                gap: 8px;
                            `;
                            
                            fileContent.innerHTML = `
                                <i class="fa-solid fa-file"></i>
                                <span>${fileName} (${fileSize} MB)</span>
                            `;
                            
                            messageElement.appendChild(fileContent);
                            messagesWrapper.appendChild(messageElement);
                            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                            
                            // Save file message
                            saveMessage({
                                content: `File: ${fileName} (${fileSize} MB)`,
                                type: 'sent',
                                isFile: true,
                                timestamp: new Date().toISOString()
                            }, chatId);
                            
                            // Create auto-reply for file
                            setTimeout(() => {
                                const responseContent = `File received: ${fileName}. We'll review it shortly.`;
                                const responseElement = createMessageElement(responseContent, 'received');
                                messagesWrapper.appendChild(responseElement);
                                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
                                
                                // Save the received message
                                saveMessage({
                                    content: responseContent,
                                    type: 'received',
                                    timestamp: new Date().toISOString()
                                }, chatId);
                            }, 1000);
                        }
                    };
                    
                    document.body.appendChild(fileInput);
                    fileInput.click();
                    document.body.removeChild(fileInput);
                });
            }
            
            // Load messages initially if chat is shown
            if (messagesWrapper.style.display !== 'none') {
                loadSavedMessages(chatId, messagesWrapper);
            }
        });
    }
    
    // Function to save message
    function saveMessage(messageData, chatId) {
        const messages = JSON.parse(localStorage.getItem(`admin-messages-${chatId}`) || '[]');
        messages.push(messageData);
        localStorage.setItem(`admin-messages-${chatId}`, JSON.stringify(messages));
    }
    
    // Function to load saved messages
    function loadSavedMessages(chatId, messagesWrapper) {
        const savedMessages = JSON.parse(localStorage.getItem(`admin-messages-${chatId}`) || '[]');
        
        // Clear existing messages
        messagesWrapper.innerHTML = '';
        
        if (savedMessages.length > 0) {
            savedMessages.forEach(msg => {
                const messageElement = document.createElement("div");
                messageElement.style.cssText = `
                    display: flex;
                    justify-content: ${msg.type === 'sent' ? 'flex-end' : 'flex-start'};
                    width: 100%;
                    margin-bottom: 10px;
                `;
                
                const messageContent = document.createElement("div");
                messageContent.style.cssText = `
                    max-width: 80%;
                    padding: 8px 12px;
                    border-radius: 8px;
                    background-color: ${msg.type === 'sent' ? '#e6f7ff' : '#f2f2f2'};
                    color: #333;
                    word-wrap: break-word;
                    font-family: 'Poppins', sans-serif;
                    ${msg.isFile ? 'display: flex; align-items: center; gap: 8px;' : ''}
                `;
                
                if (msg.isFile) {
                    messageContent.innerHTML = `<i class="fa-solid fa-file"></i> ${msg.content}`;
                } else {
                    messageContent.textContent = msg.content;
                }
                
                messageElement.appendChild(messageContent);
                messagesWrapper.appendChild(messageElement);
            });
            
            // Scroll to bottom
            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
        }
    }
    
    // Function to clear chat
    function clearChat(chatId) {
        localStorage.removeItem(`admin-messages-${chatId}`);
        const messagesWrapper = document.querySelector(`.admin-messages-wrapper[data-chat-id="${chatId}"]`);
        
        if (messagesWrapper) {
            // Clear all messages
            messagesWrapper.innerHTML = '';
            
            // Add confirmation message
            const confirmationMsg = document.createElement("div");
            confirmationMsg.style.cssText = `
                width: 100%;
                text-align: center;
                padding: 10px;
                color: #999;
                font-style: italic;
                font-size: 12px;
            `;
            confirmationMsg.textContent = "Chat history cleared";
            messagesWrapper.appendChild(confirmationMsg);
            
            // Remove confirmation after 3 seconds
            setTimeout(() => {
                if (messagesWrapper.contains(confirmationMsg)) {
                    messagesWrapper.removeChild(confirmationMsg);
                }
            }, 3000);
        }
    }
    
   z
    
</script>


</body>
<html>



