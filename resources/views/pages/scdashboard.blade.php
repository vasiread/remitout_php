<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counseller Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/studentformquestionair.css">
    <link rel="stylesheet" href="assets/css/studentdashboard.css">

    <link rel="stylesheet" href="assets/css/scdashboard.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>

    <x-navbar></x-navbar>
    <div class="scdashboard-container">
        <div class="studentdashboardprofile-togglesidebar">
            <ul class="studentdashboardprofile-sidebarlists-top">
                <li class="active"> <i class="fa-solid fa-square-poll-vertical"></i> Dashboard</li>
                <li> <i class="fa-solid fa-inbox"></i> Inbox</li>
                <li> <i class="fa-regular fa-clipboard"></i> My Applications</li>

            </ul>
            <ul class="studentdashboardprofile-sidebarlists-bottom">
                <li class="logoutBtn" onClick="sessionLogout()"> <i class="fa-solid fa-arrow-right-from-bracket"></i>Log
                    out</li>
                <li> <img src="assets/images/Icons/support_agent.png" alt=""> Support</li>

            </ul>



        </div>

        <div class="scdashboard-dashboardcontent">
            <div class="scdashboard-trackprogress">
                <div class="trackprogress-firstsection">
                    <h1>Track Progress</h1>
                    <button>Generate Referral Link</button>
                </div>
                <div class="trackprogress-secondsection">
                    <div class="trackprogress-month">
                        <h1>October</h1>
                        <p>month</p>
                    </div>
                    <div class="trackprogress-noofstudent">
                        <h1>07</h1>
                        <p>no. of student</p>
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
                    <button> <img src="assets/images/Group icon.png" alt=""> Referral Code: 45628</button>
                    <button> <img src="assets/images/dbicon.png" alt="">Track Commission</button>

                </div>


            </div>
            <div class="scdashboard-studentapplication">
                <div class="studentapplication-header">
                    <h1>Applications</h1>
                    <div class="application-buttoncontainer">
                        <button class="see-all">See all</button>
                        <button class="start-new">Start New Registration</button>
                    </div>
                </div>
                <div class="studentapplication-lists">
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>Student name</h1>
                            <div class="application-buttoncontainer">
                                <button>View</button>
                                <button>Edit</button>
                                <button class="expand-arrow"> <img src="assets/images/stat_minus_1.png" alt="">  </button>
                            </div>

                        </div>

                    </div>
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>Student name</h1>
                            <div class="application-buttoncontainer">
                                <button>View</button>
                                <button>Edit</button>
                                <button class="expand-arrow"> <img src="assets/images/stat_minus_1.png" alt="">  </button>
                            </div>

                        </div>

                    </div>
                    <div class="individualapplication-list">
                        <div class="firstsection-lists">
                            <h1>Student name</h1>
                            <div class="application-buttoncontainer">
                                <button>View</button>
                                <button>Edit</button>
                                <button class="expand-arrow"> <img src="assets/images/stat_minus_1.png" alt="">  </button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>






</body>

</html>