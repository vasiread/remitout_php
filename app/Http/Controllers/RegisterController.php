<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CourseInfo;
use App\Models\Nbfc;
use App\Models\Scuser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

    public function emailUniqueCheck(Request $request)
    {
        $email = $request->email;  // Get the email from the request

        // Check if the email exists in any of the three models
        $emailExistsInUser = User::where('email', $email)->exists();
        $emailExistsInScuser = Scuser::where('email', $email)->exists();
        $emailExistsInNbfc = Nbfc::where('nbfc_email', $email)->exists();
        $emailExistsInAdmin = Admin::where('email',$email)->exists();

        // If the email exists in any of the models, return a response indicating it's taken
        if ($emailExistsInUser || $emailExistsInScuser || $emailExistsInNbfc || $emailExistsInAdmin) {
            return response()->json([
                'success' => false,
                'message' => 'Email is already taken',
            ]);
        }

        // If email doesn't exist in any model, it's available
        return response()->json([
            'success' => true,
            'message' => 'Email is available.',
        ]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phoneInput' => 'required',
            'password' => 'required|string|min:6',
            'referralCode' => 'nullable|string|max:255', // Optional referral code
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phoneInput,
            'password' => Hash::make($request->password),
            'referral_code' => $request->referralCode,  
        ]);

        if ($user) {
            session(['user' => $user]);
            session()->put('expires_at', now()->addSeconds(10000));

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'expires_at' => session('expires_at')->toISOString(),
            ]);
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

         return view('pages.studentdashboard', compact('user'));
    }



}