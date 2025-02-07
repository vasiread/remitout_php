<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counsellor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

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
                'queriesRaisedBy' => "Student"
            ],
            [
                'queries' => "Lorem ipsum dolor sit amet, consectetur elit, ",
                'queriesRaisedBy' => "NBFC"
            ],
            [
                'queries' => "Lorem ipsum dolor sit amet, consectetur elit, ",
                'queriesRaisedBy' => "Student"
            ],
            [
                'queries' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et ",
                'queriesRaisedBy' => "NBFC"
            ],
            [
                'queries' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et ",
                'queriesRaisedBy' => "Student"
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
            ['DocumentFinalStatus' => 'Missing Documents: 01', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Missing Documents: 12', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Missing Documents: 03', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],
            ['DocumentFinalStatus' => 'Missing Documents: 02', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo],


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
                        <button>Generate Referral Link</button>
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
                        <button id="mobgeneratedbutton">Generate Referral Link</button>
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
                            +
                        </div>

                    </div>

                    <div class="studentapplication-lists">
                        <div class="individualapplication-list">
                            <div class="firstsection-lists">
                                <h1>Student name</h1>
                                <div class="application-buttoncontainer">
                                    <button>View</button>
                                    <button>Edit</button>
                                    <button class="expand-arrow"> <img
                                            src="{{ asset('assets/images/stat_minus_1.png') }}" alt=""></button>
                                </div>
                                <button class="studenteacheditbutton">
                                    Edit

                                </button>
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
                                <span>03</span>
                            </li>
                        </ul>

                    </div>
                    <div class="studentapplication-lists">
                        <div class="individualapplication-list">
                            <div class="firstsection-lists">
                                <h1>Student name</h1>
                                <div class="application-buttoncontainer">
                                    <button>View</button>
                                    <button>Edit</button>
                                    <button class="expand-arrow"> <img
                                            src="{{ asset('assets/images/stat_minus_1.png') }}" alt=""></button>
                                </div>
                                <button class="studenteacheditbutton">
                                    Edit

                                </button>
                            </div>
                        </div>
                        <ul class="individualstudentapplication-status">
                            <li class="scdashboard-nbfcnamecontainer">
                                <p>NBFC:</p>
                                <p>NBFC name</p>

                            </li>
                            <li class="scdashboard-nbfcstatus-pending">
                                <p>Status:</p>
                                <span>Approved</span>

                            </li>
                            <li class="scdashboard-missingdocumentsstatus">
                                <p>Missing Documents:</p>
                                <span>03</span>
                            </li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
        <div class="scdashboard-inboxcontent">
            <div class="scmember-profilecontainer">
                <div class="scmember-profilecontainerimg">
                    <img src="assets/images/image-women.jpeg" id="studentcounsellor-profile" alt="">

                </div>
                <div class="scmember-rowfirst">
                    <h1>Student Counsellor</h1>
                    <button>Edit</button>
                </div>
                <p id="screferral-id-fromprofile">Referral Number: <span>HYU67994003</span></p>
                <div id="screferral-dob-fromprofile">
                    <i class="fa-solid fa-calendar"></i>
                    <p>DD/MM/YYY</p>

                </div>
                <ul class="scmember_personalinfo">

                    <li class="scmember_personal_info_name" id="referenceNeId"><img src="{{$profileIconPath}}" alt="">
                        <p>Jackline Kella </p>
                    </li>
                    <li class="scmember_personal_info_phone"><img src={{$phoneIconPath}} alt="">
                        <p>+91 76374 86793 </p>
                    </li>
                    <li class="scmember_personal_info_email" id="referenceEmailId">
                        <img src="{{$mailIconPath}}" alt="">
                        <p>jakkella@gmail.com </p>
                    </li>
                    <li class="scmember_personal_info_state"><img src="{{$pindropIconPath}}" alt="">
                        <p>234, Sweet Life Apt., Cross Rd, Bengaluru, Karnataka 560982</p>
                    </li>

                </ul>

            </div>
            <div class="scdashboard-performancecontainer">
                <div class="performancecontainer-firstrow">
                    <h3>Performance</h3>
                    <button>Edit</button>
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
                            <button id="sort-by">
                                <p>Sort by</p> <img src="assets/images/Icons/swap_vert.png" />
                            </button>
                            <button id="raised-query">Raise Query</button>

                        </div>

                    </div>
                    <div class="groupofraisedquestion-scdashboard">
                        @foreach ($questions as $items)
                            <div class="individual-raisedquestions">
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
                            <div class="studentapplicationstatusreports-inscdashboard">
                                <div class="reportsindashboard-firstrow">
                                    <div class="reportsindashboard-leftcontentinfirstrow">
                                        <p>Student name</p>
                                        <span>Unique ID: HBJHKNJ776878</span>
                                    </div>
                                    <div class="reportsindashboard-rightcontentinfirstrow">
                                        <div class="application-buttoncontainer reportsindashboard-buttoncontainer">
                                            <button id="reportsindashboard-firstrow-view">View</button>
                                            <button id="reportsindashboard-firstrow-edit">Edit</button>
                                            <button class="expand-arrow-reportsindashboard">
                                                <img src="{{ asset('assets/images/stat_minus_1.png') }}" alt="">
                                            </button>
                                        </div>
                                        <div class="application-shrinkwidtheditcontainer">
                                            <img src="{{asset("assets/images/Icons/edit_icon.png")}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="reportsindashboard-secondrow">
                                    <p>{{ $student['DocumentFinalStatus'] }}</p>
                                    <p>Application Date : {{ $student['DocumentFinalDate'] }}</p>
                                    <p>Proposals received : {{ $student['ProposalReceived'] }}</p>
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
                @for ($i = 1; $i <= $totalPages; $i++)
                    <button class="page-class @if($i == 1) active @endif" id="page-id" data-page="{{ $i }}"
                        onclick="pageTrigger(event)">
                        {{ $i }}
                    </button>


                @endfor
                <button id="nextstudents" onclick="nextdetail()"> &gt; </button>
                <button id="download-detailsid">Download report</button>

            </div>


        </div>


    </div>

    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializescsidebar();
            initializecheckStatus();
            initializePagination();
            letFirstPageActive();


        })

        window.addEventListener('resize', function () {
            const triggeredSideBar = document.querySelector(".commonsidebar-togglesidebar");
            const img = document.querySelector("#scuser-dashboard-menu img");


            if (window.innerWidth < 640) {
                if (img.src.includes("menu.png")) {
                    img.src = '{{ asset('assets/images/Icons/close_icon.png') }}';
                }

            } else if (window.innerWidth > 640) {
                triggeredSideBar.style.backgroundColor = '';
                triggeredSideBar.style.display = "flex";


            }
        });


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


        const initializecheckStatus = () => {
            const statusElements = document.querySelectorAll(".reportsproposal-individualdatalists p span");
            const applicationStatusElements = document.querySelectorAll(".individualstudentapplication-status .scdashboard-nbfcstatus-pending span");
            const missingDocumentsCount = document.querySelectorAll(".scdashboard-missingdocumentsstatus");

            applicationStatusElements.forEach((items, index) => {
                // Check if the status contains "Approved"
                if (items.textContent.includes("Approved")) {
                    items.style.color = "#3FA27E";
                    items.style.backgroundColor = "#D2FFEE";

                    // Hide the corresponding missing documents container
                    if (missingDocumentsCount[index]) {
                        missingDocumentsCount[index].style.display = "none";
                    }
                } else {
                    // Show the missing documents container if not approved
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

                    if (window.innerWidth <= 640) {
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






    </script>

</body>

</html>