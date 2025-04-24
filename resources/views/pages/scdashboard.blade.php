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
$profileIconPath = "assets/images/account_circle.png";
$phoneIconPath = "assets/images/call.png";
$mailIconPath = "assets/images/mail.png";
$pindropIconPath = "assets/images/pin_drop.png";







$proposalsInfo = [
    [
        'NBFC' => 'NBFC Name',
        'ProposalDate' => '20/11/2024',
        'Status' => 'Approved'

    ],
    [
        'NBFC' => 'NBFC Name',
        'ProposalDate' => '20/11/2024',
        'Status' => 'Pending'

    ],

];



$studentDocumentDetailsInfo = [
    ['student_name' => 'Manish', 'DocumentFinalStatus' => 'Missing Documents: 01', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-07-01'],
    ['student_name' => 'Kumar', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2022-02-01'],
    ['student_name' => 'Raji', 'DocumentFinalStatus' => 'Missing Documents: 12', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-12-04'],
    ['student_name' => 'Venkatesh', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-02-01'],
    ['student_name' => 'Ramya', 'DocumentFinalStatus' => 'Missing Documents: 03', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-02-09'],
    ['student_name' => 'Chinna', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2025-07-20'],
    ['student_name' => 'Feroz', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-02-21'],
    ['student_name' => 'Ramesh', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2022-07-29'],
    ['student_name' => 'Vasi', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-09-30'],
    ['student_name' => 'Aari', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-10-01'],
    ['student_name' => 'Abinav', 'DocumentFinalStatus' => 'Missing Documents: 02', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2022-07-01'],


];



            @endphp
            <div class="scdashboard-parentcontainer">
                <div class="commonsidebar-togglesidebar">
                    <ul class="commonsidebar-sidebarlists-top">
                        @foreach($sidebarItems as $item)
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
                            <img src="{{ asset('assets/images/Icons/support_agent.png') }}" alt=""> Support
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
                                        alt=""> Referral Code:
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
                                        alt=""> Referral Code:
                                    45628</button>
                                <button style="display:none"> <img src="{{ asset('assets/images/dbicon.png') }}" alt="">Track
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
                                    <button class="start-new">Start New Registration</button>
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
                            <img src="{{asset('assets/images/image-women.jpeg')}}" id="studentcounsellor-profile" alt="">
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
                            <p></p>

                        </div>
                        <div id="screferral-dob-fromprofile-editmode" inputmode="Date">
                            <i class="fa-solid fa-calendar"></i>
                            <input type="text">

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
                                <p>{{ session('scuser')->email}}</p>
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
                            <button class="edit-scuser">Edit</button>
                            <button class="save-scuser">Save</button>
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
                                    <button id="raised-query">Raise Query</button>

                                </div>

                            </div>
                            <div class="groupofraisedquestion-scdashboard">
                                <p>Loading queries...</p>
                            </div>


                        </div>



                    </div>

                </div>
                <div class="scdashboard-applicationstatus">
                    <div class="scapplicationstatus-firstrow">
                        <h1>Applications</h1>
                        <div class="firstrowapplication-rightsidecontent">
                            <button id="applicationstatus-sortby">Sort by <img src="assets/images/Icons/swap_vert.png" />
                            </button>
                            <div class="sort-by-contents-applications-studentnames">
                                <a href="" data-sort="newest">Newest</a>
                                <a href="" data-sort="oldest">Oldest</a>
                                <a href="" data-sort="alphabet">A-Z</a>
                                <a href="" data-sort="alphabet-reverse">Z-A</a>
                            </div>
                            <button id="mobwidthdownloadbutton">
                                <img src="{{asset("assets/images/Icons/download-orange.png")}}" alt="">
                            </button>
                            <button id="sc-new-application-generate">Start New Application</button>
                        </div>
                    </div>
                    @php
$perPage = 3;
$totalStudents = count($studentDocumentDetailsInfo);
$totalPages = ceil($totalStudents / $perPage);  
                    @endphp

                    <div id="student-applicationdetailsstatus">

                    </div>




                </div>
            </div>

            <div class="studentAddBySCuserPopup">
                <div class="studentAddByScuserPopup-headerpart">
                    <h3>Register Students</h3>
                    <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="">
                </div>
                <div class="studentAddByScuserPopup-content-container">
                    <div class="studentAddByScuserPopup-contentpart">
                        <input type="text" placeholder="Name of the Student">
                        <input type="text" placeholder="bankemail@gmail.com">
                        <input type="text" placeholder="phone">
                        <input type="text" placeholder="password">
                        <button id="delete-student-row" style="cursor:pointer">Delete</button>
                        <button id="dynamic-add-student-button" style="cursor:pointer">Add Student</button>
                    </div>
                </div>
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

            <div class="referral-triggered-view" style="display:none">
                <div class="referral-triggered-view-headersection">
                    <h3>Generate Referral Link</h3>
                    <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="">

                </div>
                <div class="referral-triggered-view-content">
                    <input type="input" placeholder="Copy Link here">
                </div>
                <div class="referral-triggered-view-footer">
                    <button> <img src="{{ asset('assets/images/Icons/close_icon.png') }}" /> Cancel</button>
                    <button>Generate</button>
                </div>

            </div>

    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializescsidebar();
            initializePopuAddingstudents();
            generateReferLinkPopup();
            addDynamicInputFields();

            initializeSortByFunctionQueries();
            initializeSortByFunctionApplicationStatus();
            initializeProfileUploadScuser();
            initializeProfileViewScuser();
            initializeScUserOneView();
            getUsersByCounsellor();
            triggerExcelRegistration();
            queryDetails();




        })
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

        window.addEventListener('resize', function () {
            const triggeredSideBar = document.querySelector(".commonsidebar-togglesidebar");
            const img = document.querySelector("#scuser-dashboard-menu img");

            if (window.innerWidth < 768) {
                if (img.src.includes("menu.png")) {
                    img.src = '{{ asset('assets/images/Icons/close_icon.png') }}';
                }
            } else if (window.innerWidth > 768) {
                triggeredSideBar.style.backgroundColor = '';
                triggeredSideBar.style.display = "flex";
            }
        });

        const initializeQueryModal = () => {
            const raiseQueryBtn = document.querySelector('#raised-query');
            const modal = document.querySelector('#query-modal');
            const backdrop = document.querySelector('#backdrop');
            const closeBtn = document.querySelector('#query-modal-close');
            const cancelBtn = document.querySelector('#query-cancel');
            const form = document.querySelector('#query-form');
            const backgroundContainer = document.querySelector('.scdashboard-parentcontainer');

            if (!raiseQueryBtn || !modal || !backdrop || !closeBtn || !cancelBtn || !form) {
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(queryData)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Add new query to the DOM
                            const querysContainer = document.querySelector('.groupofraisedquestion-scdashboard');
                            const newQuery = document.createElement('div');
                            newQuery.classList.add('individual-raisedquestions');
                            newQuery.setAttribute('data-added', queryData.date_added);
                            newQuery.innerHTML = `
                                <p id="queries-row">${queryData.queryText}</p>
                                <p id="query-raisedbyrow">${queryData.queryType}</p>
                            `;
                            querysContainer.prepend(newQuery);
                            closeModal();
                            alert('Query submitted successfully!');
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
            const profileUploadForScTriggerShower = document.querySelector('.scdashboard-performancecontainer .performancecontainer-firstrow .edit-scuser');
            const scUserInfoUpdationSaver = document.querySelector('.scdashboard-performancecontainer .performancecontainer-firstrow .save-scuser');
            const profileUploadForScTrigger = document.querySelector('.scmember-profilecontainerimg i');
            const profileUploadToCloud = document.getElementById('sc-profile-upload-cloud');
            const profileViewInstantChange = document.getElementById("studentcounsellor-profile");
            const editStateProfileinfo = document.querySelector(".scmember_personalinfo_editmode");
            const editStateProfiledob = document.getElementById("screferral-dob-fromprofile-editmode");
            const Profileinfo = document.querySelector(".scmember_personalinfo");
            const Profiledob = document.getElementById("screferral-dob-fromprofile");

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

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
                                    throw new Error(errorData.error || 'Network response was not ok');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data) {
                                console.log("File uploaded successfully", data);
                                if (profileViewInstantChange) profileViewInstantChange.src = data.file_path;
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
                body: JSON.stringify({ scuserrefid: scUserRefId })
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
                    const raisedQuestions = Array.from(querysContainer.querySelectorAll('.individual-raisedquestions'));

                    if (sortContentsType === 'newest') {
                        raisedQuestions.sort((a, b) => new Date(b.dataset.added) - new Date(a.dataset.added));
                    } else if (sortContentsType === 'oldest') {
                        raisedQuestions.sort((a, b) => new Date(a.dataset.added) - new Date(b.dataset.added));
                    } else if (sortContentsType === 'alphabet') {
                        raisedQuestions.sort((a, b) => a.querySelector('#queries-row').textContent.trim().localeCompare(b.querySelector('#queries-row').textContent.trim()));
                    } else if (sortContentsType === 'alphabet-reverse') {
                        raisedQuestions.sort((a, b) => b.querySelector('#queries-row').textContent.trim().localeCompare(a.querySelector('#queries-row').textContent.trim()));
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
            const sortedApplicationStudentLinks = document.querySelectorAll(".sort-by-contents-applications-studentnames a");
            const studentContainer = document.querySelector("#student-applicationdetailsstatus");

            if (sortByApplicationContent) {
                sortByApplicationContent.style.display = 'none';
            }

            sortedApplicationStudentLinks.forEach((item) => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortType = e.target.getAttribute('data-sort');
                    const sortedElementApplicationView = Array.from(studentContainer.querySelectorAll(".studentapplicationstatusreports-inscdashboard"));

                    if (sortType === 'newest') {
                        sortedElementApplicationView.sort((a, b) => {
                            const dateA = new Date(a.getAttribute('data-added'));
                            const dateB = new Date(b.getAttribute('data-added'));
                            return dateB - dateA;
                        });
                    } else if (sortType === 'oldest') {
                        sortedElementApplicationView.sort((a, b) => {
                            const dateA = new Date(a.getAttribute('data-added'));
                            const dateB = new Date(b.getAttribute('data-added'));
                            return dateA - dateB;
                        });
                    } else if (sortType === 'alphabet') {
                        sortedElementApplicationView.sort((a, b) =>
                            a.querySelector('.reportsindashboard-leftcontentinfirstrow p').textContent.trim().localeCompare(
                                b.querySelector('.reportsindashboard-leftcontentinfirstrow p').textContent.trim()
                            )
                        );
                    } else if (sortType === 'alphabet-reverse') {
                        sortedElementApplicationView.sort((a, b) =>
                            b.querySelector('.reportsindashboard-leftcontentinfirstrow p').textContent.trim().localeCompare(
                                a.querySelector('.reportsindashboard-leftcontentinfirstrow p').textContent.trim()
                            )
                        );
                    }

                    sortedElementApplicationView.forEach((student) => {
                        studentContainer.appendChild(student);
                    });
                });
            });

            sortByApplication.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sortByApplicationContent) {
                    sortByApplicationContent.style.display = sortByApplicationContent.style.display === 'none' ? 'flex' : 'none';
                }
            });

            document.addEventListener('click', (e) => {
                if (sortByApplicationContent && sortByApplicationContent.style.display === "flex" && !sortByApplication.contains(e.target)) {
                    sortByApplicationContent.style.display = "none";
                }
            });
        }
        const dynamicChangesWhileScreenShrink = () => {
            const contentChangeButton = document.querySelector(".scdashboard-applicationstatus .scapplicationstatus-firstrow #sc-new-application-generate");
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

 
            popuAddingStudentTriggers.forEach(button => {
                button.addEventListener('click', () => {
                    if (studentAddingPopuBar) {
                        studentAddingPopuBar.style.display = 'flex';
                        backgroundContainer.classList.add('dull');
                    }
                });

            })
            if (popuAddingStudentTriggersApplications) {
                popuAddingStudentTriggersApplications.addEventListener('click', () => {
                    if (studentAddingPopuBar) {
                        studentAddingPopuBar.style.display = 'flex';
                        backgroundContainer.classList.add('dull');

                    }

                })
            }

            if (closePopuTrigger) {
                closePopuTrigger.addEventListener('click', () => {
                    if (studentAddingPopuBar) {
                        studentAddingPopuBar.style.display = "none";
                        backgroundContainer.classList.remove('dull');
                    }
                });
            }
        };

        const addDynamicInputFields = () => {
            const addStudentButtons = document.querySelectorAll(".studentAddByScuserPopup-footerpart button:nth-child(2), .studentAddByScuserPopup-contentpart #dynamic-add-student-button");
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
            const applicationStatusElements = document.querySelectorAll(".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
            const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

            applicationStatusElements.forEach((items, index) => {
                if (items.textContent.includes("Accepted")) {
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

            statusElements.forEach(dynamicStatusColorChange => {
                if (dynamicStatusColorChange.textContent.includes("Accepted")) {
                    dynamicStatusColorChange.textContent = "Approved";
                    dynamicStatusColorChange.style.color = "#3FA27E";
                    dynamicStatusColorChange.style.backgroundColor = "#D2FFEE";
                    dynamicStatusColorChange.style.width = "100%"
                    dynamicStatusColorChange.style.maxWidth = "95px"
                }
                else if (dynamicStatusColorChange.textContent.includes("Rejected")) {
                    dynamicStatusColorChange.textContent = "Rejected";
                    // dynamicStatusColorChange.style.color = "#3FA27E";
                    // dynamicStatusColorChange.style.backgroundColor = "#D2FFEE";
                    dynamicStatusColorChange.style.width = "100%"
                    dynamicStatusColorChange.style.maxWidth = "95px"
                }

                else if (dynamicStatusColorChange.textContent.includes("Pending")) {
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
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ referralId })
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

            if (data && data.length > 0) {
                data.forEach((user, index) => {
                    const isHidden = index >= 3 ? 'style="display:none"' : '';
                    const userHTML = `
                        <div class="studentapplication-lists user-item" ${isHidden}>
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
                                    <p>NBFC Name</p>
                                </li>
                                <li class="scdashboard-nbfcstatus-pending">
                                    <p>Status:</p>
                                    <span>Pending</span>
                                </li>
                                <li class="scdashboard-missingdocumentsstatus">
                                    <p>Missing Documents:</p>
                                    <span>03</span>
                                </li>
                            </ul>
                        </div>
                    `;
                    userListContainer.innerHTML += userHTML;
                });

                // Enable "See all" functionality
                const seeAllBtn = document.querySelector(".see-all");
                if (seeAllBtn) {
                    seeAllBtn.style.display = "inline-block"; // Ensure it's visible
                    seeAllBtn.addEventListener("click", () => {
                        document.querySelectorAll(".user-item").forEach(item => {
                            item.style.display = "block";
                        });
                        seeAllBtn.style.display = "none"; // Hide button after showing all
                    });
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
            // DOM Elements
            const triggeredReferralButtons = document.querySelectorAll(".referral-Link-trigger-button, .referral-Link-trigger-anotherbutton");
            const referralTriggeredView = document.querySelector(".referral-triggered-view");
            const closeReferralTriggerView = document.querySelector(".referral-triggered-view-headersection img");
            const generateButton = document.querySelector(".referral-triggered-view-footer button:nth-child(2)"); // "Generate"
            const cancelButton = document.querySelector(".referral-triggered-view-footer button:nth-child(1)"); // "Cancel"
            const referralInput = document.querySelector(".referral-triggered-view-content input");
            const backgroundContainer = document.querySelector(".scdashboard-parentcontainer");
            const referralCodeElement = document.querySelector("#screferral-id-fromprofile span");

            // Base URL for local development
            const baseUrl = "http://localhost:8000/signup";

            // Secret key for encryption (keep this secure and consistent)
            const secretKey = "rJXU0e4lTP7G+KP9dH5V1pq9P7vP8d8sravZmzMGUKM="; // Replace with a strong, unique key

            // Validation: Check if critical elements exist
            if (!triggeredReferralButtons.length || !referralTriggeredView || !referralInput || !backgroundContainer || !referralCodeElement) {
                console.error("Required DOM elements are missing for generateReferLinkPopup:", {
                    triggeredReferralButtons: !!triggeredReferralButtons.length,
                    referralTriggeredView: !!referralTriggeredView,
                    referralInput: !!referralInput,
                    backgroundContainer: !!backgroundContainer,
                    referralCodeElement: !!referralCodeElement
                });
                return;
            }

            // Check if CryptoJS is loaded
            if (typeof CryptoJS === "undefined") {
                console.error("CryptoJS library is not loaded. Please include it in your HTML.");
                return;
            }

            // Get referral code
            const referralCode = referralCodeElement.textContent.trim();
            if (!referralCode) {
                console.error("Referral code is empty or not found");
                return;
            }

            // Encrypt the referral code using AES
            const encryptedRef = CryptoJS.AES.encrypt(referralCode, secretKey).toString();
            const encodedEncryptedRef = encodeURIComponent(encryptedRef); // URL-safe encoding

            // Construct referral link with encrypted ref
            const referralLink = `${baseUrl}?ref=${encodedEncryptedRef}`;

            // Helper function to remove existing listeners (prevent stacking)
            const removeExistingListeners = (element, event, handler) => {
                element.removeEventListener(event, handler);
                element.addEventListener(event, handler);
            };

            // Show popup
            triggeredReferralButtons.forEach(button => {
                const showPopup = () => {
                    referralTriggeredView.style.display = "flex";
                    backgroundContainer.classList.add("dull");
                    referralInput.value = ""; // Reset input
                };
                removeExistingListeners(button, "click", showPopup);
            });

            // Hide popup (shared logic for close and cancel)
            const hidePopup = () => {
                referralTriggeredView.style.display = "none";
                backgroundContainer.classList.remove("dull");
            };

            // Close button
            if (closeReferralTriggerView) {
                removeExistingListeners(closeReferralTriggerView, "click", hidePopup);
            }

            // Cancel button
            if (cancelButton) {
                removeExistingListeners(cancelButton, "click", hidePopup);
            }

            // Generate button
            if (generateButton) {
                const generateLink = async () => {
                    referralInput.value = referralLink;
                    try {
                        // Use modern Clipboard API
                        await navigator.clipboard.writeText(referralLink);
                        alert("Referral link copied to clipboard!");
                    } catch (err) {
                        console.warn("Clipboard copy failed:", err);
                        // Fallback for older browsers
                        referralInput.select();
                        if (document.execCommand("copy")) {
                            alert("Referral link copied to clipboard!");
                        } else {
                            alert("Please copy the link manually.");
                        }
                    }
                };
                removeExistingListeners(generateButton, "click", generateLink);
            }
        };


        const queryDetails = () => {
            const scuser = @json(session('scuser'));
            const scuserid = scuser.referral_code;

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then((response) => response.json())
                    .then((data) => {
                        const container = document.querySelector(".groupofraisedquestion-scdashboard");
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






        const updateScUserProfileInfos = () => {
            const personalEditMode = document.querySelector(".scmember_personalinfo_editmode");
            const personalScInfoContainer = document.querySelector(".scmember_personalinfo");
            const scRefNo = document.querySelector("#screferral-id-fromprofile span").textContent;
            const updatedScName = personalEditMode.querySelector(".scmember_personal_info_name input").value;
            const updatedScDob = document.querySelector("#screferral-dob-fromprofile-editmode input").value;
            const updatedScPhone = personalEditMode.querySelector(".scmember_personal_info_phone input").value;
            const updatedScAddress = personalEditMode.querySelector(".scmember_personal_info_state-edit .subbranch-of-address");
            const Profiledob = document.getElementById("screferral-dob-fromprofile");
            const editStateProfiledob = document.getElementById("screferral-dob-fromprofile-editmode");
            const profileUploadForScTriggerShower = document.querySelector('.scdashboard-performancecontainer .performancecontainer-firstrow .edit-scuser');
            const scUserInfoUpdationSaver = document.querySelector('.scdashboard-performancecontainer .performancecontainer-firstrow .save-scuser');

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
                body: JSON.stringify({ referral_code: referralCode })
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    if (!data) {
                        console.error("No data returned from server");
                        return;
                    }

                    if (personalScInfoContainer) {
                        const scNameDisplay = personalScInfoContainer.querySelector(".scmember_personal_info_name p");
                        if (scNameDisplay) scNameDisplay.textContent = data.full_name || "N/A";
                    }
                    if (personalEditMode) {
                        const scNameEdit = personalEditMode.querySelector(".scmember_personal_info_name input");
                        if (scNameEdit) scNameEdit.value = data.full_name || "";
                    }

                    if (personalScInfoContainer) {
                        const scPhoneDisplay = personalScInfoContainer.querySelector(".scmember_personal_info_phone p");
                        if (scPhoneDisplay) scPhoneDisplay.textContent = data.phone || "N/A";
                    }
                    if (personalEditMode) {
                        const scPhoneEdit = personalEditMode.querySelector(".scmember_personal_info_phone input");
                        if (scPhoneEdit) scPhoneEdit.value = data.phone || "";
                    }

                    if (personalScInfoContainer) {
                        const scAddressDisplay = personalScInfoContainer.querySelector(".scmember_personal_info_state p");
                        if (scAddressDisplay) scAddressDisplay.textContent = data.address || "N/A";
                    }
                    if (personalEditMode) {
                        const scAddressEdit = personalEditMode.querySelector(".scmember_personal_info_state-edit .scmember-personal_address_header input");
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

                    fetch('{{ route("students.import") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
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
                    password: inputs[3].value.trim()
                };

                // Email check
                if (student.email && !isValidEmail(student.email)) {
                    console.error(`Invalid email for student ${index + 1} (${student.name || 'unnamed'}): "${student.email}"`);
                    hasInvalidEmail = true;
                }

                // Phone check
                if (student.phone && !isValidPhone(student.phone)) {
                    console.error(`Invalid phone number for student ${index + 1} (${student.name || 'unnamed'}): "${student.phone}"`);
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
                    body: JSON.stringify({ students })
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
                alert("An error occurred while saving students.");
            }
        };


        function getStatusGroups() {
            const scuser = @json(session('scuser'));
            const scReferralId = scuser.referral_code;
            const container = document.getElementById("student-applicationdetailsstatus");

            fetch("/getstatusofusers", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute("content")
                },
                body: JSON.stringify({ scReferralId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        data.data.forEach(student => {
                            const studentDiv = document.createElement("div");
                            studentDiv.className = "studentapplicationstatusreports-inscdashboard";
                            studentDiv.setAttribute("data-added", "");
                            console.log(student)

                            const firstRow = `
                        <div class="reportsindashboard-firstrow">
                            <div class="reportsindashboard-leftcontentinfirstrow">
                                <p>${student.userName}</p>
                                <span>Unique ID: ${student.user_id}</span>
                            </div>
                            <div class="reportsindashboard-rightcontentinfirstrow">
                                <div class="application-buttoncontainer reportsindashboard-buttoncontainer">
                                        <button class="expand-arrow-reportsindashboard" style="cursor:pointer">
                                        <img src="/assets/images/stat_minus_1.png" class="expand-arrow-rotation" alt="">
                                    </button>
                                </div>
                                <div class="application-shrinkwidtheditcontainer">
                                    <img src="/assets/images/Icons/edit_icon.png" style="display:none" alt="">
                                </div>
                            </div>
                        </div>
                    `;

                            const secondRow = `
                        <div class="reportsindashboard-secondrow">
                            <p>Documents: ${getFinalStatus(student.nbfcs)}</p>
                            <p>Application Date: -</p>
                            <p>Proposals received: ${student}</p>
                            <p>Total Duration: -</p>
                        </div>
                    `;
                            console.log(student)

                            const proposalDetails = document.createElement("div");
                            proposalDetails.className = "reportsproposal-datalists";

                            student.nbfcs.forEach(nbfc => {
                                nbfc.statuses.forEach(status => {
                                    const detailDiv = document.createElement("div");
                                    detailDiv.className = "reportsproposal-individualdatalists";
                                    detailDiv.innerHTML = `
                                <p>NFBC: &nbsp;&nbsp;${nbfc.nbfc_name}</p>
                                <p>Proposal Date: &nbsp;&nbsp;${status.created_at ?? '-'}</p>
                                <p id="reportspropsal-status-state" class="dynamic-status-hide">
                                    &nbsp;&nbsp;<span>${status.status_type}</span>
                                </p>
                            `;
                                    proposalDetails.appendChild(detailDiv);
                                });
                            });

                            studentDiv.innerHTML += firstRow;
                            studentDiv.innerHTML += secondRow;
                            studentDiv.appendChild(proposalDetails);
                            container.appendChild(studentDiv);

                        });
                        triggeredButtons();

                    } else {
                        container.innerHTML = "<p>No application data found.</p>";
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    container.innerHTML = "<p>Error loading application data.</p>";
                });

            function getFinalStatus(nbfcs) {
                for (const nbfc of nbfcs) {
                    for (const status of nbfc.statuses) {
                        if (status.status_type) {
                            return status.status_type;
                        }
                    }
                }
                return "-";
            }

        }




    </script>
</body>

</html>