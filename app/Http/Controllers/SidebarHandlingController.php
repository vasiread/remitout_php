<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarHandlingController extends Controller
{
    public function scdashboardItems()
    {
        $sidebarItems = [
            ['name' => 'Dashboard', 'icon' => 'fa-solid fa-square-poll-vertical', 'active' => true],
            ['name' => 'Inbox', 'icon' => 'fa-solid fa-inbox', 'active' => false],
            ['name' => 'My Applications', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
        ];

        return view('pages.scdashboard', compact('sidebarItems'));
    }
    public function admindashboardItems()
    {
        $sidebarItems = [
            ['name' => 'Dashboard', 'icon' => 'fa-solid fa-square-poll-vertical', 'active' => true],
            ['name' => 'Inbox', 'icon' => 'fa-solid fa-inbox', 'active' => false],
            ['name' => 'Student', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Student Counsellor', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'NBFC', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Manage Student', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Role Management', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Edit Content', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Promotional', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
        ];

        return view('pages.scdashboard', compact('sidebarItems'));
    }

}
