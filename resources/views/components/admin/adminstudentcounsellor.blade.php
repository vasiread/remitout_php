<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/adminsidebar.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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

    ],


]


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
            @foreach ($studentCounsellorsLists as $studentCounsellor)

                <div class="individualcounsellorlists-items" data-added="{{ $studentCounsellor['date_added'] }}">

                    <div class="individualcounsellorlists-content">

                        <p id="student-counsellor-name-id">{{$studentCounsellor['counsellor_name']}}</p>
                        <p>{{$studentCounsellor['counsellor_referral_id']}}</p>
                    </div>

                    <div class="individualcounsellors-buttoncontainer">
                        <button> <img src="{{asset("assets/images/Icons/visibility.png")}}"> </button>
                        <button> <img src="{{asset("assets/images/Icons/edit_purple.png")}}"></button>
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


            document.getElementById("generate-referral-councellor-admin").addEventListener('click', () => {
                addStudentCounsellor()

            })



            // const datePickerForStartDate =customizeDatePicker();

            // console.log(datePickerForStartDate)





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




            if (triggerTextBox && triggeredFileThroughText) {
                triggerTextBox.addEventListener("click", () => {
                    triggeredFileThroughText.click();
                });
            }

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

    // Basic form validation to ensure fields are not empty
    if (!scUserName || !scDob || !scEmail || !scContact || !scAddress) {
        alert('Please fill all the fields.');
        return;  // stop the function if any field is empty
    }

    console.log(scUserName, scDob, scEmail, scContact, scAddress);

    const studentCounsellorInfos = {
        scUserName,
        scDob,
        scEmail,
        scContact,
        scAddress
    };

    fetch('/register-studentcounsellor', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(studentCounsellorInfos)
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert('Student Counsellor Registered Successfully');
                console.log(data);
                // Optionally clear form fields after success
                document.getElementById("studentcounsellor-requiredfields-admin-scname").value = '';
                document.getElementById("studentcounsellor-requiredfields-admin-startdate").value = '';
                    document.getElementById("studentcounsellor-requiredfields-admin-email").value = '';
                    document.getElementById("studentcounsellor-requiredfields-admin-contact").value = '';
                    document.getElementById("student-counsellor-admin-address").value = '';
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



    </script>

</body>

</html>