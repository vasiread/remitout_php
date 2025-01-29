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

                <div class="scdashboard-studentapplication">
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
                                <span>03</sp>
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
                                <span>Pending</span>

                            </li>
                            <li class="scdashboard-missingdocumentsstatus">
                                <p>Missing Documents:</p>
                                <span>03</sp>
                            </li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection

</body>

</html>