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

         $referralId = 'HYU67994003';

         $scUserSession = Scuser::where('referral_code', $referralId)->first();

         if ($scUserSession) {
            session(['scuser' => $scUserSession]);

             session()->put('scDetail', $scUserSession);

            // Set session expiry
            session()->put('expires_at', now()->addSeconds(10000));
        }

        // Return sidebar items
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
