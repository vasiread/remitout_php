<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remitout-NBFC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="assets/css/nbfc.css">
     
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>

@extends('layouts.app')

<nav class="nbfc-navbar">
    <div class="nbfc-logo">
        <img src="/assets/images/nbfc-logo.png" alt="Remitout Logo">
    </div>

    <div class="nbfc-nav-right">
        <div class="nbfc-search-container">
            <img src="assets/images/search.png" alt="Search" class="nbfc-search-icon">
            <input type="text" class="nbfc-search-input" placeholder="Search">
        </div>

        <button class="nbfc-dark-mode">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
        </button>

        <div class="nbfc-profile">
            <div class="nbfc-avatar"></div>
            <span class="nbfc-profile-text">Bank Rep</span>
            <div class="nbfc-dropdown-icon"></div>
        </div>
    </div>

    <!-- Add an id to the mobile menu button -->
    <button id="nbfcMobileMenuBtn" class="nbfc-mobile-menu-btn">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<div class="nbfc-mobile-sidebar">
    <ul class="nbfc-mobile-menu-top">
        <li class="active">
            <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
        </li>
        <li>
            <i class="fas fa-inbox"></i> Inbox
        </li>
    </ul>

    <ul class="nbfc-mobile-menu-bottom">
        <li>
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </li>
        <li>
            <i class="fa-solid fa-headset"></i> Support
        </li>
    </ul>
</div>

<div class="nbfc-mobile-overlay"></div>

<div class="nbfcstudentdashboardprofile-togglesidebar">
    <ul class="nbfcstudentdashboardprofile-sidebarlists-top">
        <li class="nbfcactive">
            <i class="fa-solid fa-square-poll-vertical"></i> Dashboard
        </li>
        <li>
            <i class="fa-solid fa-inbox"></i> Inbox
        </li>
    </ul>

    <ul class="nbfcstudentdashboardprofile-sidebarlists-bottom">
        <li class="nbfclogoutBtn" onClick="sessionLogout()">
            <img src="assets/images/logout-icon.png" alt="Logout Icon" /> Log out
        </li>
        <li>
            <img src="assets/images/support_agent.png" alt="Support Icon" /> Support
        </li>
    </ul>
</div>

<div class="nbfc-mobile-overlay"></div>



<section class="dashboard-main-content">
    <div class="dashboard-sections-container" id="dashboard-container">    
        <section class="dashboard-section">
            <div class="dashboard-section-header">
                <h2 class="dashboard-section-title">Requests</h2>
                <div class="dashboard-header-controls">
                    <div class="dashboard-sort-button-container">
                        <button class="dashboard-sort-button">
                            Sort
                            <img src="assets/images/filter-icon.png" alt="Filter">
                        </button>
                        <div class="dashboard-sort-options" style="display: none;">
                            <button class="dashboard-sort-option" data-sort="A-Z">A-Z</button>
                            <button class="dashboard-sort-option" data-sort="Z-A">Z-A</button>
                            <button class="dashboard-sort-option" data-sort="Newest">Newest</button>
                            <button class="dashboard-sort-option" data-sort="Oldest">Oldest</button>
                        </div>
                    </div>
                      <div class="dashboard-nbfc-search-container">
                          <img src="assets/images/search.png" alt="Search" class="dashboard-nbfc-search-icon">
                          <input type="text" class="dashboard-nbfc-search-input" placeholder="Search">
                       </div>
                    <button class="dashboard-search-button">
                        <img src="assets/images/search.png" alt="Search">
                    </button>
                </div>    
            </div>
            <div class="dashboard-student-list" id="dashboard-request-list">
                <!-- Dynamically populated list for Requests goes here -->
            </div>
        </section>

        <section class="dashboard-section">
            <div class="dashboard-section-header">
                <h2 class="dashboard-section-title">Proposals</h2>
                <div class="dashboard-header-controls">
                 
                    <div class="dashboard-sort-button-container">
                        <button class="dashboard-sort-button">
                            Sort
                            <img src="assets/images/filter-icon.png" alt="Filter">
                        </button>
                        <div class="dashboard-sort-options" style="display: none;">
                            <button class="dashboard-sort-option" data-sort="A-Z">A-Z</button>
                            <button class="dashboard-sort-option" data-sort="Z-A">Z-A</button>
                            <button class="dashboard-sort-option" data-sort="Newest">Newest</button>
                            <button class="dashboard-sort-option" data-sort="Oldest">Oldest</button>
                        </div>
                    </div>
                     <div class="dashboard-nbfc-search-container">
                          <img src="assets/images/search.png" alt="Search" class="dashboard-nbfc-search-icon">
                          <input type="text" class="dashboard-nbfc-search-input" placeholder="Search">
                       </div>

                    <button class="dashboard-search-button">
                        <img src="assets/images/search.png" alt="Search">
                    </button>
                </div>
            </div>
            <div class="dashboard-student-list" id="dashboard-proposal-list">
                <!-- Dynamically populated list for Proposals goes here -->
            </div>
        </section>
    </div>

    <!---view trigger--->

    <div class="nbfc-studentdashboard-profile-container">
       <!-- Your profile content -->

        @if(isset($student))
        <!-- Your student profile content -->
       @endif
    </div>

   







