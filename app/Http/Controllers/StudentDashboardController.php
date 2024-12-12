<?php

namespace App\Http\Controllers;

use App\Models\Academics;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Log;
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



        $userDetails = User::where('unique_id',$uniqueId)->get();
        $courseDetails = CourseInfo::where('user_id', $uniqueId)->get();
        $academicDetails = Academics::where('user_id', $uniqueId)->get();
        $personalDetails = PersonalInfo::where('user_id', $uniqueId)->get();


        // $personalInfo = $user->personalInfo;
        // $academicDetails = $user->academicsInfo;

        // Ensure this returns the view
        return view('pages.studentdashboard', compact('user','userDetails',$userDetails, 'personalDetails', $personalDetails, 'courseDetails', $courseDetails, 'academicDetails', $academicDetails));
    }
    public function updateFromProfile(Request $request)
    {
        $validated = $request->validate([
            'editedName' => 'required|string|max:255',
            'editedPhone' => 'required|string|max:15',
            'editedEmail' => 'required|email',
            'editedState' => 'required|string|max:255',
            'iletsScore' =>'required|numeric',
            'greScore'=>'required|numeric',
            'tofelScore'=>'required|numeric',
            'userId' => 'required'
        ]);

        // Find the user by unique_id
        $user = User::where('unique_id', $validated['userId'])->first();

        if ($user) {
            // Update the User model's name and email
            $user->name = $validated['editedName'];
            $user->email = $validated['editedEmail'];
            $user->save();  // Save updated User data

            // Check if PersonalInfo exists for the user
            $personalInfo = PersonalInfo::where('user_id', $user->unique_id)->first();

            if ($personalInfo) {
                // If PersonalInfo exists, update phone and state
                $personalInfo->phone = $validated['editedPhone'];
                $personalInfo->state = $validated['editedState'];
                $personalInfo->save();  // Save updated PersonalInfo data
            } else {
                // If PersonalInfo does not exist, create a new PersonalInfo
                $personalInfo = PersonalInfo::create([
                    'user_id' => $user->unique_id,
                    'phone' => $validated['editedPhone'],
                    'state' => $validated['editedState']
                ]);
            }

            $academicsScores = Academics::where('user_id', $user->unique_id)->first();

            if($academicsScores){
                $academicsScores->ILETS = $validated['iletsScore'];
                $academicsScores->GRE = $validated['greScore'];
                $academicsScores->TOFEL = $validated['tofelScore'];
                $academicsScores->save();
            }
            else{
                $academicsScores = Academics::create([
                    'user_id' => $user->unique_id,
                    'ILETS' => $validated['iletsScore'],
                    'GRE' => $validated['greScore'],
                    'TOFEL' => $validated['tofelScore'],
                ]);

            }


            $user->refresh(); 
            $personalInfo->refresh();
            $academicsScores->refresh();

            return response()->json([
                'message' => 'User details updated successfully.',
                'user' => $user,
                'personalInfo' => $personalInfo ,
                '$academicsScores'=>$academicsScores
            ], 200);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }


    //
}
