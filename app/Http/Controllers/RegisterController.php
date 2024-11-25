<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

      


        // Save the data to the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  
        ]);

        // Return a response
        if ($user) {
            return response()->json(['success' => true, 'message' => 'Registration successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
    }
}