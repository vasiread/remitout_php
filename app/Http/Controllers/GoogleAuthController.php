<?php

namespace App\Http\Controllers;

use App\Models\Nbfc;
use App\Models\PersonalInfo;
use App\Models\Scuser;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
class GoogleAuthController extends Controller
{

    public function passwordChange(Request $request)
    {
        try {
            $request->validate([
                'userId' => 'required|string',
                'currentPassword' => 'required|string|min:8',
                'newPassword' => 'required|string|min:8|different:currentPassword',
            ]);

            if (strpos($request->userId, "NBFC") !== false) {
                $user = Nbfc::where('nbfc_id', $request->userId)->first();
            } else if (strpos($request->userId, "SCREF") !== false) {
                $user = Scuser::where('referral_code', $request->userId)->first();
            } else {
                $user = User::where('unique_id', $request->userId)->first();
            }


            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            if (strpos($request->userId, "SCREF") !== false) {
                if (!Hash::check($request->currentPassword, $user->passwordField)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Current password is incorrect.',
                    ], 401);
                }
                $user->passwordField = Hash::make($request->newPassword);
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully.',
                ], 200);
            } else {
                if (!Hash::check($request->currentPassword, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Current password is incorrect.',
                    ], 401);
                }
                $user->password = Hash::make($request->newPassword);
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully.',
                ], 200);

            }





        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the password.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $email = $googleUser->getEmail();

            // Look for email in each model
            $user = User::where('email', $email)->first();
            $nbfc = Nbfc::where('nbfc_email', $email)->first();
            $scuser = Scuser::where('email', $email)->first();

            if ($user) {
                // Set session for regular User
                session(['user' => $user]);
                session()->put('expires_at', now()->addSeconds(10000));

                return redirect('/student-dashboard')->with('success', 'Google login successful');
            } elseif ($nbfc) {
                // Set session for NBFC
                session(['nbfcuser' => $nbfc]);
                session()->put('expires_at', now()->addSeconds(10000));

                return redirect('/nbfc-dashboard')->with('success', 'Google login successful as NBFC');
            } elseif ($scuser) {
                // Set session for SC User
                session(['scuser' => $scuser]);
                session()->put('scDetail', $scuser);
                session()->put('expires_at', now()->addSeconds(10000));

                return redirect('/sc-dashboard')->with('success', 'Google login successful as SC User');
            } else {
                // Create new student user and set session
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $email,
                    'password' => Hash::make(uniqid()),
                    'google_id' => $googleUser->getId(),
                ]);

                session(['user' => $newUser]);
                session()->put('expires_at', now()->addSeconds(10000));

                return redirect('/student-forms')->with('success', 'New account created and logged in with Google');
            }

        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Google login failed. Reason: ' . $e->getMessage());
        }
    }





}
