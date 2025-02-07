<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



    @extends('layouts.app')
 
     

     <div class="commonsidebar-togglesidebar" id="commonsidebar-admin">
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
     <script src="{{ asset('js/adminsidebar.js') }}"></script>



</body>



</html>