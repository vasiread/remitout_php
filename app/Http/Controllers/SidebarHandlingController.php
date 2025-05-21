<?php

namespace App\Http\Controllers;

use App\Models\Scuser;
use Illuminate\Http\Request;

class SidebarHandlingController extends Controller
{
    public function scdashboardItems()
    {
         $sidebarItems = [
            ['name' => 'Dashboard', 'icon' => 'fa-solid fa-square-poll-vertical', 'active' => true],
            ['name' => 'Profile', 'icon' => 'fa-solid fa-inbox', 'active' => false],
            ['name' => 'Application Status', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
        ];

         

         return $sidebarItems;
    }




    public function admindashboardItems()
    {
        $sidebarItems = [
            ['name' => 'Dashboard', 'icon' => asset('assets/images/Icons/adminsidebar/dashboard.svg'), 'active' => true],
            ['name' => 'Inbox', 'icon' => asset('assets/images/Icons/adminsidebar/inbox.svg'), 'active' => false],
            ['name' => 'Student', 'icon' => asset('assets/images/Icons/adminsidebar/profile.svg'), 'active' => false],
            ['name' => 'Student Counsellor', 'icon' => asset('assets/images/Icons/adminsidebar/sccounsellor.svg'), 'active' => false],
            ['name' => 'NBFC', 'icon' => asset('assets/images/Icons/adminsidebar/nbfc.svg'), 'active' => false],
            ['name' => 'Manage Student', 'icon' => asset('assets/images/Icons/adminsidebar/manage.svg'), 'active' => false],
            ['name' => 'Role Management', 'icon' => asset('assets/images/Icons/adminsidebar/role.svg'), 'active' => false],
            ['name' => 'Edit Content', 'icon' => asset('assets/images/Icons/adminsidebar/edit.svg'), 'active' => false],
            ['name' => 'Promotional', 'icon' => asset('assets/images/Icons/adminsidebar/mail.svg'), 'active' => false],
        ];

        return $sidebarItems;
    }


}
