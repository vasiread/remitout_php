<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/adminsidebar.js') }}"></script>
</head>

<body>


    @extends('layouts.app')

    <div class="add-studentcounsellor-adminside">
        <h1 class="studentcounsellor-header-admin">Add Student Counsellor</h1>
        <div class="studentcounsellor-requiredfields-admin">
            <input type="text" placeholder="Name of the Student Counsellor">
            <input type="text" placeholder="Starting Date">
            <input type="text" placeholder="Email ID">
            <input type="text" placeholder="Contact No.">
            <input type="textarea" placeholder="Address" id="student-counsellor-admin-address">
            <input type="text" placeholder="Upload Profile Image" id="trigger-profile-photo-sc">
            <input type="file" id="sc-profile-photo-upload" style="display: none;">
        </div>
        <div class="addcouncellor-buttoncontainer">
            <button id="delete-councellor-admin">Delete</button>
            <button id="generate-referral-councellor-admin">Generate Referral Code</button>
        </div>
    </div>

    @php
        $studentCounsellorsLists = [
            [
                'counsellor_name' => 'Rahul V Raman',
                'counsellor_referral_id' => '3568878827634',
                'date_added' => '2025-02-01'
            ],
            [
                'counsellor_name' => 'Rahul V Raman',
                'counsellor_referral_id' => '3568878827634',
                'date_added' => '2025-02-13'
            ],
            [
                'counsellor_name' => 'Pranav Rajan',
                'counsellor_referral_id' => '3568878827634',
                'date_added' => '2025-09-01'
            ],
            [
                'counsellor_name' => 'Kalim Shaul',
                'counsellor_referral_id' => '3568878827634',
                'date_added' => '2025-02-01'
            ],
            [
                'counsellor_name' => 'Vikra Narayan',
                'counsellor_referral_id' => '3568878827634',
                'date_added' => '2025-04-01'
            ],
            [
                'counsellor_name' => 'Andher Pathil',
                'counsellor_referral_id' => '3568878827634',
                'date_added' => '2025-02-01'
            ]
        ];
    @endphp

    <div class="studentcounsellorlist-adminside">
        <div class="globallistcontainer-header" id="counsellorlistcontainer-headersection">
            <h2>Student Counsellor List</h2>
            <div class="headersection-rightsidecontent">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container">
                    <input type="text" id="search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="dropdown-filters" id="studentlistcontainer-filters">
                    <button class="dropdown-button-filters">
                        <img src="{{asset('assets/images/Icons/filter_icon.png')}}" alt="">
                        Sort by
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content-filters">
                        <a href="#" data-sort="newest">Newest</a>
                        <a href="#" data-sort="oldest">Oldest</a>
                        <a href="#" data-sort="alphabet">A-Z</a>
                        <a href="#" data-sort="alphabet-reverse">Z-A</a>
                    </div>
                </div>
                <button class="studentlist-add-button">Add</button>
            </div>
        </div>

        <div class="individualcounsellorlists-admin" id="counsellor-list">
            <div class="individualcounsellorlists-header">
                <p id="counsellor-name-identify">Student Counsellor Name</p>
                <p id="counsellor-referralid-identify">Referral Number</p>
            </div>

            @foreach ($studentCounsellorsLists as $studentCounsellor)
                <div class="individualcounsellorlists-items" data-added="{{ $studentCounsellor['date_added'] }}">
                    <div class="individualcounsellorlists-content">
                        <p>{{ $studentCounsellor['counsellor_name'] }}</p>
                        <p>{{ $studentCounsellor['counsellor_referral_id'] }}</p>
                    </div>

                    <div class="individualcounsellors-buttoncontainer">
                        <button>
                            <img src="{{ asset('assets/images/Icons/visibility.png') }}" alt="View">
                        </button>
                        <button>
                            <img src="{{ asset('assets/images/Icons/edit_purple.png') }}" alt="Edit">
                        </button>
                        <button>Suspend</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const triggerTextBox = document.getElementById("trigger-profile-photo-sc");
            const triggeredFileThroughText = document.getElementById("sc-profile-photo-upload");
            const dropdownButton = document.querySelector('.dropdown-button-filters');
            const dropdownContent = document.querySelector('.dropdown-content-filters');
            const sortLinks = document.querySelectorAll('#counsellorlistcontainer-headersection .dropdown-content-filters a');
            const counsellorList = document.getElementById('counsellor-list');

            // Toggle dropdown menu
            dropdownButton.addEventListener('click', () => {
                dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
            });

            // Sorting functionality
            sortLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortType = link.getAttribute('data-sort');
                    const items = Array.from(counsellorList.querySelectorAll('.individualcounsellorlists-items'));

                    if (sortType === 'newest') {
                        items.sort((a, b) => new Date(b.dataset.added) - new Date(a.dataset.added));
                    } else if (sortType === 'oldest') {
                        items.sort((a, b) => new Date(a.dataset.added) - new Date(b.dataset.added));
                    } else if (sortType === 'alphabet') {
                        items.sort((a, b) => a.textContent.trim().localeCompare(b.textContent.trim()));
                    } else if (sortType === 'alphabet-reverse') {
                        items.sort((a, b) => b.textContent.trim().localeCompare(a.textContent.trim()));
                    }

                    // Re-append sorted items
                    items.forEach(item => counsellorList.appendChild(item));
                });
            });

            // Fetch users and update list
            const getScUsers = () => {
                fetch('/getallscuser', {
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            updateCounsellorList(data.receivedData);
                        } else {
                            console.error(data.error);
                        }
                    })
                    .catch((error) => {
                        console.error("Fetch error: ", error);
                    });
            };

            getScUsers();

            // Trigger profile photo upload via text box click
            if (triggerTextBox && triggeredFileThroughText) {
                triggerTextBox.addEventListener("click", () => {
                    triggeredFileThroughText.click();
                });
            }

            // Search functionality
            document.querySelector("#counsellorlistcontainer-headersection .searchcontainer-rightsidecontent input").addEventListener("input", function () {
                const searchQuery = this.value.toLowerCase();
                const counsellorNames = document.querySelectorAll("#counsellor-list .individualcounsellorlists-items");

                counsellorNames.forEach(item => {
                    const counsellorName = item.querySelector('p').textContent.toLowerCase();
                    item.style.display = counsellorName.includes(searchQuery) ? 'flex' : 'none';
                });
            });
        });

        // Customize date picker using Flatpickr
        const customizeDatePicker = () => {
            flatpickr("#studentcounsellor-requiredfields-admin-startdate", {
                dateFormat: "Y-m-d",
                altInput: false,
                altFormat: "F j, Y",
                defaultDate: "today",
                minDate: "today",
                maxDate: new Date().fp_incr(365),
                enableTime: false,
                onReady: (selectedDates, dateStr) => {
                    console.log("Initial Date: ", dateStr);
                },
                onChange: (selectedDates, dateStr) => {
                    console.log("Selected date:", dateStr);
                }
            });
        };

        // Add student counsellor form submission
        const addStudentCounsellor = () => {
            const scUserName = document.getElementById("studentcounsellor-requiredfields-admin-scname").value;
            const scDob = document.getElementById("studentcounsellor-requiredfields-admin-startdate").value;
            const scEmail = document.getElementById("studentcounsellor-requiredfields-admin-email").value;
            const scContact = document.getElementById("studentcounsellor-requiredfields-admin-contact").value;
            const scAddress = document.getElementById("student-counsellor-admin-address").value;
            const profilePhoto = document.getElementById("sc-profile-photo-upload");

            // Basic form validation
            if (!scUserName) return alert('Please enter the Student Counsellor name.');
            if (!scDob) return alert('Please enter the date of birth.');
            if (!scEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(scEmail)) return alert('Please enter a valid email address.');
            if (!scContact || !/^[0-9]{10}$/.test(scContact)) return alert('Please enter a valid 10-digit contact number.');
            if (!scAddress) return alert('Please enter the address.');
            if (!profilePhoto.files || profilePhoto.files.length === 0) return alert('Please upload a profile photo.');

            // Create FormData
            const formData = new FormData();
            formData.append('scUserName', scUserName);
            formData.append('scDob', scDob);
            formData.append('scEmail', scEmail);
            formData.append('scContact', scContact);
            formData.append('scAddress', scAddress);
            formData.append('profilePhoto', profilePhoto.files[0]);

            // Submit form
            fetch('/register-studentcounsellor', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.message) {
                        alert(data.message);
                        document.getElementById("studentcounsellor-requiredfields-admin-scname").value = '';
                        document.getElementById("studentcounsellor-requiredfields-admin-startdate").value = '';
                        document.getElementById("studentcounsellor-requiredfields-admin-email").value = '';
                        document.getElementById("studentcounsellor-requiredfields-admin-contact").value = '';
                        document.getElementById("student-counsellor-admin-address").value = '';
                        profilePhoto.value = '';
                    } else if (data.error) {
                        console.error(data.error);
                        alert(`Error: ${data.error}`);
                    }
                })
                .catch((err) => {
                    console.error('An error occurred:', err);
                    alert("An Error Occurred, Try Again");
                });
        };

        // Update counsellor list in UI
        const updateCounsellorList = (counsellorList) => {
            const counsellorContainer = document.getElementById('counsellor-list');
            counsellorContainer.innerHTML = '';

            counsellorList.forEach(counsellor => {
                const counsellorItem = document.createElement('div');
                counsellorItem.className = 'individualcounsellorlists-items';
                counsellorItem.setAttribute('data-added', counsellor.created_at);

                const counsellorContent = document.createElement('div');
                counsellorContent.className = 'individualcounsellorlists-content';

                const counsellorName = document.createElement('p');
                counsellorName.id = 'student-counsellor-name-id';
                counsellorName.textContent = counsellor.full_name;

                const counsellorReferral = document.createElement('p');
                counsellorReferral.textContent = counsellor.referral_code;

                counsellorContent.appendChild(counsellorName);
                counsellorContent.appendChild(counsellorReferral);
                counsellorItem.appendChild(counsellorContent);

                const buttonContainer = document.createElement('div');
                buttonContainer.className = 'individualcounsellors-buttoncontainer';

                const viewButton = document.createElement('button');
                viewButton.innerHTML = '<img src="/assets/images/Icons/visibility.png" alt="View">';
                buttonContainer.appendChild(viewButton);

                const editButton = document.createElement('button');
                editButton.innerHTML = '<img src="/assets/images/Icons/edit_purple.png" alt="Edit">';
                buttonContainer.appendChild(editButton);

                const suspendButton = document.createElement('button');
                suspendButton.textContent = 'Suspend';
                buttonContainer.appendChild(suspendButton);

                counsellorItem.appendChild(buttonContainer);
                counsellorContainer.appendChild(counsellorItem); // Add item to the list
            });
        };
    </script>


</body>

</html>