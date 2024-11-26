<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ]);

        $to = $request->input('email');
        $name = $request->input('name');

        $otp = rand(100000, 999999);
        Cache::put('otp_' . $to, $otp, 600);


        $subject = "MailTest with OTP";

        $msg = "Hi " . $name . ",\n\nYour One-Time Password (OTP) is: " . $otp;

        try {
            Mail::to($to)->send(new WelcomeMail($msg, $subject));

            return response()->json(['message' => 'Email sent with OTP'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
        }
    }
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $email = $request->input('email');
        $inputOTP = $request->input('otp');

        // Retrieve OTP from cache
        $cachedOTP = Cache::get('otp_' . $email);

        if ($cachedOTP && $cachedOTP == $inputOTP) {
            // OTP is correct, remove it from cache
            Cache::forget('otp_' . $email);
            return response()->json(['message' => 'OTP verified successfully'], 200);
        }

        return response()->json(['message' => 'Invalid or expired OTP'], 400);
    }
}
