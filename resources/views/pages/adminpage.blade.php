<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>





    <div class="admin-parentcontainer">
        <x-admin.adminsidebar :sidebarItems="$sidebarItems" />

        <div class="admin-detailedviewcontainer">
            <x-admin.admindashboard />
            <x-admin.adminstudent/>
            <x-admin.adminstudentcounsellor/>
        </div>
    </div>














</body>

</html>