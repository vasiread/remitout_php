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
        /* ---------- 1. basic validation ------------------------------------ */
        $request->validate([
            'userId' => 'required|string',
            'name' => 'required|string'
           
        ]);

        $userId = $request->input('userId');
        $borrower = $request->input('name');

        /* ---------- 2. collect every file below  {userId}/static/… --------- */
        $base = "$userId/static";
        $folders = Storage::disk('s3')->directories($base);
        $fileList = [];

        foreach ($folders as $folder) {
            try {
                foreach (Storage::disk('s3')->files($folder) as $file) {
                    $fileList[] = $file;
                }
            } catch (\Throwable $e) {
                Log::error("S3 list error in [$folder]: {$e->getMessage()}");
            }
        }

        if (empty($fileList)) {
            return response()->json([
                'message' => 'No documents found for this user.'
            ], 404);
        }

        /* ---------- 3. build ZIP in local temp dir ------------------------- */
        $localDir = storage_path('app/temp');
        if (!is_dir($localDir)) {
            mkdir($localDir, 0755, true);
        }

        $zipName = 'documents_' . Str::random(10) . '.zip';
        $localZip = "$localDir/$zipName";
        $zip = new ZipArchive;

        if ($zip->open($localZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return response()->json(['message' => 'Unable to create ZIP'], 500);
        }

        foreach ($fileList as $s3Path) {
            $zip->addFromString(basename($s3Path), Storage::disk('s3')->get($s3Path));
        }
        $zip->close();

        /* ---------- 4. upload ZIP to S3 ------------------------------------ */
        $s3Path = "zips/$zipName";

        // -------  OPTION A: PERMANENT/PUBLIC URL (no time limit)  ------------
        // Make sure bucket policy or ACL allows public-read.
        Storage::disk('s3')->put(
            $s3Path,
            fopen($localZip, 'r'),
            ['ACL' => 'public-read']           // or 'visibility' => 'public' in Laravel 11
        );
        $zipUrl = Storage::disk('s3')->url($s3Path);   // never expires

        /*  -------  OPTION B: STILL PRIVATE BUT MAX 7 DAYS (comment above lines,
                       uncomment below).  ------------------------------------
        Storage::disk('s3')->put($s3Path, fopen($localZip, 'r+'));
        $zipUrl = Storage::disk('s3')->temporaryUrl($s3Path, now()->addDays(7));
        */

        /* ---------- 5. e-mail every active NBFC ---------------------------- */
        $nbfcEmails = Nbfc::where('status', 'active')->pluck('nbfc_email');

        foreach ($nbfcEmails as $email) {
            // If attachment preferred and file ≤ 10 MB, do:
            //   Mail::to($email)->send(new SendDocumentsMail($borrower, null, $localZip));
            Mail::to($email)->send(new SendDocumentsMail($zipUrl, $borrower));
        }

        /* ---------- 6. housekeeping --------------------------------------- */
        unlink($localZip);

        return response()->json([
            'message' => 'Documents sent successfully to all active NBFCs.',
            'zipUrl' => $zipUrl          // handy for debugging/API consumers
        ], 200);
    }














}
