<?php

namespace App\Http\Controllers;
use App\Models\Nbfc;
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
        $loginPassword = $request->loginPassword;

        $isEmail = filter_var($loginName, FILTER_VALIDATE_EMAIL) !== false;

         $scuser = $isEmail
            ? Scuser::where('email', $loginName)->first()
            : Scuser::where('referral_code', $loginName)->first();

        $user = $isEmail
            ? User::where('email', $loginName)->first()
            : User::where('unique_id', $loginName)->first();

        $nbfcuser = $isEmail
            ? Nbfc::where('nbfc_email', $loginName)->first()
            : Nbfc::where('nbfc_id', $loginName)->first();

         if ($scuser && Hash::check($loginPassword, $scuser->passwordField)) {
            session(['scuser' => $scuser]);
            session()->put('scDetail', $scuser);
            session()->put('expires_at', now()->addSeconds(10000));

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $scuser,
                'redirect' => '/sc-dashboard'
            ]);
        }


        if ($user && Hash::check($loginPassword, $user->password)) {
            session(['user' => $user]);
            session()->put('expires_at', now()->addSeconds(10000));

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $user,
                'redirect' => '/student-dashboard'
            ]);
        }


        if ($nbfcuser && Hash::check($loginPassword, $nbfcuser->password)) {
            session(['nbfcuser' => $nbfcuser]);
            session()->put('expires_at', now()->addSeconds(10000));

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $nbfcuser,
                'redirect' => '/nbfc-dashboard'
            ]);
        }

        $adminEmail = env('SUPERADMIN_EMAIL');
        $adminPassword = env('SUPERADMIN_PASSWORD');
        $adminId = env('SUPERADMIN_ID');

        if ($loginName === $adminEmail && Hash::check($loginPassword, $adminPassword)) {
            session([
                'admin_user_id' => $adminId,
                'admin_role' => 'superadmin',   
            ]);
            session()->put('expires_at', now()->addSeconds(20000));

            return response()->json([
                'success' => true,
                'message' => 'Super Admin login successful',
                'redirect' => '/admin-page'
            ]);
        }

        
        return response()->json(['success' => false, 'message' => 'Invalid email/ID or password.']);
    }




    public function sessionLogout(Request $request)
    {
        Session::flush();


        Auth::logout();

        return redirect()->route('login')->with('message', 'You have been logged out.');
    }
}
