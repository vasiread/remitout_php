<?php
namespace App\Http\Controllers;

use App\Mail\SendDocumentsMail;
use App\Models\Nbfc;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use ZipArchive;



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
        // Validate request input (no need to validate email anymore)
        $request->validate([
            'userId' => 'required|string',
            'name' => 'required|string'
        ]);

        $userId = $request->input('userId');
        $name = $request->input('name');

        $baseFilePath = "$userId/static";
        $folders = Storage::disk('s3')->directories($baseFilePath);
        $filePaths = [];

        foreach ($folders as $folder) {
            try {
                $files = Storage::disk('s3')->files($folder);
                foreach ($files as $file) {
                    $filePaths[] = $file;
                }
            } catch (\Exception $e) {
                Log::error("Error retrieving files from folder $folder: " . $e->getMessage());
                continue;
            }
        }

        if (!empty($filePaths)) {
            try {
                // Ensure local temp folder exists
                $localTempDir = storage_path('app/temp');
                if (!file_exists($localTempDir)) {
                    mkdir($localTempDir, 0755, true);
                }

                // Create a temporary ZIP file
                $zipFileName = 'documents_' . Str::random(10) . '.zip';
                $localZipPath = "$localTempDir/$zipFileName";

                $zip = new ZipArchive;
                if ($zip->open($localZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                    foreach ($filePaths as $filePath) {
                        $fileContents = Storage::disk('s3')->get($filePath);
                        $zip->addFromString(basename($filePath), $fileContents);
                    }
                    $zip->close();
                }

                // Upload ZIP to S3
                $s3ZipPath = "zips/$zipFileName";
                Storage::disk('s3')->put($s3ZipPath, file_get_contents($localZipPath));

                // Generate temporary download URL (valid for 2 hours)
                $zipUrl = Storage::disk('s3')->temporaryUrl($s3ZipPath, now()->addHours(2));

                // Fetch all active NBFC emails
                $nbfcEmails = Nbfc::where('status', 'active')->pluck('nbfc_email');

                foreach ($nbfcEmails as $nbfcEmail) {
                    Mail::to($nbfcEmail)->send(new SendDocumentsMail($zipUrl, $name));
                }

                unlink($localZipPath);

                return response()->json([
                    'message' => 'Documents sent successfully to all active NBFCs.',
                ], 200);
            } catch (\Exception $e) {
                Log::error("Error sending documents: " . $e->getMessage());

                return response()->json([
                    'message' => 'An error occurred while sending the documents.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'message' => 'No documents found for this user.',
        ], 404);
    }














}
