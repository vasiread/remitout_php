<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Role Management</title>
  <link rel="stylesheet" href="assets/css/adminrolemanagement.css"/>
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
          <input type="text" class="role-management-search" placeholder="Search"/>
          <div class="custom-dropdown">
            <div class="custom-dropdown-toggle">
              Sort
              <img src="assets/images/filter-icon.png" alt="Filter"/>
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

      <div class="role-management-list" id="roleManagementList"></div>
    </div>
  </div>

  <script>
    let admins = [];

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
        .then(res => res.json())
        .then(data => {
          const suspended = JSON.parse(localStorage.getItem('suspendedAdmins') || '[]');
          admins = data.data
            .filter(admin => !suspended.includes(admin.admin_id))
            .map(admin => ({
              admin_id: admin.admin_id,
              name: admin.name,
              role: admin.is_super_admin ? 'Super Admin' : 'Admin',
              email: admin.email,
              created_at: admin.created_at
            }));
          createUserRows(admins);
        })
        .catch(err => {
          console.error('Error loading admins:', err);
          createUserRows([]);
        });
    }

    function createUserRows(adminList) {
      const userList = document.getElementById('roleManagementList');
      userList.innerHTML = '';
      adminList.forEach((admin, index) => {
        const row = document.createElement('div');
        row.className = 'role-management-row';
        row.setAttribute('data-admin-id', admin.admin_id || '');
        row.innerHTML = `
          <div><input type="text" class="role-management-name" value="${admin.name || ''}" disabled></div>
          <div>
            <select class="role-management-select" disabled>
              <option value="" disabled>Select</option>
              <option value="Admin" ${admin.role === 'Admin' ? 'selected' : ''}>Admin</option>
              <option value="Super Admin" ${admin.role === 'Super Admin' ? 'selected' : ''}>Super Admin</option>
            </select>
          </div>
          <div><input type="email" class="role-management-email" value="${admin.email || ''}" disabled></div>
          <div class="role-management-actions">
            <button class="role-management-btn role-management-btn-edit">Edit</button>
            <button class="role-management-btn role-management-btn-suspend">Suspend</button>
          </div>
        `;
        userList.appendChild(row);
      });

      document.querySelectorAll('.role-management-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const row = btn.closest('.role-management-row');
          const adminId = row.getAttribute('data-admin-id');
          const name = row.querySelector('.role-management-name');
          const role = row.querySelector('.role-management-select');
          const email = row.querySelector('.role-management-email');
          const index = Array.from(document.querySelectorAll('.role-management-row')).indexOf(row);

          if (btn.classList.contains('role-management-btn-edit')) {
            name.disabled = false;
            role.disabled = false;
            email.disabled = false;
            btn.textContent = 'Save';
            btn.classList.remove('role-management-btn-edit');
            btn.classList.add('role-management-btn-save');
          } else if (btn.classList.contains('role-management-btn-save')) {
            name.disabled = true;
            role.disabled = true;
            email.disabled = true;
            btn.textContent = 'Edit';
            btn.classList.remove('role-management-btn-save');
            btn.classList.add('role-management-btn-edit');

            const updated = {
              name: name.value,
              email: email.value,
              role: role.value,
              admin_id: adminId
            };

            if (!adminId) {
              saveNewAdmin(updated, index);
            } else {
              updateAdmin(updated, index);
            }
          } else if (btn.classList.contains('role-management-btn-suspend')) {
            if (adminId) {
              const suspended = JSON.parse(localStorage.getItem('suspendedAdmins') || '[]');
              if (!suspended.includes(adminId)) {
                suspended.push(adminId);
                localStorage.setItem('suspendedAdmins', JSON.stringify(suspended));
              }
            }
            admins = admins.filter((_, i) => i !== index);
            createUserRows(admins);
          }
        });
      });
    }

    function updateAdmin(admin, index) {
      const payload = {
        name: admin.name,
        email: admin.email,
        is_super_admin: admin.role === 'Super Admin'
      };

      fetch(`/api/admins/${admin.admin_id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify(payload)
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            admins[index] = {
              ...admin,
              created_at: admins[index].created_at
            };
            createUserRows(admins);
            alert('Admin updated successfully');
          } else {
            alert('Failed to update admin: ' + (data.message || 'Unknown error'));
          }
        })
        .catch(err => {
          console.error('Update failed:', err);
          alert('Error updating admin: ' + err.message);
        });
    }

    function saveNewAdmin(admin, index) {
      const payload = {
        name: admin.name,
        email: admin.email,
        password: 'default123',
        is_super_admin: admin.role === 'Super Admin'
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
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            admins[index] = {
              admin_id: data.data.admin_id,
              name: data.data.name,
              email: data.data.email,
              role: data.data.is_super_admin ? 'Super Admin' : 'Admin',
              created_at: data.data.created_at
            };
            createUserRows(admins);
          } else {
            alert('Failed to create admin: ' + (data.message || 'Unknown error'));
          }
        })
        .catch(err => {
          console.error('Create failed:', err);
          alert('Error creating admin: ' + err.message);
        });
    }

    function addNewRow() {
      admins.unshift({ admin_id: '', name: '', email: '', role: '' });
      createUserRows(admins);
      const firstRow = document.querySelector('.role-management-row');
      const name = firstRow.querySelector('.role-management-name');
      const role = firstRow.querySelector('.role-management-select');
      const email = firstRow.querySelector('.role-management-email');
      const btn = firstRow.querySelector('.role-management-btn');
      name.disabled = false;
      role.disabled = false;
      email.disabled = false;
      btn.textContent = 'Save';
      btn.classList.remove('role-management-btn-edit');
      btn.classList.add('role-management-btn-save');
    }

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.role-management-btn-add, .role-management-mobile-add-btn')
        .forEach(btn => btn.addEventListener('click', addNewRow));

      const dropdownToggle = document.querySelector('.custom-dropdown-toggle');
      const dropdownMenu = document.querySelector('.custom-dropdown-menu');
      const dropdownItems = document.querySelectorAll('.custom-dropdown-item');

      dropdownToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
      });

      dropdownItems.forEach(item => {
        item.addEventListener('click', () => {
          const val = item.dataset.value;
          let sorted = [...admins];
          if (val === 'name') sorted.sort((a, b) => a.name.localeCompare(b.name));
          else if (val === 'role') sorted.sort((a, b) => b.name.localeCompare(a.name));
          else if (val === 'email-new') sorted.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
          else if (val === 'email-old') sorted.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
          createUserRows(sorted);
          dropdownMenu.style.display = 'none';
        });
      });

      document.addEventListener('click', (e) => {
        if (!e.target.closest('.custom-dropdown')) {
          dropdownMenu.style.display = 'none';
        }
      });

      document.querySelector('.role-management-search').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        const filtered = admins.filter(a =>
          (a.name || '').toLowerCase().includes(q) ||
          (a.email || '').toLowerCase().includes(q) ||
          (a.role || '').toLowerCase().includes(q)
        );
        createUserRows(filtered);
      });

      fetchAdmins();
    });
  </script>
</body>

</html>
