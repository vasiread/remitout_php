<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class OTPMobController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'name' => 'required',
        ]);

        try {
             $sid = env('TWILIO_SID');
            $token = env('TWILIO_AUTH_TOKEN');
            $client = new Client($sid, $token);

            // Mobile number to send OTP
            $mobile = '+91' . $request->phone;
            $name = $request->name;

             $otp = rand(100000, 999999);

            // Cache the OTP for 10 minutes
            Cache::put('otp_' . $mobile, $otp, 600);

            // Send SMS
            $message = $client->messages->create(
                $mobile, // To number
                [
                    'from' => env('TWILIO_PHONE_NUMBER'), // From Twilio number
                    'body' => "Hi $name, Your OTP code is: $otp",
                ]
            );

            return response()->json(['message' => 'OTP sent successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function verifyOTP(Request $request)
    {
        // Validate the request input
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            Log::error('Validation Error:', $validator->errors()->toArray());
            return response()->json($validator->errors(), 400);
        }

        $phone = '+91' . $request->input('phone');
        $inputOTP = $request->input('otp');

        // Retrieve OTP from cache using the phone number as a key
        $cachedOTP = Cache::get('otp_' . $phone);

        if ($cachedOTP && $cachedOTP == $inputOTP) {
            // OTP is correct, remove it from cache to prevent reuse
            Cache::forget('otp_' . $phone);

            return response()->json(['message' => 'OTP verified successfully'], 200);
        }

        // Return error if OTP is incorrect or expired
        return response()->json(['message' => 'Invalid or expired OTP'], 400);
    }




}

