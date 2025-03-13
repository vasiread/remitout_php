<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counsellor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/studentformquestionair.css') }}">

</head>

<body>

    @extends('layouts.app')

    @section('scdashboard')
            @php
$profileIconPath = "assets/images/account_circle.png";
$phoneIconPath = "assets/images/call.png";
$mailIconPath = "assets/images/mail.png";
$pindropIconPath = "assets/images/pin_drop.png";



$questions = [
    [
        'queries' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et",
        'queriesRaisedBy' => "Student",
        'date_added' => '2025-04-11'
    ],
    [
        'queries' => "worem ipsum dolor sit amet, consectetur elit, ",
        'queriesRaisedBy' => "NBFC",
        'date_added' => '2025-12-01'

    ],
    [
        'queries' => "Lorem ipsum dolor sit amet, consectetur elit, ",
        'queriesRaisedBy' => "Student",
        'date_added' => '2025-10-29'

    ],
    [
        'queries' => "oorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et ",
        'queriesRaisedBy' => "NBFC",
        'date_added' => '2023-09-01'

    ],
    [
        'queries' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et ",
        'queriesRaisedBy' => "Student",
        'date_added' => '2020-02-01'

    ],
];
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
                                <button> <img src="{{ asset('assets/images/dbicon.png') }}" alt="">Track Commission</button>
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
                                @foreach ($questions as $items)
                                    <div class="individual-raisedquestions" data-added="{{ $items['date_added']}}">
                                        <p id="queries-row">{{ $items['queries'] }}</p>
                                        <p id="query-raisedbyrow">{{ $items['queriesRaisedBy']}}</p>
                                    </div>
                                @endforeach





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
                        @foreach (array_chunk($studentDocumentDetailsInfo, $perPage, true) as $page => $students)
                            <div class="page-class student-page" data-page="{{ $page + 1 }}"
                                style="display: {{ $page == 0 ? 'block' : 'none' }};">
                                @foreach ($students as $student)
                                    <div class="studentapplicationstatusreports-inscdashboard"
                                        data-added="{{ $student['date_added'] }}">
                                        <div class="reportsindashboard-firstrow">
                                            <div class="reportsindashboard-leftcontentinfirstrow">
                                                <p>{{ $student['student_name'] }}</p>
                                                <span>Unique ID: HBJHKNJ776878</span>
                                            </div>
                                            <div class="reportsindashboard-rightcontentinfirstrow">
                                                <div class="application-buttoncontainer reportsindashboard-buttoncontainer">
                                                    <button id="reportsindashboard-firstrow-view" style="cursor:pointer">View</button>
                                                    <button id="reportsindashboard-firstrow-edit" style="cursor:pointer">Edit</button>
                                                    <button class="expand-arrow-reportsindashboard" style="cursor:pointer">
                                                        <img src="{{ asset('assets/images/stat_minus_1.png') }}" alt="">
                                                    </button>
                                                </div>
                                                <div class="application-shrinkwidtheditcontainer">
                                                    <img src="{{ asset('assets/images/Icons/edit_icon.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reportsindashboard-secondrow">
                                            <p>{{ $student['DocumentFinalStatus'] }}</p>
                                            <p>Application Date: {{ $student['DocumentFinalDate'] }}</p>
                                            <p>Proposals received: {{ $student['ProposalReceived'] }}</p>
                                            <p>Total Duration: {{ $student['TotalDuration'] }}</p>
                                        </div>
                                        <div class="reportsproposal-datalists">
                                            @foreach ($student['proposalDetailInfo'] as $proposal)
                                                <div class="reportsproposal-individualdatalists">
                                                    <p>NFBC: &nbsp;&nbsp;{{ $proposal['NBFC'] }}</p>
                                                    <p>Proposal Date: &nbsp;&nbsp;{{ $proposal['ProposalDate'] }}</p>
                                                    <p id="reportspropsal-status-state" class="dynamic-status-hide">
                                                        &nbsp;&nbsp;<span>{{ $proposal['Status'] }}</span>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Controls -->
                    <div class="pagination-controls studentapplicaton-datashownpagination">
                        <button id="prevstudents" onclick="prevdetail()">&lt;</button>
                        <div id="pages-container">
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <button class="page-class @if($i == 1) active @endif" id="page-{{ $i }}" data-page="{{ $i }}"
                                    onclick="pageTrigger(event)">
                                    {{ $i }}
                                </button>
                            @endfor
                        </div>
                        <button id="nextstudents" onclick="nextdetail()"> &gt; </button>
                        <button id="download-detailsid">Download report</button>
                    </div>



                </div>




            </div>
            <div class="studentAddBySCuserPopup">
                <div class="studentAddByScuserPopup-headerpart">
                    <h3>Register Students</h3>
                    <img src="{{ asset('assets/images/Icons/close_small.png') }}" alt="">
                </div>
                <div class="studentAddByScuserPopup-contentpart">
                    <input type="text" placeholder="Name of the Student">
                    <input type="text" placeholder="bankemail@gmail.com">
                    <input type="text" placeholder="password">
                    <button id="delete-student-row" style="cursor:pointer">Delete</button>
                    <button id="dynamic-add-student-button" style="cursor:pointer">Add Student</buttonstyle>

                </div>
                <div class="studentAddByScuserPopup-footerpart">

                    <button id='excel-upload-trigger' style="cursor:pointer">Upload xlsl <img
                            src="{{ asset('assets/images/Icons/upload.png') }}" /> </button>
                    <button style="cursor:pointer">Add Student</buttonstyle>
                        <button style="cursor:pointer">Save Student details</button>
                </div>
                <input type="file" id="excel-sheet-student-update" style="display:none">

            </div>

            <div class="referral-triggered-view">
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
            initializecheckStatus();

            initializeSortByFunctionQueries();
            initializeSortByFunctionApplicationStatus();
            initializeProfileUploadScuser();
            initializeProfileViewScuser();
            initializeScUserOneView();
            getUsersByCounsellor();
           const triggerExpandShrink = document.querySelectorAll("#reportsindashboard-firstrow-view");

            if (triggerExpandShrink) {
                triggerExpandShrink.forEach((items, index) => {

                    items.addEventListener("click",()=>{
 const progress = document.querySelectorAll(".reportsproposal-datalists");
                    if (progress[index].style.display === "flex") {
                        progress[index].style.display = "none";
                    } else {
                        progress[index].style.display = "flex";
                    }
                    })
                   
                });
            }

            const backgroundContainer = document.querySelector('.scdashboard-parentcontainer');


            const triggeredExcelStudentUploadAction = document.querySelector("#excel-sheet-student-update");
            const triggeredExcelStudentUploadButton = document.querySelector("#excel-upload-trigger");

        })

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

            })
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

        }
        const initializeSortByFunctionQueries = () => {
            const sortBy = document.querySelector(".queryraisedcontainer-rightcontent  #sort-by");

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
                        raisedQuestions.sort((a, b) => a.textContent.trim().localeCompare(b.textContent.trim()));
                    } else if (sortContentsType === 'alphabet-reverse') {
                        raisedQuestions.sort((a, b) => b.textContent.trim().localeCompare(a.textContent.trim()));
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

            // Hide the sort options initially
            if (sortByApplicationContent) {
                sortByApplicationContent.style.display = 'none';
            }

            // Sorting the student application elements
            sortedApplicationStudentLinks.forEach((item) => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortType = e.target.getAttribute('data-sort');
                    const sortedElementApplicationView = Array.from(studentContainer.querySelectorAll(".studentapplicationstatusreports-inscdashboard"));

                    // Sorting logic based on date_added (data-added attribute)
                    if (sortType === 'newest') {
                        sortedElementApplicationView.sort((a, b) => {
                            const dateA = new Date(a.getAttribute('data-added'));
                            const dateB = new Date(b.getAttribute('data-added'));
                            return dateB - dateA; // Newest first
                        });
                    } else if (sortType === 'oldest') {
                        sortedElementApplicationView.sort((a, b) => {
                            const dateA = new Date(a.getAttribute('data-added'));
                            const dateB = new Date(b.getAttribute('data-added'));
                            return dateA - dateB; // Oldest first
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

                    // Append sorted elements
                    sortedElementApplicationView.forEach((student) => {
                        studentContainer.appendChild(student);
                    });
                });
            });

            // Toggle application sorting options
            sortByApplication.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sortByApplicationContent) {
                    sortByApplicationContent.style.display = sortByApplicationContent.style.display === 'none' ? 'flex' : 'none';
                }
            });

            // Hide the sort options when clicking outside
            document.addEventListener('click', (e) => {
                if (sortByApplicationContent && sortByApplicationContent.style.display === "flex" && !sortByApplication.contains(e.target)) {
                    sortByApplicationContent.style.display = "none";
                }
            });
        }

        const letFirstPageActive = () => {
            const i = {{ $i }};
            const button = document.querySelector(`#page-id[data-page="${i}"]`);

            if (i === 1) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
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
                        element.firstChild.textContent = "Status: "; // Restore "Status:"
                    }
                });
            }
        };

        window.addEventListener('load', dynamicChangesWhileScreenShrink);
        window.addEventListener('resize', dynamicChangesWhileScreenShrink);


        const initializePopuAddingstudents = () => {
            const studentAddingPopuBar = document.querySelector(".studentAddBySCuserPopup");
            const popuAddingStudentTriggers = document.querySelectorAll(".studentapplication-header .start-new");
            const closePopuTrigger = document.querySelector(".studentAddByScuserPopup-headerpart img"); // Corrected querySelector

            popuAddingStudentTriggers.forEach(button => {

                button.addEventListener('click', () => {
                    if (studentAddingPopuBar) {
                        studentAddingPopuBar.style.display = 'flex';
                        backgroundContainer.classList.add('dull'); // Dull the background

                    }
                });

            })

            if (closePopuTrigger) {
                closePopuTrigger.addEventListener('click', () => {
                    if (studentAddingPopuBar) {
                        studentAddingPopuBar.style.display = "none"; // Hide the popup
                        backgroundContainer.classList.remove('dull'); // Dull the background

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



            statusElements.forEach(dynamicStatusColorChange => {
                if (dynamicStatusColorChange.textContent.includes("Approved")) {
                    dynamicStatusColorChange.style.color = "#3FA27E";
                    dynamicStatusColorChange.style.backgroundColor = "#D2FFEE";
                    dynamicStatusColorChange.style.width = "100%"
                    dynamicStatusColorChange.style.maxWidth = "95px"
                }

                else if (dynamicStatusColorChange.textContent.includes("Pending")) {
                    dynamicStatusColorChange.style.color = "#FA7B15";
                    dynamicStatusColorChange.style.backgroundColor = "#FFE3CA";
                    dynamicStatusColorChange.style.width = "100%";
                    dynamicStatusColorChange.style.maxWidth = "95px"

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
                    }
                    else if (index === 1) {
                        trackprogressContainer.style.display = "none";
                        scinboxContainer.style.display = "flex"
                        scapplicationStatus.style.display = "none";
                    }
                    else {
                        trackprogressContainer.style.display = "none";
                        scinboxContainer.style.display = "none";
                        scapplicationStatus.style.display = "flex";
                    }
                });
            });
        }

        let currentValue = 1;

        function pageTrigger(event) {
            const pageNumber = event.target.getAttribute("data-page");
            currentValue = parseInt(pageNumber);

            document.querySelectorAll(".student-page").forEach(page => {
                page.style.display = "none";
            });

            document.querySelector(`.student-page[data-page="${currentValue}"]`).style.display = "block";

            document.querySelectorAll(".page-class").forEach(button => {
                button.classList.remove("active");
            });
            event.target.classList.add("active");
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
            // console.log(referralId)

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
                    console.log(data);

                    const userListContainer = document.getElementById("user-list");
                    userListContainer.innerHTML = ""; // Clear previous content

                    if (data && data.length > 0) {
                        data.forEach((user) => {
                            const userHTML = `
                    <div class="studentapplication-lists">
                        <div class="individualapplication-list">
                            <div class="firstsection-lists">
                                <h1>${user.full_name}</h1> <!-- Displaying full_name -->
                                <div class="application-buttoncontainer">
                                    <button>View</button>
                                    <button>Edit</button>
                                    <button class="expand-arrow">
                                        <img src="/assets/images/stat_minus_1.png" alt="Expand">
                                    </button>
                                </div>
                                <button class="studenteacheditbutton">Edit</button>
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
                            userListContainer.innerHTML += userHTML; // Append user details to the container
                        });
                    } else {
                        userListContainer.innerHTML = "<p>No users found.</p>"; // If no users are returned
                    }
                })
                .catch(error => {
                    console.error("Error fetching users:", error);
                });
        };


        const generateReferLinkPopup = () => {
            const triggeredReferralButtons = document.querySelectorAll(".referral-Link-trigger-button, .referral-Link-trigger-anotherbutton");
            const referralTriggeredView = document.querySelector(".referral-triggered-view");
            const closeReferralTriggerView = document.querySelector(".referral-triggered-view-headersection img");

            triggeredReferralButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (referralTriggeredView) {
                        referralTriggeredView.style.display = "flex";
                        backgroundContainer.classList.add('dull'); // Dull the background

                    }
                });
            });
            if (closeReferralTriggerView) {
                closeReferralTriggerView.addEventListener('click', () => {
                    if (referralTriggeredView) {
                        referralTriggeredView.style.display = "none";
                        backgroundContainer.classList.remove('dull'); // Dull the background

                    }
                })
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
                return; // Stop the execution if any field is missing, preventing fetch
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
                    console.log(data)
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



    </script>

</body>

</html>