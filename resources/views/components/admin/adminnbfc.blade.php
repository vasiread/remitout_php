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


    <div class="nbfclist-adminside" style="display:none">
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



            <div class="individualnbfclists-items">
                <div class="individualnbfclists-content">
                    <p id="nbfc-name-id"></p>
                    <p></p>
                </div>

                <div class="individualnbfcs-buttoncontainer">
                    <button> <img src="{{asset("assets/images/Icons/visibility.png")}}"> </button>
                    <button> <img src="{{asset("assets/images/Icons/edit_purple.png")}}"></button>
                    <button>Suspend</button>
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
                    <button id="nbfc-dropdown-trigger">
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


            document.querySelector(".add-nbfc-firstsection #save-all-nbfc").addEventListener('click', () => {

                uploadMultipleNbfcUsers();

            })

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

             dynamicChangesThroughWindow();

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


        document.querySelector("#nbfc-dropdown-trigger").addEventListener('click', (event) => {
            const dropdownContent = document.querySelector(".nbfc-dropdown-content");
            if (dropdownContent.style.display === "none" || dropdownContent.style.display === "") {
                dropdownContent.style.display = "flex";
            } else {
                dropdownContent.style.display = "none";
            }
        });

        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const selectedValue = event.target.getAttribute('data-value');
                console.log('Selected value:', selectedValue);

                const dropdownContent = document.querySelector(".nbfc-dropdown-content");
                dropdownContent.style.display = "none";
                document.querySelector("#nbfc-dropdown-trigger p").textContent = selectedValue;
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
                <button id="nbfc-dropdown-trigger">
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

            // Attach event listener to the delete button in the newly added form
            newForm.querySelector('.delete-nbfc-id').addEventListener('click', () => {
                newForm.remove();
            });

            // Add dropdown toggle functionality to the newly added form
            newForm.querySelector('#nbfc-dropdown-trigger').addEventListener('click', (e) => {
                const dropdownContent = e.target.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'none' ? 'flex' : 'none';
            });

            // Add event listeners for dropdown items in the newly added form
            newForm.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', (event) => {
                    event.preventDefault();
                    const selectedValue = event.target.getAttribute('data-value');
                    newForm.querySelector("#nbfc-dropdown-trigger p").textContent = selectedValue;
                    newForm.querySelector(".nbfc-dropdown-content").style.display = "none";
                });
            });
        });

        window.addEventListener('click', (event) => {
            const dropdown = document.querySelector('.nbfc-type-dropdown');
            if (!dropdown.contains(event.target)) {
                document.querySelector(".nbfc-dropdown-content").style.display = "none";
            }
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
                    if (data.success) {
                        console.log(data.receivedData);

                        const nbfcListContainer = document.getElementById("nbfc-list");

                        // Clear existing content
                        nbfcListContainer.innerHTML = '';

                        // Loop through the received data
                        data.receivedData.forEach((item) => {
                            // Create a new div for each NBFC item
                            const nbfcItemDiv = document.createElement('div');
                            nbfcItemDiv.classList.add('individualnbfclists-items');

                            // Add the NBFC content (name, type, etc.)
                            nbfcItemDiv.innerHTML = `
                    <div class="individualnbfclists-content">
                        <p id="nbfc-name-id">${item.nbfc_name}</p>
                        <p>${item.nbfc_type}</p>
                        </div>
                    <div class="individualnbfcs-buttoncontainer">
                        <button> <img src="{{asset("assets/images/Icons/visibility.png")}}"> </button>
                        <button> <img src="{{asset("assets/images/Icons/edit_purple.png")}}"></button>
                        <button>Suspend</button>
                    </div>
                `;

                            // Append the newly created div to the list container
                            nbfcListContainer.appendChild(nbfcItemDiv);
                        });
                    } else {
                        console.error(data.error);
                    }
                });
        }


        const uploadMultipleNbfcUsers = () => {
            const nbfcBulkUsers = [];

            const allForms = document.querySelectorAll(".formsection-addnbfcuser");

            allForms.forEach(form => {
                const nbfcName = form.querySelector('#nbfc-name-id-required').value;
                const nbfcType = form.querySelector('#nbfc-dropdown-trigger p').textContent;
                const nbfcEmail = form.querySelector('#nbfc-email-id').value;
                const aboutNbfc = form.querySelector('#about-nbfc-id').value;

                const formData = {
                    name: nbfcName,
                    type: nbfcType,
                    email: nbfcEmail,
                    description: aboutNbfc
                };
                nbfcBulkUsers.push(formData);
            });

            console.log(nbfcBulkUsers);

            fetch('/addbulkusers', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(nbfcBulkUsers) // Send the collected data
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log(data.message);
                        alert(data.message);
                    } else if (data.error) {
                        console.error(data.error);
                    }
                })
                .catch((e) => {
                    console.error(e);
                });
        };


    </script>


</body>

</html>