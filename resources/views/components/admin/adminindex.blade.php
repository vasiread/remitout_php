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
                        <span class="admin-index-count" id="student-index-count">06</span>
                    </div>
                    <div class="admin-index-item">
                        <img src="assets/images/school.png" alt="" class="admin-index-icon">
                        <span>Student Councillors</span>
                        <span class="admin-index-count admin-index-count-orange" id="counsellor-index-count">04</span>
                    </div>
                    <div class="admin-index-item">
                        <img src="assets/images/nbfc-icon.png" alt="" class="admin-index-icon">
                        <span>NBFCs</span>
                        <span class="admin-index-count admin-index-count-gray" id="nbfc-index-count">00</span>
                    </div>

                </div>
            </div>

            <div class="inbox-container" class id="index-container-id">
                <div class="inbox-header">
                    <h2 class="dashboard-section-index">Student</h2>
                    <div class="inbox-controls">
                        <div class="index-search-container" id="index-search-container-id">
                            <img src="assets/images/search.png" alt="Search" class="index-search-icon">
                            <input type="text" class="index-search-input" placeholder="Search">
                        </div>
                        <div class="inbox-filters">
                            <span>Sort</span>
                            <img src="assets/images/filter-icon.png" alt="Filters">
                        </div>
                    </div>
                </div>

                <div class="message-thread" id="message-thread-id">
                    <div class="message-item">
                        <div class="message-header">
                            <h2 class="index-bank-name">Bank Name</h2>
                            <div class="message-actions">
                                <button class="inbox-btn-view">View</button>
                                <button class="inbox-btn-close">Close</button>
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

                        <div class="nbfc-individual-bankmessage-input">
                            <input type="text" placeholder="Send message" class="nbfc-message-input">
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
                        <div class="nbfc-individual-bankmessage-input-message"
                            id="nbfc-individual-bankmessage-input-message-id">
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
                        <div class="nbfc-individual-bankmessage-input-message"
                            id="nbfc-individual-bankmessage-input-message-id">
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
                        <div class="nbfc-individual-bankmessage-input-message"
                            id="nbfc-individual-bankmessage-input-message-id">
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
                        <div class="nbfc-individual-bankmessage-input-message"
                            id="nbfc-individual-bankmessage-input-message-id">
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

        document.addEventListener('DOMContentLoaded', function () {
            const messageButtons = document.querySelectorAll('.index-student-message-btn');
            overAllCounts();


            messageButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Find the parent container
                    const messageContainer = this.closest('.index-student-message-container');

                    // Find the message input div within the container
                    const messageInput = messageContainer.querySelector('.nbfc-individual-bankmessage-input-message');

                    // Toggle the visibility of the message input
                    if (messageInput) {
                        // Check if the message input is currently hidden
                        const isHidden = messageInput.style.display === 'none' || !messageInput.style.display;

                        // Hide all message inputs first
                        document.querySelectorAll('.nbfc-individual-bankmessage-input-message').forEach(input => {
                            input.style.display = 'none';
                        });

                        // Show this message input if it was hidden
                        if (isHidden) {
                            messageInput.style.display = 'flex';
                        }
                    }
                });
            });


        });

        const overAllCounts = () => {

            fetch("/overallcounts", {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Correctly fetch the CSRF token
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const students = data.receivedData.user < 10 ? "0" + data.receivedData.user : data.receivedData.user;
                        const nbfc = data.receivedData.nbfc < 10 ? "0" + data.receivedData.nbfc : data.receivedData.nbfc;
                        const counsellor = data.receivedData.counsellor < 10 ? "0" + data.receivedData.counsellor : data.receivedData.counsellor;
                        const counsellorId = document.getElementById('counsellor-index-count');
                        const studentId = document.getElementById('student-index-count');
                        const nbfcId = document.getElementById('nbfc-index-count');

                        if (counsellorId && studentId && nbfcId) {

                            counsellorId.textContent = counsellor;
                            studentId.textContent = students;
                            nbfcId.textContent = nbfc;

                        }


                    }
                    else if (data.error) {
                        console.log(data.error)
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });


        }

    </script>



</body>
<html>