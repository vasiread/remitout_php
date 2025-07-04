<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counsellor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Add CryptoJS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/studentformquestionair.css') }}">
    <style>
        /* Modal Styles */
        .query-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            width: 90%;
            max-width: 500px;
            font-family: 'Poppins', sans-serif;
        }

        .query-modal.active {
            display: block;
        }

        .query-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .query-modal-header h3 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .query-modal-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: #333;
        }

        .query-modal textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .query-modal select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            margin-bottom: 15px;
            background: #fff;
        }

        .query-modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .query-modal-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
        }

        .query-modal-buttons .submit-btn {
            background: #6F25CE;
            color: white;
        }

        .query-modal-buttons .submit-btn:hover {
            background: #5a1ea6;
        }

        .query-modal-buttons .cancel-btn {
            background: #ccc;
            color: #333;
        }

        .query-modal-buttons .cancel-btn:hover {
            background: #b3b3b3;
        }

        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .backdrop.active {
            display: block;
        }

        /* Adjust modal for mobile */
        @media (max-width: 768px) {
            .query-modal {
                width: 95%;
                padding: 15px;
            }

            .query-modal-header h3 {
                font-size: 1.2rem;
            }

            .query-modal textarea,
            .query-modal select {
                font-size: 0.85rem;
            }

            .query-modal-buttons button {
                padding: 6px 12px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('scdashboard')
        @php
            $profileIconPath = 'assets/images/account_circle1.png';
            $phoneIconPath = 'assets/images/call.png';
            $mailIconPath = 'assets/images/mail.png';
            $pindropIconPath = 'assets/images/pin_drop.png';

            $proposalsInfo = [
                [
                    'NBFC' => 'NBFC Name',
                    'ProposalDate' => '20/11/2024',
                    'Status' => 'Approved',
                ],
                [
                    'NBFC' => 'NBFC Name',
                    'ProposalDate' => '20/11/2024',
                    'Status' => 'Pending',
                ],
            ];

            $studentDocumentDetailsInfo = [
                [
                    'student_name' => 'Manish',
                    'DocumentFinalStatus' => 'Missing Documents: 01',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2023-07-01',
                ],
                [
                    'student_name' => 'Kumar',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2022-02-01',
                ],
                [
                    'student_name' => 'Raji',
                    'DocumentFinalStatus' => 'Missing Documents: 12',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2021-12-04',
                ],
                [
                    'student_name' => 'Venkatesh',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2023-02-01',
                ],
                [
                    'student_name' => 'Ramya',
                    'DocumentFinalStatus' => 'Missing Documents: 03',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2021-02-09',
                ],
                [
                    'student_name' => 'Chinna',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2025-07-20',
                ],
                [
                    'student_name' => 'Feroz',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2023-02-21',
                ],
                [
                    'student_name' => 'Ramesh',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2022-07-29',
                ],
                [
                    'student_name' => 'Vasi',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2021-09-30',
                ],
                [
                    'student_name' => 'Aari',
                    'DocumentFinalStatus' => 'Documents: Complete',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2023-10-01',
                ],
                [
                    'student_name' => 'Abinav',
                    'DocumentFinalStatus' => 'Missing Documents: 02',
                    'DocumentFinalDate' => '02/11/2024',
                    'ProposalReceived' => '02',
                    'TotalDuration' => '3 weeks',
                    'proposalDetailInfo' => $proposalsInfo,
                    'date_added' => '2022-07-01',
                ],
            ];

        @endphp

        <div class="scdashboard-parentcontainer">
            <div class="commonsidebar-togglesidebar">
                <ul class="commonsidebar-sidebarlists-top">
                    @foreach ($sidebarItems as $item)
                        <li class="{{ $item['active'] ? 'active' : '' }}">
                            <i class="{{ $item['icon'] }}"></i>
                            <p>{{ $item['name'] }}</p>
                        </li>
                    @endforeach
                </ul>
                <ul class="commonsidebar-sidebarlists-bottom">
                    <li class="logoutBtn" onClick="sessionLogout()">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/Icons/support_agent.png') }}" alt="Sc support icon"> Support
                    </li>
                </ul>
            </div>

            <div class="scdashboard-container">

                <div class="scdashboard-dashboardcontent">
                    <div class="scdashboard-trackprogress">
                        <div class="trackprogress-firstsection">
                            <h1>Track Progress</h1>
                            <button class="referral-Link-trigger-anotherbutton">Generate Referral Link</button>
                            <button id="mobgeneratedreferralcode"> <img src="{{ asset('assets/images/Group icon.png') }}"
                                    alt="Group icon for referral code"> Referral Code:
                                45628</button>
                        </div>
                        <div class="trackprogress-secondsection">
                            <div class="trackprogress-month">
                                <h1>October</h1>
                                <p>month</p>
                            </div>
                            <div class="trackprogress-noofstudent">
                                <h1>07</h1>
                                <p>no. of students</p>
                            </div>
                            <div class="trackprogress-amount">
                                <h1>50,000</h1>
                                <p>amount in rs.</p>
                            </div>
                            <div class="trackprogress-totalamount">
                                <h1>1,00,000</h1>
                                <p>total amount</p>
                            </div>

                        </div>
                        <div class="trackprogress-thirdsection">
                            <button id="pcviewgeneratedreferralcode"> <img src="{{ asset('assets/images/Group icon.png') }}"
                                    alt="Referral group icon"> Referral Code:
                                45628</button>
                            <button style="display:none"> <img src="{{ asset('assets/images/dbicon.png') }}"
                                    alt="">Track
                                Commission</button>
                            <button id="mobgeneratedbutton" class="referral-Link-trigger-button">Generate Referral
                                Link</button>
                        </div>
                    </div>

                    <div class="scdashboard-studentapplication" id="studentapplicationfromstudentdashboard">
                        <div class="studentapplication-header">
                            <h1>Applications</h1>
                            <div class="application-buttoncontainer">
                                <button class="see-all">See all</button>
                                <button class="start-new"></button>
                            </div>
                            <div class="studentadditbutton">
                                <button class="start-new">+</button>
                            </div>
                        </div>
                        <div id="user-list">
                        </div>
                    </div>
                </div>
            </div>
            <div class="scdashboard-inboxcontent">
                <div class="scmember-profilecontainer">
                    <div class="scmember-profilecontainerimg">
                        <img src="{{ asset('assets/images/image-women.jpeg') }}" id="studentcounsellor-profile"
                            alt="">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <input type="file" id="sc-profile-upload-cloud" display="none">
                    </div>

                    <div class="scmember-rowfirst">
                        <h1>Student Counsellor</h1>

                    </div>
                    <p id="screferral-id-fromprofile">Referral Number: <span>{{ session('scuser')->referral_code }}</span>
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

                        <li class="scmember_personal_info_name" id="referenceNeId"><img src="{{ $profileIconPath }}"
                                alt="">
                            <p> </p>
                        </li>
                        <li class="scmember_personal_info_phone"><img src={{ $phoneIconPath }} alt="">
                            <p></p>
                        </li>
                        <li class="scmember_personal_info_email" style="word-break: break-all;" id="referenceEmailId">
                            <img src="{{ $mailIconPath }}" alt="">
                            <p>{{ session('scuser')->email }}</p>
                        </li>
                        <li class="scmember_personal_info_state"><img src="{{ $pindropIconPath }}" alt="">
                            <p style="line-height:19px"></p>
                        </li>

                    </ul>
                    <ul class="scmember_personalinfo_editmode">
                        <li class="scmember_personal_info_name" id="referenceNeId"><img src="{{ $profileIconPath }}"
                                alt="">
                            <input type="text">
                        </li>
                        <li class="scmember_personal_info_phone"><img src={{ $phoneIconPath }} alt="">
                            <input type="text">
                        </li>
                        <li class="scmember_personal_info_email" id="referenceEmailId">
                            <img src="{{ $mailIconPath }}" alt="">
                            <input type="text" disabled>
                        </li>
                        <li class="scmember_personal_info_state-edit">

                            <div class="scmember-personal_address_header">
                                <img src="{{ $pindropIconPath }}" alt="">
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
                                    <p>Sort by</p> <img src="assets/images/Icons/swap_vert.png" alt="SC sort by icon" />
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

                        <div id="viewmore-queries">
                            <p>view more</p> <img src="{{ asset('assets/images/Icons/stat_minus_1.png') }}"
                                style="margin-top: 9px;
                                                                                                margin-left: 8px;
                                                                                                width: 12px;
                                                                                                height: 7px;"
                                alt="">
                        </div>


                    </div>



                </div>

            </div>
            <div class="scdashboard-applicationstatus">
                <div class="scapplicationstatus-firstrow">
                    <h1>Applications</h1>
                    <div class="firstrowapplication-rightsidecontent">
                        <button id="applicationstatus-sortby">Sort by <img src="assets/images/Icons/swap_vert.png"
                                alt="Sort options icon" />
                        </button>
                        <div class="sort-by-contents-applications-studentnames">
                            <a href="" data-sort="newest" style="display: none;">Newest</a>
                            <a href="" data-sort="oldest" style="display:none">Oldest</a>
                            <a href="" data-sort="alphabet">A-Z</a>
                            <a href="" data-sort="alphabet-reverse">Z-A</a>
                        </div>
                        <button id="mobwidthdownloadbutton">
                            <img src="{{ asset('assets/images/Icons/download-orange.png') }}" alt="">
                        </button>
                        <button id="sc-new-application-generate">Start New Application</button>
                    </div>
                </div>


                <div id="student-applicationdetailsstatus">

                </div>
                <div class="pagination-download-groups">
                    <div id="pagination-container-statusgroups"></div>
                    <button id="download-statusgroups-reports">Download report</button>

                </div>





            </div>
        </div>

        <div class="sc-new-registration-overlay"></div>
        <div class="studentAddBySCuserPopup">
            <div class="studentAddByScuserPopup-headerpart">
                <h3>Register Students</h3>
                <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="close popup icon">
            </div>
            <div class="studentAddByScuserPopup-content-container">
                <div class="studentAddByScuserPopup-contentpart">
                    <input type="text" placeholder="Name of the Student">
                    <input type="text" placeholder="bankemail@gmail.com">
                    <input type="text" placeholder="phone">
                    <input type="text" placeholder="password">
                    <button id="delete-student-row" style="cursor:pointer">Delete</button>
                </div>
            </div>
            <button id="dynamic-add-student-button" style="cursor:pointer">Add Student</button>
            <form id="excel-form" enctype="multipart/form-data">
                @csrf
                <div class="studentAddByScuserPopup-footerpart">
                    <!-- Excel Upload Button -->
                    <button id="excel-upload-trigger" type="button" style="cursor:pointer">
                        Upload xlsx <img src="{{ asset('assets/images/Icons/upload.png') }}" />
                    </button>
                    <button type="button" class="add-student-btn" style="cursor:pointer">Add Student</button>
                    <button type="button" id="save-multiple-students-bysc" style="cursor:pointer">Save Student
                        details</button>
                </div>

                <input type="file" id="excel-sheet-student-update" name="excel_file" accept=".xls,.xlsx"
                    style="display:none">

                <div id="file-upload-info" style="display:none">
                    <!-- Display the Selected File Name with Remove Button -->
                    <div id="file-container" style="display: flex; align-items: center; gap: 10px; position:relative;">
                        <input id="selected-file-name" readonly style="border: 1px solid #ccc; padding: 5px;" />
                        <button id="remove-excel-btn" type="button" style="cursor:pointer;">X</button>
                    </div>
                    <!-- Save Excel File Button -->
                    <button id="save-excelfile-btn" type="button" style="cursor:pointer;">
                        Save Excel File
                    </button>
                </div>
            </form>
        </div>

        <div class="sc-dashboard-generate-overlay"></div>
        <div class="referral-triggered-view" style="display:none">
            <div class="referral-triggered-view-headersection">
                <h3>Generate Referral Link</h3>
                <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="Close referral popup icon">

            </div>
            <div class="referral-triggered-view-content">
                <input type="input" placeholder="Copy Link here">
            </div>
            <div class="referral-triggered-view-footer">
                <button id="cancel-referral-link"> <img src="{{ asset('assets/images/Icons/close_icon.png') }}"
                        alt="Referral Cancel icon" />
                    Cancel</button>
                <button>Generate</button>
            </div>

        </div>
        <!-- Add Raise Query Popup -->
        <div class="sc-query-raised-overlay"></div>
        <div class="raise-query-popup" style="display:none">
            <div class="raise-query-popup-headersection">
                <h3>Raise a Query</h3>
                <button class="close-query-btn">
                    <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="Close raise query popup">
                </button>
            </div>
            <div class="raise-query-popup-content">
                <textarea id="query-text" placeholder="Enter your query here..." rows="4"></textarea>
                <select id="query-type">
                    <option value="student">Student</option>
                    <option value="nbfc">NBFC</option>
                </select>
            </div>
            <div class="raise-query-popup-footer">
                <button class="cancel-query "> <img src="{{ asset('assets/images/Icons/close_icon.png') }}"
                        alt="Dismiss action icon" />
                    Cancel</button>
                <button class="submit-query">Submit</button>
            </div>
        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if scuser session exists
            // const scuser = @json(session('scuser'));
            // if (!scuser) {
            //     window.location.href = "{{ route('login') }}"; // Redirect to login if no session
            //     return; // Stop further execution
            // }

            initializescsidebar();
            initializePopuAddingstudents();
            generateReferLinkPopup();
            addDynamicInputFields();
            passwordForgotSc();

            initializeSortByFunctionQueries();
            initializeSortByFunctionApplicationStatus();
            initializeProfileUploadScuser();
            initializeProfileViewScuser();
            initializeScUserOneView();
            getUsersByCounsellor();
            triggerExcelRegistration();
            queryDetails();
            initializeRaiseQuery();
            updateStartNewText();
            triggerDownloadTrigger();
            initializeQueryModal();
           
              setInterval(alertDeactiveCountFromReferral, 3000);



                      


document.querySelector(".unread-notify-container")?.addEventListener("click", () => {
    const sidebarItems = document.querySelectorAll(".commonsidebar-sidebarlists-top li");
    if (sidebarItems[1]) {
        sidebarItems[1].click();  
    }

    // Optional: Scroll to queries section
    const querySection = document.querySelector(".scdashboard-queryraisedcontainer");
    if (querySection) {
        setTimeout(() => {
            querySection.scrollIntoView({ behavior: "smooth" });
        }, 280); 
    }
});

      


        })

        // Add the sessionLogout function
        function sessionLogout() {
            fetch("{{ route('logout') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = "{{ route('login') }}";
                    } else {
                        console.error("Logout failed");
                        alert("Failed to log out. Please try again.");
                    }
                })
                .catch(error => {
                    console.error("Error during logout:", error);
                    alert("An error occurred while logging out.");
                });
        }

        function triggeredButtons() {
            const saveStudentDetailsButton = document.querySelector("#save-multiple-students-bysc");
            saveStudentDetailsButton.addEventListener('click', () => {
                const studentData = collectStudentData();
            });
            const triggerExpandShrink = document.querySelectorAll(".expand-arrow-reportsindashboard");
            const imageRotation = document.querySelectorAll(".expand-arrow-rotation");
            initializecheckStatus();

            if (triggerExpandShrink) {

                triggerExpandShrink.forEach((items, index) => {
                    console.log(items)

                    items.addEventListener("click", () => {

                        const progress = document.querySelectorAll(".reportsproposal-datalists");
                        if (progress[index].style.display === "flex") {
                            progress[index].style.display = "none";
                            if (imageRotation) {
                                imageRotation[index].style.transform = "rotate(360deg)"
                            }



                        } else {


                            progress[index].style.display = "flex";
                            if (imageRotation) {
                                imageRotation[index].style.transform = "rotate(180deg)"
                            }
                        }
                    });
                });
            }

            const backgroundContainer = document.querySelector('.scdashboard-parentcontainer');

        }

        // window.addEventListener('resize', function () {
        //     const triggeredSideBar = document.querySelector(".commonsidebar-togglesidebar");
        //     const img = document.querySelector("#scuser-dashboard-menu img");

        //     if (window.innerWidth <= 768) {
        //         if (img.src.includes("menu.png")) {
        //             img.src = '{{ asset('assets/images/Icons/close_icon.png') }}';
        //         }
        //     } else if (window.innerWidth > 768) {
        //         triggeredSideBar.style.backgroundColor = '';
        //         triggeredSideBar.style.display = "flex";
        //     }
        // });

        const initializeQueryModal = () => {
            const raiseQueryBtn = document.querySelector('#raised-query');
            const modal = document.querySelector('#query-modal');
            const backdrop = document.querySelector('#backdrop');
            const closeBtn = document.querySelector('#query-modal-close');
            const cancelBtn = document.querySelector('#query-cancel');
            const form = document.querySelector('#query-form');
            const backgroundContainer = document.querySelector('.scdashboard-parentcontainer');
            const viewMoreBtn = document.querySelector('#viewmore-queries');
            const querysContainer = document.querySelector('.groupofraisedquestion-scdashboard');

            if (!raiseQueryBtn || !modal || !backdrop || !closeBtn || !cancelBtn || !form || !viewMoreBtn || !
                querysContainer) {
                console.error('Query modal elements missing');
                return;
            }

            const openModal = () => {
                modal.classList.add('active');
                backdrop.classList.add('active');
                backgroundContainer.classList.add('dull');
            };

            const closeModal = () => {
                modal.classList.remove('active');
                backdrop.classList.remove('active');
                backgroundContainer.classList.remove('dull');
                form.reset();
            };

            raiseQueryBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);

            const updateQueryVisibility = () => {
                const isMobile = window.innerWidth <= 768;
                const queryEntries = querysContainer.querySelectorAll('.query-entry');

                if (isMobile) {
                    queryEntries.forEach((entry, index) => {
                        entry.style.display = querysContainer.classList.contains('expanded') || index < 4 ?
                            'block' : 'none';
                    });
                    viewMoreBtn.style.display = queryEntries.length > 4 ? 'flex' : 'none';
                } else {
                    queryEntries.forEach(entry => entry.style.display = 'block');
                    viewMoreBtn.style.display = 'none';
                    querysContainer.classList.remove('expanded');
                }
            };

            viewMoreBtn.addEventListener('click', () => {
                querysContainer.classList.toggle('expanded');

                const viewText = viewMoreBtn.querySelector('p');
                const viewIcon = viewMoreBtn.querySelector('img');
                if (querysContainer.classList.contains('expanded')) {
                    viewText.textContent = 'view less';
                    viewIcon.style.transform = 'rotate(180deg)';
                } else {
                    viewText.textContent = 'view more';
                    viewIcon.style.transform = 'rotate(0deg)';
                }

                updateQueryVisibility();
            });

            window.addEventListener('resize', updateQueryVisibility);

            updateQueryVisibility();


            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const queryText = document.querySelector('#query-text').value;
                const queryType = document.querySelector('#query-type').value;
                const scuser = @json(session('scuser'));
                const scUserId = scuser.referral_code;


                if (!queryText || !queryType) {
                    alert('Please fill in all fields.');
                    return;
                }

                const queryData = {
                    scUserId,
                    queryText,
                    queryType,
                    date_added: new Date().toISOString().split('T')[0]
                };

                fetch('/submit-query', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify(queryData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const newQuery = document.createElement('div');
                            newQuery.classList.add('individual-raisedquestions', 'query-entry');
                            newQuery.setAttribute('data-added', queryData.date_added);
                            newQuery.innerHTML = `
                        <p id="queries-row">${queryData.queryText}</p>
                        <p id="query-raisedbyrow">${queryData.queryType}</p>
                    `;
                            querysContainer.prepend(newQuery);
                            closeModal();
                            alert('Query submitted successfully!');
                            updateQueryVisibility(); // apply display logic for new entry
                        } else {
                            alert('Error submitting query: ' + data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting query:', error);
                        alert('An error occurred while submitting the query.');
                    });
            });
        };


        const initializeProfileUploadScuser = async () => {
            const profileUploadForScTriggerShower = document.querySelector(
                '.scdashboard-performancecontainer .performancecontainer-firstrow .edit-scuser');
            const scUserInfoUpdationSaver = document.querySelector(
                '.scdashboard-performancecontainer .performancecontainer-firstrow .save-scuser');
            const profileUploadForScTrigger = document.querySelector('.scmember-profilecontainerimg i');
            const profileUploadToCloud = document.getElementById('sc-profile-upload-cloud');
            const profileViewInstantChange = document.getElementById("studentcounsellor-profile");
            const editStateProfileinfo = document.querySelector(".scmember_personalinfo_editmode");
            const editStateProfiledob = document.getElementById("screferral-dob-fromprofile-editmode");
            const Profileinfo = document.querySelector(".scmember_personalinfo");
            const Profiledob = document.getElementById("screferral-dob-fromprofile");

            const dobDisplay = document.getElementById("dob-display");
            const dobInput = document.getElementById("dob-input");

            // Check if DOB elements exist
            if (!dobDisplay || !dobInput) {
                console.error('DOB display or input elements not found');
                return;
            }

            // Check if elements exist before adding event listeners
            if (profileUploadForScTriggerShower) {
                profileUploadForScTriggerShower.addEventListener('click', () => {
                    if (profileUploadForScTrigger) {
                        profileUploadForScTrigger.style.display = "block";
                        editStateProfileinfo.style.display = "flex";
                        Profileinfo.style.display = "none";
                        Profiledob.style.display = "none";
                        scUserInfoUpdationSaver.style.display = "flex";
                        profileUploadForScTriggerShower.style.display = "none";
                        editStateProfiledob.style.display = "flex";
                    }
                });
            } else {
                console.error('Trigger shower button not found');
            }

            if (profileUploadForScTrigger) {
                profileUploadForScTrigger.addEventListener('click', () => {
                    if (profileUploadToCloud) {
                        profileUploadToCloud.click();
                    } else {
                        console.error('Profile upload input not found');
                    }
                });
            } else {
                console.error('Profile upload trigger icon not found');
            }

            if (profileUploadToCloud) {
                profileUploadToCloud.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) {
                        console.error("No file selected");
                        return;
                    }

                    const idsession = @json(session('scuser'));
                    const scUserRefId = idsession.referral_code;
                    const fileName = file.name;
                    const fileType = file.type;
                    console.log(`${fileName} . ${fileType}`);

                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!allowedTypes.includes(fileType)) {
                        console.error('Invalid file type. Only jpg, png, and gif are allowed.');
                        return;
                    }

                    const formDetailsData = new FormData();
                    formDetailsData.append('file', file);
                    formDetailsData.append('scuserrefid', scUserRefId);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    if (!csrfToken) {
                        console.error('CSRF token not found');
                        return;
                    }

                    fetch('/upload-scuserprofile-photo', {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formDetailsData,
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw new Error(errorData.error ||
                                        'Network response was not ok');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data) {
                                console.log("File uploaded successfully", data);
                                if (profileViewInstantChange) profileViewInstantChange.src = data
                                    .file_path;
                                const navImageElement = document.querySelector("#nav-profile-photo-id");
                                if (navImageElement) navImageElement.src = data.file_path;
                            } else {
                                console.error("Error: No URL returned from the server", data);
                            }
                        })
                        .catch(error => {
                            console.error("Error uploading file", error);
                        });
                });
            } else {
                console.error('Profile upload input not found');
            }

            scUserInfoUpdationSaver.addEventListener('click', () => {
                updateScUserProfileInfos();
            });
        };

        const initializeProfileViewScuser = () => {
            const idsession = @json(session('scuser'));
            const scUserRefId = idsession.referral_code;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const profileViewInstantChange = document.getElementById("studentcounsellor-profile");

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }
            fetch('/view-scuserprofile-photo', {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        scuserrefid: scUserRefId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.fileUrl) {
                        console.log("Profile Picture URL:", data.fileUrl);
                        profileViewInstantChange.src = data.fileUrl;
                    } else {
                        console.error("Error: No URL returned from the server", data);
                    }
                })
                .catch(error => {
                    console.error("Error retrieving profile picture", error);
                });
        };

        const initializeSortByFunctionQueries = () => {
            const sortBy = document.querySelector(".queryraisedcontainer-rightcontent #sort-by");
            const sortByContents = document.querySelector(".queryraisedcontainer-rightcontent .sort-by-contents");
            const querysContainer = document.querySelector(".groupofraisedquestion-scdashboard");
            const sortedLinkCateg = document.querySelectorAll(".queryraisedcontainer-rightcontent .sort-by-contents a");

            sortedLinkCateg.forEach((item) => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortContentsType = e.target.getAttribute('data-sort');
                    const raisedQuestions = Array.from(querysContainer.querySelectorAll(
                        '.individual-raisedquestions'));

                    if (sortContentsType === 'newest') {
                        raisedQuestions.sort((a, b) => new Date(b.dataset.added) - new Date(a.dataset
                            .added));
                    } else if (sortContentsType === 'oldest') {
                        raisedQuestions.sort((a, b) => new Date(a.dataset.added) - new Date(b.dataset
                            .added));
                    } else if (sortContentsType === 'alphabet') {
                        raisedQuestions.sort((a, b) => a.querySelector('#queries-row').textContent
                            .trim().localeCompare(b.querySelector('#queries-row').textContent
                                .trim()));
                    } else if (sortContentsType === 'alphabet-reverse') {
                        raisedQuestions.sort((a, b) => b.querySelector('#queries-row').textContent
                            .trim().localeCompare(a.querySelector('#queries-row').textContent
                                .trim()));
                    }

                    raisedQuestions.forEach((question) => {
                        querysContainer.appendChild(question);
                    });
                });
            });

            sortBy.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sortByContents) {
                    sortByContents.style.display = sortByContents.style.display === "none" ? "flex" : "none";
                }
            });

            document.addEventListener('click', (e) => {
                if (sortByContents && sortByContents.style.display === "flex" && !sortBy.contains(e.target)) {
                    sortByContents.style.display = "none";
                }
            });
        };

        const initializeSortByFunctionApplicationStatus = () => {
            const sortByApplication = document.querySelector("#applicationstatus-sortby");
            const sortByApplicationContent = document.querySelector(".sort-by-contents-applications-studentnames");
            let sortedApplicationStudentLinks = document.querySelectorAll(
                ".sort-by-contents-applications-studentnames a");
            const studentContainer = document.querySelector("#student-applicationdetailsstatus");

            if (sortByApplicationContent) {
                sortByApplicationContent.style.display = 'none';
            }

            sortedApplicationStudentLinks.forEach((item) => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortType = e.target.getAttribute('data-sort');
                    let sortedElementApplicationView = Array.from(studentContainer.querySelectorAll(
                        ".studentapplicationstatusreports-inscdashboard"));

                    if (sortType === 'newest' || sortType === 'oldest') {
                        const elementsWithDate = sortedElementApplicationView.map(el => ({
                            el,
                            date: new Date(el.getAttribute('data-added'))
                        }));

                        elementsWithDate.sort((a, b) => {
                            return sortType === 'newest' ? b.date - a.date : a.date - b.date;
                        });

                        sortedElementApplicationView = elementsWithDate.map(item => item.el);
                    } else if (sortType === 'alphabet') {
                        sortedElementApplicationView.sort((a, b) =>
                            a.querySelector('.reportsindashboard-leftcontentinfirstrow p')
                            .textContent.trim().localeCompare(
                                b.querySelector('.reportsindashboard-leftcontentinfirstrow p')
                                .textContent.trim()
                            )
                        );
                    } else if (sortType === 'alphabet-reverse') {
                        sortedElementApplicationView.sort((a, b) =>
                            b.querySelector('.reportsindashboard-leftcontentinfirstrow p')
                            .textContent.trim().localeCompare(
                                a.querySelector('.reportsindashboard-leftcontentinfirstrow p')
                                .textContent.trim()
                            )
                        );
                    }

                    sortedElementApplicationView.forEach((student) => {
                        studentContainer.appendChild(student);
                    });

                    if (sortByApplicationContent) {
                        sortByApplicationContent.style.display =
                            'none'; // close dropdown after selection
                    }
                });
            });

            sortByApplication.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sortByApplicationContent) {
                    const isVisible = sortByApplicationContent.style.display === 'flex';
                    sortByApplicationContent.style.display = isVisible ? 'none' : 'flex';
                    sortByApplication.setAttribute('aria-expanded', !isVisible);
                }
            });

            document.addEventListener('click', (e) => {
                if (sortByApplicationContent && sortByApplicationContent.style.display === "flex" && !
                    sortByApplication.contains(e.target)) {
                    sortByApplicationContent.style.display = "none";
                    sortByApplication.setAttribute('aria-expanded', 'false');
                }
            });
        }
        const dynamicChangesWhileScreenShrink = () => {
            const contentChangeButton = document.querySelector(
                ".scdashboard-applicationstatus .scapplicationstatus-firstrow #sc-new-application-generate");
            const statusTextElements = document.querySelectorAll('.dynamic-status-hide');
            const raisedQueryButton = document.querySelector(".queryraisedcontainer-rightcontent #raised-query");

            if (window.innerWidth <= 720) {
                raisedQueryButton.textContent = "+";
                raisedQueryButton.style.width = "2.1rem";
                raisedQueryButton.style.backgroundColor = "#6F25CE";
                raisedQueryButton.style.color = "#fff";
            } else {
                raisedQueryButton.textContent = "Raise Query";
                raisedQueryButton.style.width = "8.06rem";
                raisedQueryButton.style.backgroundColor = "transparent";
                raisedQueryButton.style.color = "#6F25CE";
            }

            if (window.innerWidth <= 640) {
                contentChangeButton.textContent = "+";
                statusTextElements.forEach((element) => {
                    if (element.firstChild) {
                        element.firstChild.textContent = "";
                    }
                });
            } else {
                contentChangeButton.textContent = "Start New Application";
                statusTextElements.forEach((element) => {
                    if (element.firstChild) {
                        element.firstChild.textContent = "Status: ";
                    }
                });
            }
        };

        window.addEventListener('load', dynamicChangesWhileScreenShrink);
        window.addEventListener('resize', dynamicChangesWhileScreenShrink);

        const initializePopuAddingstudents = () => {
            const studentAddingPopuBar = document.querySelector(".studentAddBySCuserPopup");
            const popuAddingStudentTriggers = document.querySelectorAll(".studentapplication-header .start-new");
            const closePopuTrigger = document.querySelector(".studentAddByScuserPopup-headerpart img");
            const backgroundContainer = document.querySelector(".scdashboard-parentcontainer");
            const popuAddingStudentTriggersApplications = document.getElementById("sc-new-application-generate");
            const overlay = document.querySelector(".sc-new-registration-overlay");

            if (!studentAddingPopuBar || !popuAddingStudentTriggers.length || !closePopuTrigger || !
                backgroundContainer || !overlay) {
                console.error("Required DOM elements are missing for initializePopuAddingstudents:", {
                    studentAddingPopuBar: !!studentAddingPopuBar,
                    popuAddingStudentTriggers: !!popuAddingStudentTriggers.length,
                    closePopuTrigger: !!closePopuTrigger,
                    backgroundContainer: !!backgroundContainer,
                    overlay: !!overlay
                });
                return;
            }

            const showPopup = () => {
                studentAddingPopuBar.style.display = "flex";
                overlay.style.display = "block";
            };

            const hidePopup = () => {
                studentAddingPopuBar.style.display = "none";
                overlay.style.display = "none";
            };

            popuAddingStudentTriggers.forEach(button => {

                button.addEventListener("click", showPopup);
            });

            if (popuAddingStudentTriggersApplications) {
                popuAddingStudentTriggersApplications.addEventListener("click", showPopup);
            }

            if (closePopuTrigger) {
                closePopuTrigger.addEventListener("click", hidePopup);
            }
        };



        const addDynamicInputFields = () => {
            const addStudentButtons = document.querySelectorAll(
                ".studentAddByScuserPopup-footerpart button:nth-child(2), #dynamic-add-student-button");
            const studentFormContainer = document.querySelector(".studentAddByScuserPopup-contentpart");

            const addNewStudentForm = () => {
                const newForm = document.createElement("div");
                newForm.classList.add("studentAddByScuserPopup-contentpart");

                newForm.innerHTML = `
                    <input type="text" placeholder="Name of the Student">
                    <input type="text" placeholder="bankemail@gmail.com">
                    <input type="text" placeholder="phone">
                    <input type="text" placeholder="password">
                    <button class="delete-student-popup">Delete</button>
                `;

                studentFormContainer.appendChild(newForm);

                const deleteButton = newForm.querySelector(".delete-student-popup");
                deleteButton.addEventListener('click', () => {
                    newForm.remove();
                });
            };


            addStudentButtons.forEach(button => {
                button.addEventListener('click', addNewStudentForm);
            });
        };

        const initializecheckStatus = () => {
            const statusElements = document.querySelectorAll(".reportsproposal-individualdatalists p span");
            const applicationStatusElements = document.querySelectorAll(
                ".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
            const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

            applicationStatusElements.forEach((items, index) => {
                const text = items.textContent.trim();

                if (text.includes("Approved")) {
                    items.style.color = "#3FA27E";
                    items.style.backgroundColor = "#D2FFEE";
                    if (missingDocumentsCount[index]) {
                        missingDocumentsCount[index].style.display = "none";
                    }
                } else if (text.includes("No Progress Found")) {
                    items.style.color = "#B54747";
                    items.style.backgroundColor = "#FFE5E5";
                    if (missingDocumentsCount[index]) {
                        missingDocumentsCount[index].style.display = "flex";
                    }
                } else if (text.includes("Not Reviewed")) {
                    items.style.color = "#997404";
                    items.style.backgroundColor = "#FFF9DB";
                    if (missingDocumentsCount[index]) {
                        missingDocumentsCount[index].style.display = "flex";
                    }
                } else {
                    if (missingDocumentsCount[index]) {
                        missingDocumentsCount[index].style.display = "flex";
                    }
                }
            });

            statusElements.forEach(dynamicStatusColorChange => {
                if (dynamicStatusColorChange.textContent.includes("Accepted")) {
                    dynamicStatusColorChange.textContent = "Approved";
                    dynamicStatusColorChange.style.color = "#3FA27E";
                    dynamicStatusColorChange.style.backgroundColor = "#D2FFEE";
                    dynamicStatusColorChange.style.width = "100%"
                    dynamicStatusColorChange.style.maxWidth = "95px"
                } else if (dynamicStatusColorChange.textContent.includes("Rejected")) {
                    dynamicStatusColorChange.textContent = "Rejected";
                    // dynamicStatusColorChange.style.color = "#3FA27E";
                    // dynamicStatusColorChange.style.backgroundColor = "#D2FFEE";
                    dynamicStatusColorChange.style.width = "100%"
                    dynamicStatusColorChange.style.maxWidth = "95px"
                } else if (dynamicStatusColorChange.textContent.includes("Pending")) {
                    dynamicStatusColorChange.style.color = "#FA7B15";
                    dynamicStatusColorChange.style.backgroundColor = "#FFE3CA";
                    dynamicStatusColorChange.style.width = "100%";
                    dynamicStatusColorChange.style.maxWidth = "95px";
                }
            });
        };

        const initializescsidebar = () => {
            const scsidebaritems = document.querySelectorAll(".commonsidebar-sidebarlists-top li");
            const trackprogressContainer = document.querySelector(".scdashboard-container");
            const scinboxContainer = document.querySelector(".scdashboard-inboxcontent");
            const scapplicationStatus = document.querySelector(".scdashboard-applicationstatus");
            const triggeredSideBar = document.querySelector(".commonsidebar-togglesidebar");
            const img = document.querySelector("#scuser-dashboard-menu img");

            scsidebaritems.forEach((item, index) => {
                item.addEventListener("click", () => {
                    if (window.innerWidth <= 768) {
                        triggeredSideBar.style.display = "none";
                        if (img.src.includes("close_icon.png")) {
                            img.src = '{{ asset('assets/images/Icons/menu.png') }}';
                        }
                    }
                    scsidebaritems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                    if (index === 0) {
                        trackprogressContainer.style.display = "flex";
                        scinboxContainer.style.display = "none";
                        scapplicationStatus.style.display = "none";
                    } else if (index === 1) {
                        trackprogressContainer.style.display = "none";
                        scinboxContainer.style.display = "flex";
                        scapplicationStatus.style.display = "none";
                    } else {
                        trackprogressContainer.style.display = "none";
                        scinboxContainer.style.display = "none";
                        scapplicationStatus.style.display = "flex";
                    }
                });
            });
        }



        function prevdetail() {
            if (currentValue > 1) {
                currentValue--;
                document.querySelector(`.student-page[data-page="${currentValue}"]`).style.display = "block";
                document.querySelector(`.student-page[data-page="${currentValue + 1}"]`).style.display = "none";

                document.querySelectorAll(".page-class").forEach(button => {
                    button.classList.remove("active");
                });

                document.querySelector(`.page-class[data-page="${currentValue}"]`).classList.add("active");
            }
        }

        function nextdetail() {
            const totalPages = document.querySelectorAll(".student-page").length;
            if (currentValue < totalPages) {
                currentValue++;
                document.querySelector(`.student-page[data-page="${currentValue}"]`).style.display = "block";
                document.querySelector(`.student-page[data-page="${currentValue - 1}"]`).style.display = "none";

                document.querySelectorAll(".page-class").forEach(button => {
                    button.classList.remove("active");
                });
                document.querySelector(`.page-class[data-page="${currentValue}"]`).classList.add("active");
            }
        }

        const getUsersByCounsellor = () => {
            const getRefCode = document.querySelector("#screferral-id-fromprofile span");
            const referralId = getRefCode ? getRefCode.textContent : '';

            if (!referralId) {
                console.error("Referral ID is missing");
                return;
            }

            fetch("/getuserbyref", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') || ''
                    },
                    body: JSON.stringify({
                        referralId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }

                    const userListContainer = document.getElementById("user-list");
                    userListContainer.innerHTML = "";

                    if (data.users && data.users.length > 0) {
                        // Render user list
                        data.users.forEach((user, index) => {
                            const isHidden = index >= 3 ? 'hidden' :
                                ''; // Use a class instead of inline style
                            const userHTML = `
                        <div class="studentapplication-lists user-item ${isHidden}">
                            <div class="individualapplication-list">
                                <div class="firstsection-lists">
                                    <h1>${user.name}</h1>
                                    <div class="application-buttoncontainer">
                                        <button style="display:none">View</button>
                                        <button style="display:none">Edit</button>
                                        <button class="expand-arrow">
                                            <img src="/assets/images/stat_minus_1.png" alt="Expand">
                                        </button>
                                    </div>
                                    <button class="studenteacheditbutton" style="display:none">Edit</button>
                                </div>
                            </div>
                            <ul class="individualstudentapplication-status">
                                <li class="scdashboard-nbfcnamecontainer">
                                    <p>NBFC:</p>
                                    <p>${user.nbfc_name}</p>
                                </li>
                                <li class="scdashboard-nbfcstatus-pending">
                                    <p>Status:</p>
                                    <span>${user.status}</span>
                                </li>
                                <li class="scdashboard-missingdocumentsstatus">
                                    <p>Missing Documents:</p>
                                    <span>${user.missing_documents}</span>
                                </li>
                            </ul>
                        </div>
                    `;
                            userListContainer.innerHTML += userHTML;
                        });

                        // Add CSS for hidden class and mobile view "View More" button
                        const style = document.createElement("style");
                        style.textContent = `
                    .hidden {
                        display: none !important;
                    }
                    .studentapplication-lists.user-item {
                        display: block;
                    }
                    .view-more-container {
                        display: none; /* Hidden by default (web view) */
                    }
                    @media (max-width: 768px) {
                        .see-all {
                            display: none !important; /* Hide "See All" button in mobile view */
                        }
                        .view-more-container {
                            display: flex;
                            justify-content: end;
                            margin-top: 16px;
                        }
                        .view-more-btn {
                            display: flex;
                            align-items: center;
                            gap: 8px;
                            padding: 8px 16px;
                             border-radius: 4px;
                             border:none;
                             background:transparent;
                             font-weight:600;
                             
                            color:rgba(93, 92, 92, 1);
                            cursor: pointer;
                            font-size: 14px;
                        }
                        .view-more-btn .view-more-icon {
                            width: 16px;
                            height: 16px;
                            color:rgba(93, 92, 92, 1);

                        }
                    }
                `;
                        document.head.appendChild(style);

                        // Web view: "See All" functionality
                        const seeAllBtn = document.querySelector(".see-all");
                        if (seeAllBtn) {
                            seeAllBtn.style.display = "inline-block"; // Ensure it's visible initially in web view
                            let isShowingAll = false; // Track the toggle state

                            seeAllBtn.addEventListener("click", () => {
                                const userItems = document.querySelectorAll(".user-item");
                                if (!isShowingAll) {
                                    // Show all items
                                    userItems.forEach(item => {
                                        item.classList.remove("hidden");
                                    });
                                    seeAllBtn.textContent = "Hide";
                                    seeAllBtn.style.color = "#260254B3";
                                    seeAllBtn.style.borderColor = "#260254B3";
                                } else {
                                    // Revert to showing only the first 3 rows
                                    userItems.forEach((item, index) => {
                                        if (index >= 3) {
                                            item.classList.add("hidden");
                                        }
                                    });
                                    seeAllBtn.textContent = "See All";
                                    seeAllBtn.style.color = "#E98635";
                                    seeAllBtn.style.borderColor = "#E98635";
                                }
                                isShowingAll = !isShowingAll; // Toggle the state
                            });
                        }

                        // Mobile view: Add "View More" button if there are more than 3 users
                        if (data.length > 3) {
                            const viewMoreButtonHTML = `
                        <div class="view-more-container">
                            <button class="view-more-btn">
                                <span>View More</span>
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="view-more-icon">
                                    <path d="M6 9l6 6 6-6H6z" fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                    `;
                            userListContainer.insertAdjacentHTML('beforeend', viewMoreButtonHTML);

                            // Add event listener for "View More" button
                            const viewMoreButton = document.querySelector(".view-more-btn");
                            if (viewMoreButton) {
                                let isShowingAllMobile = false; // Track toggle state for mobile
                                viewMoreButton.addEventListener("click", () => {
                                    const userItems = document.querySelectorAll(".user-item");
                                    if (!isShowingAllMobile) {
                                        // Show all items
                                        userItems.forEach(item => {
                                            item.classList.remove("hidden");
                                        });
                                        viewMoreButton.querySelector("span").textContent = "View Less";
                                        // Rotate the icon to point upwards
                                        viewMoreButton.querySelector(".view-more-icon").style.transform =
                                            "rotate(180deg)";
                                    } else {
                                        // Revert to showing only the first 3 rows
                                        userItems.forEach((item, index) => {
                                            if (index >= 3) {
                                                item.classList.add("hidden");
                                            }
                                        });
                                        viewMoreButton.querySelector("span").textContent = "View More";
                                        // Reset the icon rotation
                                        viewMoreButton.querySelector(".view-more-icon").style.transform =
                                            "rotate(0deg)";
                                    }
                                    isShowingAllMobile = !isShowingAllMobile; // Toggle the state
                                });
                            }
                        }
                    } else {
                        userListContainer.innerHTML = "<p>No users found.</p>";
                    }
                })
                .catch(error => {
                    console.error("Error fetching users:", error);
                });
        };

        const generateReferLinkPopup = () => {
            const triggeredReferralButtons = document.querySelectorAll(
                ".referral-Link-trigger-button, .referral-Link-trigger-anotherbutton");
            const referralTriggeredView = document.querySelector(".referral-triggered-view");
            const closeReferralTriggerView = document.querySelector(".referral-triggered-view-headersection img");
            const footerContainer = document.querySelector(".referral-triggered-view-footer");
            let generateButton = document.querySelector(".referral-triggered-view-footer button:nth-child(2)");
            let cancelButton = document.querySelector(".referral-triggered-view-footer button:nth-child(1)");
            const referralInput = document.querySelector(".referral-triggered-view-content input");
            const backgroundContainer = document.querySelector(".scdashboard-parentcontainer");
            const referralCodeElement = document.querySelector("#screferral-id-fromprofile span");
            const overlay = document.querySelector(".sc-dashboard-generate-overlay");

            const baseUrl = "/signup"; // can be full URL like "https://example.com/signup"
            const secretKey = "rJXU0e4lTP7G+KP9dH5V1pq9P7vP8d8sravZmzMGUKM=";

            if (!triggeredReferralButtons.length || !referralTriggeredView || !referralInput || !backgroundContainer ||
                !referralCodeElement || !footerContainer || !overlay) {
                console.error("Required DOM elements are missing for generateReferLinkPopup:", {
                    triggeredReferralButtons: !!triggeredReferralButtons.length,
                    referralTriggeredView: !!referralTriggeredView,
                    referralInput: !!referralInput,
                    backgroundContainer: !!backgroundContainer,
                    referralCodeElement: !!referralCodeElement,
                    footerContainer: !!footerContainer,
                    overlay: !!overlay
                });
                return;
            }

            const referralCode = referralCodeElement.textContent.trim();
            if (!referralCode) {
                console.error("Referral code is empty or not found");
                return;
            }

            // Append ?ref=... or &ref=... based on existing query string
            const url = new URL(baseUrl, window.location.origin); // baseUrl can be relative or absolute
            url.searchParams.set("ref", referralCode);

            const referralLink = url.toString();
            console.log("Generated referral link:", referralLink);

            const removeExistingListeners = (element, event, handler) => {
                element.removeEventListener(event, handler);
                element.addEventListener(event, handler);
            };


            const resetFooter = () => {
                footerContainer.innerHTML = `
                <button>
                    <img src="{{ asset('assets/images/Icons/close_icon.png') }}" alt="Cancel Icon" />
                    Cancel
                </button>
                <div class="action-btn-group">
                    <button class="btn-generate">Generate</button>
                </div>
            `;
                cancelButton = footerContainer.querySelector("button:nth-child(1)");
                generateButton = footerContainer.querySelector(".btn-generate");

                if (cancelButton) {
                    cancelButton.style.border = "1px solid rgba(233, 134, 53, 1)";
                    removeExistingListeners(cancelButton, "click", hidePopup);
                }
                if (generateButton) {
                    removeExistingListeners(generateButton, "click", generateLink);
                }
            };

            const showPopup = () => {
                referralTriggeredView.style.display = "flex";
                overlay.style.display = "block";
                referralInput.value = "";
                resetFooter();
            };

            const hidePopup = () => {
                referralTriggeredView.style.display = "none";
                overlay.style.display = "none";
            };

            const generateLink = () => {
                if (!referralInput) return;
                referralInput.value = referralLink;
                footerContainer.innerHTML = `
                    <button>
                        <img src="{{ asset('assets/images/Icons/close_icon.png') }}" alt="Referral link Cancel Icon" />
                        Cancel
                    </button>
                    <div class="action-btn-group">
                        <button class="btn-copy-link">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 1H4C2.9 1 2 1.9 2 3V17H4V3H16V1ZM19 5H8C6.9 5 6 5.9 6 7V21C6 22.1 6.9 23 8 23H19C20.1 23 21 22.1 21 21V7C21 5.9 20.1 5 19 5ZM19 21H8V7H19V21Z"/>
                            </svg>
                            <span>Copy Link</span>
                        </button>
                        <button class="btn-share" style="width:98px">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 16.1C17.4 16.1 16.9 16.3 16.4 16.6L7.9 12.2C7.9 12.1 8 12 8 11.9C8 11.8 7.9 11.7 7.9 11.6L16.4 7.2C16.9 7.5 17.4 7.7 18 7.7C19.7 7.7 21 6.4 21 4.7S19.7 1.7 18 1.7 15 3 15 4.7C15 4.8 15 4.9 15.1 5L6.6 9.4C6.1 9.1 5.6 8.9 5 8.9 3.3 8.9 2 10.2 2 11.9S3.3 14.9 5 14.9C5.6 14.9 6.1 14.7 6.6 14.4L15.1 18.8C15 18.9 15 19 15 19.1 15 20.8 16.3 22.1 18 22.1S21 20.8 21 19.1 19.7 16.1 18 16.1ZM18 3.7C18.6 3.7 19 4.1 19 4.7S18.6 5.7 18 5.7 17 5.3 17 4.7 17.4 3.7 18 3.7ZM5 12.9C5 12.3 4.6 11.9 5 11.9S5 12.3 5 12.9 5.4 13.9 5 13.9 5 13.5 5 12.9ZM18 20.1C17.4 20.1 17 19.7 17 19.1S17.4 18.1 18 18.1 19 18.5 19 19.1 18.6 20.1 18 20.1Z"/>
                            </svg>
                            <span>Share</span>
                        </button>
                    </div>
                `;
                const newCancelButton = footerContainer.querySelector("button:nth-child(1)");
                const copyLinkButton = footerContainer.querySelector(".btn-copy-link");
                const shareButton = footerContainer.querySelector(".btn-share");

                if (newCancelButton) {
                    removeExistingListeners(newCancelButton, "click", hidePopup);
                }

                if (copyLinkButton) {
                    const copyLink = async () => {
                        try {
                            await navigator.clipboard.writeText(referralLink);
                            alert("Referral link copied to clipboard!");
                        } catch (err) {
                            console.warn("Clipboard copy failed:", err);
                            referralInput.select();
                            if (document.execCommand("copy")) {
                                alert("Referral link copied to clipboard!");
                            } else {
                                alert("Please copy the link manually.");
                            }
                        }
                    };
                    removeExistingListeners(copyLinkButton, "click", copyLink);
                }

                if (shareButton) {
                    const shareLink = async () => {
                        if (navigator.share) {
                            try {
                                await navigator.share({
                                    title: "Referral Link",
                                    text: "Check out this referral link!",
                                    url: referralLink
                                });
                            } catch (err) {
                                console.warn("Sharing failed:", err);
                            }
                        } else {
                            alert(
                                "Sharing is not supported on this device. Please copy the link manually."
                                );
                        }
                    };
                    removeExistingListeners(shareButton, "click", shareLink);
                }
            };

            triggeredReferralButtons.forEach(button => {
                removeExistingListeners(button, "click", showPopup);
            });

            if (closeReferralTriggerView) {
                removeExistingListeners(closeReferralTriggerView, "click", hidePopup);
            }

            if (cancelButton) {
                removeExistingListeners(cancelButton, "click", hidePopup);
            }

            if (generateButton) {
                removeExistingListeners(generateButton, "click", generateLink);
            }

            const style = document.createElement("style");
            style.textContent = `
                .referral-triggered-view {
                    position: relative;
                    z-index: 1000;
                }
                .referral-triggered-view-footer {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
                .referral-triggered-view-footer button {
                     
                    padding: 8px 16px;
                    margin: 0;
                    border: 1px solid #fff;
                    border-radius: 4px;
                    cursor: pointer;
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    font-size: 14px;
                    transition: background-color 0.3s ease;
                }
                .referral-triggered-view-footer button:nth-child(1) {
                    background-color: #fff;
                    color: #000;
                    border: 1px solid #000;
                 }
                .action-btn-group {
                    display: flex;
                    gap: 8px;
                }
                .action-btn-group .btn-generate {
                    background-color: #000;
                    color: #fff;
                    border: 1px solid #fff;
                }
                .action-btn-group .btn-copy-link {
                    background-color: transparent;
                    color: black;
                    border: 1px solid #fff;
                    padding: 8px 12px;
                    white-space: nowrap;
                }
                .action-btn-group .btn-share {
                    background-color: transparent;
                    color: #fff;
                    border: 1px solid #fff;
                    padding: 8px 12px;
                }
                
                .action-btn-group .btn-share:hover {
                    background-color: #A855F7;
                }
                .action-btn-group .btn-copy-link svg {
                    width: 16px;
                    height: 16px;
                    flex-shrink: 0;
                    display: inline-block;
                }
                 .action-btn-group .btn-share svg {
                    width: 16px;
                    height: 16px;
                    flex-shrink: 0;
                    display: inline-block;
                    fill: #fff;
                }
                .action-btn-group button span {
                    line-height: 1;
                    display: inline-block;
                }
            `;
            document.head.appendChild(style);
        };

        const queryDetails = () => {
            const scuser = @json(session('scuser'));
            const scuserid = scuser.referral_code;
            fetchDeactiveQueryCount(scuserid);


            const mobRef = document.getElementById("mobgeneratedreferralcode");
            const Ref = document.getElementById("pcviewgeneratedreferralcode");

            if (mobRef && Ref) {
                mobRef.textContent = `Referral Code:  ${scuserid} `;
                Ref.textContent = `Referral Code:  ${scuserid} `;
            }

            if (scuserid) {
                fetch(`/get-queries?scUserId=${scuserid}`, {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        const container = document.querySelector(".groupofraisedquestion-scdashboard");
                        container.innerHTML = ''; // Clear existing

                        if (data.success && data.queries.length > 0) {
                            const sortedQueries = data.queries.sort((a, b) => new Date(b.created_at) - new Date(a
                                .created_at));

                            sortedQueries.forEach((item) => {
                                console.log(item)
                                const div = document.createElement('div');
                                div.classList.add('individual-raisedquestions');
                                div.setAttribute('data-added', item.created_at);

                                let buttonsHTML = '';
                                if (item.status === 'deactive') {
                                    buttonsHTML = `
                           <div class="query-actions" style="display: flex; gap: 8px;">
  <button
    style="padding: 6px 12px; font-size: 16px; border-radius: 4px; cursor: pointer; background-color: #f47b20; color: #fff; border: none;"
    onclick="markQuery('${item.id}', 'deactive')"
    title="Mark as Done"
  >
    ✔
  </button>
  <button
    style="padding: 6px 12px; font-size: 16px; border-radius: 4px; cursor: pointer; background-color: #fff; color: #f47b20; border: 1px solid #f47b20;"
    onclick="markQuery('${item.id}', 'active')"
    title="Mark as Active"
  >
    ✖
  </button>
</div>`;

                                }

                                div.innerHTML = `
                        <p id="queries-row">${item.queryraised}</p>
                        <p id="query-raisedbyrow">${item.querytype}</p>
                        ${buttonsHTML}
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

        function markQuery(queryId, status) {
            fetch(`/mark-query`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        query_id: queryId,
                        status: status
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        queryDetails(); // reload the list after update

                        if (status === 'deactive') {
                            alert('Query deleted successfully.');
                        } else if (status === 'active') {
                            alert('Query sent to admin again.');
                        }
                    } else {
                        alert('Failed to update query.');
                    }
                })
                .catch(err => {
                    console.error('Update error:', err);
                    alert('An error occurred while updating the query.');
                });
        }



        function fetchDeactiveQueryCount(scUserId) {
            fetch(`/count-deactive-queries?scUserId=${scUserId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const countDisplay = document.getElementById('deactive-query-count');
                        if (countDisplay) {
                            countDisplay.textContent = `Deactive Queries: ${data.count}`;
                        }
                    } else {
                        console.error('Failed to fetch count:', data.message);
                    }
                })
                .catch(err => console.error('Error:', err));
        }


        const initializeRaiseQuery = () => {
            const raiseQueryButton = document.querySelector("#raised-query");
            const raiseQueryPopup = document.querySelector(".raise-query-popup");
            const closeQueryPopup = document.querySelector(".raise-query-popup-headersection img");
            const cancelQueryButton = document.querySelector(".raise-query-popup-footer .cancel-query");
            const submitQueryButton = document.querySelector(".raise-query-popup-footer .submit-query");
            const queryText = document.querySelector("#query-text");
            const queryType = document.querySelector("#query-type");
            const backgroundContainer = document.querySelector(".scdashboard-parentcontainer");

            if (!raiseQueryButton || !raiseQueryPopup || !closeQueryPopup || !cancelQueryButton || !submitQueryButton ||
                !queryText || !queryType) {
                console.error("Required DOM elements for raise query popup are missing");
                return;
            }

            // Create overlay element
            const overlay = document.createElement("div");
            overlay.classList.add("sc-query-raised-overlay");
            overlay.style.display = "none";
            overlay.style.position = "fixed";
            overlay.style.top = "85px";
            overlay.style.left = "0";
            overlay.style.width = "100%";
            overlay.style.height = "calc(100% - 85px)";
            overlay.style.background = "rgba(0, 0, 0, 0.5)";
            overlay.style.backdropFilter = "blur(5px)";
            overlay.style.zIndex = "999";
            document.body.appendChild(overlay);

            // Show popup and overlay
            raiseQueryButton.addEventListener('click', () => {
                raiseQueryPopup.style.display = "flex";
                overlay.style.display = "block"; // Show overlay
                backgroundContainer.classList.add("blur");
                queryText.value = ""; // Reset textarea
            });

            // Hide popup and overlay function
            const hidePopup = () => {
                raiseQueryPopup.style.display = "none";
                overlay.style.display = "none"; // Hide overlay
                backgroundContainer.classList.remove("blur");
            };

            // Close button
            closeQueryPopup.addEventListener('click', hidePopup);

            // Cancel button
            cancelQueryButton.addEventListener('click', hidePopup);

            // Submit query
            submitQueryButton.addEventListener('click', () => {
                const query = queryText.value.trim();
                const type = queryType.value;
                const scuser = @json(session('scuser'));
                const scuserid = scuser.referral_code;

                if (!query) {
                    alert("Please enter a query");
                    return;
                }

                fetch('/raise-query', {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            scuserid: scuserid,
                            querytype: type,
                            queryraised: query
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert("Query raised successfully!");
                        hidePopup(); // Close popup and overlay
                        queryDetails(); // Optional function to refresh UI
                    })
                    .catch(error => {
                        console.error("Error raising query:", error);
                        alert("An error occurred while raising the query.");
                    });
            });
        };






        const updateScUserProfileInfos = () => {
            const personalEditMode = document.querySelector(".scmember_personalinfo_editmode");
            const personalScInfoContainer = document.querySelector(".scmember_personalinfo");
            const scRefNo = document.querySelector("#screferral-id-fromprofile span").textContent;
            const updatedScName = personalEditMode.querySelector(".scmember_personal_info_name input").value;
            const updatedScDob = document.querySelector("#screferral-dob-fromprofile-editmode input").value;
            const updatedScPhone = personalEditMode.querySelector(".scmember_personal_info_phone input").value;
            const updatedScAddress = personalEditMode.querySelector(
                ".scmember_personal_info_state-edit .subbranch-of-address");
            const Profiledob = document.getElementById("screferral-dob-fromprofile");
            const editStateProfiledob = document.getElementById("screferral-dob-fromprofile-editmode");
            const profileUploadForScTriggerShower = document.querySelector(
                '.scdashboard-performancecontainer .performancecontainer-firstrow .edit-scuser');
            const scUserInfoUpdationSaver = document.querySelector(
                '.scdashboard-performancecontainer .performancecontainer-firstrow .save-scuser');

            const street = updatedScAddress.querySelector("#scaddress-address").value;
            const district = updatedScAddress.querySelector("#scaddress-city").value;
            const state = updatedScAddress.querySelector("#scaddress-state").value;
            const pincode = updatedScAddress.querySelector("#scaddress-pincode").value;

            const scUserUpdatedDatas = {
                scRefNo,
                updatedScName,
                updatedScDob,
                updatedScPhone,
                street,
                district,
                state,
                pincode
            };

            const scNameElement = personalScInfoContainer.querySelector(".scmember_personal_info_name p");
            const scPhoneElement = personalScInfoContainer.querySelector(".scmember_personal_info_phone p");
            const scAddressElement = personalScInfoContainer.querySelector(".scmember_personal_info_state p");

            if (scNameElement) scNameElement.textContent = updatedScName;
            if (scPhoneElement) scPhoneElement.textContent = updatedScPhone;

            if (Profiledob && Profiledob.querySelector("p")) {
                Profiledob.querySelector("p").textContent = updatedScDob;
            }

            if (!street || !district || !state || !pincode) {
                alert("Please fill in all the address fields: street, district, state, and pincode.");
                return;
                return;
            }

            fetch("/updatescuserdetails", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(scUserUpdatedDatas)
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("All Details Updated for the respective student counsellor");
                        if (personalEditMode) personalEditMode.style.display = "none";
                        if (personalScInfoContainer) personalScInfoContainer.style.display = "flex";
                        if (editStateProfiledob) editStateProfiledob.style.display = "none";
                        if (Profiledob) Profiledob.style.display = "flex";
                        profileUploadForScTriggerShower.style.display = "flex";
                        scUserInfoUpdationSaver.style.display = "none";
                        const finalAddress = `${street}, ${district}, ${state} - ${pincode}`;
                        if (scAddressElement) scAddressElement.textContent = finalAddress;
                    } else {
                        console.error("Update failed: " + data.error);
                    }
                })
                .catch((error) => {
                    console.error("Error posting data: ", error);
                });
        };
        async function alertDeactiveCountFromReferral() {
    const referralCodeElem = document.querySelector("#screferral-id-fromprofile span");
    const scuserid = referralCodeElem ? referralCodeElem.textContent.trim() : null;

    if (!scuserid) {
        alert("Referral code (scuserid) not found.");
        return;
    }

    // alert(scuserid);

    try {
        const response = await fetch(`/queries/deactive-counts/${scuserid}`);
        if (!response.ok) throw new Error("Failed to fetch data");

        const data = await response.json();

        const countNotify = document.querySelector(".unread-notify-container p");
        if (data.deactive_count > 0 && countNotify) {
            countNotify.style.display = "flex";
            countNotify.textContent = data.deactive_count;
        } else if (countNotify) {
            countNotify.style.display = "none";
        }

        // alert(`User ${data.scuserid} has ${data.deactive_count} deactive queries.`);
    } catch (error) {
        console.error(error);
        alert("Error fetching deactive count.");
    }
}






        const initializeScUserOneView = () => {
            const referralCodeElem = document.querySelector("#screferral-id-fromprofile span");
            const referralCode = referralCodeElem ? referralCodeElem.textContent : null;
            const personalScInfoContainer = document.querySelector(".scmember_personalinfo");
            const personalEditMode = document.querySelector(".scmember_personalinfo_editmode");
            const additionAddressView = document.querySelector(".scmember_personal_info_state-edit");

            if (!referralCode) {
                console.error("Referral code not found");
                return;
            }

            fetch('/scuserone', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        referral_code: referralCode
                    })
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    if (!data) {
                        console.error("No data returned from server");
                        return;
                    }

                    if (personalScInfoContainer) {
                        const scNameDisplay = personalScInfoContainer.querySelector(
                            ".scmember_personal_info_name p");
                        if (scNameDisplay) scNameDisplay.textContent = data.full_name || "N/A";
                    }
                    if (personalEditMode) {
                        const scNameEdit = personalEditMode.querySelector(".scmember_personal_info_name input");
                        if (scNameEdit) scNameEdit.value = data.full_name || "";
                    }

                    if (personalScInfoContainer) {
                        const scPhoneDisplay = personalScInfoContainer.querySelector(
                            ".scmember_personal_info_phone p");
                        if (scPhoneDisplay) scPhoneDisplay.textContent = data.phone || "N/A";
                    }
                    if (personalEditMode) {
                        const scPhoneEdit = personalEditMode.querySelector(".scmember_personal_info_phone input");
                        if (scPhoneEdit) scPhoneEdit.value = data.phone || "";
                    }

                    if (personalScInfoContainer) {
                        const scAddressDisplay = personalScInfoContainer.querySelector(
                            ".scmember_personal_info_state p");
                        if (scAddressDisplay) scAddressDisplay.textContent = data.address || "N/A";
                    }
                    if (personalEditMode) {
                        const scAddressEdit = personalEditMode.querySelector(
                            ".scmember_personal_info_state-edit .scmember-personal_address_header input");
                        if (scAddressEdit) scAddressEdit.value = data.address || "";
                    }

                    if (personalEditMode) {
                        const editedEmail = personalEditMode.querySelector(".scmember_personal_info_email input");
                        if (editedEmail) editedEmail.value = data.email || "";
                    }

                    if (additionAddressView) {
                        const streetInput = additionAddressView.querySelector("#scaddress-address");
                        const cityInput = additionAddressView.querySelector("#scaddress-city");
                        const stateInput = additionAddressView.querySelector("#scaddress-state");
                        const pincodeInput = additionAddressView.querySelector("#scaddress-pincode");

                        if (streetInput) streetInput.value = data.street || "";
                        if (cityInput) cityInput.value = data.district || "";
                        if (stateInput) stateInput.value = data.state || "";
                        if (pincodeInput) pincodeInput.value = data.pincode || "";
                    }

                    const dobDisplay = document.querySelector("#screferral-dob-fromprofile p");
                    const dobEdit = document.querySelector("#screferral-dob-fromprofile-editmode input");

                    if (dobDisplay) dobDisplay.textContent = data.dob || "N/A";
                    if (dobEdit) dobEdit.value = data.dob || "";
                })
                .catch((error) => {
                    console.error("Error retrieving data: ", error);
                });
        };

        const triggerExcelRegistration = () => {
            const excelUpload = document.getElementById("excel-upload-trigger");
            const excelUploadEvent = document.getElementById("excel-sheet-student-update");
            const fileNameDisplay = document.getElementById("selected-file-name");
            const fileUploadInfo = document.getElementById("file-upload-info");
            const removeFileBtn = document.getElementById("remove-excel-btn");
            const saveExcelFileBtn = document.getElementById("save-excelfile-btn");

            if (excelUpload) {
                excelUpload.addEventListener('click', () => {
                    if (excelUploadEvent) {
                        excelUploadEvent.click();
                    }
                });
            }

            if (excelUploadEvent) {
                excelUploadEvent.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        fileNameDisplay.value = `${file.name}`;
                        fileUploadInfo.style.display = "flex";
                    } else {
                        fileNameDisplay.value = "";
                        fileUploadInfo.style.display = "none";
                    }
                });
            }

            if (removeFileBtn) {
                removeFileBtn.addEventListener('click', () => {
                    fileNameDisplay.value = "";
                    excelUploadEvent.value = "";
                    fileUploadInfo.style.display = "none";
                });
            }

            if (saveExcelFileBtn) {
                saveExcelFileBtn.addEventListener('click', () => {
                    const formData = new FormData();
                    const file = excelUploadEvent.files[0];

                    if (!file) {
                        alert("Please select an Excel file to upload.");
                        return;
                    }

                    formData.append('excel_file', file);

                    const referralId = document.querySelector('#screferral-id-fromprofile span')?.textContent ||
                        '';
                    formData.append('referral_id', referralId); // ✅ Fixed key here

                    fetch('{{ route('students.import') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    ?.getAttribute('content') || ''
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message);
                            fileNameDisplay.value = "";
                            excelUploadEvent.value = "";
                            fileUploadInfo.style.display = "none";
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while uploading the file.');
                        });
                });
            }

        };


        const collectStudentData = async () => {


            const getRefCode = document.querySelector("#screferral-id-fromprofile span");
            const referralId = getRefCode ? getRefCode.textContent : '';

            if (!referralId) {
                console.error("Referral ID is missing");
                return;
            }



            const studentForms = document.querySelectorAll(".studentAddByScuserPopup-contentpart");
            const students = [];
            let hasInvalidEmail = false;
            let hasInvalidPhone = false;

            // Simple email format check
            const isValidEmail = (email) => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            };

            // Simple phone validation: 10 digits, numbers only
            const isValidPhone = (phone) => {
                return /^\d{10}$/.test(phone);
            };

            studentForms.forEach((form, index) => {
                const inputs = form.querySelectorAll("input");
                const student = {
                    name: inputs[0].value.trim(),
                    email: inputs[1].value.trim(),
                    phone: inputs[2].value.trim(),
                    password: inputs[3].value.trim(),
                    referral_code: referralId
                };

                // Email check
                if (student.email && !isValidEmail(student.email)) {
                    console.error(
                        `Invalid email for student ${index + 1} (${student.name || 'unnamed'}): "${student.email}"`
                    );
                    hasInvalidEmail = true;
                }

                // Phone check
                if (student.phone && !isValidPhone(student.phone)) {
                    console.error(
                        `Invalid phone number for student ${index + 1} (${student.name || 'unnamed'}): "${student.phone}"`
                    );
                    hasInvalidPhone = true;
                }

                if (student.name || student.email || student.phone || student.password) {
                    if (!student.name || !student.email || !student.phone || !student.password) {
                        console.error(`Missing field(s) for student ${index + 1}:`, student);
                    }

                    students.push(student);
                }
            });

            console.log("Student Data:", students);

            if (hasInvalidEmail) {
                console.warn("Some email addresses are invalid. Please fix them.");
                alert("Some email addresses are invalid. Please fix them.");
                return;
            }

            if (hasInvalidPhone) {
                console.warn("Some phone numbers are invalid. Please enter 10-digit numeric values.");
                alert("Some phone numbers are invalid. Please enter 10-digit numeric values.");
                return;
            }

            if (students.length === 0) {
                alert("No student data to save.");
                return;
            }

            try {
                const response = await fetch('/multipleregisterbyscuser', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        students
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    console.log("Success:", result.message);
                    alert("Students saved successfully!");
                    document.querySelectorAll(".studentAddByScuserPopup-contentpart").forEach(form => {
                        form.querySelectorAll("input").forEach(input => {
                            input.value = "";
                        });
                    });
                } else {
                    console.error("Error:", result.errors || result.message);

                    if (result.errors) {
                        let message = "Please correct the following errors:\n";

                        Object.entries(result.errors).forEach(([field, messages]) => {
                            const match = field.match(/^students\.(\d+)\.(\w+)$/);
                            if (match) {
                                const index = parseInt(match[1], 10) + 1;
                                const fieldName = match[2].charAt(0).toUpperCase() + match[2].slice(1);
                                message += `- Student ${index} - ${fieldName}: ${messages[0]}\n`;
                            } else {
                                message += `- ${messages[0]}\n`;
                            }
                        });

                        alert(message);
                    } else {
                        alert("Failed to save students: " + result.message);
                    }
                }

            } catch (error) {
                console.error("Network error:", error);
                alert("Network  error:.");
            }
        };


        function getStatusGroups() {
            const scuser = @json(session('scuser'));
            const scReferralId = scuser?.referral_code;
            const container = document.getElementById("student-applicationdetailsstatus");
            const paginationContainer = document.getElementById("pagination-container-statusgroups");

            if (!container || !paginationContainer || !scReferralId) {
                console.error("Missing required DOM elements or referral ID.");
                return;
            }

            fetch("/getstatusofusers", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute("content"),
                    },
                    body: JSON.stringify({
                        scReferralId
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data) && data.data.length > 0) {
                        const results = data.data;
                        const itemsPerPage = 2;
                        let currentPage = 1;

                        const renderPage = (page) => {
                            container.innerHTML = ""; // Clear previous content
                            const start = (page - 1) * itemsPerPage;
                            const end = start + itemsPerPage;
                            const paginatedItems = results.slice(start, end);

                            paginatedItems.forEach(student => {
                                const studentDiv = document.createElement("div");
                                studentDiv.className = "studentapplicationstatusreports-inscdashboard";
                                studentDiv.dataset.added = "";

                                // First Row
                                const firstRow = `
                        <div class="reportsindashboard-firstrow">
                            <div class="reportsindashboard-leftcontentinfirstrow">
                                <p>${student.userName}</p>
                                <span>Unique ID: ${student.user_id}</span>
                            </div>
                            <div class="reportsindashboard-rightcontentinfirstrow">
                                <div class="application-buttoncontainer reportsindashboard-buttoncontainer">
                                    <button class="expand-arrow-reportsindashboard" style="cursor:pointer">
                                        <img src="/assets/images/stat_minus_1.png" class="expand-arrow-rotation" alt="Collapse section icon" />
                                    </button>
                                </div>
                                <div class="application-shrinkwidtheditcontainer">
                                    <img src="/assets/images/Icons/edit_icon.png" style="display:none" alt="Edit report icon" />
                                </div>
                            </div>
                        </div>
                    `;

                                // Second Row
                                const secondRow = `
                        <div class="reportsindashboard-secondrow">
                            <p>Documents: ${getFinalStatus(student.nbfcs)}</p>
                            <p>Application Date: ${student.application_date }</p>
                            <p>Proposals received: ${student.nbfcs.length}</p>
                            <p>Total Duration: -</p>
                        </div>
                    `;

                                const proposalDetails = document.createElement("div");
                                proposalDetails.className = "reportsproposal-datalists";

                                student.nbfcs.forEach(nbfc => {
                                    nbfc.statuses.forEach(status => {
                                        const detailDiv = document.createElement("div");
                                        detailDiv.className =
                                            "reportsproposal-individualdatalists";
                                        detailDiv.innerHTML = `
                                <p>NBFC: &nbsp;&nbsp;${nbfc.nbfc_name}</p>
                                <p>Proposal Date: &nbsp;&nbsp;${formatDate(status.created_at)}</p>

                                <p id="reportspropsal-status-state" class="dynamic-status-hide">
                                    &nbsp;&nbsp;<span>${status.status_type}</span>
                                </p>
                            `;
                                        proposalDetails.appendChild(detailDiv);
                                    });
                                });

                                studentDiv.innerHTML += firstRow + secondRow;
                                studentDiv.appendChild(proposalDetails);
                                container.appendChild(studentDiv);
                            });

                            renderPagination();
                            triggeredButtons();
                        };

                        const renderPagination = () => {
                            paginationContainer.innerHTML = ""; // Clear old pagination
                            const totalPages = Math.ceil(results.length / itemsPerPage);

                            const createButton = (page, label = null, isActive = false) => {
                                const btn = document.createElement("button");
                                btn.textContent = label || page;
                                btn.disabled = isActive;
                                btn.className = isActive ? "active-page" : "inactive-page";
                                btn.addEventListener("click", () => {
                                    currentPage = page;
                                    renderPage(currentPage);
                                });
                                return btn;
                            };

                            if (currentPage > 1) {
                                paginationContainer.appendChild(createButton(currentPage - 1, "<"));
                            }

                            for (let i = 1; i <= totalPages; i++) {
                                paginationContainer.appendChild(createButton(i, null, i === currentPage));
                            }

                            if (currentPage < totalPages) {
                                paginationContainer.appendChild(createButton(currentPage + 1, ">"));
                            }
                        };

                        const getFinalStatus = (nbfcs) => {
                            for (const nbfc of nbfcs) {
                                for (const status of nbfc.statuses) {
                                    if (status.status_type) return status.status_type;
                                }
                            }
                            return "-";
                        };

                        renderPage(currentPage); // Start with first page
                    } else {
                        container.innerHTML = "<p>No application data found.</p>";
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    container.innerHTML = "<p>Error loading application data.</p>";
                });
        }
        const formatDate = (datetime) => {
            if (!datetime) return "-";
            const date = new Date(datetime);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        };


        function passwordForgotSc() {
            const forgotMailTrigger = document.querySelector(".footer-passwordchange p");

            if (forgotMailTrigger) {
                forgotMailTrigger.addEventListener('click', () => {

                    var user = @json(session('scuser'));
                    const email = user.email;
                    // alert(email);





                    fetch("/forgot-passwordmailsentsc", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                email: email
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.message) {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("There was an error while sending the email.");
                        });
                });
            }
        }

        function updateStartNewText() {
            const element = document.querySelector('.studentapplication-header .start-new');
            if (!element) return;

            if (window.innerWidth <= 767) {
                element.textContent = '+';
            } else {
                element.textContent = 'Start New Registration';
            }
        }


        function triggerDownloadTrigger() {
            const buttons = [
                document.getElementById('download-statusgroups-reports'),
                document.getElementById('mobwidthdownloadbutton')
            ];

            // Exit if neither button is found
            if (!buttons[0] && !buttons[1]) return;

            buttons.forEach(button => {
                if (!button) return;

                button.addEventListener('click', function() {
                    const scuser = @json(session('scuser'));

                    if (!scuser || !scuser.referral_code) {
                        alert('User referral code is missing in session!');
                        return;
                    }

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/export-user-status';
                    form.style.display = 'none';

                    // CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Referral Code input
                    const referralInput = document.createElement('input');
                    referralInput.type = 'hidden';
                    referralInput.name = 'scReferralId';
                    referralInput.value = scuser.referral_code;
                    form.appendChild(referralInput);

                    document.body.appendChild(form);
                    form.submit();
                });
            });
        }
    </script>
</body>

</html>
