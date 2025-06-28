<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @php
        $nbfcLists = [
            [
                'nbfc_name' => 'JHUKNMBH Bank',
                'nbfc_type' => 'NBFC',
                'date_added' => '2025-02-01'
            ],
            [
                'nbfc_name' => 'Abcdefgh Bank ',
                'nbfc_type' => 'NBFC',
                'date_added' => '2025-02-13'
            ],
            [
                'nbfc_name' => 'Rupee Empire Financial Services',
                'nbfc_type' => 'Financial Company',
                'date_added' => '2025-09-01'
            ],
            [
                'nbfc_name' => 'Hanuman Enterprises',
                'nbfc_type' => 'Financial Company',
                'date_added' => '2025-02-01'
            ],
            [
                'nbfc_name' => 'Hanuman Enterprises',
                'nbfc_type' => 'Financial Company',
                'date_added' => '2025-04-01'
            ],
            [
                'nbfc_name' => 'Abcdefgh Bank',
                'nbfc_type' => 'NBFC',
                'date_added' => '2025-02-01'
            ],
        ]
    @endphp

    <div class="nbfclist-adminside">
        <div class="globallistcontainer-header" id="nbfclistcontainer-headersection">
            <div class="nbfclist-adminside-container">
                <h2>NBFCs List</h2>
            </div>
            <div class="headersection-rightsidecontent" id="headersection-rightsidecontent-nbfc">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container-nbfc">
                    <input type="text" id="search-student-list-nbfc" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="nbfc-dropdown-filters" id="nbfc-listcontainer-filters">
                    <button class="nbfc-dropdown-button">
                        <img src="{{ asset('assets/images/Icons/filter_icon.png') }}" alt="">
                        Sort
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="nbfc-dropdown-content" style="display: none;">
                        <a href="#" data-sort="alphabet">A-Z</a>
                        <a href="#" data-sort="alphabet-reverse">Z-A</a>
                        <a href="#" data-sort="newest">Newest</a>
                        <a href="#" data-sort="oldest">Oldest</a>
                    </div>
                </div>
                <button class="studentlist-add-button">Add</button>
            </div>
        </div>

        <div class="individualnbfc-admin" id="nbfc-list">
            <div class="individualnbfclists-items">
                <div class="individualnbfclists-content">
                    <p id="nbfc-name-id" class="editable"></p>
                    <p class="editable"></p>
                     <div class="individualnbfcs-buttoncontainer">
                    <button class="edit-save-button nbfc-list-edit-button edit-nbfc">Edit</button>
                    <button>Suspend</button>
                </div>
                </div>
               
            </div>
        </div>
    </div>
    <div class="add-nbfc-datasection">
        <div class="add-nbfc-firstsection">
            <h3>Add NBFC</h3>
            <button id="save-all-nbfc">Save All</button>
        </div>
        <div class="formsection-addnbfcuser">
            <div class="firstgroup-field-nbfcadd">
                <input type="text" id="nbfc-name-id-required" placeholder="Name of the Bank">
                <div class="nbfc-type-dropdown">
                    <button class="nbfc-dropdown-trigger">
                        <p>Type</p>
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="nbfc-dropdown-content" style="display:none">
                        <a href="#" class="dropdown-item" data-value="NBFC">NBFC</a>
                        <a href="#" class="dropdown-item" data-value="Financial Company">Financial Company</a>
                        <a href="#" class="dropdown-item" data-value="Bank">Bank</a>
                    </div>
                </div>
            </div>
            <input type="text" id="nbfc-email-id" placeholder="bankemail@gmail.com">
            <input type="text" id="about-nbfc-id" placeholder="Description About the Bank or the company">
            <button class="delete-nbfc-id">Delete</button>
        </div>
        <button id="add-nbfc-user-more">Add</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            nbfcListInitialize();

            const nbfcAdminsideButton = document.querySelector(".nbfclist-adminside .studentlist-add-button");
            const nbfcAdminside = document.querySelector(".nbfclist-adminside");
            const nbfcAdminsideAddAuthority = document.querySelector(".add-nbfc-datasection");

            if (nbfcAdminsideButton) {
                nbfcAdminsideButton.addEventListener('click', () => {
                    nbfcAdminside.style.display = "none";
                    nbfcAdminsideAddAuthority.style.display = "flex";
                });
            }

            const deletefirstbutton = document.querySelector(".delete-nbfc-id");

            deletefirstbutton.addEventListener('click', () => {
                const inputs = document.querySelectorAll(".formsection-addnbfcuser input");
                inputs.forEach((item) => {
                    item.value = '';
                })
            })

            document.querySelector("#nbfclistcontainer-headersection .searchcontainer-rightsidecontent input").addEventListener("input", function () {
                const searchQueryNBFC = this.value.toLowerCase();
                const nbfcListOfNames = document.querySelectorAll("#nbfc-list .individualnbfclists-items");

                nbfcListOfNames.forEach(item => {
                    const nbfcName = item.querySelector('#nbfc-name-id').textContent.toLowerCase();
                    if (nbfcName.includes(searchQueryNBFC)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            document.querySelector(".add-nbfc-firstsection #save-all-nbfc").addEventListener('click', () => {
                uploadMultipleNbfcUsers();
            })

            const dropdownButton = document.querySelector('#nbfc-listcontainer-filters .nbfc-dropdown-button');
            const dropdownContent = document.querySelector('#nbfc-listcontainer-filters .nbfc-dropdown-content');
            const sortLinks = document.querySelectorAll('#nbfc-listcontainer-filters .nbfc-dropdown-content a');
            const nbfcList = document.getElementById('nbfc-list');

            dropdownButton.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });

            window.addEventListener('click', function (e) {
                if (!dropdownButton.contains(e.target) && !dropdownContent.contains(e.target)) {
                    dropdownContent.style.display = 'none';
                }
            });

            sortLinks.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sortType = this.getAttribute('data-sort');
                    const items = Array.from(nbfcList.querySelectorAll('.individualnbfclists-items'));

                    if (sortType === 'newest') {
                        items.sort((a, b) => {
                            const dateA = new Date(a.querySelector('.individualnbfclists-content').getAttribute('data-added') || '1970-01-01');
                            const dateB = new Date(b.querySelector('.individualnbfclists-content').getAttribute('data-added') || '1970-01-01');
                            return dateB - dateA;
                        });
                    } else if (sortType === 'oldest') {
                        items.sort((a, b) => {
                            const dateA = new Date(a.querySelector('.individualnbfclists-content').getAttribute('data-added') || '1970-01-01');
                            const dateB = new Date(b.querySelector('.individualnbfclists-content').getAttribute('data-added') || '1970-01-01');
                            return dateA - dateB; // Oldest first
                        });
                    } else if (sortType === 'alphabet') {
                        items.sort((a, b) => a.querySelector('#nbfc-name-id').textContent.trim().localeCompare(b.querySelector('#nbfc-name-id').textContent.trim()));
                    } else if (sortType === 'alphabet-reverse') {
                        items.sort((a, b) => b.querySelector('#nbfc-name-id').textContent.trim().localeCompare(a.querySelector('#nbfc-name-id').textContent.trim()));
                    }

                    nbfcList.innerHTML = ''; // Clear the list
                    items.forEach(item => nbfcList.appendChild(item)); // Re-append sorted items
                    dropdownContent.style.display = 'none';
                });
            });

            window.addEventListener('resize', function () {
                dynamicChangesThroughWindow();
            });

            dynamicChangesThroughWindow();


        });

        document.addEventListener('click', (event) => {
            const dropdown = event.target.closest('.nbfc-type-dropdown');
            if (dropdown) {
                const trigger = dropdown.querySelector('.nbfc-dropdown-trigger');
                const content = dropdown.querySelector('.nbfc-dropdown-content');
                if (event.target === trigger || trigger.contains(event.target)) {
                    content.style.display = content.style.display === 'flex' ? 'none' : 'flex';
                } else if (!content.contains(event.target)) {
                    content.style.display = 'none';
                }
            } else {
                document.querySelectorAll('.nbfc-type-dropdown .nbfc-dropdown-content').forEach(dropdownContent => {
                    dropdownContent.style.display = 'none';
                });
            }
        });

        document.querySelectorAll('.nbfc-type-dropdown .dropdown-item').forEach(item => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const selectedValue = event.target.getAttribute('data-value');
                const dropdown = event.target.closest('.nbfc-type-dropdown');
                const triggerText = dropdown.querySelector('.nbfc-dropdown-trigger p');
                triggerText.textContent = selectedValue;
                dropdown.querySelector('.nbfc-dropdown-content').style.display = 'none';
            });
        });

        document.getElementById("add-nbfc-user-more").addEventListener('click', () => {
            const container = document.querySelector(".add-nbfc-datasection");

            const newForm = document.createElement('div');
            newForm.classList.add('formsection-addnbfcuser');
            newForm.innerHTML = `
                <div class="firstgroup-field-nbfcadd">
                    <input type="text" id="nbfc-name-id-required" placeholder="Name of the Bank">
                    <div class="nbfc-type-dropdown">
                        <button class="nbfc-dropdown-trigger">
                            <p>Type</p>
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <div class="nbfc-dropdown-content" style="display:none">
                            <a href="#" class="dropdown-item" data-value="NBFC">NBFC</a>
                            <a href="#" class="dropdown-item" data-value="Financial Company">Financial Company</a>
                            <a href="#" class="dropdown-item" data-value="Bank">Bank</a>
                        </div>
                    </div>
                </div>
                <input type="text" id="nbfc-email-id" placeholder="bankemail@gmail.com">
                <input type="text" id="about-nbfc-id" placeholder="Description About the Bank or the company">
                <button class="delete-nbfc-id">Delete</button>
            `;

            container.insertBefore(newForm, document.getElementById("add-nbfc-user-more"));

            newForm.querySelector('.delete-nbfc-id').addEventListener('click', () => {
                newForm.remove();
            });

            const newDropdownTrigger = newForm.querySelector('.nbfc-dropdown-trigger');
            const newDropdownContent = newForm.querySelector('.nbfc-dropdown-content');
            newDropdownTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                newDropdownContent.style.display = newDropdownContent.style.display === 'none' ? 'flex' : 'none';
            });

            newForm.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', (event) => {
                    event.preventDefault();
                    const selectedValue = event.target.getAttribute('data-value');
                    newForm.querySelector(".nbfc-dropdown-trigger p").textContent = selectedValue;
                    newDropdownContent.style.display = 'none';
                });
            });
        });

        window.addEventListener('click', (event) => {
            const dropdown = event.target.closest('.nbfc-type-dropdown');
            if (!dropdown) {
                document.querySelectorAll('.nbfc-type-dropdown .nbfc-dropdown-content').forEach(content => {
                    content.style.display = 'none';
                });
            }
        });

        function dynamicChangesThroughWindow() {
            if (window.innerWidth < 768) {
                document.querySelector('.studentlist-add-button').innerHTML = "+";
            } else {
                document.querySelector('.studentlist-add-button').innerHTML = "Add";
            }
        }

        const nbfcListInitialize = () => {
            fetch("/getnbfcdata", {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (!data.success) {
                        console.error(data.error);
                        return;
                    }

                    const nbfcListContainer = document.getElementById("nbfc-list");
                    nbfcListContainer.innerHTML = '';

                    data.receivedData.forEach((item) => {
                        // console.log("NBFC item:", item); // Debug log

                        const nbfcItemDiv = document.createElement('div');
                        nbfcItemDiv.classList.add('individualnbfclists-items');

                        // ✅ Correctly set the actual nbfc_id
                        nbfcItemDiv.setAttribute('data-id', item.nbfc_id);

                        const dateAdded = new Date(item.created_at).toISOString();

                        nbfcItemDiv.innerHTML = `
                <div class="individualnbfclists-content" data-added="${dateAdded}">
                    <p id="nbfc-name-id" class="editable">${item.nbfc_name}</p>
                    <p class="editable">${item.nbfc_type}</p>
                </div>
                <div class="individualnbfcs-buttoncontainer">
                    <button class="edit-save-button nbfc-list-edit-button edit-nbfc">Edit</button>
                    <button class="suspend-button-nbfc" style="width:fit-content">Suspend</button>
                </div>
            `;

                        nbfcListContainer.appendChild(nbfcItemDiv);
                    });

                    document.querySelectorAll('.edit-save-button').forEach(button => {
                        button.addEventListener('click', () => {
                            const item = button.closest('.individualnbfclists-items');
                            const nameElement = item.querySelector('#nbfc-name-id');
                            const typeElement = item.querySelector('.individualnbfclists-content p:nth-child(2)');
                            const isEditing = item.classList.contains('edit-mode');
                            const isSaveButton = button.classList.contains('save-nbfc');

                            if (!isEditing) {
                                item.classList.add('edit-mode');

                                const currentName = nameElement.textContent;
                                const currentType = typeElement.textContent;

                                nameElement.innerHTML = `<input type="text" value="${currentName}" />`;
                                typeElement.innerHTML = `
                        <select>
                            <option value="NBFC" ${currentType === 'NBFC' ? 'selected' : ''}>NBFC</option>
                            <option value="Financial Company" ${currentType === 'Financial Company' ? 'selected' : ''}>Financial Company</option>
                            <option value="Bank" ${currentType === 'Bank' ? 'selected' : ''}>Bank</option>
                        </select>
                    `;

                                button.textContent = 'Save';
                                button.classList.remove('edit-nbfc');
                                button.classList.add('save-nbfc');
                            } else if (isSaveButton) {
                                const newName = item.querySelector('input').value;
                                const newType = item.querySelector('select').value;
                                const nbfcId = item.getAttribute('data-id');

                                console.log(`Updating NBFC - ID: ${nbfcId}, Name: ${newName}, Type: ${newType}`);

                                nameElement.textContent = newName;
                                typeElement.textContent = newType;

                                fetch('/updatenbfc', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        id: nbfcId,
                                        nbfc_name: newName,
                                        nbfc_type: newType
                                    })
                                })
                                    .then(response => {
                                        if (!response.ok) {
                                            return response.text().then(text => {
                                                throw new Error(`Network error: ${response.status} ${response.statusText} - ${text}`);
                                            });
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.success) {
                                            alert('NBFC updated successfully');
                                        } else {
                                            throw new Error(data.message || 'Update failed');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error updating NBFC:', error.message);
                                    })
                                    .finally(() => {
                                        item.classList.remove('edit-mode');
                                        button.textContent = 'Edit';
                                        button.classList.remove('save-nbfc');
                                        button.classList.add('edit-nbfc');
                                    });
                            }
                        });
                    });
                    document.querySelectorAll('.suspend-button-nbfc').forEach(button => {
                        button.addEventListener('click', () => {
                            const item = button.closest('.individualnbfclists-items');
                            const nbfcId = item.getAttribute('data-id');

                            fetch('/suspendnbfc', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    nbfc_id: nbfcId
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('NBFC suspended successfully');
                                        nbfcListInitialize();
                                        item.classList.add('suspended'); // Optionally add a class to highlight the suspended item
                                    } else {
                                        alert('Error suspending NBFC');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error suspending NBFC:', error.message);
                                });
                        });
                    });

                })
                .catch((error) => {
                    console.error('Failed to fetch NBFC data:', error);
                });
        };

        const uploadMultipleNbfcUsers = () => {
            const nbfcBulkUsers = [];
            const allForms = document.querySelectorAll(".formsection-addnbfcuser");

            allForms.forEach(form => {
                const nbfcName = form.querySelector('#nbfc-name-id-required')?.value?.trim();
                const nbfcType = form.querySelector('.nbfc-dropdown-trigger p')?.textContent?.trim();
                const nbfcEmail = form.querySelector('#nbfc-email-id')?.value?.trim();
                const aboutNbfc = form.querySelector('#about-nbfc-id')?.value?.trim();

                nbfcBulkUsers.push({
                    name: nbfcName || '',
                    type: nbfcType || '',
                    email: nbfcEmail || '',
                    description: aboutNbfc || ''
                });
            });

            fetch('/addbulkusers', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(nbfcBulkUsers)
            })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    if (status === 200 && body.success) {
                        // Clear forms except first one
                        document.querySelectorAll(".formsection-addnbfcuser").forEach((item, index) => {
                            if (index > 0) item.remove();
                            else {
                                item.querySelectorAll("input, textarea").forEach(input => input.value = '');
                            }
                        });
                        alert(body.message);
                        nbfcListInitialize(); // Refresh list
                    } else if (status === 422 && body.errors) {
                        // Compile error messages into a single string
                        let errorMessages = '';
                        Object.entries(body.errors).forEach(([index, messages]) => {
                            errorMessages += `Form #${parseInt(index) + 1}:\n`;
                            messages.forEach(msg => {
                                errorMessages += `- ${msg}\n`;
                            });
                            errorMessages += '\n';
                        });
                        alert("Some entries failed:\n\n" + errorMessages);
                    } else {
                        alert("Something went wrong. Please try again.");
                        console.error(body);
                    }
                })
                .catch((error) => {
                    console.error("Fetch error:", error);
                    alert("An unexpected error occurred. Try again.");
                });

        };

    </script>
</body>

</html>