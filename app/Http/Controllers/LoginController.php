<?php

namespace App\Http\Controllers;
use App\Mail\ResetPasswordMail;
use App\Models\Nbfc;
use App\Models\Scuser;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
        $adminuser = [
            $adminEmail,
            $adminId
        ];
        if ($loginName === $adminEmail && Hash::check($loginPassword, $adminPassword)) {
            session(['superadmin' => $adminuser]);




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


    public function sendResetLink(Request $request)
    {
        $request->validate([
            'loginName' => 'required|string|max:255',
        ]);

        $loginName = $request->loginName;
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

        $adminEmail = env('SUPERADMIN_EMAIL');

        if ($scuser) {
            return $this->sendResetMail($scuser->email, 'scuser');
        } elseif ($user) {
            return $this->sendResetMail($user->email, 'user');
        } elseif ($nbfcuser) {
            return $this->sendResetMail($nbfcuser->nbfc_email, 'nbfc');
        } elseif ($loginName === $adminEmail) {
            return $this->sendResetMail($adminEmail, 'superadmin');
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }

    public function sendResetMail($email, $type)
    {
        $token = Str::random(64);

        DB::table('password_resets')->where('email', $email)->delete();

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send email passing token and type separately
        Mail::to($email)->send(new ResetPasswordMail($token, $type));

        return response()->json([
            'success' => true,
            'message' => 'Reset link sent successfully.'
        ]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_resets')->where('token', $request->input('token'))->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            return response()->json(['success' => false, 'message' => 'Token expired or invalid.']);
        }

        $email = $record->email;

        if ($user = User::where('email', $email)->first()) {
            $user->password = bcrypt($request->password);
            $user->save();
        } elseif ($scuser = Scuser::where('email', $email)->first()) {
            $scuser->password = bcrypt($request->password);
            $scuser->save();
        } elseif ($nbfc = Nbfc::where('nbfc_email', $email)->first()) {
            $nbfc->password = bcrypt($request->password);
            $nbfc->save();
        }

        DB::table('password_resets')->where('email', $email)->delete();

        return response()->json(['success' => true, 'message' => 'Password has been reset successfully.']);
    }

}


