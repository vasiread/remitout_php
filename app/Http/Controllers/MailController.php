<?php
namespace App\Http\Controllers;

use App\Mail\SendDocumentsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
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









    public function sendUserDocuments(Request $request)
    {
        // Validate the request
        $request->validate([
            'userId' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string'
        ]);

        $userId = $request->input('userId');
        $email = $request->input('email');
        $name = $request->input('name');

        // Set the base file path for the user
        $baseFilePath = "$userId/";

        // Get all the folders under the base path
        $folders = Storage::disk('s3')->directories($baseFilePath);

        // Initialize an array to store file paths
        $filePaths = [];

        // Loop through the folders
        foreach ($folders as $folder) {
            // Attempt to get the files within each folder
            try {
                $files = Storage::disk('s3')->files($folder);

                // Loop through the files and collect valid file paths
                foreach ($files as $file) {
                    // You could add additional checks here if needed (e.g., file size, extension)
                    $filePaths[] = $file;
                }
            } catch (\Exception $e) {
                // Log the error for later investigation
                \Log::error("Error retrieving files from folder $folder: " . $e->getMessage());
                // Continue to the next folder if an error occurs
                continue;
            }
        }

        // Check if there are any valid file paths
        if (!empty($filePaths)) {
            try {
                // Send the email with the documents attached
                Mail::to($email)->send(new SendDocumentsMail($filePaths, $email, $name, $userId));

                // Return success response
                return response()->json([
                    'message' => 'All available documents sent as attachments successfully.',
                ], 200);
            } catch (\Exception $e) {
                 \Log::error("Error sending email: " . $e->getMessage());
                return response()->json([
                    'message' => 'An error occurred while sending the documents.',
                ], 500);
            }
        }

        // If no documents were found, return a 404 response
        return response()->json([
            'message' => 'No documents found for this user.',
        ], 404);
    }















}
