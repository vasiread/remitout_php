<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginFormData(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'loginName' => 'required|string|max:255',
            'loginPassword' => 'required|string|min:6',
        ]);

        // Fetch user based on 'loginName' field, which corresponds to 'name' in the database
        $user = User::where('name', $request->loginName)->first();

         if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
        }

         if (!Hash::check($request->loginPassword, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
        }

        // Return successful response
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user
        ]);
    }
}
