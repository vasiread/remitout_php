<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PersonalInfo;
class LoginController extends Controller
{
    public function loginFormData(Request $request)
    {
        $request->validate([
            'loginName' => 'required|string|max:255',
            'loginPassword' => 'required|string|min:6',
        ]);
        $user = User::where('unique_id', $request->loginName)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
        }

        if (!Hash::check($request->loginPassword, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
        }


        session(['user' => $user]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user,
        ]);
        // return view('user.dashboard', compact('user', 'personalInfo'));

    }
}
