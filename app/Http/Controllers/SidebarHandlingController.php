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

}
