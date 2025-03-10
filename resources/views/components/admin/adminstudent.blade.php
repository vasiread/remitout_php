<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="{{ asset('js/adminsidebar.js') }}"></script>

<body>
    @extends('layouts.app');

    <div class="student-listcontainer" id="student-admin-section-id">
        <div class="globallistcontainer-header" id="studentlistcontainer-headersection">
            <h2>Student List</h2>
            <h3 id="student-list-count">{{ count($userDetails) }}</h3>

            <div class="headersection-rightsidecontent">
                <div class="searchcontainer-rightsidecontent" id="search-student-list-container">
                    <input type="text" id="search-student-list" placeholder="Search">
                    <i class="fa-solid fa-search"></i>
                </div>

                <div class="dropdown-filters" id="studentlistcontainer-filters">
                    <button class="dropdown-button-filters">
                        <img src="{{ asset('assets/images/Icons/filter_icon.png') }}" alt="">
                        Filters
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content-filters">
                        <a href="#">Option 1</a>
                        <a href="#">Option 2</a>
                        <a href="#">Option 3</a>
                    </div>
                </div>
                <button class="studentlist-add-button">Add</button>
            </div>
        </div>

        <div class="scdashboard-studentapplication" id="studentapplicationfromadminstudent">
            @foreach ($userDetails as $users)
                <div class="studentapplication-lists">
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>{{ $users->name }}</h1>
                            <p id="hidden-id-elementforaccess" style="display:none">{{ $users->unique_id }}</p>
                            <div class="application-buttoncontainer">
                                <button>View</button>
                                <button>Edit</button>
                                <button class="expand-arrow"> <img src="{{ asset('assets/images/stat_minus_1.png') }}"
                                        alt=""></button>
                            </div>
                            <button class="studenteacheditbutton">Edit</button>
                        </div>
                    </div>
                    <ul class="individualstudentapplication-status">
                        <li class="scdashboard-nbfcnamecontainer">
                            <p>NBFC:</p>
                            <p>NBFC name</p>
                        </li>
                        <li class="scdashboard-nbfcstatus-pending">
                            <p>Status:</p>
                            <span>Pending</span>
                        </li>
                        <li class="scdashboard-missingdocumentsstatus">
                            <p>Missing Documents:</p>
                            <span class="missing-document-count">03</span>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initialisedocumentsCount();
        });

        const applicationStatusElements = document.querySelectorAll(".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
        const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

        // Update statuses and show/hide missing documents count
        applicationStatusElements.forEach((items, index) => {
            if (items.textContent.includes("Approved")) {
                items.style.color = "#3FA27E";
                items.style.backgroundColor = "#D2FFEE";

                if (missingDocumentsCount[index]) {
                    missingDocumentsCount[index].style.display = "none";
                }
            } else {
                if (missingDocumentsCount[index]) {
                    missingDocumentsCount[index].style.display = "flex";
                }
            }
        });

        const initialisedocumentsCount = () => {
            const userIdElements = document.querySelectorAll(".firstsection-lists #hidden-id-elementforaccess");
            const missingDocumentCountUpdateforeach = document.querySelectorAll(".scdashboard-missingdocumentsstatus .missing-document-count");

            // Ensure both have the same length to match user IDs with missing document counts
            if (userIdElements.length !== missingDocumentCountUpdateforeach.length) {
                console.error("Mismatch between the number of user IDs and missing document count elements.");
                return;
            }

            userIdElements.forEach((userElement, index) => {
                const userId = userElement.value || userElement.textContent;

                fetch("/count-documents", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ userId })
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("API response for user:", userId, data);

                        // Increment document count
                        let documentsCount = data.documentscount || 0;

                        // Get the corresponding missing document count element
                        const missingCountElement = missingDocumentCountUpdateforeach[index];

                        // Ensure the element exists before trying to modify it
                        if (missingCountElement) {
                            if (documentsCount > 10) {
                                missingCountElement.textContent = "0" + (22 - documentsCount);
                            } else {
                                missingCountElement.textContent = (22 - documentsCount);
                            }
                        } else {
                            console.error('Missing document count element not found for index:', index);
                        }
                    })
                    .catch((error) => {
                        console.error("Error fetching documents count for user:", userId, error);
                    });
            });
        };
    </script>
</body>

</html>