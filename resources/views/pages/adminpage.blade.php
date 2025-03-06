<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


 <nav class="admin-nav">
        <div class="admin-nav-left">
            <div class="admin-nav-logo">
                <img src="assets/images/admin-logo.png" alt="Remitout Logo" class="admin-nav-logo-img">
            </div>

            <div class="back-button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span>Back</span>
            </div>
        </div>

        <div class="admin-nav-right">
            <div class="admin-nav-search">
                <svg class="admin-nav-search-icon" width="16" height="16" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" class="admin-nav-search-input" placeholder="Search">
            </div>

            <button class="admin-nav-notification">
                  <img src="/assets/images/notifications_unread.png" alt="the notification icon" class="notification-icon">
            </button>

            <div class="admin-nav-dropdown">
                <img src="assets/images/admin-profile.png" alt="Admin avatar" class="admin-nav-avatar">
                <span class="admin-nav-name">Admin</span>
                <svg class="admin-nav-dropdown-icon" width="14" height="14" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <div class="admin-nav-dropdown-menu">
                    <div class="admin-nav-dropdown-item">Profile</div>
                    <div class="admin-nav-dropdown-item">Settings</div>
                    <div class="admin-nav-dropdown-item">Logout</div>
                </div>
            </div>
        </div>
    </nav>

 



    <div class="admin-parentcontainer">
        <x-admin.adminsidebar :sidebarItems="$sidebarItems" />

        <div class="admin-detailedviewcontainer">
            <x-admin.admindashboard />
            
            <x-admin.adminstudent :userDetails="$userDetails"/>
            <x-admin.adminstudentcounsellor/>
            <x-admin.adminnbfc/>
            <x-admin.adminindex/>
            <x-admin.admineditcontent/>
            <x-admin.adminticketraised/>
            <x-admin.adminmanagestudent/>
            <x-admin.adminrolemanagement/>
            <x-admin.adminpromotionalemail/>
          
          
        </div>
    </div>




   <script>
        document.querySelector('.admin-nav-dropdown').addEventListener('click', function () {
            document.querySelector('.admin-nav-dropdown-menu').classList.toggle('active');
            document.querySelector('.admin-nav-dropdown-icon').classList.toggle('active');
        });
// Get references to the elements
const backButton = document.querySelector('.back-button');
const editContentContainer = document.querySelector('.edit-content-container');
const editContentSubContainer = document.querySelector('.edit-content-sub-container');
const cmsContainer = document.querySelector('.edit-contents-cms-container');
const searchInput = document.getElementById('searchInput');

// Function to update back button visibility based on current view
function updateBackButtonVisibility() {
    // Check if we're in the CMS view
    // We check style.display directly and also use a custom attribute to track state
    const isCMSVisible = cmsContainer.style.display === 'block' || editContentContainer.dataset.inCmsMode === 'true';
    
    if (isCMSVisible) {
        backButton.style.display = 'flex';
    } else {
        backButton.style.display = 'none';
    }
}

// Initially hide the back button
backButton.style.display = 'none';

// Update all edit button click handlers to ensure consistent behavior
function setupEditButtonHandlers() {
    document.querySelectorAll('.edit-content-button').forEach(button => {
        button.addEventListener('click', () => {
            // Hide content list
            document.querySelector('.edit-content-list').style.display = 'none';
            // Hide the search input and header
            document.querySelector('.edit-content-header').style.display = 'none';
            // Show the CMS container
            cmsContainer.style.display = 'block';
            
            // Mark that we're in CMS mode (this helps track state after search)
            editContentContainer.dataset.inCmsMode = 'true';
            
            // Show back button
            updateBackButtonVisibility();
        });
    });
}

// Handle the search input to maintain back button state
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        // If search happens while in CMS mode, make sure back button stays visible
        updateBackButtonVisibility();
    });
}

// Implement back button functionality
backButton.addEventListener('click', () => {
    // Hide CMS container
    cmsContainer.style.display = 'none';
    
    // Show content list and header
    document.querySelector('.edit-content-list').style.display = '';
    document.querySelector('.edit-content-header').style.display = '';
    
    // Update state tracker
    editContentContainer.dataset.inCmsMode = 'false';
    
    // Hide back button
    updateBackButtonVisibility();
});

// Modify the existing renderContent function to ensure edit buttons work after search
const originalRenderContent = renderContent;
renderContent = function(data) {
    originalRenderContent(data);
    setupEditButtonHandlers();
};

// Add this to the window load event
document.addEventListener('DOMContentLoaded', () => {
    // Setup initial handlers
    setupEditButtonHandlers();
    
    // Update visibility
    updateBackButtonVisibility();
    
    // Also patch the handleSearch function in CMSEditor to maintain back button visibility
    if (window.CMSEditor && CMSEditor.prototype.handleSearch) {
        const originalHandleSearch = CMSEditor.prototype.handleSearch;
        CMSEditor.prototype.handleSearch = function(searchTerm) {
            originalHandleSearch.call(this, searchTerm);
            updateBackButtonVisibility();
        };
    }
});


    
    </script>









</body>

</html>