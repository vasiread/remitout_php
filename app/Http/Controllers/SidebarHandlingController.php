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
            ['name' => 'Inbox', 'icon' => 'fa-solid fa-inbox', 'active' => false],
            ['name' => 'Application Status', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
        ];

        // Define referralId
        $referralId = 'HYU67994003';

        // Fetch scDetail from database
        $scDetail = Scuser::where('referral_code', $referralId)->first(); // Assuming you need just one record, use `first()` instead of `get()`

        // Check if scuser session exists, else set default value
        $scuser = session('scuser', 1);

        if (!session()->has('scuser')) {
            session(['scuser' => $scuser]);
        }

         session()->put('scDetail', $scDetail);

         session()->put('expires_at', now()->addSeconds(30000));

         return $sidebarItems;
    }



    public function admindashboardItems()
    {
        $sidebarItems = [
            ['name' => 'Dashboard', 'icon' => 'fa-solid fa-square-poll-vertical', 'active' => false],
            ['name' => 'Inbox', 'icon' => 'fa-solid fa-inbox', 'active' => false],
            ['name' => 'Student', 'icon' => 'fa-regular fa-circle-user', 'active' => false],
            ['name' => 'Student Counsellor', 'icon' => 'fa-solid fa-graduation-cap', 'active' => false],
            ['name' => 'NBFC', 'icon' => 'fa-solid fa-building-columns', 'active' => true],
            ['name' => 'Manage Student', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Role Management', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Edit Content', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
            ['name' => 'Promotional', 'icon' => 'fa-regular fa-clipboard', 'active' => false],
        ];

        return $sidebarItems;
    }

}