<div class="modal-container" style="display: none;">
  <div class="reject-application-modal">
    <div class="reject-application-modal-header">
      <h3>Reject Application</h3>
      <button class="close-button">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="reject-application-modal-content">
      <textarea class="remarks-textarea" placeholder="Add Remarks"></textarea>
      <div class="actions">
        <button class="cancel-button">Cancel</button>
        <button class="reject-button">Reject</button>
      </div>
    </div>
  </div>
</div>


<section class="index-section">
    <div class="inbox-container" style="display: none;">
        <div class="inbox-header">
            <h2 class="dashboard-section-title">Inbox</h2>
            <div class="inbox-controls">
                <div class="index-search-container">
                    <img src="assets/images/search.png" alt="Search" class="index-search-icon">
                    <input type="text" class="index-search-input" placeholder="Search">
                </div>
                <div class="inbox-filters">
                    <span>Filters</span>
                    <img src="assets/images/filter-icon.png" alt="Filters">
                </div>
            </div>
        </div>

        <div class="message-thread">
            <div class="message-item">
                <div class="message-header">
                    <h2 class="student-name">Student Name</h2>
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
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



   <div class="index-student-details-container">
    
    <!-- Student Message Card 1 -->
    <div class="index-student-message-container">
        <div class="index-student-card">
            <div class="index-student-info">
                <h3 class="index-student-name">Student Name</h3>
                <p class="index-student-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
        <div class="nbfc-individual-bankmessage-input-message">
            <input type="text" placeholder="Send message" class="nbfc-message-input">
            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
        </div>
    </div>

    <!-- Student Message Card 2 -->
    <div class="index-student-message-container">
        <div class="index-student-card">
            <div class="index-student-info">
                <h3 class="index-student-name">Student Name</h3>
                <p class="index-student-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
       <div class="nbfc-individual-bankmessage-input-message">
            <input type="text" placeholder="Send message" class="nbfc-message-input">
            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
        </div>
    </div>

    <!-- Student Message Card 3 -->
    <div class="index-student-message-container">
        <div class="index-student-card">
            <div class="index-student-info">
                <h3 class="index-student-name">Student Name</h3>
                <p class="index-student-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
        <div class="nbfc-individual-bankmessage-input-message">
            <input type="text" placeholder="Send message" class="nbfc-message-input">
            <img class="nbfc-send-img" src="assets/images/send-nbfc.png" alt="send icon">
            <i class="fa-solid fa-paperclip nbfc-paperclip"></i>
            <i class="fa-regular fa-face-smile nbfc-face-smile"></i>
        </div>
    </div>

    <!-- Student Message Card 4 -->
    <div class="index-student-message-container">
        <div class="index-student-card">
            <div class="index-student-info">
                <h3 class="index-student-name">Student Name</h3>
                <p class="index-student-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut elit, sed do eiusmod tempor incididunt ut.
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
       <div class="nbfc-individual-bankmessage-input-message">
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
    // Reference elements
    const mobileMenuBtn = document.getElementById('nbfcMobileMenuBtn');
    const mobileSidebar = document.querySelector('.nbfc-mobile-sidebar');
    const mobileOverlay = document.querySelector('.nbfc-mobile-overlay');
    const nbfcNavRight = document.querySelector('.nbfc-nav-right'); // Select nav-right

    // Select elements for menu items
    const dashboardBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(1)'); // Dashboard
    const inboxBtn = document.querySelector('.nbfc-mobile-menu-top li:nth-child(2)'); // Inbox
    const dashboardContainer = document.querySelector('.dashboard-sections-container');
    const inboxContainer = document.querySelector('.inbox-container');

 function checkWindowSize() {
    if (window.innerWidth > 768) { // Hide mobile menu and sidebar for screens greater than 768px
        mobileSidebar.classList.remove('active');
        mobileOverlay.classList.remove('active');
        mobileMenuBtn.style.display = 'none'; // Hide mobile menu button
    } else {
        mobileMenuBtn.style.display = 'block'; // Show mobile menu button for 768px and below
    }
 }

