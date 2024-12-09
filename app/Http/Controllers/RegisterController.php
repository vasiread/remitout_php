<?php

namespace App\Http\Controllers;
use App\Models\CourseInfo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PersonalInfo;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Debugging: Output the request data (remove this in production)
        // dd($request->all());

        // Proceed with user creation
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

 

        // Return a proper JSON response
        if ($user) {
         

            return response()->json(['success' => true, 'message' => 'Registration successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
    }



    public function loanTracker()
    {
        // Fetch the current authenticated user's unique_id
        $userId = Auth::user()->unique_id;

        // Retrieve the user's personal information
        $user = PersonalInfo::where('user_id', $userId)->first();

        // If the user does not have personal information, redirect back with an error
        if (!$user) {
            return redirect()->back()->with('error', 'Personal information not found');
        }

        // Pass the user data to the student dashboard view
        return view('pages.studentdashboard', compact('user'));
    }



}