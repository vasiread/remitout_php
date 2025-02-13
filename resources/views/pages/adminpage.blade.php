<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


<nav class="admin-nav">
        <div class="admin-nav-logo">
            <img src="assets/images/Remitoutcolored.png" alt="Remitout Logo" class="admin-nav-logo-img">
        </div>

        <div class="admin-nav-search">
            <input type="text" class="admin-nav-search-input" placeholder="Search">
            <svg class="admin-nav-search-icon" width="20" height="20" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <div class="admin-nav-right">
            <button class="admin-nav-notification">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <span class="admin-nav-notification-dot"></span>
            </button>

            <div class="admin-nav-dropdown">
                <img src="assets/images/admin-profile.png" alt="Admin avatar" class="admin-nav-avatar">
                <span class="admin-nav-name">Admin</span>
                <svg class="admin-nav-dropdown-icon" width="16" height="16" fill="none" stroke="currentColor"
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
            <x-admin.adminstudent/>
            <x-admin.adminstudentcounsellor/>
            <x-admin.adminnbfc/>
            <x-admin.admineditcontent/>
        </div>
    </div>




   <script>
        document.querySelector('.admin-nav-dropdown').addEventListener('click', function () {
            document.querySelector('.admin-nav-dropdown-menu').classList.toggle('active');
            document.querySelector('.admin-nav-dropdown-icon').classList.toggle('active');
        });
    </script>









</body>

</html>