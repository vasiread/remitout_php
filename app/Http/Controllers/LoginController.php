<?php

namespace App\Http\Controllers;
use App\Models\Scuser;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginFormData(Request $request)
    {
        $request->validate([
            'loginName' => 'required|string|max:255',
            'loginPassword' => 'required|string|min:6',
        ]);

        $loginName = $request->loginName;

        if (strpos($loginName, 'SCREF') !== false) {
            $scuser = Scuser::where('referral_code', $request->loginName)->first();

            if (!$scuser) {
                return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
            }

            if (!Hash::check($request->loginPassword, $scuser->passwordField)) {
                return response()->json(['success' => false, 'message' => 'Invalid name or password']);

            }

            session(['scuser' => $scuser]);
            session()->put('scDetail', $scuser);
            session()->put('expires_at', now()->addSeconds(10000)); // Expire in 10,000 seconds
           
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $scuser,
            ]);

        } else {
            $user = User::where('unique_id', $request->loginName)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
            }

            if (!Hash::check($request->loginPassword, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Invalid name or password.']);
            }

            session(['user' => $user]);
            session()->put('expires_at', now()->addSeconds(10000)); // Expire in 10,000 seconds

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $user,
            ]);
        }

    }

    public function sessionLogout(Request $request)
    {
        Session::flush();


        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('login');
    }
}
