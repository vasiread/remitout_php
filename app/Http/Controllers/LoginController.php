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
        // Validate login input
        $request->validate([
            'loginName' => 'required|string|max:255',
            'loginPassword' => 'required|string|min:6',
            'loginType' => 'required|string'  // Ensure login type is validated
        ]);

        $loginName = $request->loginName;
        $loginType = $request->loginType;

        $isEmail = filter_var($loginName, FILTER_VALIDATE_EMAIL) !== false;

        // Handle login based on the type of user and whether the input is email or ID
        switch ($loginType) {
            case 'Student Counsellor':
                $scuser = $isEmail
                    ? Scuser::where('email', $loginName)->first()  // If it's email, query by email
                    : Scuser::where('referral_code', $loginName)->first();  // Otherwise, query by referral_code

                if (!$scuser || !Hash::check($request->loginPassword, $scuser->passwordField)) {
                    return response()->json(['success' => false, 'message' => 'Invalid name, email, or password.']);
                }

                session(['scuser' => $scuser]);
                session()->put('scDetail', $scuser);
                session()->put('expires_at', now()->addSeconds(10000)); // Expire in 10,000 seconds

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $scuser,
                    'redirect' => '/sc-dashboard'  // Redirect to the SC user dashboard
                ]);

            case 'User':
                // Check email or unique_id
                $user = $isEmail
                    ? User::where('email', $loginName)->first()  // If it's email, query by email
                    : User::where('unique_id', $loginName)->first();  // Otherwise, query by unique_id

                if (!$user || !Hash::check($request->loginPassword, $user->password)) {
                    return response()->json(['success' => false, 'message' => 'Invalid name, email, or password.']);
                }

                session(['user' => $user]);
                session()->put('expires_at', now()->addSeconds(10000));

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $user,
                    'redirect' => '/user-dashboard'  // Redirect to the normal user dashboard
                ]);

            case 'NBFC':
                // Check email or nbfc_id
                $NBFCuser = $isEmail
                    ? Nbfc::where('nbfc_email', $loginName)->first()  // If it's email, query by nbfc_email
                    : Nbfc::where('nbfc_id', $loginName)->first();  // Otherwise, query by nbfc_id

                if (!$NBFCuser || !Hash::check($request->loginPassword, $NBFCuser->password)) {
                    return response()->json(['success' => false, 'message' => 'Invalid name, email, or password.']);
                }

                session(['nbfcuser' => $NBFCuser]);
                session()->put('expires_at', now()->addSeconds(10000));

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $NBFCuser,
                    'redirect' => '/nbfc-dashboard'  // Redirect to the NBFC dashboard
                ]);

            default:
                return response()->json(['success' => false, 'message' => 'Invalid login type.']);
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
