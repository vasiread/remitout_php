<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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
            <x-admin.adminstudapplication/>
            
          
          
        </div>
    </div>




   <script>
        document.querySelector('.admin-nav-dropdown').addEventListener('click', function () {
            document.querySelector('.admin-nav-dropdown-menu').classList.toggle('active');
            document.querySelector('.admin-nav-dropdown-icon').classList.toggle('active');
        });

     
        const backButton = document.querySelector('.back-button');
        const editContentContainer = document.querySelector('.edit-content-container');
        const editContentSubContainer = document.querySelector('.edit-content-sub-container');
        const cmsContainer = document.querySelector('.edit-contents-cms-container');
        const searchInput = document.getElementById('searchInput');

        function updateBackButtonVisibility() {
            const isCMSVisible = cmsContainer.style.display === 'block' || editContentContainer.dataset.inCmsMode === 'true';
            
            if (isCMSVisible) {
                backButton.style.display = 'flex';
            } else {
                backButton.style.display = 'none';
            }
        }

        backButton.style.display = 'none';

        function setupEditButtonHandlers() {
            document.querySelectorAll('.edit-content-button').forEach(button => {
                button.addEventListener('click', () => {
                    document.querySelector('.edit-content-list').style.display = 'none';
                    document.querySelector('.edit-content-header').style.display = 'none';
                    cmsContainer.style.display = 'block';
                    editContentContainer.dataset.inCmsMode = 'true';
                    
                    updateBackButtonVisibility();
                });
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                // If search happens while in CMS mode, make sure back button stays visible
                updateBackButtonVisibility();
            });
        }

    
        backButton.addEventListener('click', () => {
            cmsContainer.style.display = 'none';
            
            document.querySelector('.edit-content-list').style.display = '';
            document.querySelector('.edit-content-header').style.display = '';
            
            editContentContainer.dataset.inCmsMode = 'false';
            
            updateBackButtonVisibility();
        });


        const originalRenderContent = renderContent;
        renderContent = function(data) {
            originalRenderContent(data);
            setupEditButtonHandlers();
        };

        document.addEventListener('DOMContentLoaded', () => {
        
            setupEditButtonHandlers();
            updateBackButtonVisibility();
            
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