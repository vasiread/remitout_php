<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @section('admindashboard')
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
</body>


<script>

    document.addEventListener('DOMContentLoaded', function () {
        initializeAdminSidebar();
    })

    const initializeAdminSidebar = () => {
        const adminsidebaritems = document.querySelectorAll("#commonsidebar-admin .commonsidebar-sidebarlists-top li");
       

        adminsidebaritems.forEach((item, index) => {
            item.addEventListener("click", () => {

                if (window.innerWidth <= 640) {
                    triggeredSideBar.style.display = "none";
                    if (img.src.includes("close_icon.png")) {
                        img.src = '{{ asset('assets/images/Icons/menu.png') }}';
                    }

                }
                adminsidebaritems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                if (index === 0) {
                    
                }
                else if (index === 1) {
                   
                    
                }
                else if(index ===2) {
                    
                }
                else if(index ===3) {
                    
                }
                else if(index ===4) {
                    
                }
                else if(index ===5) {
                    
                }
            });
        });
    }

</script>

</html>