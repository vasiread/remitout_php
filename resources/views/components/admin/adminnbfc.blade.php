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
            <h2>NBFCs List</h2>
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

        <div class="individualnbfc-admin" id="nbfc-list">
            <!-- <div class="individualnbfclists-header">
                <p id="nbfc-name-identify">Student Counsellor name</p>
                <p id="nbfc-referralid-identify">Referral Number</p>
            </div> -->
            @foreach ($nbfcLists as $nbfcListsItems)


                <div class="individualnbfclists-items" data-added="{{ $nbfcListsItems['date_added'] }}">
                    <div class="individualnbfclists-content">
                        <p id="nbfc-name-id">{{$nbfcListsItems['nbfc_name']}}</p>
                        <p>{{$nbfcListsItems['nbfc_type']}}</p>
                    </div>

                    <div class="individualnbfcs-buttoncontainer">
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

            const dropdownButton = document.querySelector('#studentlistcontainer-filters .dropdown-button-filters');
            const dropdownContent = document.querySelector('#studentlistcontainer-filters .dropdown-content-filters');
            const changeButtonInsideImg = document.querySelector('.individualnbfcs-buttoncontainer button:nth-child(2)');

            // Search functionality
            document.querySelector("#nbfclistcontainer-headersection .searchcontainer-rightsidecontent input").addEventListener("input", function () {
                const searchQueryNBFC = this.value.toLowerCase();
                const nbfcListOfNames = document.querySelectorAll("#nbfc-list .individualnbfclists-items");

                nbfcListOfNames.forEach(item => {
                    const nbfcName = item.querySelector('p').textContent.toLowerCase();
                    if (nbfcName.includes(searchQueryNBFC)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });



            const sortLinks = document.querySelectorAll('#nbfclistcontainer-headersection .dropdown-content-filters a');
            const counsellorList = document.getElementById('nbfc-list');

            // Dropdown toggle
            dropdownButton.addEventListener('click', function () {
                dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
            });

            // Resize event listener
            window.addEventListener('resize', function () {
                dynamicChangesThroughWindow(); // Call this on window resize
            });

            // Initial call to apply changes on page load
            dynamicChangesThroughWindow();

            // Sort functionality
            sortLinks.forEach(items => {
                items.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sortType = this.getAttribute('data-sort');
                    const items = Array.from(counsellorList.querySelectorAll('#nbfc-list .individualnbfclists-items'));

                    // Sorting logic
                    if (sortType === 'newest') {
                        items.sort((a, b) => new Date(b.dataset.added) - new Date(a.dataset.added));
                    } else if (sortType === 'oldest') {
                        items.sort((a, b) => new Date(a.dataset.added) - new Date(b.dataset.added));
                    } else if (sortType === 'alphabet') {
                        items.sort((a, b) => a.textContent.trim().localeCompare(b.textContent.trim()));
                    } else if (sortType === 'alphabet-reverse') {
                        items.sort((a, b) => b.textContent.trim().localeCompare(a.textContent.trim()));
                    }

                    // Append sorted items back to the list
                    items.forEach(item => counsellorList.appendChild(item));
                });
            });
        });

        function dynamicChangesThroughWindow() {
            if (window.innerWidth > 768) {
                document.querySelector('.studentlist-add-button').innerHTML = "+";

                const changeButtonInsideImg = document.querySelector('.studentlist-add-button img');
                if (changeButtonInsideImg) {
                    changeButtonInsideImg.src = 'assets/images/Icons/download-orange.png'; // Change the image source
                }
            } else {
                document.querySelector('.studentlist-add-button').innerHTML = "Add";
            }
        }
    </script>


</body>

</html>