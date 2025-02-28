<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    
     <link rel="stylesheet" href="assets/css/adminrolemanagement.css">
</head>

<body>

    @extends('layouts.app')

    @php

    @endphp
    
<div class="role-management-admin-main-container" id="role-management-container-admin-id">
   <div class="role-management-container">
        <div class="role-management-header">
            <h1 class="role-management-title">Role Management</h1>
            <div class="role-management-controls">
                <input type="text" class="role-management-search" placeholder="Search">
                <div class="custom-dropdown">
                    <div class="custom-dropdown-toggle">
                        Sort by
                        <img src="assets/images/filter-icon.png" alt="Filter">

                    </div>
                    <div class="custom-dropdown-menu">
                        <div class="custom-dropdown-item" data-value="name">A-Z</div>
                        <div class="custom-dropdown-item" data-value="role">Z-A</div>
                        <div class="custom-dropdown-item" data-value="email-new">Newest</div>
                        <div class="custom-dropdown-item" data-value="email-old">Oldest</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="role-management-list" id="roleManagementList">
            <!-- User rows will be inserted here by JavaScript -->
        </div>
    </div>


    <script>
   

        // Sample data with different names and emails
        const users = [
            { name: 'Alice Johnson', role: 'Student', email: 'alice.j@gmail.com' },
            { name: 'Bob Smith', role: 'Financial Company', email: 'bob.smith@gmail.com' },
            { name: 'Carol Davis', role: 'Students', email: 'carol.d@gmail.com' },
            { name: 'David Wilson', role: 'Financial Company', email: 'david.w@gmail.com' },
            { name: 'Emma Brown', role: 'Financial Company', email: 'emma.b@gmail.com' },
            { name: 'Frank Miller', role: 'Students', email: 'frank.m@gmail.com' },
            { name: 'Grace Taylor', role: 'Students', email: 'grace.t@gmail.com' },
            { name: 'Henry Clark', role: 'Students', email: 'henry.c@gmail.com' }
        ];

        // Function to create user rows
        function createUserRows(sortedUsers = users) {
            const userList = document.getElementById('roleManagementList');
            userList.innerHTML = '';

            sortedUsers.forEach((user) => {
                const row = document.createElement('div');
                row.className = 'role-management-row';
                row.innerHTML = `
            <div>${user.name}</div>
            <div>
                <select class="role-management-select" disabled>
                    <option ${user.role === 'Student' ? 'selected' : ''}>Student</option>
                    <option ${user.role === 'Financial Company' ? 'selected' : ''}>Financial Company</option>
                    <option ${user.role === 'Students' ? 'selected' : ''}>Students</option>
                </select>
            </div>
            <div>
                <input type="email" class="role-management-email" value="${user.email}" disabled>
            </div>
            <div class="role-management-actions">
                <button class="role-management-btn role-management-btn-edit">Edit</button>
            </div>
        `;
                userList.appendChild(row);
            });

            // Add click handlers for all buttons
            document.querySelectorAll('.role-management-btn').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const row = btn.closest('.role-management-row');
                    const select = row.querySelector('.role-management-select');
                    const email = row.querySelector('.role-management-email');

                    if (btn.classList.contains('role-management-btn-save')) {
                        select.disabled = true;
                        email.disabled = true;
                        btn.textContent = 'Edit';
                        btn.classList.remove('role-management-btn-save');
                        btn.classList.add('role-management-btn-edit');
                    } else {
                        select.disabled = false;
                        email.disabled = false;
                        btn.textContent = 'Save';
                        btn.classList.remove('role-management-btn-edit');
                        btn.classList.add('role-management-btn-save');
                    }
                });
            });
        }

        // Initialize event listeners for dropdown and sorting
        document.addEventListener('DOMContentLoaded', () => {
            const dropdownToggle = document.querySelector('.custom-dropdown-toggle');
            const dropdownMenu = document.querySelector('.custom-dropdown-menu');
            const dropdownItems = document.querySelectorAll('.custom-dropdown-item');

            // Toggle dropdown when clicking the toggle button
            dropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            // Handle sorting when clicking dropdown items
            dropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const sortValue = item.getAttribute('data-value');
                    let sortedUsers = [...users];

                    switch (sortValue) {
                        case 'name':
                            sortedUsers.sort((a, b) => a.name.localeCompare(b.name));
                            break;
                        case 'role':
                            sortedUsers.sort((a, b) => b.name.localeCompare(a.name));
                            break;
                        case 'email-new':
                            sortedUsers.sort((a, b) => b.email.localeCompare(a.email));
                            break;
                        case 'email-old':
                            sortedUsers.sort((a, b) => a.email.localeCompare(b.email));
                            break;
                    }

                    createUserRows(sortedUsers);
                    dropdownMenu.style.display = 'none';
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.custom-dropdown')) {
                    dropdownMenu.style.display = 'none';
                }
            });

            // Initial render
            createUserRows();
        });

        // Add search functionality
        document.querySelector('.role-management-search').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.role-management-row').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });


    </script>

        

    </body>
    </html>