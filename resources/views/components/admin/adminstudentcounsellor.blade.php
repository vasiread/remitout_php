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
        <h1 class="studentcounsellor-header-admin">
            Add Student Counsellor
        </h1>
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




    </script>

</body>

</html>