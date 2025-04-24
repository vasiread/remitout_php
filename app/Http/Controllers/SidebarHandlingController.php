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
            ['name' => 'Dashboard', 'icon' => 'fa-solid fa-square-poll-vertical', 'active' => true],
            ['name' => 'Inbox', 'icon' => 'fa-solid fa-inbox', 'active' => false],
            ['name' => 'Student', 'icon' => 'fa-regular fa-circle-user', 'active' => false],
            ['name' => 'Student Counsellor', 'icon' => 'fa-solid fa-graduation-cap', 'active' => false],
            ['name' => 'NBFC', 'icon' => 'fa-solid fa-building-columns', 'active' => false],
            ['name' => 'Manage Student', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Role Management', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Edit Content', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Promotional', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
        ];

        return $sidebarItems;
    }

}