// Run function on page load and window resize
checkWindowSize();
window.addEventListener('resize', checkWindowSize);


    // Function to toggle the mobile sidebar and hide/show nav-right
    function toggleMobileSidebar() {
        // Only toggle sidebar on mobile
        if (window.innerWidth <= 768) {
            mobileSidebar.classList.toggle('active');
            mobileOverlay.classList.toggle('active');

            // Hide nbfc-nav-right only on mobile
            nbfcNavRight.classList.toggle('hidden');

            const icon = mobileMenuBtn.querySelector('i');

            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    }

    // Event listener for the mobile menu button
    mobileMenuBtn.addEventListener('click', toggleMobileSidebar);

    // Close sidebar when clicking the overlay
    mobileOverlay.addEventListener('click', () => {
        mobileSidebar.classList.remove('active');
        mobileOverlay.classList.remove('active');

        if (window.innerWidth <= 768) { // Show nav-right again only on mobile
            nbfcNavRight.classList.remove('hidden');
        }

        const icon = mobileMenuBtn.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    });

    // Function to remove 'active' class from both tabs and add to the clicked one
    function setActiveTab(selectedTab) {
        // Remove the 'active' class from both menu items
        dashboardBtn.classList.remove('active');
        inboxBtn.classList.remove('active');

        // Add the 'active' class to the selected tab
        selectedTab.classList.add('active');
    }

    // Function to show the dashboard and hide the inbox
    dashboardBtn.addEventListener('click', () => {
        // Hide sidebar when a menu item is clicked
        mobileSidebar.classList.remove('active');
        mobileOverlay.classList.remove('active');

        // Show dashboard container and hide inbox container
        dashboardContainer.style.display = 'block';
        inboxContainer.style.display = 'none';

        // Show nav-right again on mobile
        nbfcNavRight.classList.remove('hidden');

        // Change the mobile menu icon to 'bars' when sidebar is closed
        const icon = mobileMenuBtn.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');

        // Set the active tab
        setActiveTab(dashboardBtn);
    });

    // Function to show the inbox and hide the dashboard
    inboxBtn.addEventListener('click', () => {
        // Hide sidebar when a menu item is clicked
        mobileSidebar.classList.remove('active');
        mobileOverlay.classList.remove('active');

        // Show inbox container and hide dashboard container
        inboxContainer.style.display = 'block';
        dashboardContainer.style.display = 'none';

        // Show nav-right again on mobile
        nbfcNavRight.classList.remove('hidden');

        // Change the mobile menu icon to 'bars' when sidebar is closed
        const icon = mobileMenuBtn.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');

        // Set the active tab
        setActiveTab(inboxBtn);
    });

    // Set default state (optional: show dashboard by default)
    dashboardContainer.style.display = 'block'; // Show the dashboard container initially
    inboxContainer.style.display = 'none'; // Hide the inbox container initially

    // Add 'active' class to dashboard by default
    setActiveTab(dashboardBtn);

    // Check window size on load and resize to handle sidebar visibility
    checkWindowSize();
    window.addEventListener('resize', checkWindowSize);
 


 function sortList(listId, sortType) {
    const list = document.getElementById(listId);
    const items = Array.from(list.children);

    let sortedItems;

    // Sorting logic
    if (sortType === 'A-Z') {
        sortedItems = items.sort((a, b) => {
            const aName = a.querySelector('.dashboard-student-name').textContent.toLowerCase();
            const bName = b.querySelector('.dashboard-student-name').textContent.toLowerCase();
            return aName.localeCompare(bName);
        });
    } else if (sortType === 'Z-A') {
        sortedItems = items.sort((a, b) => {
            const aName = a.querySelector('.dashboard-student-name').textContent.toLowerCase();
            const bName = b.querySelector('.dashboard-student-name').textContent.toLowerCase();
            return bName.localeCompare(aName);
        });
    } else if (sortType === 'Newest') {
        sortedItems = items.sort((a, b) => {
            const aDate = new Date(a.getAttribute('data-date'));
            const bDate = new Date(b.getAttribute('data-date'));
            return bDate - aDate;
        });
    } else if (sortType === 'Oldest') {
        sortedItems = items.sort((a, b) => {
            const aDate = new Date(a.getAttribute('data-date'));
            const bDate = new Date(b.getAttribute('data-date'));
            return aDate - bDate;
        });
    }

    // Re-append sorted items to the list
    sortedItems.forEach(item => list.appendChild(item));
 }

 // Function to show/hide sort options
 function toggleSortOptions(button) {
    const sortOptions = button.nextElementSibling;
    const isVisible = sortOptions.style.display === 'block';
    sortOptions.style.display = isVisible ? 'none' : 'block';
 }

 // Add event listeners for sorting buttons
 document.querySelectorAll('.dashboard-sort-button').forEach(button => {
    button.addEventListener('click', function () {
        toggleSortOptions(button);
    });
 });

 // Add event listeners for individual sort options
 document.querySelectorAll('.dashboard-sort-option').forEach(option => {
    option.addEventListener('click', function () {
        const sortType = this.getAttribute('data-sort');
        const section = this.closest('.dashboard-section');
        const listId = section.querySelector('.dashboard-student-list').id;
        
        // Sort the list based on the selected option
        sortList(listId, sortType);
        
        // Close the dropdown after sorting
        const sortOptions = section.querySelector('.dashboard-sort-options');
        sortOptions.style.display = 'none';
    });
 });
    
 //toggle function
 // Select the Dashboard and Inbox menu items
 const dashboardMenuItem = document.querySelector(".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(1)");
 const inboxMenuItem = document.querySelector(".nbfcstudentdashboardprofile-sidebarlists-top li:nth-child(2)");

 // Select the containers
 const dashboardSectionsContainer = document.querySelector(".dashboard-sections-container");
 

 // Function to update active state
 function setActiveMenuItem(activeItem) {
    // Remove nbfcactive class from all menu items
    document.querySelectorAll(".nbfcstudentdashboardprofile-sidebarlists-top li").forEach(item => {
        item.classList.remove('nbfcactive');
    });
    // Add nbfcactive class to clicked item
    activeItem.classList.add('nbfcactive');
 }

 // Add event listener to Dashboard menu item
 dashboardMenuItem.addEventListener("click", function () {
    // Hide inbox, show dashboard sections
    inboxContainer.style.display = "none";
    dashboardSectionsContainer.style.display = "grid";
    // Remove any leftover inline styles that might interfere
    dashboardSectionsContainer.removeAttribute('style');
    // Set active state for dashboard
    setActiveMenuItem(dashboardMenuItem);
 });

 // Add event listener to Inbox menu item
 inboxMenuItem.addEventListener("click", function () {
    // Hide dashboard sections completely, show inbox
    dashboardSectionsContainer.style.display = "none";
    inboxContainer.style.display = "block";
    // Set active state for inbox
    setActiveMenuItem(inboxMenuItem);
 });

 // Set initial states
 dashboardSectionsContainer.style.display = "grid";
 inboxContainer.style.display = "none";
 // Set initial active state to dashboard
 setActiveMenuItem(dashboardMenuItem);

 // Add CSS to ensure the hiding works
 document.head.insertAdjacentHTML('beforeend', `
    <style>
    .dashboard-sections-container[style*="display: none"] {
        display: none !important;
    }
    </style>
 `);


 // Select all message buttons
    const messageButtons = document.querySelectorAll(".index-student-message-btn");

    messageButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Find the closest parent container (index-student-message-container)
            const parentContainer = this.closest(".index-student-message-container");
            
            // Find the corresponding message input box inside the same container
            const messageInputBox = parentContainer.querySelector(".nbfc-individual-bankmessage-input-message");

            // Toggle visibility
            if (messageInputBox.style.display === "none" || messageInputBox.style.display === "") {
                messageInputBox.style.display = "flex";
            } else {
                messageInputBox.style.display = "none";
            }
        });
    });


 function filterData(data, searchTerm) {
    return data.filter(item => 
        item.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
        item.studentId.toLowerCase().includes(searchTerm.toLowerCase())
    );
 }

 // Add event listener to the search input
 const searchInput = document.querySelector(".nbfc-search-input");
 
 searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value;

    // Get the current active section to determine which list to filter
    const requestListContainer = document.getElementById("dashboard-request-list");
    const proposalListContainer = document.getElementById("dashboard-proposal-list");

    // Filter and update both lists
    const filteredRequests = filterData(requestsData, searchTerm);
    const filteredProposals = filterData(proposalsData, searchTerm);

    populateStudentList("dashboard-request-list", filteredRequests);
    populateStudentList("dashboard-proposal-list", filteredProposals);
 });


 // Modal Container and Buttons
 const modalContainer = document.querySelector(".modal-container");
 const closeButton = document.querySelector(".close-button");
 const cancelButton = document.querySelector(".cancel-button");

 
 // Show a rejection message when any reject button is clicked
 
    const rejectButtons = document.querySelectorAll(".reject-button"); // Select all reject buttons

    rejectButtons.forEach((rejectButton) => {
        rejectButton.addEventListener("click", function() {
            // Display a rejection message
            alert("Application Rejected"); // Replace this with a toast if needed
        });
    });

    // Close the modal when the close button or cancel button is clicked (if modal functionality is still needed elsewhere)
    if (closeButton) {
        closeButton.addEventListener("click", function() {
            modalContainer.style.display = "none"; // Hide the modal
        });
    }

    if (cancelButton) {
        cancelButton.addEventListener("click", function() {
            modalContainer.style.display = "none"; // Hide the modal
        });
    }




 // Sample Data for Requests and Proposals
 const requestsData = [
    { id: 1, name: "John Doe", studentId: "HYUIUIJ756738" },
    { id: 2, name: "Jane Smith", studentId: "HYUIUIJ756739" },
    { id: 3, name: "Mark Lee", studentId: "HYUIUIJ756740" },
    { id: 4, name: "Anna Patel", studentId: "HYUIUIJ756741" },
    { id: 5, name: "David Kim", studentId: "HYUIUIJ756742" }
 ];

 const proposalsData = [
    { id: 6, name: "Michael Brown", studentId: "HYUIUIJ756743" },
    { id: 7, name: "Lucy Green", studentId: "HYUIUIJ756744" },
    { id: 8, name: "Peter White", studentId: "HYUIUIJ756745" },
    { id: 9, name: "Sophia Black", studentId: "HYUIUIJ756746" },
    { id: 10, name: "Lucas Blue", studentId: "HYUIUIJ756747" }
 ];
