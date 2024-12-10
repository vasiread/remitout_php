<?php

namespace App\Http\Controllers;
use App\Models\CourseInfo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    // public function store(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     try {
    //         // Log before user creation
    //         \Log::info('Attempting to create user with email: ' . $request->email);

    //         // Create the user
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         // Log after user creation
    //         \Log::info('User created: ', ['user' => $user]);

    //         // Create personal info
    //         $personalInfoDetail = PersonalInfo::create([
    //             'user_id' => $user->unique_id,
    //         ]);

    //         // Log after personal info creation
    //         \Log::info('PersonalInfo created: ', ['personalInfoDetail' => $personalInfoDetail]);

    //         // Optionally, set session and return success response
    //         session(['user' => $user]);
    //         session()->put('expires_at', now()->addSeconds(100000));

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Registration successful',
    //             'expires_at' => session('expires_at')->toISOString(),
    //         ]);

    //     } catch (\Exception $e) {
    //         // Log the error for debugging
    //         \Log::error('Error during registration: ' . $e->getMessage());

    //         return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
    //     }
    // }



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

        // $user->refresh();


        // Return a proper JSON response
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

        // Pass the user data to the student dashboard view
        return view('pages.studentdashboard', compact('user'));
    }



}