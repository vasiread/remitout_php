<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/nbfc.css">
    <link rel="stylesheet" href="assets/css/adminindex.css">
    <style>
        /* Ensure containers and message threads are hidden by default */
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
                    <div class="admin-index-item" data-target="counsellor-container">
                        <img src="assets/images/school.png" alt="" class="admin-index-icon">
                        <span>Student Counsellors</span>
                        <span class="admin-index-count admin-index-count-orange" id="counsellor-index-count">04</span>
                    </div>
                    <div class="admin-index-item" data-target="nbfc-container">
                        <img src="assets/images/nbfc-icon.png" alt="" class="admin-index-icon">
                        <span>NBFCs</span>
                        <span class="admin-index-count admin-index-count-gray" id="nbfc-index-count">00</span>
                    </div>
                </div>

                <div class="mobile-inbox-container">
                    <span class="mobile-inbox-item active" data-target="inbox-container">Students</span>
                    <span class="mobile-inbox-item" data-target="counsellor-container">Student Counsellors</span>
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
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
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
                    <!-- Additional student cards omitted for brevity -->
                </div>
            </div>

            <!-- Student Counsellors Container -->
            <div class="inbox-container" id="counsellor-container">
                <div class="inbox-header">
                    <h2 class="dashboard-section-index">Student Counsellors</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="admin-search-container-counsellor-id">
                            <svg class="admin-nav-search-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" class="index-search-input" id="admin-search-input-counsellor-id" placeholder="Search">
                        </div>
                        <div class="admin-inbox-filters" id="admin-index-sort-counsellor-id">
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

                <div class="message-thread" id="message-thread-counsellor-id">
                    <div class="message-item">
                        <div class="message-header">
                            <h2 class="index-bank-name">Counsellor Name</h2>
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

                <div class="index-student-details-container" id="index-counsellor-details-container-admin-id">
                    <!-- Counsellor Message Card 1 -->
                    <div class="index-student-message-container" id="index-counsellor-message-container-id">
                        <div class="index-student-card" id="index-counsellor-card-id">
                            <div class="index-student-info" id="index-counsellor-info-id">
                                <h3 class="index-bank-name">Counsellor Name</h3>
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
                        <div class="nbfc-individual-bankmessage-input-message" id="nbfc-individual-counsellor-message-input-message-id">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
                            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
                            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
                            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
                        </div>
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
                    <!-- NBFC Message Card 1 -->
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
            console.log('DOM fully loaded'); // Debug: Confirm script is running

            // Expanded Names Arrays
            const bankNames = [
                'Bank of Baroda', 'State Bank of India (SBI)', 'HDFC Bank',
                'ICICI Bank', 'Axis Bank', 'Canara Bank'
            ];
            const counsellorNames = [
                'John Doe', 'Jane Smith', 'Michael Brown',
                'Emily Davis', 'David Wilson', 'Sarah Johnson'
            ];
            const nbfcNames = [
                'Bajaj Finance', 'Mahindra Finance', 'Tata Capital',
                'HDB Financial', 'Shriram Finance', 'Aditya Birla Finance'
            ];

            // Randomization Function
            function getRandomName(namesArray) {
                return namesArray[Math.floor(Math.random() * namesArray.length)];
            }

            // Randomize Names for Each Container
            function randomizeNames(containerId, namesArray, nameClass) {
                const containers = document.querySelectorAll(`#${containerId} .${nameClass}`);
                console.log(`Randomizing names for ${containerId}: Found ${containers.length} elements`); // Debug
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

            // Initialize Names
            randomizeNames('inbox-container', bankNames, 'index-bank-name');
            randomizeNames('counsellor-container', counsellorNames, 'index-bank-name');
            randomizeNames('nbfc-container', nbfcNames, 'index-bank-name');

            // Toggle Containers and Active State
            const indexItems = document.querySelectorAll('.admin-index-item');
            const mobileItems = document.querySelectorAll('.mobile-inbox-item');
            const containers = document.querySelectorAll('.inbox-container');

            console.log(`Found ${indexItems.length} admin-index-items`); // Debug
            console.log(`Found ${mobileItems.length} mobile-inbox-items`); // Debug
            console.log(`Found ${containers.length} inbox-containers`); // Debug

            function toggleContainer(targetId) {
                console.log(`Toggling container: ${targetId}`); // Debug

                // Hide all containers
                containers.forEach(container => {
                    container.classList.remove('active');
                    container.style.display = 'none';
                });

                // Show the target container
                const targetContainer = document.getElementById(targetId);
                if (targetContainer) {
                    targetContainer.classList.add('active');
                    targetContainer.style.display = 'block';
                    console.log(`Showing container: ${targetId}`); // Debug
                } else {
                    console.error(`Container with ID ${targetId} not found`); // Debug
                }

                // Update active state for admin-index-items
                indexItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-target') === targetId);
                });

                // Update active state for mobile-inbox-items
                mobileItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-target') === targetId);
                });
            }

            // Initialize default state (show inbox-container, hide others)
            toggleContainer('inbox-container');

            // Event Listeners for Admin Index Items
            indexItems.forEach(item => {
                item.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    console.log(`Admin index item clicked: ${targetId}`); // Debug
                    toggleContainer(targetId);
                });
            });

            // Event Listeners for Mobile Inbox Items
            mobileItems.forEach(item => {
                item.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    console.log(`Mobile inbox item clicked: ${targetId}`); // Debug
                    toggleContainer(targetId);
                });
            });

            // View and Close Button Functionality for Each Container
            function setupViewCloseButtons(containerId, messageThreadId) {
                const messageThread = document.getElementById(messageThreadId);
                const viewButton = messageThread.querySelector('.admin-inbox-btn-view');
                const closeButton = messageThread.querySelector('.admin-inbox-btn-close');

                if (viewButton) {
                    viewButton.addEventListener('click', function() {
                        console.log(`View button clicked in ${containerId}`); // Debug
                        messageThread.classList.add('active');
                        messageThread.style.display = 'block';
                    });
                } else {
                    console.error(`View button not found in ${messageThreadId}`); // Debug
                }

                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        console.log(`Close button clicked in ${containerId}`); // Debug
                        messageThread.classList.remove('active');
                        messageThread.style.display = 'none';
                    });
                } else {
                    console.error(`Close button not found in ${messageThreadId}`); // Debug
                }
            }

            // Setup View/Close Buttons for Each Container
            setupViewCloseButtons('inbox-container', 'message-thread-id');
            setupViewCloseButtons('counsellor-container', 'message-thread-counsellor-id');
            setupViewCloseButtons('nbfc-container', 'message-thread-nbfc-id');

            // Search Functionality for Each Container
            function setupSearch(containerId, searchInputId, cardContainerId, messageThreadId) {
                const searchInput = document.getElementById(searchInputId);
                const studentCards = document.querySelectorAll(`#${cardContainerId} .index-student-message-container`);
                const messageThread = document.getElementById(messageThreadId);

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        console.log(`Search triggered for ${containerId}`); // Debug
                        const searchTerm = this.value.toLowerCase().trim();

                        // Search in cards
                        studentCards.forEach(card => {
                            const name = card.querySelector('.index-bank-name').textContent.toLowerCase();
                            const description = card.querySelector('.index-student-description').textContent.toLowerCase();

                            if (name.includes(searchTerm) || description.includes(searchTerm)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });

                        // Search in message thread
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
                } else {
                    console.error(`Search input ${searchInputId} not found`); // Debug
                }
            }

            // Setup Search for Each Container
            setupSearch(
                'inbox-container',
                'admin-search-input-id',
                'index-student-details-container-admin-id',
                'message-thread-id'
            );
            setupSearch(
                'counsellor-container',
                'admin-search-input-counsellor-id',
                'index-counsellor-details-container-admin-id',
                'message-thread-counsellor-id'
            );
            setupSearch(
                'nbfc-container',
                'admin-search-input-nbfc-id',
                'index-nbfc-details-container-admin-id',
                'message-thread-nbfc-id'
            );

            // Sort Functionality for Each Container
            function setupSort(containerId, sortTriggerId, detailsContainerId, messageThreadId) {
                const sortTrigger = document.querySelector(`#${sortTriggerId}`);
                if (!sortTrigger) {
                    console.error(`Sort trigger ${sortTriggerId} not found`); // Debug
                    return;
                }
                const sortDropdown = sortTrigger.querySelector('.admin-sort-dropdown');
                const sortOptions = sortDropdown.querySelectorAll('li');
                const studentDetailsContainer = document.getElementById(detailsContainerId);

                sortTrigger.addEventListener('click', function(event) {
                    event.stopPropagation();
                    console.log(`Sort trigger clicked for ${containerId}`); // Debug
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
                        console.log(`Sorting ${containerId} by ${sortType}`); // Debug
                        const cards = Array.from(studentDetailsContainer.querySelectorAll('.index-student-message-container'));

                        const sortedCards = cards.sort((a, b) => {
                            const nameA = a.querySelector('.index-bank-name').textContent;
                            const nameB = b.querySelector('.index-bank-name').textContent;
                            const descriptionA = a.querySelector('.index-student-description').textContent;
                            const descriptionB = b.querySelector('.index-student-description').textContent;

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

            // Setup Sort for Each Container
            setupSort(
                'inbox-container',
                'admin-index-sort-id',
                'index-student-details-container-admin-id',
                'message-thread-id'
            );
            setupSort(
                'counsellor-container',
                'admin-index-sort-counsellor-id',
                'index-counsellor-details-container-admin-id',
                'message-thread-counsellor-id'
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
                        console.log(`Message button clicked in ${containerId}`); // Debug
                        const messageContainer = this.closest('.index-student-message-container');
                        const messageInput = messageContainer.querySelector('.nbfc-individual-bankmessage-input-message');
                        if (messageInput) {
                            document.querySelectorAll(`#${containerId} .nbfc-individual-bankmessage-input-message`).forEach(input => {
                                input.style.display = 'none';
                            });
                            messageInput.style.display = messageInput.style.display === 'flex' ? 'none' : 'flex';
                        }
                    });
                });
            }

            // Setup Message Buttons for Each Container
            setupMessageButtons('inbox-container');
            setupMessageButtons('counsellor-container');
            setupMessageButtons('nbfc-container');

            // Card View Button Functionality
            function setupCardViewButtons(containerId, messageThreadId) {
                const viewButtons = document.querySelectorAll(`#${containerId} .index-student-view-btn`);
                const messageThread = document.getElementById(messageThreadId);

                viewButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        console.log(`Card view button clicked in ${containerId}`); // Debug
                        if (messageThread) {
                            messageThread.classList.add('active');
                            messageThread.style.display = 'block';
                            // Optionally update message thread content based on the card
                            const card = this.closest('.index-student-card');
                            const bankName = card.querySelector('.index-bank-name').textContent;
                            messageThread.querySelector('.index-bank-name').textContent = bankName;
                        }
                    });
                });
            }

            // Setup Card View Buttons for Each Container
            setupCardViewButtons('inbox-container', 'message-thread-id');
            setupCardViewButtons('counsellor-container', 'message-thread-counsellor-id');
            setupCardViewButtons('nbfc-container', 'message-thread-nbfc-id');
        });
    </script>
</body>
</html>