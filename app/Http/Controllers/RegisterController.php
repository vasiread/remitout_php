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

    public function emailUniqueCheck(Request $request)
    {
        $email = $request->email;  // Get the email from the request

        // Check if email already exists in the database
        $emailUnique = User::where('email', $email)->exists();

        if ($emailUnique) {
            return response()->json([
                'success' => false,
                'message' => 'Email is already taken. Please choose a different one.',
            ]);
        }

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
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phoneInput,

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



        // Proceed with user creation

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