function createStudentListItem(student) {
    const listItem = document.createElement("div");
    listItem.classList.add("dashboard-student-item");

    const studentInfo = document.createElement("div");
    studentInfo.classList.add("dashboard-student-info");

    const studentName = document.createElement("div");
    studentName.classList.add("dashboard-student-name");
    studentName.textContent = student.name;

    const studentId = document.createElement("div");
    studentId.classList.add("dashboard-student-id");
    studentId.textContent = student.studentId;

    studentInfo.appendChild(studentName);
    studentInfo.appendChild(studentId);

    const actionButtons = document.createElement("div");
    actionButtons.classList.add("dashboard-action-buttons");

    const viewButton = document.createElement("button");
    viewButton.classList.add("dashboard-view-button");
    viewButton.innerHTML = '<i class="fa-solid fa-eye eye-icon"></i>';

    viewButton.addEventListener("click", async function() {
        try {
            // Fetch the profile content
            const response = await fetch(`/get-student-profile/${student.studentId}`);
            if (!response.ok) {
                throw new Error('Failed to load profile');
            }
            const profileContent = await response.text();

            // Hide the dashboard sections
            const dashboardSections = document.querySelector(".dashboard-sections-container");
            if (dashboardSections) {
                dashboardSections.style.display = "none";
            }

            // Create or update profile container
            let profileContainer = document.querySelector(".nbfc-studentdashboard-profile-container");
            if (!profileContainer) {
                profileContainer = document.createElement('div');
                profileContainer.classList.add('nbfc-studentdashboard-profile-container');
                document.querySelector('.main-content').appendChild(profileContainer);
            }

            // Update content and show
            profileContainer.innerHTML = profileContent;
            profileContainer.style.display = "block";

            // Add back button if needed
            if (!profileContainer.querySelector('.back-to-dashboard')) {
                const backButton = document.createElement('button');
                backButton.classList.add('back-to-dashboard');
                backButton.textContent = 'Back to Dashboard';
                backButton.addEventListener('click', function() {
                    profileContainer.style.display = "none";
                    dashboardSections.style.display = "block";
                });
                profileContainer.insertBefore(backButton, profileContainer.firstChild);
            }

        } catch (error) {
            console.error("Error loading profile:", error);
            alert("Failed to load student profile. Please try again.");
        }
    });

    const rejectButton = document.createElement("button");
    rejectButton.classList.add("dashboard-reject-button");
    rejectButton.textContent = "Reject";
    rejectButton.addEventListener("click", function () {
        showRejectModal();
    });

    actionButtons.appendChild(viewButton);
    actionButtons.appendChild(rejectButton);

    listItem.appendChild(studentInfo);
    listItem.appendChild(actionButtons);

    return listItem;
}
  //new
  

  // Function to populate student list for a given section
  function populateStudentList(sectionId, data) {
    const studentListContainer = document.getElementById(sectionId);

    studentListContainer.innerHTML = ""; // Clear existing list items

    data.forEach(student => {
        const studentListItem = createStudentListItem(student);
        studentListContainer.appendChild(studentListItem);
    });
  }

  // Function to show the reject modal
  function showRejectModal() {
    const modal = document.querySelector('.modal-container');
    modal.style.display = 'flex'; // Show the modal
  }

  // Populate both the "Requests" and "Proposals" lists
  populateStudentList("dashboard-request-list", requestsData);
  populateStudentList("dashboard-proposal-list", proposalsData);

  
    // Select elements
    const messageInput = document.querySelector(".nbfc-message-input");
    const sendButton = document.querySelector(".nbfc-send-img");
    const inputContainer = document.querySelector(".nbfc-individual-bankmessage-input");
    const viewButton = document.querySelector(".view");
    const smileIcon = document.querySelector(".nbfc-face-smile");
    const paperclipIcon = document.querySelector(".nbfc-paperclip");

    let isNBFC = true;

    // Create messages wrapper if it doesn't exist
    let messagesWrapper = document.querySelector(".messages-wrapper");
    if (!messagesWrapper) {
        messagesWrapper = document.createElement("div");
        messagesWrapper.classList.add("messages-wrapper");
        messagesWrapper.style.cssText = `
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 20px;
            padding: 20px 0;
        `;
        inputContainer.parentNode.insertBefore(messagesWrapper, inputContainer);
    }

    // Load messages from localStorage if any
    function loadMessages() {
        const savedMessages = JSON.parse(localStorage.getItem('messages'));
        if (savedMessages && Array.isArray(savedMessages)) {
            savedMessages.forEach(content => {
                createMessage(content);
            });
        }
    }

    // Create message in the chat
    function createMessage(content) {
        // Create the outer container for right alignment
        const alignmentContainer = document.createElement("div");
        alignmentContainer.style.cssText = `
            display: flex;
            justify-content: flex-end;
            width: 100%;
        `;

        // Create the message container with proper width and styling
        const messageContainer = document.createElement("div");
        messageContainer.style.cssText = `
            width: 100%;
            padding: 5px;
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            margin-left: auto;
        `;

        // Create the message content
        const messageContent = document.createElement("div");
        messageContent.style.cssText = `
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 14px;
            color: #909090;
            line-height: 1.5;
            padding: 4px 5px;
        `;

        // Handle content formatting
        if (content.startsWith('📎')) {
            messageContent.textContent = content;
        } else if (content.includes("\n")) {
            content.split("\n").forEach((line, index) => {
                if (line.trim()) {
                    if (index > 0) {
                        messageContent.appendChild(document.createElement("br"));
                    }
                    messageContent.appendChild(document.createTextNode(line.trim()));
                }
            });
        } else {
            messageContent.textContent = content;
        }

        // Assemble the message structure
        messageContainer.appendChild(messageContent);
        alignmentContainer.appendChild(messageContainer);
        messagesWrapper.appendChild(alignmentContainer);

        // Scroll only the chat container to the latest message
        messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
    }

    // Function to send message
    function sendMessage() {
        if (!messageInput) return;
        const content = messageInput.value.trim();
        if (content) {
            createMessage(content);

            // Save the message to localStorage
            let savedMessages = JSON.parse(localStorage.getItem('messages')) || [];
            savedMessages.push(content);
            localStorage.setItem('messages', JSON.stringify(savedMessages));

            messageInput.value = "";
        }
    }

    // Add event listeners
    if (sendButton) sendButton.addEventListener("click", sendMessage);
    if (messageInput) {
        messageInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    // Emoji Picker functionality
    if (smileIcon) {
        smileIcon.addEventListener("click", function(e) {
            e.stopPropagation();
            const emojis = ["😊", "👍", "😀", "🙂", "👋", "❤️", "👌", "✨"];
            
            const existingPicker = document.querySelector(".emoji-picker");
            if (existingPicker) {
                existingPicker.remove();
                return;
            }

            const picker = document.createElement("div");
            picker.classList.add("emoji-picker");
            picker.style.cssText = `
                position: absolute;
                bottom: 100%;
                right: 0;
                background: white;
                border: 1px solid #e2e2e2;
                border-radius: 5px;
                padding: 5px;
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                z-index: 1000;
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
                    if (messageInput) {
                        messageInput.value += emoji;
                        picker.remove();
                        messageInput.focus();
                    }
                };
                picker.appendChild(button);
            });

            smileIcon.parentElement.appendChild(picker);

            document.addEventListener("click", function closePicker(e) {
                if (!picker.contains(e.target) && e.target !== smileIcon) {
                    picker.remove();
                    document.removeEventListener("click", closePicker);
                }
            });
        });
    }

    // File attachment functionality
    // File attachment functionality
 if (paperclipIcon) {
    paperclipIcon.addEventListener("click", function() {
        const fileInput = document.createElement("input");
        fileInput.type = "file";
        fileInput.accept = ".pdf,.doc,.docx,.txt";
        fileInput.style.display = "none";

        fileInput.onchange = (e) => {
            const file = e.target.files[0];
            if (file) {
                // Get the file name and size
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB

                // Create the message container
                const alignmentContainer = document.createElement("div");
                alignmentContainer.style.cssText = `
                    display: flex;
                    justify-content: flex-end;
                    width: 100%;
                `;

                const messageContainer = document.createElement("div");
                messageContainer.style.cssText = ` 
                    width: 665px;
                    padding: 10px;
                    border: 1px solid #e2e2e2;
                    border-radius: 4px;
                    margin-left: auto;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                `;

                // Create message content
                const messageText = document.createElement("div");
                messageText.style.cssText = `
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                    font-size: 14px;
                    color: #909090;
                    line-height: 1.5;
                    padding: 4px 5px;
                    flex: 1;
                `;
                messageText.textContent = `${fileName} (${fileSize} MB)`;

                // Create remove icon (using SVG)
                const removeIcon = document.createElement("button");
                removeIcon.style.cssText = `
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 18px;
                    padding: 0;
                    margin-left: 10px;
                    display: flex;
                    justify-content: flex-end;
                `;
                removeIcon.innerHTML = `
                    <svg width="16" height="16" fill="black" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.146 3.854a.5.5 0 0 0-.708 0L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.146-3.146a.5.5 0 0 0 0-.708z"/>
                    </svg>
                `;
                removeIcon.onclick = () => {
                    // Remove the message and reset the file input
                    messagesWrapper.removeChild(alignmentContainer);

                    // Remove file data from localStorage
                    let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                    savedFiles = savedFiles.filter(f => f.fileName !== fileName);
                    localStorage.setItem('files', JSON.stringify(savedFiles));
                };

                // Append remove icon to the message
                messageContainer.appendChild(messageText);
                messageContainer.appendChild(removeIcon);

                // Assemble the message structure
                alignmentContainer.appendChild(messageContainer);
                messagesWrapper.appendChild(alignmentContainer);

                // Scroll to the bottom of the chat
                messagesWrapper.scrollTop = messagesWrapper.scrollHeight;

                // Save file data to localStorage
                let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                savedFiles.push({ fileName, fileSize });
                localStorage.setItem('files', JSON.stringify(savedFiles));
            }
        };

        // Trigger the file input dialog
        document.body.appendChild(fileInput);
        fileInput.click();
        document.body.removeChild(fileInput);
    });
  }

  // Load files from localStorage when the page loads
 function loadFiles() {
    const savedFiles = JSON.parse(localStorage.getItem('files'));
    if (savedFiles && Array.isArray(savedFiles)) {
        savedFiles.forEach(file => {
            const alignmentContainer = document.createElement("div");
            alignmentContainer.style.cssText = `
                display: flex;
                justify-content: flex-end;
                width: 100%;
            `;

            const messageContainer = document.createElement("div");
            messageContainer.style.cssText = ` 
                width: 665px;
                padding: 10px;
                border: 1px solid #e2e2e2;
                border-radius: 4px;
                margin-left: auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            `;

            // Create message content
            const messageText = document.createElement("div");
            messageText.style.cssText = `
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
                font-size: 14px;
                color: #909090;
                line-height: 1.5;
                padding: 4px 5px;
                flex: 1;
            `;
            messageText.textContent = `${file.fileName} (${file.fileSize} MB)`;

            // Create remove icon (using SVG)
            const removeIcon = document.createElement("button");
            removeIcon.style.cssText = `
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
                padding: 0;
                margin-left: 10px;
                display: flex;
                justify-content: flex-end;
            `;
            removeIcon.innerHTML = `
                <svg width="16" height="16" fill="black" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.146 3.854a.5.5 0 0 0-.708 0L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.146-3.146a.5.5 0 0 0 0-.708z"/>
                </svg>
            `;
            removeIcon.onclick = () => {
                // Remove the message and reset the file input
                messagesWrapper.removeChild(alignmentContainer);

                // Remove file data from localStorage
                let savedFiles = JSON.parse(localStorage.getItem('files')) || [];
                savedFiles = savedFiles.filter(f => f.fileName !== file.fileName);
                localStorage.setItem('files', JSON.stringify(savedFiles));
            };

            // Append remove icon to the message
            messageContainer.appendChild(messageText);
            messageContainer.appendChild(removeIcon);

            // Assemble the message structure
            alignmentContainer.appendChild(messageContainer);
            messagesWrapper.appendChild(alignmentContainer);

            // Scroll to the bottom of the chat
            messagesWrapper.scrollTop = messagesWrapper.scrollHeight;
        });
    }
   }

  // Load files when the page is refreshed
  loadFiles();


    // View/Close functionality
    if (viewButton && closeButton) {
        viewButton.addEventListener("click", function() {
            messagesWrapper.style.display = "block";
            inputContainer.style.display = "flex";
            viewButton.style.display = "none";
            closeButton.style.display = "inline-block";
        });

        closeButton.addEventListener("click", function() {
            messagesWrapper.style.display = "none";
            inputContainer.style.display = "none";
            closeButton.style.display = "none";
            viewButton.style.display = "inline-block";
        });
    }

    // Initially hide chat if view button exists
    if (viewButton) {
        messagesWrapper.style.display = "none";
        inputContainer.style.display = "none";
        closeButton.style.display = "none";
    }

    // Load previous messages when the page is refreshed
    loadMessages();

     
    // Select buttons and message response container
    const viewButtonIndex = document.querySelector(".inbox-btn-view");
    const closeButtonIndex = document.querySelector(".inbox-btn-close");
    const messageResponse = document.querySelector(".message-response");

    // Initially hide the message response container
    messageResponse.style.display = "none";

    // Function to handle "View" button click
    if (viewButtonIndex) {
        viewButtonIndex.addEventListener("click", function() {
            // Show the message response container
            messageResponse.style.display = "block";
        });
    }

    // Function to handle "Close" button click
    if (closeButtonIndex) {
        closeButtonIndex.addEventListener("click", function() {
            // Hide the message response container
            messageResponse.style.display = "none";
        });
    }
    

});


 </script>



</body>
</html>
