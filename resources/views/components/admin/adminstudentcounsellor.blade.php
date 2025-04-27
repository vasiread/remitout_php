<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/adminsidebar.js') }}"></script>
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
        $studentCounsellorsLists = [

        ];
    @endphp
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
    <div class="studentcounsellorlist-adminside">
        <div class="globallistcontainer-header" id="counsellorlistcontainer-headersection">
            <h2>Student Counsellor List</h2>
            <div class="headersection-rightsidecontent">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container">
                    <input type="text" id="search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="dashboard-sort-button-container">
                    <button class="dashboard-sort-button" onclick="toggleSortOptions()">
                        Sort
                        <img src="assets/images/filter-icon.png" alt="Filter">
                    </button>

                    <div class="dashboard-sort-options" id="dashboardSortOptions">
                        <button class="dashboard-sort-option" data-sort="alphabet">A-Z</button>
                        <button class="dashboard-sort-option" data-sort="alphabet-reverse">Z-A</button>
                        <button class="dashboard-sort-option" data-sort="newest">Newest</button>
                        <button class="dashboard-sort-option" data-sort="oldest">Oldest</button>
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

    <div class="scdashboard-inboxcontent" id="scdashboard-profile-adminside" style="none">
        <div class="scmember-profilecontainer">
            <div class="scmember-profilecontainerimg">
                <img src="{{asset('assets/images/image-women.jpeg')}}" id="studentcounsellor-profile" alt="">
                <i class="fa-regular fa-pen-to-square"></i>
                <input type="file" id="sc-profile-upload-cloud" display="none">
            </div>

            <div class="scmember-rowfirst">
                <h1>Student Counsellor</h1>

            </div>
            <p id="screferral-id-fromprofile">Referral Number: <span> </span>
            </p>
            <div id="screferral-dob-fromprofile" inputmode="Date">
                <i class="fa-solid fa-calendar"></i>
                <p id="dob-display"></p>

            </div>
            <div id="screferral-dob-fromprofile-editmode" style="display: none;">
                <i class="fa-solid fa-calendar"></i>
                <input type="date" id="dob-input">

            </div>
            <ul class="scmember_personalinfo">

                <li class="scmember_personal_info_name" id="referenceNeId"><img src="{{$profileIconPath}}" alt="">
                    <p> </p>
                </li>
                <li class="scmember_personal_info_phone"><img src={{$phoneIconPath}} alt="">
                    <p></p>
                </li>
                <li class="scmember_personal_info_email" style="word-break: break-all;" id="referenceEmailId">
                    <img src="{{$mailIconPath}}" alt="">
                    <p> </p>
                </li>
                <li class="scmember_personal_info_state"><img src="{{$pindropIconPath}}" alt="">
                    <p style="line-height:19px"></p>
                </li>

            </ul>
            <ul class="scmember_personalinfo_editmode">
                <li class="scmember_personal_info_name" id="referenceNeId"><img src="{{$profileIconPath}}" alt="">
                    <input type="text">
                </li>
                <li class="scmember_personal_info_phone"><img src={{$phoneIconPath}} alt="">
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
            const dropdownButton = document.querySelector('.dropdown-button-filters');
            const dropdownContent = document.querySelector('.dropdown-content-filters');
            // const sortLinks = document.querySelectorAll('#counsellorlistcontainer-headersection .dropdown-content-filters a');
            // const counsellorList = document.getElementById('counsellor-list');
            const sortLinks = document.querySelectorAll('.dashboard-sort-option');
            const counsellorList = document.getElementById('your-counsellor-container-id');





            getScUsers();


            dropdownButton.addEventListener('click', () => {
                dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
            });
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
                        items.sort((a, b) => a.querySelector('#student-counsellor-name-id').textContent.trim()
                            .localeCompare(b.querySelector('#student-counsellor-name-id').textContent.trim()));
                    } else if (sortType === 'alphabet-reverse') {
                        items.sort((a, b) => b.querySelector('#student-counsellor-name-id').textContent.trim()
                            .localeCompare(a.querySelector('#student-counsellor-name-id').textContent.trim()));
                    }

                    // Re-append sorted items
                    items.forEach(item => counsellorList.appendChild(item));
                });
            });

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
                insideSuspendTrigger.style.height = "35px"
            }

            console.log(modelScProfile)
            console.log(studentCounsellorList)
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
        };


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

        function dynamicTriggerModel(viewButton, editButton, suspendButton, counsellor, modelScProfile, studentCounsellorList) {
            let editmode = false;
            console.log(counsellor)
            // const saveScUserAdmin = document.querySelector("#scmember-profilecontainer-adminside .scmember-rowfirst .save-scuser");

            async function renderProfile() {
                
                if (modelScProfile && studentCounsellorList) {
                    modelScProfile.style.display = "flex";
                    studentCounsellorList.style.display = "none";
                    await queryDetails(counsellor.referral_code);

                    if (editmode) {
                        // saveScUserAdmin.style.display = "flex";

                        // modelScProfile.querySelector(".scmember_personal_info_name input").value = counsellor.full_name || '';
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
                        // saveScUserAdmin.style.display = "none";

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


            })
            // if (!saveScUserAdmin.classList.contains("listener-attached")) {

            // saveScUserAdmin.addEventListener('click', () => {
            //     const updatedName = modelScProfile.querySelector(".scmember_personal_info_name input").value;
            //     const updatedPhone = modelScProfile.querySelector(".scmember_personal_info_phone input").value;
            //     const updatedDob = modelScProfile.querySelector("#dob-input").value;

            //     const updatedStreet = modelScProfile.querySelector("#scaddress-address").value;
            //     const updatedCity = modelScProfile.querySelector("#scaddress-city").value;
            //     const updatedState = modelScProfile.querySelector("#scaddress-state").value;
            //     const updatedPincode = modelScProfile.querySelector("#scaddress-pincode").value;

            //     // if (!updatedStreet || !updatedCity || !updatedState || !updatedPincode) {
            //     //     alert("Please fill in all the address fields: street, city, state, and pincode.");
            //     //     return;
            //     // }

            //     const updatedData = {
            //         scRefNo: counsellor.referral_code || '',
            //         updatedScName: updatedName,
            //         updatedScDob: updatedDob,
            //         updatedScPhone: updatedPhone,
            //         street: updatedStreet,
            //         district: updatedCity,
            //         state: updatedState,
            //         pincode: updatedPincode
            //     };

            //     fetch("/updatescuserdetails", {
            //         method: "POST",
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //         },
            //         body: JSON.stringify(updatedData)
            //     })
            //         .then((response) => response.json())
            //         .then((data) => {
            //             if (data.success) {
            //                 getScUsers();

            //                 alert("All Details Updated for the respective student counsellor");

            //                 counsellor.full_name = updatedName;
            //                 counsellor.phone = updatedPhone;
            //                 counsellor.dob = updatedDob;
            //                 counsellor.address = updatedStreet;
            //                 counsellor.city = updatedCity;
            //                 counsellor.state = updatedState;
            //                 counsellor.pincode = updatedPincode;

            //                 editmode = false;
            //                 renderProfile();
            //             } else {
            //                 console.error("Update failed: " + data.error);
            //             }
            //         })
            //         .catch((error) => {
            //             console.error("Error posting data: ", error);
            //         });
            // });
            // saveScUserAdmin.classList.add("listener-attached");


            // }
        }


        const updateCounsellorList = (counsellorList, modelScProfile, studentCounsellorList) => {
            const counsellorContainer = document.getElementById('counsellor-list');
            if (!counsellorContainer) {
                console.error("counsellor-list container not found");
                return;
            }

            counsellorContainer.innerHTML = '';

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
                // Append buttons in desired order
                buttonContainer.appendChild(viewButton);   // View
                buttonContainer.appendChild(editButton);   // Edit
                buttonContainer.appendChild(suspendButton); // Suspend

                // Attach behavior after buttons are appended
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
                        container.innerHTML = ''; // Clear existing

                        if (data.success && data.queries.length > 0) {
                            // Sort queries by created_at (newest first)
                            const sortedQueries = data.queries.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                            sortedQueries.forEach((item) => {
                                const div = document.createElement('div');
                                console.log(item);
                                div.classList.add('individual-raisedquestions');
                                div.setAttribute('data-added', item.created_at); // Use created_at here

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



    </script>


</body>

</html>