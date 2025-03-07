<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/adminsidebar.js') }}">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr">
    </script>

</head>

<body>


    @extends('layouts.app')

    <div class="add-studentcounsellor-adminside">
        <h1 class="studentcounsellor-header-admin">
            Add Student Counsellor
        </h1>
        <div class="studentcounsellor-requiredfields-admin">
            <input type="text" placeholder="Name of the Student Counsellor"
                id="studentcounsellor-requiredfields-admin-scname">
            <input type="text" placeholder="Starting Date" id="studentcounsellor-requiredfields-admin-startdate">
            <input type="email" placeholder="Email ID" id="studentcounsellor-requiredfields-admin-email">
            <input type="text" placeholder="Contact No." id="studentcounsellor-requiredfields-admin-contact">
            <input type="textarea" placeholder="Address" id="student-counsellor-admin-address">
            <div id="trigger-profile-photo-sc">Upload Profile Image</div>
            <input type="file" id="sc-profile-photo-upload" style="display: none;">
        </div>
        <div class="addcouncellor-buttoncontainer">
            <button id="delete-councellor-admin">Delete</button>
            <button id="generate-referral-councellor-admin">Generate Referral Code</button>
        </div>
    </div>


    @php




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
                <p id="cousellor-name-identify">Student Counsellor name</p>
                <p id="cousellor-referralid-identify">Referral Number</p>
            </div>

            <div class="individualcounsellorlists-items" data-added="">

                <div class="individualcounsellorlists-content">

                    <p id="student-counsellor-name-id"></p>
                    <p></p>
                </div>

                <div class="individualcounsellors-buttoncontainer">
                    <button> <img src="{{asset("assets/images/Icons/visibility.png")}}"> </button>
                    <button> <img src="{{asset("assets/images/Icons/edit_purple.png")}}"></button>
                    <button>Suspend</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const triggerTextBox = document.getElementById("trigger-profile-photo-sc");
            const triggeredFileThroughText = document.getElementById("sc-profile-photo-upload");
            const dropdownButton = document.querySelector('.dropdown-button-filters');
            const dropdownContent = document.querySelector('.dropdown-content-filters');


            document.getElementById("generate-referral-councellor-admin").addEventListener('click', () => {
                addStudentCounsellor()

            })

            document.querySelector(".student-listcontainer .studentlist-add-button").addEventListener('click', () => {
                const studentList = document.querySelector(".student-listcontainer");
                const studentCounsellorAdminSide = document.querySelector(".add-studentcounsellor-adminside");

                if (studentList && studentCounsellorAdminSide) {
                    studentList.style.display = "none";
                    studentCounsellorAdminSide.style.display = "flex";
                }

            })


            const sortLinks = document.querySelectorAll('#counsellorlistcontainer-headersection .dropdown-content-filters a');
            const counsellorList = document.getElementById('counsellor-list');
            dropdownButton.addEventListener('click', function () {
                dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
            });
            sortLinks.forEach(items => {
                items.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sortType = this.getAttribute('data-sort');
                    const items = Array.from(counsellorList.querySelectorAll('#counsellor-list .individualcounsellorlists-items'));

                    if (sortType === 'newest') {
                        items.sort((a, b) => new Date(b.dataset.added) - new Date(a.dataset.added));
                    } else if (sortType === 'oldest') {
                        items.sort((a, b) => new Date(a.dataset.added) - new Date(b.dataset.added));
                    } else if (sortType === 'alphabet') {
                        items.sort((a, b) => a.textContent.trim().localeCompare(b.textContent.trim()));
                    } else if (sortType === 'alphabet-reverse') {
                        items.sort((a, b) => b.textContent.trim().localeCompare(a.textContent.trim()));
                    }
                    items.forEach(item => counsellorList.appendChild(item));



                })
            })


            const getScUsers = () => {
                fetch('/getallscuser', {
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            const counsellorList = data.receivedData;
                            updateCounsellorList(counsellorList);
                        } else {
                            console.error(data.error);
                        }
                    })
                    .catch((error) => {
                        console.error("Fetch error: ", error);
                    });
            };

            getScUsers();





            if (triggerTextBox && triggeredFileThroughText) {
                triggerTextBox.addEventListener("click", () => {
                    triggeredFileThroughText.click();
                });
            }

            triggeredFileThroughText.addEventListener('change', () => {
                if (triggeredFileThroughText.files.length > 0) {
                    triggerTextBox.textContent = triggeredFileThroughText.files[0].name;
                }
            })

            document.querySelector("#counsellorlistcontainer-headersection .searchcontainer-rightsidecontent input").addEventListener("input", function () {

                const searchQueryStudentCounsellor = this.value.toLowerCase();


                const studentCounsellorNames = document.querySelectorAll("#counsellor-list .individualcounsellorlists-items");


                studentCounsellorNames.forEach(item => {

                    const counsellorName = item.querySelector('p').textContent.toLowerCase();


                    if (counsellorName.includes(searchQueryStudentCounsellor)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });


        });

        const customizeDatePicker = () => {
            flatpickr("#studentcounsellor-requiredfields-admin-startdate", {
                dateFormat: "Y-m-d",
                altInput: false,
                altFormat: "F j, Y",
                defaultDate: "today",
                minDate: "today",
                maxDate: new Date().fp_incr(365),
                enableTime: false,
                onReady: function (selectedDates, dateStr, instance) {
                    console.log("Initial Date: ", dateStr);
                },
                onChange: function (selectedDates, dateStr, instance) {
                    console.log("Selected date:", dateStr);
                }
            });

            return dateStr

        }


        const addStudentCounsellor = () => {
            const scUserName = document.getElementById("studentcounsellor-requiredfields-admin-scname").value;
            const scDob = document.getElementById("studentcounsellor-requiredfields-admin-startdate").value;
            const scEmail = document.getElementById("studentcounsellor-requiredfields-admin-email").value;
            const scContact = document.getElementById("studentcounsellor-requiredfields-admin-contact").value;
            const scAddress = document.getElementById("student-counsellor-admin-address").value;
            const profilePhoto = document.getElementById("sc-profile-photo-upload");

            // Name validation
            if (!scUserName) {
                alert('Please enter the Student Counsellor name.');
                return;
            }

            if (!scDob) {
                alert('Please enter the date of birth.');
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!scEmail || !emailPattern.test(scEmail)) {
                alert('Please enter a valid email address.');
                return;
            }

            const contactPattern = /^[0-9]{10}$/;
            if (!scContact || !contactPattern.test(scContact)) {
                alert('Please enter a valid 10-digit contact number.');
                return;
            }

            if (!scAddress) {
                alert('Please enter the address.');
                return;
            }

            if (!profilePhoto.files || profilePhoto.files.length === 0) {
                alert('Please upload a profile photo.');
                return;
            }

            const formData = new FormData();
            formData.append('scUserName', scUserName);
            formData.append('scDob', scDob);
            formData.append('scEmail', scEmail);
            formData.append('scContact', scContact);
            formData.append('scAddress', scAddress);
            formData.append('profilePhoto', profilePhoto.files[0]);

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
                        console.log(data);

                        document.getElementById("studentcounsellor-requiredfields-admin-scname").value = '';
                        document.getElementById("studentcounsellor-requiredfields-admin-startdate").value = '';
                        document.getElementById("studentcounsellor-requiredfields-admin-email").value = '';
                        document.getElementById("studentcounsellor-requiredfields-admin-contact").value = '';
                        document.getElementById("student-counsellor-admin-address").value = '';
                        profilePhoto.value = '';
                    }
                    else if (data.error) {
                        console.error(data.error);
                        alert(`Error: ${data.error}`);
                    }
                })
                .catch((err) => {
                    console.error('An error occurred:', err);
                    alert("An Error Occurred, Try Again");
                });
        };


        const updateCounsellorList = (counsellorList) => {
            const counsellorContainer = document.getElementById('counsellor-list');
            counsellorContainer.innerHTML = '';

            counsellorList.forEach(counsellor => {
                const fullTimestamp = counsellor.created_at;
                const counsellorItem = document.createElement('div');
                counsellorItem.className = 'individualcounsellorlists-items';
                counsellorItem.setAttribute('data-added', fullTimestamp);

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

                counsellorContainer.appendChild(counsellorItem);
            });
        };
    </script>

</body>

</html>