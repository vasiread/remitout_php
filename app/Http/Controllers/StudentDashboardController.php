<?php

namespace App\Http\Controllers;

use App\Models\Academics;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\DB;
use App\Models\PersonalInfo;
use App\Models\CourseInfo;
// use App\Models\

class StudentDashboardController extends Controller
{
    public function getUser()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->withErrors('Please log in to access your dashboard.');
        }

        $uniqueId = $user->unique_id;

        $courseDetails = CourseInfo::where('user_id', $uniqueId)->get();
        $academicDetails = Academics::where('user_id', $uniqueId)->get();


        $personalInfo = $user->personalInfo;
        // $academicDetails = $user->academicsInfo;

        // Ensure this returns the view
        return view('pages.studentdashboard', compact('user', 'personalInfo', 'courseDetails', $courseDetails, 'academicDetails', $academicDetails));
    }

    //
}
