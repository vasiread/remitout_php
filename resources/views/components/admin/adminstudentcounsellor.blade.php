<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/adminsidebar.js') }}"></script>
    <!-- Add Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        /* Add your CSS here if needed */
    </style>
</head>

<body>
    @extends('layouts.app')

    @php
        $profileIconPath = "assets/images/account_circle1.png";
        $phoneIconPath = "assets/images/call.png";
        $mailIconPath = "assets/images/mail.png";
        $pindropIconPath = "assets/images/pin_drop.png";
    @endphp

    @php
        $studentCounsellorsLists = [];
    @endphp

    <div class="add-studentcounsellor-adminside">
        <h1 class="studentcounsellor-header-admin">Add Student Counsellor</h1>
        <div class="studentcounsellor-requiredfields-admin">
            <div class="input-container-sc">
                <input type="text" id="studentcounsellor-requiredfields-admin-scname"
                    placeholder="Name of the Student Counsellor">
                <span class="error-message-sc" id="scname-error"></span>
            </div>
            <div class="input-container-sc">
                <input type="text" id="studentcounsellor-requiredfields-admin-startdate" placeholder="DoB">
                <span class="error-message-sc" id="startdate-error"></span>
            </div>
            <div class="input-container-sc">
                <input type="email" id="studentcounsellor-requiredfields-admin-email" placeholder="Email ID">
                <span class="error-message-sc" id="email-error"></span>
            </div>
            <div class="input-container-sc">
                <input type="text" id="studentcounsellor-requiredfields-admin-contact" placeholder="Contact No.">
                <span class="error-message-sc" id="contact-error"></span>
            </div>
            <div class="input-container-sc">
                <textarea id="student-counsellor-admin-address" placeholder="Address"></textarea>
                <span class="error-message-sc" id="address-error"></span>
            </div>
            <div class="upload-container input-container-sc">
                <input type="text" placeholder="Upload Profile Image" id="trigger-profile-photo-sc" readonly>
                <input type="file" id="sc-profile-photo-upload" style="display: none;">
                <span class="error-message-sc" id="profile-photo-error"></span>
            </div>
        </div>
        <div class="addcouncellor-buttoncontainer">
            <button id="delete-councellor-admin">Delete</button>
            <button id="generate-referral-councellor-admin">Generate Referral Code</button>
        </div>
    </div>

    <div class="studentcounsellorlist-adminside">
        <div class="globallistcontainer-header" id="counsellorlistcontainer-headersection">
            <h2>Student Counsellor List</h2>
            <div class="headersection-rightsidecontent">
                <div class="searchcontainer-rightsidecontent" id="counsellor-search-student-list-container">
                    <input type="text" id="counsellor-search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="dashboard-sort-button-container">
                    <button class="dashboard-sort-button" onclick="toggleCounsellorSortOptions()">
                        Sort
                        <img src="assets/images/filter-icon.png" alt="Filter">
                    </button>

                    <div class="dashboard-sort-options" id="counsellor-dashboard-sort-options">
                        <button class="dashboard-sort-option" data-sort="alphabet">A-Z</button>
                        <button class="dashboard-sort-option" data-sort="alphabet-reverse">Z-A</button>
                        <button class="dashboard-sort-option" data-sort="newest">Newest</button>
                        <button class="dashboard-sort-option" data-sort="oldest">Oldest</button>
                    </div>
                </div>

                <button class="studentlist-add-button" id="switch-addcounsellor">Add</button>
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
                        <p id="student-counsellor-name-id">{{ $studentCounsellor['counsellor_name'] }}</p>
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

    <div class="scdashboard-inboxcontent" id="scdashboard-profile-adminside" style="display: none;">
        <div class="scmember-profilecontainer">
            <div class="scmember-profilecontainerimg">
                <img src="{{asset('assets/images/image-women.jpeg')}}" id="studentcounsellor-profile" alt="">
                <i class="fa-regular fa-pen-to-square"></i>
                <input type="file" id="sc-profile-upload-cloud" style="display: none;">
            </div>

            <div class="scmember-rowfirst">
                <h1>Student Counsellor</h1>
            </div>
            <p id="screferral-id-fromprofile">Referral Number: <span></span></p>
            <div id="screferral-dob-fromprofile" inputmode="Date">
                <i class="fa-solid fa-calendar"></i>
                <p id="dob-display"></p>
            </div>
            <div id="screferral-dob-fromprofile-editmode" style="display: none;">
                <i class="fa-solid fa-calendar"></i>
                <input type="text" id="dob-input">
            </div>
            <ul class="scmember_personalinfo">
                <li class="scmember_personal_info_name" id="referenceNeId">
                    <img src="{{$profileIconPath}}" alt="">
                    <p></p>
                </li>
                <li class="scmember_personal_info_phone">
                    <img src="{{$phoneIconPath}}" alt="">
                    <p></p>
                </li>
                <li class="scmember_personal_info_email" style="word-break: break-all;" id="referenceEmailId">
                    <img src="{{$mailIconPath}}" alt="">
                    <p></p>
                </li>
                <li class="scmember_personal_info_state">
                    <img src="{{$pindropIconPath}}" alt="">
                    <p style="line-height:19px"></p>
                </li>
            </ul>
            <ul class="scmember_personalinfo_editmode">
                <li class="scmember_personal_info_name" id="referenceNeId">
                    <img src="{{$profileIconPath}}" alt="">
                    <input type="text">
                </li>
                <li class="scmember_personal_info_phone">
                    <img src="{{$phoneIconPath}}" alt="">
                    <input type="text">
                </li>
                <li class="scmember_personal_info_email" id="referenceEmailId">
                    <img src="{{$mailIconPath}}" alt="">
                    <input type="text" disabled>
                </li>
                <li class="scmember_personal_info_state-edit">
                    <div class="scmember-personal_address_header">
                        <img src="{{$pindropIconPath}}" alt="">
                        <input type="text" disabled>
                    </div>
                    <div class="subbranch-of-address">
                        <input type="text" placeholder="area" id="scaddress-address">
                        <input type="text" placeholder="city" id="scaddress-city">
                        <input type="text" placeholder="state" id="scaddress-state">
                        <input type="text" placeholder="pincode" id="scaddress-pincode">
                    </div>
                </li>
            </ul>
        </div>
        <div class="scdashboard-performancecontainer">
            <div class="performancecontainer-firstrow">
                <h3>Performance</h3>
                <button class="edit-scuser" style="cursor:pointer">Edit</button>
                <button class="save-scuser" style="cursor:pointer">Save</button>
            </div>
            <ul class="scdashboard-individual-performance">
                <li>
                    <p>Average Leads/month</p>
                    <span>10</span>
                </li>
                <li>
                    <p>Total Leads</p>
                    <span>20</span>
                </li>
                <li>
                    <p>Total Commission</p>
                    <span>10</span>
                </li>
                <li>
                    <p>Pending Amount</p>
                    <span>₹2000</span>
                </li>
            </ul>
            <div class="scdashboard-queryraisedcontainer">
                <div class="queryraisedcontainer-firstrow">
                    <p id="queryraised-header">Queries Raised</p>
                    <div class="queryraisedcontainer-rightcontent">
                        <button id="sort-by" style="cursor:pointer;">
                            <p>Sort by</p> <img src="assets/images/Icons/swap_vert.png" />
                        </button>
                        <div class="sort-by-contents">
                            <a href="" data-sort="newest">Newest</a>
                            <a href="" data-sort="oldest">Oldest</a>
                            <a href="" data-sort="alphabet">A-Z</a>
                            <a href="" data-sort="alphabet-reverse">Z-A</a>
                        </div>
                        <button id="raised-query" style="cursor:pointer;">Raise Query</button>
                    </div>
                </div>
                <div class="groupofraisedquestion-scdashboard">
                    <p>Loading queries...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const triggerTextBox = document.getElementById("trigger-profile-photo-sc");
            const triggeredFileThroughText = document.getElementById("sc-profile-photo-upload");
            const sortOptions = document.querySelectorAll('#counsellor-dashboard-sort-options .dashboard-sort-option');
            const counsellorList = document.getElementById('counsellor-list');

            const contactInput = document.getElementById("studentcounsellor-requiredfields-admin-contact");
            if (contactInput) {
                contactInput.style.padding = "10px";
                contactInput.style.height = "34px";
                contactInput.style.lineHeight = "14px";
                contactInput.style.fontSize = "14px";
                contactInput.style.boxSizing = "border-box";
            }

            getScUsers();

            const triggerStudentAdd = document.getElementById("generate-referral-councellor-admin");
            const triggerCancelAdd = document.getElementById("delete-councellor-admin");

            if (triggerCancelAdd) {
                triggerCancelAdd.addEventListener("click", () => {
                    clearfields();
                    if (triggerTextBox) {
                        triggerTextBox.value = "Upload Profile Image";
                    }
                    if (triggeredFileThroughText) {
                        triggeredFileThroughText.value = "";
                    }
                    validateInput("profilePhoto");
                });
            }

            customizeDatePicker();

            if (triggerStudentAdd) {
                triggerStudentAdd.addEventListener("click", () => {
                    if (triggeredFileThroughText.files.length > 0) {
                        console.log("File to upload:", triggeredFileThroughText.files[0].name);
                    } else {
                        console.log("No file selected for upload.");
                    }
                 });
            }

            if (triggerTextBox && triggeredFileThroughText) {
                triggerTextBox.addEventListener("click", () => {
                    console.log("Trigger text box clicked, opening file input...");
                    triggeredFileThroughText.click();
                });

                triggeredFileThroughText.addEventListener("change", (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        triggerTextBox.value = file.name;
                        console.log("File selected:", file.name, "Size:", file.size, "Type:", file.type);
                        validateInput("profilePhoto");
                    } else {
                        triggerTextBox.value = "Upload Profile Image";
                        console.log("No file selected.");
                        validateInput("profilePhoto");
                    }
                });
            } else {
                console.error("Trigger elements not found:", triggerTextBox, triggeredFileThroughText);
            }

            const searchInput = document.getElementById("counsellor-search-student-list");
            if (searchInput) {
                searchInput.addEventListener("input", function () {
                    const searchQuery = this.value.toLowerCase();
                    const counsellorItems = document.querySelectorAll("#counsellor-list .individualcounsellorlists-items");

                    counsellorItems.forEach(item => {
                        const counsellorName = item.querySelector('#student-counsellor-name-id').textContent.toLowerCase();
                        item.style.display = counsellorName.includes(searchQuery) ? 'flex' : 'none';
                    });
                });
            }

            sortOptions.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortType = option.getAttribute('data-sort');
                    const items = Array.from(counsellorList.querySelectorAll('.individualcounsellorlists-items'));

                    items.sort((a, b) => {
                        const nameA = a.querySelector('#student-counsellor-name-id').textContent.trim().toLowerCase();
                        const nameB = b.querySelector('#student-counsellor-name-id').textContent.trim().toLowerCase();
                        const dateA = new Date(a.dataset.added);
                        const dateB = new Date(b.dataset.added);

                        if (sortType === 'alphabet') {
                            return nameA.localeCompare(nameB);
                        } else if (sortType === 'alphabet-reverse') {
                            return nameB.localeCompare(nameA);
                        } else if (sortType === 'newest') {
                            return dateB - dateA;
                        } else if (sortType === 'oldest') {
                            return dateA - dateB;
                        }
                        return 0;
                    });

                    counsellorList.innerHTML = `
                <div class="individualcounsellorlists-header">
                    <p id="counsellor-name-identify">Student Counsellor Name</p>
                    <p id="counsellor-referralid-identify">Referral Number</p>
                </div>
            `;
                    items.forEach(item => counsellorList.appendChild(item));

                    const sortOptionsContainer = document.getElementById('counsellor-dashboard-sort-options');
                    sortOptionsContainer.style.display = 'none';
                });
            });

            function adjustLayout() {
                const width = window.innerWidth;
                const headerSection = document.querySelector('.globallistcontainer-header');
                const addButton = document.querySelector('.studentlist-add-button');

                if (width <= 768) {
                    if (headerSection) {
                        headerSection.style.flexDirection = 'column';
                        headerSection.style.alignItems = 'center';
                    }
                    if (addButton) {
                        addButton.style.width = '100%';
                        addButton.style.marginTop = '10px';
                    }
                } else {
                    if (headerSection) {
                        headerSection.style.flexDirection = 'row';
                        headerSection.style.alignItems = 'flex-start';
                    }
                    if (addButton) {
                        addButton.style.width = 'auto';
                        addButton.style.marginTop = '0';
                    }
                }
            }

            adjustLayout();
            window.addEventListener('resize', adjustLayout);
        });

        // Toggle sort options for counsellor list
        function toggleCounsellorSortOptions() {
            const sortOptions = document.getElementById('counsellor-dashboard-sort-options');
            sortOptions.style.display = sortOptions.style.display === 'block' ? 'none' : 'block';
        }

        function getScUsers() {
            const modelScProfile = document.getElementById("scdashboard-profile-adminside");
            const studentCounsellorList = document.querySelector(".studentcounsellorlist-adminside");
            const profileTextContent = document.querySelector("#scdashboard-profile-adminside .performancecontainer-firstrow h3");
            const insideSuspendTrigger = document.querySelector("#scdashboard-profile-adminside .performancecontainer-firstrow .edit-scuser");

            if (profileTextContent) {
                profileTextContent.textContent = "Profile";
            }
            if (insideSuspendTrigger) {
                insideSuspendTrigger.textContent = "Suspend";
                insideSuspendTrigger.style.color = "rgba(111, 37, 206, 1)";
                insideSuspendTrigger.style.padding = "9px 22px";
                insideSuspendTrigger.style.width = "106px";
                insideSuspendTrigger.style.height = "35px";
            }

            fetch('/getallscuser', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        updateCounsellorList(data.receivedData, modelScProfile, studentCounsellorList);
                    } else {
                        console.error(data.error);
                    }
                })
                .catch((error) => {
                    console.error("Fetch error: ", error);
                });
        }
        const customizeDatePicker = () => {
            flatpickr("#studentcounsellor-requiredfields-admin-startdate", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "Y-m-d",
                defaultDate: null,
                minDate: "1900-01-01",
                maxDate: "today",
                enableTime: false,
                onReady: (selectedDates, dateStr) => { },
                onChange: (selectedDates, dateStr) => { }
            });

            flatpickr("#dob-input", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "Y-m-d",
                defaultDate: null,
                minDate: "1900-01-01",
                maxDate: "today",
                enableTime: false,
                onReady: (selectedDates, dateStr) => { },
                onChange: (selectedDates, dateStr) => { }
            });
        };
        const addStudentCounsellor = () => {
            const scUserName = document.getElementById("studentcounsellor-requiredfields-admin-scname").value;
            const scDob = document.getElementById("studentcounsellor-requiredfields-admin-startdate").value;
            const scEmail = document.getElementById("studentcounsellor-requiredfields-admin-email").value;
            const scContact = document.getElementById("studentcounsellor-requiredfields-admin-contact").value;
            const scAddress = document.getElementById("student-counsellor-admin-address").value;
            const profilePhoto = document.getElementById("sc-profile-photo-upload");

            if (!scUserName) return alert('Please enter the Student Counsellor name.');
            if (!scDob) return alert('Please enter the date of birth.');
            if (!scEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(scEmail)) return alert('Please enter a valid email address.');
            if (!scContact || !/^[0-9]{10}$/.test(scContact)) return alert('Please enter a valid 10-digit contact number.');
            if (!scAddress) return alert('Please enter the address.');

            const formData = new FormData();
            formData.append('scUserName', scUserName);
            formData.append('scDob', scDob);
            formData.append('scEmail', scEmail);
            formData.append('scContact', scContact);
            formData.append('scAddress', scAddress);

            // Only append the profile photo if a file is selected
            if (profilePhoto.files && profilePhoto.files.length > 0) {
                formData.append('profilePhoto', profilePhoto.files[0]);
            }

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
                        clearfields();
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

        function dynamicTriggerModel(viewButton, editButton, suspendButton, counsellor, modelScProfile, studentCounsellorList) {
            let editmode = false;

            async function renderProfile() {
                if (modelScProfile && studentCounsellorList) {
                    modelScProfile.style.display = "flex";
                    studentCounsellorList.style.display = "none";
                    await queryDetails(counsellor.referral_code);

                    if (editmode) {
                        modelScProfile.querySelector(".scmember_personal_info_name input").value = counsellor.full_name || '';
                        modelScProfile.querySelector(".scmember_personal_info_phone input").value = counsellor.phone || '';
                        modelScProfile.querySelector(".scmember_personal_info_email input").value = counsellor.email || '';
                        modelScProfile.querySelector(".scmember_personal_info_state-edit input").value = counsellor.address || '';
                        modelScProfile.querySelector("#scaddress-address").value = counsellor.address || '';
                        modelScProfile.querySelector("#scaddress-city").value = counsellor.city || '';
                        modelScProfile.querySelector("#scaddress-state").value = counsellor.state || '';
                        modelScProfile.querySelector("#scaddress-pincode").value = counsellor.pincode || '';
                        modelScProfile.querySelector("#dob-input").value = counsellor.dob || '';

                        modelScProfile.querySelector(".scmember_personalinfo_editmode").style.display = "block";
                        modelScProfile.querySelector(".scmember_personalinfo").style.display = "none";
                        modelScProfile.querySelector("#screferral-dob-fromprofile-editmode").style.display = "flex";
                        modelScProfile.querySelector("#screferral-dob-fromprofile").style.display = "none";
                    } else {
                        modelScProfile.querySelector("#screferral-id-fromprofile span").textContent = counsellor.referral_code || '';
                        modelScProfile.querySelector(".scmember_personal_info_name p").textContent = counsellor.full_name || '';
                        modelScProfile.querySelector("#screferral-dob-fromprofile p").textContent = counsellor.dob || '';
                        modelScProfile.querySelector(".scmember_personal_info_email p").textContent = counsellor.email || '';
                        modelScProfile.querySelector(".scmember_personal_info_phone p").textContent = counsellor.phone || '';
                        modelScProfile.querySelector(".scmember_personal_info_state p").textContent = counsellor.address || '';

                        modelScProfile.querySelector(".scmember_personalinfo_editmode").style.display = "none";
                        modelScProfile.querySelector(".scmember_personalinfo").style.display = "block";
                        modelScProfile.querySelector("#screferral-dob-fromprofile-editmode").style.display = "none";
                        modelScProfile.querySelector("#screferral-dob-fromprofile").style.display = "flex";
                    }
                }
            }

            function eliminateScUser() {
                const scReferral = counsellor.referral_code;
                if (!scReferral) {
                    alert("Referral code is missing.");
                    return;
                }

                fetch("/suspendscuser", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({ referralCode: scReferral })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Counsellor suspended successfully.");
                            getScUsers();
                        } else {
                            alert("Failed to suspend counsellor: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error suspending counsellor:", error);
                    });
            }

            viewButton.addEventListener('click', () => {
                editmode = false;
                renderProfile();
            });

            editButton.addEventListener('click', () => {
                editmode = true;
                renderProfile();
            });

            suspendButton.addEventListener('click', () => {
                eliminateScUser();
            });

            const saveScUserAdmin = document.querySelector("#scdashboard-profile-adminside .save-scuser");
            if (saveScUserAdmin && !saveScUserAdmin.classList.contains("listener-attached")) {
                saveScUserAdmin.addEventListener('click', () => {
                    const updatedName = modelScProfile.querySelector(".scmember_personal_info_name input").value;
                    const updatedPhone = modelScProfile.querySelector(".scmember_personal_info_phone input").value;
                    const updatedDob = modelScProfile.querySelector("#dob-input").value;

                    const updatedStreet = modelScProfile.querySelector("#scaddress-address").value;
                    const updatedCity = modelScProfile.querySelector("#scaddress-city").value;
                    const updatedState = modelScProfile.querySelector("#scaddress-state").value;
                    const updatedPincode = modelScProfile.querySelector("#scaddress-pincode").value;

                    const updatedData = {
                        scRefNo: counsellor.referral_code || '',
                        updatedScName: updatedName,
                        updatedScDob: updatedDob,
                        updatedScPhone: updatedPhone,
                        street: updatedStreet,
                        district: updatedCity,
                        state: updatedState,
                        pincode: updatedPincode
                    };

                    fetch("/updatescuserdetails", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(updatedData)
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                getScUsers();
                                alert("All Details Updated for the respective student counsellor");

                                counsellor.full_name = updatedName;
                                counsellor.phone = updatedPhone;
                                counsellor.dob = updatedDob;
                                counsellor.address = updatedStreet;
                                counsellor.city = updatedCity;
                                counsellor.state = updatedState;
                                counsellor.pincode = updatedPincode;

                                editmode = false;
                                renderProfile();
                            } else {
                                console.error("Update failed: " + data.error);
                            }
                        })
                        .catch((error) => {
                            console.error("Error posting data: ", error);
                        });
                });
                saveScUserAdmin.classList.add("listener-attached");
            }
        }

        function clearfields() {
            document.getElementById("studentcounsellor-requiredfields-admin-scname").value = '';
            document.getElementById("studentcounsellor-requiredfields-admin-startdate").value = '';
            document.getElementById("studentcounsellor-requiredfields-admin-email").value = '';
            document.getElementById("studentcounsellor-requiredfields-admin-contact").value = '';
            document.getElementById("student-counsellor-admin-address").value = '';
            document.getElementById("sc-profile-photo-upload").value = '';
        }

        const updateCounsellorList = (counsellorList, modelScProfile, studentCounsellorList) => {
            const counsellorContainer = document.getElementById('counsellor-list');
            if (!counsellorContainer) {
                console.error("counsellor-list container not found");
                return;
            }

            counsellorContainer.innerHTML = `
            <div class="individualcounsellorlists-header">
                <p id="counsellor-name-identify">Student Counsellor Name</p>
                <p id="counsellor-referralid-identify">Referral Number</p>
            </div>
        `;

            counsellorList.forEach(counsellor => {
                const counsellorItem = document.createElement('div');
                counsellorItem.className = 'individualcounsellorlists-items';
                counsellorItem.setAttribute('data-added', counsellor.created_at || '');

                const counsellorContent = document.createElement('div');
                counsellorContent.className = 'individualcounsellorlists-content';

                const counsellorName = document.createElement('p');
                counsellorName.id = 'student-counsellor-name-id';
                counsellorName.textContent = counsellor.full_name || 'No Name';

                const counsellorReferral = document.createElement('p');
                counsellorReferral.textContent = counsellor.referral_code || 'No Referral Code';

                counsellorContent.appendChild(counsellorName);
                counsellorContent.appendChild(counsellorReferral);
                counsellorItem.appendChild(counsellorContent);

                const buttonContainer = document.createElement('div');
                buttonContainer.className = 'individualcounsellors-buttoncontainer';

                const viewButton = document.createElement('button');
                viewButton.innerHTML = '<img src="/assets/images/Icons/visibility.png" alt="View">';
                viewButton.classList.add('view_sc_profile');

                const editButton = document.createElement('button');
                editButton.innerHTML = '<img src="/assets/images/Icons/edit_purple.png" alt="Edit">';

                const suspendButton = document.createElement('button');
                suspendButton.textContent = 'Suspend';

                buttonContainer.appendChild(viewButton);
                buttonContainer.appendChild(editButton);
                buttonContainer.appendChild(suspendButton);

                dynamicTriggerModel(viewButton, editButton, suspendButton, counsellor, modelScProfile, studentCounsellorList);

                counsellorItem.appendChild(buttonContainer);
                counsellorContainer.appendChild(counsellorItem);
            });
        };

        const queryDetails = (scuserid) => {
            if (scuserid) {
                fetch(`/get-queries?scUserId=${scuserid}`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then((response) => response.json())
                    .then((data) => {
                        const container = document.querySelector("#scdashboard-profile-adminside .scdashboard-queryraisedcontainer .groupofraisedquestion-scdashboard");
                        container.innerHTML = '';

                        if (data.success && data.queries.length > 0) {
                            const sortedQueries = data.queries.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                            sortedQueries.forEach((item) => {
                                const div = document.createElement('div');
                                div.classList.add('individual-raisedquestions');
                                div.setAttribute('data-added', item.created_at);

                                div.innerHTML = `
                                <p id="queries-row">${item.queryraised}</p>
                                <p id="query-raisedbyrow">${item.querytype}</p>
                            `;

                                container.appendChild(div);
                            });
                            getStatusGroups();
                        } else {
                            container.innerHTML = '<p>No queries found.</p>';
                        }
                    })
                    .catch((error) => {
                        console.error("Request failed:", error);
                    });
            }
        };

        function getStatusGroups() {
            console.log("getStatusGroups called, but not implemented.");
        }

        const validationConfig = {
            scname: {
                element: document.getElementById("studentcounsellor-requiredfields-admin-scname"),
                errorElement: document.getElementById("scname-error"),
                validate: (value) => {
                    if (!value) return "Name is required.";
                    if (value.length < 2 || value.length > 50) return "Name must be 2-50 characters.";
                    if (!/^[a-zA-Z\s]+$/.test(value)) return "Name can only contain letters and spaces.";
                    return "";
                }
            },
            startdate: {
                element: document.getElementById("studentcounsellor-requiredfields-admin-startdate"),
                errorElement: document.getElementById("startdate-error"),
                validate: (value) => {
                    if (!value) return "Starting date is required.";
                    const date = new Date(value);
                    const today = new Date();
                    if (isNaN(date.getTime())) return "Invalid date format.";
                    if (date > today) return "Date cannot be in the future.";
                    if (date < new Date("1900-01-01")) return "Date is too old.";
                    return "";
                }
            },
            email: {
                element: document.getElementById("studentcounsellor-requiredfields-admin-email"),
                errorElement: document.getElementById("email-error"),
                validate: (value) => {
                    if (!value) return "Email is required.";
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) return "Invalid email format.";
                    return "";
                }
            },
            contact: {
                element: document.getElementById("studentcounsellor-requiredfields-admin-contact"),
                errorElement: document.getElementById("contact-error"),
                validate: (value) => {
                    if (!value) return "Contact number is required.";
                    if (!/^[0-9]{10}$/.test(value) || value.length !== 10) {
                        return "Must be exactly 10 digits.";
                    }
                    return "";
                }
            },
            address: {
                element: document.getElementById("student-counsellor-admin-address"),
                errorElement: document.getElementById("address-error"),
                validate: (value) => {
                    if (!value) return "Address is required.";
                    if (value.length < 5 || value.length > 200) return "Address must be 5-200 characters.";
                    return "";
                }
            },
            profilePhoto: {
                element: document.getElementById("sc-profile-photo-upload"),
                errorElement: document.getElementById("profile-photo-error"),
                validate: (files) => {
                    if (!files || files.length === 0) return "";

                    const file = files[0];
                    const validTypes = ["image/jpeg", "image/png", "image/gif"];
                    if (!validTypes.includes(file.type)) return "Only JPEG, PNG, or GIF allowed.";
                    if (file.size > 5 * 1024 * 1024) return "Image must be less than 5MB.";
                    return "";
                }
            }

        };

        const validateInput = (field) => {
            const value = field === "profilePhoto" ? validationConfig[field].element.files : validationConfig[field].element.value;
            const error = validationConfig[field].validate(value);
            validationConfig[field].errorElement.textContent = error;
            validationConfig[field].errorElement.style.display = error ? "block" : "none";
            validationConfig[field].element.classList.toggle("input-error", !!error);
            return !error;
        };

        const validateAllInputs = () => {
            let isValid = true;
            Object.keys(validationConfig).forEach((field) => {
                if (!validateInput(field)) isValid = false;
            });
            return isValid;
        };

        Object.keys(validationConfig).forEach((field) => {
            if (field !== "profilePhoto") {
                validationConfig[field].element.addEventListener("input", () => validateInput(field));
            } else {
                validationConfig[field].element.addEventListener("change", () => validateInput(field));
            }
        });

        const contactInput = document.getElementById("studentcounsellor-requiredfields-admin-contact");
        if (contactInput) {
            contactInput.addEventListener("input", (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, "");
                if (e.target.value.length > 10) {
                    e.target.value = e.target.value.slice(0, 10);
                }
                validateInput("contact");
            });
        }

        const addButton = document.getElementById("generate-referral-councellor-admin");
        if (addButton) {
            const originalHandler = addButton.onclick || addStudentCounsellor;

            addButton.onclick = (e) => {
                e.preventDefault();
                if (validateAllInputs()) {
                    originalHandler(); 
                } else {
                    alert("Please correct the errors in the form.");
                }
            };
        }

    </script>
</body>

</html>