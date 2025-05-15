<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <link rel="stylesheet" href="assets/css/adminrolemanagement.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @extends('layouts.app')
    <div class="role-management-admin-main-container" id="role-management-container-admin-id">
        <div class="role-management-container">
            <div class="role-management-header">
                <div class="role-management-mobile-heading">
                    <h1 class="role-management-title">Role Management</h1>
                    <button class="role-management-mobile-add-btn">+</button>
                </div>
                <div class="role-management-controls">
                    <input type="text" class="role-management-search" placeholder="Search">
                    <div class="custom-dropdown">
                        <div class="custom-dropdown-toggle">
                            Sort
                            <img src="assets/images/filter-icon.png" alt="Filter">
                        </div>
                        <div class="custom-dropdown-menu">
                            <div class="custom-dropdown-item" data-value="name">A-Z</div>
                            <div class="custom-dropdown-item" data-value="role">Z-A</div>
                            <div class="custom-dropdown-item" data-value="email-new">Newest</div>
                            <div class="custom-dropdown-item" data-value="email-old">Oldest</div>
                        </div>
                    </div>
                    <button class="role-management-btn role-management-btn-add">Add</button>
                </div>
            </div>
            <div class="role-management-list" id="roleManagementList">
                <!-- User rows will be inserted here by JavaScript -->
            </div>
        </div>
    </div>
    <script>
        let admins = [];
        document.addEventListener('DOMContentLoaded', () => {
            const sessionData = @json(session()->all());
            console.log('Full Session Data:', sessionData);
        });
        
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
        function fetchAdmins() {
            fetch('/api/admins', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch admins');
                }
                return response.json();
            })
            .then(data => {
                if (data.success && Array.isArray(data.data)) {
                    // Get suspended admin IDs from localStorage
                    const suspendedAdmins = JSON.parse(localStorage.getItem('suspendedAdmins') || '[]');
                    admins = data.data
                        .filter(admin => !suspendedAdmins.includes(admin.admin_id))
                        .map(admin => ({
                            admin_id: admin.admin_id,
                            name: admin.name,
                            role: admin.is_super_admin ? 'Super Admin' : 'Admin',
                            email: admin.email,
                            created_at: admin.created_at
                        }));
                    createUserRows(admins);
                } else {
                    console.error('Unexpected response format:', data);
                    createUserRows([]);
                }
            })
            .catch(error => {
                console.error('Error fetching admins:', error);
                createUserRows([]);
            });
        }
        function createUserRows(sortedAdmins) {
            const userList = document.getElementById('roleManagementList');
            userList.innerHTML = '';
            sortedAdmins.forEach((admin, index) => {
                const row = document.createElement('div');
                row.className = 'role-management-row';
                row.setAttribute('data-admin-id', admin.admin_id || '');
                row.innerHTML = `
                    <div>
                        <input type="text" class="role-management-name" value="${admin.name || ''}" disabled>
                    </div>
                    <div>
                        <select class="role-management-select" disabled>
                            <option value="" disabled ${!admin.role ? 'selected' : ''}>Select</option>
                            <option value="Admin" ${admin.role === 'Admin' ? 'selected' : ''}>Admin</option>
                            <option value="Super Admin" ${admin.role === 'Super Admin' ? 'selected' : ''}>Super Admin</option>
                        </select>
                    </div>
                    <div>
                        <input type="email" class="role-management-email" value="${admin.email || ''}" disabled>
                    </div>
                    <div class="role-management-actions">
                        <button class="role-management-btn role-management-btn-edit">Edit</button>
                        <button class="role-management-btn role-management-btn-suspend">Suspend</button>
                    </div>
                `;
                userList.appendChild(row);
            });
            document.querySelectorAll('.role-management-btn').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const row = btn.closest('.role-management-row');
                    const adminId = row.getAttribute('data-admin-id');
                    const nameInput = row.querySelector('.role-management-name');
                    const select = row.querySelector('.role-management-select');
                    const email = row.querySelector('.role-management-email');
                    const rowIndex = Array.from(document.querySelectorAll('.role-management-row')).indexOf(row);
                    if (btn.classList.contains('role-management-btn-save')) {
                        nameInput.disabled = true;
                        select.disabled = true;
                        email.disabled = true;
                        nameInput.classList.remove('edit-mode');
                        btn.textContent = 'Edit';
                        btn.classList.remove('role-management-btn-save');
                        btn.classList.add('role-management-btn-edit');
                        const updatedAdmin = {
                            name: nameInput.value,
                            role: select.value,
                            email: email.value,
                            admin_id: adminId
                        };
                        if (!adminId) {
                            saveNewAdmin(updatedAdmin, rowIndex);
                        } else {
                            updateAdmin(updatedAdmin, rowIndex);
                        }
                    } else if (btn.classList.contains('role-management-btn-edit')) {
                        nameInput.disabled = false;
                        select.disabled = false;
                        email.disabled = false;
                        nameInput.classList.add('edit-mode');
                        select.value = '';
                        btn.textContent = 'Save';
                        btn.classList.remove('role-management-btn-edit');
                        btn.classList.add('role-management-btn-save');
                    } else if (btn.classList.contains('role-management-btn-suspend')) {
                        if (adminId) {
                            // Add admin_id to suspendedAdmins in localStorage
                            const suspendedAdmins = JSON.parse(localStorage.getItem('suspendedAdmins') || '[]');
                            if (!suspendedAdmins.includes(adminId)) {
                                suspendedAdmins.push(adminId);
                                localStorage.setItem('suspendedAdmins', JSON.stringify(suspendedAdmins));
                            }
                        }
                        // Remove from admins array and re-render
                        admins = admins.filter((_, i) => i !== rowIndex);
                        createUserRows(admins);
                    }
                });
            });
        }
        function saveNewAdmin(adminData, rowIndex) {
            const payload = {
                name: adminData.name,
                email: adminData.email,
                password: 'default123', 
                is_super_admin: adminData.role === 'Super Admin'
            };
            fetch('/api/admins', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify(payload)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to create admin');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    admins[rowIndex] = {
                        admin_id: data.data.admin_id,
                        name: data.data.name,
                        role: data.data.is_super_admin ? 'Super Admin' : 'Admin',
                        email: data.data.email,
                        created_at: data.data.created_at
                    };
                    createUserRows(admins);
                } else {
                    alert('Failed to create admin: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error creating admin:', error);
                alert('Error creating admin: ' + error.message);
            });
        }
        function updateAdmin(adminData, rowIndex) {
            const payload = {
                name: adminData.name,
                email: adminData.email,
                is_super_admin: adminData.role === 'Super Admin'
            };
            fetch(`/api/admins/${adminData.admin_id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify(payload)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update admin');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    admins[rowIndex] = {
                        admin_id: adminData.admin_id,
                        name: adminData.name,
                        role: adminData.role,
                        email: adminData.email,
                        created_at: admins[rowIndex].created_at
                    };
                    createUserRows(admins);
                } else {
                    alert('Failed to update admin: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error updating admin:', error);
                alert('Error updating admin: ' + error.message);
            });
        }
        function addNewRow() {
            const newAdmin = { admin_id: '', name: '', role: '', email: '' };
            admins.unshift(newAdmin);
            createUserRows(admins);
            const firstRow = document.querySelector('.role-management-row');
            const nameInput = firstRow.querySelector('.role-management-name');
            const select = firstRow.querySelector('.role-management-select');
            const email = firstRow.querySelector('.role-management-email');
            const btn = firstRow.querySelector('.role-management-btn');
            nameInput.disabled = false;
            select.disabled = false;
            email.disabled = false;
            nameInput.classList.add('edit-mode');
            select.value = '';
            btn.textContent = 'Save';
            btn.classList.remove('role-management-btn-edit');
            btn.classList.add('role-management-btn-save');
        }
        document.addEventListener('DOMContentLoaded', () => {
            const dropdownToggle = document.querySelector('.custom-dropdown-toggle');
            const dropdownMenu = document.querySelector('.custom-dropdown-menu');
            const dropdownItems = document.querySelectorAll('.custom-dropdown-item');
            const addButtons = document.querySelectorAll('.role-management-btn-add, .role-management-mobile-add-btn');
            addButtons.forEach(button => {
                button.addEventListener('click', addNewRow);
            });
            dropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });
            dropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const sortValue = item.getAttribute('data-value');
                    let sortedAdmins = [...admins];
                    switch (sortValue) {
                        case 'name':
                            sortedAdmins.sort((a, b) => (a.name || '').localeCompare(b.name || ''));
                            break;
                        case 'role':
                            sortedAdmins.sort((a, b) => (b.name || '').localeCompare(a.name || ''));
                            break;
                        case 'email-new':
                            sortedAdmins.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                            break;
                        case 'email-old':
                            sortedAdmins.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                            break;
                    }
                    createUserRows(sortedAdmins);
                    dropdownMenu.style.display = 'none';
                });
            });
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.custom-dropdown')) {
                    dropdownMenu.style.display = 'none';
                }
            });
            document.querySelector('.role-management-search').addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const filteredAdmins = admins.filter(admin => 
                    (admin.name || '').toLowerCase().includes(searchTerm) ||
                    (admin.email || '').toLowerCase().includes(searchTerm) ||
                    (admin.role || '').toLowerCase().includes(searchTerm)
                );
                createUserRows(filteredAdmins);
            });
            fetchAdmins();
        });
    </script>
</body>
</html>