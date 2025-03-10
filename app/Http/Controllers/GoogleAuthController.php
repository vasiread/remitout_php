<?php

namespace App\Http\Controllers;

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
                'oldPassword' => 'required|string|min:6',
                'newPassword' => 'required|string|min:6',
            ]);

            $userId = $request->input('userId');
            $oldPassword = $request->input('oldPassword');
            $newPassword = $request->input('newPassword');


            $user = User::where('unique_id', $userId)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                ], 404);
            }


            if (Hash::check($oldPassword, $user->password)) {

                $user->password = Hash::make($newPassword);
                $user->save();


                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Old password does not match.',
                ], 401);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
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
