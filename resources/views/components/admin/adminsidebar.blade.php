<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .sidebar-icon:hover{
            filter: brightness(0) invert(1);
        }
    </style>
</head>

<body>



    @extends('layouts.app')



    <div class="commonsidebar-togglesidebar" id="commonsidebar-admin">
        <ul class="commonsidebar-sidebarlists-top">
            @foreach($sidebarItems as $item)
                <li class="{{ $item['active'] ? 'active' : '' }}">
                    <img src="{{ $item['icon'] }}" alt="{{ $item['name'] }} Icon" class="sidebar-icon" />
                    <p>{{ $item['name'] }}</p>
                    @if ($item['name'] === 'Student' || $item['name'] === 'Student Counsellor')
                        <i id="expand-icon-{{ str_replace(' ', '', $item['name']) }}" class="fa-solid fa-chevron-down"></i>

                    @endif
                </li>
                @if ($item['name'] === 'Student')
                    <div id="expanded-student-admin-side">
                        <li>Student List</li>
                        <li>Applications</li>
                    </div>

                @elseif($item['name'] === 'Student Counsellor')
                    <div id="expanded-studentcounsellor-admin-side">
                        <li>Counsellor List</li>
                        <li>Ticket Lists</li>
                        <li>Add Counsellor</li>
                    </div>


                @endif
            @endforeach
        </ul>
        <ul class="commonsidebar-sidebarlists-bottom">
            <li class="logoutBtn" onClick="sessionLogout()">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
            </li>
            <li>
                <img src="{{ asset('assets/images/Icons/support_agent.png') }}" alt="support icon"> Support
            </li>
        </ul>
    </div>

    <script src="{{ asset('js/adminsidebar.js') }}"></script>


</body>



</html>