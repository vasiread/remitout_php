<?php

namespace App\Http\Controllers;

use App\Models\Nbfc;
use App\Models\Scuser;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();



    }
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

    public function callbackGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt('random_password'),
                    'unique_id' => 'HBNKJI' . str_pad(User::count() + 1, 7, '0', STR_PAD_LEFT),
                ]
            );

            session(['user' => $user]);
            session()->put('expires_at', now()->addSeconds(10000));

            return redirect()->intended('/student-forms');
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());

            return redirect('login')->with('error', 'Google login failed. Please try again.');
        }
    }



}
