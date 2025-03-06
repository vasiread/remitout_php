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


</script>


</body>
<html>



